@extends('layouts.order')

@section('title')
    | Pesan Minuman
@endsection

@section('content')
    <nav class="navbar navbar-expand-lg custom_nav-container">
        <a class="navbar-brand container" href="#">
            <span class="text-dark">
                Pesan Minuman
            </span>
        </a>
    </nav>
    <div class="container">

        <section class="food_section layout_padding-bottom">

            <div class="row grid">

                @foreach ($menu as $data)
                    <div class="col-sm-6 col-lg-4 all">
                        <div class="box">
                            <div>
                                <div class="img-box">
                                    <img src="uploads/menu/{{ $data->image }}" alt="">
                                </div>
                                <div class="detail-box">
                                    <h5>
                                        {{ $data->name }}
                                    </h5>
                                    <p>
                                        Veniam debitis quaerat officiis quasi cupiditate quo, quisquam velit, magnam
                                        voluptatem repellendus sed eaque
                                    </p>
                                    <div class="options">
                                        <h6>
                                            Rp. {{ $data->price }}
                                        </h6>

                                        <button
                                            onclick="tambahCart({{ $data->id }},'{{ $data->name }}', '{{ $data->image }}'
                                                , {{ $data->price }})">
                                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                viewBox="0 0 456.029 456.029"
                                                style="enable-background:new 0 0 456.029 456.029;" xml:space="preserve">
                                                <g>
                                                    <g>
                                                        <path
                                                            d="M345.6,338.862c-29.184,0-53.248,23.552-53.248,53.248c0,29.184,23.552,53.248,53.248,53.248
                                                                                                                                                                 c29.184,0,53.248-23.552,53.248-53.248C398.336,362.926,374.784,338.862,345.6,338.862z" />
                                                    </g>
                                                </g>
                                                <g>
                                                    <g>
                                                        <path
                                                            d="M439.296,84.91c-1.024,0-2.56-0.512-4.096-0.512H112.64l-5.12-34.304C104.448,27.566,84.992,10.67,61.952,10.67H20.48
                                                                                                                                                                 C9.216,10.67,0,19.886,0,31.15c0,11.264,9.216,20.48,20.48,20.48h41.472c2.56,0,4.608,2.048,5.12,4.608l31.744,216.064
                                                                                                                                                                 c4.096,27.136,27.648,47.616,55.296,47.616h212.992c26.624,0,49.664-18.944,55.296-45.056l33.28-166.4
                                                                                                                                                                 C457.728,97.71,450.56,86.958,439.296,84.91z" />
                                                    </g>
                                                </g>
                                                <g>
                                                    <g>
                                                        <path
                                                            d="M215.04,389.55c-1.024-28.16-24.576-50.688-52.736-50.688c-29.696,1.536-52.224,26.112-51.2,55.296
                                                                                                                                                                 c1.024,28.16,24.064,50.688,52.224,50.688h1.024C193.536,443.31,216.576,418.734,215.04,389.55z" />
                                                    </g>
                                                </g>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row grid">
                <div class="btn-box">
                    <a href="{{ route('pilih_makanan') }}">
                        Pilih Makanan
                    </a>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('cart')
    <!-- cart section -->
    <div class="bottom-right-button btn">
        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom"
            aria-controls="offcanvasBottom">Cart</button>
    </div>

    <div class="offcanvas offcanvas-bottom" style="height: 60vh" tabindex="-1" id="offcanvasBottom"
        aria-labelledby="offcanvasBottomLabel">
        <div class="offcanvas-header container">
            <h5 class="offcanvas-title" id="offcanvasBottomLabel">Pesanan Anda</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <div class="offcanvas-body container">
            <div class="order-items" id="order-items"></div>
        </div>
    </div>
@endsection


@section('script')
    <script>
        // let id_meja = localStorage.getItem('kode_meja')
        // document.getElementById('id_meja').innerHTML = id_meja
        function tambahCart(dataId, dataName, dataImage, dataPrice) {
            const orderItem = {
                id_menu: dataId,
                name: dataName,
                image: dataImage,
                price: dataPrice,
                quantity: 1
            }

            // Get localStorage Data
            let orderList = JSON.parse(localStorage.getItem('orderList')) || [];

            // Cek apakah pesanan sudah ada dalam daftar
            const existingItemIndex = orderList.findIndex(item => item.id_menu === dataId);

            if (existingItemIndex !== -1) {
                // Jika pesanan sudah ada, tingkatkan jumlahnya
                orderList[existingItemIndex].quantity++;
            } else {
                // Jika pesanan belum ada, tambahkan ke daftar
                orderList.push(orderItem);
            }

            localStorage.setItem('orderList', JSON.stringify(orderList));

            // Tampilkan pesanan di daftar pesanan
            tampilCart();
        }

        function kurangItem(dataId) {
            let orderList = JSON.parse(localStorage.getItem('orderList')) || [];

            const existingItemIndex = orderList.findIndex(item => item.id_menu === dataId);
            if (existingItemIndex !== -1) {
                // Jika pesanan sudah ada, tingkatkan jumlahnya
                if (orderList[existingItemIndex].quantity > 1) {
                    orderList[existingItemIndex].quantity--
                } else {
                    orderList.splice(existingItemIndex, 1);
                }
                localStorage.setItem('orderList', JSON.stringify(orderList));
                tampilCart();
            };
        }

        function tambahItem(dataId) {
            let orderList = JSON.parse(localStorage.getItem('orderList')) || [];

            const existingItemIndex = orderList.findIndex(item => item.id_menu === dataId);

            if (existingItemIndex !== -1) {
                // Jika pesanan sudah ada, tingkatkan jumlahnya
                orderList[existingItemIndex].quantity++;
            }

            localStorage.setItem('orderList', JSON.stringify(orderList));

            // Tampilkan pesanan di daftar pesanan
            tampilCart();
        }

        function tampilCart() {
            const orderList = JSON.parse(localStorage.getItem('orderList')) || [];
            const orderItemsElement = document.getElementById('order-items');

            // Bersihkan daftar pesanan sebelum menambahkan yang baru
            orderItemsElement.innerHTML = '';

            // Tambahkan pesanan ke daftar pesanan
            orderList.forEach(item => {
                const listItem = document.createElement('div');
                listItem.classList.add('order-item');

                listItem.innerHTML = `
                    <div class="order-card">
                        <img src="uploads/menu/${item.image}" alt="Food Image">
                        <div class="order-details">
                            <div class="order-name">
                                <span>${item.name}</span>
                                <div class="order-quantity">
                                    <button onClick="kurangItem(${item.id_menu})" class="quantity-btn">-</button>
                                    <span>${item.quantity}</span>
                                    <button onClick="tambahItem(${item.id_menu})" class="quantity-btn">+</button>
                                </div>
                            </div>
                            <div class="">
                                <p>Harga:</p>
                                <span>Rp. ${item.price.toLocaleString('id-ID')}</span>

                            </div>
                        </div>
                    </div>`;

                orderItemsElement.appendChild(listItem);
            });
            const link = document.createElement('div')
            link.innerHTML = `<a href="{{ route('detail_transaction') }}">Order Detail</a>`
            orderItemsElement.appendChild(link);
        }
        tampilCart();
    </script>
@endsection
