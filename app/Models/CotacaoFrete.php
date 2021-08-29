<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CotacaoFrete extends Model
{
    use HasFactory;
    protected $table = 'cotacao_frete';
    protected $fillable = ['uf', 'percentual_cotacao', 'valor_extra', 'transportadora_id'];

    public function transportadora()
    {
        return $this->belongsTo(Transportadora::class);
    }
}
