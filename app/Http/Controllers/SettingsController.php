<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Configuration;
use Settings;
use Image;
use File;

class SettingsController extends Controller
{
    public function __construct() {
        $this->middleware('admin');
    }

    public function settings()
    {
        $configuration = Configuration::first();
        return view('admin.settings', compact('configuration'));
    }

    public function updateSettings(Request $request)
    {
        $this->validate($request, [
            'payment_status' => 'required|in:test,live',
            'enablePassword' => 'sometimes|nullable|integer|in:0,1',
            'website_password' => 'sometimes|nullable|min:1|max:255',
            'website_title' => 'required|min:1|max:255',
            'logo'    => 'sometimes|nullable|image|mimes:jpeg,jpg,png,gif,svg',
            'facutlyEnableDisable' => 'sometimes|nullable|integer|in:0,1',
            'enableLiveConference' => 'sometimes|nullable|integer|in:0,1',
            'enableLiveConferenceQuestions' => 'sometimes|nullable|integer|in:0,1',
            'broadcastLink' => 'sometimes|nullable|min:1|max:255'
        ]);

        //////////// checkboxes ////////////
        $enablePassword = isset($request['enablePassword']) ? $request['enablePassword'] : 0;
        $facutlyEnableDisable = isset($request['facutlyEnableDisable']) ? $request['facutlyEnableDisable'] : 0;
        $enableLiveConference = isset($request['enableLiveConference']) ? $request['enableLiveConference'] : 0;
        $enableLiveConferenceQuestions = isset($request['enableLiveConferenceQuestions']) ? $request['enableLiveConferenceQuestions'] : 0;
        //////////// checkboxes ////////////

        Settings::set('facutlyEnableDisable', $facutlyEnableDisable);

        $configuration = Configuration::first();
        $configuration->payment_status = $request['payment_status'];
        $configuration->website_title = $request['website_title'];
        $configuration->website_password = $request['website_password'];
        $configuration->enablePassword = $enablePassword;
        $configuration->enableLiveConference = $enableLiveConference;
        $configuration->enableLiveConferenceQuestions = $enableLiveConferenceQuestions;
        $configuration->broadcastLink = $request['broadcastLink'];

        /////////////// save images ///////////////
        if($request->hasFile('logo'))
        {
            File::delete('images/' . $configuration->logo);
            $image_name = $this->saveImageSettings($request->file('logo'), 'global/logo', 341, 96);
            $configuration->logo = $image_name;
        }
        /////////////// save images ///////////////

        $configuration->save();

        return redirect()->back()->with('message', 'Settings page has been updated.');
    }

    public function saveImageSettings($image, $imageName, $width, $height)
    {
        $image_name = $imageName.'_'.time() . '.' . $image->getClientOriginalExtension();
        $imageToSave = Image::make($image->getRealPath());
        $imageToSave->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        })->save('images/' . $image_name);
        return $image_name;
    }
}
