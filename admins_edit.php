<?php
	session_start();
  include_once 'session_time_out_admin.php';
	require_once('layouts/header.php'); 
	require_once('layouts/left_sidebar.php'); 
?>

  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="admins_edit.php">Admin Edit and Update</a>
        </li>
        
      </ol>
      <html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Edit Admin</title>  
  

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
   <h2 align="center">Admin Edit and Update</h2><br />
  
   <br />
   <a class='btn btn-primary' href='create_admin.php' role="button">Create New Admin</a>

   <div class="table-responsive">
    <div align="right">
     <p><b>Total Records - <span id="total_records"></span></b></p>
    </div>
    <table class="table table-bordered table-striped">
     <thead>
      <tr>
       <th>Admin ID</th>
       <th>Admin Name</th>
       <th>Admin Email</th>
       <th>Admin Phone</th>
       <th>Admin Username</th>

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

    
     $sql = "SELECT * FROM admins";
     $result = $conn->query($sql);

     if (!$result) {
      die("Invalid query: " . $conn->error);
    }
    
    while($row = $result->fetch_assoc()) {
         echo "<tr>
             <td>" . $row["adminsId"] . "</td>
             <td>" . $row["adminsName"] . "</td>
             <td>" . $row["adminsEmail"] . "</td>
             <td>" . $row["adminsPhone"] . "</td>
             <td>" . $row["adminsUid"] . "</td>
             <td>
                 <a class='btn btn-primary btn-sm' href='edit_admin.php?id=$row[adminsId]'>Update</a>
                 <a class='btn btn-danger btn-sm' href='delete_admin.php?id=$row[adminsId]'>Delete</a>
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