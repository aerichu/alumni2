<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Purple Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="css/style.css">
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <!-- End layout styles -->
</head>
<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth">
        <div class="row flex-grow">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left p-5">
              <h4>Hello! let's get started</h4>
              <h6 class="font-weight-light">Sign in to continue.</h6>
              <form class="pt-3" novalidate action="<?= base_url('home/aksi_login') ?>" method="post">
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Username" name="username">
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password" name="pw">
                    <div class="input-group-append">
                      <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                        <i class="mdi mdi-eye"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="g-recaptcha" data-sitekey="6Lc4hyAqAAAAAII6iyuoLStoTtQFhP4_FKGMl_R_"></div>
                <br/>
                <div class="mt-3 d-grid gap-2">
                  <button class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
                </div>
                <a href="#" class="auth-link text-primary">Forgot password?</a>
              </div>
              <div class="text-center mt-4 font-weight-light"> Don't have an account? <a href="http://localhost:8080/home/register" class="text-primary">Create</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- content-wrapper ends -->
  </div>
  <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="js/off-canvas.js"></script>
<script src="js/misc.js"></script>
<script src="js/settings.js"></script>
<script src="js/todolist.js"></script>
<script src="js/jquery.cookie.js"></script>

<script>
  document.getElementById('myForm').addEventListener('submit', function(event) {
    var response = grecaptcha.getResponse();
    if (response.length === 0) {
                // reCAPTCHA is not verified
                alert("Please complete the reCAPTCHA.");
                event.preventDefault();
              }
            });
          </script>

          <script>
            const togglePassword = document.querySelector('#togglePassword');
            const passwordField = document.querySelector('#exampleInputPassword1');

            togglePassword.addEventListener('click', function () {
    // Toggle the type attribute
    const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordField.setAttribute('type', type);

    // Toggle the eye icon
    this.classList.toggle('mdi-eye');
    this.classList.toggle('mdi-eye-off');
  });
</script>

<!-- endinject -->
</body>
</html>