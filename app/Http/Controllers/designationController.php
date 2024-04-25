<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\PersonalUai;
use App\Services\DesignationService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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

    public function download(Request $request)
    {
        // Generate the document content in memory
        $document = $this->designationService->generate($request);

        return $document;
        // $header = [
        //     'Content-Type : aplication/octet-stream',
        // ];

        // return response()->download($document, 'document01.docx', $header)->deleteFileAfterSend(true);
    }
}
