@extends('layouts.admin')

@section('content')
<div class="span12 dcontent">
    {{ Form::open( array( 'url'=>'admin/usercredit')) }}

      <div class="control-group">
        <label class="control-label" for="rfrom">Select User :</label>
        <div class="controls">
           {{ Form::select('user_email', array(''=>"-- Select User --")+$users,Input::old('user_email'));}}
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="rto">Credit :</label>
        <div class="controls">
          <input type="text" name="credit" id="credit" value="{{ Input::old('credit') }}" placeholder="">
        </div>
      </div>

     <div class="form-actions">
          <button type="submit" class="btn btn-primary">Save</button>
      </div>

{{ Form::close() }}
 </div>
@stop