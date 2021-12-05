@extends('layouts.app')



@section('content')

  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Department - {{Auth::user()->get_user_department()->department}}</h1>
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
              <label for="staticEmail2" class="sr-only">Select Week</label>
              <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="Select Week">
            </div>
            <div class="form-group mx-sm-3 mb-2">
              <label for="inputPassword2" class="sr-only"></label>
              <select name="" id="">
                
              @foreach ($weeks as $item)
                  <option value="{{$item->id}}">{{$item->week_name}}</option>
              @endforeach
              
            </select>
            </div>
        </div>
        </h3>
      </div>
    </div>

    <div class="card card-primary card-outline card-outline-tabs">
        <div class="card-header">
            <h3 class="card-title">
              
              Department {{Auth::user()->get_user_department()->department}}
            </h3>
          </div>
        <div class="card-header p-0 border-bottom-0">
          <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
            @foreach ($kpi as $key=>$item)
              @if($key == 0)
              <li class="nav-item">
                <a class="nav-link active" id="custom-tabs-four-home-tab{{$item->id}}" data-toggle="pill" href="#custom-tabs-four-home{{$item->id}}" role="tab" aria-controls="custom-tabs-four-home{{$item->id}}" aria-selected="true">{{$item->kpi}}</a>
              </li>
            @else 
              <li class="nav-item">
                <a class="nav-link" id="custom-tabs-four-home-tab{{$item->id}}" data-toggle="pill" href="#custom-tabs-four-home{{$item->id}}" role="tab" aria-controls="custom-tabs-four-home{{$item->id}}" aria-selected="true">{{$item->kpi}}</a>
              </li>
            @endif
            @endforeach
          </ul>
        </div>
        <div class="card-body">
          <div class="tab-content" id="custom-tabs-four-tabContent">
            @foreach ($kpi as $key=>$items)
            <div class="tab-pane fade show @php echo ($key==0) ?  'active' : $key;  @endphp" id="custom-tabs-four-home{{$items->id}}" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab{{$items->id}}">
                <div>
                  
                  
                  @foreach($items->get_options() as $option)
                
                  <div class="form-inline d-flex justify-content-center">
                    <div class="form-group mb-2">
                      <label for="staticEmail2" class="sr-only"></label>
                      <input type="text" readonly class="form-control-plaintext" value="{{$option->kpi_option}}">
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                      <label for="inputPassword2" class="sr-only"></label>
                      <input type="test" class="form-control kpi_{{$items->id}}" id="opt_{{$items->id}}_{{$option->id}}"  onkeyup="calculate_kpi_data({{$items->id}})">
                    </div>
                </div> 
                  @endforeach
                </div>
                <hr>
                <div class=" mt-5">
                  @foreach($items->get_kpi_formulae() as $option)
                  <div class="form-inline d-flex justify-content-center">
                    <div class="form-group mb-2">
                      <label for="staticEmail2" class="sr-only"></label>
                      <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="{{$option->formula_label}}">
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                      <label for="inputPassword2" class="sr-only"></label>
                      <input type="test" class="form-control" id="inputPassword2" placeholder="" value="{{$option->formula_label}}">
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

<script>

  function calculate_kpi_data(kpi){

    var idArray = [];
    var idArrayData = [];
      $('.kpi_'+kpi).each(function () {
          idArray.push(this.id);
      });

      if(idArray.length > 0){
        for(var i=0;i<idArray.length;i++){

          var idobjata =    {
                          id   :idArray[i],
                          value:$('#'+idArray[i]).val()
                        }
          idArrayData.push(idobjata);
        }
      }


      console.log(idArrayData);



  }


   

</script>
@endsection