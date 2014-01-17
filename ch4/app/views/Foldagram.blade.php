<div id="popup"class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <button type="button" class="close " data-dismiss="modal" aria-hidden="true">×</button>
  <div class="modal-body">
    <div class="cfrom-wapper">
      <img src="{{ asset('img/create-form-flow.png') }}">

      {{ Form::open( array('url' => URL::route('create') )) }}

        <div class="setp1">
          <div class="message create-form">
            <textarea rows="4" class="enter-message required" placeholder="Enter Your Message: *" name="message" cols="50"></textarea>
            <br>You have <span id="charsLeft">1200</span> chars left.
            <div class="clear"></div>
            <div id="thumbnail">
              <img src="{{ asset('img/placehold.gif') }}">
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
          <div class="alert alert-error" style="display: none;"><a href="#" class="close">×</a>Message Field Required and Upload Foldagram Image.</div>
          <div class="photocreate-form recipient_address_wapper">
            <!-- daynamic content  by jqueyr add more -->
            <div class="recipient_address" id="recip_1">
              <h3>Recipient's Address <span class="acount" style="display: none;">- 1</span> </h3>
              <input placeholder="Full Name* :" class="required " type="text" name="add[0][fullname]" value="">
              <textarea placeholder="Enter Recipient's Address here  * :" rows="8" class="required " name="add[0][address_one]" cols="50"></textarea>
            </div>
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