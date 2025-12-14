<?php

namespace App\Http\Controllers;

use App\Email;
use Illuminate\Http\Request;
use App\Http\Requests\CreateEmailAddressRequest;
use App\FacultyCategory;
use App\FacultyMember;
use App\AbstractForm;
use App\Registrants;
use App\Slideshow;
use App\Session;
use App\PageContent;
use App\BoardCountries;
use App\BoardMember;
use App\CaseSubmission;
use App\CommitteeCategory;
use App\Mail\CaseSubmissionEmail;
use Settings;
use Image;
use Mail;
use Illuminate\Support\Facades\Storage;

use App\Registration;
use App\Workshop;
use App\Configuration;

use App\Company;
use App\Exhibitors;
use App\Log;
use Doctrine\Inflector\Rules\Word;

class GenericPageController extends Controller
{
    private $configuration;

    public function __construct()
    {
        $this->configuration = Configuration::first();

        if($this->configuration->enablePassword == 1 && !(\Illuminate\Support\Facades\Session::has('passwordIn')))
        {
            return view('password');
        }

        // Share config to all views
        \View::share('configuration', $this->configuration);
    }

    public function getIndex() {
        if(
            isset($this->configuration) && 
            isset($this->configuration->enablePassword) && 
            $this->configuration->enablePassword == 1
        )
        {
            if(\Illuminate\Support\Facades\Session::has('passwordIn')) {
                $slideshows = Slideshow::all();
                $workshops = $this->fetchWorkshops();
                $workshops = json_decode(json_encode($workshops), false);
                
                return view('index', compact('slideshows', 'workshops'));
            }
            
            return view('password');
        }
        else
        {
            $slideshows = Slideshow::all();
            $workshops = $this->fetchWorkshops();
            $workshops = json_decode(json_encode($workshops), false);

            return view('index', compact('slideshows', 'workshops'));
        }
    }

    public function fetchWorkshops()
    {
        $workshops = [];
        $workshopsData = Workshop::all();
        foreach ($workshopsData as $workshop)
        {
            $checkReservedPlaces = Registration::where('workshop_id', $workshop->id)
                                    ->join('payments', 'registrations.payment_id', '=', 'payments.id')
                                    ->where('payments.paid_status', 1)
                                    ->get();

            if($workshop->places > count($checkReservedPlaces))
            {
                $workshops[] = [
                    'id' => $workshop->id,
                    'title' => $workshop->title,
                    'price' => $workshop->price
                ];
            }
        }

        return $workshops;
    }

    public function passwordCheck(Request $request) {
        $request->validate([
            'password' => 'required|max:255'
        ]);

        $savedPassword = 'none';
        if(
            isset($this->configuration) && 
            isset($this->configuration->website_password) && 
            $this->configuration->website_password != ''
        )
            $savedPassword = $this->configuration->website_password;
        
        if($request['password'] == $savedPassword) session(['passwordIn' => '1']);
        return redirect('/');
    }
    

    public function createEmail(CreateEmailAddressRequest $request) {
        $email = Email::create(['email' => $request->get('email')]);
        if($email) return "Created.";
        return "Not created.";
    }

    public function pastMeetings() {
        return view('past-meetings');
    }

    public function sessions() {
        return view('sessions');
    }

    public function faculty() {
        if(!Settings::get('facutlyEnableDisable')) abort(404);

        $allMembers = FacultyMember::all();
        return view('faculty', compact('allMembers'));
    }

    public function facultyBio(Request $request) {
        if(!Settings::get('facutlyEnableDisable')) abort(404);

        $id = $request->id;

        $member = FacultyMember::find($id);

        $data = [
            "name" => $member->name ? $member->name : $member->first_name . " " . $member->last_name,
            "image" =>  url("images/faculty/" . (($member->image_file && file_exists('images/faculty/'.$member->image_file)) ? $member->image_file : "default.jpg")),
            "bio" => $member->bio ? nl2br($member->bio) : "No Bio Found!"
        ];
        return $data;
    }

    public function program() {
        $dates = Session::orderBy('session_date')->orderBy('start_time')->get()->groupBy('session_date');
        return view('program', compact('dates'));
    }

    public function downloadProgramPDF() {
        $programPDF  = 'program.pdf';
        if(Storage::exists('public/programs/'.$programPDF)) {
            return Storage::download('public/programs/'.$programPDF, 'GHA Program.pdf');
        }
        return redirect()->route('pages.program')->withErrors('Program PDF Not Found!');
    }

    public function venue() {
        return view('venue');
    }

    public function registration() {
        $registration_text = Settings::get('registration_text');
        $cme_text = Settings::get('cme_text');
        return view('registration', compact('registration_text', 'cme_text'));
    }

    public function test() {
        /**
         * Read from logs from 2025-11-18 00:00:00 till now
         * fetch request_data field and decode it to array
         */
        $logs = Log::where('created_at', '>=', '2025-11-18 00:00:00')
                ->orderBy('created_at', 'desc')
                ->get();
                
        $emails = [];
        foreach ($logs as $log) {
            $requestData = json_decode($log->request_data, true);
            if(isset($requestData['first_name']) && strlen($requestData['first_name']) < 50)
            {
                if(isset($requestData['email']) && !in_array($requestData['email'], $emails))
                {
                   echo $requestData['first_name'] . " " . $requestData['last_name'] . " " . $requestData['email'] . "<br/>";
                   $emails[] = $requestData['email'];
               }
            }

        }
    }

    public function location() {
        return view('location');
    }

    public function cme() {
        return view('cme');
    }

    public function abstract() {
        $countries = config('countries');
        return view('abstract', compact('countries'));
    }

    public function saveAbstract(Request $request) {
        // return $request->all();
        $request->validate([
            'fullName' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'authorInstitution' => 'required',
            'authorInstitution' => 'required',
            'city' => 'required',
            'countryResidence' => 'required',
            'abstractTitle' => 'required',
            'category' => 'required',
            // 'statement' => 'required',
            'purposeStatement' => 'required',
            'methods' => 'required',
            'results' => 'required',
            'conclusions' => 'required',
            'abstractFile' => 'required|max:128000',
            // 'abstractFile' => 'required|mimes:jpeg,bmp,png,svg|size:128000',
            'question1' => 'required',
            'question2' => 'required',
            'question3' => 'required',
        ],
        [
            'abstractFile.max' => 'The File must be at least 128MB'
        ]);

        $abstract = new AbstractForm();

        $abstract->full_name = $request->fullName;
        $abstract->email = $request->email;
        $abstract->phone = $request->phone;
        $abstract->phone_code = $request->phoneCode;
        $abstract->author_institution = $request->authorInstitution;
        $abstract->city = $request->city;
        $abstract->country = $request->countryResidence;
        $abstract->abstract_title = $request->abstractTitle;
        $abstract->category = $request->category;
        $abstract->purpose_statment = "";
        // $abstract->purpose_statment = $request->statement;
        $abstract->purpose_statment_text = $request->purposeStatement;
        $abstract->methods = $request->methods;
        $abstract->results = $request->results;
        $abstract->conclusion = $request->conclusions;
        if ($request->hasFile('abstractFile'))
        {
           /* $image = $request->file('abstractFile');
            $image_name = $abstract->phone . '_' . time() . '.' . $image->getClientOriginalExtension();
            $image_file = Image::make($image->getRealPath());
            $image_file->resize(1200, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->save('images/abstract/' . $image_name);*/
            // $abstract->image = $image_name;
            $file = $request->file('abstractFile');
            $file_name = $abstract->phone . '_' . time() . '.' . $file->getClientOriginalExtension();
            Storage::putFileAs('public/abstracts/', $file, $file_name);
            $abstract->file = $file_name;
        }
        // $abstract->question1 = $request->question1 == "yes" ? 1 : 0;
        $abstract->question1 = $request->question1;
        // $abstract->question2 = $request->question2 == "yes" ? 1 : 0;
        $abstract->question2 = $request->question2;
        // $abstract->question3 = $request->question3 == "yes" ? 1 : 0;
        $abstract->question3 = $request->question3;
        // $abstract->question4 = $request->question4 == "yes" ? 1 : 0;
        $abstract->question4 = $request->question4;

        $abstract->save();

        Mail::send(
                'emails.abstract',
                [
                    'abstract' => $abstract
                ],
                function ($m) use ($abstract) {
                    $m->to($abstract->email, $abstract->first_name)
                    ->subject('ABSTRACT SUBMISSION COMPLETE')
                    ->from('conferences@zawaya.me', 'GHA');

                }
            );

        return redirect()->route('pages.abstract')->with('status', 'Abstract Successfully Submitted , Please check your email for submission confirmation.');
    }

    /**
     * download Abstract Template
     */
    public function abstractTemplate()
    {
        // $path = Storage::exists('public\abstracts\GHA poster template.pptx');
        // $path = storage_path().'\app\public\abstracts\GHA poster template.pptx';
        
        if (Storage::exists('public\abstracts\GHA poster template.pptx')) {
            return Storage::download('public\abstracts\GHA poster template.pptx', 'GHA poster template.pptx');
        }
        else
        {
            return redirect()->route('pages.abstract')->withErrors('Template Not Found!');;
        }
    }

    /**
     * terms and conditions
     */
    public function termsConditions()
    {
        $pageContent = PageContent::first();

        $terms = $pageContent->terms;
        return view('termsConditions', compact('terms'));
    }



    public function paymentIncomplete()
    {
        $counter = 0;
        // $payments = Payment::where('paid_status', '<>', 1)->get();
        $registrations = Registration::where('payment_email', 0)->get();
        // return $registrations;

        foreach ($registrations as $registration)
        {
            $payment = $registration->Payment;

            if($payment && $payment->paid_status != 1)
            {
                Mail::send(
                    'emails.payment_incomplete',
                    [
                        'registration' => $registration
                    ],
                    function ($m) use ($registration) {
                        $m->to($registration->email, $registration->first_name)
                        ->subject('Payment Incomplete')
                        ->from('conferences@zawaya.me', 'GHA');

                    }
                );

                $counter++;

                $registration->payment_email = 1;
                $registration->save();
            }
        }

        return $counter;
    }

    public function about()
    {
        /*$country = ["United Arab Emirates", "Qatar", "Bahrain", "Oman", "Kuwait", "Yemen", "Saudi Arabia"];

        $boards = [
            [
                "Arif Al Nooryani" => "Arif-Al-Nooryani.jpg",
                "Abdulla Shehab" => "Abdulla-Shehab.jpg",
                "Wael Almahmeed" => "Wael-Al-Mahmeed-.jpg"
            ],
            [
                "AbdulWahid Al Mulla" => "AbdulWahid-Al-Mulla-1.jpg",
                "Hajar Al Binali" => "Hajar-Al-Binali-1.jpg",
                "Jassim Al Suwaidi" => "Jassim-Al-Suwaidi-2.jpg"
            ],
            [
                "Abdul Hai Awadi" => "Abdul-Hai-Awadi-2.jpg",
                "Fuad Abdulqader Saeed" => "Fuad-Saeed.jpg",
                "Habib Tareif" => "Habib-Tareif.jpg"
            ],
            [
                "Kadhim J Sulaiman" => "Khadim-Jaffer.jpg",
                "Hatim Al Lawati" => "Hatim-Al-Lawati-1.jpg",
                "Salim Al Maskari" => "Salim-Al-Maskari-1.jpg"
            ],
            [
                "Mohamed Aljarallah" => "Mohammed-Al-Jarallah-1.jpg",
                "Mohammad Zubaid" => "Zubaid.jpg",
                "Mousa Akbar" => "Mousa-Akbar-1.jpg"
            ],
            [
                "Ahmed Al Qudaimi" => "Ahmed-Al-Qudaimi.jpg",
                "Ahmed Motarreb" => "Ahmed-Motarreb.jpg",
                "Nasser Munibari" => "Nasser-Munibari.jpg"
            ],
            [
                "Adel Tash" => "Adel-Tash.jpg",
                "Khalid Al Najashi" => "Khalid-Al-Najashi-1.jpg",
                "Waleed AlHabeeb" => "Waleed-AlHabeeb.jpg"
            ]
        ];

        $j = 1;

        for ($i = 0; $i < count($country); $i++)
        {
            $boardCountry =  BoardCountries::create(['name' => $country[$i], "display_order" => $i + 1]);

            foreach ($boards[$i] as $name => $image)
            {
                BoardMember::create(['name' => $name, 'image_file' => $image, 'display_order' => $j, 'country_id' => $boardCountry->id]);

                $j++;
            }
        }*/

        $countries = BoardCountries::all();

        return view('about', compact('countries'));
    }

    /**
     * sponsor-registraion
     */
    public function registrants()
    {
        return view('registrants');
    }

    /**
     * sponsor-registraion
     */
    public function registrantsTemplate()
    {
        if (Storage::exists('public\registrants\Sponsor Registration.xlsx'))
        {
            return Storage::download('public\registrants\Sponsor Registration.xlsx', 'Sponsor Registration.xlsx');
        }
        else
        {
            return redirect()->route('pages.registrants')->withErrors('Template Not Found!');;
        }
    }

    /**
     * Save Registraion
     */
    public function saveRegistraion(Request $request)
    {
        // return date('YmdHis') . "-" . rand(1000000,9999999);
        $request->validate([
            'fullName' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'registrantsFile' => 'required|max:128000',
        ],
        [
            'registrantsFile.max' => 'The File must be at least 128MB'
        ]);

        $registrant = new Registrants();

        $registrant->full_name = $request->fullName;
        $registrant->email = $request->email;
        $registrant->phone = $request->phone;
        $registrant->phone_code = "+" . $request->phoneCode;

        if ($request->hasFile('registrantsFile'))
        {
           /* $image = $request->file('registrantsFile');
            $image_name = $registrant->phone . '_' . time() . '.' . $image->getClientOriginalExtension();
            $image_file = Image::make($image->getRealPath());
            $image_file->resize(1200, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->save('images/registrant/' . $image_name);*/
            // $registrant->image = $image_name;
            $file = $request->file('registrantsFile');
            $file_name = date('YmdHis') . "-" . rand(1000000,9999999) . '.' . $file->getClientOriginalExtension();
            Storage::putFileAs('public/registrants/', $file, $file_name);
            $registrant->file = $file_name;
        }

        $registrant->save();

        return redirect()->route('pages.registrants')->with('status', 'Registrants Successfully Submitted.');
    }



    public function exhibitors()
    {
        $companies = [];
        $companiesData = Company::all();
        foreach ($companiesData as $company)
        {
            $countExhibitors = Exhibitors::where('company_id', $company->id)->count();
            if($countExhibitors < $company->places)
            {
                $companies[] = [
                    'id' => $company->id,
                    'title' => $company->title
                ];
            }
        }

        return view('exhibitors', ['companies' => $companies]);
    }

    public function saveExhibitors(Request $request)
    {
        $request->validate([
            'firstName' => 'required|max:191',
            'lastName' => 'required|max:191',
            'email' => 'required|email|max:191|unique:exhibitors,email',
            'phone' => 'required',
            'phoneCode' => 'required',
            'company' => 'required|exists:companies,id',
        ]);


        $companiesData = Company::find($request->company);
        $countExhibitors = Exhibitors::where('company_id', $companiesData->id)->count();
        if($countExhibitors >= $companiesData->places)
        {
            return redirect()->back()->withErrors(['No more places'])->withInput();
        }


        $exhibitor = new Exhibitors();

        $exhibitor->first_name = $request->firstName;
        $exhibitor->last_name = $request->lastName;
        $exhibitor->email = $request->email;
        $exhibitor->phone = $request->phone;
        $exhibitor->phone_code = "+" . $request->phoneCode;
        $exhibitor->company_id = $request->company;
        $exhibitor->created_by = 'website';
        $exhibitor->save();

        return redirect()->route('pages.exhibitors')->with('status', 'Exhibitors Added Successfully');
    }

    public function caseSubmission()
    {
        $countries = config('countries');
        return view('case-submission', compact('countries'));
    }
    
    /**
     * Submit Case Submission
     */
    public function submitCaseSubmission(Request $request)
    {
        $request->validate([
            'name' => 'required|max:191',
            'email' => 'required|email|max:191',
            'phone_number' => 'required|max:20',
            'hospital_name' => 'required|max:191',
            'country' => 'required',
            'synopsis_case' => 'required|max:5000',
            'document' => 'nullable|file|max:128000|mimes:pdf,doc,docx',
        ],
        [
            'document.max' => 'The Document must be at least 128MB',
            'document.mimes' => 'The Document must be a file of type: pdf, doc, docx.'
        ]);

        $caseSubmission = CaseSubmission::create($request->except('document'));

        if ($request->hasFile('document')) {
            $file = $request->file('document');
            $file_name = time() . '-' . $caseSubmission->name . '.' . $file->getClientOriginalExtension();
            Storage::putFileAs('public/case_submissions/', $file, $file_name);
            $caseSubmission->document = $file_name;
            $caseSubmission->save();
        }

        // Send confirmation email to the user
        try {
            Mail::to($caseSubmission->email)->send(new CaseSubmissionEmail($caseSubmission));
        } catch (\Exception $e) {
            // Log the error but don't fail the submission
            \Log::error('Failed to send case submission email: ' . $e->getMessage());
        }

        return redirect()->route('pages.case-submission')->with('status', 'Case Submission Successfully Submitted.');
    }

    /**
     * Sponsors Page
     */
    public function sponsors()
    {
        return view('sponsors');
    }

    /**
     * Contact Us Page
     */
    public function contactUs()
    {
        return view('contact-us');
    }

    /**
     * Register Page
     */
    public function register()
    {
        // $workshops = $this->fetchWorkshops();
        // $workshops = json_decode(json_encode($workshops), false);

        $workshops = Workshop::all();
        
        return view('register', compact('workshops'));
    }

    /**
     * Committees Page
     */
    public function committees()
    {
        $categories = CommitteeCategory::with(['committees' => function($query) {
            $query->orderBy('display_order', 'asc');
        }])->orderBy('display_order', 'asc')->get();

        return view('committees', compact('categories'));
    }
}
