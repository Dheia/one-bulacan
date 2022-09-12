<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BusinessRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Image;

use App\Models\Business;
use App\Models\Location;
use App\Models\Baranggay;
use App\Models\Category;
use App\Models\BusinessCategory;
use App\Models\Survey;

use Mail;
use App\Mail\SendEmail;

class UpdateBusinessController extends Controller
{
     public function index($business_code, $slug) {
        
        $business = Business::where('slug', $slug)->with('featured_business')->with('business_category')->first();
        
        if($business){
            // Get Business ID
            $id             =   str_pad($business->id,5,'0',STR_PAD_LEFT);
            $year           =   $business->created_at->format('y');
            $month          =   $business->created_at->format('m');
            $business_id    =   $year.$month.$id;

            if($business_id == $business_code)
            {
                $this->data['location']         =   Location::OrderBy('name')->get();
                $this->data['categories']       =   Category::where('parent_id', '=', null)->get();
                $this->data['subcategories']    =   Category::where('parent_id', '!=', null)->get();
                $this->data['business']         =   $business;
                $this->data['tags']             =   BusinessCategory::where('business_id', $business->id)->pluck('category_id')->toArray();
                // dd($this->data['tags']);
                // return view('forms.business_info', $this->data);
                return view('v2.businesses.update_business', $this->data);
            }
            else
            {
                abort(404, 'Please go back to our <a href="'.url('').'">homepage</a>.');
            }
         }else{
             abort(404, 'Please go back to our <a href="'.url('').'">homepage</a>.');
         }
    }
    // Select Baranggays of the Selected Municipality
    public function getBaranggays()
    {
        $baranggays = Baranggay::where('location_id', request()->municipality_id)->get();
        return $baranggays;
    }

    public function updateBusiness($id, $slug, Request $request){

    	$validatedData = $request->validate([
            'name'                  =>  'required|min:5|max:255',
            'business_nature'       =>  'required|min:4|string',
            'business_description'  =>  'nullable',
            'sub_category_id'       =>  'required',
            'branch_name'           =>  'nullable',
            'category_id'           =>  'required',
            'about'                 =>  'nullable',
            
            // Business Address
            'municipality'          =>  'required|min:1', 
            'address1'              =>  'required|min:2',
            'baranggay_id'          =>  'nullable',  

            // Contact Details
            'contact_person'        =>  'required|string||max:255|min:3',
            'mobile_number'         =>  'required|digits:11',
            'telephone'             =>  'nullable|numeric',
            'email'                 =>  'required|email',
            'website'               =>  'nullable|url',
            
            // Social Media
            'facebook'              =>  'nullable|url',
            'twitter'               =>  'nullable',
            'instagram'             =>  'nullable',
            // CompanyProfile
            'business_logo'         =>  'image|mimes:jpeg,jpg,png,gif'
           
        ]);
    	$business = Business::where('id', $id)->where('slug', $slug)->first();

        if(!$business){ 
            abort('404', 'Business not Found.'); 

        }

    	$business->name             =   request('name');
        $business->branch_name      =   request('branch_name');
        $business->nature           =   request('business_nature');

        // Business Address
        $business->address1         =   request('address1');
        $business->location_id      =   request('municipality');

        if(request('baranggay_id') == null){
            $business->baranggay_id = '0';
        } else{
            $business->baranggay_id = request('baranggay_id');
        }

        // Contact Details
        $business->contact_person   =   request('contact_person');
        $business->telephone        =   request('telephone_number');
        $business->mobile           =   request('mobile_number');
        $business->email            =   request('email');
        $business->twitter          =   request('twitter');
        $business->website          =   request('website');
        $business->facebook         =   request('facebook');
        $business->instagram        =   request('instagram');

        if(request('business_logo')){
            if ($request->hasFile('business_logo')) {  
                $image              =   \Image::make($request->file('business_logo'))->encode('jpg', 90);
                $filename           =   md5($request->file('business_logo').time()).'.jpg';
                $destinationPath    =   'images/CompanyLogo';
                Storage::disk('public_folder')->put($destinationPath.'/'.$filename,  $image);
                $business->logo     =   'uploads/'.$destinationPath.'/'.$filename;
                
            }
        } else{
            $business->logo = 'images/default_image.png';
        }
        
        if($business->logo == null || $business->logo == ''){
            $business->logo = 'images/default_image.png';
        }

        $business->about            =   request('about');
        $business->purpose          =   request('purpose');
        $business->mission          =   request('mission');
        $business->vission          =   request('vission');
        $business->category_id      =   request('category_id');
        $business->goals            =   request('business_goals');
        $business->history          =   request('business_history');
        $business->description      =   request('business_description');
        $business->branches         =   request('branches');
        $business->key_process      =   request('key_process');
        $business->core_values      =   request('core_values');
        $business->ad_promotion     =   request('ad_promotion');
        $business->image_gallery    =   request('image_gallery');
        $business->product_services =   request('product_services');
        $business->product_services =   request('product_and_services');
        
        // GEO
        $business->latitude         =   request('latitude');
        $business->longitude        =   request('longitude');

		$business->update();
        BusinessCategory::where('business_id', $business->id)->delete();
        
        if(request('sub_category_id')){
	        if(count(request('sub_category_id'))){
	            foreach(request('sub_category_id') as $sub_category){
	                $business_category = new BusinessCategory();
	                $business_category->business_id = $business->id;
	                $business_category->category_id = $sub_category;
	                $business_category->save();
	            }
	        }
	    }

        return redirect()->back()->with('success', 'Successfully Updated!');
    }
}
