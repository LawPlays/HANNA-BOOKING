<x-guest-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@500;700&display=swap');

        body {
            font-family: 'Quicksand', sans-serif;
            background: linear-gradient(135deg, #fce4ec, #f3e5f5);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            color: #6a1b9a;
        }

        form {
            background-color: #fff0f6;
            padding: 2.5rem;
            border-radius: 1.5rem;
            box-shadow: 0 8px 24px rgba(174, 66, 212, 0.15);
            width: 100%;
            max-width: 420px;
            border: 2px solid #f8bbd0;
        }

        label {
            display: block;
            margin-bottom: 0.4rem;
            font-weight: 700;
            color: #ad1457;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 0.75rem 1rem;
            margin-bottom: 1.25rem;
            background-color: #fce4ec;
            color: #6a1b9a;
            border: 1.5px solid #e1bee7;
            border-radius: 0.8rem;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        input:focus {
            border-color: #ba68c8;
            box-shadow: 0 0 8px rgba(186, 104, 200, 0.4);
            outline: none;
        }

        .error {
            color: #d32f2f;
            font-size: 0.85rem;
            margin-top: -1rem;
            margin-bottom: 1rem;
        }

        .form-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1rem;
        }

        .form-footer a {
            font-size: 0.9rem;
            color: #8e24aa;
            text-decoration: none;
            font-weight: 500;
        }

        .form-footer a:hover {
            color: #6a1b9a;
            text-decoration: underline;
        }

        button {
            background: linear-gradient(to right, #f48fb1, #ce93d8);
            color: white;
            padding: 0.7rem 1.5rem;
            border: none;
            border-radius: 1rem;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(174, 66, 212, 0.2);
            transition: all 0.3s ease;
        }

        button:hover {
            background: linear-gradient(to right, #ec407a, #ba68c8);
            transform: scale(1.03);
            box-shadow: 0 6px 16px rgba(186, 104, 200, 0.3);
        }
    </style>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <label for="name">{{ __('Name') }}</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
            @if ($errors->has('name'))
                <div class="error">{{ $errors->first('name') }}</div>
            @endif
        </div>

        <!-- Email Address -->
        <div>
            <label for="email">{{ __('Email') }}</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username">
            @if ($errors->has('email'))
                <div class="error">{{ $errors->first('email') }}</div>
            @endif
        </div>

        <!-- Password -->
        <div>
            <label for="password">{{ __('Password') }}</label>
            <input id="password" type="password" name="password" required autocomplete="new-password">
            @if ($errors->has('password'))
                <div class="error">{{ $errors->first('password') }}</div>
            @endif
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation">{{ __('Confirm Password') }}</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password">
            @if ($errors->has('password_confirmation'))
                <div class="error">{{ $errors->first('password_confirmation') }}</div>
            @endif
        </div>

        <!-- Footer -->
        <div class="form-footer">
            <a href="{{ route('login') }}">{{ __('Already registered?') }}</a>
            <button type="submit">{{ __('Register') }}</button>
        </div>
    </form>
</x-guest-layout>
