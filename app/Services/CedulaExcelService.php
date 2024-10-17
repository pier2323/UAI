<?php

namespace App\Services;

final class CedulaExcelService
{
    const documentName = 'Cedula de Trabajo.xls';
    const staticVariables = [
        'unidad_entrega' => 'gerencia control posterior',
        'unidad_adscrita' => 'UAI',
        'periodo_saliente_desde' => '20/23/2020',
        'periodo_saliente_hasta' => '10/05/2020',
        'nombre_saliente' => 'pier',
        'cedula_saliente' => '12345678',
        'auditor_a' => 'geferson',
        'auditor_b' => 'jose',
        'nombre_recibe' => 'jose',
        'cedula_recibe' => '12345678',
        'periodo_desde' => '16/08/2022',
        'periodo_hasta' => '20/15/2025',
        'cargo' => 'auditro',
    ];

    const sheets = [
        'CEDULA'
    ];

    public $document;

    public function  __construct()
    {
        $this->document = new WorkingPaperExcel(sheets: self::sheets);
    }

    public function getCells(): array
    {
        return [
            'B10' => 'unidad_entrega',
            'D10' => 'unidad_adscrita',
            'K10' => 'nombre_saliente',
            'K11' => 'cedula_saliente',
            'P10' => 'nombre_recibe',
            'P11' => 'cedula_recibe',
            'T11' => 'periodo_saliente_desde',
            // 'B10' => 'periodo_saliente_hasta',
            'C23' => 'auditor_a',
            'O23' => 'auditor_b',
        ];
    }

    public function downloadExcel()
    {
        $this->document->create($this->getCells());
      
        
        $this->document->download();

        dd($this->document);

    }
}



