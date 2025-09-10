<div class="col-md-3">
    <div class="list-group">
        <a href="{{ route('admin.cms.home') }}" class="list-group-item list-group-item-action {{ $currentPage == 'home' ? 'active' : '' }}">Home</a>
        <a href="{{ route('admin.cms.index') }}" class="list-group-item list-group-item-action {{ $currentPage == 'blog' ? 'active' : '' }}">Blog</a>
        <a href="#" class="list-group-item list-group-item-action disabled">About</a>
        <a href="{{ route('admin.cms.create') }}" class="list-group-item list-group-item-action {{ $currentPage == 'contact' ? 'active' : '' }}">Contact</a>
    </div>
</div>
