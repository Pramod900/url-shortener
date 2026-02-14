<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SuperAdminController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('superadmin-dashboard', compact('user'));
    }

    public function showCompanies()
    {
        $companies = Company::with('users', 'urls')->get();
        return view('companies', compact('companies'));
    }
}
