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

    <?php
    if (array_key_exists('Strona_główna', $_POST)) {
        header("Location: index.php");
    }
    ?>



</body>

</html>