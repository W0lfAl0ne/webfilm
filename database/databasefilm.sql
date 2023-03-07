-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 07, 2023 lúc 03:00 PM
-- Phiên bản máy phục vụ: 10.4.21-MariaDB
-- Phiên bản PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `databasefilm`
--

DELIMITER $$
--
-- Các hàm
--
CREATE DEFINER=`root`@`localhost` FUNCTION `total` (`id` INT) RETURNS INT(11) READS SQL DATA
BEGIN
	DECLARE t INT;
    SELECT count(film_id) INTO t
    FROM episodes
    WHERE film_id = id
    GROUP BY film_id;
    RETURN t;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `actor`
--

CREATE TABLE `actor` (
  `actor_id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `actor`
--

INSERT INTO `actor` (`actor_id`, `name`) VALUES
(172, 'Rachel McAdams'),
(173, 'Benedict Cumberbatch'),
(174, 'Tilda Swinton'),
(175, 'Chiwetel Ejiofor'),
(176, 'Benedict Wong'),
(177, 'Mads Mikkelsen'),
(178, 'Michael Stuhlbarg'),
(179, 'Elizabeth Olsen'),
(180, 'Tom Holland'),
(181, 'Marisa Tomei'),
(182, 'Chris Evans'),
(183, 'Robert Downey Jr'),
(184, 'Paul Rudd'),
(185, 'Scarlett Johansson'),
(186, 'Sebastian Stan'),
(187, 'Hugo Weaving'),
(188, 'Samuel L. Jackson'),
(189, 'Hayley Atwell'),
(190, 'Tommy Lee Jones'),
(191, 'Dominic Cooper'),
(192, 'Robert Redford'),
(193, 'Anthony Mackie'),
(194, 'Cobie Smulders'),
(195, 'Frank Grillo'),
(196, 'Michael B. Jordan'),
(197, 'Forest Whitaker'),
(198, 'Martin Freeman'),
(199, 'Andy Serkis'),
(200, 'Chadwick Boseman'),
(201, 'Daniel Kaluuya'),
(202, 'Angela Bassett'),
(203, 'Danai Gurira'),
(204, 'Mark Ruffalo'),
(205, 'Chris Hemsworth'),
(206, 'Jeremy Renner'),
(207, 'Tom Hiddleston'),
(208, 'Clark Gregg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`category_id`, `name`) VALUES
(1, 'Hoạt Hình'),
(2, 'Võ Thuật'),
(3, 'Kiếm Hiệp'),
(4, 'Tiên Hiệp'),
(5, 'Thần Thoại'),
(6, 'Cổ Trang'),
(7, 'Hành Động'),
(8, 'Kinh Dị'),
(9, 'Hình Sự'),
(10, 'Hài'),
(11, 'Tội Phạm'),
(12, 'Khoa Học-Viễn Tưởng'),
(13, 'Phiêu Lưu'),
(14, 'Lịch Sử'),
(15, 'Học Đường'),
(16, 'Tâm Lý-Tình Cảm');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL,
  `film_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `time` datetime NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `episodes`
--

CREATE TABLE `episodes` (
  `episode_id` int(11) NOT NULL,
  `film_id` int(11) NOT NULL,
  `episode` int(10) NOT NULL,
  `episode_name` varchar(15) DEFAULT NULL,
  `url` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `episodes`
--

INSERT INTO `episodes` (`episode_id`, `film_id`, `episode`, `episode_name`, `url`) VALUES
(59, 44, 1, 'Full', '64074329ca758-video.mp4');

--
-- Bẫy `episodes`
--
DELIMITER $$
CREATE TRIGGER `after_delete` AFTER DELETE ON `episodes` FOR EACH ROW BEGIN
	DECLARE temp INT;
    SET temp = total(old.film_id);
    
    UPDATE film
    SET status = temp
    WHERE film_id = old.film_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_insert` AFTER INSERT ON `episodes` FOR EACH ROW BEGIN
	DECLARE temp INT;
    SET temp = total(new.film_id);
    
    UPDATE film
    SET status = temp
    WHERE film_id = new.film_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `film`
--

CREATE TABLE `film` (
  `film_id` int(11) NOT NULL,
  `film_name` varchar(255) DEFAULT NULL,
  `default_name` varchar(255) DEFAULT NULL,
  `directors` varchar(50) DEFAULT NULL,
  `release_year` int(11) DEFAULT NULL,
  `nation_id` int(11) DEFAULT NULL,
  `episode_number` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `filmType_id` int(11) DEFAULT NULL,
  `view` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `trailer` varchar(500) DEFAULT NULL,
  `image` varchar(500) DEFAULT NULL,
  `poster` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `film`
--

INSERT INTO `film` (`film_id`, `film_name`, `default_name`, `directors`, `release_year`, `nation_id`, `episode_number`, `status`, `filmType_id`, `view`, `description`, `trailer`, `image`, `poster`) VALUES
(44, 'Phù Thủy Tối Thượng', 'Doctor Strange', 'Scott Derrickson', 2016, 3, 1, 1, 2, 1, 'Phù Thủy Tối Thượng - Doctor Strange là câu truyệnv về một chuyên gia giải phẫu thần kinh. Sau một tai nạn xe hơi khủng khiếp, Stephen đã đến Tây Tạng học cách điều khiển được tiềm lực ma thuật bên trong bản thân và của thế giới xung quanh, cũng như cách mượn sức mạnh của các thần linh và chúa quỷ. Khi quyền năng của Stephen đạt tới cực đại thì cũng là lúc cái tên Dotor Strange ra đời. Trong truyện tranh nhân vật này còn được Death (người yêu của Thanos) ban cho cuộc sống trường sinh bất lão. Sau này Dr. Strane trở về Mỹ, dùng sức mạnh của mình để bảo vệ người vô tội, bảo vệ thế giới khỏi những thế lực hắc ám. Sự nghiệp siêu anh hùng của ông cũng bắt đầu từ đây.', 'https://www.youtube.com/embed/Lt-U_t2pUHI', '6407381745a61-Doctor_Strange_poster.jpg', '6407381745e52-poster-strange.jpg'),
(45, 'Captain America 3: Nội Chiến Siêu Anh Hùng', 'Captain America: Civil War', 'Anthony Russo, Joe Russo', 2016, 3, 1, 0, 2, 0, 'Captain America: Nội Chiến Siêu Anh Hùng sẽ trở lại sau một mùa hè bùng nổ với “Avengers: Đế Chế Ultron” và “Ant-Man – Người Kiến”, Marvel Studios tiếp tục khiến các khán giả đứng ngồi không yên khi hé lộ những tình tiết kịch tính của cuộc nội chiến nảy lửa giữa các siêu anh hùng, mở đầu cho Phase 3 trong Vũ Trụ Điện Ảnh Marvel. Trailer mở đầu với phân cảnh đã từng xuất hiện trong After Credit của “Ant-Man: Người Kiến” – Falcon và Captain America tìm thấy Bucky!. “Chiến binh mùa đông” Bucky đã nhớ lại mọi thứ và Captain sẵn sàng cứu anh khỏi sự truy đuổi của chính phủ. Cùng với nhiều sự vụ xảy ra và biệt đội Avengers góp phần không nhỏ trong việc làm thiệt hại tài sản, chính phủ quyết định thiết lập cơ quan quản lý và giám sát những siêu anh hùng này. Sự chia rẽ nội bộ bắt đầu xảy đến. Một bên được lãnh đạo bởi Steve Rogers (Captain America) với mong muốn duy trì cả biệt đội để thực hiện mục tiêu bảo vệ nhân loại mà không có sự can thiệp nào từ bên ngoài. Phe còn lại do Tony Stark (Iron Man) đứng đầu, luôn hỗ trợ giám sát và có trách nhiệm giải trình mọi việc làm với chính phủ. Kịch tính được đẩy lên cao trào khi Captain America và Bucky cùng trực tiếp chiến đấu với Iron Man. Các siêu anh hùng khác cũng chia thành 2 phe, nhưng Marvel vẫn chưa chính thức xác nhận ai sẽ về phe nào. Biệt đội siêu anh hùng trong bom tấn mới nhất này sẽ có thêm hai thành viên đáng chú ý: Black Panther (Chadwick Boseman thủ vai) và Spider-Man do Tom Holland thủ vai – lần đầu tiên xuất hiện trong Vũ Trụ Điện Ảnh Marvel.', 'https://www.youtube.com/embed/S12-4mXCNj4', '640738a8e8969-captain.jpg', '640738a8e8bd7-poster-captain_america_civil_war.jpg'),
(46, 'Phù Thủy Tối Thượng Trong Đa Vũ Trụ Hỗn Loạn', 'Captain America: Kẻ Báo Thù Đầu Tiên', 'Joe Johnston', 2011, 3, 1, 0, 2, 0, 'Captain America: Kẻ Báo Thù Đầu Tiên lấy bối cảnh phim bắt đầu năm 1942, khi Mỹ đang tham gia Thế chiến II và cần tới những chiến binh can trường. Chàng trai Steve Rogers (Chris Evans) là một người như vậy, nhưng thể hình quá thấp bé khiến anh không thể đạt được ước mơ tòng quân. Cơ may đến với Rogers khi anh được chọn tham gia một thí nghiệm của chính phủ, giúp biến người thường trở thành siêu chiến binh. Mọi việc diễn ra suôn sẻ, biến Rogers thành một người cao to vạm vỡ, đầu óc tiếp thu mọi kỹ năng chiến đấu nhanh và vẫn giữ được trái tim nhân hậu.Anh trở thành Captain America, biểu tượng của nước Mỹ kể từ đó. Đối thủ của anh là phe Phát-xít, với quái nhân Red Skull, kẻ không chỉ quyền năng mà còn rất tàn ác.', 'https://www.youtube.com/embed/S12-4mXCNj4', '640739e51def5-Poster_Captain_America_1.jpg', '640739e51e256-poster-kebaothudautien.png'),
(47, 'Captain America 2: Chiến Binh Mùa Đông', 'Captain America: The Winter Soldier', 'Anthony Russo, Joe Russo', 2014, 3, 1, 0, 2, 0, 'Chiến Binh Mùa Đông - Captain America: The Winter Soldier là phần tiếp theo của Captain America: The First Avenger. Steve Rogers muốn thấu hiểu một nước Mỹ hiện đại sau khi bị đông lạnh 50 năm trong nước đá. Một mối đe dọa mới chống lại S.H.I.E.L.D xuất hiện. Đó chính là Chiến Binh Mùa Đông. Trong lúc nguồn gốc của Chiến Binh Mùa Đông không rõ ràng, mối đe dọa của SHEILD đến từ tổ chức Hydra. Đặc biệt là sau khi thỏa hiệp với Nick Fury và chất Romanoff, SHIELD của rơi vào tình trạng bị thu hồi và bị cho là những kẻ phản bội có tổ chức. Captain America mở một cuộc điều tra nguồn gốc của SHIELD và anh trở về nơi anh từng trải qua đào tạo cơ bản gần 100 năm trước đây. Những gì anh và Romanoff khám phá ở đó tạo ra một sự phát triển rất đáng ngạc nhiên với SHIELD, một dự án bí mật được gọi là \"Chiến dịch Cái nhìn sâu sắc\", và sự ra mắt của thế hệ tiếp theo của Helicarrier. Họ có thể ngăn chặn nó trước khi quá muộn?', 'https://www.youtube.com/embed/S12-4mXCNj4', '64073a96bc365-Captain-America-2-chien-binh-mua-dong.jpg', '64073a96bcd65-poster-chienbinhmuadong.jpg'),
(48, 'Chiến Binh Báo Đen', 'Black Panther', 'Ryan Coogler', 2018, 3, 1, 0, 2, 0, 'Chiến Binh Báo Đen - Black Panther kể về T’Challa (Black Panther) là hoàng tử, một nhà sáng chế tài ba của đất nước Wakanda nằm tại Châu Phi, nơi sở hữu nguồn kim loại cực hiếm: vibranium. Với nguồn tài nguyên giàu có cùng sự tiến bộ vượt bậc, Wakanda trở thành mục tiêu tấn công của nhiều quốc gia, đế chế suốt vài thiên niên kỷ, mục đích của những kẻ xâm lược là giành được số vũ khí khủng khiếp và của cải ở đất nước giàu có này. Là người đứng đầu đất nước, hoàng tử T’Challa sẽ phải bảo vệ người dân của mình khỏi những mưu đồ từ nước ngoại bang. Sở hữu khả năng tác chiến nhanh nhạy, bộ giáp và móng vuốt bằng vibranium, có thể nói Black Panther cũng là một siêu anh hùng trong thế giới Marvel.', 'https://www.youtube.com/embed/S12-4mXCNj4', '64073c328d7b0-black1.jpg', '64073c328daa0-poster-blackpanther2.png'),
(49, 'Biệt Đội Siêu Anh Hùng', 'The Avengers', 'Joss Whedon', 2012, 3, 1, 0, 2, 0, 'Biệt Đội Siêu Anh Hùng là câu truyện về Loki, người em trai nuôi độc ác của Thor đến từ hành tinh Asgard xa xôi, đột nhập vào căn cứ của S.H.I.E.L.D để chiếm khối Tesseract chứa nguồn năng lượng vô hạn. Hắn còn âm mưu dẫn một đội quân tới Trái đất thôn tính và biến loài người thành nô lệ. Nick Fury, giám đốc của S.H.I.E.L.D nỗ lực tập hợp một đội quân tinh nhuệ nhất để bảo vệ trái đất khỏi âm mưu của Loki. Tuy nhiên, anh và người cộng sự lâu năm là điệp viên Coulson phải tìm cách thuyết phục các siêu anh hùng phối hợp thành một đội thay vì chống lại nhau...', 'https://www.youtube.com/embed/S12-4mXCNj4', '64073cdc21ab6-TheAvengers2012Poster1.jpg', '64073cdc21d69-poster-bietdoisieuanhhung2.jpg'),
(50, 'Biệt Đội Siêu ANh Hùng 2: Đế Chế Ultron', 'Avengers 2: Age of Ultron', 'Joss Whedon', 2015, 3, 1, 0, 2, 0, 'Biệt Đội Siêu Anh Hùng 2: Đế Chế Ultron lấy khởi đầu từ nhân vật Tony Stark - siêu anh hùng Iron Man. Khi chàng tỷ phú tái khởi động dự án gìn giữ hòa bình bị ngưng hoạt động từ lâu, mọi chuyện diễn ra không hề suôn sẻ. Các siêu anh hùng vĩ đại nhất trên Trái đất gồm Iron Man, Captain America, Thor, Hulk, Black Widow và Hawkeye đứng trước một thử thách vô cùng khó khăn trong việc đem lại cân bằng cho toàn thế giới. Trong phần này, biệt đội siêu anh hùng của chúng ta sẽ phải chiến đấu với binh đoàn robot được biết đến với cái tên là Ultron.', 'https://www.youtube.com/embed/S12-4mXCNj4', '64073dfc3da92-Avengers_-_Age_of_Utron_Poster1.jpg', '64073dfc3ddd1-poster-bietdoisieuanhhuyultron2.jpg'),
(51, 'Biệt Đội SIêu Anh Hùng 3: Cuộc Chiến Vô Cực', 'Avengers: Infinity War', 'Joe Russo, Anthony Russo', 2018, 3, 1, 0, 2, 0, 'Biệt Đội Siêu Anh Hùng 3: Cuộc Chiến Vô Cực: là câu truyện sau chuyến hành trình độc nhất vô nhị không ngừng mở rộng và phát triển vụ trũ điện ảnh Marvel, bộ phim Avengers: Cuộc Chiến Vô Cực sẽ mang đến màn ảnh trận chiến cuối cùng khốc liệt nhất mọi thời đại. Biệt đội Avengers và các đồng minh siêu anh hùng của họ phải chấp nhận hy sinh tất cả để có thể chống lại kẻ thù hùng mạnh Thanos trước tham vọng hủy diệt toàn bộ vũ trụ của hắn', 'https://www.youtube.com/embed/S12-4mXCNj4', '64073ea8d9ea7-Avengers-Infinity_War-Official-Poster1.jpg', '64073ea8e79bc-poster-ttxvn_avengers2.jpg'),
(52, 'Biệt Đội Siêu ANh Hùng 2: Đế Chế Ultron', 'Avengers 2: Age of Ultron', 'Joss Whedon', 2015, 3, 20, 0, 1, 0, 'Biệt Đội Siêu Anh Hùng 2: Đế Chế Ultron lấy khởi đầu từ nhân vật Tony Stark - siêu anh hùng Iron Man. Khi chàng tỷ phú tái khởi động dự án gìn giữ hòa bình bị ngưng hoạt động từ lâu, mọi chuyện diễn ra không hề suôn sẻ. Các siêu anh hùng vĩ đại nhất trên Trái đất gồm Iron Man, Captain America, Thor, Hulk, Black Widow và Hawkeye đứng trước một thử thách vô cùng khó khăn trong việc đem lại cân bằng cho toàn thế giới. Trong phần này, biệt đội siêu anh hùng của chúng ta sẽ phải chiến đấu với binh đoàn robot được biết đến với cái tên là Ultron.', 'https://www.youtube.com/embed/S12-4mXCNj4', '64073fa577b77-bietdoisieuanhhuyultron2.jpg', '64073fa578543-poster-TheAvengers2012Poster1.jpg'),
(53, 'Captain America 2: Chiến Binh Mùa Đông', 'Captain America: The Winter Soldier', 'Anthony Russo, Joe Russo', 2015, 3, 30, 0, 1, 0, 'Chiến Binh Mùa Đông - Captain America: The Winter Soldier là phần tiếp theo của Captain America: The First Avenger. Steve Rogers muốn thấu hiểu một nước Mỹ hiện đại sau khi bị đông lạnh 50 năm trong nước đá. Một mối đe dọa mới chống lại S.H.I.E.L.D xuất hiện. Đó chính là Chiến Binh Mùa Đông. Trong lúc nguồn gốc của Chiến Binh Mùa Đông không rõ ràng, mối đe dọa của SHEILD đến từ tổ chức Hydra. Đặc biệt là sau khi thỏa hiệp với Nick Fury và chất Romanoff, SHIELD của rơi vào tình trạng bị thu hồi và bị cho là những kẻ phản bội có tổ chức. Captain America mở một cuộc điều tra nguồn gốc của SHIELD và anh trở về nơi anh từng trải qua đào tạo cơ bản gần 100 năm trước đây. Những gì anh và Romanoff khám phá ở đó tạo ra một sự phát triển rất đáng ngạc nhiên với SHIELD, một dự án bí mật được gọi là \"Chiến dịch Cái nhìn sâu sắc\", và sự ra mắt của thế hệ tiếp theo của Helicarrier. Họ có thể ngăn chặn nó trước khi quá muộn?', 'https://www.youtube.com/embed/S12-4mXCNj4', '64073ff30852b-TheAvengers2012Poster1.jpg', '64073ff308948-poster-chienbinhmuadong.jpg'),
(54, 'Captain America 2: Chiến Binh Mùa Đông', 'Captain America: The Winter Soldier', 'Anthony Russo, Joe Russo', 2016, 3, 10, 0, 1, 0, 'Chris Evans, Scarlett Johansson, Samuel L. Jackson, Robert Redford, Sebastian Stan, Anthony Mackie, Cobie Smulders, Frank Grillo', '', '6407402d39d82-bietdoisieuanhhung2.jpg', '6407402d3a4fc-poster-black1.jpg'),
(55, 'Chiến Binh Báo Đen', 'Black Panther', 'Black Panther', 2016, 3, 30, 0, 1, 0, 'Black Panther', '', '6407406c02e0c-black1.jpg', '6407406c0315c-poster-bietdoisieuanhhung2.jpg'),
(56, 'Chiến Binh Báo Đen', 'Chiến Binh Báo Đen', 'Ryan Coogler', 2013, 3, 21, 0, 1, 0, 'Frank Grillo, Forest Whitaker', 'https://www.youtube.com/embed/S12-4mXCNj4', '640740da474cb-bietdoisieuanhhuyultron2.jpg', '640740da4783a-poster-Avengers_-_Age_of_Utron_Poster1.jpg'),
(57, 'Phù Thủy Tối Thượng Trong Đa Vũ Trụ Hỗn Loạn', 'Captain America: Kẻ Báo Thù Đầu Tiên', 'Joe Johnston', 2022, 3, 31, 0, 1, 0, 'Captain America: Kẻ Báo Thù Đầu Tiên lấy bối cảnh phim bắt đầu năm 1942, khi Mỹ đang tham gia Thế chiến II và cần tới những chiến binh can trường. Chàng trai Steve Rogers (Chris Evans) là một người như vậy, nhưng thể hình quá thấp bé khiến anh không thể đạt được ước mơ tòng quân. Cơ may đến với Rogers khi anh được chọn tham gia một thí nghiệm của chính phủ, giúp biến người thường trở thành siêu chiến binh. Mọi việc diễn ra suôn sẻ, biến Rogers thành một người cao to vạm vỡ, đầu óc tiếp thu mọi kỹ năng chiến đấu nhanh và vẫn giữ được trái tim nhân hậu.Anh trở thành Captain America, biểu tượng của nước Mỹ kể từ đó. Đối thủ của anh là phe Phát-xít, với quái nhân Red Skull, kẻ không chỉ quyền năng mà còn rất tàn ác.', 'https://www.youtube.com/embed/S12-4mXCNj4', '64074113c2863-Avengers_-_Age_of_Utron_Poster1.jpg', '64074113c2ad8-poster-bietdoisieuanhhung2.jpg'),
(58, 'Phù Thủy Tối Thượng Trong Đa Vũ Trụ Hỗn Loạn', 'Joe Johnston', 'Joe Johnston', 2014, 3, 12, 0, 1, 0, 'Hoạt Hình, Khoa Học-Viễn Tưởng', 'https://www.youtube.com/embed/S12-4mXCNj4', '640741428a40b-TheAvengers2012Poster1.jpg', '640741428a86b-poster-ttxvn_avengers2.jpg'),
(59, 'Phù Thủy Tối Thượng', 'Doctor Strange', 'Scott Derrickson', 2016, 3, 24, 0, 1, 0, 'Hoạt Hình, Hình Sự', 'https://www.youtube.com/embed/S12-4mXCNj4', '6407417bea181-Poster_Captain_America_1.jpg', '6407417bea58c-poster-bietdoisieuanhhuyultron2.jpg'),
(60, 'Phù Thủy Tối Thượng', 'Doctor Strange', 'Scott Derrickson', 2014, 1, 41, 0, 1, 0, 'Benedict Cumberbatch, Benedict Wong, Mads Mikkelsen, Michael Stuhlbarg, Rachel McAdams, Tilda Swinton', 'https://www.youtube.com/embed/S12-4mXCNj4', '640741b207f12-Avengers-Infinity_War-Official-Poster1.jpg', '640741b208254-poster-bietdoisieuanhhuyultron2.jpg'),
(61, 'Phù Thủy Tối Thượng', 'Doctor Strange', 'Scott Derrickson', 2016, 2, 12, 0, 1, 0, 'Benedict Cumberbatch, Benedict Wong, Mads Mikkelsen, Michael Stuhlbarg, Rachel McAdams, Tilda Swinton', 'https://www.youtube.com/embed/S12-4mXCNj4', '640741e06932e-chienbinhmuadong.jpg', '640741e06966b-poster-bietdoisieuanhhung2.jpg'),
(62, 'Captain America 3: Nội Chiến Siêu Anh Hùng', 'Captain America: Civil War', 'Anthony Russo, Joe Russo', 2015, 1, 0, 0, 1, 0, 'Captain America: Nội Chiến Siêu Anh Hùng sẽ trở lại sau một mùa hè bùng nổ với “Avengers: Đế Chế Ultron” và “Ant-Man – Người Kiến”, Marvel Studios tiếp tục khiến các khán giả đứng ngồi không yên khi hé lộ những tình tiết kịch tính của cuộc nội chiến nảy lửa giữa các siêu anh hùng, mở đầu cho Phase 3 trong Vũ Trụ Điện Ảnh Marvel. Trailer mở đầu với phân cảnh đã từng xuất hiện trong After Credit của “Ant-Man: Người Kiến” – Falcon và Captain America tìm thấy Bucky!. “Chiến binh mùa đông” Bucky đã nhớ lại mọi thứ và Captain sẵn sàng cứu anh khỏi sự truy đuổi của chính phủ. Cùng với nhiều sự vụ xảy ra và biệt đội Avengers góp phần không nhỏ trong việc làm thiệt hại tài sản, chính phủ quyết định thiết lập cơ quan quản lý và giám sát những siêu anh hùng này. Sự chia rẽ nội bộ bắt đầu xảy đến. Một bên được lãnh đạo bởi Steve Rogers (Captain America) với mong muốn duy trì cả biệt đội để thực hiện mục tiêu bảo vệ nhân loại mà không có sự can thiệp nào từ bên ngoài. Phe còn lại do Tony Stark (Iron Man) đứng đầu, luôn hỗ trợ giám sát và có trách nhiệm giải trình mọi việc làm với chính phủ. Kịch tính được đẩy lên cao trào khi Captain America và Bucky cùng trực tiếp chiến đấu với Iron Man. Các siêu anh hùng khác cũng chia thành 2 phe, nhưng Marvel vẫn chưa chính thức xác nhận ai sẽ về phe nào. Biệt đội siêu anh hùng trong bom tấn mới nhất này sẽ có thêm hai thành viên đáng chú ý: Black Panther (Chadwick Boseman thủ vai) và Spider-Man do Tom Holland thủ vai – lần đầu tiên xuất hiện trong Vũ Trụ Điện Ảnh Marvel.', 'https://www.youtube.com/embed/S12-4mXCNj4', '6407424370e1d-bietdoisieuanhhung2.jpg', '640742437e640-poster-TheAvengers2012Poster1.jpg'),
(63, 'Captain America 3: Nội Chiến Siêu Anh Hùng', 'Captain America: Civil War', 'Anthony Russo, Joe Russo', 2013, 1, 21, 0, 1, 0, 'Elizabeth Olsen, Tom Holland, Marisa Tomei, Chris Evans, Robert Downey Jr, Paul Rudd, Scarlett Johansson, Sebastian Stan', 'https://www.youtube.com/embed/S12-4mXCNj4', '64074274ee96d-kebaothudautien.png', '64074274eec6e-poster-bietdoisieuanhhuyultron2.jpg'),
(64, 'Captain America 3: Nội Chiến Siêu Anh Hùng', 'Captain America: Civil War', 'Anthony Russo, Joe Russo', 2014, 1, 12, 0, 1, 0, 'Elizabeth Olsen, Tom Holland, Marisa Tomei, Chris Evans, Robert Downey Jr, Paul Rudd, Scarlett Johansson, Sebastian Stan', 'https://www.youtube.com/embed/S12-4mXCNj4', '640742a4ea5dd-Avengers_-_Age_of_Utron_Poster1.jpg', '640742a4ea982-poster-bietdoisieuanhhuyultron2.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `filmtype`
--

CREATE TABLE `filmtype` (
  `filmType_id` int(11) NOT NULL,
  `filmType_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `filmtype`
--

INSERT INTO `filmtype` (`filmType_id`, `filmType_name`) VALUES
(1, 'Phim Bộ'),
(2, 'Phim Lẻ');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `film_actor`
--

CREATE TABLE `film_actor` (
  `film_id` int(11) NOT NULL,
  `actor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `film_actor`
--

INSERT INTO `film_actor` (`film_id`, `actor_id`) VALUES
(44, 173),
(44, 176),
(44, 177),
(44, 178),
(44, 172),
(44, 174),
(45, 179),
(45, 180),
(45, 181),
(45, 182),
(45, 183),
(45, 184),
(45, 185),
(45, 186),
(46, 182),
(46, 187),
(46, 188),
(46, 189),
(46, 186),
(46, 190),
(46, 191),
(47, 182),
(47, 185),
(47, 188),
(47, 192),
(47, 186),
(47, 193),
(47, 194),
(47, 195),
(48, 196),
(48, 197),
(48, 198),
(48, 199),
(48, 200),
(48, 201),
(48, 202),
(48, 203),
(49, 182),
(49, 183),
(49, 185),
(49, 204),
(49, 205),
(49, 206),
(49, 207),
(49, 208),
(50, 205),
(50, 179),
(50, 206),
(50, 204),
(50, 182),
(50, 183),
(50, 185),
(50, 188),
(51, 206),
(51, 182),
(51, 183),
(51, 185),
(52, 189),
(52, 179),
(52, 197),
(52, 203),
(53, 191),
(53, 195),
(53, 195),
(54, 203),
(54, 194),
(54, 203),
(55, 202),
(55, 173),
(56, 195),
(56, 197),
(57, 201),
(57, 201),
(58, 189),
(58, 200),
(59, 175),
(59, 197),
(60, 173),
(60, 176),
(60, 177),
(60, 178),
(60, 172),
(60, 174),
(61, 173),
(61, 176),
(61, 177),
(61, 178),
(61, 172),
(61, 174),
(62, 179),
(62, 180),
(62, 181),
(62, 182),
(62, 183),
(62, 184),
(62, 185),
(62, 186),
(63, 179),
(63, 180),
(63, 181),
(63, 182),
(63, 183),
(63, 184),
(63, 185),
(63, 186),
(64, 179),
(64, 180),
(64, 181),
(64, 182),
(64, 183),
(64, 184),
(64, 185),
(64, 186);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `film_category`
--

CREATE TABLE `film_category` (
  `film_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `film_category`
--

INSERT INTO `film_category` (`film_id`, `category_id`) VALUES
(44, 2),
(44, 12),
(45, 7),
(45, 12),
(46, 7),
(46, 12),
(47, 7),
(47, 6),
(48, 7),
(48, 12),
(49, 7),
(49, 12),
(49, 13),
(50, 7),
(50, 12),
(51, 7),
(51, 12),
(52, 6),
(52, 9),
(52, 11),
(53, 1),
(54, 1),
(54, 6),
(54, 8),
(54, 8),
(54, 11),
(55, 1),
(55, 3),
(55, 6),
(56, 1),
(56, 5),
(57, 1),
(57, 11),
(58, 1),
(58, 12),
(59, 1),
(59, 9),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `manage`
--

CREATE TABLE `manage` (
  `admin_id` int(11) NOT NULL,
  `film_id` int(11) NOT NULL,
  `last_update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nation`
--

CREATE TABLE `nation` (
  `nation_id` int(11) NOT NULL,
  `nation_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `nation`
--

INSERT INTO `nation` (`nation_id`, `nation_name`) VALUES
(1, 'Hàn Quốc'),
(2, 'Trung Quốc'),
(3, 'Mỹ'),
(4, 'Việt Nam'),
(5, 'Anh');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `birthday` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `usertype` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `full_name`, `password`, `birthday`, `email`, `gender`, `usertype`) VALUES
(1, 'son', 'Quach Thanh Son', 'Aptx4869', '2001-03-09', 'zzixx27xy93sq@gmail.com', 'male', 1),
(2, 'sonquach', 'Quach Thanh Son', 'Aptx4869', '2001-03-09', 'zzixx27xy93qs@gmail.com', 'male', 2),
(4, 'sonhb', 'Quach Thanh Son', 'Aptx4869', '2001-09-03', 'zzixx27xy93qs@gmail.com', 'male', 3);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `actor`
--
ALTER TABLE `actor`
  ADD PRIMARY KEY (`actor_id`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Chỉ mục cho bảng `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `film_id` (`film_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `episodes`
--
ALTER TABLE `episodes`
  ADD PRIMARY KEY (`episode_id`),
  ADD KEY `film_id` (`film_id`);

--
-- Chỉ mục cho bảng `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`film_id`),
  ADD KEY `nation_id` (`nation_id`),
  ADD KEY `filmType_id` (`filmType_id`),
  ADD KEY `index_name` (`film_name`),
  ADD KEY `index_name2` (`default_name`);

--
-- Chỉ mục cho bảng `filmtype`
--
ALTER TABLE `filmtype`
  ADD PRIMARY KEY (`filmType_id`);

--
-- Chỉ mục cho bảng `film_actor`
--
ALTER TABLE `film_actor`
  ADD KEY `actor_id` (`actor_id`),
  ADD KEY `film_id` (`film_id`);

--
-- Chỉ mục cho bảng `film_category`
--
ALTER TABLE `film_category`
  ADD KEY `category_id` (`category_id`),
  ADD KEY `film_id` (`film_id`);

--
-- Chỉ mục cho bảng `manage`
--
ALTER TABLE `manage`
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `film_id` (`film_id`);

--
-- Chỉ mục cho bảng `nation`
--
ALTER TABLE `nation`
  ADD PRIMARY KEY (`nation_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `actor`
--
ALTER TABLE `actor`
  MODIFY `actor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=209;

--
-- AUTO_INCREMENT cho bảng `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT cho bảng `episodes`
--
ALTER TABLE `episodes`
  MODIFY `episode_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT cho bảng `film`
--
ALTER TABLE `film`
  MODIFY `film_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT cho bảng `nation`
--
ALTER TABLE `nation`
  MODIFY `nation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`film_id`) REFERENCES `film` (`film_id`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Các ràng buộc cho bảng `episodes`
--
ALTER TABLE `episodes`
  ADD CONSTRAINT `episodes_ibfk_1` FOREIGN KEY (`film_id`) REFERENCES `film` (`film_id`);

--
-- Các ràng buộc cho bảng `film`
--
ALTER TABLE `film`
  ADD CONSTRAINT `film_ibfk_1` FOREIGN KEY (`nation_id`) REFERENCES `nation` (`nation_id`),
  ADD CONSTRAINT `film_ibfk_2` FOREIGN KEY (`filmType_id`) REFERENCES `filmtype` (`filmType_id`);

--
-- Các ràng buộc cho bảng `film_actor`
--
ALTER TABLE `film_actor`
  ADD CONSTRAINT `film_actor_ibfk_1` FOREIGN KEY (`actor_id`) REFERENCES `actor` (`actor_id`),
  ADD CONSTRAINT `film_actor_ibfk_2` FOREIGN KEY (`film_id`) REFERENCES `film` (`film_id`);

--
-- Các ràng buộc cho bảng `film_category`
--
ALTER TABLE `film_category`
  ADD CONSTRAINT `film_category_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`),
  ADD CONSTRAINT `film_category_ibfk_2` FOREIGN KEY (`film_id`) REFERENCES `film` (`film_id`);

--
-- Các ràng buộc cho bảng `manage`
--
ALTER TABLE `manage`
  ADD CONSTRAINT `manage_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `manage_ibfk_2` FOREIGN KEY (`film_id`) REFERENCES `film` (`film_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
