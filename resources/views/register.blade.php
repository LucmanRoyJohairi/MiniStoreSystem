<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<script src="dist/js/sweetalert/sweetalert.js"></script>

@php 
    include ("includes/dbconnection.php");
    include ("includes/header.php");
    
@endphp

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
          
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Register Page</h1>
          </div><!-- /.col -->
          
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Starter Page</li>
            </ol>
            
          </div>
          <!-- /.col -->
          
        </div><!-- /.row -->
        <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="addUser" method="POST">
                  
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="Name" placeholder="Name" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="Password" placeholder="Password" required>
                            </div>
                            <div class="form-group">
                                <label >Email address</label>
                                <input type="email" class="form-control"  name="Email" placeholder="Enter email" required>
                            </div>

                            <div class="form-group" >
                                <label>User Type</label>

                                <select class="form-control" name="Usertype" required>
                                    <option value="" disabled selected>Select user type</option>
                                    <option>User</option>
                                    <option>Admin</option>
                                
                                </select>
                            </div>
                            <button type="submit" name="btnSubmit" class="btn btn-info">Submit</button>
                        
                        </div>
                        <div class="col-md-8">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email Address</th>
                                        <th>Password</th>
                                        <th>User Type</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php 
                                        $sql = $pdo->prepare("SELECT * FROM tblusers order by userId desc");
                                        $sql->execute();
                                        while($row=$sql->fetch(PDO::FETCH_OBJ)){
                                            echo '
                                                <tr>
                                                    <td>'.$row->userId.'</td>
                                                    <td>'.$row->username.'</td>
                                                    <td>'.$row->email.'</td>
                                                    <td>'.$row->password.'</td>
                                                    <td>'.$row->userType.'</td>
                                                    <td>
                                                    </form>
                                                    <form role="form" action="deleteUser" method="POST">
                                                        <button type="submit" value="'.$row->userId.'" class="btn btn-danger" name="del"><span class="fas fa-trash-alt"></span></button>
                                                    </form> 
                                                    </td> 
                                                </tr>
                                            ';
                                        }
                                    @endphp
                                </tbody>
                            </table>
                        </div>
                    </div>

                   
                  
                
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  
                </div>
              
            </div>
      </div><!-- /.container-fluid -->
    </div>
  </div>
  <!-- /.content-wrapper -->
  


<?php include("includes/footer.php") ?>