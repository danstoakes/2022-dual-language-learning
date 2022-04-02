<a href="{{ route($link['url'], $link['data']) }}" class="text-decoration-none text-black">
    <div class="card flex flex-row align-items-center language-list-card">
        <div class="card-body language-details">
            @if (isset($tag) && $tag)
                <span class="badge badge-primary role-badge">{{ $tag }}</span>
            @endif
            <h4 class="card-title language-title language-title-large">{{ $title }}</h4>
            <p class="card-text">{{ $text }}</p>
        </div>
    </div>
</a>