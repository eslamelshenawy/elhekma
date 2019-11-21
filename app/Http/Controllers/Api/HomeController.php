<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Models\MobileSlider;
use App\Models\products;
use App\Models\governs;
use App\Models\outlets;
use App\Models\place;
use App\Models\Faq;
use App\Models\store_identity;
use App;
class HomeController extends ApiController
{

	public $lang_id = "";


	public function get_home(Request $request)
	{
		try {
            if (isset($request->lang_id)) {
                $lang_id = $request->lang_id;
            } else {
                $lang_id = 1;
            }
			$slider = MobileSlider::all();
			$featured_products = products::where('featured_pro', 1)->inRandomOrder()->limit(10)->get();
			$best_sellers = products::where('best_seller', 1)->inRandomOrder()->limit(10)->get();
			if ($slider) {
				foreach ($slider as $s) {
					$slider_response[] = $this->getMobileSliderObject($s,$lang_id);
				}
			}else{
				$slider_response= [];
			}

			if ($featured_products) {
				foreach ($featured_products as $featured_product) {
					$featured_products_response[] = $this->getHomeProductsObject($featured_product,$lang_id);
				}
			}else{
				$featured_products_response= [];
			}

			if ($best_sellers) {
				foreach ($best_sellers as $best_seller) {
					$best_seller_response[] = $this->getHomeProductsObject($best_seller,$lang_id);
				}
			}else{
				$best_seller_response= [];
			}

			$statusCode = 200;
			$response['status'] = 1;
			$response['message'] = 'data retrieved';
			$response['data'] = [
			    'slider' => $slider_response,
			    'featured_products' => $featured_products_response,
			    'best_seller' => $best_seller_response
			    ];

		} catch (\Exception $e) {
			$statusCode = 200;
            $response['status'] = -1;
            $response['message'] = $e->getMessage();

		}finally{

			return response()->json($response, $statusCode);

		}
    }

    public function getStates(Request $request)
    {
        try {
            $lang_id = $request->input('lang_id');
            $response = [];
            $statusCode = 200;
            $response['status'] = 1;
            $response['message'] = "data retrieved";
            $states = governs::where('is_active', 1)->orderBy('name_en', 'ASC')->get();
            foreach ($states as $state) {
            $response['data'][] = $this->getStateObject($state, $lang_id);
            }

        } catch (\Exception $e) {
            $statusCode = 200;
            $response['status'] = -1;
            $response['message'] = $e->getMessage();
            return response()->json($response, $statusCode);
        } finally {
            return response()->json($response, $statusCode);
        }
    }

    public function getCities(Request $request)
    {
        try {
            $lang_id = $request->input('lang_id');
            $response = [];
            $statusCode = 200;
            $response['status'] = 1;
            $response['message'] = "data retrieved";
            $cities = place::orderBy('name_en', 'ASC')->get();
            foreach ($cities as $city) {
            $response['data'][] = $this->getCityObject($city, $lang_id);
            }

        } catch (\Exception $e) {
            $statusCode = 200;
            $response['status'] = -1;
            $response['message'] = $e->getMessage();
            return response()->json($response, $statusCode);
        } finally {
            return response()->json($response, $statusCode);
        }
    }

    public function faq(Request $request)
    {
        try {
            $lang_id = $request->input('lang_id');
            $response = [];
            $statusCode = 200;
            $response['status'] = 1;
            $response['message'] = "data retrieved";
            $faqs = Faq::orderBy('id', 'ASC')->get();
            foreach ($faqs as $faq) {
            $response['data'][] = $this->getFaqObject($faq, $lang_id);
            }

        } catch (\Exception $e) {
            $statusCode = 200;
            $response['status'] = -1;
            $response['message'] = $e->getMessage();
            return response()->json($response, $statusCode);
        } finally {
            return response()->json($response, $statusCode);
        }
    }

    public function setting(Request $request)
    {
        $lang_id = $request->input('lang_id');
        if ($lang_id == 2) {
            App::setLocale("ar");
        } else {
            App::setLocale("en");
        }

        try {

            $response = [];
            $statusCode = 200;
            $response['status'] = 1;
            $response['message'] = "data retrieved";
            $response['data'] = $this->getSettingObject();

        } catch (\Exception $e) {
            $statusCode = 200;
            $response['status'] = -1;
            $response['message'] = $e->getMessage();
            logger($e->getMessage());
            return response()->json($response, $statusCode);
        } finally {
            return response()->json($response, $statusCode);
        }
    }
    public function get_stories(Request $request)
    {
        try {
            $lang_id = $request->input('lang_id');
            $response = [];
            $statusCode = 200;
            $response['status'] = 1;
            $response['message'] = "data retrieved";
            $stories = outlets::all();
            foreach ($stories as $store) {
                $store_list[] = $this->getStoreObj($store,$lang_id);
            }
            $response['data'] = $store_list;

        } catch (\Exception $e) {
            $statusCode = 200;
            $response['status'] = -1;
            $response['message'] = $e->getMessage();
            return response()->json($response, $statusCode);
        } finally {
            return response()->json($response, $statusCode);
        }        
    }
    public function get_contact_detail(Request $request)
    {
        try {
            $lang_id = $request->input('lang_id');
            $response = [];
            $statusCode = 200;
            $response['status'] = 1;
            $response['message'] = "data retrieved";
            $contact_detail = store_identity::first();
            $response['data'] = $this->get_store_contact($contact_detail);
        } catch (\Exception $e) {
            $statusCode = 200;
            $response['status'] = -1;
            $response['message'] = $e->getMessage();
            return response()->json($response, $statusCode);
        } finally {
            return response()->json($response, $statusCode);
        }        
    }    
}
