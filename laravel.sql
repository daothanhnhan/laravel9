-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th9 25, 2025 lúc 06:37 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `laravel`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `phone` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `note` text DEFAULT NULL,
  `note_cart` text DEFAULT NULL,
  `state` int(11) NOT NULL DEFAULT 0,
  `creator_id` int(11) NOT NULL DEFAULT 0,
  `total_price` bigint(20) NOT NULL DEFAULT 0,
  `total_item` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `carts`
--

INSERT INTO `carts` (`id`, `name`, `email`, `phone`, `address`, `note`, `note_cart`, `state`, `creator_id`, `total_price`, `total_item`, `created_at`, `updated_at`) VALUES
(1, 'Tuấn', 'truongquangtuan3110@gmail.com', '0987654321', 'Hà Nội', 'test', NULL, 1, 0, 24698, 1, '2025-09-25 04:31:51', '2025-09-25 04:31:51');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart_items`
--

CREATE TABLE `cart_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cart_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL DEFAULT 0,
  `product_price` bigint(20) NOT NULL DEFAULT 0,
  `product_quantity` int(11) NOT NULL DEFAULT 0,
  `product_price_total` bigint(20) NOT NULL DEFAULT 0,
  `color` text DEFAULT NULL,
  `size` text DEFAULT NULL,
  `info_1` text DEFAULT NULL,
  `info_2` text DEFAULT NULL,
  `info_3` text DEFAULT NULL,
  `info_4` text DEFAULT NULL,
  `info_5` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `cart_items`
--

INSERT INTO `cart_items` (`id`, `cart_id`, `product_id`, `product_price`, `product_quantity`, `product_price_total`, `color`, `size`, `info_1`, `info_2`, `info_3`, `info_4`, `info_5`, `created_at`, `updated_at`) VALUES
(1, 1, 9, 12349, 2, 24698, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-09-25 04:31:51', '2025-09-25 04:31:51');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `configs`
--

CREATE TABLE `configs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `keyword` text DEFAULT NULL,
  `intro` text DEFAULT NULL,
  `logo` text DEFAULT NULL,
  `icon` text DEFAULT NULL,
  `banner_1` text DEFAULT NULL,
  `banner_2` text DEFAULT NULL,
  `banner_3` text DEFAULT NULL,
  `banner_4` text DEFAULT NULL,
  `banner_5` text DEFAULT NULL,
  `content_home_1` text DEFAULT NULL,
  `content_home_2` text DEFAULT NULL,
  `content_home_3` text DEFAULT NULL,
  `content_home_4` text DEFAULT NULL,
  `content_home_5` text DEFAULT NULL,
  `content_home_6` text DEFAULT NULL,
  `content_home_7` text DEFAULT NULL,
  `content_home_8` text DEFAULT NULL,
  `content_home_9` text DEFAULT NULL,
  `content_home_10` text DEFAULT NULL,
  `embed_code_header` text DEFAULT NULL,
  `embed_code_footer` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `configs`
--

INSERT INTO `configs` (`id`, `title`, `description`, `keyword`, `intro`, `logo`, `icon`, `banner_1`, `banner_2`, `banner_3`, `banner_4`, `banner_5`, `content_home_1`, `content_home_2`, `content_home_3`, `content_home_4`, `content_home_5`, `content_home_6`, `content_home_7`, `content_home_8`, `content_home_9`, `content_home_10`, `embed_code_header`, `embed_code_footer`, `created_at`, `updated_at`) VALUES
(1, 'Sneaker', 'VỀ SNEAKER Sứ mệnh của chúng tôi là tạo ra một môi trường học có thể đem lại ảnh hưởng tích cực, niềm vui, tình yêu và sự phát triển toàn diện cho học sinh. Bên cạnh các kiến thức chuyên môn, học sinh tại American Skills được bồi dưỡng nhân cách, phát triển sự tự tin, kỹ năng sống là bước đệm quan trọng, cần thiết cho sự thành công của các em trong tương lai.', 'Giầy thể thao', 'VỀ SNEAKER Sứ mệnh của chúng tôi là tạo ra một môi trường học có thể đem lại ảnh hưởng tích cực, niềm vui, tình yêu và sự phát triển toàn diện cho học sinh. Bên cạnh các kiến thức chuyên môn, học sinh tại American Skills được bồi dưỡng nhân cách, phát triển sự tự tin, kỹ năng sống là bước đệm quan trọng, cần thiết cho sự thành công của các em trong tương lai.', 'logo.png', 'logo.png', 'banner1.jpg', 'banner2.jpg', 'banner3.jpg', '', '', 'Thượng Đình, Thanh Xuân, Hà Nội', '2', '3', 'tuan@gmail.com', '55', '6', '0987654321', '8', '99', '0', '<meta name=\"tuan\" content=\"header\" />', '<meta name=\"tuan\" content=\"footer\" />', NULL, '2025-09-22 01:35:57');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `phone` text DEFAULT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `name` text DEFAULT NULL,
  `type` text DEFAULT NULL,
  `type_id` int(11) NOT NULL DEFAULT 0,
  `link` text DEFAULT NULL,
  `sort` int(11) NOT NULL DEFAULT 0,
  `state` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `menus`
--

INSERT INTO `menus` (`id`, `parent_id`, `name`, `type`, `type_id`, `link`, `sort`, `state`, `created_at`, `updated_at`) VALUES
(1, 0, 'Về chúng tôi', 'pages', 3, NULL, 2, 1, '2025-09-19 08:22:50', '2025-09-22 08:17:49'),
(2, 0, 'Sản phẩm', 'menu_specials', 3, NULL, 3, 1, '2025-09-19 09:33:25', '2025-09-22 01:42:06'),
(3, 0, 'Trang chủ', 'menu_specials', 1, NULL, 1, 1, '2025-09-19 09:37:11', '2025-09-22 01:42:06'),
(4, 0, 'Tư vấn', 'pages', 4, NULL, 4, 1, '2025-09-22 01:39:29', '2025-09-22 08:22:33'),
(5, 0, 'Tin tức sự kiện', 'menu_specials', 2, NULL, 5, 1, '2025-09-22 01:39:46', '2025-09-22 08:22:55'),
(6, 0, 'Liên hệ', 'menu_specials', 4, NULL, 6, 1, '2025-09-22 01:39:57', '2025-09-22 08:23:13'),
(7, 2, 'Adidas', 'product_cats', 1, NULL, 1, 1, '2025-09-22 01:40:52', '2025-09-22 08:21:00'),
(8, 2, 'Nike', 'product_cats', 2, NULL, 2, 1, '2025-09-22 01:41:01', '2025-09-22 08:21:28'),
(9, 2, 'Thương hiệu khác', 'product_cats', 3, NULL, 3, 1, '2025-09-22 01:41:15', '2025-09-22 08:21:46'),
(10, 2, 'Sale off', '0', 0, 'sale', 4, 1, '2025-09-22 01:41:36', '2025-09-22 08:22:13');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `menu_specials`
--

CREATE TABLE `menu_specials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text DEFAULT NULL,
  `link` text DEFAULT NULL,
  `state` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `menu_specials`
--

INSERT INTO `menu_specials` (`id`, `name`, `link`, `state`, `created_at`, `updated_at`) VALUES
(1, 'Trang chủ', '/', 1, NULL, NULL),
(2, 'Tất cả tin tức', '/tat-ca-tin-tuc', 1, NULL, NULL),
(3, 'Tất cả sản phẩm', '/tat-ca-san-pham', 1, NULL, NULL),
(4, 'Liên hệ', '/lien-he', 1, NULL, NULL),
(5, 'Đăng ký', '/dang-ky', 0, NULL, NULL),
(6, 'Đăng nhập', '/dang-nhap', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `menu_types`
--

CREATE TABLE `menu_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text DEFAULT NULL,
  `type` text DEFAULT NULL,
  `model` text DEFAULT NULL,
  `state` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `menu_types`
--

INSERT INTO `menu_types` (`id`, `name`, `type`, `model`, `state`, `created_at`, `updated_at`) VALUES
(1, 'Trang', 'pages', 'Page', 1, NULL, NULL),
(2, 'Danh mục tin tức', 'news_cats', 'NewsCat', 1, NULL, NULL),
(3, 'Tin tức', 'posts', 'Post', 1, NULL, NULL),
(4, 'Danh mục sản phẩm', 'product_cats', 'ProductCat', 1, NULL, NULL),
(5, 'Sản phẩm', 'products', 'Product', 1, NULL, NULL),
(6, 'Khác', 'menu_specials', 'MenuSpecial', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_04_29_084656_create_news_table', 1),
(10, '2025_04_29_090207_edit_news_table', 2),
(11, '2025_09_11_043738_create_slides_table', 3),
(12, '2025_09_13_035255_create_pages_table', 4),
(13, '2025_09_15_143955_create_news_cats_table', 5),
(14, '2025_09_16_105541_create_posts_table', 6),
(15, '2025_09_17_155234_create_product_cats_table', 7),
(16, '2025_09_18_085003_create_products_table', 8),
(17, '2025_09_18_143950_create_videos_table', 9),
(18, '2025_09_18_153939_create_menus_table', 10),
(19, '2025_09_19_071115_create_menu_types_table', 11),
(20, '2025_09_19_073440_create_menu_specials_table', 12),
(21, '2025_09_20_083812_create_configs_table', 13),
(22, '2025_09_24_103859_create_contacts_table', 14),
(23, '2025_09_25_104220_create_carts_table', 15),
(24, '2025_09_25_105009_create_cart_items_table', 16);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `news`
--

CREATE TABLE `news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `news`
--

INSERT INTO `news` (`id`, `title`, `email`, `created_at`, `updated_at`, `description`) VALUES
(2, 'Nelson Walsh Jr.', 'adele.bode@gmail.com', '2025-05-04 20:55:27', '2025-05-04 20:55:27', 'Et sapiente quis cumque praesentium quasi quis quae aut eos velit quisquam quo rerum.'),
(3, 'Dr. Mckenna Kohler IV', 'mavis.rau@lueilwitz.com', '2025-05-04 20:55:27', '2025-05-04 20:55:27', 'Hic ut veritatis labore quasi et repellendus expedita et rem molestias voluptates earum odio sunt natus iure impedit nesciunt est impedit.'),
(4, 'Mrs. Nora Harris', 'frederick93@gmail.com', '2025-05-04 20:55:27', '2025-05-04 20:55:27', 'Esse ut voluptas voluptatem quas eveniet assumenda quis similique sit et.'),
(5, 'Winston Hackett', 'jennings.greenfelder@koelpin.biz', '2025-05-04 20:55:27', '2025-05-04 20:55:27', 'Et mollitia beatae fugiat aut dolores asperiores magnam commodi voluptatum in nam.'),
(6, 'Ms. Madonna Cruickshank', 'ymorissette@conroy.biz', '2025-05-04 20:55:27', '2025-05-04 20:55:27', 'Commodi facilis pariatur occaecati est sed et optio tenetur qui.'),
(7, 'Prof. Scot Gusikowski', 'jany14@gmail.com', '2025-05-04 20:55:27', '2025-05-04 20:55:27', 'Non ut modi et quis magni quo qui et sapiente quidem omnis.'),
(8, 'Annette Block', 'marguerite.reilly@lakin.com', '2025-05-04 20:55:27', '2025-05-04 20:55:27', 'Magnam facere dolorum dolor blanditiis maiores sapiente dolores accusamus aut aut unde sed sint.'),
(9, 'Jalon Rogahn', 'armstrong.timmy@pagac.com', '2025-05-04 20:55:27', '2025-05-04 20:55:27', 'Aut odit in et sit fuga nam necessitatibus natus vero dignissimos tenetur distinctio omnis quia facere voluptas id est voluptate inventore soluta.'),
(10, 'Caterina Mraz', 'dolson@yahoo.com', '2025-05-04 20:55:27', '2025-05-04 20:55:27', 'Recusandae iste veniam eveniet temporibus et impedit doloribus omnis ipsum id ipsum accusantium est fuga repellendus natus facilis nemo odit rem.'),
(11, 'Tuấn', 'tuan@gmail.com', '2025-05-09 22:00:28', '2025-05-09 22:02:22', 'Mô tả nội dung tin tức');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `news_cats`
--

CREATE TABLE `news_cats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` text DEFAULT NULL,
  `title` text DEFAULT NULL,
  `slug` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `keyword` text DEFAULT NULL,
  `title_seo` text DEFAULT NULL,
  `des_seo` text DEFAULT NULL,
  `state` int(11) NOT NULL DEFAULT 0,
  `sort` int(11) NOT NULL DEFAULT 0,
  `creator_id` int(11) NOT NULL DEFAULT 0,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `info_1` text DEFAULT NULL,
  `info_2` text DEFAULT NULL,
  `info_3` text DEFAULT NULL,
  `info_4` text DEFAULT NULL,
  `info_5` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `news_cats`
--

INSERT INTO `news_cats` (`id`, `image`, `title`, `slug`, `description`, `content`, `keyword`, `title_seo`, `des_seo`, `state`, `sort`, `creator_id`, `parent_id`, `info_1`, `info_2`, `info_3`, `info_4`, `info_5`, `created_at`, `updated_at`) VALUES
(1, 'host.png', 'Nước hoa tổng hợp', 'nuoc-hoa-tong-hop', 'Mô tả a', '<p>Nội dung a</p>', 'ab', 'Nước hoa tổng hợp', 'seo a', 1, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, '2025-09-16 02:08:41', '2025-09-22 07:49:43'),
(3, '', 'Nước hoa nam', 'nuoc-hoa-nam', NULL, NULL, NULL, 'Nước hoa nam', NULL, 1, 0, 1, 1, NULL, NULL, NULL, NULL, NULL, '2025-09-22 07:50:03', '2025-09-22 07:50:03'),
(4, '', 'Nước hoa nữ', 'nuoc-hoa-nu', NULL, NULL, NULL, 'Nước hoa nữ', NULL, 1, 0, 1, 3, NULL, NULL, NULL, NULL, NULL, '2025-09-22 07:50:17', '2025-09-22 07:50:17');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` text DEFAULT NULL,
  `title` text DEFAULT NULL,
  `slug` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `keyword` text DEFAULT NULL,
  `title_seo` text DEFAULT NULL,
  `des_seo` text DEFAULT NULL,
  `state` int(11) NOT NULL DEFAULT 0,
  `creator_id` int(11) NOT NULL DEFAULT 0,
  `info_1` text DEFAULT NULL,
  `info_2` text DEFAULT NULL,
  `info_3` text DEFAULT NULL,
  `info_4` text DEFAULT NULL,
  `info_5` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `pages`
--

INSERT INTO `pages` (`id`, `image`, `title`, `slug`, `description`, `content`, `keyword`, `title_seo`, `des_seo`, `state`, `creator_id`, `info_1`, `info_2`, `info_3`, `info_4`, `info_5`, `created_at`, `updated_at`) VALUES
(3, '', 'Giới thiệu', 'gioi-thieu', NULL, '<h1>C&Aacute;CH THỨC THANH TO&Aacute;N</h1>\r\n\r\n<p><img alt=\"\" src=\"http://hanoistudio.thietkewebsitegbvn.com/images/thanhtoan/1.png\" /></p>\r\n\r\n<h2>THANH TO&Aacute;N COD: NHẬN H&Agrave;NG V&Agrave; THANH TO&Aacute;N TIỀN MẶT</h2>\r\n\r\n<p>Khi qu&yacute; kh&aacute;ch y&ecirc;u cầu h&igrave;nh thức thanh to&aacute;n COD tức nhận h&agrave;ng v&agrave; thanh to&aacute;n tiền mặt, Qu&yacute; kh&aacute;ch vui l&ograve;ng lưu &yacute; những quy định sau:</p>\r\n\r\n<p>- Đối với c&aacute;c sản phẩm được giao h&agrave;ng bởi nh&acirc;n vi&ecirc;n c&ocirc;ng ty, Qu&yacute; kh&aacute;ch vui l&ograve;ng thanh to&aacute;n đầy đủ sau khi nh&acirc;n vi&ecirc;n đ&atilde; giao h&agrave;ng cho Qu&yacute; kh&aacute;ch. Nếu cần hỗ trợ hướng dẫn sử dụng, hoặc kiểm tra m&aacute;y m&oacute;c, thiết bị ch&uacute;ng t&ocirc;i sẵn s&agrave;ng hỗ trợ ngay tại chỗ.&nbsp;<br />\r\n- Đối với h&agrave;ng h&oacute;a được gởi theo đường bưu điện hoặc dịch vụ chuyển ph&aacute;t nhanh. Qu&yacute; kh&aacute;ch vui l&ograve;ng thanh to&aacute;n trước cho nh&acirc;n vi&ecirc;n giao h&agrave;ng rồi mới b&oacute;c mở h&agrave;ng h&oacute;a (Đ&acirc;y l&agrave; quy định bắt buộc của đơn vị vận chuyển). Sau khi b&oacute;c mở h&agrave;ng h&oacute;a, nếu Qu&yacute; kh&aacute;ch cần th&ecirc;m hỗ trợ g&igrave;, Qu&yacute; kh&aacute;ch vui l&ograve;ng li&ecirc;n hệ với c&ocirc;ng ty ch&uacute;ng t&ocirc;i.</p>\r\n\r\n<h2>2. THANH TO&Aacute;N QUA NH&Agrave; XE, ĐƠN VỊ CHUYỂN PH&Aacute;T</h2>\r\n\r\n<p>Đối với c&aacute;c tỉnh ở xa khu vực th&agrave;nh phố Hồ Ch&iacute; Minh hay H&agrave; Nội. Ch&uacute;ng t&ocirc;i thường lựa chọn phương thức vận chuyển bằng xe kh&aacute;ch hoặc ch&agrave;nh xe vận chuyển. Điều n&agrave;y l&agrave;m giảm chi ph&iacute; vận chuyển đ&aacute;ng kể cho kh&aacute;ch h&agrave;ng. V&igrave; những sản phẩm c&oacute; k&iacute;ch thước hoặc trọng lượng lớn gần như kh&ocirc;ng thể gởi bưu điện hoặc c&oacute; gởi cước ph&iacute; sẽ rất cao. Do đ&oacute; Qu&yacute; kh&aacute;ch lưu &yacute; một số vấn đề sau đ&acirc;y:</p>\r\n\r\n<p>- C&ocirc;ng ty sẽ &aacute;p dụng ch&iacute;nh s&aacute;ch nh&agrave; xe thu tiền hộ c&ocirc;ng ty. Do đ&oacute; nếu được y&ecirc;u cầu thu hộ, Qu&yacute; kh&aacute;ch vui l&ograve;ng chuẩn bị tiền thanh to&aacute;n trực tiếp cho nh&agrave; xe hoặc đơn vị vận chuyển do c&ocirc;ng ty y&ecirc;u cầu.&nbsp;<br />\r\n- Đối với c&aacute;c sản phẩm c&oacute; trọng lượng lớn v&agrave; kỹ thuật sử dụng phức tạp, Qu&yacute; kh&aacute;ch c&oacute; thể y&ecirc;u cầu nh&acirc;n vi&ecirc;n c&ocirc;ng ty đến tận nh&agrave; lắp đặt. V&agrave; sẽ thanh to&aacute;n cho nh&acirc;n vi&ecirc;n giao h&agrave;ng hoặc nh&acirc;n vi&ecirc;n lắp đặt t&ugrave;y theo th&ocirc;ng b&aacute;o của c&ocirc;ng ty.</p>\r\n\r\n<h2>3. THANH TO&Aacute;N TẠI C&Ocirc;NG TY</h2>\r\n\r\n<p>Qu&yacute; kh&aacute;ch mua h&agrave;ng c&oacute; thể đến địa chỉ c&ocirc;ng ty để xem h&agrave;ng v&agrave; mua h&agrave;ng:</p>\r\n\r\n<p>167 - 169 B&igrave;nh Lợi (Nơ Trang Long nối d&agrave;i), P. 13, Quận B&igrave;nh Thạnh, Tp. Hồ Ch&iacute; Minh .</p>\r\n\r\n<h2>4. THANH TO&Aacute;N C&Ocirc;NG NỢ</h2>\r\n\r\n<p>Đối với c&aacute;c c&ocirc;ng ty đề nghị thanh to&aacute;n c&ocirc;ng nợ, hai b&ecirc;n cần x&aacute;c nhận đơn đặt h&agrave;ng v&agrave; thời gian c&ocirc;ng nợ hoặc gởi PO đặt h&agrave;ng qua Email: Hotrospro@gmail.com. C&ocirc;ng ty sẽ xem x&eacute;t c&aacute;c trường hợp cụ thể v&agrave; th&ocirc;ng b&aacute;o đến kh&aacute;ch h&agrave;ng về việc c&oacute; chấp nhận c&ocirc;ng nợ hay kh&ocirc;ng.&nbsp;<br />\r\nLi&ecirc;n hệ trực tiếp qua số điện thoại: 0283 5 534 298 hoặc 0986 954 423</p>\r\n\r\n<h2>5. THANH TO&Aacute;N CHUYỂN KHOẢN</h2>\r\n\r\n<p><img alt=\"\" src=\"http://hanoistudio.thietkewebsitegbvn.com/images/thanhtoan/2.jpg\" /></p>\r\n\r\n<p>Qu&yacute; Kh&aacute;ch vui l&ograve;ng chuyển tiền v&agrave;o một trong c&aacute;c t&agrave;i khoản sau:</p>\r\n\r\n<ul>\r\n	<li>Chủ t&agrave;i khoản: C&ocirc;ng ty TNHH C&ocirc;ng Nghiệp v&agrave; Thương Mại Nam Việt&nbsp;<br />\r\n	- Số TK: 060059386363&nbsp;<br />\r\n	- Tại NH Sacombank - PGD Phan Đăng Lưu - Chi nh&aacute;nh 8/3&nbsp;</li>\r\n	<li>Chủ TK: CT TNHH C&ocirc;ng Nghiệp v&agrave; TM Nam Việt&nbsp;<br />\r\n	- Số TK: 0531002529891&nbsp;<br />\r\n	- Tại NH Vietcombank - Chi nh&aacute;nh Đ&ocirc;ng S&agrave;i G&ograve;n&nbsp;</li>\r\n	<li>Chủ TK: C&ocirc;ng ty TNHH C&ocirc;ng Nghiệp v&agrave; Thương Mại Nam Việt - Số TK: 19026579068019 - Tại NH Techcombank - Chi nh&aacute;nh Nguyễn Th&aacute;i Sơn</li>\r\n</ul>', 'Giầy thể thao', 'Giới thiệu', 'Giới thiệu giầy thể thao', 1, 1, NULL, NULL, NULL, NULL, NULL, '2025-09-22 07:47:07', '2025-09-22 07:47:07'),
(4, '', 'Tư vấn', 'tu-van', NULL, NULL, NULL, 'Tư vấn', NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2025-09-22 07:47:45', '2025-09-22 07:47:45'),
(5, '', 'Hàng đặt trước', 'hang-dat-truoc', NULL, NULL, NULL, 'Hàng đặt trước', NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, '2025-09-22 07:48:28', '2025-09-24 01:55:49');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` text DEFAULT NULL,
  `title` text DEFAULT NULL,
  `slug` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `keyword` text DEFAULT NULL,
  `title_seo` text DEFAULT NULL,
  `des_seo` text DEFAULT NULL,
  `state` int(11) NOT NULL DEFAULT 0,
  `creator_id` int(11) NOT NULL DEFAULT 0,
  `newscat_id` text DEFAULT NULL,
  `sort` int(11) NOT NULL DEFAULT 0,
  `views` int(11) NOT NULL DEFAULT 0,
  `info_1` longtext DEFAULT NULL,
  `info_2` longtext DEFAULT NULL,
  `info_3` longtext DEFAULT NULL,
  `info_4` longtext DEFAULT NULL,
  `info_5` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `posts`
--

INSERT INTO `posts` (`id`, `image`, `title`, `slug`, `description`, `content`, `keyword`, `title_seo`, `des_seo`, `state`, `creator_id`, `newscat_id`, `sort`, `views`, `info_1`, `info_2`, `info_3`, `info_4`, `info_5`, `created_at`, `updated_at`) VALUES
(1, 'banner2.jpg', 'Tin tức một', 'tin-tuc-mot', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s</p>', 'ab', 'Tin tức một', 'seo a', 1, 1, '[\"1\"]', 0, 0, NULL, NULL, NULL, NULL, NULL, '2025-09-17 04:09:59', '2025-09-22 07:51:50'),
(2, 'image-1-770x550.jpg', 'Tin tức hai', 'tin-tuc-hai', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s</p>', NULL, 'Tin tức hai', NULL, 1, 1, '[\"3\"]', 0, 0, NULL, NULL, NULL, NULL, NULL, '2025-09-22 07:52:16', '2025-09-22 07:52:16'),
(3, 'image-2-770x550.jpg', 'Tin tức ba', 'tin-tuc-ba', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s</p>', NULL, 'Tin tức ba', NULL, 1, 1, '[\"4\"]', 0, 0, NULL, NULL, NULL, NULL, NULL, '2025-09-22 07:52:57', '2025-09-22 07:52:57'),
(4, 'image-3-770x550.jpg', 'Tin tức bốn', 'tin-tuc-bon', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s</p>', NULL, 'Tin tức bốn', NULL, 1, 1, '[]', 0, 0, NULL, NULL, NULL, NULL, NULL, '2025-09-22 07:53:23', '2025-09-24 02:53:31');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` text DEFAULT NULL,
  `image_sub` text DEFAULT NULL,
  `title` text DEFAULT NULL,
  `slug` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `price` bigint(20) NOT NULL DEFAULT 0,
  `price_sale` bigint(20) NOT NULL DEFAULT 0,
  `product_code` text DEFAULT NULL,
  `product_shape` text DEFAULT NULL,
  `product_size` text DEFAULT NULL,
  `product_brand` text DEFAULT NULL,
  `product_origin` text DEFAULT NULL,
  `product_text_1` text DEFAULT NULL,
  `product_text_2` text DEFAULT NULL,
  `product_text_3` text DEFAULT NULL,
  `product_text_4` text DEFAULT NULL,
  `product_text_5` text DEFAULT NULL,
  `product_text_6` text DEFAULT NULL,
  `keyword` text DEFAULT NULL,
  `title_seo` text DEFAULT NULL,
  `des_seo` text DEFAULT NULL,
  `state` int(11) NOT NULL DEFAULT 0,
  `product_new` int(11) NOT NULL DEFAULT 0,
  `product_hot` int(11) NOT NULL DEFAULT 0,
  `creator_id` int(11) NOT NULL DEFAULT 0,
  `productcat_id` text DEFAULT NULL,
  `sort` int(11) NOT NULL DEFAULT 0,
  `views` int(11) NOT NULL DEFAULT 0,
  `info_1` longtext DEFAULT NULL,
  `info_2` longtext DEFAULT NULL,
  `info_3` longtext DEFAULT NULL,
  `info_4` longtext DEFAULT NULL,
  `info_5` longtext DEFAULT NULL,
  `info_6` longtext DEFAULT NULL,
  `info_7` longtext DEFAULT NULL,
  `info_8` longtext DEFAULT NULL,
  `info_9` longtext DEFAULT NULL,
  `info_10` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `image`, `image_sub`, `title`, `slug`, `description`, `content`, `price`, `price_sale`, `product_code`, `product_shape`, `product_size`, `product_brand`, `product_origin`, `product_text_1`, `product_text_2`, `product_text_3`, `product_text_4`, `product_text_5`, `product_text_6`, `keyword`, `title_seo`, `des_seo`, `state`, `product_new`, `product_hot`, `creator_id`, `productcat_id`, `sort`, `views`, `info_1`, `info_2`, `info_3`, `info_4`, `info_5`, `info_6`, `info_7`, `info_8`, `info_9`, `info_10`, `created_at`, `updated_at`) VALUES
(1, 'product1.jpg', '[\"product2.jpg\",\"product3.jpg\",\"product4.jpg\",\"product5.jpg\"]', 'Sản phẩm một', 'san-pham-mot', '<p>M&ocirc; tả a</p>', '<p>Nội dung a</p>', 12349, 45679, 'Mã a', 'Kiểu a', '1,2,3', 'Hiệu a', 'Xuấ a', '1', NULL, NULL, NULL, NULL, NULL, 'ab', 'Sản phẩm b', 'seo a', 1, 1, 1, 1, '[\"1\"]', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-09-18 04:33:18', '2025-09-22 07:57:25'),
(2, 'product2.jpg', '[]', 'Sản phẩm & hai', 'san-pham-hai', '<p>M&ocirc; tả a</p>', '<p>Nội dung a</p>', 12349, 45679, 'Mã a', 'Kiểu a', '1,2,3', 'Hiệu a', 'Xuấ a', '1', NULL, NULL, NULL, NULL, NULL, 'ab', 'Sản phẩm b', 'seo a', 1, 1, 1, 1, '[\"1\"]', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-09-18 07:32:54', '2025-09-22 07:58:30'),
(3, 'product3.jpg', '[\"product2.jpg\",\"product3.jpg\",\"product4.jpg\",\"product5.jpg\"]', 'Sản phẩm ba', 'san-pham-ba', '<p>M&ocirc; tả a</p>', '<p>Nội dung a</p>', 12349, 45679, 'Mã a', 'Kiểu a', '1,2,3', 'Hiệu a', 'Xuấ a', '1', NULL, NULL, NULL, NULL, NULL, 'ab', 'Sản phẩm ba', 'seo a', 1, 1, 1, 1, '[\"1\"]', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-09-22 08:04:11', '2025-09-22 08:29:09'),
(4, 'product4.jpg', '[\"product2.jpg\",\"product3.jpg\",\"product4.jpg\",\"product5.jpg\"]', 'Sản phẩm bốn', 'san-pham-bon', '<p>M&ocirc; tả a</p>', '<p>Nội dung a</p>', 12349, 45679, 'Mã a', 'Kiểu a', '1,2,3', 'Hiệu a', 'Xuấ a', '1', NULL, NULL, NULL, NULL, NULL, 'ab', 'Sản phẩm bốn', 'seo a', 1, 1, 1, 1, '[\"1\"]', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-09-22 08:04:50', '2025-09-22 08:29:25'),
(5, 'product5.jpg', '[\"product2.jpg\",\"product3.jpg\",\"product4.jpg\",\"product5.jpg\"]', 'Sản phẩm năm', 'san-pham-nam', '<p>M&ocirc; tả a</p>', '<p>Nội dung a</p>', 12349, 45679, 'Mã a', 'Kiểu a', '1,2,3', 'Hiệu a', 'Xuấ a', '1', NULL, NULL, NULL, NULL, NULL, 'ab', 'Sản phẩm năm', 'seo a', 1, 1, 1, 1, '[\"1\"]', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-09-22 08:05:15', '2025-09-22 08:29:55'),
(6, 'product6.jpg', '[\"product2.jpg\",\"product3.jpg\",\"product4.jpg\",\"product5.jpg\"]', 'Sản phẩm sáu', 'san-pham-sau', '<p>M&ocirc; tả a</p>', '<p>Nội dung a</p>', 12349, 45679, 'Mã a', 'Kiểu a', '1,2,3', 'Hiệu a', 'Xuấ a', '1', NULL, NULL, NULL, NULL, NULL, 'ab', 'Sản phẩm sáu', 'seo a', 1, 1, 1, 1, '[\"1\",\"2\",\"3\"]', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-09-22 08:05:44', '2025-09-22 08:30:17'),
(7, 'product7.jpg', '[\"product2.jpg\",\"product3.jpg\",\"product4.jpg\",\"product5.jpg\"]', 'Sản phẩm bảy', 'san-pham-bay', '<p>M&ocirc; tả a</p>', '<p>Nội dung a</p>', 12349, 45679, 'Mã a', 'Kiểu a', '1,2,3', 'Hiệu a', 'Xuấ a', '1', NULL, NULL, NULL, NULL, NULL, 'ab', 'Sản phẩm bảy', 'seo a', 1, 1, 1, 1, '[\"1\",\"3\"]', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-09-22 08:06:11', '2025-09-22 08:30:34'),
(8, 'product8.jpg', '[\"product2.jpg\",\"product3.jpg\",\"product4.jpg\",\"product5.jpg\"]', 'Sản phẩm Tám', 'san-pham-tam', '<p>M&ocirc; tả a</p>', '<p>Nội dung a</p>', 12349, 45679, 'Mã a', 'Kiểu a', '1,2,3', 'Hiệu a', 'Xuấ a', '1', NULL, NULL, NULL, NULL, NULL, 'ab', 'Sản phẩm tám', 'seo a', 1, 1, 1, 1, '[\"3\"]', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-09-22 08:06:37', '2025-09-22 08:30:50'),
(9, 'product1.jpg', '[\"product2.jpg\",\"product3.jpg\",\"product4.jpg\",\"product5.jpg\"]', 'Sản phẩm chín', 'san-pham-chin', '<p>M&ocirc; tả a</p>', '<p>Nội dung a</p>', 12349, 0, 'Mã a', 'Kiểu a', '1,2,3', 'Hiệu a', 'Xuấ a', '1', NULL, NULL, NULL, NULL, NULL, 'ab', 'Sản phẩm chín', 'seo a', 1, 1, 1, 1, '[\"3\"]', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-09-22 08:07:04', '2025-09-24 02:07:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_cats`
--

CREATE TABLE `product_cats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` text DEFAULT NULL,
  `title` text DEFAULT NULL,
  `slug` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `keyword` text DEFAULT NULL,
  `title_seo` text DEFAULT NULL,
  `des_seo` text DEFAULT NULL,
  `state` int(11) NOT NULL DEFAULT 0,
  `sort` int(11) NOT NULL DEFAULT 0,
  `creator_id` int(11) NOT NULL DEFAULT 0,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `info_1` longtext DEFAULT NULL,
  `info_2` longtext DEFAULT NULL,
  `info_3` longtext DEFAULT NULL,
  `info_4` longtext DEFAULT NULL,
  `info_5` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_cats`
--

INSERT INTO `product_cats` (`id`, `image`, `title`, `slug`, `description`, `content`, `keyword`, `title_seo`, `des_seo`, `state`, `sort`, `creator_id`, `parent_id`, `info_1`, `info_2`, `info_3`, `info_4`, `info_5`, `created_at`, `updated_at`) VALUES
(1, 'truong-quang-tuan.png', 'Adidas', 'adidas', 'Mô tả a', '<p>Nội dung a</p>', 'ab', 'Sản phẩm cat b', 'seo a', 1, 2, 1, 0, NULL, NULL, NULL, NULL, NULL, '2025-09-18 01:32:27', '2025-09-22 07:54:18'),
(2, '', 'Nike', 'nike', NULL, NULL, NULL, 'Nike', NULL, 1, 0, 1, 1, NULL, NULL, NULL, NULL, NULL, '2025-09-22 07:54:35', '2025-09-22 07:54:35'),
(3, '', 'Thương hiệu khác', 'thuong-hieu-khac', NULL, NULL, NULL, 'Thương hiệu khác', NULL, 1, 0, 1, 2, NULL, NULL, NULL, NULL, NULL, '2025-09-22 07:54:51', '2025-09-22 07:54:51');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `slides`
--

CREATE TABLE `slides` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` text DEFAULT NULL,
  `sort` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `slides`
--

INSERT INTO `slides` (`id`, `image`, `sort`, `created_at`, `updated_at`) VALUES
(1, 'slide2.jpg', 1, '2025-09-12 19:16:30', '2025-09-13 04:37:27'),
(3, 'slide3.jpg', 0, '2025-09-22 07:44:43', '2025-09-22 07:44:43');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'tuan@gmail.com', NULL, '$2y$10$djL37ZTdTBCp6dBVdTzn/u93TK.9Y9MK0I7F9kZETngEpNDZI5MdW', NULL, '2025-09-09 00:14:13', '2025-09-09 00:14:13');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `videos`
--

CREATE TABLE `videos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` text DEFAULT NULL,
  `content` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `videos`
--

INSERT INTO `videos` (`id`, `image`, `content`, `created_at`, `updated_at`) VALUES
(1, 'product1.jpg', '<iframe width=\"724\" height=\"407\" src=\"https://www.youtube.com/embed/w-6BkMOubkY?list=RDw-6BkMOubkY\" title=\"Mashup Nhạc Trẻ 8x 9x Bất Hủ Hay Vượt Thời Gian ♫ Mashup Nhạc Xưa 8x 9x Hay Nhất - Không Quảng Cáo\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', '2025-09-18 08:21:04', '2025-09-22 08:25:34'),
(2, 'product2.jpg', '<iframe width=\"724\" height=\"407\" src=\"https://www.youtube.com/embed/Hu_AtRQONw4\" title=\"Em Gái Mưa - Hương Tràm | Live at Soul of The Forest\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', '2025-09-22 08:28:08', '2025-09-22 08:28:08'),
(3, 'product3.jpg', '<iframe width=\"724\" height=\"407\" src=\"https://www.youtube.com/embed/Hu_AtRQONw4\" title=\"Em Gái Mưa - Hương Tràm | Live at Soul of The Forest\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', '2025-09-22 08:28:23', '2025-09-22 08:28:23'),
(4, 'product4.jpg', '<iframe width=\"724\" height=\"407\" src=\"https://www.youtube.com/embed/Hu_AtRQONw4\" title=\"Em Gái Mưa - Hương Tràm | Live at Soul of The Forest\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" referrerpolicy=\"strict-origin-when-cross-origin\" allowfullscreen></iframe>', '2025-09-22 08:28:38', '2025-09-22 08:28:38');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_id` (`cart_id`);

--
-- Chỉ mục cho bảng `configs`
--
ALTER TABLE `configs`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `menu_specials`
--
ALTER TABLE `menu_specials`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `menu_types`
--
ALTER TABLE `menu_types`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `news_cats`
--
ALTER TABLE `news_cats`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `product_cats`
--
ALTER TABLE `product_cats`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Chỉ mục cho bảng `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `configs`
--
ALTER TABLE `configs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `menu_specials`
--
ALTER TABLE `menu_specials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `menu_types`
--
ALTER TABLE `menu_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT cho bảng `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `news_cats`
--
ALTER TABLE `news_cats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `product_cats`
--
ALTER TABLE `product_cats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `slides`
--
ALTER TABLE `slides`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `videos`
--
ALTER TABLE `videos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
