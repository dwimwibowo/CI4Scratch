<?=$this->extend("portal/layout/master")?>

<?=$this->section("appTitle")?>
  CodeIgniter 4 From Scratch - Home
<?=$this->endSection()?>
  
<?=$this->section("content")?>

<div class="col-md-10">
  <div class="card">
    <div class="card-header">
      <h5 class="card-title m-0">Main</h5>
    </div>
    <div class="card-body">
      <h6 class="card-title">Special title treatment</h6>

      <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
      <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
  </div>
</div>
<aside class="col-md-2">
  <div class="card">
    <div class="card-header">
      <h5 class="card-title m-0">Left</h5>
    </div>
    <div class="card-body">
      <h6 class="card-title">Special title treatment</h6>

      <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
      <a href="#" class="btn btn-primary">Go somewhere</a>
    </div>
  </div>
</aside>

<?=$this->endSection()?>