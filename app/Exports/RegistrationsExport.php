<?php

namespace App\Exports;

use App\Registration;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;



class RegistrationsExport implements FromQuery, WithMapping, WithHeadings, ShouldAutoSize
{
    protected $workshopId;

    public function __construct($workshopId = null)
    {
        $this->workshopId = $workshopId;
    }

    public function map($registration): array
    {

        $PaymentStatus = "Pending";
        if(isset($registration->Payment)) {
            if($registration->Payment->paid_status == 1) {
                $PaymentStatus = "Success";
            }
            else if($registration->Payment->paid_status == 2) {
                $PaymentStatus = "Failed";
            }

            if($registration->Payment->payment_status != "")
                $PaymentStatus .= " (".$registration->Payment->payment_status.")";
        }
        else if(isset($registration->Registrant))
        {
            $PaymentStatus = "Imported";

            if($registration->sponsorCompany != "")
                $PaymentStatus .= " (".$registration->sponsorCompany.")";
        }


        ////////////// regsitration type //////////////
        $RegistrationType = "";
        if($registration->onlyWorkshop == 1) {
            $RegistrationType = "Only Workshop";
        }
        else {
            if(isset($registration->Workshop)) $RegistrationType = "Registration and Workshop";
        }

        // if(isset($registration->Workshop) && $RegistrationType != "")
        //     $RegistrationType .= "<br />".$registration->Workshop->title;

        if($RegistrationType == "") $RegistrationType = "Only Registration";
        ////////////// regsitration type //////////////



        return [
            $registration->id,
            $registration->title . ' ' . $registration->first_name . ' ' . $registration->last_name,
            $registration->countryCode.$registration->mobile,
            $registration->email,
            $registration->speciality,
            $registration->department,
            $registration->created_at,
            $PaymentStatus,
            $RegistrationType,
            ($registration->virtualAccess == 1) ? "YES" : "NO",
            ($registration->attended) ? "YES" : "NO",
            ($registration->answered) ? "YES" : "NO"
        ];
    }

public function query()
    {
        $query = Registration::query()->select(
            'registrations.id',
            'registrations.title',
            'registrations.first_name',
            'registrations.last_name',
            'registrations.email',
            'registrations.speciality',
            'registrations.country',
            'registrations.city',
            'registrations.countryCode',
            'registrations.mobile',
            'registrations.onlyWorkshop',
            'registrations.virtualAccess',
            'registrations.attended',
            'registrations.created_at'
        );

        if ($this->workshopId) {
            // filter via the many-to-many relation using the pivot table
            $query->whereHas('Workshops', function($q) {
                $q->where('workshops.id', $this->workshopId);
            });
        }

        return $query;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Title',
            'First Name',
            'Last Name',
            'Email',
            'Speciality',
            'Country',
            'City',
            'Country Code',
            'Mobile',
            'Only Workshop',
            'Virtual Access',
            'Attended',
            'Registered At'
        ];
    }

    public function collection() {
        return Registration::all();
    }
}