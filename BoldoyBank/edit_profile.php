<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$hostname = 'localhost';
$username = 'root';
$password = 'root';
$database = 'boldoy_bank';

$conn = mysqli_connect($hostname, $username, $password, $database);

if (!$conn) {
    die("Ошибка соединения: " . mysqli_connect_error());
}

$username = $_SESSION['username'];

// Получение информации о текущем пользователе
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $userId = $row['user_id'];
    $fullName = $row['full_name'];
    $email = $row['email'];
    $phone = $row['phone'];
    $cardOrdered = $row['card_ordered'];
} else {
    header("Location: login.php");
    exit();
}

// Обработка формы редактирования профиля
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newFullName = $_POST['full_name'];
    $newEmail = $_POST['email'];
    $newPhone = $_POST['phone'];

    // Обновление информации о пользователе в базе данных
    $updateQuery = "UPDATE users SET full_name = '$newFullName', email = '$newEmail', phone = '$newPhone' WHERE user_id = $userId";
    mysqli_query($conn, $updateQuery);

    // Перенаправление на страницу личного кабинета
    header("Location: profile.php");
    exit();
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Личный кабинет - Банк</title>
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
        margin-top: 55px;
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
        <h1>Редактирование профиля</h1>
    </header>

    <nav>
        <ul>
            <li><a href="index.php">Главная</a></li>
            <li><a href="logout.php">Выйти</a></li>
        </ul>
    </nav>
    <section class="content">
        <div class="form-container">
            <form method="POST" action="">
                <input type="text" name="full_name" value="<?php echo $fullName; ?>" placeholder="Полное имя" required>
                <input type="email" name="email" value="<?php echo $email; ?>" placeholder="Email" required>
                <input type="tel" name="phone" value="<?php echo $phone; ?>" placeholder="Телефон" required>
                <input type="submit" value="Сохранить">
            </form>
        </div>
    </section>

    <footer>
        <p>&copy; 2023 Банк. Все права защищены.</p>
    </footer>
</body>
</html>
