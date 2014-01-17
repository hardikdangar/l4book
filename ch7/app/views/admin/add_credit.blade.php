@extends('layouts.admin')

@section('content')
{{ Form::open( array('to' =>'admin/update')); }}
     <div class="control-group">
    <label class="control-label" for="rfrom">Form Qty :</label>
    <div class="controls">
      <input type="text" name="rfrom" id="rfrom" value="{{ Input::old('rfrom') }}" placeholder="Form Qty">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="rto">To Qty :</label>
    <div class="controls">
      <input type="text" name="rto" id="rto" value="{{ Input::old('rto') }}" placeholder="To Qty">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputEmail">Price :</label>
    <div class="controls">
      <input type="text" name="price" id="price" value="{{ Input::old('price') }}" placeholder="Price">
    </div>
  </div>

 <div class="form-actions">
      <button type="submit" class="btn btn-primary">Save</button>
  </div>

{{ Form::close() }}
@stop