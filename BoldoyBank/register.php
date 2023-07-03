<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // Проверка наличия пользователя с таким же именем пользователя или email
    $query = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        echo 'Пользователь с таким именем пользователя или email уже существует.';
    } else {
        // Хеширование пароля
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Вставка нового пользователя в базу данных
        $query = "INSERT INTO users (username, password, email) VALUES ('$username', '$hashedPassword', '$email')";
        if (mysqli_query($conn, $query)) {
            // Получение идентификатора нового пользователя
            $userId = mysqli_insert_id($conn);

            // Создание счета для нового пользователя
            $initialBalance = 0.00;
            $query = "INSERT INTO accounts (user_id, balance) VALUES ($userId, $initialBalance)";
            if (mysqli_query($conn, $query)) {
                echo 'Регистрация прошла успешно.';
            } else {
                echo 'Ошибка при создании счета: ' . mysqli_error($conn);
            }
        } else {
            echo 'Ошибка при регистрации: ' . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Регистрация</title>
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
</head>
<body>
<header>
    <h2>Регистрация</h2>
</header>
<nav>
<ul>
<li><a href="index.php">Главная</a></li>
<li><a href="login.php">Вход</a></li>
</ul>
</nav>
    <form action="register.php" method="POST">
        <input type="text" name="username" placeholder="Имя пользователя" required><br>
        <input type="password" name="password" placeholder="Пароль" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <button type="submit">Зарегистрироваться</button>
    </form>
</body>
</html>
