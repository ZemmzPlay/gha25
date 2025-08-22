@extends('master')

@section('title', 'Committees' . (isset($configuration) && isset($configuration->website_title) ? ' - ' .
  $configuration->website_title : ' - 15th GHA Meeting in Collaboration with KHF | Kuwait December 2023'))
@section('style')
  <link rel="stylesheet" href="{{ asset('css/committees.css') }}" />
@endsection

@section('content')
  <div id="committees" class="committees home-section animate slow-mo even fadeIn no-padding-bottom no-padding-top"
    data-anim-type="fadeIn" data-anim-delay="200">
    <div class="container">
      <div class="row" style="margin-bottom: 20px;">
        <div class="col-md-12">

          <h1 class="main-title">Committees</h1>

          <div id="committees-members">
            @foreach ($categories as $category)
              <div style="padding: 0 50px;">
                <h1 class="section-title"
                  style="margin-bottom: 15px;font-family: CircularBook, sans-serif;font-size: 20px; color: var(--primary-color); font-weight: bold;">
                  {{ $category->name }}</h1>

                <div class="row">
                  @forelse($category->committees->sortBy('last_name') as $member)
                    <div class="col-md-2 col-sm-4 col-xs-6 doctor-container">
                      <div class="doctor">
                        {{-- <a href="#modal-popup" class="modal-member-popup" data-id="{{ $member->id }}"> --}}
                        <div class="img-container">
                          <i class="fa-solid fa-spinner fa-spin fa-2x"></i>
                          <img class="member-image" src="{{ asset($member->image_file) }}">
                        </div>
                        <div class="doctor-info">
                          <span>{{ $member->name ? $member->name : $member->first_name . ' ' . $member->last_name }}</span>
                          @if ($member->subtitle)
                            <span>{{ $member->subtitle }}</span>
                          @endif
                          <span>{{ $member->country_name }}</span>
                        </div>
                        {{-- </a> --}}
                      </div>


                    </div>
                  @empty
                    <div class="col-md-12">
                      <label>No Committiee Found</label>
                    </div>
                  @endforelse
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>

    </div>
  </div>
@stop
