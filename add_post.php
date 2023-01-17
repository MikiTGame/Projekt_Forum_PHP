<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Dodawanie postów</title>
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
    if (array_key_exists('Strona_główna', $_POST)) {
        header("Location: index.php");
    }
    if (array_key_exists('wyloguj', $_POST)) {
        unset($_SESSION["id_user"]);
        unset($_SESSION["accont_type"]);
        unset($_SESSION["login"]);
        header("Location: login.php");
    }

    ?>
    <nav class="navbar">
        <div class="navbar-overlay"></div>
        <h1 class="navbar-title">Dodawanie postów</h1>
        <form method="post">
            <nav class="navbar-menu">
                <input type="submit" name="Strona_główna" value="Strona główna"></input>
                <input type="submit" name="wyloguj" value="wyloguj"></input>
            </nav>
        </form>
    </nav>
    <section class="main">
        <form method="post">
            <input id="add_title" type="text" name="tytul" placeholder="Tytuł Posta" />
            <textarea id="add_text" name="tresc" placeholder="Treść Posta" rows="20"> </textarea>
            <input type="submit" value="Dodaj Post">
        </form>
    </section>

    <?php


    if(array_key_exists('tytul',$_POST)){
        $tytul = $_POST['tytul'];
        $tresc = $_POST['tresc'];
        $autor = $_SESSION['id_user'];
        $q = "INSERT INTO `posty`(`tytul`, `tresc`, `autor`) VALUES ('".$tytul."','".$tresc."','".$autor."')";
        $insert = mysqli_query($conn, $q);
        header("Location: add_post.php");
    }
    ?>



</body>

</html>