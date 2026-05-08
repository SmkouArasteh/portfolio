<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title', config('app.name'))</title>
    <meta name="description" content="@yield('meta_description')">
    <meta name="keywords" content="@yield('meta_keywords')">

    <meta property="og:title" content="@yield('og_title')">
    <meta property="og:description" content="@yield('og_description')">
    <meta property="og:image" content="@yield('og_image')">
    <meta property="og:url" content="@yield('og_url', url()->current())">
    <meta property="og:type" content="@yield('og_type', 'website')">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('twitter_title')">
    <meta name="twitter:description" content="@yield('twitter_description')">
    <meta name="twitter:image" content="@yield('twitter_image')">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('jsonld')

    {{-- Canonical URL --}}
    <link rel="canonical" href="@yield('canonical_url', url()->current())">

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
        </style>
    @endif

    <style>
        html {
            scroll-behavior: smooth;
        }

        .gradient-text {
            background: linear-gradient(135deg, #f59e0b, #ef4444);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .skill-bar {
            transition: width 1.5s ease-in-out;
        }

        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease;
        }

        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .nav-blur {
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        html {
            scrollbar-width: none;

            -ms-overflow-style: none;
        }

        html::-webkit-scrollbar {
            display: none;
        }

        .scroll-spy-link.active {
            color: #f59e0b !important;
        }
    </style>

    @yield('jsonld')
</head>

<body class="bg-gray-950 text-white antialiased flex flex-col min-h-screen">
    @include('Portfolio.partials.navbar')

    <main class="flex-grow pt-20">
        @yield('content')
    </main>

    @include('Portfolio.partials.footer')

    @stack('scripts')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile menu toggle
            const menuBtn = document.getElementById('mobile-menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');
            if (menuBtn && mobileMenu) {
                menuBtn.addEventListener('click', () => mobileMenu.classList.toggle('hidden'));
                document.querySelectorAll('#mobile-menu a').forEach(link => {
                    link.addEventListener('click', () => mobileMenu.classList.add('hidden'));
                });
            }

            // Fade-in observer
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) entry.target.classList.add('visible');
                });
            }, {
                threshold: 0.1
            });
            document.querySelectorAll('.fade-in').forEach(el => observer.observe(el));

            // Skill bars
            const skillSection = document.getElementById('skills');
            if (skillSection) {
                const skillObserver = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.querySelectorAll('.skill-bar').forEach(bar => {
                                bar.style.width = bar.dataset.width;
                            });
                        }
                    });
                }, {
                    threshold: 0.3
                });
                skillObserver.observe(skillSection);
            }
        });
    </script>
</body>

</html>