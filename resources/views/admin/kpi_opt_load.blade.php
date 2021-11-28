<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

<div class="row">
    <div class="col-md-7">
            <select class="select2" multiple="multiple" data-placeholder="Select a State" style="width: 100%;" onchange="make_formula()">
                @foreach ($kpiOption as $key=>$item)
                    <option value="{{$item->id}}">{{$item->kpi_option}}</option>
                @endforeach
              </select>
     
    </div>
    <div class="col-md-5 d-flex flex-column-center">
        <div id="formula_view" style="width:100%;background:#fff">

        </div>
    </div>
</div>

<script>
    $( document ).ready(function() {
        $('.select2').select2();
    });

    function make_formula(){
        
    }
</script>
  

