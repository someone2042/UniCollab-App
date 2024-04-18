<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
  @vite('resources/css/app.css')
  <link rel="stylesheet" href="{{asset('loginstyle.css')}}" />
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link href="{{asset('img/logo.png')}}" rel="icon">
  <title>Sign in & Sign up Form</title>
</head>

<body>
  <div class="container">
    <div class="forms-container">
      <div class="signin-signup">
        <form action="/users/authenticate" method="POST" class="sign-in-form">
          @csrf
          <h2 class="title">Sign in</h2>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="email" placeholder="Email" name="email" value="{{old('email')}}" />
          </div>
          @error('email')
          <p class="text-red-500 test-xs mt-1">{{$message}}</p>
          @enderror
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Password" name="password" value="{{old('password')}}" />
          </div>
          @error('password')
          <p class="text-red-500 test-xs mt-1">{{$message}}</p>
          @enderror
          <input type="submit" value="Login" class="btn solid" />
        </form>
        <form action="/users" method="POST" class="sign-up-form">
          @csrf
          <h2 class="title">Sign up</h2>
          <div class="input-field">
            <i class="fas fa-user"></i>
            <input type="text" name="name" placeholder="Username" value="{{old('name')}}" />
            @error('name')
            <p class="text-red-500 text-xs w-80 mt-1">{{$message}} </p>
            @enderror
          </div>
          <div class="input-field">
            <i class="fas fa-envelope"></i>
            <input type="email" name="email" placeholder="Email" value="{{old('email')}}" />
            @error('email')
            <p class="text-red-500 text-xs w-80 mt-1">{{$message}} </p>
            @enderror
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" placeholder="Password" />
            @error('password')
            <p class="text-red-500 text-xs w-80 mt-1">{{$message}} </p>
            @enderror
          </div>
          <div class="input-field">
            <i class="fas fa-lock"></i>
            <input type="password" name="password_confirmation" placeholder="confirm password" />
            @error('password_confirmation')
            <p class="text-red-500 text-xs w-80 mt-1">{{$message}} </p>
            @enderror
          </div>
          <input type="submit" class="btn" value="Sign up" />
        </form>
      </div>
    </div>

    <div class="panels-container">
      <div class="panel left-panel">
        <div class="content">
          <h3>New here ?</h3>
          <p>
            New to our site? Welcome! If you're ready to get started, you can sign up now to unlock all the benefits of being a member of our community.
          </p>
          <button class="btn transparent" id="sign-up-btn">
            Sign up
          </button>
        </div>
        <img src="img/log.svg" class="image" alt="" />
      </div>
      <div class="panel right-panel">
        <div class="content">
          <h3>One of us ?</h3>
          <p>
            If you've already created an account with us, simply sign in below to access your account and explore our features.
          </p>
          <button class="btn transparent" id="sign-in-btn">
            Sign in
          </button>
        </div>
        <img src="img/register.svg" class="image" alt="" />
      </div>
    </div>
  </div>

  <script src="{{asset('loginapp.js')}}"></script>
</body>

</html>