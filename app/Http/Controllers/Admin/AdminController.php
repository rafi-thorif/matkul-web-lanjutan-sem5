<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use APP\Models\Users;

class AdminController extends Controller
{
    //
    public function dashboard()
    {
        $totalUsers = User::where('role', 'user')->count();
        $totalAdmins = User::where('role', 'admin')->count();
        $recentUsers = User::where('role', 'user')->latest()->take(5)->get();
    }
}
