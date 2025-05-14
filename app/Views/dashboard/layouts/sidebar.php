<!-- Sidebar -->
<div class="border-right" id="sidebar-wrapper">
    <div class="sidebar-heading text-center">
    <img src="<?= base_url('assets/dist/images/logo.svg'); ?>" alt="" class="my-4 w-50" />
    </div>
    <?php $role = session()->get('lvl_profile'); ?>
    
    <div class="list-group list-group-flush">
    <a
        href="<?= base_url('dashboard-profiles'); ?>"
        class="list-group-item list-group-item-action"
    >
        Profil Saya
    </a>
    <?php if ($role == 'admin') : ?>
        <a
        href="<?= base_url('dashboard-articles'); ?>"
        class="list-group-item list-group-item-action"
    >
        Artikel Saya
    </a>
    <?php endif; ?>
    <a
        href="<?= base_url('dashboard-password'); ?>"
        class="list-group-item list-group-item-action"
    >
        Ganti Password
    </a>
    <a
        href="<?= base_url('home'); ?>"
        class="list-group-item list-group-item-action"
    >
        Keluar
    </a>
    </div>
</div>