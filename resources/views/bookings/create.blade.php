<x-app-layout>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>
    body {
        background: linear-gradient(135deg, #ffdee9, #b5b5ff);
        color: #4b0082;
        font-family: 'Poppins', sans-serif;
    }

    .form-wrapper {
        max-width: 700px;
        margin: 3rem auto;
        background: #fff0f5;
        padding: 2rem;
        border-radius: 1.5rem;
        box-shadow: 0 10px 30px rgba(255, 182, 193, 0.4);
        border: 2px dashed #dda0dd;
    }

    .form-title {
        font-size: 2rem;
        font-weight: 600;
        color: #c71585;
        text-align: center;
        margin-bottom: 1.5rem;
        text-shadow: 0 0 8px #ffb6c1;
    }

    label {
        display: block;
        margin-bottom: 0.5rem;
        color: #800080;
        font-weight: 600;
    }

    input[type="text"],
    input[type="datetime-local"],
    textarea {
        width: 100%;
        padding: 0.75rem 1rem;
        background: #ffe6f0;
        border: 2px solid #dda0dd;
        border-radius: 1rem;
        color: #4b0082;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    input:focus,
    textarea:focus {
        outline: none;
        border-color: #da70d6;
        box-shadow: 0 0 10px #dda0dd;
    }

    .submit-btn {
        background: linear-gradient(45deg, #ffb6c1, #dda0dd);
        color: white;
        padding: 0.75rem 1.5rem;
        font-weight: bold;
        border: none;
        border-radius: 1rem;
        cursor: pointer;
        float: right;
        box-shadow: 0 0 15px #dda0dd;
        transition: 0.3s ease;
    }

    .submit-btn:hover {
        transform: scale(1.05);
        background: linear-gradient(45deg, #ffa6c9, #c89edb);
    }

    .flatpickr-calendar {
        background-color: #fff0f5 !important;
        color: #800080 !important;
        border-radius: 1rem;
        padding: 0.5rem;
        border: 2px dashed #dda0dd;
        box-shadow: 0 0 15px rgba(255, 182, 193, 0.4);
    }

    .flatpickr-months,
    .flatpickr-weekdays,
    .flatpickr-day {
        color: #800080 !important;
        font-weight: 600;
    }

    .flatpickr-day.selected,
    .flatpickr-day.startRange,
    .flatpickr-day.endRange {
        background: linear-gradient(to right, #ffb6c1, #dda0dd) !important;
        color: white !important;
        font-weight: bold;
    }

    .flatpickr-day:hover {
        background: rgba(255, 182, 193, 0.3) !important;
        color: #800080 !important;
    }

    .error-box {
        background: #ffe4e1;
        border: 2px dashed #ff69b4;
        color: #ff1493;
        padding: 1rem;
        border-radius: 1rem;
        margin-bottom: 1.5rem;
    }

    .glow-box {
        background-color: #fff0f5;
        border-radius: 1rem;
        box-shadow: 0 0 15px rgba(255, 192, 203, 0.4);
    }

    </style>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-pink-800 leading-tight">
            🎀 Create Booking
        </h2>
    </x-slot>

    <div class="min-h-screen py-12 px-4">
        <div class="form-wrapper">
            <h1 class="form-title">🎀 Create Booking</h1>

            @if ($errors->any())
                <div class="error-box">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('bookings.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="title">Booking Title</label>
                    <input
                        type="text"
                        name="title"
                        id="title"
                        value="{{ old('title') }}"
                        required
                        placeholder="e.g. Birthday Party"
                    >
                </div>

                <div class="mb-6">
                    <label for="booking_date">📅 Booking Date & Time</label>
                    <input type="hidden" name="booking_date" id="booking_date">
                    <div id="calendarBox" class="rounded-2xl mt-4"></div>
                </div>

                <div class="mb-6">
                    <label for="notes">Notes (Optional)</label>
                    <textarea
                        name="notes"
                        id="notes"
                        rows="4"
                        placeholder="e.g. Bring decorations or snacks..."
                    >{{ old('notes') }}</textarea>
                </div>

                <div class="text-right">
                    <button type="submit" class="submit-btn">💖 Submit Booking</button>
                </div>
            </form>
        </div>
    </div>

    <div id="customDatetimeBox" class="fixed inset-0 z-50 bg-black bg-opacity-60 flex items-center justify-center hidden">
        <div class="glow-box text-purple-900 p-6 rounded-xl w-96 text-center relative">
            <button onclick="toggleCustomDatetime()" class="absolute top-2 right-3 text-pink-600 hover:text-red-400 text-xl font-bold">×</button>
            <h2 class="text-lg font-bold mb-4">Pick Date & Time</h2>
            <input
                type="datetime-local"
                id="customPicker"
                class="w-full p-2 rounded bg-pink-100 text-purple-900 border border-pink-300 focus:ring-2 focus:ring-pink-300"
            >
            <button onclick="applyCustomDatetime()" class="submit-btn mt-4 w-full">✨ Use This</button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
    flatpickr("#calendarBox", {
        inline: true,
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        defaultDate: new Date(),
        time_24hr: false,
        minuteIncrement: 1,
        onChange: function(selectedDates, dateStr) {
            document.getElementById("booking_date").value = dateStr;
        }
    });
    </script>
</x-app-layout>
