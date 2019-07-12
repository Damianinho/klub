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
        

        <div id="tlo">
        <div id= "tekst">

        
<div id="Zawodnicy"></a>
    <div id="nag">Zawodnicy w piłce nożnej</div>
Bramkarz jako jedyny zawodnik na boisku może łapać piłkę rękami w wyznaczonym polu karnym. Jego rola nie ogranicza się jednak tylko do łapania piłki. Bramkarz jest pełnoprawnym zawodnikiem, który częściej atakuje czyli wprowadza piłkę do gry różnymi sposobami aniżeli broni. 
</br></p>Obrońca – w piłce nożnej zawodnik, który ma za zadanie zapobiegać atakom napastników przeciwnika na bramkę. W dzisiejszym futbolu zadania obrońców wychodzą znacznie poza zwykłe bronienie własnego pola karnego.</br>
</p>Pomocnik (ang. midfielder) – zawodnik w piłce nożnej, który gra w środku pola między atakującymi napastnikami a broniącymi obrońcami. Rozróżnia się pomocników: defensywnych, środkowych, ofensywnych, bocznych oraz cofniętych skrzydłowych.</br>
</p>Napastnik – zawodnik w piłce nożnej, który gra na pozycji najbliższej do przeciwnej bramki i dlatego w drużynie głównie to on jest odpowiedzialny za zdobywanie bramek.<a id="Rozgrywki"></a></p>

      <?php
         if(isset($_POST['add'])) {
            $dbhost = 'localhost';
            $dbuser = 'root';
            $dbpass = '';
            $db = 'pilkarze';
            $conn = new mysqli($dbhost, $dbuser, $dbpass, $db);

   
            
            if(! $conn ) {
               die('Could not connect: ' . mysqli_error());
            }
            
            if(! get_magic_quotes_gpc() ) {
               $imie_nazwisko = addslashes ($_POST['imie_nazwisko']);
               $wiek = addslashes ($_POST['wiek']);
               $narodowosc = addslashes ($_POST['narodowosc']);
               $pozycja = addslashes ($_POST['pozycja']);
               $klub = addslashes ($_POST['klub']);
               $mecze = addslashes ($_POST['mecze']);
               $bramki = addslashes ($_POST['bramki']);
            }else {
               $imie_nazwisko = $_POST['imie_nazwisko'];
               $wiek = $_POST['wiek'];
               $narodowosc = $_POST['narodowosc'];
               $pozycja = $_POST['pozycja'];
               $klub = $_POST['klub'];
               $mecze = $_POST['mecze'];
               $bramki = $_POST['bramki'];
            }
            
            //$emp_salary = $_POST['emp_salary'];
            
            $sql = "INSERT INTO players ". "(imie_nazwisko,wiek,narodowosc,pozycja,klub,mecze,bramki) ". "VALUES('$imie_nazwisko','$wiek','$narodowosc','$pozycja','$klub','$mecze','$bramki')";
               
            mysqli_select_db($conn, 'pilkarze');
            $retval = mysqli_query( $conn,$sql );
            
            if(! $retval ) {
               die('Could not enter data: ' . mysqli_error());
            }
            
            mysqli_close($conn);
         }else {
            ?>

<form method = "post" action = "<?php $_PHP_SELF ?>">
    <input type="text" name="imie_nazwisko" size="9" placeholder="Imię i nazwisko" />
    <input type="text" name="wiek" size="9" placeholder="Wiek" />
    <input type="text" name="narodowosc" size="9" placeholder="Narodowość" />
    <input type="text" name="pozycja" size="9" placeholder="Pozycja" />
    <input type="text" name="klub" size="9" placeholder="Klub" />
    <input type="text" name="mecze" size="9" placeholder="Mecze" />
    <input type="text" name="bramki" size="9" placeholder="Bramki" />
                               <input name = "add" type = "submit" id = "add" 
                              value = "Dodaj"></p>
</form>
    <form method="GET">
    <?php
    mysqli_connect("localhost", "root", "", "pilkarze");
    /*
        localhost - it's location of the mysql server, usually localhost
        root - your username
        third is your password
         
        if connection fails it will stop loading the page and display an error
    */
     
    

error_reporting(0);
    $query = $_GET['query']; 
    // gets value sent over search form
     
    $min_length = 3;
    // you can set minimum length of the query if you want
     
    if(strlen($query) >= $min_length){ // if query length is more or equal minimum length then
         
        $query = htmlspecialchars($query); 
        // changes characters used in html to their equivalents, for example: < to &gt;
         
        $query = mysqli_real_escape_string($query);
        // makes sure nobody uses SQL injection
         
        $raw_results = mysqli_query("SELECT * FROM players
            WHERE (`imie_nazwisko` LIKE '%".$query."%') OR (`klub` LIKE '%".$query."%' ) ") or die(mysqli_error());
             
        // * means that it selects all fields, you can also write: `id`, `title`, `text`
        // articles is the name of our table
         
        // '%$query%' is what we're looking for, % means anything, for example if $query is Hello
        // it will match "hello", "Hello man", "gogohello", if you want exact match use `title`='$query'
        // or if you want to match just full word so "gogohello" is out use '% $query %' ...OR ... '$query %' ... OR ... '% $query'
         
        if(mysqli_num_rows($raw_results) > 0){ // if one or more rows are returned do following
             
            while($results = mysqli_fetch_array($raw_results)){
            // $results = mysqli_fetch_array($raw_results) puts data from database into array, while it's valid it does the loop
             
                echo "<p><h4>".$results['imie_nazwisko']."</h4>".$results['klub']."</p>";
                // posts results gotten from database(title and text) you can also show id ($results['id'])
            }
             
        }
        else{ // if there is no matching rows do following
            echo "Brak wyników";
        }
         
    }
    else{ // if query length is less than minimum
        echo "";
        ?>

        <input type="text" placeholder="Imię/Nazwisko piłkarza" name="query" />
        <input type="submit" value="Wyszukaj piłkarzy" />
    </form>
    <?php   }
?>
       <?php
         }
      ?>

</form>
<div id="table-wrapper">
  <div id="table-scroll">
      <form action="...">
          <?php
$con=mysqli_connect("localhost","root","","pilkarze");
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($con,"SELECT * FROM players");
  echo  "<table>
                <tr>
                <th><span>Lp</span></th>
                <th><span>Imię i Nazwisko</span></th>
                <th><span>Wiek</span></th>
                <th><span>Narodowość</span></th>
                <th><span>Pozycja</span></th>
                <th><span>Klub</span></th>
                <th><span>Mecze</span></th>
                <th><span>Bramki</span></th>
            </tr>";
            while($row = mysqli_fetch_array($result))
{  
echo "<tr>";
echo "<td>" . $row['id'] . "</td>";
echo "<td>" . $row['imie_nazwisko'] . "</td>";
echo "<td>" . $row['wiek'] . "</td>";
echo "<td>" . $row['narodowosc'] . "</td>";
echo "<td>" . $row['pozycja'] . "</td>";
echo "<td>" . $row['klub'] . "</td>";
echo "<td>" . $row['mecze'] . "</td>";
echo "<td>" . $row['bramki'] . "</td>";
echo "</tr>";
}
echo "</table>";
mysqli_close($con);
?>
    </form>
  </div>
</div>
   
</div>
        
        </div>

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