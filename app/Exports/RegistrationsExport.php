<?php

namespace App\Exports;

use App\Registration;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;



class RegistrationsExport implements FromQuery, WithMapping, WithHeadings, ShouldAutoSize
{

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
            'Payment Status',
            'Registration Type',
            'Virtual Access',
            'Attended',
            'Certificate Downloaded'
        ];
    }

    public function query()
    {
        // return Registration::where('onlyWorkshop', 0)->whereHas('Payment', function($query) {
        //     $query->where('paid_status', 1);
        // });
        return Registration::all();
    }

    public function collection() {
        return Registration::all();
    }
}