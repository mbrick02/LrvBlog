<div class="blog-masthead">
	<nav class="navbar navbar-default">
	<div class="container container-fluid">

        <!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
				data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="{{ route('product.index') }}">Brand</a>
		</div>
		<!-- Collect the nav links, forms, and oth content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li><a class="nav-link active" href="/">Home</a></li>
				<li><a class="nav-link" href="#">About</a></li>
				@if (Auth::check())
					<li>
						<a class="nav-link ml-auto" 
						href="#">{{ Auth::user()->fname }} {{ Auth::user()->lname }}</a>
					</li>
            	@endif
			
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="{{ route('product.shoppingCart') }}">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>Shopping Cart
                					<span class="badge">
                {{ Session::has('cart') ? Session::get('cart')->totalQty : '' }}
                </span> 
                </a></li>
                <li class="dropdown"><a href="#" class-"dropdown-toggle" 
                  data-toggle="dropdown" role="button" aria-haspopup="true" 
                  aria-expanded="false"><i class="fa fa-user" aria-hidden="true></i>
                  User Management <span class="caret"></span></a>
                	<ul class="dropdown-menu">
                		@if(Auth::check())    <!-- ****MB lesson 7 auth -->
                			<li><a href="{{ route('user.profile') }}">User Profile</a></li>
                			<li role="separator" class="divider"></li>
                			<li><a href="{{ route('user.logout') }}">Logout</a></li>
                		@else
                			<li><a href="{{ route('user.signup') }}">Signup</a></li>
                			<li><a href="{{ route('user.signin') }}">Signin</a></li>
                		@endif
                	</ul>
                </li>
			</ul>
		</div><!-- /.navbar-collapse -->
    </div> <!-- /.container-fluid -->
	</nav>
</div>