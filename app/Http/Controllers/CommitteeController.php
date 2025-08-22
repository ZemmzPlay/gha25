<?php

namespace App\Http\Controllers;

use App\Committee;
use App\CommitteeCategory;
use Illuminate\Http\Request;

class CommitteeController extends Controller
{
    public function getIndex()
    {
        $members = Committee::all();
        // $user = Auth::guard('admin')->user();
        return view('admin.committee.members', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function getCreate()
    {
        $member = new Committee();
        $categories = CommitteeCategory::all();
        $countries = config('countries');
        $member->display_order = 1;
        return view('admin.committee.member-form', [
            'member'  => $member,
            'method'    => 'post',
            'categories' => $categories,
            'countries' => $countries,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function postCreate(Request $request)
    {
        $this->validate($request, [
            'first_name'   => 'required|min:1|max:255',
            'last_name'   => 'required|min:1|max:255',
            'committee_category_id'   => 'required|exists:committee_categories,id',
            'country'   => 'required|min:1|max:255',
            'image'   => 'nullable|image|max:2048|mimes:jpeg,png,jpg,gif',
        ]);

        $member = new Committee();

        //$member->fill($request->all());
        $member->fill($request->all());
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(Committee::imagesFolderPath(), $image_name);

            $member->image = $image_name;
        }
        $member->save();

        return redirect('/admin/committee')->with('success', 'Committee member has been created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function getEdit($id)
    {
        $member = Committee::findOrFail($id);
        $categories = CommitteeCategory::all();
        $countries = config('countries');
        return view('admin.committee.member-form', [
            'member'  => $member,
            'method'    => 'put',
            'categories' => $categories,
            'countries' => $countries,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function postEdit(Request $request, $id)
    {
        $this->validate($request, [
            'first_name'   => 'required|min:1|max:255',
            'last_name'   => 'required|min:1|max:255',
            'committee_category_id'   => 'required|exists:committee_categories,id',
            'country'   => 'required|min:1|max:255',
            'image'   => 'nullable|image|max:2048|mimes:jpeg,png,jpg,gif',
        ]);

        $member = Committee::findOrFail($id);
        $member->fill($request->all());
        if ($request->hasFile('image')) {
            // Delete old image file
            if ($member->image) {
                if (file_exists(public_path() . '/' . Committee::imagesFolder() . $member->image))
                    unlink(public_path() . '/' . Committee::imagesFolder() . $member->image);

                $image = $request->file('image');
                $image_name = time() . '.' . $image->getClientOriginalExtension();
                $image->move(Committee::imagesFolderPath(), $image_name);
                $member->image = $image_name;
            }
        }

        $member->save();
        return redirect('/admin/committee')->with('success', 'Committee member has been updated successfully.');
    }

    /**
     * load the committee categories management page
     */
    public function categoryList()
    {
        $categories = CommitteeCategory::all();
        return view('admin.committee.categories.list', compact('categories'));
    }

    /**
     * load the page to create a new committee category
     */
    public function categoryCreate()
    {
        return view('admin.committee.categories.create');
    }

    /**
     * save the new committee category
     */
    public function categorySave(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'display_order' => 'required|integer',
        ]);

        // $category = new CommitteeCategory();

        $category = CommitteeCategory::create($request->all());

        return redirect()->back()->with('message', "Committee Category <b>$category->name</b> has been added.");
    }

    /**
     * load the page to edit a committee category
     */
    public function categoryEdit($id)
    {
        $category = CommitteeCategory::find($id);

        if(!$category)
        {
            return redirect()->route('committee.categories')->withErrors(['Category Not Found']);
        }

        return view('admin.committee.categories.edit', compact('category'));
    }

    /**
     * update the committee category
     */
    public function categoryUpdate(Request $request, $id)
    {
        $category = CommitteeCategory::find($id);

        if(!$category)
        {
            return redirect()->route('committee.categories')->withErrors(['Category Not Found']);
        }

        $request->validate([
            'name' => 'required',
            'display_order' => 'required|integer',
        ]);

        $category->update($request->all());

        return redirect()->back()->with('message', "Committee Category <b>$category->name</b> has been updated.");
    }
}
