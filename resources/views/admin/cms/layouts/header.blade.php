<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
    <div class="container">
        {{--  
        <a class="navbar-brand" href="{{ route('admin.cms.home') }}">CMS</a>
        --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ $currentPage == 'home' ? 'active' : '' }}" href="{{ route('cms.home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $currentPage == 'blog' ? 'active' : '' }}" href="{{ route('cms.index') }}">Blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $currentPage == 'about' ? 'active' : '' }} disabled" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $currentPage == 'contact' ? 'active' : '' }}" href="{{ route('cms.contact.create') }}">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
