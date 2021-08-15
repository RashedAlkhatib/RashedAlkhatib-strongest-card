<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Products;
use App\Models\SlideShow;
use Illuminate\Http\Request;
use Nette\Utils\Image;
use PHPUnit\Exception;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin');
    }

    public function deleteitem(Request $request)
    {
        $_categories = new Category();
        $_products = new Products();
        $_slideShow = new SlideShow();

        if ($request['type'] === 'categories') {
            $_categories::destroy($request['id']);
        } elseif ($request['type'] === 'products') {
            $_products::destroy($request['id']);
        } elseif ($request['type'] === 'slide_show') {
            $_slideShow::destroy($request['id']);
        }

        return response()->json(array('data' => 1));
    }

    public function saveslideshow(Request $request)
    {
        $_slideShow = new SlideShow();

        if ($request->file('image')) {
            $imagePath = $request->file('image');
            $imageName = $imagePath->getClientOriginalName();
            $path = $request->file('image')->storeAs('uploads', $imageName, 'public');
        }

        $_slideShow->longitude = $request->input('longitude');
        $_slideShow->latitude = $request->input('latitude');


        if ($request->input('id') !== null) {
            $_image = $request->input('image_temp');

            if ($request->hasFile('image')) {
                $_image = '/storage/' . $path;
            }

            $_slideShow::whereId($request->input('id'))->update(
                array('image' => $_image,
                    'longitude' => $request->input('longitude'),
                    'latitude' => $request->input('latitude'),
                )
            );
        } else {
            $_slideShow->save();
        }

        return response()->json(array('data' => 1));
    }

    public function savesproduct(Request $request)
    {
        $_products = new Products();
        $path = '';
        if ($request->file('image')) {
            $imagePath = $request->file('image');
            $imageName = $imagePath->getClientOriginalName();
            $path = $request->file('image')->storeAs('uploads', $imageName, 'public');
        }
        $_image = '/storage/' . $path;
        $_products->image = $_image;
        $_products->phone_number = $request->input('phone_number');
        $_products->name = $request->input('name');
        $_products->category_id = $request->input('category_id');
        $_products->price = $request->input('price');


        if ($request->input('id') !== null) {
            $_image = $request->input('image_temp');

            if ($request->hasFile('image')) {
                $_image = '/storage/' . $path;
            }

            $_products::whereId($request->input('id'))->update(
                array('image' => $_image,
                    'name' => $request->input('name'),
                    'price' => $request->input('price'),
                    'phone_number' => $request->input('phone_number'),
                    'category_id' => $request->input('category_id'),
                )
            );
        } else {
            $_products->save();
        }

        return response()->json(array('data' => 1));
    }

    public function savescategory(Request $request)
    {
        $_category = new Category();
        $path = '';
        if ($request->file('image')) {
            $imagePath = $request->file('image');
            $imageName = $imagePath->getClientOriginalName();
            $path = $request->file('image')->storeAs('uploads', $imageName, 'public');
        }
        $_image = '/storage/' . $path;
        $_category->image = $_image;
        $_category->name = $request->input('name');

        if ($request->input('id') !== null) {
            $_image = $request->input('image_temp');

            if ($request->hasFile('image')) {
                $_image = '/storage/' . $path;
            }

            $_category::whereId($request->input('id'))->update(
                array('image' => $_image,
                    'name' => $request->input('name')
                )
            );
        } else {
            $_category->save();
        }

        return response()->json(array('data' => 1));
    }
    public function gotoproduct(Request $request, $category_id)
    {
        $products = Products::all()->where( 'category_id','=',(int)$category_id)->toArray();
        return view('products')->with('products', $products);
    }

}
