-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 06, 2020 at 03:00 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `ganjuran4`
--
CREATE DATABASE IF NOT EXISTS `ci_dashboard` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `ganjuran4`;

-- --------------------------------------------------------

--
-- Table structure for table `content_article`
--

DROP TABLE IF EXISTS `content_article`;
CREATE TABLE `content_article` (
  `id` int(11) NOT NULL,
  `judul` varchar(128) NOT NULL,
  `isi` mediumtext NOT NULL,
  `gambar` varchar(128) DEFAULT NULL,
  `video` varchar(128) DEFAULT NULL,
  `penulis_id` int(11) NOT NULL,
  `tgl_buat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tgl_ubah` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL DEFAULT '0',
  `slug` varchar(128) NOT NULL,
  `editor_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `content_article`
--

INSERT INTO `content_article` (`id`, `judul`, `isi`, `gambar`, `video`, `penulis_id`, `tgl_buat`, `tgl_ubah`, `status`, `slug`, `editor_id`) VALUES
(1, 'Gereja HKTY Ganjuran', '<blockquote class=\"blockquote\"><b>Gereja Hati Kudus Tuhan Yesus Ganjuran</b></blockquote><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;\"><span style=\"font-family: Helvetica;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec enim felis, sollicitudin id porta id, interdum vel sapien. Vivamus elementum tempus nulla, sit amet interdum nulla pellentesque sit amet. Duis sodales, lorem id pretium pulvinar, justo sapien eleifend augue, sit amet maximus arcu nulla sed ligula. Proin euismod dapibus quam, eu blandit orci dictum vitae. Nullam et nisl dignissim, maximus ante quis, tincidunt nisl. Duis tristique dolor quis tellus imperdiet sagittis. Quisque condimentum consectetur augue, non elementum mi dictum vitae. Cras ultricies magna aliquet nunc pharetra, id suscipit ante ullamcorper. Aliquam tincidunt porta ultricies. Cras sit amet lacus sed turpis tempus tempus vitae vitae ex. Mauris consectetur mi dolor, sit amet gravida massa fermentum ac. Nunc ut viverra massa. Morbi augue dui, imperdiet id dictum nec, facilisis vitae enim. Etiam non sagittis velit.</span></p><p style=\"text-align: center; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;\"><span style=\"font-family: Helvetica;\">Quisque id viverra diam. Sed nec molestie mauris, et faucibus eros. Vivamus eget neque turpis. Curabitur feugiat in nisi id fringilla. Morbi efficitur sed nunc ut commodo. Praesent efficitur finibus quam. Suspendisse sagittis mollis porta.</span></p><p style=\"margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;\"><span style=\"font-family: Helvetica;\">Pellentesque eget semper sapien. In pulvinar neque sit amet tortor commodo scelerisque ut ut tellus. Pellentesque commodo eu magna quis ullamcorper. Curabitur iaculis lacinia enim, at faucibus sem feugiat vitae. Sed consectetur ligula vitae sem ultrices sagittis. Nullam a luctus nibh. Praesent vitae aliquet mi. Morbi suscipit, est et pulvinar ultrices, magna sem porta odio, quis pretium mi ipsum imperdiet odio. Nam eget faucibus lectus, sed lacinia urna. Donec pharetra, nisi sit amet consectetur accumsan, massa quam vulputate augue, eu faucibus est velit non nunc. Mauris elementum finibus purus, vitae porttitor felis tristique vitae. Mauris sed dui id lorem pulvinar ullamcorper sit amet at velit. Fusce vel est eu neque ornare porta. Duis in turpis nulla.</span></p><p style=\"text-align: center; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;\"><span style=\"font-family: Helvetica;\">Maecenas erat quam, finibus quis blandit non, scelerisque pellentesque nibh. Quisque ultrices leo nec leo hendrerit tempus. Morbi sapien velit, gravida at elit at, congue dictum sapien. Vestibulum sed arcu consectetur enim molestie molestie. Aenean maximus neque et metus semper ultrices quis sed erat. Ut posuere turpis eget orci pulvinar dignissim. Fusce sodales arcu ut imperdiet pretium. Proin euismod dolor libero, non commodo odio varius ultrices. Proin lacinia ac enim in venenatis. Maecenas iaculis placerat est, eu laoreet enim dapibus in. Quisque ullamcorper lectus nec mauris rutrum, tristique vulputate metus feugiat. Sed quis blandit metus. Vestibulum et tincidunt lectus. Aenean ante orci, efficitur sed nisi nec, imperdiet gravida metus. Praesent lobortis ante et cursus fringilla.</span></p><blockquote style=\"text-align: center; margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px;\" class=\"blockquote\"><span style=\"font-family: Helvetica;\">Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Morbi orci velit, hendrerit et maximus in, convallis et neque. Donec non facilisis ligula. Praesent facilisis pellentesque congue. Nulla semper, mi ac ultricies interdum, purus orci tempor enim, eget blandit dui lectus faucibus nulla. Donec pretium mollis velit id mattis. In eget porttitor arcu.</span></blockquote>', 'a0b289be9dea2c1ffdaaf19a1233f777.jpg', 'ijn9d8c4fxU', 1, '2020-01-04 09:57:25', '2020-01-05 23:29:31', 1, 'gereja-hkty-ganjuran', NULL),
(2, 'vero', 'Quod nihil vel fugiat excepturi quia. Et fuga molestiae nobis repellendus soluta ex delectus accusamus. Dolor eligendi quo est dolorem quis aut corporis et. Minima quo quia quasi quo repellat.', '10f910fd438a6542326ca6f2144219bd.jpg', '5en0di8168p', 1, '1991-07-06 04:43:20', '2010-03-25 20:56:09', 0, 'voluptatem', 2),
(3, 'tempore', 'Corrupti sed culpa odit ratione consequuntur. Rerum excepturi ullam dolorum aut nostrum. Repellendus qui qui aut enim natus sit.', 'c18c77b24130fd9f5b0fbfd013e21e26.jpg', '5ml5bz1681j', 2, '2008-11-16 23:54:57', '1995-09-02 16:01:56', 0, 'provident', 2),
(4, 'qui', 'Culpa voluptate quo suscipit explicabo quia. Tenetur repellendus deleniti necessitatibus voluptas et. Aut voluptatem quis voluptas autem animi eligendi.', 'deeb8e32f1db2e5daa756863709eb1e5.jpg', '2ug1kt2249j', 0, '2008-09-04 18:44:35', '2005-12-05 18:50:28', 1, 'et', 0),
(5, 'natus', 'Corporis similique eaque voluptatem voluptatem saepe iusto sunt. Ullam voluptatem maiores iusto et. Quia ut quia aut iste possimus nihil. Labore neque debitis quisquam quod.', 'ace351fbf91d837c207655b80d802a8e.jpg', '4mr7bu4120q', 0, '1976-06-27 11:31:40', '1987-03-15 13:46:33', 0, 'explicabo', 0),
(6, 'odit', 'Nulla qui quod quia temporibus quia culpa nam. Ipsa laboriosam qui iusto sapiente beatae et eum sapiente. Qui recusandae voluptatem in neque.', 'bd4f53dca99148d4703b05629ed84d7e.jpg', '3in6kb0623b', 0, '2014-05-04 16:10:37', '1986-08-15 13:59:02', 1, 'illum', 0),
(7, 'unde', 'Quisquam fugit ratione autem non maxime. Aut minus itaque provident culpa voluptate eos. Qui maxime quis eos culpa quis non.', '1bcb6ec5b56815582b3a82c8be4efad5.jpg', '2ub8ww9528m', 0, '1999-10-04 18:29:15', '1993-09-23 10:28:31', 0, 'eveniet', 1),
(8, 'eligendi', 'Consequuntur earum laboriosam suscipit voluptatibus vitae id nihil. Impedit earum ipsam molestiae dolorum. At veritatis aliquam voluptas facilis reprehenderit.', '17d21e71903aebc626ebc46c3fb28d4b.jpg', '2jc6nk4070q', 2, '1997-11-25 02:24:40', '1975-10-30 02:09:26', 0, 'impedit', 2),
(9, 'neque', 'Quasi nesciunt ullam illo cumque. Tempore porro et aut recusandae delectus quos. Facere placeat natus sed animi. Id ut omnis fuga maxime maiores repudiandae qui facilis.', '0f42ef959035cea395bbae9922dd3d3f.jpg', '1fp4ul6679v', 2, '1988-02-10 16:16:48', '1978-07-02 16:27:36', 0, 'qui', 2),
(10, 'molestias', 'Nesciunt animi voluptate dolorum qui expedita ea libero. Doloremque omnis illo quia et non et. Aliquid deserunt veritatis autem rem placeat et odit. Adipisci et veniam velit rerum.', '122f792cc09e278f26f8b8f5644137b6.jpg', '2pn8ek5727f', 2, '2017-06-14 21:41:16', '1997-07-26 02:48:43', 0, 'sed', 1),
(11, 'sed', 'Consequatur nisi porro repellat deserunt. Cum nemo facere totam quo.', 'ab1daf82600ce50443dee4991413fe2d.jpg', '1pt2wd0304f', 0, '2007-06-30 22:54:06', '1993-04-30 22:59:42', 1, 'similique', 0),
(12, 'fugit', 'Provident error corrupti nostrum magni et voluptates consequuntur similique. Natus occaecati quae aut nesciunt repellat magni. Et at aut neque voluptas nihil. Et ducimus sed inventore a autem.', '0e1df956a52bc3f86d3096136243bd39.jpg', '5ue4zz0200g', 1, '1974-12-02 16:49:46', '1972-06-21 06:03:39', 1, 'error', 2),
(13, 'dolorem', 'Qui repellendus perferendis voluptatem. Sed fuga officiis repellat harum quas et. Repellendus perspiciatis est beatae earum.', '9da0b891fffaf3c1063656cf8a1ed45c.jpg', '8av5mn9515e', 1, '2013-02-21 17:09:08', '2005-05-18 22:12:57', 1, 'ut', 0),
(14, 'officiis', 'Qui enim rerum perspiciatis non blanditiis quisquam eum. Distinctio nemo aut error exercitationem reprehenderit accusamus ducimus. Et eum officia est commodi eveniet. Eius molestiae ut nulla facere repudiandae et.', 'e169cda239a982458303b6dbd2a848a2.jpg', '5fp2cp3566p', 2, '2018-02-17 16:45:09', '1989-06-09 12:14:25', 1, 'dolorem', 0),
(15, 'est', 'Qui qui minus iusto et. Error sed aut ipsa nihil. Sed totam aut ut voluptate earum vel. Architecto quia dolor qui ut ut.', 'ef05a3cfdcef102f745f14c44589184b.jpg', '5jy7ue4283y', 0, '1998-01-30 05:00:54', '1976-02-11 06:01:58', 1, 'quia', 1),
(16, 'aperiam', 'Rerum et exercitationem qui hic sapiente. Tempore occaecati consequatur et. Autem et sapiente qui ut sed. Quasi facilis repellat debitis facilis facilis doloremque.', 'e993058a2e78d0568b360ee6674d9e15.jpg', '5zj0yk7968f', 0, '2012-09-06 06:46:59', '2019-06-08 12:55:33', 1, 'perferendis', 1),
(17, 'iusto', 'Voluptatum et rerum quae. Aut aut fugiat voluptate nulla itaque. Facilis ipsum sit pariatur laboriosam.', '0e882674f385d8fe0811739a3ad3d081.jpg', '8tu9lk3567x', 0, '2016-06-10 18:00:43', '2016-10-14 11:02:25', 0, 'quia', 0),
(18, 'ullam', 'Quia saepe sit beatae. Expedita nam mollitia tempore necessitatibus natus.', '7f223da767ce9d2c1225a2c74727f385.jpg', '9cw3ih1081f', 1, '2002-02-27 01:53:57', '1998-01-03 11:27:56', 1, 'autem', 0),
(19, 'qui', 'Amet eos expedita vel molestias nihil facilis. Ea unde doloremque error iste doloribus sit.', '551bfe407b6bda308cf576a59da90df9.jpg', '6uc2yf2771y', 1, '2013-09-28 11:59:16', '1988-05-21 16:04:35', 0, 'ex', 0),
(20, 'voluptas', 'Sed autem quis odit mollitia error. Eum magni ut qui. Sit nihil rerum cupiditate ea et reiciendis molestias.', '8a5188c1063919154b57ea4fd43b2df0.jpg', '5bs8ef9295q', 2, '2006-01-30 16:46:26', '1975-10-30 16:11:58', 1, 'impedit', 2),
(21, 'dolor', 'Aut reprehenderit voluptas cum mollitia sit rem non. Ratione in ut rerum rem. Eos accusantium illo nostrum aliquid. Expedita consequatur pariatur odio.', 'e3b29a4f9331d266eaa2c25cd9fc008c.jpg', '1jj0ge9254x', 2, '1982-04-13 13:57:27', '1985-06-30 18:49:06', 1, 'minus', 0),
(22, 'ullam', 'Consequatur et inventore tenetur voluptas id nihil ut. Placeat id et et sunt adipisci. Voluptatibus consequatur rerum vel deleniti suscipit.', 'cae7d521a50b1ad1903b1425eb8596dc.jpg', '3vb9lb6658z', 2, '2018-09-14 12:54:14', '2013-08-15 17:42:54', 0, 'quis', 0),
(23, 'pariatur', 'Expedita in dolorum quia dolores in est aut. Minus non suscipit dolores consectetur. Possimus ab voluptatem dolor odit veritatis consequatur odio.', '7b91028064b5cf234cdfed6b735947b1.jpg', '9yy8vb3145p', 2, '2016-07-14 23:42:37', '2010-10-01 03:05:35', 0, 'non', 1),
(24, 'sed', 'Consequatur eos quibusdam aut nulla iure. Voluptatum esse ea quia commodi distinctio magni officiis. Quasi corporis quia repellendus sit voluptas aut. Dolorem sequi quam quis et iusto sed.', '3e74faace633200f7f6ffef1a623aa10.jpg', '4tj9zo4287e', 1, '1999-03-07 22:55:30', '1991-04-23 12:23:52', 0, 'sit', 2),
(25, 'quo', 'Esse natus qui nisi minus quae id nemo quos. Qui aut id sunt ab minus velit unde optio. Mollitia officiis eveniet cupiditate odio. Vitae autem est corrupti et eveniet cupiditate at.', '0a167a3601d23b0afb2e1c9d8482219a.jpg', '5ye2gy6218o', 1, '1998-09-18 09:54:39', '1978-11-11 13:21:23', 1, 'debitis', 2),
(26, 'sint', 'Unde eos earum distinctio quia est. Nesciunt nobis dolorum qui animi dignissimos quia. Labore ut ut fugiat.', '3e4607c6ab617164c62348565588619d.jpg', '4yh5my4510j', 2, '1994-01-16 08:20:38', '1996-09-04 03:34:30', 1, 'quo', 2),
(27, 'qui', 'Aut mollitia et sed commodi dignissimos est. Aut facilis quod vel aliquid at iure vero non. Corrupti sed deleniti iure quaerat eum. Et inventore laboriosam et dolorum temporibus.', '91b40620ce951c5099f3b4e29883825c.jpg', '1ty1gk7768f', 1, '1991-10-22 07:53:27', '1991-07-24 14:16:58', 0, 'veniam', 2),
(28, 'aliquam', 'Qui amet fugit modi sunt maxime totam. Suscipit ratione alias eum alias facilis. Et iure quasi magnam perferendis modi mollitia. Assumenda fugit perspiciatis quos autem nobis quas.', 'a013787135370ce4bef57daac215f504.jpg', '4nk0ck5861v', 1, '1994-08-14 04:53:02', '2011-10-17 01:30:17', 1, 'quia', 0),
(29, 'commodi', 'Quasi tenetur non quia occaecati nam. Facilis adipisci voluptas doloremque ut numquam ab sequi veritatis.', '5ea29a8ea23fdffc7361f3115ee5dead.jpg', '1ux2uw0433l', 1, '1972-07-15 15:55:29', '1989-08-15 21:42:43', 1, 'pariatur', 0),
(30, 'beatae', 'Impedit praesentium tempora error eius sit at. Magnam et quos alias consequuntur quo saepe officiis.', '074fb1515608af5e8b788bef2fb02d66.jpg', '4om9jt1268c', 1, '1976-02-15 02:41:04', '2004-03-16 14:16:16', 1, 'facere', 0),
(31, 'dolores', 'Sunt modi dicta sit dicta rerum. Eligendi tenetur itaque voluptate similique tempore minima ab. Sed et inventore qui voluptatem.', '4ea10847d788be1d5d3e70ec742d0748.jpg', '9hb9sf2332e', 0, '1974-12-26 20:50:53', '1973-08-14 22:15:11', 0, 'quae', 1),
(32, 'dolorem', 'Architecto harum aut iusto laborum. Nam reprehenderit tenetur beatae dolorem. Eum libero quos dolore in. Non magni dolores quibusdam aut eveniet.', 'dbd75621a838d953d9e454a8614231b4.jpg', '1zx7ly9573h', 2, '2012-02-21 15:45:40', '2005-05-13 15:55:46', 0, 'ducimus', 0),
(33, 'iure', 'Et excepturi voluptatum accusantium ad debitis in voluptates. Rem a assumenda corrupti magnam est.', '6a1509aa085462a797d786fd0a42bf0f.jpg', '5iy2zd9644r', 2, '2007-04-30 13:49:56', '1978-06-24 21:23:11', 0, 'cum', 0),
(34, 'voluptatum', 'Qui quis aut id accusamus natus. Qui dolores sapiente maiores eaque fugiat consequatur. Et eum facere deleniti quis. Est temporibus adipisci et.', '615e3105624146867b26962bed33ef52.jpg', '5bx5tp2651r', 1, '2006-09-20 10:41:29', '1997-03-15 18:43:31', 1, 'sunt', 2),
(35, 'eos', 'Ea sequi quidem est ea animi. Reiciendis maiores autem quibusdam consequatur dolore.', 'a000fbacd04b0ef49bba2342297d2ba3.jpg', '3no6cg2816x', 0, '2000-10-03 09:00:48', '1992-08-13 05:25:20', 0, 'odio', 0),
(36, 'tempora', 'Rerum magni non sint corrupti iusto rerum. Assumenda ad expedita atque aspernatur totam omnis. Exercitationem est nisi voluptas veniam. Accusamus incidunt eos dignissimos aut est.', '107c2ea475496087a95bbd4735a95266.jpg', '0wd0ty0207c', 2, '2011-10-02 12:37:41', '2009-10-02 03:06:07', 1, 'accusamus', 0),
(37, 'esse', 'Quam itaque rerum veritatis ab est dignissimos quas. Minima sed enim nihil adipisci dolores vel ut voluptatem. Saepe voluptatum eos vitae maiores facere.', '97926a8425828ae3a89a7330db654124.jpg', '5ls9qp3028l', 1, '2018-01-25 00:58:25', '1988-06-26 01:14:38', 1, 'consequatur', 2),
(38, 'tempora', 'Labore molestiae repudiandae autem est nisi. Neque in aut eum recusandae excepturi non ea dolore. Porro dolorem et nihil iste. Dolores expedita et sed quasi laudantium consequatur.', '795c43e3baf557b92614bcca30f03c77.jpg', '4ww2nr9389j', 1, '2001-09-09 06:55:46', '1970-06-22 10:45:15', 0, 'tempore', 1),
(39, 'saepe', 'Dolor sint consequatur natus quaerat deleniti distinctio. Illo facere nostrum itaque doloribus voluptate eos magni. Corrupti vel error ut dignissimos.', 'f9bde18de99fb79bc0c2b7d947680864.jpg', '6jq9ow1916k', 0, '1987-05-05 03:37:11', '2012-04-03 13:42:27', 1, 'ut', 0),
(40, 'autem', 'Pariatur similique velit minima sunt. Eum voluptatem cum cum accusamus ex iusto reprehenderit esse. Similique similique ad sed dolorem pariatur saepe. Consectetur similique labore voluptatem officia est nemo est.', '47b3014d204dc4b885991c0bd9afc6d3.jpg', '9by1so9048c', 1, '1989-02-21 13:20:17', '2013-04-04 08:01:10', 0, 'tenetur', 2),
(41, 'dignissimos', 'Voluptas ut incidunt dicta provident iste ullam explicabo ullam. Nostrum id repudiandae est sit consequatur eos in et. Impedit nesciunt ea reiciendis repellendus. Et perferendis aliquid vero maxime quis.', '2374d7610ba29ba41d2c14321a105d2f.jpg', '2kw0to8502u', 2, '2011-09-22 06:35:37', '1980-09-27 09:21:36', 1, 'cupiditate', 0),
(42, 'sed', 'Rem et sint dicta assumenda eum minus. Sapiente cumque assumenda id magnam. Excepturi architecto quis quasi quia enim nisi. Itaque porro iure dignissimos aperiam.', '52d79efea4dd278b79fb969dbb02b647.jpg', '3dq2cj7134j', 2, '2014-09-27 13:08:09', '2007-02-05 22:56:43', 0, 'aut', 2),
(43, 'cumque', 'Omnis dicta omnis maiores quis reiciendis a ut. Asperiores inventore quo distinctio quis. Expedita corrupti eligendi quia nihil.', 'f99a3c5cbb435fc199733014b92072f7.jpg', '9px8zo8434f', 1, '2003-07-16 23:13:12', '1997-12-04 09:05:19', 0, 'nobis', 0),
(44, 'quidem', 'Iste itaque adipisci impedit ratione doloremque. Nostrum consequatur facere quo aut. Atque est mollitia et perspiciatis asperiores. Veritatis corporis doloremque quibusdam consequatur accusamus magnam asperiores rerum.', '54bcf2a05673672785e40e82c13a9a22.jpg', '4uq2qf2650k', 2, '1976-01-14 07:30:51', '1989-08-12 04:25:35', 1, 'hic', 0),
(45, 'consequuntur', 'Dignissimos rerum mollitia ullam expedita. Dicta consequatur saepe laborum consequatur. Sit ut iure voluptatem a. Quas illum ipsam occaecati voluptas et. Voluptas ut numquam mollitia voluptatem et sed.', '2de1da80b9b4f06a3cc067f54f9e6a3a.jpg', '3hz4mq6472v', 0, '2011-09-16 16:56:02', '2008-10-22 22:24:07', 0, 'qui', 0),
(46, 'eos', 'Ut quos nihil et officiis quas magnam sit. Itaque et iste animi quia ab. Quasi quia odit voluptatem tempore nobis atque repudiandae.', '8ba6e1dfb958c204f1ef4237b0b7cba2.jpg', '0py8fo4488u', 2, '2018-09-18 18:00:07', '2005-09-25 10:23:14', 0, 'magni', 1),
(47, 'eligendi', 'Recusandae dolor ut et in perspiciatis nostrum. Praesentium nihil libero autem labore molestias sunt. Vel aut sit et quia corrupti nihil eos ab.', '81b73926d6ab797043ca3a781c92dee7.jpg', '8vk4kw5104y', 1, '2004-02-13 02:53:29', '1974-10-05 19:42:38', 1, 'non', 0),
(48, 'excepturi', 'Modi eius aut vero sit. Ut eaque nihil facere velit aut sint delectus ut.', '289f0f21bba21119ca32620273991a24.jpg', '7uw5vv5867b', 0, '2003-10-10 18:55:05', '1993-02-09 13:24:21', 0, 'fugit', 0),
(49, 'amet', 'Quaerat repudiandae ipsa est voluptatem accusamus. Aut adipisci iusto dolores harum temporibus et. Nihil reprehenderit et numquam corporis molestiae. Facere libero ducimus sit reiciendis molestias.', '61762de4064326e54ac323b5ddac4bcd.jpg', '1ep0ml0366w', 0, '2007-09-17 02:06:38', '1976-08-08 04:48:57', 0, 'eveniet', 1),
(50, 'aut', 'Praesentium non molestias eum aspernatur occaecati animi inventore. Animi in ea consectetur cum. Consectetur non a quibusdam dicta. Nihil voluptas quasi quo beatae rerum minus. Beatae et ipsa aliquid facilis nulla et error.', 'd561198e6d079214f88dd444828776c6.jpg', '9gv0oi1041y', 2, '1996-09-28 03:11:25', '1997-04-22 01:27:53', 1, 'aut', 1),
(51, 'nihil', 'Sit consequatur magni sed ea adipisci. Aut error magnam quos delectus non. Deleniti quam harum delectus. Iste nobis nesciunt qui consequuntur repudiandae voluptatibus hic officiis. Deleniti et facere nobis.', '437522c6ae37d9209b9c05fafe374b19.jpg', '5er8pt6508a', 2, '1976-06-06 05:39:14', '2018-12-09 22:24:57', 0, 'error', 0),
(52, 'alias', 'Quasi maiores quaerat numquam libero pariatur velit vitae. Fuga quidem cumque similique reprehenderit officiis. Repellendus sint laudantium omnis sit voluptatibus vero.', '6bcb8e189c613e25160c9a0189700f00.jpg', '2dl1yc5571n', 0, '2006-11-28 07:37:52', '2014-04-26 00:59:04', 0, 'magnam', 1),
(53, 'error', 'Eveniet qui et pariatur odio qui. Quisquam nisi aut quis possimus. Quibusdam esse et facilis maiores voluptates atque.', '2707a8f560f8a4df7bdeeb60e820d301.jpg', '2ej0lf4707h', 2, '2015-02-05 12:17:24', '1986-05-07 08:20:52', 0, 'est', 0),
(54, 'voluptatem', 'Numquam veritatis sint aut qui. Id vero fuga in culpa. Sunt harum suscipit non repellendus. Ducimus quia vel consequatur quae ratione qui et.', '0d43b241cb563d34e6ad36c0468f4a0e.jpg', '1ge0uu5715u', 2, '2018-02-08 22:09:29', '2005-04-08 02:35:27', 0, 'saepe', 0),
(55, 'in', 'Voluptates architecto consequatur fugit eius sed iure omnis. Dolores accusantium architecto voluptatem quia officiis amet libero. Qui sed sed sint illo dolores ad ex.', '841d9d4ef08a601f5083cd258023de8b.jpg', '4dv6jr8436b', 0, '1994-10-15 18:16:29', '1997-05-03 19:10:04', 1, 'eligendi', 2),
(56, 'recusandae', 'Sunt vel voluptatibus odio ex qui minus sapiente non. Ab illo iusto praesentium voluptatibus quia perferendis autem. At voluptatem rerum beatae quia at maxime quia.', '592cac6010c43a7fb5cb70c8ddfd3a5d.jpg', '1tt8qw5384a', 1, '1998-09-24 17:52:51', '2000-11-22 12:59:26', 0, 'maiores', 1),
(57, 'minus', 'Quas omnis dolores sed illo amet. Fuga similique quis omnis. Sunt quos esse vel esse.', '87aba94435ca683aa3be887c4ddfd727.jpg', '2eq5ne8410e', 1, '2003-04-30 02:36:53', '1971-03-03 23:34:09', 1, 'sit', 0),
(58, 'eius', 'Iste architecto odio iste quo in quam. Voluptates quia ad voluptas expedita officia similique est. Placeat inventore accusantium nesciunt porro et iure iure illum. Temporibus ducimus cum rerum temporibus laboriosam voluptatum deleniti aut.', '716c89644e37706e0f101e102ac89b67.jpg', '6xj0ug4021h', 2, '2000-10-15 09:02:02', '2019-07-31 22:11:37', 0, 'excepturi', 1),
(59, 'aliquid', 'Voluptatum omnis inventore exercitationem sunt. Earum laborum enim voluptates. Rem voluptas omnis ut quod corrupti dolorem reiciendis. Et assumenda officia repellendus fuga laboriosam harum.', '9c73921d8dcefc8c55dbead1b2ca0ef4.jpg', '7fy1by5470u', 0, '1977-12-13 17:02:16', '1992-08-12 07:26:35', 1, 'quas', 2),
(60, 'nesciunt', 'Accusantium est veritatis recusandae laudantium placeat at ut. Velit ducimus a id sit earum. Nihil quidem cum consequatur qui consequuntur. Similique vel earum ad commodi ut.', '67f8cf1710d6e736bb1803e85c85f06b.jpg', '1jb3pt7368g', 0, '2005-05-14 17:22:57', '2013-02-21 06:39:37', 0, 'quisquam', 0),
(61, 'ex', 'Excepturi amet provident eos aut saepe omnis laboriosam. Illo accusamus est quod velit corrupti. Veniam voluptatem aut sint aliquam praesentium minima quae. Impedit ipsum excepturi esse autem qui numquam.', '02ab4f58fbd913781ca3dba279b908be.jpg', '4nn3ji5651o', 2, '1984-09-02 07:30:27', '1989-11-09 13:53:31', 1, 'velit', 0),
(62, 'eos', 'Libero eos sit ad. Vel ea ab perspiciatis in. Tempora nostrum occaecati facere.', 'c6b2605888f04cc73a4b7d5d1ae3fb44.jpg', '2vj1zq4751n', 2, '2014-10-13 14:20:22', '2018-08-19 20:32:29', 1, 'quo', 2),
(63, 'voluptatem', 'Ut id quis laboriosam reiciendis. Ipsam architecto accusantium cupiditate cum. Sit vel hic est tempora tenetur inventore dignissimos aperiam. Autem adipisci sint error ex et quos ut sit.', '74799632e6eea768422a2e8a0830d9e8.jpg', '0lq5oa9920s', 2, '1994-12-23 07:20:42', '1972-02-11 00:27:35', 1, 'dolor', 0),
(64, 'nam', 'Veritatis ad quae dignissimos molestiae aliquid. Laboriosam ullam tempora rerum maxime voluptate. Magnam ullam quas quod animi vel.', '1b50dc8ea6a4678be7ebdcf8c912fadf.jpg', '3os7jj3050i', 2, '1987-10-21 20:40:06', '1975-10-31 17:00:19', 1, 'dolore', 2),
(65, 'voluptate', 'Ipsam ut nesciunt et ipsum tempore sit minima dolores. Ex qui natus et quam mollitia aut dolorem. Rerum id at omnis et necessitatibus.', 'ba6df4e68b11316fbe3b530e5b144378.jpg', '7xa2da0608j', 0, '2014-04-30 07:23:55', '1978-06-03 02:41:39', 1, 'rem', 0),
(66, 'officia', 'Veritatis voluptatem numquam similique reiciendis laborum et ut. Et rerum et alias quibusdam facilis quia earum. Sapiente rerum perspiciatis et sint fuga aut hic.', '9df48c8982f6c8159d4dfeb04c6f14b9.jpg', '5wa8wo7046r', 2, '1984-12-07 19:40:33', '2009-10-13 01:09:54', 0, 'tenetur', 0),
(67, 'perferendis', 'Dolores aut consectetur quis repudiandae impedit occaecati. Quo ipsam molestias accusamus aut quaerat quis nesciunt voluptas. Tempore non ducimus quidem incidunt eius.', 'af89738b09cd2203e2bd506d5fe40d9d.jpg', '5iy3au4968a', 2, '1981-05-26 23:54:21', '1980-10-06 15:34:53', 1, 'dolorem', 0),
(68, 'delectus', 'Beatae voluptatem error ut consequuntur et. Ea iste quis molestiae. Sint possimus tempora corrupti possimus. Voluptatem ut quaerat laborum quo harum.', 'b5580150d33b371b53b1449a1ee5651c.jpg', '9ti2nw5373x', 2, '1985-07-17 13:11:15', '1975-03-04 04:55:48', 1, 'quis', 0),
(69, 'dolorem', 'Aperiam sit voluptatem et laudantium aut dolore. Eligendi accusantium accusamus at deserunt recusandae quos.', '138f3b0b296f7149d8dbe065cc513963.jpg', '1ro1mz1147x', 1, '2014-09-19 11:14:24', '2013-06-22 02:03:40', 0, 'maiores', 2),
(70, 'nesciunt', 'Quos maiores sit labore. Libero porro dolores molestiae quaerat est dignissimos. Molestias iste est quos et vel rem non.', 'feed69942102d68bf28a6d34c003eb16.jpg', '5rh0nz3388q', 0, '1999-07-06 21:58:06', '1998-08-14 21:37:17', 1, 'beatae', 0),
(71, 'dolorum', 'Possimus a modi nihil necessitatibus sed. Animi doloremque molestiae quidem libero ut id sed. Et repudiandae non dignissimos totam ut. Et et molestias ut adipisci debitis doloribus eius.', 'd9a49346751c25b6fa96834426159496.jpg', '7dk9xr9398m', 2, '1983-02-27 08:35:27', '2004-02-09 23:46:37', 1, 'excepturi', 0),
(72, 'nihil', 'Eos explicabo commodi sed non aut consectetur. Rerum id numquam voluptas necessitatibus ducimus velit. Ut nisi quia quaerat aut. Molestiae aut minima tempora ut voluptatem culpa. Quasi exercitationem dignissimos non voluptatem.', 'ce2315488e59304e812aac548847ea20.jpg', '2zt3wx7882x', 2, '1977-12-28 11:32:29', '2013-06-14 02:55:42', 0, 'autem', 1),
(73, 'inventore', 'Qui quasi eveniet sunt et autem laudantium. Minima qui dolorum tempore vitae. Molestiae saepe esse ab.', '31e5bf2e8a0c5289645222354ea1feaa.jpg', '4ae6ju3710q', 0, '1987-02-03 11:19:28', '2019-02-19 13:52:33', 1, 'fuga', 0),
(74, 'ut', 'Facilis tenetur magnam est deleniti fugiat iusto. Incidunt voluptatem consequuntur distinctio sit suscipit aliquam vero quo. Et quidem sed qui. Error totam dolores tempora aut magni facere est.', '5f3b4093e46d0f5bef5dae289401181b.jpg', '7pe7cq6652p', 0, '2008-08-30 22:24:29', '1999-05-11 12:32:32', 0, 'sit', 0),
(75, 'nulla', 'Necessitatibus et blanditiis vitae consequatur fugiat perspiciatis. Iusto vel saepe dicta vel. Qui distinctio iure facilis assumenda.', '4752d581aa389bd8b4c2554237c9c0e3.jpg', '4qo6ta6105c', 2, '1994-02-23 15:49:54', '1997-03-24 07:41:11', 1, 'eligendi', 1),
(76, 'quo', 'Magnam qui voluptas aut ut. Nesciunt aperiam facere culpa non. Non molestiae doloremque temporibus magni est. Vitae pariatur molestias natus.', '54db990ca422570f48b6b0fdd0e4e07c.jpg', '5qe1qk3220p', 0, '1981-01-22 08:03:34', '1996-03-18 21:30:47', 1, 'cupiditate', 0),
(77, 'quia', 'Maiores quae dolores dignissimos omnis quo quis quidem reiciendis. Ea sint in exercitationem dignissimos. Eligendi autem error eum sit quia aliquid.', '4f5093d7660b369363f44b3689090e09.jpg', '2vo7rf6819x', 1, '1984-11-03 00:00:41', '1972-07-20 22:17:31', 1, 'esse', 2),
(78, 'voluptate', 'Neque qui deserunt fugit repellat id ratione. Sapiente sunt ea amet ut asperiores est est. Recusandae delectus quis ea. Est numquam incidunt voluptatibus est aut eligendi.', '9c06aff8c0a21a05e520c54bfaead48b.jpg', '8re1jm8888f', 0, '2000-08-20 03:47:18', '1985-11-17 17:06:48', 1, 'aspernatur', 2),
(79, 'consequuntur', 'Laudantium velit labore suscipit est nulla blanditiis. Veniam nam saepe et nesciunt minus assumenda. Et voluptatem mollitia maiores. Sed voluptatem aut fugit eveniet.', '648ad9cc72b19e2d52f681093b2f347c.jpg', '4un2gm3464j', 2, '1995-11-21 03:11:48', '1994-05-24 15:32:33', 1, 'consequuntur', 2),
(80, 'enim', 'Occaecati non placeat temporibus unde iste. Facere sit molestiae est et assumenda doloremque et. Illum distinctio explicabo vitae omnis ut ea.', 'c07b3c1dfe11bd03ddc8ec42b9941508.jpg', '8me6hy5000u', 1, '2012-09-26 17:26:39', '1980-04-10 15:21:38', 1, 'dolores', 2),
(81, 'dolores', 'Odit voluptas ut dolorem. Facere rem laborum et adipisci. Consequatur aut culpa voluptas totam est maxime.', 'c255cf9c0459850e4e5f8f330bf90e79.jpg', '2ru2cm4506v', 1, '2016-02-26 15:52:36', '1987-02-28 03:53:03', 1, 'hic', 2),
(82, 'doloribus', 'Dolor eum voluptatibus eos quae aliquid. Voluptatum sit quaerat quia fuga quia voluptates. Aliquid praesentium similique atque quas occaecati.', '3f08abc6a13d61172bf421e45a811650.jpg', '3ym2vd5299m', 0, '1974-05-08 19:17:36', '1981-05-09 05:20:20', 1, 'aut', 0),
(83, 'sit', 'Voluptate id ad consectetur eligendi velit. Quaerat quisquam et repellat nobis ipsum. Ipsum cupiditate illum deserunt repellat omnis eum non. Et consequatur qui eum voluptatem id.', 'fa119d8613ef4f7f08b47890ade30ae8.jpg', '4qg1qn2132u', 0, '2015-10-27 15:53:57', '2016-05-14 14:10:49', 1, 'repellendus', 0),
(84, 'ut', 'Maxime voluptatibus doloremque totam dicta. Nulla inventore nostrum dolorem cum blanditiis. Nobis maxime necessitatibus eum nam id. Ut tenetur ut et esse ipsam.', '97a18687ecdcca5eb48bbd6e5fe87088.jpg', '4mx5ir1410r', 1, '2004-10-13 16:00:19', '1970-10-05 22:21:07', 1, 'nisi', 0),
(85, 'qui', 'Voluptatibus facilis nostrum in veniam porro temporibus. Tempore vitae voluptas ut molestiae quia doloremque. Ullam molestiae sapiente corporis.', '0d0f4972a17ce1b8becd7f9ef2d44eea.jpg', '6jx0ip6870d', 2, '2009-07-13 10:30:56', '2003-09-12 16:26:47', 1, 'ipsum', 1),
(86, 'ipsa', 'Dolore optio animi minima tenetur doloremque commodi. Omnis ullam molestias officia nostrum excepturi quisquam quia. Cupiditate nemo quasi eos. Error nihil nostrum exercitationem veritatis labore.', 'b7eaeb877369fbc23ccf4e5022cd3187.jpg', '3lm3bp8756e', 0, '1991-02-02 23:05:58', '2007-05-22 09:22:43', 0, 'nihil', 2),
(87, 'voluptas', 'Assumenda eum voluptatem voluptatem officia repudiandae. Culpa ipsum quis voluptatem nihil. Voluptatibus dolore sunt amet rerum. Et qui et error.', '7f367d4cb0b45840ddff93273863975a.jpg', '1qv9yj9544q', 1, '2010-01-04 23:07:43', '1984-11-21 05:49:05', 1, 'neque', 2),
(88, 'vitae', 'Cupiditate aut ipsam sunt quo corporis earum minus enim. Ut qui nisi reiciendis est ut. Totam saepe rerum autem eius in est.', 'bea14b84f8d09021caaf72a3b2cbaf4f.jpg', '6hc7ax7010t', 2, '1983-05-08 13:28:55', '1971-05-17 05:48:30', 0, 'accusantium', 1),
(89, 'ea', 'Dolor aliquam optio aut inventore aspernatur animi doloremque eos. Autem ea mollitia qui voluptatem. Molestiae totam aut ea provident. Harum beatae aut earum ut quae ut odio.', '5da3762e25dd938fd544c85f6c37fa04.jpg', '6gd7hr3070q', 0, '2003-03-07 02:16:18', '1985-07-18 06:03:50', 0, 'voluptas', 0),
(90, 'nesciunt', 'Aut maxime reiciendis officiis ut. Fugit reprehenderit sunt nam. Odit iure quasi voluptatem cumque facilis omnis qui. Aut quia nesciunt veniam dolores.', '35b2c158712c780dd74c24f598648055.jpg', '8gv3cy7305o', 2, '2008-03-06 05:14:32', '2009-11-10 07:13:12', 0, 'optio', 2),
(91, 'sit', 'Occaecati voluptatem nihil maxime ut inventore magnam molestias minima. Suscipit omnis qui voluptas alias nesciunt. Delectus rerum accusamus pariatur et ea suscipit eum veritatis.', 'e506ce35bd79685f1659aced1e6cea32.jpg', '5ds7lu6522z', 0, '1984-07-13 04:00:08', '1997-05-11 23:00:10', 1, 'sit', 1),
(92, 'molestiae', 'Quaerat iure modi minus perspiciatis in debitis voluptas. Quasi voluptas molestias consectetur quia repellendus nisi sed. Ea est quo assumenda similique dolores assumenda dolore. Minima inventore facilis autem ratione dolor qui occaecati.', '5df4d529da510b0e5fe8b24441ba83cd.jpg', '0ov6wt4748w', 2, '2007-06-05 04:20:07', '2001-11-27 02:20:16', 0, 'adipisci', 1),
(93, 'est', 'Quasi omnis qui dolores provident quo. Nihil dolorum accusamus inventore dolorem corporis repellat. Ducimus dolorem expedita quis eligendi natus sit. Omnis dignissimos non est omnis sunt perspiciatis. Eos nesciunt cumque earum.', '0bf4628b223b275b6590eca52c249c5f.jpg', '4ap9ya3608q', 0, '2015-03-05 08:04:57', '1996-05-11 06:45:50', 1, 'error', 1),
(94, 'libero', 'Explicabo consequatur autem deserunt. Dolorem maiores magni quasi in earum. Aut quam tenetur eveniet ullam voluptatem.', '4d5647e0cde5994b00371699ad09be80.jpg', '5qo2gi5287v', 0, '1989-12-17 01:24:23', '1977-10-17 09:00:43', 0, 'libero', 1),
(95, 'ad', 'Eius dolorum doloremque nihil. Sint animi aut maiores. Quis officiis corrupti dolorem tempore tempore. Porro ipsam exercitationem non nostrum nihil exercitationem ab.', '1882c50c1a0cb48313662188a631a430.jpg', '8fn6zr7842t', 0, '2004-07-01 04:14:51', '1986-11-16 18:06:56', 1, 'quas', 2),
(96, 'in', 'Aperiam deleniti quaerat facilis commodi placeat hic. Accusamus tempora possimus ut dolores voluptatem illo. Tempora voluptatibus fugit nisi deserunt doloribus.', 'c1e49cb642fde7c1aa6b2de1e83616a5.jpg', '1wv7bm5564m', 1, '1973-01-22 04:00:34', '2017-04-18 13:01:22', 1, 'quis', 0),
(97, 'sed', 'Natus eius nulla quia velit illum. Exercitationem asperiores ut adipisci minus sapiente beatae. Et nihil nihil doloremque sed. Provident nihil quaerat accusamus exercitationem.', '17e4b3f52f236b5461f8ef5310662abf.jpg', '9ua5zd5143l', 0, '1991-06-08 00:07:22', '2009-02-11 17:05:57', 0, 'aliquam', 0),
(98, 'dolore', 'Nisi alias sunt accusamus eum cumque sunt totam. Molestiae eum iste aut vel. Similique corrupti beatae modi accusantium et et eligendi molestiae.', '89e79a9c742659dd1153ee0b8e6a0a9e.jpg', '5rg7ml3479y', 0, '2009-06-11 20:14:13', '1974-03-30 19:50:59', 1, 'at', 2),
(99, 'molestiae', 'Dolor ducimus modi velit officiis sequi dolores sint. Ex nihil omnis eveniet tempora dolore consequatur. Aspernatur explicabo et excepturi animi nihil ducimus.', '258995d4bfcb58f540f0ae0c808cc793.jpg', '8fe4sp0286u', 1, '2004-07-14 00:48:28', '1977-04-27 15:07:32', 1, 'qui', 1),
(100, 'ut', 'Fugit velit quidem non doloribus ducimus voluptatem explicabo quod. Accusantium accusantium minima minima fuga quia nam soluta blanditiis. Expedita recusandae qui tenetur laboriosam dolorem itaque delectus nisi. Impedit ut suscipit enim. Modi minima labore voluptas qui odio.', '142809a2422f7bbea00204200edf8bf3.jpg', '4sp1xd7347q', 0, '2005-08-10 22:32:39', '2019-11-22 00:09:41', 0, 'ipsa', 0);

-- --------------------------------------------------------

--
-- Table structure for table `content_event`
--

DROP TABLE IF EXISTS `content_event`;
CREATE TABLE `content_event` (
  `id` int(11) NOT NULL,
  `Acara` varchar(128) NOT NULL,
  `Deskripsi` text,
  `Lokasi` varchar(256) NOT NULL,
  `Peta_Lokasi` varchar(128) DEFAULT NULL,
  `Hari & Tanggal` date NOT NULL,
  `Waktu` time NOT NULL,
  `Status` int(1) NOT NULL DEFAULT '0' COMMENT '0: soon, 1: now, 2:past',
  `Poster` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `content_event`
--

INSERT INTO `content_event` (`id`, `Acara`, `Deskripsi`, `Lokasi`, `Peta_Lokasi`, `Hari & Tanggal`, `Waktu`, `Status`, `Poster`) VALUES
(1, 'Testing', 'Testing', 'Testing', NULL, '2020-01-09', '19:00:00', 0, NULL),
(2, 'Testing1', 'Testing1', 'Testing1', NULL, '2020-01-15', '19:00:00', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `img` varchar(128) NOT NULL DEFAULT 'default.png',
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `date_created` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `token` varchar(128) NOT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `address` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `img`, `password`, `role_id`, `date_created`, `status`, `token`, `phone_number`, `address`) VALUES
(0, 'Administrator', 'andreas.ardi1@gmail.com', 'd512e8f639439f8834419ffdea8e33c1.jpg', '$2y$10$YXQrgpv6lhlsvOWz/c/pduYUQLfpNXaLUdWqPj5h0ijtUi3lCysQy', 1, 1577535456, 1, '', '+62895380616287', 'Gebangan, Dagaran, Palbapang, Bantul  (55713)'),
(1, 'Andreas Ardi', 'andreotomo007@gmail.com', 'b7b60e7dad6fed55aaee1d764a82412b.jpg', '$2y$10$UWTGzARtu7.pW5us4ueH9OTe00.3KVhVbxQqF5J7R8Cd1UQQ0NQa.', 2, 1577601256, 1, '', '+6285868868256', 'Gebangan, Dagaran, Palbapang, Bantul'),
(2, 'Noer Pratomo', 'andreas.ardi@test.com', '4d7580a8ef4e38d4471a6735b2395d42.png', '$2y$10$qAeU2kppwOdV.U3cFAZTMOTx.1Uxsa/zvwfeAF7f9RQNtf33kb4B.', 2, 1577615449, 0, '', '085801563201', 'Gebangan, Dagaran, Palbapang, Bantul');

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

DROP TABLE IF EXISTS `user_access_menu`;
CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(3, 2, 2),
(6, 1, 3),
(10, 2, 6),
(11, 1, 6),
(12, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

DROP TABLE IF EXISTS `user_menu`;
CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL,
  `icon` varchar(64) NOT NULL DEFAULT 'fas fa-fw fa-cog'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`, `icon`) VALUES
(1, 'Home', 'fas fa-fw fa-cog'),
(2, 'User', 'fas fa-fw fa-user-circle'),
(3, 'Menu', 'fas fa-fw fa-folder'),
(6, 'Content', 'fas fa-fw fa-blog');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

DROP TABLE IF EXISTS `user_role`;
CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Admin'),
(2, 'Member');

-- --------------------------------------------------------

--
-- Table structure for table `user_status`
--

DROP TABLE IF EXISTS `user_status`;
CREATE TABLE `user_status` (
  `id` tinyint(1) NOT NULL,
  `status` char(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_status`
--

INSERT INTO `user_status` (`id`, `status`) VALUES
(0, 'offline'),
(1, 'online');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

DROP TABLE IF EXISTS `user_sub_menu`;
CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Home', 'dashboard/home', 'fas fa-fw fa-home', 1),
(3, 2, 'Profile Page', 'dashboard/user', 'fas fa-fw fa-user', 1),
(4, 3, 'Menu Management', 'dashboard/menu', 'fas fa-fw fa-folder', 1),
(5, 3, 'Sub Menu Management', 'dashboard/menu/submenu', 'fas fa-fw fa-folder-open', 1),
(11, 2, 'Change Password', 'dashboard/user/changepassword', 'fas fa-fw fa-key', 1),
(13, 1, 'User Management', 'dashboard/home/userman', 'fas fa-fw fa-users', 1),
(16, 6, 'Article', 'dashboard/content', 'fas fa-fw fa-blog', 1),
(17, 6, 'Event', 'dashboard/content/event', 'fas fa-fw fa-calendar-alt', 1),
(18, 6, 'Renungan', 'dashboard/content/renungan', 'fas fa-fw fa-cross', 1),
(19, 1, 'Site Settings', 'dashboard/home/settings', 'fas fa-fw fa-cogs', 1),
(20, 6, 'Page', 'dashboard/content/page', 'fas fa-fw fa-file', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `content_article`
--
ALTER TABLE `content_article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `content_event`
--
ALTER TABLE `content_event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_status`
--
ALTER TABLE `user_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `content_article`
--
ALTER TABLE `content_article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `content_event`
--
ALTER TABLE `content_event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_status`
--
ALTER TABLE `user_status`
  MODIFY `id` tinyint(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;
