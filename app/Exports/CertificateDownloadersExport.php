<?php

namespace App\Exports;

use App\Registration;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;



class CertificateDownloadersExport implements FromQuery, WithMapping, WithHeadings, ShouldAutoSize
{

    public function map($registration): array
    {
        return [
            $registration->id,
            $registration->title . ' ' . $registration->first_name . ' ' . $registration->last_name,
            $registration->mobile,
            $registration->email,
            $registration->speciality,
            $registration->department,
            $registration->created_at
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Phone',
            'Email',
            'Speciality',
            'Hospital / Center',
            'Date'
        ];
    }

    public function query()
    {
        return Registration::where('answered', '1');
    }

    public function collection() {
        return Registration::where('answered', '1');
    }
}