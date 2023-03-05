<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
	<title>Продукты</title>
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
									<li class="breadcrumb-item active" aria-current="page">Продукты</li>
								</ol>
							</div>

							@if (session('message'))
							    <div class="alert alert-success">
							        {{ session('message') }}
							    </div>
							@endif

							<div class="row">
								<div class="col-md-12">
									<button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#productModal">Создать новый продукт</button>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="card shadow">
										<div class="card-header">
											<h2 class="mb-0">Список всех продуктов</h2>
										</div>
										<div class="card-body">
											<div class="table-responsive">
												<table id="products" class="table table-bordered w-100">
													<thead>
														<tr>
															<th class="text-center">П.н.</th>
															<th class="text-center">Название продукта</th>
															<th class="text-center">Категория</th>
															<th class="text-center" >Описание</th>
															<th class="text-center">Функция</th>
														</tr>
													</thead>
													<tbody>
														@foreach($products as $key => $value)
															<tr>
																<td style="width:3%;" class="text-center align-middle">{{ $key+1 }}</td>
																<td style="width:10%; white-space:pre-wrap;" class="text-center align-middle">{{ $value->name }}</td>
																<td style="width:10%;" class="text-center align-middle">{{ $value->category }}</td>
																<td style="width:59%; white-space:pre-wrap; text-align:justify;">{{ $value->description }}</td>
																<td style="width:18%;">
																	<a href="{{ route('products.show', $value->id) }}" class="btn btn-primary btn-sm">Изменить</a>
																	<form method="post" action="{{route('products.destroy', $value->id)}}" style="float:right;">
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
									</div>
								</div>
							</div>

							<div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
								    <div class="modal-content">
								    	<form action="{{ route('products.store') }}" method="post">
								      		@csrf
									      	<div class="modal-header">
									        	<h5 class="modal-title" id="productModalLabel">Параметры продукта</h5>
									        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									          		<span aria-hidden="true">&times;</span>
									        	</button>
									      	</div>
									      	<div class="modal-body">
									        	<div class="container">
									        		<div class="row">
									        			<div class="col-md-6 mb-2">
									        				<label for="category">Категория продукта</label>
									        				<select id="category" class="form-control" name="category">
									        					<option value="0">Выберите категорию</option>
									        					@foreach($categories as $key => $value)
									        						<option value="{{ $value->id }}">{{ $value->name }}</option>
									        					@endforeach		
									        				</select>
									        			</div>
									        			<div class="col-md-6 mb-2">
									        				<label for="name">Название продукта</label>
									        				<input id="name" type="text" autocomplete="off" class="form-control" name="product" required>
									        			</div>
									        			<div class="col-md-12 mb-2">
									        				<label for="description">Описание</label>
									        				<textarea rows="5" id="description" class="form-control" name="description"></textarea>
									        			</div>
									        		</div>
									        	</div>
									      	</div>
									      	<div class="modal-footer">
									        	<button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
									        	<button type="submit" class="btn btn-primary">Сохранить</button>
									      	</div>
								      	</form>
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
	<script src="{{ asset('assets/plugins/customscroll/jquery.mCustomScrollbar.concat.min.js') }}"></script>
	<script src="{{ asset('assets/js/custom.js') }}"></script>
	<script>
		$(function(e) {
			$('#products').DataTable({
				ordering: false,
			});
		});
	</script>
</body>
</html>