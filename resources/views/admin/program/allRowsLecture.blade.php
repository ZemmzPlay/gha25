@if(count($lectures))
    @foreach($lectures as $lectureKey => $lecture)
        <?php
        $selected_speakers = array_pluck($lecture->speakers, 'id');
        ?>
        <div class="oneRowLecture oneRowLecture_{{$lecture->id}}" style="margin-bottom: 20px!important;border-bottom: 1px solid #e6e6e6;">
            <div class="form-group" style="margin-bottom: 10px!important;">
                <label for="lecture_title_{{$lectureKey}}" class="col-sm-1 control-label">Title</label>
                <div class="col-sm-2">
                    <input id="lecture_title_{{$lectureKey}}" type="text" class="form-control" name="lecture_title_{{$lecture->id}}" required value="{{$lecture['lecture_title']}}">
                </div>

                <label for="lecture_start_time_{{$lectureKey}}" class="col-sm-1 control-label">Start time</label>
                <div class="col-sm-2">
                    <input id="lecture_start_time_{{$lectureKey}}" type="time" class="form-control" name="lecture_start_time_{{$lecture->id}}" required value="{{substr($lecture['lecture_start_time'], 0, -3)}}">
                </div>

                <label for="lecture_end_time_{{$lectureKey}}" class="col-sm-1 control-label">End time</label>
                <div class="col-sm-2">
                    <input id="lecture_end_time_{{$lectureKey}}" type="time" class="form-control" name="lecture_end_time_{{$lecture->id}}" required value="{{substr($lecture['lecture_end_time'], 0, -3)}}">
                </div>

                <label for="speaker_{{$lectureKey}}" class="col-sm-1 control-label">Speakers</label>
                <div class="col-sm-2">
                    <select id="speaker_{{$lectureKey}}" name="speaker_id_{{$lecture->id}}[]" class="form-control multipleSelect" multiple="multiple">
                        @foreach($speakers as $speaker)
                            <option value="{{$speaker->id}}" {{(in_array($speaker->id,$selected_speakers)) ? "selected" : ""}}>{{$speaker->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="lecture_parts_{{$lectureKey}}" class="col-sm-1 control-label">Parts</label>
                <div class="col-sm-10">
                    <textarea id="lecture_parts_{{$lectureKey}}" class="form-control" style="height: 95px" name="lecture_parts_{{$lecture->id}}">{{$lecture['lecture_parts']}}</textarea>
                </div>
            </div>


            <div class="form-group">
                <div class="col-sm-12" style="
                    display: flex;
                    align-items: center;
                    justify-content: center;">
                    <input type="button" data-id="{{$lecture->id}}" data-type="edit" class="btn btn-primary editSaveDeleteLectureButton" style="margin-right: 10px;" value="Edit" />
                    <input type="button" data-id="{{$lecture->id}}" data-type="delete" class="btn btn-danger editSaveDeleteLectureButton" value="Delete" />
                </div>
            </div>
        </div>
    @endforeach
@endif


<div class="oneRowLecture">
    <div class="form-group" style="margin-bottom: 10px!important;">
        <label for="lecture_title" class="col-sm-1 control-label">Title</label>
        <div class="col-sm-2">
            <input id="lecture_title" type="text" class="form-control" name="lecture_title_add_{{$session->id}}" required />
        </div>

        <label for="lecture_start_time" class="col-sm-1 control-label">Start time</label>
        <div class="col-sm-2">
            <input id="lecture_start_time" type="time" class="form-control" name="lecture_start_time_add_{{$session->id}}" required />
        </div>

        <label for="lecture_end_time" class="col-sm-1 control-label">End time</label>
        <div class="col-sm-2">
            <input id="lecture_end_time" type="time" class="form-control" name="lecture_end_time_add_{{$session->id}}" required />
        </div>

        <label for="speaker" class="col-sm-1 control-label">Speakers</label>
        <div class="col-sm-2">
            <select id="speaker" name="speaker_id_add_{{$session->id}}[]" class="form-control multipleSelect" multiple="multiple">
                @foreach($speakers as $speaker)
                    <option value="{{$speaker->id}}">{{$speaker->name}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="lecture_parts" class="col-sm-1 control-label">Parts</label>
        <div class="col-sm-10">
            <textarea id="lecture_parts" class="form-control" style="height: 95px" name="lecture_parts_add_{{$session->id}}"></textarea>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-12" style="
            display: flex;
            align-items: center;
            justify-content: center;">
            <input type="button" data-id="{{$session->id}}" data-type="save" class="btn btn-primary editSaveDeleteLectureButton" value="Save" />
        </div>
    </div>
</div>