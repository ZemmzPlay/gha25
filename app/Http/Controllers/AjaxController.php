<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Artisan;
use Request;
use Datatables;
use DB;
use Mail;
use Settings;
use App\Registration;
use Carbon\Carbon;

class AjaxController extends Controller {

    public function postDelete() {
        if(Request::has('id') && Request::has('model')) {
            $id     = Request::get('id');
            $model  = "App\\".Request::get('model');
            $instance = $model::find($id);
            if($instance->image_file) {
                if(file_exists(public_path().'/'.$model::imagesFolder().$instance->image_file))
                    unlink(public_path().'/'.$model::imagesFolder().$instance->image_file);
            }

            if($instance->image) {
                if(file_exists(public_path().'/'.$model::imagesFolder().$instance->image))
                    unlink(public_path().'/'.$model::imagesFolder().$instance->image);
            }

            if($instance->image_mobile) {
                if(file_exists(public_path().'/'.$model::imagesFolder().$instance->image_mobile))
                    unlink(public_path().'/'.$model::imagesFolder().$instance->image_mobile);
            }
            
            $model::destroy($id);
            return response()->json(['response' => true, 'msg' => 'Object has been deleted successfully.']);
        } else {
            return response()->json(['response' => false, 'msg' => 'ID or Model is missing.', 'data' => Request::all()]);
        }
    }

    public function postDeleteFile() {
        if(Request::has('fileName')) {
            unlink(Request::get('fileName'));
            return response()->json(['response' => true, 'msg' => 'File has been deleted']);
        } else {
            return response()->json(['response' => false, 'msg' => 'No data received']);
        }
    }

    public function postSettings() {
        if(Request::has('key') && Request::has('value')) {
            Settings::set(Request::get('key'), Request::get('value'));
            if(Request::get('key') == 'maintenance_mode') {
                switch(Request::get('value')) {
                    case 1: Artisan::call('down', ['--allow' => Request::ip()]); break;
                    case 0: Artisan::call('up'); break;
                }
            }
            return response()->json(['response' => true, 'msg' => 'Settings updated.']);
        }
        return response()->json(['response' => false, 'msg' => 'No data received.']);
    }

    public function getDraw() {
        return Registration::where('attended', '1')->inRandomOrder()->get()->first();
    }

    public function postCheck() {
        $id = Request::get('id');
        $type = Request::get('type');
        $activity_id = Request::get('activity_id');;
        $registration = Registration::find(intval($id));
        if(!$registration) return 404;

        if($type == 'checkin') {
            if($registration->activities()->where('activity_id', '=', $activity_id)->get()->first())
                return 2; // User already checked in for this session
            else {
                $registration->activities()->attach($activity_id, [
                    'check_in' => Carbon::now()
                ]);
            }

        } elseif($type == 'checkout') {
            if(!$registration->activities()->where('activity_id', '=', $activity_id)->get()->first())
                return 3; // User has not checked in for this session
            else {
                $registration->activities()->updateExistingPivot($activity_id, [
                    'check_out' => Carbon::now()
                ]);
            }
        }

        return $registration;
    }


}