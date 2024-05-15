<?php

namespace App\Http\Controllers;

use App\Models\ActuacionFiscal;
use App\Models\Cargo;
use App\Models\PersonalUai;
use App\Services\DesignationService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class designationController extends Controller
{
    private $designationService;
    public function __construct(DesignationService $designationService)
    {
        $this->designationService = $designationService;
    }

    public function index()
    {
        return view('designation.index', ['personal' => PersonalUai::all()]);
    }

    public function download(Request $request, $actionId = 1): BinaryFileResponse | string
    {
        // todo Generate the document content in memory
        $document = $this->designationService->generate($request);

        // todo Store changes in db
        $action = ActuacionFiscal::findOrFail($actionId);

        $dates =
            [
               'planning_start'=> $request->planningStart,
               'planning_end'=> $request->planningEnd,
               'execution_start'=> $request->executionStart,
               'execution_end'=> $request->executionEnd,
               'preliminary_start' =>  $request->preliminaryStart,
               'preliminary_end' => $request->preliminaryEnd,
               'download_start' =>  $request->downloadStart,
               'download_end' => $request->downloadEnd,
               'definitive_start' => $request->definitiveStart,
               'definitive_end' => $request->definitiveEnd,
            ];


        foreach ($dates as $date => $value)
        {
            [$day, $month, $year] = explode("/", $value);
            $action->{$date} = Carbon::parse("$year-$month-$day")->toDateString();
        }

        foreach ($request->auditor as $auditor) 
        {
            $action->personalUai()->attach($auditor);
        }

        $action->update();

        return $document;
    }
}
