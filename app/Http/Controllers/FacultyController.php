<?php

namespace App\Http\Controllers;

use App\FacultyCategory;
use App\FacultyMember;
use App\Permission;
use App\MemberPermission;
use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use Image;
use File;

class FacultyController extends Controller
{
    public function getIndex() {
        $members = FacultyMember::all();
        $user = Auth::guard('admin')->user();
        return view('admin.faculty.members', compact('user', 'members'));
    }

    public function getCreate() {
        $member = new FacultyMember();
        $member->display_order = 1;
        $user = Auth::guard('admin')->user();
        $categories = FacultyCategory::all();
        $permissions = Permission::all();
        $selected_permissions = array();
        return view('admin.faculty.member-form', [
            'member'  => $member,
            'method'    => 'post',
            'user'      => $user,
            'categories'=> $categories,
            'permissions'=> $permissions,
            'selected_permissions'=> $selected_permissions,
        ]);
    }

    public function postCreate(Request $request) {
        $this->validate($request, [
            'first_name'   => 'required|min:1|max:255',
            'last_name'   => 'required|min:1|max:255',
        ]);

        $member = new FacultyMember();
        
        //$member->fill($request->all());
        $member->name = null;
        $member->fill($request->except('permission_id'));
        if($request->hasFile('image_file')) {
            $image = $request->file('image_file');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $logo = Image::make($image->getRealPath());
            $logo->resize(387, 446, function ($constraint) {
                $constraint->aspectRatio();
            })->save('images/faculty/' . $image_name);

            $member->image_file = $image_name;
        } else {
            $member->image_file = "";
        }
        $member->save();
        $permission_ids = $request->only('permission_id');
        $member->permission()->attach($permission_ids['permission_id']);

        return redirect('admin/faculty/')->with('message', "Member <b>$member->name</b> has been added.");
    }

    public function getEdit($id) {
        $user = Auth::guard('admin')->user();
        $member = FacultyMember::find($id);
        $categories = FacultyCategory::all();
        $permissions = Permission::all();
        $selected_permissions = array_pluck($member->permission, 'id');
        
        if(!$member)
            abort(404);
        return view('admin.faculty.member-form', [
            'member'    => $member,
            'method'    => 'put',
            'user'      => $user,
            'categories'=> $categories,
            'permissions'=> $permissions,
            'selected_permissions'=> $selected_permissions,
        ]);
    }

    public function postEdit($id, Request $request) {
        $member = FacultyMember::find($id);
        if(!$member)
            abort(404);
        $this->validate($request, [
            'first_name'   => 'required|min:1|max:255',
            'last_name'   => 'required|min:1|max:255',
        ]);
        
        //$member->update($request->all());
        $member->name = null;
        $member->update($request->except('permission_id'));
        $permission_ids = $request->only('permission_id');
        $member->permission()->sync($permission_ids['permission_id']);
        
        if($request->hasFile('image_file')) {
            if ($member->image_file) {
                File::delete('images/faculty/' . $member->image_file);
            }
            $image = $request->file('image_file');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $logo = Image::make($image->getRealPath());
            $logo->resize(387, 446, function ($constraint) {
                $constraint->aspectRatio();
            })->save('images/faculty/' . $image_name);

            $member->image_file = $image_name;
            $member->save();
        }
        return redirect()->back()->with('message', "Faculty member <b>$member->name</b> has been updated.");

    }

    /**
     * get all the faculty categories as list
     */
    public function categoryList()
    {
        $categories = FacultyCategory::all();

        return view('admin.faculty.categories.list', compact('categories'));
    }

    /**
     * load the page to create a new faculty category
     */
    public function categoryCreate()
    {
        return view('admin.faculty.categories.create');
    }

    /**
     * save the new faculty category
     */
    public function categorySave(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'display_order' => 'required|integer',
        ]);

        // $category = new FacultyCategory();

        $category = FacultyCategory::create($request->all());

        return redirect()->back()->with('message', "Faculty Category <b>$category->name</b> has been added.");
    }

    /**
     * load the page to edit a faculty category
     */
    public function categoryEdit($id)
    {
        $category = FacultyCategory::find($id);

        if(!$category)
        {
            return redirect()->route('faculty.categories')->withErrors(['Category Not Found']);
        }

        return view('admin.faculty.categories.edit', compact('category'));
    }

    /**
     * update the faculty category
     */
    public function categoryUpdate(Request $request, $id)
    {
        $category = FacultyCategory::find($id);

        if(!$category)
        {
            return redirect()->route('faculty.categories')->withErrors(['Category Not Found']);
        }

        $request->validate([
            'name' => 'required',
            'display_order' => 'required|integer',
        ]);

        $category->update($request->all());

        return redirect()->back()->with('message', "Faculty Category <b>$category->name</b> has been updated.");
    }

    public function getPrint($id) {
        $faculty = FacultyMember::find($id);
        // $faculty->attended = 1;
        // $faculty->save();
        return view('admin.faculty.print', compact('faculty'));
    }

}
