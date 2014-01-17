@extends('layouts.user')


@section('content')
 <div class="span12 dcontent">
     <div class="tabbable">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#tab1" data-toggle="tab">My Profile</a></li>
          <li><a href="#tab2" data-toggle="tab">Change Password</a></li>
          <li><a href="#tab3" data-toggle="tab">My Orders</a></li>
        </ul>
      <div class="tab-content">

      <!-- My account tab start -->
      <div class="tab-pane active" id="tab1">
        {{ Form::open( array( 'url' => 'myaccount/profile') ); }}
      <div class="control-group">
        <label class="control-label" for="first_name">First Name :</label>
        <div class="controls">
          <input type="text" name="first_name" id="first_name" value="{{ $user->first_name }}" placeholder="">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="last_name">Last Name :</label>
        <div class="controls">
          <input type="text" name="last_name" id="last_name" value="{{ $user->last_name }}" placeholder="">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="rto">Email :</label>
        <div class="controls">
          <input type="text" name="email" id="email" value="{{ $user['email'] }}" placeholder="">
        </div>
      </div>

      <div class="form-actions">
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
      {{ Form::close() }}
      </div>
      <!-- My account tab close -->

      <!-- Change Password start -->
        <div class="tab-pane" id="tab2">
           {{ Form::open( array('url' => 'myaccount/changepassword') ); }}
             <div class="control-group">
                <label class="control-label" for="old_password">Old Password :</label>
                <div class="controls">
                  <input type="password" name="old_password" id="old_password" value="" placeholder="">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="password">New Password :</label>
                <div class="controls">
                  <input type="password" name="password" id="password" value="{{ Input::old('password') }}" placeholder="">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label" for="password">Confirm New Password :</label>
                <div class="controls">
                  <input type="password" name="password_confirmation" id="password_confirmation" value="{{ Input::old('password_confirmation') }}" placeholder="">
                </div>
              </div>
             <div class="form-actions">
                  <button type="submit" class="btn btn-primary">Save</button>
              </div>
          {{ Form::close() }}
        </div>
      <!-- Change Password close -->


      <!-- My Orders start -->
<div class="tab-pane" id="tab3">
  <h3>My Order</h3>
  <table class="table table-striped table-bordered table-condensed ">
    <thead>
        <tr>
            <th>Message</th>
            <th>Picture</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @if(!empty($orders))
            @foreach($orders as $value)
                <tr>
                    <td>{{ $value->message }}</td>
                    <td>@if($value->image!="")

                            @if(File::exists(public_path().'img/thumbnails/'.$value->image))
                              {{ HTML::image('img/thumbnails/'.$value->image, "Foldagram Image", array('width'=>'100px')) }}
                            @endif
                        @endif

                         </td>
                     <td> <?php $status = Config::get('app.status'); ?>
                        @if($value->status=='1')
                             <span class="label label-important">{{ $status[$value->status] }} </span>
                        @elseif ($value->status=='2')
                             <span class="label label-success">{{ $status[$value->status] }} </span>
                        @elseif ($value->status=='3')
                             <span class="label">{{ $status[$value->status] }} </span>
                        @elseif ($value->status=='4')

                             <span class="label label-warning">{{ $status[$value->status] }} </span>
                        @elseif ($value->status=='5')

                             <span class="label label-success">{{ $status[$value->status] }} </span>
                        @elseif ($value->status=='6')

                             <span class="label label-success">{{ $status[$value->status] }} </span>
                        @elseif ($value->status=='7')

                            <span class="label label-success">{{ $status[$value->status] }} </span>
                        @endif
                        </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="3" class="sr-align-center" style="text-align: center">No Orders!</td>
            </tr>
        @endif
    </tbody>
</table>

<h3>My Purchase Credit</h3>
 <table class="table table-striped table-bordered table-condensed">
    <thead>
        <tr>
           <th>Transection ID</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Total</th>
            <th>Status</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        @if(!empty($pcredit))
            @foreach($pcredit as $value)
                <tr>
                    <td>{{ $value->transection_id }}</td>
                    <td>{{ $value->qty }}</td>
                    <td>{{ $value->price }}</td>
                    <td>{{ ($value->qty * $value->price) }}</td>


                    <td>
                        @if($value->status=='0')
                             <span class="label label-important">Not completed</span>
                        @elseif ($value->status=='1')
                           <span class="label label-success">Completed</span>
                        @endif
                        </td>
                      <td>{{ $value->created_at }}</td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="6" class="sr-align-center" style="text-align: center">No Credits</td>
            </tr>
        @endif
    </tbody>
</table>


</div>

      <!-- My Orders close -->


     </div>

     </div>

</div>

@stop
