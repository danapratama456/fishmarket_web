@extends('layouts.order')

@section('title')
    | Detail Order
@endsection

@section('style')
    <style>
        button {
            width: auto;
            height: auto;
            padding-top: 0.5em;
            padding-bottom: 0.5em;
            padding-left: 2em;
            padding-right: 2em;
            border-radius: 0;
            margin-left: auto;
            margin-right: auto;
            background: #ffbe33;
            border: 0;
            display: -webkit-box;
            display: -ms-flexbox;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            color: white
        }
    </style>
@endsection

@section('content')
    <nav class="navbar navbar-expand-lg custom_nav-container">
        <a class="navbar-brand container" href="{{ route('scan_table') }}">
            <span class="text-dark">
                Detail Order
            </span>
        </a>
    </nav>
    <div class="container mb-5">
        <div class="order-items" id="order-items"></div>
    </div>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="mb-5 container">
        <button id="simpan" class="btn-primary" onclick="simpanCart()">Simpan cart</button>
        <a class="btn-primary" href="{{ route('pilih_makanan') }}">Tambah menu</a>
    </div>
@endsection

@section('script')
    <script>
        function simpanCart() {
            const orderList = JSON.parse(localStorage.getItem('orderList')) || [];
            const kodeMeja = JSON.parse(localStorage.getItem('kode_meja')) || [];
            const button = document.getElementById("simpan");


            fetch('{{ route('save_transaction') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        orderList,
                        kodeMeja
                    })
                }).then(response => response.json())
                .then(data => {
                    console.log(data.message);
                    if (data) {
                        button.remove()
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                })
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
                        <div class="order-quantity" style="margin-right:2em">
                            <span >${item.quantity}</span>
                        </div>
                    </div>
                    <div class="">
                        <p>Harga:</p>
                        <span>Rp. ${item.price}</span>

                    </div>
                </div>
            </div>`;

                orderItemsElement.appendChild(listItem);
            });
        }
        tampilCart();
    </script>
@endsection
