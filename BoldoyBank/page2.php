<?php
// Проверяем, авторизован ли пользователь
session_start();
if (!isset($_SESSION['username'])) {
    // Если пользователь не авторизован, перенаправляем его на страницу входа или выводим сообщение о необходимости авторизации
    header("Location: login.php");
    exit();
}
?>

<?php
// Подключение к базе данных
$hostname = 'localhost';
$username = 'root';
$password = 'root';
$database = 'boldoy_bank';

$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Ошибка подключения к базе данных: " . $conn->connect_error);
}

// Обработка отправленной формы
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получение данных из формы
    $carMakeModel = $_POST["car_make_model"];
    $carYear = $_POST["car_year"];
    $carRegistrationNumber = $_POST["car_registration_number"];
    $ownerName = $_POST["owner_name"];
    $contactNumber = $_POST["contact_number"];
    $email = $_POST["email"];
    $insuranceAmount = $_POST["insurance_amount"];
    $additionalParameters = $_POST["additional_parameters"];

    // Вставка данных в базу данных
    $sql = "INSERT INTO Insurance (car_make_model, car_year, car_registration_number, owner_name, contact_number, email, insurance_amount, additional_parameters)
            VALUES ('$carMakeModel', '$carYear', '$carRegistrationNumber', '$ownerName', '$contactNumber', '$email', '$insuranceAmount', '$additionalParameters')";

    if ($conn->query($sql) === TRUE) {
        $message = "Страховка успешно оформлена!";
    } else {
        $error = "Ошибка при оформлении страховки: " . $conn->error;
    }

    // Закрытие соединения с базой данных
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Оформление страховки на автомобиль</title>
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
            padding: 5px;
            text-align: center;
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

    form {
        text-align: center;
    }

    .form-row {
        display: block;
        width: 300px;
        margin: 0 auto;
        box-sizing: border-box;
        padding: 5px;
        text-align: left;
    }

    label {
        display: block;
        margin-bottom: 5px;
    }

    input[type="text"],
    input[type="email"],
    input[type="number"],
    textarea {
        width: 100%;
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }

    .example {
        display: block;
        font-size: 12px;
        color: #888;
        margin-top: 5px;
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

    input[type="submit"]:hover {
        background-color: #555;
    }
</style>
</head>
<body>
<header>
    <h1>Оформление страховки на автомобиль</h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.php">Главная</a></li>
            <li><a href="contacts.php">Контакты</a></li>
        </ul>
    </nav>
    <?php if (isset($message)) { ?>
        <p><?php echo $message; ?></p>
    <?php } ?>

    <?php if (isset($error)) { ?>
        <p><?php echo $error; ?></p>
    <?php } ?>

    <form action="process_form.php" method="POST">
    <div class="form-row">
        <label for="owner_name">Имя владельца автомобиля:</label>
        <input type="text" name="owner_name" id="owner_name" required>
        <span class="example">Например: Иван Иванов</span>
    </div>

    <div class="form-row">
        <label for="contact_number">Контактный номер телефона:</label>
        <input type="text" name="contact_number" id="contact_number" required>
        <span class="example">Например: +7 (123) 456-7890</span>
    </div>

    <div class="form-row">
        <label for="email">Электронная почта:</label>
        <input type="email" name="email" id="email" required>
        <span class="example">Например: ivan@gmail.com</span>
    </div>

    <div class="form-row">
        <label for="car_make">Марка автомобиля:</label>
        <input type="text" name="car_make" id="car_make" required>
        <span class="example">Например: Toyota</span>
    </div>

    <div class="form-row">
        <label for="car_model">Модель автомобиля:</label>
        <input type="text" name="car_model" id="car_model" required>
        <span class="example">Например: Camry</span>
    </div>

    <div class="form-row">
        <label for="car_year">Год выпуска автомобиля:</label>
        <input type="number" name="car_year" id="car_year" min="1900" max="2023" required>
        <span class="example">Например: 2015</span>
    </div>

    <div class="form-row">
        <label for="insurance_amount">Страховая сумма:</label>
        <input type="text" name="insurance_amount" id="insurance_amount" required>
        <span class="example">Например: 100,000 руб.</span>
    </div>

    <div class="form-row">
        <label for="additional_parameters">Дополнительные параметры страховки:</label>
        <textarea name="additional_parameters" id="additional_parameters"></textarea>
        <span class="example">Например: Автостекла, Несчастный случай</span>
    </div>

    <input type="submit" value="Оформить страховку">
</form>
<footer>
        <p>&copy; 2023 Банк. Все права защищены.</p>
    </footer>
</body>
</html>
