@extends('admin.master')

@section('title', 'Page Content')
@section('title2', 'Page Content')

@section('style')
{{-- <link rel="stylesheet" href="{{asset('css/admin/members.css')}}" /> --}}
@stop

@section('breadcrumps')
<ol class="breadcrumb mb-0">
    <li><a href="{{url('admin')}}">Dashboard</a></li>
    <li class="active">Page Content</li>
</ol>
@stop


@section('content')
<div class="widget no-border">

        <form class="form-horizontal" method="post" enctype="multipart/form-data">
            {{csrf_field()}}

            <div class="widget-heading clearfix">
                <div class="widget-title pull-left">
                    <h3 class="widget-title" style="margin-top:8px;">Page Content</h3>
                </div>
                <div class="pull-right">
                    <button type="submit" class="btn btn-primary"><i class="ti-save"></i></button>
                    <a class="btn btn-default" href="{{url('admin/instructors')}}"><i class="ti-arrow-left"></i></a>
                </div>
            </div>


            <div class="widget-body">

                @if(Session::has('message'))
        <div class="alert alert-success col-md-12">
            {!! Session::get('message') !!}
        </div>
        @endif
            
            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Terms</label>
                <div class="col-sm-9">
                    <textarea name="terms" id="terms">{{ old('terms') ? old('terms') : $pageContent->terms }}</textarea>
                </div>
            </div>
        </form>

    </div>

</div>
@stop

@section('scripts')
<script type="text/javascript" src="{{asset('plugins/ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function() {

        CKEDITOR.replace('terms',
        {
          customConfig : 'config.js',
      });
    });
</script>
{{-- <script src="{{asset('plugins/bootbox/bootbox.min.js')}}"></script> --}}
{{-- <script type="text/javascript" src="{{asset('build/js/page-content/e-commerce/member-list.js')}}"></script> --}}
@stop