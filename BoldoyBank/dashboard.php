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

// Получение информации о счете текущего пользователя
$sql = "SELECT * FROM accounts WHERE user_id = $userId";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $accountRow = mysqli_fetch_assoc($result);
    $accountBalance = $accountRow['balance'];
} else {
    $accountBalance = 'Нет данных';
}

// Обработка формы перевода средств
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $recipientUsername = $_POST['recipient'];
    $amount = $_POST['amount'];

    // Проверка, существует ли получатель с таким именем пользователя
    $recipientQuery = "SELECT user_id FROM users WHERE username = '$recipientUsername'";
    $recipientResult = mysqli_query($conn, $recipientQuery);

    if ($recipientResult && mysqli_num_rows($recipientResult) > 0) {
        $recipientRow = mysqli_fetch_assoc($recipientResult);
        $recipientUserId = $recipientRow['user_id'];

        // Проверка, достаточно ли средств на счете для перевода
        if ($accountBalance >= $amount) {
            // Выполнение перевода средств
            $updateSenderQuery = "UPDATE accounts SET balance = balance - $amount WHERE user_id = $userId";
            $updateRecipientQuery = "UPDATE accounts SET balance = balance + $amount WHERE user_id = $recipientUserId";

            mysqli_query($conn, $updateSenderQuery);
            mysqli_query($conn, $updateRecipientQuery);

            // Добавление записи о переводе в таблицу transfers
            $insertTransferQuery = "INSERT INTO transfers (sender_id, recipient_id, amount) VALUES ($userId, $recipientUserId, $amount)";
            mysqli_query($conn, $insertTransferQuery);

            // Перенаправление на страницу успешного перевода
            header("Location: success.php");
            exit();
        } else {
            $errorMessage = "Недостаточно средств на счете.";
        }
    } else {
        $errorMessage = "Пользователь с таким именем не найден.";
    }
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
            left: 0;
            bottom: 0;
            width: 100%;
        }

        .error {
            color: red;
            margin-bottom: 10px;
        }

        .form-container {
            max-width: 400px;
            margin: 0 auto;
        }

        .form-container input[type="text"],
        .form-container input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
        }

        .form-container input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <header>
        <h1>Личный кабинет</h1>
    </header>

    <nav>
        <ul>
            <li><a href="index.php">Главная</a></li>
            <li><a href="transactions.php">История переводов</a></li>
            <li><a href="edit_profile.php">Редактировать профиль</a></li>
            <li><a href="logout.php">Выйти</a></li>
        </ul>
    </nav>

    <section class="content">
        <h2>Профиль пользователя</h2>
        <p><strong>Имя пользователя:</strong> <?php echo $username; ?></p>
        <p><strong>Полное имя:</strong> <?php echo $fullName; ?></p>
        <p><strong>Email:</strong> <?php echo $email; ?></p>
        <p><strong>Телефон:</strong> <?php echo $phone; ?></p>
        <p><strong>Заказана карта:</strong> <?php echo $cardOrdered ? 'Да' : 'Нет'; ?></p>
        <p><strong>Личный счет:</strong> <?php echo $accountBalance; ?></p>

        <h2>Перевод средств</h2>
        <div class="form-container">
            <?php if (isset($errorMessage)) { ?>
                <p class="error"><?php echo $errorMessage; ?></p>
            <?php } ?>
            <form method="POST" action="">
                <input type="text" name="recipient" placeholder="Имя получателя" required>
                <input type="number" name="amount" placeholder="Сумма перевода" required>
                <input type="submit" value="Перевести" >
            </form>
        </div>
    </section>

    <footer>
        <p>&copy; 2023 Банк. Все права защищены.</p>
    </footer>
</body>
</html>
