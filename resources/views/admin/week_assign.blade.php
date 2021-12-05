@extends('layouts.app')



@section('content')
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
            <table class="table">
                <thead>
                    <th>Week No</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                </thead>
                <tbody>
                    @foreach ($weeks as $item)
                    <tr>
                        <td>{{$item->week_name}}</td>
                        <td>{{$item->start_date}}</td>
                        <td>{{$item->end_date}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
    </div> 

</div>

@endsection