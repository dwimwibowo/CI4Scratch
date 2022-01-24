<?=$this->extend("admin/layout/master")?>

<?=$this->section("appTitle")?>
  CodeIgniter 4 From Scratch - Create User
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
        
        <?= form_open_multipart(base_url().'/admin/user', ['novalidate="novalidate"']); ?>
            <div class="form-group row">
                <label for="firstName" class="col-sm-2 col-form-label">First Name</label> 
                <div class="col-sm-10">
                    <input id="firstName" name="firstName" type="text" class="form-control" placeholder="First Name" value="<?= set_value('firstName'); ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="lastName" class="col-sm-2 col-form-label">Last Name</label> 
                <div class="col-sm-10">
                    <input id="lastName" name="lastName" type="text" class="form-control" placeholder="Last Name" value="<?= set_value('lastName'); ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email</label> 
                <div class="col-sm-10">
                    <input id="email" name="email" type="text" class="form-control" placeholder="Email" value="<?= set_value('email'); ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="img" class="col-sm-2 col-form-label">Photo</label> 
                <div class="col-sm-10">
                    <input type="file" class="form-control-file" id="imgFile" name="imgFile">
                </div>
            </div>
            <div class="form-group row">
                <label for="password" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="password" class="col-sm-2 col-form-label">Confirm Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="confirm" name="confirm" placeholder="Confirm Password" required>
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
                                echo '<option'.((set_value('role') == $role_id) ? ' selected="selected"' : '').' value="'.$role_id.'">'.$role.'</option>';
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="offset-2 col-sm-10">
                    <button name="submit" type="submit" class="btn btn-primary">Submit</button>
                    <a href="<?= base_url();?>/admin/user" class="btn btn-success">Back</a>
                </div>
            </div>
        <?= form_close(); ?>
    </div>
  </div><!-- /.card -->
<?=$this->endSection()?>