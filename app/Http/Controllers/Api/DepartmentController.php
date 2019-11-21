<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Models\department;

class DepartmentController extends ApiController
{
    public $lang_id = "";

    public function get_all_departments(Request $request)
    {
		try {
			
            if (isset($request->lang_id)) {
                $lang_id = $request->lang_id;
            } else {
                $lang_id = 1;
            }	
			$departments = department::all();
			if ($departments) {
				$statusCode = 200;
				$response['status'] = 1;
				$response['message'] = 'data retrieved';				
				foreach ($departments as $department) {
					$response['data'][] = $this->getDepartmentObject($department,$lang_id);
				}
			}else{
				$statusCode = 200;
				$response['status'] = 1;
				$response['message'] = 'data retrieved';				
				$response['data'][] = [];
			}


		} catch (\Exception $e) {
			$statusCode = 200;
            $response['status'] = -1;
            $response['message'] = $e->getMessage();
			
		}finally{

			return response()->json($response, $statusCode);

		}
	}
}
