<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<script src="dist/js/sweetalert/sweetalert.js"></script>



  @include ('includes.dbconnection.php');
  @include ("includes.header.php"); 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Orders Page</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Starter Page</li>
            </ol>
          </div><!-- /.col -->
          
        
        </div><!-- /.row -->
        <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
      
              <div class="card-body">
                <table class="table table-striped" id="prodtable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Customer Name</th>
                            <th>Order Date</th>
                            <th>Total</th>
                            <th>Paid</th>
                            <th>Due</th>
                            

                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                
                          $sql = $pdo->prepare("SELECT * FROM tblorders order by orderId desc");
                          $sql->execute();
                          while($row=$sql->fetch(PDO::FETCH_OBJ)){
                              echo '
                                  <tr>
                                      <td>'.$row->orderId.'</td>
                                      <td>'.$row->customerName.'</td>
                                      <td>'.$row->orderDate.'</td>
                                      <td>'.$row->Total.'</td>
                                      <td>'.$row->Paid.'</td>
                                      <td>'.$row->Due.'</td>
                                      

                                  </tr>';
                          }
                      ?>
                    </tbody>
                </table>
                
              </div>
        </div>
        
      </div><!-- /.container-fluid -->
      
    </div>
  </div>
  <!-- /.content-wrapper -->


<?php include("includes/footer.php") ?>