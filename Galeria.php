<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="pl" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Grot.pl</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style/style.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="css/fontello.css" />
<link href='https://fonts.googleapis.com/css?family=Josefin+Sans&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<link rel="stylesheet" type="text/css" href="css/jquery.lightbox-0.5.css" media="screen" />
<script type="text/javascript" src="scripts/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="scripts/jquery.lightbox-0.5.min.js"></script>
<script type="text/javascript" src="przewijanie/jquery.localscroll.js"></script>
<script type="text/javascript" src="przewijanie/jquery.scrollTo.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="js/bootstrap.min.js"></script>


</head>

<body>

<div id="menu">
			<div class="option"><a href="index.php">Aktualności</a></div>
			<div class="option"><a href="kadra.php">Kadra</a></div>
			<div class="option"><a href="tabela.php">Tabela</a></div>
			<div class="option"><a href="galeria.php">Galeria</a></div>
			<div class="option"><a href="sztab.php">Sztab</a></div>
			<div style="clear:both;"></div>
		</div>
        



        
        <div id= "tekst">


       <?php
include('config.php');
$mysqli = db();
$select_category = "SELECT * FROM category order by id";
if ($result = $mysqli->query($select_category)) {
    while ($r = $result->fetch_assoc()) {
        $categories[] = $r;
    }
}

?>


<form action="uploadPhoto.php" method="post" enctype="multipart/form-data">
    <select name="categoryPhoto" class="selectpicker">
    <?php foreach($categories as $c){
        $selected = "";
        if($c['id'] == $_GET['category']){
            $selected = "selected";
        }
        echo '<option '.$selected.' value="' . $c['id'] . '">' . $c['name'] . '</option>';
    }?>
</select>
    
    
    
    Select image to upload:
    <input type="file" name="fileToUploadPhoto" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>



<div class="galeria">
<a href="gallery" id="href">Gallery</a>
</div>





 <div id="up">
<a href="#Up1"><i class="icon-up-open-2"></i></a> 
</div>
</div>
</div> 
<div id="stopka">
<div id="zdj">
Główne organizacje sportowe:
<marquee><img src="uefa1.png"/>
<img src="fifa1.png"/>
<img src="pzpn1.jpg"/></marquee>    
</div>


		

</body>

   

</html>