<nav x-data="{ open: false }">
    <style>
        nav {
            background: #111;
            border-bottom: 2px solid #444;
            position: relative;
            z-index: 10;
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
        }

        .nav-left, .nav-right {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .nav-logo svg {
            height: 40px;
            fill: #fff;
        }

        .nav-link {
            color: white;
            text-decoration: none;
            font-weight: 500;
            position: relative;
            padding: 0.3rem 0.5rem;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .nav-link:hover::before {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background: #fff;
        }

        .hamburger {
            display: none;
            background: none;
            border: none;
            cursor: pointer;
            color: white;
            font-size: 1.5rem;
        }

        @media (max-width: 768px) {
            .nav-left > .nav-link,
            .nav-right {
                display: none;
            }

            .hamburger {
                display: block;
            }

            .mobile-menu {
                display: block;
                background: #111;
                padding: 1rem 2rem;
                animation: fadeIn 0.3s ease-in-out;
            }
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>

    @php
        $unreadCount = Auth::user()->unreadNotifications->count();
    @endphp

    <div class="nav-container">
        <div class="nav-left">
            <a href="{{ route('dashboard') }}" class="nav-logo">
                <x-application-logo />
            </a>

            <a href="{{ route('dashboard') }}" class="nav-link">
                {{ __('Dashboard') }}
            </a>
        </div>

        <div class="nav-right">
            <span class="nav-user-name">👤 {{ Auth::user()->name }}</span>

            <a href="{{ route('notifications') }}" class="nav-link relative">
                🔔 Notifications
                @if ($unreadCount > 0)
                    <span class="absolute -top-2 -right-2 bg-red-600 text-white text-xs px-2 py-0.5 rounded-full">
                        {{ $unreadCount }}
                    </span>
                @endif
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}"
                   class="nav-link"
                   onclick="event.preventDefault(); this.closest('form').submit();">
                    {{ __('Log Out') }}
                </a>
            </form>
        </div>

        <button @click="open = !open" class="hamburger">
            ☰
        </button>
    </div>

    <div x-show="open" class="mobile-menu">
        <span class="nav-user-name">👤 {{ Auth::user()->name }}</span>

        <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>

        <a href="{{ route('notifications') }}" class="nav-link relative">
            🔔 Notifications
            @if ($unreadCount > 0)
                <span class="absolute -top-2 -right-2 bg-red-600 text-white text-xs px-2 py-0.5 rounded-full">
                    {{ $unreadCount }}
                </span>
            @endif
        </a>

        <a href="{{ route('profile.edit') }}" class="nav-link">Profile</a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="{{ route('logout') }}"
               class="nav-link"
               onclick="event.preventDefault(); this.closest('form').submit();">
                {{ __('Log Out') }}
            </a>
        </form>
    </div>
</nav>
