<?php

namespace App\Actions\DesignationAcreditation;

use App\Models\Designation;
use Carbon\Carbon;

readonly final class Designate
{
    private array $data;
    public function __construct(string $date_release) 
    {
        $date_release = Carbon::createFromFormat('d/m/Y', $date_release);
        $this->data = ['date_release' => $date_release->format('Y-m-d')];
    }

    public function __invoke(?Designation $designation = null): Designation
    {
        return $designation instanceof Designation
            ? $this->update($designation)
            : $this->create();
    }

    private function create(): Designation
    {
        return Designation::query()->create($this->data);
    }

    private function update(Designation $designation): Designation
    {
        $designation->update($this->data);
        return $designation; 
    }
}