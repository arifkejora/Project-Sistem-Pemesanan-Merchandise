<?php
session_start();
include 'dbconnect.php';

$idproduk = $_GET['idproduk'];

if (isset($_POST['addprod'])) {
    if (!isset($_SESSION['log'])) {
        header('location:login.php');
    } else {
        $ui = $_SESSION['id'];
        $cek = mysqli_query($conn, "select * from cart where userid='$ui' and status='Cart'");
        $liat = mysqli_num_rows($cek);
        $f = mysqli_fetch_array($cek);
        $orid = $f['orderid'];

        // If there is an order ID
        if ($liat > 0) {
            $cekbrg = mysqli_query($conn, "select * from detailorder where idproduk='$idproduk' and orderid='$orid'");
            $liatlg = mysqli_num_rows($cekbrg);

            if ($liatlg > 0) {
                $brpbanyak = mysqli_fetch_array($cekbrg);
                $jmlh = $brpbanyak['qty'];
                $i = 1;
                $baru = $jmlh + $i;

                $updateaja = mysqli_query($conn, "update detailorder set qty='$baru' where orderid='$orid' and idproduk='$idproduk'");

                if ($updateaja) {
                    // Reduce stock in the produk table
                    $reduceStock = mysqli_query($conn, "update produk set stok = stok - 1 where idproduk = '$idproduk'");
                    
                    if ($reduceStock) {
                        echo "<div class='alert alert-success'>
                            Barang sudah pernah dimasukkan ke keranjang, jumlah akan ditambahkan
                        </div>
                        <meta http-equiv='refresh' content='1; url= product.php?idproduk=" . $idproduk . "'/>";
                    } else {
                        // Handle stock reduction failure
                        echo "<div class='alert alert-warning'>
                            Gagal menambahkan ke keranjang (Stock reduction failed)
                        </div>
                        <meta http-equiv='refresh' content='1; url= product.php?idproduk=" . $idproduk . "'/>";
                    }
                } else {
                    echo "<div class='alert alert-warning'>
                            Gagal menambahkan ke keranjang
                          </div>
                          <meta http-equiv='refresh' content='1; url= product.php?idproduk=" . $idproduk . "'/>";
                }
            } else {
                $tambahdata = mysqli_query($conn, "insert into detailorder (orderid,idproduk,qty) values('$orid','$idproduk','1')");
                if ($tambahdata) {
                    // Reduce stock in the produk table
                    $reduceStock = mysqli_query($conn, "update produk set stok = stok - 1 where idproduk = '$idproduk'");
                    
                    if ($reduceStock) {
                        echo "<div class='alert alert-success'>
                            Berhasil menambahkan ke keranjang
                        </div>
                        <meta http-equiv='refresh' content='1; url= product.php?idproduk=" . $idproduk . "'/>";
                    } else {
                        // Handle stock reduction failure
                        echo "<div class='alert alert-warning'>
                            Gagal menambahkan ke keranjang (Stock reduction failed)
                        </div>
                        <meta http-equiv='refresh' content='1; url= product.php?idproduk=" . $idproduk . "'/>";
                    }
                } else {
                    echo "<div class='alert alert-warning'>
                            Gagal menambahkan ke keranjang
                          </div>
                             <meta http-equiv='refresh' content='1; url= product.php?idproduk=" . $idproduk . "'/> ";
                }
            }
        } else {
            $oi = crypt(rand(22, 999), time());

            $bikincart = mysqli_query($conn, "insert into cart (orderid, userid) values('$oi','$ui')");

            if ($bikincart) {
                $tambahuser = mysqli_query($conn, "insert into detailorder (orderid,idproduk,qty) values('$oi','$idproduk','1')");
                if ($tambahuser) {
                    // Reduce stock in the produk table
                    $reduceStock = mysqli_query($conn, "update produk set stok = stok - 1 where idproduk = '$idproduk'");
                    
                    if ($reduceStock) {
                        echo "<div class='alert alert-success'>
                            Berhasil menambahkan ke keranjang
                        </div>
                        <meta http-equiv='refresh' content='1; url= product.php?idproduk=" . $idproduk . "'/>";
                    } else {
                        // Handle stock reduction failure
                        echo "<div class='alert alert-warning'>
                            Gagal menambahkan ke keranjang (Stock reduction failed)
                        </div>
                        <meta http-equiv='refresh' content='1; url= product.php?idproduk=" . $idproduk . "'/>";
                    }
                } else {
                    echo "<div class='alert alert-warning'>
                            Gagal menambahkan ke keranjang
                          </div>
                             <meta http-equiv='refresh' content='1; url= product.php?idproduk=" . $idproduk . "'/> ";
                }
            } else {
                echo "gagal bikin cart";
            }
        }
    }
}
?>



<!DOCTYPE html>
<html>
<head>
<title>BMI MERCHAND - Produk</title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- font-awesome icons -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
<!-- js -->
<script src="js/jquery-1.11.1.min.js"></script>
<!-- //js -->
<link href='//fonts.googleapis.com/css?family=Raleway:400,100,100italic,200,200italic,300,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<!-- start-smoth-scrolling -->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>
<!-- start-smoth-scrolling -->
</head>
	
<body>
<!-- header -->
	<div class="agileits_header">
		<div class="container">
			<div class="w3l_offers">
			</div>
			<div class="agile-login">
				<ul>
				<?php
				if(!isset($_SESSION['log'])){
					echo '
					<li><a href="registered.php"> Daftar</a></li>
					<li><a href="login.php">Masuk</a></li>
					';
				} else {
					
					if($_SESSION['role']=='Member'){
					echo '
					<li style="color:white">Halo, '.$_SESSION["name"].'
					<li><a href="logout.php">Keluar?</a></li>
					';
					} else {
					echo '
					<li style="color:white">Halo, '.$_SESSION["name"].'
					<li><a href="admin">Admin Panel</a></li>
					<li><a href="logout.php">Keluar?</a></li>
					';
					};
					
				}
				?>
					
				</ul>
			</div>
			<div class="product_list_header">  
					<a href="cart.php"><button class="w3view-cart" type="submit" name="submit" value=""><i class="fa fa-cart-arrow-down" aria-hidden="true"></i></button>
					 </a>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>

	<div class="logo_products">
		<div class="container">
		<div class="w3ls_logo_products_left1">
		<ul class="phone_email">
				<li><i class="fa fa-phone" aria-hidden="true"></i>Hubungi Kami : 089678234567</li>
				</ul>
			</div>
			<div class="w3ls_logo_products_left">
				<h1><a href="index.php">BMI MERCHAND</a></h1>
			</div>
		<div class="w3l_search">
			<form action="search.php" method="post">
				<input type="search" name="Search" placeholder="Cari produk...">
				<button type="submit" class="btn btn-default search" aria-label="Left Align">
					<i class="fa fa-search" aria-hidden="true"> </i>
				</button>
				<div class="clearfix"></div>
			</form>
		</div>
			
			<div class="clearfix"> </div>
		</div>
	</div>
<!-- //header -->
<!-- navigation -->
	<div class="navigation-agileits">
		<div class="container">
			<nav class="navbar navbar-default">
							<!-- Brand and toggle get grouped for better mobile display -->
							<div class="navbar-header nav_2">
								<button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
							</div> 
							<div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
								<ul class="nav navbar-nav">
									<li class="active"><a href="index.php" class="act">Home</a></li>	
									
									<li><a href="cart.php">Keranjang Saya</a></li>
									<li><a href="daftarorder.php">Daftar Order</a></li>
								</ul>
							</div>
							</nav>
			</div>
		</div>
		
<!-- //navigation -->
<!-- breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
				<li><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
				<li class="active"><?php 
				$p = mysqli_fetch_array(mysqli_query($conn,"Select * from produk where idproduk='$idproduk'"));
				echo $p['namaproduk'];
				?></li>
			</ol>
		</div>
	</div>
<!-- //breadcrumbs -->
	<div class="products">
		<div class="container">
			<div class="agileinfo_single">
				
				<div class="col-md-4 agileinfo_single_left">
					<img id="example" src="<?php echo $p['gambar']?>" alt=" " class="img-responsive">
				</div>
				<div class="col-md-8 agileinfo_single_right">
				<h2><?php echo $p['namaproduk'] ?></h2>
					<div class="rating1">
						<span class="starRating">
							<?php
								$bintang = '<i class="fa fa-star blue-star" aria-hidden="true"></i>';
								$rate = $p['rate'];
								
								for($n=1;$n<=$rate;$n++){
								echo '<i class="fa fa-star blue-star" aria-hidden="true"></i>';
								};
								?>
						</span>
					</div>
					<div class="w3agile_description">
						<h4>Deskripsi :</h4>
						<p><?php echo $p['deskripsi'] ?></p>
					</div>

					<div class="w3agile_description">
						<h4>Stok :</h4>
						<p><?php echo $p['stok'] ?></p>
					</div> 
					<div class="snipcart-item block">
						<div class="snipcart-thumb agileinfo_single_right_snipcart">
							<h4 class="m-sing">Rp<?php echo number_format($p['hargaafter']) ?> <span>Rp<?php echo number_format($p['hargabefore']) ?></span></h4>
						</div>
						<div class="snipcart-details agileinfo_single_right_details">
							<form action="#" method="post">
								<fieldset>
									<input type="hidden" name="idprod" value="<?php echo $idproduk ?>">
									<input type="submit" name="addprod" value="Add to cart" class="button">
								</fieldset>
							</form>
						</div>
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>

<!-- //footer -->
<div class="footer">
		<div class="container">
			<div class="w3_footer_grids">
				<div class="col-md-4 w3_footer_grid">
					<h3>Hubungi Kami</h3>
					<ul class="address">
						<li><i class="glyphicon glyphicon-map-marker" aria-hidden="true"></i>Ulujami, Pesanggrahan</li>
						<li><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i><a href="mailto:info@email">bmi.merchand@bmi.co.id</a></li>
						<li><i class="glyphicon glyphicon-earphone" aria-hidden="true"></i>089678234567</li>
					</ul>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
		
		<div class="footer-copy">
			
			<div class="container">
			<p>© 2022 |BMI MERCHAND</p>
			</div>
		</div>
	</div>
<!-- //footer -->	
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- top-header and slider -->
<!-- here stars scrolling icon -->
	<script type="text/javascript">
		$(document).ready(function() {
			
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 4000,
				easingType: 'linear' 
				};
			
								
			$().UItoTop({ easingType: 'easeOutQuart' });
								
			});
	</script>
<!-- //here ends scrolling icon -->

<!-- main slider-banner -->
<script src="js/skdslider.min.js"></script>
<link href="css/skdslider.css" rel="stylesheet">
<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery('#demo1').skdslider({'delay':5000, 'animationSpeed': 2000,'showNextPrev':true,'showPlayButton':true,'autoSlide':true,'animationType':'fading'});
						
			jQuery('#responsive').change(function(){
			  $('#responsive_wrapper').width(jQuery(this).val());
			});
			
		});
</script>	
<!-- //main slider-banner --> 
</body>
</html>