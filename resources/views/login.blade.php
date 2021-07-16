<!DOCTYPE html>
<html lang="en" >
<head>
<meta charset="UTF-8">
<title>Đăng nhập</title>
<script src="{{ asset('js/app.js') }}" defer></script>
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('logintemplate/style.css') }}">
</head>
<body>
<!-- partial:index.partial.html -->
<div class="panda">
<div class="ear"></div>
<div class="face">
	<div class="eye-shade"></div>
	<div class="eye-white">
	<div class="eye-ball"></div>
	</div>
	<div class="eye-shade rgt"></div>
	<div class="eye-white rgt">
	<div class="eye-ball"></div>
	</div>
	<div class="nose"></div>
	<div class="mouth"></div>
</div>
<div class="body"> </div>
<div class="foot">
	<div class="finger"></div>
</div>
<div class="foot rgt">
	<div class="finger"></div>
</div>
</div>
<form method="POST" action="">
	@csrf
	<div class="hand"></div>
	<div class="hand rgt"></div>
	<h1>Phần mềm Quản lý văn bản</h1>
	<div class="form-group">
		<input required="required" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username"/>
		<label class="form-label">Tài khoản</label>

	</div>
	<div class="form-group">
		<input id="password" type="password" required="required" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"/>
		<label class="form-label">Mật khẩu</label>
		
	</div>
	<div class="form-group text-left" style="margin-left:20px;">
		<input id="my-input" class="form-check-input" type="checkbox" name="remember" value="remember">
		<label for="my-input" class="form-check-label">Lưu tài khoản</label>
	</div>
	<div class="form-group">
		<button type="submit" class="btn">Đăng nhập</button>
	</div>
	
	@if ( Session::has('error') )
		<p class="alert">
			<strong>{{ Session::get('error') }}</strong>
		</p>
	@endif
	
</form>
<!-- partial -->
<script src='{{ asset('logintemplate/jquery.min.js') }}'></script>
<script  src="{{ asset('logintemplate/script.js') }}"></script>
</body>
</html>