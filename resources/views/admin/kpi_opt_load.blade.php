<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

<div class="row">
    <div class="col-md-3">
        
        <div id="formula_view" style="width:100%;background:#fff">
                @foreach ($kpiOption as $key=>$item)
                <div class="row p-1">
                    <button style="width:100%" type="button" id="{{$item->id}}" onclick="add_value(this.id,'{{$item->kpi_option}}')">{{$item->kpi_option}} ({{$item->id}})</button>
                </div>
                @endforeach
        </div>
    </div>
    <div class="col-md-3">
            <div class="row">
                <a class="btn btn-app" onclick="add_value('','+')"><i class="fas fa-plus"></i> </a>
                <a class="btn btn-app" onclick="add_value('','-')"><i class="fas fa-minus"></i> </a>
                <a class="btn btn-app" onclick="add_value('','/')"><i class="fas fa-divide"></i> </a>
                <a class="btn btn-app" onclick="add_value('','*')"><i class="fas fa-times"></i> </a>
                <a class="btn btn-app" onclick="add_value('','(')"><i class="fas fa-left-bracket"></i><h3><b>(</b></h3></a>
                <a class="btn btn-app" onclick="add_value('',')')"><i class="fas fa-right-bracket"></i> <h3><b>)</b></h3></a>
            </div>

    </div>
    <div class="col-md-6">
       
        <div id="formula_view" class=" d-flex flex-column-center" style="width:100%;background:#fff">
            <h2> = <div id="formular_id"></div>
            <input type="hidden" id="real_form" name="real_form"></h2>
            <input type="hidden" id="real_form_value" name="real_form_value"></h2>
        </div>
        Percentage : <input type="checkbox" name="is_perce" id="">
    </div>
</div>

<script>
    $( document ).ready(function() {
        $('.select2').select2();
    });

    function make_formula(){
        
    }
    var arr = [];
    function add_value(id,valu){
        var obj = {
            'id':id,
            'value':valu
        }
        arr.push(obj);  
        draw_fromula(arr)
    }
    
    function draw_fromula(arr){
        let form = "";
        let form_value = "";

        $('#formular_id').empty();

        arr.forEach((link,index) => {
            var apn = "";
            if(link['id'] == ''){
                form += link['value']+',';
                apn = link['value'];
            }else{
                form += link['id']+',';
                apn = link['id'];
            }

            form_value += link['value'];
            $('#formular_id').append('<a href="#" class="badge badge-pill badge-primary" id="atr'+'_'+index+'" >'+apn+'<span class="badge bg-info" onclick="delete_index('+index+')">X</span></a>');

            $('#real_form').val(form);
            $('#real_form_value').val(form_value);

            // test(form)
        });
    }

    function delete_index(index){
        
        if (index > -1) {
            arr.splice(index, 1);
        }

        draw_fromula(arr);
    }

    // function test(s) {
    //     const re = /\d+\.?\d*(?:e[+-]?\d+)?/;
    //     console.log("%s is valid? %s", s, re.test(s));
    // }
</script>
  

