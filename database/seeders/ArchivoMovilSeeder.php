<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ArchivoMovil;

class ArchivoMovilSeeder extends Seeder
{
    public function run()
    {
        ArchivoMovil::create(['year' => 2023, 'description' => 'Documento A', 'type' => 'Acta de Entrega']);
        ArchivoMovil::create(['year' => 2022, 'description' => 'Documento B', 'type' => 'Actuación Fiscal']);
    }
}
