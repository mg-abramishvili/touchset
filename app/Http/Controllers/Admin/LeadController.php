<?php

namespace App\Http\Controllers\Admin;

use App\Models\Lead;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function index()
    {
        $leads = Lead::orderBy('created_at', 'desc')->get();
        return view('admin.leads.index', compact('leads'));
    }
}
