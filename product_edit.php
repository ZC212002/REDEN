<?php
	session_start();
  include_once "session_time_out_admin.php"; 
	require_once('layouts/header.php'); 
	require_once('layouts/left_sidebar.php'); 
?>

  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Product Edit and Update</a>
        </li>
      </ol>
      <html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Edit Product</title>  
  
  <style>
  .bootstrap-tagsinput {
   width: 100%;
  }
  </style>
 </head>
 <body>
  <div class="container">
   <br />
   <br />
   <br />
   <h2 align="center">Product Edit and Update</h2><br />
  
   <br />
   <a class='btn btn-primary' href='create_product.php' role="button">Create New Product</a>

   <div class="table-responsive">
    <div align="right">
     <p><b>Total Records - <span id="total_records"></span></b></p>
    </div>
    <table class="table table-bordered table-striped">
     <thead>
      <tr>
       <th>Product ID</th>
       <th>Product Name</th>
       <th>Product Description</th>
       <th>Product Price</th>
       <th>Product rrp</th>
       <th>Product quantity</th>
       <th>Product image</th>
       <th>Product date added</th>
     

      </tr>
     </thead>
     <tbody>
      <?php
     $servername = "localhost";
     $username = "root";
     $password = "";
     $database = "redentableproduct";


     $conn = new mysqli($servername, $username, $password, $database);

   
    if ($conn->connect_error) {
    die("Connection failed: " . $connection->connect_error);
   }

    
     $sql = "SELECT * FROM redenproduct";
     $result = $conn->query($sql);

     if (!$result) {
      die("Invalid query: " . $conn->error);
    }
    
    while($row = $result->fetch_assoc()) {
         echo "<tr>
             <td>" . $row["id"] . "</td>
             <td>" . $row["name"] . "</td>
             <td>" . $row["description"] . "</td>
             <td>" . $row["price"] . "</td>
             <td>" . $row["rrp"] . "</td>
             <td>" . $row["quantity"] . "</td>
             <td>" . $row["img"] . "</td>
             <td>" . $row["dateadded"] . "</td>
             <td>
                 <a class='btn btn-primary btn-sm' href='edit_product.php?id=$row[id]'>Update</a>
                 <a class='btn btn-danger btn-sm' href='delete_product.php?id=$row[id]'>Delete</a>
             </td>
         </tr>";
     }

     $conn->close();
      
     ?>
     </tbody>
    </table>
   </div>
  </div>
  <div style="clear:both"></div>
  <br />
  
  <br />
  <br />
  <br />
 </body>
</html>
      
      <div style="height: 1000px;"></div>
    </div>
    <!-- /.container-fluid-->
	
<?php require_once('layouts/footer.php'); ?>	