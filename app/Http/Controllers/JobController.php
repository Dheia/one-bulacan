<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Requests\JobRequest;
use App\Models\Job;
use App\Models\JobCategory;
use App\Models\Business;
use App\Models\Location;
use App\Models\Baranggay;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use DB;
class JobController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $job_categories     =   JobCategory::where('active', 1)->get();

        if(request()->get('municipality_id'))
        {
            $baranggays             =   Baranggay::where('location_id', request()->get('municipality_id'))
                                            ->orderBy('name', 'ASC')
                                            ->get();
            $selected_municipality  =   Location::where('id', '=', request('municipality_id'))->first();

            $jobs                   =   Job::join('businesses', 'businesses.id', '=', 'jobs.business_id')
                                            ->where('jobs.end_at', '>', Carbon::now())
                                            ->where('businesses.location_id', request()->get('municipality_id'))
                                            ->where('jobs.active', '=', '1')
                                            ->select('businesses.*', 'jobs.*')
                                            ->inRandomOrder()
                                            ->get();
            
            if(request()->get('baranggay_id'))
            {
                $selected_baranggay =   Baranggay::where('id', '=', request('baranggay_id'))->first();
                $jobs               =   Job::join('businesses', 'businesses.id', '=', 'jobs.business_id')
                                            ->where('jobs.end_at', '>', Carbon::now())
                                            ->where('businesses.location_id', request()->get('municipality_id'))
                                            ->where('businesses.baranggay_id', request()->get('baranggay_id'))
                                            ->where('jobs.active', '=', '1')
                                            ->select('businesses.*', 'jobs.*')
                                            ->get();
            }
            else
            {
                $selected_baranggay =   null;
                $jobs               =   Job::join('businesses', 'businesses.id', '=', 'jobs.business_id')
                                            ->where('jobs.end_at', '>', Carbon::now())
                                            ->where('businesses.location_id', request()->get('municipality_id'))
                                            ->where('jobs.active', '=', '1')
                                            ->select('businesses.*', 'jobs.*')
                                            ->inRandomOrder()
                                            ->get();
            }
        }else
        {
            $baranggays             =   null;
            $selected_municipality  =   null;
            $selected_baranggay     =   null;
            $jobs                   =   Job::where('jobs.end_at', '>', Carbon::now())
                                            ->where('jobs.active', '=', '1')
                                            ->inRandomOrder()
                                            ->get();
        }

        $municipalities     =   Location::orderBy('name', 'ASC')->get();

        return view('pages.jobs')->with('jobs', collect($jobs)->shuffle())
                ->with('job_categories', $job_categories)
                ->with('municipalities', $municipalities)
                ->with('baranggays', $baranggays)
                ->with('selected_municipality', $selected_municipality)
                ->with('selected_baranggay', $selected_baranggay);
            
    }
    public function jobCategory($id){
        $job_categories     =   JobCategory::where('active', 1)->get();

        if(request()->get('municipality_id'))
        {
            $baranggays             =   Baranggay::where('location_id', request()->get('municipality_id'))
                                            ->orderBy('name', 'ASC')
                                            ->get();
            $selected_municipality  =   Location::where('id', '=', request('municipality_id'))->first();

            $jobs                   =   Job::join('businesses', 'businesses.id', '=', 'jobs.business_id')
                                            ->where('jobs.end_at', '>', Carbon::now())
                                            ->where('job_category_id', $id)
                                            ->where('businesses.location_id', request()->get('municipality_id'))
                                            ->where('jobs.active', '=', '1')
                                            ->select('businesses.*', 'jobs.*')
                                            ->get();
            
            if(request()->get('baranggay_id'))
            {
                $selected_baranggay =   Baranggay::where('id', '=', request('baranggay_id'))->first();
                $jobs               =   Job::join('businesses', 'businesses.id', '=', 'jobs.business_id')
                                            ->where('jobs.end_at', '>', Carbon::now())
                                            ->where('job_category_id', $id)
                                            ->where('businesses.location_id', request()->get('municipality_id'))
                                            ->where('businesses.baranggay_id', request()->get('baranggay_id'))
                                            ->where('jobs.active', '=', '1')
                                            ->select('businesses.*', 'jobs.*')
                                            ->get();
            }
            else
            {
                $selected_baranggay =   null;
                $jobs               =   Job::join('businesses', 'businesses.id', '=', 'jobs.business_id')
                                            ->where('jobs.end_at', '>', Carbon::now())
                                            ->where('job_category_id', $id)
                                            ->where('businesses.location_id', request()->get('municipality_id'))
                                            ->where('jobs.active', '=', '1')
                                            ->select('businesses.*', 'jobs.*')
                                            ->get();
            }
        }else
        {
            $baranggays             =   null;
            $selected_baranggay     =   null;
            $selected_municipality  =   null;
            $jobs                   =   Job::where('jobs.end_at', '>', Carbon::now())
                                            ->where('jobs.active', '=', '1')
                                            ->where('job_category_id', $id)
                                            ->get();
        }

        $municipalities     =   Location::orderBy('name', 'ASC')->get();

        return view('pages.jobs')->with('jobs', $jobs)
                ->with('job_categories', $job_categories)
                ->with('municipalities', $municipalities)
                ->with('baranggays', $baranggays)
                ->with('selected_municipality', $selected_municipality)
                ->with('selected_baranggay', $selected_baranggay);
    }

    public function jobInfo($business_slug, $id){
        $job_categories =   JobCategory::where('active', 1)->get();
        $job            =   Job::join('businesses', 'businesses.id', '=', 'jobs.business_id')
                                ->where('jobs.id', $id)
                                ->select('businesses.*', 'jobs.*')
                                ->first();

        $jobs           =   Job::join('businesses', 'businesses.id', '=', 'jobs.business_id')
                                ->where('job_category_id', $job->job_category_id)
                                ->where('jobs.id', '!=', $id)
                                ->select('businesses.*', 'jobs.*')
                                ->get();


        $filtered_jobs  =   array_filter(json_decode($jobs));

        if (count($filtered_jobs)>=3)
        {
            $related_jobs   =   Arr::random($filtered_jobs, 3);
        } else {
            $related_jobs   =   $filtered_jobs;
        }
        return view('pages.job_info')->with('job', $job)
                ->with('related_jobs', $related_jobs)
                ->with('job_categories', $job_categories);
    }

    public function createJob(Request $request){
        $categories     =   JobCategory::orderBy('name', 'ASC')->where('active', 1)->get();
        return view('forms.create_job')->with('categories', $categories);
    }

    public function submitJob(Request $request){

        $businesses     =   Business::where('active', 1)->get();
        $business_id    =   [];

        foreach($businesses as $business){
            $id             =   str_pad($business->id,5,'0',STR_PAD_LEFT);
            $year           =   $business->created_at->format('y');
            $month          =   $business->created_at->format('m');
            $business_id[]  =   $year.$month.$id;
        }

        $validatedData = $request->validate([
            'business_id'   =>  [
                'nullable',
                Rule::in($business_id),
            ],
            'registered'    =>  'required',
            'category_id'   =>  'required',
            'position'      =>  'required',
            'description'   =>  'nullable',
            'requirement'   =>  'nullable',
            'qualification' =>  'nullable',
            'company_name'  =>  'required_if:registered,0',
            'contact_person' => 'required_if:registered,0',
            'contact_number' => 'nullable|required_if:registered,0|digits:11',
        ]);
        
        $job = new Job();
        if(request('registered') == 1){
            $business_id        =   substr(request('business_id'), 4);
            $business_id        =   (int)$business_id;
            $job->business_id   =   $business_id;
        }
        else if(request('registered') == 0){
            $job->company_name   =  request('company_name');
            $job->contact_person =  request('contact_person');
            $job->contact_number =  request('contact_number');
        }
        
        $job->job_category_id   =   request('category_id');
        $job->position          =   request('position');
        $job->description       =   request('description');
        $job->requirement       =   request('requirement');
        $job->qualification     =   request('qualification');
        $job->quantity          =   request('quantity');
        $job->local             =   request('local');
        $job->registered        =   request('registered');
        $job->active            =   0;
        $job->save();
        return redirect()->back()->with('success', 'Successfully Created!'); 
    }
}
