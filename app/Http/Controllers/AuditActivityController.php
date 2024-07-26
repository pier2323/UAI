<?php

namespace App\Http\Controllers;

use App\Models\AuditActivity;
use App\Models\HandoverDocument;

class AuditActivityController extends Controller
{
    /**
     * todo Display the specified resource. 
     */
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view(view: 'auditActivity.index', data: [
            "auditActivities" => AuditActivity::with([
                'handoverDocument' => [
                    'employeeIncoming',
                    'employeeOutgoing' => [
                        'jobTitle',
                    ],
                ],
                'employee' => [
                    'uai'
                ],
                'typeAudit',
            ])->get(),
        ]);
    }























































    

    // public function create()
    // {
    //     $typeAudits = TypeAudit::all();
    //     return view('action.create', ['typeAudits' => $typeAudits]);
    // }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'target' => 'required',
    //         'typeAudit' => 'required',
    //         'started_at' => 'required',
    //         'ended_at' => 'required',
    //     ]);

    //     $action = new Action();
    //     $action->target = $request->target;
    //     $action->type_audits_id = $request->typeAudit;
    //     $action->started_at = $request->started_at;
    //     $action->ended_at = $request->ended_at;

    //     $action->save();
    //     return redirect()->route('action.show', $action->id);
    // }

    // public function show(Action $action) // * $action->id
    // {
    //     $typeAudit = TypeAudit::where('id', $action->type_audits_id)->first();
    //     return view('action.show', ['response' => 
    //     ['action' => $action, 'typeAudit' => $typeAudit]]);
    // }

    // public function edit(Action $action) // * $action->id
    // {
    //           $typeAuditOld = TypeAudit::find($action->type_audits_id);
    //     $typeAuditList = TypeAudit::all();
    //     return view('action.edit', 
    //     ['response' => ['action' => $action, 'typeAuditOld' => $typeAuditOld, 'typeAuditList' => $typeAuditList]]);
    // }

//     public function update(Request $request, Action $action) // * $action->id
//     {
//         $request->validate([
//             'target' => 'required',
//             'typeAudit' => 'required',
//             'started_at' => 'required',
//             'ended_at' => 'required',
//         ]);
//         $action->target = $request->target;
//         $action->type_audits_id = $request->typeAudit;
//         $action->started_at = $request->started_at;
//         $action->ended_at = $request->ended_at;

//         $action->save();
//         return redirect()->route('action.show', $action->id);
//     }
}
