@extends('layouts.default')

@section('inner-banner')
<div class="row-fluid inner-top">
  <div class="span6 inner-content">
    <h2>About</h2>
    <p>We have a great story, and we'd love to tell you about it.  By the way, did you watch the original Foldagram video on the front page?</p>
  </div>
  <img src="{{ URL::asset('img/inner-folder.png') }} ">
</div>
@stop

@section('content')
  <br>
    <div class="row price">
      <div class="span6 well price_content">
        <h3>Current Price</h3>
        <p>Foldagrams can either be purchased one at a time, or with credits. When you pay for credits in advance, you receive a discount. Don't worry, you don't have to use them all at once! The prices shown already include postage.</p>
        @if($credit)
          <ul>
          @foreach($credit as $value)
            <li>{{ $value->rfrom ." - ". $value->rto ." Foldagrams  -  $".$value->price." each" }}</li>
          @endforeach
          </ul>
        @endif
      </div>

	<div class="span6 well price_content">
        {{ Form::open( array ( 'url'=>'addtocredit','id'=>'creditform')) }}
        <h3>Purchase Credit</h3>
        <br/>

        {{ Form::label('qty', 'Foldagrams:') }}<br/>
        {{ Form::label('qty', 'Quantity ') }}
        {{ Form::text('qty', '1') }}&nbsp; &nbsp;
        {{ Form::label('price', 'Per Foldagram') }}
        {{ Form::text('price','', array('id'=>'price', 'readonly'=>'readonly')) }}&nbsp; &nbsp;
        {{ Form::label('total', 'Total') }}
        {{ Form::text('total', '', array('id'=>'total', 'readonly'=>'readonly')) }}
        <br/>
        <div class="well credit_card">
            <h3>Payment</h3>
            <div class="payment-errorme alert alert-error" style="display:none">
               <button type="button" class="close" data-dismiss="alert">&times;</button>
               <div class="payment-errors"></div>
            </div>
            {{ Form::label('credit_owner', 'Card Owner *') }}
            {{ Form::text('credit_owner', Input::old('credit_owner'), array('class'=>'required')) }}
            <p class="help-block">Enter credit card Owner.</p>

            {{ Form::label('credit_card', 'Card Number *') }}
            {{ Form::text('credit_number', Input::old('credit_number'), array('class'=>'card-number required')) }}
            <p class="help-block">Enter credit card number.</p>


            {{ Form::label('expiration', 'Expiration *') }}

              {{ Form::select('month', Config::get('app.month')  ,Input::old('month'),array("class"=>"span1 required card-expiry-month")) }}

              {{ Form::select('year', Config::get('app.year'),Input::old('year'),array("class"=>"span1 required card-expiry-year")) }}



            {{ Form::label('code', 'Security code *') }}
            {{ Form::text('code', Input::old('code'), array('class'=>'card-cvc required')) }}

            <p class="help-block">Enter security code.</p>

            <div class="payment-errors alert alert-error" style="display:none"></div>

          </div>
        <br/>
        {{ Form::submit('Buy Now',array("class"=>"btn-large ")) }}

        {{ Form::close(); }}
    </div>
  </div>

<script type="text/javascript">
 $(function () {

  $.ajax({
      type: "GET",
      url: 'price/'+$('#qty').val(),
  }).done(function( data ) {
    $('#price').val(data);
  });

 });


   $('#qty').change(function(e) {  // e=event
    //e.preventDefault();
    // attempt to GET the new content
    var qty = $(this).val();

    $.ajax({
        type: "GET",
        url: 'price/'+$('#qty').val(),
    }).done(function( data ) {
        $('#price').val(data);
        if(qty==''){
          $('#total').val(0);
        }else {
          $('#total').val(parseInt(qty)*parseFloat(data));
        }
    });

  });
 </script>
 <!-- stripe js -->

<script type="text/javascript" src="https://js.stripe.com/v1/"></script>
<script type="text/javascript">
    // this identifies your website in the createToken call below
    Stripe.setPublishableKey('pk_test_TWK6aAHhCWPMmya8XMCDhv4J');

    function stripeResponseHandler(status, response) {
        if (response.error) {
            // re-enable the submit button
            $('.submit-button').removeAttr("disabled");
            // show the errors on the form
            $(".payment-errors").html(response.error.message).show();
        } else {
            var form$ = $("#creditform");
            // token contains id, last4, and card type
            var token = response['id'];
            // insert the token into the form so it gets submitted to the server
            form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
            // and submit
            form$.get(0).submit();
        }
    }

    $(document).ready(function() {
        $("#creditform").submit(function(event) {
            // disable the submit button to prevent repeated clicks
            $('.submit-button').attr("disabled", "disabled");

            // createToken returns immediately - the supplied callback submits the form if there are no errors
            Stripe.createToken({
                number: $('.card-number').val(),
                cvc: $('.card-cvc').val(),
                exp_month: $('.card-expiry-month').val(),
                exp_year: $('.card-expiry-year').val()
            }, stripeResponseHandler);
            return false; // submit from callback
        });
    });
    </script>
@stop