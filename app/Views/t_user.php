<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <!-- <div class="col-lg-5 d-none d-lg-block bg-register-image"></div> -->
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="mt-5 mb-5 login-input" action="<?=base_url('home/aksi_t_user')?>" method="post" onsubmit="return validateForm()">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="yourUsername" class="form-label">Username</label>
                                        <input type="text" class="form-control form-control-user" id="exampleFirstName"
                                            placeholder="Your name" name="nama">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="yourUsername" class="form-label">Email</label>
                                        <input type="text" class="form-control form-control-user" id="" placeholder="Password" name="email">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="yourUsername" class="form-label">Password</label>
                                        <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" name="pass">
                                    </div>
                                </div>

                                
                                <div class="form-group">
                            <label for="edit-level">Level</label>
                            <select class="form-control" name="level" id="edit-level">
                                        <option value="admin">admin</option>
                                        <option value="siswa">siswa</option>
                                        <option value="guru">guru</option>
                                        <option value="wakil-kurikulum">wakil kurikulum</option>
                            </select>
                        </div>
                                <button class="tn login-form__btn submit w-100b btn btn-primary">Add now!</button>
                            </form>
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        function validateForm() {
            var password = document.getElementById("exampleInputPassword").value;
            if (password.length < 8) {
                alert("Password must be at least 8 characters long.");
                return false;
            }
            return true;
        }
    </script>
</body>
