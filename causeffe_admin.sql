-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: mysql:3306
-- Время создания: Дек 20 2018 г., 09:37
-- Версия сервера: 5.6.42
-- Версия PHP: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `causeffe_admin`
--

-- --------------------------------------------------------

--
-- Структура таблицы `availability_type`
--

CREATE TABLE `availability_type` (
  `type_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `availability_type`
--

INSERT INTO `availability_type` (`type_id`, `description`) VALUES
(0, 'Beschikbaar'),
(1, 'Onbeschikbaar'),
(2, 'Ziekgemeld'),
(3, 'Met vakantie');

-- --------------------------------------------------------

--
-- Структура таблицы `color`
--

CREATE TABLE `color` (
  `color_id` int(11) NOT NULL,
  `hex` char(6) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `color`
--

INSERT INTO `color` (`color_id`, `hex`, `description`) VALUES
(1, 'e59b9c', 'Red'),
(2, 'a19be5', 'Purple'),
(3, 'e6cc9b', 'Yellow'),
(4, 'da9ae4', 'Pink'),
(5, '9ce5de', 'Green');

-- --------------------------------------------------------

--
-- Структура таблицы `contract`
--

CREATE TABLE `contract` (
  `contract_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `contract`
--

INSERT INTO `contract` (`contract_id`, `name`) VALUES
(1, 'Oproep'),
(2, 'Min-Max'),
(3, 'Stageovereenkomst');

-- --------------------------------------------------------

--
-- Структура таблицы `employer`
--

CREATE TABLE `employer` (
  `employer_id` int(11) NOT NULL,
  `employer_uid` varchar(32) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `street_number` int(11) NOT NULL,
  `street_extra` varchar(32) NOT NULL,
  `postal` char(7) NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `kvk` int(4) NOT NULL,
  `iban` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `confirmed` int(1) DEFAULT NULL,
  `contactperson` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `employer`
--

INSERT INTO `employer` (`employer_id`, `employer_uid`, `name`, `phone`, `email`, `street`, `street_number`, `street_extra`, `postal`, `city`, `country`, `kvk`, `iban`, `password`, `confirmed`, `contactperson`) VALUES
(1, '00c8a9ae44f11f360785ea213dfa0e58', 'Special cosmetics', '', '', '', 0, '', '', '', '', 0, '', NULL, NULL, NULL),
(2, '44d9b81e56589146aecc95110dabd9e4', 'Stadion Consultency ', '+31 6-2926 7514', 'r.schrama@stadiumconsultancy.com', 'Jan Massenstraat 32', 0, '', '1411 RW', 'Naarden', 'Nederland', 32118721, '', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `employer_task`
--

CREATE TABLE `employer_task` (
  `task_id` int(11) NOT NULL,
  `employer_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `time_start` datetime NOT NULL,
  `time_end` datetime NOT NULL,
  `complete` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `event`
--

CREATE TABLE `event` (
  `event_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `time_start` datetime NOT NULL,
  `time_end` datetime NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `identification`
--

CREATE TABLE `identification` (
  `id_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `identification`
--

INSERT INTO `identification` (`id_id`, `name`) VALUES
(1, 'ID kaart'),
(2, 'Paspoort'),
(3, 'Verblijfsdocument');

-- --------------------------------------------------------

--
-- Структура таблицы `location`
--

CREATE TABLE `location` (
  `location_id` int(11) NOT NULL,
  `employer_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `dress_code` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `street_number` int(11) NOT NULL,
  `street_extra` varchar(32) NOT NULL,
  `postal` char(7) NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `location`
--

INSERT INTO `location` (`location_id`, `employer_id`, `name`, `dress_code`, `street`, `street_number`, `street_extra`, `postal`, `city`, `country`) VALUES
(1, 1, 'Sheila', '', 'Wormerveer', 100, '', '2013ab', 'Wormerveer', 'Nederland'),
(2, 2, 'Naarden Staandaard vesteging. ', '', 'Jan Massenstraat 32', 32, '', '1411 RW', 'Naarden', 'Nederland ');

-- --------------------------------------------------------

--
-- Структура таблицы `posture`
--

CREATE TABLE `posture` (
  `posture_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `posture`
--

INSERT INTO `posture` (`posture_id`, `name`) VALUES
(1, 'Atletisch'),
(2, 'Gespierd'),
(3, 'Slank'),
(4, 'Stevig');

-- --------------------------------------------------------

--
-- Структура таблицы `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `filter` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `role`
--

INSERT INTO `role` (`role_id`, `name`, `filter`) VALUES
(1, 'Systeembeheerder\n', 0),
(2, 'Beveiliger', 1),
(3, 'Aspirant Beveiliger', 1),
(4, 'Straatcoach', 1),
(5, 'Host', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `shift`
--

CREATE TABLE `shift` (
  `shift_id` int(11) NOT NULL,
  `shift_uid` varchar(255) NOT NULL,
  `time_start` datetime NOT NULL,
  `time_end` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `confirmed` tinyint(4) NOT NULL,
  `break` smallint(6) NOT NULL,
  `late` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `shift`
--

INSERT INTO `shift` (`shift_id`, `shift_uid`, `time_start`, `time_end`, `user_id`, `location_id`, `confirmed`, `break`, `late`) VALUES
(1, '7c50bc5a35bd6e8135c7d36b3c5a473f', '1970-01-01 01:00:00', '2018-04-15 14:57:00', 5, 1, 0, 0, 0),
(2, '142a3e2f773110b836969f39dfb69c25', '2018-07-27 12:00:00', '2018-07-27 18:00:00', 7, 2, 1, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `shift_note`
--

CREATE TABLE `shift_note` (
  `note_id` int(11) NOT NULL,
  `shift_id` int(11) NOT NULL,
  `note` text NOT NULL,
  `archived` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_uid` char(32) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`user_id`, `user_uid`, `email`, `password`, `firstname`, `lastname`, `role_id`, `created`) VALUES
(1, 'a', 'milon@mxg.nl', '$2y$10$lvSg.59/I0cAFYhCbpOAzuApXusp/UqnO/7F9giidCbtcJj9GMb.q', 'Milon', 'Kremer', 1, '2018-04-09 00:00:00'),
(2, 'b', 'robert@causeffect.nl', '$2y$10$hvyHdGfYGNQeZ39lVMlw9eCus2PbRu7W1gMB42H3.htnDl24El78e', 'Robert', 'Marousseev', 1, '2018-04-09 00:00:00'),
(3, 'c', 'patrick@causeffect.nl', '$2y$10$SCq2bHrNwq6VGmAoiYT3teF1ix44j92Ee3eEdxsasPJPTQmLPzOCa', 'Patrick', 'Goeptar', 1, '2018-04-09 00:00:00'),
(4, 'd', 'tamsyngraanoogst@hotmail.com', '$2y$10$SCq2bHrNwq6VGmAoiYT3teF1ix44j92Ee3eEdxsasPJPTQmLPzOCa', 'Tamsyn', 'Graanoogst', 1, '2018-04-09 00:00:00'),
(5, '9025e123164e357623bb3e47dd906800', 'charlespoorter@gmail.com', '$2y$10$jkelcHewhQ79wlAoNcPQiOTVaGKDEc7kVn9mx2WwohELNNHaBNd5i', 'Charles', 'Poorter', 5, '2018-04-10 12:37:08'),
(6, 'dev228', 'tony.pitchblack@yandex.ru', '$2y$10$6oxJOOUKtSAgmNGMp.AHAuIkoCpPchiG2y53UpmVOW9a9JArwCg1i', 'Tony', 'Pitchblack', 5, '2018-05-12 00:00:00'),
(7, '55320ef7da32ce9874649211dd751782', 'david@iammorse.com', '$2y$10$Ez1P64QJEkoaRie2N3o/I.pt1tNXOZyCb0qWd5sWwMq0WAQ2a/Q0O', 'David ', 'Morse ', 5, '2018-07-25 13:41:25');

-- --------------------------------------------------------

--
-- Структура таблицы `user_availability`
--

CREATE TABLE `user_availability` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `time_start` datetime NOT NULL,
  `time_end` datetime NOT NULL,
  `repeats` tinyint(4) NOT NULL,
  `type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user_availability`
--

INSERT INTO `user_availability` (`id`, `user_id`, `comment`, `time_start`, `time_end`, `repeats`, `type_id`) VALUES
(1, 5, '', '2018-04-14 09:00:00', '2018-04-14 09:00:00', 1, 0),
(2, 5, '', '2018-04-15 09:00:00', '2018-04-17 11:12:20', 1, 0),
(3, 4, '', '2018-04-12 09:00:00', '2018-04-12 15:00:00', 0, 0),
(4, 7, '', '2018-07-26 09:00:00', '2018-08-26 09:00:00', 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `user_clothing`
--

CREATE TABLE `user_clothing` (
  `user_id` int(11) NOT NULL,
  `shirt` smallint(6) NOT NULL,
  `pants` decimal(4,1) NOT NULL,
  `costume` decimal(4,1) NOT NULL,
  `shoes` decimal(4,1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user_clothing`
--

INSERT INTO `user_clothing` (`user_id`, `shirt`, `pants`, `costume`, `shoes`) VALUES
(5, 0, '0.0', '0.0', '0.0'),
(7, 1, '0.0', '0.0', '0.0');

-- --------------------------------------------------------

--
-- Структура таблицы `user_contact`
--

CREATE TABLE `user_contact` (
  `user_id` int(11) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `street_number` int(11) NOT NULL,
  `street_extra` varchar(32) NOT NULL,
  `postal` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user_contact`
--

INSERT INTO `user_contact` (`user_id`, `phone`, `street`, `street_number`, `street_extra`, `postal`, `city`, `country`) VALUES
(1, '', '', 0, '', '', '', ''),
(2, '', '', 0, '', '', '', ''),
(3, '', '', 0, '', '', '', ''),
(4, '', '', 0, '', '', '', ''),
(5, '', '', 0, '', '', '', ''),
(7, '', '', 0, '', '', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `user_diploma`
--

CREATE TABLE `user_diploma` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `user_image`
--

CREATE TABLE `user_image` (
  `image_id` int(11) NOT NULL,
  `source_uid` varchar(32) NOT NULL,
  `offset_x` int(4) NOT NULL DEFAULT '0',
  `offset_y` int(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `user_info`
--

CREATE TABLE `user_info` (
  `user_id` int(11) NOT NULL,
  `contract_id` int(11) NOT NULL,
  `gender` tinyint(4) NOT NULL,
  `birthdate` date NOT NULL,
  `birth_city` varchar(255) NOT NULL,
  `birth_country` varchar(255) NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `csn` int(11) NOT NULL,
  `id_id` int(11) NOT NULL,
  `id_exp` date NOT NULL,
  `length` decimal(3,2) NOT NULL,
  `posture_id` int(11) NOT NULL,
  `wage` decimal(4,2) NOT NULL,
  `travel_cost` decimal(4,2) NOT NULL,
  `card_number` int(11) NOT NULL,
  `card_color` varchar(64) NOT NULL,
  `card_exp` date NOT NULL,
  `contract_start` date NOT NULL,
  `contract_end` date DEFAULT NULL,
  `service_start` date NOT NULL,
  `drivers_license` tinyint(4) NOT NULL,
  `specialty` enum('Graphic designer','SEA specialist','SEO specialist','Social media marketeer','Copywriter','DTP’er','Camera operator','Video editor','Motion graphic designer') DEFAULT NULL,
  `level` enum('Semi Pro','Pro','Expert') DEFAULT NULL,
  `rating` int(1) DEFAULT NULL,
  `photo_image_id` int(11) DEFAULT NULL,
  `video_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user_info`
--

INSERT INTO `user_info` (`user_id`, `contract_id`, `gender`, `birthdate`, `birth_city`, `birth_country`, `nationality`, `csn`, `id_id`, `id_exp`, `length`, `posture_id`, `wage`, `travel_cost`, `card_number`, `card_color`, `card_exp`, `contract_start`, `contract_end`, `service_start`, `drivers_license`, `specialty`, `level`, `rating`, `photo_image_id`, `video_id`) VALUES
(1, 0, 0, '0000-00-00', '', '', '', 0, 0, '0000-00-00', '0.00', 0, '0.00', '0.00', 0, '', '0000-00-00', '0000-00-00', NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL),
(2, 0, 0, '0000-00-00', '', '', '', 0, 0, '0000-00-00', '0.00', 0, '0.00', '0.00', 0, '', '0000-00-00', '0000-00-00', NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL),
(3, 0, 0, '0000-00-00', '', '', '', 0, 0, '0000-00-00', '0.00', 0, '0.00', '0.00', 0, '', '0000-00-00', '0000-00-00', NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL),
(4, 0, 0, '0000-00-00', '', '', '', 0, 0, '0000-00-00', '0.00', 0, '0.00', '0.00', 0, '', '0000-00-00', '0000-00-00', NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL),
(5, 0, 0, '0000-00-00', '', '', '', 0, 0, '0000-00-00', '0.00', 0, '0.00', '0.00', 0, '', '0000-00-00', '0000-00-00', NULL, '0000-00-00', 0, NULL, NULL, NULL, NULL, NULL),
(7, 0, 0, '2018-07-17', '', '', '', 0, 1, '1970-01-01', '0.00', 0, '20.00', '0.00', 0, '', '1970-01-01', '1970-01-01', '1970-01-01', '1970-01-01', 0, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `user_internal_training`
--

CREATE TABLE `user_internal_training` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `user_portfolio`
--

CREATE TABLE `user_portfolio` (
  `user_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `user_project`
--

CREATE TABLE `user_project` (
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `started` datetime DEFAULT NULL,
  `finished` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `user_review`
--

CREATE TABLE `user_review` (
  `user_id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_site` varchar(255) DEFAULT NULL,
  `review` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `user_skill`
--

CREATE TABLE `user_skill` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `user_task`
--

CREATE TABLE `user_task` (
  `task_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `time_start` datetime NOT NULL,
  `time_end` datetime NOT NULL,
  `complete` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user_task`
--

INSERT INTO `user_task` (`task_id`, `user_id`, `description`, `time_start`, `time_end`, `complete`) VALUES
(1, 1, 'test', '2018-04-09 09:00:00', '2018-04-09 09:00:00', 1),
(2, 5, 'Adres gegevens opvragen', '2018-04-10 09:00:00', '2018-04-10 09:00:00', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `user_verification`
--

CREATE TABLE `user_verification` (
  `user_id` int(11) NOT NULL,
  `token` varchar(32) NOT NULL,
  `generated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `user_video`
--

CREATE TABLE `user_video` (
  `video_id` int(11) NOT NULL,
  `source_uid` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `user_weekday_availability`
--

CREATE TABLE `user_weekday_availability` (
  `user_id` int(11) NOT NULL,
  `monday` bit(1) DEFAULT NULL,
  `tuesday` bit(1) DEFAULT NULL,
  `wednesday` bit(1) DEFAULT NULL,
  `thursday` bit(1) DEFAULT NULL,
  `friday` bit(1) DEFAULT NULL,
  `saturday` bit(1) DEFAULT NULL,
  `sunday` bit(1) DEFAULT NULL,
  `hours` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `availability_type`
--
ALTER TABLE `availability_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Индексы таблицы `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`color_id`);

--
-- Индексы таблицы `contract`
--
ALTER TABLE `contract`
  ADD PRIMARY KEY (`contract_id`);

--
-- Индексы таблицы `employer`
--
ALTER TABLE `employer`
  ADD PRIMARY KEY (`employer_id`),
  ADD UNIQUE KEY `employer_uid` (`employer_uid`);

--
-- Индексы таблицы `employer_task`
--
ALTER TABLE `employer_task`
  ADD PRIMARY KEY (`task_id`);

--
-- Индексы таблицы `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`event_id`);

--
-- Индексы таблицы `identification`
--
ALTER TABLE `identification`
  ADD PRIMARY KEY (`id_id`);

--
-- Индексы таблицы `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`location_id`);

--
-- Индексы таблицы `posture`
--
ALTER TABLE `posture`
  ADD PRIMARY KEY (`posture_id`);

--
-- Индексы таблицы `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Индексы таблицы `shift`
--
ALTER TABLE `shift`
  ADD PRIMARY KEY (`shift_id`);

--
-- Индексы таблицы `shift_note`
--
ALTER TABLE `shift_note`
  ADD PRIMARY KEY (`note_id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_id` (`user_uid`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `user_id_2` (`user_uid`);

--
-- Индексы таблицы `user_availability`
--
ALTER TABLE `user_availability`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user_clothing`
--
ALTER TABLE `user_clothing`
  ADD PRIMARY KEY (`user_id`);

--
-- Индексы таблицы `user_contact`
--
ALTER TABLE `user_contact`
  ADD PRIMARY KEY (`user_id`);

--
-- Индексы таблицы `user_diploma`
--
ALTER TABLE `user_diploma`
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `user_image`
--
ALTER TABLE `user_image`
  ADD PRIMARY KEY (`image_id`);

--
-- Индексы таблицы `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `photo_image_id` (`photo_image_id`);

--
-- Индексы таблицы `user_internal_training`
--
ALTER TABLE `user_internal_training`
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `user_portfolio`
--
ALTER TABLE `user_portfolio`
  ADD KEY `user_id` (`user_id`),
  ADD KEY `image_id` (`image_id`);

--
-- Индексы таблицы `user_project`
--
ALTER TABLE `user_project`
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `user_review`
--
ALTER TABLE `user_review`
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `user_skill`
--
ALTER TABLE `user_skill`
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `user_task`
--
ALTER TABLE `user_task`
  ADD PRIMARY KEY (`task_id`);

--
-- Индексы таблицы `user_verification`
--
ALTER TABLE `user_verification`
  ADD PRIMARY KEY (`user_id`);

--
-- Индексы таблицы `user_video`
--
ALTER TABLE `user_video`
  ADD PRIMARY KEY (`video_id`);

--
-- Индексы таблицы `user_weekday_availability`
--
ALTER TABLE `user_weekday_availability`
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `availability_type`
--
ALTER TABLE `availability_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `contract`
--
ALTER TABLE `contract`
  MODIFY `contract_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `employer`
--
ALTER TABLE `employer`
  MODIFY `employer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `event`
--
ALTER TABLE `event`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `identification`
--
ALTER TABLE `identification`
  MODIFY `id_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `location`
--
ALTER TABLE `location`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `posture`
--
ALTER TABLE `posture`
  MODIFY `posture_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `shift`
--
ALTER TABLE `shift`
  MODIFY `shift_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `shift_note`
--
ALTER TABLE `shift_note`
  MODIFY `note_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `user_availability`
--
ALTER TABLE `user_availability`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `user_task`
--
ALTER TABLE `user_task`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `user_diploma`
--
ALTER TABLE `user_diploma`
  ADD CONSTRAINT `user_diploma_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Ограничения внешнего ключа таблицы `user_info`
--
ALTER TABLE `user_info`
  ADD CONSTRAINT `user_info_ibfk_1` FOREIGN KEY (`photo_image_id`) REFERENCES `user_image` (`image_id`);

--
-- Ограничения внешнего ключа таблицы `user_internal_training`
--
ALTER TABLE `user_internal_training`
  ADD CONSTRAINT `user_internal_training_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Ограничения внешнего ключа таблицы `user_portfolio`
--
ALTER TABLE `user_portfolio`
  ADD CONSTRAINT `user_portfolio_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `user_portfolio_ibfk_2` FOREIGN KEY (`image_id`) REFERENCES `user_image` (`image_id`);

--
-- Ограничения внешнего ключа таблицы `user_project`
--
ALTER TABLE `user_project`
  ADD CONSTRAINT `user_project_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Ограничения внешнего ключа таблицы `user_review`
--
ALTER TABLE `user_review`
  ADD CONSTRAINT `user_review_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Ограничения внешнего ключа таблицы `user_skill`
--
ALTER TABLE `user_skill`
  ADD CONSTRAINT `user_skill_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Ограничения внешнего ключа таблицы `user_weekday_availability`
--
ALTER TABLE `user_weekday_availability`
  ADD CONSTRAINT `user_weekday_availability_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
