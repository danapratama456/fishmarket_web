<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="public/assets_landingpage/images/favicon.png" type="">

    <title> Upload Menu </title>

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="public/assets_landingpage/css/bootstrap.css" />

    <!--owl slider stylesheet -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <!-- nice select  -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css"
        integrity="sha512-CruCP+TD3yXzlvvijET8wV5WxxEh5H8P4cmz0RFbKK6FlZ2sYl3AEsKlLPHbniXKSrDdFewhbmBK5skbdsASbQ=="
        crossorigin="anonymous" />
    <!-- font awesome style -->
    <link href="public/assets_landingpage/css/font-awesome.min.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="public/assets_landingpage/css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="public/assets_landingpage/css/responsive.css" rel="stylesheet" />

</head>

<body>

    <section class="about_section layout_padding">
        <div class="container  ">

            <div class="row">
                <div class="col-md-3 ">
                </div>
                <div class="col-md-6">
                    <div class="detail-box">
                        <div class="heading_container">


                            <h2>
                                Upload Menu
                            </h2>
                        </div>
                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                            data-target="#ModalTambah">
                            <i class="fas fa-plus"></i> Tambah menu
                        </button>
                        <br><br>

                        <div class="table-responsive">
                            <table id="dataTable" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="color: white">No</th>
                                        <th style="color: white">Nama Menu</th>
                                        <th style="color: white">Opsi</th>

                                        <th style="display: none;">hidden</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no=1 @endphp
                                    @foreach ($menu as $data)
                                        <tr>
                                            <td style="color: white">{{ $no++ }}</td>
                                            <td style="color: white">{{ $data->name }}</td>
                                            <td style="color: white">


                                                <a href="#" data-toggle="modal"
                                                    onclick="deleteData({{ $data->id }})"
                                                    data-target="#DeleteModal">
                                                    <button class="btn btn-danger btn-sm" title="Hapus">Hapus</button>
                                            </td>

                                            <td style="display: none;">{{ $data->id }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 ">
                </div>
            </div>
        </div>
    </section>




    <!-- Modal Tambah -->
    <div class="modal fade" id="ModalTambah" tabindex="-1" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myLargeModalLabel">Tambah Menu</h5>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('upload_menu_add') }}" enctype="multipart/form-data">

                        {{ csrf_field() }}


                        <div class="form-group">
                            <label for="name">nama Menu</label>
                            <input type="text" class="form-control" id="name" name="name"
                                required=""></input>
                        </div>

                        <div class="form-group">
                            <label for="price">price Menu</label>
                            <input type="text" class="form-control" id="price" name="price"
                                required=""></input>
                        </div>
                        <div class="form-group">
                            <label for="kategori">kategori Menu</label>
                            <select name="kategori" id="kategori">
                                <option value="0">Pilih Kategori</option>
                                @foreach ($menu_categories as $kategori)
                                    <option value="{{ $kategori->id }}">{{ $kategori->name }}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="form-group">
                            <label for="image">image Menu</label>
                            <input type="file" class="form-control" id="image" name="image"
                                required=""></input>
                        </div>


                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="Submit">Tambahkan</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>

                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end about section -->




    <!-- Modal -->
    <div class="modal fade" id="DeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data Ini?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" id="deleteForm" method="post">

                        {{ csrf_field() }}
                        {{ method_field('POST') }}
                        <p>Apakah anda yakin ingin menghapus Menu ini ?</p> <button type="button"
                            class="btn btn-secondary float-right" data-dismiss="modal">Batal</button>
                        <button type="submit" name="" class="btn btn-danger float-right mr-2"
                            data-dismiss="modal" onclick="formSubmit()">Hapus</button>

                    </form>
                </div>

            </div>
        </div>
    </div>



    <script type="text/javascript">
        function deleteData(id) {
            var id = id;
            var url = '{{ route('upload_menu_delete', ':id') }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }

        function formSubmit() {
            $("#deleteForm").submit();
        }
    </script>
    <!-- jQery -->
    <script src="public/assets_landingpage/js/jquery-3.4.1.min.js"></script>
    <!-- popper js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <!-- bootstrap js -->
    <script src="public/assets_landingpage/js/bootstrap.js"></script>
    <!-- owl slider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <!-- isotope js -->
    <script src="https://unpkg.com/isotope-layout@3.0.4/dist/isotope.pkgd.min.js"></script>
    <!-- nice select -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script>
    <!-- custom js -->
    <script src="public/assets_landingpage/js/custom.js"></script>
    <!-- Google Map -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap">
    </script>
    <!-- End Google Map -->

    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script type="text/javascript">
        function onScanSuccess(decodedText, decodedResult) {
            // handle the scanned code as you like, for example:
            document.getElementById('kode_produk_form').value = decodedText;
        }

        function onScanFailure(error) {
            // handle scan failure, usually better to ignore and keep scanning.
            // for example:
            // console.warn(`Code scan error = ${error}`);
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", {
                fps: 10,
                qrbox: {
                    width: 250,
                    height: 250
                }
            },
            /* verbose= */
            false);
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    </script>

</body>

</html>
