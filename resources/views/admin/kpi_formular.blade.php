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
  @include('flash-message')
  <form action="{{URL('kpi/save-formula')}}" method="post">
    @csrf
    <div class="form-group">
        <label for="exampleFormControlInput1">KPI Formula label</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" name = "eq_label">
      </div>
      <div class="form-group">
        <label for="exampleFormControlSelect1">KPI</label>
        <select name="kpi_id" class="form-control" onchange="load_kpi_opt_to_div(this.value)">
            <option value="0">Select KPI</option>
            @foreach ($kpi as $item)
                <option value="{{$item->id}}">{{$item->kpi}}</option>
            @endforeach
        </select>
    </div> 
    <div id="kpi_load">


    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
  </form>

  <br>

  <table class="table table-bordered table-striped">
    <thead>
      <th>Label</th>
      <th>KPI</th>
      <th>Formula</th>
      <th></th>
    </thead>
    @foreach ($kpieqs as $item)
    <tr>
      <td>{{$item->formula_label}}</td><td>{{$item->get_kpi_name()->kpi}}</td><td>{{$item->formula_string}}</td><td><a href="{{URL('admin/delete_data')}}?tbl=KpiCalculation&id={{$item->id}}"><i class="far fa-trash-alt"></i></a></td>
    </tr>  
    @endforeach
  </table>
</div>




<script>
    function load_kpi_opt_to_div(id){
        $('#kpi_load').load('kpi-option-load?kpi='+id);

    }
</script>

@endsection