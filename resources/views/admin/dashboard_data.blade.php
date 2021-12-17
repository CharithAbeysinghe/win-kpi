<div class="card-header">
   
      <table>
       

    @foreach ($kpi_data as $item)
    <tr style="background: red">
      <td>{{$item['department']}}</td>
      <td>{{$item['week']}}</td>
      <td></td>
      <td></td>
    </tr>
      @foreach ($item['kpi_data'] as $item_opt)
        <tr>
          <td>{{$item_opt['id']}}</td>
          <td>{{$item_opt['kpi_id']}}</td>
          <td></td>
          <td></td>
        </tr>
      @endforeach
      @foreach ($item['kpi_total'] as $item_opt_tot)
        <tr>
          <td>{{$item_opt_tot['id']}}</td>
          <td>{{$item_opt_tot['amount']}}</td>
          <td></td>
          <td></td>
        </tr>
      @endforeach
    @endforeach
  </table>
  </div>

<!-- /.card -->