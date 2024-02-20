-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 20 2024 г., 07:46
-- Версия сервера: 8.0.30
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `websocket`
--

-- --------------------------------------------------------

--
-- Структура таблицы `chatrooms`
--

CREATE TABLE `chatrooms` (
  `id` int NOT NULL,
  `userid` int NOT NULL,
  `msg` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `created_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `chatrooms`
--

INSERT INTO `chatrooms` (`id`, `userid`, `msg`, `created_on`) VALUES
(11, 4, 'adada', '2024-02-19 08:52:01'),
(12, 4, 'adaq', '2024-02-19 08:52:56'),
(13, 4, 'dadad', '2024-02-19 08:54:52'),
(14, 4, 'ed1', '2024-02-19 08:55:04'),
(15, 4, '1213', '2024-02-19 08:55:13'),
(16, 5, '23213', '2024-02-19 08:56:08'),
(17, 5, 'qweqeq', '2024-02-19 08:58:25'),
(18, 5, 'saada', '2024-02-19 08:58:30'),
(19, 5, 'gtgtg', '2024-02-19 08:58:42'),
(20, 4, 'sda', '2024-02-19 08:59:00'),
(21, 5, 'dadag', '2024-02-19 08:59:04'),
(22, 4, 'ьпавапролд', '2024-02-20 04:04:52'),
(23, 4, 'іііі', '2024-02-20 04:04:58'),
(24, 4, '1 повідомлення', '2024-02-20 04:06:06'),
(25, 4, '2 повідомлення', '2024-02-20 04:06:12'),
(26, 4, '12', '2024-02-20 04:07:04'),
(27, 4, '123', '2024-02-20 04:07:12'),
(29, 5, '123', '2024-02-20 04:08:08'),
(30, 4, '231313', '2024-02-20 04:09:58');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(30) CHARACTER SET latin1 NOT NULL,
  `email` varchar(50) CHARACTER SET latin1 NOT NULL,
  `login_status` tinyint NOT NULL DEFAULT '0',
  `last_login` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `login_status`, `last_login`) VALUES
(4, 'vitas', 'ne.tvoe.del@gmail.com', 0, '2024-02-20 07:36:42'),
(5, 'vitas2.0', 'vetasek@gmail.com', 1, '2024-02-20 07:36:48'),
(6, 'Vitasik1', 'chpock@gmail.com', 0, '2024-02-20 07:26:09');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `chatrooms`
--
ALTER TABLE `chatrooms`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `chatrooms`
--
ALTER TABLE `chatrooms`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
