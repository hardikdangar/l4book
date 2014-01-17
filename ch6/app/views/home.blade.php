@extends('layouts.default')

@section('content')
        <div class="row-fluid slider-content">
            <div class="span12 slider">
             	<div class="flexslider">
				  <ul class="slides">
				    <li class="da-slider">
				     <div class="da-slide row">
				    		<div class="span5">
				     <h2>New Visitors: Welcome!</h2>
						<p>Thank you for visiting the Foldagram!  As you explore the site and create your Foldagram,
!</p>
						<a href="#popup" data-toggle="modal" class="da-link create">Click Here to Get Started!</a>
	                    <a href="#video" class="da-link video" data-toggle="modal">See the Foldagram Video!</a>
	                </div>
						<div class="da-img span7"><img src="img/slide3.png" alt="image01" /></div>
					  </div>
				    </li>
				    <li>
				      <div class="da-slide row">
				    		<div class="span5">
				     <h2>Send from anywhere on Earth.</h2>
						<p>Wether you're travelling in South America, China, or your own neighborhood, Foldagrams are always</p>
						<a href="#popup" data-toggle="modal" class="da-link create">Click Here to Get Started!</a>
	                    <a href="#video" class="da-link video" data-toggle="modal">See the Foldagram Video!</a>
	                </div>
						<div class="da-img span7"><img src="img/slide2.png" alt="image01" /></div>
					  </div>
				    </li>

				  </ul>
				</div>

            </div>
</div>

		<div class="row-fluid fguid">
			<div class="span4 you-click">
				<h2>You Click</h2>
				<img src="img/photo.png">
				<ul>
					<li>Upload a photo and write a message</li>
					<li>Fill out the addresses</li>
					<li>Buy one at a time or start an account</li>
				</ul>
			</div>
			<div class="span4 we-send">
				<h2>We Send</h2>
				<img src="img/fly.png">
				<ul>
					<li>Your custom Foldagram is printed</li>
					<li>We stamp it for you</li>
					<li>Foldagrams are mailed weekdays at noon</li>
				</ul>
			</div>
			<div class="span4 they-fold">
				<h2>They Fold</h2>
				<img src="img/mail.png">
				<ul>
					<li>Open the Foldagram</li>
					<li>Fold into standing position</li>
					<li>Skip the fridge magnets and picture frames!</li>
				</ul>
			</div>
		</div>
@stop