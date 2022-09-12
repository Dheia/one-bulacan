<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FeaturedBusiness;
use App\Models\Category;
use App\Models\Business;
use App\Models\Location;
use App\Models\Baranggay;
use App\Models\BusinessCoupon;

use Illuminate\Support\Arr;
use Carbon\Carbon;
use DB;

class HomeController extends Controller
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
    public function index(Request $request)
    {
        $featured_businesses_id     =   FeaturedBusiness::where('end_at', '>', Carbon::now())
                                            ->where('isActive', '=', 1)->get();
        $featured_ids               =   collect($featured_businesses_id)->pluck('business_id')->shuffle()->toArray();

        $featured_businesses        =   Business::where('businesses.active', '=', '1')
                                            ->where('businesses.drafted', '!=', '1')
                                            ->where('businesses.featured', '=', '1')
                                            ->whereIN('id',  $featured_ids)
                                            ->inRandomOrder()
                                            ->get();
                                            // ->paginate(3);

        $coupons                    =   BusinessCoupon::where('start_at', '<', Carbon::now())
                                            ->where('end_at', '>', Carbon::now())
                                            ->get();

        // $featured_businesses = collect($featured_businesses)->shuffle();
        $categories                 =   Category::whereRelation('businesses', 'active', '1')
                                            ->where('parent_id', '=', null)->orderBy('name', 'ASC')
                                            ->get();
        $subcategories              =   Category::getTree();

        //  if($request->ajax()){
        //     $view   =   view('v2.ajax.home_featured',compact(['featured_businesses', 'categories', 'subcategories']))->render();
        //     return response()->json(['html'=>$view, $featured_businesses, 'current_page' => $featured_businesses->currentPage(), 'lastPage' => $featured_businesses->lastPage()]);
        //  }

        // $featured_businesses = $featured_businesses->take(3);
        return view('v2.pages.home_new', compact(['featured_businesses', 'categories', 'subcategories', 'coupons']));
    }
}
