<!DOCTYPE html>
<html lang="en">
<head>

  <!-- SITE TITTLE -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Hardigurdi (Self Belief) | An Online Test Series</title>
  
  <!-- PLUGINS CSS STYLE -->
  <!-- Bootstrap -->
 

	<!-- HardiGurdi Font -->  
	<link href="{{ asset('plugins/HardiGurdi-font/style.css') }}" rel="stylesheet">

	<!-- CUSTOM CSS -->
	<link href="{{ asset('css/style.css') }}" rel="stylesheet">

	<!-- FAVICON -->
	<link href="{{ url('favicon.ico') }}" rel="shortcut icon">



   	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-137367922-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-137367922-1');
	</script>


</head>

<body class="body-wrapper">


<nav class="navbar main-nav fixed-top navbar-expand-lg">
  <div class="container">
		<H3>
			<a class="navbar-brand" href="homepage.html">
				<img src="images/icon.png" width="30" height="30" class="d-inline-block align-top" alt="">
		  		<span style="color: white; font-size: 1em">HardiGurdi</span>
		 	</a>
		</H3>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
	    <span style="color: white; font-size: 1em"><i class="fas fa-bars"></i></span>
	  </button>





      <div class="collapse navbar-collapse" id="navbarNav">
	      <ul class="navbar-nav ">
	        <li class="nav-item">
	          <a class="nav-link scrollTo" href="#home">Home</a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link scrollTo" href="#about">About</a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link scrollTo" href="#feature">Why US?</a>
	        </li>
	        <!-- <li class="nav-item">
	          <a class="nav-link scrollTo" href="#pricing">Pricing</a>
	        </li> -->
	        <!-- <li class="nav-item">
	          <a class="nav-link scrollTo" href="#team">Team</a>
	        </li> -->
	        <li class="nav-item">
	          <a class="nav-link scrollTo" href="#contact">Contact</a>
	        </li>
	      </ul>
      </div>
  </div>
</nav>


<div class="alert alert-danger" role="alert">
  Welcome HardiGurdi.com
</div>

@if (session('status'))
	<div class="alert alert-success" role="alert">
		<strong>Success!</strong> {{session('status')}}.
	</div>         
@endif

@if ($errors->any())
	<div class="alert alert-danger" role="alert">
	    <ul>
	        @foreach ($errors->all() as $error)
	            <strong><li>Error!!{{ $error }}</li></strong>
	        @endforeach
	    </ul>
	</div>
@endif

<!--=====================================
=            Homepage Banner            =
======================================-->

<section class="banner bg-1" id="home">
	<div class="container">
		<div class="row">
			<div class="col-md-8 align-self-center">
				<!-- Contents -->
				<div class="content-block">

					<blockquote>
					  Luck is what happens when preparation meets opportunity.
					  <H3><span>Seneca</span></H3>
					</blockquote>

				</div>
			</div>
			<div class="col-md-4">
				<!-- App Image -->
				<div class="image-block">
					<img class="img-fluid" src="images/phones/iphone-banner.png" alt="iphone-banner">
				</div>
			</div>
		</div>
	</div>
</section>

<!--====  End of Homepage Banner  ====-->

<!--===========================
=            About            =
============================-->

<section class="about section bg-about" id="about">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="section-title" >
					<h2 style="color: white;">About US</h2>
				</div>
			</div>
		</div>
		<div class="row">
			<div >
				<h1>
					<p style="font-size: 25px; color: white; margin: 10px;">
					Hardi Gurdi<sup>©</sup> was conceptualized amidst the same struggle faced by millions of aspirants in a country where the hallowed sarkari naukri never goes out of vogue.  Public sector jobs in India have always enjoyed an almost sacred position amongst job seekers. In a country which is currently experiencing a demographic spring, employment with the State guarantees adequate support, security, and coveted prestige.   The architects of Hardi Gurdi<sup>©</sup> have had the first-hand experience of the same and have tasted wide success. It is thus their wish to share the experience of their journey and impart guidance to thousands of such candidates who may find themselves lost.
					</p>
				</h1>
				
			</div>
		</div>
	</div>
</section>







<section class="about section bg-2">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="section-title">
					<h2>App Features</h2>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-5 col-md-5 m-md-auto align-self-center ml-auto">
				<!-- Image Content -->
				<div class="image-block">
					<img src="images/phones/phone2.png" alt="iphone-feature" class="img-fluid">
				</div>
			</div>

			<div class="col-lg-6 col-md-10 m-md-auto align-self-center ml-auto">
				<div class="about-block">
					<!-- About 01 -->
					<div class="about-item">
						<div class="icon">
							<i class="tf-ion-ios-paper-outline"></i>
						</div>
						<div class="content">
							<h5>Creative Design</h5>

						</div>
					</div>
					<!-- About 02 -->
					<div class="about-item active">
						<div class="icon">
							<i class="tf-globe"></i>
						</div>
						<div class="content">
							<h5>Easy to Use</h5>

						</div>
					</div>
					<!-- About 03 -->
					<div class="about-item">
						<div class="icon">
							<i class="tf-circle-compass"></i>
						</div>
						<div class="content">
							<h5>Best User Experience</h5>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!--====  End of About  ====-->


<!--=================================
=            Promo Video            =
==================================-->

<section class="section promo-video bg-3 overlay">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<!-- Promo Video -->
				<div class="video">
					<img class="img-fluid" src="images/backgrounds/promo-video-bg.jpeg" alt="video-thumbnail">
					<div class="video-button video-box">
						<!-- Video Play Button -->
						<a href="javascript:void(0)">
							<span class="icon" data-video="https://www.youtube.com/embed/tPASI1rGd-Q?autoplay=1">
								<i class="tf-ion-ios-play-outline"></i>
							</span>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!--====  End of Promo Video  ====-->

<!--===================================
=            Pricing Table            =
====================================-->

<!-- <section class="pricing section bg-shape" id="pricing">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="section-title">
					<h2>Choose Your Subscription Plan</h2>
					<p>Demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee idea of denouncing pleasure and praising</p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-4 col-md-6">
				<div class="pricing-table text-center">	
					<div class="title">	
						<h5></h5>
					</div>
					<div class="price">	
						<p>$0<span>/month</span></p>
					</div>
					<ul class="feature-list">
						<li>Android App</li>
						<li>One time payment</li>
						<li>Build & Publish</li>
						<li>Life time support</li>
					</ul>
					<div class="action-button">
						<a href="" class="btn btn-main-rounded">Start Now</a>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6">
				 <div class="pricing-table featured text-center">	
					<div class="title">	
						<h5>Basic</h5>
					</div>
				 	<div class="price">	
						<p>$19<span>/month</span></p>
					</div>
				 	<ul class="feature-list">
						<li>Android App</li>
						<li>One time payment</li>
						<li>Build & Publish</li>
						<li>Life time support</li>
					</ul>
				 	<div class="action-button">
						<a href="" class="btn btn-main-rounded">Start Now</a>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6 m-md-auto">
				 <div class="pricing-table text-center">	
					<div class="title">	
						<h5>Advance</h5>
					</div>
					<div class="price">	
						<p>$99<span>/month</span></p>
					</div>
					<ul class="feature-list">
						<li>Android App</li>
						<li>One time payment</li>
						<li>Build & Publish</li>
						<li>Life time support</li>
					</ul>
					<div class="action-button">
						<a href="" class="btn btn-main-rounded">Start Now</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section> -->

<!--====  End of Pricing Table  ====-->

<!--=============================================
=            Call to Action Download            =
==============================================-->


<section id="feature">
	<dir class="container" style="color: white;" >

		<div class="card text-white bg-primary mb-12" >
		  <div class="card-body">
		  	<div class="card-header">
		  		<div class="">
					<h1 class="section-title"  style="color: white; font-size: 48px">Why HardiGurdi?</h1>
					
				</div>
		  	</div>
		    <p class="card-title" style="color: white; font-size: 25px;" >Tests and mock practices have become essentials for all the students, given the cut-throat competition public sector employment is suffering with right now. We have come up with most popular and hassle free method of providing a platform for the candidates to access information and mock practices through our mobile application. We only offer our services via this app and upon no other platform or website.</p>


		    <p class="card-title" style="color: white;font-size: 25px;">The Hardi Gurdi<sup>©</sup> Mobile App. has been specially designed in the most creative, interesting, and user-friendly fashion. The seamless interface with most relevant and updated data makes the mobile-app a delight to use. Hardi Gurdi<sup>©</sup> offers tests which have been especially curated by academicians and experts who have successfully competed and contributed in a wide range of government exams, recruitments, and interviews for state and central agencies. Their rich experience and unique knack of accuracy is easily evident with number success stories and testimonials numerous candidates have shared over time on different platforms in praise and gratitude of Hardi Gurdi<sup>©</sup> and its mentors.</p>

		    <p class="card-title" style="color: white;font-size: 25px;">Hardi Gurdi<sup>©</sup> test series is currently being offered at a nominal introductory price. We wish to maintain our costs as affordable as possible for all our aspirants. We are confident by the virtue of our dedicated mentors and unprecedented response of the successful candidates that every single candidate who opts for our test series will find oneself comprehensively better prepared for their upcoming examination. </p>
		  </div>
		</div>
	</dir>
</section>



<section class="cta-download bg-3 overlay">
	<div class="container">
		<div class="row">
			<div class="col-lg-5">
				<div class="image-block"><img class="img-fluid" src="images/phones/iphone-chat.png" alt=""></div>
			</div>
			<div class="col-lg-7">
				<div class="content-block">
					<!-- Title -->
					<h2> Download Now</h2>
					<!-- Desctcription -->
					<p>
						Success is not final; failure is not fatal: It is the courage to continue that counts.<br> It is better to fail in originality than to succeed in imitation.
					</p>
					<!-- App Badge -->
					<div class="app-badge" >
						<ul class="list-inline" >
							<li class="list-inline-item downloadapp-popover" data-toggle="popover" title="Great!!!" data-content="App will avalible soon...">
								<a ><img class="img-fluid" src="images/app-badge/google-play.png" alt="google-play"></a>
							</li>
							<!-- <li class="list-inline-item">
								<a href="#"><img class="img-fluid" src="images/app-badge/app-store.png" alt="app-store"></a>
							</li> -->
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>



<section style="margin-top: 2rem; margin-bottom: 2rem; ">
	<div class="container">
		<div class="card mb-12 shadow-lg bg-white rounded" >
		  <div class="row no-gutters">
		    <div class="col-md-4">
		      <img src="images/backgrounds/cs.jpg" class="card-img img-fluid" alt="...">
		    </div>
		    <div class="col-md-8">
		      <div class="card-body">
		        <h5 class="card-title card-title-adv">We are Launching..</h5>
		        <p class="card-text card-text-adv">Mock Tests will be launched from 6th of april 2019. Hope you will take advantage of our awesome  mobile appliction.</p>
		        <p class="card-text card-text-adv"><small class="text-muted">By CEO HardiGurdi</small></p>
		      </div>
		    </div>
		  </div>
		</div>
	</div>	
</section>


<section style="margin-top: 2rem; margin-bottom: 2rem; ">
	<div class="container">
		<div class="card mb-12 shadow-lg bg-white rounded" >
		  <div class="row no-gutters">
		    <div class="col-md-4">
		      <img src="images/backgrounds/apple-android-store-icons.png" class="card-img img-fluid" alt="...">
		    </div>
		    <div class="col-md-8">
		      <div class="card-body">
		        <h5 class="card-title card-title-adv"> On App Store</h5>
		        <p class="card-text card-text-adv">Available on Google play store & for Apple I store comming soon.</p>
		        <p class="card-text card-text-adv"><small class="text-muted">By CEO HardiGurdi</small></p>
		      </div>
		    </div>
		  </div>
		</div>
	</div>	
</section>



<section style="margin-top: 2rem; margin-bottom: 2rem; ">
	<div class="container">
		<div class="card mb-12 shadow-lg bg-white rounded" >
		  <div class="row no-gutters">
		    <div class="col-md-4">
		      <img src="images/phones/rrb.jpg" class="card-img img-fluid" alt="...">
		    </div>
		    <div class="col-md-8">
		      <div class="card-body">
		        <h5 class="card-title card-title-adv">RRB Tips</h5>
		         <p class="card-text card-text-adv">
			        in RRB exam questions are some bit trickier and harder to solve.But anything can achieved and conquered by constant effort and practice.For this I will give you some important tips.
				        <ol>
				        	<li>What are the topics much important?</li>
				        	<li>Put daily 4–5 hours for solving aptitude questions.</li>
				        	<li>Begin to write online mock tests for all aptitude topics.</li>
				        </ol>
		        </p>
		        <p class="card-text card-text-adv"><small class="text-muted">By Team HardiGurdi</small></p>
		      </div>
		    </div>
		  </div>
		</div>
	</div>	
</section>




<blockquote class="quote-box">
      <p class="quotation-mark">
        “
      </p>
      <p class="quote-text">
        <h3>We wish the very best to each and every one of you!</h3>
      </p>
      <hr>
      <div class="blog-post-actions">
        <p class="blog-post-bottom pull-left">
          <h5>Team HardiGurdi </h5>
        </p>
      </div>
    </blockquote>
<!--====  End of Call to Action Download  ====-->

<!--=============================
=            Counter            =
==============================-->
<!-- 
<section class="section counter bg-gray">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-6">
				<div class="counter-item">
					<h3>29k</h3>
					<p>Download</p>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="counter-item">
					<h3>200k</h3>
					<p>Active Account</p>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="counter-item">
					<h3>60k</h3>
					<p>Happy User</p>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="counter-item">
					<h3>300k<sup>+</sup></h3>
					<p>Download</p>
				</div>
			</div>
		</div>
	</div>
</section> -->

<!--====  End of Counter  ====-->


<!--============================
=            Contact us            =
=============================-->
<section class="container-fluid" id="contact">
	
	<div class="container" >
		<div class="row" >
  
			<form 
					style="
						align-self: center;
						align-content: center;
						align-items: center; 
						margin: 50px;" 
					class="col-md-12"
					action="{{url('submitFeedback')}}" 
					method="POST"

				>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

				<div class="form-row">
				    <div class="form-group col-md-6">
				      <label for="inputEmail4">Name</label>
				      <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
				    </div>
				    <div class="form-group col-md-6">
				      <label for="inputPassword4">Email</label>
				      <input type="Email" class="form-control" id="email" name="email" placeholder="Email" required>
				    </div>
				  </div>
			    <div class="form-group">
				    <label for="message">Message</label>
				    <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
				  </div>
				<button type="submit" class="btn btn-primary btn-lg btn-block">Send</button>
			</form>
		</div>
	</div>

</section>




<!--============================
=            Footer            =
=============================-->

<footer class="footer-main">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 mr-auto">
          
          <div class="footer-logo">
            <H3 style="color: white;">HardiGurdi</H3>
          </div>
          
          <div class="copyright">
            <p>@2018 HardiGurdi All Rights Reserved  |  Design By : <a href="https://HardiGurdi.com/" target="_blank">Team HardiGurdi</a> 
            </p>
          </div>
          
          <div class="footer-logo">
            <H1 >
            	<a href="mailto:support@hardigurdi.com" style="color: white; font-size: 25px; font-weight: bold">
            		<span style="font-size: 2em; color: white;">
					  <i class="far fa-envelope-open "></i>
					</span>
					 support@hardigurdi.com          		
	          	</a>
	          </H1>
          </div>

          <div class="row">
          	
          </div>

        </div>
        <div class="col-lg-6 text-lg-right">
          <!-- Social Icons -->
          <ul class="social-icons list-inline">
       <!--      <li class="list-inline-item">
              <a href=""><i class="tf-ion-social-facebook"></i></a>
            </li>
            <li class="list-inline-item">
              <a href=""><i class="tf-ion-social-twitter"></i></a>
            </li> -->
            <li class="list-inline-item">
              <a href="https://www.youtube.com/channel/UCKCEfG7MyziSnjA1Ds3CuHQ"><i class="tf-ion-social-youtube"></i></a>
            </li>
           <!--  <li class="list-inline-item">
              <a href=""><i class="tf-ion-social-instagram-outline"></i></a>
            </li> -->
          </ul>
          <!-- Footer Links -->
          <ul class="footer-links list-inline">
            <li class="list-inline-item">
              <a href="#about">ABOUT</a>
            </li>
            <li class="list-inline-item">
              <a href="#feature">Why US?</a>
            </li>
            <li class="list-inline-item">
              <a href="#contact">CONTACT</a>
            </li>


          </ul>
        </div>
      </div>
    </div>
</footer>



  <!-- JAVASCRIPTS -->
  

<script src="{{ asset('plugins/jquery/jquery.js') }}"></script>
<script src="{{ asset('plugins/popper/popper.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>

<script src="{{ asset('plugins/waypoints/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('plugins/slick/slick.min.js') }}"></script>
<script src="{{ asset('plugins/smoothscroll/SmoothScroll.min.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>

<!-- <link href="{{ asset('plugins/slick/slick.css') }}" rel="stylesheet">
<link href="{{ asset('plugins/slick/slick-theme.css') }}" rel="stylesheet">
<link href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
	
 -->







  <script type="text/javascript">
  		$(function () {
			$('.downloadapp-popover').popover({
				container: 'body'
			});
			$("ul.dropdown-menu").on("click", "[data-keepOpenOnClick]", function(e) {
		        e.stopPropagation();
		    });
		})
  </script>
	<!--Start of Tawk.to Script-->
	<script type="text/javascript">
		
		var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
		(function(){
		var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
		s1.async=true;
		s1.src='https://embed.tawk.to/5c9fbd771de11b6e3b0605da/default';
		s1.charset='UTF-8';
		s1.setAttribute('crossorigin','*');
		s0.parentNode.insertBefore(s1,s0);
		})();

	</script>
	<!--End of Tawk.to Script-->
</body>

</html>

