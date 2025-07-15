<x-app-layout>
    <x-slot name="header">
        <h2 class="page-header">🌸 My Magical Bookings</h2>
    </x-slot>

    <div class="container">
        @if (session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($bookings->isEmpty())
            <div class="no-bookings">
                <p>No bookings yet 💫 Click below to get started!</p>
            </div>
        @else
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Date</th>
                            <th>Notes</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $booking)
                            <tr>
                                <td>{{ $booking->title }}</td>
                                <td>{{ \Carbon\Carbon::parse($booking->booking_date)->format('F j, Y g:i A') }}</td>
                                <td>{{ $booking->notes ?? '-' }}</td>
                                <td class="action-buttons">
                                    <a href="{{ route('bookings.edit', $booking) }}" class="edit-btn">Edit</a>
                                    <form action="{{ route('bookings.destroy', $booking) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this booking?');" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete-btn">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <div class="new-booking">
            <a href="{{ route('bookings.create') }}">+ New Booking</a>
        </div>
    </div>

    {{-- 🌈 Cute Pastel CSS --}}
    <style>
        body {
            background-color: #fff0f6;
        }

        .page-header {
            font-size: 2rem;
            font-weight: 800;
            color: #d946ef;
            text-shadow: 0 0 8px #f9a8d4;
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .container {
            max-width: 900px;
            margin: auto;
            padding: 2rem;
        }

        .alert-success {
            background: linear-gradient(to right, #f9a8d4, #c084fc);
            color: white;
            padding: 1rem;
            border-radius: 1rem;
            margin-bottom: 1.5rem;
            text-align: center;
            font-weight: bold;
            box-shadow: 0 0 15px #f472b6;
        }

        .no-bookings {
            background: #ffe4f0;
            border: 2px dashed #f472b6;
            padding: 2rem;
            text-align: center;
            color: #be185d;
            font-size: 1.1rem;
            border-radius: 1rem;
            box-shadow: 0 0 10px #f9a8d4;
        }

        .table-container {
            background: #fff0f6;
            border-radius: 1rem;
            box-shadow: 0 0 15px #f0abfc;
            padding: 1rem;
            margin-top: 2rem;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            color: #6b21a8;
            font-size: 0.95rem;
        }

        thead {
            background: linear-gradient(to right, #f472b6, #c084fc);
            color: white;
        }

        th, td {
            padding: 1rem;
            border-top: 1px solid #fbcfe8;
            text-align: left;
        }

        tr:hover {
            background-color: #fce7f3;
            transition: background-color 0.3s ease;
        }

        .action-buttons a,
        .action-buttons button {
            padding: 0.4rem 0.8rem;
            border: none;
            border-radius: 0.5rem;
            font-size: 0.85rem;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            margin-right: 0.5rem;
            color: white;
            transition: all 0.3s ease;
        }

        .edit-btn {
            background: linear-gradient(to right, #facc15, #f97316);
            color: #4b1e00;
        }

        .edit-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 0 10px #fcd34d;
        }

        .delete-btn {
            background: linear-gradient(to right, #f43f5e, #ec4899);
        }

        .delete-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 0 10px #fb7185;
        }

        .new-booking {
            margin-top: 2.5rem;
            text-align: center;
        }

        .new-booking a {
            background: linear-gradient(to right, #c084fc, #f472b6);
            color: white;
            padding: 0.75rem 2rem;
            font-size: 1rem;
            font-weight: bold;
            border-radius: 1rem;
            text-decoration: none;
            box-shadow: 0 0 20px #f9a8d4;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .new-booking a:hover {
            transform: scale(1.05);
            box-shadow: 0 0 30px #f472b6;
        }
    </style>
</x-app-layout>
