<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
        background-image: url({{asset('imageassets/bglogin.jpg')}});
        background-repeat: no-repeat;
        background-position: right top;
        background-attachment: fixed;
        align-items: center;
        background-size: cover;
    }
    form {border: 3px solid #41a29f;
        border-radius: 25px;
    	width: 350px;
	background: white;
	/*meletakkan form ke tengah*/
	margin: 5% auto;
	padding: 30px 20px;}
    
    input[type=text], input[type=password] {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
        border-radius: 10px;
    }
    
    button {
        background-color: #4aaa80;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
        border-radius: 10px;
    }
    
    button:hover {
        opacity: 0.8;
    }
    
    
    
    .imgcontainer {
        text-align: center;
        margin: 24px 0 12px 0;
    }
    
    img.avatar {
        width: 40%;
        border-radius: 50%;
    }
    
    .container {
        padding: 16px;
    }
    .invalid-feedback {
   
    width: 100%;
    margin-top: .25rem;
    font-size: 80%;
    color: #e3342f;
}
.form-group {
    margin-bottom: 1rem;
}
.is-invalid {
    border-color: #e3342f !important;
}
   
    
    /* Change styles for span and cancel button on extra small screens */
    @media screen and (max-width: 300px) {
        span.psw {
            display: block;
            float: none;
        }
        .cancelbtn {
            width: 100%;
        }
    }
</style>
</head>
<body>

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="imgcontainer">
        <img src="{{asset('imageassets/bklogo.png')}}" alt="Avatar" class="avatar">
        </div>

        <div class="container">
            <div class="form-group">
                    <label for="email"><b>{{ __('Username / Email ') }}</b></label>
                    <input id="email" class="{{ $errors->has('email') ? ' is-invalid' : '' }}" type="text" placeholder="Enter Username / Email" name="email" required autofocus>
                    @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
            </div>
        

        <label for="psw"><b>{{ __('Password') }}</b></label>
        <input id="password" class="{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" placeholder="Enter Password" name="password" required>
        @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
        <button type="submit">{{ __('Login') }}</button>
        <label>
            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
        </label>
        </div>

    </form>

</body>
</html>