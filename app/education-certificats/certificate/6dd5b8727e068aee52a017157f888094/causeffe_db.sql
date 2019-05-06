-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Дек 12 2018 г., 09:40
-- Версия сервера: 5.6.41
-- Версия PHP: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `causeffe_db`
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
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `street_number` int(11) DEFAULT NULL,
  `street_extra` varchar(32) DEFAULT NULL,
  `postal` char(7) DEFAULT NULL,
  `postal_location` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `kvk` int(4) DEFAULT NULL,
  `iban` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `confirmed` int(1) DEFAULT NULL,
  `contactperson` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `employer`
--

INSERT INTO `employer` (`employer_id`, `employer_uid`, `name`, `phone`, `email`, `address`, `street`, `street_number`, `street_extra`, `postal`, `postal_location`, `city`, `country`, `kvk`, `iban`, `password`, `confirmed`, `contactperson`) VALUES
(1, '00c8a9ae44f11f360785ea213dfa0e58', 'Special cosmetics', '', '', NULL, '', 0, '', '', '', '', '', 0, '', NULL, NULL, NULL),
(2, '44d9b81e56589146aecc95110dabd9e4', 'Stadion Consultency ', '+31 6-2926 7514', 'r.schrama@stadiumconsultancy.com', NULL, 'Jan Massenstraat 32', 0, '', '1411 RW', '', 'Naarden', 'Nederland', 32118721, '', NULL, NULL, NULL),
(3, '563a7520e19f8118fe83cfe044514b49', 'Dmitriyz', '+380504567320', 'dmglad7@gmail.comzz', 'some address', NULL, NULL, NULL, NULL, 'postal+location', NULL, NULL, 1234, NULL, NULL, NULL, '1234567zz'),
(5, '57818145adb4403bfb41f920aa116984', 'Dmitriy', '+380502346534', 'sciencetech@mail.ru', 'somestreet', NULL, NULL, NULL, NULL, 'city', NULL, NULL, 1234, NULL, NULL, NULL, 'contacter'),
(6, '94599b9387dc007a1e9fa39760aa2b6d', '', '', '', '', NULL, NULL, NULL, NULL, '', NULL, NULL, 0, NULL, NULL, NULL, ''),
(7, '7f39e85e8355d5e7933806a7fbd6b658', '', '', '', '', NULL, NULL, NULL, NULL, '', NULL, NULL, 0, NULL, NULL, NULL, ''),
(8, '38813902506ff00f532055e1a7ebcb97', '', '', '', '', NULL, NULL, NULL, NULL, '', NULL, NULL, 0, NULL, NULL, NULL, ''),
(9, 'aad012c852a9d3a3df9cc26d0faefe23', '', '', '', '', NULL, NULL, NULL, NULL, '', NULL, NULL, 0, NULL, NULL, NULL, ''),
(10, 'faf724ba27bfe34bcaf0ce3ee269a899', '', '', '', '', NULL, NULL, NULL, NULL, '', NULL, NULL, 0, NULL, NULL, NULL, ''),
(11, '6f9d20c51b8468973056d7491137afcc', '', '', '', '', NULL, NULL, NULL, NULL, '', NULL, NULL, 0, NULL, NULL, NULL, ''),
(12, '3736920aa0287954f4e9b9a198471a1b', '', '', '', '', NULL, NULL, NULL, NULL, '', NULL, NULL, 0, NULL, NULL, NULL, ''),
(13, '0a2b3a0d93feca5e367372926158f23a', '', '', '', '', NULL, NULL, NULL, NULL, '', NULL, NULL, 0, NULL, NULL, NULL, ''),
(14, '0ca46d43ff49cc5c666d2fdc674668c4', '', '', '', '', NULL, NULL, NULL, NULL, '', NULL, NULL, 0, NULL, NULL, NULL, ''),
(15, '60d6c23af003a01083cd1f68fca013bd', '5345345345345', '5345345345345', 'aa@ss.ss', '435345345345', NULL, NULL, NULL, NULL, '345345345345345', NULL, NULL, 2147483647, NULL, NULL, NULL, '34534534534'),
(16, '39c8d9f4fbff02957a2e7f3ba5128437', '', '', '', '', NULL, NULL, NULL, NULL, '', NULL, NULL, 0, NULL, NULL, NULL, ''),
(17, '85584eae95e024365a8f6034115bcd54', '', '', '', '', NULL, NULL, NULL, NULL, '', NULL, NULL, 0, NULL, NULL, NULL, ''),
(18, '04599f10ceb0accce794280e590175fd', '', '', '', '', NULL, NULL, NULL, NULL, '', NULL, NULL, 0, NULL, NULL, NULL, ''),
(19, 'c544115fefa79eef18ef99da28dfe7ad', '', '', '', '', NULL, NULL, NULL, NULL, '', NULL, NULL, 0, NULL, NULL, NULL, ''),
(20, '9549a9719bc87d042007ae6ffbe6b2f8', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 'fa4e6e89e7d469876784f993869ea547', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 'd37d66b63c0602c6f4056565e0b07bee', 'dddd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, '7f6456829640a0b58b323cfbfa375793', 'asdasdasd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, '6a132b02430d499ab08499f2e217700e', 'qweqweqweqweqwe', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, '5229ded10403a85f58be8063294005df', 'Styleitaly', '0623414469', 'necati_aksu@hotmail.com', NULL, 'Kabelweg ', 34, '', '1014 BB', NULL, 'Amsterdam', 'Nederland ', 66142296, '', NULL, NULL, NULL);

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
-- Структура таблицы `feedback_form`
--

CREATE TABLE `feedback_form` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `question` text,
  `request_closed` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `feedback_form`
--

INSERT INTO `feedback_form` (`id`, `name`, `email`, `phone`, `question`, `request_closed`) VALUES
(1, 'Gonzalez', 'asdf@gds.xom', '+380505602678', 'Where?', 0),
(2, 'Gonzo', 'asdf@gds.xom', '+380505602678', 'Who?', 0),
(3, '', '', '', '', 0),
(4, '', '', '', '', 0),
(5, '', '', '', '', 0),
(6, '', '', '', '', 0),
(7, '', '', '', '', 0),
(8, '', '', '', '', 0),
(9, '', '', '', '', 0),
(10, '', '', '', '', 0),
(11, '', '', '', '', 0),
(12, '', '', '', '', 0),
(13, '', '', '', '', 0),
(14, '', '', '', '', 0),
(15, '', '', '', '', 0),
(16, '', '', '', '', 0),
(17, '', '', '', '', 0),
(18, '', '', '', '', 0),
(19, '', '', '', '', 0),
(20, '', '', '', '', 0),
(21, '', '', '', '', 0),
(22, '', '', '', '', 0),
(23, '', '', '', '', 0),
(24, '', '', '', '', 0),
(25, '', '', '', '', 0),
(26, 'dasdasd', 'dasd@das.com', '2132131', 'deasxdxda', 0),
(27, '', '', '', '', 0),
(28, '23423423423erwerwerwer', 'rrww@wew.wewe', '345345345345345', 'gdfgdfgdfgdfgdfgdfgdfg', 0),
(29, '', '', '', '', 0),
(30, '222222222222', '222qq@qq.qq', '354534534534534534', '345345345345345345345', 0),
(31, '', '', '', '', 0),
(32, 'Victor', 'ewer@e.we', '23423423', '23424234', 0),
(33, '', '', '', '', 0),
(34, 'werwerw', 'wsew@wwe.asd', '23423423423', '2343dsf233', 0),
(35, '', '', '', '', 0),
(36, '345345345', 'werwer@sesrwer.werwer', '23423423423', 'fssdfsdfsdfsfsdfsdf', 0),
(37, '2233223332323', 'qw@adfs.sdfsdf', '456456456456456', '45645645645645645645645645456', 0),
(38, '', '', '', '', 0),
(39, '', '', '', '', 0),
(40, '', '', '', '', 0),
(41, 'dsdasdasdasd', 'dd@ddd.dd', '234234234234234234234', 'asdasdasdasdasdasd', 0),
(42, 'sdasdasdasd', 'ww@dsf.sdf', '324234234234234', 'assddasfdsfsdfsdfsdf', 0),
(43, 'dsadas', 'dasda@dsad.cdas', '12321321321', 'dasdxas', 0),
(44, 'dasdas', 'dasda@dasdas.coimndsa', '213213213213', 'dsaxdas', 0),
(45, 'dasxda', 'dasdas@dsad.com', '21321321312', 'dasxdasxd', 0),
(46, 'dsfdsdf', '3333@df.df', '45445345345345345', 'sdfsdfsdfsdf', 0),
(47, 'tytytyrtyrty', 'rty@rtyr.rt', '45645646456456456', 'rtyrtyrtyrtrtyrtyryrty', 0),
(48, 'dasdasd', 'dasdas@das.com', '34234234234234234', 'dasdxas', 0),
(49, 'fffggfdgdfg', 'dfgdfg@fgd.df', '546456456456456', 'dfgdbdfdghdfh', 0),
(50, '64565465646546456', '456456@dsfsd.fsdf', '', 'sdfsdfsdfsdf', 0),
(51, '456456456456', '554654@sdfsdf.sdf', '', '4dgfhdfgdfgdfgdfg', 0),
(52, '34534534', '53453@dfsd.fsdf', '', 'sdfgsdfsdfsdfsdfsdfsdf', 0),
(53, 'dfsdfsdfsdf', '', '', 'sdfsdfs', 0),
(54, '345345345345', '34234@erfsw.fs', '456456456456', 'dfdhdfhdfhdfhdf', 0),
(55, 'sdfsdfsdf', 'sdfsd@dsfsd.sdf', '345345345345345345', 'sdfsdfsdfsdf', 0);

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
(2, 2, 'Naarden Staandaard vesteging. ', '', 'Jan Massenstraat 32', 32, '', '1411 RW', 'Naarden', 'Nederland '),
(3, 25, 'Hoofdkantoor Styleitaly ', 'Nee', 'Kabelweg', 34, '', '1014BB', 'Amsterdam', 'Nederland ');

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
(2, '142a3e2f773110b836969f39dfb69c25', '2018-07-27 12:00:00', '2018-07-27 18:00:00', 7, 2, 1, 0, 0),
(3, 'f748527c13352375bb1b2f3137505638', '2018-10-27 09:00:00', '2018-10-27 17:00:00', 114, 2, 0, 0, 0),
(4, 'df9297b2def959b496dd8aae5492f9e8', '2018-11-28 09:00:00', '2018-11-28 18:00:00', 115, 3, 0, 0, 0),
(5, 'c8bb14533fb7fb95f49e4d8090b5ab84', '2018-11-21 09:00:00', '2018-11-21 18:00:00', 115, 3, 0, 0, 0),
(6, 'a17771bcb3d564ec0b29ad31b7bd170b', '2018-12-05 09:00:00', '2018-12-05 18:00:00', 115, 3, 0, 0, 0);

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
(7, '55320ef7da32ce9874649211dd751782', 'david@iammorse.com', '$2y$10$Ez1P64QJEkoaRie2N3o/I.pt1tNXOZyCb0qWd5sWwMq0WAQ2a/Q0O', 'David ', 'Morse ', 5, '2018-07-25 13:41:25'),
(109, 'cd0fcec57580eecddbe4fce7aef6a23b', 'mail@example.comf', '$2y$10$5H9zMPAGaPiUF.MHHBTYp.DsGGUMdg2XCqXXPd3DZynyrxLF/7iHa', 'John', 'Doe', 1, '2018-10-30 10:29:04'),
(110, '66dd063f7e51fac664b354375a17a3d4', 'dfgdfg@fff.fff', '$2y$10$09LSW8y68EqjmXu3LaX25OWFoS1RSkwiykwMZRno9uNCUp4ydw6Ke', 'John', 'Doe', 1, '2018-11-02 14:07:58'),
(111, '6dd5b8727e068aee52a017157f888094', 'Test_453534534@gmail.com', '$2y$10$tgoGhwm/UAZX9RLnFCtlHeu4gWF04SjYVeonusFebndWUQ3a3Xc9O', 'John', 'Doe', 1, '2018-11-08 10:26:50'),
(112, '0bd2377c7d1ec04f213d6fa16537f5f9', 'test_3333333333@gmail.com', '$2y$10$ADT3G5X2lBcakeI2VJoGmuImBmBCP99orrUYpiaElHc9kOnj7Iena', 'John', 'Doe', 1, '2018-11-08 10:29:43'),
(113, '034248469f3bdc9e479b638572d2ad26', 'test_88888888@ggg.ggg', '$2y$10$1sfu5fpFBT7lLPS7l62/cucuWOtq30wYMh5OpywRwOWbbxhzNayOS', 'John', 'Doe', 1, '2018-11-08 10:42:11'),
(114, 'd81fcd88fb7d2db8f6bf82f5a0bc07ad', 'daisy@photodaisy.nl', '$2y$10$xIxo.Xgstc.AWhibmU54Du/HpqK5wCUAk8yhjRRfMH9kaSuSs.vCO', 'Daisy ', 'von Dutch', 5, '2018-11-27 15:23:17'),
(115, 'a7a1dc98e5b51094b6ae389c2c2a5beb', 'Etienne@dutchconsultants.com', '$2y$10$zfgtSKP8CpPyzNMx7UVq/e2tb5b8ASLIjYPIJMnpTEcD53kUZKqWO', 'Etienne', 'Rozenblad ', 5, '2018-11-27 15:41:43');

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
(7, 1, '0.0', '0.0', '0.0'),
(109, 0, '0.0', '0.0', '0.0'),
(110, 0, '0.0', '0.0', '0.0'),
(111, 0, '0.0', '0.0', '0.0'),
(112, 0, '0.0', '0.0', '0.0'),
(113, 0, '0.0', '0.0', '0.0'),
(114, 1, '0.0', '0.0', '0.0'),
(115, 4, '0.0', '0.0', '0.0');

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
(7, '', '', 0, '', '', '', ''),
(109, '', '', 0, '', '', '', ''),
(110, '', '', 0, '', '', '', ''),
(111, '', '', 0, '', '', '', ''),
(112, '', '', 0, '', '', '', ''),
(113, '', '', 0, '', '', '', ''),
(114, '0623457927', '', 0, '', '', '', ''),
(115, '0653874611', '', 0, '', '', '', '');

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
(1, 0, 0, '0000-00-00', '', '', '', 0, 0, '0000-00-00', '0.00', 0, '5.00', '0.00', 0, '', '0000-00-00', '0000-00-00', '2018-11-28', '0000-00-00', 0, NULL, NULL, 6, NULL, NULL),
(2, 0, 0, '0000-00-00', '', '', '', 0, 0, '0000-00-00', '0.00', 0, '10.00', '0.00', 0, '', '0000-00-00', '0000-00-00', '2018-11-02', '0000-00-00', 0, NULL, NULL, 2, NULL, NULL),
(3, 0, 0, '0000-00-00', '', '', '', 0, 0, '0000-00-00', '0.00', 0, '5.00', '0.00', 0, '', '0000-00-00', '0000-00-00', '2018-07-17', '0000-00-00', 0, NULL, NULL, 1, NULL, NULL),
(4, 0, 0, '0000-00-00', '', '', '', 0, 0, '0000-00-00', '0.00', 0, '0.50', '0.00', 0, '', '0000-00-00', '0000-00-00', '2019-02-07', '0000-00-00', 0, NULL, NULL, 7, NULL, NULL),
(5, 0, 0, '0000-00-00', '', '', '', 0, 0, '0000-00-00', '0.00', 0, '8.00', '0.00', 0, '', '0000-00-00', '0000-00-00', '2019-04-13', '0000-00-00', 0, NULL, NULL, 10, NULL, NULL),
(7, 0, 0, '2018-07-17', '', '', '', 0, 1, '1970-01-01', '0.00', 0, '20.00', '0.00', 0, '', '1970-01-01', '1970-01-01', '1970-01-01', '1970-01-01', 0, NULL, NULL, 10, NULL, NULL),
(109, 0, 0, '0000-00-00', '', '', '', 0, 0, '0000-00-00', '0.00', 0, '0.00', '0.00', 0, '', '0000-00-00', '0000-00-00', '2018-06-18', '0000-00-00', 0, NULL, NULL, 1, NULL, NULL),
(110, 0, 0, '0000-00-00', '', '', '', 0, 0, '0000-00-00', '0.00', 0, '0.00', '0.00', 0, '', '0000-00-00', '0000-00-00', '2019-01-15', '0000-00-00', 0, NULL, NULL, 10, NULL, NULL),
(111, 0, 0, '0000-00-00', '', '', '', 0, 0, '0000-00-00', '0.00', 0, '0.00', '0.00', 0, '', '0000-00-00', '0000-00-00', '2017-09-12', '0000-00-00', 0, NULL, NULL, 9, NULL, NULL),
(112, 0, 0, '0000-00-00', '', '', '', 0, 0, '0000-00-00', '0.00', 0, '0.00', '0.00', 0, '', '0000-00-00', '0000-00-00', '2019-05-16', '0000-00-00', 0, NULL, NULL, 3, NULL, NULL),
(113, 0, 0, '0000-00-00', '', '', '', 0, 0, '0000-00-00', '0.00', 0, '0.00', '0.00', 0, '', '0000-00-00', '0000-00-00', '2019-06-07', '0000-00-00', 0, NULL, NULL, 8, NULL, NULL),
(114, 0, 0, '1985-10-10', 'Amsterdam', 'Nederland ', 'Nederlandse ', 0, 1, '1970-01-01', '0.00', 0, '99.99', '0.00', 0, '', '1970-01-01', '2018-09-01', '2019-09-01', '2018-09-01', 0, NULL, NULL, NULL, NULL, NULL),
(115, 0, 0, '1985-01-01', 'Almere', 'Nederland ', 'Nederlandse ', 0, 1, '1970-01-01', '0.00', 0, '21.00', '0.00', 0, '', '1970-01-01', '2018-11-27', '2019-11-28', '2018-11-27', 0, NULL, NULL, NULL, NULL, NULL);

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
(1, 1, 'test', '2018-04-09 09:00:00', '2018-04-09 09:00:00', 0),
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
-- Индексы таблицы `feedback_form`
--
ALTER TABLE `feedback_form`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `employer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT для таблицы `event`
--
ALTER TABLE `event`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `feedback_form`
--
ALTER TABLE `feedback_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT для таблицы `identification`
--
ALTER TABLE `identification`
  MODIFY `id_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `location`
--
ALTER TABLE `location`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `shift_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `shift_note`
--
ALTER TABLE `shift_note`
  MODIFY `note_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

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
