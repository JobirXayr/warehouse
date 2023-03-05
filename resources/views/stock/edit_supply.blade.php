<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
	<title>Редактировать поставку</title>
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
									<li class="breadcrumb-item"><a href="{{ route('stocks') }}">Поставки</a></li>
									<li class="breadcrumb-item active" aria-current="page">Редактировать поставку</li>
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
											<h2 class="mb-0">Параметры поставки</h2>
										</div>
										<div class="card-body">
											<form action="{{ route('update-supply', $supply->id) }}" method="post">
												@method('PUT')
												@csrf
												<div class="row">
								        			<div class="col-md-4 mb-2">
								        				<label for="supply_number">№ поставки</label>
								        				<input id="supply_number" type="text" autocomplete="off" class="form-control" name="supply_number" value="{{ $supply->supply_number }}" required>
								        			</div>
								        			<div class="col-md-8 mb-2">
								        				<label for="supply_category">Категория продукта</label>
								        				<select id="supply_category" class="form-control supply_category_select" name="category_id">
								        					<option value="0">Выберите категорию</option>
								        					@foreach($categories as $key => $value)
								        						@if($value->id == $supply->category_id)
								        							<option value="{{ $value->id }}" selected>{{ $value->name }}</option>	
								        						@else
								        							<option value="{{ $value->id }}">{{ $value->name }}</option>
								        						@endif
								        					@endforeach
								        				</select>
								        			</div>
								        			<div class="col-md-12 mb-2">
								        				<label for="supply_product">Продукты</label>
								        				<select id="supply_product" class="form-control supply_products_select" name="product_id">
								        					@foreach($products as $key => $value)
								        						@if($value->id == $supply->product_id)
																	<option value="{{ $value->id }}" selected>{{ $value->name }}</option>
								        						@else
								        							<option value="{{ $value->id }}">{{ $value->name }}</option>
								        						@endif
								        					@endforeach
								        				</select>
								        			</div>
								        			<div class="col-md-4 mb-2">
								        				<label for="supply_amount">Количество, шт</label>
								        				<input id="supply_amount" type="text" autocomplete="off" class="form-control" name="amount" value="{{ $supply->amount }}" required>
								        			</div>
								        			<div class="col-md-4 mb-2">
								        				<label for="supply_price">Стоимость, рубль</label>
								        				<input id="supply_price" type="text" autocomplete="off" class="form-control" name="price" value="{{ $supply->price }}" required>
								        			</div>
								        			<div class="col-md-4 mb-2">
								        				<label for="supply_date">Дата</label>
								        				<div class="wd-200 mg-b-30">
															<div class="input-group">
																<div class="input-group-prepend">
																	<div class="input-group-text">
																		<i class="fa fa-calendar tx-16 lh-0 op-6"></i>
																	</div>
																</div><input class="form-control datepicker" placeholder="MM/DD/YYYY" type="text" id="supply_date" name="date" autocomplete="off" value="{{ $supply->day }}" required>
															</div>
														</div>
								        			</div>
								        			<div class="col-md-12 mb-2">
								        				<button type="submit" class="btn btn-primary">Сохранить изменения</button>
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
	<script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/customscroll/jquery.mCustomScrollbar.concat.min.js') }}"></script>
	<script src="{{ asset('assets/js/custom.js') }}"></script>

	<script type="text/javascript">
		$(document).ready(function() {
			$('body').on('change', '.supply_category_select', function(event){
				event.preventDefault();
				let category_id = $(this).val();
				alert(category_id);
				$.ajax({
					headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
		           	type:'POST',
		           	url:"{{ route('category-products') }}",
		           	data:{ category_id:category_id },
		           	success:function(data){
		              	$(".supply_products_select").html(data);
		           	}
		        });
			});
		});

		$('.datepicker').datepicker({
		 	showOtherMonths: true,
		 	selectOtherMonths: true
	   	});
	</script>
</body>
</html>