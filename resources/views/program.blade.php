@extends('master')

@section('title', 'Program'.(isset($configuration) && isset($configuration->website_title) ? ' - '.$configuration->website_title : ' - 3RD GHA - SCAI SHOCK MIDDLE EAST - KUWAIT'))


@section('style')
    <link rel="stylesheet" href="{{asset('css/program.css?ver=1.2')}}" />
@stop


@section('content')

    <div class="program_container">
        <div class="program_middle_container">
            <div class="program_title">The Program</div>

            <div class="text-right">
                <a href="{{route('downloadProgramPDF')}}" class="download_program_btn" target="_blank"><i class="fa fa-download"></i> Download Program PDF</a>
            </div>


            <?php
            $WednesdayNotWorkshop = [];
            $workshops = [];
            if(isset($dates['2023-12-13']))
            {
                $sessionsOfWorkshops = $dates['2023-12-13'];
                if(count($sessionsOfWorkshops))
                {
                    foreach ($sessionsOfWorkshops as $session)
                    {
                        if (strpos($session->title, 'Echocardiography Workshop') !== false)
                        {
                            $oneWorkshop = [];
                            if(array_key_exists('Echocardiography Workshop', $workshops))
                                $oneWorkshop = $workshops['Echocardiography Workshop'];

                            $oneWorkshop[] = $session;
                            $workshops['Echocardiography Workshop'] = $oneWorkshop;
                        }
                        else if (strpos($session->title, 'ECG & Arrhythmia') !== false)
                        {
                            $oneWorkshop = [];
                            if(array_key_exists('ECG & Arrhythmia Workshop', $workshops))
                                $oneWorkshop = $workshops['ECG & Arrhythmia Workshop'];

                            $oneWorkshop[] = $session;
                            $workshops['ECG & Arrhythmia Workshop'] = $oneWorkshop;
                        }
                        else if (strpos($session->title, 'BLS Workshop') !== false)
                        {
                            $oneWorkshop = [];
                            if(array_key_exists('BLS Workshop', $workshops))
                                $oneWorkshop = $workshops['BLS Workshop'];

                            $oneWorkshop[] = $session;
                            $workshops['BLS Workshop'] = $oneWorkshop;
                        }
                        else 
                        {
                            $WednesdayNotWorkshop[] = $session;
                        }
                    }
                }
            }
            ?>

            @if(count($workshops))
            <div class="program_sub_title">Workshops (Wednesday, December 13th 2023)</div>
            <div class="all_programs">
                <?php
                foreach ($workshops as $workshopTitle => $workshopSessions)
                {
                    ?>
                    <div class="oneProgram">
                        <div class="oneProgramHeader">
                            <span class="oneProgramDate">{{$workshopTitle}}</span>
                            <div class="oneProgramExCol" id="expandProgram">
                                <!-- <span class="expand-icon">Expand</span> -->
                                <span class="plus-sign">+</span>
                            </div>
                            <div class="oneProgramExCol hide" id="collapseProgram">
                                <!-- <span class="expand-icon">Collapse</span> -->
                                <span class="plus-sign">-</span>
                            </div>
                        </div>
                        <div class="oneProgramContent">
                            @if(count($workshopSessions))
                            <div class="allSessions">
                                <?php
                                foreach ($workshopSessions as $workshopSession)
                                {
                                    //// get panelist ////
                                    $panelistText = "";
                                    $panelists = $workshopSession->panelists;
                                    foreach ($panelists as $panelistkey => $panelist) {
                                        $panelistText .= $panelist->name;
                                        if($panelistkey < count($panelists) - 1) $panelistText .= ", ";
                                    }
                                    //// get panelist ////

                                    ?>
                                    <div class="oneSession">
                                        <div class="oneSessionTitle">{{$workshopSession->title}}</div>
                                        @if(isset($workshopSession->moderator))
                                        <div class="oneSessionText">Moderator: {{$workshopSession->moderator->name}}</div>
                                        @endif
                                        @if($panelistText != "")
                                        <div class="oneSessionText">Panelists: {{$panelistText}}</div>
                                        @endif

                                        <?php
                                        $lectures = $workshopSession->lectures;
                                        ?>

                                        @if(count($lectures))
                                        <div class="oneSessionTiming">
                                            <?php
                                            foreach ($workshopSession->lectures as $lecture)
                                            {
                                                //// fetch speakers ////
                                                $speakerText = "";
                                                $speakers = $lecture->speakers;
                                                foreach ($speakers as $speakerkey => $speaker)
                                                {
                                                    $speakerText .= $speaker->name;
                                                    if($speakerkey < count($speakers) - 1) $speakerText .= ", ";
                                                }
                                                //// fetch speakers ////

                                                ?>
                                                <div class="oneSessionTimeRow">
                                                   <div class="oneSessionTime">{{date('H:i', strtotime($lecture->lecture_start_time))}} - {{date('H:i', strtotime($lecture->lecture_end_time))}}</div>
                                                   <div class="oneSessionDescription"><b>{{$lecture->lecture_title}}</b>
                                                        @if($speakerText != "")
                                                            <br />
                                                            <label class="oneSessionSpeaker">{{$speakerText}}</label>
                                                        @endif
                                                        @if($lecture->lecture_parts != "" && $lecture->lecture_parts != null)
                                                            <div class="oneSessionParts">{!!nl2br($lecture->lecture_parts)!!}</div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                        @endif


                                        @if(!isset($workshopSession->moderator) && $panelistText == "" && (count($lectures) == 0))
                                            <div class="oneSessionText">{{date('H:i', strtotime($workshopSession->start_time))}} - {{date('H:i', strtotime($workshopSession->end_time))}}</div>
                                        @endif

                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                            @endif
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
            @endif

            <?php
            $paddingBottomSection = (count($workshops)) ? "40px" : "0px";
            ?>
            <div class="program_sub_title" style="padding-top: {{$paddingBottomSection}};">Scientific Program</div>
            <div class="all_programs">
                <?php
                foreach ($dates as $date => $sessions)
                {
                    if($date == '2023-12-13')
                    {
                        if(count($WednesdayNotWorkshop))
                        {
                            ?>
                            <div class="oneProgram">
                                <div class="oneProgramHeader">
                                    <span class="oneProgramDate">{{date('l F j', strtotime('2023-12-13'))}}</span>
                                    <div class="oneProgramExCol" id="expandProgram">
                                        <!-- <span class="expand-icon">Expand</span> -->
                                        <span class="plus-sign">+</span>
                                    </div>
                                    <div class="oneProgramExCol hide" id="collapseProgram">
                                        <!-- <span class="expand-icon">Collapse</span> -->
                                        <span class="plus-sign">-</span>
                                    </div>
                                </div>
                                <div class="oneProgramContent">
                                    <div class="allSessions">
                                        <?php
                                        foreach ($WednesdayNotWorkshop as $session)
                                        {
                                            //// get panelist ////
                                            $panelistText = "";
                                            $panelists = $session->panelists;
                                            foreach ($panelists as $panelistkey => $panelist) {
                                                $panelistText .= $panelist->name;
                                                if($panelistkey < count($panelists) - 1) $panelistText .= ", ";
                                            }
                                            //// get panelist ////

                                            ?>
                                            <div class="oneSession">
                                                <div class="oneSessionTitle">{{$session->title}}</div>
                                                @if(isset($session->moderator))
                                                <div class="oneSessionText">Moderator: {{$session->moderator->name}}</div>
                                                @endif
                                                @if($panelistText != "")
                                                <div class="oneSessionText">Panelists: {{$panelistText}}</div>
                                                @endif

                                                <?php
                                                $lectures = $session->lectures;
                                                ?>

                                                @if(count($lectures))
                                                <div class="oneSessionTiming">
                                                    <?php
                                                    foreach ($session->lectures as $lecture)
                                                    {
                                                        //// fetch speakers ////
                                                        $speakerText = "";
                                                        $speakers = $lecture->speakers;
                                                        foreach ($speakers as $speakerkey => $speaker)
                                                        {
                                                            $speakerText .= $speaker->name;
                                                            if($speakerkey < count($speakers) - 1) $speakerText .= ", ";
                                                        }
                                                        //// fetch speakers ////

                                                        ?>
                                                        <div class="oneSessionTimeRow">
                                                           <div class="oneSessionTime">{{date('H:i', strtotime($lecture->lecture_start_time))}} - {{date('H:i', strtotime($lecture->lecture_end_time))}}</div>
                                                           <div class="oneSessionDescription"><b>{{$lecture->lecture_title}}</b>@if($speakerText != "")<br /><label class="oneSessionSpeaker">{{$speakerText}}</label>@endif</div>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                                @endif


                                                @if(!isset($session->moderator) && $panelistText == "" && (count($lectures) == 0))
                                                    <div class="oneSessionText">{{date('H:i', strtotime($session->start_time))}} - {{date('H:i', strtotime($session->end_time))}}</div>
                                                @endif

                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    else
                    {
                        ?>
                        <div class="oneProgram">
                            <div class="oneProgramHeader">
                                <span class="oneProgramDate">{{date('l F j', strtotime($date))}}</span>
                                <div class="oneProgramExCol" id="expandProgram">
                                    <!-- <span class="expand-icon">Expand</span> -->
                                    <span class="plus-sign">+</span>
                                </div>
                                <div class="oneProgramExCol hide" id="collapseProgram">
                                    <!-- <span class="expand-icon">Collapse</span> -->
                                    <span class="plus-sign">-</span>
                                </div>
                            </div>
                            <div class="oneProgramContent">
                                @if(count($sessions))
                                <div class="allSessions">
                                    <?php
                                    foreach ($sessions as $session)
                                    {
                                        //// get panelist ////
                                        $panelistText = "";
                                        $panelists = $session->panelists;
                                        foreach ($panelists as $panelistkey => $panelist) {
                                            $panelistText .= $panelist->name;
                                            if($panelistkey < count($panelists) - 1) $panelistText .= ", ";
                                        }
                                        //// get panelist ////

                                        ?>
                                        <div class="oneSession">
                                            <div class="oneSessionTitle">{{$session->title}}</div>
                                            @if(isset($session->moderator))
                                            <div class="oneSessionText">Moderator: {{$session->moderator->name}}</div>
                                            @endif
                                            @if($panelistText != "")
                                            <div class="oneSessionText">Panelists: {{$panelistText}}</div>
                                            @endif

                                            <?php
                                            $lectures = $session->lectures;
                                            ?>

                                            @if(count($lectures))
                                            <div class="oneSessionTiming">
                                                <?php
                                                foreach ($session->lectures as $lecture)
                                                {
                                                    //// fetch speakers ////
                                                    $speakerText = "";
                                                    $speakers = $lecture->speakers;
                                                    foreach ($speakers as $speakerkey => $speaker)
                                                    {
                                                        $speakerText .= $speaker->name;
                                                        if($speakerkey < count($speakers) - 1) $speakerText .= ", ";
                                                    }
                                                    //// fetch speakers ////

                                                    ?>
                                                    <div class="oneSessionTimeRow">
                                                       <div class="oneSessionTime">{{date('H:i', strtotime($lecture->lecture_start_time))}} - {{date('H:i', strtotime($lecture->lecture_end_time))}}</div>
                                                       <div class="oneSessionDescription"><b>{{$lecture->lecture_title}}</b>@if($speakerText != "")<br /><label class="oneSessionSpeaker">{{$speakerText}}</label>@endif</div>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                            @endif


                                            @if(!isset($session->moderator) && $panelistText == "" && (count($lectures) == 0))
                                                <div class="oneSessionText">{{date('H:i', strtotime($session->start_time))}} - {{date('H:i', strtotime($session->end_time))}}</div>
                                            @endif

                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                                @endif
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>

            <!-- Mobile Download Button -->
            <div class="mobile-download-btn">
                <a href="{{route('downloadProgramPDF')}}" class="download_program_btn" target="_blank"><i class="fa fa-download"></i> Download Program PDF</a>
            </div>
        </div>
    </div>
@stop


@section('scripts')
    <script type="text/javascript" src="{{asset('js/program.js')}}"></script>
@stop

