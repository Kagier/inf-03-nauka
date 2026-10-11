<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zdrowy bazarek</title>
    <link rel="stylesheet" href="styl.css">
</head>
<body>

<header>
    <h1>Zdrowy bazarek</h1>
</header>

<nav>
    <?php 
    $db = mysqli_connect("localhost", "root", "", "bazar");

    $query1 = "SELECT nazwa, plik from towar LIMIT 10;";
    $wynik1 = mysqli_query($db, $query1);

    while ($row1 = mysqli_fetch_array($wynik1)) {
        echo "<img src='{$row1['1']}' alt='{$row1[0]}'>";
    }
    ?>
</nav>

<main>
    <aside>
        <img src="market.png" alt="bazarek">
    </aside>

    <section>
        <p>Wybierz owoc lub warzywo i podaj jego wagę:</p>

        <form action="" method="POST">
            <select name="lista">

                <?php 
                $query2 = "SELECT id, nazwa FROM towar;";
                $wynik2 = mysqli_query($db, $query2);

                while ($row2 = mysqli_fetch_array($wynik2)) {
                    echo "<option value='{$row2['0']}'>{$row2['1']}</option>";
                }
                
                ?>
            </select>

            <input type="number" name="waga" step="1">

            <input type="submit" value="Zamów" name="przycisk">
        </form>

        <?php 
            if(isset($_POST['przycisk'])) {
                $waga = $_POST['waga'];
                $lista = $_POST['lista'];

                $query3 = "SELECT rodzaj, nazwa, cena FROM towar WHERE id = $lista;";

                $wynik3 = mysqli_query($db, $query3);

                $row3 = mysqli_fetch_array($wynik3);

                $cena = $row3['2'];

                $wartosc1 = $cena * $waga; 

                echo "<p>{$row3['0']} {$row3['1']} wartość: {$wartosc1}</p>";

                $query4 = "INSERT INTO zamowienie VALUES (NULL, $lista, 2, $waga);";

                $dodaj = mysqli_query($db, $query4);
            }
        ?>
    </section>
</main>

<footer>
    <p>Stronę opracował: 12345678901</p>
</footer>

<?php mysqli_close($db); ?>

    
</body>
</html>