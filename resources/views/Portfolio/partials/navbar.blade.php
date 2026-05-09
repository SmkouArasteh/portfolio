<nav class="fixed top-0 w-full z-50 nav-blur bg-gray-950/80 border-b border-gray-800/50 h-20" dir="ltr">
    <div class="max-w-6xl mx-auto px-4 h-full flex justify-between items-center">
        <a href="{{ url('/') }}" class="text-xl font-bold gradient-text">
            {{ $settings->site_name ?? config('app.name', 'Portfolio') }}
        </a>
        <div class="hidden md:flex gap-8 text-sm">
            <a href="#about" class="scroll-spy-link text-gray-400 hover:text-amber-400 transition">About Me</a>
            <a href="#skills" class="scroll-spy-link text-gray-400 hover:text-amber-400 transition">Skills</a>
            <a href="#projects" class="scroll-spy-link text-gray-400 hover:text-amber-400 transition">Projects</a>
            <a href="#experience" class="scroll-spy-link text-gray-400 hover:text-amber-400 transition">Experience</a>
            <a href="#education" class="scroll-spy-link text-gray-400 hover:text-amber-400 transition">Education</a>
            <a href="#contact" class="scroll-spy-link text-gray-400 hover:text-amber-400 transition">Contact</a>
        </div>
        <button id="mobile-menu-btn" class="md:hidden text-gray-400">
            <i class="fas fa-bars text-xl"></i>
        </button>
    </div>
    <div id="mobile-menu" class="hidden md:hidden px-4 pb-4 space-y-3">
        <a href="#about" class="scroll-spy-link block text-gray-400 hover:text-amber-400">About Me</a>
        <a href="#skills" class="scroll-spy-link block text-gray-400 hover:text-amber-400">Skills</a>
        <a href="#projects" class="scroll-spy-link block text-gray-400 hover:text-amber-400">Projects</a>
        <a href="#experience" class="scroll-spy-link block text-gray-400 hover:text-amber-400">Experience</a>
        <a href="#education" class="scroll-spy-link block text-gray-400 hover:text-amber-400">Education</a>
    </div>
    <div id="scroll-progress-bar" class="fixed top-20 left-0 h-1 z-40 bg-gradient-to-r from-amber-400 to-red-500"
        style="width: 0%; border-radius: 0 4px 4px 0;"></div>
</nav>