<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Strona główna</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link href="./styles.css" rel="stylesheet" />
</head>


<body>
    <?php
    session_start();

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "forum";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if (!isset($_SESSION['id_user'])) {
        header("Location: login.php");
    }
    if (array_key_exists('wyloguj', $_POST)) {
        unset($_SESSION["id_user"]);
        unset($_SESSION["accont_type"]);
        unset($_SESSION["login"]);
        header("Location: login.php");
    }
    if (array_key_exists('Dodaj_post', $_POST)) {
        header("Location: add_post.php");
    }

    ?>
    <nav class="navbar">
        <div class="navbar-overlay"></div>
        <h1 class="navbar-title">Strona główna</h1>
        <form method="post">
            <nav class="navbar-menu">
                <input type="submit" name="Strona_główna" value="Strona główna" class="active"></input>
                <?php
                if ($_SESSION['accont_type'] == 2) {
                    echo '<input type="submit" name="Dodaj_post" value="Dodaj Post"></input>';
                }
                ?>
                <input type="submit" name="wyloguj" value="wyloguj"></input>
            </nav>
        </form>
    </nav>
    
    <section class="main">
        <?php
        $result = mysqli_query($conn, "SELECT `id_post`, `tytul`, `tresc`, `autor` FROM `posty`");
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="post"><h1 class="tytul_posta">';
            echo $row['tytul'];
            echo '</h1><p class="tresc_posta">';
            echo $row['tresc'];
            echo '</p><form action="post.php" method="get">
            <input type="hidden" value="';
            echo $row['id_post'];
            echo '" name="id_post"></input><input type="submit" value="Czytaj dalej"></input></form></div>';
        }
        ?>
    </section>
</body>

</html>