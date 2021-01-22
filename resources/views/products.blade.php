<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<script src="dist/js/sweetalert/sweetalert.js"></script>
<script src="http://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>

@php 
  include ('includes/dbconnection.php');
  include ("includes/header.php"); 
  //delete category
  if(isset($_GET['id'])){
    $delId = $_GET['id'];
    $del = $pdo->prepare("delete from tblproducts where productId = '$delId'");
    //echo $del->execute();
    if($del->execute()){
        
        echo '<script type="text/javascript">
        jQuery(function validation(){
            swal({
            icon: "success",
            title: "Product has been deleted.",
            button: "Ok",
            }); 
        });
        </script>';
        
    }else{
      echo '<script type="text/javascript">
        jQuery(function validation(){
            swal({
            icon: "error",
            title: "Failed to delete record.",
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
            <h1 class="m-0 text-dark">Products</h1>
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
                          <th>Name</th>
                          <th>Category</th>
                          <th>Purchase Price</th>
                          <th>Sale Price</th>
                          <th>Stock left</th>
                          <th>Description</th>
                          <th>Image</th>
                          <th>Delete</th>



                      </tr>
                  </thead>
                  <tbody>
                      @php 
                          $sql = $pdo->prepare("SELECT * FROM tblproducts order by productId desc");
                          $sql->execute();
                          while($row=$sql->fetch(PDO::FETCH_OBJ)){
                              echo '
                                  <tr>
                                      <td>'.$row->productId.'</td>
                                      <td>'.$row->productName.'</td>
                                      <td>'.$row->productCategory.'</td>
                                      <td>'.$row->purchasePrice.'</td>
                                      <td>'.$row->salePrice.'</td>
                                      <td>'.$row->productStock.'</td>
                                      <td>'.$row->productDescription.'</td>
                                      <td><img src="productimages/'.$row->productImage.'" class="img-rounded" width="40px" height="40px"/></td>
                                     
                                      <td>
                                        <form role="form" action="deleteProduct" method="POST">
                                          <button type="submit" value="'.$row->productId.'" class="btn btn-danger" name="btndel"><span class="fas fa-trash-alt"></span></button>
                                        </form>
                                        <!-- <a href="products.php?id='.$row->productId.'" class="btn btn-danger" name="del" role="button"><span class="fas fa-trash-alt" title="delete"></span></a> -->
                                      </td> 
                                  </tr>
                              ';
                          }
                      @endphp
                  </tbody>
                </table>
              </div>
        </div>
      </div><!-- /.container-fluid -->
      
    </div>
  </div>
  <!-- /.content-wrapper -->
  
  

<?php include("includes/footer.php") ?>