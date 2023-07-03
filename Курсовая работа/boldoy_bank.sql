-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:200
-- Время создания: Июл 02 2023 г., 19:37
-- Версия сервера: 8.0.19
-- Версия PHP: 7.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `boldoy_bank`
--

-- --------------------------------------------------------

--
-- Структура таблицы `accounts`
--

CREATE TABLE `accounts` (
  `account_id` int NOT NULL,
  `user_id` int NOT NULL,
  `balance` decimal(10,2) DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `accounts`
--

INSERT INTO `accounts` (`account_id`, `user_id`, `balance`) VALUES
(1, 1, '9808.00'),
(2, 2, '1302.00'),
(3, 3, '0.00');

-- --------------------------------------------------------

--
-- Структура таблицы `cards`
--

CREATE TABLE `cards` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `payment_system` varchar(50) NOT NULL,
  `delivery_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `cards`
--

INSERT INTO `cards` (`id`, `name`, `phone_number`, `payment_system`, `delivery_date`) VALUES
(5, 'Никита', '8555', 'Mir', '2023-07-07');

-- --------------------------------------------------------

--
-- Структура таблицы `clients`
--

CREATE TABLE `clients` (
  `client_id` int NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `clients`
--

INSERT INTO `clients` (`client_id`, `first_name`, `last_name`, `address`, `phone_number`, `email`) VALUES
(1, 'Иван', 'Иванов', 'ул. Центральная 1', '555-1111', 'ivan.ivanov@example.com'),
(2, 'Елена', 'Смирнова', 'пр. Солнечный 10', '555-2222', 'elena.smirnova@example.com'),
(3, 'Александр', 'Петров', 'ул. Гагарина 5', '555-3333', 'alexander.petrov@example.com');

-- --------------------------------------------------------

--
-- Структура таблицы `creditcards`
--

CREATE TABLE `creditcards` (
  `card_id` int NOT NULL,
  `card_number` varchar(16) DEFAULT NULL,
  `card_holder` varchar(100) DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `cvv` varchar(3) DEFAULT NULL,
  `credit_limit` decimal(10,2) DEFAULT NULL,
  `balance` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `transactioncategories`
--

CREATE TABLE `transactioncategories` (
  `category_id` int NOT NULL,
  `category_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `transactioncategories`
--

INSERT INTO `transactioncategories` (`category_id`, `category_name`) VALUES
(1, 'Покупки'),
(2, 'Зарплата'),
(3, 'Перевод');

-- --------------------------------------------------------

--
-- Структура таблицы `transactiondetails`
--

CREATE TABLE `transactiondetails` (
  `transaction_id` int DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  `type_id` int DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `transactiondetails`
--

INSERT INTO `transactiondetails` (`transaction_id`, `category_id`, `type_id`, `description`) VALUES
(1, 1, 1, 'Покупка продуктов'),
(2, 2, 2, 'Зарплата за май'),
(3, 3, 1, 'Перевод другу');

-- --------------------------------------------------------

--
-- Структура таблицы `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `transactiontypes`
--

CREATE TABLE `transactiontypes` (
  `type_id` int NOT NULL,
  `type_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `transactiontypes`
--

INSERT INTO `transactiontypes` (`type_id`, `type_name`) VALUES
(1, 'Оплата'),
(2, 'Пополнение'),
(3, 'Снятие');

-- --------------------------------------------------------

--
-- Структура таблицы `transfers`
--

CREATE TABLE `transfers` (
  `transfer_id` int NOT NULL,
  `sender_id` int DEFAULT NULL,
  `recipient_id` int DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `date_created` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `transfers`
--

INSERT INTO `transfers` (`transfer_id`, `sender_id`, `recipient_id`, `amount`, `date_created`) VALUES
(1, 2, 1, '1.00', '2023-07-02 11:34:39'),
(2, 1, 2, '1234.00', '2023-07-02 12:09:58');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`) VALUES
(1, '111', '$2y$10$9B5NMZ.Pvm2Q8IjNKN5hMuMeqw2cTL2MkKkkrlN99mTLi0nmSBnt6', '111@mail.ru'),
(2, '123', '$2y$10$Ayqg/s0h5gqjuCXkQ31tmO6P5mEbk2wHufmHVDeNozPM3IPBfzNbK', '123@mail.ru'),
(3, 'Никита', '$2y$10$spiZZvIiIwM4s5mUfs2EBO3gHLkUusjyKl6txK8v6XpRtX2S/AMim', '455@mail.ru');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`account_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`);

--
-- Индексы таблицы `creditcards`
--
ALTER TABLE `creditcards`
  ADD PRIMARY KEY (`card_id`);

--
-- Индексы таблицы `transactioncategories`
--
ALTER TABLE `transactioncategories`
  ADD PRIMARY KEY (`category_id`);

--
-- Индексы таблицы `transactiondetails`
--
ALTER TABLE `transactiondetails`
  ADD KEY `transaction_id` (`transaction_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `type_id` (`type_id`);

--
-- Индексы таблицы `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `transactiontypes`
--
ALTER TABLE `transactiontypes`
  ADD PRIMARY KEY (`type_id`);

--
-- Индексы таблицы `transfers`
--
ALTER TABLE `transfers`
  ADD PRIMARY KEY (`transfer_id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `recipient_id` (`recipient_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `accounts`
--
ALTER TABLE `accounts`
  MODIFY `account_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `cards`
--
ALTER TABLE `cards`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `creditcards`
--
ALTER TABLE `creditcards`
  MODIFY `card_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `transfers`
--
ALTER TABLE `transfers`
  MODIFY `transfer_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `accounts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Ограничения внешнего ключа таблицы `transactiondetails`
--
ALTER TABLE `transactiondetails`
  ADD CONSTRAINT `transactiondetails_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`transaction_id`),
  ADD CONSTRAINT `transactiondetails_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `transactioncategories` (`category_id`),
  ADD CONSTRAINT `transactiondetails_ibfk_3` FOREIGN KEY (`type_id`) REFERENCES `transactiontypes` (`type_id`);

--
-- Ограничения внешнего ключа таблицы `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Ограничения внешнего ключа таблицы `transfers`
--
ALTER TABLE `transfers`
  ADD CONSTRAINT `transfers_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `transfers_ibfk_2` FOREIGN KEY (`recipient_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
