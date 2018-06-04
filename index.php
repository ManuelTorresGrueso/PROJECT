<!DOCTYPE HTML>
<!--
	Industrious by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title>Voetafdruk.online</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="is-preload">

		<!-- Banner -->
			<section id="banner">
				<div class="inner">
					<h1>Voetafdruk</h1>
					<p>Bereken hier je voetafdruk voor jou traject!<br /></p>
				</div>
				<video autoplay loop muted playsinline src="images/banner.mp4"></video>
			</section>

		<!-- Highlights -->
			<section class="wrapper">
				<div class="inner">
					<header class="special">
						<h2>Bereken het hier!</h2>
						<p>Hieronder vind je onze applicatie die we speciaal voor jou hebben ontworpen.</br> Maak er gebruik van en denk volgende keer nog eens na als je de auto pakt!</p>
					</header>
					
					<?Php $org=$_POST['org'];
$des=$_POST['des'];
$trans = $_POST['transport']; ?>
<form id="form1" name="form1" method="post" action="index.php">
<h5>beginpunt:
<input type="text" name="org" id="org" value="<?php echo $org; ?>" />
eindpunt:
<label for="des"></label>
<input type="text" name="des" id="des" value="<?php echo $des; ?>" />
</br>
<select name="transport" value="<?php echo $trans; ?>"class="selectpicker">
<option value="walking">Te voet</option>
<option value="driving">Auto</option>
<option value="transit">Bus</option>
<option value="bicycling">Fietsen</option>
</select>
<input type="submit" name="verzenden" id="button" value="Bereken"/>
</h5>
</br>

<?php
$trans = $_POST['transport'];
/*-----------Wandelen-----------*/
if ($trans == 'walking')
{
$org=$_POST['org'];
$des=$_POST['des'];
if(isset($_POST['org']) && isset($_POST['des']))
{
	
	echo "<iframe width='100%'
	height='550'
	frameborder='0'
	src='https://www.google.com/maps/embed/v1/directions?key=AIzaSyCWEo4W_7VHj6G55wNmGNOAK5YP9acEkA0&origin=$org&destination=$des&mode=$trans' allowfullscreen>
	</iframe></br>";
	$origin = $_POST['org']; $destination = $_POST['des'];
            $api = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=$origin&destinations=$destination&mode=$trans&key=AIzaSyCWEo4W_7VHj6G55wNmGNOAK5YP9acEkA0");
            $data = json_decode($api);
			
			/*-----------Wandelen VS Fietsen-----------*/
			$origin1 = $_POST['org']; $destination = $_POST['des'];
            $api1 = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=$origin&destinations=$destination&mode=bicycling&key=AIzaSyCWEo4W_7VHj6G55wNmGNOAK5YP9acEkA0");
            $data1 = json_decode($api1);
			/*-----------Wandelen VS Auto-----------*/
			$origin2 = $_POST['org']; $destination = $_POST['des'];
            $api2 = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=$origin&destinations=$destination&mode=driving&key=AIzaSyCWEo4W_7VHj6G55wNmGNOAK5YP9acEkA0");
            $data2 = json_decode($api2);
			/*-----------Wandelen VS Bus-----------*/
			$origin3 = $_POST['org']; $destination = $_POST['des'];
            $api3 = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=$origin&destinations=$destination&mode=driving&key=AIzaSyCWEo4W_7VHj6G55wNmGNOAK5YP9acEkA0");
            $data3 = json_decode($api3);

?>
<!--tabel-->
	<table>
	  <tr>
		<th> </th>
		<th>Wandelen</th>
		<th>Fietsen</th>
		<th>Auto</th>
		<th>Bus</th>
	  </tr>
	  <tr>
		<td><b>Afstand:</b></td>
		<td><span><?php echo ((int)$data->rows[0]->elements[0]->distance->value / 1000).' Km'; ?></span></td>
		<td><span><?php echo ((int)$data1->rows[0]->elements[0]->distance->value / 1000).' Km'; ?></span></td>
		<td><span><?php echo ((int)$data2->rows[0]->elements[0]->distance->value / 1000).' Km'; ?></span></td>
		<td><span><?php echo ((int)$data3->rows[0]->elements[0]->distance->value / 1000).' Km'; ?></span></td>
	  </tr>
	  <tr>
		<td><b>Reisduur:</b></td>
		<td><span><?php echo $data->rows[0]->elements[0]->duration->text; ?></span></td>
		<td><span><?php echo $data1->rows[0]->elements[0]->duration->text; ?></span></td>
		<td><span><?php echo $data2->rows[0]->elements[0]->duration->text; ?></span></td>
		<td><span><?php echo $data3->rows[0]->elements[0]->duration->text; ?></span></td>
	  </tr>
	  <tr>
		<td><b>CO² uitstoot:</b></td>
		<td><span><?php echo "0 gram CO²"; ?></span></td>
		<td><span><?php echo "0 gram CO²"; ?></span></td>
		<td><span><?php echo ((int)$data2->rows[0]->elements[0]->distance->value / 1000)*115 ." gram CO²"; ?></span></td>
		<td><span><?php echo ((int)$data3->rows[0]->elements[0]->distance->value / 1000)*75 ." gram CO²"; ?></span></td>
	  </tr>
	  <tr>
		<td><b>Aantal bomen nodig:</b></td>
		<td><span><?php echo "0 gram CO²"; ?></span></td>
		<td><span><?php echo "0 gram CO²"; ?></span></td>
		<td><span><?php echo round(((int)$data2->rows[0]->elements[0]->distance->value / 1000)*2) ." bomen"; ?></span></td>
		<td><span><?php echo round(((int)$data3->rows[0]->elements[0]->distance->value / 1000)*1.25) ." bomen"; ?></span></td>
	  </tr>
	  <tr>
		<td><b>Weergeven:</b></td>
		<td> </td>
		<td> </td>
		<td> <input type="submit" name="verzenden1" id="button" value="Weergeven"/></td>
		<td> <input type="submit" name="verzenden2" id="button" value="Weergeven"/></td>
	  </tr>
	</table>
  <?php
  if(isset($_POST['verzenden1']))
  {
	  $boom = round(((int)$data2->rows[0]->elements[0]->distance->value / 1000)*2);
	  $i = 1;
		while ($i <= $boom) {
					$i++; 
					echo"<img src='images/boom.jpg' alt='boom' style='width:10%;height:10%';>";
		}
  }
  if(isset($_POST['verzenden2']))
  {
	  $boom = round(((int)$data2->rows[0]->elements[0]->distance->value / 1000)*1.25);
	  $i = 1;
		while ($i <= $boom) {
					$i++; 
					echo"<img src='images/boom.jpg' alt='boom' style='width:10%;height:10%';>";
		}
  }
  
  ?>

<?php } }?>

<?php
$trans = $_POST['transport'];
/*-----------Rijden-----------*/
if ($trans == 'driving')
{
$org=$_POST['org'];
$des=$_POST['des'];
if(isset($_POST['org']) && isset($_POST['des']))
{

	echo "
	<iframe width='100%'
	height='550'
	frameborder='0'
	src='https://www.google.com/maps/embed/v1/directions?key=AIzaSyCWEo4W_7VHj6G55wNmGNOAK5YP9acEkA0&origin=$org&destination=$des&mode=$trans' allowfullscreen>
	</iframe></br>";
	$origin = $_POST['org']; $destination = $_POST['des'];
            $api = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=$origin&destinations=$destination&mode=$trans&key=AIzaSyCWEo4W_7VHj6G55wNmGNOAK5YP9acEkA0");
            $data = json_decode($api);
			
			/*-----------Rijden VS Wandelen-----------*/
			$origin1 = $_POST['org']; $destination = $_POST['des'];
            $api1 = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=$origin&destinations=$destination&mode=walking&key=AIzaSyCWEo4W_7VHj6G55wNmGNOAK5YP9acEkA0");
            $data1 = json_decode($api1);
			/*-----------Rijden VS Fietsen-----------*/
			$origin2 = $_POST['org']; $destination = $_POST['des'];
            $api2 = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=$origin&destinations=$destination&mode=bicycling&key=AIzaSyCWEo4W_7VHj6G55wNmGNOAK5YP9acEkA0");
            $data2 = json_decode($api2);
			/*-----------Rijden VS Bus-----------*/
			$origin3 = $_POST['org']; $destination = $_POST['des'];
            $api3 = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=$origin&destinations=$destination&mode=transit&key=AIzaSyCWEo4W_7VHj6G55wNmGNOAK5YP9acEkA0");
            $data3 = json_decode($api3);

?>
<!--tabel-->
	<table>
	  <tr>
		<th> </th>
		<th>Rijden</th>
		<th>Wandelen</th>
		<th>Fietsen</th>
		<th>Bus</th>
	  </tr>
	  <tr>
		<td><b>Afstand:</b></td>
		<td><span><?php echo ((int)$data->rows[0]->elements[0]->distance->value / 1000).' Km'; ?></span></td>
		<td><span><?php echo ((int)$data1->rows[0]->elements[0]->distance->value / 1000).' Km'; ?></span></td>
		<td><span><?php echo ((int)$data2->rows[0]->elements[0]->distance->value / 1000).' Km'; ?></span></td>
		<td><span><?php echo ((int)$data3->rows[0]->elements[0]->distance->value / 1000).' Km'; ?></span></td>
	  </tr>
	  <tr>
		<td><b>Reisduur:</b></td>
		<td><span><?php echo $data->rows[0]->elements[0]->duration->text; ?></span></td>
		<td><span><?php echo $data1->rows[0]->elements[0]->duration->text; ?></span></td>
		<td><span><?php echo $data2->rows[0]->elements[0]->duration->text; ?></span></td>
		<td><span><?php echo $data3->rows[0]->elements[0]->duration->text; ?></span></td>
	  </tr>
	  <tr>
		<td><b>CO² uitstoot:</b></td>
		<td><span><?php echo ((int)$data->rows[0]->elements[0]->distance->value / 1000)*115 ." gram CO²"; ?></span></td>
		<td><span><?php echo "0 gram CO²"; ?></span></td>
		<td><span><?php echo "0 gram CO²"; ?></span></td>
		<td><span><?php echo ((int)$data3->rows[0]->elements[0]->distance->value / 1000)*75 ." gram CO²"; ?></span></td>
	  </tr>
	  <tr>
		<td><b>Aantal Bomen nodig:</b></td>
		<td><span><?php echo round(((int)$data->rows[0]->elements[0]->distance->value / 1000)*2) ." bomen"; ?></span></td>
		<td> </td>
		<td></td>
		<td><span><?php echo round(((int)$data3->rows[0]->elements[0]->distance->value / 1000)*1.25) ." bomen"; ?></span></td>
	  <tr>
		<td><b>Weergeven:</b></td>
		<td><input type="submit" name="verzenden1" id="button" value="Weergeven"/> </td>
		<td> </td>
		<td> </td>
		<td> <input type="submit" name="verzenden2" id="button" value="Weergeven"/></td>
	  </tr>
	</table>
  <?php
  if(isset($_POST['verzenden1']))
  {
	  $boom = round(((int)$data2->rows[0]->elements[0]->distance->value / 1000)*2);
	  $i = 1;
		while ($i <= $boom) {
					$i++; 
					echo"<img src='images/boom.jpg' alt='boom' style='width:10%;height:10%';>";
		}
  }
  if(isset($_POST['verzenden2']))
  {
	  $boom = round(((int)$data2->rows[0]->elements[0]->distance->value / 1000)*1.25);
	  $i = 1;
		while ($i <= $boom) {
					$i++; 
					echo"<img src='images/boom.jpg' alt='boom' style='width:10%;height:10%';>";
		}
  }
  
  ?>
  
  

<?php } }?>

<?php
$trans = $_POST['transport'];
/*-----------Fietsen-----------*/
if ($trans == 'bicycling')
{
$org=$_POST['org'];
$des=$_POST['des'];
if(isset($_POST['org']) && isset($_POST['des']))
{

	echo "<iframe width='100%'
	height='550'
	frameborder='0'
	src='https://www.google.com/maps/embed/v1/directions?key=AIzaSyCWEo4W_7VHj6G55wNmGNOAK5YP9acEkA0&origin=$org&destination=$des&mode=$trans' allowfullscreen>
	</iframe></br>";
	$origin = $_POST['org']; $destination = $_POST['des'];
            $api = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=$origin&destinations=$destination&mode=$trans&key=AIzaSyCWEo4W_7VHj6G55wNmGNOAK5YP9acEkA0");
            $data = json_decode($api);
			
			/*-----------Fietsen VS Wandelen-----------*/
			$origin1 = $_POST['org']; $destination = $_POST['des'];
            $api1 = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=$origin&destinations=$destination&mode=walking&key=AIzaSyCWEo4W_7VHj6G55wNmGNOAK5YP9acEkA0");
            $data1 = json_decode($api1);
			/*-----------Fietsen VS Auto-----------*/
			$origin2 = $_POST['org']; $destination = $_POST['des'];
            $api2 = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=$origin&destinations=$destination&mode=driving&key=AIzaSyCWEo4W_7VHj6G55wNmGNOAK5YP9acEkA0");
            $data2 = json_decode($api2);
			/*-----------Fietsen VS Bus-----------*/
			$origin3 = $_POST['org']; $destination = $_POST['des'];
            $api3 = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=$origin&destinations=$destination&mode=transit&key=AIzaSyCWEo4W_7VHj6G55wNmGNOAK5YP9acEkA0");
            $data3 = json_decode($api3);

?>
<!--tabel-->
	<table>
	  <tr>
		<th> </th>
		<th>Fietsen</th>
		<th>Wandelen</th>
		<th>Rijden</th>
		<th>Bus</th>
	  </tr>
	  <tr>
		<td><b>Afstand:</b></td>
		<td><span><?php echo ((int)$data->rows[0]->elements[0]->distance->value / 1000).' Km'; ?></span></td>
		<td><span><?php echo ((int)$data1->rows[0]->elements[0]->distance->value / 1000).' Km'; ?></span></td>
		<td><span><?php echo ((int)$data2->rows[0]->elements[0]->distance->value / 1000).' Km'; ?></span></td>
		<td><span><?php echo ((int)$data3->rows[0]->elements[0]->distance->value / 1000).' Km'; ?></span></td>
	  </tr>
	  <tr>
		<td><b>Reisduur:</b></td>
		<td><span><?php echo $data->rows[0]->elements[0]->duration->text; ?></span></td>
		<td><span><?php echo $data1->rows[0]->elements[0]->duration->text; ?></span></td>
		<td><span><?php echo $data2->rows[0]->elements[0]->duration->text; ?></span></td>
		<td><span><?php echo $data3->rows[0]->elements[0]->duration->text; ?></span></td>
	  </tr>
	  <tr>
		<td><b>CO² uitstoot:</b></td>
		<td><span><?php echo "0 gram CO²"; ?></span></td>
		<td><span><?php echo "0 gram CO²"; ?></span></td>
		<td><span><?php echo ((int)$data2->rows[0]->elements[0]->distance->value / 1000)*115 ." gram CO²"; ?></span></td>
		<td><span><?php echo ((int)$data3->rows[0]->elements[0]->distance->value / 1000)*75 ." gram CO²"; ?></span></td>
	  </tr>
	  <tr>
		<td><b>Aantal bomen nodig:</b></td>
		<td> </td>
		<td> </td>
		<td><span><?php echo round(((int)$data2->rows[0]->elements[0]->distance->value / 1000)*2) ." bomen"; ?></span></td>
		<td><span><?php echo round(((int)$data3->rows[0]->elements[0]->distance->value / 1000)*1.25) ." bomen"; ?></span></td>
	  <tr>
		<td><b>Weergeven:</b></td>
		<td> </td>
		<td> </td>
		<td> <input type="submit" name="verzenden1" id="button" value="Weergeven"/></td>
		<td> <input type="submit" name="verzenden2" id="button" value="Weergeven"/></td>
	  </tr>
	</table>
  <?php
  if(isset($_POST['verzenden1']))
  {
	  $boom = round(((int)$data2->rows[0]->elements[0]->distance->value / 1000)*2);
	  $i = 1;
		while ($i <= $boom) {
					$i++; 
					echo"<img src='images/boom.jpg' alt='boom' style='width:10%;height:10%';>";
		}
  }
  if(isset($_POST['verzenden2']))
  {
	  $boom = round(((int)$data2->rows[0]->elements[0]->distance->value / 1000)*1.25);
	  $i = 1;
		while ($i <= $boom) {
					$i++; 
					echo"<img src='images/boom.jpg' alt='boom' style='width:10%;height:10%';>";
		}
  }
  
  ?>
  
  

<?php } }?>

<?php
$trans = $_POST['transport'];
/*-----------Bus-----------*/
if ($trans == 'transit')
{
$org=$_POST['org'];
$des=$_POST['des'];
if(isset($_POST['org']) && isset($_POST['des']))
{

	echo "<iframe width='100%'
	height='550'
	frameborder='0'
	src='https://www.google.com/maps/embed/v1/directions?key=AIzaSyCWEo4W_7VHj6G55wNmGNOAK5YP9acEkA0&origin=$org&destination=$des&mode=$trans' allowfullscreen>
	</iframe></br>";
	$origin = $_POST['org']; $destination = $_POST['des'];
            $api = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=$origin&destinations=$destination&mode=$trans&key=AIzaSyCWEo4W_7VHj6G55wNmGNOAK5YP9acEkA0");
            $data = json_decode($api);
			
			/*-----------Bus VS Wandelen-----------*/
			$origin1 = $_POST['org']; $destination = $_POST['des'];
            $api1 = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=$origin&destinations=$destination&mode=walking&key=AIzaSyCWEo4W_7VHj6G55wNmGNOAK5YP9acEkA0");
            $data1 = json_decode($api1);
			/*-----------Bus VS fietsen-----------*/
			$origin2 = $_POST['org']; $destination = $_POST['des'];
            $api2 = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=$origin&destinations=$destination&mode=bicycling&key=AIzaSyCWEo4W_7VHj6G55wNmGNOAK5YP9acEkA0");
            $data2 = json_decode($api2);
			/*-----------bus VS rijden-----------*/
			$origin3 = $_POST['org']; $destination = $_POST['des'];
            $api3 = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=$origin&destinations=$destination&mode=driving&key=AIzaSyCWEo4W_7VHj6G55wNmGNOAK5YP9acEkA0");
            $data3 = json_decode($api3);

?>
<!--tabel-->
	<table>
	  <tr>
		<th> </th>
		<th>bus</th>
		<th>Wandelen</th>
		<th>Fietsen</th>
		<th>Rijden</th>
	  </tr>
	  <tr>
		<td><b>Afstand:</b></td>
		<td><span><?php echo ((int)$data->rows[0]->elements[0]->distance->value / 1000).' Km'; ?></span></td>
		<td><span><?php echo ((int)$data1->rows[0]->elements[0]->distance->value / 1000).' Km'; ?></span></td>
		<td><span><?php echo ((int)$data2->rows[0]->elements[0]->distance->value / 1000).' Km'; ?></span></td>
		<td><span><?php echo ((int)$data3->rows[0]->elements[0]->distance->value / 1000).' Km'; ?></span></td>
	  </tr>
	  <tr>
		<td><b>Reisduur:</b></td>
		<td><span><?php echo $data->rows[0]->elements[0]->duration->text; ?></span></td>
		<td><span><?php echo $data1->rows[0]->elements[0]->duration->text; ?></span></td>
		<td><span><?php echo $data2->rows[0]->elements[0]->duration->text; ?></span></td>
		<td><span><?php echo $data3->rows[0]->elements[0]->duration->text; ?></span></td>
	  </tr>
	  <tr>
		<td><b>CO² uitstoot:</b></td>
		<td><span><?php echo ((int)$data3->rows[0]->elements[0]->distance->value / 1000)*75 ." gram CO²"; ?></span></td>
		<td><span><?php echo "0 gram CO²"; ?></span></td>
		<td><span><?php echo "0 gram CO²"; ?></span></td>
		<td><span><?php echo ((int)$data3->rows[0]->elements[0]->distance->value / 1000)*115 ." gram CO²"; ?></span></td>
	  </tr>
	  <tr>
		<td><b>Aantal bomen nodig:</b></td>
		<td><span><?php echo round(((int)$data3->rows[0]->elements[0]->distance->value / 1000)*1.25) ." bomen"; ?></span></td>
		<td> </td>
		<td> </td>
		<td><span><?php echo round(((int)$data3->rows[0]->elements[0]->distance->value / 1000)*2) ." bomen "; ?></span></td>
	  <tr>
		<td><b>Weergeven:</b></td>
		<td><input type="submit" name="verzenden2" id="button" value="Weergeven"/> </td>
		<td> </td>
		<td> </td>
		<td><input type="submit" name="verzenden1" id="button" value="Weergeven"/> </td>
	  </tr>
	</table>
  <?php
  if(isset($_POST['verzenden1']))
  {
	  $boom = round(((int)$data2->rows[0]->elements[0]->distance->value / 1000)*2);
	  $i = 1;
		while ($i <= $boom) {
					$i++; 
					echo"<img src='images/boom.jpg' alt='boom' style='width:10%;height:10%';>";
		}
  }
  if(isset($_POST['verzenden2']))
  {
	  $boom = round(((int)$data2->rows[0]->elements[0]->distance->value / 1000)*1.25);
	  $i = 1;
		while ($i <= $boom) {
					$i++; 
					echo"<img src='images/boom.jpg' alt='boom' style='width:10%;height:10%';>";
		}
  }
  
  ?>
  
  

<?php } }?>

					
				</div>
			</section>
		<!-- Footer -->
			<footer id="footer">
				<div class="inner">
					<div class="content">
						<section>
							<h3>Accumsan montes viverra</h3>
							<p>Nunc lacinia ante nunc ac lobortis. Interdum adipiscing gravida odio porttitor sem non mi integer non faucibus ornare mi ut ante amet placerat aliquet. Volutpat eu sed ante lacinia sapien lorem accumsan varius montes viverra nibh in adipiscing. Lorem ipsum dolor vestibulum ante ipsum primis in faucibus vestibulum. Blandit adipiscing eu felis iaculis volutpat ac adipiscing sed feugiat eu faucibus. Integer ac sed amet praesent. Nunc lacinia ante nunc ac gravida.</p>
						</section>
						<section>
							<h4>Sem turpis amet semper</h4>
							<ul class="alt">
								<li><a href="#">Dolor pulvinar sed etiam.</a></li>
								<li><a href="#">Etiam vel lorem sed amet.</a></li>
								<li><a href="#">Felis enim feugiat viverra.</a></li>
								<li><a href="#">Dolor pulvinar magna etiam.</a></li>
							</ul>
						</section>
						<section>
							<h4>Magna sed ipsum</h4>
							<ul class="plain">
								<li><a href="#"><i class="icon fa-twitter">&nbsp;</i>Twitter</a></li>
								<li><a href="#"><i class="icon fa-facebook">&nbsp;</i>Facebook</a></li>
								<li><a href="#"><i class="icon fa-instagram">&nbsp;</i>Instagram</a></li>
								<li><a href="#"><i class="icon fa-github">&nbsp;</i>Github</a></li>
							</ul>
						</section>
					</div>
					<div class="copyright">
						&copy; Untitled. Photos <a href="https://unsplash.co">Unsplash</a>, Video <a href="https://coverr.co">Coverr</a>.
					</div>
				</div>
			</footer>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>