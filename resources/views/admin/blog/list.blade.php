@extends('admin.master')

@section('title', 'Blog Posts')
@section('title2', 'Blog Posts')

@section('style')
{{-- <link rel="stylesheet" href="{{asset('css/admin/members.css')}}" /> --}}
@stop

@section('breadcrumps')
<ol class="breadcrumb mb-0">
  <li><a href="{{url('admin')}}">Dashboard</a></li>
  <li class="active">Blog Posts</li>
</ol>
@stop


@section('content')

<div class="widget no-border">

  <input type="hidden" id="blog-posts-url" value="{{ route('blog.posts.list') }}">
  <input type="hidden" id="blog-post-delete-url" value="{{ route('blog.post.delete') }}">
  <input type="hidden" id="blog-post-view-url" value="{{ url('admin/blog/post/view/') }}">

  <div class="widget-heading">
    <div class="row">
      <div class="col-md-6">
        <h3 class="widget-title" style="margin-top:8px;">Blog Posts List</h3>
      </div>
      <div class="col-md-6 text-right">
        <div class="btn-group">
          <a href="{{url('admin/blog/post/create')}}" class="btn btn-primary btn-lg">New Post</a>
        </div>
      </div>
    </div>
  </div>


  <div class="widget-body">

    @if(Session::has('message'))
    <div class="alert alert-success col-md-12">
      {!! Session::get('message') !!}
    </div>
    @endif


    <table id="blog-posts-list" style="width: 100%" class="table table-hover dt-responsive nowrap">


    </table>

  </div>

</div>
@stop

@section('scripts')
<script src="{{asset('plugins/bootbox/bootbox.min.js')}}"></script>
<script src="{{asset('js/admin/blog/list.js')}}"></script>
@stop