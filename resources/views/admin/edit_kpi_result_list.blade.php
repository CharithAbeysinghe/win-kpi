@extends('layouts.app')



@section('content')
@include('flash-message')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Department</h1>
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
              <label for="staticEmail2" class="sr-only">Location</label>
              <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="Location">
            </div>
            <div class="form-group mx-sm-3 mb-2">
              <label for="inputPassword2" class="sr-only"></label>
              <select name="location_id" id="location_id" class="form-control">
                <option value="0">Select Location</option>
                @foreach ($locations as $location_item)
                    <option value="{{$location_item->id}}">{{$location_item->location}}</option>
                @endforeach
            </select>
            </div>
        </div>
          <div class="form-inline d-flex justify-content-center">
            <div class="form-group mb-2">
              <label for="staticEmail2" class="sr-only">Department</label>
              <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="Department">
            </div>
            <div class="form-group mx-sm-3 mb-2">
              <label for="inputPassword2" class="sr-only"></label>
              <select class="form-control" name="department_id" id="department_id" onchange="get_kpis(this.value)">
                <option value="0">--select--</option>
                @foreach ($departments as $items)
                <option value="{{$items->id}}">{{$items->department}}</option>
                @endforeach
            </select>
            </div>
        </div>
          <div class="form-inline d-flex justify-content-center">
            <div class="form-group mb-2">
              <label for="staticEmail2" class="sr-only">Week</label>
              <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="Week">
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

    <div class="card">
      <div class="card-header">
        <div class="card-body">
        <h3 class="card-title"></h3>
          
        
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
                var vl = (eval(tot)*100).toFixed(2);
              $('#total_val_'+kpi+'_'+eq).val(numberWithCommas(vl)+'%');
            }else{
              $('#total_val_'+kpi+'_'+eq).val(0 * 100);
            }
            

          }else{
            if (isFinite(eval(tot))) {
                var vl = eval(tot).toFixed(2);
              $('#total_val_'+kpi+'_'+eq).val(numberWithCommas(vl));
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
  
  function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}


   

</script>
@endsection