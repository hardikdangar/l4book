@extends('layouts.admin')

@section('content')
 <div class="span12 dcontent">
    {{ Form::open( array('to' =>'admin/editcredit')) }}
    <input type="hidden" name="id" value="{{ $credit->id }}">
         <div class="control-group">
        <label class="control-label" for="rfrom">Form Qty :</label>
        <div class="controls">
          <input type="text" name="rfrom" id="rfrom" value="{{ $credit->rfrom }}" placeholder="Form Qty">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="rto">To Qty :</label>
        <div class="controls">
          <input type="text" name="rto" id="rto" value="{{ $credit->rto }}" placeholder="To Qty">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="inputEmail">Price :</label>
        <div class="controls">
          <input type="text" name="price" id="price" value="{{ $credit->price }}" placeholder="Price">
        </div>
      </div>

     <div class="form-actions">
          <button type="submit" class="btn btn-primary">Update</button>
      </div>

</form>
 </div>
@endsection