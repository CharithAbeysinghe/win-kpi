@extends('layouts.app')



@section('content')
@include('flash-message')
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
<form action="{{URL('user/submit')}}" method="post">
  @csrf
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
              <select name="week_id" id="week_id" class="form-control" onchange="set_start_end(this.arr_end)">
                @foreach ($weeks as $item)
                    <option att_end="{{$item->end_date}}" att_st="{{$item->start_date}}" value="{{$item->id}}">{{$item->week_name}}</option>
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
              <input type="hidden" id="kpi_id_{{$items->id}}" name="kpi_id_{{$items->id}}" value="{{$items->id}}">  
              <div>
                  
                  @php 
                    $k=0;
                  @endphp
                  @foreach($items->get_options() as $option)
                
                  <div class="form-inline d-flex justify-content-center">
                    <div class="form-group mb-2">
                      <label for="staticEmail2" class="sr-only"></label>
                      <input type="text"  readonly class="form-control-plaintext" value="{{$option->kpi_option}}">
                      <input type="hidden" id="kpi_opt_id_{{$items->id}}_{{$k}}" name="kpi_opt_id_{{$items->id}}_{{$k}}"  value="{{$option->id}}">
                      <input type="hidden" id="id_kpi_opt_val_{{$items->id}}_{{$k}}" name="kpi_opt_id_{{$items->id}}_{{$k}}"  value="{{$option->id}}">
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                      <label for="inputPassword2" class="sr-only"></label>
                      <input type="text" name="kpi_opt_val_{{$items->id}}_{{$k}}" id="kpi_opt_val_{{$items->id}}_{{$k}}" class="form-control kpi_{{$items->id}}"   onkeyup="calculate_kpi_data({{$items->id}})">
                    </div>
                </div>      
                  @php 
                    $k++;
                  @endphp
                  @endforeach
                </div>
                <input type="hidden" name="kpi_opt_count_{{$items->id}}" value="{{$k}}">
                <hr>
                <div class=" mt-5">
                  @php $x=0; @endphp
                  @foreach($items->get_kpi_formulae() as $ky=>$option)

                  <div class="form-inline d-flex justify-content-center">
                    <div class="form-group mb-2">
                      <label for="staticEmail2" class="sr-only"></label>
                      <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="{{$option->formula_label}}">
                      <input type="hidden" name="kpi_eq_ids_{{$items->id}}_{{$x}}" class="form-control-plaintext" id="staticEmail2" value="{{$option->id}}">
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                      <label for="inputPassword2" class="sr-only"></label>
                      <input type="hidden" class="form-control" id="eq_id_{{$items->id}}_{{$x}}" placeholder="" value="{{$option->formula}}">
                      <input type="hidden" id="is_perce_{{$items->id}}_{{$x}}" value="{{$option->is_perce}}">
                      <input type="text" name = "total_val_{{$items->id}}_{{$x}}" id="total_val_{{$items->id}}_{{$x}}" class="form-control">
                    </div>
                </div>
                @php $x++; @endphp
                @endforeach
                <input type="hidden" name="kpi_eq_count_{{$items->id}}" id="kpi_eq_count_{{$items->id}}" value="{{$x}}">
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
                <button type="submit" class="btn btn-block btn-outline-success btn-lg">Submit</button>
              </div>
              <div  class="col-md-4"></div>
            </div>
          
        </div>
      </div>

</div>
</form>
<script>

  function calculate_kpi_data(kpi){

    var idArray = [];
    var idArrayData = [];
      $('.kpi_'+kpi).each(function () {
          idArray.push(this.id);
      });

      if(idArray.length > 0){
        for(var i=0;i<idArray.length;i++){

          var idobjata = {
                          option_id   :$('#id_'+idArray[i]).val(),
                          value:$('#'+idArray[i]).val()
                         }
          console.log(idobjata  );
          idArrayData.push(idobjata);
        }
      }


      // geteqs
      for(var eq = 0; eq<$('#kpi_eq_count_'+kpi).val();eq++){

        
          var eqa = $('#eq_id_'+kpi+'_'+eq).val();


          var nameArr = eqa.split(',');
          var tot = "";
          for(var t=0;t<nameArr.length;t++){
            if(!isNaN(nameArr[t])){
              tot = tot + parseFloat(get_option_val(idArrayData,nameArr[t]));
            }else{
              tot += nameArr[t];
            }
           
          }

          if($('#is_perce_'+kpi+'_'+eq).val() == 'on'){

            if (isFinite(eval(tot))) {
              $('#total_val_'+kpi+'_'+eq).val(eval(tot) * 100);
            }else{
              $('#total_val_'+kpi+'_'+eq).val(0 * 100);
            }
            

          }else{
            if (isFinite(eval(tot))) {
              $('#total_val_'+kpi+'_'+eq).val(eval(tot));
            }else{
              $('#total_val_'+kpi+'_'+eq).val(0);
            }
            
            
          }

      }

  }

  function get_option_val(idArrayData,opt){

    for(var q=0;q<idArrayData.length;q++){
              if(idArrayData[q].option_id == opt && !isNaN(opt)){
  
                if(idArrayData[q].value != ""){
                  return idArrayData[q].value;
                }else{
                  return 0;
                }
               
              }

    }
  }

  function set_start_end(id){
    // alert(id);
  }


   

</script>
@endsection