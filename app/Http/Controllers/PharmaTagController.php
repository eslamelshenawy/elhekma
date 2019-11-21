<?php

namespace App\Http\Controllers;

use App\Models\categories;
use App\Models\PharmaTag;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class PharmaTagController extends Controller
{

    public function pharma_tag($id , Request $request)
    {
        ///logger($id);
        if($id==1) {
            $category_id = $request->get('q');
          //  logger('-cat'.$category_id);
            $cond[] = ['category_id' ,'=', $category_id];
            $cond[] = ['parent_id' ,'=', 0];
        }
        elseif($id==0)
        {
            $category_id = $request->get('q');
            // logger('-par'.$parent_id);
            $cond[] = ['category_id' ,'=', $category_id];
        }
        else
        {
            $parent_id = $request->get('q');
           // logger('-par'.$parent_id);
            $cond[] = ['parent_id' ,'=', $parent_id];
        }

        $sub = PharmaTag::where($cond)->get(['id', 'name_en'])->toArray();
        $sub1 = array (
            0 =>
                array (
                    'id' => 0,
                    'name_en' => '-',
                )
        );
        $mer = array_merge($sub1 , $sub);
        return $mer;
    }
}
