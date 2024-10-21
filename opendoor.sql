-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Хост: 10.0.0.45:3306
-- Время создания: Окт 21 2024 г., 14:58
-- Версия сервера: 10.6.19-MariaDB-cll-lve-log
-- Версия PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `burnfeniks_opendoor`
--

-- --------------------------------------------------------

--
-- Структура таблицы `authors`
--

CREATE TABLE `authors` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `bio` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Дамп данных таблицы `authors`
--

INSERT INTO `authors` (`id`, `name`, `bio`) VALUES
(1, 'Stan Lee', 'Сооснователь Marvel Comics и создатель множества известных супергероев.'),
(2, 'Jack Kirby', 'Известен как соавтор комиксов Marvel, таких как \"Фантастическая четверка\" и \"Мстители\".'),
(3, 'Alan Moore', 'Британский писатель и автор культовых комиксов, таких как \"Хранители\" и \"V значит вендетта\".'),
(4, 'Frank Miller', 'Известен своими работами над комиксами \"Бэтмен: Возвращение Темного рыцаря\" и \"Город грехов\".'),
(5, 'Neil Gaiman', 'Автор комикса \"Песочный человек\", а также множества книг и сценариев.'),
(6, 'Todd McFarlane', 'Создатель персонажа Спауна и один из соучредителей Image Comics.');

-- --------------------------------------------------------

--
-- Структура таблицы `comics`
--

CREATE TABLE `comics` (
  `id` int(11) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL,
  `genre_id` int(11) DEFAULT NULL,
  `published_date` date DEFAULT NULL,
  `stock` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Дамп данных таблицы `comics`
--

INSERT INTO `comics` (`id`, `image_url`, `name`, `price`, `description`, `author_id`, `genre_id`, `published_date`, `stock`) VALUES
(1, 'https://d1466nnw0ex81e.cloudfront.net/n_iv/600/4618586.jpg', 'Человек-Паук', '9.99', 'Комикс о супергерое Человеке-Пауке, созданном Стэном Ли и Стивом Дитко.', 1, 1, '1962-08-01', 50),
(2, 'https://i.pinimg.com/originals/81/8d/0e/818d0eb63cf38224168407f6842fb6f8.jpg', 'Фантастическая четверка', '12.99', 'История о первой супергеройской команде Marvel, созданной Стэном Ли и Джеком Кирби.', 1, 1, '1961-11-01', 30),
(3, 'https://i.pinimg.com/originals/1c/1d/e5/1c1de55d0c016f882db5d4e4ff74e470.jpg', 'Хранители', '14.99', 'Культовый комикс Алана Мура, который переосмыслил жанр супергероев.', 3, 1, '1986-09-01', 20),
(4, 'https://d1466nnw0ex81e.cloudfront.net/n_iv/600/905911.jpg', 'Песочный человек', '19.99', 'Комикс Нила Геймана, сочетающий элементы фэнтези и ужаса.', 5, 3, '1989-01-01', 40),
(5, 'https://i.pinimg.com/736x/84/ed/88/84ed88bb17daf98b46cc8553ee223ffb.jpg', 'Спаун', '11.99', 'История о бывшем наемнике, который вернулся с того света как антигерой.', 6, 4, '1992-05-01', 25),
(6, 'https://i.pinimg.com/736x/37/24/0c/37240c784af76e3d18dc15f22cfa2454.jpg', 'Бэтмен: Возвращение Темного рыцаря', '17.99', 'Темная история Фрэнка Миллера о возвращении Бэтмена из отставки.', 4, 1, '1986-02-01', 15),
(7, 'https://upload.wikimedia.org/wikipedia/ru/thumb/4/41/MayorGromCover%E2%84%961.jpg/261px-MayorGromCover%E2%84%961.jpg', 'Майор Гром', '800.00', 'Серия комиксов о майоре МВД Игоре Громе, созданная российским издательством Bubble Comics и публиковавшаяся в период с 2012 по 2017 год. Изначально художником выступал Константин Тарасов, затем должность перешла к Анастасии Ким, рисовавшей большинство последующих выпусков. Сценаристом большей части номеров серии был Артём Габрелянов, основатель издательства Bubble, в разное время работавший в соавторстве с Евгением Федотовым и Иваном Скороходом. В январе 2017 года в рамках инициативы «Второе дыхание» серия была закончена и заменена на другую, под заголовком «Игорь Гром», которая является её продолжением. В 2021 году «Игорь Гром» был также завершён и продолжен серией комиксов «Майор Игорь Гром».', 1, 1, '2024-10-19', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `genres`
--

CREATE TABLE `genres` (
  `id` int(11) NOT NULL,
  `genre_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Дамп данных таблицы `genres`
--

INSERT INTO `genres` (`id`, `genre_name`) VALUES
(1, 'Супергерои'),
(2, 'Фантастика'),
(3, 'Фэнтези'),
(4, 'Ужасы'),
(5, 'Детектив'),
(6, 'Комедия'),
(7, 'Драма');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `comics`
--
ALTER TABLE `comics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`author_id`),
  ADD KEY `genre_id` (`genre_id`);

--
-- Индексы таблицы `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `authors`
--
ALTER TABLE `authors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `comics`
--
ALTER TABLE `comics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `comics`
--
ALTER TABLE `comics`
  ADD CONSTRAINT `comics_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `authors` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `comics_ibfk_2` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
