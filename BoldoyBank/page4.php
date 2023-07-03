<?php
// Старт сессии
// Проверяем, авторизован ли пользователь
session_start();
if (!isset($_SESSION['username'])) {
    // Если пользователь не авторизован, перенаправляем его на страницу входа или выводим сообщение о необходимости авторизации
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<style>
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

        main {
            padding: 20px;
            text-align: center;
        }

        footer {
            background-color: #ccc;
            color: #333;
            padding: 10px;
            text-align: center;
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
        }
        form {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 35px;
        }

        form label,
        form input,
        form select {
        margin-top: 10px;
        }
        
        input[type="submit"] {
        margin-top: 10px;
        padding: 10px 20px;
        background-color: #333;
        color: #fff;
        border: none;
        border-radius: 3px;
        cursor: pointer;
    }

    button[type="submit"] {
        padding: 10px 20px;
        background-color: #333;
        color: #fff;
        border: none;
        border-radius: 3px;
        cursor: pointer;
        margin-top: 10px;
    }

    button[type="submit"]:hover {
        background-color: #555;
    }
    </style>
  <title>Оформление кредитной карты</title>
  <script>
    function updateSliderValue() {
      var slider = document.getElementById("credit_limit_slider");
      var sliderValue = document.getElementById("credit_limit_value");
      sliderValue.textContent = "Кредитный лимит: " + slider.value + " рублей";
    }
  </script>
</head>
<body>
  
  <div class="form-container">
    <header>
    <h1>Оформление кредитной карты</h1>
  </header>
  <nav>
        <ul>
            <li><a href="index.php">Главная</a></li>
            <li><a href="contacts.php">Контакты</a></li>
        </ul>
    </nav>
    <form action="process_credit_card.php" method="post">
      <label for="full_name">ФИО:</label>
      <input type="text" name="full_name" id="full_name" required><br>

      <label for="email">Email:</label>
      <input type="email" name="email" id="email" required><br>

      <label for="phone">Номер телефона:</label>
      <input type="tel" name="phone" id="phone" required><br>

      <label for="address">Адрес:</label>
      <input type="text" name="address" id="address" required><br>

      <div class="slider-container">
        <label for="credit_limit">Кредитный лимит:</label>
        <input type="range" name="credit_limit" id="credit_limit_slider" min="0" max="1000000" step="1000" oninput="updateSliderValue()">
        <div class="slider-value" id="credit_limit_value">Кредитный лимит: 0 рублей</div>
      </div>

      <button type="submit">Оформить кредитную карту</button>
    </form>
  </div>
  <footer>
        <p>&copy; 2023 Банк. Все права защищены.</p>
    </footer>
</body>
</html>
<?php
$hostname = 'localhost';
$username = 'root';
$password = 'root';
$database = 'boldoy_bank';

$conn = mysqli_connect($hostname, $username, $password, $database);

if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}
?>