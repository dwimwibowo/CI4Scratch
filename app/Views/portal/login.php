<?=$this->extend("portal/layout/master")?>

<?=$this->section("appTitle")?>
  CodeIgniter 4 From Scratch - Home
<?=$this->endSection()?>
  
<?=$this->section("content")?>

<div class="login-box mx-auto">
    <?php
        if(isset($errors)) {
            $msgError = array();
            if(is_array($errors))
            {
                foreach ($errors as $error) {
                    array_push($msgError, esc($error));
                }
            }
            else { $msgError[] = esc($errors); }
            
            echo msgInfo('Failed', join("<br />", $msgError), 3);
        }
        else if(session()->has("errors")) { echo msgInfo('Failed', session("errors"), 3); }
    ?>
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="../" class="h1"><b>Admin</b>LTE</a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Sign in to start your session</p>

            <?= form_open(base_url().'/login'); ?>
                <div class="input-group mb-3">
                    <input id="email" name="email" type="email" class="form-control" placeholder="Email" value="<?= set_value('email'); ?>" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <sp an class="fas fa-envelope"></sp>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input id="password" name="password" type="password" class="form-control" placeholder="Password" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">Sign In</button>
                        <a href="./" class="btn btn-success">Back</a>
                    </div>
                    <div class="col-md-6">
                        <a href="forgot-password.html">I forgot my password</a>
                    </div>
                </div>
            <?= form_close(); ?>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.login-box -->

<?=$this->endSection()?>

<?=$this->section("footer")?>
  <!-- Page specific script -->
  <script>
    $(function () {
        $("#email").select().focus();
    });
  </script>
<?=$this->endSection()?>