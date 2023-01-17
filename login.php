<!-- index.html -->
<html>

<head>
  <link rel="stylesheet" href="styles_log.css" />
</head>

<body>

  <?php
  session_start();
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "forum";

  $conn = new mysqli($servername, $username, $password, $dbname);

  if (isset($_SESSION['id_user'])) {
    header("Location: index.php");
  }
  ?>

  <div class="login">
    <h2>Login</h2>
    <form class="login-form" action="login.php" method="POST">
      <div class="textbox">
        <input type="text" placeholder="Username" name="login" />
        <span class="material-symbols-outlined">
        </span>
      </div>
      <div class="textbox">
        <input type="password" placeholder="Password" name="password" />
        <span class="material-symbols-outlined">
        </span>
      </div>
      <button type="submit">LOGIN</button>
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $login = $_POST['login'];
      $password = hash('sha1',$_POST['password']);
      $result = mysqli_query($conn, "SELECT `id_user`, `login`, `password`, `accont_type` FROM `login`");
      while ($row = mysqli_fetch_assoc($result)) {
        if ($password == $row['password'] and $login == $row['login']) {
          $_SESSION["id_user"] = $row['id_user'];
          $_SESSION["accont_type"] = $row['accont_type'];
          $_SESSION["login"] = $row['login'];
          header("Location: index.php");
        }
      }
    }
    ?>
  </div>
</body>

</html>