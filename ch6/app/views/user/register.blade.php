@extends('layouts.user')

@section('inner-banner')
  <div class="row-fluid inner-top">
    <div class="span6 inner-content">
      <h2>{{ $page_title}}</h2>
      <p>So glad you're here.  I'm sure you know what to do.</p>
    </div>
    <img src="{{ URL::to('/') }}/img/inner-folder.png">
  </div>
@stop

@section('content')
 <div class="span12 dcontent">
     {{ Form::open( array('url'=>'register') ) }}
      <div class="control-group">
        <label class="control-label" for="first_name">First Name :</label>
        <div class="controls">
          <input type="text" name="first_name" class="input-xxlarge" id="first_name" value="{{ Input::old('first_name') }}" placeholder="">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="last_name">Last Name :</label>
        <div class="controls">
          <input type="text" name="last_name" class="input-xxlarge" id="last_name" value="{{ Input::old('last_name') }}" placeholder="">

        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="rto">Email * :</label>
        <div class="controls">
          <input type="text" name="email" class="input-xxlarge"  id="email" value="{{ Input::old('email') }}" placeholder="">

        </div>
      </div>
      <div class="control-group">
        <label class="control-label"  for="password">Password * :</label>
        <div class="controls">
          <input type="password" name="password" class="input-xxlarge" id="password" value="{{ Input::old('password') }}" placeholder="">

        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="password">Confirm Password * :</label>
        <div class="controls">
          <input type="password" name="password_confirmation" class="input-xxlarge" id="password_confirmation" value="{{ Input::old('password_confirmation') }}" placeholder="">

        </div>
      </div>

      <button type="submit" class="btn btn-large">Register</button>

{{ Form::close() }}
 </div>
@stop