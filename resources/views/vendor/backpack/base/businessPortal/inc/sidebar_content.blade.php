<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->

<!--Dashboard -->
<li class="nav-item">
	<a class="nav-link" href="{{ route('business-portal.dashboard') }}">
		<i class="fa fa-dashboard nav-icon"></i> {{ trans('backpack::base.dashboard') }}
	</a>
</li>

<!--Businesses -->
<li class="nav-item nav-dropdown">
	<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon fas fa-business-time"></i> Businesses</a>
	<ul class="nav-dropdown-items">
		<li class='nav-item'>
			<a class='nav-link' href="{{ url('one-portal/my-business') }}">
				<i class='nav-icon fa fa-business-time'></i> My Businesses
			</a>
		</li>
	</ul>
</li>

<!-- Products and Services -->
<li class='nav-item'>
	<a class='nav-link' href="{{ url('one-portal/business-product-service') }}">
		<i class='nav-icon fas fa-tools'></i> Products & Services
	</a>
</li>

{{-- <li class='nav-item'>
	<a class='nav-link' href="{{ url('one-portal/coupon') }}">
		<i class='nav-icon fas fa-gifts'></i> Coupons
	</a>
</li> --}}

<!-- Transactions -->
<li class='nav-item'>
	<a class='nav-link' href="{{ url('one-portal/transaction') }}">
		<i class='nav-icon fas fa-tools'></i> Transactions
	</a>
</li>
