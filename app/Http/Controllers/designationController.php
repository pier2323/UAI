<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\PersonalUai;
use App\Services\DesignationService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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

    public function download(Request $request): BinaryFileResponse|Request
    {
        return $request;
        // Generate the document content in memory
        $document = $this->designationService->generate($request);

        return $document;
    }
}
