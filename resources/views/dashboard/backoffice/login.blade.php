@extends('layouts.layout')

@section('content')
<style>
    body {
        margin: 0;
        padding: 0;
        overflow-x: hidden;
        font-family: sans-serif;
    }

    .login-container {
        min-height: 100vh;
        background: white;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 40px;
        position: relative;
        flex-wrap: wrap;
    }

    .login-left {
        flex: 1 1 500px;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 0px;
        position: relative;
        z-index: 3;
        margin-top: -285px;
    }

    .login-logo {
        height: auto;
        max-height: 320px;
        width: auto;
        max-width: 100%;
        margin-bottom: -80px;
    }

    .login-title {
        color: #e53949;
        font-weight: 700;
        font-size: 32px;
        margin-bottom: 30px;
        text-align: center;
    }

    .form-control-custom {
        background-color: #fce2e2;
        border: none;
        border-radius: 30px;
        padding: 15px 72px;
        width: 100%;
        max-width: 342px;
        font-size: 16px;
        margin-bottom: 18px;
    }

    .btn-custom {
        background-color: #e53949;
        color: white;
        padding: 15px 0;
        border-radius: 30px;
        border: none;
        width: 110%;
        max-width: 340px;
        font-weight: bold;
        font-size: 16px;
        position: relative;
        z-index: 2;
    }

    .bottom-half-circle {
        width: 303px;
        height: 149px;
        border-top: 7px solid #a10c1f;
        border-left: 0 solid transparent;
        border-right: 0 solid transparent;
        border-bottom: none;
        border-radius: 170px 170px 0 0;
        position: absolute;
        bottom: 0;
        left: 25%;
        transform: translateX(-74%);
        z-index: 2;
        background: white;
    }

    .login-right {
        flex: 2 1 600px;
        position: relative;
        display: flex;
        justify-content: center;
        align-items: flex-end;
        padding-bottom: 80px;
        z-index: 2;
        width: 100%;
    }

    .shoe-img {
        width: 100%;
        max-width: 1000px;
        margin-top: 0px;
        position: relative;
        z-index: 2;
        height: auto;
    }

    .input-group-custom {
        max-width: 342px;
        width: 100%;
        margin: 0 auto 18px auto;
        text-align: left;
    }

    .text-danger {
        display: block;
        font-size: 14px;
        margin-top: 5px;
    }


    /* Responsive Tweaks */
    @media (max-width: 1024px) {
        .login-container {
            flex-direction: column;
            align-items: center;
            padding: 30px 20px;
        }

        .login-left,
        .login-right {
            flex: 1 1 100%;
            max-width: 100%;
        }

        .login-logo {
            max-height: 240px;
            margin-bottom: -60px;
        }

        .shoe-img {
            max-width: 90%;
            margin-top: 100px;
            transform: scaleX(-1) rotate(25deg);
        }

        .bottom-half-circle {
            width: 200px;
            height: 100px;
            left: 50%;
            transform: translateX(-50%);
        }

    }

    @media (max-width: 600px) {
        .login-title {
            font-size: 24px;
        }

        .form-control-custom,
        .btn-custom {
            width: 90%;
            max-width: 100%;
        }

        .shoe-img {
            transform: scaleX(-1) rotate(20deg);
            margin-top: 60px;
        }

        .bottom-half-circle {
            width: 150px;
            height: 80px;
        }

        .circle-large-top-left {
            width: 80px;
            height: 80px;
            top: 3vh;
            left: 3vw;
        }
    }
</style>



<div class="login-container">
    <!-- LEFT SIDE -->
    <div class="login-left">
        <img src="{{ asset('image/shoepos-logo.png') }}" alt="Logo" class="login-logo">
        <h2 class="login-title">Log In to Your Account</h2>

        <form action="{{ route('backoffice.check') }}" method="post" autocomplete="off">
            @csrf

            @if (Session::get('fail'))
                <div class="alert alert-danger">{{ Session::get('fail') }}</div>
            @endif

            <div class="input-group-custom">
                <input type="text" name="email" placeholder="Email" class="form-control form-control-custom" value="{{ old('email') }}">
                <span class="text-danger">@error('email'){{ $message }}@enderror</span>
            </div>
            
            <div class="input-group-custom" style="position: relative;">
                <input type="password" name="password" placeholder="Password" class="form-control form-control-custom" id="password" value="{{ old('password') }}">
                <span id="toggle-password" style="
                    position: absolute;
                    right: 20px;
                    top: 40%;
                    transform: translateY(-50%);
                    cursor: pointer;
                    user-select: none;
                    font-size: 18px;
                    color: #555;
                ">👁</span>
                <span class="text-danger">@error('password'){{ $message }}@enderror</span>
            </div>
            
            <span class="text-danger">@error('password'){{ $message }}@enderror</span>          

            <div class="input-group-custom" style="margin-top: 10px;">
                <button type="submit" class="btn btn-custom">LOG IN</button>
            </div>
        </form>
    </div>

    <!-- RIGHT SIDE -->
    <div class="login-right">
        <!-- Large red circle top-left side of shoe -->
        <div class="red-circle circle-large-top-left"></div>

        <!-- Shoe image -->
        <img src="{{ asset('image/shoe-image.png') }}" alt="Shoes" class="shoe-img">

        <!-- 3 small circles under shoe image -->
        <div class="red-circle circle-bottom-1"></div>
        <div class="red-circle circle-bottom-2"></div>
        <div class="red-circle circle-bottom-3"></div>
    </div>

    <!-- Half circle at bottom of page -->
    <div class="bottom-half-circle"></div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const togglePassword = document.getElementById('toggle-password');
        const passwordInput = document.getElementById('password');

        togglePassword.addEventListener('click', function () {
            const isPassword = passwordInput.type === 'password';
            passwordInput.type = isPassword ? 'text' : 'password';
            this.textContent = isPassword ? '🚫' : '👁'; // toggle emoji
        });
    });
</script>

@endsection
