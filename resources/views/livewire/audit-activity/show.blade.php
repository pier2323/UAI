<div>
        
    {{-- todo Headings --}}
    <livewire:components.audit-activity-headings 
        :$repository 
        :hasObjective="true"
    >
    
    {{-- todo Designation --}}
    <livewire:AuditActivity.Show.Designation 
        :$repository wire:model='object' 
        :typeAudit="$object->type_audit"
    >
        
    {{-- todo handover Document register --}}
    @if($isHandoverDocument)
        <livewire:Components.RegisterFormHandoverDocument 
            :auditActivity="$object" 
            :handoverDocumentId="$object->handover_document['id'] ?? null" 
        />
    @endif

</div>
