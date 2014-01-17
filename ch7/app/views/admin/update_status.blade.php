@extends('layouts.admin')
@section('content')
 <div class="span12 dcontent">
    {{ Form::open( array('to' =>'admin/update')); }}
         <input type="hidden" name="id" value="{{ $foldagram->id }}">
        <div class="control-group">
        <label class="control-label" for="rfrom">Message :</label>
        <div class="controls">
        <?php echo $foldagram->message; ?>
        </div>
      </div>

      <div class="control-group">
        <label class="control-label" for="rto">Picture :</label>
        <div class="controls">
          @if($foldagram->image!="")
            {{ HTML::image('img/thumbnails/'.$foldagram->image, "Foldagram Image", array('width'=>'100px')) }}
          @endif
        </div>
      </div>

      <div class="control-group">
        <label class="control-label" for="rto">Current Status :</label>
        <div class="controls">
          <?php $status = Config::get('app.status'); ?>
          <span class="label label-success"><?php echo  $status[$foldagram->status]; ?></span>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="rto">Change Status :</label>
        <div class="controls">
          {{ Form::select('status', array('0'=>'-- Select Status --')+Config::get('app.status'),$foldagram->status, array('class'=>'input-medium')) }}
        </div>
      </div>
     <div class="form-actions">
          <button type="submit" class="btn btn-primary">Save</button>
      </div>

  {{ Form::close() }}
</div>
@stop