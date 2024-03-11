

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <style>
        body {
            display: grid;
            place-items: center;
        }

        main {
            margin-top: 250px;
        }
    </style>
</head>

<body class="pt-2" style="background-color: #204c2d;">
    <main class="d-flex align-items-center flex-column rounded-lg py-5" style="background-color: white; width: 90%; max-width: 600px; font-size: 14px;">
        <img class="rounded-circle " src="{{asset('assets/img/brand/logo.webp')}}" alt="york cafe logo" width="70" height="70">

        <div class="text-center mt-4">
            <h1 style="font-size: 26px; font-weight: bold;">Login Here</h1>
        </div>

        <form action="{{route('login')}}" method="POST" style="width: 70%; max-width: 350px;">
            @csrf
            <label for="emial" style="opacity: 0.6;">Email</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <label class="mt-3" for="password" style="opacity: 0.6;">Password</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password">

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <div class="d-flex justify-content-start mt-3">
                <button class="btn text-white" style="background-color: #204c2d; font-weight: bold;margin-right: 20px;">Login</button>
                @if (Route::has('password.request'))
                <a href="" style="padding-top: 8px;font-size: 15px;color: #204c2d;text-decoration: underline;">Forgot Your Password?</a>
                @endif
            </div>
        </form>

    </main>
</body>

</html>