@extends('layouts.app')

@section('content')
<div class="">
  <div class="page-title">
    <div class="title_left">
      <h3>Users</h3>
    </div>


  </div>

  <div class="clearfix"></div>

  <div class="row">
    <div class="col-md-12 col-sm-12  ">
      <div class="x_panel">
        <div class="x_title">
          <h2>List Users</h2>
          <button class="btn btn-info btn-sm ml-3" data-toggle="modal" data-target="#modalTambahUser">Tambah</button>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <table class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>User</th>
                <th>Role</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($users as $user)
              <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td>{{$user->name}}</td>
                <td>{{$user->role}}</td>
                <td>
                  <div class="btn-group">
                    <button class="btn btn-sm btn-primary btnupdatestatus" data-id="{{$user->id}}" data-toggle="modal" data-target="#modalStatus">Edit</button>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>

        </div>
        
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="modalTambahUser" tabindex="-1" role="dialog" aria-labelledby="modalTambahUserLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTambahUserLabel">Add Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-label-left input_mask" method="post" action="{{route('user.store')}}">
          @csrf
          <input type="text" class="form-control mb-3" name="name" id="" placeholder="Name">
          <input type="email" class="form-control mb-3" name="email" id="" placeholder="Email Address">
          <select name="role" id="role" class="form-control mb-3">
            <option value="0">--Select Role--</option>
            <<option value="admin">ADMIN</option>
            <option value="customer">CUSTOMER</option>
            <option value="gudang">GUDANG</option>
          </select>
          <input type="password" class="form-control mb-3" name="password" id="" placeholder="Password">
          <input type="password" class="form-control mb-3" name="password_confirmation" id="" placeholder="Password Confirmation">

      </div>
      <div class="modal-footer">
          <button class="btn btn-primary source" type="submit">Simpan</button>
      </div>
  </form> 
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalStatus" tabindex="-1" role="dialog" aria-labelledby="modalStatusLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalStatusLabel">Update Role</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formstatus" class="form-label-left input_mask" method="post">
          @csrf
          @method('PUT')
          <input type="hidden" name="id" id="idStatus">
          <div class="col-md-12 col-sm-12  form-group has-feedback">
            <select class="form-control" name="status" id="">
              <option value="0">--Pilih Role--</option>
              <option value="admin">ADMIN</option>
              <option value="customer">CUSTOMER</option>
              <option value="gudang">GUDANG</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary source">Simpan</button>
        </div>
      </form> 
    </div>
  </div>
</div>

@endsection
@push('addscript')
<script>
  $(".btnupdatestatus").on('click', function () {
            
    let id = $(this).data('id')
    $('#idStatus').val(id)
    $('#formstatus').attr('action',"{{url('user/')}}/"+id)
  })
</script>
@endpush