<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Business;
use App\Models\FeaturedBusiness;
use App\Models\Category;
use App\Models\BusinessCategory;
use App\Models\Job;

use App\Models\Location;
use App\Models\Baranggay;
use App\Models\BusinessVisitor;


use Carbon\Carbon;
use DB;
use Illuminate\Support\Arr;


class ShowBusinessesController extends Controller
{
    public function showBusinessList($slug){

        if(request('searchkey')){
            return redirect('/search?searchkey='.request('searchkey'));
        }

        $featured_businesses_id     =   FeaturedBusiness::where('end_at', '>', Carbon::now())->where('isActive', '=', 1)->get();
        $featured_ids               =   collect($featured_businesses_id)->pluck('business_id')->toArray();

        $categories                 =   Category::getTree();
        $municipalities             =   Location::orderBy('name', 'ASC')->get();
        $featured_businesses        =   [];

        if($slug){
            if(request()->get('municipality_id')){
                $baranggays             =   Baranggay::where('location_id', request()->get('municipality_id'))
                                                ->orderBy('name', 'ASC')
                                                ->get();
                $selected_municipality  =   Location::where('id', '=', request('municipality_id'))->first();
                
                if(request()->get('baranggay_id')){
                    $selected_baranggay =   Baranggay::where('id', '=', request('baranggay_id'))->first();
                } else{
                    $selected_baranggay =   null;
                }
            }else {
                $baranggays             =   null;
                $selected_municipality  =   null;
                $selected_baranggay     =   null;
            }

            $selected_category =  Category::where('slug', '=', $slug)->first();

            if(!$selected_category){ abort(404); }
            
            // If The Category Is Child and Has Parent
            if($selected_category->parent_id)
            {
                $related_categories     =   Category::where('parent_id', '=',  $selected_category->parent_id)
                                                ->where('slug', '!=',  $slug)
                                                ->inRandomOrder()
                                                ->limit(10)
                                                ->get();
                $business_category      =   BusinessCategory::where('category_id', '=' ,$selected_category->id)->get()->pluck('business_id')->toArray();

                // If Filtered By Municipalty
                if($selected_municipality){

                    // If Filtered By Barangay
                    if($selected_baranggay){
                        $businesses             =   Business::whereIn('businesses.id', $business_category)
                                                        ->where('businesses.location_id', '=', request()->get('municipality_id'))
                                                        ->where('businesses.baranggay_id', '=', request()->get('baranggay_id'))
                                                        ->where('businesses.active', '=', '1')
                                                        ->where('businesses.drafted', '!=', '1')
                                                        ->get();
                        $featured_businesses    =   Business::whereIn('businesses.id', $business_category)
                                                        ->where('businesses.location_id', '=', request()->get('municipality_id'))
                                                        ->where('businesses.baranggay_id', '=', request()->get('baranggay_id'))
                                                        ->where('businesses.active', '=', '1')
                                                        ->where('businesses.drafted', '!=', '1')
                                                        ->where('businesses.featured', '=', '1')
                                                        ->whereIN('id',  $featured_ids)
                                                        ->inRandomOrder()
                                                        ->get();
                    }
                    // If Not Filtered By Barangay
                    else
                    {
                        $businesses             =   Business::whereIn('businesses.id', $business_category)
                                                        ->where('businesses.location_id', '=', request()->get('municipality_id'))
                                                        ->where('businesses.active', '=', '1')
                                                        ->where('businesses.drafted', '!=', '1')
                                                        ->inRandomOrder()
                                                        ->get();
                        $featured_businesses    =   Business::whereIn('businesses.id', $business_category)
                                                        ->where('businesses.location_id', '=', request()->get('municipality_id'))
                                                        ->where('businesses.active', '=', '1')
                                                        ->where('businesses.drafted', '!=', '1')
                                                        ->where('businesses.featured', '=', '1')
                                                        ->whereIN('id',  $featured_ids)
                                                        ->inRandomOrder()
                                                        ->get();
                    }
                }
                // If Not Filtered By Municipalty
                else{
                    $businesses             =   Business::whereIn('businesses.id', $business_category)
                                                    ->where('businesses.active', '=', '1')
                                                    ->where('businesses.drafted', '!=', '1')
                                                    ->inRandomOrder()
                                                    ->get();
                    $featured_businesses    =   Business::whereIn('businesses.id', $business_category)
                                                    ->where('businesses.active', '=', '1')
                                                    ->where('businesses.drafted', '!=', '1')
                                                    ->where('businesses.featured', '=', '1')
                                                    ->whereIN('id',  $featured_ids)
                                                    ->inRandomOrder()
                                                    ->get();
                }
            }
            // If The Category Is Parent
            else
            {
                $related_categories     =   Category::where('parent_id', '=',  $selected_category->id)
                                                ->where('id', '!=',  request('category_id'))
                                                ->inRandomOrder()
                                                ->limit(10)
                                                ->get();
                // If Filtered By Municipalty
                if($selected_municipality){

                    // If Filtered By Barangay
                    if($selected_baranggay){
                        $businesses             =   Business::where('businesses.category_id', '=', $selected_category->id)
                                                        ->where('businesses.active', '=', '1')
                                                        ->where('businesses.drafted', '!=', '1')
                                                        ->where('businesses.location_id', '=', request()->get('municipality_id'))
                                                        ->where('businesses.baranggay_id', '=', request()->get('baranggay_id'))
                                                        ->inRandomOrder()
                                                        ->get();
                        $featureds_businesses   =   Business::where('businesses.category_id', '=', $selected_category->id)
                                                        ->where('businesses.active', '=', '1')
                                                        ->where('businesses.drafted', '!=', '1')
                                                        ->where('businesses.location_id', '=', request()->get('municipality_id'))
                                                        ->where('businesses.baranggay_id', '=', request()->get('baranggay_id'))
                                                        ->where('businesses.featured', '=', '1')
                                                        ->whereIN('id',  $featured_ids)
                                                        ->inRandomOrder()
                                                        ->get();
                    }
                    // If Not Filtered By Barangay
                    else{
                        $businesses             =   Business::where('businesses.category_id', '=', $selected_category->id)
                                                        ->where('businesses.active', '=', '1')
                                                        ->where('businesses.drafted', '!=', '1')
                                                        ->where('businesses.location_id', '=', request()->get('municipality_id'))
                                                        ->inRandomOrder()
                                                        ->get();
                        $featured_businesses    =   Business::where('businesses.category_id', '=', $selected_category->id)
                                                        ->where('businesses.active', '=', '1')
                                                        ->where('businesses.drafted', '!=', '1')
                                                        ->where('businesses.location_id', '=', request()->get('municipality_id'))
                                                        ->where('businesses.featured', '=', '1')
                                                        ->whereIN('id',  $featured_ids)
                                                        ->inRandomOrder()
                                                        ->get();
                    }
                }
                // If Not Filtered By Municipality
                else{
                    $businesses             =   Business::where('businesses.category_id', '=', $selected_category->id)
                                                    ->where('businesses.active', '=', '1')
                                                    ->where('businesses.drafted', '!=', '1')
                                                    ->inRandomOrder()
                                                    ->get();
                    $featured_businesses    =   Business::where('businesses.category_id', '=', $selected_category->id)
                                                    ->where('businesses.active', '=', '1')
                                                    ->where('businesses.drafted', '!=', '1')
                                                    ->where('businesses.featured', '=', '1')
                                                    ->whereIN('id',  $featured_ids)
                                                    ->inRandomOrder()
                                                    ->get();
                } 
            }

            if (count($featured_businesses)>=3) {
                $featured_businesses = $featured_businesses->shuffle()->take(3);
            } 
        }
        else{
            abort(404);
        }
        
        $meta_keyword   =  Config('settings.province') . ' '.$selected_category->name.', '.$selected_category->name. ' in '. Config('settings.province') .', '. Config('settings.province') .' '.$selected_category->parent_name.', '.$selected_category->parent_name. ' in ' . Config('settings.province');

        return view('v2.pages.business_list')
                ->with('baranggays', $baranggays)
                ->with('categories', $categories)
                ->with('municipalities', $municipalities)
                ->with('selected_category', $selected_category)
                ->with('related_categories', $related_categories)
                ->with('selected_baranggay', $selected_baranggay)
                ->with('featured_businesses', $featured_businesses)
                ->with('businesses', collect($businesses)->shuffle())
                ->with('selected_municipality', $selected_municipality)
                ->with('meta_keyword', $meta_keyword);
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW SINGLE BUSINESS PAGE
    |--------------------------------------------------------------------------
    |
    */
    public function showSingleBusiness($category_slug, $slug)
    {
        if(request('searchkey'))
        {
            return redirect('/search?searchkey='.request('searchkey'));
        }

        $business   = Business::where('businesses.slug', '=', $slug)->first();
            // dd($slug);
        if(!$business){ abort(404); }

        $meta_keywords      =   BusinessCategory::where('business_categories.business_id', '=', $business->id)->get();
        $tag_categories     =   BusinessCategory::where('business_categories.business_id', '=', $business->id)->get();

        $metaword  =  Config('settings.province').' '.$business->category_name.', '.$business->category_name. ' in '. Config('settings.province') .', '.$business->category_name. ' in '.$business->location_name.' '.Config('settings.province');

        foreach($meta_keywords as $key => $meta_keyword){
            $metaword = $metaword.', ' . Config('settings.province')  .' '. $meta_keyword->category_name.', ' .$meta_keyword->category_name. ' in '.Config('settings.province').', '.$business->location_name.' '.Config('settings.province').' '.$meta_keyword->category_name.', '.$meta_keyword->category_name. ' in '.$business->location_name.' '.Config('settings.province');
        }

        // Visitors Count Get Ip
        $clientIps  =   request()->getClientIps();
        $visitorIp  =   end($clientIps);

        $isExists   =   BusinessVisitor::where('ip_address', $visitorIp)->where('business_id', $business->id)->where('deleted_at', null)->exists();
        if($isExists == true){
            $visitor = BusinessVisitor::where('ip_address', $visitorIp)->where('business_id', $business->id)->first();
            $visitor->count = $visitor->count + 1;
            $visitor->update();
        }
        else{
            $visitor = new BusinessVisitor();
            $visitor->business_id = $business->id;
            $visitor->ip_address = $visitorIp;
            $visitor->count = 1;
            $visitor->save();
        }

        // CHECK IF PREMIUM OR FREE
        $isPremium      =   FeaturedBusiness::where('business_id', $business->id)
                                ->where('end_at', '>', Carbon::now())
                                ->where('isActive', '1')
                                ->exists();
        $subscription   =   $isPremium ? 'premium' : 'free';

        return view('v2.pages.business_'.$subscription.'_show')
                    ->with('business', $business)
                    ->with('meta_keywords', $metaword)
                    ->with('tag_categories', $tag_categories);
    }

    public function getIp(){
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $ip){
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                        return $ip;
                    }
                }
            }
        }
    }

     public function getClientIps()
    {
        $ip = $this->server->get('REMOTE_ADDR');
        dd($ip);
        if (!$this->isFromTrustedProxy()) {
            return array($ip);
        }

        return $this->getTrustedValues(self::HEADER_X_FORWARDED_FOR, $ip) ?: array($ip);
    }

    function last($array)
    {
        return end($array);
    }
    
}
