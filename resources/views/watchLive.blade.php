@extends('master')

@section('title', 'Watch Live'.(isset($configuration) && isset($configuration->website_title) ? ' - '.$configuration->website_title : ' - 3RD GHA - SCAI SHOCK MIDDLE EAST - KUWAIT'))


@section('style')
    <link rel="stylesheet" href="{{asset('css/watchLive.css?ver=1.1')}}" />
@stop


@section('content')
    <div class="mainContainer">
        <div class="middleContainer">
            <input type="hidden" id="nextSessionSeconds" value="{{($nextSessionSeconds != null) ? $nextSessionSeconds : ''}}" />
            <div class="allSessionsTimes none">{{json_encode($allSessionStartingTimes)}}</div>

            <div class="loadingContainer none">
                <div class="lds-ripple"><div></div><div></div></div>
                <p>Sending</p>
            </div>

            <div class="sessionInfoPart">

                <div class="SessionTitlesContainer">
                    <?php $sessionTitle = ""; ?>
                    @foreach($allSessions as $session)
                        <?php
                        $sessionKey = date('Y_m_d_H_i', strtotime($session['date_time_from']));
                        if($current == $sessionKey) $sessionTitle = $session['title'];
                        ?>
                        <div 
                            id="{{$sessionKey}}_title" 
                            class="sessionTitle {{($current != $sessionKey) ? 'none' : ''}}">{{$session['title']}}</div>
                    @endforeach
                </div>

                <div class="localTime">Local Time: {{date('H:i')}}</div>

                <div class="SessionContentsContainer">
                    @foreach($allSessions as $session)
                        <?php $sessionKey = date('Y_m_d_H_i', strtotime($session['date_time_from'])); ?>
                        <div 
                            id="{{$sessionKey}}_content"
                            class="sessionContent {{($current != $sessionKey) ? 'none' : ''}}">
                            @if(isset($session['moderator']))
                                <div class="sessionContentText">Moderator: {{$session['moderator']}}</div>
                            @endif

                            @if(isset($session['panelists']))
                                <div class="sessionContentText">Panelists: {{$session['panelists']}}</div>
                            @endif
                            
                            @if(isset($session['lectures']))
                                @foreach ($session['lectures'] as $lecture)
                                    <div class="sessionContentText">{{date('H:i', strtotime($lecture['lecture_start_time']))}} - {{date('H:i', strtotime($lecture['lecture_end_time']))}}</div>
                                    <div class="sessionContentText">{{$lecture['lecture_title']}}</div>
                                    @if(isset($lecture['speakers']))
                                        <div class="sessionContentText">{{$lecture['speakers']}}</div>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    @endforeach
                </div>

            </div>
            <div class="liveConfPart">
                <div class="sessionTitleMobile">{{$sessionTitle}}</div>
                <div class="videoPart">
                    <div class="topPartBlur"></div>
                    <div class="bottomPartBlur"></div>
                    <div class="playVideoButtonContainer">
                        <div class="playVideoButton">
                            <div class="playVideoButtonIn"></div>
                        </div>
                    </div>
                    @if($configuration->broadcastLink != "")
                        <?php $youtubeLink = $configuration->broadcastLink."&amp;controls=0&amp;showinfo=0&amp;autohide=1"; ?>
                        <input type="hidden" id="youtubeLink" value="{{$youtubeLink}}">
                        <iframe id="youtubeVideo" width="100%" height="100%" src="{{$youtubeLink}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    @endif
                </div>

                @if($configuration->enableLiveConferenceQuestions)
                    <div class="questionContainer">
                        <textarea class="questionText" placeholder="Enter your question here"></textarea>
                        <button class="submitQuestion">Send</button>
                    </div>
                    <div class="responseMsg successResp none"></div>
                @endif

            </div>
        </div>
    </div>
@stop


@section('scripts')
    <script type="text/javascript" src="{{asset('js/watchLive.js')}}"></script>
@stop

