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
        <a id="link" class="btn-primary" href="{{ route('pilih_makanan') }}">Tambah menu</a>
    </div>
    <div class="container">
        <div id="status"></div>
    </div>
    {{-- Confirm modal --}}
    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel">Konfirmasi Simpan ke Pesanan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModalBtn">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin untuk menambah pesanan?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancelBtn">Batal</button>
                    <button type="button" class="btn btn-primary" id="confirmSaveBtn">Ya, Simpan</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function simpanCart() {
            // Check if the user confirmed

            const orderList = JSON.parse(localStorage.getItem('orderList')) || [];
            const kodeMeja = JSON.parse(localStorage.getItem('kode_meja')) || [];
            // const button = document.getElementById("simpan");

            const confirmationModal = document.getElementById('confirmationModal');
            confirmationModal.classList.add('show');
            confirmationModal.style.display = 'block';

            // Atur event listener untuk tombol konfirmasi di dalam modal
            const confirmSaveBtn = document.getElementById('confirmSaveBtn');
            confirmSaveBtn.addEventListener('click', function() {
                fetch('{{ route('save_transaction') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content')
                        },
                        body: JSON.stringify({
                            orderList,
                            kodeMeja,
                        })
                    }).then(response => response.json())
                    .then(data => {
                        console.log(data.message);
                        if (data) {
                            alert(data.message)
                            localStorage.removeItem('orderList')
                            deleteButton()
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    })
                confirmationModal.classList.remove('show');
                confirmationModal.style.display = 'none';
            })

            // Atur event listener untuk tombol Batal di dalam modal
            var cancelBtn = document.getElementById('cancelBtn');
            cancelBtn.addEventListener('click', function() {
                // Tutup modal saat tombol Batal diklik
                confirmationModal.classList.remove('show');
                confirmationModal.style.display = 'none';
            });

            // Atur event listener untuk tombol close (X) di dalam modal
            var closeModalBtn = document.getElementById('closeModalBtn');
            closeModalBtn.addEventListener('click', function() {
                // Tutup modal saat tombol close (X) diklik
                confirmationModal.classList.remove('show');
                confirmationModal.style.display = 'none';
            });
        }

        function deleteButton() {
            let orderList = localStorage.getItem('orderList');
            const buttonElement = document.getElementById("simpan");
            const linkElement = document.getElementById("link");
            const statusElement = document.getElementById("status");

            if (!orderList) {
                buttonElement.remove()
                linkElement.remove()
                const newStatus = document.createElement('div');
                newStatus.innerHTML = `
                <div class="alert alert-warning">
                    Pesanan Anda telah dibuat. Silakan tunggu. <br> Untuk melihat pesanan Anda, silakan klik <a href={{ route('invoice') }}><strong>di sini</strong></a>.
                </div>
                `
                statusElement.appendChild(newStatus)
            }
        }
        deleteButton()

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
                        <span>Rp. ${item.price.toLocaleString('id-ID')}</span>
                    </div>
                </div>
            </div>`;

                orderItemsElement.appendChild(listItem);
            });
        }
        tampilCart();
    </script>
@endsection
