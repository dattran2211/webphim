-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 20, 2025 lúc 03:06 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `webphim_tutorial`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `position` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `title`, `description`, `status`, `slug`, `position`) VALUES
(1, 'Phim Chiếu Rạp', 'hay nhất trong ngày', 1, 'phim-chieu-rap', 0),
(5, 'Phim Mới', 'hấp dẫn', 1, 'phim-moi', 1),
(8, 'Phim thuyết minh', 'ok ', 1, 'phim-thuyet-minh', 4),
(9, 'Phim hoạt hình', 'ok ', 1, 'phim-hoạt-hình', 5),
(13, 'Phim lẻ', 'hấp dẫn', 1, 'phim-le', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `status` int(11) NOT NULL,
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `countries`
--

INSERT INTO `countries` (`id`, `title`, `description`, `status`, `slug`) VALUES
(1, 'việt nam', '🎬 Phim Việt Nam:\r\n\r\nPhim Việt Nam thường tập trung vào đời sống xã hội, các mối quan hệ gia đình, tình yêu và những vấn đề nhân văn. Nội dung gần gũi, phản ánh hiện thực cuộc sống người Việt – từ nông thôn đến đô thị, từ thời chiến đến hiện đại. Các bộ phim ngày càng được đầu tư về mặt hình ảnh, âm thanh, diễn xuất, và đặc biệt chú trọng đến yếu tố cảm xúc, dễ khiến người xem đồng cảm.\r\n\r\nNgoài ra, phim truyền hình dài tập Việt Nam cũng thường khai thác mâu thuẫn gia đình, xã hội, cùng các yếu tố “drama” thu hút khán giả. Trong những năm gần đây, điện ảnh Việt phát triển mạnh với nhiều phim chiếu rạp chất lượng, đa dạng thể loại: tình cảm, hài hước, kinh dị, hành động...\r\n\r\n🔹 Đặc trưng: Cảm xúc, gần gũi, đậm chất Việt, thường mang thông điệp xã hội.', 1, 'viet-nam'),
(3, 'thái lan', '🎬 Phim Thái Lan:\r\n\r\nPhim Thái nổi tiếng bởi sự kịch tính cao, lối diễn xuất mạnh mẽ, và phong cách kể chuyện cuốn hút, đặc biệt trong các thể loại như tình cảm – tâm lý, báo thù, xuyên không, ma – kinh dị. Ngoài ra, các phim đam mỹ (BL) Thái Lan cũng rất nổi tiếng trên toàn châu Á nhờ dàn diễn viên đẹp, nội dung mới mẻ và thu hút giới trẻ.\r\n\r\nPhim truyền hình Thái Lan (lakorn) thường khai thác mạnh yếu tố “drama”: tình tay ba, hận thù, âm mưu... nhưng cũng có những bộ phim nhẹ nhàng, lãng mạn và hài hước. Điện ảnh Thái thì rất mạnh ở mảng kinh dị và hành động, với nhiều phim được quốc tế công nhận.\r\n\r\n🔹 Đặc trưng: Mạnh về cảm xúc, cuốn hút, diễn biến nhanh, nhiều tình tiết bất ngờ và hấp dẫn.', 1, 'thai-lan'),
(4, 'Phim nhật bản', 'Phim Nhật Bản (J-dorama hoặc điện ảnh) thường có tiết tấu nhẹ nhàng, sâu lắng và tập trung vào tâm lý nhân vật. Các câu chuyện được xây dựng giản dị nhưng cảm động, phản ánh các giá trị gia đình, tình bạn, sự cô đơn, trưởng thành, hay cả sự mất mát. Dù là phim học đường, tình cảm, hay trinh thám – yếu tố “chạm đến trái tim người xem” luôn được đặt lên hàng đầu.\r\n\r\nKhông ít phim khai thác những chủ đề triết lý, cuộc sống hàng ngày, hoặc những mối quan hệ con người mang tính nhân văn cao. Ngoài ra, Nhật Bản cũng nổi bật với thể loại anime điện ảnh, kinh dị ma mị và phim chuyển thể từ manga rất phổ biến với giới trẻ toàn cầu.\r\n\r\nĐặc trưng khác bao gồm: diễn xuất tự nhiên, nhạc phim nhẹ nhàng, và bối cảnh thường mang đậm dấu ấn phong cảnh và kiến trúc Nhật Bản – từ những ngôi đền cổ đến các con phố yên bình.', 1, 'nhat-ban'),
(5, 'Mỹ', 'Phim Mỹ', 1, 'my'),
(6, 'Đài Loan', 'Phim Đài Loan', 1, 'dai-loan'),
(7, 'Hàn Quốc', 'Phim Hàn Quốc', 1, 'han-quoc'),
(8, 'Phim Trung Quốc', 'Phim Trung Quốc thường mang đậm bản sắc văn hóa Á Đông với cốt truyện giàu cảm xúc, đa dạng về đề tài như tình yêu, gia đình, quyền lực, âm mưu và lý tưởng sống. Các phim thường được đầu tư kỹ về bối cảnh, phục trang và diễn xuất, kết hợp giữa yếu tố giải trí và truyền tải giá trị nhân văn. Dù ở bối cảnh cổ trang hay hiện đại, phim Trung Quốc thường khai thác sâu vào tâm lý nhân vật, các mối quan hệ phức tạp, và hành trình phát triển của con người qua những thử thách, lựa chọn và hy sinh.', 1, 'phim-trung-quoc');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `episodes`
--

CREATE TABLE `episodes` (
  `id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `linkphim` text NOT NULL,
  `episode` varchar(11) DEFAULT NULL,
  `linkserver` int(11) NOT NULL,
  `ngaytao` varchar(50) NOT NULL,
  `ngaycapnhat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `episodes`
--

INSERT INTO `episodes` (`id`, `movie_id`, `linkphim`, `episode`, `linkserver`, `ngaytao`, `ngaycapnhat`) VALUES
(32, 28, '<iframe width=\"560\" height=\"315\" src=\"//ok.ru/videoembed/1981527165581?nochat=1\" frameborder=\"0\" allow=\"autoplay\" allowfullscreen></iframe>', '1', 4, '2025-04-19 15:30:44', '2025-04-19 15:30:44'),
(33, 29, '<iframe width=\"560\" height=\"315\" src=\"//ok.ru/videoembed/1936125266573?nochat=1\" frameborder=\"0\" allow=\"autoplay\" allowfullscreen></iframe>', 'FullHD', 1, '2025-04-19 15:55:57', '2025-04-19 15:55:57'),
(34, 30, '<iframe width=\"560\" height=\"315\" src=\"//ok.ru/videoembed/2314479471323?nochat=1\" frameborder=\"0\" allow=\"autoplay\" allowfullscreen></iframe>', '1', 1, '2025-04-19 16:21:33', '2025-04-19 16:21:33'),
(35, 30, '<iframe width=\"560\" height=\"315\" src=\"//ok.ru/videoembed/2315787766491?nochat=1\" frameborder=\"0\" allow=\"autoplay\" allowfullscreen></iframe>', '2', 1, '2025-04-19 16:22:12', '2025-04-19 16:22:12'),
(37, 30, '<iframe width=\"560\" height=\"315\" src=\"//ok.ru/videoembed/2317971819227?nochat=1\" frameborder=\"0\" allow=\"autoplay\" allowfullscreen></iframe>', '3', 1, '2025-04-19 16:25:37', '2025-04-19 16:25:37'),
(38, 30, '<iframe width=\"560\" height=\"315\" src=\"//ok.ru/videoembed/2320232418011?nochat=1\" frameborder=\"0\" allow=\"autoplay\" allowfullscreen></iframe>', '4', 1, '2025-04-19 16:26:07', '2025-04-19 16:26:07'),
(39, 31, '<iframe width=\"560\" height=\"315\" src=\"//ok.ru/videoembed/9333152942617?nochat=1\" frameborder=\"0\" allow=\"autoplay\" allowfullscreen></iframe>', '5', 1, '2025-04-19 16:41:57', '2025-04-19 16:41:57'),
(40, 31, '<iframe width=\"560\" height=\"315\" src=\"//ok.ru/videoembed/9333162838553?nochat=1\" frameborder=\"0\" allow=\"autoplay\" allowfullscreen></iframe>', '6', 1, '2025-04-19 16:42:33', '2025-04-19 16:42:33'),
(41, 32, '<iframe width=\"560\" height=\"315\" src=\"//ok.ru/videoembed/9339773782553?nochat=1\" frameborder=\"0\" allow=\"autoplay\" allowfullscreen></iframe>', '3', 1, '2025-05-04 19:57:56', '2025-05-04 19:57:56'),
(42, 32, '<iframe width=\"560\" height=\"315\" src=\"//ok.ru/videoembed/9342096837145?nochat=1\" frameborder=\"0\" allow=\"autoplay\" allowfullscreen></iframe>', '4', 1, '2025-05-04 20:01:34', '2025-05-04 20:01:34'),
(43, 32, '<iframe width=\"560\" height=\"315\" src=\"//ok.ru/videoembed/9364076235289?nochat=1\" frameborder=\"0\" allow=\"autoplay\" allowfullscreen></iframe>', '5', 1, '2025-05-04 20:03:09', '2025-05-04 20:03:09'),
(44, 32, '<iframe width=\"560\" height=\"315\" src=\"//ok.ru/videoembed/9364077152793?nochat=1\" frameborder=\"0\" allow=\"autoplay\" allowfullscreen></iframe>', '6', 1, '2025-05-04 20:03:41', '2025-05-04 20:03:41'),
(45, 32, '<iframe width=\"560\" height=\"315\" src=\"//ok.ru/videoembed/9383224478233?nochat=1\" frameborder=\"0\" allow=\"autoplay\" allowfullscreen></iframe>', '7', 1, '2025-05-04 20:04:25', '2025-05-04 20:04:25'),
(46, 32, '<iframe width=\"560\" height=\"315\" id=\"embed-player\" allow=\"autoplay; encrypted-media; picture-in-picture;\" referrerPolicy=\"strict-origin-when-cross-origin\" allowFullScreen=\"\" webkitallowfullscreen=\"true\" mozallowfullscreen=\"true\"></iframe>', '2', 1, '2025-05-04 20:23:27', '2025-05-04 20:23:27'),
(47, 33, '<iframe width=\"560\" height=\"315\" src=\"//ok.ru/videoembed/9371361938148?nochat=1\" frameborder=\"0\" allow=\"autoplay\" allowfullscreen></iframe>', '1', 4, '2025-06-19 23:24:42', '2025-06-19 23:24:42'),
(48, 33, '<iframe width=\"560\" height=\"315\" src=\"//ok.ru/videoembed/9371361872612?nochat=1\" frameborder=\"0\" allow=\"autoplay\" allowfullscreen></iframe>', '2', 4, '2025-06-19 22:51:07', '2025-06-19 22:51:07'),
(49, 33, '<iframe width=\"560\" height=\"315\" src=\"//ok.ru/videoembed/9371381598948?nochat=1\" frameborder=\"0\" allow=\"autoplay\" allowfullscreen></iframe>', '3', 4, '2025-06-19 23:25:23', '2025-06-19 23:25:23'),
(50, 33, '<iframe width=\"560\" height=\"315\" src=\"//ok.ru/videoembed/9373873998564?nochat=1\" frameborder=\"0\" allow=\"autoplay\" allowfullscreen></iframe>', '4', 4, '2025-06-19 23:27:01', '2025-06-19 23:27:01'),
(51, 33, '<iframe width=\"560\" height=\"315\" src=\"//ok.ru/videoembed/9373873933028?nochat=1\" frameborder=\"0\" allow=\"autoplay\" allowfullscreen></iframe>', '5', 4, '2025-06-19 23:27:46', '2025-06-19 23:27:46'),
(52, 33, '<iframe width=\"560\" height=\"315\" src=\"//ok.ru/videoembed/9376491899620?nochat=1\" frameborder=\"0\" allow=\"autoplay\" allowfullscreen></iframe>', '6', 4, '2025-06-19 23:28:32', '2025-06-19 23:28:32');

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
-- Cấu trúc bảng cho bảng `genres`
--

CREATE TABLE `genres` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `genres`
--

INSERT INTO `genres` (`id`, `title`, `description`, `status`, `slug`) VALUES
(2, 'Viễn Tưởng', 'Phim Viễn Tưởng', 1, 'vien-tuong'),
(3, 'Hài Hước', 'e', 1, 'hai-huoc'),
(4, 'Hành Động', 'r', 1, 'hanh-dong'),
(5, 'Lãng Mạn', 'de', 1, 'lang-man'),
(6, 'Tâm Lý', 'ok', 1, 'tam-ly'),
(7, 'Võ thuật', 'phim võ thuật', 1, 'vo-thuat'),
(8, 'Kinh dị', 'Phim kinh dị', 1, 'kinh-di'),
(10, 'Gia đình - Học đường', 'Gia đình - Học đường', 1, 'gia-dinh- học-duong'),
(11, 'Hoạt Hình', 'Phim hoạt hình', 1, 'hoat-hinh'),
(12, 'Chiến Tranh', 'Phim Chiến Tranh', 1, 'chien-tranh'),
(13, 'Phiêu Lưu', 'Phim Phiêu Lưu', 1, 'phieu-luu'),
(14, 'Cổ Trang', 'Phim Cổ Trang', 1, 'co-trang'),
(15, 'Tôn Giao', 'Phim Tôn Giao', 1, 'ton-giao'),
(16, 'Tài liệu - Học thuật', 'Phim Tài liệu - Học thuật', 1, 'tai-lieu-hoc-thuat'),
(17, 'Tình Cảm', 'Phim Tình Cảm', 1, 'phim-tinh-cam'),
(18, 'Hình Sự - Gây Cấn', 'Phim Hình Sự - Gây Cấn', 1, 'hinh-su-gay-can');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `info`
--

CREATE TABLE `info` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `logo` varchar(100) NOT NULL,
  `copyright` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `info`
--

INSERT INTO `info` (`id`, `title`, `description`, `logo`, `copyright`) VALUES
(1, 'Phim hay 2020 - Xem phim hay nhất', 'Phim hay 2020 - Xem phim hay nhất, phim hay trung quốc, hàn quốc, việt nam, mỹ, hong kong , chiếu rạp', 'Nguoi-Kien61853.jpg', 'ok');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `linkmovie`
--

CREATE TABLE `linkmovie` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `linkmovie`
--

INSERT INTO `linkmovie` (`id`, `title`, `description`, `status`) VALUES
(0, 'Link Hydrax', 'Link Hydrax link mượt nhưng quảng cáo hơi nhiều', 1),
(1, 'Link Ok.ru', 'Link Ok.ru phim hay, video mượt', 1),
(2, 'Link doodstream', 'Link doodstream video mượt, ko tính phí', 1),
(3, 'Link vimeo', 'Link vimeo mượt và miễn phí trọn đời', 1),
(4, 'Link Thường', 'Link thường có quảng cáo và đôi lúc bị lag', 1);

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
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `sotap` int(11) NOT NULL DEFAULT 1,
  `thoiluong` varchar(50) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `status` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `thuocphim` varchar(10) NOT NULL,
  `genre_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `phim_hot` int(11) NOT NULL,
  `name_english` varchar(255) NOT NULL,
  `resolution` int(11) NOT NULL DEFAULT 0,
  `phude` int(11) NOT NULL DEFAULT 0,
  `ngaytao` varchar(50) DEFAULT NULL,
  `ngaycapnhat` varchar(50) DEFAULT NULL,
  `year` varchar(50) DEFAULT NULL,
  `tags` text DEFAULT NULL,
  `topview` int(11) DEFAULT NULL,
  `season` varchar(50) DEFAULT '0',
  `trailer` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `movies`
--

INSERT INTO `movies` (`id`, `title`, `sotap`, `thoiluong`, `slug`, `description`, `status`, `image`, `category_id`, `thuocphim`, `genre_id`, `country_id`, `phim_hot`, `name_english`, `resolution`, `phude`, `ngaytao`, `ngaycapnhat`, `year`, `tags`, `topview`, `season`, `trailer`) VALUES
(28, 'Cuộc hành trình của mèo Nana ( 旅猫リポート  )', 1, '119 phút', 'cuoc-hanh-trinh-cua-meo-nana', 'Nội dung phim: Chàng trai trẻ với trái tim nhân hậu Satoru, cậu đã cứu chú mèo hoang Nana sau 1 lần tai nạn và nhận nuôi nó và trở nên thân thiết. Tuy nhiên, một ngày nọ, Satoru đã nói rằng không thể nuôi Nana được nữa, họ đã bắt đầu cuộc hành trình đi đến rất nhiều nơi để tìm một người chủ mới cho Nana. Trong cuộc hành trình, Satoru đã gặp lại những người bạn cũ, giúp Nana hiểu hơn phần nào về cuộc đời của Satoru và đằng sau đó là 1 bí mật đầy cảm động được hé mở...', 1, 'nana89.jpg', 1, 'phimle', 5, 4, 1, 'The Travelling Cat Chronicles', 1, 1, '2025-04-19 15:02:10', '2025-04-19 15:02:10', '2018', 'Tình cảm gia đình , Động vật (mèo) , Hành trình cảm động,  Tình bạn, Phim Nhật Bản, Cảm động – xúc động, Chữa lành (healing movie), Tình yêu thương, Chia ly, Văn hóa Nhật Bản', NULL, '1', 'JI2DJTWb5hA'),
(29, 'Chàng trai bí ẩn Itou ( 伊藤くん A to E )', 1, '126 phút', 'chang-trai-bi-an-itou', 'Nội dung phim: Rio Yazaki (Fumino Kimura) là một biên kịch 32 tuổi. Cô từng rất nổi tiếng khi tạo nên cơn sốt với kịch bản của bộ phim “Tokyo Doll House.” Nhưng kể từ đó cô cũng không còn tác phẩm nào gây tiếng vang nữa. Cho đến một ngày khi Rio Yazaki tổ chức một buổi tọa đàm, từ bảng trả lời câu hỏi của hoạt động kèm thêm, cô nhận ra có 4 người phụ nữ cùng có quan hệ với một người đàn ông tên là Itou. Và với tư liệu về câu chuyện tình yêu của 4 người phụ nữ này, Rio Yazaki dự định sẽ viết nên một kịch bản mới. Ở movie này, danh tính của chàng trai Itou đã dần lộ diện...', 1, 'itou75.jpg', 1, 'phimle', 1, 4, 1, 'The Many Faces Of Itou', 4, 0, '2025-04-19 15:55:16', '2025-04-19 15:55:16', '2018', 'Tình cảm gia đình ,   Hành trình cảm động,  Tình bạn, Phim Nhật Bản, Cảm động – xúc động, Chữa lành (healing movie), Tình yêu thương, Chia ly, Văn hóa Nhật Bản', NULL, '1', 'mPc2v7i7uP4'),
(30, 'Nước mắt của Hỏa Thần', 10, '50 phút', 'nuoc-mat-cua-hoa-than', 'Bộ phim xoay quanh cuộc sống và công việc của bốn lính cứu hỏa thuộc phân đội Đồng An, đội phòng cháy chữa cháy thành phố Đại Viên. Họ không chỉ đối mặt với hiểm nguy trong các vụ cháy mà còn phải vượt qua những áp lực nghề nghiệp và khó khăn trong cuộc sống cá nhân. Phim khắc họa chân thực những thách thức mà lính cứu hỏa phải đối mặt, từ công việc đến gia đình, phản ánh sâu sắc về nghề nghiệp và xã hội.', 1, 'tire on fires80.jpg', 5, 'phimbo', 1, 6, 1, 'Tears on Fire', 4, 0, '2025-04-19 16:20:54', '2025-04-19 16:23:30', NULL, 'Tình cảm gia đình , Tình bạn – tình đồng đội , Sự hy sinh thầm lặng , Cảm động – xúc động, Bi kịch đời thường, Chữa lành (healing movie), Nghề lính cứu hỏa, Nghề nguy hiểm, Áp lực công việc, Phim nghề nghiệp (workplace drama), Đấu tranh nội tâm, Văn hóa Đài Loan, Đời sống hiện đại, Thành phố – đô thị, Câu chuyện đời thường, Phim Châu Á truyền cảm', NULL, '0', 'Dk3ir7dEdE0'),
(31, '7 Ngày Bên Nhau', 6, '45 phút', '7-ngay-ben-nhau', 'Phim kể về Jeong Hee-wan (Kim Min-ha), một cô gái 24 tuổi sống khép kín, mất đi ý chí sống sau nhiều biến cố. Bất ngờ, Kim Ram-woo (Gong Myung) – người bạn thời thơ ấu và cũng là mối tình đầu của cô, xuất hiện trước mặt cô dưới hình dạng một thần chết, thông báo rằng cô chỉ còn sống được một tuần nữa. Ram-woo, người đã qua đời 6 năm trước, giờ đây trở thành người dẫn dắt linh hồn. Trong tuần cuối cùng của cuộc đời, họ cùng nhau thực hiện những điều chưa kịp làm, chữa lành những vết thương cũ và đối mặt với những cảm xúc chưa từng được thổ lộ.', 1, 'noi-dung-lich-chieu-phim-7-ngay-ben-nhau-way-back-love-84.jpg', 5, 'phimbo', 1, 7, 1, 'Way Back Love (2025)', 1, 1, '2025-04-19 16:38:21', '2025-04-19 16:40:55', '2025', 'Tình cảm lãng mạn , Giả tưởng – Thần chết, Tình yêu đầu, Chữa lành (healing drama), Tình bạn – Tình yêu, Tái hợp sau chia ly, Tình cảm gia đình, Phim Hàn Quốc 2025, Phim ngắn – 6 tập, Phim cảm động – xúc động​', 0, '1', 'KC4liJKDnOc'),
(32, 'Chuyện Đời Bác Sĩ Nội Trú', 12, '80 - 100 phút', 'chuyen-doi-bac-si-noi-tru', '\"Chuyện Đời Bác Sĩ Nội Trú\" là câu chuyện cảm động và đầy kịch tính về hành trình trưởng thành của những bác sĩ nội trú trẻ trong một bệnh viện lớn. Phim theo chân nhóm bác sĩ vừa mới ra trường, bước vào con đường đầy thử thách của nghề y, nơi họ không chỉ đối mặt với bệnh tật, mà còn phải vượt qua những giới hạn về sức khỏe tinh thần và cảm xúc.\r\n\r\nMỗi tập phim là một câu chuyện về cuộc sống hằng ngày của các bác sĩ nội trú: từ những ca phẫu thuật căng thẳng, những quyết định sinh tử cho đến những mâu thuẫn, tình bạn, tình yêu nảy sinh trong môi trường bệnh viện đầy áp lực. Họ phải đối mặt với sự mệt mỏi về thể chất, căng thẳng tâm lý, và đôi khi là cảm giác bất lực trước sự sống chết của bệnh nhân.\r\n\r\nCác nhân vật chính là những bác sĩ trẻ đầy nhiệt huyết, nhưng cũng đầy hoài nghi và thử thách. Họ cần phải học cách cân bằng giữa chuyên môn, tình cảm cá nhân và các mối quan hệ đồng nghiệp. Bộ phim không chỉ nói về y học, mà còn là một hành trình khám phá sự hy sinh, lòng kiên nhẫn và giá trị thực sự của một nghề đầy cao cả nhưng cũng đầy gian khổ.\r\n\r\nChuyện Đời Bác Sĩ Nội Trú không chỉ là một bộ phim y khoa, mà còn là một bài học về tình người, sự đồng cảm và những quyết định khó khăn trong cuộc sống.', 1, '055875f8424f76d54b2a36feaa6edc0778.webp', 5, 'phimbo', 1, 7, 1, 'Resident Playbook', 4, 0, '2025-05-04 19:57:19', '2025-05-04 20:10:36', NULL, 'ChuyệnĐờiBácSĩ, BácSĩNộiTrú, HọcTậpYHọc, BệnhViện, ĐàoTạoBácSĩ', NULL, '0', NULL),
(33, 'Thiều Hoa Nhược Cẩm', 30, '1 giờ 10 phút', 'thieu-hoa-nhuoc-cam', 'Thiều Hoa Nhược Cẩm (tiếng Anh: Youthful Glory) là phim cổ trang tình cảm pha yếu tố phá án, chuyển thể từ tiểu thuyết Tiểu Đậu Khấu của Bất Chỉ Thị Khỏa Thái. Phim xoay quanh sự kiện Giang Tự – chiến tướng lừng danh sau 8 năm gác kiếm ở biên ải – trở về kinh thành Thành Khang để điều tra vụ tham ô quân lương. Để tiếp cận nguồn tin, anh kết hôn sắp đặt với Minh Đàn, tiểu thư trí tuệ và duyên dáng. Từ cuộc hôn nhân “cưới trước yêu sau”, cả hai dần khám phá âm mưu sâu xa từ triều đình, đấu trí cùng kết tình. Họ sát cánh để minh oan cho gia tộc, vạch trần thế lực đen tối, và xây dựng tình yêu chân thành giữa biến cố.', 1, 'tải xuống98.jpg', 5, 'phimbo', 1, 8, 1, 'Youthful Glory', 1, 0, '2025-06-19 22:37:56', '2025-06-19 22:48:16', '2025', '#ThiềuHoaNhượcCẩm, #CổTrangPháÁn ,  #CướiTrướcYêuSau ,  #TốngUyLong ,  #BaoThượngÂn, #ThiếuTướng , #TìnhCảmNhẹNhàng, #ĐiềuTraQuanTrường\r\n\r\n\r\n\r\n\r\n\r\n,', NULL, '1', 'x-NBuo9DoHE');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `movie_genre`
--

CREATE TABLE `movie_genre` (
  `id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `movie_genre`
--

INSERT INTO `movie_genre` (`id`, `movie_id`, `genre_id`) VALUES
(47, 28, 3),
(48, 28, 5),
(49, 29, 3),
(50, 29, 5),
(51, 29, 6),
(52, 29, 10),
(53, 29, 17),
(54, 30, 4),
(55, 30, 6),
(56, 30, 7),
(57, 30, 12),
(58, 30, 13),
(59, 30, 18),
(60, 31, 2),
(61, 31, 5),
(62, 31, 6),
(63, 31, 10),
(64, 31, 13),
(65, 31, 17),
(66, 32, 3),
(67, 32, 5),
(68, 32, 6),
(69, 32, 17),
(70, 33, 2),
(71, 33, 3),
(72, 33, 4),
(73, 33, 5),
(74, 33, 6),
(75, 33, 7),
(76, 33, 13),
(77, 33, 14),
(78, 33, 17);

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `rating`
--

CREATE TABLE `rating` (
  `id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `ip_address` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `rating`
--

INSERT INTO `rating` (`id`, `rating`, `movie_id`, `ip_address`) VALUES
(1, 3, 21, '127.0.0.1'),
(2, 4, 4, '127.0.0.1'),
(3, 3, 29, '127.0.0.1'),
(4, 4, 31, '127.0.0.1'),
(5, 3, 30, '127.0.0.1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `status`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Dat Xuan Tran', 'Tranxuandat373745@gmail.com', 1, NULL, '$2y$10$wQPG44v0w.iNtTPNrYmnn.CSpLyID5ejixIL6q5RZalrsB21RkQDe', '3yNyTtCbiU3nOJNGnB6JJO2HpQJJvPFx69mRs6vcnrhtUNw7YOqJUWQeebwR', '2024-08-25 09:01:54', '2025-06-19 08:12:04'),
(3, 'bống', 'vananh93@gmail.com', 0, NULL, '$2y$10$25OvJpVIdeFwfb8T5phNsOwkHX89rJIiymBKJiOloZJ7y5xuT8LPK', 'WkW95f8G55AOGVzsFLIo6ax7KQuLYZivP2DblIgJBANQ5xcSeJUOMzEz6E6X', '2025-04-22 23:28:18', '2025-04-23 01:07:58'),
(4, 'tiến anh', 'tienanh@gmail.com', 1, NULL, '$2y$10$sKaFPaO3lPp5coSSJKv0hebphyWMXUjiCDnA0n64uU0CmAyciDi7G', NULL, '2025-04-23 00:26:58', '2025-04-23 00:26:58'),
(5, 'hồng quân', 'hquan123@gmail.com', 1, NULL, '$2y$10$JiQj3ybmD4dpvpLxLVh1wOICP0TNFrrRM2Xf/WWmDwS8MhPne2nS6', NULL, '2025-06-19 07:38:17', '2025-06-19 07:38:17');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `episodes`
--
ALTER TABLE `episodes`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `linkmovie`
--
ALTER TABLE `linkmovie`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `movie_genre`
--
ALTER TABLE `movie_genre`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `episodes`
--
ALTER TABLE `episodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `info`
--
ALTER TABLE `info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `linkmovie`
--
ALTER TABLE `linkmovie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT cho bảng `movie_genre`
--
ALTER TABLE `movie_genre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
