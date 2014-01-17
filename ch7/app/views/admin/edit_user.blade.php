@extends('layouts.admin')
@section('content')
 <div class="span12 dcontent">
    {{ Form::open( array('to' =>'users/edituser')); }}
        <input type="hidden" name="id" value="{{ $user['id'] }}">
        <div class="control-group">
        <label class="control-label" for="rfrom">User Credit :</label>
        <div class="controls">
          {{ $user->credit }}
        </div>
      </div>
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
        <label class="control-label" for="password">Password :</label>
        <div class="controls">
          <input type="text" name="password" id="password" value="" placeholder="">
        </div>
      </div>

     <div class="form-actions">
          <button type="submit" class="btn btn-primary">Save</button>
      </div>
{{ Form::close() }}
 </div>
@stop