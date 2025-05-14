<ul class="navbar-nav d-none d-lg-flex ml-auto">
    <li class="nav-item dropdown">
    <a
        href="#"
        class="nav-link"
        id="navbarDropdown"
        role="button"
        data-toggle="dropdown"
    >
    </a>
    <div class="dropdown-menu">
        <a href="<?= base_url('dashboard-profiles'); ?>" class="dropdown-item"
        >Dashboard</a
        >
        <a href="<?= base_url('dashboard-password'); ?>" class="dropdown-item"
        >Settings</a
        >
        <div class="dropdown-divider"></div>
        <a href="/" class="dropdown-item">Logout</a>
    </div>
    </li>
    </a>
</ul>
<ul class="navbar-nav d-block d-lg-none">
    <li class="nav-item">
    <a href="<?= base_url('dashboard-profiles'); ?>" class="dropdown-item"
        >Dashboard</a>
    </li>
    <li class="nav-item">
    <a href="<?= base_url('dashboard-password'); ?>" class="dropdown-item"
        >Settings</a>
    </li>
    <li class="nav-item">
    <a href="<?= base_url('home'); ?>" class="dropdown-item">Keluar</a>
    </li>
</ul>