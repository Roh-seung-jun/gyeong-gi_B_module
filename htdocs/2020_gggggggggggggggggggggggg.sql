-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 22-08-15 13:24
-- 서버 버전: 10.4.22-MariaDB
-- PHP 버전: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `2020_gggggggggggggggggggggggg`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `calendars`
--

CREATE TABLE `calendars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `people` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `garden_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 테이블 구조 `disables`
--

CREATE TABLE `disables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `garden_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 테이블의 덤프 데이터 `disables`
--

INSERT INTO `disables` (`id`, `date`, `garden_id`) VALUES
(1, '2022-08-15', '1');

-- --------------------------------------------------------

--
-- 테이블 구조 `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 테이블 구조 `gardens`
--

CREATE TABLE `gardens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `introduce` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `management` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `score` int(11) NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 테이블의 덤프 데이터 `gardens`
--

INSERT INTO `gardens` (`id`, `name`, `address`, `phone`, `introduce`, `management`, `score`, `user_id`) VALUES
(1, '나폴리농원', '경상남도 통영시 산양읍 미륵산길 152', '010-3117-9030', '기존 팔각정자를 바탕으로 전통적인 느낌의 공간을 조성하여 고즈넉하고 편안한 공간 계획, 평택의 이미지와 전통적인 분위기 조성합니다.', '나폴리농원', 5, 'garden_01'),
(2, '사천식물랜드', '경상남도 사천시 용현면 덕곡리 82-4 일원', '010-4590-8718', '분수를 감싸고 있는 아름다운 경사지에 거대한 분수대가 손님을 가장 먼저 맞이하는 광장입니다.', '사천식물랜드', 3, 'garden_02'),
(3, '해솔찬정원', '경상남도 통영시 도산면 저산리 572-1', '055-643-0564', '늘 푸른 구상나무와 초여름 연분홍 꽃을 피우는 자귀나무가 펼쳐진 잔디마당은 관람객들의 눈길을 사로잡는 곳입니다.', '해솔찬정원', 8, 'garden_03'),
(4, '통영동백커피식물원', '경상남도 통영시 도산면 원산리 920 일원', '010-3557-9634', '정원을 만드는 과정에서 죽은 참나무로 쉼터를 만들었으며 봄에는 복수초와 철쭉, 여름에는 산수국, 가을에는 꽃무릇, 구절초를 볼 수 있습니다.', '통영동백커피식물원', 5, 'garden_04'),
(5, '물빛소리정원', '경상남도 통영시 도산면 수월리 655-3', '010-3588-6453', '물빛소리정원 옆으로 길게 뻗은 벚나무길에는 아름다운 루미나리에로 장식되어있어 밤이 되면 그 아름다움을 뽐냅니다.', '물빛소리정원', 1, 'garden_05'),
(6, '춘화의 정원', '경상남도 통영시 도산면 도산일주로 56', '010-2596-6344', '잎이나 단풍, 꽃과 열매, 가지가 빨간색인 식물과 빨간색의 쉘터. 빨간색이 색깔 고유의 파장과 에너지를 활용해 신체와 마음을 치료합니다.', '춘화의 정원', 2, 'garden_06'),
(7, '농부가그린정원', '경상남도 김해시 진영읍 좌곤리 765-1', '010-3832-8430', '빛나는 번영과 발전을 상징하는 정원으로 연속성이 있는 뫼비우스의 띠를 모티브 한 공간을 구상된 정원입니다.', '농부가그린정원', 7, 'garden_07'),
(8, '엄마의정원', '경상남도 밀양시 하남읍 남전7길 41-19', '010-3884-1100', '더불어 살아가는 다채로운 무지개 조형목과 겹겹이 쌓은 나뭇가지로 비유하여 다양한 문화의 포용을 느낄 수 있습니다.', '엄마의정원', 8, 'garden_08'),
(9, '녹색교육정원', '경상남도 양산시 동면 개곡로77번길', '010-5574-7176', '사회와 시민, 자연과 사람간의 소통공간으로 서로를 이해하며 감싸주는 관계의 시작점으로 조화롭게 살아가는 화합을 상징합니다.', '녹색교육정원', 4, 'garden_09'),
(10, '옥동힐링가든', '경상남도 거제시 둔덕면 청마로 665-13', '055-636-8988', '사이프러스 나무를 대체하여 파주지역에 월동이 가능한 은청색의 블루엔젤이라는 측백나무를 식재하여 비스타를 형성하였습니다.', '옥동힐링가든', 9, 'garden_10'),
(11, '새미골정원', '경상남도 양산시 동면 개곡리 564', '010-3885-1567', '사계장미, 플로리분다 등 프랑스, 독일 등의 장미가 자리하고 있습니다. 봄에는 다양한 사계장미가 트렐리스 아치 등에 연출될 예정입니다.', '새미골정원', 1, 'garden_11'),
(12, '느티나무의 사랑', '경상남도 양산시 동면 여락리 103 일원', '055-912-5551', '자수화단이 한눈에 내려다 보이는 해피가든에서는 봄부터 가을까지 매주 재즈공연이 열립니다. 라이브 공연과 함께 즐기는 맥주 한잔의 여유를 즐길 수 있습니다.', '느티나무의 사랑', 3, 'garden_12'),
(13, '만년교정원', '경상남도 창녕군 영산면 원다리길 17', '010-9431-2277', '‘사라진 도시의 복원’이라는 벽화가 있습니다. 폭포의 안으로 들어가면 사라진 도시를 한껏 느낄 수 있습니다.', '만년교정원', 2, 'garden_13'),
(14, '그레이스정원', '경상남도 고성군 상리면 삼상로 1312-71', '055-673-1803', '푸른 잔디밭에서는 결혼, 가정, 출산의 여신인 헤라가 여는 행복의 파티가 열리는 정원입니다.', '그레이스정원', 5, 'garden_14'),
(15, '만화방초정원', '경상남도 고성군 거류면 은황길 82-91', '010-3870-1041', '수목한계선 아래에 자생하는 고산식물과 건조 기후에 사는 다육식물, 마름견딜성 식물들이 실개울과 연못 주변에 다양한 형식으로 연출되었습니다.', '만화방초', 3, 'garden_15'),
(16, '섬이정원', '경상남도 남해군 남면 평산리 888-4번지', '010-2255-3577', '작은 호수 중앙에 하트모양의 섬과 빨간색 흔들다리, 하트모양의 연못, 다양한 수변, 수생 식물과 생물 등이 서식할 수 있는 생태와 사랑을 주제로 한 정원입니다.', '섬이정원', 4, 'garden_16'),
(17, '화계리정원', '경상남도 남해군 이동면 화계리 292-6', '010-4074-6444', '푸른 잔디, 편안한 평상, 시원하게 펼쳐진 나무 그늘에서 잠시 쉬어가는 여유 시간을 즐길 수 있습니다.', '화계리정원', 6, 'garden_17'),
(18, '토피어리정원', '경상남도 남해군 창선면 서부로 270-106', '010-2851-2978', '지형적 제약으로 경사지를 계단형으로 만든 이탈리아의 대표적인 노단 건축식 정원입니다.', '토피어리정원', 5, 'garden_18'),
(19, '하미앙정원', '경남 함양군 함양읍 삼봉로 442-14', '055-964-2500', '새들이 좋아하는 열매 식물들을 심어 놓은 정원으로 파주 운정지구 개발로 없어지게 될 나무들을 이식하여 자연 훼손방지, 자연과 공생하는 친 환경적인 정원입니다.', '하미앙정원', 1, 'garden_19'),
(20, '이수미팜베리정원', '경상남도 거창군 거창읍 가지리 산250-3', '055-945-1789', '남쪽지방 난대 수종과 아열대, 열대, 건조지 수종으로 남도 숲, 녹차밭, 귤원, 동백원, 향기원, 연꽃과 열대성 조류가 있는 버드가든 등 사계절 다양한 테마가 있는 정원입니다.', '이수미팜베리정원', 3, 'garden_20'),
(21, '이한메미술관', '경상남도 거창군 북상면 송계로 1243-15', '010-3227-0345', '다양한 작품이 존재하고 입구에는 아름다운 꽃들과 향기가 공존하는 정원이 존재합니다.', '이한메미술관', 6, 'garden_21'),
(22, '자연의소리정원', '경상남도 거창군 가북면 용암리 산62 일원', '055-262-2729', '사계절 흰색 꽃과 흐니 자작이 둘러쌓고 있는 하얀 빛깔의 숲 중앙에는 달빛이 비치는 연못이 자리하고 있습니다.', '자연의소리정원', 4, 'garden_22');

-- --------------------------------------------------------

--
-- 테이블 구조 `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 테이블의 덤프 데이터 `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(3, '2014_10_12_000000_create_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2022_08_15_102148_create_gardens_table', 2),
(6, '2022_08_15_105019_create_calendars_table', 3),
(7, '2022_08_15_111111_create_disables_table', 3);

-- --------------------------------------------------------

--
-- 테이블 구조 `users`
--

CREATE TABLE `users` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'normal'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 테이블의 덤프 데이터 `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `type`) VALUES
('1', '1', '1', 'normal'),
('admin', '관리자', '1234', 'garden'),
('garden_01', '나폴리농원의 관리자', '1234', 'garden'),
('garden_02', '사천식물랜드의 관리자', '1234', 'garden'),
('garden_03', '해솔찬정원의 관리자', '1234', 'garden'),
('garden_04', '통영동백커피식물원의 관리자', '1234', 'garden'),
('garden_05', '물빛소리정원의 관리자', '1234', 'garden'),
('garden_06', '춘화의 정원의 관리자', '1234', 'garden'),
('garden_07', '농부가그린정원의 관리자', '1234', 'garden'),
('garden_08', '엄마의정원의 관리자', '1234', 'garden'),
('garden_09', '녹색교육정원의 관리자', '1234', 'garden'),
('garden_10', '옥동힐링가든의 관리자', '1234', 'garden'),
('garden_11', '새미골정원의 관리자', '1234', 'garden'),
('garden_12', '느티나무의 사랑의 관리자', '1234', 'garden'),
('garden_13', '만년교정원의 관리자', '1234', 'garden'),
('garden_14', '그레이스정원의 관리자', '1234', 'garden'),
('garden_15', '만화방초정원의 관리자', '1234', 'garden'),
('garden_16', '섬이정원의 관리자', '1234', 'garden'),
('garden_17', '화계리정원의 관리자', '1234', 'garden'),
('garden_18', '토피어리정원의 관리자', '1234', 'garden'),
('garden_19', '하미앙정원의 관리자', '1234', 'garden'),
('garden_20', '이수미팜베리정원의 관리자', '1234', 'garden'),
('garden_21', '이한메미술관의 관리자', '1234', 'garden'),
('garden_22', '자연의소리정원의 관리자', '1234', 'garden'),
('zxc', '승준', 'zxc', 'garden');

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `calendars`
--
ALTER TABLE `calendars`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `disables`
--
ALTER TABLE `disables`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `gardens`
--
ALTER TABLE `gardens`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `calendars`
--
ALTER TABLE `calendars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `disables`
--
ALTER TABLE `disables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 테이블의 AUTO_INCREMENT `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `gardens`
--
ALTER TABLE `gardens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- 테이블의 AUTO_INCREMENT `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
