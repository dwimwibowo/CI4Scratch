<?=$this->extend("admin/layout/master")?>

<?=$this->section("appTitle")?>
  CodeIgniter 4 From Scratch - User Show
<?=$this->endSection()?>
  
<?=$this->section("content")?>
  <div class="card card-success card-outline w-100">
    <div class="card-header">
      <h5 class="m-0"><?= $cardTitle; ?></h5>
    </div>
    <div class="card-body">
        <form>
            <div class="form-group row">
                <label for="firstName" class="col-sm-2 col-form-label">First Name</label>
                <div class="col-sm-10">
                    <input id="firstName" name="firstName" type="text" readonly class="form-control-plaintext" value="<?= $user->first_name; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="lastName" class="col-sm-2 col-form-label">Last Name</label> 
                <div class="col-sm-10">
                    <input id="lastName" name="lastName" type="text" readonly class="form-control-plaintext" value="<?= $user->last_name; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email</label> 
                <div class="col-sm-10">
                    <input id="email" name="email" type="text" readonly class="form-control-plaintext" value="<?= $user->email; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label for="img" class="col-sm-2 col-form-label">Photo</label> 
                <div class="col-sm-10">
                    <img src="<?= imgAssets($userImgFolder, $user->user_id.".".$user->img_ext); ?>" id="img" class="img-thumbnail" alt="..." />
                </div>
            </div>
            <div class="form-group row">
                <label for="role" class="col-sm-2 col-form-label">Role</label>
                <div class="col-sm-10">
                    <input id="role" name="role" type="text" readonly class="form-control-plaintext" value="<?= $roles[$user->role_id]; ?>">
                </div>
            </div>
            <div class="form-group row">
                <div class="offset-2 col-sm-10">
                    <button name="back" type="button" class="btn btn-success" onclick="goBack();">Back</button>
                </div>
            </div>
        </form>
    </div>
  </div><!-- /.card -->
<?=$this->endSection()?>