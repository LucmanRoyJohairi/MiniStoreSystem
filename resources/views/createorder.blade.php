<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<script src="dist/js/sweetalert/sweetalert.js"></script>
<!-- date-range-picker -->
<script src="plugins/daterangepicker/daterangepicker.js"></script>

@php
  include('includes/dbconnection.php');
 
  
  function show_products($pdo){
    echo "here";
    $output = '';
    $sql = $pdo->prepare('select * from tblproducts order by productName asc');
    $sql->execute();
    $result = $sql->fetchAll();


    foreach($result as $row){
      $output .= '<option value="'.$row["productId"].'">'.$row["productName"].'</option>';

    }
    return $output;
  }
  
  
  include("includes/header.php"); 

  //submit order button
  
function datas(){
  $id = $_GET['id'];

    $sql = $pdo->prepare('select * from tblproducts where productId = :p');
    $sql->bindParam(":p", $id);
    $sql->execute();

    $row = $sql->fetch(PDO::FETCH_ASSOC);

    $response = $row;

    header('Content_type: application/json');

    echo json_encode($response);

}

@endphp

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Order Page</h1>
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
              
            <form action="addOrder" method="POST" name="formproduct">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Customer Name</label>
                                <input type="text" class="form-control" name="customername" placeholder="Customer Name" required>
                            </div>
                        </div> <!-- col-md-6 -->


                        <div class="col-md-6">
                          <div class="form-group">
                                <label>Date</label>
                                <input type="date" class="form-control" name="date" placeholder="Customer Name" required>
                            </div>
                        </div><!-- col-md-6 -->
                        
                      
                        
                    </div><!--Row-->

                </div><!-- customer and date -->


                <div class="card-body">
                  <div class="col-md-12">
                  <div style="overflow-x:auto">
                  <table class="table table-striped" id="prodtable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Search Product</th>
                            <th>Stock</th>
                            <th>Price</th>
                            <th>Enter Quantity</th>
                            <th>Total</th>
                            <th>
            
                            <!-- <a href="products.php?id='.$row->productId.'" class="btn btn-danger btnadd" name="del" role="button"><span class="fas fa-trash-alt" title="delete"></span></a> -->
                            <button type="button" name="btnAdd" class="btn btn-success btnadd" ><span class="fas fa-plus"></span></button>

                            </th>
                            


                        </tr>
                    </thead>
                  </table>
                  <!-- overflow -->
                  </div>   
                  </div>
                  

                </div><!-- this is for table -->


                <div class="card-body">

                  <div class="row">
                    
                    <div class="col-md-6">
                    <div class="form-group">
                        <label>Total</label>
                        <input type="text" class="form-control total2" name="total" readonly>
                      </div>
                      <div class="form-group">
                        <label>Paid</label>
                        <input type="text" class="form-control paid2" name="paid">
                      </div>
                      <div class="form-group">
                        <label>Due</label>
                        <input type="text" class="form-control due2" name="due" readonly>
                      </div>
                    </div>
                  </div>
                </div><!-- tax -->

                
                <div class="card-footer">
                    <button type="submit" name="btnOrder" class="btn btn-info btnSubmitOrder">Submit Order</button>
                </div>
            </div>
          </form>
      </div><!-- /.container-fluid -->
      
    </div>
  </div>
  <!-- /.content-wrapper -->
  <script>
     $(document).ready(function(){
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $totalAmount = parseInt(0,10);
      $(document).on('click', '.btnadd', function(){
        var html='';
        html+='<tr>';

        html += '<td><input type="hidden" class="form-control pname" name="productname[]" required></td>';

        html += '<td><select class="form-control productid" name="productId[]" ><option value="">Select option </option>@php echo show_products($pdo); @endphp</select></td>';
        
        html += '<td><input type="text" class="form-control stock" name="productStock[]" readonly></td>';
        html += '<td><input type="text" class="form-control price" name="price[]" readonly></td>';
        html += '<td><input type="text" class="form-control qty" name="qty[]" required></td>';
        html += '<td><input type="text" class="form-control total" name="total[]" readonly></td>';

        html += '<center><td><button type="button" name="remove" class="btn btn-danger btn-sm btnremove"><span class="fas fa-times" title="delete"></span></button></td></center>';
        html += '</tr>';
        $('#prodtable').append(html);


        $(".productid").on('change', function(){
          var tr = $(this).parent().parent();
          var productid = this.value;
          $.ajax({
            url:'values',
            method: "get",
            data: {
              id:productid},
            success: function(data){
              
              $a = JSON.parse(data)
              
              $(".stock").val($a.productStock);
              $(".price").val($a.salePrice);
             
              //console.log(parseInt($num2,10)  * parseInt($num1,10));
              
              
              
            }
          })
        })

        $(".qty").on('change', function(e){
         
          var tr = $(this).parent().parent();
          $num1 = $(".qty").val();
          $num2 = $(".price").val();

          $amount = parseInt($num1,10);
          $amount2 = parseInt($num2,10);
          console.log($amount);

          $totalAmount += $amount * $amount2;
          $(".total").val($amount * $amount2);
          $(".total2 ").val($totalAmount);
          

          
        })

        $(".paid2").on('change', function(e){
          $paid = parseInt($(".paid2").val(),10);
          $(".due2 ").val($totalAmount - $paid);
        })
      })
      
      $(document).on('click', '.btnremove', function(){
        $(this).closest('tr').remove();
      })


     
     });
  </script>

<?php include("includes/footer.php") ?>