@extends('admin.master')

@section('title', 'Registrations')
@section('title2', 'Registrations')

@section('breadcrumps')
    <ol class="breadcrumb mb-0">
        <li><a href="{{url('admin')}}">Dashboard</a></li>
        <li class="active">Registrations</li>
    </ol>
@stop


@section('content')

    <div class="widget no-border">

        <div class="widget-heading">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="widget-title" style="margin-top:8px;">Registration List</h3>
                </div>
                @if($user->user_type == 1)
                <div class="col-md-6 text-right">
                    <div class="btn-group">
                        <a href="{{url('admin/registrations/create')}}" class="btn btn-primary btn-lg">New Registration</a>
                        <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-primary btn-lg dropdown-toggle"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="#">Import Registrations</a></li>
                        </ul>
                    </div>
                    <div class="btn-group">
                        <a href="{{url('admin/registrations/export/allReg')}}" class="btn btn-success btn-lg">Export</a>
                    </div>
                </div>
                    @endif
            </div>
        </div>


        <div class="widget-body">

            @if(Session::has('message'))
                <div class="alert alert-success col-md-12">
                    {!! Session::get('message') !!}
                </div>
            @endif


            <table id="registration-list" style="width: 100%" class="table table-hover dt-responsive nowrap">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>E-mail</th>
                        <th>Mobile</th>
                        <th>Payment status</th>
                        <th>Registration type</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($registrations as $registration)
                        <?php
                        $PaymentStatus = "Pending";
                        $PaymentStatusColor = "";
                        if(isset($registration->Payment)) {
                            if($registration->Payment->paid_status == 1) {
                                $PaymentStatus = "Success";
                                $PaymentStatusColor = "green";
                            }
                            else if($registration->Payment->paid_status == 2) {
                                $PaymentStatus = "Failed";
                                $PaymentStatusColor = "red";
                            }

                            if($registration->Payment->payment_status != "")
                                $PaymentStatus .= " (".$registration->Payment->payment_status.")";
                        }
                        else if(isset($registration->Registrant))
                        {
                            $PaymentStatus = "Imported";
                            $PaymentStatusColor = "green";

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
                        
                        ?>
                        <tr>
                            <td>{{$registration->id}}</td>
                            <td>{{$registration->first_name}} {{$registration->last_name}}</td>
                            <td>{{$registration->email}}</td>
                            <td>{{$registration->countryCode.$registration->mobile}}</td>
                            <td style="color: {{$PaymentStatusColor}}">{{$PaymentStatus}}</td>
                            <td>{!!$RegistrationType!!}</td>
                            <td>
                                <a href="{{url('admin/registrations/'.$registration->id.'/print')}}" class="btn btn-sm btn-default" target="_blank">Print ID</a>
                                <a href="{{url('admin/registrations/'.$registration->id.'/edit')}}" class="btn btn-sm btn-info">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>

        </div>

    </div>
@stop

@section('scripts')
    <script type="text/javascript" src="{{asset('plugins/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <script type="text/javascript" src="{{asset('build/js/page-content/e-commerce/registration-list.js')}}"></script>
@stop