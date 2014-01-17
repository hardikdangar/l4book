@extends('layouts.admin')
@section('content')
{{ Form::open( array( 'url' => 'users/adduser'))  }}
  <div class="control-group">
    <label class="control-label" for="first_name">First Name :</label>
    <div class="controls">
      <input type="text" name="first_name" id="first_name" value="{{ Input::old('first_name') }}" placeholder="">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="last_name">Last Name :</label>
    <div class="controls">
      <input type="text" name="last_name" id="last_name" value="{{ Input::old('last_name') }}" placeholder="">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="rto">Email :</label>
    <div class="controls">
      <input type="text" name="email" id="email" value="{{ Input::old('email') }}" placeholder="">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="password">Password :</label>
    <div class="controls">
      <input type="password" name="password" id="password" value="{{ Input::old('password') }}" placeholder="">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="password">Confirm Password :</label>
    <div class="controls">
      <input type="password" name="password_confirmation" id="password_confirmation" value="{{ Input::old('password_confirmation') }}" placeholder="">
    </div>
  </div>
<div class="form-actions">
      <button type="submit" class="btn btn-primary">Save</button>

  </div>
{{ Form::close() }}
@stop