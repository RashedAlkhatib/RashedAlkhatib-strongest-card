function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah')
                .attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

$(document).ready(function () {
    $('#table_categories').dataTable(
        {
            "scrollX": true,
            "sAjaxSource": '../getcategory',
            'serverside': true,
            "sAjaxDataProp": "data",
            "columns": [
                {
                    "data": "id",
                    "orderable": true
                }, {
                    "mData": "name",
                    "orderable": true
                },
                {
                    "mData": "image",
                    "orderable": true,
                    "render": function (data, type, row) {
                        return '<img src="' + data + '" style="max-height: 100px; max-width: 100px"/>';
                    }
                },
                {
                    "mData": "id",
                    "orderable": false,
                    "render": function (data, type, row) {
                        return ' <button class="btn-sm btn-primary category-template"  data-toggle="modal" data-target="#category_modal" data-id="' + row.id + '">Edit</button>'
                            + ' <button class="btn-sm btn-danger delete-item" data-type="categories" data-id="' + row.id + '">Delete</button>';
                    }
                }
            ],
            "lengthMenu": [
                [10, 15, 20, -1],
                [10, 15, 20, "All"] // change per page values here
            ]
        });


    $('#table_slide_show').dataTable(
        {
            "scrollX": true,
            "sAjaxSource": '../getslideshow',
            'serverside': true,
            "sAjaxDataProp": "data",
            "columns": [
                {
                    "data": "id",
                    "orderable": true
                },
                {
                    "mData": "image",
                    "orderable": true,
                    "render": function (data, type, row) {
                        return '<img src="' + data + '" style="max-height: 100px; max-width: 100px"/>';
                    }
                },
                {
                    "mData": "id",
                    "orderable": false,
                    "render": function (data, type, row) {
                        //latitude	longitude
                        return ' <button class="btn-sm btn-primary slide_show-template"  data-toggle="modal" data-target="#slide_show_modal" data-id="' + row.id + '">Edit</button>'
                            + ' <button class="btn-sm btn-danger delete-item" data-type="slide_show" data-id="' + row.id + '">Delete</button>';
                    }
                }
            ],
            "lengthMenu": [
                [10, 15, 20, -1],
                [10, 15, 20, "All"] // change per page values here
            ]
        });
    $('.table_products').dataTable(
        {
            "scrollX": true,
            "sAjaxSource": '../getproduct',
            'serverside': true,
            "sAjaxDataProp": "data",
            "columns": [
                {
                    "data": "id",
                    "orderable": true
                }, {
                    "mData": "name",
                    "orderable": true
                }, {
                    "mData": "price",
                    "orderable": true
                }, {
                    "mData": "phone_number",
                    "orderable": true
                }, {
                    "mData": "category_name",
                    "orderable": true
                },
                {
                    "mData": "image",
                    "orderable": true,
                    "render": function (data, type, row) {
                        return '<img src="' + data + '" style="max-height: 100px; max-width: 100px"/>';
                    }
                },
                {
                    "mData": "id",
                    "orderable": false,
                    "render": function (data, type, row) {
                        return ' <button class="btn-sm btn-primary product-template"  data-toggle="modal" data-target="#product_modal" data-id="' + row.id + '">Edit</button>'
                            + ' <button class="btn-sm btn-danger delete-item" data-type="products" data-id="' + row.id + '">Delete</button>';
                    }
                }
            ],
            "lengthMenu": [
                [10, 15, 20, -1],
                [10, 15, 20, "All"] // change per page values here
            ]
        });
    $('body').on('click', '.delete-item', function (e) {
        e.preventDefault();
        var type = $(this).data('type');
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: '../deleteitem',
            type: 'POST',
            dataType: 'json',
            data: {
                type: $(this).data('type'),
                id: $(this).data('id'),

            },
            success: function (data) {
                alert('deleted successfully');
                $("#table_" + type).DataTable().ajax.reload(function (json) {
                });
            }
        });
    });

    $('body').on('click', '.category-template', function (e) {
        e.preventDefault();
        $('#form_category').find('input').val('').change();

        $('#form_category').find('.image').attr('src', '');
        if ($(this).data('id') != null)
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: '../getcategory',
                type: 'get',
                dataType: 'json',
                data: {
                    id: $(this).data('id')
                },
                success: function (data) {
                    $.each(data.data, function (key, value) {
                        if (key === 'image') {
                            $('#form_category').find('.image').attr('src', value);
                            $('#form_category').find('input[name=image_temp]').val(value).change();

                        } else {
                            $('#form_category').find('input[name=' + key + ']').val(value).change();

                        }

                    })
                }
            });
    });

    $('body').on('click', '.product-template', function (e) {
        e.preventDefault();
        $('#category_select')
            .empty()
            .append('<option selected="selected" value="..">Please Select Category</option>')
        ;
        $('#form_category').find('input').val('').change();
        $('#form_product').find('.image').attr('src', '');
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: '../getcategory',
            type: 'get',
            dataType: 'json',
            success: function (data) {

                $.each(data.data, function (key, value) {
                    $('select[name=category_id]').append($("<option />").val(value.id).text(value.name));
                });

            }
        });
        if ($(this).data('id') != null)
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: '../getproduct',
                type: 'get',
                dataType: 'json',
                data: {
                    id: $(this).data('id')
                },
                success: function (data) {
                    $.each(data.data, function (key, value) {
                        if (key === 'image') {
                            $('#form_product').find('.image').attr('src', value);
                            $('#form_product').find('input[name=image_temp]').val(value).change();

                        } else if (key === 'category_id') {
                            $('#form_product').find('#category_select option[value=' + value + ']').attr("selected", "selected");
                        } else
                            $('#form_product').find('input[name=' + key + ']').val(value).change();
                    })
                }
            });
    });

    $('body').on('click', '.slide_show-template', function (e) {
        e.preventDefault();
        $('#form_slide_show').find('input').val('').change();
        $('#form_slide_show').find('.image').attr('src', '');
        if ($(this).data('id') != null)
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: '../getslideshow',
                type: 'get',
                dataType: 'json',
                data: {
                    id: $(this).data('id')
                },
                success: function (data) {

                    $.each(data.data, function (key, value) {
                        if (key === 'image') {
                            $('#form_slide_show').find('.image').attr('src', value);
                            $('#form_slide_show').find('input[name=image_temp]').val(value).change();
                        } else {
                            $('#form_slide_show').find('input[name=' + key + ']').val(value).change();
                        }

                    })
                    google.maps.event.addDomListener(
                        window,
                        "load",
                        initMap(
                            parseFloat($('#form_slide_show').find('input[name=latitude]').val()),
                            parseFloat(parseFloat($('#form_slide_show').find('input[name=longitude]').val())))
                    );
                }
            });
    });

    $('body').on('click', '.save-slide-show', function (e) {
        let formData = new FormData(document.getElementById("form_slide_show"));
        e.preventDefault();
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: '../saveslideshow',
            contentType: false,
            processData: false,
            type: 'post',
            dataType: 'json',
            data: formData,
            success: function (data) {
                $('#table_slide_show').DataTable().ajax.reload(function (json) {
                });
            }
        });

    });

    $('body').on('click', '.save-product', function (e) {
        let formData = new FormData(document.getElementById("form_product"));
        e.preventDefault();
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: '../savesproduct',
            contentType: false,
            processData: false,
            type: 'post',
            dataType: 'json',
            data: formData,
            success: function (data) {
                $('#table_products').DataTable().ajax.reload(function (json) {
                });
            }
        });


    });
    $('body').on('click', '.save-category', function (e) {
        let formData = new FormData(document.getElementById("form_category"));
        e.preventDefault();
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: '../savescategory',
            contentType: false,
            processData: false,
            type: 'post',
            dataType: 'json',
            data: formData,
            success: function (data) {
                $('#table_categories').DataTable().ajax.reload(function (json) {
                });
            }
        });


    });
    $('body').on('click', '.open-map-slider', function (e) {
         e.preventDefault();
        google.maps.event.addDomListener(window, "load",
            initMap(parseFloat($(this).data('lat')), parseFloat($(this).data('lng'))));
    });


    function initMap(lat, lng) {
        map = new google.maps.Map(document.getElementById('map'), {
            center: {
                lat: lat,
                lng: lng
            },
            zoom: 13,
        });
        var clickmarker = new google.maps.Marker({
            draggable: false
        });
        new google.maps.Marker({
            position: {lat: lat, lng: lng},
            map
        });
        google.maps.event.addListener(map, 'click', function (event) {
            clickmarker.setPosition(event.latLng);
            clickmarker.setMap(map);
            clickmarker.setAnimation(google.maps.Animation.DROP);
            var lat = clickmarker.getPosition().lat();
            var lng = clickmarker.getPosition().lng();
            $("#form_slide_show").find('input[name=latitude]').val(lat).change();
            $("#form_slide_show").find('input[name=longitude]').val(lng).change();
        });
    }


    $('.modal').on('hidden.bs.modal', function (e) {
        $(this)
            .find("input,textarea,select")
            .val('')
            .end()
            .find("input[type=checkbox], input[type=radio]")
            .prop("checked", "")
            .end();
        google.maps.event.addDomListener(window, "load", initMap(0, 0));
    })
});
$.getJSON( "getslideshow", function( data ) {


    var index=0;
    $.each( data.data, function( key, val ) {
        $( '<li data-target="#demo" data-slide-to="'+(index+1)+'"></li>', {
        }).appendTo( ".carousel-indicators" );


        $( '        <div class="carousel-item">\n' +
            '            <img src="'+val.image+'" width="100%" height="500">\n' +
            '            <div class="carousel-caption">\n' +
            '                <h3>\n' +
            '                    <button data-lat="'+val.latitude+'" data-lng="'+val.longitude+'" type="button" class="btn btn-success open-map-slider" data-toggle="modal" data-target="#open_map">\n' +
            '                        View Location\n' +
            '                    </button>\n' +
            '                </h3>\n' +
            '\n' +
            '            </div>\n' +
            '        </div>', {
        }).appendTo( ".carousel-inner" );
    });


});

$.getJSON( "getcategory", function( data ) {


    $.each( data.data, function( key, val ) {

        $( '  <div class="col-sm-6">' +
            '<div class="card">\n' +
            '  <img class="card-img-top" style="  max-height: 100px;" src="'+val.image+'">\n' +
            '  <div class="card-body">\n' +
            '    <p class="card-text">Name :'+val.name+'</p>\n' +
            '    <a href="gotoproduct/' + val.id + '" class="btn btn-primary">Open</a>\n' +
            '  </div>\n' +
            '</div>' +
            '</div>', {
        }).appendTo( ".card-category" );
    });


});
