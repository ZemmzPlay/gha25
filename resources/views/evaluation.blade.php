@extends('master')

@section('style')
<style>
    .time {
        font-size: 12px;
        float: right;
    }
    label {
        display: block !important;
    }

    .registration {
        padding: 0px;
    }
    .evaluationForm {
        padding-bottom: 40px;
    }
    .evaluationTopTitle {
        margin-bottom: 0px;
        margin-top: 20px;
        font-family: 'WorkSansBold';
    }
    .evaluationSecondTitle {
        font-size: 20px;
    }
    .evaluationSectionATitle {
        margin-bottom: 15px;
        font-size: 25px;
        font-family: 'WorkSansBold';
    }
    .evaluationSectionAQuestionText {
        font-size: 16px;
        text-transform: none;
        font-weight: normal !important;
        color: black;
        font-family: 'WorkSansRegular';
        letter-spacing: 0;
        margin-bottom:15px;
        margin-top: 10px;
    }
    .evaluationQuestionOptions {
        margin-top:5px;
        padding: 5px;
    }
    .evaluationSectionBTitle {
        margin-bottom: 15px;
        margin-top: 25px;
        font-size: 25px;
        font-family: 'WorkSansBold';
    }
    .evaluationSectionBChecksTitle {
        font-size: 16px;
        text-transform: none;
        font-weight: normal !important;
        color: black;
        font-family: 'WorkSansRegular';
        letter-spacing: 0;
        margin-bottom:10px;
        margin-top: 0px;
    }
    .evaluationSectionBChecksOption {
        font-size: 16px;
        text-transform: none;
        font-weight: normal !important;
        color: black;
        font-family: 'WorkSansRegular';
        letter-spacing: 0;
        margin-bottom:10px;
        display:block;
    }
    .evaluationSectionBQuestionText {
        font-size: 16px;
        text-transform: none;
        font-weight: normal !important;
        color: black;
        font-family: 'WorkSansRegular';
        letter-spacing: 0;
        margin-bottom:20px;
    }
    .evaluationSubmit {
        cursor: pointer;
        outline: none;
        width: 100%;
        padding: 30px; 
        margin:0;
        background: var(--primary-color);
        border: 5px solid var(--primary-color);
        color:white;
        border-radius: 0;
        margin-top: 20px;
        font-size: 25px;
        font-family: 'WorkSansBold';
        font-weight: bold;
    }

    @media all and (max-width: 991px) {
        .evaluationTopTitle {
            font-size: 25px;
            -webkit-text-size-adjust:100%;
            margin-top: 10px;
        }
        .evaluationSecondTitle {
            font-size: 15px;
            -webkit-text-size-adjust:100%;
        }
        .evaluationSectionATitle {
            font-size: 18px;
            margin-bottom: 10px;
            -webkit-text-size-adjust:100%;
        }
        .evaluationSectionAQuestionText {
            font-size: 13px;
            -webkit-text-size-adjust:100%;
        }
        .evaluationQuestionOptions {
            margin-top: 8px;
            padding: 3px;
            font-size: 12px;
            -webkit-text-size-adjust:100%;
        }

        .evaluationSectionBTitle {
            font-size: 18px;
            margin-bottom: 10px;
            -webkit-text-size-adjust:100%;
        }
        .evaluationSectionBChecksTitle {
            font-size: 13px;
            -webkit-text-size-adjust:100%;
        }
        .evaluationSectionBChecksOption {
            display: flex!important;
            align-items: flex-start;
            font-size: 13px;
            -webkit-text-size-adjust:100%;
        }
        .evaluationSectionBChecksInput {
            margin-top: 1px!important;
            margin-right: 5px!important;
        }
        .evaluationSectionBQuestionText {
            font-size: 13px;
            -webkit-text-size-adjust:100%;
        }
        .evaluationCommentLabel {
            font-size: 13px;
            -webkit-text-size-adjust:100%;
        }
        .evaluationSubmit {
            font-size: 20px;
            padding: 20px;
        }
    }
</style>
@stop

@section('title', 'Evaluation Form'.(isset($configuration) && isset($configuration->website_title) ? ' - '.$configuration->website_title : ' - 15th GHA Meeting in Collaboration with KHF | Kuwait December 2023'))

@section('content')
    <section id="registration" class="registration">
        <div class="container">
            <div class="row">
                <!-- section title -->
                <div class="col-md-12">
                    <form class="evaluationForm" method="post" action="{{route('evaluation.post')}}">
                        <input name="_token" type="hidden" value="{{csrf_token()}}">
                        <input name="registration_id" type="hidden" value="{{$registration->id}}">

                        <h1 class="evaluationTopTitle">Evaluation Form</h1>
                        <p class="evaluationSecondTitle">Please complete all questions to print Certificate.</p>

                        <h2 class="evaluationSectionATitle">Section A - Instructor</h2>
                        @foreach($questions as $question)
                            <h5 class="evaluationSectionAQuestionText">
                                {{$question->question}}
                                <select name="answers[]" class="form-control evaluationQuestionOptions" required>

                                    <option value="5">5 excellent, outstanding performance, very appropriate</option>
                                    <option value="4">4 well done, appropriate, good</option>
                                    <option value="3">3 adequate, satisfactory, OK</option>
                                    <option value="2">2 minimally acceptable, superficially done, borderline</option>
                                    <option value="1">1 inadequate, not well done, poor</option>
                                    <option value="0">0 Not Available</option>
                                </select>
                                <input type="hidden" value="{{$question->id}}" name="questions[]">
                            </h5>
                        @endforeach

                        <h2 class="evaluationSectionBTitle">Section B - Program</h2>
                        <h5 class="evaluationSectionBChecksTitle">This program (please check all that apply)</h5>
                        @foreach($general_questions as $question)
                            <label class="evaluationSectionBChecksOption">
                                <input type="checkbox" class="evaluationSectionBChecksInput" name="general_questions[]" value="{{$question->id}}">
                                {{$question->question}}
                            </label>
                        @endforeach
                        @foreach($questions2 as $question)
                            <h5 class="evaluationSectionBQuestionText">
                                {{$question->question}}
                                <select required name="answers[]" class="form-control evaluationQuestionOptions">
                                    @if($question->id != 13)
                                    <option value="5">5 excellent, outstanding performance, very appropriate</option>
                                    <option value="4">4 well done, appropriate, good</option>
                                    <option value="3">3 adequate, satisfactory, OK</option>
                                    <option value="2">2 minimally acceptable, superficially done, borderline</option>
                                    <option value="1">1 inadequate, not well done, poor</option>
                                    <option value="0">0 Not Available</option>
                                    @else
                                        <option value="11">Yes</option>
                                        <option value="12">No</option>
                                    @endif
                                </select>
                                <input type="hidden" value="{{$question->id}}" name="questions[]">
                            </h5>
                        @endforeach

                        <label class="evaluationCommentLabel">Other comments</label>
                        <textarea class="form-control" name="comment" rows="5" style="margin-bottom: 20px;"></textarea>

                        <label class="evaluationCommentLabel">Suggestions for future activities (and whether you would recommend this program to colleagues)</label>
                        <textarea class="form-control" name="suggestion" rows="5"></textarea>

                        <input type="submit" class="evaluationSubmit" value="SUBMIT YOUR REVIEW" />
                    </form>
                </div>


            </div>


        </div>
    </section>

@stop