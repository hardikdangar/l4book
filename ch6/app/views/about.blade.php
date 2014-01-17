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
	<div class="span7 about well">
		<h3>Where it all began...</h3>
		<p>	Everyone knows the internet provides a wonderful tool for quickly sharing thoughts and
			photos, but do you ever miss real mail?  You know, the physical stuff that shows up in
			your actual mailbox, something you can touch.  Postcards are nice, but they aren’t the
			same as opening an envelope.  Besides, people seem to toss them out or lose them because
			there’s no easy way to stand them up!
		</p>
		<p>	This is what led Jordan Bundy to create The Foldagram in 2012.  He was hiking in the
			Rocky Mountains near his home in Vail, CO, and wanted to share the beauty of the
			landscape.  It seemed like a waste to just put photos on Facebook, since they would get
			lost in the constant shuffle of updates.  The idea of making prints, writing messages,
			stuffing envelopes and going to the post office just seemed daunting.  And yet, what
			other option was there?
		</p>
		<p>	After several prototypes, The Foldagram was born.  Thanks to a successful Kickstarter
			campaign, you can send someone a unique piece of physical mail as easily as updating a
			blog.
		</p>
		<p>	If you have a media query, please contact Jordan at thefoldagram.com.  Otherwise, feel
			free to browse what’s already been written!
		</p>
	</div>
	<div class="span5 well">
		<h3>What's been said</h3>
		<span>Web Links</span>

		<p><a href="http://offbeathome.com/2012/10/the-foldagram">Offbeat Home</a></p>
		<p><a href="http://www.coloradocountrylife.com/index.php?option=com_content&view=article&id=1068:send-a-letter&catid=39:other-resources&Itemid=91">Colorado Country Life</a></p>

		<h4>Audio Clips</h4>

		<p><a href="http://www.youtube.com/watch?v=QT0POw0DFr8">The second interview with Ski Country</a></p>
		<p><a href="http://www.youtube.com/watch?v=MQlObuRkJrk">The first interview with Ski Country</a></p>
	</div>
</div>
@endsection
