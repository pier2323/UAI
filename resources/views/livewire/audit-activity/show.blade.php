<div>
     
    @isset($designation) 
    {{-- todo Acreditation --}}
    <livewire:AuditActivity.Show.Acreditation :$auditActivity :$acreditation>
    @endisset

    {{-- todo Headings --}}
    <div role="headings"> <livewire:Components.AuditActivityHeadings :$auditActivity objective></div>
    
    {{-- todo Designation --}}
    <livewire:AuditActivity.Show.Designation :$auditActivity :$designation>

</div>