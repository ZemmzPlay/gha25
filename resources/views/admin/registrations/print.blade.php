<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<style>

    @font-face {
        font-family: 'WorkSansRegular';
        src: url('../fonts/Work_Sans/static/WorkSans-Regular.ttf');
    }

   /* * {
        font-family: Helvetica, sans-serif;
    }*/


    * {
        font-family: WorkSansRegular, sans-serif;
    }

</style>
<h1 style="text-align: center; margin-top: 210px; margin-bottom:5px; text-transform: capitalize; font-size:18px">{{$registration->title}}. {{$registration->first_name}} {{$registration->last_name}}</h1>
<h2 style="text-align: center; margin-top: 0;">ID: {{$registration->id}}</h2>
{{-- <h2 style="text-align:center; margin-top:50px;">{!! DNS1D::getBarcodeSVG(str_pad($registration->id, 3, "0", STR_PAD_LEFT), "C39") !!}</h2> --}}