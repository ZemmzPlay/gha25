@extends('admin.master')

@section('title', 'Create Blog Post')
@section('title2', 'Create Blog Post')
@section('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/css/intlTelInput.css">
<style type="text/css">
  .iti { width: 100%; }
</style>
<link rel="stylesheet" href="{{ asset('css/admin/blog/posts.css') }}">
@endsection

@section('breadcrumps')
<ol class="breadcrumb mb-0">
  <li><a href="{{url('admin')}}">Dashboard</a></li>
  <li><a href="{{url('admin/blog/posts')}}">Blog Post</a></li>
  <li class="active">Create Blog Post</li>
</ol>
@stop


@section('content')
<div class="widget" style="padding: 0 15px;">


  <form class="form-horizontal" action="{{ route('blog.post.create') }}" method="post" enctype="multipart/form-data">
    @csrf

    <div class="widget-heading clearfix">
      <h3 class="widget-title pull-left">
        Create Blog Post
      </h3>
      <div class="pull-right">
        <button type="submit" class="btn btn-primary"><i class="ti-save"></i></button>
        <a class="btn btn-default" href="{{route('blog.posts')}}"><i class="ti-arrow-left"></i></a>
      </div>
    </div>

    <div class="widget-body">

      @if ($errors->has('space'))
      <div class="alert alert-danger col-md-12">
        {{ $errors->first('space') }}
      </div>
      @endif

      @if(Session::has('message'))
      <div class="alert alert-success col-md-12">
        {!! Session::get('message') !!}
      </div>
      @endif

      {{-- Title --}}
      <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
        <label for="title" class="col-sm-3 control-label">Title</label>
        <div class="col-sm-9">
          <input id="title" type="text" class="form-control" name="title" required autofocus value="{{ old('title') }}">

          @if ($errors->has('title'))
          <span class="help-block">
            <strong>{{ $errors->first('title') }}</strong>
          </span>
          @endif
        </div>
      </div>
      {{-- Title --}}

      {{-- Text --}}
      <div class="form-group{{ $errors->has('text') ? ' has-error' : '' }}">
        <label for="text" class="col-sm-3 control-label">Text</label>
        <div class="col-sm-9">
          <textarea id="text" type="text" class="form-control" name="text" required autofocus>{{ old('text') }}</textarea>

          @if ($errors->has('text'))
          <span class="help-block">
            <strong>{{ $errors->first('text') }}</strong>
          </span>
          @endif
        </div>
      </div>
      {{-- Text --}}


      {{-- Author --}}
      <div class="form-group{{ $errors->has('author') ? ' has-error' : '' }}">
        <label for="author" class="col-sm-3 control-label">Author</label>
        <div class="col-sm-9">
          <input id="author" type="text" class="form-control" name="author" required autofocus value="{{ old('author') }}">

          @if ($errors->has('author'))
          <span class="help-block">
            <strong>{{ $errors->first('author') }}</strong>
          </span>
          @endif
        </div>
      </div>
      {{-- Author --}}

      {{-- Thumbnail --}}
      <div class="form-group{{ $errors->has('thumbnail') ? ' has-error' : '' }}">
        <label for="thumbnail" class="col-sm-3 control-label">Thumbnail</label>
        <label class="col-sm-9" for="thumbnail">
          <div class="img-container-list">
            <img src="{{asset('images/add.png')}}" class="thumbnailPreview" style="width: 200px;">
          </div>
          <input id="thumbnail" type="file" class="form-control hidden" name="thumbnail" required autofocus value="{{ old('thumbnail') }}">

          @if ($errors->has('thumbnail'))
          <span class="help-block">
            <strong>{{ $errors->first('thumbnail') }}</strong>
          </span>
          @endif
        </label>
      </div>
      {{-- Thumbnail --}}

    </div>
  </form>
</div>
@section('scripts')
<script type="text/javascript" src="{{asset('plugins/ckeditor/ckeditor.js?ver="1.1')}}"></script>
<script type="text/javascript" src="{{asset('js/admin/blog/post.js?ver="1.0')}}"></script>
{{-- <script type="text/javascript">
  $(document).ready(function() {

    CKEDITOR.replace('text',
    {
      customConfig : 'config.js',
    });
  });

  $(document).on('change', '#thumbnail', function(event) {
    // event.preventDefault();
      /* Act on the event */
    input = this;
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      // var id = $(input).attr('id');
    // id = id.replace('/_/g', ' ');
    // console.log(id);
      reader.onload = function (e) {
        $('.thumbnailPreview').attr('src', e.target.result);
        // $('#remove-' + camelize_id).val('false');
        // $('button[data-id=' + id + ']').attr('disabled', false);
      }
      reader.readAsDataURL(input.files[0]);
    }
  });
</script> --}}
@endsection
@stop


