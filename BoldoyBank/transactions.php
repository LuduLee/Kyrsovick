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

// Получение истории переводов текущего пользователя
$historyQuery = "SELECT t.*, u.username AS sender_username, u2.username AS recipient_username FROM transfers t 
                INNER JOIN users u ON t.sender_id = u.user_id 
                INNER JOIN users u2 ON t.recipient_id = u2.user_id 
                WHERE t.sender_id = $userId OR t.recipient_id = $userId 
                ORDER BY t.date_created DESC";

$historyResult = mysqli_query($conn, $historyQuery);

if (!$historyResult) {
    die("Ошибка выполнения запроса: " . mysqli_error($conn));
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head>
    <title>История переводов - Банк</title>
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

    table {
        width: 100%;
        border-collapse: collapse;
    }

    table td, table th {
        padding: 8px;
        border: 1px solid #ddd;
    }

    table tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    </style>
</head>
<body>
    <header>
        <h1>История переводов</h1>
    </header>

    <nav>
        <ul>
            <li><a href="index.php">Главная</a></li>
            <li><a href="dashboard.php">Личный кабинет</a></li>
            <li><a href="logout.php">Выйти</a></li>
        </ul>
    </nav>

    <section class="content">
        <h2>История переводов</h2>
        <table>
        <thead>
        <tr>
            <th>Отправитель</th>
            <th>Получатель</th>
            <th>Сумма</th>
            <th>Дата и время</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($historyResult && mysqli_num_rows($historyResult) > 0) {
            while ($row = mysqli_fetch_assoc($historyResult)) {
                $senderId = $row['sender_id'];
                $recipientId = $row['recipient_id'];
                $amount = $row['amount'];
                $timestamp = $row['date_created'];

                // Получение имени отправителя по его идентификатору
                $senderQuery = "SELECT username FROM users WHERE user_id = $senderId";
                $senderResult = mysqli_query($conn, $senderQuery);
                if ($senderResult && mysqli_num_rows($senderResult) > 0) {
                    $senderRow = mysqli_fetch_assoc($senderResult);
                    $sender = $senderRow['username'];
                } else {
                    $sender = "Unknown";
                }

                // Получение имени получателя по его идентификатору
                $recipientQuery = "SELECT username FROM users WHERE user_id = $recipientId";
                $recipientResult = mysqli_query($conn, $recipientQuery);
                if ($recipientResult && mysqli_num_rows($recipientResult) > 0) {
                    $recipientRow = mysqli_fetch_assoc($recipientResult);
                    $recipient = $recipientRow['username'];
                } else {
                    $recipient = "Unknown";
                }

                // Отображение информации о переводе
                echo "<tr>";
                echo "<td>$sender</td>";
                echo "<td>$recipient</td>";
                echo "<td>$amount</td>";
                echo "<td>$timestamp</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Нет доступных переводов</td></tr>";
        }
        ?>
    </tbody>
    </table>
    </section>

    <footer>
        <p>&copy; 2023 Банк. Все права защищены.</p>
    </footer>
</body>
</html>
