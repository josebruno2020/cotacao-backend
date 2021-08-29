<?php

namespace Database\Seeders;

use App\Models\Transportadora;
use Illuminate\Database\Seeder;

class TransportadoraSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createTransportadora('Transportadora 001');
        $this->createTransportadora('Transportadora 002');
        $this->createTransportadora('Transportadora 003');
        $this->createTransportadora('Transportadora 004');
    }

    private function createTransportadora(string $nome)
    {
        $transportadora = new Transportadora();
        $transportadora->nome = $nome;
        $transportadora->save();
    }
}
