@extends('layouts.app')
@section('content')
<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>


  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Week Assignment</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard v1</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

<div class="container">
    @include('flash-message')
    <form action="{{URL('admin/week_add')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="exampleFormControlInput1">Add week</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Week No" name="week_name">
            Start Date :<input type="date" class="form-control" style="width:50%" id="exampleFormControlInput1" name="start_date" placeholder="Start Date">
            End Date : <input type="date" class="form-control" style="width:50%" id="exampleFormControlInput1" name="end_date" placeholder="End Date">
            <button type="submit" class="btn btn-primary mt-4">Submit</button>
    </form>
      </div>
      <div class="form-group">
        <label for="exampleFormControlSelect1">Weeks</label>
            <table class="table" id="example1">
                <thead>
                    <th>Week No</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Active Week</th>
                </thead>
                <tbody>
                    @foreach ($weeks as $item)
                    <tr>
                        <td>{{$item->week_name}}</td>
                        <td>{{$item->start_date}}</td>
                        <td>{{$item->end_date}}</td>
                        <td>
                          @if($item->current_week_status != 0)
                          <input type="checkbox" id="week_en_id_{{$item->id}}" checked data-toggle="toggle" onchange="enableDisableWeek(this.value,{{$item->id}})" data-on="Enabled" data-off="Disabled">
                          @else 
                          <input type="checkbox" id="week_en_id_{{$item->id}}" data-toggle="toggle" onchange="enableDisableWeek(this.value,{{$item->id}})" data-on="Enabled" data-off="Disabled">
                          @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
    </div> 

</div>

<script>
    $( document ).ready(function() {
    $("#example1").DataTable();
    // $("#example1").DataTable({
    //   "responsive": true, "lengthChange": false, "autoWidth": false,
    //   "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    // }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

   
  });

  function enableDisableWeek(valu,id){
      
    if ($('#week_en_id_'+id).prop('checked')) {
      $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
            $.ajax({
              type:'get',
              url:'/public/admin/enable-disable-week',
              data:{
                 'id':id
              },

              success:function(data) {
                  var x = JSON.parse(data);
                 window.location.reload();
              }
            });
    }
  }
</script>
@endsection