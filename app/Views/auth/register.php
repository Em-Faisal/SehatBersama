<?= $this -> extend('auth/main');?>
<?= $this -> section('content');?>

<div class="page-content page-auth" id="register" data-email-exists="<?= session()->getFlashdata('email_exists') ? 'true' : 'false'; ?>">
      <div class="section-store-auth" data-aos="fade-up">
        <div class="container">
          <div class="row align-items-center justify-content-center row-login">
            <div class="col-lg-5">
              <h2>
                Mulai hidup sehat,
                Kapan lagi?
              </h2>
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
              <form class="mt-3" action="<?= base_url('proses_register'); ?>" method="post">
                  <div class="form-group">
                    <label>Full Name</label>
                    <input
                      type="text"
                      class="form-control"
                      v-model="name"
                      name="nama_lengkap"
                      autofocus
                    />
                  </div>
                  <div class="form-group">
                    <label>Username</label>
                    <input
                      type="text"
                      class="form-control"
                      v-model="username"
                      name="username"
                      autofocus
                    />
                  </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input
                      type="email"
                      class="form-control"
                      v-model="email"
                      name="email"
                    />
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" />
                  </div>
                  <div class="form-group">
                    <label for="">Confirm Password</label>
                    <input type="password" class="form-control" name="confirm_password" />
                  </div>
                  <button type="submit" class="btn btn-success btn-block mt-4">Daftar</button>
                  <a href="/login" class="btn btn-signup btn-block mt-4"
                    >Sudah punya akun</a
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
