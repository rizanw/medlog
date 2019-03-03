<nav class="sidebar">
    <div class="side-header">
        <a href="{{ url('') }}">
            <img src="{{ url('img/ver-wh.svg') }}">
        </a>
    </div>
    <div class="side-menu">
        <ul>
            <li>
                <a href="{{ url('pasien/home') }}">
                    <i class="fas fa-home"> </i>
                    <span>Beranda</span>
                </a>
            </li>
            <li>
                <a href="{{ url() }}">
                    <i class="fas fa-users"> </i>
                    <span>Pasien</span>
                </a>
                <div class="side-submenu">
                    <ul>
                        <li>
                            <a href="{{ url('pasien/rekap') }}">
                                <i class="fas fa-list-ul"></i>
                                <span>Rekap</span>
                            </a>
                        </li>
                        
                    </ul>
                </div>
            </li>
            
        </ul>
    </div>
</nav>