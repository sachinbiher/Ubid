<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CoreController;
use Illuminate\Http\Request;
use DB;
use View;
// Models

class SponsoredVendorController extends CoreController
{
	public $loggedInUser;
    public $data;
    public $activeMenu = 'vendors';
    public $activeSubmenu = '';

    // public function __construct() {
    //     parent::__construct();

    //     $this->middleware(function ($request, $next) {
    //         // get current logged in user
    //         $this->loggedInUser = auth()->user();

    //         return $next($request);
    //     });        
    // }

    public function index()
    {
        $this->data['title'] = 'Sponsored Vendors Management';
        $this->data['activeMenu'] = $this->activeMenu;
        $this->data['activeSubmenu'] = $this->activeSubmenu;
        $this->data['breadcrumbs'] = (object) [
            (object) [
                'url' => false,
                'title' => 'Sponsored Vendors Management',
            ],
        ];

        return view('sponsoredvendors.index', $this->data);
    }
}
