<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\DirectoryRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\URL;

use Illuminate\Http\Request;

use App\Models\FeaturedBusiness;
use App\Models\Business;
use App\Models\Location;
use App\Models\Baranggay;
use App\Models\Category;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use DB;

/**
 * Class DirectoryCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class DashboardController extends CrudController
{
    public $data = [];

    public function dashboard(Request $request)
    {
        $this->data['title'] = trans('backpack::base.dashboard'); // set the page title
        $this->data['breadcrumbs'] = [
            trans('backpack::crud.admin')     => backpack_url('dashboard'),
            trans('backpack::base.dashboard') => false,
        ];

        $this->data['categories']   = Category::where('parent_id', null)->paginate(5, ['*'], 'categories');
        $this->data['businesses']   = Business::orderBy('id', 'DESC')
                                        ->where('active', '=', 1)
                                        ->where('drafted', 0)
                                        ->paginate(5, ['*'], 'businesses');

        $this->data['activeBusinesses']     = Business::getReferrerActiveBusinesses();
        $this->data['pendingBusinesses']    = Business::getReferrerPendingBusinesses();

        $this->data['premiumSubscriptions']             = FeaturedBusiness::getReferrerActiveFeatured();
        $this->data['forrenewalPremiumSubscriptions']   = FeaturedBusiness::getReferrerRenewalFeatured();
        $this->data['expiredPremiumSubscriptions']      = FeaturedBusiness::getReferrerExpiredFeatured();

        return view(backpack_view('dashboard'), $this->data);
    }
}
