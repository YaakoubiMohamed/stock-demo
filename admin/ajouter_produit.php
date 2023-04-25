<?php
ini_set('display_errors', 'on');
include 'bd.php';
$sql = 'SELECT * FROM `categorie`';
$result = $conn->query($sql);
if (isset($_POST['ajouter'])) {
    $code = $_POST['code'];
    $designation = $_POST['designation'];
    $prix_unitaire = $_POST['prix_unitaire'];
    $rayon = $_POST['rayon'];
    $categorie_id = $_POST['categorie_id'];
    $description = $_POST['description'];
    $errors = array();
    $file_name = $_FILES['photo']['name'];
    $file_size = $_FILES['photo']['size'];
    $file_tmp = $_FILES['photo']['tmp_name'];
    $file_type = $_FILES['photo']['type'];
    $file_ext = strtolower(end(explode('.',$_FILES['photo']['name'])));

    $photo = $file_name;
    echo $photo;
    $extensions = array("jpeg","jpg","png");

    if (in_array($file_ext,$extensions) === false) {
        $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
    }

    if ($file_size > 2097152) {
        $errors[] = 'File size must be exactly 2 MB';
    }

    if (empty($errors) === true) {
      move_uploaded_file($_FILES['photo']['tmp_name'],   '/opt/lampp/htdocs/projet/admin/images/'. $_FILES['photo']['name']);

        // move_uploaded_file($file_tmp, "/opt/lampp/htdocs/projet/admin/images/" . $file_name);
        echo "Upload Success";
    } else {
        print_r($errors);
    }
    $sql = "INSERT INTO `article`(`code`, `designation`, `prix_unitaire`, `rayon`, `photo`, `description`, `categorie_id`) VALUES  ('$code', '$designation', '$prix_unitaire', '$rayon', '$photo', '$description', '$categorie_id')";

    if ($conn->query($sql) === true) {
        echo 'New record created successfully';
        //header('location:produits.php');
    } else {
        echo 'Error: ' . $sql . '<br>' . $conn->error;
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Blank Page</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-photo img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="photo">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User photo">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="index.php" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Accueil
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="categories.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Categories
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="produits.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Produits
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="commandes.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Commandes
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="clients.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Clients
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="deco.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Deconnexion
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>New Article</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">New Article</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Create New Article</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
        <div class="container">
  <div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h2>Create New Article</h2>
            <form method="post" action=""  enctype="multipart/form-data">
                <div class="form-group">
                    <label for="code">Photo:</label>
                    <input type="file" class="form-control" id="code" name="photo" required>
                </div>
                <div class="form-group">
                    <label for="code">Code:</label>
                    <input type="text" class="form-control" id="code" name="code" required>
                </div>
                <div class="form-group">
                    <label for="designation">Designation:</label>
                    <input type="text" class="form-control" id="designation" name="designation" required>
                </div>
                <div class="form-group">
                    <label for="prix_unitaire">Prix Unitaire:</label>
                    <input type="number" step="0.01" class="form-control" id="prix_unitaire" name="prix_unitaire" required>
                </div>
                <div class="form-group">
                    <label for="rayon">Rayon:</label>
                    <input type="text" class="form-control" id="rayon" name="rayon" required>
                </div>
                <div class="form-group">
                    <label for="categorie_id">Categorie:</label>
                    <select class="form-control" id="categorie_id" name="categorie_id" required>
                    <option value="">Select a category</option>
                    <?php if ($result->num_rows > 0) {
                        // output data of each row
                        while ($row = $result->fetch_assoc()) { ?>
                        
                        <option value="<?php echo $row[
                            'id'
                        ]; ?>"><?php echo $row['libelle']; ?></option>
                        <?php }
                    } else {
                        echo '0 category';
                    } ?>
                        <!-- Add more options here -->
                    </select>
                </div>
                <div class="form-group">
                    <label for="rayon">Description:</label>
                    <textarea class="form-control" name="description"></textarea>
                </div>
                <button type="submit" name="ajouter" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>

</div>

        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          Footer
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
</body>
</html>
