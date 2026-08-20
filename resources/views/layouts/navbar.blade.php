<style>
    :root {
        --green-darkest: #33623c;
        --green-primary:  #4f8a5b;
        --green-primary-hover: #3f7049;
        --green-soft:     #9fc7a8;
        --green-pale:     #eef5ef;
    }

    html, body {
        overflow-x: hidden;
        width: 100%;
        margin: 0;
        padding: 0;
    }

    * {
        box-sizing: border-box;
    }

    .navbar-pos {
        background-color: #fff;
        border-bottom: 1px solid var(--green-soft);
        box-shadow: 0 2px 8px rgba(51, 98, 60, 0.06);
        padding: .8rem 0;
    }

    .navbar-pos .navbar-brand {
    color: #204a29;
    font-weight: 800;
    font-size: 1.35rem;
    letter-spacing: .5px;
}

    .navbar-pos .navbar-nav {
        align-items: center;
        gap: 1rem;
    }

    .navbar-pos .nav-link {
        color: #4a5a4d !important;
        font-weight: 500;
        padding: .5rem .9rem;
        position: relative;
        transition: color .2s ease;
    }

    .navbar-pos .nav-link:hover {
        color: var(--green-primary) !important;
    }

    .navbar-pos .nav-link::after {
        content: "";
        position: absolute;
        left: .9rem;
        right: .9rem;
        bottom: .1rem;
        height: 2px;
        background-color: var(--green-primary);
        transform: scaleX(0);
        transform-origin: center;
        transition: transform .2s ease;
    }

    .navbar-pos .nav-link:hover::after {
        transform: scaleX(1);
    }

    .navbar-pos .nav-link.active {
        color: var(--green-darkest) !important;
        font-weight: 700 !important;
    }

    .navbar-pos .nav-link.active::after {
        transform: scaleX(1);
        background-color: var(--green-darkest);
    }

    .navbar-pos .btn-logout {
        background-color: #c0463f;
        border-color: #c0463f;
        border-radius: 8px;
        font-weight: 500;
        padding: .4rem 1.3rem;
        color: #fff;
        transition: background-color .2s ease;
    }

    .navbar-pos .btn-logout:hover {
        background-color: #a53a34;
        border-color: #a53a34;
    }

    @media (max-width: 991.98px) {
        .navbar-pos .navbar-nav {
            align-items: flex-start;
            padding-top: 1rem;
            gap: 0.5rem;
        }
        .navbar-pos .nav-link::after {
            display: none;
        }
        .navbar-pos .btn-logout {
            width: 100%;
            margin-top: 1rem;
            text-align: center;
        }
    }
</style>

<nav class="navbar navbar-expand-lg navbar-pos">
    <div class="container">
        <a class="navbar-brand" href="#">Point Of Sale</a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                {{-- menu users hanya untuk admin (role_id)1 --}}
                @if (auth()->user()->role_id === 1)
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin/users') ? 'active' : '' }}" href="{{ route('admin.users') }}">Users</a>
                </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('jenis') ? 'active' : '' }}" href="{{ route('jenis.index') }}">Jenis</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('produk') ? 'active' : '' }}" href="{{ route('produk.index') }}">Produk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('penjualan') ? 'active' : '' }}" href="{{ route('penjualan.index') }}">Penjualan</a>
                </li>
            </ul>
            
            <form action="{{ route('logout') }}" method="POST" class="d-flex mb-0">
                @csrf
                <button type="submit" class="btn btn-logout">Logout</button>
            </form>
        </div>
    </div>
</nav>