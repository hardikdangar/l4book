  <div id="recipient_address" style="display:none">
        <div class="recipient_address" id="recip_aid">
          <h3>Recipient's Address <span class="acount">- rone</span> </h3>
            {{ Form::text('add[zero][fullname]', '',array('placeholder' => 'Full Name* :', 'class'=>"required ")) }}
          {{ Form::textarea('add[zero][address_one]', '',array('placeholder' => 'Enter Recipient\'s Address here  * :', 'rows' => '8', 'class'=>"required ")) }}
      </div>
    </div>

<div id="popup"class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <button type="button" class="close " data-dismiss="modal" aria-hidden="true">×</button>
  <div class="modal-body">

        @if (Session::has('psuccess') )
          <div class="alert alert-success">
            {{ Session::get('psuccess') }}
          </div>
        @endif
        @if (Session::has('perror') )
          <div class="alert alert-error">
            {{ Session::get('perror') }}
          </div>
        @endif


    <div class="cfrom-wapper">
      <img src="{{ asset('img/create-form-flow.png') }}">

        @if(Cart::total_items()==0 && empty($foldagram_id))
          {{ Form::open( array('url' => URL::route('create'),'files'=>true )) }}
        @else
          {{ Form::open( array('url' => URL::route('edit'),'files'=>true )) }}
        @endif

        @if (!empty($foldagram_id))
          {{ Form::hidden('foldagram_id', $foldagram_id) }}
        @endif

        @if(Cart::total_items())
          <?php $cart_contents = Cart::contents();  ?>
          @foreach ($cart_contents as $item)
                <?php $rowid = $item['rowid']; ?>
                {{ Form::hidden('rowid', $item['rowid']) }}
                {{ Form::hidden('qty', $item['qty']) }}
                {{ Form::hidden('foldagram_id', $fid) }}
          @endforeach
        @endif




        <div class="setp1">
          <div class="message create-form">
            <?php $message = isset($foldagram_data) ? $foldagram_data->message : '';  ?>
            {{ Form::textarea('message', $message  ,array('rows' => '4', "class"=>"enter-message required",'placeholder' => 'Enter Your Message: *')) }}

            <br>You have <span id="charsLeft">1200</span> chars left.
            <div class="clear"></div>
            <div id="thumbnail">

                    @if(!empty($foldagram_data->image))
                        <img src="{{ asset('img/thumbnails/'.$foldagram_data->image) }}" alt="Foldgram thumbnail" >
                    @else
                      <img src="{{ URL::to('/') }}/img/placehold.gif">
                    @endif
            </div>
            <input type="file" style="display:none" id="upload-image" name="image"  class="required" >
            <div id="upload" class="drop-area">
              <span class="uploadfile">Upload File</span>
              <p class="help-block">Files must be less than <span>8 MB</span></p>
              <p class="help-block">Allowed file types: <span>png gif jpg jpeg</span></p>
            </div>
          </div>
        </div>
        <div class="address">
          <div class="alert alert-error"><a href="#" class="close" >×</a>Message Field Required and Upload Foldagram Image.</div>
          <div class="photocreate-form recipient_address_wapper">
            <!-- daynamic content  by jqueyr add more -->
          </div>

        </div>
        <div class="submit">
          <div class="submit-content">
            <button class="add btn-large btn" type="button">Add Another Address</button>
            <button class="remove btn-large btn" type="button" style="display: none;">Remove Address</button><br>
            <button class="submit-btn btn-large btn" type="submit">Save</button>
          </div>
        </div>
      {{ Form::close() }}
    </div>
  </div>
</div>