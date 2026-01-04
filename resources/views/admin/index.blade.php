@extends('admin.master')

@section('title', 'Z Events Management System')
@section('title2', 'Z Events Management System')



@section('breadcrumps')
    <p class="text-muted mb-0">{{date("l, d F Y")}}</p>
@stop

@section('content')

    <div class="row dashboard">
        <div class="col-md-4 col-sm-6">
            <div class="widget text-center">
                <div class="widget-body">
                    <h5 class="mb-5">Registrations</h5>
                    <div class="fs-36 fw-600 mb-20 counter">{{$registration_count}}</div>
                    <div class="stat-icon fs-60">
                        <i class="ti-user text-muted"></i>
                    </div>
                    <a href="{{route('registrations.export.allReg')}}" class="btn btn-primary"><i class="ti-file"></i> Export List</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-6">
            <div class="widget text-center">
                <div class="widget-body">
                    <h5 class="mb-5">Attendees</h5>
                    <div class="fs-36 fw-600 mb-20 counter">{{$attendees}}</div>
                    <div class="stat-icon fs-60">
                        <i class="ti-check text-muted"></i>
                    </div>
                    <a href="{{route('registrations.export.attendees')}}" class="btn btn-primary"><i class="ti-file"></i> Export List</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-6">
            <div class="widget text-center">
                <div class="widget-body">
                    <h5 class="mb-5">Certificate Downloads</h5>
                    <div class="fs-36 fw-600 mb-20 counter">{{$certificate_downloads}}</div>
                    <div class="stat-icon fs-60">
                        <i class="ti-download text-muted"></i>
                    </div>
                    <a href="{{route('registrations.export.downloaders')}}" class="btn btn-primary"><i class="ti-file"></i> Export List</a>
                </div>
            </div>
        </div>

        @foreach($workshops as $workshop)
        <div class="col-md-4 col-sm-6">
            <div class="widget text-center">
                <div class="widget-body">
                    <h5 class="mb-5">{{ $workshop->title }}</h5>
                    <div class="fs-36 fw-600 mb-20 counter">{{ count($workshop->RegistrationWorkshops) }}</div>
                    <div class="stat-icon fs-60">
                        <i class="ti-briefcase text-muted"></i>
                    </div>
                    <a href="{{route('registrations.export.workshop', $workshop->id)}}" class="btn btn-primary"><i class="ti-file"></i> Export List</a>
                </div>
            </div>
        </div>
        @endforeach

    </div>

    <div class="row">



        <div class="col-md-6">
            <div class="widget">
                <div class="widget-heading">
                    <h3 class="widget-title">Quick Settings</h3>
                </div>

                <div class="widget-body">
                    <div class="row">
                        <div class="col-md-8">
                            <label>Certificate issuing</label>
                        </div>
                        <div class="col-md-4">
                            <div class="has-success">
                                <div class="switch mt-0">
                                    <input id="switchCertificates" type="checkbox" value="1" {{(Settings::get('certificates_enabled')) ? "checked" : ""}}>
                                    <label for="switchCertificates" class="switch-success"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <label>Registration</label>
                        </div>
                        <div class="col-md-4">
                            <div class="has-success">
                                <div class="switch mt-0">
                                    <input id="switchRegistration" type="checkbox" value="1" {{(Settings::get('registration_enabled')) ? "checked" : ""}}>
                                    <label for="switchRegistration" class="switch-success"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <label>Maintenance Mode</label>
                        </div>
                        <div class="col-md-4">
                            <div class="has-success">
                                <div class="switch mt-0">
                                    <input id="switchMaintenanceMode" type="checkbox" value="1" {{(Settings::get('maintenance_mode')) ? "checked" : ""}}>
                                    <label for="switchMaintenanceMode" class="switch-success"></label>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>


        </div>
        <div class="col-md-6">
            <div class="widget">
                <div class="widget-heading">
                    <h3 class="widget-title">Check in</h3>
                </div>

                <div class="widget-body">
                    <div class="row">
                        <div class="col-md-8">
                            <label>Certificate issuing</label>
                        </div>
                        <div class="col-md-4">
                            <div class="has-success">
                                <div class="switch mt-0">
                                    <input id="switchCertificates" type="checkbox" value="1" {{(Settings::get('certificates_enabled')) ? "checked" : ""}}>
                                    <label for="switchCertificates" class="switch-success"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <label>Registration</label>
                        </div>
                        <div class="col-md-4">
                            <div class="has-success">
                                <div class="switch mt-0">
                                    <input id="switchRegistration" type="checkbox" value="1" {{(Settings::get('registration_enabled')) ? "checked" : ""}}>
                                    <label for="switchRegistration" class="switch-success"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <label>Maintenance Mode</label>
                        </div>
                        <div class="col-md-4">
                            <div class="has-success">
                                <div class="switch mt-0">
                                    <input id="switchMaintenanceMode" type="checkbox" value="1" {{(Settings::get('maintenance_mode')) ? "checked" : ""}}>
                                    <label for="switchMaintenanceMode" class="switch-success"></label>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>



    </div>

@stop

@section('scripts')
    <script type="text/javascript" src="{{asset('plugins/toastr/toastr.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            let switchMaintenanceMode = $('#switchMaintenanceMode');
            let maintenanceMode;
            let switchCertificates = $('#switchCertificates');
            let switchCertificatesStatus;
            let switchRegistration = $('#switchRegistration');
            let switchRegistrationStatus;


            switchMaintenanceMode.on('change', function() {
                if($(this).prop('checked') == false) {
                    maintenanceMode = 0;
                } else {
                    maintenanceMode = 1
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-Token': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "/admin/ajax/settings",
                    cache: false,
                    data: {
                        key: 'maintenance_mode',
                        value: maintenanceMode
                    },
                    success: function() {
                        toastr.warning(maintenanceMode ? 'Maintenance mode has been activated.' : 'Maintenance mode has been deactivated.', 'Maintenance Mode', {
                            "closeButton": true,
                            "positionClass": "toast-bottom-right",
                            "showDuration": "3000",
                            "hideDuration": "3000",
                            "timeOut": "500000",
                            "extendedTimeOut": "30000"
                        });
                    }
                });
            });

            switchCertificates.on('change', function() {
                if($(this).prop('checked') == false) {
                    switchCertificatesStatus = 0;
                } else {
                    switchCertificatesStatus = 1
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-Token': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "/admin/ajax/settings",
                    cache: false,
                    data: {
                        key: 'certificates_enabled',
                        value: switchCertificatesStatus
                    }
                });
            });

            switchRegistration.on('change', function() {
                if($(this).prop('checked') == false) {
                    switchRegistrationStatus = 0;
                } else {
                    switchRegistrationStatus = 1
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-Token': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: "/admin/ajax/settings",
                    cache: false,
                    data: {
                        key: 'registration_enabled',
                        value: switchRegistrationStatus
                    }
                });
            });





            $("#showtoast").click(function() {
                toastr.success('Are you the 6 fingered man?');
                toastr.warning('My name is Inigo Montoya. You killed my father, prepare to die!');
                toastr.success('Have fun storming the castle!', 'Miracle Max Says');
                toastr.error('I do not think that word means what you think it means.', 'Inconceivable!');
                toastr.success('We do have the Kapua suite available.', 'Turtle Bay Resort', {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "500000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                });

            });

        });
    </script>
@stop