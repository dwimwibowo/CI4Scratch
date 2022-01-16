<!doctype html>
<html lang="en">
  <head>
    <title>Datatable in CodeIgniter 4</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

     <!-- bootstrap 5 CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css"/>
  </head>
  <body>
  <div class="container-fluid py-4">
    <h4 class="text-center"> Datatable in CodeIgniter 4 </h3>
    <div class="row mt-4">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title">Users </h4>
                </div>

                <div class="card-body">
                    <table class="table table-striped table-bordered" id="userTable">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Photo</th>
                            </tr>
                        </thead>

                        <tbody>
                        <?php 
                            if (count($users) > 0):
                                foreach ($users as $user): ?>
                                    <tr>
                                        <td><?= $user['user_id'] ?></td>
                                        <td><?= $user['first_name'] ?></td>
                                        <td><?= $user['last_name'] ?></td>
                                        <td><?= $user['email'] ?></td>
                                        <td><img src="<?= $user['img'] ?>" alt="..." height="100" width="75" /></td>
                                    </tr>
                                <?php endforeach;
                            else: ?>
                                <tr rowspan="1">
                                    <td colspan="4">
                                        <h6 class="text-danger text-center">No user found</h6>
                                    </td>
                                </tr>
                            <?php endif ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
  </div>
   
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#userTable").dataTable();
        });
    </script>
  </body>
</html>