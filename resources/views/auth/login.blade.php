<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('gnams.png') }}" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('gna/gna.css') }}">
    <title>GNA-Login</title>
</head>
<body style="background-color: #dee2e6">
    <div class="login">
        <div class="gna-title">
            <img src="{{ asset('gnams.png') }}" alt="gna" style="width: 13%;"><br>
            <h4 class="fw-semibold" style="line-height: 1.6">LOGIN GNA</h4>
        </div>
        <hr>
        <form class="needs-validation" action="{{ route('login.auth') }}" method="POST" novalidate>
            @csrf
            @error('error')
                <div class="form-error mb-2">
                    <span>{{ $errors->first('error') }}</span>
                </div>
            @enderror
            <div class="mb-2">
                <label for="nik" class="form-label">NIK</label>
                <input type="text" class="form-control form-control-sm {{ $errors->has('nik') ? 'is-invalid' : '' }}" name="nik" id="nik" placeholder="XN12345" value="{{ old('nik') }}">
                @error('nik')<span>{{ $errors->first('nik') }}</span>@enderror
            </div>
            <div class="mb-2">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control form-control-sm {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" id="password">
                @error('password')<span>{{ $errors->first('password') }}</span>@enderror
            </div>
            <div class="form-check pointer">
                <input class="form-check-input" type="checkbox" id="showPassCheck" style="border-width: 2px;">
                <label class="form-check-label" for="showPassCheck">
                    Show Password
                </label>
            </div>
            <hr>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-success btn-sm">Login</button>
            </div>
        </form>
    </div>
    
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('gna/gna.js') }}"></script>

    <script>
        const showPassCheck = document.getElementById('showPassCheck')
        const password = document.getElementById('password')
        const nik = document.getElementById('nik')

        showPassCheck.onchange = function () {
            if (this.checked) {
                password.setAttribute('type', 'text')
            } else {
                password.setAttribute('type', 'password')
            }
        }
    </script>
</body>
</html>