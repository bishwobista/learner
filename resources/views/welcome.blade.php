<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Learner App</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Tailwind CSS -->
    <style>
        body {
            font-family: 'Figtree', sans-serif;
        }

        .cta-button {
            @apply bg-blue-600 text-white font-bold py-3 px-6 rounded-lg transition hover: bg-blue-700;
        }

        .cta-button-outline {
            @apply border border-blue-600 text-blue-600 font-bold py-3 px-6 rounded-lg transition hover: bg-blue-100;
        }

        .feature-card {
            @apply bg-white dark: bg-gray-800 rounded-lg shadow-md p-6 transition hover:shadow-lg;
        }
    </style>
</head>

<body class="antialiased font-sans bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200">
    <div
        class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
        <img id="background" class="absolute -left-20 top-0 max-w-[877px]"
            src="https://laravel.com/assets/img/welcome/background.svg" alt="background image" />

        <div class="relative w-full max-w-4xl px-6 lg:max-w-6xl">
            <!-- Header with navigation -->
            <header class="grid grid-cols-2 items-center py-10 lg:grid-cols-3">
                <h1 class="text-4xl font-bold text-center col-span-2 lg:col-span-1 lg:text-left">
                    Welcome to Learner App
                </h1>
                @if (Route::has('login'))
                <livewire:welcome.navigation />
                @endif
            </header>

            <!-- Call to Action -->
            <section class="text-center py-16">
                <h2 class="text-2xl font-semibold mb-6">
                    Master your learning with our Spaced Repetition System
                </h2>
                <p class="mb-8 text-gray-600 dark:text-gray-400 max-w-lg mx-auto">
                    The most efficient way to learn and retain knowledge. Start learning today with our customizable
                    decks and spaced repetition algorithm.
                </p>
                <div class="flex justify-center gap-4">
                    <a href="{{ route('register') }}" class="cta-button">Get Started for Free</a>
                    <a href="{{ route('login') }}" class="cta-button-outline">Log In</a>
                </div>
            </section>

            <!-- Features Section -->
            <section class="py-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="feature-card">
                    <h3 class="text-xl font-bold mb-3">Spaced Repetition</h3>
                    <p class="text-gray-600 dark:text-gray-400">Use the scientifically proven method to retain
                        information longer.</p>
                </div>

                <div class="feature-card">
                    <h3 class="text-xl font-bold mb-3">Customizable Decks</h3>
                    <p class="text-gray-600 dark:text-gray-400">Create your own decks to tailor learning to your needs.
                    </p>
                </div>

                <div class="feature-card">
                    <h3 class="text-xl font-bold mb-3">Progress Tracking</h3>
                    <p class="text-gray-600 dark:text-gray-400">Track your learning progress and improve over time.</p>
                </div>
            </section>
        </div>
    </div>
</body>

</html>