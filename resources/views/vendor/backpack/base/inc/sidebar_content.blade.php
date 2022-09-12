<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item">
	<a class="nav-link" href="{{ backpack_url('dashboard') }}">
		<i class="fa fa-dashboard nav-icon"></i> {{ trans('backpack::base.dashboard') }}
	</a>
</li>

<!-- BUSINESSES -->
@if(backpack_user()->can('access business') || backpack_user()->email == 'dev@tigernetthost.com')
	<li class="nav-item nav-dropdown">
		<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon fas fa-building"></i> Businesses</a>
		<ul class="nav-dropdown-items">
			<!-- BUSINESSES -->
			<li class='nav-item'>
				<a class='nav-link' href="{{ backpack_url('business') }}">
					<i class='nav-icon fas fa-building'></i> Businesses
				</a>
			</li>
			<!-- FEATURED BUSINESSES -->
			@if(backpack_user()->can('access featured business') || backpack_user()->email == 'dev@tigernetthost.com')
				<li class='nav-item'>
					<a class='nav-link' href="{{ backpack_url('featuredbusiness') }}">
						<i class='nav-icon fas fa-building'></i> FeaturedBusinesses
					</a>
				</li>
			@endif
			<!-- PENDING BUSINESSES -->
			<li class='nav-item'>
				<a class='nav-link' href="{{ backpack_url('pending-business') }}">
					<i class='nav-icon fas fa-building'></i> Pending Businesses
				</a>
			</li>
			<!-- DRAFTED BUSINESSES -->
			<li class='nav-item'>
				<a class='nav-link' href="{{ backpack_url('drafted-business') }}">
					<i class='nav-icon fas fa-building'></i> Drafted Businesses
				</a>
			</li>
		</ul>
	</li>
@endif

<!-- BUSINESS PRODUCT & SERVICES -->
@if(backpack_user()->can('access business product-services') || backpack_user()->email == 'dev@tigernetthost.com')
	<li class='nav-item'>
		<a class='nav-link' href="{{ backpack_url('product-service') }}">
			<i class="nav-icon fas fa-tools"></i> Product & Services
		</a>
	</li>
@endif

@if(backpack_user()->can('access business') || backpack_user()->email == 'dev@tigernetthost.com')
	<li class='nav-item'>
		<a class='nav-link' href="{{ backpack_url('business-coupon') }}">
			<i class='nav-icon fas fa-gifts'></i> Business Coupons
		</a>
	</li>
@endif

<!-- JOBS -->
@if(backpack_user()->can('access job') || backpack_user()->can('access job category') || backpack_user()->email == 'dev@tigernetthost.com')
	<li class="nav-item nav-dropdown">
		<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon fas fa-briefcase"></i> Jobs</a>
		<ul class="nav-dropdown-items">
			<!-- JOBS & PENDING JOBS -->
			@if(backpack_user()->can('access job') || backpack_user()->email == 'dev@tigernetthost.com')
				<li class='nav-item'>
					<a class='nav-link' href="{{ backpack_url('job') }}">
						<i class='nav-icon fas fa-briefcase'></i> Jobs
					</a>
				</li>
				<li class='nav-item'>
					<a class='nav-link' href="{{ backpack_url('pending-job') }}">
						<i class='nav-icon fas fa-briefcase'></i> Pending Jobs
					</a>
				</li>
			@endif
			<!-- JOB CATEGORIES -->
			@if(backpack_user()->can('access job category') || backpack_user()->email == 'dev@tigernetthost.com')
				<li class='nav-item'>
					<a class='nav-link' href="{{ backpack_url('jobcategory') }}">
						<i class='nav-icon fas fa-briefcase'></i> JobCategories
					</a>
				</li>
			@endif
		</ul>
	</li>
@endif

<!-- LISTING -->
@if(backpack_user()->can('access tag') || backpack_user()->can('access business category') || backpack_user()->email == 'dev@tigernetthost.com')
	<li class="nav-item nav-dropdown">
		<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon fas fa-pencil-alt"></i> Listing</a>
		<ul class="nav-dropdown-items">
			<!-- CATEGORIES -->
			@if(backpack_user()->can('access business category') || backpack_user()->email == 'dev@tigernetthost.com')
		  		<li class='nav-item'>
		  			<a class='nav-link' href="{{ backpack_url('category') }}">
		  				<i class='nav-icon fas fa-list-alt'></i> Categories
		  			</a>
		  		</li>
		  	@endif
		  	<!-- TAGS -->
		  	@if(backpack_user()->can('access tag') || backpack_user()->email == 'dev@tigernetthost.com')
		  		<li class='nav-item'>
		  			<a class='nav-link' href="{{ backpack_url('tag') }}">
		  				<i class='nav-icon fas fa-tags'></i> Tags
		  			</a>
		  		</li>
		  	@endif
		</ul>
	</li>
@endif

<!-- MONITORING -->
@if(backpack_user()->can('access survey') || backpack_user()->can('access business visitor') || backpack_user()->can('access sale') || backpack_user()->email == 'dev@tigernetthost.com')
	<li class="nav-item nav-dropdown">
		<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon fas fa-poll"></i> Monitoring</a>
		<ul class="nav-dropdown-items">
			<!-- SURVEYS -->
			@if(backpack_user()->can('access survey') || backpack_user()->email == 'dev@tigernetthost.com')
		  		<li class='nav-item'>
		  			<a class='nav-link' href="{{ backpack_url('survey') }}">
		  				<i class='nav-icon fas fa-poll'></i> Surveys
		  			</a>
		  		</li>
		  	@endif
		  	<!-- BUSINESS VISITORS -->
		  	@if(backpack_user()->can('access business visitor') || backpack_user()->email == 'dev@tigernetthost.com')
		  		<li class='nav-item'>
		  			<a class='nav-link' href="{{ backpack_url('businessvisitor') }}">
		  				<i class='nav-icon fas fa-poll'></i> BusinessVisitors
		  			</a>
		  		</li>
		  	@endif
		  	<!-- SALES -->
		  	@if(backpack_user()->can('access sale') || backpack_user()->email == 'dev@tigernetthost.com')
				<li class='nav-item'>
					<a class='nav-link' href="{{ backpack_url('sale') }}">
						<i class='nav-icon fas fa-poll'></i> Sales
					</a>
				</li>
			@endif
		</ul>
	</li>
@endif

<!-- SETTING UP -->
@if(backpack_user()->can('access barangay') || backpack_user()->can('access location') || backpack_user()->email == 'dev@tigernetthost.com')
	<li class="nav-item nav-dropdown">
		<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon fas fa-compass"></i> Setting up</a>
		<ul class="nav-dropdown-items">
			<!-- LOCATIONS -->
			@if(backpack_user()->can('access location') || backpack_user()->email == 'dev@tigernetthost.com')
				<li class='nav-item'>
					<a class='nav-link' href="{{ backpack_url('location') }}">
						<i class="nav-icon fas fa-location-arrow"></i> Locations
					</a>
				</li>
			@endif
			<!-- BARANGAYS -->
			@if(backpack_user()->can('access barangay') || backpack_user()->email == 'dev@tigernetthost.com')
				<li class='nav-item'>
					<a class='nav-link' href="{{ backpack_url('baranggay') }}">
						<i class="nav-icon fas fa-map-marker-alt"></i> Barangays
					</a>
				</li>
			@endif
		</ul>
	</li>
@endif

<!-- PAYMENTS -->
@if(backpack_user()->can('access payment') || backpack_user()->email == 'dev@tigernethost.com')
	<li class="nav-item nav-dropdown">
		<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon fas fa-hand-holding-usd"></i> Payment</a>
		<ul class="nav-dropdown-items">

			<!-- PAYNAMICS PAYMENTS -->
			@if(backpack_user()->can('access paynamics-payment') || backpack_user()->email == 'dev@tigernethost.com')
				<li class='nav-item'>
					<a class='nav-link' href='{{ backpack_url('paynamics-payment') }}'>
						<i class='nav-icon la la-coins'></i> Payments
					</a>
				</li>
			@endif

            <!-- PAYBIZ WALLET -->
			@if(backpack_user()->can('access paybiz-wallet') || backpack_user()->email == 'dev@tigernethost.com')
                <li class='nav-item'>
                    <a class='nav-link' href='{{ backpack_url('paybiz-wallet') }}'>
                        <i class='nav-icon fas fa-wallet'></i> Paybiz Wallet
                    </a>
                </li>
            @endif

			<!-- PAYMENT METHOD -->
			@if(backpack_user()->can('access payment-method') || backpack_user()->email == 'dev@tigernethost.com')
				<li class='nav-item'>
					<a class='nav-link' href='{{ backpack_url('payment-method') }}'>
						<i class='nav-icon fas fa-money-check-alt'></i> Payment Methods
					</a>
				</li>
			@endif

			<!-- PAYMENT CATEGORY -->
			@if(backpack_user()->can('access payment-category') || backpack_user()->email == 'dev@tigernethost.com')
				<li class='nav-item'>
					<a class='nav-link' href='{{ backpack_url('payment-category') }}'>
						<i class='nav-icon fas fa-money-check-alt'></i> Payment Categories
					</a>
				</li>
			@endif
		</ul>
	</li>
@endif

<!-- NEWSLETTER -->
@if(backpack_user()->can('access newsletter') || backpack_user()->email == 'dev@tigernetthost.com')
	<li class='nav-item'>
		<a class='nav-link' href="{{ backpack_url('newsletter') }}">
			<i class='nav-icon fas fa-newspaper'></i> Newsletters
		</a>
	</li>
@endif

<!-- MESSAGES -->
@if(backpack_user()->can('access message') || backpack_user()->email == 'dev@tigernetthost.com')
	<li class='nav-item'>
		<a class='nav-link' href="{{ backpack_url('message') }}">
			<i class='nav-icon fas fa-envelope'></i> Messages
		</a>
	</li>
@endif

<!-- AUTHENTICATIONS -->
@if(backpack_user()->can('access user') || backpack_user()->can('access role') || backpack_user()->can('access permission') || backpack_user()->email == 'dev@tigernetthost.com')
	<li class="nav-item nav-dropdown">
		<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon fas fa-users"></i> Authentication</a>
		<ul class="nav-dropdown-items">
			<!-- USERS -->
			@if(backpack_user()->can('access user') || backpack_user()->email == 'dev@tigernetthost.com')
		  		<li class="nav-item">
		  			<a class="nav-link" href="{{ backpack_url('user') }}">
		  				<i class="nav-icon fas fa-user"></i> <span>Users</span>
		  			</a>
		  		</li>
		  	@endif
			<!-- ROLES -->
			@if(backpack_user()->can('access role') || backpack_user()->email == 'dev@tigernetthost.com')
		  		<li class="nav-item">
		  			<a class="nav-link" href="{{ backpack_url('role') }}">
		  				<i class="nav-icon fas fa-id-badge"></i> <span>Roles</span>
		  			</a>
		  		</li>
		  	@endif
		  	<!-- PERMISSIONS -->
		  	@if(backpack_user()->can('access permission') || backpack_user()->email == 'dev@tigernetthost.com')
		  		<li class="nav-item">
		  			<a class="nav-link" href="{{ backpack_url('permission') }}">
		  				<i class="nav-icon fas fa-key"></i> <span>Permissions</span>
		  			</a>
		  		</li>
		  	@endif
		</ul>
	</li>
@endif

<!-- BUSINESS OWNER -->
@if(backpack_user()->can('access business owner') || backpack_user()->email == 'dev@tigernetthost.com')
	<li class='nav-item'>
		<a class='nav-link' href="{{ backpack_url('business-owner') }}">
			<i class='nav-icon fas fa-user-tie'></i> Business Owners
		</a>
	</li>
@endif

<!-- FILE MANAGER -->
@if(backpack_user()->can('access file manager') || backpack_user()->email == 'dev@tigernetthost.com')
	<li class=nav-item>
		<a class=nav-link href="{{ backpack_url('elfinder') }}">
			<i class="nav-icon far fa-file"></i> <span>{{ trans('backpack::crud.file_manager') }}</span>
		</a>
	</li>
@endif

<!-- LOGS -->
@if(backpack_user()->can('access log') || backpack_user()->email == 'dev@tigernetthost.com')
	<li class='nav-item'>
		<a class='nav-link' href="{{ backpack_url('log') }}">
			<i class="nav-icon fas fa-clipboard-list"></i> Logs
		</a>
	</li>
@endif

<!-- SETTINGS -->
@if(backpack_user()->can('access setting') || backpack_user()->email == 'dev@tigernetthost.com')
	<li class='nav-item'>
		<a class='nav-link' href="{{ backpack_url('setting') }}">
			<i class='nav-icon fa fa-cog'></i> Settings
		</a>
	</li>
@endif

{{-- <li class='nav-item'><a class='nav-link' href="{{ backpack_url('directory') }}"><i class='nav-icon fa fa-question'></i> Directories</a></li>
<li class='nav-item'><a class='nav-link' href="{{ backpack_url('businesscategory') }}"><i class='nav-icon fa fa-question'></i> BusinessCategories</a></li>
<li class='nav-item'><a class='nav-link' href="{{ backpack_url('businesstag') }}"><i class='nav-icon fa fa-question'></i> BusinessTags</a></li>
<li class='nav-item'><a class='nav-link' href="{{ backpack_url('page') }}"><i class='nav-icon fa fa-file-o'></i> <span>Pages</span></a></li>
<li class='nav-item'><a class='nav-link' href="{{ backpack_url('menu-item') }}"><i class='nav-icon fa fa-list'></i> <span>Menu</span></a></li> --}}
{{-- <li class="nav-item"><a class="nav-link" href="{{ backpack_url('elfinder') }}"><i class="nav-icon la la-files-o"></i> <span>{{ trans('backpack::crud.file_manager') }}</span></a></li> --}}