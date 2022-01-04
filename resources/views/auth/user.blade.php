@extends('layouts.app')
@section('content')

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>

  <!-- Content Header (Page header) -->
  <div class="content-header">
    @include('flash-message')
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">User View</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">User</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

<div class="container">
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>User Type</th>
                <th>Location</th>
                <th>Department</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($getUser as $item)
            <tr>
                <td>{{$item->name}}</td>
                <td>{{$item->email}}</td>
                <td>@php echo ($item->u_tp_id !=0) ? $item->get_user_type()->user_type : "" @endphp</td>
                <td>@php echo ($item->location_id !=0) ? $item->get_user_location()->location : "" @endphp</td>
                <td>@php echo ($item->department_id !=0) ? $item->get_user_department()->department : "" @endphp</td>
                <td><button class="btn btn-default" data-toggle="modal" data-target="#modal-xl" onclick="load_edit_model({{$item->id}})">Edit</button></td>
                <td><a href="{{URL('admin/delete_data')}}?tbl=User&id={{$item->id}}"><i class="far fa-trash-alt"></i></a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="modal fade" id="modal-xl">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">User Edit</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{URL('admin/user-edit')}}" method="POST">
        @csrf
        <div class="modal-body" id="popup_div">
        </div>
      
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->




<script>
  $( document ).ready(function() {
    $("#example1").DataTable();
  });

  function load_edit_model(id){
    $('#popup_div').load('user-edit-popup?id='+id);
  }
  
</script>

@endsection