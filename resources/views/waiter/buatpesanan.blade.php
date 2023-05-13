@extends('layouts.dashboard')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <!-- / Layout wrapper -->
    <div class="row row-cols-1 row-cols-lg-2">
        <div class="col-12 col-lg-8">
            <div class="row row-cols-1 row-cols-lg-3 g-4">
                @foreach($menu as $item)
                    <div class="col">
                        <button class="btn btn-link" onclick="return get_menu({{ $item->id }})">
                            <div class="card">
                                <img src="{{ asset('storage/'. $item->image ) }}"" class="
                                    card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $item->nama }}</h5>
                                    <p class="card-text">Rp.{{ number_format($item->harga,0,',','.') }}</p>
                                    {{-- <form class="tambahpesanan">
                                        <input type="number" min="1" max="" class="form-control qty" name="qty" id="qty">
                                        <input type="hidden" class="id_menu" name="id" id="id" value="{{ $item->id }}">
                                        <button class="btn btn-primary addcart" id="add">Tambah</button>
                                    </form> --}}
                                </div>
                            </div>
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-lg-4 col-12">
            <div class="card bg-dark text-white">
                <div class="" id="menuselect"></div>
                <button class="btn btn-success" id="set">Rp.10000000/Checkout</button>
            </div>
        </div>
    </div>

    @endsection
    @section('js')
    
    <script>
        $(document).ready(function () {
            var val = $('.tambahpesanan').serializeArray();
            let i ;
// let len = cars.length;
            $('.tambahpesanan').on('submit', function (e) {
                e.preventDefault();
                for (i= 1;i < 5; i++) {
                    window.localStorage.setItem('pesanan'+[i], val);
                    // text += cars[i] + "<br>";
                }
            });

        });
        function get_menu(id){
            $.ajax({
                type : 'get',
                url : '/pilih-menu',
                data:{
                    'id': id,
                },
                success:function(data){
                    $('#menuselect').html(data);
                }
            });
        }

        function add_pesan(id,harga){
            var qty = $('#qty').val();
            var pesanan={
                "nama" : $('#nama').html(),
                "id_menu":id,
                "qty" : qty,
                "sub-total" : harga*qty,
            };
            localStorage.setItem('pesanan',JSON.stringify(pesanan));
            var item = JSON.parse(localStorage.getItem('pesanan'));
            console.log(item);
        }

    </script>

    @endsection
