<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
	<title>Редактировать продукт</title>
	<link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700,800" rel="stylesheet">
	<link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}">
	<link href="{{ asset('assets/css/dashboard.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/plugins/customscroll/jquery.mCustomScrollbar.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/plugins/toggle-sidebar/css/sidemenu.css') }}" rel="stylesheet" type="text/css">
</head>
<body class="app sidebar-mini rtl" >
	<div id="global-loader" ></div>
	<div class="page">
		<div class="page-main">
			<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
			
			<!-- Sidebar -->
			@include('sidebar')

			<!-- app-content-->
			<div class="app-content ">
				<div class="side-app">
					<div class="main-content">

						<!-- Navbar -->
						@include('navbar')

						<!-- Page content -->
						<div class="container-fluid pt-8">
							<div class="page-header mt-0 shadow p-3">
								<ol class="breadcrumb mb-sm-0">
									<li class="breadcrumb-item"><a href="{{ route('products.index') }}">Продукты</a></li>
									<li class="breadcrumb-item active" aria-current="page">Редактировать продукт</li>
								</ol>
							</div>

							@if (session('message'))
							    <div class="alert alert-success">
							        {{ session('message') }}
							    </div>
							@endif

							<div class="row">
								<div class="col-md-12">
									<div class="card shadow">
										<div class="card-header">
											<h2 class="mb-0">Параметры продукта</h2>
										</div>
										<div class="card-body">
											<form action="{{ route('products.update', $product->id) }}" method="post">
												@method('PUT')
												@csrf
												<div class="row">
								        			<div class="col-md-6 mb-2">
								        				<label for="category">Категория продукта</label>
								        				<select id="category" class="form-control" name="update_category">
								        					<option value="0">Выберите категорию</option>
								        					@foreach($categories as $key => $value)
								        						@if($value->id == $product->category_id)
								        							<option value="{{ $value->id }}" selected>{{ $value->name }}</option>
								        						@else
								        							<option value="{{ $value->id }}">{{ $value->name }}</option>
								        						@endif
								        					@endforeach		
								        				</select>
								        			</div>
								        			<div class="col-md-6 mb-2">
								        				<label for="name">Название продукта</label>
								        				<input id="name" type="text" autocomplete="off" class="form-control" name="update_product" value="{{ $product->name }}" required>
								        			</div>
								        			<div class="col-md-12 mb-2">
								        				<label for="description">Описание</label>
								        				<textarea rows="12" id="description" class="form-control" name="update_description">{{ $product->description }}</textarea>
								        			</div>
								        			<div class="col-md-12 mb-2 text-right">
								        				<button class="btn btn-primary">Сохранить изменения</button>
								        			</div>
								        		</div>
											</form>
										</div>

									</div>
								</div>
							</div>

							@include('footer')

						</div>
					</div>
				</div>
			</div>
			<!-- app content -->
		</div>
	</div>

	<script src="{{ asset('assets/plugins/jquery/dist/jquery.min.js') }}"></script>
	<script src="{{ asset('assets/js/popper.js') }}"></script>
	<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/toggle-sidebar/js/sidemenu.js') }}"></script>
	<script src="{{ asset('assets/plugins/customscroll/jquery.mCustomScrollbar.concat.min.js') }}"></script>
	<script src="{{ asset('assets/js/custom.js') }}"></script>
</body>
</html>