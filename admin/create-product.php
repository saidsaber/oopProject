<?php
session_start();

use App\Controller\Admin\AdminController;
use App\Controller\Admin\ProductController;
use App\Controller\Admin\CategoryController;
use App\Controller\Admin\SubCategoryController;
use App\Controller\Admin\BrandController;
include($_SERVER['DOCUMENT_ROOT'] . "/book_store/App/controller/admin/AdminController.php");
include($_SERVER['DOCUMENT_ROOT'] . "/book_store/App/Config.php");

$data = AdminController::isLogIn($db);
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
	<link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
	<link rel="stylesheet" href="plugins/dropzone/dropzone.css">
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
				<ol class="breadcrumb p-0 m-0 bg-white">
					<li class="breadcrumb-item"><a href="products.php">Products</a></li>
					<li class="breadcrumb-item active">Create</li>
				</ol>
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
				<div class="container-fluid my-2">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1>Create Product</h1>
						</div>
						<div class="col-sm-6 text-right">
							<a href="products.php" class="btn btn-primary">Back</a>
						</div>
					</div>
				</div>
				<!-- /.container-fluid -->
			</section>
			<!-- Main content -->
			<section class="content">
				<!-- Default box -->
				<?php
				if (isset($_GET["id"])):
					$product = ProductController::getProduct($db, $_GET["id"]);
					?>
					<form action="../App/header/admin/product/updateProduct.php" method="post" enctype="multipart/form-data"
						class="p-4 border rounded bg-light shadow-sm">
						<input type="hidden" name="id"  value="<?= $product->getId()?>">
						<div class="container-fluid">
							<div class="row">
								<div class="col-md-8">
									<div class="card mb-3">
										<div class="card-body">
											<div class="row">
												<div class="col-md-12">
													<div class="mb-3">
														<label for="title">Title</label>
														<input type="text" name="title" id="title" class="form-control"
															value="<?= $product->getTitle() ?>" placeholder="Title">
													</div>
												</div>
												<div class="col-md-12">
													<div class="mb-3">
														<label for="description">Description</label>
														<textarea name="description" id="description" cols="30" rows="10"
															class="summernote"
															placeholder="Description"><?= $product->getDescription() ?></textarea>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="card mb-3">
										<div class="card-body">
											<h2 class="h4 mb-3">Media</h2>
											<input type="file" name="image" id="image" style="display:none">
											<label for="image">
												<div id="" class="dropzone dz-clickable">
													<div class="dz-message needsclick">
														<br>Drop files here or click to upload.<br><br>
													</div>
												</div>
											</label>
										</div>
									</div>
									<div class="card mb-3">
										<div class="card-body">
											<h2 class="h4 mb-3">Pricing</h2>
											<div class="row">
												<div class="col-md-12">
													<div class="mb-3">
														<label for="price">Price</label>
														<input type="text" name="price" id="price" class="form-control"
															value="<?= $product->getPrice() ?>" placeholder="Price">
													</div>
												</div>
												<div class="col-md-12">
													<div class="mb-3">
														<label for="compare_price">Compare at Price</label>
														<input type="text" name="compare_price" id="compare_price"
															class="form-control"
															value="<?= $product->getPriceAfterDiscount() ?>"
															placeholder="Compare Price">
														<p class="text-muted mt-3">
															To show a reduced price, move the product’s original price into
															Compare at price. Enter a lower value into Price.
														</p>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="card mb-3">
										<div class="card-body">
											<div class="row">
												<div class="col-md-12">
													<div class="mb-3">
														<input type="number" min="0" name="qty" id="qty"
															class="form-control" value="<?= $product->getQty() ?>"
															placeholder="Qty">
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="card mb-3">
										<div class="card-body">
											<h2 class="h4 mb-3">Product status</h2>
											<div class="mb-3">
												<select name="status" id="status" class="form-control">
													<option value="1">Active</option>
													<option value="0">Block</option>
												</select>
											</div>
										</div>
										<div class="card-body">
											<h2 class="h4 mb-3">Product lang</h2>
											<div class="mb-3">
												<select name="lang" id="lang" class="form-control">
													<option value="ar">ar</option>
													<option value="en">en</option>
												</select>
											</div>
										</div>
									</div>
									<div class="card">
										<div class="card-body">
											<h2 class="h4  mb-3">Product category</h2>
											<div class="mb-3">
												<label for="category">Category</label>
												<select name="category" id="category" class="form-control">
													<?php
													$categories = CategoryController::getAllCategories($db);
													if ($categories):
														foreach ($categories as $category):
															?>
															<option value="<?= $category->getCateId() ?>">
																<?= $category->getCateName() ?>
															</option>
															<?php
														endforeach;
													endif;
													?>
												</select>
											</div>
											<div class="mb-3">
												<label for="sub_category">Sub category</label>
												<select name="sub_category" id="sub_category" class="form-control">
													<?php
													$subcategories = SubCategoryController::getAllSubCategory($db);
													if ($subcategories):
														foreach ($subcategories as $subcategory):
															?>
															<option value="<?= $subcategory->getSubCateId() ?>">
																<?= $subcategory->getSubCateName() ?>
															</option>
															<?php
														endforeach;
													endif;
													?>
												</select>
											</div>
										</div>
									</div>
									<div class="card mb-3">
										<div class="card-body">
											<h2 class="h4 mb-3">Product brand</h2>
											<div class="mb-3">
												<select name="brand" id="brand" class="form-control">
													<?php
													$brands = BrandController::getBrands($db);
													if ($brands):
														foreach ($brands as $brand):
															?>
															<option value="<?= $brand->getBrandId()?>"><?= $brand->getBrandName()?></option>
															<?php
														endforeach;
													endif;
													?>
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="pb-5 pt-3">
								<input type="submit" class="btn btn-primary" value="Create">
								<a href="products.php" class="btn btn-outline-dark ml-3">Cancel</a>
							</div>
						</div>
					</form>
				<?php else: ?>
					<form action="../App/header/admin/product/createProduct.php" method="post" enctype="multipart/form-data"
						class="p-4 border rounded bg-light shadow-sm">
						<div class="container-fluid">
							<div class="row">
								<div class="col-md-8">
									<div class="card mb-3">
										<div class="card-body">
											<div class="row">
												<div class="col-md-12">
													<div class="mb-3">
														<label for="title">Title</label>
														<input type="text" name="title" id="title" class="form-control"
															placeholder="Title">
													</div>
												</div>
												<div class="col-md-12">
													<div class="mb-3">
														<label for="description">Description</label>
														<textarea name="description" id="description" cols="30" rows="10"
															class="summernote" placeholder="Description"></textarea>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="card mb-3">
										<div class="card-body">
											<h2 class="h4 mb-3">Media</h2>
											<input type="file" name="image" id="image" style="display:none">
											<label for="image">
												<div id="" class="dropzone dz-clickable">
													<div class="dz-message needsclick">
														<br>Drop files here or click to upload.<br><br>
													</div>
												</div>
											</label>
										</div>
									</div>
									<div class="card mb-3">
										<div class="card-body">
											<h2 class="h4 mb-3">Pricing</h2>
											<div class="row">
												<div class="col-md-12">
													<div class="mb-3">
														<label for="price">Price</label>
														<input type="text" name="price" id="price" class="form-control"
															placeholder="Price">
													</div>
												</div>
												<div class="col-md-12">
													<div class="mb-3">
														<label for="compare_price">Compare at Price</label>
														<input type="text" name="compare_price" id="compare_price"
															class="form-control" placeholder="Compare Price">
														<p class="text-muted mt-3">
															To show a reduced price, move the product’s original price into
															Compare at price. Enter a lower value into Price.
														</p>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="card mb-3">
										<div class="card-body">
											<div class="row">
												<div class="col-md-12">
													<div class="mb-3">
														<input type="number" min="0" name="qty" id="qty"
															class="form-control" placeholder="Qty">
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="card mb-3">
										<div class="card-body">
											<h2 class="h4 mb-3">Product status</h2>
											<div class="mb-3">
												<select name="status" id="status" class="form-control">
													<option value="1">Active</option>
													<option value="0">Block</option>
												</select>
											</div>
										</div>
										<div class="card-body">
											<h2 class="h4 mb-3">Product lang</h2>
											<div class="mb-3">
												<select name="lang" id="lang" class="form-control">
													<option value="ar">ar</option>
													<option value="en">en</option>
												</select>
											</div>
										</div>
									</div>
									<div class="card">
										<div class="card-body">
											<h2 class="h4  mb-3">Product category</h2>
											<div class="mb-3">
												<label for="category">Category</label>
												<select name="category" id="category" class="form-control">
													<option value="7">Electronics</option>
													<option value="8">Clothes</option>
												</select>
											</div>
											<div class="mb-3">
												<label for="sub_category">Sub category</label>
												<select name="sub_category" id="sub_category" class="form-control">
													<option value="11">Mobile</option>
													<option value="12">Home Theater</option>
													<option value="13">Headphones</option>
												</select>
											</div>
										</div>
									</div>
									<div class="card mb-3">
										<div class="card-body">
											<h2 class="h4 mb-3">Product brand</h2>
											<div class="mb-3">
												<select name="brand" id="brand" class="form-control">
													<option value="5">Apple</option>
													<option value="5">Vivo</option>
													<option value="5">HP</option>
													<option value="5">Samsung</option>
													<option value="5">DELL</option>
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="pb-5 pt-3">
								<input type="submit" class="btn btn-primary" value="Create">
								<a href="products.php" class="btn btn-outline-dark ml-3">Cancel</a>
							</div>
						</div>
					</form>
				<?php endif; ?>
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
	<!-- Summernote -->
	<script src="plugins/summernote/summernote-bs4.min.js"></script>
	<script src="plugins/dropzone/dropzone.js"></script>
	<script src="js/demo.js"></script>
	<script>
		Dropzone.autoDiscover = false;
		$(function () {
			// Summernote
			$('.summernote').summernote({
				height: '300px'
			});

			const dropzone = $("#image").dropzone({
				url: "create-product.php",
				maxFiles: 5,
				addRemoveLinks: true,
				acceptedFiles: "image/jpeg,image/png,image/gif",
				headers: {
					'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
				}, success: function (file, response) {
					$("#image_id").val(response.id);
				}
			});

		});
	</script>
</body>

</html>