<?= $this -> extend('home/main');?>
<?= $this -> section('content');?>
<div class="page-content page-home">
      <section class="store-carousel">
        <div class="container">
          <div class="row">
            <div class="col-lg-12" data-aos="zoom-in">
              <div
                id="storeCarousel"
                class="carousel slide"
                data-ride="carousel"
              >
                <ol class="carousel-indicators">
                  <li
                    class="active"
                    data-target="#storeCarousel"
                    data-slide-to="0"
                  ></li>
                  <li data-target="#storeCarousel" data-slide-to="1"></li>
                  <li data-target="#storeCarousel" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img
                      src="<?= base_url('/assets/dist/images/banner.jpg'); ?>"
                      alt="Carousel Image"
                      class="d-block w-100"
                    />
                  </div>
                  <div class="carousel-item">
                    <img
                      src="<?= base_url('/assets/dist/images/banner.jpg'); ?>"
                      alt="Carousel Image"
                      class="d-block w-100"
                    />
                  </div>
                  <div class="carousel-item">
                    <img
                      src="<?= base_url('/assets/dist/images/banner.jpg'); ?>"
                      alt="Carousel Image"
                      class="d-block w-100"
                    />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="store-trend-categories">
        <div class="container">
          <div class="row">
          <?php $role = session()->get('lvl_profile'); ?>
          <?php if ($role == 'admin') : ?>
            <div
              class="col-6 col-md-4 col-lg-4"
              data-aos="fade-up"
              data-aos-delay="100"
            >
              <a href="<?= base_url('home'); ?>" class="component-categories d-flex">
                <div class="categories-image">
                  <img
                    src="<?= base_url('assets/dist/images/categories-article.svg'); ?>"
                    alt=""
                    class="mxw-50"
                  />
                </div>
                <p class="categories-text">Artikel</p>
              </a>
            </div>
            <div
              class="col-6 col-md-4 col-lg-4"
              data-aos="fade-up"
              data-aos-delay="200"
            >
              <a href="<?= base_url('kategori'); ?>" class="component-categories d-flex">
                <div class="categories-image">
                  <img
                    src="<?= base_url('assets/dist/images/categories-discover.svg'); ?>"
                    alt=""
                    class="mxw-50"
                  />
                </div>
                <p class="categories-text">Kategori</p>
              </a>
            </div>
            <div
              class="col-6 col-md-4 col-lg-4"
              data-aos="fade-up"
              data-aos-delay="400"
            >
              <a href="<?= base_url('dashboard-articles'); ?>" class="component-categories d-flex">
                <div class="categories-image">
                  <img
                    src="<?= base_url('assets/dist/images/categories-community.svg'); ?>"
                    alt=""
                    class="mxw-50"
                  />
                </div>
                <p class="categories-text">Tambah Artikel</p>
              </a>
            </div>
          </div>
          <?php endif; ?>
          <?php if ($role == 'user') : ?>
            <div
              class="col-6 col-md-6 col-lg-6"
              data-aos="fade-up"
              data-aos-delay="100"
            >
              <a href="<?= base_url('home'); ?>" class="component-categories d-flex">
                <div class="categories-image">
                  <img
                    src="<?= base_url('assets/dist/images/categories-article.svg'); ?>"
                    alt=""
                    class="mxw-50"
                  />
                </div>
                <p class="categories-text">Artikel</p>
              </a>
            </div>
            <div
              class="col-6 col-md-6 col-lg-6"
              data-aos="fade-up"
              data-aos-delay="200"
            >
              <a href="<?= base_url('kategori'); ?>" class="component-categories d-flex">
                <div class="categories-image">
                  <img
                    src="<?= base_url('assets/dist/images/categories-discover.svg'); ?>"
                    alt=""
                    class="mxw-50"
                  />
                </div>
                <p class="categories-text">Kategori</p>
              </a>
            </div>
          <?php endif; ?>
        </div>
      </section>
      <section class="new-health-article">
        <div class="container">
          <div class="row">
            <div class="col-12" data-aos="fade-up">
              <h5>Artikel Terbaru</h5>
            </div>
          </div>
          <div class="row">
            <?php if (isset($articles) && is_array($articles) && count($articles) > 0): ?>
              <?php 
                // Ambil artikel pertama untuk tampilan besar
                $firstArticle = array_shift($articles); 
              ?>
              <div class="col-12 col-md-12 col-lg-7" data-aos="fade-up" data-aos-delay="100">
                <a href="<?= base_url('articles/' . $firstArticle['slug']); ?>" class="component-article d-block">
                  <div class="article-thumbnail">
                    <div class="article-image" style="background-image: url('<?= base_url('/images/' . $firstArticle['image']); ?>');"></div>
                  </div>
                  <div class="content">
                    <div class="inner-content">
                      <p class="categories-title"><?= esc($firstArticle['category_name']); ?></p>
                      <h2 class="title"><?= esc($firstArticle['judul']); ?></h2>
                      <p class="description"><?= esc(strip_tags($firstArticle['isi'])); ?></p>
                    </div>
                  </div>
                </a>
              </div>

              <?php foreach (array_slice($articles, 0, 4) as $index => $article): ?>
                <div class="col-12 <?= $index === 0 ? 'col-md-12 col-lg-5' : 'col-md-6 col-lg-4' ?>" data-aos="fade-up" data-aos-delay="<?= ($index + 2) * 100; ?>">
                  <a href="<?= base_url('articles/' . $article['slug']); ?>" class="component-article d-block">
                    <div class="article-thumbnail">
                      <div class="article-image" style="background-image: url('<?= base_url('/images/' . $article['image']); ?>');"></div>
                    </div>
                    <div class="content">
                      <div class="inner-content">
                        <p class="categories-title"><?= esc($article['category_name']); ?></p>
                        <h2 class="title"><?= esc($article['judul']); ?></h2>
                        <?php if ($index === 0): ?>
                          <p class="description"><?= esc(strip_tags($article['isi'])); ?></p>
                        <?php endif; ?>
                      </div>
                    </div>
                  </a>
                </div>
              <?php endforeach; ?>
            <?php else: ?>
              <div class="col-12">
                <p class="text-center">Tidak ada artikel yang tersedia.</p>
              </div>
            <?php endif; ?>
          </div>

          <!-- Pagination -->
          <?php if (isset($pager)): ?>
          <div class="row mt-4">
              <div class="col-12">
                  <nav aria-label="Page navigation">
                      <?= $pager->links('articles', 'bootstrap_pagination') ?>
                  </nav>
              </div>
          </div>
          <?php endif; ?>
        </div>
      </section>
    </div>
  </div>
<?= $this -> endSection(); ?>