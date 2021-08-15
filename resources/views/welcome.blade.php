@extends('layouts.app')


@section('content')


<div id="demo" class="carousel slide" data-ride="carousel">

    <!-- Indicators -->
    <ul class="carousel-indicators">
        <li data-target="#demo" data-slide-to="0" class="active"></li>

    </ul>

    <!-- The slideshow -->
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="../images/1.png" alt="Los Angeles" width="100%" height="500">
            <div class="carousel-caption">
                <h3>
                    <button type="button" class="btn btn-success open-map-slider" data-toggle="modal" data-target="#open_map">
                        View Location
                    </button>
                </h3>

            </div>
        </div>
    </div>

    <!-- Left and right controls -->
    <a class="carousel-control-prev" href="#demo" data-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </a>
    <a class="carousel-control-next" href="#demo" data-slide="next">
        <span class="carousel-control-next-icon"></span>
    </a>
</div>
<br>

<div class="row col-md-12">
    <h3><span class="badge badge-secondary ml-3">Categories</span></h3>
</div>
<div class="row col-md-12 card-category">


</div>


<div class="modal fade" id="open_map" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> Google Maps</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="height: 350px;">

                <div id="map" style="    height: 272px;
    width: 94%;
    padding: 0px;
    margin-top: unset;
    position: absolute !important;"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection
