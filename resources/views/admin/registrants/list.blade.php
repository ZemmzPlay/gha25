@extends('admin.master')

@section('title', 'Registrants Bulk')
@section('title2', 'Registrants Bulk')

@section('breadcrumps')
    <ol class="breadcrumb mb-0">
        <li><a href="{{url('admin')}}">Dashboard</a></li>
        <li class="active">Registrants Bulk</li>
    </ol>
@stop


@section('content')

    <div class="widget no-border">

        <div class="widget-heading">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="widget-title" style="margin-top:8px;">Registrants Bulk List</h3>
                </div>
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


            <table id="registration-list" style="width: 100%" class="table table-hover dt-responsive nowrap">

                <thead>
                    <tr>
                        <th>Name</th>
                        <th>E-mail</th>
                        <th>Mobile</th>
                        <th>File</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($registrants as $registrant)
                        <?php $file_path = 'public/registrants/'.$registrant->file; ?>
                        @if(Storage::exists($file_path))
                            <tr>
                                <td>{{$registrant->full_name}}</td>
                                <td>{{$registrant->email}}</td>
                                <td>{{$registrant->phone_code.$registrant->phone}}</td>
                                <td>
                                    <a href="{{Storage::url($file_path)}}">Download File</a>
                                </td>
                                <td>
                                    @if($registrant->confirmed)
                                        <span style="color: green; font-weight: bold;">Confirmed</span>
                                    @else
                                        <a href="{{url('admin/registrants-bulk/'.$registrant->id.'/confirm')}}" class="btn btn-sm btn-info">Confirm</a>
                                    @endif
                                    
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>

            </table>

        </div>

    </div>
@stop

@section('scripts')
    <script type="text/javascript" src="{{asset('plugins/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/admin/registrants/list.js')}}"></script>
@stop