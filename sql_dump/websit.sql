-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2017 at 02:18 AM
-- Server version: 10.1.8-MariaDB
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `websit`
--

-- --------------------------------------------------------

--
-- Table structure for table `dogadjajs`
--

CREATE TABLE `dogadjajs` (
  `id` int(10) UNSIGNED NOT NULL,
  `naziv` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vreme_odr` datetime DEFAULT NULL,
  `opis_s` text COLLATE utf8_unicode_ci NOT NULL,
  `slike` text COLLATE utf8_unicode_ci NOT NULL,
  `opis_p` text COLLATE utf8_unicode_ci NOT NULL,
  `arhiva` int(11) NOT NULL,
  `mesto_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `max_br_ul` int(11) NOT NULL,
  `max_rez_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `dogadjajs`
--

INSERT INTO `dogadjajs` (`id`, `naziv`, `vreme_odr`, `opis_s`, `slike`, `opis_p`, `arhiva`, `mesto_id`, `created_at`, `updated_at`, `max_br_ul`, `max_rez_date`) VALUES
(1, 'Enrique Iglesias', '2017-09-04 18:00:00', 'Pop megastar, Enrique Iglesias will hold a concert at Kombank Arena, Belgrade. The concert will take place as part of his “Sex and Love” tour, with which he is promoting his current, tenth studio album, and the audience can expect a real show. ', '1473869139-99875_thumb.jpg**1473869139-99875.jpg', ' The multi-talented, multi-lingual and multi-award winning Enrique – who also enjoys a highly successful writing, record producing and acting career – as well as performing to an enormous fanbase worldwide – has sold over 100 million albums and is dubbed ‘King of Latin Pop’ and “King of Dance” by Billboard. Enrique Iglesias has won the hearts of millions of fans across the world with his songs. Thus far, he has sold more than a hundred million albums, and his hits have been number one on the Billboard charts more than 70 times During his career he has cooperated with many globally renowned musicians and achieved world-wide success (Grammy, Billboard, American Music) . The global Latino star will perform his greatest hits, such as Not in love, Tonight, Do you know, Turn the night up, I like it, Bailamos, Ring my bells, Hero, Bailando, etc. This will be the second concert of the world pop star in Belgrade who delighted our audience with an excellent performance seven years ago. "Thank you for being here tonight, it’s an honor that we end this tour in Belgrade. Thank you all, you are amazing! I’ll see you soon. Cheers, Belgrado! "- with these words Enrique finished his first concert in Belgrade and kept his promise. Enrique Iglesias concert will be just one of a series of events that will mark Arena significant anniversary, 10 years of active work!', 0, 1, '2016-09-01 14:05:40', '2016-09-01 14:05:40', 6, '2016-09-01 16:05:00'),
(2, 'Andreas Šol i Edin Karamazov', '2017-09-23 16:05:00', 'U četvrtak, 29. septembra od 20.00, u Kolarčevoj zadužbini nastupiće Andreas Šol i Edin Karamazov.\r\nNa programu su dela Hendla, Baha, Daulenda, kao i engleske narodne pesme.', '1473689266-91775_thumb.jpg**1473689266-91775.jpg', 'Andreas Šol je nemački pevač koji važi za jednog od najboljih kontratenora današnjice i vodećih interpretatora baroknog repertoara. Njegovo muzičko obrazovanje započelo je u dečačkom horu, da bi sa 17 godina bio primljen u Školu Kantorum Bazilijensis, gde je učio u klasama Ričarda Levita i Renea Jakobsa. Godine 1996, osvojio je nagradu časopisa Gramofon za izvođenja barokne muzike, a između ostalih, dobio je nagrade Eho i Edison.', 1, 1, '2016-09-12 12:07:46', '2016-09-14 14:49:07', 8, '2016-09-18 14:00:00'),
(3, 'Music Bridge', '2017-09-11 17:00:00', 'U četvrtak 8. septembra biće održana mini konferencija Music Bridge, koju prati, u Klubu Doma omladine od 20 časova, showcase koncert perspektivnih beogradskih bendova.', '1473689441-70315_thumb.jpg**1473689441-70315.jpg', 'Nastupaju ENSH, Erik & The Worldly Savages i Nežni Dalibor.\r\n\r\nENSH je elektro pop projekat Milenka Vujoševića, muzičara koji živi na relaciji Toronto – Beograd, Erik & The Worldly Savages čine Erik Mut, pevač i kompozitor iz Toronta i njegov beogradski folk pank sastav, a Nežni Dalibor je beogradski bend, predstvanik neo psihodelik pop rok zvuka.', 0, 1, '2016-09-12 12:10:41', '2016-09-12 12:10:41', 4, '2016-09-09 14:35:00'),
(4, 'Tav Falco’s Panther Burns', '2017-10-13 16:10:00', 'U sali Amerikana Doma omladine Beograda u subotu 10. septembra od 21 čas, u okviru festivala subkulture „Paralel“, nastupa Tav Falco, jedan od najautentičnijih predstavnika garažnog roka, sa svojim bendom Tav Falco’s Panther Burns.', '1473689642-23271_thumb.jpg**1473689642-23271.jpg', 'Tav Falco (Gustavo Antonio Falco), danas gotovo sedamdesetogodišnjak, ima posebno mesto u istoriji garažnog roka, u koji je implementirao par ne baš srodnih žanrova, ali i jak umetnički koncept.\r\n\r\nOdrastao je u ruralnom Arkanzasu i, inficiran delta bluzom i rokenrol muzikom, imao je samo jedan izbor – da se preseli u Memfis i započne rokenrol karijeru. Po dolasku, 1973. godine, Tav i njegov partner Randall Lyon formiraju neprofitabilnu video grupu „TeleVista“, snimaju nastupe lokalnih muzičara i izložbe umetnika i prate memfisku art ekipu po gradu i okolini.', 0, 5, '2016-09-12 12:14:02', '2016-09-12 12:14:02', 10, '2016-10-01 14:20:00'),
(5, 'Jean-Michel Jarre', '2017-09-30 21:00:00', 'U okviru svetske turneje Electronica, 13. novembra u Kombank areni nastupiće Jean-Michel Jarre.', '1473689810-68988_thumb.jpg**1473689810-68988.jpg', 'Na sajtovima Arene i Eventima i dalje nema informacija o prodaji ulaznica ali na zvaničnom portalu ovog kultnog muzičara koncert u Beogradu je najavljen.', 0, 5, '2016-09-12 12:16:51', '2016-09-12 12:16:51', 3, '2016-09-17 14:30:00'),
(6, 'Hip hop – rege veče', '2017-09-22 16:20:00', 'Novi alternatnativni kulturni prostor Dorćol Platz domaćin je u petak 2. septembra hip hop i rege umetnicima.', '1473689965-63123_thumb.jpg**1473689965-63123.jpg', 'Glavni gost je kanadski hip hoper Unknown Mizery, domaću podršku pružiće Hornsman Coyote, Crossroad 25 i Lord Kastro, a kao specijalni gost nastupiće King Calypso Selectah.\r\nUnknown Mizery je hip hop umetnik, koji dolazi iz Toronta. Svojim neprikosnovenim talentom stekao je reputaciju ne samo u Kanadi, već i širom sveta. Član underground sastava Babylon Warchild, kao solo izvođač, sarađivao je i nastupao sa velikim brojem izvođača, među kojima su Arkeologist, Poor Man Militia, Logical Ethix, Bahamadia, Raekwon, Brother Ali, Dead Prez, Pharaoh Monch i drugi. Izdao je četiri zapažena albuma, „The Devil’s Pie On God’s Plate“, „Godzillionaire Status“, „Busking In Bombay“ i „It Will Fall“. Unknown Mizery je jedan od osnivača organizacije Stolen From Africa, koja se bavi razvojem kulture i obrazovanjem mladih u zajednicama koje su pogođene siromaštvom. Među izvođačima koji su podržali projekat su Protoje, Jah 9, KRS One, Kendrick Lamar i drugi.', 0, 5, '2016-09-16 12:19:25', '2016-09-12 12:19:25', 6, '2016-09-15 14:30:00'),
(7, 'Sanjarenje – priča iz Terezina', '2017-09-15 16:00:00', 'Jedna glumica Plavog pozorišta je u svojoj porodici imala iskustvo susreta sa posledicama stradanja jevrejskog naroda. Njena baka i njen deka su preživeli Holokaust. ', '1473792744-55238_thumb.jpg**1473792744-55238.jpg', 'To je ostavilo trag u njenim sećanjima iz detinjstva i ona je želela da prevede ta sećanja na jezik glumačkog izraza.\r\nTo je bio početni impuls za proces rada, koji je trajao nešto više od godinu dana i u koji su ubrzo bili uključeni i ostali članovi pozorišta. Rezultat tog procesa je predstava „Sanjarenje – priča iz Terezina“. Ta predstava je pokušaj senzibiliziranja jevrejskog pitanja kroz jedan drugačiji odnos Jevreja prema Hristu i sa drugačijim ishodom.\r\n\r\n– To je jedna fantastična priča iz logora Terezin, koji je poznat po tome što su u taj logor bili odvođeni istaknuti članovi jevrejske zajednice. U tu izmišljenu priču mi smo spustili Hanu Arent, Karla Marksa, Isusa Hrista i Barabasa, kao istaknute predstavnike jevrejskog naroda i napravili jedno scensko-muzičko delo, bazirano na duhovnim i svetovnim jevrejskim pesmama. Rad na ovoj predstavi za nas je bio neka vrsta našeg duga prema čovečanstvu, koje u svojoj istoriji prepunoj tragedija, ima jedno tako neshvatljivo mesto kao što je Holokaust – napisao je Nenad Čolić, reditelj i scenarista.', 0, 6, '2016-09-13 16:52:24', '2016-09-13 16:52:24', 3, '2016-09-14 14:00:00'),
(8, 'Enrique Iglesias', '2017-09-24 21:06:00', 'Pop megastar, Enrique Iglesias will hold a concert at Kombank Arena, Belgrade. The concert will take place as part of his “Sex and Love” tour, with which he is promoting his current, tenth studio album, and the audience can expect a real show.', '1473793769-24796_thumb.jpg**1473793769-24796.jpg', ' The multi-talented, multi-lingual and multi-award winning Enrique – who also enjoys a highly successful writing, record producing and acting career – as well as performing to an enormous fanbase worldwide – has sold over 100 million albums and is dubbed ‘King of Latin Pop’ and “King of Dance” by Billboard. Enrique Iglesias has won the hearts of millions of fans across the world with his songs. Thus far, he has sold more than a hundred million albums, and his hits have been number one on the Billboard charts more than 70 times During his career he has cooperated with many globally renowned musicians and achieved world-wide success (Grammy, Billboard, American Music) . The global Latino star will perform his greatest hits, such as Not in love, Tonight, Do you know, Turn the night up, I like it, Bailamos, Ring my bells, Hero, Bailando, etc. This will be the second concert of the world pop star in Belgrade who delighted our audience with an excellent performance seven years ago. "Thank you for being here tonight, it’s an honor that we end this tour in Belgrade. Thank you all, you are amazing! I’ll see you soon. Cheers, Belgrado! "- with these words Enrique finished his first concert in Belgrade and kept his promise. Enrique Iglesias concert will be just one of a series of events that will mark Arena significant anniversary, 10 years of active work!', 0, 1, '2016-09-13 17:09:29', '2016-09-13 17:09:29', 10, '2016-09-15 19:09:00'),
(9, 'INDILA', '2017-09-17 19:00:00', 'It’s impossible for Indila to put on a finger on the exact fateful day when music became a revelation. ', '1473794014-28059_thumb.jpg**1473794014-28059.jpg', 'From Michael Jackson to Jacques Brel, passing through Ismaël Lô, Warda or Lata Mangeshka, a famous Indian singer from the 40s, the eclectic influences of this young Parisian reflect a profound taste for the power of emotions.\r\nAt the age of seven, Indila writes her first poems, fascinated by the power of words, the power of an imagination with infinite contours. Dreams and desires of long journeys mingle in a childlike language that outlines what would become her favorite themes. The poems of this dreamer today are her songs. A love for writing she lives like a necessity, a release; to write and sing what she feels about the world, this to escape to her "Mini World," her refuge from the pain in life. Indila signs in 2013 with Capitol Records and works on her debut album Mini World. No borders, symbolic or real, must oppose to her creative impulses and tarnish her definition of music. She entrusts the direction of her tracks with her producer Skalp. Together they form an innovative and complementary artistic tandem. Skalp composes and produces the songs while Indila creates the melodies and texts. With this first album in which she delivers herself, overcoming the label of genres: Obsolete keys that are deliciously nostalgic, and resolutely modern rhythms offer a dense universe, timeless, and singular. "World Music," French variety meets pop, never without blushing about their differences in order to plant a musical territory the size of the world. Her first single “Derniere Danse” was not only number one in France but also in more than 25 countries. So far, the video has over 180 million views on Youtube. Mini World went multi-platinum in several countries and was sold more than 1 million times worldwide. Furthermore, she was number one in more than 15 countries. Her Facebook page has reached the 3.8 million mark and her Youtube channel has over 810.000 subscribers. Recently she won the MTV European Music Award for “Best French Artist 2014”, the “Victoires de la Musique” and the EBBA Award for France.', 0, 5, '2016-09-13 17:13:34', '2016-09-14 14:15:36', 6, '2016-09-14 19:12:00'),
(10, 'Anastacia', '2017-10-21 21:00:00', 'There are singers all round the globe that unleash a worthy listen, an enjoyable song and a memorable sound. ', '1473794328-81108_thumb.jpg**1473794328-81108.jpg', 'There are very few singers in the universe who embed that utterly unique tone you instantly, undoubtedly recognise. That captivating, spine tingling, soulful, big voice that warrants a superstar status. Anastacia is just this. A superstar. ', 0, 1, '2016-09-13 17:18:48', '2016-09-14 14:29:29', 5, '2016-09-30 19:00:00'),
(11, 'Duke Bojadžiev kvintet', '2017-09-16 20:00:00', 'Pod nazivom „Dream. Faith. Love“, u petak 16. septembra u Velikoj dvorani Kolarčeve zadužbine nastupa Duke Bojadžiev kvintet, ansambl  iz Njujorka sa repertoarom jedinstvenog spoja tradicionalne balkanske i klasične muzike.', '1473688926-22846_thumb.jpg**1473688926-22846.jpg', 'Koncert u organizaciji New York Artist Management-a počinje u 20 časova i deo je proslave Dana Republike Makedonije.\r\nDuke Bojadžiev, klavir i kompozicija. Duke Bojadžiev (takođe poznat kao Duke B) je filmski kompozitor, producent i pijanista, koji živi i radi u Njujorku. U svojoj rodnoj Makedoniji Duke je stekao diplomu lekara. Istovremeno razvija strast prema muzici, a konačnu odluku da se njom i profesionalno bavi doneo je kada se upisao na prestižni koledž u Bostonu, Berklee College of Music. Po završetku, 2001. godine, preselio se u Njujork i započeo muzičku karijeru koja se razvijala neprestano uzlaznom putanjom. Između ostalih izdvaja se njegova saradnja sa poznatim rediteljima – dobitnikom Oskara Jonathan Demme-om i Danisom Tanovićem, kao i kandidatom za Oskara, Stole Popovim.\r\n\r\nMuzički uticaj Dukea Bojadžieva se brzo širio – od globalnih reklamnih kampanja (Pežo, Mercedes, L’Oreal, Lancome i Anna Sui), preko multimedije (Fontainebleau Hoteli, Vaniti Fair, GE, i Cosmopolitan), do TV emisija (Marta Stewart i Gjuding Liht). Duke je izdao 7 albuma, a njegova muzika je predstavljena na svetski poznatim CD kompilacijama (Buddha Bar KSIV Chill Out In Paris, i Marrakech Ekpress).', 0, 1, '2016-09-12 12:02:06', '2016-09-12 12:02:06', 5, '2016-09-14 14:01:00');

-- --------------------------------------------------------

--
-- Table structure for table `kategorijas`
--

CREATE TABLE `kategorijas` (
  `id` int(10) UNSIGNED NOT NULL,
  `kategorija` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `naziv` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cena` double NOT NULL,
  `kolicina` int(11) NOT NULL,
  `ulaznica_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `kategorijas`
--

INSERT INTO `kategorijas` (`id`, `kategorija`, `naziv`, `cena`, `kolicina`, `ulaznica_id`, `created_at`, `updated_at`) VALUES
(1, '1', 'parter', 1000, 500, 1, '2016-09-12 12:02:06', '2016-09-12 12:02:06'),
(2, '2', 'sala', 1200, 300, 1, '2016-09-12 12:02:06', '2016-09-12 12:02:06'),
(3, '1', 'sala levo', 1200, 100, 2, '2016-09-12 12:07:47', '2016-09-12 12:07:47'),
(4, '2', 'sala desno', 1200, 100, 2, '2016-09-12 12:07:47', '2016-09-12 12:07:47'),
(5, '3', 'sala sredina', 1500, 200, 2, '2016-09-12 12:07:47', '2016-09-12 12:07:47'),
(6, '4', 'balkon', 1500, 100, 2, '2016-09-12 12:07:47', '2016-09-12 12:07:47'),
(7, '1', 'prva', 500, 100, 3, '2016-09-12 12:10:41', '2016-09-12 12:10:41'),
(8, '2', 'druga', 350, 497, 3, '2016-09-12 12:10:41', '2016-09-12 12:42:01'),
(9, '1', 'prva', 500, 994, 4, '2016-09-12 12:14:03', '2016-09-12 12:21:01'),
(10, '1', 'parter', 1000, 550, 5, '2016-09-12 12:16:51', '2016-09-12 12:16:51'),
(11, '2', 'sala', 1200, 200, 5, '2016-09-12 12:16:51', '2016-09-12 12:16:51'),
(12, '1', 'prva', 1000, 1000, 6, '2016-09-12 12:19:25', '2016-09-12 12:19:25'),
(13, '2', 'druga', 350, 297, 6, '2016-09-12 12:19:25', '2016-09-12 12:21:36'),
(14, '1', 'kategorija 1', 1700, 48, 7, '2016-09-13 16:52:24', '2016-09-13 16:53:13'),
(15, '2', 'kategorija 2', 1300, 100, 7, '2016-09-13 16:52:24', '2016-09-13 16:52:24'),
(16, '1', '1', 6500, 270, 8, '2016-09-13 17:09:29', '2016-09-13 17:09:29'),
(17, '2', '2', 5200, 396, 8, '2016-09-13 17:09:29', '2016-09-13 17:19:58'),
(18, '3', '3', 4100, 500, 8, '2016-09-13 17:09:29', '2016-09-13 17:09:29'),
(19, '4', '4', 3000, 1000, 8, '2016-09-13 17:09:29', '2016-09-13 17:09:29'),
(20, '1', 'prva', 5000, 500, 9, '2016-09-13 17:13:34', '2016-09-13 17:13:34'),
(21, '2', 'druga', 4000, 1000, 9, '2016-09-13 17:13:34', '2016-09-13 17:13:34'),
(22, '1', 'VIP', 10000, 29, 10, '2016-09-13 17:18:48', '2016-09-15 14:13:26'),
(23, '2', 'nivo 1', 6500, 400, 10, '2016-09-13 17:18:48', '2016-09-13 17:18:48'),
(24, '3', 'nivo 2', 4500, 800, 10, '2016-09-13 17:18:48', '2016-09-13 17:18:48'),
(25, '1', '1', 1700, 998, 11, '2016-09-14 14:05:40', '2016-09-14 14:08:07'),
(26, '2', '2', 1300, 1500, 11, '2016-09-14 14:05:40', '2016-09-14 14:05:40');

-- --------------------------------------------------------

--
-- Table structure for table `komentars`
--

CREATE TABLE `komentars` (
  `id` int(10) UNSIGNED NOT NULL,
  `komentar` text COLLATE utf8_unicode_ci NOT NULL,
  `datum` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ocena` int(11) NOT NULL,
  `dogadjaj_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `komentars`
--

INSERT INTO `komentars` (`id`, `komentar`, `datum`, `ocena`, `dogadjaj_id`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'Super', '2016-09-12 14:33:13', 9, 3, '2016-09-12 12:33:13', '2016-09-12 12:33:13', 2),
(2, 'eXTRA je', '2016-09-14 16:09:36', 8, 1, '2016-09-14 14:09:36', '2016-09-14 14:09:36', 3);

-- --------------------------------------------------------

--
-- Table structure for table `mestos`
--

CREATE TABLE `mestos` (
  `id` int(10) UNSIGNED NOT NULL,
  `naziv` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adresa` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `mestos`
--

INSERT INTO `mestos` (`id`, `naziv`, `adresa`, `created_at`, `updated_at`) VALUES
(1, 'Kombank Arena', 'Novi Beograd', '2016-09-12 11:48:19', '2016-09-12 11:48:19'),
(2, 'Kolarac', 'Knez Mihajlova 18', '2016-09-12 11:49:00', '2016-09-12 11:49:00'),
(3, 'Sava Centar', 'Novi Beograd', '2016-09-12 11:49:09', '2016-09-12 11:49:09'),
(4, 'Jugoslovenska Kinoteka', 'Uzun Mirkova 1', '2016-09-12 11:49:38', '2016-09-12 11:49:38'),
(5, 'Dom omladine', 'Makedonska 22/IV', '2016-09-12 11:49:58', '2016-09-12 11:49:58'),
(6, 'Atelje 212', 'Svetogorska 21', '2016-09-12 11:50:16', '2016-09-12 11:50:16');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2016_06_07_083019_dodaj_polja_u_users', 2),
('2016_06_07_101643_drop_enum', 3),
('2016_06_07_101722_redosled_kolona_u_users', 4),
('2016_06_07_101835_vrati_enum', 5),
('2016_06_07_102144_drop2_enum', 6),
('2016_06_07_102244_redosled_kolona_u_users2', 7),
('2016_06_07_102457_redosled_kolona_u_users3', 8),
('2016_06_07_103002_redosled_kolona_u_users4', 9),
('2016_06_07_103309_redosled_kolona_u_users5', 10),
('2016_06_07_104633_obrisi_kolonu_email_i_radnomesto', 11),
('2016_06_07_104745_vrati_kolonu_email_i_radnomesto', 12),
('2016_06_07_105006_promeni_kolonu_email_u_unique', 13),
('2016_06_07_105233_vrati_enum2', 14),
('2016_06_07_114225_promeni_kolonu_email_bez_unique', 15),
('2016_06_07_121322_promeni_kolonu_email_i_username_u_unique', 16),
('2016_06_07_122057_promeni_kolonu_email_i_username_u_unique2', 17),
('2016_06_07_122553_promeni_kolonu_email_i_username_u_unique3', 18),
('2016_06_07_122819_promeni_kolonu_email_i_username_u_unique4', 19),
('2016_06_07_122921_promeni_kolonu_email_i_username_u_unique5', 20),
('2016_06_07_123501_promeni_kolonu_email_i_username_u_unique6', 21),
('2016_06_07_123900_promeni_kolonu_email_i_username_u_unique7', 22),
('2016_06_08_114248_promena_imena_kolona_u_users', 23),
('2016_06_08_115429_promena_imena_kolona_u_users2', 23),
('2016_06_08_115759_promena_imena_kolona_u_users3', 23),
('2016_06_26_052253_migration_cartalyst_sentinel_tabela_users', 24),
('2016_06_26_070447_drop_sentinel_tables', 24),
('2016_06_26_071558_drop_sentinel_tables_sve', 25),
('2016_06_26_071808_promena_imena_tabele_users3', 26),
('2016_06_26_160224_napravi_tabelu_mesto', 27),
('2016_06_26_160615_napravi_tabelu_dogadjaj', 28),
('2016_06_26_161237_napravi_tabelu_rezervacija', 29),
('2016_06_26_161617_napravi_tabelu_ulaznica', 30),
('2016_06_26_161920_napravi_tabelu_komentar', 31),
('2016_06_26_170504_obrisi_enum_polja', 32),
('2016_06_26_170632_dodaj_polja_u_users', 33),
('2016_06_28_142119_dodavanje_kolone_opis_sazetak', 34),
('2016_06_28_143316_dodavanje_kolone_max_rez_date_u_ulaznicas', 35),
('2016_06_29_112917_promeni_ime_koloni_uploads_u_slike', 36),
('2016_07_15_184132_izmena_kolona_u_tabeli_ulaznica', 37),
('2016_07_15_184854_redosled_kolona_u_ulaznica', 37),
('2016_07_15_185358_redosled_kolona_u_ulaznica2', 37),
('2016_07_16_110649_dodavanje_kolona_u_dogadjaj', 38),
('2016_07_16_111147_brisanje_kolona_iz_ulaznica', 39),
('2016_07_16_111338_dodavanje_kolona_u_ulaznica', 40),
('2016_07_16_112628_brisanje_kolona_iz_ulaznica2', 40),
('2016_07_16_204812_dodavanje_kolona_u_rezervacija', 41),
('2016_07_17_115810_promena_kolona_u_dogadjajs', 42),
('2016_07_19_083848_napravi_tabelu_kategorijas', 43),
('2016_09_07_055204_izmena_kolona_u_tabeli_komentar', 44);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rezervacijas`
--

CREATE TABLE `rezervacijas` (
  `id` int(10) UNSIGNED NOT NULL,
  `datum_rezervacije` timestamp NULL DEFAULT NULL,
  `vazi_do` timestamp NULL DEFAULT NULL,
  `status_rezervacije` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ulaznica_id` int(11) NOT NULL,
  `kategorija_id` int(11) NOT NULL,
  `kolicina` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rezervacijas`
--

INSERT INTO `rezervacijas` (`id`, `datum_rezervacije`, `vazi_do`, `status_rezervacije`, `user_id`, `ulaznica_id`, `kategorija_id`, `kolicina`, `created_at`, `updated_at`) VALUES
(1, '2016-09-12 12:21:01', '2016-09-12 12:21:01', 2, 0, 4, 9, 6, '2016-09-12 12:21:01', '2016-09-12 12:21:01'),
(2, '2016-09-12 12:21:36', '2016-09-12 12:21:36', 2, 0, 6, 13, 3, '2016-09-12 12:21:36', '2016-09-12 12:21:36'),
(3, '2016-09-12 12:22:22', '2016-09-18 20:22:00', 1, 2, 6, 13, 4, '2016-09-12 12:22:22', '2016-09-12 12:22:22'),
(4, '2016-09-12 12:22:50', '2016-09-14 12:22:50', 2, 2, 3, 8, 3, '2016-09-12 12:22:50', '2016-09-12 12:42:01'),
(5, '2016-09-12 12:44:22', '2016-09-14 12:44:22', 0, 2, 5, 11, 2, '2016-09-12 12:44:22', '2016-09-12 12:44:31'),
(6, '2016-09-12 12:45:51', '2016-09-14 12:45:51', 1, 2, 4, 9, 8, '2016-09-12 12:45:51', '2016-09-12 12:45:51'),
(7, '2016-09-13 16:53:13', '2016-09-13 16:53:13', 2, 0, 7, 14, 2, '2016-09-13 16:53:13', '2016-09-13 16:53:13'),
(8, '2016-09-13 17:19:58', '2016-09-13 17:19:58', 2, 0, 8, 17, 4, '2016-09-13 17:19:58', '2016-09-13 17:19:58'),
(9, '2016-09-13 17:20:25', '2016-09-13 17:20:25', 2, 0, 10, 22, 17, '2016-09-13 17:20:25', '2016-09-13 17:20:25'),
(10, '2016-09-14 14:06:13', '2016-09-16 14:06:13', 2, 3, 11, 25, 2, '2016-09-14 14:06:13', '2016-09-14 14:08:07'),
(11, '2016-09-15 14:10:15', '2016-09-17 14:10:15', 2, 2, 10, 22, 4, '2016-09-15 14:10:15', '2016-09-15 14:13:26');

-- --------------------------------------------------------

--
-- Table structure for table `ulaznicas`
--

CREATE TABLE `ulaznicas` (
  `id` int(10) UNSIGNED NOT NULL,
  `dogadjaj_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ulaznicas`
--

INSERT INTO `ulaznicas` (`id`, `dogadjaj_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2016-09-12 12:02:06', '2016-09-12 12:02:06'),
(2, 2, '2016-09-12 12:07:47', '2016-09-12 12:07:47'),
(3, 3, '2016-09-12 12:10:41', '2016-09-12 12:10:41'),
(4, 4, '2016-09-12 12:14:02', '2016-09-12 12:14:02'),
(5, 5, '2016-09-12 12:16:51', '2016-09-12 12:16:51'),
(6, 6, '2016-09-12 12:19:25', '2016-09-12 12:19:25'),
(7, 7, '2016-09-13 16:52:24', '2016-09-13 16:52:24'),
(8, 8, '2016-09-13 17:09:29', '2016-09-13 17:09:29'),
(9, 9, '2016-09-13 17:13:34', '2016-09-13 17:13:34'),
(10, 10, '2016-09-13 17:18:48', '2016-09-13 17:18:48'),
(11, 11, '2016-09-14 14:05:40', '2016-09-14 14:05:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `ime` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prezime` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `adresa` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `grad` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tel` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `uloga` int(11) NOT NULL,
  `mesto_id` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ime`, `prezime`, `username`, `password`, `adresa`, `grad`, `tel`, `email`, `status`, `uloga`, `mesto_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Nenad', 'Pivarevic', 'admin', '$2y$10$qGXTGJtGEB7tBW9RdG5bhuauf3Bl5Xuj8BeKQTAJJjYcPou2dl8W2', 'Srpskog husarskog puka 41', 'Beograd', '2365478', 'nenadepo2208@gmail.com', 1, 2, 0, 'fth4B79IWiuvDjns0uk5iGZcB0Fwo4FJThvwUkaHn3QjDciPft24vyDzH2e0', '2016-06-26 08:15:32', '2017-05-20 06:43:05'),
(2, 'Dragan', 'Savic', 'korisnik1', '$2y$10$O97WgSGzzCmsfGawQTDrXeoJCgyfQ/nFz.AxGlElGVroRl71Ezx7K', 'Uzun Mirkova 12', 'Beograd', '12345678', 'brankamilacic@gmail.com', 1, 0, 6, '0CtzuosRyZUVcfxyAAigmONbrHUwGk3PGqNJeyjekH3o1kUlygqgQkrn8eSu', '2016-09-12 11:50:52', '2016-09-13 18:09:39'),
(3, 'Dejan', 'Jovanovic', 'korisnik2', '$2y$10$9sSmnKFDWGebl4A3IK9rF.dtzMIWah3vAXQyExK8.f9VmRyIlXcBO', 'Makedonska 40', 'Beograd', '12345578', 'branka74milacic@gmail.com', 1, 0, 6, 'rK2hcG2qbVpInrj6F6p8CAeXfFrYDXb8oPDrjlKMrNznUkSnze7idzZam3uW', '2016-09-12 11:52:18', '2016-09-14 14:31:24'),
(4, 'Blagoje', 'Stankovic', 'blagajnik1', '$2y$10$/5pLCWKj8iCxBOvCwewlZe.CTQQcnVGmaMIM4Ur08HcP4q7A8vNIy', 'Savska 22', 'Beograd', '032345578', 'anatrifunovic2001@gmail.com', 1, 1, 1, 'SkxKnYoQZYyjAsdvdMGWH9RoEFkgl3Ns0vuNm5WxBZ2O7TdJM14AYg1jYOPO', '2016-09-12 11:53:21', '2017-05-20 07:12:13'),
(5, 'Branka', 'Milacic', 'blagajnik2', '$2y$10$3gRLamIaSl7Si1L6PYRSXuFXBAyE.fbzAQNJda01gZMyD8/zcgqam', 'Makedonska 46', 'Beograd', '0653455789', 'mojemail@gmail.com', 1, 0, 5, 'z8W96AvdUdkFOfk9mnISrCptdG761Ez1gcRFjcciGeRIo4ILR4VOPdFypxVE', '2016-09-12 11:54:59', '2016-09-15 14:20:22'),
(6, 'Petar', 'Perić', 'blagajnik3', '$2y$10$ZEW5kpfefJlRfxFrKqOq0O3h3.aC3VCnvzwtDG9DiglAibdfU6e56', 'Knez Mihajlova 36', 'Beograd', '0641255789', 'pera@petar.com', 1, 1, 6, 'U4j7gMwE346WRTUfLnWr2aQi08TSxCniWt7BwVJKrpqTq1y9GZBro9ZqzEJu', '2016-09-13 16:41:39', '2016-09-13 17:05:35'),
(7, 'Dragan', 'Marković', 'korisnik3', '$2y$10$9XpcsInkrh8w26Zj2HtZVOuCh7T/CPy/KNeZ5Bpg9v1sKp9RXWBd.', 'Neka ulica 2', 'Beograd', '064/123-4567', 'kor3@mail.net', 2, 0, 0, 'MbiPrS9MH58FFsePa04rpgd92yDjO5KoMkSSQdde9TAoIdyeLMPcLKTsWLAQ', '2016-09-13 17:26:11', '2016-09-13 18:12:58'),
(8, 'Dejan', 'Marković', 'korisnik4', '$2y$10$vznq3hwsH4kPpG4dEE/v7eH5YEcW6D0XGI.i87fGR3N1C0X3XqhmO', 'Neka ulica 3', 'Beograd', '064/123-4568', 'dejan@test.com', 1, 0, 0, '6r8hX2f94or00qMtWVW4isVr6mLTexgU2rDus8bvPBml6uFkuOparHE04b79', '2016-09-13 17:50:13', '2016-09-13 18:12:46'),
(9, 'Petar', 'Petrović', 'korisnik5', '$2y$10$oYqP0b3rq18iphuut1AC9eRDuIMK32KP9Z4FIKjbKAwMw7ndJnZl6', 'Neka ulica 4', 'Beograd', '064/123-3567', 'petarp@test.com', 1, 0, 0, 'iWTzA9Y372PMQmNsUF45fOIxd8wXvolJpn7OqoVFBECri8Q71B0tORAYuVVK', '2016-09-13 18:08:48', '2016-09-15 14:19:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dogadjajs`
--
ALTER TABLE `dogadjajs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategorijas`
--
ALTER TABLE `kategorijas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `komentars`
--
ALTER TABLE `komentars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mestos`
--
ALTER TABLE `mestos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `rezervacijas`
--
ALTER TABLE `rezervacijas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ulaznicas`
--
ALTER TABLE `ulaznicas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dogadjajs`
--
ALTER TABLE `dogadjajs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `kategorijas`
--
ALTER TABLE `kategorijas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `komentars`
--
ALTER TABLE `komentars`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `mestos`
--
ALTER TABLE `mestos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `rezervacijas`
--
ALTER TABLE `rezervacijas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `ulaznicas`
--
ALTER TABLE `ulaznicas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
