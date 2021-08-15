@extends('layouts.app')


@section('content')

<div class="row col-md-12">
    <h3><span class="badge badge-secondary ml-3">Products</span></h3>
</div>


<div class="row col-md-12">
    <?php
    foreach ($products as $value){
        echo '    <div class="col-sm-6">
        <div class="card">
            <div class="card-body">
            <img class="card-img-top" style="  max-height: 100px;" src="'.$value['image'].'">
                <h5 class="card-title">Name : '.$value['name'].'</h5>
                <p class="card-text">Price : '.$value['price'].' $</p>
                <p class="card-text">Phone Number : '.$value['phone_number'].'</p>
                <a href="https://wa.me/'.$value['phone_number'].'< " class="btn btn-primary">Open Whatsapp</a>
            </div>
        </div>
    </div>';
    }
    ?>

</div>
@endsection
