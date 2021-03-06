-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 12. Jan 2021 um 13:30
-- Server-Version: 10.4.11-MariaDB
-- PHP-Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `blog`
--
CREATE DATABASE IF NOT EXISTS `blog` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `blog`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `blogs`
--

DROP TABLE IF EXISTS `blogs`;
CREATE TABLE `blogs` (
  `blog_id` int(11) NOT NULL,
  `blog_headline` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `blog_imagePath` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blog_imageAlignment` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `blog_content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `blog_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `cat_id` int(11) NOT NULL,
  `usr_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `blogs`
--

INSERT INTO `blogs` (`blog_id`, `blog_headline`, `blog_imagePath`, `blog_imageAlignment`, `blog_content`, `blog_date`, `cat_id`, `usr_id`) VALUES
(1, 'Harry Potter und der arme Junge mit den Füßen', 'uploaded_images/85692yilbdsrkovpczgqahnwfmuxetj1610375443_04_-_katze.jpg', 'left', 'Harry blickte hinauf. Er versuchte, einen Brief zu fangen. Onkel Vernons glänzende Faust war so hoch, dass man sie nicht einmal mehr gesehen hat. „Das ist sehr lustig!“, sagte Tante Petunia. Sie fuhr rückwärts in die Küche. Harry drehte sich auf dem Boden. Er hielt ein paar alte Socken in der Hand und schwang sie in die Lüfte.\r\n\r\n„Oh ja, ich bin der schlechteste in der Schule!“, rief Ron voller Nägel. Hagrid hob Harry und Ron auf und drückte sie. Er setzte sich auf Dudley und war verschwunden.\r\n„Was ist passiert?“, fragte Harry neugierig und versuchte angestrengt, in einen Mülleimer zu fassen. „Ich verhungere gleich!“, murmelte Onkel Vernon und stopfte sich ein Bein in den Mund.\r\n\r\nHarry hatte einen Brief für sich auf seinem Gesicht. Er warf seinen Zauberstab aus Mahagoni in den Wagen und fuhr nach Hogwarts.\r\nAuf halbem Weg zum Vordereingang trat Hermine mit einem Lächeln auf einen kleinen Jungen. „Er ist eingeschlafen!“, sagte sie freundlich und Harry bemerkte, dass sie all die Augen ihrer Mutter hatte. In einer Ecke des Schlosses brach er sich die Hände.\r\n\r\nVor der Tür sagte Dumbledore:“ Ich wette, ich kann mir einen Rennbesen aus dem Kopf reißen!“ Und er konnte es.\r\n\r\nDas Dach des Schlosses brach Harry auf den Kopf und er war nicht einmal daran interessiert. Der Stein der Weisen hatte sich kaum merklich Cracker in den Schnabel geklemmt. Er konnte fliegen und verabschiedete sich.', '2021-01-11 14:30:43', 1, 1),
(2, 'The wonderful world of Typography', 'uploaded_images/372955zdfhgsyojicvxwtpkurblanemq1610375611_coloured-hand-drawn-typography_1191-11.jpg', 'right', 'abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ ! &quot;§ $%&amp; /() =? * &apos;&lt;&gt; |; ²³~ @`´ ©«» ¤¼× {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ ! &quot;§ $%&amp; /() =? * &apos;&lt;&gt; |; ²³~ @`´ ©«» ¤¼× {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ ! &quot;§ $%&amp; /() =? * &apos;&lt;&gt; |; ²³~ @`´ ©«» ¤¼× {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ ! &quot;§ $%&amp; /() =? * &apos;&lt;&gt;\r\n\r\n|; ²³~ @`´ ©«» ¤¼× {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ ! &quot;§ $%&amp; /() =? * &apos;&lt;&gt; |; ²³~ @`´ ©«» ¤¼× {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ ! &quot;§ $%&amp; /() =? * &apos;&lt;&gt; |; ²³~ @`´ ©«» ¤¼× {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ ! &quot;§ $%&amp; /() =? * &apos;&lt;&gt; |; ²³~ @`´ ©«» ¤¼× {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ ! &quot;§ $%&amp; /() =?\r\n\r\n* &apos;&lt;&gt; |; ²³~ @`´ ©«» ¤¼× {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ ! &quot;§ $%&amp; /() =? * &apos;&lt;&gt; |; ²³~ @`´ ©«» ¤¼× {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ ! &quot;§ $%&amp; /() =? * &apos;&lt;&gt; |; ²³~ @`´ ©«» ¤¼× {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ ! &quot;§ $%&amp; /() =? * &apos;&lt;&gt; |; ²³~ @`´ ©«» ¤¼× {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ ! &quot;§ $%&amp; /() =?\r\n\r\n* &apos;&lt;&gt; |; ²³~ @`´ ©«» ¤¼× {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ ! &quot;§ $%&amp; /() =? * &apos;&lt;&gt; |; ²³~ @`´ ©«» ¤¼× {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ ! &quot;§ $%&amp; /() =? * &apos;&lt;&gt; |; ²³~ @`´ ©«» ¤¼× {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ ! &quot;§ $%&amp; /() =? * &apos;&lt;&gt; |; ²³~ @`´ ©«» ¤¼× {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ ! &quot;§ $%&amp; /() =? * &apos;&lt;&gt; |; ²³~ @`´ ©«» ¤¼× {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ ! &quot;§ $%&amp; /() =? * &apos;&lt;&gt; |; ²³~ @`´ ©«» ¤¼× {} abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS TUV WXYZ ! &quot;§ $%&amp; /() =? * &apos;&lt;&gt; |; ²³~ @`´ ©«» ¤¼× {}abc def ghi jkl mno pqrs tuv wxyz ABC DEF GHI JKL MNO PQRS', '2021-01-11 14:33:31', 2, 1),
(3, 'The wonderful world of Rust', 'uploaded_images/988219ixpnyfldtcmrshqowzkgjbauve1610433757_michael-schaffler-mrtj1jph8xq-unsplash.jpg', 'right', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth. Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar. The Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn’t listen. She packed her seven versalia, put her initial into the belt and made herself on the way.\r\n\r\nWhen she reached the first hills of the Italic Mountains, she had a last view back on the skyline of her hometown Bookmarksgrove, the headline of Alphabet Village and the subline of her own road, the Line Lane. Pityful a rethoric question ran over her cheek, then she continued her way. On her way she met a copy. The copy warned the Little Blind Text, that where it came from it would have been rewritten a thousand times and everything that was left from its origin would be the word &quot;and&quot; and the Little Blind Text should turn around and return to its own, safe country. But nothing the copy said could convince her and so it didn’t take long until a few insidious Copy Writers ambushed her, made her drunk with Longe and Parole and dragged her into their agency, where they abused her for their projects again and again. And if she hasn’t been rewritten, then they are still using her.\r\n\r\nFar far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth. Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar. The Big Oxmox advised her not to do so, because there were thousands of bad Commas, wild Question Marks and devious Semikoli, but the Little Blind Text didn’t listen. She packed her seven versalia, put her initial into the belt and made herself on the way.', '2021-01-12 06:42:37', 3, 1),
(4, 'Temporal Dead Zone in JavaScript', NULL, 'left', 'While digging deeper into the concepts of ES6, I stumbled across the term &quot;Temporal Dead Zone&quot;. I was curious and found out that I was unknowing of the term itself, but knew the concept of it. I didn&apos;t run into the issues too often, but it is absolutely helpful to know why it occurs and how to avoid it. So follow me on my journey through the Temporal Dead Zone.\r\n\r\nTo get it right off the bat:\r\nThe Temporal Dead Zone describes the state, when variables are unreachable.\r\n\r\n&lt;cite&gt;\r\nANONYMOUS\r\nThe term isn&apos;t mentioned in the EcmaScript Language Specification but is used from us programmers to give the child a name.\r\n&lt;/cite&gt;\r\n\r\nSo what does that mean? And why haven&apos;t I encountered this when writing code in the past (before ES6).\r\n\r\n&lt;h3&gt;Variable declaration and hoisting&lt;/h3&gt;\r\nLet&apos;s start with an extremely simplified example:\r\n&lt;pre&gt;\r\nconsole.log(myVar); \r\nvar myVar = &apos;Hello World&apos;\r\nconsole.log(myVar);\r\n&lt;/pre&gt;\r\nWhat happens:\r\nThe JavaScript Engine parses the code and hoists myVar to the top of its scope. Since we declared it with var it and creates a global property. We then try to log myVar before we declare it which logs us undefined, the default initialization value for var. Then we initialize its correct value and log it again. This time we log Hello World. So far so good. Our code doesn&apos;t break and we can just live with the undefined state.\r\n\r\nLet&apos;s step it up and write this in ES6 (so let&apos;s use let instead of var):\r\n&lt;pre&gt;\r\nconsole.log(myVar);\r\nlet myVar = &apos;Hello World&apos;\r\nconsole.log(myVar);\r\n&lt;/pre&gt;\r\nWhat happens:\r\nAgain the JavaScript Engine parses the code and hoists myVar. This time we declared it with let which doesn&apos;t create a global property, since let (also const) are block scoped. Both are hoisted into the Temporal Dead Zone. We then try again to log myVar but Ooops! This throws an Uncaught ReferenceError: can&apos;t access lexical declaration &apos;myVar&apos; before initialization and breaks our code!\r\n\r\n&lt;h3&gt;Hoisting table&lt;/h3&gt;\r\nOn ExploringJS, you can find a really nifty table, showing all the variants how variables can be declared and how they are hoisted.\r\n\r\n\r\n&lt;h3&gt;Temporal Dead Zone explained&lt;/h3&gt;\r\nAs quoted above, the state between the declaration of a variable with let or const and its initialization is called the Temporal Dead Zone. This is because of its lifecycle in the JavaScript Engine. So let&apos;s have a closer look on this:\r\n\r\n&lt;h3&gt;Lifecycle of let and const&lt;/h3&gt;\r\nBoth variables are bound to their blockscope. So the cycle looks a bit like this:\r\n\r\n&lt;h3&gt;Entering the scope of the variable&lt;/h3&gt;\r\nBind space for the variable (Hoisting), the variable is not initialized -&gt; ReferenceError\r\nIf there is a declaration initialize the value if given, if not default to undefined\r\nconst is a bis special here, it must have an initializer since it is immutable (not 100% true but for this example close enough)', '2021-01-12 08:30:25', 2, 1),
(5, 'Node Version Manager (nvm) unter Windows nutzen', 'uploaded_images/509869nxltikqzmbjgwcephoafsyurvd1610440800_mark-hessling-_y8bgf8o_dq-unsplash.jpg', 'right', 'Wenn man mit unterschiedlichen Versionen von NodeJS und NPM arbeiten möchte oder muss, stellt sich sehr schnell die Frage, ob man wirklich virtuelle Maschinen mit den unterschiedlichen Versionen benötigt. Oder ob man jedesmal beim nötigen Versionswechsel NodeJS de- und neuinstallieren muss. Eine schnelle Suche über eine Suchmaschine der Wahl, fördert zum Glück sehr schnell die verschiedenen Versionsmanager zu Tage.\r\n\r\nDa ich nvm, n und nodist unter Windows nur schwer oder gar nicht zum Laufen zu bekommen habe, ist meine Entscheidung auf nvm-windows gefallen.\r\n\r\nnvm-windows\r\nnvm-windows verfolgt einen etwas anderen Ansatz als die anderen Versions Manager und arbeitet mit symlinks (ja richtig gelesen!) anstatt mit batch und PATH Magie. Es basiert auf Go und benötigt vorab keine installierte NodeJS Umgebung. Ich fand es immer seltsam NodeJS zu beötigen um einen NodeJS Mananger zu nutzen… Allerdings muss man auf seinem Rechner Admin-Rechte besitzen. Sollte das nicht möglich sein, endet die Reise hier meines Wissens nach auch schon. Das ist aber bei den anderen Managern nicht anders.\r\n\r\nInstallation und Einrichtung\r\nDie Installation von nvm-windows ist recht simpel: Es gibt einen Installer für die letzte stabile Version. Diesen einfach herunterladen.\r\n\r\nBevor wir aber mit der Installation beginnen, müssen wir erstmal das aktuelle NodeJS und NPM deinstallieren. Das macht uns das Leben später sehr viel einfacher.\r\n\r\nWichtig: Sollte bereits eine .npmrc vorhanden sein, sichert den Inhalt lieber.\r\n\r\nSobald kein NodeJS/NPM (mehr) vorhanden ist, können wir einfach den Installer starten und nvm-windows installieren. Sobald das erledigt ist, können wir wieder ganz normal NodeJS in den gewünschten Versionen installieren. Das geht ganz einfach über nvm install &lt;version&gt; &lt;arch&gt;:\r\n\r\n&gt; nvm install 12.8.0\r\nDownloading node.js version 12.18.0 (64-bit)…\r\nComplete\r\nCreating \\AppData\\Roaming\\nvm\\tempDownloading npm version 6.14.4… Complete\r\nInstalling npm v6.14.4…Installation complete. If you want to use this version, type\r\nnvm use 12.18.0\r\nJetzt noch die enstsprechenden Tools installieren, z.B. Gulp oder JSHint etc. pp. und man kann loslegen.\r\n\r\nNutzen von mehreren NodeJS Versionen\r\nSo weit, so gut. Allerdings haben wir bisher ja immer noch nur eine Version am Laufen. Jetzt kommt nvm richtig ins Spiel! Mit nvm install können wir beliebig viele NodeJS/NPM-Versionen auf unserem System haben (weswegen wir den ganzen Spaß ja machen). Mit nvm list kann man dann alle installierten Versionen und ihre Archetypen sehen und mit nvm use wechselt man zwischen den entsprechenden Versionen hin und her.\r\n\r\n&gt; nvm list\r\n* 10.20.1 (Currently using 64-bit executable)\r\n 10.19.0&gt; nvm use 10.19.0\r\nNow using node v10.19.0 (64-bit)\r\nAchtung: Für jede installierte Version, müssen auch die globalen Tools installiert werden. Wir wechseln immer zwischen dem vollständig aufgesetzten NodeJS hin und her. Das bedeutet zwar etwas Aufwand beim Einrichten, bietet aber auch gleichzeitig höchstmögliche Flexibilität.\r\n\r\nResümee\r\nFür mich bot nvm-windows das einfachste Setup der Alternativen an. Auch im Alltag funktioniert es für mich super. Ich habe bisher keinerlei Unterschied zwischen einer “normalen” und der nvm Installation bemerkt.', '2021-01-12 08:40:00', 2, 1),
(6, 'The wonderful world of Photography', 'uploaded_images/678643bjuicawdhnzkrytsvpeogfmqlx1610440980_large_format_camera_lens.jpg', 'left', 'Photography is the art, application, and practice of creating durable images by recording light, either electronically by means of an image sensor, or chemically by means of a light-sensitive material such as photographic film. It is employed in many fields of science, manufacturing (e.g., photolithography), and business, as well as its more direct uses for art, film and video production, recreational purposes, hobby, and mass communication.[1]\r\n\r\nTypically, a lens is used to focus the light reflected or emitted from objects into a real image on the light-sensitive surface inside a camera during a timed exposure. With an electronic image sensor, this produces an electrical charge at each pixel, which is electronically processed and stored in a digital image file for subsequent display or processing. The result with photographic emulsion is an invisible latent image, which is later chemically &quot;developed&quot; into a visible image, either negative or positive depending on the purpose of the photographic material and the method of processing. A negative image on film is traditionally used to photographically create a positive image on a paper base, known as a print, either by using an enlarger or by contact printing.\r\n\r\nEtymology\r\nThe word &quot;photography&quot; was created from the Greek roots φωτός (phōto&apos;s), genitive of φῶς (phōs), &quot;light&quot;[2] and γραφή (graphé) &quot;representation by means of lines&quot; or &quot;drawing&quot;,[3] together meaning &quot;drawing with light&quot;.[4]\r\n\r\nSeveral people may have coined the same new term from these roots independently. Hercules Florence, a French painter and inventor living in Campinas, Brazil, used the French form of the word, photographie, in private notes which a Brazilian historian believes were written in 1834.[5] This claim is widely reported but is not yet largely recognized internationally. The first use of the word by the Franco-Brazilian inventor became widely known after the research of Boris Kossoy in 1980.[6]\r\n\r\nThe German newspaper Vossische Zeitung of 25 February 1839 contained an article entitled Photographie, discussing several priority claims – especially Henry Fox Talbot&apos;s – regarding Daguerre&apos;s claim of invention.[7] The article is the earliest known occurrence of the word in public print.[8] It was signed &quot;J.M.&quot;, believed to have been Berlin astronomer Johann von Maedler.[9] The astronomer Sir John Herschel is also credited with coining the word, independent of Talbot, in 1839.[10]\r\n\r\nThe inventors Nicéphore Niépce, Henry Fox Talbot and Louis Daguerre seem not to have known or used the word &quot;photography&quot;, but referred to their processes as &quot;Heliography&quot; (Niépce), &quot;Photogenic Drawing&quot;/&quot;Talbotype&quot;/&quot;Calotype&quot; (Talbot) and &quot;Daguerreotype&quot; (Daguerre).[9]', '2021-01-12 08:43:00', 3, 2),
(7, 'Metal 4 Life', 'uploaded_images/869301kbunvoygxishlwfaqrezmdtjcp1610442599_hugo-l-casanova-exb2qyocnys-unsplash.jpg', 'left', 'Heavy metal (or simply metal) is a genre of rock music[3][4] that developed in the late 1960s and early 1970s, largely in the United Kingdom and the United States.[5] With roots in blues rock, psychedelic rock, and acid rock,[6] heavy metal bands developed a thick, massive sound, characterized by distortion, extended guitar solos, emphatic beats, and loudness. The lyrics and performances are sometimes associated with aggression and machismo.[6]\r\n\r\nIn 1968, three of the genre&apos;s most famous pioneers, Led Zeppelin, Black Sabbath and Deep Purple, were founded.[7] Though they came to attract wide audiences, they were often derided by critics. Several American bands modified heavy metal into more accessible forms during the 1970s: the raw, sleazy sound and shock rock of Alice Cooper and Kiss; the blues-rooted rock of Aerosmith; and the flashy guitar leads and wild party rock of Van Halen.[8] During the mid-1970s, Judas Priest helped spur the genre&apos;s evolution by discarding much of its blues influence,[9][10] while Motörhead introduced a punk rock sensibility and an increasing emphasis on speed. Beginning in the late 1970s, bands in the new wave of British heavy metal such as Iron Maiden and Saxon followed in a similar vein. By the end of the decade, heavy metal fans became known as &quot;metalheads&quot; or &quot;headbangers&quot;.\r\n\r\nDuring the 1980s, glam metal became popular with groups such as Bon Jovi and Mötley Crüe. Underground scenes produced an array of more aggressive styles: thrash metal broke into the mainstream with bands such as Metallica, Slayer, Megadeth, and Anthrax, while other extreme subgenres such as death metal and black metal remain subcultural phenomena. Since the mid-1990s, popular styles have expanded the definition of the genre. These include groove metal and nu metal, the latter of which often incorporates elements of grunge and hip hop.\r\n\r\nCharacteristics\r\nHeavy metal is traditionally characterized by loud distorted guitars, emphatic rhythms, dense bass-and-drum sound, and vigorous vocals. Heavy metal subgenres variously emphasize, alter, or omit one or more of these attributes. The New York Times critic Jon Pareles writes, \"In the taxonomy of popular music, heavy metal is a major subspecies of hard-rock—the breed with less syncopation, less blues, more showmanship and more brute force.\"[11] The typical band lineup includes a drummer, a bassist, a rhythm guitarist, a lead guitarist, and a singer, who may or may not be an instrumentalist. Keyboard instruments are sometimes used to enhance the fullness of the sound.[12] Deep Purple\'s Jon Lord played an overdriven Hammond organ. In 1970, John Paul Jones used a Moog synthesizer on Led Zeppelin III; by the 1990s, in \"almost every subgenre of heavy metal\" synthesizers were used.[13]\r\n\r\nThe band Judas Priest are onstage at a concert. From left to right are the singer, two electric guitarists, the bass player, and the drummer, who is seated behind a drumkit. The singer is wearing a black trenchcoat with metal studs.\r\nJudas Priest performing in 2005\r\nThe electric guitar and the sonic power that it projects through amplification has historically been the key element in heavy metal.[14] The heavy metal guitar sound comes from a combined use of high volumes and heavy distortion.[15] For classic heavy metal guitar tone, guitarists maintain gain at moderate levels, without excessive preamp or pedal distortion, to retain open spaces and air in the music; the guitar amplifier is turned up loud to produce the characteristic \"punch and grind\".[16] Thrash metal guitar tone has scooped mid-frequencies and tightly compressed sound with multiple bass frequencies.[16] Guitar solos are \"an essential element of the heavy metal code ... that underscores the significance of the guitar\" to the genre.[17] Most heavy metal songs \"feature at least one guitar solo\",[18] which is \"a primary means through which the heavy metal performer expresses virtuosity\".[19] Some exceptions are nu metal and grindcore bands, which tend to omit guitar solos.[20] With rhythm guitar parts, the \"heavy crunch sound in heavy metal ... [is created by] palm muting\" the strings with the picking hand and using distortion.[21] Palm muting creates a tighter, more precise sound and it emphasizes the low end.[22]\r\n\r\nThe lead role of the guitar in heavy metal often collides with the traditional \"frontman\" or bandleader role of the vocalist, creating a musical tension as the two \"contend for dominance\" in a spirit of \"affectionate rivalry\".[12] Heavy metal \"demands the subordination of the voice\" to the overall sound of the band. Reflecting metal\'s roots in the 1960s counterculture, an \"explicit display of emotion\" is required from the vocals as a sign of authenticity.[23] Critic Simon Frith claims that the metal singer\'s \"tone of voice\" is more important than the lyrics.[24]\r\n\r\nThe prominent role of the bass is also key to the metal sound, and the interplay of bass and guitar is a central element. The bass guitar provides the low-end sound crucial to making the music \"heavy\".[25] The bass plays a \"more important role in heavy metal than in any other genre of rock\".[26] Metal basslines vary widely in complexity, from holding down a low pedal point as a foundation to doubling complex riffs and licks along with the lead or rhythm guitars. Some bands feature the bass as a lead instrument, an approach popularized by Metallica\'s Cliff Burton with his heavy emphasis on bass guitar solos and use of chords while playing bass in the early 1980s.[27] Lemmy of Motörhead often played overdriven power chords in his bass lines.[28]\r\n\r\nThe essence of heavy metal drumming is creating a loud, constant beat for the band using the \"trifecta of speed, power, and precision\".[29] Heavy metal drumming \"requires an exceptional amount of endurance\", and drummers have to develop \"considerable speed, coordination, and dexterity ... to play the intricate patterns\" used in heavy metal.[30] A characteristic metal drumming technique is the cymbal choke, which consists of striking a cymbal and then immediately silencing it by grabbing it with the other hand (or, in some cases, the same striking hand), producing a burst of sound. The metal drum setup is generally much larger than those employed in other forms of rock music.[25] Black metal, death metal and some \"mainstream metal\" bands \"all depend upon double-kicks and blast beats\".[31]\r\n\r\nFemale musician Enid Williams from the band Girlschool and Lemmy Kilmeister from Motörhead are shown onstage. Both are singing and playing bass guitar. A drumkit is seen behind them.\r\nEnid Williams from Girlschool and Lemmy from Motörhead singing \"Please Don\'t Touch\" live in 2009. The ties that bind the two bands started in the 1980s and were still strong in the 2010s.\r\nIn live performance, loudness—an \"onslaught of sound\", in sociologist Deena Weinstein\'s description—is considered vital.[14] In his book Metalheads, psychologist Jeffrey Arnett refers to heavy metal concerts as \"the sensory equivalent of war\".[32] Following the lead set by Jimi Hendrix, Cream and The Who, early heavy metal acts such as Blue Cheer set new benchmarks for volume. As Blue Cheer\'s Dick Peterson put it, \"All we knew was we wanted more power.\"[33] A 1977 review of a Motörhead concert noted how \"excessive volume in particular figured into the band\'s impact.\"[34] Weinstein makes the case that in the same way that melody is the main element of pop and rhythm is the main focus of house music, powerful sound, timbre, and volume are the key elements of metal. She argues that the loudness is designed to \"sweep the listener into the sound\" and to provide a \"shot of youthful vitality\".[14]\r\n\r\nHeavy metal performers tended to be almost exclusively male[35] until at least the mid-1980s[36] apart from exceptions such as Girlschool.[35] However, by the 2010s women were making more of an impact,[37][38] and PopMatters\' Craig Hayes argues that metal \"clearly empowers women\".[39] In the sub-genres of symphonic and power metal, there has been a sizable number of bands that have had women as the lead singers; bands such as Nightwish, Delain, and Within Temptation have featured women as lead singers with men playing instruments.', '2021-01-12 09:09:59', 3, 2);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_name`) VALUES
(1, 'Abracadabra'),
(2, 'Development'),
(3, 'Stuff');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `usr_id` int(11) NOT NULL,
  `usr_firstname` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usr_lastname` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usr_email` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usr_city` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usr_password` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`usr_id`, `usr_firstname`, `usr_lastname`, `usr_email`, `usr_city`, `usr_password`) VALUES
(1, 'Hans', 'Mustermann', 'a@b.c', 'Entenhausen', '$2y$10$LfMubT8QFiWD4sQR7iwHr.stI5ZnDT8RebiBm96aX3D0a1C/Mpma2'),
(2, 'Erika', 'Gabler', 'erika@gabler.de', 'Musterhausen', '$2y$10$e4j2FGPP6.iDZGlZMp1ONe0MlKEW7Ve9LeF1zC36lKsE8TpB9V6hG');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`blog_id`);

--
-- Indizes für die Tabelle `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`usr_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `blogs`
--
ALTER TABLE `blogs`
  MODIFY `blog_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT für Tabelle `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `usr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
