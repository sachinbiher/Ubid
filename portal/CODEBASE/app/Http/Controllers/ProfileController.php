<?php

namespace App\Http\Controllers;

use App\Http\Controllers\CoreController;
use Illuminate\Http\Request;
use DB;
use View;
// Models

class ProfileController extends CoreController
{
	public $loggedInUser;
    public $data;
    public $activeMenu = 'profile';
    public $activeSubmenu = '';

    public function __construct() {
        parent::__construct();

        $this->middleware(function ($request, $next) {
            // get current logged in user
            $this->loggedInUser = auth()->guard('admin')->user();

            return $next($request);
        });        
    }

    public function index()
    {
        $this->data['title'] = 'Profile Management';
        $this->data['activeMenu'] = $this->activeMenu;
        $this->data['activeSubmenu'] = $this->activeSubmenu;
        $this->data['breadcrumbs'] = (object) [
            (object) [
                'url' => false,
                'title' => 'Profile Management',
            ],
        ];

        return view('profile.index', $this->data);
    }
}
