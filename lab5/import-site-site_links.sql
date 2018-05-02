-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2018 at 08:11 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpclassspring2018`
--
CREATE DATABASE IF NOT EXISTS `phpclassspring2018` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `phpclassspring2018`;

-- --------------------------------------------------------

--
-- Table structure for table `sitelinks`
--

CREATE TABLE `sitelinks` (
  `site_id` int(11) NOT NULL,
  `link` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `sitelinks`
--

INSERT INTO `sitelinks` (`site_id`, `link`) VALUES
(21, 'http://schema.org/WebPage'),
(21, 'https://ssl.gstatic.com/gb/images/b_8d5afc09.png'),
(21, 'https://ssl.gstatic.com/gb/images/b8_3615d64d.png'),
(21, 'https://apis.google.com'),
(21, 'https://plusone.google.com/u/0'),
(21, 'https://ssl.gstatic.com/gb/images/silhouette_24.png'),
(21, 'https://ssl.gstatic.com/gb/images/silhouette_96.png'),
(21, 'https://www.google.com/webhp'),
(21, 'https://www.google.com/imghp'),
(21, 'https://maps.google.com/maps'),
(21, 'https://play.google.com/'),
(21, 'https://www.youtube.com/'),
(21, 'https://news.google.com/nwshp'),
(21, 'https://mail.google.com/mail/'),
(21, 'https://drive.google.com/'),
(21, 'https://www.google.com/intl/en/options/'),
(21, 'https://www.google.com/calendar'),
(21, 'https://translate.google.com/'),
(21, 'http://www.google.com/mobile/'),
(21, 'https://books.google.com/bkshp'),
(21, 'http://www.google.com/shopping'),
(21, 'https://www.blogger.com/'),
(21, 'https://www.google.com/finance'),
(21, 'https://photos.google.com/'),
(21, 'http://video.google.com/'),
(21, 'https://docs.google.com/document/'),
(21, 'https://accounts.google.com/ServiceLogin'),
(21, 'https://www.google.com/'),
(21, 'http://www.google.com/preferences'),
(21, 'http://www.google.com/history/optout'),
(21, 'https://plus.google.com/116899029375914044550'),
(22, 'https://assets-cdn.github.com'),
(22, 'https://avatars0.githubusercontent.com'),
(22, 'https://avatars1.githubusercontent.com'),
(22, 'https://avatars2.githubusercontent.com'),
(22, 'https://avatars3.githubusercontent.com'),
(22, 'https://github-cloud.s3.amazonaws.com'),
(22, 'https://user-images.githubusercontent.com/'),
(22, 'https://assets-cdn.github.com/assets/frameworks-8e75cb55ad06095e497d44ea5c418a39.css'),
(22, 'https://assets-cdn.github.com/assets/github-c9666298ecce451b7fb4a932af2f830b.css'),
(22, 'https://assets-cdn.github.com/assets/site-b4158a9f22ebd9e592779d889c0f9aaf.css'),
(22, 'https://github.com/fluidicon.png'),
(22, 'https://github.com'),
(22, 'https://assets-cdn.github.com/images/modules/open_graph/github-logo.png'),
(22, 'https://assets-cdn.github.com/images/modules/open_graph/github-mark.png'),
(22, 'https://assets-cdn.github.com/images/modules/open_graph/github-octocat.png'),
(22, 'https://assets-cdn.github.com/'),
(22, 'https://collector.githubapp.com/github-external/browser_event'),
(22, 'https://github.com/'),
(22, 'https://api.github.com/_private/browser/stats'),
(22, 'https://api.github.com/_private/browser/errors'),
(22, 'https://assets-cdn.github.com/pinned-octocat.svg'),
(22, 'https://assets-cdn.github.com/favicon.ico'),
(22, 'https://help.github.com/terms'),
(22, 'https://help.github.com/privacy'),
(22, 'https://assets-cdn.github.com/images/modules/site/tenyears/10.png'),
(22, 'https://assets-cdn.github.com/images/modules/site/logos/airbnb-logo.png'),
(22, 'https://assets-cdn.github.com/images/modules/site/logos/sap-logo.png'),
(22, 'https://assets-cdn.github.com/images/modules/site/logos/ibm-logo.png'),
(22, 'https://assets-cdn.github.com/images/modules/site/logos/google-logo.png'),
(22, 'https://assets-cdn.github.com/images/modules/site/logos/paypal-logo.png'),
(22, 'https://assets-cdn.github.com/images/modules/site/logos/bloomberg-logo.png'),
(22, 'https://assets-cdn.github.com/images/modules/site/logos/spotify-logo.png'),
(22, 'https://assets-cdn.github.com/images/modules/site/logos/swift-logo.png'),
(22, 'https://assets-cdn.github.com/images/modules/site/logos/facebook-logo.png'),
(22, 'https://assets-cdn.github.com/images/modules/site/logos/node-logo.png'),
(22, 'https://assets-cdn.github.com/images/modules/site/logos/nasa-logo.png'),
(22, 'https://assets-cdn.github.com/images/modules/site/logos/walmart-logo.png'),
(22, 'https://assets-cdn.github.com/images/modules/site/home-illo-team.svg'),
(22, 'https://assets-cdn.github.com/images/modules/site/home-illo-team-code.svg'),
(22, 'https://assets-cdn.github.com/images/modules/site/home-illo-team-chaos.svg'),
(22, 'https://assets-cdn.github.com/images/modules/site/home-illo-team-tools.svg'),
(22, 'https://assets-cdn.github.com/images/modules/site/home-illo-business.png'),
(22, 'http://www.w3.org/2000/svg'),
(22, 'https://assets-cdn.github.com/images/modules/site/integrators/slackhq.png'),
(22, 'https://assets-cdn.github.com/images/modules/site/integrators/zenhubio.png'),
(22, 'https://assets-cdn.github.com/images/modules/site/integrators/travis-ci.png'),
(22, 'https://assets-cdn.github.com/images/modules/site/integrators/atom.png'),
(22, 'https://assets-cdn.github.com/images/modules/site/integrators/circleci.png'),
(22, 'https://assets-cdn.github.com/images/modules/site/integrators/codeship.png'),
(22, 'https://assets-cdn.github.com/images/modules/site/integrators/codeclimate.png'),
(22, 'https://assets-cdn.github.com/images/modules/site/stories/developers/ariya.png'),
(22, 'https://assets-cdn.github.com/images/modules/site/stories/developers/freakboy3742.png'),
(22, 'https://assets-cdn.github.com/images/modules/site/stories/customers/mailchimp.png'),
(22, 'https://assets-cdn.github.com/images/modules/site/stories/developers/kris-nova.png'),
(22, 'https://assets-cdn.github.com/images/modules/site/stories/developers/yyx990803.png'),
(22, 'https://assets-cdn.github.com/images/modules/site/stories/customers/mapbox.png'),
(22, 'https://assets-cdn.github.com/images/modules/site/stories/developers/jessfraz.png'),
(22, 'http://electron.atom.io/'),
(22, 'https://desktop.github.com/'),
(22, 'https://developer.github.com'),
(22, 'https://education.github.com/'),
(22, 'https://partner.github.com/'),
(22, 'https://community.github.com/'),
(22, 'https://github.com/about'),
(22, 'https://blog.github.com'),
(22, 'https://shop.github.com'),
(22, 'https://github.com/contact'),
(22, 'https://github.community'),
(22, 'https://help.github.com'),
(22, 'https://status.github.com/'),
(22, 'https://help.github.com/articles/github-security/'),
(22, 'https://services.github.com/'),
(22, 'https://assets-cdn.github.com/assets/compat-bb7abfb15ed4ffb0da9056d4c980fba5.js'),
(22, 'https://assets-cdn.github.com/assets/frameworks-039b22b3fc4a4274b5117a4cc610e683.js'),
(22, 'https://assets-cdn.github.com/assets/github-0c9f409a4c79c7aa81a79c53d740bb54.js'),
(23, 'https://duckduckgo.com/'),
(23, 'https://duckduckgo.com/assets/logo_social-media.png'),
(24, 'https://duckduckgo.com/'),
(24, 'https://duckduckgo.com/assets/logo_social-media.png'),
(25, 'http://www.w3.org/1999/xhtml'),
(25, 'https://www.reddit.com/'),
(25, 'https://www.reddit.com/.rss'),
(25, 'https://stats.redditmedia.com'),
(25, 'https://www.reddit.com'),
(25, 'https://www.reddit.com/api/share.json'),
(25, 'https://www.reddit.com/post/login'),
(25, 'https://www.reddit.com/help/useragreement/'),
(25, 'https://www.reddit.com/help/privacypolicy/'),
(25, 'https://www.reddit.com/help/contentpolicy/'),
(25, 'https://www.reddit.com/post/reg'),
(25, 'https://www.reddit.com/subreddits/'),
(25, 'https://www.reddit.com/r/popular/'),
(25, 'https://www.reddit.com/r/all/'),
(25, 'https://www.reddit.com/r/random/'),
(25, 'https://www.reddit.com/users/'),
(25, 'https://www.reddit.com/r/AskReddit/'),
(25, 'https://www.reddit.com/r/worldnews/'),
(25, 'https://www.reddit.com/r/videos/'),
(25, 'https://www.reddit.com/r/funny/'),
(25, 'https://www.reddit.com/r/todayilearned/'),
(25, 'https://www.reddit.com/r/pics/'),
(25, 'https://www.reddit.com/r/gaming/'),
(25, 'https://www.reddit.com/r/movies/'),
(25, 'https://www.reddit.com/r/news/'),
(25, 'https://www.reddit.com/r/gifs/'),
(25, 'https://www.reddit.com/r/mildlyinteresting/'),
(25, 'https://www.reddit.com/r/aww/'),
(25, 'https://www.reddit.com/r/Showerthoughts/'),
(25, 'https://www.reddit.com/r/television/'),
(25, 'https://www.reddit.com/r/Jokes/'),
(25, 'https://www.reddit.com/r/science/'),
(25, 'https://www.reddit.com/r/OldSchoolCool/'),
(25, 'https://www.reddit.com/r/sports/'),
(25, 'https://www.reddit.com/r/IAmA/'),
(25, 'https://www.reddit.com/r/Documentaries/'),
(25, 'https://www.reddit.com/r/TwoXChromosomes/'),
(25, 'https://www.reddit.com/r/explainlikeimfive/'),
(25, 'https://www.reddit.com/r/personalfinance/'),
(25, 'https://www.reddit.com/r/books/'),
(25, 'https://www.reddit.com/r/tifu/'),
(25, 'https://www.reddit.com/r/Futurology/'),
(25, 'https://www.reddit.com/r/dataisbeautiful/'),
(25, 'https://www.reddit.com/r/WritingPrompts/'),
(25, 'https://www.reddit.com/r/nottheonion/'),
(25, 'https://www.reddit.com/r/food/'),
(25, 'https://www.reddit.com/r/Music/'),
(25, 'https://www.reddit.com/r/photoshopbattles/'),
(25, 'https://www.reddit.com/r/EarthPorn/'),
(25, 'https://www.reddit.com/r/philosophy/'),
(25, 'https://www.reddit.com/r/Art/'),
(25, 'https://www.reddit.com/r/nosleep/'),
(25, 'https://www.reddit.com/r/GetMotivated/'),
(25, 'https://www.reddit.com/r/askscience/'),
(25, 'https://www.reddit.com/r/LifeProTips/'),
(25, 'https://www.reddit.com/r/space/'),
(25, 'https://www.reddit.com/r/UpliftingNews/'),
(25, 'https://www.reddit.com/r/DIY/'),
(25, 'https://www.reddit.com/r/history/'),
(25, 'https://www.reddit.com/r/gadgets/'),
(25, 'https://www.reddit.com/r/creepy/'),
(25, 'https://www.reddit.com/r/listentothis/'),
(25, 'https://www.reddit.com/r/blog/'),
(25, 'https://www.reddit.com/r/announcements/'),
(25, 'https://www.reddit.com/r/InternetIsBeautiful/'),
(25, 'https://www.reddit.com/new/'),
(25, 'https://www.reddit.com/rising/'),
(25, 'https://www.reddit.com/controversial/'),
(25, 'https://www.reddit.com/top/'),
(25, 'https://www.reddit.com/gilded/'),
(25, 'https://www.reddit.com/wiki/'),
(25, 'https://www.reddit.com/login'),
(25, 'https://www.reddit.com/search'),
(25, 'https://www.reddit.com/wiki/search'),
(25, 'https://www.reddit.com/submit'),
(25, 'https://en.wikipedia.org/wiki/Pacific_Time_Zone'),
(25, 'https://www.reddit.com/prefs/update/geopopular'),
(25, 'https://imgur.com/a1oEPSn'),
(25, 'https://out.reddit.com/t3_8ghlxm'),
(25, 'https://www.reddit.com/user/HydroStaticSkeletor'),
(25, 'https://www.reddit.com/r/pics/comments/8ghlxm/once_upon_a_time_it_was_my_parents_belief_id_live/'),
(25, 'http://www.bbc.com/news/science-environment-43976977'),
(25, 'https://out.reddit.com/t3_8ghbxn'),
(25, 'https://www.reddit.com/user/mvea'),
(25, 'https://www.reddit.com/r/space/comments/8ghbxn/stephen_hawkings_final_research_paper_just/'),
(25, 'https://i.redd.it/61awwrd7sfv01.jpg'),
(25, 'https://www.reddit.com/user/bennettbrowncomedy'),
(25, 'https://www.reddit.com/r/standupshots/'),
(25, 'https://www.reddit.com/r/standupshots/comments/8gh0yq/pearly_whites/'),
(25, 'https://i.redditmedia.com/E0Eoe4W34RhtSUnya4FXf55PtLnm9jjy6BY0ZuOg2zA.jpg'),
(25, 'https://v.redd.it/4ah21ghtgfv01'),
(25, 'https://www.reddit.com/user/BakedWafflez'),
(25, 'https://www.reddit.com/r/aww/comments/8ggo3n/a_loving_husky/'),
(25, 'https://v.redd.it/4ah21ghtgfv01/HLSPlaylist.m3u8'),
(25, 'https://v.redd.it/4ah21ghtgfv01/DASHPlaylist.mpd'),
(25, 'https://v.redd.it/4ah21ghtgfv01/DASH_600_K'),
(25, 'https://i.imgur.com/slSR3OK.jpg'),
(25, 'https://out.reddit.com/t3_8ggub6'),
(25, 'https://www.reddit.com/user/HumanNutrStudent'),
(25, 'https://www.reddit.com/r/WhitePeopleTwitter/'),
(25, 'https://www.reddit.com/r/WhitePeopleTwitter/comments/8ggub6/paul_the_badass/'),
(25, 'https://i.redditmedia.com/PShvN82NaujDjfM7WZtxEz6Cmsgv4ZFevKAyW2whrcg.jpg'),
(25, 'https://i.redd.it/yuf6tk22tgv01.jpg'),
(25, 'https://www.reddit.com/user/Whirlspell'),
(25, 'https://www.reddit.com/r/NintendoSwitch/'),
(25, 'https://www.reddit.com/r/NintendoSwitch/comments/8gihq2/my_mini_switch_case_keychains_finally_arrived/'),
(25, 'https://i.redditmedia.com/xE8to9elO1Q6dVZIhSIJyMQAPkLLg-XsxqY4LS23HWQ.jpg'),
(25, 'https://i.imgur.com/G7zPvJ7.jpg'),
(25, 'https://out.reddit.com/t3_8ggvrc'),
(25, 'https://www.reddit.com/user/OMGLMAOWTF_com'),
(25, 'https://www.reddit.com/r/rarepuppers/'),
(25, 'https://www.reddit.com/r/rarepuppers/comments/8ggvrc/lowflying_cloud_boye_does_an_awooo/'),
(25, 'https://i.redditmedia.com/q7Xd5mg9yBfapq3qR2dwSOeoGsxnFowO5DMp1EAItZI.jpg'),
(25, 'https://i.imgur.com/Qn6UV5B.jpg'),
(25, 'https://out.reddit.com/t3_8ghd25'),
(25, 'https://www.reddit.com/user/irishamerican'),
(25, 'https://www.reddit.com/r/PandR/'),
(25, 'https://www.reddit.com/r/PandR/comments/8ghd25/andy_and_aprils_age_difference/'),
(25, 'https://i.redditmedia.com/odlCS4fCrDhhqo9R9FELVhoNuYFcHd8V_oVflFKszLw.jpg'),
(25, 'https://i.redd.it/masmy20hpfv01.jpg'),
(25, 'https://www.reddit.com/user/KittenStomper666'),
(25, 'https://www.reddit.com/r/trashy/'),
(25, 'https://www.reddit.com/r/trashy/comments/8gh08w/strip_club_in_az_after_the_strike/'),
(25, 'https://i.redditmedia.com/mq-osj_BlrGk34zBf-a3l6QvsfWNXa1rLif8lRB6cKc.jpg'),
(25, 'https://i.redd.it/3gz6r30aqfv01.jpg'),
(25, 'https://www.reddit.com/user/CaptainReggie'),
(25, 'https://www.reddit.com/r/hmmm/'),
(25, 'https://www.reddit.com/r/hmmm/comments/8ggylg/hmmm/'),
(25, 'https://i.redditmedia.com/ZXwqqphqIZvPVw0EmK1HzQ355Za-F7bZ-jS8xDrn-zY.jpg'),
(25, 'https://i.imgur.com/nHgSCMk.jpg'),
(25, 'https://out.reddit.com/t3_8gghly'),
(25, 'https://www.reddit.com/user/Endless_Vanity'),
(25, 'https://www.reddit.com/r/mildlyinteresting/comments/8gghly/somebody_tipped_me_1_folded_into_a_collared_tshirt/'),
(25, 'https://i.redditmedia.com/-IK1rwUA4cApSjr9u11C470fJ_gVPZNRvze00ds0maI.jpg'),
(25, 'https://i.imgur.com/qeFBqxI.gifv'),
(25, 'https://out.reddit.com/t3_8ghl5a'),
(25, 'https://www.reddit.com/user/gregthegregest2'),
(25, 'https://www.reddit.com/r/GifRecipes/'),
(25, 'https://www.reddit.com/r/GifRecipes/comments/8ghl5a/hand_cut_french_fries/'),
(25, 'https://g.redditmedia.com/xfC_yGjuGRMEB4bEEuMybNVwhLk3FbkGBuGonx4TtRs.gif'),
(25, 'https://i.redd.it/dl1mjjzhhfv01.jpg'),
(25, 'https://www.reddit.com/user/TheDalaiLyallma'),
(25, 'https://www.reddit.com/r/PrequelMemes/'),
(25, 'https://www.reddit.com/r/PrequelMemes/comments/8ggoqh/trying_to_get_upvotes_with_a_mace_windu_quote/'),
(25, 'https://i.redditmedia.com/gKLKz1CJL3a83lpxSd5FAoQ1pEO56X3V4r63A2KwIB4.jpg'),
(25, 'https://imgur.com/hbOdEnw'),
(25, 'https://out.reddit.com/t3_8ggiqu'),
(25, 'https://www.reddit.com/user/BunyipPouch'),
(25, 'https://www.reddit.com/r/interestingasfuck/'),
(25, 'https://www.reddit.com/r/interestingasfuck/comments/8ggiqu/bamboo_forest_in_japan/'),
(25, 'https://i.redd.it/dtek5yzg7gv01.jpg'),
(25, 'https://www.reddit.com/user/Hereiamhereibe2'),
(25, 'https://www.reddit.com/r/gaming/comments/8ghl2j/how_to_play_games_on_a_mac/'),
(25, 'https://i.redditmedia.com/_0nrf4WAwJZ8T_lcAuhVg4jxTPitbU0osYz3Yt9PrF8.jpg'),
(25, 'https://i.imgur.com/W8Y94Op.jpg'),
(25, 'https://out.reddit.com/t3_8gikqp'),
(25, 'https://www.reddit.com/user/sidshembekar'),
(25, 'https://www.reddit.com/r/trippinthroughtime/'),
(25, 'https://www.reddit.com/r/trippinthroughtime/comments/8gikqp/noo_way_dude/'),
(25, 'https://i.redditmedia.com/IUTuvh36YYPeZojfpJ5itcRKg46Ph-7dNk3Hnmn9H98.jpg'),
(25, 'https://ajph.aphapublications.org/doi/10.2105/AJPH.2018.304360'),
(25, 'https://out.reddit.com/t3_8ggtfb'),
(25, 'https://www.reddit.com/user/Wagamaga'),
(25, 'https://www.reddit.com/r/science/comments/8ggtfb/under_scott_pruitt_the_environmental_protection/'),
(25, 'https://i.imgur.com/apf2Mcl.gifv'),
(25, 'https://out.reddit.com/t3_8ghkhy'),
(25, 'https://www.reddit.com/user/doctorzimbabwe'),
(25, 'https://www.reddit.com/r/funny/comments/8ghkhy/not_the_god_of_hammers/'),
(25, 'https://www.theguardian.com/books/booksblog/2011/oct/27/best-times-to-write'),
(25, 'https://out.reddit.com/t3_8ggr9v'),
(25, 'https://www.reddit.com/user/Christopherfromtheuk'),
(25, 'https://www.reddit.com/r/todayilearned/comments/8ggr9v/til_charles_dickens_only_worked_9am_to_2pm_and/'),
(25, 'https://www.nbcnews.com/nightly-news/video/gas-prices-hit-three-year-high-nationwide-1223545411909'),
(25, 'https://out.reddit.com/t3_8gghzp'),
(25, 'https://www.reddit.com/user/thinkB4WeSpeak'),
(25, 'https://www.reddit.com/r/news/comments/8gghzp/gas_prices_hit_threeyear_high_nationwide/'),
(25, 'https://i.imgur.com/Pbf8yWR.jpg'),
(25, 'https://out.reddit.com/t3_8ghqe9'),
(25, 'https://www.reddit.com/user/Michael_by_the_Bay'),
(25, 'https://www.reddit.com/r/evilbuildings/'),
(25, 'https://www.reddit.com/r/evilbuildings/comments/8ghqe9/when_youre_high_on_meth_and_decide_youre_bob_the/'),
(25, 'https://i.redditmedia.com/VZ233IjSF1LotXiR5XW5RLlqWY32fv4Zfr2iPqS5JMA.jpg'),
(25, 'https://v.redd.it/d2b3i7c1yfv01'),
(25, 'https://www.reddit.com/user/EwaGold'),
(25, 'https://www.reddit.com/r/Whatcouldgowrong/'),
(25, 'https://www.reddit.com/r/Whatcouldgowrong/comments/8gh8ff/acting_cool_and_throwing_an_apple_at_someone_wcgw/'),
(25, 'https://v.redd.it/d2b3i7c1yfv01/HLSPlaylist.m3u8'),
(25, 'https://v.redd.it/d2b3i7c1yfv01/DASHPlaylist.mpd'),
(25, 'https://v.redd.it/d2b3i7c1yfv01/DASH_600_K'),
(25, 'https://i.redd.it/0zyvvh1gnfv01.jpg'),
(25, 'https://www.reddit.com/user/OutLiveThemDeadRoses'),
(25, 'https://www.reddit.com/r/mildlyinfuriating/'),
(25, 'https://www.reddit.com/r/mildlyinfuriating/comments/8ggvbs/rented_god_of_war_and_got_paper_instead/'),
(25, 'https://i.redditmedia.com/HGTGjtbX4xfe6N_cP0Hf2XPL72SnN2knu4gdiLnrGtg.jpg'),
(25, 'https://c1.staticflickr.com/1/909/40038765810_d451b078b0_o.jpg'),
(25, 'https://out.reddit.com/t3_8ggdio'),
(25, 'https://www.reddit.com/user/soupyhands'),
(25, 'https://www.reddit.com/r/EarthPorn/comments/8ggdio/predawn_landscape_at_haleakala_hawaii_6674x4449oc/'),
(25, 'https://i.redditmedia.com/eg3vOmGGUFzQnJTzSzq9KQi4ZubqCvQjcHWJiQAXkp4.jpg'),
(25, 'http://ultimateclassicrock.com/pink-floyd-banned-south-africa/'),
(25, 'https://out.reddit.com/t3_8ggovs'),
(25, 'https://www.reddit.com/user/chbailey442013'),
(25, 'https://www.reddit.com/r/todayilearned/comments/8ggovs/til_pink_floyds_the_wall_was_banned_in_south/'),
(25, 'https://redditblog.com'),
(25, 'https://www.redditinc.com'),
(25, 'https://www.redditinc.com/advertising'),
(25, 'https://www.redditinc.com/careers'),
(25, 'https://www.reddit.com/rules/'),
(25, 'https://www.reddithelp.com'),
(25, 'https://www.reddit.com/wiki/reddiquette/'),
(25, 'https://www.reddit.com/help/healthycommunities/'),
(25, 'https://www.reddit.com/contact/'),
(25, 'https://itunes.apple.com/us/app/reddit-the-official-app/id1064216828'),
(25, 'https://play.google.com/store/apps/details'),
(25, 'https://www.reddit.com/buttons/'),
(25, 'https://www.reddit.com/gold/about/'),
(25, 'http://redditgifts.com'),
(25, 'https://www.reddit.com/help/useragreement'),
(25, 'https://www.reddit.com/help/privacypolicy'),
(25, 'https://www.reddit.com/post/unlogged_options'),
(25, 'https://www.reddit.com/r/i18n/wiki/getting_started');

-- --------------------------------------------------------

--
-- Table structure for table `sites`
--

CREATE TABLE `sites` (
  `site_id` int(11) NOT NULL,
  `site` varchar(255) COLLATE utf8_bin NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `sites`
--

INSERT INTO `sites` (`site_id`, `site`, `date`) VALUES
(21, 'https://www.google.com/', '2018-05-01 20:35:17'),
(22, 'https://github.com/', '2018-05-02 09:23:49'),
(23, 'https://duckduckgo.com/', '2018-05-02 10:26:56'),
(24, 'https://duckduckgo.com/', '2018-05-02 10:33:19'),
(25, 'https://www.reddit.com/', '2018-05-02 13:33:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sitelinks`
--
ALTER TABLE `sitelinks`
  ADD KEY `site_id` (`site_id`);

--
-- Indexes for table `sites`
--
ALTER TABLE `sites`
  ADD PRIMARY KEY (`site_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sites`
--
ALTER TABLE `sites`
  MODIFY `site_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sitelinks`
--
ALTER TABLE `sitelinks`
  ADD CONSTRAINT `sitelinks_ibfk_1` FOREIGN KEY (`site_id`) REFERENCES `sites` (`site_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
