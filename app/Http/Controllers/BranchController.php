<?php

namespace App\Http\Controllers;
use App\Models\outlets;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BranchController extends Controller
{
    public function depends(Request $request)
    {
        $company_id = $request->get('q');
        return outlets::where('company_id', $company_id)->orderBy('name_en', 'asc')->get(['id', 'name_en']);
    }
}
