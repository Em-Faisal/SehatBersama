<?= $this -> extend('home/main');?>
<?= $this -> section('content');?>
<div class="page-content page-home">
    <section class="all-categories">
    <div class="container">
        <div class="row">
        <div class="col-12 text-center" data-aos="fade-up">
            <h5>Pilih Kategori</h5>
        </div>
        </div>
        <div class="row">
            <?php if (isset($categories) && is_array($categories)): ?>
                <?php foreach ($categories as $index => $category): ?>
                    <div class="col-6 col-md-4 col-lg-4" data-aos="fade-up" data-aos-delay="<?= ($index + 1) * 100; ?>">
                        <a href="<?= base_url('kategori/' . $category['slug']); ?>" class="component-categories d-block">
                            <div class="categories-image">
                                <img src="<?= base_url('/assets/dist/images/' . $category['slug'] . '-kategori.png'); ?>" alt="<?= esc($category['name']); ?>" class="w-100" />
                            </div>
                            <p class="categories-text"><?= esc($category['name']); ?></p>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <p class="text-center">Tidak ada kategori yang tersedia.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
    </section>
<?= $this -> endSection(); ?>