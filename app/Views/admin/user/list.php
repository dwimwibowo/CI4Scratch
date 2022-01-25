<?=$this->extend("admin/layout/master")?>

<?=$this->section("appTitle")?>
  CodeIgniter 4 From Scratch - User
<?=$this->endSection()?>

<?=$this->section("header")?>
  <?=$this->include("admin/layout/header_datatable"); ?>
<?=$this->endSection()?>
  
<?=$this->section("content")?>
  <div class="card card-primary card-outline w-100">
    <?= form_open(base_url().'/admin/user', ['novalidate="novalidate"']); ?>
    <div class="card-header">
      <h5 class="m-0 float-left"><?= $cardTitle; ?></h5>

      <div class="btn-group float-right" role="group" aria-label="">
        <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="far fa-square"></i></button>
        <button name="submit" type="submit" class="btn btn-default btn-sm"><i class="far fa-trash-alt"></i></button>
        <a href="<?= base_url(); ?>/admin/user/new" class="btn btn-default btn-sm" title="Create"><i class="fas fa-plus"></i></a>
        <button type="button" class="btn btn-default btn-sm"><i class="fas fa-sync-alt"></i></button>
      </div>
    </div>
    <div class="card-body data-table">
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
      <table class="table table-striped table-hover" id="dataTable">
        <thead>
            <tr>
                <th>Id</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Photo</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
        <?php 
            if (count($users) > 0):
                foreach ($users as $user): ?>
                    <tr>
                        <td>
                          <div class="float-left"><input type="checkbox" value="<?= $user->user_id; ?>" id="chkData<?= $user->user_id; ?>" name="chkData[]"></div>
                          <?= $user->user_id; ?>
                        </td>
                        <td><?= $user->first_name; ?></td>
                        <td><?= $user->last_name; ?></td>
                        <td><?= $user->email; ?></td>
                        <td><img src="<?= imgAssets($userImgFolder, $user->user_id.".".$user->img_ext); ?>" alt="..." class="img-thumbnail" /></td>
                        <td>
                          <div class="btn-group-vertical" role="group" aria-label="">
                            <a href="<?= base_url(); ?>/admin/user/<?= $user->user_id; ?>" class="btn btn-success btn-sm" title="Detail"><i class="fas fa-search"></i></a>
                            <a href="<?= base_url(); ?>/admin/user/edit/<?= $user->user_id; ?>" class="btn btn-info btn-sm" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                            <a href="<?= base_url(); ?>/admin/user/remove/<?= $user->user_id; ?>" class="btn btn-danger btn-sm" title="Delete"><i class="fas fa-times"></i></a>
                          </div>
                        </td>
                    </tr>
                <?php endforeach;
            else: ?>
                <tr>
                    <td colspan="7">
                        <h6 class="text-danger text-center">No user found</h6>
                    </td>
                </tr>
            <?php endif ?>
        </tbody>
      </table>
    </div>
    <?= form_close(); ?>
  </div><!-- /.card -->
<?=$this->endSection()?>

<?=$this->section("footer")?>
  <?=$this->include("admin/layout/footer_datatable"); ?>

  <!-- Page specific script -->
  <script>
    $(function () {
      $("#dataTable").DataTable({
        paging: true,
        searching: true,
        ordering: true,
        info: true,
        responsive: true,
        lengthChange: false,
        autoWidth: true,
        buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
        columnDefs: [
          { width: "40px", targets: [0] },
          { width: "80px", targets: [4,5] },
          { className: 'text-center', targets: [0,4,5] },
          { orderable: false, targets: [4,5] }
        ]
      }).buttons().container().appendTo('#dataTable_wrapper .col-md-6:eq(0)');

      $('.checkbox-toggle').click(function () {
        var clicks = $(this).data('clicks')
        if (clicks) {
          //Uncheck all checkboxes
          $('.data-table input[type=\'checkbox\']').prop('checked', false)
          $('.checkbox-toggle .far.fa-check-square').removeClass('fa-check-square').addClass('fa-square')
        } else {
          //Check all checkboxes
          $('.data-table input[type=\'checkbox\']').prop('checked', true)
          $('.checkbox-toggle .far.fa-square').removeClass('fa-square').addClass('fa-check-square')
        }
        $(this).data('clicks', !clicks)
      })
    });
  </script>
<?=$this->endSection()?>