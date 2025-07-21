<?php

namespace App\Http\Controllers;

use App\BoardCountries;
use App\BoardMember;
use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use Image;
use File;

class BoardController extends Controller
{
    public function getIndex() {
        $members = BoardMember::all();
        return view('admin.board.members', compact('members'));
    }

    public function getCreate() {
        $member = new BoardMember();
        $member->display_order = 1;
        $countries = BoardCountries::all();
        return view('admin.board.member-form', [
            'member'  => $member,
            'method'    => 'post',
            'countries'=> $countries
        ]);
    }

    public function postCreate(Request $request) {
        $this->validate($request, [
            'name'   => 'required|min:1|max:191'
        ]);

        $member = new BoardMember();
        
        $member->fill($request->all());
        // $member->fill($request->except('image_file'));
        if($request->hasFile('image_file')) {
            $image = $request->file('image_file');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $logo = Image::make($image->getRealPath());
            $logo->resize(387, 446, function ($constraint) {
                $constraint->aspectRatio();
            })->save('images/board/' . $image_name);

            $member->image_file = $image_name;
        } else {
            $member->image_file = "";
        }
        $member->save();

        return redirect('admin/board/')->with('message', "Member <b>$member->name</b> has been added.");
    }

    public function getEdit($id) {
        $member = BoardMember::find($id);
        $countries = BoardCountries::all();
        
        if(!$member)
            abort(404);
        return view('admin.board.member-form', [
            'member'    => $member,
            'method'    => 'put',
            'countries'=> $countries
        ]);
    }

    public function postEdit($id, Request $request) {
        $member = BoardMember::find($id);
        if(!$member)
            abort(404);
        $this->validate($request, [
            'name'   => 'required|min:1|max:191'
        ]);
        
        $member->update($request->all());
        // $member->update($request->except('image_file'));
        
        if($request->hasFile('image_file')) {
            if ($member->image_file) {
                File::delete('images/board/' . $member->image_file);
            }
            $image = $request->file('image_file');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $logo = Image::make($image->getRealPath());
            $logo->resize(387, 446, function ($constraint) {
                $constraint->aspectRatio();
            })->save('images/board/' . $image_name);

            $member->image_file = $image_name;
            $member->save();
        }
        return redirect()->back()->with('message', "Board member <b>$member->name</b> has been updated.");

    }

    /**
     * get all the board countries as list
     */
    public function countryList()
    {
        $countries = BoardCountries::all();

        return view('admin.board.countries.list', compact('countries'));
    }

    /**
     * load the page to create a new board country
     */
    public function countryCreate()
    {
        return view('admin.board.countries.create');
    }

    /**
     * save the new board country
     */
    public function countrySave(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'display_order' => 'required|integer',
        ]);

        // $country = new BoardCountries();

        $country = BoardCountries::create($request->all());

        return redirect()->back()->with('message', "Board Countries <b>$country->name</b> has been added.");
    }

    /**
     * load the page to edit a board country
     */
    public function countryEdit($id)
    {
        $country = BoardCountries::find($id);

        if(!$country)
        {
            return redirect()->route('board.countries')->withErrors(['Countries Not Found']);
        }

        return view('admin.board.countries.edit', compact('country'));
    }

    /**
     * update the board country
     */
    public function countryUpdate(Request $request, $id)
    {
        $country = BoardCountries::find($id);

        if(!$country)
        {
            return redirect()->route('board.countries')->withErrors(['Countries Not Found']);
        }

        $request->validate([
            'name' => 'required',
            'display_order' => 'required|integer',
        ]);

        $country->update($request->all());

        return redirect()->back()->with('message', "Board Countries <b>$country->name</b> has been updated.");
    }

}
