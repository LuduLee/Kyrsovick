<?php
// Подключение к базе данных
$hostname = 'localhost';
$username = 'root';
$password = 'root';
$database = 'boldoy_bank';

$connection = mysqli_connect($host, $username, $password, $db_name);

if (!$connection) {
    die("Ошибка подключения к базе данных: " . mysqli_connect_error());
}

// Проверяем, авторизован ли пользователь
session_start();
if (!isset($_SESSION['username'])) {
    // Если пользователь не авторизован, перенаправляем его на страницу входа или выводим сообщение о необходимости авторизации
    header("Location: login.php");
    exit();
}


// Отправка данных о вкладе в базу данных
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $principal = $_POST['principal'];
    $duration = $_POST['duration'];



    // Сохранение данных в базе данных
    $query = "INSERT INTO investments (principal, duration) VALUES ('$principal', '$duration')";
    if (mysqli_query($connection, $query)) {
        // Данные успешно сохранены
        $_SESSION['success_message'] = "Данные о вкладе успешно сохранены.";
        header("Location: investment_result.php");
        exit;
    } else {
        // Ошибка при сохранении данных
        $_SESSION['error_message'] = "Ошибка при сохранении данных.";
        header("Location: page3.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Инвестиции - Банк</title>
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

    <script>
        // Функция для автоматического расчета
        function calculateInvestment() {
            var amount = parseFloat(document.getElementById("investment-amount").value);
            var percent = parseFloat(document.getElementById("investment-percent").value);
            var income = (amount * percent) / 100;
            
            document.getElementById("investment-income").textContent = income.toFixed(2);
        }
    </script>
</head>
<body>
    <header>
        <h1>Инвестиции</h1>
    </header>

    <nav>
        <ul>
            <li><a href="index.php">Главная</a></li>
            <li><a href="contacts.php">Контакты</a></li>
        </ul>
    </nav>

    <section class="content">
        

        <!-- Форма для расчета инвестиций -->
        <form action="page3.php" method="POST">
            <label for="principal">Сумма вклада:</label>
            <input type="number" id="principal" name="principal" required>
        
            <label for="duration">Срок вклада (в месяцах):</label>
            <input type="number" id="duration" name="duration" required>

            <button type="submit">Рассчитать вклад</button>
        </form>
    </section>

    <footer>
        <p>&copy; 2023 Банк. Все права защищены.</p>
    </footer>
</body>
</html>
