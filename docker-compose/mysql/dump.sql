SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Очистить таблицу перед добавлением данных `locale`
--
SET FOREIGN_KEY_CHECKS = 0;
TRUNCATE TABLE `locale`;
SET FOREIGN_KEY_CHECKS = 1;
--
-- Дамп данных таблицы `locale`
--

INSERT INTO `locale` (`id`, `name`, `iso`) VALUES
(1, 'English', 'en'),
(2, 'France', 'fr');

--
-- Очистить таблицу перед добавлением данных `country`
--
SET FOREIGN_KEY_CHECKS = 0;
TRUNCATE TABLE `country`;
SET FOREIGN_KEY_CHECKS = 1;
--
-- Дамп данных таблицы `country`
--

INSERT INTO `country` (`id`, `locale_id`, `name`) VALUES
(1, 1, 'USA'),
(2, 2, 'France');

--
-- Очистить таблицу перед добавлением данных `product_group`
--
SET FOREIGN_KEY_CHECKS = 0;
TRUNCATE TABLE `product_group`;
SET FOREIGN_KEY_CHECKS = 1;
--
-- Дамп данных таблицы `product_group`
--

INSERT INTO `product_group` (`id`, `name`, `description`) VALUES
(1, 'Food', 'Food product group'),
(2, 'Alcohol', 'Alcohol product group');

--
-- Очистить таблицу перед добавлением данных `product`
--
SET FOREIGN_KEY_CHECKS = 0;
TRUNCATE TABLE `product`;
SET FOREIGN_KEY_CHECKS = 1;
--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`id`, `product_group_id`, `name`, `description`, `price`) VALUES
(1, 1, 'White bread', 'Delicious white bread', 10),
(2, 2, 'Red wine', 'Aromatic red wine', 50);

--
-- Очистить таблицу перед добавлением данных `vat`
--
SET FOREIGN_KEY_CHECKS = 0;
TRUNCATE TABLE `vat`;
SET FOREIGN_KEY_CHECKS = 1;
--
-- Дамп данных таблицы `vat`
--

INSERT INTO `vat` (`id`, `product_group_id`, `locale_id`, `name`, `value`) VALUES
(1, 2, 2, 'France alcohole vat 10%', 10),
(2, 1, 2, 'France food vat 20%', 20),
(3, 1, 1, 'Usa food vat 2%', 2),
(4, 2, 1, 'Usa alcohole vat 5%', 5);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
