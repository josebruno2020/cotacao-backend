<?php

namespace App\Http\Controllers;

use App\Models\Transportadora;
use Illuminate\Http\Request;

class TransportadoraController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $data = Transportadora::query()->get();
            return $this->responseData($data);
        } catch (\Exception $e) {
            return $this->responseError($e->getMessage());
        }
    }
}
