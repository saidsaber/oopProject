<?php
session_start();

use App\Controller\Admin\AdminController;
include($_SERVER['DOCUMENT_ROOT'] . "/book_store/App/controller/admin/AdminController.php");
include($_SERVER['DOCUMENT_ROOT'] . "/book_store/App/Config.php");
$data = AdminController::isLogIn($db);
// print_r($_SESSION);
// exit;
if (isset($_GET["logout"])) {
	AdminController::logout();
	header(header: "Location: dashboard.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Laravel Shop :: Administrative Panel</title>
	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet"
		href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="css/adminlte.min.css">
	<link rel="stylesheet" href="css/custom.css">
</head>

<body class="hold-transition sidebar-mini">
	<!-- Site wrapper -->
	<div class="wrapper">
		<!-- Navbar -->
		<nav class="main-header navbar navbar-expand navbar-white navbar-light">
			<!-- Right navbar links -->
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
				</li>
			</ul>
			<div class="navbar-nav pl-2">
				<!-- <ol class="breadcrumb p-0 m-0 bg-white">
						<li class="breadcrumb-item active">Dashboard</li>
					</ol> -->
			</div>

			<ul class="navbar-nav ml-auto">
				<li class="nav-item">
					<a class="nav-link" data-widget="fullscreen" href="#" role="button">
						<i class="fas fa-expand-arrows-alt"></i>
					</a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link p-0 pr-3" data-toggle="dropdown" href="#">
						<img src="img/avatar5.png" class='img-circle elevation-2' width="40" height="40" alt="">
					</a>
					<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-3">
						<!-- login -->
						<?php
						if (AdminController::isLogIn($db)) {
							?>
							<h4 class="h4 mb-0"><strong><?= $data->getAdminName() ?></strong></h4>
							<div class="mb-3"><?= $data->getAdminEmail() ?></div>
							<div class="dropdown-divider"></div>
							<a href="#" class="dropdown-item">
								<i class="fas fa-user-cog mr-2"></i> Settings
							</a>
							<div class="dropdown-divider"></div>
							<a href="#" class="dropdown-item">
								<i class="fas fa-lock mr-2"></i> Change Password
							</a>
							<div class="dropdown-divider"></div>
							<a href="?logout" class="dropdown-item text-danger">
								<i class="fas fa-sign-out-alt mr-2"></i> Logout
							</a>
							<?php
						} else {
							?>
							<a href="login.php" class="dropdown-item">
								login
							</a>
						<?php } ?>
					</div>
				</li>
			</ul>
		</nav>
		<!-- /.navbar -->
		<!-- Main Sidebar Container -->
		<aside class="main-sidebar sidebar-dark-primary elevation-4">
			<!-- Brand Logo -->
			<a href="#" class="brand-link">
				<img src="img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
					style="opacity: .8">
				<span class="brand-text font-weight-light">LARAVEL SHOP</span>
			</a>
			<!-- Sidebar -->
			<div class="sidebar">
				<!-- Sidebar user (optional) -->
				<nav class="mt-2">
					<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
						data-accordion="false">
						<!-- Add icons to the links using the .nav-icon class
								with font-awesome or any other icon font library -->
						<li class="nav-item">
							<a href="dashboard.php" class="nav-link">
								<i class="nav-icon fas fa-tachometer-alt"></i>
								<p>Dashboard</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="categories.php" class="nav-link">
								<i class="nav-icon fas fa-file-alt"></i>
								<p>Category</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="subcategory.php" class="nav-link">
								<i class="nav-icon fas fa-file-alt"></i>
								<p>Sub Category</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="brands.php" class="nav-link">
								<svg class="h-6 nav-icon w-6 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none"
									viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
									<path stroke-linecap="round" stroke-linejoin="round"
										d="M16 4v12l-4-2-4 2V4M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
									</path>
								</svg>
								<p>Brands</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="products.php" class="nav-link">
								<i class="nav-icon fas fa-tag"></i>
								<p>Products</p>
							</a>
						</li>

						<li class="nav-item">
							<a href="orders.php" class="nav-link">
								<i class="nav-icon fas fa-shopping-bag"></i>
								<p>Orders</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="discount.php" class="nav-link">
								<i class="nav-icon  fa fa-percent" aria-hidden="true"></i>
								<p>Discount</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="users.php" class="nav-link">
								<i class="nav-icon  fas fa-users"></i>
								<p>Users</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="pages.php" class="nav-link">
								<i class="nav-icon  far fa-file-alt"></i>
								<p>Pages</p>
							</a>
						</li>
					</ul>
				</nav>
				<!-- /.sidebar-menu -->
			</div>
			<!-- /.sidebar -->
		</aside>
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<div class="container-fluid">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1>Dashboard</h1>
						</div>
						<div class="col-sm-6">

						</div>
					</div>
				</div>
				<!-- /.container-fluid -->
			</section>
			<!-- Main content -->
			<section class="content">
				<!-- Default box -->
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-4 col-6">
							<div class="small-box card">
								<div class="inner">
									<h3>150</h3>
									<p>Total Orders</p>
								</div>
								<div class="icon">
									<i class="ion ion-bag"></i>
								</div>
								<a href="#" class="small-box-footer text-dark">More info <i
										class="fas fa-arrow-circle-right"></i></a>
							</div>
						</div>

						<div class="col-lg-4 col-6">
							<div class="small-box card">
								<div class="inner">
									<h3>50</h3>
									<p>Total Customers</p>
								</div>
								<div class="icon">
									<i class="ion ion-stats-bars"></i>
								</div>
								<a href="#" class="small-box-footer text-dark">More info <i
										class="fas fa-arrow-circle-right"></i></a>
							</div>
						</div>

						<div class="col-lg-4 col-6">
							<div class="small-box card">
								<div class="inner">
									<h3>$1000</h3>
									<p>Total Sale</p>
								</div>
								<div class="icon">
									<i class="ion ion-person-add"></i>
								</div>
								<a href="javascript:void(0);" class="small-box-footer">&nbsp;</a>
							</div>
						</div>
					</div>
				</div>
				<!-- /.card -->
			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->
		<footer class="main-footer">

			<strong>Copyright &copy; 2014-2022 AmazingShop All rights reserved.
		</footer>

	</div>
	<!-- ./wrapper -->
	<!-- jQuery -->
	<script src="plugins/jquery/jquery.min.js"></script>
	<!-- Bootstrap 4 -->
	<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- AdminLTE App -->
	<script src="js/adminlte.min.js"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="js/demo.js"></script>
</body>

</html>