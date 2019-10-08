<!DOCTYPE html>
<html lang="zxx" class="no-js">
        <head>
            <!-- Mobile Specific Meta -->
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <!-- Favicon-->
            <link rel="shortcut icon" href="img/fav.png">
            <!-- Author Meta -->
            <meta name="author" content="colorlib">
            <!-- Meta Description -->
            <meta name="description" content="">
            <!-- Meta Keyword -->
            <meta name="keywords" content="">
            <!-- meta character set -->
            <meta charset="UTF-8">
            <!-- Site Title -->
            <title>Magazine</title>
            <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
            <!--
                CSS
                ============================================= -->
            <link rel="stylesheet" href="../assets/css/linearicons.css">
            <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
            <link rel="stylesheet" href="../assets/css/bootstrap.css">
            <link rel="stylesheet" href="../assets/css/magnific-popup.css">
            <link rel="stylesheet" href="../assets/css/nice-select.css">
            <link rel="stylesheet" href="../assets/css/animate.min.css">
            <link rel="stylesheet" href="../assets/css/owl.carousel.css">
            <link rel="stylesheet" href="../assets/css/jquery-ui.css">
            <link rel="stylesheet" href="../assets/css/main.css">
        </head>
	<body>
		@include('header')
		
		<div class="site-main-container">
			<!-- Start latest-post Area -->
			<section class="latest-post-area pb-120">
				<div class="container no-padding">
					<div class="row">                        
						<div class="col-lg-12 post-list">
                            @if(Session::has('alert-success'))
                            <div class="alert alert-success">
                                <div>{{Session::get('alert-success')}}</div>
                            </div>
                            @endif
							<!-- Start single-post Area -->
							<div class="single-post-wrap">
								<div class="content-wrap">
									<ul class="tags mt-10">
										<li>
										@if($user->tipe == 'admin')
											ADMIN
										@elseif($user->tipe == 'reguler')
                                            REGULER
										@endif
										</li>
									</ul>
									<h3> Nama : {{ $user->nama }} </h3>
									<h3> Username : {{ $user->username }} </h3>
                                    <h3> Nomor WA : {{ $user->nomorWA }} </h3>
									
								</div>								
                                <a href="{{ $user->id_user }}/edit"><p class="btn btn-info">Edit</p></a>
								<form action="/users/{{ $user->id_user }}" method="post">
									@method('DELETE')
									@csrf
									<input class="btn btn-danger" type="submit" value="Delete"/>
								</form>
								<div class="navigation-wrap justify-content-between d-flex">
									<a class="prev" href="/users"><span class="lnr lnr-arrow-left"></span>Back</a>								
								</div>
							</div>
						</div>
						<!-- End single-post Area -->
					</div>
				</div>
			</div>
		</section>
		<!-- End latest-post Area -->
	</div>


    <script src="../../assets/js/vendor/jquery-2.2.4.min.js"></script>
    <script src="../../assets/js/vendor/bootstrap.min.js"></script>
    <script src="../../assets/js/easing.min.js"></script>
    <script src="../../assets/js/hoverIntent.js"></script>
    <script src="../../assets/js/superfish.min.js"></script>
    <script src="../../assets/js/jquery.ajaxchimp.min.js"></script>
    <script src="../../assets/js/jquery.magnific-popup.min.js"></script>
    <script src="../../assets/js/mn-accordion.js"></script>
    <script src="../../assets/js/jquery-ui.js"></script>
    <script src="../../assets/js/jquery.nice-select.min.js"></script>
    <script src="../../assets/js/owl.carousel.min.js"></script>
    <script src="../../assets/js/mail-script.js"></script>
    <script src="../../assets/js/main.js"></script>
</body>
</html>