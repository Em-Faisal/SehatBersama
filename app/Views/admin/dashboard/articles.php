<?= $this->extend('dashboard/layouts/main'); ?>
<?= $this->section('content'); ?>
<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Artikel Saya</h2>
            <p class="dashboard-subtitle">Buat dan Atur artikel</p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-12">
                    <a href="<?= base_url('dashboard-articles-create'); ?>" class="btn btn-success">Tambah Artikel Baru</a>
                </div>
            </div>
            <div class="row mt-4">
                <?php if (isset($articles) && is_array($articles) && count($articles) > 0): ?>
                    <?php foreach ($articles as $index => $article): ?>
                        <div class="col-12 col-md-6 col-lg-6" data-aos="fade-up" data-aos-delay="<?= ($index + 1) * 100; ?>">
                            <a href="<?= base_url('dashboard-articles-edit/' . $article['id']); ?>" class="component-article d-block">
                                <div class="article-thumbnail">
                                    <div class="article-image" style="background-image: url('<?= base_url('/images/' . $article['image']); ?>');"></div>
                                </div>
                                <div class="content">
                                    <div class="inner-content">
                                        <p class="categories-title"><?= esc($article['category_name']); ?></p>
                                        <h2 class="title"><?= esc($article['judul']); ?></h2>
                                        <p class="description"><?= esc(strip_tags(substr($article['isi'], 0, 200))); ?>...</p>
                                        <small class="text-muted">Dibuat: <?= date('d F Y H:i', strtotime($article['created_at'])); ?></small>
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
    </div>
</div>
<?= $this->endSection(); ?>
