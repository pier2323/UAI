<div>

    {{-- todo Headings --}}
    <div role="headings"> <livewire:Components.AuditActivityHeadings :$auditActivity objective></div>

    {{-- todo Designation --}}
    <livewire:AuditActivity.Show.Designation :$auditActivity>

    @if($auditActivity->type_audit_id === 1) {{-- todo type_audit_id => 1 = Acta de Entrega --}}
    <livewire:Components.RegisterFormHandoverDocument :$auditActivity :mod  elsHandoverDocument="$handoverDocument">
    @endif

</div>
