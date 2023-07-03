<?php
// Подключение к базе данных
include 'config.php';

// Получение данных из формы
$amount = $_POST['amount'];
$interest = $_POST['interest'];

// Расчет инвестиций
$profit = $amount * ($interest / 100);

// Сохранение результатов в базу данных
$query = "INSERT INTO Investments (amount, interest, profit) VALUES ($amount, $interest, $profit)";
$result = mysqli_query($conn, $query);

// Проверка успешности выполнения запроса
if ($result) {
    // Вывод результатов расчета
    echo "Сумма инвестиции: $amount руб.<br>";
    echo "Процентная ставка: $interest%<br>";
    echo "Прибыль: $profit руб.<br>";
} else {
    echo "Ошибка при сохранении данных в базу данных.";
}

// Закрытие соединения с базой данных
mysqli_close($conn);
?>
