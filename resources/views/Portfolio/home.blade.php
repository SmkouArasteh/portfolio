@extends('Portfolio.layouts.app')

@section('title', ($about->full_name ?? 'Portfolio') . ' | ' . ($about->title ?? 'Web Developer'))

@section('meta_description', Str::limit(strip_tags($about->bio ?? ''), 160))
@section('meta_keywords', implode(',', $skills->pluck('name')->toArray()))

@section('og_title', ($about->full_name ?? 'Portfolio') . ' - Portfolio')
@section('og_description', Str::limit(strip_tags($about->bio ?? ''), 160))
@section('og_image', $about->avatar ? route('private.image', ['path' => $about->avatar]) : asset('images/default-og.jpg'))

@section('content')
    <!-- Hero Section -->
    <section id="hero" class="min-h-screen flex items-center justify-center relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-amber-500/5 via-transparent to-red-500/5"></div>
        <div class="text-center z-10 px-4">
            @if ($about?->avatar)
                <img src="{{ asset('storage/' . $about->avatar) }}" alt="{{ $about->full_name }}"
                    class="w-36 h-36 rounded-full mx-auto mb-8 border-4 border-amber-400/30 object-cover shadow-2xl shadow-amber-500/20">
            @endif
            <h1 class="text-4xl md:text-6xl font-extrabold mb-4">
                Hello, I'm <span class="gradient-text">{{ $about?->full_name ?? 'Developer' }}</span>
            </h1>
            <p class="text-xl md:text-2xl text-gray-400 mb-8">{{ $about?->title ?? 'Web Developer' }}</p>
            <div class="flex gap-4 justify-center mb-8">
                <a href="#projects"
                    class="bg-amber-500 hover:bg-amber-600 text-black font-semibold px-8 py-3 rounded-lg transition">
                    My Work
                </a>
                <a href="#contact"
                    class="border border-gray-600 hover:border-amber-400 text-gray-300 hover:text-amber-400 px-8 py-3 rounded-lg transition">
                    Contact Me
                </a>
            </div>
            @if (count($socialLinks))
                <div class="flex gap-4 justify-center">
                    @foreach ($socialLinks as $link)
                        <a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer"
                            class="w-10 h-10 rounded-full bg-gray-800 hover:bg-amber-500 flex items-center justify-center transition text-gray-400 hover:text-black">
                            <i class="{{ $link->icon ?? 'fas fa-link' }}"></i>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <!-- About Section -->
    @if ($about)
        <section id="about" class="py-20 px-4 fade-in">
            <div class="max-w-4xl mx-auto">
                <h2 class="text-3xl font-bold text-center mb-12">About <span class="gradient-text">Me</span></h2>
                <div class="bg-gray-900/50 rounded-2xl p-8 border border-gray-800/50">
                    <p class="text-gray-300 leading-8 text-lg mb-6">{!! $about->bio !!}</p>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                        @if ($about->email)
                            <div class="flex items-center gap-3 text-gray-400">
                                <i class="fas fa-envelope text-amber-400"></i>
                                <span>{{ $about->email }}</span>
                            </div>
                        @endif
                        @if ($about->phone)
                            <div class="flex items-center gap-3 text-gray-400">
                                <i class="fas fa-phone text-amber-400"></i>
                                <span dir="ltr">{{ $about->phone }}</span>
                            </div>
                        @endif
                        @if ($about->location)
                            <div class="flex items-center gap-3 text-gray-400">
                                <i class="fas fa-map-marker-alt text-amber-400"></i>
                                <span>{{ $about->location }}</span>
                            </div>
                        @endif
                    </div>
                    @if ($about->resume)
                        <div class="mt-6">
                            <a href="{{ asset('storage/' . $about->resume) }}" target="_blank"
                                class="inline-flex items-center gap-2 bg-amber-500/10 text-amber-400 border border-amber-500/30 hover:bg-amber-500 hover:text-black px-6 py-2 rounded-lg transition">
                                <i class="fas fa-download"></i>
                                Download Resume
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @endif

    <!-- Skills Section -->
    @if ($skills->count())
        <section id="skills" class="py-20 px-4 fade-in">
            <div class="max-w-4xl mx-auto">
                <h2 class="text-3xl font-bold text-center mb-12">Ski<span class="gradient-text">lls</span></h2>
                @php $categories = $skills->groupBy('category'); @endphp
                @foreach ($categories as $category => $items)
                    <div class="mb-8">
                        @if ($category)
                            <h3 class="text-lg font-semibold text-amber-400 mb-4">{{ $category }}</h3>
                        @endif
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach ($items as $skill)
                                <div class="bg-gray-900/50 rounded-xl p-4 border border-gray-800/50">
                                    <div class="flex justify-between items-center mb-2">
                                        <span class="flex items-center gap-2 text-gray-200">
                                            @if ($skill->icon)
                                                <i class="{{ $skill->icon }} text-amber-400"></i>
                                            @endif
                                            {{ $skill->name }}
                                        </span>
                                        <span class="text-amber-400 text-sm font-semibold">{{ $skill->percentage }}%</span>
                                    </div>
                                    <div class="w-full bg-gray-800 rounded-full h-2">
                                        <div class="skill-bar bg-gradient-to-r from-amber-400 to-red-500 h-2 rounded-full"
                                            style="width: 0%" data-width="{{ $skill->percentage }}%"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    <!-- Projects Section -->
    @if ($projects->count())
        <section id="projects" class="py-20 px-4 fade-in">
            <div class="max-w-6xl mx-auto">
                <h2 class="text-3xl font-bold text-center mb-12">Proj<span class="gradient-text">ects</span></h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($projects as $project)
                        <div class="card-hover bg-gray-900/50 rounded-2xl overflow-hidden border border-gray-800/50">
                            @if ($project->image)
                                <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}"
                                    class="w-full h-48 object-cover">
                            @else
                                <div
                                    class="w-full h-48 bg-gradient-to-br from-amber-500/20 to-red-500/20 flex items-center justify-center">
                                    <i class="fas fa-code text-4xl text-amber-400/50"></i>
                                </div>
                            @endif
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-2">
                                    <h3 class="text-lg font-bold text-white">{{ $project->title }}</h3>
                                    @if ($project->is_featured)
                                        <span
                                            class="text-xs bg-amber-500/20 text-amber-400 px-2 py-1 rounded-full">Featured</span>
                                    @endif
                                </div>
                                <p class="text-gray-400 text-sm mb-4 line-clamp-3">{{ $project->description }}</p>
                                @if ($project->technologies)
                                    <div class="flex flex-wrap gap-2 mb-4">
                                        @foreach ($project->technologies as $tech)
                                            <span
                                                class="text-xs bg-gray-800 text-gray-300 px-2 py-1 rounded-md">{{ $tech }}</span>
                                        @endforeach
                                    </div>
                                @endif
                                @if ($project->url)
                                    <a href="{{ $project->url }}" target="_blank" rel="noopener noreferrer"
                                        class="text-amber-400 hover:text-amber-300 text-sm flex items-center gap-1 transition">
                                        <span>View Project</span>
                                        <i class="fas fa-arrow-right text-xs"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Experience Section -->
    @if ($experiences->count())
        <section id="experience" class="py-20 px-4 fade-in">
            <div class="max-w-4xl mx-auto">
                <h2 class="text-3xl font-bold text-center mb-12">Work <span class="gradient-text">Experience</span></h2>
                <div class="relative">
                    <div class="absolute left-4 top-0 bottom-0 w-0.5 bg-gray-800"></div>
                    @foreach ($experiences as $exp)
                        <div class="relative pl-12 pb-12 last:pb-0">
                            <div class="absolute left-2.5 top-1 w-4 h-4 rounded-full border-2 border-amber-400 bg-gray-950">
                            </div>
                            <div class="bg-gray-900/50 rounded-xl p-6 border border-gray-800/50">
                                <div class="flex flex-wrap items-center justify-between mb-2">
                                    <h3 class="text-lg font-bold text-white">{{ $exp->position }}</h3>
                                    <span class="text-xs text-gray-500">{{ $exp->duration }}</span>
                                </div>
                                <p class="text-amber-400 text-sm mb-3">{{ $exp->company }}</p>
                                @if ($exp->description)
                                    <p class="text-gray-400 text-sm leading-7">{!! $exp->description !!}</p>
                                @endif
                                @if ($exp->is_current)
                                    <span
                                        class="inline-block mt-3 text-xs bg-green-500/20 text-green-400 px-3 py-1 rounded-full">
                                        Currently Working
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Education Section -->
    @if ($educations->count())
        <section id="education" class="py-20 px-4 fade-in">
            <div class="max-w-4xl mx-auto">
                <h2 class="text-3xl font-bold text-center mb-12">My <span class="gradient-text">Education</span></h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach ($educations as $edu)
                        <div class="card-hover bg-gray-900/50 rounded-xl p-6 border border-gray-800/50">
                            <div class="flex items-start gap-4">
                                <div
                                    class="w-12 h-12 rounded-lg bg-amber-500/10 flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-graduation-cap text-amber-400"></i>
                                </div>
                                <div>
                                    <h3 class="font-bold text-white">{{ $edu->degree }} {{ $edu->field }}</h3>
                                    <p class="text-amber-400 text-sm">{{ $edu->institution }}</p>
                                    <p class="text-gray-500 text-xs mt-1">{{ $edu->duration }}</p>
                                    @if ($edu->description)
                                        <p class="text-gray-400 text-sm mt-2">{!! $edu->description !!}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Contact Section -->
    <section id="contact" x-data="contactForm" class="py-20 px-4 fade-in">
        <div class="max-w-2xl mx-auto">
            <h2 class="text-3xl font-bold text-center mb-12">Contact <span class="gradient-text">Me</span></h2>

            <!-- Success message -->
            <div x-show="success" x-cloak
                class="bg-green-500/10 border border-green-500/30 text-green-400 rounded-xl p-4 mb-6 text-center">
                Your message has been sent successfully.
            </div>

            <form @submit.prevent="submit" class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <input type="text" name="name" placeholder="Your Name" x-model="fields.name"
                            :class="errors.name ? 'border-red-500' : 'border-gray-800'"
                            class="w-full bg-gray-900/50 border rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:border-amber-400 focus:outline-none transition">
                        <span x-show="errors.name" x-text="errors.name" class="text-red-400 text-xs"></span>
                    </div>
                    <div>
                        <input type="email" name="email" placeholder="Your Email" x-model="fields.email"
                            :class="errors.email ? 'border-red-500' : 'border-gray-800'"
                            class="w-full bg-gray-900/50 border rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:border-amber-400 focus:outline-none transition">
                        <span x-show="errors.email" x-text="errors.email" class="text-red-400 text-xs"></span>
                    </div>
                </div>
                <div>
                    <input type="text" name="subject" placeholder="Subject" x-model="fields.subject"
                        :class="errors.subject ? 'border-red-500' : 'border-gray-800'"
                        class="w-full bg-gray-900/50 border rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:border-amber-400 focus:outline-none transition">
                    <span x-show="errors.subject" x-text="errors.subject" class="text-red-400 text-xs"></span>
                </div>
                <div>
                    <textarea name="message" rows="5" placeholder="Your Message..." x-model="fields.message"
                        :class="errors.message ? 'border-red-500' : 'border-gray-800'"
                        class="w-full bg-gray-900/50 border rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:border-amber-400 focus:outline-none transition resize-none"></textarea>
                    <span x-show="errors.message" x-text="errors.message" class="text-red-400 text-xs"></span>
                </div>
                <button type="submit" :disabled="loading"
                    class="w-full bg-amber-500 hover:bg-amber-600 text-black font-semibold py-3 rounded-xl transition disabled:opacity-50">
                    <span x-show="!loading">Send Message <i class="fas fa-paper-plane ml-2"></i></span>
                    <span x-show="loading">Sending...</span>
                </button>
            </form>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('contactForm', () => ({
                fields: {
                    name: '',
                    email: '',
                    subject: '',
                    message: ''
                },
                errors: {},
                loading: false,
                success: false,

                async submit() {
                    this.loading = true;
                    this.errors = {};
                    this.success = false;

                    try {
                        const response = await fetch('{{ route('contact.send') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]')?.content,
                                'Accept': 'application/json',
                            },
                            body: JSON.stringify(this.fields),
                        });

                        if (response.ok) {
                            this.success = true;
                            this.fields = {
                                name: '',
                                email: '',
                                subject: '',
                                message: ''
                            };
                        } else if (response.status === 422) {
                            const data = await response.json();
                            this.errors = data.errors;
                        }
                    } catch (e) {
                        alert('Error sending message.');
                    } finally {
                        this.loading = false;
                    }
                }
            }));
        });

        document.addEventListener('DOMContentLoaded', function() {
            const navLinks = document.querySelectorAll('.scroll-spy-link');
            if (navLinks.length === 0) return;

            const sections = [];
            navLinks.forEach(link => {
                const targetId = link.getAttribute('href').substring(1);
                const target = document.getElementById(targetId);
                if (target) {
                    sections.push({
                        link,
                        target
                    });
                }
            });

            const navbarHeight = 80;
            const rootMargin = -(navbarHeight + 10);

            const observerCallback = (entries) => {
                let bestSection = null;
                let bestRatio = 0;

                entries.forEach(entry => {
                    if (entry.isIntersecting && entry.intersectionRatio > bestRatio) {
                        bestRatio = entry.intersectionRatio;
                        bestSection = entry.target;
                    }
                });

                navLinks.forEach(link => link.classList.remove('active'));

                if (bestSection) {
                    const activeLink = document.querySelector(`.scroll-spy-link[href="#${bestSection.id}"]`);
                    if (activeLink) activeLink.classList.add('active');
                }
            };

            const observer = new IntersectionObserver(observerCallback, {
                root: null,
                rootMargin: `${rootMargin}px 0px 0px 0px`,
                threshold: [0, 0.2, 0.4, 0.6, 0.8, 1.0]
            });

            sections.forEach(s => observer.observe(s.target));

            if (window.location.hash) {
                const hashLink = document.querySelector(`.scroll-spy-link[href="${window.location.hash}"]`);
                if (hashLink) {
                    setTimeout(() => {
                        navLinks.forEach(l => l.classList.remove('active'));
                        hashLink.classList.add('active');
                    }, 200);
                }
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const progressBar = document.getElementById('scroll-progress-bar');
            if (!progressBar) return;

            window.addEventListener('scroll', function() {
                const scrollTop = window.scrollY;
                const docHeight = document.documentElement.scrollHeight - window
                    .innerHeight;
                const scrollPercent = (scrollTop / docHeight) * 100;
                progressBar.style.width = Math.min(scrollPercent, 100) + '%';
            });
        });
    </script>
@endpush
