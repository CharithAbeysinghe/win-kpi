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
          <h1 class="m-0">User Permission</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">User Permission</li>
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
            <th>Menu</th>
            <th>URL</th>
            <th>Permission</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    
    </tbody>
</table>
</div>
<script>
  $( document ).ready(function() {
    $("#example1").DataTable();
  });
</script>
@endsection