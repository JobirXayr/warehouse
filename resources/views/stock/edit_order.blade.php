<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
	<title>Редактировать заказ</title>
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
									<li class="breadcrumb-item"><a href="{{ route('stocks') }}">Заказы</a></li>
									<li class="breadcrumb-item active" aria-current="page">Редактировать заказ</li>
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
											<h2 class="mb-0">Параметры заказа</h2>
										</div>
										<div class="card-body">
											<form action="{{ route('update-order', $order->id) }}" method="post">
												@method('PUT')
												@csrf
												<div class="row">
								        			<div class="col-md-4 mb-2">
								        				<label for="order_number">№ заказа</label>
								        				<input id="order_number" type="text" autocomplete="off" class="form-control" name="order_number" value="{{ $order->order_number }}" required>
								        			</div>
								        			<div class="col-md-8 mb-2">
								        				<label for="order_category">Категория продукта</label>
								        				<select id="order_category" class="form-control order_category_select" name="category_id">
								        					<option value="0">Выберите категорию</option>
								        					@foreach($categories as $key => $value)
								        						@if($value->id == $order->category_id)
								        							<option value="{{ $value->id }}" selected>{{ $value->name }}</option>
								        						@else
								        							<option value="{{ $value->id }}">{{ $value->name }}</option>
								        						@endif
								        					@endforeach
								        				</select>
								        			</div>
								        			<div class="col-md-6 mb-2">
								        				<label for="order_product">Продукты</label>
								        				<select id="order_product" class="form-control order_products_select" name="product_id">
								        					@foreach($products as $key => $value)
								        						@if($value->id == $order->product_id)
								        							<option value="{{ $value->id }}" selected>{{ $value->name }}</option>
								        						@else
								        							<option value="{{ $value->id }}">{{ $value->name }}</option>
								        						@endif
								        					@endforeach
								        				</select>
								        			</div>
								        			<div class="col-md-6 mb-2">
								        				<label for="supply">Подходящие заказы</label>
								        				<select id="supply" class="form-control permit_supply_select" name="supply_number">
								        					@foreach($supplies as $key => $value)
								        						@if($value->supply_number == $order->supply_number)
								        							<option value="{{ $value->supply_number }}" selected>{{ $value->supply_number }}</option>
								        						@else
								        							<option value="{{ $value->supply_number }}">{{ $value->supply_number }}</option>
								        						@endif
								        					@endforeach
								        				</select>
								        			</div>
								        			<div class="col-md-5 mb-2">
								        				<label for="last_amount">Количество остаток в складе, шт</label>
								        				<input id="last_amount" type="text" class="form-control last_product_amount" name="last_amount" value="{{ $last_amount }}" readonly>
								        			</div>
								        			<div class="col-md-4 mb-2">
								        				<label for="order_amount">Количество, шт</label>
								        				<input id="order_amount" type="text" autocomplete="off" class="form-control" name="amount" value="{{ $order->amount }}" required>
								        			</div>
								        			<div class="col-md-3 mb-2">
								        				<label for="order_date">Дата</label>
								        				<div class="wd-200 mg-b-30">
															<div class="input-group">
																<div class="input-group-prepend">
																	<div class="input-group-text">
																		<i class="fa fa-calendar tx-16 lh-0 op-6"></i>
																	</div>
																</div><input class="form-control datepicker" placeholder="MM/DD/YYYY" type="text" id="order_date" name="date" autocomplete="off" value="{{ $order->day }}" required>
															</div>
														</div>
								        			</div>
								        			<input type="hidden" name="last_amount_saved" value="{{ $order->amount }}">
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
		$('.datepicker').datepicker({
		 	showOtherMonths: true,
		 	selectOtherMonths: true
	   	});

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

			// брать продукты для заказа
			$('body').on('change', '.order_category_select', function(event){
				event.preventDefault();
				let category_id = $(this).val();
				$.ajax({
					headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
		           	type:'POST',
		           	url:"{{ route('category-products') }}",
		           	data:{ category_id:category_id },
		           	success:function(data){
		              	$(".order_products_select").html(data);
		           	}
		        });
			});

			// проверить все подходящие поставки
			$('body').on('change', '.order_products_select', function(event) {
				event.preventDefault();
				let product_id = $(this).val();
				// alert(product_id);
				$.ajax({
					headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
		           	type:'POST',
		           	url:"{{ route('rest-supplies') }}",
		           	data:{ product_id: product_id },
		           	success:function(data){
		              	$(".permit_supply_select").html(data);
		           	}
		        });
			});

			// количество продуктов в текущей поставке
			$('body').on('change', '.permit_supply_select', function(event) {
				event.preventDefault();
				let supply_number = $(this).val();
				$.ajax({
					headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
		           	type:'POST',
		           	url:"{{ route('rest-product-amount') }}",
		           	data:{ supply_number: supply_number },
		           	success:function(data){
		              	$(".last_product_amount").val(data);
		           	}
		        });
			});
		});
	</script>
</body>
</html>