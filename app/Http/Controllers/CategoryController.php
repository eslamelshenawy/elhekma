<?php

namespace App\Http\Controllers;

use App\Models\categories;
use App\Models\PharmaTag;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function depends(Request $request)
    {
        $department_id = $request->get('q');
       // logger($department_id.'-------');
        return categories::where('department_id', $department_id)->orderBy('name_en', 'asc')->get(['id', 'name_en']);
    }
}
