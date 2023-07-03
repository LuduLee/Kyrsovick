<?php
include('config.php');
include('investment_functions.php');

// Получение данных из формы
$principal = $_POST['principal'];
$duration = $_POST['duration'];

// Расчет вклада
$interestRate = 0.05; // Процентная ставка 5%
$interest = calculateInterest($principal, $duration, $interestRate);

// Сохранение результатов в базу данных
saveInvestmentResult($principal, $duration, $interest);

// Вывод результатов на страницу
echo "<div style='text-align: center;'>";
echo "<h2>Результаты расчета вклада</h2>";
echo "<p>Сумма вклада: $principal руб.</p>";
echo "<p>Срок вклада: $duration месяцев</p>";
echo "<p>Процентная ставка: " . ($interestRate * 100) . "%</p>";
echo "<p>Сумма процентов: $interest руб.</p>";
echo "<button onclick='saveInvestment()'>Оформить инвестицию</button>";
echo "</div>";

// Функция для сохранения результатов вклада в базу данных
function saveInvestmentResult($principal, $duration, $interest) {
  // Ваш код для сохранения результатов в базу данных
}
?>
