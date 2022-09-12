<?php

namespace App\Http\Controllers\BusinessPortal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BusinessPortalController extends Controller
{
    public function index()
    {
        $businessOwner = auth()->user()->businessOwner;
        $title = "Dashboard";

        $businesses = $businessOwner->businesses;
        // dd($businessOwner->businesses);
        return view('businessPortal.dashboard',compact(['businessOwner', 'businesses', 'title']));
    }
}
