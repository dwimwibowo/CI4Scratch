<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper pt-2">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h5 class="m-0"><?= $pageTitle; ?></h5>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <?= $this->include('admin/layout/breadcumb'); ?>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <?= $this->renderSection("content") ?>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->