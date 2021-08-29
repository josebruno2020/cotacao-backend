<?php

namespace App\Http\Controllers;

use App\Http\Requests\CotacaoRequest;
use App\Http\Requests\ImpostoRequest;
use App\Models\CotacaoFrete;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class CotacaoController extends Controller
{
    public function index()
    {
        $data = CotacaoFrete::query()->orderBy('uf', 'desc')->get();

        return $this->responseData($data);
    }

    public function store(CotacaoRequest $request)
    {
        $data = $request->validated();
        $uf_transportadora = CotacaoFrete::query()->where('uf', $data['uf'])->where('transportadora_id', $data['transportadora_id']);
        if($uf_transportadora->count() > 0) {
            return $this->responseError('Já existe uma cotação dess transportadora para esse UF.');
        }

        try {
            $cotacao = CotacaoFrete::create($data);
            return $this->responseData($cotacao, Response::HTTP_CREATED);
        } catch (\Exception $exception) {
            Log::info($exception->getMessage());
            return $this->responseError('Não foi possível criar a cotação');
        }



    }

    public function imposto(ImpostoRequest $request)
    {
        $data = $request->validated();
        $cotacao_uf = CotacaoFrete::query()->where('uf', $data['uf'])->get();
        if(!$cotacao_uf) {
            return $this->responseError('UF nao encontrado');
        }

        $cotacoes = new Collection();
        foreach ($cotacao_uf as $cotacao) {
            $calculo = ((floatval($data['valor_pedido']) / 100) * floatval($cotacao->percentual_cotacao)) + $cotacao->valor_extra;
            $cotacao = $this->fillArray($cotacao, $data['valor_pedido'], floatval(number_format($calculo, '2', '.', ',')));
            $cotacoes->push($cotacao);
        }

        $cotacoes = $cotacoes->sortBy(['valor_cotacao', 'asc']);
        $cotacoes->splice(3);

        return $this->responseData($cotacoes);
    }

    private function fillArray($obj, $valor_pedido, $calculo)
    {
        return [
            'uf' => $obj->uf,
            'valor_pedido' => $valor_pedido,
            'transportadora_id' => $obj->transportadora_id,
            'valor_cotacao' => $calculo
        ];
    }
}
