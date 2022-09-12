<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Carbon\Carbon;

use App\Models\Review;
use App\Models\Business;
use App\Models\Category;
use App\Models\ProductService;
use App\Models\BusinessVisitor;
use App\Models\BusinessCategory;
use App\Models\FeaturedBusiness;

class ApiController extends Controller
{
    //
    public function categories () 
    {
        return Category::active()->whereHas('businesses')->paginate(20);
    }

    public function businesses() 
    {
        $businesses =   Business::search('')
                            ->where('drafted', '!=', '1')
                            ->where('active', 1)
                            ->paginate(20);

        return response()->json($businesses);
    }

    public function business($slug) 
    {
        $business   =   Business::with('topReviews', 'topReviews.user')->where('slug', $slug)->published()->active()->first();

        if(! $business) { 
            return response()->json(['message' => 'Not found'], 400); 
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
        
        return response()->json($business);
    }

    public function businessProducts($slug) 
    {
        $business =  Business::where('slug', $slug)->published()->active()->first();

        if(! $business) { 
            return response()->json(['message' => 'Business not found.'], 400); 
        }

        $products = ProductService::where('business_id', $business->id)->paginate(20);

        return response()->json($products);
    }

    public function businessReviews($slug) 
    {
        $business =  Business::where('slug', $slug)->published()->active()->first();

        if(! $business) { 
            return response()->json(['message' => 'Business not found.'], 400); 
        }

        $reviews = Review::with('user')->where('business_id', $business->id)->paginate(20);

        return response()->json($reviews);
    }

    public function categoryBusinesses($category_slug)
    {
    	$category   =   Category::where('slug', '=', $category_slug)->active()->first();

    	if(! $category) { 
    		return response()->json(['message' => 'Not found'], 400); 
    	}

    	$businesses =   Business::search($category->name)
                            ->where('drafted', '!=', '1')
                            ->where('active', '=', '1')
                            ->paginate(20);

        return response()->json($businesses);
    }

    public function featuredBusinesses() 
    {
        $featured_businesses_id =   FeaturedBusiness::where('end_at', '>', Carbon::now())
                                        ->active()
                                        ->get();
        $featured_ids           =   collect($featured_businesses_id)->pluck('business_id')
                                        ->toArray();
        $featuredBusinesses     =   Business::search('')
                                        ->where('active', 1)
                                        ->where('drafted', '!=', '1')
                                        ->where('featured', 1)
                                        ->whereIN('id',  $featured_ids)
                                        ->paginate(20);
        return response()->json($featuredBusinesses);          
    }

    public function userProfile()
    {
        return response()->json(auth()->user());
    }

    public function search(Request $request)
    {
        $businesses =   Business::search($request->name)
                            ->where('drafted', '!=', '1')
                            ->where('active', 1)
                            ->paginate(20);

        return response()->json($businesses); 
    }

    public function storeReviewRating(Request $request)
    {
        $fields = $request->validate([
            'business_id'   => 'required|exists:App\Models\Business,id',
            'review'        => 'required_without:rating|min:3',
            'rating'        => 'required_without:review|numeric|min:1|max:5',
        ]);

        // Get Authenticated User
        $user       =   auth()->user();
        $business   =   Business::where('id', $fields['business_id'])->published()->active()->first();
        $review     =   Review::where('business_id', $fields['business_id'])
                            ->where('user_id', $user->id)
                            ->first();

        if(! $business) {
            return response([
                'message' => 'Business not found.'
            ], 422);
        }

        $reviewCreated  =   Review::updateOrCreate(
                                [
                                    'business_id'   =>  $fields['business_id'],
                                    'user_id'       =>  $user->id
                                ],
                                $fields
                            );
        // $response = [
        //     'success' => true,
        //     'message' => 'Review has been store successfully.',
        //     'data'    => $reviewCreated
        // ];
        $review   = Review::where('id', $reviewCreated->id)->with('user')->first();
        $response = $review;

        return response()->json($response, 201);
    }

    public function storeReview(Request $request)
    {
        $fields = $request->validate([
            'business_id'   => 'required|exists:App\Models\Business,id',
            'review'        => 'required|min:3',
        ]);

        // Get Authenticated User
        $user       =   auth()->user();
        $business   =   Business::where('id', $fields['business_id'])->published()->active()->first();
        $review     =   Review::where('business_id', $fields['business_id'])
                            ->where('user_id', $user->id)
                            ->first();

        if(! $business) {
            return response([
                'message' => 'Business not found.'
            ], 422);
        }

        if($review) {
            if($review->review) {
                return response([
                    'message' => 'User already has a review to this business.'
                ], 422);
            }
        }

        $reviewCreated  =   Review::updateOrCreate(
                                [
                                    'business_id'   =>  $fields['business_id'],
                                    'user_id'       =>  $user->id
                                ],
                                [
                                    'review'        =>  $fields['review']
                                ]
                            );

        $response = [
            'success' => true,
            'message' => 'Review has been store successfully.',
            'data'    => $reviewCreated
        ];

        return response()->json($response, 201);
    }

    public function storeRating(Request $request)
    {
        $fields = $request->validate([
            'business_id'   => 'required|exists:App\Models\Business,id',
            'rating'        => 'required|numeric|min:1|max:5',
        ]);

        // Get Authenticated User
        $user       =   auth()->user();
        $business   =   Business::where('id', $fields['business_id'])->published()->active()->first();
        $review     =   Review::where('business_id', $fields['business_id'])
                            ->where('user_id', $user->id)
                            ->first();

        if(! $business) {
            return response([
                'message' => 'Business not found.'
            ], 422);
        }

        if($review) {
            if($review->rating) {
                return response([
                    'message' => 'User already rate this business.'
                ], 422);
            }
        }

        $ratingCreated  =   Review::updateOrCreate(
                                [
                                    'business_id'   =>  $fields['business_id'],
                                    'user_id'       =>  $user->id
                                ],
                                [
                                    'rating'        =>  $fields['rating']
                                ]
                            );

        $response = [
            'success' => true,
            'message' => 'Rating has been store successfully.',
            'data'    => $ratingCreated
        ];

        return response()->json($response, 201);
    }
}
