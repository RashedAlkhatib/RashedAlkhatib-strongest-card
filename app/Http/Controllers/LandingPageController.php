<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Products;
use App\Models\SlideShow;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    //
    public function getslideshow(Request $request)
    {
        $_slideShow = new SlideShow();
        if (isset($request['id'])){
            return response()->json(array('data' => $_slideShow::all()->firstWhere('id', $request['id'])));
        }else{
            return response()->json(array('data' => $_slideShow::all()));
        }

    }

    public function getcategories(Request $request)
    {

        $_categories = new Category();
        if (isset($request['id'])){
            return response()->json(array('data' => $_categories::all()->firstWhere('id', $request['id'])));
        }else{
            return response()->json(array('data' => $_categories::all()));
        }
    }

    public function getproduct(Request $request)
    {
        $_products = new Products();

        if (isset($request['id'])) {
            return response()->json(array('data' => $_products::select(array('tbl_products.*','tbl_categories.name as category_name'))
                ->leftJoin('tbl_categories', 'tbl_categories.id', '=', 'tbl_products.category_id')->firstWhere('tbl_products.id', $request['id'])));
        } else {
            return response()->json(array('data' => $_products::select(array('tbl_products.*','tbl_categories.name as category_name'))
                ->leftJoin('tbl_categories', 'tbl_categories.id', '=', 'tbl_products.category_id')->get()));
        }

    }

    public function getproducts(Request $request)
    {
        $_products = new Products();

        return response()->json(array('data' => $_products ::select('tbl_products.*,tbl_categories.name as category_name')
            ->leftJoin('tbl_categories', 'tbl_categories.id', '=', 'tbl_products.category_id')->firstWhere('category_id', $request['category_id'])));

    }
}
