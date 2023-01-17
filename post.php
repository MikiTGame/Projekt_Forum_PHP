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

    if (!isset($_SESSION['accont_type'])) {
        header("Location: login.php");
    } elseif ($_SESSION['accont_type'] != 2) {
        header("Location: index.php");
    }
    if (array_key_exists('Strona_główna', $_POST)) {
        header("Location: index.php");
    }

    $q = "SELECT `tytul`, `tresc`, `autor` FROM `posty` where `id_post` =" . $_GET['id_post'];
    $result = mysqli_query($conn, $q);
    while ($row = mysqli_fetch_assoc($result)) {
        $tytul = $row['tytul'];
        $tresc = $row['tresc'];
        $autor_posta = $row['autor'];
    }

    ?>
    <nav class="navbar">
        <div class="navbar-overlay"></div>
        <h1 class="navbar-title">
            <?php echo $tytul ?>
        </h1>
        <form method="post">
            <nav class="navbar-menu">
                <input type="submit" name="Strona_główna" value="Strona główna"></input>
                <input type="submit" name="wyloguj" value="wyloguj"></input>
            </nav>
        </form>
    </nav>

    <section class="main">
        <div class="tresc_posta">
            <?php echo $tresc; ?>
        </div>
    </section>

    <section class="scomm">
        <form method="post">
            <input class="comm_in" type="text" name="komm" placeholder="Treść komentarza" />
            <input type="submit" value="Dodaj komentarza" />

            <?php
            if (array_key_exists('komm', $_POST)) {
                $id = $_GET['id_post'];
                $autor = $_SESSION['id_user'];
                $tresc_k = $_POST['komm'];
                $q = "INSERT INTO `comm`(`tresc_comm`, `id_autora`, `id_posta`) VALUES ('" . $tresc_k . "','" . $id . "','" . $autor . "')";
                $insert = mysqli_query($conn, $q);
                header("Location: post.php?id_post=".$id);
            }
            ?>

        </form>
        <?php
        $q = "SELECT `tresc_comm`, `id_autora`FROM `comm` WHERE `id_posta`=" . $_GET['id_post'] . " ORDER BY `id_posta` DESC";
        $result = mysqli_query($conn, $q);
        while ($row = mysqli_fetch_assoc($result)) {
            $tresc_comm = $row['tresc_comm'];
            $id_autora = $row['id_autora'];
            $q2 = "SELECT `login` FROM `login` WHERE `id_user` = " . $id_autora;
            $result2 = mysqli_query($conn, $q2);
            while ($row2 = mysqli_fetch_assoc($result2)) {
                $nazwa_autora = $row2['login'];
            }
            echo '<div class="comm">
                <h3>' . $nazwa_autora . '</h3>
                <p>' . $tresc_comm . '</p>
                </div>';
        }
        ?>
    </section>


</body>

</html>