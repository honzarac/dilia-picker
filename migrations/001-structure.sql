CREATE TABLE `synopsy` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(200) NOT NULL,
  `name_en` varchar(200) COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `detail_href` varchar(200) COLLATE utf8mb4_czech_ci DEFAULT NULL,
  `author` varchar(200) NOT NULL,
  `translator` varchar(200) NULL,
  `literal_starring` varchar(200) NOT NULL,
  `men_min` int NULL,
  `men_max` int NULL,
  `women_min` int NULL,
  `women_max` int NULL
) ENGINE='InnoDB' COLLATE 'utf8mb4_czech_ci';
