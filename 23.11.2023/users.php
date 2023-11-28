<?php
    $db = new mysqli(
        hostname: "localhost",
        username: "root",
        password: "",
        database: "dane4",
        port: 3306
    );
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./styl4.css">
    <title>Panel Administratora</title>
</head>
<body>
    <header>
        <h3>Portal Społecznościowy - panel administratora</h3>
    </header>
    <section id="main">
        <section>
            <h4>Użytkownicy</h4>
            <?php
                $sql = 'SELECT id, imie, nazwisko, rok_urodzenia, zdjecie FROM osoby LIMIT 30';

                $result = $db->query($sql);

                while( $row = $result->fetch_assoc() ){
                    echo $row['id']. ' ' . $row['imie'] . ' '.$row['nazwisko'] . ' '. (date('Y') - $row['rok_urodzenia']). '<br>';
                }
                $result->free_result();
            ?>
            <a href="./settings.html">Inne ustawienia</a><br>
        </section>
        <section>
            <h4>Podaj id użytkownika</h4>
            <form method="post">
                <input type="number">
                <button type="submit">ZOBACZ</button>
            </form>
            <hr>
            <?php
            if (isset($_POST['user_id'])){
                $id = $_POST['user_id'];

                $sql = 'SELECT imie, nazwisko, rok_urodzenia, opis, zdjecie FROM osoby WHERE id = ' . $id;

                $result = $db->query($sql);

                $row = $result->fetch_assoc();

                echo "<h2>$id. {$row['imie']} {$row['nazwisko']}</h2>";
                
                echo "<img src='./{$row['zdjecie']}' alt=$id'/>";

                echo "<p> Rok urodzenia: {$row"
            }
            ?>
        </section>
    </section>
    <footer>
        Stronę wykonał: 00000000
    </footer>
</body>
</html>
<?php
    $db->close();
?>