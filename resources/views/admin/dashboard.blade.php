@extends('layouts.app')



@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">KPI Data View</h1>
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

    <div class="card">
      <div class="card-header">
          <table>
            <tr>
              <td>Week</td>
              <td>
                <select class="form-control" name="week_id" id="week_id" >
                  <option value="0">--select--</option>
                  @foreach ($weeks as $item)
                      <option att_end="{{$item->end_date}}" att_st="{{$item->start_date}}" value="{{$item->id}}">{{$item->week_name}}</option>
                  @endforeach
              </select>
              </td>
              <td></td>
            </tr>
            <tr>
              <td>Depatment</td>
              <td>
                <select class="form-control" name="department_id" id="department_id" onchange="get_kpis(this.value)">
                  <option value="0">--select--</option>
                  @foreach ($departments as $items)
                  <option value="{{$items->id}}">{{$items->department}}</option>
                  @endforeach
              </select>
            </td>
            <td></td>
            </tr>
            <tr>
              
              <td><button class="btn btn-block btn-outline-warning btn-lg" onclick="load_result()">Search</button></td>
            </tr>
          </table>
      </div>
    </div>

    <div class="card card-primary card-outline card-outline-tabs" id="result_dev">
        
    </div>
</div>

<script>
  function get_kpis(department_id){
    $('#kpi_id').empty();
        $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
            $.ajax({
               type:'get',
               url:'/admin/kpi-per-department',
               data:{
                 department_id:department_id
               },

               success:function(data) {
                  var x = JSON.parse(data);
                  $('#kpi_id').append('<option value="0">--select--</option>');
                  for(var i = 0; i<x.length;i++){
                    $('#kpi_id').append('<option value="'+x[i].id+'">'+x[i].kpi+'</option>');
                  }
               }
            });
  }

  function load_result(){
    var kpi_id = $('#kpi_id').val();
    var week_id = $('#week_id').val();
    var department_id = $('#department_id').val();
    console.log(kpi_id+'-'+week_id+'-'+department_id);
    $('#result_dev').load('kpi-result?week_id='+week_id+'&department_id='+department_id);
  }
</script>
@endsection