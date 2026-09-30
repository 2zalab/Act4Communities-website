/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.11.18-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: act4c2641288
-- ------------------------------------------------------
-- Server version	10.11.18-MariaDB-deb12

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `act4c2641288`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `act4c2641288` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `act4c2641288`;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `color` varchar(7) NOT NULL DEFAULT '#007bff',
  `icon` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES
(1,'Eau, hygiène et assainissement','eau-hygiene-et-assainissement','Accès à l’eau potable, hygiène et infrastructures sanitaires.','#138be7','fas fa-tint',1,'2025-07-29 14:22:01','2025-08-03 14:48:27'),
(2,'Réduction des risques de catastrophe','reduction-des-risques-de-catastrophe','Prévention et réponse face aux catastrophes pour protéger les populations.','#840594','fas fa-exclamation-triangle',1,'2025-07-29 14:22:01','2025-08-03 14:46:28'),
(3,'Promotion et protection des droits humains et du genre','genre-autonomisation','Promotion de l’égalité et protection contre les discriminations et violences.','#EC4899','fas fa-balance-scale',1,'2025-07-29 14:22:01','2025-07-29 14:22:01'),
(4,'Gouvernance et gestion durable et inclusive des ressources naturelles','gouvernance-et-gestion-durable-et-inclusive-des-ressources-naturelles','Gestion durable, équitable et participative des ressources environnementales.','#f7483b','fas fa-seedling',1,'2025-07-29 14:22:01','2025-08-03 14:49:43'),
(5,'Conservation de la biodiversité','conservation-de-la-biodiversite','Protection des espèces, écosystèmes et savoirs locaux.','#09a372','fas fa-leaf',1,'2025-07-29 14:22:01','2025-08-03 14:49:16'),
(6,'Changements climatiques et efficacité énergétique','energie-propre','Adaptation climatique et promotion des énergies renouvelables.','#EAB308','fas fa-solar-panel',1,'2025-07-29 14:22:01','2025-07-29 14:22:01');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `contacts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'general',
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `replied_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
INSERT INTO `contacts` VALUES
(3,'Touza Isaac','isaac_touza@outlook.fr','+237 0691805321','Proposition de partenariat','VZEVERVERVER','partnership',1,'2025-07-29 20:54:33','2025-07-29 16:33:31','2025-07-29 20:54:33'),
(4,'Touza Isaac','isaac_touza@outlook.fr',NULL,'Inscription Newsletter','Demande d\'inscription à la newsletter','general',1,NULL,'2025-07-30 18:33:18','2025-08-01 18:57:04'),
(5,'Touza Isaac','touzaisaac@yahoo.com',NULL,'Inscription Newsletter','Demande d\'inscription à la newsletter','general',1,NULL,'2025-08-01 18:54:29','2025-08-01 18:55:29'),
(6,'Touza Isaac','isaac_touza@outlook.fr','691805321','Candidature de bénévolat','REVERBRTTRYNYTTVREVERVREVDVE','volunteer',1,NULL,'2025-08-01 19:29:31','2025-08-03 15:11:14'),
(7,'Mike Levi Wouters','info@speed-seo.net','86282613238','Find act4communities.org SEO Issues totally free','Hi, \r\nWorried about hidden SEO issues on your website? Let us help — completely free. \r\nRun a 100% free SEO check and discover the exact problems holding your site back from ranking higher on Google. \r\n \r\nRun Your Free SEO Check Now \r\nhttps://www.speed-seo.net/check-site-seo-score/ \r\n \r\nOr chat with us and our agent will run the report for you: https://www.speed-seo.net/whatsapp-with-us/ \r\n \r\nBest regards, \r\n \r\n \r\nMike Levi Wouters\r\n \r\nSpeed SEO Digital \r\nEmail: info@speed-seo.net \r\nPhone/WhatsApp: +1 (833) 454-8622','general',0,NULL,'2025-09-07 19:06:12','2025-09-07 19:06:12'),
(8,'Daniel Edwards','danieledwards.websolution08@gmail.com','8454479454','sss','Hello,\r\n\r\nFollowing the completion of your website, we conducted a quick backend check to ensure everything was functioning smoothly. However, the results revealed that your website is currently not appearing on major search engines like Google and Bing when relevant keywords related to your business are searched.\r\n\r\nThis is primarily due to the lack of proper SEO (Search Engine Optimization), which is currently incomplete. Without it, your website will struggle to appear in search results, meaning your target audience won’t be able to find you and your site won’t receive the traffic or conversions it was designed to generate.\r\n\r\nPlease share your phone number and a convenient time for a brief call. We’d be happy to guide you on how we can help you attract more traffic.\r\n\r\nThanks,\r\nDaniel Edwards','volunteer',0,NULL,'2025-09-08 12:28:45','2025-09-08 12:28:45'),
(9,'Mike Walter Olsson','info@digital-x-press.com','87311437252','Add AEO to your SEO strategies today !','Hi, \r\nI realize that some companies find it challenging grasping that SEO is a long-term game and a strategically planned regular commitment. \r\n \r\nUnfortunately, very few marketers have the willingness to observe the progressive yet meaningful benefits that can completely change their search performance. \r\n \r\nWith constant algorithm changes, a reliable, continuous SEO strategy including Answer Engine Optimization (AEO) is critical for getting a profitable outcome. \r\n \r\nIf you recognize this as the best method, partner with us! \r\n \r\nCheck out Our Monthly SEO Services https://www.digital-x-press.com/unbeatable-seo/ \r\n \r\nReach Out on Instant Messaging https://www.digital-x-press.com/whatsapp-us/ \r\n \r\nWe offer exceptional performance for your investment, and you will value choosing us as your digital marketing ally. \r\n \r\nKind regards, \r\nDigital X SEO Experts \r\nPhone/WhatsApp: +1 (844) 754-1148','general',0,NULL,'2025-09-15 11:58:33','2025-09-15 11:58:33'),
(10,'slm_svOt','reststerthorring1986@larpan-mobi4omes.ru','81953495345','slm принтер купить','Найдите идеальный вариант для своего бизнеса и <a href=https://klpl3r.ru/>slm 3d принтер купить|3д принтер slm купить|slm принтер по металлу купить|slm принтер купить</a> уже сегодня! \r\nТакже можно посетить форумы, посвященные slm печати.','general',0,NULL,'2025-10-16 03:05:42','2025-10-16 03:05:42'),
(11,'Mike Stephan Wouters','mike@monkeydigital.co','81223491995','Increase Your Website Traffic with Country-Specific Social Ads – Only $10 for 10K Visits!','Hi there, \r\n \r\nI wanted to check in with something that could seriously improve your website’s visitor count. We work with a trusted ad network that allows us to deliver genuine, geo-targeted social ads traffic for just $10 per 10,000 visits. \r\n \r\nThis isn\'t fake traffic—it’s actual users, tailored to your chosen market and niche. \r\n \r\nWhat you get: \r\n \r\n10,000+ high-quality visitors for just $10 \r\nLocalized traffic for your chosen location \r\nLarger traffic packages available based on your needs \r\nUsed by marketers—we even use this for our SEO clients! \r\n \r\nReady to scale? Check out the details here: \r\nhttps://www.monkeydigital.co/product/country-targeted-traffic/ \r\n \r\nOr ask any questions on WhatsApp: \r\nhttps://monkeydigital.co/whatsapp-us/ \r\n \r\nLooking forward to helping you grow! \r\n \r\nBest, \r\nMike Stephan Wouters\r\n \r\nPhone/whatsapp: +1 (775) 314-7914','general',0,NULL,'2025-11-01 14:46:55','2025-11-01 14:46:55'),
(12,'Mike Tomas Smit','info@professionalseocleanup.com','81362746356','Fix August Google Spam update ranking problems for free','Hi, \r\nWhile reviewing act4communities.org, we spotted toxic backlinks that could put your site at risk of a Google penalty. Especially that this Google SPAM update had a high impact in ranks. This is an easy and quick fix for you. Totally free of charge. No obligations. \r\n \r\nFix it now: \r\nhttps://www.professionalseocleanup.com/ \r\n \r\nNeed help or questions? Chat here: \r\nhttps://www.professionalseocleanup.com/whatsapp/ \r\n \r\nBest, \r\nMike Tomas Smit\r\n \r\n+1 (855) 221-7591 \r\ninfo@professionalseocleanup.com','general',0,NULL,'2025-11-08 18:07:20','2025-11-08 18:07:20'),
(13,'Harold','info@act4communities.org','6991693478','Nous contacter - act4communities','Hey \r\n\r\nI wanted to reach out and let you know about our new dog harness. It\'s really easy to put on and take off - in just 2 seconds - and it\'s personalized for each dog. \r\nPlus, we offer a lifetime warranty so you can be sure your pet is always safe and stylish.\r\n\r\nWe\'ve had a lot of success with it so far and I think your dog would love it. \r\n\r\nGet yours today with 50% OFF:  https://caredogbest.com\r\n\r\nFREE Shipping - TODAY ONLY! \r\n\r\nThank You, \r\n\r\nHarold','partnership',0,NULL,'2025-11-09 01:02:19','2025-11-09 01:02:19'),
(14,'Yasuhiro Yamada','pharmacyrohto@gmail.com','82636632353','Remote Job Opportunity with ROHTO Pharmaceutical','Hello Sir/Madam, \r\n \r\nWith all due respect. We are looking for a Spokesperson/Financial Coordinator whom is based in the \r\nUSA or Canada, for ROHTO \r\nPharmaceutical Co., Ltd. This part-time role offers a minimum $5k salary and requires only a few minutes of your time daily. It will not create any conflicts if you work with other companies. If interested, please contact \r\ninfo@rohtorepsapplication.com \r\n \r\nBest regards, \r\nYasuhiro Yamada \r\nSenior Executive Officer \r\nhttps://rohtorepapplication.com','general',0,NULL,'2025-11-18 06:27:26','2025-11-18 06:27:26'),
(15,'Elissa','elissa.borges@gmail.com','3813033295','Get the Best Proxy Deals — Hand-Picked for You','We monitor the entire proxy market and select only the most profitable offers — discounts, exclusive rates, and limited-time deals.\r\n\r\nConfirm your subscription and start receiving the best proxy offers straight to your inbox. No spam — only real savings.\r\n\r\nhttps://www.novaai.expert/proxy\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\nto UNSUBSCRIBE:\r\nhttps://www.novaai.expert/unsubscribe?domain=act4communities.org\r\nAddress: 108 West Street Comstock Park, MI 48721','general',0,NULL,'2025-11-24 13:17:56','2025-11-24 13:17:56'),
(16,'AhmetBeirl','morrismi1@outlook.com','88274488785','Introduce','I\'m Ahmet, a bank staff in a Turkish bank. I\'ve been looking for someone who has the same nationality as you. A citizen of your country died in the recent earthquake in Turkey, he had in our bank fixed deposit of $11.5 million. \r\n \r\nIf my bank executive finds out about his death ,They would use the funds for themselves, I would like to prevent that from happening only if I get your cooperation, I knew about it because I was his account manager. Last week my bank held a meeting for the purpose of a bank audit to note abandoned deposit accounts. that\'s why I\'m looking for a solution to deal with this situation because if my bank discovers his death, they will divert the funds to the board of directors.  I don\'t want that to happen. \r\n \r\nI request your cooperation to introduce you as the kin/heir of the account as you are of the same nationality as him.  There is no risk;  the transaction is carried out under a legal agreement that protects you from infringement. I suggest we split the funds, 60/40 and 40 for me. I need this fund for my daughter\'s surgery so keep this info confidential. email me so i can provide you with more info  ahmetartk67@outlook.com .','general',0,NULL,'2025-12-12 14:17:42','2025-12-12 14:17:42'),
(17,'Kasey','leone.kasey26@outlook.com','7721551776','Discover how those who manage websites improve the value of current visitors and boost outcomes','If you own a web project, you can skip extra complications — you need better results. \r\n\r\nhttps://sugarrush1000.site/AITitan?act4communities.org\r\n\r\n\r\nThis setup is made to get you get more value from your visitors you are already getting, while avoiding overwhelming setups or added strain. \r\n\r\nIt’s created for website owners who focus on efficiency: fewer repetitive actions, greater visibility, and noticeable improvements in day-to-day results. \r\n\r\nHave a closer look and learn why more and more site owners view this as a smart upgrade for their digital setup.\r\n\r\nhttps://sugarrush1000.site/AITitan?act4communities.org\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\nYou’re receiving this email \r\nbecause we think \r\nthis offer \r\nmay be relevant to you.\r\n\r\nIf you do not wish to receive \r\nfuture messages from us, \r\nyou can \r\nunsubscribe:\r\n\r\nhttps://sugarrush1000.site/unsub?domain=act4communities.org \r\nAddress: Address: 6923   18 Lamphey Road, NA  Wv5 2fw\r\nLooking out for you, Kasey Leone.','partnership',0,NULL,'2025-12-20 18:21:41','2025-12-20 18:21:41'),
(18,'Jayrn','dannielle.maher@gmail.com','2812476806','act4communities.org: Most sites get this wrong when monetizing','Hi, it’s Jayrn.\r\n\r\nIf your site already uses — or is preparing to use — affiliate links, this will be relevant.\r\n\r\nOne issue I see constantly is that monetization is treated as something you “add later,” instead of something that’s designed into the site from the beginning.\r\n\r\nThat usually leads to:\r\nrandom placement of links\r\nunclear visitor intent\r\nunpredictable income\r\n\r\nIt works, but never consistently.\r\n\r\nI put together a short explanation of why this happens and what changes once monetization is structured properly:\r\n\r\nhttps://marketersmentor.com/recurring-income-system.php?refer=act4communities.org\r\n\r\nYou’ll know quickly whether this applies to your situation.\r\n\r\nJayrn\r\n\r\n\r\n\r\nPS: And one quick note so you’re not wondering why you’re hearing from me:\r\nI only reach out to website owners because they’re the ones actively building something online. I’m not blasting random emails. \r\nI’m simply sharing a resource that has been helping a lot of people create predictable online income. If it resonates, great. If not, no worries.\r\n\r\n\r\n\r\n\r\nUnsubscribe: \r\nhttps://marketersmentor.com/unsubscribe.php?d=act4communities.org','general',0,NULL,'2025-12-23 12:33:16','2025-12-23 12:33:16'),
(19,'Mike Francois Rouxson','mike@monkeydigital.co','88147498371','Monkey Digital - built for AI-driven search visibility','Hi, \r\n \r\nSearch is changing faster than most businesses realize. \r\n \r\nMore buyers are now discovering products and services through AI-driven platforms — not only traditional search results. This is why we created the AI Rankings SEO Plan at Monkey Digital. \r\n \r\nIt’s designed to help websites become clear, trusted, and discoverable by AI systems that increasingly influence how people find and choose businesses. \r\n \r\nYou can view the plan here: \r\nhttps://www.monkeydigital.co/ai-rankings/ \r\n \r\nIf you’d like to see whether this approach makes sense for your site, feel free to reach out directly — even a quick question is fine. Whatsapp: https://wa.link/b87jor \r\n \r\n \r\n \r\nBest regards, \r\nMike Francois Rouxson\r\n \r\nMonkey Digital \r\nmike@monkeydigital.co \r\nPhone/Whatsapp: +1 (775) 314-7914','general',0,NULL,'2026-01-27 05:33:41','2026-01-27 05:33:41'),
(20,'Mike Arthur Michel','info@professionalseocleanup.com','86759499882','Fix August Google Spam update ranking problems for free','Hi, \r\nWhile reviewing act4communities.org, we spotted toxic backlinks that could put your site at risk of a Google penalty. Especially that this Google SPAM update had a high impact in ranks. This is an easy and quick fix for you. Totally free of charge. No obligations. \r\n \r\nFix it now: \r\nhttps://www.professionalseocleanup.com/ \r\n \r\nNeed help or questions? Chat here: \r\nhttps://www.professionalseocleanup.com/whatsapp/ \r\n \r\nBest, \r\nMike Arthur Michel\r\n \r\n+1 (855) 221-7591 \r\ninfo@professionalseocleanup.com','general',0,NULL,'2026-01-31 08:34:23','2026-01-31 08:34:23'),
(21,'Sherlyn','domains@search-act4communities.org','44130321','act4communities.org','Hi\r\n\r\nRegister act4communities.org in Google Search Index and have it appear in online search results!\r\n\r\nRegister act4communities.org at  https://searchregister.org','partnership',0,NULL,'2026-03-07 20:08:16','2026-03-07 20:08:16'),
(22,'Alan','domains@search-act4communities.org','7032389871','act4communities.org','Hi\r\n\r\nList act4communities.org in Google Search Index and have it show up  in online search results!\r\n\r\nRegister act4communities.org at  https://searchregister.net','general',0,NULL,'2026-03-27 14:25:41','2026-03-27 14:25:41'),
(23,'Mario','domains@search-act4communities.org','761749452','act4communities.org','Greetings\r\n\r\nSubmit act4communities.org in Google Search Index and have it be displayed in online search results!\r\n\r\nRegister act4communities.org at  https://searchregister.info','volunteer',0,NULL,'2026-04-02 17:39:08','2026-04-02 17:39:08'),
(24,'Joanna','joannariggs211@gmail.com','7813489523','Video Promotion for act4communities.org?','Hi,\r\n\r\nI just visited act4communities.org and wondered if you\'ve ever considered an impactful video to advertise your business? Our videos can generate impressive results on both your website and across social media.\r\n\r\nOur videos cost just $195 (USD) for a 30 second video ($239 for 60 seconds) and include a full script, voice-over and video.\r\n\r\nI can show you some previous videos we\'ve done if you want me to send some over. Let me know if you\'re interested in seeing samples of our previous work.\r\n\r\nRegards,\r\nJoanna','partnership',0,NULL,'2026-05-28 15:33:09','2026-05-28 15:33:09'),
(25,'Joanna','joannaholden1981@gmail.com',NULL,'Google Ads setup for act4communities.org','Hi,\r\n\r\nI noticed act4communities.org isn\'t currently running any Google or Meta ad campaigns.\r\n\r\nRight now your competitors are paying to sit at the top of Google when local customers search for your services — pulling that business away from you every single day.\r\n\r\nWe handle everything from setup to optimisation so you don\'t have to touch it.\r\n\r\nIs this something you would consider?\r\n\r\nBest regards,\r\nJoanna','general',0,NULL,'2026-06-15 07:45:58','2026-06-15 07:45:58'),
(26,'Ananya','ananya@rocketdigitaltech.com','7532833829','Improve Your Search Engine Visibility','Hello http://act4communities.org.,\r\n \r\nWe can place your website on Google 1st page.\r\n \r\nI can give you our Complete SEO Action Plan along with a customary reach and add great value to your product/ service.\r\n \r\nI may send you a SEO Packages & price list. If interested.\r\n \r\nBest Regards,\r\nAnanya\r\nOnline SEO Consultant','general',0,NULL,'2026-07-02 13:34:32','2026-07-02 13:34:32'),
(27,'RobertTew','phenom1og1@gmail.com','87869967987','STEP INTO VICTORY AND CLAIM THE $27,000,000 JACKPOT','The $27,000,000 Jackpot Is Here to Stay http://freeurlredirect.com/df74z','general',0,NULL,'2026-07-19 00:50:26','2026-07-19 00:50:26'),
(28,'RobertTew','phenom1og1@gmail.com','81561126998','STEP INTO VICTORY AND CLAIM THE $27,000,000 JACKPOT','The $27,000,000 Jackpot Is Here to Stay http://freeurlredirect.com/df74z','general',0,NULL,'2026-07-19 00:50:27','2026-07-19 00:50:27'),
(29,'RobertTew','phenom1og1@gmail.com','86287567836','STEP INTO VICTORY AND CLAIM THE $27,000,000 JACKPOT','The $27,000,000 Jackpot Is Here to Stay http://freeurlredirect.com/df74z','general',0,NULL,'2026-07-19 00:50:28','2026-07-19 00:50:28'),
(30,'RobertTew','phenom1og1@gmail.com','86683774358','STEP INTO VICTORY AND CLAIM THE $27,000,000 JACKPOT','The $27,000,000 Jackpot Is Here to Stay http://freeurlredirect.com/df74z','general',0,NULL,'2026-07-19 00:50:29','2026-07-19 00:50:29'),
(31,'RobertTew','phenom1og1@gmail.com','87717586633','STEP INTO VICTORY AND CLAIM THE $27,000,000 JACKPOT','The $27,000,000 Jackpot Is Here to Stay http://freeurlredirect.com/df74z','general',0,NULL,'2026-07-19 00:50:30','2026-07-19 00:50:30'),
(32,'RobertTew','suhallen0@gmail.com','88768323277','THE $27,000,000 JACKPOT IS A MEMENTO OF MONEY','A Single Attempt Could Change Your Outlook With the $27,000,000 Jackpot https://shortmylink.co/WEfCQ','general',0,NULL,'2026-07-22 18:41:07','2026-07-22 18:41:07'),
(33,'RobertTew','suhallen0@gmail.com','83395699374','THE $27,000,000 JACKPOT IS A MEMENTO OF MONEY','A Single Attempt Could Change Your Outlook With the $27,000,000 Jackpot https://shortmylink.co/WEfCQ','general',0,NULL,'2026-07-22 18:41:08','2026-07-22 18:41:08'),
(34,'RobertTew','suhallen0@gmail.com','83163435149','THE $27,000,000 JACKPOT IS A MEMENTO OF MONEY','A Single Attempt Could Change Your Outlook With the $27,000,000 Jackpot https://shortmylink.co/WEfCQ','general',0,NULL,'2026-07-22 18:41:09','2026-07-22 18:41:09'),
(35,'RobertTew','suhallen0@gmail.com','81473479942','THE $27,000,000 JACKPOT IS A MEMENTO OF MONEY','A Single Attempt Could Change Your Outlook With the $27,000,000 Jackpot https://shortmylink.co/WEfCQ','general',0,NULL,'2026-07-22 18:41:11','2026-07-22 18:41:11'),
(36,'RobertTew','suhallen0@gmail.com','81234963267','THE $27,000,000 JACKPOT IS A MEMENTO OF MONEY','A Single Attempt Could Change Your Outlook With the $27,000,000 Jackpot https://shortmylink.co/WEfCQ','general',0,NULL,'2026-07-22 18:41:12','2026-07-22 18:41:12');
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media_files`
--

DROP TABLE IF EXISTS `media_files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `media_files` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) NOT NULL,
  `original_name` varchar(255) NOT NULL,
  `mime_type` varchar(255) NOT NULL,
  `size` bigint(20) NOT NULL,
  `path` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `is_public` tinyint(1) NOT NULL DEFAULT 1,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `media_files_user_id_foreign` (`user_id`),
  CONSTRAINT `media_files_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media_files`
--

LOCK TABLES `media_files` WRITE;
/*!40000 ALTER TABLE `media_files` DISABLE KEYS */;
/*!40000 ALTER TABLE `media_files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_resets_table',1),
(3,'2019_08_19_000000_create_failed_jobs_table',1),
(4,'2019_12_14_000001_create_personal_access_tokens_table',1),
(5,'2025_07_29_133301_create_categories_table',1),
(6,'2025_07_29_133307_create_projects_table',1),
(7,'2025_07_29_133313_create_posts_table',1),
(8,'2025_07_29_133318_create_partners_table',1),
(9,'2025_07_29_133324_create_testimonials_table',1),
(10,'2025_07_29_133330_create_media_files_table',1),
(11,'2025_07_29_133335_create_contacts_table',1),
(12,'2025_07_29_133348_create_pages_table',1),
(13,'2025_07_29_133457_create_permission_tables',1),
(14,'2025_08_01_205519_create_volunteers_table',2),
(15,'2025_08_03_175900_create_partnership_requests_table',3),
(16,'2025_08_03_175955_create_partnership_request_categories_table',3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES
(1,'App\\Models\\User',2),
(1,'App\\Models\\User',6),
(1,'App\\Models\\User',9),
(1,'App\\Models\\User',10),
(1,'App\\Models\\User',11);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `pages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `template` varchar(255) NOT NULL DEFAULT 'default',
  `meta_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta_data`)),
  `is_published` tinyint(1) NOT NULL DEFAULT 1,
  `translations` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`translations`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pages_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES
(1,'À propos','about','<p>Action pour le Développement Communautaire (ADC) est une OSC camerounaise défendant les droits des communautés locales et autochtones à travers la recherche-action, l\'information et la sensibilisation, le renforcement des capacités et le plaidoyer.</p><p>Notre vision est celle d\'un « Cameroun où le développement est centré sur la personne humaine ».</p>','about',NULL,1,NULL,'2025-07-29 14:22:02','2025-07-29 14:22:02'),
(2,'Politique de confidentialité','privacy-policy','<p>Votre vie privée est importante pour nous. Cette politique de confidentialité explique quelles informations personnelles nous collectons et comment nous les utilisons.</p>','default',NULL,1,NULL,'2025-07-29 14:22:02','2025-07-29 14:22:02'),
(3,'Conditions d\'utilisation','terms-of-service','<p>En utilisant notre site web, vous acceptez ces conditions d\'utilisation.</p>','default',NULL,1,NULL,'2025-07-29 14:22:02','2025-07-29 14:22:02');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `partners`
--

DROP TABLE IF EXISTS `partners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `partners` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'partner',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `partners`
--

LOCK TABLES `partners` WRITE;
/*!40000 ALTER TABLE `partners` DISABLE KEYS */;
INSERT INTO `partners` VALUES
(3,'GIZ','partners/IsogVmMvac1TriCBpYRuS8l0CM3IxgHlj63L95eW.jpg','https://giz.de','Coopération allemande','partner',1,3,'2025-07-29 14:22:02','2025-07-29 21:08:46'),
(4,'Maroua Innovation Technology','partners/qShh3cDYnFpNZ2r7ODnn38zegWir7BTUD5l8Vs5C.png','https://maroua-it.com','Partenaire technique','partner',1,4,'2025-07-29 21:12:29','2025-07-29 21:12:29');
/*!40000 ALTER TABLE `partners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `partnership_request_categories`
--

DROP TABLE IF EXISTS `partnership_request_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `partnership_request_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `partnership_request_id` bigint(20) unsigned NOT NULL,
  `category_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_partnership_request_category` (`partnership_request_id`,`category_id`),
  KEY `partnership_request_categories_category_id_foreign` (`category_id`),
  CONSTRAINT `partnership_request_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `partnership_request_categories_partnership_request_id_foreign` FOREIGN KEY (`partnership_request_id`) REFERENCES `partnership_requests` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `partnership_request_categories`
--

LOCK TABLES `partnership_request_categories` WRITE;
/*!40000 ALTER TABLE `partnership_request_categories` DISABLE KEYS */;
INSERT INTO `partnership_request_categories` VALUES
(3,3,2,NULL,NULL),
(4,3,3,NULL,NULL),
(5,3,6,NULL,NULL);
/*!40000 ALTER TABLE `partnership_request_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `partnership_requests`
--

DROP TABLE IF EXISTS `partnership_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `partnership_requests` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `org_name` varchar(255) NOT NULL,
  `org_type` enum('ngo','company','institution','university','foundation','other') NOT NULL,
  `website` varchar(255) DEFAULT NULL,
  `contact_name` varchar(255) NOT NULL,
  `contact_position` varchar(255) DEFAULT NULL,
  `contact_email` varchar(255) NOT NULL,
  `contact_phone` varchar(255) DEFAULT NULL,
  `partnership_type` enum('financial','technical','strategic','academic') NOT NULL,
  `description` text NOT NULL,
  `status` enum('pending','under_review','approved','rejected') NOT NULL DEFAULT 'pending',
  `admin_notes` text DEFAULT NULL,
  `partner_id` bigint(20) unsigned DEFAULT NULL,
  `processed_by` bigint(20) unsigned DEFAULT NULL,
  `processed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `partnership_requests_partner_id_foreign` (`partner_id`),
  KEY `partnership_requests_processed_by_foreign` (`processed_by`),
  CONSTRAINT `partnership_requests_partner_id_foreign` FOREIGN KEY (`partner_id`) REFERENCES `partners` (`id`) ON DELETE SET NULL,
  CONSTRAINT `partnership_requests_processed_by_foreign` FOREIGN KEY (`processed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `partnership_requests`
--

LOCK TABLES `partnership_requests` WRITE;
/*!40000 ALTER TABLE `partnership_requests` DISABLE KEYS */;
INSERT INTO `partnership_requests` VALUES
(3,'The University of Maroua','ngo','https://sahelcommunication.org','Isaac Touza','Lecturer','isaac_touza@outlook.fr','691805321','strategic','sdsvdfbdb','approved',NULL,NULL,6,'2025-08-03 17:54:43','2025-08-03 17:32:12','2025-08-03 17:54:43');
/*!40000 ALTER TABLE `partnership_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` VALUES
('isaac_touza@outlook.fr','$2y$10$EsAjcSq7ICYcq7Ltjmh3VOs1sK/SlT5dQFJrvwg5jPxdr4lfXkiam','2025-08-01 21:50:07');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES
(1,'view_admin','web','2025-07-29 14:22:01','2025-07-29 14:22:01'),
(2,'manage_projects','web','2025-07-29 14:22:01','2025-07-29 14:22:01'),
(3,'manage_posts','web','2025-07-29 14:22:01','2025-07-29 14:22:01'),
(4,'manage_categories','web','2025-07-29 14:22:01','2025-07-29 14:22:01'),
(5,'manage_contacts','web','2025-07-29 14:22:01','2025-07-29 14:22:01'),
(6,'manage_partners','web','2025-07-29 14:22:01','2025-07-29 14:22:01'),
(7,'manage_pages','web','2025-07-29 14:22:01','2025-07-29 14:22:01'),
(8,'manage_users','web','2025-07-29 14:22:01','2025-07-29 14:22:01'),
(9,'manage_media','web','2025-07-29 14:22:01','2025-07-29 14:22:01'),
(10,'manage_settings','web','2025-07-29 14:22:01','2025-07-29 14:22:01');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `posts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `excerpt` text NOT NULL,
  `content` longtext NOT NULL,
  `featured_image` varchar(255) DEFAULT NULL,
  `gallery` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`gallery`)),
  `type` varchar(255) NOT NULL DEFAULT 'article',
  `category_id` bigint(20) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `is_published` tinyint(1) NOT NULL DEFAULT 1,
  `published_at` datetime DEFAULT NULL,
  `translations` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`translations`)),
  `meta_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta_data`)),
  `views_count` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `posts_slug_unique` (`slug`),
  KEY `posts_category_id_foreign` (`category_id`),
  KEY `posts_user_id_foreign` (`user_id`),
  CONSTRAINT `posts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `posts`
--

LOCK TABLES `posts` WRITE;
/*!40000 ALTER TABLE `posts` DISABLE KEYS */;
INSERT INTO `posts` VALUES
(6,'CONSULTATION DES JEUNES DE YouFT EN PRELUDE A LA 11EME SESSION DU GROUPE DE TRAVAIL INTERGOUVERNEMENTAL À COMPOSITION NON LIMITÉE SUR LES SOCIÉTÉS TRANSNATIONALES ET AUTRES ENTREPRISES ET LES DROITS DE L’HOMME','consultation-des-jeunes-de-youft-en-prelude-a-la-11eme-session-du-groupe-de-travail-intergouvernemental-a-composition-non-limitee-sur-les-societes-transnationales-et-autres-entreprises-et-les-droits-de-lhomme','CONSULTATION DES JEUNES DE YouFT EN PRELUDE A LA 11EME SESSION DU GROUPE DE TRAVAIL INTERGOUVERNEMENTAL À COMPOSITION NON LIMITÉE SUR LES SOCIÉTÉS TRANSNATIONALES ET AUTRES ENTREPRISES ET LES DROITS DE L’HOMME','En dépit de leurs apports importants dans l’économie, les sociétés transnationales sont auteures d’importantes violations de droits humains. Pour y mettre un terme, une Résolution du Conseil des Droits de l’Homme des Nations Unies datant de 2014 met en place le Groupe de travail intergouvernemental à composition non limitée sur les sociétés transnationales et autres entreprises et les droits de l’homme chargé d’élaborer un instrument international juridiquement contraignant pour réglementer, dans le cadre du droit international des droits de l’homme, les activités des sociétés transnationales et autres entreprises.  Depuis sa création, le groupe de travail a tenu dix (10) sessions et, depuis le début de l’année 2025, trois (03) sessions de consultations thématiques inter sessions sur des articles précis permettant de négocier le contenu de ce document. Les jeunes et les enfants sont les héritiers de cet instrument.Il est donc indispensable qu’ils contribuent aux sessions de négociation de son contenu. ADC, créateur du mouvement Young Friends of the Treaty, a organisé ce 15 octobre une consultation réunissant les jeunes africains et européens sur les articles 12 à 24 de la mouture du Traité base des négociations de la 11ème session. La session de réflexion a été riche et productive et les représentants du mouvement YouFT la 11ème session de négociation à Genève porteront la voix des jeunes, à côté des organisations telles que Südwind Austria.','images/posts/1760551183_68efe10fd9f9d.jpg',NULL,'news',3,9,1,0,'2025-10-15 18:58:00',NULL,NULL,0,'2025-10-15 15:59:43','2025-10-15 15:59:43');
/*!40000 ALTER TABLE `posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `projects` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `excerpt` text NOT NULL,
  `description` longtext NOT NULL,
  `featured_image` varchar(255) DEFAULT NULL,
  `gallery` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`gallery`)),
  `status` varchar(255) NOT NULL DEFAULT 'active',
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `budget` decimal(15,2) DEFAULT NULL,
  `objectives` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`objectives`)),
  `expected_results` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`expected_results`)),
  `category_id` bigint(20) unsigned NOT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `is_published` tinyint(1) NOT NULL DEFAULT 1,
  `translations` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`translations`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `projects_slug_unique` (`slug`),
  KEY `projects_category_id_foreign` (`category_id`),
  CONSTRAINT `projects_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` VALUES
(1,'LandCam - Suivi de la gouvernance foncière','landcam-suivi-de-la-gouvernance-fonciere','Projet de suivi et amélioration de la gouvernance foncière au Cameroun','<p>Le projet LandCam vise à améliorer la gouvernance foncière au Cameroun à travers le suivi, la sensibilisation et le renforcement des capacités des communautés locales.</p>','images/projects/1753818531_688925a3d7cf2.jpg',NULL,'active','2024-01-01','2025-12-31','Nord et Extrême-Nord Cameroun',500000.00,'[\"Am\\u00e9liorer la gouvernance fonci\\u00e8re\",\"Renforcer les capacit\\u00e9s des communaut\\u00e9s\"]','[\"R\\u00e9duction des conflits fonciers\",\"Meilleure s\\u00e9curisation des droits\"]',4,1,1,NULL,'2025-07-29 14:22:02','2025-07-29 18:48:51'),
(2,'Autonomisation des femmes rurales','autonomisation-des-femmes-rurales','Programme d\'autonomisation économique des femmes en milieu rural','<p>Ce programme vise à renforcer les capacités économiques des femmes rurales à travers la formation, l\'accès au crédit et le développement d\'activités génératrices de revenus.</p>','images/projects/1753818620_688925fc47a4b.jpg',NULL,'completed','2024-03-01','2024-12-31','Région du Nord',250000.00,'[\"Former 500 femmes\",\"Cr\\u00e9er 100 AGR\"]','[\"Augmentation des revenus\",\"Autonomie financi\\u00e8re\"]',3,1,1,NULL,'2025-07-29 14:22:02','2025-07-29 19:01:15');
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resource_categories`
--

DROP TABLE IF EXISTS `resource_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `resource_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `color` varchar(255) NOT NULL DEFAULT '#6B7280',
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `resource_categories_is_active_sort_order_index` (`is_active`,`sort_order`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resource_categories`
--

LOCK TABLES `resource_categories` WRITE;
/*!40000 ALTER TABLE `resource_categories` DISABLE KEYS */;
INSERT INTO `resource_categories` VALUES
(1,'Rapports & Études','rapports-etudes','Rapports d\'activités, études de terrain et analyses sectorielles','fas fa-chart-line','#3B82F6',1,1,'2025-08-28 22:16:59','2025-08-28 22:16:59'),
(2,'Guides & Manuels','guides-manuels','Guides pratiques et manuels de formation','fas fa-book','#10B981',2,1,'2025-08-28 22:16:59','2025-08-28 22:16:59'),
(3,'Politiques & Procédures','politiques-procedures','Documents de politique et procédures organisationnelles','fas fa-gavel','#F59E0B',3,1,'2025-08-28 22:16:59','2025-08-28 22:16:59'),
(4,'Outils & Templates','outils-templates','Outils de travail et modèles de documents','fas fa-tools','#8B5CF6',4,1,'2025-08-28 22:16:59','2025-08-28 22:16:59'),
(5,'Formations & Présentations','formations-presentations','Supports de formation et présentations','fas fa-presentation','#EF4444',5,1,'2025-08-28 22:16:59','2025-08-28 22:16:59'),
(6,'Médias & Publications','medias-publications','Brochures, newsletters et supports de communication','fas fa-newspaper','#06B6D4',6,1,'2025-08-28 22:16:59','2025-08-28 22:16:59');
/*!40000 ALTER TABLE `resource_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `resources`
--

DROP TABLE IF EXISTS `resources`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `resources` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `original_filename` varchar(255) DEFAULT NULL,
  `file_type` varchar(255) DEFAULT NULL,
  `file_size` bigint(20) DEFAULT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `category_id` bigint(20) unsigned NOT NULL,
  `tags` text DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL DEFAULT 0,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `download_count` int(11) NOT NULL DEFAULT 0,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `resources_is_published_created_at_index` (`is_published`,`created_at`),
  KEY `resources_category_id_is_published_index` (`category_id`,`is_published`),
  KEY `resources_is_featured_is_published_index` (`is_featured`,`is_published`),
  KEY `resources_sort_order_index` (`sort_order`),
  CONSTRAINT `resources_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `resource_categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `resources`
--

LOCK TABLES `resources` WRITE;
/*!40000 ALTER TABLE `resources` DISABLE KEYS */;
INSERT INTO `resources` VALUES
(1,'Rapport AG 20224','rapport-ag-20224','Rapport AG 20224','Rapport AG 20224','resources/files/1757082855_liste-agents-police-2025-09-04-23-41.pdf','Liste_Agents_Police_2025-09-04_23-41.pdf','application/pdf',59367,'resources/thumbnails/1757082855_thumb_gs.jpeg',1,'AG, Rapport',1,0,386,0,NULL,NULL,'2025-09-05 12:34:15','2026-08-02 19:43:37');
/*!40000 ALTER TABLE `resources` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` VALUES
(1,1),
(1,2),
(2,1),
(2,2),
(3,1),
(3,2),
(4,1),
(5,1),
(6,1),
(7,1),
(8,1),
(9,1),
(9,2),
(10,1);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES
(1,'admin','web','2025-07-29 14:22:01','2025-07-29 14:22:01'),
(2,'editor','web','2025-07-29 14:22:01','2025-07-29 14:22:01');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testimonials`
--

DROP TABLE IF EXISTS `testimonials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `testimonials` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `position` varchar(255) DEFAULT NULL,
  `organization` varchar(255) DEFAULT NULL,
  `content` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `rating` int(11) NOT NULL DEFAULT 5,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testimonials`
--

LOCK TABLES `testimonials` WRITE;
/*!40000 ALTER TABLE `testimonials` DISABLE KEYS */;
/*!40000 ALTER TABLE `testimonials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES
(2,'Louise LOKUMU','louise@act4communities.org','2025-07-29 14:22:01','$2y$10$zlZPwXquUTZYRHB6MYtICOWKPspiRlyJgPIA3mJL/sOBiAeL5DOE2',NULL,1,'HiBUfwm5F4q9El7KSK22xocLHxVPqZ4fmGtmghieKQExYLKAbfDvqOSym15b','2025-07-29 14:22:01','2025-07-29 14:22:01'),
(6,'Touza Isaac','isaac_touza@outlook.fr',NULL,'$2y$10$nznth0lDGPTtTqveUgzs..8vRYtnmMsDKIXPTAl3TcMxkqkZLyC5e',NULL,1,'Lh937CCFS6CK0dodKSNyilgAJ3bwapqpMz704spfpOwEpOyBhzZnaCyrQ5Di','2025-08-01 21:21:59','2025-08-01 21:21:59'),
(9,'Eliane NDJIATSA','eliane@act4communities.org',NULL,'$2y$10$AivhvQ/R0uMjDp6uE2cL/.F5z9Fx3UrFHeJvrXv4tQ47BwX0lx7Ie',NULL,1,NULL,'2025-09-08 11:38:30','2025-09-08 11:38:30'),
(10,'Christian PORO','christian@act4communities.org',NULL,'$2y$10$JFgV.ueMiUubU3PzHvlT0uRt8/HT/OKBQZFfImEVlRIGW9i5Q9azG',NULL,1,'eH3eUJ04che5WJIRP4wur8T6jl678felI5XFCBl4wC4B4bsRkrIJLeiCn0qb','2025-09-08 11:39:23','2025-09-08 11:39:23'),
(11,'Moïse MBIMBE','mbimbe@act4communities.org',NULL,'$2y$10$EjFlh7vWy7DoZKd1xveJ8uZI.NUUT2EmTyCjYrwUFwZwU54kjEsHa',NULL,1,NULL,'2025-09-08 11:41:16','2025-09-08 11:41:16');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `volunteers`
--

DROP TABLE IF EXISTS `volunteers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `volunteers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `age` int(11) DEFAULT NULL,
  `skills` text DEFAULT NULL,
  `domains` varchar(255) NOT NULL,
  `availability` text DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `volunteers`
--

LOCK TABLES `volunteers` WRITE;
/*!40000 ALTER TABLE `volunteers` DISABLE KEYS */;
/*!40000 ALTER TABLE `volunteers` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-09-08  2:32:39
