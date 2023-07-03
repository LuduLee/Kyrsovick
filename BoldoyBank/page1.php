<?php
    session_start();
    // Проверяем, авторизован ли пользователь
    if (!isset($_SESSION['username'])) {
        // Если пользователь не авторизован, перенаправляем его на страницу входа или выводим сообщение о необходимости авторизации
        header("Location: login.php");
        exit();
    }
    // Подключение к базе данных
    $hostname = 'localhost';
    $username = 'root';
    $password = 'root';
    $database = 'boldoy_bank';

    $conn = mysqli_connect($host, $username, $password, $database);
    if (!$conn) {
        die('Ошибка подключения к базе данных: ' . mysqli_connect_error());
    }

    // Обработка отправки формы
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Получение данных из формы
        $name = $_POST['name'];
        $phone_number = $_POST['phone_number'];
        $payment_system = $_POST['payment_system'];
        $delivery_date = $_POST['delivery_date'];

        // Валидация данных и выполнение запроса к базе данных
        if (!empty($name) && !empty($phone_number) && !empty($payment_system) && !empty($delivery_date)) {
            // Добавление 2 дней к дате доставки карты
            $delivery_date = date('Y-m-d', strtotime($delivery_date . ' + 2 days'));

            $query = "INSERT INTO Cards (name, phone_number, payment_system, delivery_date) VALUES ('$name', '$phone_number', '$payment_system', '$delivery_date')";

            if (mysqli_query($conn, $query)) {
                echo '<p>Карта успешно оформлена!</p>';
            } else {
                echo '<p>Ошибка при оформлении карты: ' . mysqli_error($conn) . '</p>';
            }
        } else {
            echo '<p>Пожалуйста, заполните все поля формы.</p>';
        }
    }
    ?>
<!DOCTYPE html>
<html>
<head>
    <title>Оформление карты</title>
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
    </style>
</head>
<body>
    <header>
    <h1>Оформление карты</h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.php">Главная</a></li>
            <li><a href="contacts.php">Контакты</a></li>
        </ul>
    </nav>



    <form method="POST" action="page1.php">
        <label for="name">Имя на карте:</label>
        <input type="text" name="name" id="name" required><br>

        <label for="phone_number">Номер телефона:</label>
        <input type="text" name="phone_number" id="phone_number" required><br>

        <label for="payment_system">Платежная система:</label>
        <select name="payment_system" id="payment_system" required>
            <option value="">Выберите платежную систему</option>
            <option value="Visa">Visa</option>
            <option value="Mastercard">Mastercard</option>
            <option value="Mir">Мир</option>
        </select><br>

        <label for="delivery_date">Дата доставки:</label>
        <input type="date" name="delivery_date" id="delivery_date" min="<?php echo date('Y-m-d', strtotime('+2 days')); ?>" max="<?php echo date('Y-m-d', strtotime('+3 days')); ?>" required><br>


        <input type="submit" value="Оформить карту">
    </form>

    <?php
    // Закрытие соединения с базой данных
    mysqli_close($conn);
    ?>
        <footer>
        <p>&copy; 2023 Банк. Все права защищены.</p>
    </footer>
</body>
</html>
