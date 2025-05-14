<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Store - Your Best Marketplace</title>

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link href="<?= base_url('/assets/dist/style/main.css'); ?>" rel="stylesheet" />
  </head>

   <?= $this->renderSection('content'); ?>

   <?= $this-> include('layouts/footer'); ?>

  <body>
    <!-- Bootstrap core JavaScript -->
    <script src="<?= base_url('/assets/plugins/jquery/jquery.min.js'); ?>"></script>
    <script src="<?= base_url('/assets/plugins/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
    <script src="<?= base_url('/assets/plugins/vue/vue.js')?>"></script>
    <script src="https://unpkg.com/vue-toasted"></script>
    
    <script src="<?= base_url('/assets/plugins/script/navbar-scroll.js')?>"></script>
  </body>
</html>
