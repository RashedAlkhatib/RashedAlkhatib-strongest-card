@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Admin Panel') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <ul class="nav nav-tabs ">
                        <li  class=" nav-item"><a data-toggle="tab" class="nav-link active" href="#home">Categories</a></li>
                        <li class="nav-item"><a data-toggle="tab" class="nav-link" href="#menu1">Products</a></li>
                        <li class="nav-item"><a data-toggle="tab" class="nav-link" href="#menu2">Slide Show</a></li>
                    </ul>
                    <div class="tab-content col-lg-12 mt-3">

                        <div id="home" class="tab-pane  active show">
                            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8" style="
    background-color: rgba(0,72,255,0.22);
    margin-top: 35px;
">
                                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                    Categories
                                </h2>
                            </div>

                            <button type="button" class="btn btn-primary category-template" data-toggle="modal" data-target="#category_modal">
                                Add Category
                            </button>

                            <div class="py-12">
                                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                        <div class="p-6 bg-white border-b border-gray-200">

                                            <table class="display nowrap" id="table_categories" width="100%">
                                                <thead style="background: floralwhite; font-weight: bold;">
                                                <tr>
                                                    <td>
                                                        Id
                                                    </td>
                                                    <td>
                                                        Name
                                                    </td>
                                                    <td>
                                                        Image
                                                    </td>
                                                    <td>
                                                        Action
                                                    </td>
                                                </tr>
                                                </thead>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div id="menu1" class="tab-pane">
                            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8" style="
    background-color: rgba(0,72,255,0.22);
    margin-top: 35px;
">
                                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                    Products
                                </h2>
                            </div>
                            <button type="button" class="btn btn-primary product-template" data-toggle="modal" data-target="#product_modal">
                                Add Product
                            </button>
                            <div class="py-12">
                                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                        <div class="p-6 bg-white border-b border-gray-200">

                                            <table class="display nowrap table_products" id="table_products" width="100%">
                                                <thead style="background: floralwhite; font-weight: bold;">
                                                <tr>
                                                    <td>
                                                        Id
                                                    </td>
                                                    <td>
                                                        Name
                                                    </td>
                                                    <td>
                                                        Price
                                                    </td>
                                                    <td>
                                                        Phone
                                                    </td>
                                                    <td>
                                                        Category
                                                    </td>
                                                    <td>
                                                        Image
                                                    </td>
                                                    <td>
                                                        Action
                                                    </td>
                                                </tr>
                                                </thead>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div id="menu2" class="tab-pane">
                            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8" style="
    background-color: rgba(0,72,255,0.22);
    margin-top: 35px;
">
                                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                   Slide Show
                                </h2>
                            </div>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#slide_show_modal">
                                Add Slide Show
                            </button>
                            <div class="py-12">
                                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                        <div class="p-6 bg-white border-b border-gray-200">

                                            <table class="display nowrap" id="table_slide_show" width="100%">
                                                <thead style="background: floralwhite; font-weight: bold;">
                                                <tr>
                                                    <td>
                                                        Id
                                                    </td>
                                                    <td>
                                                        Image
                                                    </td>
                                                    <td>
                                                        Action
                                                    </td>
                                                </tr>
                                                </thead>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal category -->
<div class="modal fade" id="category_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-group" id="form_category" >
                <input type="hidden" name="id">
            <div class="modal-body">
                <div class="form-group row col-md-12">
                    <label class="control-label col-md-12 float-left"> Name:
                        <span class="required">* </span>
                        <input type="text"
                               name="name" required
                               placeholder="Please Enter Category Name"
                               class="form-control required"/>
                    </label>


                    <label class="form-label control-label col-md-12 float-left " for="category_image">Image</label>
                    <input type="file" class="form-control" onchange="readURL(this);" name="image" id="category_image" />
                    <img  src="null" id="blah" class="img-fluid image" style="max-width: 100px; max-height: 100px;">
                    <input type="hidden" name="image_temp">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary save-category">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal products -->
<div class="modal fade" id="product_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-group" id="form_product" >
                <input type="hidden" name="id">
                <div class="modal-body">
                    <div class="form-group row col-md-12">
                        <label class="control-label col-md-12 float-left"> Name:
                            <span class="required">* </span>
                            <input type="text"
                                   name="name" required
                                   placeholder="Please Enter Category Name"
                                   class="form-control required"/>
                        </label>
                        <label class="control-label col-md-12 float-left"> Price:
                            <span class="required">* </span>
                            <input type="number"
                                   name="price" required
                                   placeholder="Please Enter Price"
                                   class="form-control required"/>
                        </label>
                        <label class="control-label col-md-12 float-left"> Phone Number:
                            <span class="required">* </span>
                            <input type="text"
                                   name="phone_number" required
                                   placeholder="Please Enter Price"
                                   class="form-control required"/>
                        </label>
                        <div class="form-group row col-md-12">
                            <label class="control-label col-md-12 float-left">Select Category:
                                <span class="required">* </span>
                                <select id="category_select"
                                        name="category_id" required
                                        class="form-control  col-md-12">
                                    <option value="0" selected>Please Select a Category</option>
                                </select>
                            </label>
                        </div>

                        <label class="form-label control-label col-md-12 float-left " for="product_image">Image</label>
                        <input type="file" class="form-control" onchange="readURL(this);" name="image" id="product_image" />
                        <img  src="null" id="blah" class="img-fluid image" style="max-width: 100px; max-height: 100px;">
                        <input type="hidden" name="image_temp">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary save-product">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal slideshow -->
<div class="modal fade" id="slide_show_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Slide Show</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-group" id="form_slide_show" >
                <input type="hidden" name="id">
            <div class="modal-body">
                <div class="modal-body" style="height: 700px;">
                    <div class="form-group row col-md-12">

                        <label class="form-label control-label col-md-12 float-left " for="slide_show_image">Image</label>
                        <input type="file" class="form-control" onchange="readURL(this);" name="image" id="slide_show_image" />
                        <img  src="null" id="blah" class="img-fluid image" style="max-width: 100px; max-height: 100px;">
                        <input type="hidden" name="image_temp">
                        <label for="inputIsiBerita"> Click on Map to set location Or Enter Manually:</label>
                        <label for="inputIsiBerita"> Latitude:</label>
                        <input type="text" class="form-control" required name="latitude">
                        <label for="inputIsiBerita"> Longitude</label>
                        <input type="text" class="form-control" required name="longitude">

                        <div id="map"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary save-slide-show">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
