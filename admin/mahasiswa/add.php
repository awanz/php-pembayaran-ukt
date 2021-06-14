<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <title>Mahasiswa Edit</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="../assets/css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body class="app sidebar-mini">
    <?php include_once("../includes/header.php"); ?>
    <?php include_once("../includes/sidebar.php"); ?>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-users"></i> Mahasiswa</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="#">Mahasiswa</a></li>
          <li class="breadcrumb-item"><a href="#">Edit</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                          <input id="nim" name="nim" class="form-control" type="text" placeholder="NIM" required>
                        </div>
                        <div class="form-group">
                          <input id="nama" name="nama" class="form-control" type="text" placeholder="Nama" required>
                        </div>
                        <div class="form-group">
                          <input id="prodi" name="prodi" class="form-control" type="text" placeholder="Program Studi" required>
                        </div>
                        <div class="form-group">
                          <input id="fakultas" name="fakultas" class="form-control" type="text" placeholder="Fakultas" required>
                        </div>
                        <div class="form-group">
                          <input id="nominal_ukt" name="nominal_ukt" class="form-control" type="number" placeholder="Nominal UKT" required>
                        </div>
                        <div class="form-group">
                          <input id="semester" name="semester" class="form-control" type="text" placeholder="Semester" required>
                        </div>
                    </div>
                </div>
                <div class="tile-footer">
                    <a href="list.php" class="btn btn-danger" type="submit">Cancel</a>
                    <button class="btn btn-primary" type="submit" onclick="save()">Save</button>
                </div>
            </div>
        </div>
      </div>
    </main>
    <!-- Essential javascripts for application to work-->
    <script src="../assets/js/jquery-3.3.1.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="../assets/js/plugins/pace.min.js"></script>
    <script type="text/javascript">
      
      function save() {
        let dataPost =  {
                          nim: $("#nim").val(),
                          nama: $("#nama").val(),
                          prodi: $("#prodi").val(),
                          fakultas: $("#fakultas").val(),
                          nominal_ukt: $("#nominal_ukt").val(),
                          semester: $("#semester").val(),
                          status_ukt: "0",
                        };
        $.ajax({
            url: "/pembayaran-ukt/ukt",
            type: 'POST',
            data: JSON.stringify(dataPost),
            success: function(result) {
              console.log(result);
              if (result.status) {
                alert(result.status_message);
              }else{
                alert(result.status_message);
              }
            }
        }).fail(function() {
            alert( "Error, Try again with new data!" );
        });
      }
      
    </script>
  </body>
</html>