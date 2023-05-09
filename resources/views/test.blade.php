<!DOCTYPE html>
<html>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
        /*the container must be positioned relative:*/
        .custom-select {
            position: relative;
            font-family: Arial;
            width: 200px;
            height: 50px;
        }

        .custom-select select {
            display: flex;
            /*hide original SELECT element:*/
        }

        .select-selected {
            background-color: DodgerBlue;
        }

        /*style the arrow inside the select element:*/
        .select-selected:after {
            position: absolute;
            content: "";
            top: 14px;
            right: 10px;
            width: 0;
            height: 0;
            border: 6px solid transparent;
            border-color: #fff transparent transparent transparent;
        }

        /*point the arrow upwards when the select box is open (active):*/
        .select-selected.select-arrow-active:after {
            border-color: transparent transparent #fff transparent;
            top: 7px;
        }

        /*style the items (options), including the selected item:*/
        .select-items div,
        .select-selected {
            color: #ffffff;
            padding: 8px 16px;
            border: 1px solid transparent;
            border-color: transparent transparent rgba(0, 0, 0, 0.1) transparent;
            cursor: pointer;
            user-select: none;
        }

        /*style items (options):*/
        .select-items {
            position: absolute;
            background-color: DodgerBlue;
            top: 100%;
            left: 0;
            right: 0;
            z-index: 99;
        }

        /*hide the items when the select box is closed:*/
        .select-hide {
            display: none;
        }

        .select-items div:hover,
        .same-as-selected {
            background-color: rgba(0, 0, 0, 0.1);
        }
    </style>
    <style>
        body {
            font-family: Arial;
            font-size: 17px;
            padding: 70px;
        }

        * {
            box-sizing: border-box;
        }

        .row {
            display: -ms-flexbox;
            /* IE10 */
            display: flex;
            -ms-flex-wrap: wrap;
            /* IE10 */
            flex-wrap: wrap;
            margin: 0 -16px;
        }

        .col-25 {
            -ms-flex: 25%;
            /* IE10 */
            flex: 25%;
        }

        .col-50 {
            -ms-flex: 50%;
            /* IE10 */
            flex: 50%;
        }

        .col-75 {
            -ms-flex: 75%;
            /* IE10 */
            flex: 75%;
        }

        .col-25,
        .col-50,
        .col-75 {
            padding: 0 16px;
        }

        .container {
            background-color: #f2f2f2;
            padding: 5px 20px 15px 20px;
            border: 1px solid lightgrey;
            border-radius: 3px;
        }

        input[type=text] {
            width: 100%;
            margin-bottom: 8px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        label {
            margin-bottom: 8px;
            display: block;
        }

        .icon-container {
            margin-bottom: 20px;
            padding: 7px 0;
            font-size: 24px;
        }

        .btn {
            background-color: #04AA6D;
            color: white;
            padding: 12px;
            margin: 10px 0;
            border: none;
            width: 100%;
            border-radius: 3px;
            cursor: pointer;
            font-size: 17px;
        }

        .btn:hover {
            background-color: #45a049;
        }

        a {
            color: #2196F3;
        }

        hr {
            border: 1px solid lightgrey;
        }

        span.price {
            float: right;
            color: grey;
        }

        /* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (also change the direction - make the "cart" column go on top) */
        @media (max-width: 800px) {
            .row {
                flex-direction: column-reverse;
            }

            .col-25 {
                margin-bottom: 20px;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">Home</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Cart
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="row" style="margin-top: 20px;">
        <div class="col-75">
            <div class="container">
                <form class="form" method="POST" action="{{route('order.tuku')}}">
                    @csrf
                    <div class="row">
                        <div class="col-50" style="margin-top: 10px; font-family: 'Times New Roman', Times, serif;">
                            <h4><b>Alamat Pembeli</b></h3>

                                <label for="fname"><i class="fa fa-user"></i> Provinsi</label>
                                <div style="margin-bottom: 15px;">
                                    <select class="form-select" id='ProvinceId' name='ProvinceId' aria-label="Default select example" required>
                                        <option value='0'>-- Select Provinsi --</option>
                                        @foreach ($provinsi as $province)
                                        <option value="{{ $province->provinceId }}">{{ $province->provinceName }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <label for="fname"><i class="fa fa-address-card-o"></i> Kabupaten / Kota</label>
                                <div style="margin-bottom: 15px;">
                                    <select class="form-select" id='cityId' name='cityId' required>
                                        <option value='0'>-- Select Kabupaten / Kota --</option>
                                    </select>
                                </div>
                                <label for="fname"><i class="fa fa-address-card-o"></i> Kecamatan</label>
                                <div style="margin-bottom: 15px;">
                                    <select class="form-select" id='districtId' name='districtId'>
                                        <option value='0'>-- Pilih Kecamatan --</option>
                                    </select>
                                </div>
                                <label for="fname"><i class="fa fa-address-card-o"></i> Kode Pos</label>
                                <div style="margin-bottom: 15px;">
                                    <select class="form-select" id='postalCode' name='postalCode'>
                                        <option value='0'>-- Pilih Kode Pos --</option>
                                    </select>
                                </div>
                                <div style="margin-bottom: 15px;">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" id="alamat" name="alamat" placeholder="Masukan Alamat Lengkap Anda">
                                </div>

                        </div>

                        <div class="col-50" style="margin-top: 10px; font-family: 'Times New Roman', Times, serif;">
                            <h4><b>Pengiriman</b></h4>


                            <label for="nama">Nama</label>
                            <input type="text" id="nama" name="nama" placeholder="Masukan Nama Anda">
                            <label for="email">Email</label>
                            <input type="text" id="email" name="email" placeholder="Masukan Nama Anda">

                            <label for="phone">No telepon</label>
                            <input type="text" id="phone" name="phone" placeholder="Masukan Nomor Telepon Anda">

                            <div class="form-group">
                                <label>Pilih Jasa Ekspedisi<span style="color: red;"> *</span></label>
                                <select class="form-select" name="ekspedisi" id="ekspedisi" required>
                                    <option value="">Pilih Jasa Ekspedisi</option>
                                    <option value="jne">Jne </option>
                                    <option value="jnt">Jnt </option>
                                    <option value="sicepat">Si Cepat </option>
                                    <option value="anteraja">Anter Aja </option>
                                    <option value="pos">Pos </option>
                                    <option value="lion">Lion </option>
                                </select>
                                <p class="text-danger">{{ $errors->first('ekspedisi') }}</p>
                            </div>
                            <div class="form-group">
                                <label>Pilih Layanan<span style="color: red;"> *</span></label>
                                <select class="form-select" name="service" id="service" required>
                                    <option value="">pilih layanan </option>
                                </select>
                                <p class="text-danger">{{ $errors->first('service') }}</p>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="demo" id="demo" class="form-control" required>
                                <input type="hidden" name="hargaOngkos" id="hargaOngkos" class="form-control" required>
                                <input type="hidden" name="kodepos" id="kodepos" class="form-control" required>

                            </div>



                        </div>

                    </div>
                    <label>
                        <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
                    </label>
                    <input type="submit" value="Continue to checkout" class="btn">
                </form>
            </div>
        </div>


        <div class="col-25">
            <div class="container" style=" font-family: 'Times New Roman', Times, serif;">

                <h4 style="margin-top: 10px;">Cart <span class="price" style="color:black"><i class="fa fa-shopping-cart"></i> <b>
                            {{ (Helper::cartCount()) }}
                        </b></span></h4>
                @foreach ($cart as $item)
                <p>{{ $item->product->title }} X {{ $item->quantity }} <span class="price">{{ $item->amount }}</span></p>
                @endforeach


                <!-- //total weight  -->
                <input type="hidden" name="weight" id="weight" value="{{ $total_weight }}">
                <!-- //end total weight -->
                <hr>
                <p>Sub Total <span class="price" id="subTotal" style="color:black">
                        Rp. {{number_format(Helper::totalCartPrice(),2)}}</span></p>
                <?php
                $jumlah = Helper::totalCartPrice();
                ?>
                <p>Ongkos Kirim <span class="price" id="harga" style="color:black"><b></b></span></p>

                <p>Total <span class="price" style="color:black" id="total"><b></b></span></p>

                <p>Saldo Dompet <span class="price" style="color:black" id="saldo"><b>
                            Rp. {{number_format(Auth::user()->saldo,2)}}
                        </b></span></p>
                </b></span></p>
            </div>
        </div>
    </div>

    <!-- Script -->
    <script type='text/javascript'>
        $(document).ready(function() {
            $('#ProvinceId').on('change', function() {
                var provinceId = $(this).val();
                if (provinceId) {
                    $.ajax({
                        url: "{{ url('api/city') }}",
                        method: "GET",
                        data: {
                            provinceId: provinceId,
                            _token: '{{csrf_token()}}'
                        },
                        success: function(result) {
                            var len = 0;
                            if (result['data'] != null) {
                                len = result['data'].length;
                            }
                            if (len > 0) {
                                // Read data and create <option >
                                var option = "";
                                for (var i = 0; i < len; i++) {
                                    var id = result['data'][i].cityId;
                                    var name = result['data'][i].cityName;
                                    option += "<option value='" + id + "'>" + name + "</option>";
                                }
                                $("#cityId").empty();
                                $("#cityId").append(option);
                            }

                        }
                    });
                } else {
                    $("#cityId").empty();
                }
            });
        });
        //memanggl api district
        $(document).ready(function() {
            $('#cityId').on('change', function() {
                var cityId = $(this).val();
                if (cityId) {
                    $.ajax({
                        url: "{{ url('api/district') }}",
                        method: "GET",
                        data: {
                            cityId: cityId,
                        },
                        success: function(result) {
                            var len = 0;
                            if (result['data'] != null) {
                                len = result['data'].length;
                            }
                            if (len > 0) {
                                // Read data and create <option >
                                var option = "";
                                for (var i = 0; i < len; i++) {
                                    var id = result['data'][i].districtId;
                                    var name = result['data'][i].districtName;
                                    option += "<option value='" + id + "'>" + name + "</option>";
                                }
                                $("#districtId").empty();
                                $("#districtId").append(option);
                            }
                        }
                    });
                } else {
                    $("#districtId").empty();
                }
            });
        });

        //memanggil api postalCode 
        $(document).ready(function() {
            $('#districtId').on('change', function() {
                var districtId = $(this).val();
                if (districtId) {
                    $.ajax({
                        url: "{{ url('api/subdistrict') }}",
                        method: "GET",
                        data: {
                            districtId: districtId,
                        },
                        success: function(result) {
                            var len = 0;
                            if (result['data'] != null) {
                                len = result['data'].length;
                            }
                            if (len > 0) {
                                // Read data and create <option >
                                var option = "";
                                for (var i = 0; i < len; i++) {
                                    var id = result['data'][i].subdistrictId;
                                    var name = result['data'][i].subdistrictName;
                                    var postalCode = result['data'][i].postalCode;
                                    option += "<option value='" + postalCode + "'>" + '(' + postalCode + ')' + "&nbsp" + name + "</option>";
                                }
                                $("#postalCode").empty();
                                $("#postalCode").append(option);
                            }
                        }
                    });
                } else {
                    $("#postalCode").empty();
                }
            });
        });


        $('#ekspedisi').on('change', function() {
            $('#service').empty()
            $('#service').append('<option value="">Loading...</option>')

            $.ajax({
                url: "{{ url('/api/cost') }}",
                type: "POST",
                data: {
                    // origin_postal_code: 10520,
                    destination_postal_code: $('#postalCode').val(),
                    couriers: $('#ekspedisi').val(),
                    weight: $('#weight').val(),
                },
                success: function(data) {

                    $('#service').empty()
                    $('#service').append('<option value="">Pilih Service</option>')
                    let dt = data['data'];
                    let cr = dt['pricing'];
                    console.log("Hasil Response: " + JSON.stringify(cr));
                    //LOOPING DATA ONGKOS KIRIM
                    // Menampilkan Ongkos Kirim
                    $.each(cr, function(key, value) {
                        let kurir = value['courier_service_code'];
                        let harga = value['price'];
                        $('#service')
                            //menampilkan data kurir
                            .append(
                                '<option value="' + harga + '">' + kurir + '&nbsp' + harga + '</option>');

                    });
                }
            });
        })



        //kurir harga
        $('#service').on('change', function() {
            //mengampildata value select dari kurir//
            // let split = $('[harga]').val()
            let harga = $('#service').find(":selected").val();
            let layanan = $('#service').find(":selected").text();

            // mengambil harga dan value harga //
            $('#harga').text('Rp. ' + harga + '.00');
            document.getElementById("harga").value = harga;

            let subtotal = "{{ $jumlah }}";
            let total = parseInt(subtotal) + parseInt(harga);
            $('#total').text('Rp. ' + total + '.00');
            document.getElementById("total").value = total;

            $('#demo').val(total);
            $('#hargaOngkos').val(harga);

        })

        $('#postalCode').on('change', function() {
            let kodepos = $('#postalCode').find(":selected").val();
            $('#kodepos').val(kodepos);
        })
    </script>
</body>

</html>