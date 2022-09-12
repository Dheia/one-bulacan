<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BusinessRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Image;
use Illuminate\Support\Str;

use App\Models\Business;
use App\Models\Location;
use App\Models\Baranggay;
use App\Models\Category;
use App\Models\BusinessCategory;
use App\Models\Survey;
use App\Models\Sale;

use App\User;

use Mail;
use App\Mail\SendEmail;

class BusinessRegistrationController extends Controller
{
    public function registration(){
        $location       =   Location::OrderBy('name')->get();
        $categories     =   Category::where('parent_id', '=', null)->get();
        $subcategories  =   Category::where('parent_id', '!=', null)->get();
        $title          =   "Register at One " . Config('settings.province') ?? "Project One";
        // $categories = Category::getTree();
        return view('v2.pages.registration')
                ->with('title', $title)
                ->with('location', $location)
                ->with('categories', $categories)
                ->with('subcategories', $subcategories);
    }
    
    public function registerBusiness(Request $request)
    {
        $validatedData  =   $request->validate([
                                'name'                  =>  'required|min:5|max:255',
                                'branch_name'           =>  'nullable',
                                'business_nature'       =>  'required|min:4|string',
                                'about'                 =>  'nullable',
                                'business_description'  =>  'nullable',
                                'category_id'           =>  'required',
                                'sub_category_id'       =>  'required',

                                // Business Address
                                'address1'              =>  'required|min:2',
                                'municipality'          =>  'required|min:1', 
                                //BARANGAY ID NOT REQUIRED BEACUSE IN SOME DEVICE SCRIPT NOT WORKING
                                'baranggay_id'          =>  'nullable',  

                                // Contact Details
                                'contact_person'        =>  'required|string||max:255|min:3',
                                'telephone'             =>  'nullable|numeric',
                                'mobile_number'         =>  'required|digits:11',
                                'email'                 =>  'required|email',
                                'website'               =>  'nullable|url',
                                
                                // Social Media
                                'facebook'              =>  'nullable|url',
                                'twitter'               =>  'nullable',
                                'instagram'             =>  'nullable',
                                // CompanyProfile
                                'business_logo'         =>  'image|mimes:jpeg,jpg,png|max:1000',
                                
                                //   SURVEY
                                'survey'                =>  'nullable',
                                'referred_by'           =>  'nullable|max:50',

                                // 'listing_type'          =>  'required|in:basic,premium',
                                'terms_and_condition'   =>  'accepted',
                               
                            ]);
        // request()->image->move(public_path('images'), $imageName);
        

        $business                   =   new Business();
        $business->name             =   request('name');
        $business->branch_name      =   request('branch_name');
        $business->nature           =   request('business_nature');

        // Business Address
        $business->address1         =   request('address1');
        $business->location_id      =   request('municipality');
        if(request('baranggay_id') == null)
        {
            $business->baranggay_id =   '0';
        }
        else
        {
            $business->baranggay_id =   request('baranggay_id');
        }
        // LatLang
        $business->latitude         =   request('latitude');
        $business->longitude        =   request('longitude');
        // Contact Details
        $business->contact_person   =   request('contact_person');
        $business->telephone        =   request('telephone_number');
        $business->mobile           =   request('mobile_number');
        $business->email            =   request('email');
        $business->website          =   request('website');
        $business->facebook         =   request('facebook');
        $business->twitter          =   request('twitter');
        $business->instagram        =   request('instagram');

        // Company Profile
        if(request('business_logo')){
            if ($request->hasFile('business_logo')) {  
                $image              =   \Image::make($request->file('business_logo'))->encode('jpg', 90);
                $image_medium       =   \Image::make($request->file('business_logo'))->resize(200, 200)->encode('jpg', 90);
                $image_small        =   \Image::make($request->file('business_logo'))->resize(100, 100)->encode('jpg', 90);

                $filename           =   md5($request->file('business_logo').time()).'.jpg';
                // $business_logo = $request->file('business_logo');
                $destinationPath   =   "businesses/" . request('name') . '/Logo'; // path relative to the disk above
                $logo_medium_path  =   "businesses/" . request('name') . '/MediumLogo'; // path relative to the disk above
                $logo_small_path   =   "businesses/" . request('name') . '/SmallLogo'; // path relative to the disk above
                // $destinationPath    =   'images/CompanyLogo';
                
                // $extension = $business_logo->getClientOriginalExtension();
                Storage::disk('public_folder')->put($destinationPath.'/'.$filename,  $image);
                Storage::disk('public_folder')->put($logo_medium_path.'/'.$filename,  $image_medium);
                Storage::disk('public_folder')->put($logo_small_path.'/'.$filename,  $image_small);

                $business->logo             =   'uploads/'.$destinationPath.'/'.$filename;
                $business->logo_medium      =   'uploads/'.$logo_medium_path.'/'.$filename;
                $business->logo_small       =   'uploads/'.$logo_small_path.'/'.$filename; 
            }
        }
        else{
            $business->logo           =   'images/default_image.png';
            $business->logo_medium    =   'images/default_image_200x200.jpg';
            $business->logo_small     =   'images/default_image_100x100.jpg';
        }
        if($business->logo == null || $business->logo == ''){
            $business->logo           =   'images/default_image.png';
            $business->logo_medium    =   'images/default_image_200x200.jpg';
            $business->logo_small     =   'images/default_image_100x100.jpg';
        }
       
      
        $business->slug             =   Str::slug(request('name').' '.(Business::max('id')+1), '-');
        $business->history          =   request('business_history');
        $business->description      =   request('business_description');
        $business->about            =   request('about');
        $business->purpose          =   request('purpose');
        $business->mission          =   request('mission');
        $business->vission          =   request('vission');
        $business->core_values      =   request('core_values');
        $business->goals            =   request('business_goals');
        $business->key_process      =   request('key_process');
        $business->product_services =   request('product_services');
        $business->image_gallery    =   request('image_gallery');
        $business->ad_promotion     =   request('ad_promotion');
        $business->product_services =   request('product_and_services');
        $business->branches         =   request('branches');
        // GEO
        $business->latitude         =   request('latitude');
        $business->longitude        =   request('longitude');
        
        $business->status           =   0;
        $business->active           =   0;
        $business->drafted          =   0;
        $business->dti              =   0;
        $business->verified         =   0;
        $business->featured         =   0;

        $business->listing_type     =   request('listing_type') ?? 'basic';

        $business->category_id      =   request('category_id');

        if(request('refcode'))
        {
            $user = User::where('code', request('refcode'))->first();
            $business->referrer_user_id  =   $user ? $user->id : null;
        }
        $business->save();

        if(count(request('sub_category_id')))
        {
            foreach(request('sub_category_id') as $sub_category)
            {
                $business_category                  =   new BusinessCategory();
                $business_category->business_id     =   Business::max('id');
                $business_category->category_id     =   $sub_category;
                $business_category->save();
            }
            
        }
        if(request('survey')){
            $survey                 =   new Survey();
            $survey->business_id    =   Business::max('id');
            $survey->medium         =   request('survey');
            $survey->referred_by    =   request('referred_by');
            $survey->save();
        }
       

        $sale               =   new Sale();
        $sale->business_id  =   Business::max('id');
        $sale->paid         =   0;
        $sale->messaged     =   0;
        $sale->emailed      =   0;
        $sale->notified     =   0;
        $sale->save();

        $paymentUrl = "#";
        if(request('listing_type') == 'basic') {
            $paymentUrl = "https://share.paybiz.ph/items/CfXHE2wAk5npWX9ZxkZzev";
        }
        if(request('listing_type') == 'premium') {
            $paymentUrl = "https://share.paybiz.ph/items/CiodyiDcf3K6Ha0QGmfy23";
        }
        // Send Email To the User
        // Send Email to the Business Email
        // Mail::to(request('email'))->send(new SendEmail($business));
        return redirect()->back()
                ->with('success', 'Successfully Registered!')
                ->with('paymentUrl', $paymentUrl)
                ->with('business_email', request('email')); 
    }

    public function getBaranggays()
    {
        $baranggays     =   Baranggay::where('location_id', request()->municipality_id)->get();
        return $baranggays;
    }

    public function getSubCategories()
    {
        $sub_categories =   Category::where('parent_id', request()->category_id)->get();
        return $sub_categories;
    }
}
