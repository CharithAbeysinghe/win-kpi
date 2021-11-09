@extends('layouts.app')



@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Department - HR</h1>
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
        <h3 class="card-title">
          <div class="form-inline d-flex justify-content-center">
            <div class="form-group mb-2">
              <label for="staticEmail2" class="sr-only">Date</label>
              <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="Year-Month">
            </div>
            <div class="form-group mx-sm-3 mb-2">
              <label for="inputPassword2" class="sr-only">Password</label>
              <input type="date" class="form-control" readonly id="inputPassword2" value="<?= date('Y-m-d'); ?>">
            </div>
        </div>
        </h3>
      </div>
    </div>

    <div class="card card-primary card-outline card-outline-tabs">
        <div class="card-header">
            <h3 class="card-title">
              
              Department HR
            </h3>
          </div>
        <div class="card-header p-0 border-bottom-0">
          <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
            @foreach ($kpi as $item)
            <li class="nav-item">
              <a class="nav-link" id="custom-tabs-four-home-tab{{$item->id}}" data-toggle="pill" href="#custom-tabs-four-home{{$item->id}}" role="tab" aria-controls="custom-tabs-four-home{{$item->id}}" aria-selected="true">{{$item->kpi}}</a>
            </li>
            @endforeach
          </ul>
        </div>
        <div class="card-body">
          <div class="tab-content" id="custom-tabs-four-tabContent">
            @foreach ($kpi as $items)
            <div class="tab-pane fade show" id="custom-tabs-four-home{{$items->id}}" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab{{$items->id}}">
                <div>
                  
                  
                  @foreach($items->get_options() as $option)
                
                  <div class="form-inline d-flex justify-content-center">
                    <div class="form-group mb-2">
                      <label for="staticEmail2" class="sr-only"></label>
                      <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="{{$option->kpi_option}}">
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                      <label for="inputPassword2" class="sr-only"></label>
                      <input type="password" class="form-control" id="inputPassword2" placeholder="">
                    </div>
                </div> 
                  @endforeach
                </div>
            </div>
            @endforeach
          </div>
        </div>
        <!-- /.card -->
      </div>

      <div class="card">
        <div class="card-header">
          <h3 class="card-title"></h3>
            <div class="row">
              <div  class="col-md-4"></div>
              <div class="col-md-2">
                <button type="button" class="btn btn-block btn-outline-warning btn-lg">Cancel</button>
              </div>
              <div class="col-md-2">
                <button type="button" class="btn btn-block btn-outline-success btn-lg">Submit</button>
              </div>
              <div  class="col-md-4"></div>
            </div>
          
        </div>
      </div>

</div>
@endsection