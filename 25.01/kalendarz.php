<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <title>Kalendarz PHP</title>
    <link rel="stylesheet" href="./styl5.css">
</head>

<body>
    <?php
    $conn = new mysqli(
        hostname: '127.0.0.1',
        username: 'root',
        password: '',
        database: 'egzamin5',
        port: 3306
    );
    ?>
    <header>
        <section class="heading">
            <img src="./logo1.png" alt="Mój kalendarz">
        </section>
    </header>
    <section class="cal_body">
        <h2>Kalendarz zadan</h2>
        <?php
        if ($conn) {
            $query1 = "SELECT miesiac, rok FROM zadania WHERE dataZadania  = '2020-07-01'";
            $result1 = mysqli_query($conn, $query1);
            while ($row = mysqli_fetch_array($result1)) {
                echo "<h3>miesiąc: $row[0], rok: $row[1]</h3>";
            }
            mysqli_free_result($result1);
        } else {
            echo "Błąd połączenia z bazą danych.";
        }
        ?>
    </section>
    <section>
        <?php
        if ($conn) {
            $query2 = "SELECT dataZadania, wpis FROM zadania WHERE miesiac = 'lipiec'";
            $result2 = mysqli_query($conn, $query2);

            $counter = 1;
            while ($row = mysqli_fetch_array($result2)) {
                if ($counter == 1) {
                    echo "<div class = 'line'>";
                }
                echo "<div class='month'>
                        <h5>$row[0]</h5>
                        <p>$row[1]</p>
                    </div>";
                if ($counter == 7) {
                    echo "</div>";
                    $counter = 0;
                }
                $counter = $counter + 1;
            }
            mysqli_free_result($result2);
        }
        ?>
    </section>
    <section>
        <?php
        if ($conn) {
            $query3 = "SELECT DISTINCT miesiac FROM zadania WHERE miesiac = 'l%'";
            $result3 = mysqli_query($conn, $query3);
            while ($row = mysqli_fetch_array($result3)) {
                echo "<div class='month'>
                        <h5>$row[0]</h5>
                        <p>$row[1]</p>
                    </div>";
            }
            mysqli_free_result($result3);
        }
        ?>
    </section>
    <footer>
        <form action="./kalendarz.php" method="POST">
            <label>dodaj wpis:
                <input name="entry">
            </label>
            <button name="send">dodaj</button>
        </form>
        <?php
        if ($conn && isset($_POST['send'])) {
            $record = mysqli_real_escape_string($conn, $_POST['entry']);
            $query4 = "UPDATE zadania SET wpis = '$record' WHERE dataZadania = '2020-07-13'";
            mysqli_query($conn, $query4);
        }
        if ($conn) {
            mysqli_close($conn);
        }
        ?>
        <p>Jaro Sobon</p>
    </footer>
</body>

</html>