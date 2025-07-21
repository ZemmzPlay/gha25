@extends('admin.master')

@section('title')
    @if($method == 'post')
        New Registration
    @else
        Edit Registration: {{$registration->first_name.' '.$registration->last_name}}
    @endif
@stop

@section('title2')
    @if($method == 'post')
        New Registration
    @else
        Edit Registration: {{$registration->first_name.' '.$registration->last_name}}
    @endif
@stop

@section('breadcrumps')
    <ol class="breadcrumb mb-0">
        <li><a href="{{url('admin')}}">Dashboard</a></li>
        <li><a href="{{url('admin/registrations')}}">Registrations</a></li>
        @if($method == 'post')
            <li class="active">New Registration</li>
        @else
            <li class="active">{{$registration->first_name.' '.$registration->last_name}}</li>
        @endif
    </ol>
@stop

@section('style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
@stop

@section('content')
    <div class="widget" style="padding: 0 15px;">

        <form class="form-horizontal" method="post">
            {{csrf_field()}}

            <div class="widget-heading clearfix">
                <h3 class="widget-title pull-left">
                    @if($method == 'post')
                        New Registration
                    @else
                        Edit Registration: {{$registration->name}}
                    @endif
                </h3>
                <div class="pull-right">
                    <button type="submit" class="btn btn-primary"><i class="ti-save"></i></button>
                    <a class="btn btn-default" href="{{url('admin/registrations')}}"><i class="ti-arrow-left"></i></a>
                </div>
            </div>

            <div class="widget-body">

                @if(count($errors) > 0)
                    <div class="alert alert-danger col-md-12">
                        @if(count($errors) == 1)
                            {{$errors->first()}}
                        @else
                            The following errors happened:
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                @endif

                @if(Session::has('message'))
                    <div class="alert alert-success col-md-12">
                        {!! Session::get('message') !!}
                    </div>
                @endif


                    <div class="form-group">
                        <label for="title" class="col-sm-3 control-label">Title</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="title" name="title" required>
                                <option value="">Select a Title</option>
                                <option value="Prof" {{($registration->title == "Prof") ? "selected" : ""}}>Prof</option>
                                <option value="Dr" {{($registration->title == "Dr") ? "selected" : ""}}>Dr</option>
                                <option value="Mr" {{($registration->title == "Mr") ? "selected" : ""}}>Mr</option>
                                <option value="Mrs" {{($registration->title == "Mrs") ? "selected" : ""}}>Mrs</option>
                                <option value="Miss" {{($registration->title == "Miss") ? "selected" : ""}}>Miss</option>
                            </select>
                        </div>
                    </div>

                <div class="form-group">
                    <label for="first_name" class="col-sm-3 control-label">First Name</label>
                    <div class="col-sm-9">
                        <input id="first_name" type="text" class="form-control" name="first_name" required value="{{$registration->first_name}}">
                    </div>
                </div>

                    <div class="form-group">
                        <label for="last_name" class="col-sm-3 control-label">Last Name</label>
                        <div class="col-sm-9">
                            <input id="last_name" type="text" class="form-control" name="last_name" required value="{{$registration->last_name}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="speciality" class="col-sm-3 control-label">Speciality</label>
                        <div class="col-sm-9">
                            <input id="speciality" type="text" class="form-control" name="speciality" required value="{{$registration->speciality}}">
                        </div>
                    </div>



                    <div class="form-group">
                        <label for="country" class="col-sm-3 control-label">Country</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="country" name="country" required>
                                <option value="Kuwait" {{($registration->country == 'Kuwait') ? 'selected' : ''}}>Kuwait</option>
                                <option value="Saudi Arabia" {{($registration->country == 'Saudi Arabia') ? 'selected' : ''}}>Saudi Arabia</option>
                                <option value="Iran" {{($registration->country == 'Iran') ? 'selected' : ''}}>Iran</option>
                                <option value="Egypt" {{($registration->country == 'Egypt') ? 'selected' : ''}}>Egypt</option>
                                <option value="Qatar" {{($registration->country == 'Qatar') ? 'selected' : ''}}>Qatar</option>
                                <option value="United Arab Emirates" {{($registration->country == 'United Arab Emirates') ? 'selected' : ''}}>United Arab Emirates</option>
                                <option value="Syria" {{($registration->country == 'Syria') ? 'selected' : ''}}>Syria</option>
                                <option value="Iraq" {{($registration->country == 'Iraq') ? 'selected' : ''}}>Iraq</option>
                                <option value="Jordan" {{($registration->country == 'Jordan') ? 'selected' : ''}}>Jordan</option>
                                <option value="Lebanon" {{($registration->country == 'Lebanon') ? 'selected' : ''}}>Lebanon</option>
                                <option value="Tunisia" {{($registration->country == 'Tunisia') ? 'selected' : ''}}>Tunisia</option>
                                <option value="Morocco" {{($registration->country == 'Morocco') ? 'selected' : ''}}>Morocco</option>
                                <option value="Yemen" {{($registration->country == 'Yemen') ? 'selected' : ''}}>Yemen</option>
                                <option value="Bahrain" {{($registration->country == 'Bahrain') ? 'selected' : ''}}>Bahrain</option>
                                <option value="Oman" {{($registration->country == 'Oman') ? 'selected' : ''}}>Oman</option>
                                <option value="Algeria" {{($registration->country == 'Algeria') ? 'selected' : ''}}>Algeria</option>
                                <option value="Libya" {{($registration->country == 'Libya') ? 'selected' : ''}}>Libya</option>
                                <option value="Palestine" {{($registration->country == 'Palestine') ? 'selected' : ''}}>Palestine</option>
                                <option value="Sudan" {{($registration->country == 'Sudan') ? 'selected' : ''}}>Sudan</option>
                                <option value="Djibouti" {{($registration->country == 'Djibouti') ? 'selected' : ''}}>Djibouti</option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="city" class="col-sm-3 control-label">City</label>
                        <div class="col-sm-9">
                            <input id="city" type="text" class="form-control" name="city" required value="{{$registration->city}}">
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="email" class="col-sm-3 control-label">Email Address</label>
                        <div class="col-sm-9">
                            <input type="text" name="email" placeholder="Email Address" class="form-control" value="{{$registration->email}}" required>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="countryCode" class="col-sm-3 control-label">Country Code</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="countryCode" name="countryCode" required>
                                <option value="+965" {{($registration->countryCode == '+965') ? 'selected' : ''}}>+965</option>
                                <option value="+966" {{($registration->countryCode == '+966') ? 'selected' : ''}}>+966</option>
                                <option value="+98" {{($registration->countryCode == '+98') ? 'selected' : ''}}>+98</option>
                                <option value="+20" {{($registration->countryCode == '+20') ? 'selected' : ''}}>+20</option>
                                <option value="+974" {{($registration->countryCode == '+974') ? 'selected' : ''}}>+974</option>
                                <option value="+971" {{($registration->countryCode == '+971') ? 'selected' : ''}}>+971</option>
                                <option value="+963" {{($registration->countryCode == '+963') ? 'selected' : ''}}>+963</option>
                                <option value="+964" {{($registration->countryCode == '+964') ? 'selected' : ''}}>+964</option>
                                <option value="+962" {{($registration->countryCode == '+962') ? 'selected' : ''}}>+962</option>
                                <option value="+961" {{($registration->countryCode == '+961') ? 'selected' : ''}}>+961</option>
                                <option value="+216" {{($registration->countryCode == '+216') ? 'selected' : ''}}>+216</option>
                                <option value="+212" {{($registration->countryCode == '+212') ? 'selected' : ''}}>+212</option>
                                <option value="+967" {{($registration->countryCode == '+967') ? 'selected' : ''}}>+967</option>
                                <option value="+973" {{($registration->countryCode == '+973') ? 'selected' : ''}}>+973</option>
                                <option value="+968" {{($registration->countryCode == '+968') ? 'selected' : ''}}>+968</option>
                                <option value="+213" {{($registration->countryCode == '+213') ? 'selected' : ''}}>+213</option>
                                <option value="+218" {{($registration->countryCode == '+218') ? 'selected' : ''}}>+218</option>
                                <option value="+970" {{($registration->countryCode == '+970') ? 'selected' : ''}}>+970</option>
                                <option value="+249" {{($registration->countryCode == '+249') ? 'selected' : ''}}>+249</option>
                                <option value="+253" {{($registration->countryCode == '+253') ? 'selected' : ''}}>+253</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="mobile" class="col-sm-3 control-label">Mobile</label>
                        <div class="col-sm-9">
                            <input type="tel" name="mobile" placeholder="Mobile" class="form-control" value="{{$registration->mobile}}" required>
                        </div>
                    </div>



                    <div class="form-group">
                        <label for="receive_updates" class="col-sm-3 control-label">Receive Updates</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="receive_updates" name="receive_updates">
                                <option value="0" {{($registration->receive_updates == 0) ? "selected" : ""}}>No</option>
                                <option value="1" {{($registration->receive_updates == 1) ? "selected" : ""}}>Yes</option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="onlyWorkshop" class="col-sm-3 control-label">Only Workshop</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="onlyWorkshop" name="onlyWorkshop">
                                <option value="0" {{($registration->onlyWorkshop == 0) ? "selected" : ""}}>No</option>
                                <option value="1" {{($registration->onlyWorkshop == 1) ? "selected" : ""}}>Yes</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="virtualAccess" class="col-sm-3 control-label">Virtual Access</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="virtualAccess" name="virtualAccess">
                                <option value="0" {{($registration->virtualAccess == 0) ? "selected" : ""}}>No</option>
                                <option value="1" {{($registration->virtualAccess == 1) ? "selected" : ""}}>Yes</option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="workshop_id" class="col-sm-3 control-label">Workshop</label>
                        <div class="col-sm-9">
                            <input type="hidden" name="workshop_id_old" value="{{$registration->workshop_id}}" />
                            <select class="form-control" id="workshop_id" name="workshop_id">
                                <option value="">Select Workshop</option>
                                @foreach($workshops as $workshop)
                                    <option value="{{$workshop->id}}" {{($registration->workshop_id == $workshop->id) ? "selected" : ""}}>{{$workshop->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <?php
                    $paid_status = false;
                    $PaymentStatus = "Pending";
                    $PaymentStatusColor = "";
                    $totalPrice = 0;
                    $RegistrationType = "";

                    if($method != 'post')
                    {
                        if(isset($registration->Payment)) {

                            $totalPrice = $registration->Payment->amount_paid;

                            if($registration->Payment->paid_status == 1) {
                                $paid_status = true;
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
                            $paid_status = true;
                            $PaymentStatus = "Imported";
                            $PaymentStatusColor = "green";

                            if($registration->sponsorCompany != "")
                                $PaymentStatus .= " (".$registration->sponsorCompany.")";
                        }

                        ////////////// regsitration type //////////////
                        if($registration->onlyWorkshop == 1) {
                            $RegistrationType = "Only Workshop";
                        }
                        else {
                            if(isset($registration->Workshop)) $RegistrationType = "Registration and Workshop";
                        }

                        if($RegistrationType == "") $RegistrationType = "Only Registration";
                        ////////////// regsitration type //////////////
                        ?>
                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">Payment status</label>
                            <div class="col-sm-9">
                                <input type="text" style="color: {{$PaymentStatusColor}}" class="form-control" value="{{$PaymentStatus}}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">Registration type</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{$RegistrationType}}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">Total Price</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="KD {{$totalPrice}}" readonly>
                            </div>
                        </div>
                        <?php

                        if(!$paid_status)
                        {
                            ?>
                            <div class="form-group">
                                <label for="paidByAdmin" class="col-sm-3 control-label">Pay By Admin</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="paidByAdmin" name="paidByAdmin">
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                </div>
                            </div>
                            <?php
                        }
                    }

                    if(($method == 'post') || ($method != 'post' && !$paid_status))
                    {
                        ?>
                        <div class="form-group">
                                <label for="sendEmail" class="col-sm-3 control-label">Send Email</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="sendEmail" name="sendEmail">
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                </div>
                            </div>
                        <?php
                    }
                    ?>
            </div>
        </form>
    </div>


    @if($method != 'post')
        <?php
        $transactions = App\Payment::where('registration_id', $registration->id)->orderBy('created_at', 'DESC')->get();
        if(count($transactions))
        {
            ?>
            <div class="widget" style="padding: 0 15px;">

                <div class="widget-heading clearfix">
                    <h3 class="widget-title pull-left">
                        Transactions
                    </h3>
                    
                </div>

                <div class="widget-body">
                    

                    <table id="registration-list" style="width: 100%" class="table table-hover dt-responsive nowrap">

                        <thead>
                            <tr>
                                <th>Total Price</th>
                                <th>Payment Status</th>
                                <th>Date time</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($transactions as $transaction)
                                <?php
                                $PaymentStatus = "Pending";
                                $PaymentStatusColor = "";
                                if($transaction->paid_status == 1) {
                                    $PaymentStatus = "Success";
                                    $PaymentStatusColor = "green";
                                }
                                else if($transaction->paid_status == 2) {
                                    $PaymentStatus = "Failed";
                                    $PaymentStatusColor = "red";
                                }

                                if($transaction->payment_status != "")
                                    $PaymentStatus .= " (".$transaction->payment_status.")";
                                ?>
                                <tr>
                                    <td>{{$transaction->amount_paid}}</td>
                                    <td style="color: {{$PaymentStatusColor}};">{{$PaymentStatus}}</td>
                                    <td>{{date('j F Y - g:i a', strtotime($transaction->created_at))}}</td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>


                </div>
            </div>
            <?php
        }
        ?>
    @endif




@stop





@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script type="text/javascript" src="{{asset('js/admin/registrations/registration-form.js?ver=1.2')}}"></script>
@stop