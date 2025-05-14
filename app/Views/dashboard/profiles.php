<?= $this->extend('dashboard/layouts/main'); ?>
<?= $this->section('content'); ?>
    <!-- Section Content -->
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Profil Saya</h2>
                <p class="dashboard-subtitle">Ubah Profil</p>
            </div>
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">   
                                    <?php if (isset($profiles['photo']) && !empty($profiles['photo'])) : ?>
                                        <img src="<?= base_url('uploads/photos/' . $profiles['photo']) ?>" class="profile-picture rounded-circle mr-2 w-25">
                                    <?php else : ?>
                                        <img src="<?= base_url('/assets/dist/images/user.jpg'); ?>" alt="Default Photo Profile" class="profile-picture rounded-circle mr-2">
                                    <?php endif; ?>
                                    <form action="<?= base_url('/update_photo/'. $profiles['id']);?>" method="post" enctype="multipart/form-data">
                                        <label for="upload-photo" class="btn btn-primary mt-3">Upload Foto</label>
                                        <label for="save" class="btn btn-success mt-3">Save</label>
                                        <input type="file" id="upload-photo" name="photo" style="display: none;" />
                                        <button type="submit" id="save" style="display: none;"></button>
                                        <?php if (session()->getFlashdata('success')): ?>
                                            <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
                                        <?php endif; ?>
                                        <?php if (session()->getFlashdata('errors')): ?>
                                            <div class="alert alert-danger"><?= session()->getFlashdata('errors'); ?></div>
                                        <?php endif; ?>
                                    </form>
                                </div>
                            <h3 class="profile-username text-center"><?= $profiles['nama_lengkap'] ?? 'Tidak Diketahui'; ?></h3>
                            <p class="text-muted text-center"><?= $profiles['bio'] ?? 'Bio belum diisi'; ?></p>
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
                                        <form action="<?= base_url('/update_profile/' . $profiles['id']); ?>" method="post">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <div class="form-group">
                                                                <label for="">Nama Lengkap</label>
                                                                <input type="text" class="form-control" name="nama_lengkap" placeholder="Nama Lengkap" value="<?= old('nama_lengkap', $profiles['nama_lengkap']); ?>">
                                                                <?php if (session('errors.nama_lengkap')) : ?>
                                                                    <small class="text-danger"><?= session('errors.nama_lengkap') ?></small>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="">Jenis Kelamin</label>
                                                                <select name="jns_kelamin" id="jns_kelamin" class="form-control" value="<?= old('jns_kelamin', $profiles['jns_kelamin']); ?>">
                                                                    <option disabled selected>Pilih Jenis Kelamin</option>
                                                                    <option value="Laki-Laki" <?php if (old('jns_kelamin', $profiles['jns_kelamin']) == 'Laki-Laki') echo 'selected'; ?>>Laki-Laki</option>
                                                                    <option value="Perempuan" <?php if (old('jns_kelamin', $profiles['jns_kelamin']) == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
                                                                </select>
                                                                <?php if (session('errors.jns_kelamin')) : ?>
                                                                    <small class="text-danger"><?= session('errors.jns_kelamin') ?></small>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="">Bio</label>
                                                                <input type="text" class="form-control" name="bio" value="<?= old('bio', $profiles['bio']); ?>">
                                                                <?php if (session('errors.bio')) : ?>
                                                                    <small class="text-danger"><?= session('errors.bio') ?></small>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="">No Telepon</label>
                                                                <input type="text" class="form-control" name="telp" value="<?= old('telp', $profiles['telp']); ?>">
                                                                <?php if (session('errors.telp')) : ?>
                                                                    <small class="text-danger"><?= session('errors.telp') ?></small>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="">Tempat Lahir</label>
                                                                <input type="text" class="form-control" name="tmp_lahir" value="<?= old('tmp_lahir', $profiles['tmp_lahir']); ?>">
                                                                <?php if (session('errors.tmp_lahir')) : ?>
                                                                    <small class="text-danger"><?= session('errors.tmp_lahir') ?></small>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="">Tanggal Lahir</label>
                                                                <input type="date" class="form-control" name="tgl_lahir" value="<?= old('tgl_lahir', $profiles['tgl_lahir']); ?>">
                                                                <?php if (session('errors.tgl_lahir')) : ?>
                                                                    <small class="text-danger"><?= session('errors.tgl_lahir') ?></small>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="">Kode Pos</label>
                                                                <input type="text" class="form-control" name="kode_pos" value="<?= old('kode_pos', $profiles['kode_pos']); ?>">
                                                                <?php if (session('errors.kode_pos')) : ?>
                                                                    <small class="text-danger"><?= session('errors.kode_pos') ?></small>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="">Kota</label>
                                                                <input type="text" class="form-control" name="kota" value="<?= old('kota', $profiles['kota']); ?>">
                                                                <?php if (session('errors.kota')) : ?>
                                                                    <small class="text-danger"><?= session('errors.kota') ?></small>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="">Provinsi</label>
                                                                <input type="text" class="form-control" name="provinsi" value="<?= old('provinsi', $profiles['provinsi']); ?>">
                                                                <?php if (session('errors.provinsi')) : ?>
                                                                    <small class="text-danger"><?= session('errors.provinsi') ?></small>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="">Alamat</label>
                                                                <textarea name="alamat" id="alamat" cols="30" rows="5" class="form-control"> <?= old('alamat', $profiles['alamat']); ?></textarea>
                                                                <?php if (session('errors.alamat')) : ?>
                                                                    <small class="text-danger"><?= session('errors.alamat') ?></small>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col text-right">
                                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection(); ?>


