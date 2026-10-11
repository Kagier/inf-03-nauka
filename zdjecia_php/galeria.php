<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeria</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>

    <header>
        <h1>Zdjęcia</h1>
    </header>

<main>  
    
<form action="" method="POST">
       jebac nefka skurwysyna <input type="text" name="cos">

       <input type="submit" value="tak">
</form>


<?php 

    $coscojest = $_POST['cos'];
    echo $coscojest;


?>
    <section class="lewy">
        <ol>
            <li>Zwierzęta</li>
            <li>Krajobrazy</li>
            <li>Miasta</li>
            <li>Przyroda</li>
            <li>Samochody</li>
        </ol>
    </section>
    <section class="srodek">
        <?php 
        $db = mysqli_connect("localhost", "root", "", "galeria");

        $query1 = "SELECT zdjecia.plik, zdjecia.tytul, zdjecia.polubienia, autorzy.imie, autorzy.nazwisko FROM zdjecia JOIN autorzy ON autorzy_id = autorzy.id ORDER BY autorzy.nazwisko ASC;";

        $wynik1 = mysqli_query($db, $query1);

        while ($row = mysqli_fetch_array($wynik1)) {
            echo "<div class='blok'>";
            echo "<img src='$row[0]' alt='zdjęcie'>";
            echo "<h3>'$row[1]'</h3>";

                if ('$row[2]' > 40) {
                    echo "<p>Autor: $row[3] $row[4].</br>Wiele osób polubiło ten obraz.</p>";
                } else {
                    echo "<p>Autor: $row[3] $row[4].</p>";
                }

                echo "<a href='$row[0]' download>Pobierz</a>";

            echo "</div>";
        }
        ?>
    </section>
    <section class="prawy">
        <h2>Najbardziej lubiane</h2>
        <?php 
            $query2 = "SELECT tytul, plik FROM zdjecia WHERE polubienia >= 100;";
            $wynik2 = mysqli_query($db, $query2);
            while ($row = mysqli_fetch_array($wynik2)) {
                echo "<img src='$row[1]' alt='$row[0]'>";
            }
        ?>
         <strong>Zobacz wszystkie nasze 
        zdjęcia</strong>

        
    </section>
</main>

    <footer>
        <h5>Strone wykonal: 12345678901</h5>
    </footer>

    <?php mysqli_close($db); ?>
    
</body>
</html>