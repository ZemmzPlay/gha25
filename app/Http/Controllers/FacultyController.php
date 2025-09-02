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
    public function getIndex()
    {
        $faculty = [
            ["first_name" => "Pedro", "last_name" => "Villablanca", "country" => "Chile"],
            ["first_name" => "Elizabeth", "last_name" => "Burke", "country" => "USA"],
            ["first_name" => "Federico", "last_name" => "Pappalardo", "country" => "Italy"],
            ["first_name" => "Daniel", "last_name" => "Burkhoff"],
            ["first_name" => "Mir", "last_name" => "Basir"],
            ["first_name" => "Abdul Hai", "last_name" => "Awadi", "country" => "Bahrain"],
            ["first_name" => "Fuad Abdulqader", "last_name" => "Saeed", "country" => "Bahrain"],
            ["first_name" => "Habib", "last_name" => "Tareif", "country" => "Bahrain"],
            ["first_name" => "Adel", "last_name" => "Tash", "country" => "KSA"],
            ["first_name" => "Khalid", "last_name" => "Al Najashi", "country" => "KSA", "image_file" => "1701588509.jpg"],
            ["first_name" => "Waleed", "last_name" => "AlHabeeb", "country" => "KSA"],
            ["first_name" => "Fahad", "last_name" => "Alkindi", "country" => "Oman"],
            ["first_name" => "Kadhim", "last_name" => "J Sulaiman", "country" => "Oman"],
            ["first_name" => "Salim", "last_name" => "Al Maskari", "country" => "Oman"],
            ["first_name" => "AbdulWahid", "last_name" => "Al Mulla", "country" => "Qatar"],
            ["first_name" => "Hajar", "last_name" => "Al Binali", "country" => "Qatar"],
            ["first_name" => "Jassim", "last_name" => "Al Suwaidi", "country" => "Qatar"],
            ["first_name" => "Arif", "last_name" => "Al Nooryani", "country" => "UAE"],
            ["first_name" => "Abdullah", "last_name" => "Shehab", "country" => "UAE"],
            ["first_name" => "Wael", "last_name" => "Almahmeed", "country" => "UAE", "image_file" => "1690212556.jpg"],
            ["first_name" => "Abdullah", "last_name" => "Esmaiel", "country" => "Oman"],
            ["first_name" => "Fayaz", "last_name" => "Khan"],
            ["first_name" => "Rasha", "last_name" => "Albawardi", "country" => "KSA"],
            ["first_name" => "Abdulhameid", "last_name" => "Alfaddagh", "country" => "Kuwait"],
            ["first_name" => "Abdullah", "last_name" => "Alenezi", "country" => "Kuwait", "image_file" => "1699783613.jpg"],
            ["first_name" => "Abdullah", "last_name" => "Ismaili"],
            ["first_name" => "Abdulrahman", "last_name" => "Arabi", "country" => "Qatar"],
            ["first_name" => "Abdulrahman", "last_name" => "Asiri", "country" => "KSA", "image_file" => "1701588536.jpg"],
            ["first_name" => "Ahmed", "last_name" => "Alkarrazah", "country" => "Kuwait"],
            ["first_name" => "Ahmed", "last_name" => "Alshatti", "country" => "Kuwait"],
            ["first_name" => "Alemzadeh", "last_name" => "Ansari"],
            ["first_name" => "Ali", "last_name" => "Abualsaud", "country" => "KSA"],
            ["first_name" => "Ali", "last_name" => "Alsulaimi", "country" => "Kuwait", "image_file" => "1699881308.jpg"],
            ["first_name" => "Awadh", "last_name" => "Al-Qahtani"],
            ["first_name" => "Babar", "last_name" => "Basir", "country" => "USA"],
            ["first_name" => "Bader", "last_name" => "Al-Ayyad", "country" => "Kuwait"],
            ["first_name" => "Essa", "last_name" => "Althahri", "country" => "UAE"],
            ["first_name" => "Fahad", "last_name" => "Alhajri", "country" => "Kuwait", "image_file" => "1694515424.jpg"],
            ["first_name" => "Fahad", "last_name" => "Alkindi", "country" => "Oman", "image_file" => "1699364604.jpg"],
            ["first_name" => "Fareed", "last_name" => "Alhuzali", "country" => "KSA"],
            ["first_name" => "Fawaz", "last_name" => "Almutairi", "country" => "KSA", "image_file" => "1699951798.jpg"],
            ["first_name" => "Fawaz", "last_name" => "Bardooli", "country" => "Bahrain"],
            ["first_name" => "Hatim", "last_name" => "Alalawi"],
            ["first_name" => "Huda", "last_name" => "Alfoudari", "country" => "Kuwait", "image_file" => "1699783661.jpg"],
            ["first_name" => "Hussain", "last_name" => "Alfarsi", "country" => "Oman"],
            ["first_name" => "Hussain", "last_name" => "Almutairi", "country" => "Kuwait"],
            ["first_name" => "Ibrahim", "last_name" => "Alhabib", "country" => "KSA"],
            ["first_name" => "Ibrahim", "last_name" => "Fawzi"],
            ["first_name" => "Jassim", "last_name" => "Alsuwaidi"],
            ["first_name" => "Khalid", "last_name" => "Almerri", "country" => "Kuwait"],
            ["first_name" => "Mohamed", "last_name" => "Al-Turki"],
            ["first_name" => "Mohammad", "last_name" => "Almohammadi", "country" => "KSA"],
            ["first_name" => "Mohammad", "last_name" => "Fakhrideen", "country" => "Kuwait"],
            ["first_name" => "Mohammad", "last_name" => "Shamsah", "country" => "Kuwait"],
            ["first_name" => "Mohammed", "last_name" => "Alhijji"],
            ["first_name" => "Mohammed", "last_name" => "Javad", "country" => "Iran"],
            ["first_name" => "Mubarak", "last_name" => "Aldosari", "country" => "KSA"],
            ["first_name" => "Riyadh", "last_name" => "Al-Tarrazi", "country" => "Kuwait"],
            ["first_name" => "Saeid", "last_name" => "Hossein", "country" => "Iran"],
            ["first_name" => "Waleed", "last_name" => "Alharbi", "country" => "KSA"],
            ["first_name" => "Yahya", "last_name" => "Alansari", "image_file" => "1702565182.jpg"],
        ];

        // foreach ($faculty as $fac) {
        //     $member = FacultyMember::where('first_name', $fac['first_name'])
        //         ->where('last_name', $fac['last_name'])->first();
        //     if (!$member) {
        //         $member = new FacultyMember();
        //         $member->first_name = $fac['first_name'];
        //         $member->last_name = $fac['last_name'];
        //         if (isset($fac['country']))
        //             $member->country = $fac['country'];
        //         if (isset($fac['image_file']))
        //             $member->image_file = $fac['image_file'];
        //         $member->faculty_category_id = 1;
        //         $member->display_order = 1;
        //         $member->save();
        //     }
        // }

        // $countries = ['KSA' => 'SA', 'UAE' => 'AE', 'Kuwait' => 'KW', 'Oman' => 'OM', 'Qatar' => 'QA', 'Bahrain' => 'BH', 'USA' => 'US', 'Italy' => 'IT', 'Chile' => 'CL', 'Iran' => 'IR'];

        // foreach ($countries as $key => $country) {
        //     FacultyMember::where('country', $key)->update(['country' => $country]);
        // }

        $members = FacultyMember::all()->sortBy(function($member) { 
            $firstInitial = strtolower(substr($member->first_name, 0, 1));
            $lastInitial = strtolower(substr($member->last_name, 0, 1));
            return $firstInitial . $lastInitial;
        });
        $user = Auth::guard('admin')->user();
        return view('admin.faculty.members', compact('user', 'members'));
    }

    public function getCreate()
    {
        $member = new FacultyMember();
        $member->display_order = 1;
        $user = Auth::guard('admin')->user();
        $categories = FacultyCategory::all();
        $permissions = Permission::all();
        $selected_permissions = array();
        $countries = config('countries');
        return view('admin.faculty.member-form', [
            'member'  => $member,
            'method'    => 'post',
            'user'      => $user,
            'categories' => $categories,
            'countries' => $countries,
            'permissions' => $permissions,
            'selected_permissions' => $selected_permissions,
        ]);
    }

    public function postCreate(Request $request)
    {
        $this->validate($request, [
            'first_name'   => 'required|min:1|max:255',
            'last_name'   => 'required|min:1|max:255',
        ]);

        $member = new FacultyMember();

        //$member->fill($request->all());
        $member->name = null;
        $member->fill($request->except('permission_id'));
        if ($request->hasFile('image_file')) {
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

    public function getEdit($id)
    {
        $user = Auth::guard('admin')->user();
        $member = FacultyMember::find($id);
        $categories = FacultyCategory::all();
        $permissions = Permission::all();
        $selected_permissions = array_pluck($member->permission, 'id');
        $countries = config('countries');

        if (!$member)
            abort(404);
        return view('admin.faculty.member-form', [
            'member'    => $member,
            'method'    => 'put',
            'user'      => $user,
            'countries' => $countries,
            'categories' => $categories,
            'permissions' => $permissions,
            'selected_permissions' => $selected_permissions,
        ]);
    }

    public function postEdit($id, Request $request)
    {
        $member = FacultyMember::find($id);
        if (!$member)
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

        if ($request->hasFile('image_file')) {
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

        if (!$category) {
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

        if (!$category) {
            return redirect()->route('faculty.categories')->withErrors(['Category Not Found']);
        }

        $request->validate([
            'name' => 'required',
            'display_order' => 'required|integer',
        ]);

        $category->update($request->all());

        return redirect()->back()->with('message', "Faculty Category <b>$category->name</b> has been updated.");
    }

    public function getPrint($id)
    {
        $faculty = FacultyMember::find($id);
        // $faculty->attended = 1;
        // $faculty->save();
        return view('admin.faculty.print', compact('faculty'));
    }
}
