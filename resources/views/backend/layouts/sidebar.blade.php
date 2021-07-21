<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">PM Quản lý Văn bản</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="image">
				<img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
			</div>
			<div class="info">
				<a href="#" class="d-block">PX03</a>
			</div>
		</div>

      <!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				<li class="nav-item has-treeview menu-open">
					<a href="#" class="nav-link active">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
							Hiển thị Tổng quát
						</p>
					</a>
				</li>
				<li class="nav-item">
					<router-link to="/loaivanban" class="nav-link">
						<a>
							<i class="nav-icon fas fa-th"></i>
							<p>
								QL Loại Văn bản
							</p>
						</a>
					</router-link>
				</li>
				<li class="nav-item has-treeview">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-copy"></i>
						<p>
							Nguồn văn bản
							<i class="fas fa-angle-left right"></i>
							<span class="badge badge-info right">2</span>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<router-link to="/nguonden" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Nguồn văn bản đến</p>
							</router-link>
						</li>
						<li class="nav-item">
							<router-link to="/nguondi" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Nguồn văn bản đi</p>
							</router-link>
						</li>
					</ul>
				</li>
				<li class="nav-item">
					<router-link to="/lanhdao" class="nav-link">
						<a>
							<i class="nav-icon fas fa-th"></i>
							<p>
								QL Lãnh đạo
							</p>
						</a>
					</router-link>
				</li>
				<li class="nav-item">
					<router-link to="/donvi" class="nav-link">
						<a>
							<i class="nav-icon fas fa-th"></i>
							<p>
								QL Đơn vị
							</p>
						</a>
					</router-link>
				</li>
				<li class="nav-item">
					<a href="{{route('logout')}}" class="nav-link">
						<i class="fas fa-sign-out-alt nav-icon"></i>
						<p>Đăng xuất</p>
					</a>
				</li>
			</ul>
		</nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>