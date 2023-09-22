 <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="dashboard.php"></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="admin_page.php">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Dashboard</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
          <a class="nav-link" href="customer_edit.php">
            <i class="fa fa-fw fa fa-users" aria-hidden="true"></i>
            <span class="nav-link-text">Edit User</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
			  <a class="nav-link" href="product_edit.php">
				<i class="fa fa-fw fa fa-product-hunt" aria-hidden="true"></i>
				<span class="nav-link-text">Edit Product</span>
			  </a>
			</li>
			
			<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
			  <a class="nav-link" href="admins_edit.php">
				<i class="fa fa-fw fa fa-id-badge" aria-hidden="true"></i>
				<span class="nav-link-text">Edit Admin</span>
			  </a>
			</li>
		

      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php?logout=true">
            <i class="fa fa-fw fa-sign-out"></i>Logout
          </a>
        </li>
      </ul>

    </div>
  </nav>