<?php

return new class extends \Livewire\Volt\Component
{
    /**
     * Holds the list of employees to be displayed in the table.
     *
     * @var array
     */
    public $employees;

    /**
     * Redirect to the employee show route.
     *
     * @param int $id The ID of the employee.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function goTo($id)
    {
        return redirect()->route('employee.show', $id);
    }
}

?>

<div x-data="tableEmployee">
     @php
        foreach ($employees as $employee) 
        $employee->fullname = $employee->names();
     @endphp
    <x-table-alpine name="tableAlpinePersonal" :data="$employees" browser
        :nameColumns="[
            'P00' => 'p00',
            'Nombre' => 'fullname',
            'Correo Cantv' => 'email_cantv',
        ]"
        nameColumnId="p00"
        eventRow="x-on:dblclick" 
        x-on:dblclick="$wire.goTo(row.id)" 
    />
</div>

@script
    <script>
        Alpine.data('tableEmployee', () => {
            return {
                filtered(query, employees, pages, currentPage) {
                    if (typeof (query !== "" ? employees : pages[currentPage]) !== 'undefined') {
                        return (query !== "" ? employees : pages[currentPage]).filter(
                            employee => {
                                return employee.p00.toString().includes(query) 
                                || employee.fullname.includes(query.toUpperCase())
                                || employee.email_cantv.includes(query)
                            }
                        );
                    }
                },
            }
        })
    </script>
@endscript