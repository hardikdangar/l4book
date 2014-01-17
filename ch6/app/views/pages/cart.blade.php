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
<div class="span12 dcontent">

{{ Form::open(array('url' => '/checkout','id'=>'cart')) }}

<div class="well">
<table class="table table-hover table-striped table-bordered">
  <thead>
    <tr>
      <th width="40%">Name</th>
      <th width="8%">Qty.</th>
      <th width="12%">Price</th>
      <th width="12%">Total</th>
    </tr>
  </thead>
  <tbody>
    @foreach  ($cart_contents as $item)
    <tr>
      <td> {{ Form::hidden('foldagram_id', $item['options']['id']) }}

        <?php $foldagram_id = $item['options']['id']; ?>

        <strong>{{ $item['name'] }}</a></strong>
        <span class="pull-right">
          <a href="{{ URL::to('cart/remove/' . $item['rowid'].'/'.$foldagram_id) }}" rel="tooltip" title="Remove the product" class="btn btn-mini btn-danger"><i class="icon icon-white icon-remove"></i></a>

        </span>

      </td>
      <td>
          {{ $item['qty'] }}
      </td>
      <td>{{ number_format($item['price']) }}</td>
      <td>{{ number_format($item['subtotal']) }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>

  @if(!Sentry::check())
    <div class="well">
    <h3>Account information</h3>
      {{ Form::label('email_address', 'E-mail address *') }}
      {{ Form::text('email', Input::old('email'), array("class"=>"required")) }}
    </div>
  @endif

<div class="well">
  <h3> Billing information </h3>
  <label for="fullname"> Full Name * </label>
  <input class="required input-xxlarge" type="text" name="fullname" id="fullname">

  <label for="country"> Country * </label>
  <input class="required input-xlarge" type="text" name="country" id="country">

  <label for="address_one">Address 1 *</label>
  <input class="required input-xxlarge" type="text" name="address_one" id="address_one">

  <label for="address_two"> Address 2 </label>
  <input class="input-xxlarge" type="text" name="address_two" id="address_two">

  <label for="city"> City * </label>
  <input class="required input-xlarge" type="text" name="city" id="city">

  <label for="state"> State * </label>
  <input class="required input-xlarge" type="text" name="state" id="state">

  <label for="zipcode"> Zip code * </label>
  <input class="required input-xlarge" type="text" name="zipcode" id="zipcode">

  <input type="hidden" name="action" value="foldagram_checkout">
</div>

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



  <button type="submit" id="checkout" name="checkout" value="1" class="btn btn-info">Submit</button>
{{ Form::close() }}
</div>


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
            var form$ = $("#cart");
            // token contains id, last4, and card type
            var token = response['id'];
            // insert the token into the form so it gets submitted to the server
            form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
            // and submit
            form$.get(0).submit();
        }
    }

    $(document).ready(function() {
        $("#cart").submit(function(event) {
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