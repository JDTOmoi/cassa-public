<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Cassa Terra</title>

    <link rel="stylesheet" href="css/app.css">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @yield('headscripts')
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>

    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">
                    Cassa Terra
                </a>

                @auth
                <form action="{{route('produk')}}" method="GET" class="form-inline w-25 d-flex gap-2">
                    <input class = "form-control" type="search" name="search" placeholder="Cari Produk">
                    <button type = "submit" class="btn btn-outline-success">Cari</button>
                </form>
                @endauth

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <ul class="navbar-nav d-md-none">
                          @if(Auth::user() && Auth::user()->isAdmin() !== null && Auth::user()->isAdmin())
                            <li class="nav-item {{$activeProduk ?? ''}}">
                              <a class="nav-link {{$activeProduk ?? ''}}" href="{{route('admin.daftarproduk')}}">Produk</a>
                            </li>
                            <li class="nav-item {{$activeBrand ?? ''}}">
                              <a class="nav-link {{$activeBrand ?? ''}}" href="{{route('admin.daftarbrand')}}">Brand</a>
                            </li>
                            <li class="nav-item {{$activeCategory ?? ''}}">
                              <a class="nav-link {{$activeCategory ?? ''}}" href="{{route('admin.daftarcategory')}}">Kategori</a>
                            </li>
                            <li class="nav-item {{$activeTransaction ?? ''}}">
                              <a class="nav-link {{$activeTransaction ?? ''}}" href="{{route('admin.kirimtransaksi')}}">Send Transaction</a>
                            </li>
                            <li class="nav-item {{$activeDaftarOrder ?? ''}}">
                              <a class="nav-link {{$activeDaftarOrder ?? ''}}" href="{{route('admin.daftarorder')}}">Daftar Order</a>
                            </li>
                            <li class="nav-item {{$activeOrder ?? ''}}">
                              <a class="nav-link {{$activeOrder ?? ''}}" href="{{route('tambahorder')}}">Order</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link {{$activePort ?? ''}}" href="{{route('admin.portofolio')}}">Portofolio</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link {{$activeNews ?? ''}}" href="{{route('admin.berita')}}">Berita</a>
                            </li>

                          @else
                            <li class="nav-item {{$activeProduk ?? ''}}">
                              <a class="nav-link {{$activeProduk ?? ''}}" href="{{route('produk')}}">Produk</a>
                            </li>
                            <li class="nav-item {{$activeOrder ?? ''}}">
                              <a class="nav-link {{$activeOrder ?? ''}}" href="{{route('tambahorder')}}">Order</a>
                            </li>
                            <li class="nav-item {{$activePort ?? ''}}">
                              <a class="nav-link {{$activePort ?? ''}}" href="{{route('portofolio')}}">Portofolio</a>
                            </li>
                            <li class="nav-item {{$activeNews ?? ''}}">
                              <a class="nav-link {{$activeNews ?? ''}}" href="{{route('berita')}}">Berita</a>
                            </li>
                          @endif
                          <li class="nav-item">
                            <a class="nav-link {{$activeContact ?? ''}}" href="{{route('contact')}}">Kontak</a>
                          </li>
                    </ul>
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{route('vieworder')}}">View Orders</a>
                                    <a class="dropdown-item" href="{{route('viewtransaction')}}">View Transaction Records</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <a class="dropdown-item" style="color:red;" href="{{route('deleteuser')}}">Delete Account</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <nav class="navbar navbar-expand-lg navbar-light bg-light px-5">
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav">
              @if(Auth::user() && Auth::user()->isAdmin() !== null && Auth::user()->isAdmin())
                <li class="nav-item {{$activeProduk ?? ''}}">
                  <a class="nav-link {{$activeProduk ?? ''}}" href="{{route('admin.daftarproduk')}}">Produk</a>
                </li>
                <li class="nav-item {{$activeBrand ?? ''}}">
                  <a class="nav-link {{$activeBrand ?? ''}}" href="{{route('admin.daftarbrand')}}">Brand</a>
                </li>
                <li class="nav-item {{$activeCategory ?? ''}}">
                  <a class="nav-link {{$activeCategory ?? ''}}" href="{{route('admin.daftarcategory')}}">Kategori</a>
                </li>
                <li class="nav-item {{$activeTransaction ?? ''}}">
                  <a class="nav-link {{$activeTransaction ?? ''}}" href="{{route('admin.kirimtransaksi')}}">Send Transaction</a>
                </li>
                <li class="nav-item {{$activeDaftarOrder ?? ''}}">
                  <a class="nav-link {{$activeDaftarOrder ?? ''}}" href="{{route('admin.daftarorder')}}">Daftar Order</a>
                </li>
                <li class="nav-item {{$activeOrder ?? ''}}">
                  <a class="nav-link {{$activeOrder ?? ''}}" href="{{route('tambahorder')}}">Order</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{$activePort ?? ''}}" href="{{route('admin.portofolio')}}">Portofolio</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{$activeNews ?? ''}}" href="{{route('admin.berita')}}">Berita</a>
                </li>

              @else
                <li class="nav-item {{$activeProduk ?? ''}}">
                  <a class="nav-link {{$activeProduk ?? ''}}" href="{{route('produk')}}">Produk</a>
                </li>
                <li class="nav-item {{$activeOrder ?? ''}}">
                  <a class="nav-link {{$activeOrder ?? ''}}" href="{{route('tambahorder')}}">Order</a>
                </li>
                <li class="nav-item {{$activePort ?? ''}}">
                  <a class="nav-link {{$activePort ?? ''}}" href="{{route('portofolio')}}">Portofolio</a>
                </li>
                <li class="nav-item {{$activeNews ?? ''}}">
                  <a class="nav-link {{$activeNews ?? ''}}" href="{{route('berita')}}">Berita</a>
                </li>
              @endif

              <li class="nav-item">
                <a class="nav-link {{$activeContact ?? ''}}" href="{{route('contact')}}">Kontak</a>
              </li>
              </ul>
            </div>
          </nav>

        <main class="py-4">
            @yield('content')
        </main>

        @include('layouts.footer')
    </div>
</body>
</html>
