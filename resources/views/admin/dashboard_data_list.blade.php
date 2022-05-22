<!-- jQuery -->
{{-- <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>  --}}
<div class="card-header">
   <div class="card-body">
      <table class="table table-bordered table-striped" id="example3">   
        <thead>
          <th>Week</th>
          <th>Department</th>
          <th>User</th>
          <th>Added Date</th>
          <th>View</th>
        </thead>
          <tbody>
       
              @foreach ($kpi_data as $item)

              <tr>
                <td>{{$item['week_name']}}</td>
                <td>{{$item['department_name']}}</td>
                <td>{{$item['user']}}</td>
                <td>{{$item['added_date']}}</td>
                <td><button onclick="loadKpiDetail({{$item['kpi_id']}})"> >> </button></td>
              </tr>
              @endforeach
          </tbody>
      </table>
   </div>
</div>

<!-- /.card -->
<script>
  $( document ).ready(function() {
    setTimeout(() => {
        $("#example3").DataTable();
    }, 100);
  });  

  function loadKpiDetail(kpi_id){
    window.location.href = "editdashboard?id="+kpi_id;
  }
</script>