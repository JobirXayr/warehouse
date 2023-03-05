<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
	<div class="sidebar-img">
		<ul class="side-menu" style="margin-top: 82px;">
			<?php 
				$active = "";
				if (Request::segment(1) == "/products")
					$active = "active";
			?>
			<li class="slide {{ $active }}">
				<a class="side-menu__item" href="{{ route('products.index') }}"><i class="side-menu__icon fe fe-file-text"></i><span class="side-menu__label">Продукты</span></a>
			</li>
			<li class="slide {{ $active }}">
				<a class="side-menu__item" href="{{ route('stocks') }}"><i class="side-menu__icon fe fe-flag"></i><span class="side-menu__label">Поставки и заказы</span></a>
			</li>
			<!-- 
			<li class="slide">
				<a class="side-menu__item active" data-toggle="slide" href="#"><i class="side-menu__icon fe fe-list"></i><span class="side-menu__label">Сделки</span><i class="angle fa fa-angle-right"></i></a>
				<ul class="slide-menu">
					<li>
						<a class="slide-item" href="">Все сделки</a>
					</li>
					<li>
						<a class="slide-item" href="">Виды сделок</a>
					</li>
					<li>
						<a class="slide-item" href="">Компании</a>
					</li>
				</ul>	
			</li> -->
		</ul>
	</div>
</aside>