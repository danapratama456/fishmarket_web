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

        .order-name p {
            margin-bottom: 0
        }

        .order-quantity {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        @media (max-width: 767px) {
            .order-quantity {
                display: flex;
                flex-direction: row;
            }
        }
    </style>
@endsection

@section('content')
    <nav class="navbar navbar-expand-lg custom_nav-container">
        <a class="navbar-brand container" href="{{ route('scan_table') }}">
            <span class="text-dark">
                Invoice
            </span>
        </a>
    </nav>
    <div class="container mb-5">
        <div class="" id="loading">Loading...</div>
        <div class="" id="error"></div>
        <div class="order-items" id="order-items"></div>
    </div>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="mb-5 container">
        <a id="link" class="btn-primary" href="{{ route('pilih_makanan') }}">Tambah menu</a>
    </div>
    <div class="container">
        <div id="status"></div>
    </div>
@endsection

@section('script')
    <script>
        async function fetchData(apiEndpoint) {
            // Initial state
            let data = null;
            let isLoading = true;
            let error = null;

            try {
                const response = await fetch(apiEndpoint);

                // Check if the response status is OK (status code 200)
                if (!response.ok) {
                    throw new Error(`Failed to fetch data. Status: ${response.status}`);
                }

                // Parse the response JSON
                data = await response.json();
            } catch (err) {
                // Handle any errors that occurred during the fetch
                error = err.message;
            } finally {
                // Set isLoading to false regardless of success or failure
                isLoading = false;
            }

            // Return the result object
            return {
                data,
                isLoading,
                error
            };
        }

        function tampilOrderDB(result) {
            const loadingDiv = document.getElementById('loading');
            const errorDiv = document.getElementById('error');
            const orderItems = document.getElementById('order-items');

            if (result.isLoading) {
                loadingDiv.style.display = 'block';
                errorDiv.style.display = 'none';
                orderItems.style.display = 'none';
            } else if (result.error) {
                loadingDiv.style.display = 'none';
                errorDiv.style.display = 'block';
                dataContainer.style.display = 'none';
                errorDiv.textContent = `Error: ${result.error}`;
            } else {
                loadingDiv.style.display = 'none';
                errorDiv.style.display = 'none';
                orderItems.style.display = 'block';

                let totalHarga = 0

                // Customize the HTML structure based on your data
                result.data.orderList.forEach(item => {
                    totalHarga += item.total_price
                    const listItem = document.createElement('div');
                    listItem.classList.add('order-item');
                    listItem.innerHTML = `
                    <div class="order-card">
                        <img src="uploads/menu/${item.image}" alt="Food Image">
                            <div class="order-details">
                                <div class="order-name">
                                    <div>
                                        <p>${item.name}</p>
                                        <p>Rp. ${item.price.toLocaleString('id-ID')}</p>

                                    </div>
                                    <div class="order-quantity" style="margin-right:2em">
                                       <p>Jml</p> 
                                        <p>
                                            ${item.quantity}
                                        </p>
                                    </div>
                                </div>
                            <div class="">
                                <p>Jumlah harga:</p>
                                <p>
                                    Rp. ${item.total_price.toLocaleString('id-ID')}
                                </p>
                            </div>
                        </div>
                    </div>`;
                    orderItems.appendChild(listItem);
                });
                localStorage.setItem('savedOrderList', result.data.orderList)
                const total = document.createElement('div')
                total.innerHTML = `
                <div class="fixed-bottom bg-light p-3 text-center d-flex justify-content-between p-4">
                    <p>Total Harga</p>
                    <p class="fw-bold">
                        Rp. ${totalHarga.toLocaleString('id-ID')}    
                    </p>
                </div>
                `
                orderItems.appendChild(total);
            }

        }


        const kode_meja = localStorage.getItem('kode_meja');
        if (kode_meja) {
            const fetchUrl = `{{ route('index') }}/get_transaction/${kode_meja}`
            console.log(fetchUrl)
            fetchData(fetchUrl)
                .then(result => tampilOrderDB(result))
                .catch(error => console.error(`Error in fetchData: ${error}`))
        } else {
            console.log('error!!')
        }
    </script>
@endsection
