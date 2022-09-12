<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Business;
use App\Models\Category;
use App\Models\FeaturedBusiness;
use Illuminate\Support\Arr;

use Carbon\Carbon;

class SearchController extends Controller
{
   
    public function search(Request $request){
        $keyword    =   $request->searchkey;
        $businesses =   Business::search($keyword)
                            ->where('drafted', '!=', 1)
                            ->where('active', '=', 1)
                            ->paginate(10);
        
        $categories =   Category::where('parent_id', null)
                            ->inRandomOrder()
                            ->limit(10)
                            ->get();
        if(!$businesses->isEmpty()){
           if($businesses->currentPage() >= $businesses->lastPage()){
                $load_more = '0';
            }
            else{
                $load_more = '1';
            }
        }
        else{
            if($businesses->currentPage() >= $businesses->lastPage()){
                $load_more = '0';
            }
            else{
                $load_more = '1';
            }
        }
        if($request->ajax()){
            $view = view('v2.ajax.searches_load',compact('businesses', 'load_more'))->render();
            return response()->json(['html'=>$view]);
        }
        return view('v2.pages.searches',compact('businesses','keyword', 'load_more'))->with('categories', $categories);
    }
}