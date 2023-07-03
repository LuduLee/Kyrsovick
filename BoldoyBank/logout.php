<?php
// Инициируем сессию
session_start();

// Уничтожаем все данные сессии
session_destroy();

// Перенаправляем пользователя на index.html
header('Location: index.php');
exit;
?>
