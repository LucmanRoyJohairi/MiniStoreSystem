<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<script src="dist/js/sweetalert/sweetalert.js"></script>

@php 
  include("includes/dbconnection.php");
  include("includes/header.php"); 
@endphp

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Add Product</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Product Page</li>
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

                    <form action="addProduct" method="POST" name="formproduct" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Product Name</label>
                                    <input type="text" class="form-control" name="Name" placeholder="Product Name" required>
                                </div>

                                <div class="form-group" >
                                  <label>Category</label>
                                  <select class="form-control" name="category" required>
                                      <option value="" disabled selected>Category</option>
                                      @php 
                                          $sql = $pdo->prepare("SELECT * FROM tblcategory order by catId desc");
                                          $sql->execute();
                                          while($row=$sql->fetch(PDO::FETCH_ASSOC)){
                                              extract($row);
                                              @endphp
                                              <option>@php echo $row['category']; @endphp</option>
                                          @php
                                          }
                                      @endphp
                                  
                                  </select>
                                

                              
                                <div class="form-group">
                                    <label>Purchase Price</label>
                                    <input type="number" min="1" step="1" class="form-control" name="purchaseprice" placeholder="Purchase Price" required>
                                </div>
                                <div class="form-group">
                                    <label>Sales Price</label>
                                    <input type="number" min="1" step="1" class="form-control" name="salesprice" placeholder="Sales Price" required>
                                </div>
                            </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Stock left</label>
                                    <input type="number" min="1" step="1" class="form-control" name="stockleft" placeholder="stock remaining" required>
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                   <textarea name="description"  class="form-control"  rows="4" placeholder="description"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Product image</label>
                                    <input type="file" class="input-group" name="productimage" required>
                                </div>
                            </div>
                            
                        </div>
                       

                    
                </div>
                <div class="card-footer">
                    <button type="submit" name="btnAdd" class="btn btn-info">ADD</button>
                </div>
                </form>
        </div>

      </div><!-- /.container-fluid -->
      
    </div>
  </div>
  <!-- /.content-wrapper -->


<php include("includes/footer.php") ?>