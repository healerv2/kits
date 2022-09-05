<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="{{ route('dashboard') }}">{{ $settings->nama_komunitas }}</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="#">KITS</a>
    </div>
    <ul class="sidebar-menu">
      <li class="menu-header">Dashboard</li>
      <li class="{{ Request::route()->getName() == 'dashboard' ? ' active' : '' }}"><a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>
      @if (auth()->user()->level == 1)
      <li class="menu-header">Menu</li>
      <li class="{{ Request::route()->getName() == 'users.index' ? ' active' : '' }}"><a class="nav-link" href="{{ route('users.index') }}"><i class="fas fa-users"></i> <span>Users</span></a></li>

      <li class="{{ Request::route()->getName() == 'kategori.index' ? ' active' : '' }}"><a class="nav-link" href="{{ route('kategori.index') }}"><i class="fas fa-book"></i><span>Kategori Materi</span></a></li>

      <li class="{{ Request::route()->getName() == 'tutorials.index' ? ' active' : '' }}"><a class="nav-link" href="{{ route('tutorials.index') }}"><i class="fas  fa-folder"></i><span>Tutorial</span></a></li>

      <li class="{{ Request::route()->getName() == 'kegiatans.index' ? ' active' : '' }} "><a class="nav-link" href="{{ route('kegiatans.index') }}"><i class="fas fa-calendar"></i><span>Kegiatan</span></a></li>

      <li class="{{ Request::route()->getName() == 'kegiatans.list' ? ' active' : '' }} "><a class="nav-link" href="{{ route('kegiatans.list') }}"><i class="fas fa-calendar"></i><span>List Kegiatan</span></a></li>

      <li><a class="nav-link" href="#"><i class="fas fa-image"></i><span>Galery</span></a></li>

      <li><a class="nav-link" href="#"><i class="fas fa-database"></i><span>Votting</span></a></li>

      <li class="{{ Request::route()->getName() == 'angkatan.index' ? ' active' : '' }}"><a class="nav-link" href="{{ route('angkatan.index') }}"><i class="fas fa-globe"></i> <span>Angkatan</span></a></li>

      <li class="{{ Request::route()->getName() == 'kits-peduli.index' ? ' active' : '' }}"><a class="nav-link" href="{{ route('kits-peduli.index') }}"><i class="fas fa-heart"></i> <span>KITS Peduli</span></a></li>

      <li class="{{ Request::route()->getName() == 'kits-peduli.list' ? ' active' : '' }}"><a class="nav-link" href="{{ route('kits-peduli.list') }}"><i class="fas fa-heart"></i> <span>Data KITS Peduli</span></a></li>

      <li class="{{ Request::route()->getName() == 'settings.index' ? ' active' : '' }}"><a class="nav-link" href="{{ route('settings.index') }}"><i class="fas fa-cogs"></i> <span>Setting</span></a></li>
      <li class="{{ Request::route()->getName() == 'log.index' ? ' active' : '' }}"><a class="nav-link" href="{{ route('log.index') }}"><i class="fas fa-inbox"></i> <span>Activity Log</span></a></li>
      
      {{-- Akses Pembina --}}
      @elseif (auth()->user()->level == 2)
      <li class="menu-header">Menu</li>
      <li class="{{ Request::route()->getName() == 'users.index' ? ' active' : '' }}"><a class="nav-link" href="{{ route('users.index') }}"><i class="fas fa-users"></i> <span>Users</span></a></li>

      <li class="{{ Request::route()->getName() == 'kategori.index' ? ' active' : '' }}"><a class="nav-link" href="{{ route('kategori.index') }}"><i class="fas fa-book"></i><span>Kategori</span></a></li>

      <li class="{{ Request::route()->getName() == 'tutorials.index' ? ' active' : '' }}"><a class="nav-link" href="{{ route('tutorials.index') }}"><i class="fas  fa-folder"></i><span>Tutorial</span></a></li>

      <li class="{{ Request::route()->getName() == 'kegiatan.index' ? ' active' : '' }} "><a class="nav-link" href="{{ route('kegiatan.index') }}"><i class="fas fa-calendar"></i><span>Kegiatan</span></a></li>

     {{--  <li><a class="nav-link" href="#"><i class="fas fa-image"></i><span>Galery</span></a></li>

      <li><a class="nav-link" href="#"><i class="fas fa-database"></i><span>Votting</span></a></li> --}}

      <li class="{{ Request::route()->getName() == 'angkatan.index' ? ' active' : '' }}"><a class="nav-link" href="{{ route('angkatan.index') }}"><i class="fas fa-globe"></i> <span>Angkatan</span></a></li>

      <li><a class="nav-link" href="#"><i class="fas fa-heart"></i> <span>KITS Peduli</span></a></li>

      <li class="{{ Request::route()->getName() == 'settings.index' ? ' active' : '' }}"><a class="nav-link" href="{{ route('settings.index') }}"><i class="fas fa-cogs"></i> <span>Setting</span></a></li>

      {{-- Akses Alumni --}}
      @elseif (auth()->user()->level == 3)
      <li class="menu-header">Menu</li>
      <li class="{{ Request::route()->getName() == 'users.index' ? ' active' : '' }}"><a class="nav-link" href="{{ route('users.index') }}"><i class="fas fa-users"></i> <span>Users</span></a></li>

      <li class="{{ Request::route()->getName() == 'tutorials.index' ? ' active' : '' }}"><a class="nav-link" href="{{ route('tutorials.index') }}"><i class="fas  fa-folder"></i><span>Tutorial</span></a></li>

      <li class="{{ Request::route()->getName() == 'kegiatans.index' ? ' active' : '' }} "><a class="nav-link" href="{{ route('kegiatans.index') }}"><i class="fas fa-calendar"></i><span>Kegiatan</span></a></li>

      {{-- <li><a class="nav-link" href="#"><i class="fas fa-image"></i><span>Galery</span></a></li>

      <li><a class="nav-link" href="#"><i class="fas fa-database"></i><span>Votting</span></a></li> --}}

      <li class="{{ Request::route()->getName() == 'kits-peduli.index' ? ' active' : '' }}"><a class="nav-link" href="{{ route('kits-peduli.index') }}"><i class="fas fa-heart"></i> <span>KITS Peduli</span></a></li>

      {{-- Akses Siswa --}}
      @else
      <li class="menu-header">Menu</li>
      <li class="{{ Request::route()->getName() == 'users.index' ? ' active' : '' }}"><a class="nav-link" href="{{ route('users.index') }}"><i class="fas fa-users"></i> <span>Users</span></a></li>

      <li class="{{ Request::route()->getName() == 'tutorials.index' ? ' active' : '' }}"><a class="nav-link" href="{{ route('tutorials.index') }}"><i class="fas  fa-folder"></i><span>Tutorial</span></a></li>

      <li class="{{ Request::route()->getName() == 'kegiatans.index' ? ' active' : '' }} "><a class="nav-link" href="{{ route('kegiatans.index') }}"><i class="fas fa-calendar"></i><span>Kegiatan</span></a></li>

      {{-- <li><a class="nav-link" href="#"><i class="fas fa-image"></i><span>Galery</span></a></li>

      <li><a class="nav-link" href="#"><i class="fas fa-database"></i><span>Votting</span></a></li> --}}

      <li class="{{ Request::route()->getName() == 'kits-peduli.index' ? ' active' : '' }}"><a class="nav-link" href="{{ route('kits-peduli.index') }}"><i class="fas fa-heart"></i> <span>KITS Peduli</span></a></li>

      @endif
    </ul>       
  </aside>
</div>