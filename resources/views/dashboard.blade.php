<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<script src="dist/js/sweetalert/sweetalert.js"></script>


@php 
  include ('includes/dbconnection.php');
  



  //products
  $sql2 = $pdo->prepare("SELECT * FROM tblproducts");
  $sql2->execute();
  $numProds = 0;
  while ($row = $sql2->fetch(PDO::FETCH_OBJ)) {
    $numProds += 1;
  }

  //orders
  $sql3 = $pdo->prepare("SELECT * FROM tblorders");
  $sql3->execute();
  $numOrders = 0;
  while ($row = $sql3->fetch(PDO::FETCH_OBJ)) {
    $numOrders += 1;
  }

  //users
  $sql3 = $pdo->prepare("SELECT * FROM tblusers");
  $sql3->execute();
  $numUsers = 0;
  while ($row = $sql3->fetch(PDO::FETCH_OBJ)) {
    $numUsers += 1;
  }

  //revenue
  $sql4 = $pdo->prepare("SELECT * FROM tblorders");
  $sql4->execute();
  $sum = 0;
  $due = 0;
  while ($row = $sql4->fetch(PDO::FETCH_OBJ)) {
    $sum += $row->Total;
    $due += $row->Due;
  }
  $subtotal = $sum - $due;



  include ("includes/header.php"); 
@endphp

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
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
                <h3 class="card-title"> </h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
          
              <div class="card-body">
                <div class="row">
                  <div class="col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-box"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Products</span>
                                <span class="info-box-number">@php echo $numProds; @endphp</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </div>
                  <div class="col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-shopping-cart"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Sales</span>
                            <span class="info-box-number">@php echo $numOrders; @endphp</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                  </div>
                  <div class="col-md-3">
                  <div class="info-box">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-users"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Users</span>
                            <span class="info-box-number">@php echo $numUsers; @endphp</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-dollar-sign"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Total Revenue</span>
                            <span class="info-box-number">@php echo "$". $subtotal @endphp</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                  </div>
                </div>
              </div><!-- icons -->
              
             

              <div class="card-body">

                <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title">Recent Orders</h3>
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
                    @php 
                
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
                      @endphp
                    </tbody>
                </table>
                </div>
              </div>

              </div><!-- sell summary -->
        </div>
      </div><!-- /.container-fluid -->
      
    </div>
  </div>
  <!-- /.content-wrapper -->

<?php include("includes/footer.php") ?>