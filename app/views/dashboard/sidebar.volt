<nav class="sidebar">
    <div class="side-header">
        <a href="{{ url('') }}">
            <img src="{{ url('img/ver-wh.svg') }}">
        </a>
    </div>
    <div class="side-menu">
        <ul>
            <li>
                <a href="{{ url('dokter/home') }}">
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
                            <a href="{{ url('dokter/lihatpasien') }}">
                                <i class="fas fa-list-ul"></i>
                                <span>Daftar Pasien</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('dokter/tambahpasien') }}">
                                <i class="fas fa-user-plus"></i>
                                <span>Tambah Pasien</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <a href="{{ url() }}">
                    <i class="fas fa-cog"> </i>
                    <span>Pengaturan</span>
                </a>
                <div class="side-submenu">
                    <ul>
                        <li>
                            <a href="{{ url() }}">
                                <i class="fas fa-clipboard-list"></i>
                                <span>Template SOAP</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>