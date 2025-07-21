<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromQuery;
use App\Workshop;
use App\Registration;

class WorkshopExport implements WithMapping, WithHeadings, ShouldAutoSize, FromQuery
{

  public function __construct(int $id)
  {
    $this->id = $id;
  }

  public function map($registration): array
  {
    return [
      $registration->id,
      $registration->title . ' ' . $registration->first_name . ' ' . $registration->last_name,
      $registration->mobile,
      $registration->email,
      $registration->speciality,
      $registration->department,
      $registration->created_at,
      ($registration->answered) ? "YES" : "NO"
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
      'Date',
      'Certificate Downloaded'
    ];
  }

  public function query()
  {
    return Registration::where('workshop_id', $this->id)->whereHas('Payment', function($query) {
            $query->where('paid_status', 1);
        });
  }
}
