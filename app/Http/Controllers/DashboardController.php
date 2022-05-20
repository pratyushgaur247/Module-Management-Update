<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\AdminServices;
class DashboardController extends Controller{
    
    protected $adminServices;

    public function __construct(AdminServices $adminServices){
        $this->adminServices  = $adminServices;
    }
    public function adminDashboard(){
        $dashboardData = $this->adminServices->getAdminDashboard();
        $businessOwners = $dashboardData['businessOwners'];
        $businessOwnersActive = $dashboardData['businessOwnersActive'];
        return view('dashboard.homepage', compact('businessOwners', 'businessOwnersActive'));  
    }
    
    public function userDashboard(){
        return view('dashboard.homepage');
    }
}
