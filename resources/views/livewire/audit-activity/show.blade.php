<div>
    @isset($auditActivity->public_id)
        @dump($auditActivity->public_id)
    @endisset(isse)
        
    {{-- todo Headings --}}
    {{-- <div role="headings"> <livewire:components.audit-activity-headings :$auditActivity objective></div> --}}

    {{-- todo Designation --}}
    <livewire:AuditActivity.Show.Designation wire:model='auditActivity' :typeAudit="$auditActivity->typeAudit">

    {{-- @if($auditActivity->typeAudit->code == 'ae') --}}
     {{-- todo type_audit_id => 1 = Acta de Entrega --}}
    {{-- <livewire:Components.RegisterFormHandoverDocument :$auditActivity :modelsHandoverDocument="$handoverDocument"> --}}
    {{-- @endif --}}

</div>
