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
    <title>Оформление сим-карты - Банк</title>
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
        <h1>Оформление сим-карты</h1>
    </header>

    <nav>
        <ul>
            <li><a href="index.php">Главная</a></li>
            <li><a href="contacts.php">Контакты</a></li>
        </ul>
    </nav>

    <section class="content">
        <h2>Заполните форму для оформления сим-карты</h2>

        <form action="process_sim_card.php" method="POST">
            <label for="full-name">ФИО:</label>
            <input type="text" id="full-name" name="full-name" required>

            <label for="phone-number">Номер телефона:</label>
            <input type="text" id="phone-number" name="phone-number" required>

            <label for="plan">Тарифный план:</label>
            <select id="plan" name="plan" required>
                <option value="plan1">Тарифный план 1</option>
                <option value="plan2">Тарифный план 2</option>
                <option value="plan3">Тарифный план 3</option>
            </select>

            <button type="submit">Оформить сим-карту</button>
        </form>
    </section>

    <footer>
        <p>&copy; 2023 Банк. Все права защищены.</p>
    </footer>
</body>
</html>
