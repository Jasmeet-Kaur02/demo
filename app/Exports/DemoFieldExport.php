<?php

namespace App\Exports;

use App\Models\DemoField;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DemoFieldExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $demoFields = DemoField::all("firstName", "lastName", "executionTime");

        return $demoFields;
    }

    public function headings(): array
    {
        return [
            'First Name',
            'Last Name',
            'Execution Time'
        ];
    }
}
