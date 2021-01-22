<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<script src="dist/js/sweetalert/sweetalert.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>

@php
  include("includes/dbconnection.php");
 
  include ("includes/header.php"); 

  if(isset($_POST['btnUpdate'])){
    $categoryId = $_POST['categoryid'];
    $newCat = $_POST['categoryname'];
    

    $updatetCat = $pdo->prepare("Update tblcategory set category = '$newCat' where catID = '$categoryId' ");
    //$updatetCat->bindParam(':category', $newCat);
    if($updatetCat->execute()){
      echo '<script type="text/javascript">
      jQuery(function validation(){
          swal({
          icon: "success",
          title: "Category Updated",
          button: "Ok",
          });
          
      });
    </script>';
    }

  }
@endphp

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Category</h1>
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
                  <form role="form" action="addCategory" method="POST">
                    @php 
                      
                      if(isset($_POST['btnedit'])){
                        $edit = $_POST['btnedit'];
                        $sql = $pdo->prepare("select * from tblcategory where catId = '$edit'");
                        $sql->execute();

                        if($sql){
                          $row=$sql->fetch(PDO::FETCH_OBJ);
                          echo '
                          <div class="row">
                          <div class="col-md-4">
                              <div class="form-group">
                                  <label>Category</label>
                                  <input type="hidden" class="form-control" name="categoryid" value="'.$row->catId.'" placeholder="Category">
                                  <input type="text" class="form-control" name="categoryname" value="'.$row->category.'" placeholder="Category" >
                              </div>
                              

                              <button type="submit" name="btnUpdate" class="btn btn-info">Update</button>
                          
                          </div>';
                          //echo $row->catId;
                        }


                      }else{
                        echo '
                        <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Category</label>
                                <input type="text" class="form-control" name="categoryname" placeholder="Category">
                            </div>
                            
                            <button type="submit" name="btnAdd" class="btn btn-success">Add</button>
                        
                        </div>';
                      }
                    
                    @endphp

                    
                        
                        <div class="col-md-8">
                            <table id="categoryData" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @php 
                                     $selectCat = $pdo->prepare("SELECT * FROM tblcategory order by catId desc");
                                     $selectCat->execute();
                                     while($row=$selectCat->fetch(PDO::FETCH_OBJ)){
                                         echo '
                                             <tr>
                                                <td>'.$row->catId.'</td>
                                                <td>'.$row->category.'</td>
                                                <td>
                                                </form>
                                                <form role="form" action="deleteCategory" method="POST">
                                                  <button type="submit" value="'.$row->catId.'" class="btn btn-danger" name="btndel"><span class="fas fa-trash-alt"></span></button>
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

                   
                  
                  </form>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  
                </div>
              
            </div>
      </div><!-- /.container-fluid -->
      
    </div>
  </div>
  <!-- /.content-wrapper -->

  <!-- <script>
    $(document).ready(function(){
      $('#categoryData').DataTable();
    });
  </script>       -->
<?php include("includes/footer.php") ?>