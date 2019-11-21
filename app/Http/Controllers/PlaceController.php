<?php

namespace App\Http\Controllers;

use App\Models\place;
use Illuminate\Http\Request;
use App\Models\customFieldsItems;

class PlaceController extends Controller
{

    public function depends(Request $request)
    {
        $govern_id = $request->get('q');
        return place::where('govern_id', $govern_id)->get(['id', 'name_en']);
    }
}
