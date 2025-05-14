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
    <link href="https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css" rel="stylesheet"
            type="text/css" />
  </head>
  

  <body>
  <div class="page-dashboard">
    <div class="d-flex" id="wrapper" data-aos="fade-right">
    <?= $this-> include('dashboard/layouts/sidebar'); ?>

      <div id="page-content-wrapper">
        <nav
          class="navbar navbar-expand-lg navbar-light navbar-store fixed-top fixed-top"
          data-aos="fade-down"
        >
          <div class="container-fluid">
            <button
              class="btn btn-secondary d-md-none mr-auto mr-2"
              id="menu-toggle"
            >
              &laquo; Menu
            </button>
            <button
              class="navbar-toggler"
              type="button"
              data-toggle="collapse"
              data-target="#navbarSupportedContent"
            >
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <?= $this-> include('dashboard/layouts/menubar'); ?>
            </div>
          </div>
        </nav>
        <?= $this->renderSection('content'); ?>
      </div>
    </div>
  </div>
   

   <?= $this-> include('layouts/footer'); ?>
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
    <script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>
    <script>
      ClassicEditor.create(document.querySelector("#editor"))
        .then((editor) => {
          console.log(editor);
        })
        .catch((error) => {
          console.error(error);
        });
    </script>
    <script type="text/javascript"
    src="https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js"></script>
    <script>
            new FroalaEditor("div#froala-editor");
    </script>
  </body>
</html>
