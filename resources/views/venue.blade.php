@extends('master')

@section('title', 'Venue | GHAESC')

@section('content')
        <section id="where" class="home-section no-padding where">
            <div class="container-fuild">
                <div class="row no-margin" style="position: relative;">


                    <div class="container">
                        <div class="row">
                            <div class="col-md-12" style="min-height: 0px;">
                                <h1 style="position: absolute; top:0; color: #D91E43; z-index:99; margin-top: 50px; font-size: 60px;">Where</h1>
                                <a style="position: absolute; top:60px; color: #fff; z-index:99; margin-top: 50px; font-size: 16px; padding: 10px 15px; background: #da1f42;" href="https://www.google.com/maps/place/The+Regency+Kuwait/@29.316642,48.0869963,17z/data=!3m1!4b1!4m5!3m4!1s0x3fcf75fd1fddcdcd:0xa103f04ef540450f!8m2!3d29.316642!4d48.089185?shorturl=1" class="btn btn-info">Get Directions</a>
                            </div>
                        </div>
                    </div>

                    <div style="height: 325px;" class="map" id="map"></div>

                    <div class="container mapContainer">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <address>
                                    THE REGENCY
                                    <span class="address">Kuwait</span>
                                    <img src="{{asset('images/regency.png')}}" alt="" style="max-width: 200px; margin: 20px auto; display: block;">
                                    <p style="font-size:18px;">FOR MORE INFORMATION PLEASE CALL<br><span class="phone"><a href="tel:+96522467780">+965 2246 7780</a></span></p>
                                </address>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
@stop
