<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('welcome') }}"
        target="_blank">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">LaraBlog <sup>@</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    @php
    function isActiveRoute($route, $output = 'active')
    {
    return request()->routeIs($route) ? $output : '';
    }
    @endphp

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ isActiveRoute('categories*') }}">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
            aria-controls="collapseOne">
            <i class="fas fa-fw fa-cog"></i>
            <span>Categories</span>
        </a>
        <div id="collapseOne" class="collapse {{isActiveRoute('categories*', 'show') }}" aria-labelledby="headingTwo"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Menu Categories:</h6>
                <a class="collapse-item {{isActiveRoute('categories.index')}}"
                    href="{{ route('categories.index') }}">Index</a>
                <a class="collapse-item {{isActiveRoute('categories.create')}}"
                    href="{{ route('categories.create') }}">Create</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item {{ isActiveRoute('tags*') }}">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
            aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Tags</span>
        </a>
        <div id="collapseTwo" class="collapse {{isActiveRoute('tags*', 'show') }}" aria-labelledby="headingTwo"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Menu Tags:</h6>
                <a class="collapse-item {{isActiveRoute('tags.index')}}" href="{{ route('tags.index') }}">Index</a>
                <a class="collapse-item {{isActiveRoute('tags.create')}}" href="{{ route('tags.create') }}">Create</a>
            </div>
        </div>
    </li>

    <li class="nav-item {{ isActiveRoute('posts*') }}">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true"
            aria-controls="collapseThree">
            <i class="fas fa-fw fa-cog"></i>
            <span>Post</span>
        </a>
        <div id="collapseThree" class="collapse {{isActiveRoute('posts*', 'show') }}" aria-labelledby="headingTwo"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Menu Posts:</h6>
                <a class="collapse-item {{isActiveRoute('posts.index')}}" href="{{ route('posts.index') }}">Index</a>
                <a class="collapse-item {{isActiveRoute('posts.create')}}" href="{{ route('posts.create') }}">Create</a>
            </div>
        </div>
    </li>

    @auth
    @if (auth()->user()->isAdmin())
    <li class="nav-item {{ isActiveRoute('users*') }}">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true"
            aria-controls="collapseFour">
            <i class="fas fa-fw fa-cog"></i>
            <span>User</span>
        </a>
        <div id="collapseFour" class="collapse {{isActiveRoute('users*', 'show') }}" aria-labelledby="headingTwo"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Menu Users:</h6>
                <a class="collapse-item {{isActiveRoute('users.index')}}" href="{{ route('users.index') }}">Index</a>
                <a class="collapse-item {{isActiveRoute('users.create')}}" href="{{ route('users.create') }}">Create</a>
            </div>
        </div>
    </li>

    <li class="nav-item {{ isActiveRoute('comments*') }}">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true"
            aria-controls="collapseFive">
            <i class="fas fa-fw fa-cog"></i>
            <span>Comments</span>
        </a>
        <div id="collapseFive" class="collapse {{isActiveRoute('comments*', 'show') }}" aria-labelledby="headingTwo"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Menu comments:</h6>
                <a class="collapse-item {{isActiveRoute('comments.index')}}"
                    href="{{ route('comments.index') }}">Index</a>
            </div>
        </div>
    </li>

    <li class="nav-item {{ isActiveRoute('replies*') }}">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseSix" aria-expanded="true"
            aria-controls="collapseSix">
            <i class="fas fa-fw fa-cog"></i>
            <span>Replies</span>
        </a>
        <div id="collapseSix" class="collapse {{isActiveRoute('replies*', 'show') }}" aria-labelledby="headingTwo"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Menu Replies:</h6>
                <a class="collapse-item {{isActiveRoute('replies.index')}}"
                    href="{{ route('replies.index') }}">Index</a>
            </div>
        </div>
    </li>

    <li class="nav-item {{ isActiveRoute('settings*') }}">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="true"
            aria-controls="collapseSeven">
            <i class="fas fa-fw fa-cog"></i>
            <span>Setting</span>
        </a>
        <div id="collapseSeven" class="collapse {{isActiveRoute('settings*', 'show') }}" aria-labelledby="headingTwo"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Menu Setting:</h6>
                <a class="collapse-item {{isActiveRoute('settings.index')}}"
                    href="{{ route('settings.index') }}">Index</a>
            </div>
        </div>
    </li>
    @endif
    @endauth

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>