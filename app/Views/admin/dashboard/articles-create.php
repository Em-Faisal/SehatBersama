<?= $this->extend('dashboard/layouts/main'); ?>
<?= $this->section('content'); ?>
<div
    class="section-content section-dashboard-home"
    data-aos="fade-up"
    >
    <div class="container-fluid">
        <div class="dashboard-heading">
        <h2 class="dashboard-title">Membuat Artikel</h2>
        <p class="dashboard-subtitle">Buat artikel menarik untuk masyarakat</p>
        </div>
        <div class="dasboard-content">
        <div class="row">
            <div class="col-12">
            <?php if (session()->getFlashdata('errors')) : ?>
            <div class="alert alert-danger">
                <?php
                $errors = session()->getFlashdata('errors');
                if (is_array($errors)) {
                foreach ($errors as $errors) {
                    echo "<p>$errors</p>";
                }
                } else {
                    echo $errors;
                }
                ?>
            </div>
            <?php endif; ?>
            <form action="<?= base_url('/proses_menambahkan_artikel/')?>" method="post" enctype="multipart/form-data">
                <div class="card">
                <div class="card-body">
                    <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                        <label>Judul</label>
                        <input type="text" class="form-control" name="judul" required />
                        <?php if (session('errors.judul')) : ?>
                            <small class="text-danger"><?= session('errors.judul') ?></small>
                        <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <label>Kategori</label>
                        <select name="categories_id" class="form-control" required>
                            <option disabled selected>Silahkan Pilih</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= esc($category['id']); ?>"><?= esc($category['name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (session('errors.categories_id')) : ?>
                            <small class="text-danger"><?= session('errors.categories_id') ?></small>
                        <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                        <label>Isi Artikel</label>
                        <textarea name="isi" id="editor"></textarea>
                        <?php if (session('errors.isi')) : ?>
                            <small class="text-danger"><?= session('errors.isi') ?></small>
                        <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <label>Thumbnails</label>
                        <input type="file" class="form-control" name="image" required/>
                        <p class="text-mute">
                            Akan ditampilkan sebagai thumbnail artikel
                        </p>
                        <?php if (session('errors.image')) : ?>
                            <small class="text-danger"><?= session('errors.image') ?></small>
                        <?php endif; ?>
                        </div>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col text-right">
                        <button
                        type="submit"
                        class="btn btn-success px-5"
                        >
                        Save Now
                        </button>
                    </div>
                    </div>
                </div>
                </div>
            </form>
            </div>
        </div>
        </div>
    </div>
    </div>

<script>
    // Initialize CKEditor
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });
</script>

<?= $this->endSection(); ?>
