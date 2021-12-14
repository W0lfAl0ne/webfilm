-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 13, 2021 lúc 02:03 PM
-- Phiên bản máy phục vụ: 10.4.21-MariaDB
-- Phiên bản PHP: 7.3.30

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
CREATE FUNCTION `total` (`id` INT) RETURNS INT(11) READS SQL DATA
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
(1, 'Song Joong Ki'),
(2, 'Jun Yeo Bin'),
(3, 'Ok Taec Yeon'),
(4, 'Kim Yeo Jin'),
(5, 'Jo Han Chul'),
(6, 'Kwak Dong Yeon'),
(7, 'Lưu Đào'),
(8, 'Châu Du Dân'),
(9, 'Quy Á Lôi'),
(10, 'Triệu Văn Tuyên'),
(11, ' Phan Nhất Y'),
(12, 'Chenglin Liu'),
(13, 'Jianan Guo'),
(14, 'Kwok Wai'),
(15, 'Qianchan Liao'),
(16, 'Yong Liu'),
(17, 'Diêu Thần'),
(18, 'Ngô Diệc Phàm'),
(19, 'Lâm Doãn'),
(20, 'Lâm Canh Tân'),
(134, 'Hà Lạc Lạc'),
(135, 'Trương Lăng Hách'),
(136, 'Đới Lộ Oa'),
(137, 'Nhan An'),
(138, 'Phạm Soái Kỳ'),
(139, 'Thường Bân'),
(140, 'Hoàng Đức Nghị'),
(141, 'Lý Bách Huệ'),
(142, 'Phạm Tịnh Y'),
(143, 'Minh Đạo'),
(144, 'Điềm Nữu'),
(145, 'Tô Hiểu Đồng'),
(146, 'Vương Tử Kỳ'),
(147, 'Dương Đình Đông'),
(148, 'Triệu Nghiêu Kha'),
(149, 'Trịnh Hợp Huệ Tử'),
(150, 'Huỳnh Thánh Trì'),
(151, 'Hồ Văn Triết'),
(152, 'Đài Nhã Văn'),
(153, 'Trịnh Diệu'),
(154, 'Lý Điện Tôn'),
(155, 'Cố Thiên Dật'),
(156, 'Rachel McAdams'),
(157, 'Benedict Cumberbatch'),
(158, 'Tilda Swinton'),
(159, 'Chiwetel Ejiofor'),
(160, 'Benedict Wong'),
(161, 'Mads Mikkelsen'),
(162, 'Michael Stuhlbarg'),
(163, 'Elizabeth Olsen'),
(164, 'Tom Holland'),
(165, 'Marisa Tomei'),
(166, 'Chris Evans'),
(167, 'Robert Downey Jr'),
(168, 'Paul Rudd'),
(169, 'Scarlett Johansson'),
(170, 'Sebastian Stan');

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

--
-- Đang đổ dữ liệu cho bảng `comment`
--

INSERT INTO `comment` (`comment_id`, `film_id`, `user_id`, `time`, `content`) VALUES
(1, 1, 1, '2021-11-19 16:19:51', 'Năm 8 tuổi, Park Joo-hyung (Song Joong-ki) đến Ý sau khi được một gia đình người Ý nhận nuôi. Sau đó anh gia nhập băng đảng Mafia, nơi anh được Don Fabio - người đứng đầu gia tộc Cassano nhận nuôi. Park Joo-hyung được đổi tên thành Vincenzo Cassano và trở thành luật sư người Ý. Anh làm việc cho Mafia với tư cách là một cố vấn và là cánh tay phải đáng tin cậy nhất của Don Fabio. Sau khi Fabio chết thì Paolo (con ruột của Fabio và là thủ lĩnh mới) cố gắng giết Vincenzo. Nên anh đã bỏ trốn đến Seoul ở Hàn Quốc và bắt đầu thu hồi một lượng vàng khổng lồ (15 tấn) được cất giấu trong mật thất nằm ở dưới tòa nhà Geumga-dong Plaza. Vincenzo đã giúp một ông trùm người Trung Quốc cất giữ vàng trong một kho tiền được bảo vệ bởi mafia trong khu phức hợp. Ông trùm chết. Vì không ai khác biết về số vàng đó. Vincenzo đã lên kế hoạch để lấy số vàng và sử dụng nó làm quỹ hưu trí của mình sau khi rời Ý. Tuy nhiên, một công ty bất động sản thuộc tập đoàn Babel đã chiếm quyền sở hữu tòa nhà một cách bất hợp pháp và Vincenzo phải sử dụng các kỹ năng của mình để lấy lại tòa nhà và khôi phục lại vận may của mình. Tại Hàn Quốc, Vincenzo đã gặp gỡ và quen biết với luật sư Hong Cha-Young (Jeon Yeo-bin), cô là kiểu luật sư sẽ làm mọi cách để thắng kiện. Vincenzo Cassano đã phải lòng Hong Cha-Young. Anh cũng đạt được công bằng xã hội theo cách riêng của mình.'),
(2, 1, 3, '2021-11-19 16:19:58', 'Sáng hôm sau, Đường Tăng đang tìm nước để nấu cháo thì đi ngang qua một ngôi nhà. Chủ nhà, một nữ nhân xinh đẹp trong bộ trang phục lộng lẫy (Vương Lệ Khôn) và các chị em của nàng ta, chào đón tất cả bọn họ và mời họ ăn sáng. Tuy nhiên, Tôn Ngộ Không thấy được chúng là Yêu Nhện; hắn cố ý khiêu khích chúng, cho đến khi nàng ta và đồng bọn hiện nguyên hình. Trong trận chiến sau đó, lũ nhện tạo thành một con nhện khổng lồ. Sau khi bị nhiễm độc bởi con nhện, Sa Tăng đổ bệnh và từ từ trở về hình dáng ban đầu, một con cá khổng lồ. Tôn Ngộ Không đánh bại con nhện, Đường Tăng cố gắng cảm hóa nó nhưng Ngộ Không đã giết con yêu quái bằng một cú đánh chí mạng vào đầu. Một lần nữa, Đường Tăng rất bực tức vì sự bất tuân của Tôn Ngộ Không. Tối hôm đó, Tôn Ngộ Không giận dữ thảo luận với các đồ đệ khác về kế hoạch giết Đường Tăng của mình, nhưng những đồ đệ lại sợ quyền năng Như lai thần chưởng của sư phụ. Đường Tăng nghe được cuộc trò chuyện này và cầu nguyện với Đức Phật để giúp đỡ anh ta và cũng thú nhận rằng anh ta thực sự không biết, hoặc có, quyền năng của Đức Phật. Trư Bát Giới nghe lỏm được và nói với Tôn Ngộ Không, người sau đó đã thách thức Đường Tăng đánh nhau với hắn. Khi Tôn Ngộ Không chuẩn bị tấn công, một tia sáng chói lòa tỏa sáng từ trên trời và hắn ta rút lui'),
(18, 1, 3, '2021-11-30 19:38:39', 'bộ trang phục lộng lẫy (Vương Lệ Khôn) và các chị em của nàng ta, chào đón tất cả bọn họ và mời họ ăn sáng. Tuy nhiên, Tôn Ngộ Không thấy được chúng là Yêu Nhện; hắn cố ý khiêu khích chúng, cho đến khi nàng ta và đồng bọn hiện nguyên hình. Trong trận chiến sau đó, lũ nhện tạo thành một con nhện khổng lồ. Sau khi bị nhiễm độc bởi con nhện, Sa Tăng đổ bệnh và từ từ trở về hình dáng ban đầu, một con cá khổng lồ. Tôn Ngộ Không đánh bại con nhện, Đường Tăng cố gắng cảm hóa nó nhưng Ngộ Không đã giết con yêu quái bằng một cú đánh chí mạng vào đầ');

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
(1, 1, 1, 'tập 1', '//ok.ru/videoembed/2423924263543'),
(2, 1, 2, 'tập 2', '//ok.ru/videoembed/2425395153527'),
(3, 1, 3, 'tập 3', '//ok.ru/videoembed/2436141943415'),
(4, 1, 4, 'tập 4', '//ok.ru/videoembed/2438472731255'),
(5, 1, 5, 'tập 5', '//ok.ru/videoembed/2449145858679'),
(6, 1, 6, 'tập 6', '//ok.ru/videoembed/2451723258487'),
(7, 1, 7, 'tập 7', '//ok.ru/videoembed/2463320115831'),
(8, 1, 8, 'tập 8', '//ok.ru/videoembed/2465319488119'),
(9, 1, 9, 'tập 9', '//ok.ru/videoembed/2477898599031'),
(10, 1, 10, 'tập 10', '//ok.ru/videoembed/2481011100279'),
(11, 1, 11, 'tập 11', '//ok.ru/videoembed/2509086067438'),
(12, 1, 12, 'tập 12', '//ok.ru/videoembed/2511773829870'),
(13, 1, 13, 'tập 13', '//ok.ru/videoembed/2511646427767'),
(14, 1, 14, 'tập 14', '//ok.ru/videoembed/2514182408823'),
(15, 1, 15, 'tập 15', '//ok.ru/videoembed/2528582109815'),
(16, 1, 16, 'tập 16', '//ok.ru/videoembed/2531172813431'),
(17, 2, 1, 'tập 1', 'https://em.iq.com/player.html?id=1unh0803ofk&mod=vn&lang=vi_vn'),
(18, 2, 2, 'tập 2', 'https://em.iq.com/player.html?id=2fbw70b7shk&mod=vn&lang=vi_vn'),
(19, 2, 3, 'tập 3', 'https://em.iq.com/player.html?id=2eo27zjaogs&mod=vn&lang=vi_vn'),
(20, 2, 4, 'tập 4', 'https://em.iq.com/player.html?id=z3oxspp9k4&mod=vn&lang=vi_vn'),
(21, 2, 5, 'tập 5', 'https://em.iq.com/player.html?id=ptrqxtnwbw&mod=vn&lang=vi_vn'),
(22, 2, 6, 'tập 6', 'https://em.iq.com/player.html?id=1lwiulrlu4c&mod=vn&lang=vi_vn'),
(23, 2, 7, 'tập 7', 'https://em.iq.com/player.html?id=2fzq3bi7vbs&mod=vn&lang=vi_vn'),
(24, 2, 8, 'tập 8', 'https://em.iq.com/player.html?id=1we072tjre0&mod=vn&lang=vi_vn'),
(25, 2, 9, 'tập 9', 'https://em.iq.com/player.html?id=b4gwjf2gb8&mod=vn&lang=vi_vn'),
(26, 2, 10, 'tập 10', 'https://em.iq.com/player.html?id=25eg3gk2h5o&mod=vn&lang=vi_vn'),
(27, 3, 1, 'Full', '//ok.ru/videoembed/2583166192366'),
(28, 4, 1, 'Full', '//ok.ru/videoembed/2585426791150'),
(29, 1, 0, 'Tập 17', '//ok.ru/videoembed/2561129122423'),
(32, 32, 0, 'Tập 1', '//ok.ru/videoembed/2557182151414'),
(33, 32, 0, 'Tập 2', '//ok.ru/videoembed/2557195782902'),
(34, 32, 0, 'Tập 3', '//ok.ru/videoembed/2557343697654'),
(35, 32, 0, 'Tập 4', '//ok.ru/videoembed/2557360278262'),
(36, 32, 0, 'Tập 5', '//ok.ru/videoembed/2557378300662'),
(37, 32, 0, 'Tập 6', '//ok.ru/videoembed/2557401434870'),
(38, 32, 0, 'Tập 7', '//ok.ru/videoembed/2557411068662'),
(39, 32, 0, 'Tập 8', '//ok.ru/videoembed/2557420374774'),
(40, 32, 0, 'Tập 9', '//ok.ru/videoembed/2559526308598'),
(41, 32, 0, 'Tập 10', '//ok.ru/videoembed/2559532534518'),
(51, 35, 1, 'full', 'https://www.youtube.com/embed/EhZdDbLtjR4'),
(53, 36, 1, 'full', 'https://www.youtube.com/embed/dKrVegVI0Us');

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
(1, 'Vincenzo', 'Vincenzo', 'Kim Hee Won', 2021, 1, 20, 17, 1, 1, 'Vincenzo kể về Cassano là một người Hàn Quốc được gia đình Ý nhận nuôi từ bé. Anh vốn sở hữu sức hút vô song cùng kỹ năng đàm phán tuyệt đỉnh, mục đích duy nhất của anh là trả thù dưới danh nghĩa trùm Mafia Ý. Vốn dĩ Vincenzo không muốn trở lại đất nước Hàn Quốc, quê hương với những quá khứ đẫm máu, đau khổ nhưng anh buộc phải về khi phát hiện ra một băng đảng độc ác, có nguồn gốc sâu xa đến từ Hàn Quốc. Tại đây a cùng với nữ luật sư tài giỏi Hong Cha Young (Jeon Yeo Bin thủ vai) và thực tập sinh Jang Joon Woo (Taecyeon đảm nhận) kết hợp điều tra những vụ án bí ẩn chưa có lời giải đáp trong khoảng thời gian dài.', 'https://www.youtube.com/embed/S12-4mXCNj4', 'https://i0.wp.com/image.motphim.net/poster/vincenzo-8706.jpg?1617547106', 'https://ss-images.saostar.vn/wp1000/pc/1612324479842/105252591_1.jpg'),
(2, 'ĐẠI TỐNG CUNG TỪ', 'Palace of Devotion', 'Lý Thiếu Hồng', 2021, 2, 61, 61, 1, 7, 'Đại Tống Cung Từ kể về mối tình của Lưu Nga (Lưu Đào đóng) và Triệu Hằng (Châu Du Dân đóng). Lưu Nga từ nhỏ mồ côi cả cha và mẹ. Bà lưu lạc khắp nơi, gặp được một nghệ nhân tên Cung Mỹ nạp làm thiếp và cùng đi làm nghề nghệ nhân kim hoàn. Tài nghệ Cung Mỹ nổi tiếng trong kinh thành, Tương vương Triệu Hằng nghe đến, đưa về phủ của mình để phục vụ, Lưu Nga cũng đi theo Cung Mỹ vào phủ, đó là lúc Triệu Hằng gặp được Lưu Nga. Lưu Nga thông minh xinh đẹp, lại cùng tuổi với Triệu Hằng nên cả hai nhanh chóng thân thiết, dần dần thành nhất kiến chung tình. Lấy bối cảnh lịch sử Hàm Bình Chi Trị và Nhân Tông Thịnh Trị làm không gian lịch sử của phim. Đại Tống Cung Từ tường thuật sinh động những biến cố, sự kiện từ năm 985 đến năm 1033 công nguyên. Vào thời đại Chân Tông Bắc Tống, những vị quan tài đức nổi tiếng, mối bang giao giữa nước Tống và các nước lân cận, nương tựa lẫn nhau, kiềm chế lẫn nhau.', 'https://www.youtube.com/embed/Ig8UREAq1ck', 'https://i0.wp.com/image.motphim.net/poster/dai-tong-cung-tu-8788.jpg?1618335713', 'https://bloganchoi.com/wp-content/uploads/2021/03/review-phim-dai-tong-cung-tu.jpg'),
(3, 'Lôi Chấn Tử: Phong Thần Duyên Khởi', 'Thunder Twins', 'Zhao Cong', 2021, 2, 1, 1, 2, 8, 'Thuở xưa Thiên Tôn dùng linh khí trời đất bày trận Phong Thần, người tộc Vũ trời sinh đã có cánh, do thám chuyện thế gian giữa đất trời, một khi gặp loạn thế, sẽ lợi dụng đôi cánh Phong Lôi khởi động trận. Những năm cuối Ân Thương, đứa trẻ định mệnh Lôi Chấn Tử và Tân Hoàn gánh vác sứ mệnh của người tộc Vũ, muốn sử dụng đôi cánh Phong Lôi cùng sức mạnh Tướng Tinh mở trận Phong Thần, câu chuyện bắt đầu từ đây.', 'https://www.youtube.com/embed/o796irNT61g', 'https://pic8.iqiyipic.com/image/20210224/c7/64/v_157246033_m_601_en_260_360.jpg', 'https://static.ssphim.net/static/5fe2d564b3fa6403ffa11d1c/6086ca22dad8d3182ae807f1_loi-chan-tu-1.jpg'),
(4, 'TÂY DU KÝ: MỐI TÌNH NGOẠI TRUYỆN 2', 'Journey To The West: Demon Chapte', 'Châu Tinh Trì, Từ Khắc', 2017, 2, 1, 1, 2, 9, 'Tây Du Ký: Mối Tình Ngoại Truyện 2 - Tây Du Hành Ma: Lần này thầy trò Đường tăng trên hành trình đi Tây thiên thỉnh kinh . Tuy bề ngoài 4 thầy trò luôn hòa thuận đoàn kết nhưng ẩn sâu trong đó luôn có sự xung đột bằng mặt không bằng lòng', 'https://www.youtube.com/embed/nV9s7HZrHzY', 'https://i0.wp.com/image.motphim.net/poster/tay-du-ky-moi-tinh-ngoai-truyen-2-245.jpg?1537845301', 'https://i.ytimg.com/vi/IHZP9KZgYOo/maxresdefault.jpg'),
(32, 'Anh Ấy Hoàn Hảo', 'Love Crossed', 'Yu Zhong Zhong, Wu Jian Xin', 2021, 2, 24, 10, 1, 6, 'Anh Ấy Hoàn Hảo – Love Crossed (2021) kể về cuộc gặp gỡ và trải nghiệm tình yêu của hai nữ chính và bốn thần tượng “ảo”, kêu gọi mọi người quay về thực tại, quý trọng cuộc sống, cuối cùng sẽ gặt hái được tình yêu đẹp.\r\n\r\nLục Tiếu ấm áp như mùa xuân trong thế giới ảo nhưng lại khá nhạy cảm và cô độc trong cuộc sống thực. Tô Liệt có thể phải trải qua một cuộc sống đầy khó khăn nhưng cô ấy vẫn luôn hy vọng rằng sẽ gặp được hoàng tử hoàn hảo trong cuộc đời của mình.\r\n\r\nTrên thực tế bộ phim xoay quanh bốn nhân vật chính hoàn hảo tên Y4 gồm Lục Tiếu, Tô Liệt, Hứa Niệm và Lạc Khải. Bốn nhân vật hư cấu này được xây dựng dựa trên cơ sở dữ liệu về nhóm hoa mỹ nam G4 mà công ty giải trí Diệu đã thu thập được. Nhóm G4 có nhiều khuyết điểm, hoàn toàn trái ngược với nhóm Y4, hơn nữa còn không có kinh nghiệm trong chuyện tình cảm.\r\n\r\nNữ chính Khương Khả và Quan Thiên Nhã vô tình phát hiện ra bí mật của Love Boys và âm mưu phía sau của Giải trí Diệu. CEO của giải trí Diệu Từ Quảng hàn âm thầm thao túng mọi chuyện, dưới sự ảnh hưởng của Khả Lạc cùng Thiên Nhã, kế hoạch bỏ trốn của G4 gặp muôn vàn khó khăn.', 'https://www.youtube.com/embed/sRhp1vyZJUY', 'https://i.imgur.com/fsBLvHf.jpg', 'https://phim33.co/upload/images/2021/05/anh-ay-hoan-hao-2021-big.jpg'),
(35, 'Phù Thủy Tối Thượng', 'Doctor Strange', 'Scott Derrickson', 2016, 3, 1, 1, 2, 10, 'Phù Thủy Tối Thượng - Doctor Strange là câu truyệnv về một chuyên gia giải phẫu thần kinh. Sau một tai nạn xe hơi khủng khiếp, Stephen đã đến Tây Tạng học cách điều khiển được tiềm lực ma thuật bên trong bản thân và của thế giới xung quanh, cũng như cách mượn sức mạnh của các thần linh và chúa quỷ. Khi quyền năng của Stephen đạt tới cực đại thì cũng là lúc cái tên Dotor Strange ra đời. Trong truyện tranh nhân vật này còn được Death (người yêu của Thanos) ban cho cuộc sống trường sinh bất lão. Sau này Dr. Strane trở về Mỹ, dùng sức mạnh của mình để bảo vệ người vô tội, bảo vệ thế giới khỏi những thế lực hắc ám. Sự nghiệp siêu anh hùng của ông cũng bắt đầu từ đây.', 'https://www.youtube.com/embed/EhZdDbLtjR4', 'https://mp-focus-opensocial.googleusercontent.com/gadgets/proxy?container=focus&refresh=604800&url=https%3A%2F%2Fi0.wp.com%2Fimage.motphim.net%2Fposter%2Fphu-thuy-toi-thuong-208.jpg', 'https://lh3.googleusercontent.com/proxy/54owsA2EJuctD1ux9j4ECLMoEUoanrP61yZR2a1BkjvIgYH84yo0Vc1ykH8NaDpj5URPOJjT6sb-rzPI6Bx9CcPnCoBhn4iLv5ZA1e1b9Zi8umCANAYl-JRU61_vv57m3Mn_eZvLdN-7hrrIsw'),
(36, 'CAPTAIN AMERICA 3: NỘI CHIẾN SIÊU ANH HÙNG', 'Captain America: Civil War', 'Anthony Russo, Joe Russo', 2016, 3, 1, 1, 2, 9, 'Captain America: Nội Chiến Siêu Anh Hùng sẽ trở lại sau một mùa hè bùng nổ với “Avengers: Đế Chế Ultron” và “Ant-Man – Người Kiến”, Marvel Studios tiếp tục khiến các khán giả đứng ngồi không yên khi hé lộ những tình tiết kịch tính của cuộc nội chiến nảy lửa giữa các siêu anh hùng, mở đầu cho Phase 3 trong Vũ Trụ Điện Ảnh Marvel. Trailer mở đầu với phân cảnh đã từng xuất hiện trong After Credit của “Ant-Man: Người Kiến” – Falcon và Captain America tìm thấy Bucky!. “Chiến binh mùa đông” Bucky đã nhớ lại mọi thứ và Captain sẵn sàng cứu anh khỏi sự truy đuổi của chính phủ. Cùng với nhiều sự vụ xảy ra và biệt đội Avengers góp phần không nhỏ trong việc làm thiệt hại tài sản, chính phủ quyết định thiết lập cơ quan quản lý và giám sát những siêu anh hùng này. Sự chia rẽ nội bộ bắt đầu xảy đến. Một bên được lãnh đạo bởi Steve Rogers (Captain America) với mong muốn duy trì cả biệt đội để thực hiện mục tiêu bảo vệ nhân loại mà không có sự can thiệp nào từ bên ngoài. Phe còn lại do Tony Stark (Iron Man) đứng đầu, luôn hỗ trợ giám sát và có trách nhiệm giải trình mọi việc làm với chính phủ. Kịch tính được đẩy lên cao trào khi Captain America và Bucky cùng trực tiếp chiến đấu với Iron Man. Các siêu anh hùng khác cũng chia thành 2 phe, nhưng Marvel vẫn chưa chính thức xác nhận ai sẽ về phe nào. Biệt đội siêu anh hùng trong bom tấn mới nhất này sẽ có thêm hai thành viên đáng chú ý: Black Panther (Chadwick Boseman thủ vai) và Spider-Man do Tom Holland thủ vai – lần đầu tiên xuất hiện trong Vũ Trụ Điện Ảnh Marvel.', 'https://www.youtube.com/embed/dKrVegVI0Us', 'https://upload.wikimedia.org/wikipedia/vi/5/53/Captain_America_Civil_War_poster.jpg', 'https://vtv1.mediacdn.vn/thumb_w/650/2016/captain-america-civil-war-wallpaper-more-final-piece-for-now-607639-1461931850002.jpg');

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
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(2, 7),
(2, 8),
(2, 9),
(2, 10),
(2, 11),
(32, 134),
(32, 135),
(32, 136),
(32, 137),
(32, 138),
(32, 139),
(32, 140),
(32, 141),
(32, 142),
(32, 143),
(32, 144),
(3, 12),
(3, 13),
(3, 14),
(3, 15),
(3, 16),
(35, 156),
(35, 157),
(35, 158),
(35, 159),
(35, 160),
(35, 161),
(35, 162),
(36, 163),
(36, 164),
(36, 165),
(36, 166),
(36, 167),
(36, 168),
(36, 169),
(36, 170),
(4, 17),
(4, 18),
(4, 19),
(4, 20);

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
(1, 7),
(1, 9),
(1, 10),
(1, 11),
(1, 13),
(2, 5),
(2, 6),
(2, 14),
(32, 16),
(3, 5),
(3, 6),
(3, 7),
(35, 7),
(35, 12),
(36, 7),
(36, 12),
(4, 5),
(4, 6),
(4, 7),
(4, 15);

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
(3, 'son01', 'Quach Thanh Son', 'Aptx4869', '2001-03-09', 'zzixx27xy93qs@gmail.com', 'female', 3),
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
  MODIFY `actor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;

--
-- AUTO_INCREMENT cho bảng `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT cho bảng `episodes`
--
ALTER TABLE `episodes`
  MODIFY `episode_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT cho bảng `film`
--
ALTER TABLE `film`
  MODIFY `film_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

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
