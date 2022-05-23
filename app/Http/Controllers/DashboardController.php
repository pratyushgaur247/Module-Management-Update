<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\AdminServices;
use App\Services\Admin\DashboardServices;
class DashboardController extends Controller{
    
    protected $dashboardServices;

    public function __construct(DashboardServices $dashboardServices){
        $this->dashboardServices  = $dashboardServices;
    }
    public function adminDashboard(){
        $dashboardData = $this->dashboardServices->getAdminDashboard();
        $businessOwners = $dashboardData['businessOwners'];
        $businessOwnersActive = $dashboardData['businessOwnersActive'];
        return view('dashboard.homepage', compact('businessOwners', 'businessOwnersActive'));  
    }
    
    public function userDashboard(){
        return view('dashboard.homepage');
    }
}
