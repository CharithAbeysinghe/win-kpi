
<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<div class="card">
    <div class="card-header">
        <div class="form-group">
            <label for="header">{{$header}}</label>
            <form action="{{URL(''.$url.'')}}" method="POST">
                @csrf
                @include('form-component',[$form_component])
                <button type="submit" class="btn btn-primary mt-4">Submit</button>
            </form>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    @foreach ($th_array as $th)
                    <th>{{$th}}</th>
                    @endforeach
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data_array as $item)
                <tr>
                    @foreach ($td_array as $k=>$td)
                    <td>
                    @if($model == 'KpiOption' && $k == 0)
                    <span >{{$item->$td}}</span>
                    @else 
                    <span id="span_id_{{$item->id}}" ondblclick="get_input({{$item->id}})">{{$item->$td}}</span>
                    <input type="text" style="display: none" value="{{$item->$td}}" id="edit_{{$item->id}}" onfocusout="update_data('{{$model}}','{{$item->id}}',this.value)">  
                    @endif
                    </td>
                    @endforeach
                    <td><a href="{{URL('admin/delete_data')}}?tbl={{$model}}&id={{$item->id}}"><i class="far fa-trash-alt"></i></a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>
<script>
  $( document ).ready(function() {
    $("#example1").DataTable();
    // $("#example1").DataTable({
    //   "responsive": true, "lengthChange": false, "autoWidth": false,
    //   "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    // }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

   
  });

  function get_input(id){
      
      document.getElementById('edit_'+id).style.display = "block";
      document.getElementById('span_id_'+id).style.display = "none";

  }

  function update_data(model,id,vale){

    $('#kpi_id').empty();
        $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
            $.ajax({
               type:'get',
               url:'/admin/update_data',
               data:{
                 id:id,
                 tbl:model,
                 vale:vale,
               },

               success:function(data) {
                   
                $('#span_id_'+id).text(vale);
                document.getElementById('edit_'+id).style.display = "none";
                document.getElementById('span_id_'+id).style.display = "block";

               }
            });

  }

</script>