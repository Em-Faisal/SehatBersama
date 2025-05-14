<?= $this -> extend('layouts/main');?>
<?= $this -> section('content');?>
<!-- Page Content -->
<div class="page-content page-details">
      <section
        class="store-breadcrumbs"
        data-aos="fade-down"
        data-aos-delay="100"
      >
        <div class="container">
          <div class="row">
            <div class="col-12">
              <nav>
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="<?= base_url('/'); ?>">Home</a>
                  </li>
                  <li class="breadcrumb-item"><a href="<?= base_url('kategori/' . $article['category_name']); ?>"><?= esc($article['category_name']); ?></a></li>
                  <li class="breadcrumb-item active"><?= esc($article['judul']); ?></li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </section>

      <section class="top-details">
        <div class="container">
          <div class="row">
            <div class="col-12 col-md-12 col-lg-10">
              <div class="article-image">
                <h1><?= esc($article['judul']); ?></h1>
                <img src="<?= base_url('/images/' . $article['image']); ?>" class="w-100" alt="<?= esc($article['judul']); ?>" >
                <div class="article-meta mt-3">
                  <span class="badge badge-primary"><?= esc($article['category_name']); ?></span>
                  <span class="text-muted ml-3"><?= date('d F Y', strtotime($article['created_at'])); ?></span>
                </div>
              </div>
              <div class="article-contents mt-4">
                <?= $article['isi']; ?>
              </div>

              <!-- Komentar Section -->
              <div class="comments-section mt-5">
                <h4>Diskusi (<?= count($comments); ?>)</h4>
                
                <!-- Form Komentar (hanya untuk user yang login) -->
                <?php if ($is_logged_in): ?>
                  <div class="comment-form mb-4">
                    <form action="<?= base_url('add-comment'); ?>" method="POST">
                      <input type="hidden" name="article_id" value="<?= $article['id']; ?>">
                      <div class="form-group">
                        <textarea class="form-control" name="comment" rows="3" placeholder="Tulis komentar Anda..." required></textarea>
                      </div>
                      <button type="submit" class="btn btn-primary">Kirim Komentar</button>
                    </form>
                  </div>
                <?php else: ?>
                  <div class="alert alert-info mb-4">
                    <p class="mb-0">Silakan <a href="<?= base_url('login'); ?>">login</a> untuk memberikan komentar.</p>
                  </div>
                <?php endif; ?>

                <!-- Daftar Komentar -->
                <div class="comments-list">
                  <?php if (!empty($comments)): ?>
                    <?php foreach ($comments as $comment): ?>
                      <div class="comment-item mb-4">
                        <div class="d-flex">
                          <div class="comment-avatar">
                            <?php if (!empty($comment['photo'])): ?>
                              <img src="<?= base_url('/uploads/photos/' . $comment['photo']); ?>" alt="<?= esc($comment['nama_lengkap']); ?>" class="rounded-circle" width="40" height="40" style="object-fit: cover;">
                            <?php else: ?>
                              <img src="<?= base_url('/assets/dist/images/user.png'); ?>" alt="Default Avatar" class="rounded-circle" width="40" height="40">
                            <?php endif; ?>
                          </div>
                          <div class="comment-content ml-3">
                            <div class="comment-header">
                              <h6 class="mb-1"><?= esc($comment['nama_lengkap']); ?></h6>
                              <small class="text-muted"><?= date('d F Y H:i', strtotime($comment['created_at'])); ?></small>
                            </div>
                            <div class="comment-text">
                              <?= esc($comment['comment']); ?>
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <p class="text-muted">Belum ada komentar. <?php if ($is_logged_in): ?>Jadilah yang pertama berkomentar!<?php endif; ?></p>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
</div>
<?= $this -> endSection(); ?>