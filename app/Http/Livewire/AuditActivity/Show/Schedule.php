<?php

namespace App\Http\Livewire\AuditActivity\Show;

use Livewire\Form;

class Schedule extends Form
{
    public $planning_days = '5';
    public $executio_days = '10';
    public $preliminary_days = '10';
    public $download_days = '10';
    public $definitive_days = '5';
    public $planning_start;
    public $planning_end;
    public $execution_start;
    public $execution_end;
    public $preliminary_start;
    public $preliminary_end;
    public $download_start;
    public $download_end;
    public $definitive_start;
    public $definitive_end;
}
