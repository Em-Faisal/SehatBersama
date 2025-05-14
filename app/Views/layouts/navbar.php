<nav
      class="navbar navbar-expand-lg navbar-light navbar-store fixed-top navbar-fixed-top"
      data-aos="fade-down"
    >
      <div class="container">
        <a href="<?= base_url('/'); ?>" class="navbar-brand">
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
            <li class="nav-item active">
              <a href="<?= base_url('/'); ?>" class="nav-link">Home</a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('kategori'); ?>" class="nav-link">Kategori</a>
            </li>
            <li class="nav-item">
              <form action="<?= base_url('/'); ?>" method="get" class="form-inline my-2 my-lg-0">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Cari artikel..." name="search" value="<?= $search ?? '' ?>">
                  <div class="input-group-append">
                    <button class="btn btn-outline-primary" type="submit">
                      <i class="fa fa-search"></i>
                    </button>
                  </div>
                </div>
              </form>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('register'); ?>" class="nav-link">Sign Up</a>
            </li>
            <li class="nav-item">
              <a
                href="<?= base_url('login'); ?>"
                class="btn btn-success nav-link px-4 text-white"
                >Sign In</a
              >
            </li>
          </ul>

          <!-- Mobile Menu -->
          <ul class="navbar-nav d-block d-lg-none mt-3">
            <li class="nav-item">
              <form action="<?= base_url('/'); ?>" method="get" class="form-inline">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Cari artikel..." name="search" value="<?= $search ?? '' ?>">
                  <div class="input-group-append">
                    <button class="btn btn-outline-primary" type="submit">
                      <i class="fa fa-search"></i>
                    </button>
                  </div>
                </div>
              </form>
            </li>
          </ul>
        </div>
      </div>
    </nav>