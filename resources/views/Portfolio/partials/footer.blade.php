<footer class="border-t border-gray-800/50 py-8 px-4">
    <div class="max-w-6xl mx-auto flex flex-col md:flex-row justify-between items-center gap-4">
        <p class="text-gray-500 text-sm" dir="ltr">
            © {{ date('Y') }} {{ $settings->site_name ?? config('app.name') }}. All rights reserved.
        </p>
        @if(isset($socialLinks) && count($socialLinks))
            <div class="flex gap-3">
                @foreach($socialLinks as $link)
                    <a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer" class="text-gray-500 hover:text-amber-400 transition">
                        <i class="{{ $link->icon ?? 'fas fa-link' }}"></i>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</footer>