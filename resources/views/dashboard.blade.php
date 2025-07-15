<x-app-layout>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #fce4ec, #e1bee7);
            font-family: 'Comic Sans MS', cursive, sans-serif;
            color: #4a148c;
        }

        .dashboard-container {
            min-height: 100vh;
            padding: 3rem 1rem;
            max-width: 1200px;
            margin: auto;
        }

        .dashboard-header h1 {
            font-size: 3rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
            color: #ad1457;
            text-shadow: 0 0 8px #fff, 0 0 12px #f48fb1;
            animation: sparkle 3s infinite alternate;
        }

        .dashboard-header p {
            color: #6a1b9a;
            font-size: 1.2rem;
            margin-bottom: 2rem;
        }

        .card-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2rem;
        }

        @media (min-width: 768px) {
            .card-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        .card {
            background: linear-gradient(145deg, #f8bbd0, #e1bee7);
            border-radius: 20px;
            padding: 1.8rem;
            box-shadow: 0 0 20px rgba(236, 64, 122, 0.3), 0 0 35px rgba(156, 39, 176, 0.3);
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-6px);
        }

        .card h2 {
            font-size: 1.6rem;
            font-weight: bold;
            color: #6a1b9a;
            text-shadow: 0 0 6px #f3e5f5;
        }

        .card p {
            font-size: 1rem;
            color: #4a148c;
        }

        .drawer-toggle {
            position: fixed;
            top: 1rem;
            left: 1rem;
            z-index: 100;
            background: #f48fb1;
            color: white;
            padding: 0.5rem 0.8rem;
            border-radius: 50%;
            font-size: 1.5rem;
            box-shadow: 0 0 15px #f06292;
            border: none;
            cursor: pointer;
        }

        .drawer {
            position: fixed;
            top: 0;
            left: -260px;
            width: 220px;
            height: 100%;
            background-color: #fce4ec;
            box-shadow: 5px 0 20px rgba(236, 64, 122, 0.4);
            border-right: 3px solid #f48fb1;
            padding: 2rem 1rem;
            transition: left 0.3s ease;
            z-index: 99;
            display: flex;
            flex-direction: column;
        }

        .drawer.open {
            left: 0;
        }

        .drawer-links {
            margin-top: 25%;
            display: flex;
            flex-direction: column;
        }

        .drawer a {
            background: linear-gradient(to right, #f8bbd0, #ce93d8);
            color: #6a1b9a;
            padding: 0.6rem 1rem;
            margin-bottom: 1rem;
            border-radius: 12px;
            text-decoration: none;
            font-weight: bold;
            text-align: center;
            box-shadow: 0 0 10px #f48fb1;
            transition: transform 0.2s ease;
        }

        .drawer a:hover {
            transform: scale(1.05);
            box-shadow: 0 0 18px #ba68c8;
        }

        @keyframes sparkle {
            0% { text-shadow: 0 0 5px #fff, 0 0 10px #f48fb1; }
            100% { text-shadow: 0 0 10px #fff, 0 0 20px #ce93d8; }
        }
    </style>

    <!-- 💖 Drawer Toggle -->
    <div class="drawer-toggle" onclick="document.querySelector('.drawer').classList.toggle('open')">☰</div>

    <!-- 🎀 Sidebar Drawer -->
    <div class="drawer">
        <div class="drawer-links">
            <a href="{{ url('/bookings/create') }}">➕ Create Booking</a>
            <a href="{{ url('/bookings') }}">📖 View Bookings</a>
            <a href="{{ url('/profile') }}">👥 User Management</a>
        </div>
    </div>

    <!-- 💜 Dashboard Content -->
    <div class="dashboard-container">
        <header class="dashboard-header">
            <h1>💖 Booking Dashboard</h1>
            <p>Manage your platform with sparkle and style!</p>
        </header>

        <section class="card-grid">
            <!-- Total Bookings -->
            <div class="card">
                <h2>📅 Total Bookings</h2>
                <p>You currently have <strong>{{ $totalBookings }}</strong> booking{{ $totalBookings !== 1 ? 's' : '' }}.</p>
            </div>

            <!-- Total Users -->
            <div class="card">
                <h2>👩‍💻 Total Users</h2>
                <p>There {{ $totalUsers === 1 ? 'is' : 'are' }} <strong>{{ $totalUsers }}</strong> registered user{{ $totalUsers !== 1 ? 's' : '' }}.</p>
            </div>
        </section>
    </div>

    <script>
        window.addEventListener('click', function (e) {
            const drawer = document.querySelector('.drawer');
            const toggle = document.querySelector('.drawer-toggle');
            if (!drawer.contains(e.target) && !toggle.contains(e.target)) {
                drawer.classList.remove('open');
            }
        });
    </script>
</x-app-layout>
