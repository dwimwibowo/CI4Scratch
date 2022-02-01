<?=$this->extend("admin/layout/master")?>

<?=$this->section("appTitle")?>
  CodeIgniter 4 From Scratch - Update User
<?=$this->endSection()?>

<?=$this->section("header")?>
  <!-- Ekko Lightbox -->
  <link rel="stylesheet" href="<?= base_url(); ?>/assets/plugins/ekko-lightbox/ekko-lightbox.css">
<?=$this->endSection()?>

<?=$this->section("pageTitle")?>
  User
<?=$this->endSection()?>
  
<?=$this->section("content")?>
  <div class="card card-warning card-outline w-100">
    <div class="card-header">
      <h5 class="m-0"><?= $cardTitle; ?></h5>
    </div>
    <div class="card-body">
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
            else if(session()->has("msgInfo")) { echo msgInfo('Success', session("msgInfo"), 1); }
        ?>
        
        <?= form_open_multipart(base_url().'/admin/user/edit/'.$user->user_id); ?>
            <div class="form-group row">
                <label for="firstName" class="col-sm-2 col-form-label">First Name</label> 
                <div class="col-sm-10">
                    <input id="firstName" name="firstName" type="text" class="form-control" placeholder="First Name" value="<?= set_value('firstName', $user->first_name); ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="lastName" class="col-sm-2 col-form-label">Last Name</label> 
                <div class="col-sm-10">
                    <input id="lastName" name="lastName" type="text" class="form-control" placeholder="Last Name" value="<?= set_value('lastName', $user->last_name); ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email</label> 
                <div class="col-sm-10">
                    <input id="email" name="email" type="text" class="form-control" placeholder="Email" value="<?= set_value('email', $user->email); ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="img" class="col-sm-2 col-form-label">Photo</label> 
                <div class="col-sm-10">
                    <input type="file" class="form-control-file" id="imgFile" name="imgFile"><br/>
                    <a href="<?= imgAssets($userImgFolder, $user->user_id.".".$user->img_ext); ?>" data-toggle="lightbox" data-title="Photo <?= $user->first_name." ".$user->last_name; ?>"  data-max-width="800" data-max-height="600">
                        <img src="<?= imgAssets($userImgFolder, $user->user_id.".".$user->img_ext); ?>" id="img" alt="..." class="img-thumbnail" style="max-width: 150px; max-height: 150px;" />
                    </a>
                </div>
            </div>
            <div class="form-group row">
                <label for="password" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
            </div>
            <div class="form-group row">
                <label for="password" class="col-sm-2 col-form-label">Confirm Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="confirm" name="confirm" placeholder="Confirm Password">
                </div>
            </div>
            <div class="form-group row">
                <label for="role" class="col-sm-2 col-form-label">Role</label>
                <div class="col-sm-10">
                    <select class="form-control" id="role" name="role">
                        <option value="">Select One</option>
                        <?php
                            foreach($roles as $role_id => $role)
                            {
                                echo '<option'.((set_value('role', $user->role_id) == $role_id) ? ' selected="selected"' : '').' value="'.$role_id.'">'.$role.'</option>';
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="offset-2 col-sm-10">
                    <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                    <a href="<?= base_url();?>/admin/user" class="btn btn-success">Back</a>
                    <input type="hidden" name="_method" value="PUT" />
                </div>
            </div>
        <?= form_close(); ?>
    </div>
  </div><!-- /.card -->
<?=$this->endSection()?>

<?=$this->section("footer")?>
  <!-- Ekko Lightbox -->
  <script src="<?= base_url(); ?>/assets/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>

  <!-- Page specific script -->
  <script>
    $(function () {
      $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox({
          alwaysShowClose: true
        });
      });
    });
  </script>
<?=$this->endSection()?>