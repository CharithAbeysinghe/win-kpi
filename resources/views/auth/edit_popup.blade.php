

<div class="row">
    <div class="col-md-6">
      <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" class="form-control" name="name" id="name" value="{{$getUser->name}}">
            <input type="hidden" class="form-control" name="u_id" id="u_id" value="{{$getUser->id}}">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">User Type</label>
            <select name="u_tp_id" id="u_tp_id" class="form-control">
                @foreach ($userType as $item_user_type)
                    
                    <option value="{{$item_user_type['id']}}" @if($getUser->u_tp_id == $item_user_type['id'])
                        
                      selected  @endif>{{$item_user_type['type']}}</option>
                    
                @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Email</label>
            <input type="email" class="form-control" value="{{$getUser->email}}" id="email" name="email" placeholder="email">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="enter new password">
          </div>
    </div>
    <div class="col-md-6">
      @if($getUser->u_tp_id != 1)
      <div class="form-group">
            <label for="exampleInputEmail1">Location</label>
            <select name="location_id" id="location_id" class="form-control">
                @foreach ($location as $item_location)
                    <option value="{{$item_location['id']}}" @if($getUser->location_id == $item_location['id'])
                        
                        selected  @endif>{{$item_location['location']}}</option>
                    
                @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Department</label>
            <select name="department_id" id="department_id" class="form-control">
                @foreach ($department as $item_department)
                    <option value="{{$item_department['id']}}" @if($getUser->department_id == $item_department['id'])
                        
                        selected  @endif>{{$item_department['department']}}</option>
                    
                @endforeach
            </select>
          </div>
      @endif
    </div>
</div>