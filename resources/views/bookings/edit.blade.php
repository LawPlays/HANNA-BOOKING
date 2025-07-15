<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-pink-100 leading-tight text-center drop-shadow-lg">
            🌸 Edit Booking
        </h2>
    </x-slot>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    @push('styles')
    <style>
        body {
            font-family: 'Comic Sans MS', cursive, sans-serif;
        }

        .form-container {
            background: linear-gradient(145deg, #ffe4f0, #f3e8ff);
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 0 25px rgba(255, 182, 193, 0.4);
            max-width: 700px;
            margin: 2rem auto;
            color: #4b0082;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
            color: #d63384;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 12px;
            border-radius: 12px;
            border: 2px solid #eab1ff;
            background-color: #fff0f6;
            color: #5b0065;
            box-shadow: 0 0 6px rgba(255, 192, 203, 0.5);
            margin-bottom: 1.5rem;
            font-size: 15px;
            transition: 0.3s;
        }

        input:focus,
        textarea:focus {
            outline: none;
            border-color: #ff7de9;
            box-shadow: 0 0 12px rgba(238, 130, 238, 0.7);
        }

        .calendar-wrapper {
            margin-bottom: 1.5rem;
        }

        #calendarBox {
            background-color: #ffeafc;
            border-radius: 16px;
            padding: 1rem;
            box-shadow: 0 0 20px rgba(255, 105, 180, 0.4);
            border: 2px solid #fbcfe8;
        }

        .submit-button {
            background: linear-gradient(to right, #ff9ce3, #d4b5ff);
            color: white;
            padding: 12px 28px;
            border: none;
            border-radius: 30px;
            font-weight: 600;
            font-size: 15px;
            box-shadow: 0 0 14px rgba(255, 182, 193, 0.6);
            cursor: pointer;
            transition: 0.3s ease;
        }

        .submit-button:hover {
            transform: scale(1.05);
            box-shadow: 0 0 24px rgba(218, 112, 214, 0.8);
        }

        .back-link {
            font-size: 0.9rem;
            color: #d63384;
            text-decoration: underline;
            transition: 0.3s;
        }

        .back-link:hover {
            color: #f72585;
        }

        input[type="date"],
        input[type="time"],
        .flatpickr-input {
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            border: 2px solid #f8b4d9;
            background-color: #fff0fa;
            color: #9400d3;
            font-size: 14px;
            box-shadow: 0 0 6px rgba(219, 112, 147, 0.3);
            margin-bottom: 1.5rem;
            transition: 0.3s ease;
        }

        input:focus,
        .flatpickr-input:focus {
            outline: none;
            border-color: #ff7de9;
            box-shadow: 0 0 12px rgba(255, 105, 180, 0.7);
        }

        input::placeholder {
            color: #c084fc;
            text-shadow: 0 0 2px rgba(200, 147, 255, 0.5);
        }

        /* Flatpickr customization */
        .flatpickr-calendar {
            background-color: #ffeafc !important;
            color: #7e22ce !important;
            border: 1px solid #f8b4d9;
            box-shadow: 0 0 20px rgba(255, 182, 193, 0.3);
        }

        .flatpickr-day.today {
            background: #f472b6 !important;
            color: #fff !important;
            box-shadow: 0 0 8px rgba(245, 101, 179, 0.8);
        }

        .flatpickr-day.selected {
            background: linear-gradient(to right, #ff9ce3, #d4b5ff) !important;
            color: white !important;
            font-weight: bold;
            box-shadow: 0 0 12px rgba(218, 112, 214, 0.9);
        }

        .flatpickr-day:hover {
            background-color: rgba(255, 182, 193, 0.6) !important;
            color: #fff !important;
        }

    </style>

    <div class="form-container">
        @if ($errors->any())
            <div class="bg-pink-500 text-white p-4 mb-4 rounded shadow-md">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('bookings.update', $booking) }}" method="POST">
            @csrf
            @method('PUT')

            <div>
                <label for="title">Title</label>
                <input type="text" name="title" id="title"
                       value="{{ old('title', $booking->title) }}" required>
            </div>

            <div>
                <label for="calendarBox">Booking Date & Time</label>
                <div class="calendar-wrapper">
                    <div id="calendarBox"></div>
                </div>
                <input type="hidden" name="booking_date" id="booking_date"
                       value="{{ old('booking_date', \Carbon\Carbon::parse($booking->booking_date)->format('Y-m-d H:i')) }}">
            </div>

            <div>
                <label for="notes">Notes</label>
                <textarea name="notes" id="notes" rows="4">{{ old('notes', $booking->notes) }}</textarea>
            </div>

            <div class="flex justify-between items-center mt-6">
                <a href="{{ route('bookings.index') }}" class="back-link">← Back to list</a>
                <button type="submit" class="submit-button">💾 Update</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#calendarBox", {
            inline: true,
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            defaultDate: "{{ old('booking_date', \Carbon\Carbon::parse($booking->booking_date)->format('Y-m-d H:i')) }}",
            time_24hr: false,
            minuteIncrement: 1,
            onChange: function(selectedDates, dateStr, instance) {
                document.getElementById("booking_date").value = dateStr;
            }
        });
    </script>
</x-app-layout>
