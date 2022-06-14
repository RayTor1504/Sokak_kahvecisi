SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";




CREATE TABLE `kahveler_tbl` (
  `id` int(10) NOT NULL,
  `kahve turu` varchar(100) NOT NULL,
  `fiyat` varchar(250) NOT NULL,
  `kahve_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `kahveler_tbl` (`id`, `kahve turu`,  `fiyat`, `kahve_img`) VALUES
(1, 'Macchiato', '22', 'images/menu-1.png'),
(2, 'Americano',  '24', 'images/menu-2.png'),
(3, 'Latte',  '24', 'images/menu-3.png'),
(4, 'Mocha', '22', 'images/menu-4.png'),



ALTER TABLE `kahveler_tbl`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `kahveler_tbl`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;
