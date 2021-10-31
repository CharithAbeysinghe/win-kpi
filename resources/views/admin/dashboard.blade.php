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

    <div class="card card-primary card-outline card-outline-tabs">
        <div class="card-header">
            <h3 class="card-title">
              <i class="fas fa-exclamation-triangle"></i>
              Department HR
            </h3>
          </div>
        <div class="card-header p-0 border-bottom-0">
          <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Carder fulfilment</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Clocked hours</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill" href="#custom-tabs-four-messages" role="tab" aria-controls="custom-tabs-four-messages" aria-selected="false">Labour turnover</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill" href="#custom-tabs-four-settings" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="false">Absenteeism</a>
            </li>
          </ul>
        </div>
        <div class="card-body">
          <div class="tab-content" id="custom-tabs-four-tabContent">
            <div class="tab-pane fade active show" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                <div>
                    <div class="form-inline d-flex justify-content-center">
                        <div class="form-group mb-2">
                          <label for="staticEmail2" class="sr-only"></label>
                          <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="Requierd Carder">
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                          <label for="inputPassword2" class="sr-only">Password</label>
                          <input type="password" class="form-control" id="inputPassword2" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-inline d-flex justify-content-center">
                        <div class="form-group mb-2">
                          <label for="staticEmail2" class="sr-only">Email</label>
                          <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="Running(Average)">
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                          <label for="inputPassword2" class="sr-only">Password</label>
                          <input type="password" class="form-control" id="inputPassword2" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-inline d-flex justify-content-center">
                        <div class="form-group mb-2">
                          <label for="staticEmail2" class="sr-only">Email</label>
                          <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="Training school">
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                          <label for="inputPassword2" class="sr-only">Password</label>
                          <input type="password" class="form-control" id="inputPassword2" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-inline d-flex justify-content-center">
                        <div class="form-group mb-2">
                          <label for="staticEmail2" class="sr-only">Email</label>
                          <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="email@example.com">
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                          <label for="inputPassword2" class="sr-only">Password</label>
                          <input type="password" class="form-control" id="inputPassword2" placeholder="Password">
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
              sdsdsdsdsds
            </div>
            <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel" aria-labelledby="custom-tabs-four-messages-tab">
               Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue id mi placerat mollis. Vivamus faucibus eu massa eget condimentum. Fusce nec hendrerit sem, ac tristique nulla. Integer vestibulum orci odio. Cras nec augue ipsum. Suspendisse ut velit condimentum, mattis urna a, malesuada nunc. Curabitur eleifend facilisis velit finibus tristique. Nam vulputate, eros non luctus efficitur, ipsum odio volutpat massa, sit amet sollicitudin est libero sed ipsum. Nulla lacinia, ex vitae gravida fermentum, lectus ipsum gravida arcu, id fermentum metus arcu vel metus. Curabitur eget sem eu risus tincidunt eleifend ac ornare magna.
            </div>
            <div class="tab-pane fade" id="custom-tabs-four-settings" role="tabpanel" aria-labelledby="custom-tabs-four-settings-tab">
               Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis.
            </div>
          </div>
        </div>
        <!-- /.card -->
      </div>

</div>
@endsection