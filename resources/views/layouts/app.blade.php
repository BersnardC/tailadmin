<html lang="en">
	<head>
	    <meta charset="utf-8">
	    <link rel="icon" type="image/png" href="{{url('logo-tail.png')}}">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <meta name="description" content="Python bottle Client">
	    <meta name="author" content="Bersnard Coello">
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1">
	    <title>TailAdmin</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		<link
	      rel="stylesheet"
	      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
	      integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
	      crossorigin="anonymous"
	    />
	    <link rel="stylesheet" type="text/css" href="{{url('styles.css')}}">
	</head>
  	<body>
  		<div class="hero">
			<nav>
				<img src="https://media-exp1.licdn.com/dms/image/C4E03AQG6a0Pw6iyJnA/profile-displayphoto-shrink_200_200/0/1541457400725?e=1637798400&v=beta&t=LfsO6VmLjeFuv8fGf95cZGR62pvkPsiO_mWwv1938AM" alt="" class="logo">
				<ul>
					<li><a href="{{url('load_data')}}" target="_blank">Cargar datos</a></li>
					<li><a href="https://www.linkedin.com/in/bersnardcoello/" target="_blank">Sobre mi</a></li>
					<li><a href="https://github.com/BersnardC/tailadmin" target="_blank"><span class="fab fa-github"></span></a></li>
				</ul>
				<img src="./images/moon.png" alt="" id="icon">
			</nav>
		</div>
    	@yield('content')
    	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    	<!-- JavaScript Bundle with Popper -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
		<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        @yield('scripts')
	</body>
</html>