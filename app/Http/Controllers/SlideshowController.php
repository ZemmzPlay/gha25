<?php

namespace App\Http\Controllers;

use App\Slideshow;
use Illuminate\Http\Request;
use Image;
use File;

class SlideshowController extends Controller
{
    public function getIndex() {
        $slideshows = Slideshow::all();
        return view('admin.slideshow.list', compact('slideshows'));
    }

    public function getCreate() {
        return view('admin.slideshow.add-edit-form', ['method' => "post"]);
    }

    public function postCreate(Request $request) {
        $this->validate($request, [
            'title' => 'required|min:1|max:255',
            'details' => 'sometimes|nullable|min:1|max:500',
            'location' => 'sometimes|nullable|min:1|max:500',
            'start_date' => 'sometimes|nullable|date|date_format:Y-m-d',
            'start_time' => 'sometimes|nullable|date_format:H:i',
            // 'image'    => 'required|image',
            'image'    => 'required|mimes:jpeg,jpg,bmp,png',
            // 'image_mobile'    => 'required|image',
            'image_mobile'    => 'required|mimes:jpeg,jpg,bmp,png',
            'active'    => 'required|integer|in:0,1',
            'buttonTheme' => 'required|integer|in:1,2',
        ]);

        $slideshow = new Slideshow();
        $slideshow->fill($request->all());

        /////////////// save images ///////////////
        $image = $request->file('image');
        $image_name = 'slide_'.time() . '.' . $image->getClientOriginalExtension();
        // $logo = Image::make($image->getRealPath());
        // $logo->resize(1920, 600, function ($constraint) {
        //     $constraint->aspectRatio();
        // })->save('images/slideshow/' . $image_name);
        $image->move('images/slideshow', $image_name);
        $slideshow->image = $image_name;


        $image_mobile = $request->file('image_mobile');
        $image_mobile_name = 'slide_mobile_'.time() . '.' . $image_mobile->getClientOriginalExtension();
        // $mobile_logo = Image::make($image_mobile->getRealPath());
        // $mobile_logo->resize(664, 600, function ($constraint) {
        //     $constraint->aspectRatio();
        // })->save('images/slideshow/' . $image_mobile_name);
        $image_mobile->move('images/slideshow', $image_mobile_name);
        $slideshow->image_mobile = $image_mobile_name;
        /////////////// save images ///////////////


        $slideshow->save();

        return redirect('admin/slideshow/')->with('message', "Slideshow <b>$slideshow->title</b> has been added.");
    }

    public function getEdit($id) {
        $slideshow = Slideshow::find($id);
        if(!$slideshow) abort(404);

        return view('admin.slideshow.add-edit-form', [
            'slideshow'         => $slideshow,
            'method'            => "put"
        ]);
    }

    public function postEdit($id, Request $request) {
        $slideshow = Slideshow::find($id);
        if(!$slideshow) abort(404);

        $this->validate($request, [
            'title' => 'required|min:1|max:255',
            'details' => 'sometimes|nullable|min:1|max:500',
            'location' => 'sometimes|nullable|min:1|max:500',
            'start_date' => 'sometimes|nullable|date|date_format:Y-m-d',
            'start_time' => 'sometimes|nullable|date_format:H:i',
            // 'image'    => 'sometimes|nullable|image',
            'image'    => 'sometimes|nullable|mimes:jpeg,jpg,bmp,png',
            // 'image_mobile'    => 'sometimes|nullable|image',
            'image_mobile'    => 'sometimes|nullable|mimes:jpeg,jpg,bmp,png',
            'active'    => 'required|integer|in:0,1',
            'buttonTheme' => 'required|integer|in:1,2',
        ]);

        $slideshow->update($request->all());

        /////////////// save images ///////////////
        if($request->hasFile('image'))
        {
            File::delete('images/slideshow/' . $slideshow->image);

            $image = $request->file('image');
            $image_name = 'slide_'.time() . '.' . $image->getClientOriginalExtension();
            // $logo = Image::make($image->getRealPath());
            // $logo->resize(1920, 600, function ($constraint) {
            //     $constraint->aspectRatio();
            // })->save('images/slideshow/' . $image_name);
            $image->move('images/slideshow', $image_name);
            $slideshow->image = $image_name;
            $slideshow->save();
        }

        if($request->hasFile('image_mobile'))
        {
            File::delete('images/slideshow/' . $slideshow->image_mobile);

            $image_mobile = $request->file('image_mobile');
            $image_mobile_name = 'slide_mobile_'.time() . '.' . $image_mobile->getClientOriginalExtension();
            // $mobile_logo = Image::make($image_mobile->getRealPath());
            // $mobile_logo->resize(664, 600, function ($constraint) {
            //     $constraint->aspectRatio();
            // })->save('images/slideshow/' . $image_mobile_name);
            $image_mobile->move('images/slideshow', $image_mobile_name);
            $slideshow->image_mobile = $image_mobile_name;
            $slideshow->save();
        }
        /////////////// save images ///////////////

        return redirect()->back()->with('message', "Slideshow <b>$slideshow->title</b> has been updated.");
    }

}
