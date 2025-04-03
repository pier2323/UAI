<?php

use App\Models\AuditActivity;
use App\Repositories\AuditActivityRepository;
use App\Models\Employee;
use Illuminate\Contracts\Support\Renderable;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Modelable;
use Livewire\Attributes\Reactive;
use Livewire\Attributes\Renderless;

new class extends \Livewire\Volt\Component
{
    #[Modelable]
    public array $employees;

    #[Reactive]
    public ?array $errors;

    #[Reactive]
    public bool $isEditing = true;

    #[Reactive]
    public bool $isCreated = false;

    #[Reactive]
    public AuditActivityRepository $repository;

    #[Renderless]
    public function addCard($id): object
    {
        return (object) Employee::with('jobTitle')->find($id)->toArray();
    }
};

?>

<div class="">
    {{-- ? A good traveler has no fixed plans and is not intent upon arriving. --}}

    <div :class="typeof $wire.errors[0] !== 'undefined' ? 'border-red-400' : ''"
    class="flex flex-col flex-grow h-full px-3 pt-3 pb-5 align-middle border-2 shadow rounded-sd w-fit"
    >
        <h1 class="text-3xl font-bold dark:text-white">Comisión<small class="font-semibold text-gray-500 ms-2 dark:text-gray-400">de la Auditoría</small></h1>

        <hr class="mb-4">

        <div class="w-full">

            {{-- todo cards --}}
            <div class="grid items-center content-center grid-cols-3 p-2 auto-rows-fr gap-x-8 gap-y-5 min-h-56 min-w-96"
            x-data="card()"

            x-on:cancel.window="cancelEdit()"
            x-on:saving.window="updatedWire()"
            x-on:saved.window="updatedWire()"
            x-on:deleted.window="deleting()"
            >

                {{-- todo x-for --}}
                <template class="w-fit"
                x-for="(card, index) in employees"
                :key="'card-'+index">

                    <div class="w-fit">

                        {{-- todo one card --}}
                        <x-card-profile class="cards-profile">

                            <div x-show="isSelecting()"
                            class="flex flex-row justify-between mb-1" >

                                {{-- todo Select Role  --}}
                                <select x-model='card.role' :id="'browser-card-select-' + index" name="role" class="block text-sm text-gray-900 border-0 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 w-fit">
                                    <option value="1">Coordinador</option>
                                    <option value="2" selected>Auditor</option>
                                </select>

                                {{-- todo closeButton --}}
                                <button class="inline-block p-1 text-sm text-gray-500 rounded-lg dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-2 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700"
                                type="button"
                                x-on:click="clickCloseButton(card)">
                                    <span class="sr-only">Open dropdown</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" height="30px" viewBox="0 -960 960 960" width="30px" fill="#5f6368"><path d="m249-207-42-42 231-231-231-231 42-42 231 231 231-231 42 42-231 231 231 231-42 42-231-231-231 231Z"/></svg>
                                </button>

                            </div>

                        </x-card-profile>
                    </div>

                </template>

                @can('auditActivity.show.designationAcreditation')
                    {{-- todo card Add --}}
                    @push('modals') <livewire:employee.browser /> @endpush
                @endcan

                @can('auditActivity.show.designationAcreditation')
                    {{-- todo button add card --}}
                    <div x-show='isSelecting()' class="w-1/2 bg-gray-200 border border-gray-200 rounded-full shadow justify-self-center h-1/2 dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 active:bg-green-100"
                    x-on:click="clickAddCardButton()"
                    x-on:add-card.window="resolve($wire.addCard($event.detail.id)); ">
                        <?xml version="1.0" encoding="utf-8"?><!-- Uploaded to: SVG Repo, www.svgrepo.com, Generator: SVG Repo Mixer Tools -->
                        <svg class="w-full h-full" width="800px" height="800px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4 12H20M12 4V20" stroke="#ccc" stroke-width=".9" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                @endcan

            </div>
        </div>

        <x-errors-all :custom="$errors"/>
    </div>

</div>

@script
    <script>
        Alpine.data('card', () => {
            return {
                employees: {},

                remove(key) {
                    this.employees = this.employees.filter(employee => employee.data !== key.data)
                },

                resolve(promise) {
                    promise.then(data => {

                        this.employees.push({
                            data: data,
                            role: 1,
                        })

                    })
                },

                clickAddCardButton() {
                    datas = this.employees.map( employees => employees.data );
                    @this.dispatch('open-browser', { employees: datas });
                    this.updatedWire();
                },

                clickCloseButton(card) {
                    this.remove(card);
                    @this.dispatch('delete-card', { employees: this.employees });
                    this.updatedWire();
                },

                updatedWire() {
                    $wire.$parent.updateTableEmployee(this.employees);
                },

                updateAlpine() {
                    this.employees = @js($employees);
                    this.employeesWithEdit = @js($employees);
                },

                isSelecting() {
                    return !$wire.isCreated || $wire.isEditing;
                },

                cancelEdit() {
                    $wire.employees = this.employeesWithEdit;
                    this.updateAlpine()
                },

                deleting() {
                    $wire.employees = [];
                    this.employees = [];
                },

                init() {
                    this.updateAlpine();
                },

            }
        })
    </script>
@endscript
