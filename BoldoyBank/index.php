<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Главная</title>
    <style>
        .service-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 200px;
            width: 300px;
            border: 1px solid #ccc;
            margin: 10px;
        }

        .service-row {
            display: flex;
            justify-content: center;
        }
        
body {
  font-family: Arial, sans-serif;
  background-color: #f1f1f1;
  margin: 0;
  padding: 0;
}

header {
  background-color: #333;
  color: #fff;
  padding: 10px;
  text-align: center;
}

nav {
  background-color: #777;
  color: #fff;
  padding: 10px;
}

nav ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
}

nav ul li {
  display: inline;
  margin-right: 10px;
}

nav ul li a {
  color: #fff;
  text-decoration: none;
}

.content {
  padding: 20px;
}

footer {
  background-color: #ccc;
  color: #333;
  padding: 10px;
  text-align: center;
}
    </style>
</head>
<body>
<nav>
<ul>
<li><h1>Boldoy Bank</h1></li>
    </ul>
    </nav>
    <?php
    
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        echo '<p>Привет, ' . $username . '! <a href="logout.php">Выйти</a></p><a href="dashboard.php">Личный кабинет</a>';
    } else {
        echo '<a href="register.php">Регистрация</a>';
        echo '<a href="login.php">Вход</a>';
    }
    ?>
    
    <h3>Услуги банка</h3>

    <!DOCTYPE html>
<html>
<head>
    <title>Главная страница</title>
    <style>
        table {
            margin: 0 auto;
        }

        td {
            text-align: center;
            padding: 10px;
        }

    </style>
</head>
<body>
    <table>
        <tr>
            <td>
                <a href="page1.php"><img src="images/photo1.jpg" alt="Photo 1"></a>
            </td>
            </td>
            
            <td>
            <td>
                <a href="page2.php"><img src="images/photo2.jpg" alt="Photo 2"></a>
            </td>
        </tr>
        <tr>
            <td>
                <a href="page3.php"><img src="images/photo3.jpg" alt="Photo 3"></a>
            </td>
            <td>
                <a href="page4.php"><img src="images/photo4.jpg" alt="Photo 4"></a>
            </td>
            <td>
                <a href="page5.php"><img src="images/photo5.jpg" alt="Photo 5"></a>
            </td>
        </tr>
    </table>
</body>
<footer>
        &copy; 2023 Boldoy Банк. Все права защищены.
    </footer>
</body>
</html>
