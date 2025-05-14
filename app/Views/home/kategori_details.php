<?= $this->extend('home/main'); ?>
<?= $this->section('content'); ?>
<div class="page-content page-home">
    <section class="store-trend-categories">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12" data-aos="fade-up">
                    <h5>Artikel Kategori <?= esc($category['name']); ?></h5>
                    <p class="text-muted">Menampilkan <?= $total ?> artikel</p>
                </div>
                <div class="col-md-6 ml-auto" data-aos="fade-up">
                    <form action="<?= current_url() ?>" method="get" class="form-inline justify-content-end">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Cari artikel..." name="search" value="<?= $search ?? '' ?>">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fa fa-search"></i> Cari
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <?php if (isset($articles) && is_array($articles) && count($articles) > 0): ?>
                    <?php foreach ($articles as $article): ?>
                        <div class="col-12 col-md-6 col-lg-4" data-aos="fade-up">
                            <a href="<?= base_url('article/' . $article['slug']); ?>" class="component-article d-block">
                                <div class="article-thumbnail">
                                    <div class="article-image" style="background-image: url('<?= base_url('/images/' . $article['image']); ?>');"></div>
                                </div>
                                <div class="content">
                                    <div class="inner-content">
                                        <p class="categories-title"><?= esc($article['category_name']); ?></p>
                                        <h2 class="title"><?= esc($article['judul']); ?></h2>
                                        <p class="description"><?= esc(strip_tags(substr($article['isi'], 0, 100))); ?>...</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12">
                        <p class="text-center">Tidak ada artikel dalam kategori ini.</p>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Pagination -->
            <?php if (isset($pager) && $total > 6): ?>
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
<?= $this->endSection(); ?> 