<?= $this -> extend('auth/main');?>
<?= $this -> section('content');?>
<div class="page-content page-auth">
      <div class="section-store-auth" data-aos="fade-up">
        <div class="container">
          <div class="row align-items-center row-login">
            <div class="col-lg-6 text-center">
              <img
                src="<?= base_url('/assets/dist/images/login-placeholder.jpg'); ?>"
                alt=""
                class="w-50 mb-4 mb-lg-none"
              />
            </div>
            <div class="col-lg-5">
              <h2>
                Kesehatan adalah investasi paling berharga, jadi jagalah baik-baik.
              </h2>
              
              <form action="<?= base_url('proses_login'); ?>" method="post" class="mt-3">
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
                <div class="form-group">
                  <label>Email atau Username</label>
                  <input type="text" class="form-control w-75" name="email" />
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <input type="password" class="form-control w-75" name="password" />
                </div>
                <button type="submit" class="btn btn-success btn-block w-75 mt-4">Login</button>
                <a
                  href="/register"
                  class="btn btn-signup btn-block w-75 mt-4"
                  >Belum punya akun?</a
                >
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script>
      Vue.use(Toasted);

      var register = new Vue({
        el: "#register",
        mounted() {
          AOS.init();

          var emailExists = this.$el.dataset.emailExists === 'true';
          if (!emailExists) {
              this.$toasted.error(
              "Maaf, tampaknya email sudah terdaftar pada sistem kami.",
              {
                position: "top-center",
                className: "rounded",
                duration: 1000,
              }
            );
          }
        },
      });
    </script>
    
<?= $this -> endSection(); ?>