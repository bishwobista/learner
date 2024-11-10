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

        /* Enhanced feature-card styles */
        .feature-card {
            @apply bg-blue-50 dark: bg-gray-800 rounded-lg shadow-lg p-6 transform transition duration-300 ease-out;
        }

        .feature-card:hover {
            @apply shadow-xl scale-105;
        }

        /* Animation for fade-in effect */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in-up {
            animation: fadeInUp 0.8s ease-out;
        }

        .fade-in-up-delayed {
            animation: fadeInUp 0.8s ease-out 0.3s;
        }
    </style>
</head>

<body class="antialiased font-sans bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200">
    <div class="min-h-screen flex flex-col justify-between">
        <!-- Header with login/signup -->
        <header class="flex justify-end items-center p-6">
            @if (Route::has('login'))
            <livewire:welcome.navigation />
            @endif
        </header>

        <main class="flex flex-col lg:flex-row items-center lg:items-start mx-auto max-w-6xl w-full px-6">
            <!-- Hero Image -->
            <div class="w-full lg:w-1/2 mb-8 lg:mb-0">
                <img src="{{ asset('hero.jpg') }}" alt="hero image" class="w-full rounded-lg shadow-lg" />
            </div>

            <!-- Description with animation and centered alignment -->
            <div
                class="w-full lg:w-1/2 flex flex-col items-center lg:items-start justify-center lg:ml-8 text-center lg:text-left fade-in-up">
                <h2 class="text-3xl font-semibold mb-4">
                    Master your learning with our Spaced Repetition System
                </h2>
                <p class="mb-8 text-gray-600 dark:text-gray-400 max-w-lg">
                    The most efficient way to learn and retain knowledge. Start learning today with our customizable
                    decks and spaced repetition algorithm.
                </p>
                <div class="flex justify-center lg:justify-start gap-4">
                    <a href="{{ route('register') }}" class="cta-button">Get Started for Free</a>
                    <a href="{{ route('login') }}" class="cta-button-outline">Log In</a>
                </div>
            </div>
        </main>

        <!-- Features Section with animations and background colors -->
        <section class="py-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto px-6">
            <div class="feature-card fade-in-up">
                <h3 class="text-xl font-bold mb-3">Spaced Repetition</h3>
                <p class="text-gray-600 dark:text-gray-400">Use the scientifically proven method to retain
                    information longer.</p>
            </div>

            <div class="feature-card fade-in-up-delayed">
                <h3 class="text-xl font-bold mb-3">Customizable Decks</h3>
                <p class="text-gray-600 dark:text-gray-400">Create your own decks to tailor learning to your needs.
                </p>
            </div>

            <div class="feature-card fade-in-up-delayed">
                <h3 class="text-xl font-bold mb-3">Progress Tracking</h3>
                <p class="text-gray-600 dark:text-gray-400">Track your learning progress and improve over time.</p>
            </div>
        </section>
    </div>
</body>

</html>