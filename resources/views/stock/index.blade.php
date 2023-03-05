<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
	<title>Поставки и заказы</title>
	<link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700,800" rel="stylesheet">
	<link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/css/dashboard.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('assets/plugins/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css">
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
									<li class="breadcrumb-item active" aria-current="page">Поставки и заказы</li>
								</ol>
							</div>

							@if (session('message'))
							    <div class="alert alert-success">
							        {{ session('message') }}
							    </div>
							@endif

							<div class="row">
								<div class="col-md-12">
									<button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#soModal">Создать новую поставку (заказ)</button>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="card shadow">
										<div class="card-header">
											<h2 class="mb-0">Список всех поставок и заказов</h2>
										</div>
										<div class="card-body">
											<ul class="nav nav-tabs" id="myTab1" role="tablist">
												<li class="nav-item">
													<a class="nav-link active show" id="supplies-tab1" data-toggle="tab" href="#supplies" role="tab" aria-selected="true">Поставки</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" id="profile-tab1" data-toggle="tab" href="#orders" role="tab" aria-selected="false">Заказы</a>
												</li>
											</ul>
											<div class="tab-content tab-bordered" id="myTab1Content">
												<!-- Supplies -->
												<div class="tab-pane fade active show text-sm" id="supplies" role="tabpanel" aria-labelledby="supplies-tab1">
													<div class="table-responsive">
														<table id="supplies_table" class="table table-bordered w-100">
															<thead>
																<tr>
																	<th class="text-center">П.н.</th>
																	<th class="text-center">Номер поставки</th>
																	<th class="text-center">Товар</th>
																	<th class="text-center">Количество, шт</th>
																	<th class="text-center">Стоимость, рубль</th>
																	<th class="text-center">Дата</th>
																	<th class="text-center">Функция</th>
																</tr>
															</thead>
															<tbody>
																@foreach($supplies as $key => $value)
																	<tr>
																		<td style="width:3%;" class="text-center align-middle">{{ $key + 1 }}</td>
																		<td style="width:10%;" class="text-center align-middle">{{ $value->supply_number }}</td>
																		<td style="width:10%;" class="text-center align-middle">{{ $value->product_name }}</td>
																		<td style="">{{ $value->amount }}</td>
																		<td style="">{{ $value->price }}</td>
																		<td style="">{{ $value->day }}</td>
																		<td style="width:18%;">
																			<a href="{{ route('show-supply', $value->id) }}" class="btn btn-primary btn-sm">Изменить</a>
																			<form method="post" action="{{ route('destroy-supply', $value->id) }}" style="float:right;">
													                            @method('delete')
													                            @csrf
													                            <button type="submit" class="btn btn-danger btn-sm">Удалить</button>
													                        </form>
																		</td>
																	</tr>
																@endforeach
															</tbody>
														</table>
													</div>
												</div>
												<!-- Supplies -->
												
												<!-- Orders -->
												<div class="tab-pane fade text-sm" id="orders" role="tabpanel" aria-labelledby="orders-tab1">
													<div class="table-responsive">
														<table id="orders_table" class="table table-bordered w-100">
															<thead>
																<tr>
																	<th class="text-center">П.н.</th>
																	<th class="text-center">Номер заказа</th>
																	<th class="text-center">Товар</th>
																	<th class="text-center">Количество, шт</th>
																	<th class="text-center">Стоимость, рубль</th>
																	<th class="text-center">Дата</th>
																	<th class="text-center">Функция</th>
																</tr>
															</thead>
															<tbody>
																@foreach($orders as $key => $value)
																	<tr>
																		<td style="width:3%;" class="text-center align-middle">{{ $key + 1 }}</td>
																		<td style="width:10%;" class="text-center align-middle">{{ $value->order_number }}</td>
																		<td style="width:10%;" class="text-center align-middle">{{ $value->product_name }}</td>
																		<td style="">{{ $value->amount }}</td>
																		<td style="">{{ $value->price }}</td>
																		<td style="">{{ $value->day }}</td>
																		<td style="width:18%;">
																			<a href="{{ route('show-order', $value->id) }}" class="btn btn-primary btn-sm">Изменить</a>
																			<form method="post" action="{{ route('destroy-order', $value->id) }}" style="float:right;">
													                            @method('delete')
													                            @csrf
													                            <button type="submit" class="btn btn-danger btn-sm">Удалить</button>
													                        </form>
																		</td>
																	</tr>
																@endforeach
															</tbody>
														</table>
													</div>
												</div>
												<!-- Orders -->
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="modal fade" id="soModal" tabindex="-1" role="dialog" aria-labelledby="soModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
								    <div class="modal-content">
								      	<div class="modal-header">
								        	<h5 class="modal-title" id="soModalLabel">Оформить поставку (заказ)</h5>
								        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          		<span aria-hidden="true">&times;</span>
								        	</button>
								      	</div>
								      	<div class="modal-body">
								      		<ul class="nav nav-tabs" id="myTab2" role="tablist">
												<li class="nav-item">
													<a class="nav-link active show" id="supplies-tab2" data-toggle="tab" href="#add_supplies" role="tab" aria-selected="true">Поставка</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" id="profile-tab2" data-toggle="tab" href="#add_orders" role="tab" aria-selected="false">Заказ</a>
												</li>
											</ul>
											<div class="tab-content tab-bordered" id="myTab2Content">
												<!-- Add supply -->
												<div class="tab-pane fade active show text-sm" id="add_supplies" role="tabpanel" aria-labelledby="supplies-tab2">
													<form action="{{ route('save-supply') }}" method="post">
							      						@csrf
							      						<div class="container">
									        				<div class="row">
									      						<div class="col-md-4 mb-2">
											        				<label for="supply_number">№ поставки</label>
											        				<input id="supply_number" type="text" autocomplete="off" class="form-control" name="supply_number" required>
											        			</div>
											        			<div class="col-md-8 mb-2">
											        				<label for="supply_category">Категория продукта</label>
											        				<select id="supply_category" class="form-control supply_category_select" name="category_id">
											        					<option value="0">Выберите категорию</option>
											        					@foreach($categories as $key => $value)
											        						<option value="{{ $value->id }}">{{ $value->name }}</option>
											        					@endforeach
											        				</select>
											        			</div>
											        			<div class="col-md-12 mb-2">
											        				<label for="supply_product">Продукты</label>
											        				<select id="supply_product" class="form-control supply_products_select" name="product_id">
											        					
											        				</select>
											        			</div>
											        			<div class="col-md-4 mb-2">
											        				<label for="supply_amount">Количество, шт</label>
											        				<input id="supply_amount" type="text" autocomplete="off" class="form-control" name="amount" required>
											        			</div>
											        			<div class="col-md-4 mb-2">
											        				<label for="supply_price">Стоимость, рубль</label>
											        				<input id="supply_price" type="text" autocomplete="off" class="form-control" name="price" required>
											        			</div>
											        			<div class="col-md-4 mb-2">
											        				<label for="supply_date">Дата</label>
											        				<div class="wd-200 mg-b-30">
																		<div class="input-group">
																			<div class="input-group-prepend">
																				<div class="input-group-text">
																					<i class="fa fa-calendar tx-16 lh-0 op-6"></i>
																				</div>
																			</div><input class="form-control datepicker" placeholder="MM/DD/YYYY" type="text" id="supply_date" name="date" autocomplete="off" required>
																		</div>
																	</div>
											        			</div>
											        			<div class="col-md-12 mb-2">
											        				<button type="submit" class="btn btn-primary">Сохранить поставку</button>
											        			</div>
											        		</div>
											        	</div>
							      					</form>
												</div>
												<!-- Add supply -->

												<!-- Add order -->
												<div class="tab-pane fade text-sm" id="add_orders" role="tabpanel" aria-labelledby="orders-tab2">
													<form action="{{ route('save-order') }}" method="post">
							      						@csrf
							      						<div class="container">
									        				<div class="row">
									      						<div class="col-md-4 mb-2">
											        				<label for="order_number">№ заказа</label>
											        				<input id="order_number" type="text" autocomplete="off" class="form-control" name="order_number" required>
											        			</div>
											        			<div class="col-md-8 mb-2">
											        				<label for="order_category">Категория продукта</label>
											        				<select id="order_category" class="form-control order_category_select" name="category_id">
											        					<option value="0">Выберите категорию</option>
											        					@foreach($categories as $key => $value)
											        						<option value="{{ $value->id }}">{{ $value->name }}</option>
											        					@endforeach
											        				</select>
											        			</div>
											        			<div class="col-md-6 mb-2">
											        				<label for="order_product">Продукты</label>
											        				<select id="order_product" class="form-control order_products_select" name="product_id">
											        					
											        				</select>
											        			</div>
											        			<div class="col-md-6 mb-2">
											        				<label for="supply">Подходящие поставки</label>
											        				<select id="supply" class="form-control permit_supply_select" name="supply_number">
											        					
											        				</select>
											        			</div>
											        			<div class="col-md-5 mb-2">
											        				<label for="last_amount">Количество остаток в складе , шт</label>
											        				<input id="last_amount" type="text" class="form-control last_product_amount" name="last_amount" readonly>
											        			</div>
											        			<div class="col-md-4 mb-2">
											        				<label for="order_amount">Количество, шт</label>
											        				<input id="order_amount" type="text" autocomplete="off" class="form-control" name="amount" required>
											        			</div>
											        			<div class="col-md-3 mb-2">
											        				<label for="order_date">Дата</label>
											        				<div class="wd-200 mg-b-30">
																		<div class="input-group">
																			<div class="input-group-prepend">
																				<div class="input-group-text">
																					<i class="fa fa-calendar tx-16 lh-0 op-6"></i>
																				</div>
																			</div><input class="form-control datepicker" placeholder="MM/DD/YYYY" type="text" id="order_date" name="date" autocomplete="off" required>
																		</div>
																	</div>
											        			</div>
											        			<div class="col-md-12 mb-2">
											        				<button type="submit" class="btn btn-primary">Сохранить заказ</button>
											        			</div>
											        		</div>
											        	</div>
							      					</form>
												</div>
												<!-- Add order -->
											</div>
								      	</div>
								    </div>
								</div>
							</div>
							<!-- Footer -->
							@include('footer')
						
						</div>
					</div>
				</div>
			</div>
			<!-- app-content-->
		</div>
	</div>
	<a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>

	<script src="{{ asset('assets/plugins/jquery/dist/jquery.min.js') }}"></script>
	<script src="{{ asset('assets/js/popper.js') }}"></script>
	<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/datatable/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/datatable/dataTables.bootstrap4.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/toggle-sidebar/js/sidemenu.js') }}"></script>
	<script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
	<script src="{{ asset('assets/plugins/customscroll/jquery.mCustomScrollbar.concat.min.js') }}"></script>
	<script src="{{ asset('assets/js/custom.js') }}"></script>
	<script>
		$(function(e) {
			$('#products').DataTable({
				ordering: false,
			});
		});

		$('.datepicker').datepicker({
		 	showOtherMonths: true,
		 	selectOtherMonths: true
	   	});
		$(document).ready(function() {
			// брать продукты для поставки
			$('body').on('change', '.supply_category_select', function(event){
				event.preventDefault();
				let category_id = $(this).val();
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