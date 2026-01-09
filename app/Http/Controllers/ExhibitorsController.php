<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exhibitors;
use App\Company;

class ExhibitorsController extends Controller
{
  public function list()
  {
    return view('admin.exhibitors.list');
  }

  public function getData(Request $request)
  {
    $column = ["first_name", "email", "company"];
    $order = $request->order[0]["column"];
    $dir = $request->order[0]["dir"];

    $query = Exhibitors::where('exhibitors.id', '>', 0);
    // $query = new Exhibitors();

    if ($request->has('search') && $request->search['value'] != '') {
      $search = $request->search['value'];
      $query->where('first_name', 'like', "%" . $search . "%")->orwhere('last_name', 'like', "%" . $search . "%")->orwhere('email', 'like', "%" . $search . "%")->orwhere('phone', 'like', "%" . $search . "%")->orwhere('phone_code', 'like', "%" . $search . "%")->orwhereHas('company', function($q) use ($search)
      {
        $q->where('title', 'like', "%" . $search . "%");
      });
        // Add more conditions for other searchable columns
      $totalData = $query->count();
    }
    else
    {
      $totalData = count(Exhibitors::all());
    }

    if($column[$order] != "company")
    {
      $query = $query->orderBy($column[$order], $dir);
    }
    else
    {
      $query = $query->join('companies', 'exhibitors.company_id', '=', 'companies.id')->orderBy('companies.title', $dir);
    }

    $data = $query->offset($request->start)->limit($request->length)->get();

    $formattedData = $data->map(function ($item) {
      return [
        'id' => $item->id,
        'name' => $item->first_name . " " . $item->last_name,
        'email' => $item->email,
        'company' => $item->company->title,
      ];
    });

    // return [$totalData, $formattedData->count()];

    return [
      'draw' => intval($request->draw),
      'recordsTotal' => count($data),
      'recordsFiltered' => $totalData,
      'data' => $formattedData
    ];
  }

  public function loadCreate()
  {
    $companies = Company::all();

    return view('admin.exhibitors.create', ['companies' => $companies]);
  }

  public function create(Request $request)
  {
    $request->validate([
      'firstName' => 'required|max:191',
      'lastName' => 'required|max:191',
      // 'email' => 'sometimes|email|max:191|unique:exhibitors,email',
      'email' => 'sometimes|email|max:191',
      'phone' => 'sometimes',
      'phoneCode' => 'sometimes',
      'company' => 'required|exists:companies,id',
    ]);


    $company = Company::find($request->company);

    $countExhibitors = Exhibitors::where('company_id', $company->id)->count();

    if($countExhibitors >= $company->places)
    {
      return redirect()->back()->withErrors(['space' => 'No more places'])->withInput();
    }
    
    if($request->has('email')) {
      $request->validate([
        'email' => 'email|max:191|unique:exhibitors,email',
      ]);
    }

    $exhibitor = new Exhibitors();

    $exhibitor->first_name = $request->firstName;
    $exhibitor->last_name = $request->lastName;
    $exhibitor->email = $request->email;
    $exhibitor->phone = $request->phone;
    $exhibitor->phone_code = "+" . $request->phoneCode;
    $exhibitor->company_id = $request->company;

    $exhibitor->save();

    return redirect()->route('exhibitors')->with('message', 'Exhibitors Added Successfully');
  }

  public function companySpace(Request $request)
  {
    $company = Company::find($request->id);

    $exhibitors = Exhibitors::where('company_id', $company->id)->count();

    return $company ? $company->places - $exhibitors : 0;
  }

  public function view($id)
  {
    $exhibitor = Exhibitors::find($id);
    return view('admin.exhibitors.view', ['exhibitor' => $exhibitor]);
  }

  public function getPrint($id) {
    $exhibitor = Exhibitors::find($id);
    return view('admin.exhibitors.print', compact('exhibitor'));
  }
}
