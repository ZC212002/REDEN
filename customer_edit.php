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
          <a href="#">Customer Edit and Update</a>
        </li>
        
      </ol>
      <html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Edit Customer</title>  
  

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
   <h2 align="center">Customer Edit and Update</h2><br />
  
   <br />
   <a class='btn btn-primary' href='create_customer.php' role="button">Create New Client</a>

   <div class="table-responsive">
    <div align="right">
     <p><b>Total Records - <span id="total_records"></span></b></p>
    </div>
    <table class="table table-bordered table-striped">
     <thead>
      <tr>
       <th>Customer ID</th>
       <th>Customer Name</th>
       <th>Customer Email</th>
       <th>Customer Username</th>
       <th>Customer Billing Name</th>
       <th>Phone</th>
       <th>Address</th>
       <th>City</th>
       <th>State</th>
       <th>Zip</th>

      </tr>
     </thead>
     <tbody>
      <?php
     $servername = "localhost";
     $username = "root";
     $password = "";
     $database = "reden";


     $conn = new mysqli($servername, $username, $password, $database);

   
    if ($conn->connect_error) {
    die("Connection failed: " . $connection->connect_error);
   }

    
     $sql = "SELECT * FROM users";
     $result = $conn->query($sql);

     if (!$result) {
      die("Invalid query: " . $conn->error);
    }
    
    while($row = $result->fetch_assoc()) {
         echo "<tr>
             <td>" . $row["usersId"] . "</td>
             <td>" . $row["usersName"] . "</td>
             <td>" . $row["usersEmail"] . "</td>
             <td>" . $row["usersUid"] . "</td>
             <td>" . $row["billingName"] . "</td>
             <td>" . $row["usersPhone"] . "</td>
             <td>" . $row["usersAddress"] . "</td>
             <td>" . $row["usersCity"] . "</td>
             <td>" . $row["usersState"] . "</td>
             <td>" . $row["usersZip"] . "</td>
             <td>
                 <a class='btn btn-primary btn-sm' href='edit_user.php?id=$row[usersId]'>Update</a>
                 <a class='btn btn-danger btn-sm' href='delete_user.php?id=$row[usersId]'>Delete</a>
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