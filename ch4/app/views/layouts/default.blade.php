<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>{{ $title }}</title>
	<meta name="viewport" content="width=device-width">
	<link href='//fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'>

	{{ HTML::style('css/bootstrap/css/bootstrap.min.css') }}
	{{ HTML::style('css/bootstrap/css/bootstrap-responsive.min.css') }}
	{{ HTML::script('css/bootstrap/js/jquery-1.9.1.min.js') }}
	{{ HTML::script('css/bootstrap/js/bootstrap.min.js') }}


	{{ HTML::style('css/jquery-ui-git.css') }}
	{{ HTML::style('css/flexslider.css') }}

	{{ HTML::script('js/jquery-ui-git.js') }}
	{{ HTML::script('js/jquery.limit.js') }}

	{{ HTML::script('js/jquery.flexslider.js') }}

	{{ HTML::script('js/global.js') }}


	{{ HTML::style('css/style.css') }}

	<script type="text/javascript">
		var base_url = '<?php echo URL::to("/"); ?>/';
		var total_item = 0;
	</script>

</head>
<body class = "{{ $class }}">
<div class="container">
     <div class="row-fluid header">
	  <div class="span4 logo">
	    <a href="{{ URL::to('/') }}"><img class="logo" src="{{ URL::asset('img/logo.png') }}" /></a>
	  </div>
	  <div class="span6 menu">
	      <ul>
	           <li><a href="#popup" data-toggle="modal">Create Foldagram</a></li>
	           <li>{{ link_to_route('pcredit', 'Purchase Credits') }}</li>
	           <li>{{ link_to_route('cart', 'Cart') }}</li>
	           <li>{{ link_to_route('contact', 'Contact') }}</li>
	           <li>{{ link_to_route('userlogin', 'Login') }}</li>
	           <li>{{ link_to_route('register', 'Register') }}</li>
	      </ul>
	    </div>
	    <div class="span2 social">
	          <a href="https://www.facebook.com/TheFoldagram" target="_blank"><img class="facebook" src="{{ URL::to('/') }}/img/img_trans.png" /></a>
	          <a href="https://twitter.com/thefoldagram" target="_blank"><img class="twit" src="{{ URL::to('/') }}/img/img_trans.png" /></a>
	          <a href="https://pinterest.com/thefoldagram/" target="_blank"><img class="ping" src="{{ URL::to('/') }}/img/img_trans.png" /></a>
	    </div>
	</div>

		@yield('inner-banner')

		<div class="row-fluid content">
			@yield('content')
		</div>



		<div class="row-fluid subcribe-form">

			@if ($errors->any())
			<div class="span6 alert alert-error">
			    <ul>
			        {{ implode('', $errors->all('<li class="error">:message</li>')) }}
			    </ul>
			</div>
			@endif

			<div class="span12 subscribe-content">
				<?php
					echo Form::open(array('url' => 'subscribe'));
					echo Form::label('something', 'Sign Up for Our Newsletter and Updates!');
					echo Form::text('email', null, array('class' => 'input-large', 'placeholder' => ''));
					echo Form::submit('Subscribe');
					echo Form::close();
				?>
			</div>

		</div>
<div class="row-fluid footer">
			<div class="span8 footer-menu">
				<ul>
					<li>{{ link_to_route('contact', 'Contact') }}</li>
					<li>{{ link_to_route('about', 'About Us') }}</li>
					<li>{{ link_to_route('login', 'Log In') }}</a></li>
					<li>{{ link_to_route('register', 'Register') }}</a></li>
				</ul>
			</div>
			<div class="span4 copyright">
					<h4>Foldagram is patent pending</h4>
					<p>&copy;Copyright All Encompassing Productions llc, 2012</p>
			</div>

		</div>
	</div><!-- End Container -->
	@include('foldagram')

</body>
</html>