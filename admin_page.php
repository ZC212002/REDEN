<?php
	session_start();

	require_once('layouts/header.php'); 
	require_once('layouts/left_sidebar.php');
  include_once "session_time_out_admin.php"; 
?>

  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        
      </ol>
      <h1>Welcome to Dashboard</h1>
      <hr>
      <!--getUserAccessRoleByID() is under config.php   -->
      <p>You are login as <strong>admin</strong></p>
      <div style="height: 1000px;"></div>
    </div>
    <!-- /.container-fluid-->
	
<?php require_once('layouts/footer.php'); ?>	