<nav
      class="navbar navbar-expand-lg navbar-light navbar-store fixed-top navbar-fixed-top"
      data-aos="fade-down"
    >
      <div class="container">
        <a href="<?= base_url('home'); ?>" class="navbar-brand">
          <img src="<?= base_url('/assets/dist/images/logo.svg'); ?>" alt="Logo" />
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarResponsive"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a href="<?= base_url('home'); ?>" class="nav-link">Home</a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('kategori'); ?>" class="nav-link">Kategori</a>
            </li>
            <li class="nav-item">
              <form action="<?= base_url('home'); ?>" method="get" class="form-inline my-2 my-lg-0">
                <div class="input-group">
                  <input type="text" class="form-control rounded" placeholder="Cari artikel..." name="search" value="<?= $search ?? '' ?>">
                  <div class="input-group-append">
                    <button class="btn btn-outline-primary" type="submit">
                      <i class="fas fa-search"></i>
                    </button>
                  </div>
                </div>
              </form>
            </li>
          </ul>
          <!-- Desktop Menu -->
          <ul class="navbar-nav d-none d-lg-flex">
            <li class="nav-item dropdown">
              <a
                href="#"
                class="nav-link"
                id="navbarDropdown"
                role="button"
                data-toggle="dropdown"
              >
              <?php if (isset($profiles['photo']) && !empty($profiles['photo'])) : ?>
                  <img src="<?= base_url('/uploads/photos/' . $profiles['photo']) ?>" class="profile-picture rounded-circle mr-2 w-25">
              <?php else : ?>
                  <img src="<?= base_url('/assets/dist/images/user.jpg'); ?>" alt="Default Photo Profile" class="profile-picture rounded-circle mr-2">
              <?php endif; ?>
                Hi, <?= session()->get('username'); ?>
              </a>
              <div class="dropdown-menu">
                <a href="<?= base_url('dashboard-profiles'); ?>" class="dropdown-item">Dashboard</a>
                <a href="<?= base_url('dashboard-password'); ?>" class="dropdown-item"
                  >Settings</a
                >
                <div class="dropdown-divider"></div>
                <a href="<?= base_url('logout'); ?>" class="dropdown-item">Logout</a>
              </div>
            </li>
            <a href="#" class="nav-link d-inline-block mt-2">
              <img src="<?= base_url('/assets/dist/images/icon-cart.svg'); ?>" alt="" />
            </a>
          </ul>
          <ul class="navbar-nav d-block d-lg-none">
            <li class="nav-item">
                <a href="#" class="nav-link">Hi, <?= session()->get('username') ?? 'Guest'; ?></a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('dashboard-profiles'); ?>" class="nav-link d-inline-block">Dashboard</a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('dashboard-password'); ?>" class="nav-link d-inline-block">Settings</a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('logout'); ?>" class="nav-link d-inline-block">Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
