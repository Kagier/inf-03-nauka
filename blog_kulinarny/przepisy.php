<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog kulinarny</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>

<aside>
    <a href="przepisy.php?id=1">Sernik</a>
    <a href="przepisy.php?id=2">Sałatka</a>
    <a href="przepisy.php?id=3">Pankejki</a>
    <a href="przepisy.php?id=4">Nugetsy</a>
    <a href="przepisy.php?id=5">Łosoś</a>
    <a href="przepisy.php?id=6">Kociołek</a>
    <a href="przepisy.php?id=7">Jagnięcina</a>
    <a href="przepisy.php?id=8">Hamburgery</a>
    <a href="przepisy.php?id=9">Eklerki</a>
    <a href="przepisy.php?id=10">Churros</a>

    <p>Autor: 12345678901</p>
</aside>

<main>

    <?php 
    $id = 7;
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        };

    $db = mysqli_connect("localhost", "root", "", "przepisy");

    $query1 = "SELECT potrawy.nazwa, rodzaje.rodzaj FROM potrawy JOIN rodzaje ON potrawy.idRodzaje = rodzaje.idRodzaje WHERE potrawy.idPotrawy = $id;";
    $wynik1 = mysqli_query($db, $query1);

    $row1 = mysqli_fetch_array($wynik1);

    echo "<h2>{$row1['1']}</h2>";


    $query2 = "SELECT nazwa, trudnosc, kalorie FROM potrawy WHERE idPotrawy = $id;";
    $wynik2 = mysqli_query($db, $query2);

    $row2 = mysqli_fetch_array($wynik2);

    echo "<h2> {$row2['0']}</h2>";

    if ($row2['1'] == 1) {
        $poziom = 'łatwe';
    } elseif ($row2['1'] == 2)  {
        $poziom = 'Srednie';
    } else {
        $poziom = 'Trudne';
    }

    echo "<p>Trudnosc: $poziom, kalorie {$row2['2']}</p> ";
    ?>
    <img src="separator.png" alt="przepis">

    <p> Alergeny:
    
    <?php 

       $query3 = "SELECT potrawy.nazwa, alergeny.alergen FROM potrawy JOIN lista_alergenow ON potrawy.idPotrawy = lista_alergenow.idPotrawy JOIN alergeny ON lista_alergenow.idAlergeny = alergeny.idAlergeny WHERE potrawy.idPotrawy = $id;"; 

       $wynik3 = mysqli_query($db, $query3);

       while($row3 = mysqli_fetch_array($wynik3)) {
        echo "{$row3['1']} ";
       }
    ?>
    </p>


    <h2>Składniki</h2>
    <ul>
        <li>Lorem 1 kg</li>
        <li>Ipsum 2 szt.</li>
        <li>Dolor 200 g</li>
        <li>Sit amet (szczypta)</li>
    </ul>

    <?php
        $query4 = "SELECT przepis, plik FROM potrawy WHERE idPotrawy = $id;";
        $wynik4 = mysqli_query($db, $query4);
        $row4 = mysqli_fetch_array($wynik4);
        ?>

        <p><?php echo $row4['0']; ?></p>
</main>

    <section style="background-image: url('<?= $row4['1'] ?>')">
        <h1>Blog kulinarny</h1>
    </section>

<?php mysqli_close($db); ?>


</body>
</html>