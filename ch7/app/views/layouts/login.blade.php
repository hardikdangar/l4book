<!DOCTYPE html>
<html lang="en">
 <head>
        <meta charset="utf-8">
        <title>{{ $title }}</title>

    {{ HTML::style('css/bootstrap/css/bootstrap.min.css') }}
    {{ HTML::style('css/bootstrap/css/bootstrap-responsive.min.css') }}

    {{ HTML::style('admin/css/datepicker.css') }}
    {{ HTML::style('admin/css/timepicker.css') }}
    {{ HTML::style('admin/css/login.css') }}
    {{ HTML::style('admin/css/style.css') }}





    {{ HTML::script('css/bootstrap/js/jquery-1.9.1.min.js') }}
    {{ HTML::script('css/bootstrap/js/bootstrap.min.js') }}

</head>
<body class="body">
    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
        <div class="container">
            <a href="#" class="brand">The Foldagram</a>
            </div>
        </div>
    </div>
    <div class="container-fluid sr-container">
        <div class="row-fluid ">
            @if($errors->has())
            <div class="alert alert-error alert-block">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <h4>Error!</h4>
              <p>The following errors have occurred:</p>
              <ul id="form-errors">
                @foreach ($errors->all('<li>:message</li>') as $error)
                {{ $error }}
                @endforeach
                </ul>
            </div>
            @endif
        <div class="span12">
            <div class="content-container">
            {{ Form::open( array('to'=> 'admin/login')) }}
            <div class="container">
                <div class="content">
                    <div class="box login">
                    <fieldset class="boxBody">
                        <label>Email</label>
                        <input type="text" name="username" tabindex="1" value="{{ Input::old('username')}}" placeholder="">
                        <label>Password</label>
                        <input type="password" name="password" tabindex="2" placeholder="">
                    </fieldset>
                    <div class="footer">
                        <input type="submit" class="btn btn-large btn-inverse" value="Login" tabindex="3">
                    </div>
                    </div>
                </div>
            </div>
            {{Form::close()}}
        </div>
    </div>
</div>

</div>



</body>
</html>