@extends('layouts.app')



@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">KPI Formula</h1>
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
    <div class="form-group">
        <label for="exampleFormControlInput1">KPI Formula label</label>
        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
      </div>
      <div class="form-group">
        <label for="exampleFormControlSelect1">KPI</label>
        <select name="" class="form-control" onchange="load_kpi_opt_to_div(this.value)">
            <option value="0">Select KPI</option>
            @foreach ($kpi as $item)
                <option value="{{$item->id}}">{{$item->kpi}}</option>
            @endforeach
        </select>
    </div> 
    <div id="kpi_load">


    </div>

    
</div>

<script>
    function load_kpi_opt_to_div(id){
        $('#kpi_load').load('kpi-option-load?kpi='+id);

    }
</script>

@endsection