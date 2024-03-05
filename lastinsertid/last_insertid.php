<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <form method="POST" action="">
    username:
    <input placeholder="username" type="text" name="username">
    email:
    <input placeholder="email" type="text" name="email">
    password:
    <input id="pass" placeholder="password" type="password" name="password">
    <br><br>
    <input type="submit">
  </form>

  <?php
  if (
    !empty($_POST["username"])
    && !empty($_POST["email"]) &&
    !empty($_POST["password"])
  ) {
    $database = "mydata";
    $table = "users";
    $host = "localhost";
    $usrname = "root";
    $passcode = "";

    $username = $_POST["username"];
    $password = $_POST["password"];
    if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
      $email = $_POST["email"];
      try {
        $connect = new PDO("mysql:host=$host;dbname=$database", $usrname, $passcode);
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connect->exec("INSERT INTO $table (username, email, password)
        VALUES ('$username','$email','$password')");
        $last_id = $connect->lastInsertId();
        echo "insertion successful! last id is . $last_id";
      } catch (Exception $e) {
        echo "insertion failed!: " . $e->getMessage();
      }
    } else {
      echo "please enter a valid email";
    }
  } else {
    echo "don't leave empty inputs";
  }
  ?>
</body>

</html>