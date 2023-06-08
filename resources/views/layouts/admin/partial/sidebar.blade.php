<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>General</h3>
        <ul class="nav side-menu">
            <li><a href="{{route('dashboard.')}}"><i class="fa fa-home"></i> Dashboard</a>
            </li>
            <li><a><i class="fa fa-edit"></i> Master Data <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{route('dashboard.kategori.index')}}">Kategori</a></li>
                    <li><a href="{{route('dashboard.tempat_buku.index')}}">Tempat Buku</a></li>
                    <li><a href="{{route('dashboard.buku.index')}}">Buku</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-tasks" aria-hidden="true"></i> Peminjaman <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{route('dashboard.peminjaman.pending')}}">Pending</a></li>
                    <li><a href="{{route('dashboard.peminjaman.berlangsung')}}">Berlangsung</a></li>
                    <li><a href="{{route('dashboard.peminjaman.ditolak')}}">Ditolak</a></li>
                </ul>
            </li>
            <li><a href="{{route('dashboard.rekapan.index')}}"><i class="fa fa-archive" aria-hidden="true"></i> Rekapan</a>
            </li>
        </ul>
    </div>

</div>