<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-dark nav-bg-dark">
	<a class="navbar-brand" href="{{url('dashboard')}}"><img src="{{session('brand')['logo']}}" alt="" style="width: 250px;"></a>
	<div><img src="{{session('brand')['slogan']}}" style="width: 100px; max-height: 40px"></div>
	<div class="collapse navbar-collapse" id="navbarText">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item active">
				
			</li>
		</ul>
		<span class="navbar-text">
			<a href="{{url('logout')}}" class="text-uppercase font-weight-bold mr-3" style="text-decoration: none;">Logout</a>
		</span>
	</div>
</nav>