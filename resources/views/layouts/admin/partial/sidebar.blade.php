<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>General</h3>
        <ul class="nav side-menu">
            <li><a href="{{route('dashboard.')}}"><i class="fa fa-home"></i> Home</a>
            </li>
            <li><a><i class="fa fa-edit"></i> Master Data <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{route('dashboard.kategori.index')}}">Kategori</a></li>
                    <li><a href="{{route('dashboard.tempat_buku.index')}}">Tempat Buku</a></li>
                    <li><a href="{{route('dashboard.buku.index')}}">Buku</a></li>
                </ul>
            </li>
        </ul>
    </div>

</div>