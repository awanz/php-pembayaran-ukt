<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="description" content="Wizhart.">
    <title>List Mahasiswa</title>
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
          <li class="breadcrumb-item"><a href="#">Lists</a></li>
        </ul>
      </div>
      <div class="row">
      <div class="col-md-12">
      
          <div class="tile">
            <div>
              <a href="add.php"><button class="btn btn-primary" type="submit">Add data</button></a>
              <br><br>
            </div>         
            <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="sampleTable">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>NIM</th>
                      <th>Nama</th>
                      <th>Fakultas</th>
                      <th>Prodi</th>
                      <th>Nominal UKT</th>
                      <th>Semester</th>
                      <th>Status</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody id="listTable">                  
                  </tbody>
                </table>
              </div>
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
    <!-- Data table plugin-->
    <script type="text/javascript" src="../assets/js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="../assets/js/plugins/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
    <script>
      function getData() {
        let table = null;
        $.get("/pembayaran-ukt/ukt/all", function(data, status){
          data.forEach(function(data, index){
            table += "<tr>";
            table += "<td>"+(index+1)+"</td>";
            table += "<td>"+data.nim+"</td>";
            table += "<td>"+data.nama+"</td>";
            table += "<td>"+data.fakultas+"</td>";
            table += "<td>"+data.prodi+"</td>";
            table += "<td>"+data.nominal_ukt+"</td>";
            table += "<td>"+data.semester+"</td>";
            table += "<td>"+data.status_ukt+"</td>";
            table += "<td><button class='btn btn-primary' onclick=hapus("+data.nim+")>Delete</button><a href='edit.php?nim="+data.nim+"'><button class='btn btn-success'>Edit</button></a></td>";
            table += "<tr>";
          });
          $("#listTable").html(table);
        })
      }
      $( document ).ready(function() {
        getData();        
      });

      function hapus(nim) {
        $.ajax({
            url: "/pembayaran-ukt/ukt/"+nim,
            type: 'DELETE',
            success: function(result) {
                if (result.status) {
                    getData();
                    alert(result.status_message);
                }else{
                    getData();
                    alert(result.status_message);
                }
            }
        });
        console.log(tes+"deletee");
      }
      
    </script>
  </body>
</html>