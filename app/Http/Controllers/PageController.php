<?php

namespace App\Http\Controllers;

use Backpack\PageManager\app\Models\Page;
use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Category;
use App\Models\BusinessCategory;
use App\Models\BusinessVisitor;

use App\Models\Location;
use App\Models\Baranggay;
use DB;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index($slug, $subs = null)
    {
        $page = Page::findBySlug($slug);
        if($slug == "categories") {
			return $this->categories();
        }
        if (!$page)
        {
            abort(404, 'Please go back to our <a href="'.url('').'">homepage</a>.');
        }

        $this->data['title']    =   $page->title;
        $this->data['page']     =   $page->withFakes();

        return view('pages.'.$page->template, $this->data);
    }

    public function categories()
    {
        $location           =   Config('settings.province') ?? "Project One";
        $title              =   "Categories for One " . $location;

        $this->data['title']            =   $title;

        $this->data['subcategories']    =   Category::getTree();
        $this->data['categories']       =   Category::where('parent_id', '=', null)->orderBy('name', 'ASC')->get();
        // dd($categories);
        return view('v2.pages.categories', $this->data);
    }

    public function getCategories(Request $request)
    {
        $categories     =   Category::where('name', 'LIKE', '%' . $request->search . '%')->paginate(5);

        $categories->setPath(url()->current());
        return response()->json($categories);
    }


    public function about() 
    {
        $location                       =   Config('settings.province') ?? "Project One";
        $this->data['title']            =   "About One " . $location;

        $businesses                     =   Business::where('active', '=', 1)->where('drafted', '!=', 1)->get();
        
        $this->data['businesses']       =   $businesses;
        $this->data['totalBusinesses']  =   count($businesses);
        $this->data['dtiRegistered']    =   $businesses->where('dti', 1)->count();
        $this->data['uniqueVisitors']   =   BusinessVisitor::groupBy('ip_address')->selectRaw('count(*) as total, ip_address')->get()->count();
        $this->data['totalVisits']      =   BusinessVisitor::all()->count();

        return view('v2.pages.about', $this->data);
    }

   
    
}