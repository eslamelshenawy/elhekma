<?php

namespace App\Http\Controllers;

use App\Models\categories;
use Illuminate\Http\Request;
use App\Models\customFieldsItems;
use App\Models\companies;
use App\Models\outlets;

class CustomFieldController extends Controller
{

    public function depends(Request $request)
    {
        $category_id = $request->get('q');
        $custom_field_ids=categories::where('id', $category_id)->get(['custom_field_id']);
       return  customFieldsItems::whereIn('custom_field_id',$custom_field_ids)->get(['id', 'name_en']);
    }
    public function company(Request $request)
    {
    	$role_id = $request->get('q');
    	if ($role_id == 2) {
    		return companies::get(['id','name_en']);
    	}
    	
    }
    public function branch(Request $request)
    {
    	$company_id = $request->get('q');
    	return outlets::where('company_id',$company_id)->get(['id','name_en']);

    }
}
