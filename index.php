<!DOCTYPE HTML>
<html>
<head>
<title>applicatie</title>
<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>
</head>
<body>
<h1>Voetadruk.online</h1>
<form id="form1" name="form1" method="post" action="index1.php">
beginpunt:
<input type="text" name="org" id="org" value="mechelen" />
eindpunt:
<label for="des"></label>
<input type="text" name="des" id="des" value="antwerpen" />
<select name="transport">
<option value="walking">Te voet</option>
<option value="driving">Auto</option>
<option value="transit">Bus</option>
<option value="bicycling">Fietsen</option>
</select>
<input type="submit" name="verzenden" id="button" value="submit"/>
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

	echo "
	<iframe width='758'
	height='550'
	frameborder='0'
	src='https://www.google.com/maps/embed/v1/directions?key=AIzaSyCWEo4W_7VHj6G55wNmGNOAK5YP9acEkA0&origin=$org&destination=$des&mode=$trans' allowfullscreen>
	</iframe>";
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
	</table>
  
  

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
	<iframe width='758'
	height='550'
	frameborder='0'
	src='https://www.google.com/maps/embed/v1/directions?key=AIzaSyCWEo4W_7VHj6G55wNmGNOAK5YP9acEkA0&origin=$org&destination=$des&mode=$trans' allowfullscreen>
	</iframe>";
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
	</table>
  
  

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

	echo "
	<iframe width='758'
	height='550'
	frameborder='0'
	src='https://www.google.com/maps/embed/v1/directions?key=AIzaSyCWEo4W_7VHj6G55wNmGNOAK5YP9acEkA0&origin=$org&destination=$des&mode=$trans' allowfullscreen>
	</iframe>";
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
	</table>
  
  

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

	echo "
	<iframe width='758'
	height='550'
	frameborder='0'
	src='https://www.google.com/maps/embed/v1/directions?key=AIzaSyCWEo4W_7VHj6G55wNmGNOAK5YP9acEkA0&origin=$org&destination=$des&mode=$trans' allowfullscreen>
	</iframe>";
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
	</table>
  
  

<?php } }?>



</br>
</br>


</body>
</html>