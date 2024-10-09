<div>
     
    @isset($designation) 
    {{-- todo Acreditation --}}
    <livewire:AuditActivity.Show.Acreditation :$auditActivity :$acreditation>
    @endisset

    {{-- todo Headings --}}
    <div role="headings"> <livewire:Components.AuditActivityHeadings :$auditActivity objective></div>
    
    {{-- todo Designation --}}
    <livewire:AuditActivity.Show.Designation :$auditActivity :$designation>

    @if($auditActivity->type_audit_id === 1) {{-- todo type_audit_id => 1 = Acta de Entrega --}}
    <livewire:AuditActivity.Show.RegisterFormHandoverDocument :$auditActivity :modelsHandoverDocument="$handoverDocument">
    @endif
    
</div>