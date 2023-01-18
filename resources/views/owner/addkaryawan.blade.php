@extends('layouts.dashboard')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
  <div class="" id="notifdelete"></div>
    <div class="row row-cols-1 row-cols-lg-2">
        <div class="col-2">
            <div class="card my-3">
                <div class="card-body">
                    {{-- <div class="card-title d-flex align-items-start justify-content-between">
                    <div class="avatar flex-shrink-0">
                      <img
                        src="/assets/img/icons/unicons/wallet-info.png"
                        alt="Credit Card"
                        class="rounded"
                      />
                    </div>
                    <div class="dropdown">
                      <button
                        class="btn p-0"
                        type="button"
                        id="cardOpt6"
                        data-bs-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                      >
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                        <a class="dropdown-item" href="javascript:void(0);">View More</a>
                        <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                      </div>
                    </div>
                  </div> --}}
                    <span>Sales</span>
                    <h3 class="card-title text-nowrap mb-1">$4,679</h3>
                    <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small>
                </div>
            </div>
        </div>
        <div class="col-10">
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Error excepturi illum impedit cupiditate
                delectus
                nostrum, voluptas distinctio sit corporis voluptatem. Maiores suscipit quas ab. Nesciunt ab hic a
                asperiores
                veniam?</p>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#adduser">
                Tambah User
            </button>

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
                            <form id="form-usr">
                                <input type="text" class="form-control mb-3" name="name" id="name" placeholder="Nama"
                                    required>
                                <input type="email" class="form-control mb-3" name="email" id="email"
                                    placeholder="Email" required>
                                <select name="level" class="form-select mb-3" id="level">
                                    <option value="">Posisi</option>
                                    <option value="admin">admin</option>
                                    <option value="kasir">kasir</option>
                                    <option value="waiter">waiter</option>
                                </select>
                                <input type="password" class="form-control mb-3" name="password" id="password"
                                    placeholder="password" required>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="add-user">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <table class="table table-responsive" id="data">
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Jabatan</th>
        <th>Aksi</th>
      </tr>
      <tbody>
        @foreach ($karyawans as $item)
        <tr>
          <td>{{$loop->iteration}}</td>
          <td>{{ $item->name}}</td>
          <td>{{ $item->email}}</td>
          <td>{{ $item->level}}</td>
          <td>
            <form method="post" id="deleteform" class="delete-form" data-route="/tambah-karyawan/{{$item->id}}">
              @method('destroy')
              <button type="submit" class="btn btn-danger btn-sm">HAPUS</button>
          </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
</div>
<!-- / Layout wrapper -->

@endsection
@section('js')
<script>
    $(document).ready(function () {
        // $("#my-toast").toast("show");
        $('#add-user').on('click', function (e) {
                $.ajax({
                    type: 'post',
                    url: '/tambah-karyawan',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: $("#form-usr").serializeArray(),
                    success: function (data) {
                        $('#form-usr')[0].reset();
                        $('#notif').html(data);
                        $('#data').load(document.URL +  ' #data');
                        $("#my-toast").toast("show");
                    }
                });
        });
        $('.delete-form').on('submit', function(e) {
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
                      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                      data: {
                    '_method': 'delete'
                  },
                      success: function (data) {
                        $('#deleteform')[0].reset();
                        $('#notifdelete').html(data);
                        $('#data').load(document.URL +  ' #data');
                        $("#my-toast").toast("show");
                      }
                  });
                  }
              });
          });
    });

</script>
@endsection
