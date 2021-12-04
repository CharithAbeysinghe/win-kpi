
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
                    @foreach ($td_array as $td)
                    <td>

                        {{$item->$td}}
                    
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
