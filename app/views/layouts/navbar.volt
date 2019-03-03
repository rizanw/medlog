<nav class="nav">
    <div class="logo-brand">
        <img class="red-nav active" src="{{ 'img/ver-wh.png' }}">
        <img class="white-nav" src="{{ 'img/ver-normal.png' }}">
    </div>
    <div id="nav-btn" class="nav-btn">
        <i class="fas fa-bars fa-2x"></i>
    </div>
    <div class="dropdown-container">
        <div class="nav-dropdown">
            <div class="nav-dropdown-btn">
                <a href="">
                    <i class="fas fa-user"></i>
                    Pasien
                </a>
            </div>
            <div class="dropdown-item">
                <ul>
                    <li><a href="{{ url('pasien/register') }}">Daftar</a></li>
                    <li><a href="{{ url('pasien/login') }}">Masuk</a></li>
                </ul>
            </div>
        </div>
        <div class="nav-dropdown">
            <div class="nav-dropdown-btn">
                <a href="">
                    <i class="fas fa-user-md"></i>
                    Dokter
                </a>
            </div>
            <div class="dropdown-item">
                <ul>
                    <li><a href="{{ url('dokter/register') }}">Daftar</a></li>
                    <li><a href="{{ url('dokter/login') }}">Masuk</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<div class="side-menu">
    <ul>
        <li>
            <a href="{{ url() }}">
                <i class="fas fa-user-md"> </i>
                <span>Dokter</span>
            </a>
            <div class="side-submenu">
                <ul>
                    <li>
                        <a href="{{ url('dokter/login') }}">
                            <span>Masuk</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('dokter/register') }}">
                            <span>Daftar</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li>
            <a href="{{ url() }}">
                <i class="fas fa-user"> </i>
                <span>Pasien</span>
            </a>
            <div class="side-submenu">
                <ul>
                    <li>
                        <a href="{{ url('pasien/login') }}">
                            <span>Masuk</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('pasien/register') }}">
                            <span>Daftar</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</div>