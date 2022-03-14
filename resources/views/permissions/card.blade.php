<div class="col-sm-6 {{ $lastCard ? '' : 'mb-4 mb-sm-0' }}">
    <a href="{{ route('permissions.show', $permission->id) }}" class="text-decoration-none text-black">
        <div class="card flex flex-row align-items-top language-list-card h-100">
            <div class="card-body language-details">
                <h4 class="card-title language-title language-title-large">{{ $permission->name }}</h4>
                <p class="card-text">{{ $permission->description }}</p>
            </div>
        </div>
    </a>
</div>