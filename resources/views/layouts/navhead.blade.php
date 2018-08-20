<div class="blog-masthead">
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<div class="container container-fluid">

        <!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<a class="navbar-brand" href="{{ route('product.index') }}">Brand</a>
			<button type="button" class="navbar-toggler" data-toggle="collapse" 
			data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
			aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
		</div>
		<!-- Collect the nav links, forms, and oth content for toggling -->
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li><a class="nav-link nav-item active" href="/">Home</a></li>
				<li><a class="nav-link" href="#">About</a></li>
				@if (Auth::check())
					<li>
						<a class="nav-link ml-auto" 
						href="#">{{ Auth::user()->fname }} {{ Auth::user()->lname }}</a>
					</li>
            	@endif
			
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li>
				<a href="{{ route('product.shoppingCart') }}">
					<i class="fa fa-shopping-cart" aria-hidden="true"></i> Shopping Cart
					  <span class="badge">
                	    {{ Session::has('cart') ? Session::get('cart')->totalQty : '' }}
                	  </span> 
                </a></li>
                <li><div class="dropdown">
					<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" 
                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @if(Auth::check()) User  @else  Visitor  @endif
					</button>
					<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    	@if(Auth::check())  
                    		<a class="dropdown-item" href="{{ route('profile') }}">User Profile</a>
                    		<div class="dropdown-divider"></div>
                    		<a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                    	@else
                    		<a class="dropdown-item" href="{{ route('signup') }}">Signup</a>
                    		<a class="dropdown-item" href="{{ route('login') }}">Signin</a>
                    	@endif
                    </div>
				</div></li>
			</ul>
		</div><!-- /.navbar-collapse -->
    </div> <!-- /.container-fluid -->
	</nav>
</div>