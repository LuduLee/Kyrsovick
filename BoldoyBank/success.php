<!DOCTYPE html>
<html>
<head>
    <title>Успешный перевод - Банк</title>
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

        /* Стиль кнопки */
        .back-button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        /* Выравнивание текста кнопки по центру */
        .back-button {
            display: block;
            margin: 0 auto;
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
    <nav>
        <!-- Навигационное меню -->
    </nav>

    <section class="content" style="text-align: center;">
        <h2>Успешный перевод</h2>
        <p>Перевод средств выполнен успешно.</p>
        <p>Средства были успешно переведены получателю.</p>
        <p>Спасибо, что используете наш банк!</p>

        <button class="back-button" onclick="goBack()">Назад</button>

        <script>
            function goBack() {
                window.history.back();
            }
        </script>
    </section>
    <footer>
        <p>&copy; 2023 Банк. Все права защищены.</p>
    </footer>
</body>
</html>
