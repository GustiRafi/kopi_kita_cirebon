@extends('layouts.dashboard')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="" id="notifdelete"></div>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#adduser">
        Tambah Menu
    </button>
    <button id="add-table" class="btn btn-primary">Tambah Meja</button>

    <!-- Modal -->
    <div class="modal fade" id="adduser" tabindex="-1" aria-labelledby="adduser" aria-hidden="true">
        <div class="" id="notif"></div>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">form tambah data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-menu" enctype="multipart/form-data">
                        <input type="text" class="form-control mb-3" name="nama" id="nama" placeholder="Nama Menu"
                            required>
                        <input type="text" class="form-control mb-3" name="harga" id="harga" placeholder="Harga"
                            required>
                        <select name="type" class="form-select mb-3" id="type">
                            <option value="">Jenis Menu</option>
                            <option value="makanan">Makanan</option>
                            <option value="minuman">Minuman</option>
                        </select>
                        <input type="file" class="form-control mb-3" name="image" id="image" placeholder="image"
                            required>
                        <div id="preview"><img src="" /></div><br>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="add-menu">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-lg-2">
        <div class="col-6">
            <table class="table table-responsive" id="data">
                <tr>
                    <th>No</th>
                    <th>foto</th>
                    <th>Nama</th>
                    <th>tipe</th>
                    <th>harga</th>
                    <th>Aksi</th>
                </tr>
                <tbody>
                    @foreach($menu as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><img src="{{ asset('storage/'. $item->image ) }}"
                                    class="img-fluid h-25 w-25 " alt="" srcset=""></td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->type }}</td>
                            <td>{{ $item->harga }}</td>
                            <td>
                                <div class="d-flex">
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#edit{{ $item->id }}">
                                        Edit
                                    </button>
                                    <form method="post" id="deletemenu" class="delete-menu" data-route="/menu/{{ $item->id }}">
                                        @method('destroy')
                                        <button type="submit" class="btn btn-danger btn-sm">HAPUS</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-6">
            <table class="table table-responsive" id="datameja">
                <tr>
                    <th>No</th>
                    <th>Nomer Meja</th>
                    <th>status</th>
                    <th>Aksi</th>
                </tr>
                <tbody>
                    @foreach($tables as $table)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>Meja {{$table->no_meja}}</td>
                            <td>
                                @if ($table->is_avaliable === 1 )
                                Tersedia                                    
                                @else
                                    Tidak Tersedia
                                @endif
                            </td>
                            <td>
                                    <form method="post" id="deletemeja" class="delete-meja">
                                        <input type="hidden" name="no_meja" id="id" value="{{ $table->no_meja}}">
                                        <button type="submit" class="btn btn-danger btn-sm">HAPUS</button>
                                    </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@foreach($menu as $row)
    <!-- Modal edit menu -->
    <div class="modal fade" id="edit{{ $row->id }}" tabindex="-1" aria-labelledby="edit{{ $row->id }}"
        aria-hidden="true">
        <div class="" id="notif"></div>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">form edit data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editmenu" method="post" action="/menu/{{ $row->id }}" enctype="multipart/form-data">
                        @method("put")
                        @csrf
                        <input type="text" class="form-control mb-3" name="nama" id="nama" placeholder="Nama Menu"
                            required value="{{ $row->nama }}">
                        <input type="text" class="form-control mb-3" name="harga" id="harga" placeholder="Harga"
                            value="{{ $row->harga }}" required>
                        <select name="type" class="form-select mb-3" id="type">
                            @if($row->type === "minuman")
                                <option value="">Jenis Menu</option>
                                <option value="makanan">Makanan</option>
                                <option value="minuman" selected>Minuman</option>
                            @elseif($row->type === "makanan")
                                <option value="">Jenis Menu</option>
                                <option value="makanan" selected>Makanan</option>
                                <option value="minuman">Minuman</option>
                            @endif
                        </select>
                        <input type="file" class="form-control mb-3" name="image" id="image" placeholder="image">
                        <div id="preview"><img src="" /></div><br>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="add-menu">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
<!-- / Layout wrapper -->

@endsection
@section('js')
<script>
    $(document).ready(function () {
        // $("#my-toast").toast("show");
        $('#add-menu').on('click', function (e) {
            // e.preventDefault();
            // Get form
            var form = $('#form-menu')[0];

            // Create an FormData object 
            var data = new FormData(form);
            $.ajax({
                type: 'post',
                url: '/menu',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: data,
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    $('#form-menu')[0].reset();
                    $('#notif').html(data);
                    $('#data').load(document.URL + ' #data');
                    $("#my-toast").toast("show");
                }
            });
        });
        // delete menu
        $('.delete-menu').on('submit', function (e) {
            e.preventDefault();
            swal({
                    title: "Yakin ingin menghapus data ini?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: 'post',
                            url: $(this).data('route'),
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                '_method': 'delete'
                            },
                            success: function (data) {
                                $('.delete-menu')[0].reset();
                                $('#notifdelete').html(data);
                                $('#data').load(document.URL + ' #data');
                                $("#my-toast").toast("show");
                            }
                        });
                    }
                });
        });

        // edit menu
        // $('#editmenu').on('submit', function (e) {
        //     var form = $('#editmenu')[0];

        //     // Create an FormData object 
        //     var data = new FormData(form);
        //     e.preventDefault();
        //     $.ajax({
        //         type: 'PUT',
        //         url: $(this).data('route'),
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         },
        //         data:data,
        //         enctype: 'multipart/form-data',
        //         processData: false,
        //         contentType: false,
        //         cache: false,
        //         success: function (data) {
        //             $('#deletemenu')[0].reset();
        //             $('#notifdelete').html(data);
        //             $('#data').load(document.URL + ' #data');
        //             $("#my-toast").toast("show");
        //         }
        //     });
        // });

        $('#add-table').on('click',function(e){
            $.ajax({
                type: 'post',
                url: '/tambah-meja',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                    $('#notifdelete').html(data);
                    $('#datameja').load(document.URL + ' #datameja');
                    $("#my-toast").toast("show");
                }
            });
        });

        // hapus meja
        $('.delete-meja').on('submit', function (e) {
            e.preventDefault();
            swal({
                    title: "Yakin ingin menghapus data ini?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: 'post',
                            url: '/hapus-meja',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: $(".delete-meja").serializeArray(),
                            success: function (data) {
                                $('.delete-meja')[0].reset();
                                $('#notifdelete').html(data);
                                $('#datameja').load(document.URL + ' #datameja');
                                $("#my-toast").toast("show");
                            }
                        });
                    }
                });
        });
    });

</script>
@endsection
