<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>UBID</title>
    <!--Bootstrap-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <!--font-awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="icon" href="images/favicon.ico">
    <!--custom css-->
<style>
    @font-face {
  font-family: Century Gothic;
  src: url('app-assets/fonts/fontfamily/fonts/GOTHIC.TTF');
}

body {
  background-color: #151515;
  font-family: Century Gothic;
}

.navbar-nav {
  align-items: center !important;
}

@media (max-width: 768px) {
  .navbar-nav {
    align-items: baseline !important;
  }
}

/*Hamburg Menu*/
.navbar-toggler {
  border: 2px solid #9e5a0d;
  padding: 8px;
}

#navMenu>span {
  display: block;
  width: 28px;
  height: 2px;
  border-radius: 9999px;
  background-color: white;
}

#navMenu>span:not(:last-child) {
  margin-bottom: 10px;
}

#navMenu,
#navMenu>span {
  transition: all 0.4s ease-in-out;
}

#navMenu.active {
  transition-delay: 0.8s;
  transform: rotate(180deg);
}
/* 404 page */
#notfound {
  position: relative;
  height: 85vh;
}

#notfound .notfound {
  position: absolute;
  left: 50%;
  top: 50%;
  -webkit-transform: translate(-50%, -50%);
      -ms-transform: translate(-50%, -50%);
          transform: translate(-50%, -50%);
}

.notfound {
  max-width: 767px;
  width: 100%;
  line-height: 1.4;
  text-align: center;
  padding: 15px;
}

.notfound .notfound-404 {
  position: relative;
  height: 220px;
}

.notfound .notfound-404 h1 {
  position: absolute;
  left: 50%;
  top: 50%;
  -webkit-transform: translate(-50%, -50%);
      -ms-transform: translate(-50%, -50%);
          transform: translate(-50%, -50%);
  font-size: 186px;
  font-weight: 200;
  margin: 0px;
  background: linear-gradient(
  130deg, #d3996c, #af774e);
  color:transparent;
  -webkit-background-clip: text;
  background-clip: text;
  text-transform: uppercase;
}

.notfound h2 {
  font-size: 33px;
  font-weight: 200;
  text-transform: uppercase;
  margin-top: 0px;
  margin-bottom: 25px;
  letter-spacing: 3px;
}


.notfound p {
  font-size: 16px;
  font-weight: 200;
  margin-top: 0px;
  margin-bottom: 25px;
}


.notfound a {
  color: #af774e;
  font-weight: 200;
  text-decoration: none;
  border-bottom: 1px dashed #af774e;
  border-radius: 2px;
}

@media only screen and (max-width: 480px) {
  .notfound .notfound-404 {
    position: relative;
    height: 168px;
  }

  .notfound .notfound-404 h1 {
    font-size: 142px;
  }

  .notfound h2 {
    font-size: 22px;
  }
}

</style>
</head>

<body style="background-color: #fff;">
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                <img src="{{url('app-assets\images\logo\UBID-Logo-1X.png')}}" alt="" height="60" /> &nbsp;
          <img src="{{url('app-assets\images\logo\ubid-text-logo.png')}}" alt="" height="50" />
                </a>
                <button class="navbar-toggler menu" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" data-menu="2">
                    <div id="navMenu">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <div class="navbar-nav ml-auto">
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- START content section-->
    <section>
    <div id="notfound">
		<div class="notfound">
			<div class="notfound-404">
				<h1>500</h1>
			</div>
			<h2>Oops! That page can’t be found.</h2>
			<p>The page you are looking for might have been removed or had its name changed or is temporarily unavailable.</p>
		</div>
	</div>
    </section>
    <!-- END content section-->
    <!-- TogglerMenu JS-->
    <script>
        const navMenu = document.querySelector("#navMenu");
        navMenu.addEventListener("click", () => {
            navMenu.classList.toggle("active");
        });
    </script>
    <!-- Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>