@foreach ($form_component as $item)

@if ($item['ht_type'] == 'input')
<input type="text" name="{{$item['name']}}" class="form-control mt-4">
@endif

@if ($item['ht_type'] == 'select')
@php 
$value = $item['array_opt']['value'];
$opt = $item['array_opt']['opt'];
@endphp
<select name="{{$item['name']}}" class="form-control mt-4">
  <option value="0">{{$item['select_title']}}</option>
  @foreach ($item['array'] as $item_data)
            <option value="{{$item_data->$value}}">{{$item_data->$opt}}</option>
  @endforeach
</select>
@endif

@endforeach
