-- phpMyAdmin SQL Dump
-- version 2.6.2-pl1
-- http://www.phpmyadmin.net
-- 
-- 主机: localhost
-- 生成日期: 2015 年 07 月 08 日 10:31
-- 服务器版本: 5.0.27
-- PHP 版本: 5.2.1
-- 
-- 数据库: `ly-jiujiu`
-- 

-- --------------------------------------------------------

-- 
-- 表的结构 `ad`
-- 

DROP TABLE IF EXISTS `ad`;
CREATE TABLE `ad` (
  `AId` smallint(5) NOT NULL auto_increment,
  `PageName` varchar(50) default NULL,
  `AdPosition` varchar(50) default NULL,
  `AdType` tinyint(1) default '0',
  `PicCount` tinyint(1) default '1',
  `Name` varchar(100) default NULL,
  `Contents` text,
  `FlashPath` varchar(100) default NULL,
  `Name_0` varchar(100) default NULL,
  `Name_1` varchar(100) default NULL,
  `Name_2` varchar(100) default NULL,
  `Name_3` varchar(100) default NULL,
  `Name_4` varchar(100) default NULL,
  `Url_0` varchar(200) default NULL,
  `Url_1` varchar(200) default NULL,
  `Url_2` varchar(200) default NULL,
  `Url_3` varchar(200) default NULL,
  `Url_4` varchar(200) default NULL,
  `PicPath_0` varchar(100) default NULL,
  `PicPath_1` varchar(100) default NULL,
  `PicPath_2` varchar(100) default NULL,
  `PicPath_3` varchar(100) default NULL,
  `PicPath_4` varchar(100) default NULL,
  `Width` smallint(5) default NULL,
  `Height` smallint(5) default NULL,
  PRIMARY KEY  (`AId`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- 
-- 导出表中的数据 `ad`
-- 

INSERT INTO `ad` VALUES (1, '首页', '广告图', 0, 5, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '/u_file/ad/15_04_10/9f064deae5.jpg', '/u_file/ad/15_04_10/f1c695d194.jpg', '/u_file/ad/15_04_10/8a6206b30e.jpg', '/u_file/ad/15_04_10/d136a7b324.jpg', '/u_file/ad/15_04_10/a8ad984377.jpg', 0, 564);
INSERT INTO `ad` VALUES (2, '内页', '关于我们', 0, 1, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '/u_file/ad/15_04_16/d2e8fe7bfc.jpg', '', '', '', '', 0, 311);
INSERT INTO `ad` VALUES (3, '内页', '产品列表页', 0, 1, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '/u_file/ad/15_04_16/bdf76202a4.jpg', '', '', '', '', 0, 311);
INSERT INTO `ad` VALUES (5, '内页', '注册背景', 0, 1, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '/u_file/ad/15_06_27/192bdf94e6.jpg', '', '', '', '', 0, 0);
INSERT INTO `ad` VALUES (6, '证书模板', '证书', 0, 3, NULL, NULL, NULL, '', '', '', '', '', '', '', '', '', '', '/u_file/ad/15_07_03/3bac07ca54.jpg', '/u_file/ad/15_07_03/149a938183.jpg', '/u_file/ad/15_07_03/d7e5f6450c.jpg', '', '', 100, 100);

-- --------------------------------------------------------

-- 
-- 表的结构 `article`
-- 

DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `AId` tinyint(2) NOT NULL auto_increment,
  `GroupId` tinyint(1) default '0',
  `Title` varchar(50) default NULL,
  `SeoTitle` varchar(200) default NULL,
  `SeoKeywords` varchar(200) default NULL,
  `SeoDescription` varchar(200) default NULL,
  `Contents` text,
  `PageUrl` varchar(250) default NULL,
  `MyOrder` smallint(5) default '0',
  PRIMARY KEY  (`AId`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

-- 
-- 导出表中的数据 `article`
-- 

INSERT INTO `article` VALUES (4, 0, '注册协议', '', '', '', '一、总则<br />\r\n1.1　用户应当同意本协议的条款并按照页面上的提示完成全部的注册程序。用户在进行注册程序过程中点击&quot;同意&quot;按钮即表示用户与数据堂达成协议，完全接受本协议项下的全部条款。<br />\r\n1.2　用户注册成功后，数据堂将给予每个用户一个用户帐号及相应的密码，该用户帐号和密码由用户负责保管；用户应当对以其用户帐号进行的所有活动和事件负法律责任。<br />\r\n1.3　用户可以使用数据堂各个频道单项服务，当用户使用数据堂各单项服务时，用户的使用行为视为其对该单项服务的服务条款以及数据堂在该单项服务中发出的各类公告的同意。<br />\r\n1.4　数据堂会员服务协议以及各个频道单项服务条款和公告可由数据堂随时更新，且无需另行通知。您在使用相关服务时,应关注并遵守其所适用的相关 条款。您在使用数据堂提供的各项服务之前，应仔细阅读本服务协议。如您不同意本服务协议及/或随时对其的修改，您可以主动取消数据堂提供的服务；您一旦使 用数据堂服务，即视为您已了解并完全同意本服务协议各项内容，包括数据堂对服务协议随时所做的任何修改，并成为数据堂用户。<br />\r\n二、注册信息和隐私保护<br />\r\n2.1　数据堂帐号（即数据堂用户ID）的所有权归数据堂，用户完成注册申请手续后，获得数据堂帐号的使用权。用户应提供及时、详尽及准确的个人资 料，并不断更新注册资料，符合及时、详尽准确的要求。所有原始键入的资料将引用为注册资料。如果因注册信息不真实而引起的问题，并对问题发生所带来的后 果，数据堂不负任何责任。<br />\r\n2.2　用户不应将其帐号、密码转让或出借予他人使用。如用户发现其帐号遭他人非法使用，应立即通知数据堂。因黑客行为或用户的保管疏忽导致帐号、密码遭他人非法使用，数据堂不承担任何责任。<br />\r\n2.3　数据堂不对外公开或向第三方提供单个用户的注册资料，除非：\r\n<div>&bull; 事先获得用户的明确授权；<br />\r\n&bull; 只有透露您的个人资料，才能提供您所要求的产品和服务；<br />\r\n&bull; 根据有关的法律法规要求；<br />\r\n&bull; 按照相关政府主管部门的要求；<br />\r\n&bull; 为维护数据堂的合法权益。</div>\r\n2.4　在您注册数据堂账户，使用其他数据堂产品或服务，访问数据堂网页, 或参加促销和有奖游戏时，数据堂会收集您的个人身份识别资料，并会将这些资料用于：改进为你提供的服务及网页内容。<br />\r\n三、使用规则<br />\r\n3.1　用户在使用数据堂服务时，必须遵守中华人民共和国相关法律法规的规定，用户应同意将不会利用本服务进行任何违法或不正当的活动，包括但不限于下列行为∶\r\n<div>上载、展示、张贴、传播或以其它方式传送含有下列内容之一的信息：<br />\r\n不得为任何非法目的而使用网络服务系统<br />\r\n不利用数据堂服务从事以下活动：<br />\r\n未经允许，进入计算机信息网络或者使用计算机信息网络资源的；<br />\r\n未经允许，对计算机信息网络功能进行删除、修改或者增加的；<br />\r\n未经允许，对进入计算机信息网络中存储、处理或者传输的数据和应用程序进行删除、修改或者增加的；<br />\r\n故意制作、传播计算机病毒等破坏性程序的；<br />\r\n其他危害计算机信息网络安全的行为。</div>\r\n3.2　用户违反本协议或相关的服务条款的规定，导致或产生的任何第三方主张的任何索赔、要求或损失，包括合理的律师费，您同意赔偿数据堂与合作公 司、关联公司，并使之免受损害。对此，数据堂有权视用户的行为性质，采取包括但不限于删除用户发布信息内容、暂停使用许可、终止服务、限制使用、回收数据 堂帐号、追究法律责任等措施。对恶意注册数据堂帐号或利用数据堂帐号进行违法活动、捣乱、骚扰、欺骗、其他用户以及其他违反本协议的行为，数据堂有权回收 其帐号。同时，数据堂会视司法部门的要求，协助调查。<br />\r\n3.3　用户不得对本服务任何部分或本服务之使用或获得，进行复制、拷贝、出售、转售或用于任何其它商业目的。<br />\r\n3.4　用户须对自己在使用数据堂服务过程中的行为承担法律责任。用户承担法律责任的形式包括但不限于：对受到侵害者进行赔偿，以及在数据堂首先承担了因用户行为导致的行政处罚或侵权损害赔偿责任后，用户应给予数据堂等额的赔偿。<br />\r\n四、服务内容<br />\r\n4.1　数据堂网络服务的具体内容由数据堂根据实际情况提供。<br />\r\n4.2　除非本服务协议另有其它明示规定，数据堂所推出的新产品、新功能、新服务，均受到本服务协议之规范。<br />\r\n4.3　为使用本服务，您必须能够自行经有法律资格对您提供互联网接入服务的第三方，进入国际互联网，并应自行支付相关服务费用。此外，您必须自行配备及负责与国际联网连线所需之一切必要装备，包括计算机、数据机或其它存取装置。<br />\r\n4.4　鉴于网络服务的特殊性，用户同意数据堂有权不经事先通知，随时变更、中断或终止部分或全部的网络服务（包括收费网络服务）。数据堂不担保网络服务不会中断，对网络服务的及时性、安全性、准确性也都不作担保。<br />\r\n4.5　数据堂需要定期或不定期地对提供网络服务的平台或相关的设备进行检修或者维护，如因此类情况而造成网络服务（包括收费网络服务）在合理时间内的中断，数据堂无需为此承担任何责任。数据堂保留不经事先通知为维修保养、升级或其它目的暂停本服务任何部分的权利。<br />\r\n4.6　本服务或第三人可提供与其它国际互联网上之网站或资源之链接。由于数据堂无法控制这些网站及资源，您了解并同意，此类网站或资源是否可供利 用，数据堂不予负责，存在或源于此类网站或资源之任何内容、广告、产品或其它资料，数据堂亦不予保证或负责。因使用或依赖任何此类网站或资源发布的或经由 此类网站或资源获得的任何内容、商品或服务所产生的任何损害或损失，数据堂不承担任何责任。<br />\r\n4.7　用户明确同意其使用数据堂网络服务所存在的风险将完全由其自己承担。用户理解并接受下载或通过数据堂服务取得的任何信息资料取决于用户自 己，并由其承担系统受损、资料丢失以及其它任何风险。数据堂对在服务网上得到的任何商品购物服务、交易进程、招聘信息，都不作担保。<br />\r\n4.8　6个月未登录的帐号，数据堂保留关闭的权利。<br />\r\n4.9　数据堂有权于任何时间暂时或永久修改或终止本服务（或其任何部分），而无论其通知与否，数据堂对用户和任何第三人均无需承担任何责任。<br />\r\n4.10　终止服务<br />\r\n您同意数据堂得基于其自行之考虑，因任何理由，包含但不限于长时间未使用，或数据堂认为您已经违反本服务协议的文字及精神，终止您的密码、帐号或本 服务之使用（或服务之任何部分），并将您在本服务内任何内容加以移除并删除。您同意依本服务协议任何规定提供之本服务，无需进行事先通知即可中断或终止， 您承认并同意，数据堂可立即关闭或删除您的帐号及您帐号中所有相关信息及文件，及/或禁止继续使用前述文件或本服务。此外，您同意若本服务之使用被中断或 终止或您的帐号及相关信息和文件被关闭或删除，数据堂对您或任何第三人均不承担任何责任。<br />\r\n五、知识产权和其他合法权益（包括但不限于名誉权、商誉权）<br />\r\n5.1　用户专属权利<br />\r\n数据堂尊重他人知识产权和合法权益，呼吁用户也要同样尊重知识产权和他人合法权益。若您认为您的知识产权或其他合法权益被侵犯，请按照以下说明向数据堂提供资料∶<br />\r\n请注意：如果权利通知的陈述失实，权利通知提交者将承担对由此造成的全部法律责任（包括但不限于赔偿各种费用及律师费）。如果上述个人或单位不确定网络上可获取的资料是否侵犯了其知识产权和其他合法权益，数据堂建议该个人或单位首先咨询专业人士。<br />\r\n为了数据堂有效处理上述个人或单位的权利通知，请使用以下格式（包括各条款的序号）：\r\n<div>&bull; 权利人对涉嫌侵权内容拥有知识产权或其他合法权益和/或依法可以行使知识产权或其他合法权益的权属证明。<br />\r\n&bull; 请充分、明确地描述被侵犯了知识产权或其他合法权益的情况并请提供涉嫌侵权的第三方网址（如果有）。<br />\r\n&bull; 请指明涉嫌侵权网页的哪些内容侵犯了第2项中列明的权利。<br />\r\n&bull; 请提供权利人具体的联络信息，包括姓名、身份证或护照复印件（对自然人）、单位登记证明复印件（对单位）、通信地址、电话号码、传真和电子邮件。<br />\r\n&bull; 请提供涉嫌侵权内容在信息网络上的位置（如指明您举报的含有侵权内容的出处，即：指网页地址或网页内的位置）以便我们与您举报的含有侵权内容的网页的所有权人/管理人联系。<br />\r\n&bull; 请在权利通知中加入如下关于通知内容真实性的声明： &ldquo;我保证，本通知中所述信息是充分、真实、准确的，如果本权利通知内容不完全属实，本人将承担由此产生的一切法律责任。&rdquo;<br />\r\n&bull; 请您签署该文件，如果您是依法成立的机构或组织，请您加盖公章。<br />\r\n请您把以上资料和联络方式书面发往以下地址：　　<br />\r\n北京市海淀区中关村东路18号 财智国际大厦B座 1508室<br />\r\n数据堂　会员服务部<br />\r\n邮政编码：100083</div>\r\n5.2　对于用户通过数据堂服务（包括但不限于贴吧、知道、MP3、影视等）上传到数据堂网站上可公开获取区域的任何内容，用户同意数据堂在全世界 范围内具有免费的、永久性的、不可撤销的、非独家的和完全再许可的权利和许可，以使用、复制、修改、改编、出版、翻译、据以创作衍生作品、传播、表演和展 示此等内容（整体或部分），或将此等内容编入当前已知的或以后开发的其他任何形式的作品、媒体或技术中。<br />\r\n5.3　数据堂拥有本网站内所有资料的版权。任何被授权的浏览、复制、打印和传播属于本网站内的资料必须符合以下条件：\r\n<div>&bull; 所有的资料和图象均不得用于商业目的；<br />\r\n&bull; 所有的资料、图象及其任何部分都必须包括此版权声明；<br />\r\n&bull; 本网站（www.datatang.com）所有的产品、技术与所有程序均属于数据堂知识产权，在此并未授权。<br />\r\n&bull; &ldquo;Datatang&rdquo;, &ldquo;数据堂&rdquo;及相关图形等为数据堂的注册商标。<br />\r\n&bull; 未经数据堂许可，任何人不得擅自（包括但不限于：以非法的方式复制、传播、展示、镜像、上载、下载）使用。否则，数据堂将依法追究法律责任。</div>\r\n六、青少年用户特别提示<br />\r\n青少年用户必须遵守全国青少年网络文明公约：<br />\r\n要善于网上学习，不浏览不良信息；要诚实友好交流，不侮辱欺诈他人；要增强自护意识，不随意约会网友；要维护网络安全，不破坏网络秩序；要有益身心健康，不沉溺虚拟时空。<br />\r\n七、其他<br />\r\n7.1　本协议的订立、执行和解释及争议的解决均应适用中华人民共和国法律。<br />\r\n7.2　如双方就本协议内容或其执行发生任何争议，双方应尽量友好协商解决；协商不成时，任何一方均可向数据堂所在地的人民法院提起诉讼。<br />\r\n7.3　数据堂未行使或执行本服务协议任何权利或规定，不构成对前述权利或权利之放弃。<br />\r\n7.4　如本协议中的任何条款无论因何种原因完全或部分无效或不具有执行力，本协议的其余条款仍应有效并且有约束力。<br />\r\n请您在发现任何违反本服务协议以及其他任何单项服务的服务条款、数据堂各类公告之情形时，通知数据堂。您可以通过如下联络方式同数据堂联系∶', '/article/4.html', 0);
INSERT INTO `article` VALUES (3, 0, '页面底部版权', '页面底部版权', '页面底部版权', '页面底部版权', '网站备案号：粤ICP备052145689 &nbsp;经营许可证：粤B3-10245686<br />\r\n<br />\r\n&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Copyright @ 2010-2015', '/article/3.html', 0);
INSERT INTO `article` VALUES (5, 1, '益海简介', '益海简介', '益海简介', '益海简介', '<div style="text-align:center"><img alt="" src="/u_file/images/15_05_04/ac5e2103ae.jpg" style="height:308px; width:1150px" /><br />\r\n<br />\r\n<br />\r\n<br />\r\n<img alt="" src="/u_file/images/15_05_04/598f21c90c.jpg" style="height:380px; width:1102px" /><br />\r\n<br />\r\n<br />\r\n<br />\r\n<img alt="" src="/u_file/images/15_05_04/36bb422174.jpg" style="height:512px; width:415px" /></div>', '/article/5.html', 0);
INSERT INTO `article` VALUES (15, 0, '约课流程', '', '', '', '<div>\r\n<div>&nbsp;</div>\r\n</div>\r\n\r\n<div>\r\n<table border="0" cellpadding="0" cellspacing="0" style="width:100%">\r\n	<tbody>\r\n		<tr>\r\n			<td align="center"><img alt="" src="/images/img_b0.png" style="line-height:20.7999992370605px" /></td>\r\n			<td align="center"><img alt="" src="/images/img_b1.png" style="line-height:20.7999992370605px" /></td>\r\n			<td align="center"><img alt="" src="/images/img_b2.png" style="line-height:20.7999992370605px" /></td>\r\n			<td align="center"><img alt="" src="/images/img_b3.png" style="line-height:20.7999992370605px" /></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>', '/article/15.html', 0);
INSERT INTO `article` VALUES (7, 1, '啾啾文化', '啾啾文化', '啾啾文化', '啾啾文化', '免责声明', '/article/7.html', 0);
INSERT INTO `article` VALUES (8, 1, '事业价值', '事业价值', '事业价值', '事业价值', '事业价值', '/article/8.html', 0);
INSERT INTO `article` VALUES (9, 1, '啾啾优势', '啾啾优势', '啾啾优势', '啾啾优势', '啾啾优势', '/article/9.html', 0);
INSERT INTO `article` VALUES (10, 2, '咨询服务', '咨询服务', '咨询服务', '咨询服务', '咨询服务', '/article/10.html', 0);
INSERT INTO `article` VALUES (11, 2, '实施服务', '实施服务', '实施服务', '实施服务', '实施服务', '/article/11.html', 0);
INSERT INTO `article` VALUES (12, 2, '售后服务', '售后服务', '售后服务', '售后服务', '售后服务', '/article/12.html', 0);
INSERT INTO `article` VALUES (13, 2, '个性化开发服务', '个性化开发服务', '个性化开发服务', '个性化开发服务', '个性化开发服务', '/article/13.html', 0);
INSERT INTO `article` VALUES (14, 2, '服务团队', '服务团队', '服务团队', '服务团队', '服务团队', '/article/14.html', 0);
INSERT INTO `article` VALUES (17, 0, '意见反馈', '', '', '', '意见反馈', '/article/17.html', 0);
INSERT INTO `article` VALUES (16, 0, '我们的优势', '', '', '', '我们的优势', '/article/16.html', 0);

-- --------------------------------------------------------

-- 
-- 表的结构 `country`
-- 

DROP TABLE IF EXISTS `country`;
CREATE TABLE `country` (
  `CId` smallint(3) NOT NULL auto_increment,
  `Country` varchar(50) default NULL,
  PRIMARY KEY  (`CId`)
) ENGINE=MyISAM AUTO_INCREMENT=241 DEFAULT CHARSET=utf8 AUTO_INCREMENT=241 ;

-- 
-- 导出表中的数据 `country`
-- 

INSERT INTO `country` VALUES (1, 'Andorra');
INSERT INTO `country` VALUES (2, 'United Arab Emirates');
INSERT INTO `country` VALUES (3, 'Afghanistan');
INSERT INTO `country` VALUES (4, 'Antigua and Barbuda');
INSERT INTO `country` VALUES (5, 'Anguilla');
INSERT INTO `country` VALUES (6, 'Albania');
INSERT INTO `country` VALUES (7, 'Armenia');
INSERT INTO `country` VALUES (8, 'Netherlands Antilles');
INSERT INTO `country` VALUES (9, 'Angola');
INSERT INTO `country` VALUES (10, 'Antarctica');
INSERT INTO `country` VALUES (11, 'Argentina');
INSERT INTO `country` VALUES (12, 'American Samoa');
INSERT INTO `country` VALUES (13, 'Austria');
INSERT INTO `country` VALUES (14, 'Australia');
INSERT INTO `country` VALUES (15, 'Aruba');
INSERT INTO `country` VALUES (16, 'Azerbaijan');
INSERT INTO `country` VALUES (17, 'Bosnia and Herzegovina');
INSERT INTO `country` VALUES (18, 'Barbados');
INSERT INTO `country` VALUES (19, 'Bangladesh');
INSERT INTO `country` VALUES (20, 'Belgium');
INSERT INTO `country` VALUES (21, 'Burkina Faso');
INSERT INTO `country` VALUES (22, 'Bulgaria');
INSERT INTO `country` VALUES (23, 'Bahrain');
INSERT INTO `country` VALUES (24, 'Burundi');
INSERT INTO `country` VALUES (25, 'Benin');
INSERT INTO `country` VALUES (26, 'Bermuda');
INSERT INTO `country` VALUES (27, 'Brunei');
INSERT INTO `country` VALUES (28, 'Bolivia');
INSERT INTO `country` VALUES (29, 'Brazil');
INSERT INTO `country` VALUES (30, 'Bahamas');
INSERT INTO `country` VALUES (31, 'Bhutan');
INSERT INTO `country` VALUES (32, 'Bouvet Island');
INSERT INTO `country` VALUES (33, 'Botswana');
INSERT INTO `country` VALUES (34, 'Belarus');
INSERT INTO `country` VALUES (35, 'Belize');
INSERT INTO `country` VALUES (36, 'Canada');
INSERT INTO `country` VALUES (37, 'Cocos Islands');
INSERT INTO `country` VALUES (38, 'Congo');
INSERT INTO `country` VALUES (39, 'Central African Republic');
INSERT INTO `country` VALUES (40, 'Congo');
INSERT INTO `country` VALUES (41, 'Switzerland');
INSERT INTO `country` VALUES (42, 'Cote D''ivoire');
INSERT INTO `country` VALUES (43, 'Cook Islands');
INSERT INTO `country` VALUES (44, 'Chile');
INSERT INTO `country` VALUES (45, 'Cameroon');
INSERT INTO `country` VALUES (46, 'China');
INSERT INTO `country` VALUES (47, 'Colombia');
INSERT INTO `country` VALUES (48, 'Costa Rica');
INSERT INTO `country` VALUES (49, 'Cuba');
INSERT INTO `country` VALUES (50, 'Cape Verde');
INSERT INTO `country` VALUES (51, 'Christmas Island');
INSERT INTO `country` VALUES (52, 'Cyprus');
INSERT INTO `country` VALUES (53, 'Czech Republic');
INSERT INTO `country` VALUES (54, 'Germany');
INSERT INTO `country` VALUES (55, 'Djibouti');
INSERT INTO `country` VALUES (56, 'Denmark');
INSERT INTO `country` VALUES (57, 'Dominica');
INSERT INTO `country` VALUES (58, 'Dominican Republic');
INSERT INTO `country` VALUES (59, 'Algeria');
INSERT INTO `country` VALUES (60, 'Ecuador');
INSERT INTO `country` VALUES (61, 'Estonia');
INSERT INTO `country` VALUES (62, 'Egypt');
INSERT INTO `country` VALUES (63, 'Western Sahara');
INSERT INTO `country` VALUES (64, 'Eritrea');
INSERT INTO `country` VALUES (65, 'Spain');
INSERT INTO `country` VALUES (66, 'Ethiopia');
INSERT INTO `country` VALUES (67, 'Finland');
INSERT INTO `country` VALUES (68, 'Fiji');
INSERT INTO `country` VALUES (69, 'Falkland Islands');
INSERT INTO `country` VALUES (70, 'Micronesia');
INSERT INTO `country` VALUES (71, 'Faroe Islands');
INSERT INTO `country` VALUES (72, 'France');
INSERT INTO `country` VALUES (73, 'Gabon');
INSERT INTO `country` VALUES (74, 'United Kingdom');
INSERT INTO `country` VALUES (75, 'Grenada');
INSERT INTO `country` VALUES (76, 'Georgia');
INSERT INTO `country` VALUES (77, 'French Guiana');
INSERT INTO `country` VALUES (78, 'Ghana');
INSERT INTO `country` VALUES (79, 'Gibraltar');
INSERT INTO `country` VALUES (80, 'Greenland');
INSERT INTO `country` VALUES (81, 'Gambia');
INSERT INTO `country` VALUES (82, 'Guinea');
INSERT INTO `country` VALUES (83, 'Guadeloupe');
INSERT INTO `country` VALUES (84, 'Equatorial Guinea');
INSERT INTO `country` VALUES (85, 'Greece');
INSERT INTO `country` VALUES (86, 'South Georgia and The South Sandwich Islands');
INSERT INTO `country` VALUES (87, 'Guatemala');
INSERT INTO `country` VALUES (88, 'Guam');
INSERT INTO `country` VALUES (89, 'Guinea-Bissau');
INSERT INTO `country` VALUES (90, 'Guyana');
INSERT INTO `country` VALUES (91, 'Hong Kong');
INSERT INTO `country` VALUES (92, 'Heard Island and Mcdonald Islands');
INSERT INTO `country` VALUES (93, 'Honduras');
INSERT INTO `country` VALUES (94, 'Croatia');
INSERT INTO `country` VALUES (95, 'Haiti');
INSERT INTO `country` VALUES (96, 'Hungary');
INSERT INTO `country` VALUES (97, 'Indonesia');
INSERT INTO `country` VALUES (98, 'Ireland');
INSERT INTO `country` VALUES (99, 'Israel');
INSERT INTO `country` VALUES (100, 'India');
INSERT INTO `country` VALUES (101, 'British Indian Ocean Territory');
INSERT INTO `country` VALUES (102, 'Iraq');
INSERT INTO `country` VALUES (103, 'Iran');
INSERT INTO `country` VALUES (104, 'Iceland');
INSERT INTO `country` VALUES (105, 'Italy');
INSERT INTO `country` VALUES (106, 'Jamaica');
INSERT INTO `country` VALUES (107, 'Jordan');
INSERT INTO `country` VALUES (108, 'Japan');
INSERT INTO `country` VALUES (109, 'Kenya');
INSERT INTO `country` VALUES (110, 'Kyrgyzstan');
INSERT INTO `country` VALUES (111, 'Cambodia');
INSERT INTO `country` VALUES (112, 'Kiribati');
INSERT INTO `country` VALUES (113, 'Comoros');
INSERT INTO `country` VALUES (114, 'Saint Kitts and Nevis');
INSERT INTO `country` VALUES (115, 'Korea, Democratic People''s Republic Of');
INSERT INTO `country` VALUES (116, 'Korea');
INSERT INTO `country` VALUES (117, 'Kuwait');
INSERT INTO `country` VALUES (118, 'Cayman African Republic');
INSERT INTO `country` VALUES (119, 'Kazakhstan');
INSERT INTO `country` VALUES (120, 'Laos');
INSERT INTO `country` VALUES (121, 'Lebanon');
INSERT INTO `country` VALUES (122, 'Saint Lucia');
INSERT INTO `country` VALUES (123, 'Liechtenstein');
INSERT INTO `country` VALUES (124, 'Sri Lanka');
INSERT INTO `country` VALUES (125, 'Liberia');
INSERT INTO `country` VALUES (126, 'Lesotho');
INSERT INTO `country` VALUES (127, 'Lithuania');
INSERT INTO `country` VALUES (128, 'Luxembourg');
INSERT INTO `country` VALUES (129, 'Latvia');
INSERT INTO `country` VALUES (130, 'Libyan Arab Jamahiriya');
INSERT INTO `country` VALUES (131, 'Morocco');
INSERT INTO `country` VALUES (132, 'Monaco');
INSERT INTO `country` VALUES (133, 'Moldova');
INSERT INTO `country` VALUES (134, 'Madagascar');
INSERT INTO `country` VALUES (135, 'Marshall Islands');
INSERT INTO `country` VALUES (136, 'Macedonia');
INSERT INTO `country` VALUES (137, 'Mali');
INSERT INTO `country` VALUES (138, 'Myanmar');
INSERT INTO `country` VALUES (139, 'Mongolia');
INSERT INTO `country` VALUES (140, 'Macao');
INSERT INTO `country` VALUES (141, 'Northern Mariana Islands');
INSERT INTO `country` VALUES (142, 'Martinique');
INSERT INTO `country` VALUES (143, 'Mauritania');
INSERT INTO `country` VALUES (144, 'Montserrat');
INSERT INTO `country` VALUES (145, 'Malta');
INSERT INTO `country` VALUES (146, 'Mauritius');
INSERT INTO `country` VALUES (147, 'Maldives');
INSERT INTO `country` VALUES (148, 'Malawi');
INSERT INTO `country` VALUES (149, 'Mexico');
INSERT INTO `country` VALUES (150, 'Malaysia');
INSERT INTO `country` VALUES (151, 'Mozambique');
INSERT INTO `country` VALUES (152, 'Namibia');
INSERT INTO `country` VALUES (153, 'New Caledonia');
INSERT INTO `country` VALUES (154, 'Niger');
INSERT INTO `country` VALUES (155, 'Norfolk Island');
INSERT INTO `country` VALUES (156, 'Nigeria');
INSERT INTO `country` VALUES (157, 'Nicaragua');
INSERT INTO `country` VALUES (158, 'Netherlands');
INSERT INTO `country` VALUES (159, 'Norway');
INSERT INTO `country` VALUES (160, 'Nepal');
INSERT INTO `country` VALUES (161, 'Nauru');
INSERT INTO `country` VALUES (162, 'Niue');
INSERT INTO `country` VALUES (163, 'New Zealand');
INSERT INTO `country` VALUES (164, 'Oman');
INSERT INTO `country` VALUES (165, 'Panama');
INSERT INTO `country` VALUES (166, 'Peru');
INSERT INTO `country` VALUES (167, 'French Polynesia');
INSERT INTO `country` VALUES (168, 'Papua New Guinea');
INSERT INTO `country` VALUES (169, 'Philippines');
INSERT INTO `country` VALUES (170, 'Pakistan');
INSERT INTO `country` VALUES (171, 'Poland');
INSERT INTO `country` VALUES (172, 'Saint Pierre and Miquelon');
INSERT INTO `country` VALUES (173, 'Pitcairn');
INSERT INTO `country` VALUES (174, 'Puerto Rico');
INSERT INTO `country` VALUES (175, 'Palestinian Territory, Occupied');
INSERT INTO `country` VALUES (176, 'Portugal');
INSERT INTO `country` VALUES (177, 'Palau');
INSERT INTO `country` VALUES (178, 'Paraguay');
INSERT INTO `country` VALUES (179, 'Qatar');
INSERT INTO `country` VALUES (180, 'Reunion');
INSERT INTO `country` VALUES (181, 'Romania');
INSERT INTO `country` VALUES (182, 'Serbia');
INSERT INTO `country` VALUES (183, 'Russia');
INSERT INTO `country` VALUES (184, 'Rwanda');
INSERT INTO `country` VALUES (185, 'Saudi Arabia');
INSERT INTO `country` VALUES (186, 'Solomon Islands');
INSERT INTO `country` VALUES (187, 'Seychelles');
INSERT INTO `country` VALUES (188, 'Sudan');
INSERT INTO `country` VALUES (189, 'Sweden');
INSERT INTO `country` VALUES (190, 'Singapore');
INSERT INTO `country` VALUES (191, 'Saint Helena');
INSERT INTO `country` VALUES (192, 'Slovenia');
INSERT INTO `country` VALUES (193, 'Svalbard and Jan Mayen');
INSERT INTO `country` VALUES (194, 'Slovakia');
INSERT INTO `country` VALUES (195, 'Sierra Leone');
INSERT INTO `country` VALUES (196, 'San Marino');
INSERT INTO `country` VALUES (197, 'Senegal');
INSERT INTO `country` VALUES (198, 'Somalia');
INSERT INTO `country` VALUES (199, 'Suriname');
INSERT INTO `country` VALUES (200, 'Sao Tome and Principe');
INSERT INTO `country` VALUES (201, 'El Salvador');
INSERT INTO `country` VALUES (202, 'Syrian Arab Republic');
INSERT INTO `country` VALUES (203, 'Swaziland');
INSERT INTO `country` VALUES (204, 'Turks and Caicos Islands');
INSERT INTO `country` VALUES (205, 'Chad');
INSERT INTO `country` VALUES (206, 'French Southern Territories');
INSERT INTO `country` VALUES (207, 'Togo');
INSERT INTO `country` VALUES (208, 'Thailand');
INSERT INTO `country` VALUES (209, 'Tajikistan');
INSERT INTO `country` VALUES (210, 'Tokelau');
INSERT INTO `country` VALUES (211, 'Turkmenistan');
INSERT INTO `country` VALUES (212, 'Tunisia');
INSERT INTO `country` VALUES (213, 'Tonga');
INSERT INTO `country` VALUES (214, 'East Timor');
INSERT INTO `country` VALUES (215, 'Turkey');
INSERT INTO `country` VALUES (216, 'Trinidad and Tobago');
INSERT INTO `country` VALUES (217, 'Tuvalu');
INSERT INTO `country` VALUES (218, 'TaiWan');
INSERT INTO `country` VALUES (219, 'Tanzania');
INSERT INTO `country` VALUES (220, 'Ukraine');
INSERT INTO `country` VALUES (221, 'Uganda');
INSERT INTO `country` VALUES (222, 'United States Minor Outlying Islands');
INSERT INTO `country` VALUES (223, 'United States Of America');
INSERT INTO `country` VALUES (224, 'Uruguay');
INSERT INTO `country` VALUES (225, 'Uzbekistan');
INSERT INTO `country` VALUES (226, 'Holy See (Vatican City State)');
INSERT INTO `country` VALUES (227, 'Saint Lucia');
INSERT INTO `country` VALUES (228, 'Venezuela');
INSERT INTO `country` VALUES (229, 'US Virgin Islands');
INSERT INTO `country` VALUES (230, 'US Virgin Islands');
INSERT INTO `country` VALUES (231, 'Viet Nam');
INSERT INTO `country` VALUES (232, 'Vanuatu');
INSERT INTO `country` VALUES (233, 'Wallis & Futuna Is');
INSERT INTO `country` VALUES (234, 'Western Samoa');
INSERT INTO `country` VALUES (235, 'Yemen');
INSERT INTO `country` VALUES (236, 'Mayotte');
INSERT INTO `country` VALUES (237, 'Yugoslavia');
INSERT INTO `country` VALUES (238, 'South Africa');
INSERT INTO `country` VALUES (239, 'Zambia');
INSERT INTO `country` VALUES (240, 'Zimbabwe');

-- --------------------------------------------------------

-- 
-- 表的结构 `download`
-- 

DROP TABLE IF EXISTS `download`;
CREATE TABLE `download` (
  `DId` mediumint(8) NOT NULL auto_increment,
  `CateId` smallint(5) default '0',
  `Name` varchar(100) default NULL,
  `PicPath` varchar(100) default NULL,
  `FilePath` varchar(100) default NULL,
  `FileName` varchar(100) default NULL,
  `BriefDescription` varchar(255) default NULL,
  `SeoTitle` varchar(200) default NULL,
  `SeoKeywords` varchar(200) default NULL,
  `SeoDescription` varchar(200) default NULL,
  `Language` tinyint(1) default '0',
  `PageUrl` varchar(250) default NULL,
  `MyOrder` smallint(5) default '0',
  PRIMARY KEY  (`DId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `download`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `download_category`
-- 

DROP TABLE IF EXISTS `download_category`;
CREATE TABLE `download_category` (
  `CateId` smallint(5) NOT NULL auto_increment,
  `Category` varchar(50) default NULL,
  `UId` varchar(50) default NULL,
  `PicPath` varchar(100) default NULL,
  `SeoTitle` varchar(200) default NULL,
  `SeoKeywords` varchar(200) default NULL,
  `SeoDescription` varchar(200) default NULL,
  `Dept` tinyint(2) default '1',
  `SubCate` smallint(5) default '0',
  `PageUrl` varchar(250) default NULL,
  `MyOrder` smallint(5) default '0',
  PRIMARY KEY  (`CateId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `download_category`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `download_category_description`
-- 

DROP TABLE IF EXISTS `download_category_description`;
CREATE TABLE `download_category_description` (
  `DId` smallint(5) NOT NULL auto_increment,
  `CateId` smallint(5) default '0',
  `Description` text,
  PRIMARY KEY  (`DId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `download_category_description`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `download_description`
-- 

DROP TABLE IF EXISTS `download_description`;
CREATE TABLE `download_description` (
  `CId` mediumint(8) NOT NULL auto_increment,
  `DId` mediumint(8) default '0',
  `Description` text,
  PRIMARY KEY  (`CId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `download_description`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `feedback`
-- 

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE `feedback` (
  `FId` mediumint(10) NOT NULL auto_increment,
  `Name` varchar(50) default NULL,
  `Company` varchar(100) default NULL,
  `Phone` varchar(20) default NULL,
  `Mobile` varchar(20) default NULL,
  `Email` varchar(100) default NULL,
  `QQ` int(10) default NULL,
  `Face` tinyint(2) default '0',
  `Subject` varchar(100) default NULL,
  `Message` text,
  `Site` varchar(10) default NULL,
  `Ip` varchar(15) default NULL,
  `PostTime` int(10) default '0',
  `Reply` text,
  `ReplyTime` int(10) default '0',
  `Display` tinyint(1) default '0',
  `IsRead` tinyint(1) default '0',
  PRIMARY KEY  (`FId`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- 导出表中的数据 `feedback`
-- 

INSERT INTO `feedback` VALUES (1, '320006220', 'LY Network', '02083226791', '1380013800', '320006220@qq.com', 0, 0, 'test', 'aass rrr vcsa yterte xczzc yjtxv', 'en', '127.0.0.1', 1347956173, NULL, 0, 0, 1);

-- --------------------------------------------------------

-- 
-- 表的结构 `info`
-- 

DROP TABLE IF EXISTS `info`;
CREATE TABLE `info` (
  `InfoId` mediumint(8) NOT NULL auto_increment,
  `CateId` smallint(5) default '0',
  `Title` varchar(100) default NULL,
  `PicPath` varchar(100) default NULL,
  `ExtUrl` varchar(200) default NULL,
  `Author` varchar(50) default NULL,
  `Provenance` varchar(50) default NULL,
  `Burden` varchar(50) default NULL,
  `BriefDescription` varchar(255) default NULL,
  `IsInIndex` tinyint(1) default '0',
  `IsHot` tinyint(1) default '0',
  `SeoTitle` varchar(200) default NULL,
  `SeoKeywords` varchar(200) default NULL,
  `SeoDescription` varchar(200) default NULL,
  `AccTime` int(10) default '0',
  `Language` tinyint(1) default '0',
  `PageUrl` varchar(250) default NULL,
  `MyOrder` smallint(5) default '0',
  PRIMARY KEY  (`InfoId`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- 
-- 导出表中的数据 `info`
-- 

INSERT INTO `info` VALUES (1, 0, 'How Whitney''s voice transformed two writers'' careers', '', '', '', '', '', '', 0, 1, '', '', '', 1329148800, 1, '/info/how-whitneys-voice-transformed-two-writers-careers-1.html', 0);
INSERT INTO `info` VALUES (2, 0, 'Greek bailout crisis: Brussels welcomes austerity vote', '', '', '', '', '', '', 0, 1, '', '', '', 1329148800, 0, '/info/greek-bailout-crisis-brussels-welcomes-austerity-vote-2.html', 0);
INSERT INTO `info` VALUES (3, 0, 'Rangers FC signals intent to go into administration', '', '', '', '', '', '', 0, 1, '', '', '', 1329148800, 0, '/info/rangers-fc-signals-intent-to-go-into-administration-3.html', 0);
INSERT INTO `info` VALUES (4, 0, 'Amsterdam''s Schiphol airport evacuated amid bomb threat', '', '', '', '', '', '', 0, 1, 'Amsterdam''s Schiphol airport evacuated amid bomb threat', 'Amsterdam''s Schiphol airport evacuated amid bomb threat', 'Amsterdam''s Schiphol airport evacuated amid bomb threat', 1329148800, 0, '/info/amsterdams-schiphol-airport-evacuated-amid-bomb-threat-4.html', 0);

-- --------------------------------------------------------

-- 
-- 表的结构 `info_category`
-- 

DROP TABLE IF EXISTS `info_category`;
CREATE TABLE `info_category` (
  `CateId` smallint(5) NOT NULL auto_increment,
  `Category` varchar(50) default NULL,
  `UId` varchar(50) default NULL,
  `PicPath` varchar(100) default NULL,
  `SeoTitle` varchar(200) default NULL,
  `SeoKeywords` varchar(200) default NULL,
  `SeoDescription` varchar(200) default NULL,
  `Dept` tinyint(2) default '1',
  `SubCate` smallint(5) default '0',
  `PageUrl` varchar(250) default NULL,
  `MyOrder` smallint(5) default '0',
  PRIMARY KEY  (`CateId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `info_category`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `info_category_description`
-- 

DROP TABLE IF EXISTS `info_category_description`;
CREATE TABLE `info_category_description` (
  `DId` smallint(5) NOT NULL auto_increment,
  `CateId` smallint(5) default '0',
  `Description` text,
  PRIMARY KEY  (`DId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `info_category_description`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `info_contents`
-- 

DROP TABLE IF EXISTS `info_contents`;
CREATE TABLE `info_contents` (
  `CId` mediumint(8) NOT NULL auto_increment,
  `InfoId` mediumint(8) default '0',
  `Contents` text,
  PRIMARY KEY  (`CId`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- 
-- 导出表中的数据 `info_contents`
-- 

INSERT INTO `info_contents` VALUES (1, 1, '<p>\r\n	George Merrill and Shannon Rubicam wrote two US number one hits for Whitney Houston in the 1980s.</p>\r\n<p>\r\n	The couple had moved from Seattle to California to work as songwriters. How Will I Know and I Wanna Dance with Somebody were the songs that made their names.</p>\r\n<p>\r\n	By 1988, they had their own record deal and scored a global hit of their own with the song Waiting for a Star to Fall, recorded under the name Boy Meets Girl.</p>\r\n<p>\r\n	The duo told the BBC about how their songs came to be part of Whitney Houston&#39;s repertoire, and how her vocals embellished their original demos.</p>\r\n<p>\r\n	<strong>George:</strong> We&#39;d had success prior to How Will I Know, but nothing that compared. That was the meteoric rise, right there. But it was originally written for Janet Jackson.</p>\r\n<p>\r\n	<strong>Shannon:</strong> We were asked by our publishing company to write something for Janet&#39;s album, and we just wrote for what we knew of Janet&#39;s voice and style. But she took such a different musical direction on that record, which became her Control album, that they turned down our song.</p>\r\n<p>\r\n	But then Clive [Davis - Arista Records] heard it and wanted it for Whitney, who he had discovered.</p>\r\n<p>\r\n	<strong>George:</strong> We didn&#39;t know much about Whitney. There was a buzz. People who had heard her and seen her were excited. But we were concerned it wouldn&#39;t work out as well as it might have with Janet Jackson.</p>\r\n<p>\r\n	Then we got a call from our friends Alan and Preston Glass [record producers], who were in the studio in San Rafael, northern California with Narada Michael Walden [producer of How Will I Know].</p>\r\n<p>\r\n	They were kind of excited and whispering, &quot;I think you&#39;ve got to hear this right now&quot;. They hit playback and we got a chance to hear How Will I Know in its rough, unmixed form.</p>\r\n<div class="caption body-narrow-width">\r\n	<span style="width: 304px">Rubicam and Merrill wrote Houston&#39;s How Will I Know and I Wanna Dance with Somebody</span></div>\r\n<p>\r\n	<strong>Shannon: </strong>Even down the telephone, I&#39;d never heard anyone sing like that. Especially on one of our songs. I think our hair blew back!</p>\r\n<p>\r\n	<strong>George:</strong> She bit off those lines and chewed up the song. It was so exciting.</p>\r\n<p>\r\n	<strong>Shannon:</strong> The demo recording had been very soft and sweet, because we were thinking of Janet Jackson. Whitney added her power punch to it.</p>\r\n<p>\r\n	I&#39;d put a few ad libs in on the guide vocal track, but she embellished them and made them her own. She sang the hell out of it.</p>\r\n<p>\r\n	<strong>George:</strong> When we came to write I Wanna Dance, that was written specifically for Whitney. And it was really exciting to hear some of the little things Shannon did on the demo, little twists on the words, when Whitney picked those up and sang them later.</p>\r\n<p>\r\n	<strong>Shannon:</strong> But she was always very true to the melody. She had the sensibility to embellish the song with acrobatic licks but maintain a real elegant control. She never got crazy. It was really something.</p>\r\n<p>\r\n	If you listen to the a capella version of How Will I Know, she&#39;s so precise. Even at the lower end of her zenith, she still was one of the better singers around. Most of us could never approach that.</p>\r\n<p>\r\n	Her impact on the world of female singers, in particular, was so strong. It&#39;s strange to think there&#39;s a group of girls aged 10 and 11 now who&#39;ll grow up with a completely different set of idols, and they won&#39;t know about Whitney Houston.</p>\r\n<p>\r\n	<strong>George:</strong> For me, the other memory that sticks out was when she was playing at the Greek Theater in the open air in Los Angeles [on the 1986 Greatest Love Tour]. Shannon and I had seats right back by the mixing board and when she sang our song, everyone jumped up. She was so powerful and it was such a great moment.</p>\r\n<p>\r\n	We got the chance to meet her afterwards. She was just this kid - this elated kid.</p>\r\n<p>\r\n	<strong>Shannon:</strong> Effervescent and silly and happy. Her parents were there...</p>\r\n<p>\r\n	<strong>George:</strong> ...and they were hugging her. Everyone was hugging. It was a really exciting moment.</p>\r\n<p>\r\n	<strong>Shannon:</strong> The gifts that she brought into our lives were so unexpected and so brilliant. I will always be grateful to her for that.</p>');
INSERT INTO `info_contents` VALUES (2, 2, '<p>\r\n	<strong>The European Commission has welcomed the Greek parliament&#39;s decision to approve tough new austerity measures.</strong></p>\r\n<p>\r\n	Economics commissioner Olli Rehn urged Greek officials to &quot;take ownership&quot; and fully implement the reforms, demanded by the EU in return for a huge bailout.</p>\r\n<p>\r\n	But the measures attracted massive protests throughout Greece. Buildings were set on fire in Athens and police used tear gas to disperse the crowds.</p>\r\n<p>\r\n	The government confirmed later that an election would be held in April.</p>\r\n<p>\r\n	Analysts say the biggest party in the governing coalition, the socialist Pasok, is likely to suffer at the hands of the electorate.</p>\r\n<p>\r\n	Greece is trying to secure a 130bn euro ($170bn; &pound;110bn) bailout from the EU and IMF to prevent it defaulting on its massive debts. The deal, which has not yet been finalised, could write off around half of Greece&#39;s privately-held debt.</p>\r\n<p>\r\n	The austerity measures were demanded by the European Union as a precondition for releasing the funds.</p>\r\n<p>\r\n	Greece now has two days to meet two other EU demands: setting out exactly how it will make 325m euros of the promised savings, and giving written confirmation that the measures will be implemented regardless of the outcome of April&#39;s election.</p>\r\n<p>\r\n	Read Gavin&#39;s thoughts in full<br />\r\n	European Union finance ministers are due to discuss their decision on the bailout package at a meeting on Wednesday.</p>\r\n<p>\r\n	Athens has been criticised for failing to implement many of the pledges it made in the first round of austerity measures, prompting concern from some EU politicians that the cuts might not be put into effect.</p>\r\n<p>\r\n	German Chancellor Angela Merkel hailed the vote as a &quot;very important step&quot; on the road to Greek stability, but insisted there &quot;would not and cannot be any changes&quot; to the austerity programme.</p>\r\n<p>\r\n	Mr Rehn meanwhile said the EU continued to stand by the Greek people, and insisted that the reforms were needed to ensure future economic growth.</p>\r\n<p>\r\n	&quot;The Greek authorities and political forces should now take full ownership and make the case for the second programme and fully implement it in order to return the country to stable economic growth and job creation,&quot; he said.</p>\r\n<p>\r\n	The EU has been the target of much anger among Greeks, who see the reforms as piling unnecessary hardship on ordinary people.</p>\r\n<p>\r\n	Continue reading the main story<br />\r\n	&ldquo;<br />\r\n	Start Quote<br />\r\n	As ever, the biggest question mark of all - which was not a question at all for last night&#39;s rioters - is whether the Greek government is right in its assessment, that qualifying for sticking with the programme is still in the country&#39;s best interests &rdquo;<br />\r\n	End Quote&nbsp;<br />\r\n	Stephanie Flanders<br />\r\n	&nbsp;<br />\r\n	Economics editor<br />\r\n	&nbsp;<br />\r\n	--------------------------------------------------------------------------------</p>\r\n<p>\r\n	Read more from Stephanie<br />\r\n	The measures include slashing 15,000 public-sector jobs as part of a longer-term strategy to get rid of 150,000 civil servants.</p>\r\n<p>\r\n	The minimum wage is also to be cut by 20% to about 600 euros a month, and labour laws are to be liberalised to allow easier hiring and firing of staff.</p>\r\n<p>\r\n	Financial markets were up slightly after the austerity bill was passed.</p>\r\n<p>\r\n	But tens of thousands protested against the measures in Athens on Sunday night.</p>\r\n<p>\r\n	Most of the demonstrators protested peacefully, but small groups were involved in running battles with riot police.</p>\r\n<p>\r\n	They did huge damage to the city, attacking buildings with petrol bombs, and setting fire to banks, cinemas and cafes.</p>\r\n<p>\r\n	In all, 45 buildings are said to have burnt in the worst rioting for years. Other businesses were looted and badly damaged.</p>\r\n<p>\r\n	Continue reading the main story What went wrong in Greece?<br />\r\n	&nbsp;<br />\r\n	Greece&#39;s economic reforms, which led to it abandoning the drachma as its currency in favour of the euro in 2002, made it easier for the country to borrow money.<br />\r\n	&nbsp;<br />\r\n	Greece went on a big, debt-funded spending spree, including paying for high-profile projects such as the 2004 Athens Olympics, which went well over its budget.<br />\r\n	&nbsp;<br />\r\n	The country was hit by the downturn, which meant it had to spend more on benefits and received less in taxes. There were also doubts about the accuracy of its economic statistics.<br />\r\n	&nbsp;<br />\r\n	Greece&#39;s economic problems meant lenders started charging higher interest rates to lend it money. Widespread tax evasion also hit the government&#39;s coffers.<br />\r\n	&nbsp;<br />\r\n	There have been demonstrations against the government&#39;s austerity measures to deal with its debt, such as cuts to public sector pay and pensions, reduced benefits and increased taxes.<br />\r\n	&nbsp;<br />\r\n	The EU, IMF and European Central Bank agreed 229bn euros ($300bn; &pound;190bn) of rescue loans for Greece. Prime Minister George Papandreou quit in November 2011 after trying to call a referendum.<br />\r\n	&nbsp;<br />\r\n	Eurozone leaders are worried that if Greece were to default, and even leave the euro, it would cause a major financial crisis that could spread to much bigger economies such as Italy and Spain.<br />\r\n	&nbsp;<br />\r\n	Under Prime Minister Lucas Papademos, Greece is trying to negotiate a big write-off of private debts and secure a second bail-out of 130bn euros ($170bn, &pound;80bn) before a 20 March deadline.<br />\r\n	BACK 1 of 8 NEXT At least 170 people, most of them police officers, were hurt during the disturbances, and dozens of people were arrested.</p>\r\n<p>\r\n	Firefighters were still damping down some of the blazes on Monday.</p>\r\n<p>\r\n	Eurozone finance ministers will closely monitor the situation in Greece before making further decisions on the bailout package at Wednesday&#39;s meeting.</p>\r\n<p>\r\n	They rejected a previous set of measures proposed by Athens, demanding an extra 325m euros in savings.</p>\r\n<p>\r\n	Passing the austerity bill has cost Greece&#39;s coalition more than 40 MPs, who were dismissed after refusing to back the plan.</p>\r\n<p>\r\n	Several ministers have resigned, and a small right-wing party Laos, the junior member of the coalition, also withdrew its co-operation.</p>');
INSERT INTO `info_contents` VALUES (3, 3, 'Rangers Football Club has lodged legal papers signalling its intention to go into administration.<br />\r\n<br />\r\nThe Ibrox club lodged papers at the Court of Session in Edinburgh on Monday, notifying an intention to declare an administrator.<br />\r\n<br />\r\nIt now has five days to confirm whether administrators have been appointed to take over the running of the club.<br />\r\n<br />\r\nThe move comes while Rangers awaits a tax tribunal decision over a disputed bill plus penalties totalling &pound;49m.<br />\r\n<br />\r\nIf the club is formally put into administration it faces an immediate 10-point penalty from the Scottish Premier League.<br />\r\n<br />\r\nThat would place the Ibrox club 14 points behind first-placed Celtic in the race for the championship.<br />\r\n<br />\r\nCraig Whyte bought the club last year from Sir David Murray It is understood the papers relating to administration were lodged by Rangers&#39; lawyers on behalf of directors.<br />\r\n<br />\r\nCraig Whyte, who bought the club from former owner Sir David Murray last year, said recently that administration was an option if the club lost the tax case.<br />\r\n<br />\r\nThe case relates to the use of employment benefit trusts (EBTs) to pay players and other staff.<br />\r\n<br />\r\nIt is thought that HM Revenue and Customs believe the club misused the scheme and avoided paying significant sums in tax.<br />\r\n<br />\r\nThe amount HMRC is claiming, including penalties and interest, is believed to be about &pound;49m.<br />\r\n<br />\r\nBBC Scotland&#39;s business and economy editor, Douglas Fraser, said the legal moves on Monday surrounding administration would give the club &quot;a few days for negotiations with HM Revenue and Customs (HMRC)&quot;.<br />\r\n<br />\r\nThe revenue could stand to lose out on any tax due if Mr Whyte chooses to collapse the company.<br />\r\n<br />\r\nMr Whyte is understood to be the club&#39;s main secured creditor via a floating charge over its assets.<br />\r\n<br />\r\nThis would allow him to pursue other avenues such as receivership or pre-pack administration to satisfy the debts which the club owes him.<br />\r\n<br />\r\nThese would involve transferring Rangers assets out to another company or companies to satisfy outstanding debts to the floating charge holder and leaving the club behind with the debt.<br />\r\n<br />\r\nIn such scenarios, it would be likely that Rangers FC - formed in 1873 - would be formally wound up.');
INSERT INTO `info_contents` VALUES (4, 4, 'Dutch police say they have arrested a man who locked himself in a toilet and claimed to have a bomb at Amsterdam&#39;s Schiphol airport.<br />\r\n<br />\r\nThe airport&#39;s two main international terminals were evacuated at about 11:30 (10:30 GMT), as the bomb squad and scores of police arrived at the scene.<br />\r\n<br />\r\nThe terminals reopened about four hours later, after officers said the man posed no threat to the public.<br />\r\n<br />\r\nHowever, delays continued to affect the airport - one of Europe&#39;s busiest.<br />\r\n<br />\r\nPolice dogs<br />\r\n<br />\r\nDutch border police were investigating whether the suspect had explosives in his luggage, reported the BBC&#39;s Anna Holligan in The Hague.<br />\r\n<br />\r\nLive television streams had shown police with guns, dogs and balaclavas outside the building, she added.<br />\r\n<br />\r\nPassengers were warned to expect disruption for the rest of Monday By 16:00 local time, the airport&#39;s website was showing 16 cancellations to inbound flights and 11 to departures. Dozens of flights were delayed.<br />\r\n<br />\r\nA Schiphol spokesman said: &quot;Things are not back to normal yet. The evacuation is over and we are busy getting operations back on track but there will be some delays and cancellations for the rest of the day.&quot;<br />\r\n<br />\r\nOn 25 December 2009, a Nigerian student smuggled explosives on to a flight from Schiphol to Detroit in the US after flying into Amsterdam from Lagos.<br />\r\n<br />\r\nHe has pleaded guilty to trying to blow up the Northwest Airlines jet he boarded and is due to be sentenced on Thursday. He faces life imprisonment.');

-- --------------------------------------------------------

-- 
-- 表的结构 `instance`
-- 

DROP TABLE IF EXISTS `instance`;
CREATE TABLE `instance` (
  `CaseId` mediumint(8) NOT NULL auto_increment,
  `CateId` smallint(5) default '0',
  `Name` varchar(100) default NULL,
  `PicPath_0` varchar(100) default NULL,
  `PicPath_1` varchar(100) default NULL,
  `PicPath_2` varchar(100) default NULL,
  `PicPath_3` varchar(100) default NULL,
  `PicPath_4` varchar(100) default NULL,
  `Alt_0` varchar(100) default NULL,
  `Alt_1` varchar(100) default NULL,
  `Alt_2` varchar(100) default NULL,
  `Alt_3` varchar(100) default NULL,
  `Alt_4` varchar(100) default NULL,
  `BriefDescription` varchar(255) default NULL,
  `SeoTitle` varchar(200) default NULL,
  `SeoKeywords` varchar(200) default NULL,
  `SeoDescription` varchar(200) default NULL,
  `IsInIndex` tinyint(1) default '0',
  `IsClassic` tinyint(1) default '0',
  `UpdateTime` int(10) default '0',
  `Language` tinyint(1) default '0',
  `PageUrl` varchar(250) default NULL,
  `MyOrder` smallint(5) default '0',
  PRIMARY KEY  (`CaseId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `instance`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `instance_category`
-- 

DROP TABLE IF EXISTS `instance_category`;
CREATE TABLE `instance_category` (
  `CateId` smallint(5) NOT NULL auto_increment,
  `Category` varchar(50) default NULL,
  `UId` varchar(50) default NULL,
  `PicPath` varchar(100) default NULL,
  `SeoTitle` varchar(200) default NULL,
  `SeoKeywords` varchar(200) default NULL,
  `SeoDescription` varchar(200) default NULL,
  `Dept` tinyint(2) default '1',
  `SubCate` smallint(5) default '0',
  `PageUrl` varchar(250) default NULL,
  `MyOrder` smallint(5) default '0',
  PRIMARY KEY  (`CateId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `instance_category`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `instance_category_description`
-- 

DROP TABLE IF EXISTS `instance_category_description`;
CREATE TABLE `instance_category_description` (
  `DId` smallint(5) NOT NULL auto_increment,
  `CateId` smallint(5) default '0',
  `Description` text,
  PRIMARY KEY  (`DId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `instance_category_description`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `instance_description`
-- 

DROP TABLE IF EXISTS `instance_description`;
CREATE TABLE `instance_description` (
  `DId` mediumint(8) NOT NULL auto_increment,
  `CaseId` mediumint(8) default '0',
  `Description` text,
  PRIMARY KEY  (`DId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `instance_description`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `links`
-- 

DROP TABLE IF EXISTS `links`;
CREATE TABLE `links` (
  `LId` smallint(5) NOT NULL auto_increment,
  `Name` varchar(50) default NULL,
  `Url` varchar(200) default NULL,
  `LogoPath` varchar(100) default NULL,
  `Language` varchar(10) default NULL,
  `MyOrder` smallint(5) default '0',
  PRIMARY KEY  (`LId`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- 
-- 导出表中的数据 `links`
-- 

INSERT INTO `links` VALUES (1, 'Forest Homes', 'http://news.163.com/', '/u_file/links/12_10_29/s_8490d74491.jpg', '0', 0);
INSERT INTO `links` VALUES (2, 'Wiener Borse', 'http://www.ly200.com/', '/u_file/links/12_10_29/s_977043f03f.jpg', '0', 0);
INSERT INTO `links` VALUES (3, 'Badotherm Holland', 'http://www.google.com/', '/u_file/links/12_10_29/s_b038ad4799.jpg', '0', 0);
INSERT INTO `links` VALUES (4, 'Jaclyn & Smith', 'http://www.lywebsite.com/', '/u_file/links/12_10_29/s_8064d7e752.jpg', '0', 0);
INSERT INTO `links` VALUES (5, 'Chartered Accountants', 'http://www.ly200.com/', '/u_file/links/12_10_29/s_730b21f318.jpg', '0', 0);

-- --------------------------------------------------------

-- 
-- 表的结构 `manage_log`
-- 

DROP TABLE IF EXISTS `manage_log`;
CREATE TABLE `manage_log` (
  `LId` mediumint(10) NOT NULL auto_increment,
  `AdminUserName` varchar(16) default NULL,
  `PageUrl` varchar(250) default NULL,
  `Ip` varchar(15) default NULL,
  `LogContents` varchar(100) default NULL,
  `OpTime` int(10) default '0',
  PRIMARY KEY  (`LId`)
) ENGINE=MyISAM AUTO_INCREMENT=589 DEFAULT CHARSET=utf8 AUTO_INCREMENT=589 ;

-- 
-- 导出表中的数据 `manage_log`
-- 

INSERT INTO `manage_log` VALUES (1, 'lywebsite', '/manage/index.php?', '127.0.0.1', '成功登录后台', 1347936577);
INSERT INTO `manage_log` VALUES (2, 'lywebsite', '/manage/set/global.php?', '127.0.0.1', '系统全局设置', 1347936643);
INSERT INTO `manage_log` VALUES (3, 'lywebsite', '/manage/article/add.php?', '127.0.0.1', '添加信息页：Company', 1347949595);
INSERT INTO `manage_log` VALUES (4, 'lywebsite', '/manage/article/add.php?', '127.0.0.1', '添加信息页：Contact Us', 1347949635);
INSERT INTO `manage_log` VALUES (5, 'lywebsite', '/manage/article/add.php?', '127.0.0.1', '添加信息页：Factory', 1347949667);
INSERT INTO `manage_log` VALUES (6, 'lywebsite', '/manage/article/add.php?', '127.0.0.1', '添加信息页：Sitemap', 1347949702);
INSERT INTO `manage_log` VALUES (7, 'lywebsite', '/manage/article/mod.php?', '127.0.0.1', '编辑信息页：Company', 1347952168);
INSERT INTO `manage_log` VALUES (8, 'lywebsite', '/manage/product/add.php?', '127.0.0.1', '添加产品:Leather Simple Fashion Lady Bag', 1347954716);
INSERT INTO `manage_log` VALUES (9, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:Leather Simple Fashion Lady Bag', 1347954721);
INSERT INTO `manage_log` VALUES (10, 'lywebsite', '/manage/product/copy.php?ProId=1', '127.0.0.1', '复制产品:Leather Simple Fashion Lady Bag', 1347954724);
INSERT INTO `manage_log` VALUES (11, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:Leather Simple Fashion Lady Bag', 1347954729);
INSERT INTO `manage_log` VALUES (12, 'lywebsite', '/manage/product/copy.php?ProId=2', '127.0.0.1', '复制产品:Leather Simple Fashion Lady Bag', 1347954732);
INSERT INTO `manage_log` VALUES (13, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:Leather Simple Fashion Lady Bag', 1347954736);
INSERT INTO `manage_log` VALUES (14, 'lywebsite', '/manage/product/copy.php?ProId=3', '127.0.0.1', '复制产品:Leather Simple Fashion Lady Bag', 1347954740);
INSERT INTO `manage_log` VALUES (15, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:Leather Simple Fashion Lady Bag', 1347954745);
INSERT INTO `manage_log` VALUES (16, 'lywebsite', '/manage/product/copy.php?ProId=4', '127.0.0.1', '复制产品:Leather Simple Fashion Lady Bag', 1347954749);
INSERT INTO `manage_log` VALUES (17, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:Leather Simple Fashion Lady Bag', 1347954755);
INSERT INTO `manage_log` VALUES (18, 'lywebsite', '/manage/product/copy.php?ProId=5', '127.0.0.1', '复制产品:Leather Simple Fashion Lady Bag', 1347954757);
INSERT INTO `manage_log` VALUES (19, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:Leather Simple Fashion Lady Bag', 1347954761);
INSERT INTO `manage_log` VALUES (20, 'lywebsite', '/manage/product/category_add.php?', '127.0.0.1', '添加产品类别:Door Closer Series', 1347955028);
INSERT INTO `manage_log` VALUES (21, 'lywebsite', '/manage/product/category_add.php?', '127.0.0.1', '添加产品类别:Door Handle Series', 1347955070);
INSERT INTO `manage_log` VALUES (22, 'lywebsite', '/manage/product/category_mod.php?', '127.0.0.1', '更新产品类别:Door Closer Series', 1347955081);
INSERT INTO `manage_log` VALUES (23, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:Leather Simple Fashion Lady Bag', 1347955091);
INSERT INTO `manage_log` VALUES (24, 'lywebsite', '/manage/info/mod.php?', '127.0.0.1', '编辑文章:Amsterdam\\''s Schiphol airport evacuated amid bomb threat', 1347955284);
INSERT INTO `manage_log` VALUES (25, 'lywebsite', '/manage/info/mod.php?', '127.0.0.1', '编辑文章:Rangers FC signals intent to go into administration', 1347955289);
INSERT INTO `manage_log` VALUES (26, 'lywebsite', '/manage/info/mod.php?', '127.0.0.1', '编辑文章:Greek bailout crisis: Brussels welcomes austerity vote', 1347955294);
INSERT INTO `manage_log` VALUES (27, 'lywebsite', '/manage/info/mod.php?', '127.0.0.1', '编辑文章:How Whitney\\''s voice transformed two writers\\'' careers', 1347955297);
INSERT INTO `manage_log` VALUES (28, 'lywebsite', '/manage/info/mod.php?', '127.0.0.1', '编辑文章:How Whitney\\''s voice transformed two writers\\'' careers', 1347955302);
INSERT INTO `manage_log` VALUES (29, 'lywebsite', '/manage/ad/add.php?', '127.0.0.1', '添加广告图片', 1347955372);
INSERT INTO `manage_log` VALUES (30, 'lywebsite', '/manage/ad/mod.php?', '127.0.0.1', '更新广告图片', 1347955381);
INSERT INTO `manage_log` VALUES (31, 'lywebsite', '/manage/ad/add.php?', '127.0.0.1', '添加广告图片', 1347955401);
INSERT INTO `manage_log` VALUES (32, 'lywebsite', '/manage/ad/mod.php?', '127.0.0.1', '更新广告图片', 1347955407);
INSERT INTO `manage_log` VALUES (33, 'lywebsite', '/manage/ad/add.php?', '127.0.0.1', '添加广告图片', 1347955427);
INSERT INTO `manage_log` VALUES (34, 'lywebsite', '/manage/ad/mod.php?', '127.0.0.1', '更新广告图片', 1347955433);
INSERT INTO `manage_log` VALUES (35, 'lywebsite', '/manage/ad/add.php?', '127.0.0.1', '添加广告图片', 1347955445);
INSERT INTO `manage_log` VALUES (36, 'lywebsite', '/manage/ad/mod.php?', '127.0.0.1', '更新广告图片', 1347955450);
INSERT INTO `manage_log` VALUES (37, 'lywebsite', '/manage/index.php?', '127.0.0.1', '成功登录后台', 1351321581);
INSERT INTO `manage_log` VALUES (38, 'lywebsite', '/manage/article/mod.php?', '127.0.0.1', '编辑信息页：Company', 1351321649);
INSERT INTO `manage_log` VALUES (39, 'lywebsite', '/manage/article/mod.php?', '127.0.0.1', '编辑信息页：Contact Us', 1351321687);
INSERT INTO `manage_log` VALUES (40, 'lywebsite', '/manage/article/mod.php?', '127.0.0.1', '编辑信息页：Sitemap', 1351321706);
INSERT INTO `manage_log` VALUES (41, 'lywebsite', '/manage/article/index.php?', '127.0.0.1', '批量删除信息页', 1351321713);
INSERT INTO `manage_log` VALUES (42, 'lywebsite', '/manage/product/category_mod.php?', '127.0.0.1', '更新产品类别:Clothing', 1351322946);
INSERT INTO `manage_log` VALUES (43, 'lywebsite', '/manage/product/category_mod.php?', '127.0.0.1', '更新产品类别:Jewelry', 1351323006);
INSERT INTO `manage_log` VALUES (44, 'lywebsite', '/manage/product/category_add.php?', '127.0.0.1', '添加产品类别:Accessories', 1351323070);
INSERT INTO `manage_log` VALUES (45, 'lywebsite', '/manage/product/category_add.php?', '127.0.0.1', '添加产品类别:Theme', 1351323092);
INSERT INTO `manage_log` VALUES (46, 'lywebsite', '/manage/product/add.php?', '127.0.0.1', '添加产品:New Womem Sexy Srawstring', 1351323188);
INSERT INTO `manage_log` VALUES (47, 'lywebsite', '/manage/product/copy.php?ProId=1', '127.0.0.1', '复制产品:New Womem Sexy Srawstring', 1351323195);
INSERT INTO `manage_log` VALUES (48, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:New Womem Sexy Srawstring', 1351323199);
INSERT INTO `manage_log` VALUES (49, 'lywebsite', '/manage/product/copy.php?ProId=2', '127.0.0.1', '复制产品:New Womem Sexy Srawstring', 1351323202);
INSERT INTO `manage_log` VALUES (50, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:New Womem Sexy Srawstring', 1351323208);
INSERT INTO `manage_log` VALUES (51, 'lywebsite', '/manage/product/copy.php?ProId=3', '127.0.0.1', '复制产品:New Womem Sexy Srawstring', 1351323210);
INSERT INTO `manage_log` VALUES (52, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:New Womem Sexy Srawstring', 1351323219);
INSERT INTO `manage_log` VALUES (53, 'lywebsite', '/manage/product/copy.php?ProId=4', '127.0.0.1', '复制产品:New Womem Sexy Srawstring', 1351323221);
INSERT INTO `manage_log` VALUES (54, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:New Womem Sexy Srawstring', 1351323226);
INSERT INTO `manage_log` VALUES (55, 'lywebsite', '/manage/product/copy.php?ProId=5', '127.0.0.1', '复制产品:New Womem Sexy Srawstring', 1351323228);
INSERT INTO `manage_log` VALUES (56, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:New Womem Sexy Srawstring', 1351323234);
INSERT INTO `manage_log` VALUES (57, 'lywebsite', '/manage/product/copy.php?ProId=6', '127.0.0.1', '复制产品:New Womem Sexy Srawstring', 1351323256);
INSERT INTO `manage_log` VALUES (58, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:New Womem Sexy Srawstring', 1351323262);
INSERT INTO `manage_log` VALUES (59, 'lywebsite', '/manage/product/copy.php?ProId=7', '127.0.0.1', '复制产品:New Womem Sexy Srawstring', 1351323266);
INSERT INTO `manage_log` VALUES (60, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:New Womem Sexy Srawstring', 1351323271);
INSERT INTO `manage_log` VALUES (61, 'lywebsite', '/manage/product/copy.php?ProId=8', '127.0.0.1', '复制产品:New Womem Sexy Srawstring', 1351323273);
INSERT INTO `manage_log` VALUES (62, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:New Womem Sexy Srawstring', 1351323278);
INSERT INTO `manage_log` VALUES (63, 'lywebsite', '/manage/product/copy.php?ProId=9', '127.0.0.1', '复制产品:New Womem Sexy Srawstring', 1351323280);
INSERT INTO `manage_log` VALUES (64, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:New Womem Sexy Srawstring', 1351323284);
INSERT INTO `manage_log` VALUES (65, 'lywebsite', '/manage/product/category_add.php?', '127.0.0.1', '添加产品类别:Dresses', 1351324195);
INSERT INTO `manage_log` VALUES (66, 'lywebsite', '/manage/product/category_add.php?', '127.0.0.1', '添加产品类别:Tops', 1351324478);
INSERT INTO `manage_log` VALUES (67, 'lywebsite', '/manage/product/category_mod.php?', '127.0.0.1', '更新产品类别:Tops', 1351324498);
INSERT INTO `manage_log` VALUES (68, 'lywebsite', '/manage/product/category_add.php?', '127.0.0.1', '添加产品类别:Bottoms', 1351324511);
INSERT INTO `manage_log` VALUES (69, 'lywebsite', '/manage/product/category_mod.php?', '127.0.0.1', '更新产品类别:Bottoms', 1351324528);
INSERT INTO `manage_log` VALUES (70, 'lywebsite', '/manage/product/category_add.php?', '127.0.0.1', '添加产品类别:Jackets & Seeaters', 1351324570);
INSERT INTO `manage_log` VALUES (71, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:New Womem Sexy Srawstring', 1351326780);
INSERT INTO `manage_log` VALUES (72, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:New Womem Sexy Srawstring', 1351326785);
INSERT INTO `manage_log` VALUES (73, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:New Womem Sexy Srawstring', 1351326791);
INSERT INTO `manage_log` VALUES (74, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:New Womem Sexy Srawstring', 1351326796);
INSERT INTO `manage_log` VALUES (75, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:New Womem Sexy Srawstring', 1351326803);
INSERT INTO `manage_log` VALUES (76, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:New Womem Sexy Srawstring', 1351326811);
INSERT INTO `manage_log` VALUES (77, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:New Womem Sexy Srawstring', 1351326818);
INSERT INTO `manage_log` VALUES (78, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:New Womem Sexy Srawstring', 1351326824);
INSERT INTO `manage_log` VALUES (79, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:New Womem Sexy Srawstring', 1351326830);
INSERT INTO `manage_log` VALUES (80, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:New Womem Sexy Srawstring', 1351326836);
INSERT INTO `manage_log` VALUES (81, 'lywebsite', '/manage/set/global.php?', '127.0.0.1', '系统全局设置', 1351328370);
INSERT INTO `manage_log` VALUES (82, 'lywebsite', '/manage/index.php?', '127.0.0.1', '成功登录后台', 1351474245);
INSERT INTO `manage_log` VALUES (83, 'lywebsite', '/manage/product/category_mod.php?', '127.0.0.1', '更新产品类别:Clothing', 1351475154);
INSERT INTO `manage_log` VALUES (84, 'lywebsite', '/manage/product/category_mod.php?', '127.0.0.1', '更新产品类别:Jewelry', 1351475165);
INSERT INTO `manage_log` VALUES (85, 'lywebsite', '/manage/product/category_mod.php?', '127.0.0.1', '更新产品类别:Accessories', 1351475170);
INSERT INTO `manage_log` VALUES (86, 'lywebsite', '/manage/product/category_mod.php?', '127.0.0.1', '更新产品类别:Theme', 1351475173);
INSERT INTO `manage_log` VALUES (87, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:New Womem Sexy Srawstring', 1351477728);
INSERT INTO `manage_log` VALUES (88, 'lywebsite', '/manage/links/mod.php?', '127.0.0.1', '编辑友情链接:Google', 1351478329);
INSERT INTO `manage_log` VALUES (89, 'lywebsite', '/manage/links/mod.php?', '127.0.0.1', '编辑友情链接:联雅网络', 1351478331);
INSERT INTO `manage_log` VALUES (90, 'lywebsite', '/manage/links/mod.php?', '127.0.0.1', '编辑友情链接:网易新闻', 1351478335);
INSERT INTO `manage_log` VALUES (91, 'lywebsite', '/manage/links/mod.php?', '127.0.0.1', '编辑友情链接:Google', 1351478353);
INSERT INTO `manage_log` VALUES (92, 'lywebsite', '/manage/links/mod.php?', '127.0.0.1', '编辑友情链接:Wiener Borse', 1351478366);
INSERT INTO `manage_log` VALUES (93, 'lywebsite', '/manage/links/mod.php?', '127.0.0.1', '编辑友情链接:LY Network', 1351478385);
INSERT INTO `manage_log` VALUES (94, 'lywebsite', '/manage/links/mod.php?', '127.0.0.1', '编辑友情链接:163', 1351478398);
INSERT INTO `manage_log` VALUES (95, 'lywebsite', '/manage/links/mod.php?', '127.0.0.1', '编辑友情链接:Forest Homes', 1351478439);
INSERT INTO `manage_log` VALUES (96, 'lywebsite', '/manage/links/mod.php?', '127.0.0.1', '编辑友情链接:Badotherm Holland', 1351478477);
INSERT INTO `manage_log` VALUES (97, 'lywebsite', '/manage/links/mod.php?', '127.0.0.1', '编辑友情链接:Wiener Borse', 1351478483);
INSERT INTO `manage_log` VALUES (98, 'lywebsite', '/manage/links/add.php?', '127.0.0.1', '添加友情链接:Jaclyn & Smith', 1351478524);
INSERT INTO `manage_log` VALUES (99, 'lywebsite', '/manage/links/add.php?', '127.0.0.1', '添加友情链接:Chartered Accountants', 1351478575);
INSERT INTO `manage_log` VALUES (100, 'lywebsite', '/manage/ad/mod.php?', '127.0.0.1', '更新广告图片', 1351479032);
INSERT INTO `manage_log` VALUES (101, 'lywebsite', '/manage/ad/mod.php?', '127.0.0.1', '更新广告图片', 1351479040);
INSERT INTO `manage_log` VALUES (102, 'lywebsite', '/manage/ad/mod.php?', '127.0.0.1', '更新广告图片', 1351479045);
INSERT INTO `manage_log` VALUES (103, 'lywebsite', '/manage/ad/mod.php?', '127.0.0.1', '更新广告图片', 1351479050);
INSERT INTO `manage_log` VALUES (104, 'lywebsite', '/manage/index.php?', '127.0.0.1', '成功登录后台', 1361150042);
INSERT INTO `manage_log` VALUES (105, 'lywebsite', '/manage/index.php?', '127.0.0.1', '成功登录后台', 1428644885);
INSERT INTO `manage_log` VALUES (106, 'lywebsite', '/manage/product/category_mod.php?', '127.0.0.1', '更新产品类别:Dresses', 1428645159);
INSERT INTO `manage_log` VALUES (107, 'lywebsite', '/manage/product/category_mod.php?', '127.0.0.1', '更新产品类别:Clothing', 1428645164);
INSERT INTO `manage_log` VALUES (108, 'lywebsite', '/manage/product/category_mod.php?', '127.0.0.1', '更新产品类别:民族乐器', 1428645233);
INSERT INTO `manage_log` VALUES (109, 'lywebsite', '/manage/product/category_mod.php?', '127.0.0.1', '更新产品类别:西洋乐器', 1428645244);
INSERT INTO `manage_log` VALUES (110, 'lywebsite', '/manage/product/category_mod.php?', '127.0.0.1', '更新产品类别:声  乐', 1428645255);
INSERT INTO `manage_log` VALUES (111, 'lywebsite', '/manage/product/category_mod.php?', '127.0.0.1', '更新产品类别:舞  蹈', 1428645270);
INSERT INTO `manage_log` VALUES (112, 'lywebsite', '/manage/product/category_add.php?', '127.0.0.1', '添加产品类别:乐  理', 1428645278);
INSERT INTO `manage_log` VALUES (113, 'lywebsite', '/manage/product/category_mod.php?', '127.0.0.1', '更新产品类别:二胡', 1428645290);
INSERT INTO `manage_log` VALUES (114, 'lywebsite', '/manage/product/category_mod.php?', '127.0.0.1', '更新产品类别:长笛', 1428645306);
INSERT INTO `manage_log` VALUES (115, 'lywebsite', '/manage/product/category_mod.php?', '127.0.0.1', '更新产品类别:短箫', 1428645319);
INSERT INTO `manage_log` VALUES (116, 'lywebsite', '/manage/product/category_mod.php?', '127.0.0.1', '更新产品类别:金属口弦', 1428645330);
INSERT INTO `manage_log` VALUES (117, 'lywebsite', '/manage/product/category_add.php?', '127.0.0.1', '添加产品类别:云锣', 1428645339);
INSERT INTO `manage_log` VALUES (118, 'lywebsite', '/manage/product/category_add.php?', '127.0.0.1', '添加产品类别:琵琶', 1428645351);
INSERT INTO `manage_log` VALUES (119, 'lywebsite', '/manage/product/category_add.php?', '127.0.0.1', '添加产品类别:月琴', 1428645362);
INSERT INTO `manage_log` VALUES (120, 'lywebsite', '/manage/product/category_add.php?', '127.0.0.1', '添加产品类别:象脚鼓', 1428645371);
INSERT INTO `manage_log` VALUES (121, 'lywebsite', '/manage/product/category_add.php?', '127.0.0.1', '添加产品类别:冬不拉', 1428645383);
INSERT INTO `manage_log` VALUES (122, 'lywebsite', '/manage/product/category_add.php?', '127.0.0.1', '添加产品类别:侗笛', 1428645397);
INSERT INTO `manage_log` VALUES (123, 'lywebsite', '/manage/product/category_add.php?', '127.0.0.1', '添加产品类别:板胡', 1428645406);
INSERT INTO `manage_log` VALUES (124, 'lywebsite', '/manage/product/category_add.php?', '127.0.0.1', '添加产品类别:编钟', 1428645421);
INSERT INTO `manage_log` VALUES (125, 'lywebsite', '/manage/product/category_mod.php?', '127.0.0.1', '更新产品类别:西洋乐器', 1428645442);
INSERT INTO `manage_log` VALUES (126, 'lywebsite', '/manage/product/category_mod.php?', '127.0.0.1', '更新产品类别:声  乐', 1428645446);
INSERT INTO `manage_log` VALUES (127, 'lywebsite', '/manage/product/category_mod.php?', '127.0.0.1', '更新产品类别:乐  理', 1428645450);
INSERT INTO `manage_log` VALUES (128, 'lywebsite', '/manage/product/category_mod.php?', '127.0.0.1', '更新产品类别:舞  蹈', 1428645454);
INSERT INTO `manage_log` VALUES (129, 'lywebsite', '/manage/product/category_add.php?', '127.0.0.1', '添加产品类别:电子琴', 1428649424);
INSERT INTO `manage_log` VALUES (130, 'lywebsite', '/manage/product/category_add.php?', '127.0.0.1', '添加产品类别:手拉琴', 1428649449);
INSERT INTO `manage_log` VALUES (131, 'lywebsite', '/manage/product/category_add.php?', '127.0.0.1', '添加产品类别:手提琴', 1428649469);
INSERT INTO `manage_log` VALUES (132, 'lywebsite', '/manage/product/category_add.php?', '127.0.0.1', '添加产品类别:大提琴', 1428649488);
INSERT INTO `manage_log` VALUES (133, 'lywebsite', '/manage/ad/add.php?', '127.0.0.1', '添加广告图片', 1428649797);
INSERT INTO `manage_log` VALUES (134, 'lywebsite', '/manage/ad/mod.php?', '127.0.0.1', '更新广告图片', 1428649822);
INSERT INTO `manage_log` VALUES (135, 'lywebsite', '/manage/index.php?', '127.0.0.1', '成功登录后台', 1428890851);
INSERT INTO `manage_log` VALUES (136, 'lywebsite', '/manage/index.php?', '127.0.0.1', '成功登录后台', 1429168749);
INSERT INTO `manage_log` VALUES (137, 'lywebsite', '/manage/set/global.php?', '127.0.0.1', '系统全局设置', 1429182353);
INSERT INTO `manage_log` VALUES (138, 'lywebsite', '/manage/article/add.php?', '127.0.0.1', '添加信息页：页面底部版权', 1429184598);
INSERT INTO `manage_log` VALUES (139, 'lywebsite', '/manage/ad/add.php?', '127.0.0.1', '添加广告图片', 1429185037);
INSERT INTO `manage_log` VALUES (140, 'lywebsite', '/manage/ad/mod.php?', '127.0.0.1', '更新广告图片', 1429185436);
INSERT INTO `manage_log` VALUES (141, 'lywebsite', '/manage/ad/add.php?', '127.0.0.1', '添加广告图片', 1429185652);
INSERT INTO `manage_log` VALUES (142, 'lywebsite', '/manage/ad/mod.php?', '127.0.0.1', '更新广告图片', 1429185674);
INSERT INTO `manage_log` VALUES (143, 'lywebsite', '/manage/index.php?', '127.0.0.1', '成功登录后台', 1429251852);
INSERT INTO `manage_log` VALUES (144, 'lywebsite', '/manage/index.php?', '127.0.0.1', '成功登录后台', 1429495979);
INSERT INTO `manage_log` VALUES (145, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:New Womem Sexy Srawstring', 1429499220);
INSERT INTO `manage_log` VALUES (146, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:周老师', 1429499310);
INSERT INTO `manage_log` VALUES (147, 'lywebsite', '/manage/index.php?', '127.0.0.1', '成功登录后台', 1429599583);
INSERT INTO `manage_log` VALUES (148, 'lywebsite', '/manage/product/index.php?', '127.0.0.1', '批量删除产品', 1429599597);
INSERT INTO `manage_log` VALUES (149, 'lywebsite', '/manage/product/copy.php?ProId=10', '127.0.0.1', '复制产品:周老师', 1429599599);
INSERT INTO `manage_log` VALUES (150, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:周老师', 1429599604);
INSERT INTO `manage_log` VALUES (151, 'lywebsite', '/manage/product/copy.php?ProId=11', '127.0.0.1', '复制产品:周老师', 1429599606);
INSERT INTO `manage_log` VALUES (152, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:周老师', 1429599618);
INSERT INTO `manage_log` VALUES (153, 'lywebsite', '/manage/product/copy.php?ProId=12', '127.0.0.1', '复制产品:周老师', 1429599621);
INSERT INTO `manage_log` VALUES (154, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:周老师', 1429599624);
INSERT INTO `manage_log` VALUES (155, 'lywebsite', '/manage/product/copy.php?ProId=10', '127.0.0.1', '复制产品:周老师', 1429599625);
INSERT INTO `manage_log` VALUES (156, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:周老师', 1429599628);
INSERT INTO `manage_log` VALUES (157, 'lywebsite', '/manage/product/copy.php?ProId=10', '127.0.0.1', '复制产品:周老师', 1429599630);
INSERT INTO `manage_log` VALUES (158, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:周老师', 1429599634);
INSERT INTO `manage_log` VALUES (159, 'lywebsite', '/manage/product/index.php?', '127.0.0.1', '批量删除产品', 1429602568);
INSERT INTO `manage_log` VALUES (160, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:周老师', 1429602590);
INSERT INTO `manage_log` VALUES (161, 'lywebsite', '/manage/product/copy.php?ProId=15', '127.0.0.1', '复制产品:周老师', 1429603876);
INSERT INTO `manage_log` VALUES (162, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:周老师', 1429603878);
INSERT INTO `manage_log` VALUES (163, 'lywebsite', '/manage/product/copy.php?ProId=16', '127.0.0.1', '复制产品:周老师', 1429603880);
INSERT INTO `manage_log` VALUES (164, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:周老师', 1429603882);
INSERT INTO `manage_log` VALUES (165, 'lywebsite', '/manage/product/copy.php?ProId=17', '127.0.0.1', '复制产品:周老师', 1429604433);
INSERT INTO `manage_log` VALUES (166, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:周老师', 1429604435);
INSERT INTO `manage_log` VALUES (167, 'lywebsite', '/manage/product/copy.php?ProId=18', '127.0.0.1', '复制产品:周老师', 1429604437);
INSERT INTO `manage_log` VALUES (168, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:周老师', 1429604439);
INSERT INTO `manage_log` VALUES (169, 'lywebsite', '/manage/product/index.php?', '127.0.0.1', '批量删除产品', 1429605233);
INSERT INTO `manage_log` VALUES (170, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:周老师', 1429605242);
INSERT INTO `manage_log` VALUES (171, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:周老师', 1429610403);
INSERT INTO `manage_log` VALUES (172, 'lywebsite', '/manage/index.php?', '127.0.0.1', '成功登录后台', 1429665465);
INSERT INTO `manage_log` VALUES (173, 'lywebsite', '/manage/index.php?', '127.0.0.1', '成功登录后台', 1429671723);
INSERT INTO `manage_log` VALUES (174, 'lywebsite', '/manage/article/index.php?', '127.0.0.1', '批量删除信息页', 1429694686);
INSERT INTO `manage_log` VALUES (175, 'lywebsite', '/manage/article/add.php?', '127.0.0.1', '添加信息页：注册协议', 1429694718);
INSERT INTO `manage_log` VALUES (176, 'lywebsite', '/manage/index.php?', '127.0.0.1', '成功登录后台', 1429926512);
INSERT INTO `manage_log` VALUES (177, 'lywebsite', '/manage/index.php?', '127.0.0.1', '成功登录后台', 1429932035);
INSERT INTO `manage_log` VALUES (178, 'lywebsite', '/manage/product/category_add.php?', '127.0.0.1', '添加产品类别:乐理', 1429940671);
INSERT INTO `manage_log` VALUES (179, 'lywebsite', '/manage/product/category_add.php?', '127.0.0.1', '添加产品类别:乐感', 1429940687);
INSERT INTO `manage_log` VALUES (180, 'lywebsite', '/manage/product/category_mod.php?', '127.0.0.1', '更新产品类别:乐理', 1429940698);
INSERT INTO `manage_log` VALUES (181, 'lywebsite', '/manage/product/category_mod.php?', '127.0.0.1', '更新产品类别:吉他乐理', 1429940936);
INSERT INTO `manage_log` VALUES (182, 'lywebsite', '/manage/product/category_mod.php?', '127.0.0.1', '更新产品类别:吉他技巧', 1429940963);
INSERT INTO `manage_log` VALUES (183, 'lywebsite', '/manage/product/category_add.php?', '127.0.0.1', '添加产品类别:长号', 1429941025);
INSERT INTO `manage_log` VALUES (184, 'lywebsite', '/manage/product/category_mod.php?', '127.0.0.1', '更新产品类别:二胡', 1429941796);
INSERT INTO `manage_log` VALUES (185, 'lywebsite', '/manage/product/category_mod.php?', '127.0.0.1', '更新产品类别:长笛', 1429941804);
INSERT INTO `manage_log` VALUES (186, 'lywebsite', '/manage/product/category_mod.php?', '127.0.0.1', '更新产品类别:短箫', 1429941835);
INSERT INTO `manage_log` VALUES (187, 'lywebsite', '/manage/product/category_mod.php?', '127.0.0.1', '更新产品类别:二胡', 1429942726);
INSERT INTO `manage_log` VALUES (188, 'lywebsite', '/manage/product/category_mod.php?', '127.0.0.1', '更新产品类别:长笛', 1429942730);
INSERT INTO `manage_log` VALUES (189, 'lywebsite', '/manage/product/category_mod.php?', '127.0.0.1', '更新产品类别:短箫', 1429942735);
INSERT INTO `manage_log` VALUES (190, 'lywebsite', '/manage/product/category_mod.php?', '127.0.0.1', '更新产品类别:民族乐器', 1429942794);
INSERT INTO `manage_log` VALUES (191, 'lywebsite', '/manage/product/category_mod.php?', '127.0.0.1', '更新产品类别:二胡', 1429942799);
INSERT INTO `manage_log` VALUES (192, 'lywebsite', '/manage/product/category_mod.php?', '127.0.0.1', '更新产品类别:二胡', 1429942955);
INSERT INTO `manage_log` VALUES (193, 'lywebsite', '/manage/product/category_mod.php?', '127.0.0.1', '更新产品类别:二胡', 1429943266);
INSERT INTO `manage_log` VALUES (194, 'lywebsite', '/manage/product/category_add.php?', '127.0.0.1', '添加产品类别:二胡', 1429946404);
INSERT INTO `manage_log` VALUES (195, 'lywebsite', '/manage/product/category_add.php?', '127.0.0.1', '添加产品类别:吉他', 1429946414);
INSERT INTO `manage_log` VALUES (196, 'lywebsite', '/manage/product/category_add.php?', '127.0.0.1', '添加产品类别:二胡', 1429946421);
INSERT INTO `manage_log` VALUES (197, 'lywebsite', '/manage/product/category_add.php?', '127.0.0.1', '添加产品类别:吉他', 1429946428);
INSERT INTO `manage_log` VALUES (198, 'lywebsite', '/manage/product/color_add.php?', '127.0.0.1', '添加产品颜色:越秀区', 1429946956);
INSERT INTO `manage_log` VALUES (199, 'lywebsite', '/manage/product/color_add.php?', '127.0.0.1', '添加产品颜色:天河区', 1429946967);
INSERT INTO `manage_log` VALUES (200, 'lywebsite', '/manage/product/color_add.php?', '127.0.0.1', '添加产品颜色:荔湾区', 1429946973);
INSERT INTO `manage_log` VALUES (201, 'lywebsite', '/manage/product/color_add.php?', '127.0.0.1', '添加产品颜色:增城区', 1429946983);
INSERT INTO `manage_log` VALUES (202, 'lywebsite', '/manage/product/color_add.php?', '127.0.0.1', '添加产品颜色:天河区', 1429946994);
INSERT INTO `manage_log` VALUES (203, 'lywebsite', '/manage/product/color.php?', '127.0.0.1', '删除产品颜色', 1429946998);
INSERT INTO `manage_log` VALUES (204, 'lywebsite', '/manage/product/color_add.php?', '127.0.0.1', '添加产品颜色:黄埔区', 1429947005);
INSERT INTO `manage_log` VALUES (205, 'lywebsite', '/manage/product/color_add.php?', '127.0.0.1', '添加产品颜色:海珠区', 1429947012);
INSERT INTO `manage_log` VALUES (206, 'lywebsite', '/manage/product/color_add.php?', '127.0.0.1', '添加产品颜色:白云区', 1429947029);
INSERT INTO `manage_log` VALUES (207, 'lywebsite', '/manage/product/color_add.php?', '127.0.0.1', '添加产品颜色:花都区', 1429947036);
INSERT INTO `manage_log` VALUES (208, 'lywebsite', '/manage/product/color_add.php?', '127.0.0.1', '添加产品颜色:番禺区', 1429947044);
INSERT INTO `manage_log` VALUES (209, 'lywebsite', '/manage/product/color_add.php?', '127.0.0.1', '添加产品颜色:佛山市', 1429947218);
INSERT INTO `manage_log` VALUES (210, 'lywebsite', '/manage/product/color_add.php?', '127.0.0.1', '添加产品颜色:深圳市', 1429947230);
INSERT INTO `manage_log` VALUES (211, 'lywebsite', '/manage/index.php?', '127.0.0.1', '成功登录后台', 1430102989);
INSERT INTO `manage_log` VALUES (212, 'lywebsite', '/manage/index.php?', '127.0.0.1', '成功登录后台', 1430366750);
INSERT INTO `manage_log` VALUES (213, 'lywebsite', '/manage/index.php?', '127.0.0.1', '成功登录后台', 1430389770);
INSERT INTO `manage_log` VALUES (214, 'lywebsite', '/manage/index.php?', '127.0.0.1', '成功登录后台', 1430704027);
INSERT INTO `manage_log` VALUES (215, 'lywebsite', '/manage/product/category_mod.php?', '127.0.0.1', '更新产品类别:二胡', 1430704462);
INSERT INTO `manage_log` VALUES (216, 'lywebsite', '/manage/product/category_mod.php?', '127.0.0.1', '更新产品类别:长笛', 1430704482);
INSERT INTO `manage_log` VALUES (217, 'lywebsite', '/manage/product/category_mod.php?', '127.0.0.1', '更新产品类别:短箫', 1430704493);
INSERT INTO `manage_log` VALUES (218, 'lywebsite', '/manage/product/category_mod.php?', '127.0.0.1', '更新产品类别:金属口弦', 1430704509);
INSERT INTO `manage_log` VALUES (219, 'lywebsite', '/manage/product/category_mod.php?', '127.0.0.1', '更新产品类别:二胡', 1430705396);
INSERT INTO `manage_log` VALUES (220, 'lywebsite', '/manage/product/category_mod.php?', '127.0.0.1', '更新产品类别:民族乐器', 1430705401);
INSERT INTO `manage_log` VALUES (221, 'lywebsite', '/manage/product/category_mod.php?', '127.0.0.1', '更新产品类别:长笛', 1430705409);
INSERT INTO `manage_log` VALUES (222, 'lywebsite', '/manage/product/category_mod.php?', '127.0.0.1', '更新产品类别:二胡', 1430705418);
INSERT INTO `manage_log` VALUES (223, 'lywebsite', '/manage/product/category_mod.php?', '127.0.0.1', '更新产品类别:金属口弦', 1430705430);
INSERT INTO `manage_log` VALUES (224, 'lywebsite', '/manage/product/category_mod.php?', '127.0.0.1', '更新产品类别:二胡', 1430705740);
INSERT INTO `manage_log` VALUES (225, 'lywebsite', '/manage/product/category_mod.php?', '127.0.0.1', '更新产品类别:二胡', 1430705874);
INSERT INTO `manage_log` VALUES (226, 'lywebsite', '/manage/product/category_mod.php?', '127.0.0.1', '更新产品类别:二胡', 1430706543);
INSERT INTO `manage_log` VALUES (227, 'lywebsite', '/manage/product/category_mod.php?', '127.0.0.1', '更新产品类别:二胡', 1430706568);
INSERT INTO `manage_log` VALUES (228, 'lywebsite', '/manage/product/category_mod.php?', '127.0.0.1', '更新产品类别:二胡', 1430706591);
INSERT INTO `manage_log` VALUES (229, 'lywebsite', '/manage/product/category_mod.php?', '127.0.0.1', '更新产品类别:长笛', 1430706601);
INSERT INTO `manage_log` VALUES (230, 'lywebsite', '/manage/product/category_mod.php?', '127.0.0.1', '更新产品类别:短箫', 1430706607);
INSERT INTO `manage_log` VALUES (231, 'lywebsite', '/manage/product/category_mod.php?', '127.0.0.1', '更新产品类别:金属口弦', 1430706612);
INSERT INTO `manage_log` VALUES (232, 'lywebsite', '/manage/product/category_mod.php?', '127.0.0.1', '更新产品类别:电子琴', 1430706638);
INSERT INTO `manage_log` VALUES (233, 'lywebsite', '/manage/product/category_mod.php?', '127.0.0.1', '更新产品类别:手拉琴', 1430706649);
INSERT INTO `manage_log` VALUES (234, 'lywebsite', '/manage/product/category_mod.php?', '127.0.0.1', '更新产品类别:手提琴', 1430706663);
INSERT INTO `manage_log` VALUES (235, 'lywebsite', '/manage/product/category_mod.php?', '127.0.0.1', '更新产品类别:大提琴', 1430706674);
INSERT INTO `manage_log` VALUES (236, 'lywebsite', '/manage/product/category_mod.php?', '127.0.0.1', '更新产品类别:手拉琴', 1430706988);
INSERT INTO `manage_log` VALUES (237, 'lywebsite', '/manage/product/category_mod.php?', '127.0.0.1', '更新产品类别:手提琴', 1430706994);
INSERT INTO `manage_log` VALUES (238, 'lywebsite', '/manage/product/category_mod.php?', '127.0.0.1', '更新产品类别:大提琴', 1430707000);
INSERT INTO `manage_log` VALUES (239, 'lywebsite', '/manage/product/category_mod.php?', '127.0.0.1', '更新产品类别:二胡', 1430707034);
INSERT INTO `manage_log` VALUES (240, 'lywebsite', '/manage/product/category_mod.php?', '127.0.0.1', '更新产品类别:吉他', 1430707042);
INSERT INTO `manage_log` VALUES (241, 'lywebsite', '/manage/product/category_mod.php?', '127.0.0.1', '更新产品类别:二胡', 1430707050);
INSERT INTO `manage_log` VALUES (242, 'lywebsite', '/manage/product/category_mod.php?', '127.0.0.1', '更新产品类别:吉他', 1430707057);
INSERT INTO `manage_log` VALUES (243, 'lywebsite', '/manage/product/category_mod.php?', '127.0.0.1', '更新产品类别:吉他乐理', 1430707063);
INSERT INTO `manage_log` VALUES (244, 'lywebsite', '/manage/product/category_mod.php?', '127.0.0.1', '更新产品类别:吉他技巧', 1430707070);
INSERT INTO `manage_log` VALUES (245, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:周老师', 1430707224);
INSERT INTO `manage_log` VALUES (246, 'lywebsite', '/manage/article/add.php?', '127.0.0.1', '添加信息页：关于我们', 1430708949);
INSERT INTO `manage_log` VALUES (247, 'lywebsite', '/manage/article/mod.php?', '127.0.0.1', '编辑信息页：关于我们', 1430709139);
INSERT INTO `manage_log` VALUES (248, 'lywebsite', '/manage/article/mod.php?', '127.0.0.1', '编辑信息页：关于我们', 1430709177);
INSERT INTO `manage_log` VALUES (249, 'lywebsite', '/manage/article/mod.php?', '127.0.0.1', '编辑信息页：关于我们', 1430709191);
INSERT INTO `manage_log` VALUES (250, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:周老师', 1430709347);
INSERT INTO `manage_log` VALUES (251, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:周老师', 1430709395);
INSERT INTO `manage_log` VALUES (252, 'lywebsite', '/manage/product/add.php?', '127.0.0.1', '添加产品:靳怡然', 1430710934);
INSERT INTO `manage_log` VALUES (253, 'lywebsite', '/manage/product/add.php?', '127.0.0.1', '添加产品:黄老师', 1430710966);
INSERT INTO `manage_log` VALUES (254, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:靳怡然', 1430722248);
INSERT INTO `manage_log` VALUES (255, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:黄老师', 1430722259);
INSERT INTO `manage_log` VALUES (256, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:周老师', 1430722284);
INSERT INTO `manage_log` VALUES (257, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:周老师', 1430722321);
INSERT INTO `manage_log` VALUES (258, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:靳怡然', 1430722332);
INSERT INTO `manage_log` VALUES (259, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:黄老师', 1430722339);
INSERT INTO `manage_log` VALUES (260, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:黄老师', 1430722372);
INSERT INTO `manage_log` VALUES (261, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:黄老师', 1430722380);
INSERT INTO `manage_log` VALUES (262, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:靳怡然', 1430722391);
INSERT INTO `manage_log` VALUES (263, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:周老师', 1430722415);
INSERT INTO `manage_log` VALUES (264, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:黄老师', 1430723719);
INSERT INTO `manage_log` VALUES (265, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:靳怡然', 1430723730);
INSERT INTO `manage_log` VALUES (266, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:周老师', 1430723735);
INSERT INTO `manage_log` VALUES (267, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:黄老师', 1430724121);
INSERT INTO `manage_log` VALUES (268, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:黄老师', 1430724306);
INSERT INTO `manage_log` VALUES (269, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:靳怡然', 1430724317);
INSERT INTO `manage_log` VALUES (270, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:周老师', 1430724325);
INSERT INTO `manage_log` VALUES (271, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:黄老师', 1430724610);
INSERT INTO `manage_log` VALUES (272, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:黄老师', 1430724806);
INSERT INTO `manage_log` VALUES (273, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:靳怡然', 1430724819);
INSERT INTO `manage_log` VALUES (274, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:周老师', 1430724828);
INSERT INTO `manage_log` VALUES (275, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:黄老师', 1430725988);
INSERT INTO `manage_log` VALUES (276, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:黄老师', 1430725995);
INSERT INTO `manage_log` VALUES (277, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:黄老师', 1430726045);
INSERT INTO `manage_log` VALUES (278, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:黄老师', 1430726061);
INSERT INTO `manage_log` VALUES (279, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:黄老师', 1430726089);
INSERT INTO `manage_log` VALUES (280, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:黄老师', 1430726902);
INSERT INTO `manage_log` VALUES (281, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:靳怡然', 1430726924);
INSERT INTO `manage_log` VALUES (282, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:周老师', 1430726931);
INSERT INTO `manage_log` VALUES (283, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:黄老师', 1430729772);
INSERT INTO `manage_log` VALUES (284, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:黄老师', 1430729788);
INSERT INTO `manage_log` VALUES (285, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:靳怡然', 1430729795);
INSERT INTO `manage_log` VALUES (286, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:周老师', 1430729805);
INSERT INTO `manage_log` VALUES (287, 'lywebsite', '/manage/index.php?', '127.0.0.1', '成功登录后台', 1430879992);
INSERT INTO `manage_log` VALUES (288, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:靳怡然', 1430880013);
INSERT INTO `manage_log` VALUES (289, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:周老师', 1430880424);
INSERT INTO `manage_log` VALUES (290, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:黄老师', 1430880430);
INSERT INTO `manage_log` VALUES (291, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:靳怡然', 1430883184);
INSERT INTO `manage_log` VALUES (292, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:黄老师', 1430884315);
INSERT INTO `manage_log` VALUES (293, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:靳怡然', 1430884350);
INSERT INTO `manage_log` VALUES (294, 'lywebsite', '/manage/index.php?', '127.0.0.1', '成功登录后台', 1430898659);
INSERT INTO `manage_log` VALUES (295, 'lywebsite', '/manage/index.php?', '127.0.0.1', '成功登录后台', 1430898738);
INSERT INTO `manage_log` VALUES (296, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:黄老师', 1430899048);
INSERT INTO `manage_log` VALUES (297, 'lywebsite', '/manage/index.php?', '127.0.0.1', '成功登录后台', 1430899226);
INSERT INTO `manage_log` VALUES (298, 'lywebsite', '/manage/index.php?', '127.0.0.1', '成功登录后台', 1431003791);
INSERT INTO `manage_log` VALUES (299, 'lywebsite', '/manage/index.php?', '127.0.0.1', '成功登录后台', 1431003890);
INSERT INTO `manage_log` VALUES (300, 'lywebsite', '/manage/index.php?', '127.0.0.1', '成功登录后台', 1431004041);
INSERT INTO `manage_log` VALUES (301, 'lywebsite', '/manage/index.php?', '127.0.0.1', '成功登录后台', 1431004272);
INSERT INTO `manage_log` VALUES (302, 'lywebsite', '/manage/index.php?', '127.0.0.1', '成功登录后台', 1431064029);
INSERT INTO `manage_log` VALUES (303, 'lywebsite', '/manage/index.php?', '127.0.0.1', '成功登录后台', 1431072595);
INSERT INTO `manage_log` VALUES (304, 'lywebsite', '/manage/index.php?', '127.0.0.1', '成功登录后台', 1431073411);
INSERT INTO `manage_log` VALUES (305, 'lywebsite', '/manage/index.php?', '127.0.0.1', '成功登录后台', 1431342820);
INSERT INTO `manage_log` VALUES (306, 'lywebsite', '/manage/orders/view.php?OrderId=4&module=print', '127.0.0.1', '打印订单', 1431344947);
INSERT INTO `manage_log` VALUES (307, 'lywebsite', '/manage/orders/view.php?OrderId=4&module=print', '127.0.0.1', '打印订单', 1431345235);
INSERT INTO `manage_log` VALUES (308, 'lywebsite', '/manage/member/level_add.php?', '127.0.0.1', '添加会员级别:普通会员', 1431345270);
INSERT INTO `manage_log` VALUES (309, 'lywebsite', '/manage/index.php?', '127.0.0.1', '成功登录后台', 1431395136);
INSERT INTO `manage_log` VALUES (310, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:靳怡然', 1431395151);
INSERT INTO `manage_log` VALUES (311, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:周老师', 1431395160);
INSERT INTO `manage_log` VALUES (312, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:黄老师', 1431395175);
INSERT INTO `manage_log` VALUES (313, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:靳怡然', 1431395180);
INSERT INTO `manage_log` VALUES (314, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:周老师', 1431395184);
INSERT INTO `manage_log` VALUES (315, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:黄老师', 1431396728);
INSERT INTO `manage_log` VALUES (316, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:靳怡然', 1431396739);
INSERT INTO `manage_log` VALUES (317, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:周老师', 1431396752);
INSERT INTO `manage_log` VALUES (318, 'lywebsite', '/manage/member/level_mod.php?', '127.0.0.1', '编辑会员级别:普通会员', 1431398707);
INSERT INTO `manage_log` VALUES (319, 'lywebsite', '/manage/set/global.php?', '127.0.0.1', '系统全局设置', 1431398819);
INSERT INTO `manage_log` VALUES (320, 'lywebsite', '/manage/member/level_add.php?', '127.0.0.1', '添加会员级别:教师会员', 1431398836);
INSERT INTO `manage_log` VALUES (321, 'lywebsite', '/manage/set/global.php?', '127.0.0.1', '系统全局设置', 1431398844);
INSERT INTO `manage_log` VALUES (322, 'lywebsite', '/manage/set/global.php?', '127.0.0.1', '系统全局设置', 1431398848);
INSERT INTO `manage_log` VALUES (323, 'lywebsite', '/manage/member/index.php?', '127.0.0.1', '批量删除会员', 1431398872);
INSERT INTO `manage_log` VALUES (324, 'lywebsite', '/manage/article/add.php?', '127.0.0.1', '添加信息页：教师申请页面', 1431420706);
INSERT INTO `manage_log` VALUES (325, 'lywebsite', '/manage/article/mod.php?', '127.0.0.1', '编辑信息页：教师申请页面', 1431421874);
INSERT INTO `manage_log` VALUES (326, 'lywebsite', '/manage/article/mod.php?', '127.0.0.1', '编辑信息页：教师申请页面', 1431422181);
INSERT INTO `manage_log` VALUES (327, 'lywebsite', '/manage/article/mod.php?', '127.0.0.1', '编辑信息页：教师申请页面', 1431422514);
INSERT INTO `manage_log` VALUES (328, 'lywebsite', '/manage/index.php?', '127.0.0.1', '成功登录后台', 1431429963);
INSERT INTO `manage_log` VALUES (329, 'lywebsite', '/manage/article/mod.php?', '127.0.0.1', '编辑信息页：教师申请页面', 1431434141);
INSERT INTO `manage_log` VALUES (330, 'lywebsite', '/manage/article/mod.php?', '127.0.0.1', '编辑信息页：教师申请页面', 1431434356);
INSERT INTO `manage_log` VALUES (331, 'lywebsite', '/manage/index.php?', '127.0.0.1', '成功登录后台', 1431486721);
INSERT INTO `manage_log` VALUES (332, 'lywebsite', '/manage/index.php?', '127.0.0.1', '成功登录后台', 1431911649);
INSERT INTO `manage_log` VALUES (333, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:黄老师', 1431940872);
INSERT INTO `manage_log` VALUES (334, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:黄老师', 1431941028);
INSERT INTO `manage_log` VALUES (335, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:黄老师', 1431941037);
INSERT INTO `manage_log` VALUES (336, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:黄老师', 1431941074);
INSERT INTO `manage_log` VALUES (337, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:黄老师', 1431941455);
INSERT INTO `manage_log` VALUES (338, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:黄老师', 1431941542);
INSERT INTO `manage_log` VALUES (339, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:黄老师', 1431941556);
INSERT INTO `manage_log` VALUES (340, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:黄老师', 1431941901);
INSERT INTO `manage_log` VALUES (341, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:靳怡然', 1431947063);
INSERT INTO `manage_log` VALUES (342, 'lywebsite', '/manage/member_two/view.php?', '127.0.0.1', '审核教师申请', 1431947955);
INSERT INTO `manage_log` VALUES (343, 'lywebsite', '/manage/index.php?', '127.0.0.1', '成功登录后台', 1432000167);
INSERT INTO `manage_log` VALUES (344, 'lywebsite', '/manage/set/global.php?', '127.0.0.1', '系统全局设置', 1432004172);
INSERT INTO `manage_log` VALUES (345, 'lywebsite', '/manage/member_two/view.php?', '127.0.0.1', '审核教师申请', 1432004750);
INSERT INTO `manage_log` VALUES (346, 'lywebsite', '/manage/member_two/view.php?', '127.0.0.1', '审核教师申请', 1432004772);
INSERT INTO `manage_log` VALUES (347, 'lywebsite', '/manage/member_two/view.php?', '127.0.0.1', '审核教师申请', 1432004797);
INSERT INTO `manage_log` VALUES (348, 'lywebsite', '/manage/member_two/view.php?', '127.0.0.1', '审核教师申请', 1432004817);
INSERT INTO `manage_log` VALUES (349, 'lywebsite', '/manage/member_two/view.php?', '127.0.0.1', '审核教师申请', 1432004818);
INSERT INTO `manage_log` VALUES (350, 'lywebsite', '/manage/member_two/view.php?', '127.0.0.1', '审核教师申请', 1432004948);
INSERT INTO `manage_log` VALUES (351, 'lywebsite', '/manage/member_two/view.php?', '127.0.0.1', '审核教师申请', 1432005081);
INSERT INTO `manage_log` VALUES (352, 'lywebsite', '/manage/member_two/view.php?', '127.0.0.1', '审核教师申请', 1432005105);
INSERT INTO `manage_log` VALUES (353, 'lywebsite', '/manage/member_two/view.php?', '127.0.0.1', '审核教师申请', 1432005250);
INSERT INTO `manage_log` VALUES (354, 'lywebsite', '/manage/index.php?', '127.0.0.1', '成功登录后台', 1432021708);
INSERT INTO `manage_log` VALUES (355, 'lywebsite', '/manage/product/index.php?', '127.0.0.1', '批量删除产品', 1432025773);
INSERT INTO `manage_log` VALUES (356, 'lywebsite', '/manage/product/index.php?', '127.0.0.1', '批量删除产品', 1432025815);
INSERT INTO `manage_log` VALUES (357, 'lywebsite', '/manage/product/index.php?', '127.0.0.1', '批量删除产品', 1432026063);
INSERT INTO `manage_log` VALUES (358, 'lywebsite', '/manage/product/index.php?', '127.0.0.1', '批量删除产品', 1432026253);
INSERT INTO `manage_log` VALUES (359, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:同学', 1432026907);
INSERT INTO `manage_log` VALUES (360, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:黄老师', 1432026915);
INSERT INTO `manage_log` VALUES (361, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:黄老师', 1432026921);
INSERT INTO `manage_log` VALUES (362, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:靳怡然', 1432026982);
INSERT INTO `manage_log` VALUES (363, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:靳怡然', 1432027004);
INSERT INTO `manage_log` VALUES (364, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:靳怡然', 1432027032);
INSERT INTO `manage_log` VALUES (365, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:靳怡然', 1432027044);
INSERT INTO `manage_log` VALUES (366, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:同学', 1432027049);
INSERT INTO `manage_log` VALUES (367, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:黄老师', 1432027061);
INSERT INTO `manage_log` VALUES (368, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:靳怡然', 1432027066);
INSERT INTO `manage_log` VALUES (369, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:周老师', 1432027072);
INSERT INTO `manage_log` VALUES (370, 'lywebsite', '/manage/product/mod.php?', '127.0.0.1', '编辑产品:同学', 1432028740);
INSERT INTO `manage_log` VALUES (371, 'lywebsite', '/manage/product/index.php?', '127.0.0.1', '批量删除产品', 1432028745);
INSERT INTO `manage_log` VALUES (372, 'lywebsite', '/manage/product/index.php?', '127.0.0.1', '批量删除产品', 1432029077);
INSERT INTO `manage_log` VALUES (373, 'lywebsite', '/manage/index.php?', '58.62.106.122', '成功登录后台', 1432085690);
INSERT INTO `manage_log` VALUES (374, 'lywebsite', '/manage/set/global.php?', '58.62.106.122', '系统全局设置', 1432085699);
INSERT INTO `manage_log` VALUES (375, 'lywebsite', '/manage/set/global.php?', '58.62.106.122', '系统全局设置', 1432085750);
INSERT INTO `manage_log` VALUES (376, 'lywebsite', '/manage/set/global.php?', '58.62.106.122', '系统全局设置', 1432085757);
INSERT INTO `manage_log` VALUES (377, 'lywebsite', '/manage/set/global.php?', '58.62.106.122', '系统全局设置', 1432085766);
INSERT INTO `manage_log` VALUES (378, 'lywebsite', '/manage/set/global.php?', '58.62.106.122', '系统全局设置', 1432085790);
INSERT INTO `manage_log` VALUES (379, 'lywebsite', '/manage/set/global.php?', '58.62.106.122', '系统全局设置', 1432085801);
INSERT INTO `manage_log` VALUES (380, 'lywebsite', '/manage/set/global.php?', '58.62.106.122', '系统全局设置', 1432085816);
INSERT INTO `manage_log` VALUES (381, 'lywebsite', '/manage/set/global.php?', '58.62.106.122', '系统全局设置', 1432085820);
INSERT INTO `manage_log` VALUES (382, 'lywebsite', '/manage/set/global.php?', '58.62.106.122', '系统全局设置', 1432085833);
INSERT INTO `manage_log` VALUES (383, 'lywebsite', '/manage/set/global.php?', '58.62.106.122', '系统全局设置', 1432085917);
INSERT INTO `manage_log` VALUES (384, 'lywebsite', '/manage/set/global.php?', '58.62.106.122', '系统全局设置', 1432085930);
INSERT INTO `manage_log` VALUES (385, 'lywebsite', '/manage/set/global.php?', '58.62.106.122', '系统全局设置', 1432085973);
INSERT INTO `manage_log` VALUES (386, 'lywebsite', '/manage/article/mod.php?', '58.62.106.122', '编辑信息页：益海简介', 1432086124);
INSERT INTO `manage_log` VALUES (387, 'lywebsite', '/manage/article/add.php?', '58.62.106.122', '添加信息页：免责声明', 1432086137);
INSERT INTO `manage_log` VALUES (388, 'lywebsite', '/manage/article/add.php?', '58.62.106.122', '添加信息页：联系方式', 1432086146);
INSERT INTO `manage_log` VALUES (389, 'lywebsite', '/manage/article/add.php?', '58.62.106.122', '添加信息页：推广联盟', 1432086154);
INSERT INTO `manage_log` VALUES (390, 'lywebsite', '/manage/article/add.php?', '58.62.106.122', '添加信息页：咨询服务', 1432086341);
INSERT INTO `manage_log` VALUES (391, 'lywebsite', '/manage/article/add.php?', '58.62.106.122', '添加信息页：实施服务', 1432086350);
INSERT INTO `manage_log` VALUES (392, 'lywebsite', '/manage/article/add.php?', '58.62.106.122', '添加信息页：售后服务', 1432086358);
INSERT INTO `manage_log` VALUES (393, 'lywebsite', '/manage/article/add.php?', '58.62.106.122', '添加信息页：个性化开发服务', 1432086367);
INSERT INTO `manage_log` VALUES (394, 'lywebsite', '/manage/article/add.php?', '58.62.106.122', '添加信息页：服务团队', 1432086377);
INSERT INTO `manage_log` VALUES (395, 'lywebsite', '/manage/product/mod.php?', '58.62.106.122', '编辑产品:靳怡然', 1432087080);
INSERT INTO `manage_log` VALUES (396, 'lywebsite', '/manage/product/index.php?', '58.62.106.122', '批量删除产品', 1432087088);
INSERT INTO `manage_log` VALUES (397, 'lywebsite', '/manage/product/mod.php?', '58.62.106.122', '编辑产品:同学', 1432088077);
INSERT INTO `manage_log` VALUES (398, 'lywebsite', '/manage/product/mod.php?', '58.62.106.122', '编辑产品:同学', 1432088085);
INSERT INTO `manage_log` VALUES (399, 'lywebsite', '/manage/product/mod.php?', '58.62.106.122', '编辑产品:同学', 1432094163);
INSERT INTO `manage_log` VALUES (400, 'lywebsite', '/manage/product/mod.php?', '58.62.106.122', '编辑产品:同学', 1432094187);
INSERT INTO `manage_log` VALUES (401, 'lywebsite', '/manage/member/view.php?', '58.62.106.122', '修改注册用户密码', 1432094338);
INSERT INTO `manage_log` VALUES (402, 'lywebsite', '/manage/member_two/view.php?', '58.62.106.122', '审核教师申请', 1432094940);
INSERT INTO `manage_log` VALUES (403, 'lywebsite', '/manage/product/index.php?', '58.62.106.122', '批量删除产品', 1432096004);
INSERT INTO `manage_log` VALUES (404, 'lywebsite', '/manage/product/mod.php?', '58.62.106.122', '编辑产品:1233', 1432096053);
INSERT INTO `manage_log` VALUES (405, 'lywebsite', '/manage/index.php?', '59.42.114.65', '成功登录后台', 1432258361);
INSERT INTO `manage_log` VALUES (406, 'lywebsite', '/manage//index.php?', '113.119.25.167', '成功登录后台', 1433224676);
INSERT INTO `manage_log` VALUES (407, 'lywebsite', '/manage/article/mod.php?', '113.119.25.167', '编辑信息页：啾啾文化', 1433225042);
INSERT INTO `manage_log` VALUES (408, 'lywebsite', '/manage/article/mod.php?', '113.119.25.167', '编辑信息页：事业价值', 1433225058);
INSERT INTO `manage_log` VALUES (409, 'lywebsite', '/manage/article/mod.php?', '113.119.25.167', '编辑信息页：啾啾优势', 1433225071);
INSERT INTO `manage_log` VALUES (410, 'lywebsite', '/manage/product/mod.php?', '113.119.25.167', '编辑产品:1233', 1433228050);
INSERT INTO `manage_log` VALUES (411, 'lywebsite', '/manage/index.php?', '219.136.215.17', '成功登录后台', 1434593036);
INSERT INTO `manage_log` VALUES (412, 'lywebsite', '/manage/member_two/view.php?', '219.136.215.17', '审核教师申请', 1434598389);
INSERT INTO `manage_log` VALUES (413, 'lywebsite', '/manage/index.php?', '219.136.215.17', '成功登录后台', 1434610961);
INSERT INTO `manage_log` VALUES (414, 'lywebsite', '/manage/product/mod.php?', '219.136.215.17', '编辑产品:同学', 1434611801);
INSERT INTO `manage_log` VALUES (415, 'lywebsite', '/manage/product/mod.php?', '219.136.215.17', '编辑产品:同学', 1434611809);
INSERT INTO `manage_log` VALUES (416, 'lywebsite', '/manage/product/index.php?', '219.136.215.17', '批量删除产品', 1434611815);
INSERT INTO `manage_log` VALUES (417, 'lywebsite', '/manage/index.php?', '61.144.105.193', '成功登录后台', 1435053529);
INSERT INTO `manage_log` VALUES (418, 'lywebsite', '/manage/product/mod.php?', '61.144.105.193', '编辑产品:同学', 1435056521);
INSERT INTO `manage_log` VALUES (419, 'lywebsite', '/manage/set/exchange_rate.php?', '61.144.105.193', '汇率设置', 1435061079);
INSERT INTO `manage_log` VALUES (420, 'lywebsite', '/manage/set/exchange_rate.php?', '61.144.105.193', '汇率设置', 1435061086);
INSERT INTO `manage_log` VALUES (421, 'lywebsite', '/manage/set/exchange_rate.php?', '61.144.105.193', '汇率设置', 1435061117);
INSERT INTO `manage_log` VALUES (422, 'lywebsite', '/manage/set/exchange_rate.php?', '61.144.105.193', '汇率设置', 1435061129);
INSERT INTO `manage_log` VALUES (423, 'lywebsite', '/manage/index.php?', '112.90.231.43', '成功登录后台', 1435099884);
INSERT INTO `manage_log` VALUES (424, 'lywebsite', '/manage/orders/index.php?', '112.90.231.43', '批量删除订单', 1435099910);
INSERT INTO `manage_log` VALUES (425, 'lywebsite', '/manage/orders/index.php?', '112.90.231.43', '批量删除订单', 1435100195);
INSERT INTO `manage_log` VALUES (426, 'lywebsite', '/manage/orders/index.php?', '112.90.231.43', '批量删除订单', 1435100801);
INSERT INTO `manage_log` VALUES (427, 'lywebsite', '/manage/index.php?', '61.144.105.193', '成功登录后台', 1435107934);
INSERT INTO `manage_log` VALUES (428, 'lywebsite', '/manage/orders/index.php?', '61.144.105.193', '批量删除订单', 1435108766);
INSERT INTO `manage_log` VALUES (429, 'lywebsite', '/manage/product/mod.php?', '61.144.105.193', '编辑产品:同学', 1435110539);
INSERT INTO `manage_log` VALUES (430, 'lywebsite', '/manage/product/mod.php?', '61.144.105.193', '编辑产品:同学', 1435110585);
INSERT INTO `manage_log` VALUES (431, 'lywebsite', '/manage/member/view.php?', '61.144.105.193', '修改注册用户信息', 1435113855);
INSERT INTO `manage_log` VALUES (432, 'lywebsite', '/manage/orders/index.php?', '61.144.105.193', '批量删除订单', 1435114363);
INSERT INTO `manage_log` VALUES (433, 'lywebsite', '/manage/member/index.php?', '61.144.105.193', '批量删除会员', 1435128023);
INSERT INTO `manage_log` VALUES (434, 'lywebsite', '/manage/member/index.php?', '61.144.105.193', '批量删除会员', 1435128652);
INSERT INTO `manage_log` VALUES (435, 'lywebsite', '/manage/member_two/index.php?', '61.144.105.193', '批量删除会员', 1435129155);
INSERT INTO `manage_log` VALUES (436, 'lywebsite', '/manage/member_two/index.php?', '61.144.105.193', '批量删除会员', 1435129159);
INSERT INTO `manage_log` VALUES (437, 'lywebsite', '/manage/member_two/index.php?', '61.144.105.193', '批量删除会员', 1435129263);
INSERT INTO `manage_log` VALUES (438, 'lywebsite', '/manage/member_two/view.php?', '61.144.105.193', '审核教师申请', 1435129279);
INSERT INTO `manage_log` VALUES (439, 'lywebsite', '/manage/member_two/view.php?', '61.144.105.193', '审核教师申请', 1435129283);
INSERT INTO `manage_log` VALUES (440, 'lywebsite', '/manage/member/view.php?', '61.144.105.193', '修改注册用户信息', 1435134211);
INSERT INTO `manage_log` VALUES (441, 'lywebsite', '/manage/orders/view.php?', '61.144.105.193', '修改订单状态', 1435136180);
INSERT INTO `manage_log` VALUES (442, 'lywebsite', '/manage/orders/view.php?', '61.144.105.193', '修改订单状态', 1435136188);
INSERT INTO `manage_log` VALUES (443, 'lywebsite', '/manage/index.php?', '61.144.105.193', '成功登录后台', 1435137375);
INSERT INTO `manage_log` VALUES (444, 'lywebsite', '/manage/index.php?', '59.41.113.170', '成功登录后台', 1435201910);
INSERT INTO `manage_log` VALUES (445, 'lywebsite', '/manage/index.php?', '59.41.113.170', '成功登录后台', 1435282304);
INSERT INTO `manage_log` VALUES (446, 'lywebsite', '/manage/orders/index.php?', '59.41.113.170', '批量删除订单', 1435284650);
INSERT INTO `manage_log` VALUES (447, 'lywebsite', '/manage/orders/index.php?', '59.41.113.170', '批量删除订单', 1435285502);
INSERT INTO `manage_log` VALUES (448, 'lywebsite', '/manage/orders/view.php?', '59.41.113.170', '修改订单基本信息', 1435285914);
INSERT INTO `manage_log` VALUES (449, 'lywebsite', '/manage/orders/view.php?', '59.41.113.170', '修改订单基本信息', 1435285917);
INSERT INTO `manage_log` VALUES (450, 'lywebsite', '/manage/orders/index.php?', '59.41.113.170', '批量删除订单', 1435287971);
INSERT INTO `manage_log` VALUES (451, 'lywebsite', '/manage/ad/add.php?', '59.41.113.170', '添加广告图片', 1435288139);
INSERT INTO `manage_log` VALUES (452, 'lywebsite', '/manage/ad/mod.php?', '59.41.113.170', '更新广告图片', 1435288573);
INSERT INTO `manage_log` VALUES (453, 'lywebsite', '/manage/ad/mod.php?', '59.41.113.170', '更新广告图片', 1435289068);
INSERT INTO `manage_log` VALUES (454, 'lywebsite', '/manage/index.php?', '59.42.114.146', '成功登录后台', 1435367331);
INSERT INTO `manage_log` VALUES (455, 'lywebsite', '/manage/product/mod.php?', '59.42.114.146', '编辑产品:同学', 1435367356);
INSERT INTO `manage_log` VALUES (456, 'lywebsite', '/manage/product/mod.php?', '59.42.114.146', '编辑产品:同学', 1435367365);
INSERT INTO `manage_log` VALUES (457, 'lywebsite', '/manage/index.php?', '59.42.114.146', '成功登录后台', 1435370829);
INSERT INTO `manage_log` VALUES (458, 'lywebsite', '/manage/ad/add.php?', '59.42.114.146', '添加广告图片', 1435370865);
INSERT INTO `manage_log` VALUES (459, 'lywebsite', '/manage/ad/mod.php?', '59.42.114.146', '更新广告图片', 1435370875);
INSERT INTO `manage_log` VALUES (460, 'lywebsite', '/manage/article/index.php?', '59.42.114.146', '批量删除信息页', 1435374167);
INSERT INTO `manage_log` VALUES (461, 'lywebsite', '/manage/member/index.php?', '59.42.114.146', '批量删除会员', 1435375666);
INSERT INTO `manage_log` VALUES (462, 'lywebsite', '/manage/member/index.php?', '59.42.114.146', '批量删除会员', 1435377242);
INSERT INTO `manage_log` VALUES (463, 'lywebsite', '/manage/member/index.php?', '59.42.114.146', '批量删除会员', 1435377318);
INSERT INTO `manage_log` VALUES (464, 'lywebsite', '/manage/member/index.php?', '59.42.114.146', '批量删除会员', 1435383581);
INSERT INTO `manage_log` VALUES (465, 'lywebsite', '/manage/member/index.php?', '59.42.114.146', '批量删除会员', 1435384260);
INSERT INTO `manage_log` VALUES (466, 'lywebsite', '/manage/member/index.php?', '59.42.114.146', '批量删除会员', 1435385884);
INSERT INTO `manage_log` VALUES (467, 'lywebsite', '/manage/member_two/index.php?', '59.42.114.146', '批量删除会员', 1435386637);
INSERT INTO `manage_log` VALUES (468, 'lywebsite', '/manage/member_two/view.php?', '59.42.114.146', '审核教师申请', 1435387097);
INSERT INTO `manage_log` VALUES (469, 'lywebsite', '/manage/product/index.php?', '59.42.114.146', '批量删除产品', 1435389284);
INSERT INTO `manage_log` VALUES (470, 'lywebsite', '/manage/product/color_mod.php?', '59.42.114.146', '更新产品颜色:广州市', 1435391032);
INSERT INTO `manage_log` VALUES (471, 'lywebsite', '/manage/product/color_mod.php?', '59.42.114.146', '更新产品颜色:深圳市', 1435391051);
INSERT INTO `manage_log` VALUES (472, 'lywebsite', '/manage/product/color_mod.php?', '59.42.114.146', '更新产品颜色:珠海市', 1435391064);
INSERT INTO `manage_log` VALUES (473, 'lywebsite', '/manage/product/color_mod.php?', '59.42.114.146', '更新产品颜色:汕头市', 1435391073);
INSERT INTO `manage_log` VALUES (474, 'lywebsite', '/manage/product/color_mod.php?', '59.42.114.146', '更新产品颜色:韶关市', 1435391083);
INSERT INTO `manage_log` VALUES (475, 'lywebsite', '/manage/product/color_mod.php?', '59.42.114.146', '更新产品颜色:河源市', 1435391091);
INSERT INTO `manage_log` VALUES (476, 'lywebsite', '/manage/product/color_mod.php?', '59.42.114.146', '更新产品颜色:惠州市', 1435391099);
INSERT INTO `manage_log` VALUES (477, 'lywebsite', '/manage/product/color_mod.php?', '59.42.114.146', '更新产品颜色:东莞市', 1435391108);
INSERT INTO `manage_log` VALUES (478, 'lywebsite', '/manage/product/color_mod.php?', '59.42.114.146', '更新产品颜色:中山市', 1435391119);
INSERT INTO `manage_log` VALUES (479, 'lywebsite', '/manage/product/color_mod.php?', '59.42.114.146', '更新产品颜色:江门市', 1435391156);
INSERT INTO `manage_log` VALUES (480, 'lywebsite', '/manage/product/color_add.php?', '59.42.114.146', '添加产品颜色:阳江市', 1435391166);
INSERT INTO `manage_log` VALUES (481, 'lywebsite', '/manage/product/color_add.php?', '59.42.114.146', '添加产品颜色:湛江市', 1435391176);
INSERT INTO `manage_log` VALUES (482, 'lywebsite', '/manage/product/color_add.php?', '59.42.114.146', '添加产品颜色:茂名市', 1435391185);
INSERT INTO `manage_log` VALUES (483, 'lywebsite', '/manage/product/color_add.php?', '59.42.114.146', '添加产品颜色:肇庆市', 1435391203);
INSERT INTO `manage_log` VALUES (484, 'lywebsite', '/manage/product/color_mod.php?', '59.42.114.146', '更新产品颜色:肇庆市', 1435391208);
INSERT INTO `manage_log` VALUES (485, 'lywebsite', '/manage/product/color_add.php?', '59.42.114.146', '添加产品颜色:清远市', 1435391217);
INSERT INTO `manage_log` VALUES (486, 'lywebsite', '/manage/article/add.php?', '59.42.114.146', '添加信息页：约课流程', 1435391310);
INSERT INTO `manage_log` VALUES (487, 'lywebsite', '/manage/article/mod.php?', '59.42.114.146', '编辑信息页：约课流程', 1435391342);
INSERT INTO `manage_log` VALUES (488, 'lywebsite', '/manage/article/mod.php?', '59.42.114.146', '编辑信息页：约课流程', 1435391384);
INSERT INTO `manage_log` VALUES (489, 'lywebsite', '/manage/article/mod.php?', '59.42.114.146', '编辑信息页：约课流程', 1435391398);
INSERT INTO `manage_log` VALUES (490, 'lywebsite', '/manage/article/add.php?', '59.42.114.146', '添加信息页：我们的优势', 1435391481);
INSERT INTO `manage_log` VALUES (491, 'lywebsite', '/manage/article/mod.php?', '59.42.114.146', '编辑信息页：约课流程', 1435391558);
INSERT INTO `manage_log` VALUES (492, 'lywebsite', '/manage/article/mod.php?', '59.42.114.146', '编辑信息页：约课流程', 1435391583);
INSERT INTO `manage_log` VALUES (493, 'lywebsite', '/manage/article/mod.php?', '59.42.114.146', '编辑信息页：约课流程', 1435391643);
INSERT INTO `manage_log` VALUES (494, 'lywebsite', '/manage/article/mod.php?', '59.42.114.146', '编辑信息页：约课流程', 1435391666);
INSERT INTO `manage_log` VALUES (495, 'lywebsite', '/manage/article/mod.php?', '59.42.114.146', '编辑信息页：约课流程', 1435391691);
INSERT INTO `manage_log` VALUES (496, 'lywebsite', '/manage/article/mod.php?', '59.42.114.146', '编辑信息页：约课流程', 1435391751);
INSERT INTO `manage_log` VALUES (497, 'lywebsite', '/manage/product/mod.php?', '59.42.114.146', '编辑产品:黄老师', 1435393973);
INSERT INTO `manage_log` VALUES (498, 'lywebsite', '/manage/index.php?', '58.62.104.87', '成功登录后台', 1435540906);
INSERT INTO `manage_log` VALUES (499, 'lywebsite', '/manage/product/index.php?', '58.62.104.87', '批量删除产品', 1435541687);
INSERT INTO `manage_log` VALUES (500, 'lywebsite', '/manage/product/mod.php?', '58.62.104.87', '编辑产品:黄老师', 1435541695);
INSERT INTO `manage_log` VALUES (501, 'lywebsite', '/manage/orders/view.php?', '58.62.104.87', '修改订单状态', 1435547824);
INSERT INTO `manage_log` VALUES (502, 'lywebsite', '/manage/orders/view.php?', '58.62.104.87', '修改订单状态', 1435547828);
INSERT INTO `manage_log` VALUES (503, 'lywebsite', '/manage/orders/view.php?', '58.62.104.87', '修改订单状态', 1435547885);
INSERT INTO `manage_log` VALUES (504, 'lywebsite', '/manage/orders/view.php?', '58.62.104.87', '修改订单状态', 1435547900);
INSERT INTO `manage_log` VALUES (505, 'lywebsite', '/manage/orders/view.php?', '58.62.104.87', '修改订单状态', 1435548420);
INSERT INTO `manage_log` VALUES (506, 'lywebsite', '/manage/orders/index.php?', '58.62.104.87', '批量删除订单', 1435548910);
INSERT INTO `manage_log` VALUES (507, 'lywebsite', '/manage/article/add.php?', '58.62.104.87', '添加信息页：意见反馈', 1435550416);
INSERT INTO `manage_log` VALUES (508, 'lywebsite', '/manage/orders/index.php?', '58.62.104.87', '批量删除订单', 1435557547);
INSERT INTO `manage_log` VALUES (509, 'lywebsite', '/manage/orders/view.php?', '58.62.104.87', '修改订单状态', 1435558528);
INSERT INTO `manage_log` VALUES (510, 'lywebsite', '/manage/orders/view.php?', '58.62.104.87', '修改订单状态', 1435559905);
INSERT INTO `manage_log` VALUES (511, 'lywebsite', '/manage/order_twos/view.php?', '58.62.104.87', '修改订单状态', 1435564319);
INSERT INTO `manage_log` VALUES (512, 'lywebsite', '/manage/orders/view.php?', '58.62.104.87', '修改订单状态', 1435564862);
INSERT INTO `manage_log` VALUES (513, 'lywebsite', '/manage/index.php?', '58.62.104.87', '成功登录后台', 1435626656);
INSERT INTO `manage_log` VALUES (514, 'lywebsite', '/manage/product_review/index.php?', '58.62.104.87', '批量删除产品评论', 1435630889);
INSERT INTO `manage_log` VALUES (515, 'lywebsite', '/manage/product_review/index.php?', '58.62.104.87', '批量删除产品评论', 1435630893);
INSERT INTO `manage_log` VALUES (516, '', '/manage/index.php?', '58.62.104.87', '<font class=''fc_red''>lywebsite</font>尝试登录后台，返回状态:错误的验证码，请重新登录！', 1435724878);
INSERT INTO `manage_log` VALUES (517, 'lywebsite', '/manage/index.php?', '58.62.104.87', '成功登录后台', 1435724883);
INSERT INTO `manage_log` VALUES (518, 'lywebsite', '/manage/member_two/view.php?', '58.62.104.87', '审核教师申请', 1435725151);
INSERT INTO `manage_log` VALUES (519, 'lywebsite', '/manage/product/mod.php?', '58.62.104.87', '编辑产品:宋老师', 1435725401);
INSERT INTO `manage_log` VALUES (520, 'lywebsite', '/manage/product/mod.php?', '58.62.104.87', '编辑产品:宋老师', 1435725530);
INSERT INTO `manage_log` VALUES (521, 'lywebsite', '/manage/product/mod.php?', '58.62.104.87', '编辑产品:宋老师', 1435725758);
INSERT INTO `manage_log` VALUES (522, 'lywebsite', '/manage/member_two/view.php?', '58.62.104.87', '审核教师申请', 1435725820);
INSERT INTO `manage_log` VALUES (523, 'lywebsite', '/manage/member_two/view.php?', '58.62.104.87', '审核教师申请', 1435726244);
INSERT INTO `manage_log` VALUES (524, 'lywebsite', '/manage/member_two/view.php?', '58.62.104.87', '审核教师申请', 1435726863);
INSERT INTO `manage_log` VALUES (525, 'lywebsite', '/manage/product/mod.php?', '58.62.104.87', '编辑产品:willer123', 1435729344);
INSERT INTO `manage_log` VALUES (526, 'lywebsite', '/manage/product/mod.php?', '58.62.104.87', '编辑产品:天天', 1435729359);
INSERT INTO `manage_log` VALUES (527, 'lywebsite', '/manage/product/mod.php?', '58.62.104.87', '编辑产品:宋老师', 1435729756);
INSERT INTO `manage_log` VALUES (528, 'lywebsite', '/manage/member/index.php?', '58.62.104.87', '批量删除会员', 1435733668);
INSERT INTO `manage_log` VALUES (529, 'lywebsite', '/manage/member/index.php?', '58.62.104.87', '批量删除会员', 1435733676);
INSERT INTO `manage_log` VALUES (530, 'lywebsite', '/manage/orders/index.php?', '58.62.104.87', '批量删除订单', 1435733993);
INSERT INTO `manage_log` VALUES (531, 'lywebsite', '/manage/orders/view.php?', '58.62.104.87', '修改订单状态', 1435734072);
INSERT INTO `manage_log` VALUES (532, 'lywebsite', '/manage/product/mod.php?', '58.62.104.87', '编辑产品:willer123', 1435735737);
INSERT INTO `manage_log` VALUES (533, 'lywebsite', '/manage/product/mod.php?', '58.62.104.87', '编辑产品:willer123', 1435735743);
INSERT INTO `manage_log` VALUES (534, 'lywebsite', '/manage/product/mod.php?', '58.62.104.87', '编辑产品:willer123', 1435736719);
INSERT INTO `manage_log` VALUES (535, 'lywebsite', '/manage/product/mod.php?', '58.62.104.87', '编辑产品:天天', 1435736736);
INSERT INTO `manage_log` VALUES (536, 'lywebsite', '/manage/product/mod.php?', '58.62.104.87', '编辑产品:willer123', 1435736791);
INSERT INTO `manage_log` VALUES (537, 'lywebsite', '/manage/product/mod.php?', '58.62.104.87', '编辑产品:天天', 1435736801);
INSERT INTO `manage_log` VALUES (538, 'lywebsite', '/manage/orders/view.php?', '58.62.104.87', '修改订单状态', 1435740580);
INSERT INTO `manage_log` VALUES (539, 'lywebsite', '/manage/index.php?', '58.62.104.87', '成功登录后台', 1435742328);
INSERT INTO `manage_log` VALUES (540, 'lywebsite', '/manage/member_two/view.php?', '58.62.104.87', '审核教师申请', 1435742493);
INSERT INTO `manage_log` VALUES (541, 'lywebsite', '/manage/product/mod.php?', '58.62.104.87', '编辑产品:黄老师', 1435743103);
INSERT INTO `manage_log` VALUES (542, 'lywebsite', '/manage/orders/view.php?', '58.62.104.87', '修改订单状态', 1435743603);
INSERT INTO `manage_log` VALUES (543, 'lywebsite', '/manage/order_twos/view.php?OrderId=72&module=print', '58.62.104.87', '打印订单', 1435744320);
INSERT INTO `manage_log` VALUES (544, 'lywebsite', '/manage/order_twos/view.php?', '58.62.104.87', '修改订单状态', 1435744327);
INSERT INTO `manage_log` VALUES (545, '', '/manage/index.php?', '58.62.104.87', '<font class=''fc_red''>lywebsite</font>尝试登录后台，返回状态:错误的验证码，请重新登录！', 1435801632);
INSERT INTO `manage_log` VALUES (546, 'lywebsite', '/manage/index.php?', '58.62.104.87', '成功登录后台', 1435801636);
INSERT INTO `manage_log` VALUES (547, 'lywebsite', '/manage/index.php?', '58.62.104.87', '成功登录后台', 1435820732);
INSERT INTO `manage_log` VALUES (548, 'lywebsite', '/manage/index.php?', '58.62.104.87', '成功登录后台', 1435840293);
INSERT INTO `manage_log` VALUES (549, 'lywebsite', '/manage/index.php?', '58.62.104.87', '成功登录后台', 1435887454);
INSERT INTO `manage_log` VALUES (550, 'lywebsite', '/manage/order_twos/index.php?', '58.62.104.87', '批量删除订单', 1435893720);
INSERT INTO `manage_log` VALUES (551, 'lywebsite', '/manage/order_twos/view.php?', '58.62.104.87', '修改订单状态', 1435894329);
INSERT INTO `manage_log` VALUES (552, 'lywebsite', '/manage/order_twos/index.php?', '58.62.104.87', '批量删除订单', 1435898074);
INSERT INTO `manage_log` VALUES (553, 'lywebsite', '/manage/order_twos/view.php?', '58.62.104.87', '修改订单状态', 1435898228);
INSERT INTO `manage_log` VALUES (554, 'lywebsite', '/manage/order_twos/index.php?', '58.62.104.87', '批量删除订单', 1435898962);
INSERT INTO `manage_log` VALUES (555, 'lywebsite', '/manage/order_twos/view.php?', '58.62.104.87', '修改订单状态', 1435899047);
INSERT INTO `manage_log` VALUES (556, 'lywebsite', '/manage/order_twos/view.php?', '58.62.104.87', '修改订单状态', 1435904101);
INSERT INTO `manage_log` VALUES (557, 'lywebsite', '/manage/ad/add.php?', '58.62.104.87', '添加广告图片', 1435908009);
INSERT INTO `manage_log` VALUES (558, 'lywebsite', '/manage/ad/mod.php?', '58.62.104.87', '更新广告图片', 1435908027);
INSERT INTO `manage_log` VALUES (559, 'lywebsite', '/manage/member_two/view.php?', '58.62.104.87', '审核教师申请', 1435911885);
INSERT INTO `manage_log` VALUES (560, 'lywebsite', '/manage/order_twos/view.php?', '58.62.104.87', '修改订单状态', 1435918382);
INSERT INTO `manage_log` VALUES (561, 'lywebsite', '/manage/index.php?', '163.179.244.46', '成功登录后台', 1435939188);
INSERT INTO `manage_log` VALUES (562, 'lywebsite', '/manage/product/mod.php?', '163.179.244.46', '编辑产品:黄老师', 1435939334);
INSERT INTO `manage_log` VALUES (563, 'lywebsite', '/manage/product_review/index.php?', '163.179.244.46', '批量删除产品评论', 1435952922);
INSERT INTO `manage_log` VALUES (564, 'lywebsite', '/manage/index.php?', '59.42.9.206', '成功登录后台', 1436002311);
INSERT INTO `manage_log` VALUES (565, 'lywebsite', '/manage/order_twos/view.php?', '59.42.9.206', '修改订单状态', 1436014849);
INSERT INTO `manage_log` VALUES (566, '', '/manage/admin/logout.php?', '59.42.9.206', '退出登录', 1436020522);
INSERT INTO `manage_log` VALUES (567, '', '/manage/index.php?', '157.122.117.182', '<font class=''fc_red''>lywebsite</font>尝试登录后台，返回状态:错误的验证码，请重新登录！', 1436070332);
INSERT INTO `manage_log` VALUES (568, 'lywebsite', '/manage/index.php?', '157.122.117.182', '成功登录后台', 1436070340);
INSERT INTO `manage_log` VALUES (569, 'lywebsite', '/manage/member/index.php?', '157.122.117.182', '批量删除会员', 1436070421);
INSERT INTO `manage_log` VALUES (570, 'lywebsite', '/manage/member_two/index.php?', '157.122.117.182', '批量删除会员', 1436071479);
INSERT INTO `manage_log` VALUES (571, 'lywebsite', '/manage/member/index.php?', '157.122.117.182', '批量删除会员', 1436071489);
INSERT INTO `manage_log` VALUES (572, 'lywebsite', '/manage/product/index.php?', '157.122.117.182', '批量删除产品', 1436071497);
INSERT INTO `manage_log` VALUES (573, 'lywebsite', '/manage/index.php?', '58.62.104.87', '成功登录后台', 1436150937);
INSERT INTO `manage_log` VALUES (574, 'lywebsite', '/manage/index.php?', '58.62.104.87', '成功登录后台', 1436168334);
INSERT INTO `manage_log` VALUES (575, 'lywebsite', '/manage/index.php?', '116.21.160.29', '成功登录后台', 1436290328);
INSERT INTO `manage_log` VALUES (576, 'lywebsite', '/manage/index.php?', '59.42.115.243', '成功登录后台', 1436317880);
INSERT INTO `manage_log` VALUES (577, 'lywebsite', '/manage/product/circle_add.php?', '59.42.115.243', '添加产品颜色:商圈1', 1436326640);
INSERT INTO `manage_log` VALUES (578, 'lywebsite', '/manage/product/circle_add.php?', '59.42.115.243', '添加产品颜色:商圈2', 1436326645);
INSERT INTO `manage_log` VALUES (579, 'lywebsite', '/manage/product/circle_add.php?', '59.42.115.243', '添加产品颜色:商圈3', 1436326653);
INSERT INTO `manage_log` VALUES (580, 'lywebsite', '/manage/product/circle_mod.php?', '59.42.115.243', '更新产品颜色:商圈12', 1436326662);
INSERT INTO `manage_log` VALUES (581, 'lywebsite', '/manage/product/circle_mod.php?', '59.42.115.243', '更新产品颜色:商圈1', 1436326668);
INSERT INTO `manage_log` VALUES (582, 'lywebsite', '/manage/product/mod.php?', '59.42.115.243', '编辑产品:啊老师', 1436326941);
INSERT INTO `manage_log` VALUES (583, 'lywebsite', '/manage/product/mod.php?', '59.42.115.243', '编辑产品:黄老师', 1436327087);
INSERT INTO `manage_log` VALUES (584, 'lywebsite', '/manage/orders/view.php?', '59.42.115.243', '修改订单基本信息', 1436329030);
INSERT INTO `manage_log` VALUES (585, 'lywebsite', '/manage/orders/view.php?OrderId=88&module=print', '59.42.115.243', '打印订单', 1436329081);
INSERT INTO `manage_log` VALUES (586, 'lywebsite', '/manage/orders/view.php?OrderId=88&module=export', '59.42.115.243', '导出订单', 1436329086);
INSERT INTO `manage_log` VALUES (587, 'lywebsite', '/manage/index.php?', '59.42.115.243', '成功登录后台', 1436337060);
INSERT INTO `manage_log` VALUES (588, 'lywebsite', '/manage/index.php?', '59.42.115.243', '成功登录后台', 1436351486);

-- --------------------------------------------------------

-- 
-- 表的结构 `manage_operation_log`
-- 

DROP TABLE IF EXISTS `manage_operation_log`;
CREATE TABLE `manage_operation_log` (
  `LId` smallint(5) NOT NULL auto_increment,
  `Value` smallint(5) default '0',
  `Operation` varchar(50) default NULL,
  PRIMARY KEY  (`LId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `manage_operation_log`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `member`
-- 

DROP TABLE IF EXISTS `member`;
CREATE TABLE `member` (
  `MemberId` mediumint(8) NOT NULL auto_increment,
  `ID` varchar(8) NOT NULL,
  `Face` varchar(255) default '0',
  `Title` varchar(10) default NULL,
  `UserName` varchar(20) default NULL,
  `Email` varchar(100) default NULL,
  `Phone` varchar(30) default NULL,
  `Password` varchar(32) default NULL,
  `RegTime` int(10) default '0',
  `RegIp` varchar(15) default NULL,
  `LastLoginTime` int(10) default '0',
  `LastLoginIp` varchar(15) default NULL,
  `LoginTimes` mediumint(8) default '0',
  `MemberLevel` smallint(5) NOT NULL default '0',
  `Country` varchar(20) default NULL,
  `State` varchar(20) default NULL,
  `City` varchar(20) default NULL,
  `IsTeacher` tinyint(1) default NULL,
  `Apply` tinyint(1) default '0',
  `IsStar` smallint(1) default '0',
  `IsHot` smallint(1) default '0',
  `Ischeck` tinyint(1) NOT NULL default '0',
  `Account_Price` decimal(10,2) default '0.00',
  `CardNum` varchar(100) default NULL,
  `Brithday` varchar(30) default NULL,
  `Is_All_0` tinyint(1) default '0',
  `Is_All_1` tinyint(4) default '0',
  PRIMARY KEY  (`MemberId`)
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=utf8 AUTO_INCREMENT=54 ;

-- 
-- 导出表中的数据 `member`
-- 

INSERT INTO `member` VALUES (28, '00000028', '/u_file/face/70_01/01/s_82cff05247.png', '男', '学生家长1', '465937350@qq.com', '15013059003', '7f856006fa50b94a03ce35a61818580b', 1435544365, '58.62.104.87', 1436337879, '59.42.115.243', 29, 3, '天津市', '市辖区', '和平区', 0, 0, 0, 0, 0, 0.00, '18885654798966564465', '2015-5-03', 0, 0);
INSERT INTO `member` VALUES (27, '00000027', '/u_file/face/70_01/01/s_0fb4953bd9.jpg', '男', '黄老师', NULL, '15013059001', '7f856006fa50b94a03ce35a61818580b', 1435386026, '59.42.114.146', 1436338067, '59.42.115.243', 22, 3, '', '', '', 1, 0, 0, 0, 0, 0.00, NULL, NULL, 0, 0);
INSERT INTO `member` VALUES (37, '00000037', '/u_file/face/70_01/01/s_482c78f403.png', '男', '黄老师', NULL, '15013059005', '7f856006fa50b94a03ce35a61818580b', 1435742145, '58.62.104.87', 1436330302, '59.42.115.243', 14, 3, '', '', '', 1, 1, 0, 0, 0, 0.00, '545', '1994-10-16', 1, 0);
INSERT INTO `member` VALUES (38, '00000038', '0', NULL, NULL, NULL, '15013059006', '7f856006fa50b94a03ce35a61818580b', 1435742567, '58.62.104.87', 1435742567, '58.62.104.87', 1, 3, NULL, NULL, '1', 0, 1, 0, 0, 0, 0.00, NULL, NULL, 0, 0);
INSERT INTO `member` VALUES (39, '00000039', '0', NULL, NULL, NULL, '15820226402', '7f856006fa50b94a03ce35a61818580b', 1435758533, '116.26.213.43', 1436285867, '116.26.213.33', 2, 3, NULL, NULL, '', 0, 0, 0, 0, 0, 0.00, NULL, NULL, 0, 0);
INSERT INTO `member` VALUES (40, '00000040', '0', NULL, NULL, NULL, '13131313131', '7f856006fa50b94a03ce35a61818580b', 1435758795, '116.26.213.43', 1435758795, '116.26.213.43', 1, 3, NULL, NULL, '1', 0, 1, 0, 0, 0, 0.00, NULL, NULL, 0, 0);
INSERT INTO `member` VALUES (35, '00000035', '/u_file/face/70_01/01/s_69bdb1672e.jpg', '男', '天天', NULL, '13015059003', '7f856006fa50b94a03ce35a61818580b', 1435725746, '58.62.104.87', 1435840327, '58.62.104.87', 5, 3, '', '', '', 1, 1, 0, 0, 0, 0.00, NULL, NULL, 0, 0);
INSERT INTO `member` VALUES (36, '00000036', '/u_file/face/70_01/01/s_bc6f49d67b.jpg', '男', 'willer123', NULL, '15013059004', '7f856006fa50b94a03ce35a61818580b', 1435726715, '58.62.104.87', 1436338102, '59.42.115.243', 8, 3, '', '', '', 1, 1, 0, 0, 0, 0.00, '', '1953-4-4', 1, 0);
INSERT INTO `member` VALUES (41, '00000041', '/u_file/face/70_01/01/s_fda1a7983a.jpg', '男', '啊老师', NULL, '15820227258', '7f856006fa50b94a03ce35a61818580b', 1435768127, '14.18.243.102', 1436345519, '59.42.115.243', 41, 3, '', '', '', 1, 1, 0, 0, 0, 0.00, '', NULL, 0, 0);
INSERT INTO `member` VALUES (42, '00000042', '0', NULL, NULL, NULL, '18666188660', '7f856006fa50b94a03ce35a61818580b', 1435851346, '157.122.117.172', 1436345193, '59.42.115.243', 21, 3, NULL, NULL, '', 0, 0, 0, 0, 0, 0.00, NULL, NULL, 0, 0);
INSERT INTO `member` VALUES (43, '00000043', '/u_file/face/70_01/01/s_1e12199bfb.jpg', '男', '刘老师', NULL, '15013059009', '7f856006fa50b94a03ce35a61818580b', 1435965778, '163.179.244.46', 1435965778, '163.179.244.46', 1, 3, '', '', '', 0, 1, 0, 0, 0, 0.00, NULL, NULL, 1, 0);
INSERT INTO `member` VALUES (44, '00000044', '0', NULL, NULL, NULL, '18620271466', '7f856006fa50b94a03ce35a61818580b', 1435994348, '119.129.246.230', 1435994348, '119.129.246.230', 1, 3, NULL, NULL, '1', 0, 1, 0, 0, 0, 0.00, NULL, NULL, 0, 0);
INSERT INTO `member` VALUES (45, '00000045', '0', NULL, NULL, NULL, '15678991234', '7f856006fa50b94a03ce35a61818580b', 1435995341, '119.129.246.230', 1435995341, '119.129.246.230', 1, 3, NULL, NULL, '1', 0, 1, 0, 0, 0, 0.00, NULL, NULL, 0, 0);
INSERT INTO `member` VALUES (46, '00000046', '0', NULL, NULL, NULL, '1111111', '5882f427161ca84ae2daf1deda800743', 1435995740, '119.129.246.230', 1435995740, '119.129.246.230', 1, 3, NULL, NULL, '1', 0, 1, 0, 0, 0, 0.00, '123456', NULL, 0, 0);
INSERT INTO `member` VALUES (47, '00000047', '0', NULL, NULL, NULL, '1', 'fbdb4eb3407bbcd88b6e3671342b54c2', 1435995974, '119.129.246.230', 1436198368, '14.147.101.114', 5, 3, NULL, NULL, '', 0, 0, 0, 0, 0, 0.00, '121212', NULL, 0, 0);
INSERT INTO `member` VALUES (48, '00000048', '0', '男', '131313131313', NULL, '11', 'f2d233f941d0d6427a5f0e1649ee87b0', 1435996154, '119.129.246.230', 1435996154, '119.129.246.230', 1, 3, '', '', '', 0, 1, 0, 0, 0, 0.00, '121212', NULL, 1, 0);
INSERT INTO `member` VALUES (49, '00000049', '0', NULL, NULL, NULL, '33', '05b895c08d55c11f620caa9745411e82', 1436028778, '14.18.243.19', 1436028778, '14.18.243.19', 1, 3, NULL, NULL, '', 0, 0, 0, 0, 0, 0.00, NULL, NULL, 0, 0);
INSERT INTO `member` VALUES (50, '00000050', '0', NULL, NULL, NULL, '2', '022562165bdd76dd23338c7e7d4de7d2', 1436032504, '119.129.246.235', 1436032504, '119.129.246.235', 1, 3, NULL, NULL, '1', 0, 1, 0, 0, 0, 0.00, NULL, NULL, 0, 0);
INSERT INTO `member` VALUES (51, '00000051', '0', NULL, NULL, NULL, '3', 'f6a50a404d777e3b0fd33743f2f835c0', 1436032568, '119.129.246.235', 1436032568, '119.129.246.235', 1, 3, NULL, NULL, '', 0, 0, 0, 0, 0, 0.00, NULL, NULL, 0, 0);
INSERT INTO `member` VALUES (53, '00000053', '0', '男', '老师', NULL, '15013059010', '7f856006fa50b94a03ce35a61818580b', 1436070517, '157.122.117.182', 1436070517, '157.122.117.182', 1, 3, '', '', '', 0, 1, 0, 0, 0, 0.00, NULL, '1952-3-5', 1, 0);

-- --------------------------------------------------------

-- 
-- 表的结构 `member_address_book`
-- 

DROP TABLE IF EXISTS `member_address_book`;
CREATE TABLE `member_address_book` (
  `AId` mediumint(8) NOT NULL auto_increment,
  `MemberId` mediumint(8) default '0',
  `Title` varchar(10) default NULL,
  `FirstName` varchar(20) default NULL,
  `LastName` varchar(20) default NULL,
  `AddressLine1` varchar(200) default NULL,
  `AddressLine2` varchar(200) default NULL,
  `City` varchar(50) default NULL,
  `State` varchar(50) default NULL,
  `Country` varchar(50) default NULL,
  `PostalCode` varchar(10) default NULL,
  `Phone` varchar(20) default NULL,
  `AddressType` tinyint(1) default '0',
  `IsDefault` tinyint(1) default '0',
  PRIMARY KEY  (`AId`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

-- 
-- 导出表中的数据 `member_address_book`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `member_apply`
-- 

DROP TABLE IF EXISTS `member_apply`;
CREATE TABLE `member_apply` (
  `AId` mediumint(8) NOT NULL auto_increment,
  `MemberId` mediumint(8) default '0',
  `T_style` varchar(20) default NULL,
  `Identity_Num` varchar(20) default NULL,
  `CateId` int(8) default NULL,
  `T_age` smallint(3) default NULL,
  `T_address` varchar(120) default NULL,
  `T_will` varchar(20) default NULL,
  `T_gift` varchar(200) default NULL,
  `T_thought` varchar(200) default NULL,
  `T_success` varchar(200) default NULL,
  `T_ter` varchar(200) default NULL,
  `P_age` tinyint(8) default NULL,
  `ApplyTime` varchar(10) default NULL,
  `RegTime` int(10) default NULL,
  `Ischeck` tinyint(1) default '0',
  `Degree` tinyint(1) default '0',
  `Certification` tinyint(1) default '0',
  `Identity` tinyint(1) default '0',
  `Is_apply` tinyint(1) default NULL,
  `CId` int(8) default NULL,
  PRIMARY KEY  (`AId`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 PACK_KEYS=1 AUTO_INCREMENT=13 ;

-- 
-- 导出表中的数据 `member_apply`
-- 

INSERT INTO `member_apply` VALUES (7, 35, '细心，认真，活力', '44018312198903208405', 5, 12, '还是大家咖啡', '天天向上', '还是大家咖啡', '还是大家咖啡', '还是大家咖啡', '还是大家咖啡', 23, '1435725781', 1435726244, 1, 0, 0, 0, NULL, NULL);
INSERT INTO `member_apply` VALUES (5, 27, '幽默', '44018312198903208405', 8, 10, '广州', '认真，负责', '认真，负责', '认真，负责', '认真，负责', '认真，负责', 26, '1435386608', 1435387097, 1, 0, 0, 0, NULL, NULL);
INSERT INTO `member_apply` VALUES (8, 36, '激动，活力', '4401831989202084077', 23, 3, '深圳', '路过的', '激动，活力', '激动，活力', '激动，活力', '激动，活力', 30, '1435726755', 1435726863, 1, 0, 0, 0, NULL, NULL);
INSERT INTO `member_apply` VALUES (9, 37, '认真 努力', '44018319898005471', 8, 4, '认真 努力', '认真 努力', '认真 努力', '认真 努力', '认真 努力', '认真 努力', 25, '1435742292', 1435742493, 1, 0, 0, 0, NULL, NULL);
INSERT INTO `member_apply` VALUES (10, 41, '45', '45', 23, 17, '45', '45', '45', '45', '45', '45', 5, '1435911762', 1435911885, 1, 0, 0, 0, NULL, NULL);
INSERT INTO `member_apply` VALUES (11, 43, '', '44018689880208', 5, 2, '', '', '', '', '', '', 25, '1435967994', NULL, 0, 0, 0, 0, 1, NULL);
INSERT INTO `member_apply` VALUES (12, 53, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1436070517', NULL, 0, 0, 0, 0, NULL, 1);

-- --------------------------------------------------------

-- 
-- 表的结构 `member_ext`
-- 

DROP TABLE IF EXISTS `member_ext`;
CREATE TABLE `member_ext` (
  `AId` mediumint(8) NOT NULL auto_increment,
  `MemberId` mediumint(8) default '0',
  `Brief` varchar(250) default NULL,
  `Job` varchar(200) default NULL,
  `Age` smallint(3) default NULL,
  `Hobby` varchar(120) default NULL,
  `Class` varchar(120) default NULL,
  `Shcool` varchar(120) default NULL,
  `Interest` varchar(250) default NULL,
  `IntroDes` varchar(250) default NULL,
  `Video` varchar(200) default NULL,
  PRIMARY KEY  (`AId`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

-- 
-- 导出表中的数据 `member_ext`
-- 

INSERT INTO `member_ext` VALUES (26, 8, '123123123', '123', 18, '|5|10|14|18|22|26|', '123', '123', '123', NULL, NULL);
INSERT INTO `member_ext` VALUES (27, 14, NULL, NULL, NULL, '|5|10|14|18|22|', '高三', 'gz', NULL, NULL, NULL);
INSERT INTO `member_ext` VALUES (28, 19, NULL, NULL, NULL, '|5|6|7|10|11|12|16|20|24|', '年级', '萨芬', NULL, NULL, NULL);
INSERT INTO `member_ext` VALUES (29, 22, NULL, NULL, NULL, '||', '', '', NULL, NULL, NULL);
INSERT INTO `member_ext` VALUES (30, 27, 'test', 'test', 18, '||', '', '', 'test', NULL, NULL);
INSERT INTO `member_ext` VALUES (31, 29, NULL, NULL, NULL, '||', '', '', NULL, NULL, NULL);
INSERT INTO `member_ext` VALUES (32, 28, '', '', 0, '|5|10|14|18|22|', '1年纪', 'test', '', 'test', 'http://player.youku.com/player.php/sid/XMTI3MDkwNjQxNg==/v.swf');
INSERT INTO `member_ext` VALUES (33, 34, NULL, NULL, NULL, '||', '', '', NULL, NULL, NULL);
INSERT INTO `member_ext` VALUES (34, 35, NULL, NULL, NULL, '||', '', '', NULL, NULL, NULL);
INSERT INTO `member_ext` VALUES (35, 36, NULL, NULL, NULL, '||', '', '', NULL, '', '');
INSERT INTO `member_ext` VALUES (36, 37, NULL, NULL, NULL, '||', '', '', NULL, '', '');
INSERT INTO `member_ext` VALUES (37, 41, NULL, NULL, NULL, '||', '', '', NULL, '', '');
INSERT INTO `member_ext` VALUES (38, 43, NULL, NULL, NULL, '||', '', '', NULL, '', '');
INSERT INTO `member_ext` VALUES (39, 48, NULL, NULL, NULL, '||', '', '', NULL, '', '');
INSERT INTO `member_ext` VALUES (40, 53, NULL, NULL, NULL, '||', '', '', NULL, '', '');

-- --------------------------------------------------------

-- 
-- 表的结构 `member_ident`
-- 

DROP TABLE IF EXISTS `member_ident`;
CREATE TABLE `member_ident` (
  `AId` mediumint(8) NOT NULL auto_increment,
  `MemberId` mediumint(8) default '0',
  `Pic_Cer` varchar(150) default NULL,
  `Pic_Teach` varchar(120) default NULL,
  `Pic_Other` varchar(120) default NULL,
  `Is_ident` tinyint(1) default '0',
  `T_age` int(3) default NULL,
  PRIMARY KEY  (`AId`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=utf8 AUTO_INCREMENT=47 ;

-- 
-- 导出表中的数据 `member_ident`
-- 

INSERT INTO `member_ident` VALUES (43, 37, '/u_file/cer/2fe6efe20d.jpg', '/u_file/cer/76675ead0a.jpg', '/u_file/cer/22e7bb6fda.jpg', 1, 123);
INSERT INTO `member_ident` VALUES (44, 43, '/u_file/cer/b48e6a393c.png', '/u_file/cer/74ca3ba5b8.jpg', '', 1, NULL);
INSERT INTO `member_ident` VALUES (45, 41, '', '', '', 0, NULL);
INSERT INTO `member_ident` VALUES (46, 53, '/u_file/cer/c207090167.jpg', '/u_file/cer/be286792b3.png', '/u_file/cer/6ac75b7edd.jpg', 1, 12);

-- --------------------------------------------------------

-- 
-- 表的结构 `member_level`
-- 

DROP TABLE IF EXISTS `member_level`;
CREATE TABLE `member_level` (
  `LId` mediumint(8) NOT NULL auto_increment,
  `Level` varchar(50) default NULL,
  `UpgradePrice` decimal(10,2) default NULL,
  `Discount` int(5) default NULL,
  `AccTime` int(10) default NULL,
  PRIMARY KEY  (`LId`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- 
-- 导出表中的数据 `member_level`
-- 

INSERT INTO `member_level` VALUES (3, '普通会员', 0.00, 10, 1431398707);
INSERT INTO `member_level` VALUES (4, '教师会员', 0.00, 0, 1431398836);

-- --------------------------------------------------------

-- 
-- 表的结构 `member_log`
-- 

DROP TABLE IF EXISTS `member_log`;
CREATE TABLE `member_log` (
  `AId` smallint(5) NOT NULL auto_increment,
  `MemberId` smallint(8) default NULL,
  `Ip` varchar(100) default NULL,
  `Operation` int(2) default NULL,
  PRIMARY KEY  (`AId`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- 
-- 导出表中的数据 `member_log`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `member_login_log`
-- 

DROP TABLE IF EXISTS `member_login_log`;
CREATE TABLE `member_login_log` (
  `LId` mediumint(10) NOT NULL auto_increment,
  `MemberId` mediumint(10) default '0',
  `LoginTime` int(10) default '0',
  `LoginIp` varchar(15) default NULL,
  PRIMARY KEY  (`LId`)
) ENGINE=MyISAM AUTO_INCREMENT=372 DEFAULT CHARSET=utf8 AUTO_INCREMENT=372 ;

-- 
-- 导出表中的数据 `member_login_log`
-- 

INSERT INTO `member_login_log` VALUES (120, 7, 1431345595, '127.0.0.1');
INSERT INTO `member_login_log` VALUES (121, 7, 1431396866, '127.0.0.1');
INSERT INTO `member_login_log` VALUES (122, 0, 1431398895, '127.0.0.1');
INSERT INTO `member_login_log` VALUES (123, 0, 1431399151, '127.0.0.1');
INSERT INTO `member_login_log` VALUES (124, 0, 1431399224, '127.0.0.1');
INSERT INTO `member_login_log` VALUES (125, 8, 1431399248, '127.0.0.1');
INSERT INTO `member_login_log` VALUES (126, 8, 1431421810, '127.0.0.1');
INSERT INTO `member_login_log` VALUES (127, 8, 1431430015, '127.0.0.1');
INSERT INTO `member_login_log` VALUES (128, 9, 1431432611, '127.0.0.1');
INSERT INTO `member_login_log` VALUES (129, 8, 1431675873, '127.0.0.1');
INSERT INTO `member_login_log` VALUES (130, 8, 1431911511, '127.0.0.1');
INSERT INTO `member_login_log` VALUES (131, 8, 1431948787, '127.0.0.1');
INSERT INTO `member_login_log` VALUES (132, 8, 1432000281, '127.0.0.1');
INSERT INTO `member_login_log` VALUES (133, 8, 1432007280, '127.0.0.1');
INSERT INTO `member_login_log` VALUES (134, 8, 1432013766, '127.0.0.1');
INSERT INTO `member_login_log` VALUES (135, 8, 1432016784, '127.0.0.1');
INSERT INTO `member_login_log` VALUES (136, 8, 1432016995, '127.0.0.1');
INSERT INTO `member_login_log` VALUES (137, 8, 1432017019, '127.0.0.1');
INSERT INTO `member_login_log` VALUES (138, 8, 1432017099, '127.0.0.1');
INSERT INTO `member_login_log` VALUES (139, 8, 1432020694, '127.0.0.1');
INSERT INTO `member_login_log` VALUES (140, 8, 1432020793, '127.0.0.1');
INSERT INTO `member_login_log` VALUES (141, 8, 1432020924, '127.0.0.1');
INSERT INTO `member_login_log` VALUES (142, 10, 1432042238, '183.131.11.81');
INSERT INTO `member_login_log` VALUES (143, 11, 1432044022, '116.26.220.157');
INSERT INTO `member_login_log` VALUES (144, 8, 1432087101, '58.62.106.122');
INSERT INTO `member_login_log` VALUES (145, 9, 1432094343, '58.62.106.122');
INSERT INTO `member_login_log` VALUES (146, 9, 1432095050, '58.62.106.122');
INSERT INTO `member_login_log` VALUES (147, 10, 1432113158, '112.90.231.33');
INSERT INTO `member_login_log` VALUES (148, 12, 1432188449, '112.90.231.33');
INSERT INTO `member_login_log` VALUES (149, 10, 1433401053, '112.90.231.23');
INSERT INTO `member_login_log` VALUES (150, 10, 1433664616, '14.18.243.13');
INSERT INTO `member_login_log` VALUES (151, 13, 1434597698, '219.136.215.17');
INSERT INTO `member_login_log` VALUES (152, 14, 1434597914, '219.136.215.17');
INSERT INTO `member_login_log` VALUES (153, 14, 1434598417, '219.136.215.17');
INSERT INTO `member_login_log` VALUES (154, 8, 1434606726, '219.136.215.17');
INSERT INTO `member_login_log` VALUES (155, 10, 1435031064, '112.90.231.43');
INSERT INTO `member_login_log` VALUES (156, 8, 1435053692, '61.144.105.193');
INSERT INTO `member_login_log` VALUES (157, 8, 1435099617, '112.90.231.43');
INSERT INTO `member_login_log` VALUES (158, 8, 1435108157, '61.144.105.193');
INSERT INTO `member_login_log` VALUES (159, 10, 1435111894, '183.131.11.91');
INSERT INTO `member_login_log` VALUES (160, 15, 1435127495, '61.144.105.193');
INSERT INTO `member_login_log` VALUES (161, 16, 1435128091, '61.144.105.193');
INSERT INTO `member_login_log` VALUES (162, 17, 1435128589, '61.144.105.193');
INSERT INTO `member_login_log` VALUES (163, 18, 1435129021, '61.144.105.193');
INSERT INTO `member_login_log` VALUES (164, 11, 1435135451, '183.55.84.107');
INSERT INTO `member_login_log` VALUES (165, 19, 1435137850, '61.144.105.193');
INSERT INTO `member_login_log` VALUES (166, 8, 1435138068, '61.144.105.193');
INSERT INTO `member_login_log` VALUES (167, 8, 1435199909, '59.41.113.170');
INSERT INTO `member_login_log` VALUES (168, 8, 1435212859, '59.41.113.170');
INSERT INTO `member_login_log` VALUES (169, 8, 1435212973, '59.41.113.170');
INSERT INTO `member_login_log` VALUES (170, 8, 1435213160, '59.41.113.170');
INSERT INTO `member_login_log` VALUES (171, 11, 1435241473, '183.55.84.107');
INSERT INTO `member_login_log` VALUES (172, 8, 1435282056, '59.41.113.170');
INSERT INTO `member_login_log` VALUES (173, 10, 1435307189, '112.90.231.42');
INSERT INTO `member_login_log` VALUES (174, 20, 1435308775, '112.90.231.42');
INSERT INTO `member_login_log` VALUES (175, 8, 1435313799, '59.41.113.170');
INSERT INTO `member_login_log` VALUES (176, 8, 1435314267, '59.41.113.170');
INSERT INTO `member_login_log` VALUES (177, 21, 1435376460, '59.42.114.146');
INSERT INTO `member_login_log` VALUES (178, 22, 1435377260, '59.42.114.146');
INSERT INTO `member_login_log` VALUES (179, 23, 1435377552, '59.42.114.146');
INSERT INTO `member_login_log` VALUES (180, 23, 1435378203, '59.42.114.146');
INSERT INTO `member_login_log` VALUES (181, 24, 1435384189, '59.42.114.146');
INSERT INTO `member_login_log` VALUES (182, 25, 1435384272, '59.42.114.146');
INSERT INTO `member_login_log` VALUES (183, 25, 1435385732, '59.42.114.146');
INSERT INTO `member_login_log` VALUES (184, 26, 1435385895, '59.42.114.146');
INSERT INTO `member_login_log` VALUES (185, 27, 1435386026, '59.42.114.146');
INSERT INTO `member_login_log` VALUES (186, 27, 1435386223, '59.42.114.146');
INSERT INTO `member_login_log` VALUES (187, 27, 1435386452, '59.42.114.146');
INSERT INTO `member_login_log` VALUES (188, 27, 1435386492, '59.42.114.146');
INSERT INTO `member_login_log` VALUES (189, 27, 1435386531, '59.42.114.146');
INSERT INTO `member_login_log` VALUES (190, 27, 1435387106, '59.42.114.146');
INSERT INTO `member_login_log` VALUES (191, 27, 1435389770, '59.42.114.146');
INSERT INTO `member_login_log` VALUES (192, 27, 1435389935, '59.42.114.146');
INSERT INTO `member_login_log` VALUES (193, 27, 1435397158, '59.42.114.146');
INSERT INTO `member_login_log` VALUES (194, 27, 1435539944, '58.62.104.87');
INSERT INTO `member_login_log` VALUES (195, 28, 1435544365, '58.62.104.87');
INSERT INTO `member_login_log` VALUES (196, 27, 1435552926, '58.62.104.87');
INSERT INTO `member_login_log` VALUES (197, 27, 1435556111, '58.62.104.87');
INSERT INTO `member_login_log` VALUES (198, 27, 1435556384, '58.62.104.87');
INSERT INTO `member_login_log` VALUES (199, 28, 1435557349, '58.62.104.87');
INSERT INTO `member_login_log` VALUES (200, 29, 1435572317, '183.5.238.164');
INSERT INTO `member_login_log` VALUES (201, 29, 1435573053, '183.5.238.164');
INSERT INTO `member_login_log` VALUES (202, 29, 1435574694, '183.5.238.164');
INSERT INTO `member_login_log` VALUES (203, 29, 1435575105, '183.5.238.164');
INSERT INTO `member_login_log` VALUES (204, 30, 1435575257, '183.5.238.164');
INSERT INTO `member_login_log` VALUES (205, 31, 1435575286, '183.5.238.164');
INSERT INTO `member_login_log` VALUES (206, 32, 1435577055, '183.55.74.237');
INSERT INTO `member_login_log` VALUES (207, 29, 1435591426, '157.122.117.172');
INSERT INTO `member_login_log` VALUES (208, 28, 1435628173, '58.62.104.87');
INSERT INTO `member_login_log` VALUES (209, 29, 1435628369, '14.18.243.102');
INSERT INTO `member_login_log` VALUES (210, 31, 1435629256, '14.18.243.102');
INSERT INTO `member_login_log` VALUES (211, 31, 1435629314, '14.18.243.102');
INSERT INTO `member_login_log` VALUES (212, 28, 1435629813, '58.62.104.87');
INSERT INTO `member_login_log` VALUES (213, 28, 1435631441, '58.62.104.87');
INSERT INTO `member_login_log` VALUES (214, 28, 1435631879, '58.62.104.87');
INSERT INTO `member_login_log` VALUES (215, 33, 1435635762, '119.130.186.8');
INSERT INTO `member_login_log` VALUES (216, 29, 1435650175, '14.18.243.102');
INSERT INTO `member_login_log` VALUES (217, 29, 1435662755, '14.18.243.102');
INSERT INTO `member_login_log` VALUES (218, 29, 1435673285, '14.18.243.102');
INSERT INTO `member_login_log` VALUES (219, 29, 1435715692, '14.18.243.102');
INSERT INTO `member_login_log` VALUES (220, 34, 1435724665, '58.62.104.87');
INSERT INTO `member_login_log` VALUES (221, 29, 1435724776, '14.18.243.102');
INSERT INTO `member_login_log` VALUES (222, 34, 1435725089, '58.62.104.87');
INSERT INTO `member_login_log` VALUES (223, 34, 1435725161, '58.62.104.87');
INSERT INTO `member_login_log` VALUES (224, 35, 1435725746, '58.62.104.87');
INSERT INTO `member_login_log` VALUES (225, 35, 1435726214, '58.62.104.87');
INSERT INTO `member_login_log` VALUES (226, 35, 1435726279, '58.62.104.87');
INSERT INTO `member_login_log` VALUES (227, 36, 1435726715, '58.62.104.87');
INSERT INTO `member_login_log` VALUES (228, 36, 1435726853, '58.62.104.87');
INSERT INTO `member_login_log` VALUES (229, 36, 1435726891, '58.62.104.87');
INSERT INTO `member_login_log` VALUES (230, 34, 1435729650, '58.62.104.87');
INSERT INTO `member_login_log` VALUES (231, 34, 1435730980, '58.62.104.87');
INSERT INTO `member_login_log` VALUES (232, 34, 1435733313, '58.62.104.87');
INSERT INTO `member_login_log` VALUES (233, 35, 1435733583, '58.62.104.87');
INSERT INTO `member_login_log` VALUES (234, 28, 1435733710, '58.62.104.87');
INSERT INTO `member_login_log` VALUES (235, 28, 1435733835, '58.62.104.87');
INSERT INTO `member_login_log` VALUES (236, 37, 1435742145, '58.62.104.87');
INSERT INTO `member_login_log` VALUES (237, 38, 1435742567, '58.62.104.87');
INSERT INTO `member_login_log` VALUES (238, 37, 1435742756, '58.62.104.87');
INSERT INTO `member_login_log` VALUES (239, 28, 1435743157, '58.62.104.87');
INSERT INTO `member_login_log` VALUES (240, 37, 1435743273, '58.62.104.87');
INSERT INTO `member_login_log` VALUES (241, 28, 1435743325, '58.62.104.87');
INSERT INTO `member_login_log` VALUES (242, 28, 1435745906, '58.62.104.87');
INSERT INTO `member_login_log` VALUES (243, 28, 1435747257, '58.62.104.87');
INSERT INTO `member_login_log` VALUES (244, 39, 1435758533, '116.26.213.43');
INSERT INTO `member_login_log` VALUES (245, 40, 1435758795, '116.26.213.43');
INSERT INTO `member_login_log` VALUES (246, 41, 1435768127, '14.18.243.102');
INSERT INTO `member_login_log` VALUES (247, 41, 1435802218, '14.18.243.102');
INSERT INTO `member_login_log` VALUES (248, 41, 1435815188, '14.145.139.117');
INSERT INTO `member_login_log` VALUES (249, 34, 1435821113, '58.62.104.87');
INSERT INTO `member_login_log` VALUES (250, 34, 1435828899, '58.62.104.87');
INSERT INTO `member_login_log` VALUES (251, 36, 1435829910, '58.62.104.87');
INSERT INTO `member_login_log` VALUES (252, 37, 1435831886, '58.62.104.87');
INSERT INTO `member_login_log` VALUES (253, 28, 1435831908, '58.62.104.87');
INSERT INTO `member_login_log` VALUES (254, 28, 1435836057, '58.62.104.87');
INSERT INTO `member_login_log` VALUES (255, 34, 1435837509, '58.62.104.87');
INSERT INTO `member_login_log` VALUES (256, 28, 1435837526, '58.62.104.87');
INSERT INTO `member_login_log` VALUES (257, 37, 1435839752, '58.62.104.87');
INSERT INTO `member_login_log` VALUES (258, 35, 1435840327, '58.62.104.87');
INSERT INTO `member_login_log` VALUES (259, 28, 1435840370, '58.62.104.87');
INSERT INTO `member_login_log` VALUES (260, 28, 1435841368, '58.62.104.87');
INSERT INTO `member_login_log` VALUES (261, 34, 1435841980, '58.62.104.87');
INSERT INTO `member_login_log` VALUES (262, 42, 1435851346, '157.122.117.172');
INSERT INTO `member_login_log` VALUES (263, 42, 1435851936, '157.122.117.172');
INSERT INTO `member_login_log` VALUES (264, 42, 1435852085, '14.18.243.102');
INSERT INTO `member_login_log` VALUES (265, 41, 1435853235, '14.18.243.102');
INSERT INTO `member_login_log` VALUES (266, 28, 1435887287, '58.62.104.87');
INSERT INTO `member_login_log` VALUES (267, 37, 1435893775, '58.62.104.87');
INSERT INTO `member_login_log` VALUES (268, 41, 1435894571, '14.18.243.102');
INSERT INTO `member_login_log` VALUES (269, 42, 1435895262, '157.122.117.172');
INSERT INTO `member_login_log` VALUES (270, 41, 1435895714, '14.18.243.102');
INSERT INTO `member_login_log` VALUES (271, 41, 1435904718, '14.18.243.102');
INSERT INTO `member_login_log` VALUES (272, 42, 1435907241, '14.18.243.102');
INSERT INTO `member_login_log` VALUES (273, 37, 1435907481, '58.62.104.87');
INSERT INTO `member_login_log` VALUES (274, 34, 1435909597, '58.62.104.87');
INSERT INTO `member_login_log` VALUES (275, 42, 1435910616, '60.191.30.53');
INSERT INTO `member_login_log` VALUES (276, 42, 1435910715, '60.191.30.53');
INSERT INTO `member_login_log` VALUES (277, 28, 1435911548, '58.62.104.87');
INSERT INTO `member_login_log` VALUES (278, 41, 1435911684, '60.191.30.53');
INSERT INTO `member_login_log` VALUES (279, 37, 1435913787, '58.62.104.87');
INSERT INTO `member_login_log` VALUES (280, 41, 1435918747, '58.62.104.87');
INSERT INTO `member_login_log` VALUES (281, 42, 1435918806, '60.191.30.53');
INSERT INTO `member_login_log` VALUES (282, 36, 1435918921, '58.62.104.87');
INSERT INTO `member_login_log` VALUES (283, 41, 1435918993, '58.62.104.87');
INSERT INTO `member_login_log` VALUES (284, 41, 1435925013, '60.191.30.53');
INSERT INTO `member_login_log` VALUES (285, 42, 1435925054, '60.191.30.53');
INSERT INTO `member_login_log` VALUES (286, 41, 1435925616, '60.191.30.53');
INSERT INTO `member_login_log` VALUES (287, 41, 1435932169, '14.18.243.57');
INSERT INTO `member_login_log` VALUES (288, 41, 1435932698, '14.18.243.57');
INSERT INTO `member_login_log` VALUES (289, 42, 1435932977, '14.18.243.57');
INSERT INTO `member_login_log` VALUES (290, 41, 1435933550, '14.18.243.57');
INSERT INTO `member_login_log` VALUES (291, 42, 1435933557, '14.18.243.57');
INSERT INTO `member_login_log` VALUES (292, 37, 1435938699, '163.179.244.46');
INSERT INTO `member_login_log` VALUES (293, 28, 1435939447, '163.179.244.46');
INSERT INTO `member_login_log` VALUES (294, 41, 1435942607, '14.18.243.57');
INSERT INTO `member_login_log` VALUES (295, 28, 1435965717, '163.179.244.46');
INSERT INTO `member_login_log` VALUES (296, 43, 1435965778, '163.179.244.46');
INSERT INTO `member_login_log` VALUES (297, 41, 1435968914, '14.18.243.57');
INSERT INTO `member_login_log` VALUES (298, 41, 1435971256, '14.18.243.57');
INSERT INTO `member_login_log` VALUES (299, 42, 1435977142, '14.18.243.57');
INSERT INTO `member_login_log` VALUES (300, 41, 1435978821, '14.18.243.57');
INSERT INTO `member_login_log` VALUES (301, 44, 1435994348, '119.129.246.230');
INSERT INTO `member_login_log` VALUES (302, 45, 1435995341, '119.129.246.230');
INSERT INTO `member_login_log` VALUES (303, 46, 1435995740, '119.129.246.230');
INSERT INTO `member_login_log` VALUES (304, 47, 1435995974, '119.129.246.230');
INSERT INTO `member_login_log` VALUES (305, 48, 1435996154, '119.129.246.230');
INSERT INTO `member_login_log` VALUES (306, 47, 1435996486, '119.129.246.230');
INSERT INTO `member_login_log` VALUES (307, 47, 1435996687, '119.129.246.230');
INSERT INTO `member_login_log` VALUES (308, 28, 1436002253, '59.42.9.206');
INSERT INTO `member_login_log` VALUES (309, 37, 1436002329, '59.42.9.206');
INSERT INTO `member_login_log` VALUES (310, 37, 1436007042, '59.42.9.206');
INSERT INTO `member_login_log` VALUES (311, 28, 1436008858, '59.42.9.206');
INSERT INTO `member_login_log` VALUES (312, 37, 1436008975, '59.42.9.206');
INSERT INTO `member_login_log` VALUES (313, 28, 1436014601, '59.42.9.206');
INSERT INTO `member_login_log` VALUES (314, 37, 1436014687, '59.42.9.206');
INSERT INTO `member_login_log` VALUES (315, 28, 1436016810, '59.42.9.206');
INSERT INTO `member_login_log` VALUES (316, 28, 1436016939, '59.42.9.206');
INSERT INTO `member_login_log` VALUES (317, 42, 1436027315, '14.18.243.19');
INSERT INTO `member_login_log` VALUES (318, 41, 1436027443, '14.18.243.19');
INSERT INTO `member_login_log` VALUES (319, 42, 1436028008, '122.228.229.248');
INSERT INTO `member_login_log` VALUES (320, 41, 1436028101, '14.18.243.19');
INSERT INTO `member_login_log` VALUES (321, 49, 1436028778, '14.18.243.19');
INSERT INTO `member_login_log` VALUES (322, 42, 1436028894, '122.228.229.248');
INSERT INTO `member_login_log` VALUES (323, 50, 1436032504, '119.129.246.235');
INSERT INTO `member_login_log` VALUES (324, 51, 1436032568, '119.129.246.235');
INSERT INTO `member_login_log` VALUES (325, 41, 1436064671, '14.18.243.19');
INSERT INTO `member_login_log` VALUES (326, 41, 1436069103, '14.18.243.19');
INSERT INTO `member_login_log` VALUES (327, 52, 1436070360, '157.122.117.182');
INSERT INTO `member_login_log` VALUES (328, 53, 1436070517, '157.122.117.182');
INSERT INTO `member_login_log` VALUES (329, 41, 1436070840, '14.18.243.19');
INSERT INTO `member_login_log` VALUES (330, 47, 1436081696, '14.145.229.211');
INSERT INTO `member_login_log` VALUES (331, 41, 1436148514, '202.99.196.202');
INSERT INTO `member_login_log` VALUES (332, 41, 1436149844, '14.18.243.105');
INSERT INTO `member_login_log` VALUES (333, 27, 1436151077, '58.62.104.87');
INSERT INTO `member_login_log` VALUES (334, 27, 1436153637, '58.62.104.87');
INSERT INTO `member_login_log` VALUES (335, 41, 1436167663, '58.62.104.87');
INSERT INTO `member_login_log` VALUES (336, 42, 1436168564, '58.62.104.87');
INSERT INTO `member_login_log` VALUES (337, 27, 1436168749, '58.62.104.87');
INSERT INTO `member_login_log` VALUES (338, 41, 1436168882, '58.62.104.87');
INSERT INTO `member_login_log` VALUES (339, 27, 1436169423, '58.62.104.87');
INSERT INTO `member_login_log` VALUES (340, 41, 1436169526, '58.62.104.87');
INSERT INTO `member_login_log` VALUES (341, 41, 1436197731, '183.131.11.90');
INSERT INTO `member_login_log` VALUES (342, 42, 1436197788, '183.131.11.90');
INSERT INTO `member_login_log` VALUES (343, 47, 1436198368, '14.147.101.114');
INSERT INTO `member_login_log` VALUES (344, 41, 1436261977, '183.131.11.90');
INSERT INTO `member_login_log` VALUES (345, 41, 1436275876, '183.131.11.90');
INSERT INTO `member_login_log` VALUES (346, 41, 1436285846, '112.90.231.4');
INSERT INTO `member_login_log` VALUES (347, 39, 1436285867, '116.26.213.33');
INSERT INTO `member_login_log` VALUES (348, 41, 1436285925, '116.26.213.33');
INSERT INTO `member_login_log` VALUES (349, 27, 1436292028, '116.21.160.29');
INSERT INTO `member_login_log` VALUES (350, 27, 1436292167, '116.21.160.29');
INSERT INTO `member_login_log` VALUES (351, 27, 1436292213, '116.21.160.29');
INSERT INTO `member_login_log` VALUES (352, 36, 1436293056, '116.21.160.29');
INSERT INTO `member_login_log` VALUES (353, 36, 1436318480, '59.42.115.243');
INSERT INTO `member_login_log` VALUES (354, 27, 1436318943, '59.42.115.243');
INSERT INTO `member_login_log` VALUES (355, 28, 1436329527, '59.42.115.243');
INSERT INTO `member_login_log` VALUES (356, 37, 1436330302, '59.42.115.243');
INSERT INTO `member_login_log` VALUES (357, 41, 1436331618, '183.131.11.90');
INSERT INTO `member_login_log` VALUES (358, 42, 1436331746, '183.131.11.90');
INSERT INTO `member_login_log` VALUES (359, 28, 1436337084, '59.42.115.243');
INSERT INTO `member_login_log` VALUES (360, 41, 1436337719, '59.42.115.243');
INSERT INTO `member_login_log` VALUES (361, 28, 1436337879, '59.42.115.243');
INSERT INTO `member_login_log` VALUES (362, 27, 1436338067, '59.42.115.243');
INSERT INTO `member_login_log` VALUES (363, 36, 1436338102, '59.42.115.243');
INSERT INTO `member_login_log` VALUES (364, 41, 1436338111, '59.42.115.243');
INSERT INTO `member_login_log` VALUES (365, 42, 1436338130, '59.42.115.243');
INSERT INTO `member_login_log` VALUES (366, 41, 1436338713, '59.42.115.243');
INSERT INTO `member_login_log` VALUES (367, 42, 1436339020, '59.42.115.243');
INSERT INTO `member_login_log` VALUES (368, 41, 1436339630, '59.42.115.243');
INSERT INTO `member_login_log` VALUES (369, 41, 1436345114, '59.42.115.243');
INSERT INTO `member_login_log` VALUES (370, 42, 1436345193, '59.42.115.243');
INSERT INTO `member_login_log` VALUES (371, 41, 1436345519, '59.42.115.243');

-- --------------------------------------------------------

-- 
-- 表的结构 `order_threes`
-- 

DROP TABLE IF EXISTS `order_threes`;
CREATE TABLE `order_threes` (
  `OrderId` mediumint(8) NOT NULL auto_increment,
  `OId` varchar(20) default NULL,
  `MemberId` mediumint(8) default '0',
  `Email` varchar(100) default NULL,
  `Phone` varchar(19) default NULL,
  `Shipping_Name` varchar(30) default NULL,
  `ProName` varchar(120) default NULL,
  `TotalPrice` decimal(10,2) default '0.00',
  `Comments` text,
  `PaymentMethod` varchar(100) default NULL,
  `OrderTime` int(10) default '0',
  `OrderStatus` tinyint(1) default '1',
  PRIMARY KEY  (`OrderId`)
) ENGINE=MyISAM AUTO_INCREMENT=79 DEFAULT CHARSET=utf8 AUTO_INCREMENT=79 ;

-- 
-- 导出表中的数据 `order_threes`
-- 

INSERT INTO `order_threes` VALUES (70, '2015070309385590', 28, NULL, '15013059003', '学生家长1', '充值', 100.00, NULL, NULL, 1435916335, 1);
INSERT INTO `order_threes` VALUES (71, '2015070309390342', 28, NULL, '15013059003', '学生家长1', '充值', 100.00, NULL, NULL, 1435916343, 1);
INSERT INTO `order_threes` VALUES (72, '2015070309561875', 28, NULL, '15013059003', '学生家长1', '充值', 100.00, NULL, NULL, 1435917378, 1);
INSERT INTO `order_threes` VALUES (73, '2015070310173355', 28, NULL, '15013059003', '学生家长1', '充值', 100.00, NULL, NULL, 1435918653, 1);
INSERT INTO `order_threes` VALUES (74, '2015070407545891', 47, NULL, '1', '', '充值', 1.00, NULL, NULL, 1435996498, 1);
INSERT INTO `order_threes` VALUES (75, '2015070407554250', 47, NULL, '1', '', '充值', 1.00, NULL, NULL, 1435996542, 1);
INSERT INTO `order_threes` VALUES (76, '2015070407554821', 47, NULL, '1', '', '充值', 1.00, NULL, NULL, 1435996548, 1);
INSERT INTO `order_threes` VALUES (77, '2015070414141138', 28, NULL, '15013059003', '学生家长1', '充值', 1000.00, NULL, NULL, 1436019251, 1);
INSERT INTO `order_threes` VALUES (78, '2015070507351770', 47, NULL, '1', '', '充值', 1.00, NULL, NULL, 1436081717, 1);

-- --------------------------------------------------------

-- 
-- 表的结构 `order_twos`
-- 

DROP TABLE IF EXISTS `order_twos`;
CREATE TABLE `order_twos` (
  `OrderId` mediumint(8) NOT NULL auto_increment,
  `OId` varchar(20) default NULL,
  `MemberId` mediumint(8) default '0',
  `Email` varchar(100) default NULL,
  `Phone` varchar(19) default NULL,
  `Shipping_Name` varchar(30) default NULL,
  `ProName` varchar(120) default NULL,
  `Grade_Site` varchar(220) default NULL,
  `Class_Site` varchar(220) default NULL,
  `PerTime` varchar(30) default NULL,
  `ProId` int(8) default NULL,
  `StartTime` varchar(50) default NULL,
  `EndTime` varchar(50) default NULL,
  `TotalPrice` decimal(10,2) default '0.00',
  `Comments` text,
  `Comments_two` text,
  `PaymentMethod` varchar(100) default NULL,
  `OrderTime` int(10) default '0',
  `OrderStatus` tinyint(1) default '1',
  `CateId` int(8) default NULL,
  `ClassTime` int(10) default NULL,
  `TeacherId` int(8) default NULL,
  `Tmakesure_0` tinyint(1) default '0',
  `Tmakesure_1` tinyint(1) default '0',
  `Smakesure_0` tinyint(1) default NULL,
  `Smakesure` tinyint(1) default '0',
  PRIMARY KEY  (`OrderId`)
) ENGINE=MyISAM AUTO_INCREMENT=84 DEFAULT CHARSET=utf8 AUTO_INCREMENT=84 ;

-- 
-- 导出表中的数据 `order_twos`
-- 

INSERT INTO `order_twos` VALUES (82, '2015070322364164', 28, NULL, '15013059003', '学生家长1', '黄老师', 'etet', '', NULL, 41, '07:00', '07:30', 0.01, 'set', NULL, NULL, 1435963001, 1, 8, NULL, 37, 0, 0, NULL, 0);
INSERT INTO `order_twos` VALUES (81, '2015070317453073', 28, NULL, '15013059003', '学生家长1', '黄老师', 'etet', '', NULL, 41, '07:00', '07:30', 0.01, 'set', NULL, NULL, 1435945530, 3, 8, NULL, 37, 1, 0, NULL, 0);
INSERT INTO `order_twos` VALUES (80, '2015070317422954', 28, NULL, '15013059003', '学生家长1', '黄老师', 'etet', '', NULL, 41, '07:00', '07:30', 0.01, 'set', NULL, NULL, 1435945349, 1, 8, NULL, 37, 0, 0, NULL, 0);
INSERT INTO `order_twos` VALUES (78, '2015070304494546', 28, NULL, '15013059003', '学生家长1', '黄老师', '2', '3', NULL, 41, '19:30', '18:00', 1500.00, '啦啦啦 啦阿拉了', NULL, NULL, 1435898985, 1, 8, NULL, 37, 1, 0, NULL, 0);
INSERT INTO `order_twos` VALUES (79, '2015070306015953', 28, NULL, '15013059003', '学生家长1', '黄老师', '2', '3', NULL, 41, '19:30', '18:00', 900.00, '啦啦啦 啦阿拉了', NULL, NULL, 1435903319, 3, 8, NULL, 37, 1, 0, NULL, 0);
INSERT INTO `order_twos` VALUES (83, '2015070412565130', 28, NULL, '15013059003', '学生家长1', '黄老师', '2', '3', NULL, 41, '19:30', '18:00', 1500.00, '啦啦啦 啦阿拉了', NULL, NULL, 1436014611, 2, 8, NULL, 37, 1, 0, NULL, 0);

-- --------------------------------------------------------

-- 
-- 表的结构 `order_twos_product_list`
-- 

DROP TABLE IF EXISTS `order_twos_product_list`;
CREATE TABLE `order_twos_product_list` (
  `LId` mediumint(8) NOT NULL auto_increment,
  `OrderId` mediumint(8) default '0',
  `ProId` mediumint(8) default '0',
  `CateId` smallint(5) default '0',
  `Color` varchar(50) default NULL,
  `Size` varchar(50) default NULL,
  `Name` varchar(100) default NULL,
  `ItemNumber` varchar(20) default NULL,
  `Weight` decimal(10,3) default '0.000',
  `PicPath` varchar(100) default NULL,
  `Price` decimal(10,2) default '0.00',
  `Qty` smallint(5) default '0',
  `Url` varchar(200) default NULL,
  `Remark` varchar(100) default NULL,
  `Class_num` int(8) default NULL,
  `Scompelet` tinyint(1) default NULL,
  `TeacherId` int(8) default NULL,
  `MemberId` int(8) default NULL,
  `Tmakesure_0` tinyint(1) default '0',
  `Smakesure_0` tinyint(1) default '0',
  `Smakesure` tinyint(1) default '0',
  PRIMARY KEY  (`LId`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

-- 
-- 导出表中的数据 `order_twos_product_list`
-- 

INSERT INTO `order_twos_product_list` VALUES (25, 78, 41, 0, NULL, NULL, '黄老师', NULL, 0.000, NULL, 0.00, 0, NULL, NULL, 5, NULL, 37, 28, 0, 0, 0);
INSERT INTO `order_twos_product_list` VALUES (24, 78, 41, 0, NULL, NULL, '黄老师', NULL, 0.000, NULL, 0.00, 0, NULL, NULL, 4, NULL, 37, 28, 0, 0, 0);
INSERT INTO `order_twos_product_list` VALUES (23, 78, 41, 0, NULL, NULL, '黄老师', NULL, 0.000, NULL, 0.00, 0, NULL, NULL, 3, NULL, 37, 28, 0, 0, 0);
INSERT INTO `order_twos_product_list` VALUES (22, 78, 41, 0, NULL, NULL, '黄老师', NULL, 0.000, NULL, 0.00, 0, NULL, NULL, 2, NULL, 37, 28, 0, 1, 1);
INSERT INTO `order_twos_product_list` VALUES (21, 78, 41, 0, NULL, NULL, '黄老师', NULL, 0.000, NULL, 0.00, 0, NULL, NULL, 1, NULL, 37, 28, 0, 1, 1);
INSERT INTO `order_twos_product_list` VALUES (26, 79, 41, 0, NULL, NULL, '黄老师', NULL, 0.000, NULL, 0.00, 0, NULL, NULL, 1, NULL, 37, 28, 1, 1, 1);
INSERT INTO `order_twos_product_list` VALUES (27, 79, 41, 0, NULL, NULL, '黄老师', NULL, 0.000, NULL, 0.00, 0, NULL, NULL, 2, NULL, 37, 28, 0, 1, 1);
INSERT INTO `order_twos_product_list` VALUES (28, 79, 41, 0, NULL, NULL, '黄老师', NULL, 0.000, NULL, 0.00, 0, NULL, NULL, 3, NULL, 37, 28, 0, 1, 1);
INSERT INTO `order_twos_product_list` VALUES (29, 80, 41, 0, NULL, NULL, '黄老师', NULL, 0.000, NULL, 0.00, 0, NULL, NULL, 1, NULL, 37, 28, 0, 0, 0);
INSERT INTO `order_twos_product_list` VALUES (30, 81, 41, 0, NULL, NULL, '黄老师', NULL, 0.000, NULL, 0.00, 0, NULL, NULL, 1, NULL, 37, 28, 0, 1, 1);
INSERT INTO `order_twos_product_list` VALUES (31, 82, 41, 0, NULL, NULL, '黄老师', NULL, 0.000, NULL, 0.00, 0, NULL, NULL, 1, NULL, 37, 28, 0, 0, 0);
INSERT INTO `order_twos_product_list` VALUES (32, 83, 41, 0, NULL, NULL, '黄老师', NULL, 0.000, NULL, 0.00, 0, NULL, NULL, 1, NULL, 37, 28, 0, 1, 1);
INSERT INTO `order_twos_product_list` VALUES (33, 83, 41, 0, NULL, NULL, '黄老师', NULL, 0.000, NULL, 0.00, 0, NULL, NULL, 2, NULL, 37, 28, 0, 1, 1);
INSERT INTO `order_twos_product_list` VALUES (34, 83, 41, 0, NULL, NULL, '黄老师', NULL, 0.000, NULL, 0.00, 0, NULL, NULL, 3, NULL, 37, 28, 0, 1, 1);
INSERT INTO `order_twos_product_list` VALUES (35, 83, 41, 0, NULL, NULL, '黄老师', NULL, 0.000, NULL, 0.00, 0, NULL, NULL, 4, NULL, 37, 28, 0, 0, 0);
INSERT INTO `order_twos_product_list` VALUES (36, 83, 41, 0, NULL, NULL, '黄老师', NULL, 0.000, NULL, 0.00, 0, NULL, NULL, 5, NULL, 37, 28, 0, 0, 0);

-- --------------------------------------------------------

-- 
-- 表的结构 `orders`
-- 

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `OrderId` mediumint(8) NOT NULL auto_increment,
  `OId` varchar(20) default NULL,
  `MemberId` mediumint(8) default '0',
  `Email` varchar(100) default NULL,
  `Phone` varchar(19) default NULL,
  `Shipping_Name` varchar(30) default NULL,
  `ProName` varchar(120) default NULL,
  `Grade_Site` varchar(220) default NULL,
  `Class_Site` varchar(220) default NULL,
  `PerTime` varchar(30) default NULL,
  `ProId` int(8) default NULL,
  `StartTime` varchar(50) default NULL,
  `EndTime` varchar(50) default NULL,
  `TotalPrice` decimal(10,2) default '0.00',
  `Comments` text,
  `Comments_two` text,
  `PaymentMethod` varchar(100) default NULL,
  `OrderTime` int(10) default '0',
  `OrderStatus` tinyint(1) default '1',
  `CateId` int(8) default NULL,
  `ClassTime` int(10) default NULL,
  `TeacherId` int(8) default NULL,
  `Tmakesure_0` tinyint(1) default '0',
  `Tmakesure_1` tinyint(1) default '0',
  `Smakesure_0` tinyint(1) default NULL,
  `Smakesure` tinyint(1) default '0',
  PRIMARY KEY  (`OrderId`)
) ENGINE=MyISAM AUTO_INCREMENT=90 DEFAULT CHARSET=utf8 AUTO_INCREMENT=90 ;

-- 
-- 导出表中的数据 `orders`
-- 

INSERT INTO `orders` VALUES (64, '2015062905560324', 28, '', '15013059003', NULL, '黄老师', '2', '1', '2015', 37, '14:30', '14:00', 300.00, 'teset', NULL, NULL, 1435557363, 3, 8, NULL, 27, 1, 1, 1, 0);
INSERT INTO `orders` VALUES (63, '2015062903364085', 28, '', '15013059003', NULL, '黄老师', '1', '2', '2015', 37, '08:00', '07:00', 300.00, '123teste', NULL, NULL, 1435549000, 3, 8, NULL, 27, 1, 0, NULL, 0);
INSERT INTO `orders` VALUES (67, '2015070108360392', 28, '', '15013059003', '学生家长1', '天天', '1', '2', '2015-5-30', 39, '15:00', '15:00', 2600.00, 'test', 'test', NULL, 1435739763, 3, 5, NULL, 35, 1, 0, 1, 0);
INSERT INTO `orders` VALUES (66, '2015070106574693', 28, '', '15013059003', '学生家长1', '天天', '1', '2', '2015-5-30', 39, '15:00', '15:00', 2600.00, '若您向该老师购买课时，也需支付试听的课时费', NULL, NULL, 1435733866, 3, 5, NULL, 35, 1, 1, 1, 0);
INSERT INTO `orders` VALUES (68, '2015070109365437', 28, '', '15013059003', '学生家长1', '黄老师', '2', '3', '2015-10-10', 41, '19:30', '18:00', 300.00, '啦啦啦 啦阿拉了', NULL, NULL, 1435743414, 3, 8, NULL, 37, 1, 1, 1, 0);
INSERT INTO `orders` VALUES (69, '2015070308553691', 28, '', '15013059003', '学生家长1', '黄老师', 'test', '', '2015-5-30', 41, '07:00', '07:30', 300.00, 'test', NULL, NULL, 1435913736, 1, 8, NULL, 37, 1, 0, NULL, 0);
INSERT INTO `orders` VALUES (70, '2015070310025063', 28, '', '15013059003', '学生家长1', '黄老师', '123123', '', '2015-5-30', 41, '07:30', '07:30', 300.00, 'etst', NULL, NULL, 1435917770, 1, 8, NULL, 37, 1, 0, NULL, 0);
INSERT INTO `orders` VALUES (71, '2015070310283725', 42, '', '18666188660', '', '黄老师', '545', '', '54545', 37, '13:30', '14:30', 300.00, '54545', NULL, NULL, 1435919317, 1, 8, NULL, 27, 1, 0, NULL, 0);
INSERT INTO `orders` VALUES (72, '2015070310313491', 42, '', '18666188660', '', '黄老师', '84848', '', 'dfsd', 41, '15:00', '14:30', 300.00, 'efwefwefwef', NULL, NULL, 1435919494, 1, 8, NULL, 37, 0, 0, NULL, 0);
INSERT INTO `orders` VALUES (73, '2015070314111842', 41, '', '15820227258', '啊老师', '啊老师', '45646', '', '548948', 42, '14:00', '13:30', 300.00, '24981981', NULL, NULL, 1435932678, 1, 23, NULL, 41, 1, 0, NULL, 0);
INSERT INTO `orders` VALUES (74, '2015070314280262', 42, '', '18666188660', '', '啊老师', '12213', '', '123', 42, '12:30', '16:00', 300.00, '12の4', NULL, NULL, 1435933682, 1, 23, NULL, 41, 1, 0, NULL, 0);
INSERT INTO `orders` VALUES (75, '2015070314365550', 42, '', '18666188660', '', '啊老师', '124', '', '123', 42, '14:30', '16:00', 0.00, '1231', NULL, NULL, 1435934215, 1, 23, NULL, 41, 1, 0, NULL, 0);
INSERT INTO `orders` VALUES (76, '2015070314473670', 42, '', '18666188660', '', '啊老师', '1231', '', '123', 42, '12:30', '16:00', 1.00, '万日', NULL, NULL, 1435934856, 1, 23, NULL, 41, 1, 0, NULL, 0);
INSERT INTO `orders` VALUES (77, '2015070316491940', 28, '', '15013059003', '学生家长1', '黄老师', '只有基础', '', '2015-10-10', 41, '07:00', '07:30', 0.01, '试听成功后，', NULL, NULL, 1435942159, 1, 8, NULL, 37, 1, 0, NULL, 0);
INSERT INTO `orders` VALUES (78, '2015070316512596', 28, '', '15013059003', '学生家长1', '黄老师', '很好', '', '2015-10-10', 41, '07:30', '07:30', 0.01, '若您向该老师购买课', NULL, NULL, 1435942285, 1, 8, NULL, 37, 1, 0, NULL, 0);
INSERT INTO `orders` VALUES (79, '2015070317223439', 28, '', '15013059003', '学生家长1', '黄老师', 'test', '', '2015-10-10', 41, '07:00', '07:30', 0.01, 'aer', NULL, NULL, 1435944154, 1, 8, NULL, 37, 1, 0, NULL, 0);
INSERT INTO `orders` VALUES (80, '2015070317275530', 28, '', '15013059003', '学生家长1', '黄老师', 'test', '', '2015-10-10', 41, '07:00', '07:30', 0.01, 'adf', NULL, NULL, 1435944475, 1, 8, NULL, 37, 1, 0, NULL, 0);
INSERT INTO `orders` VALUES (81, '2015070317341497', 28, '', '15013059003', '学生家长1', '黄老师', '213', '', '123', 41, '07:30', '07:30', 0.01, '123', NULL, NULL, 1435944854, 1, 8, NULL, 37, 1, 0, NULL, 0);
INSERT INTO `orders` VALUES (82, '2015070317370210', 28, '', '15013059003', '学生家长1', '黄老师', '123', '', '123', 41, '07:00', '07:00', 0.01, '123', 'testetwerwer', NULL, 1435945022, 2, 8, 1436119320, 37, 1, 0, NULL, 0);
INSERT INTO `orders` VALUES (83, '2015070317403596', 28, '', '15013059003', '学生家长1', '黄老师', 'etet', '', 'set', 41, '07:00', '07:30', 0.01, 'set', NULL, NULL, 1435945235, 2, 8, 1436119550, 37, 1, 0, 1, 0);
INSERT INTO `orders` VALUES (84, '2015070407585310', 47, '', '1', '', '黄老师', '1111', '', '7月20日', 41, '12:00', '08:30', 0.01, '', NULL, NULL, 1435996733, 1, 8, NULL, 37, 0, 0, NULL, 0);
INSERT INTO `orders` VALUES (85, '2015070413362335', 28, '', '15013059003', '学生家长1', '黄老师', 'test', '', '2015-10-05', 41, '07:30', '07:00', 0.01, 'test', NULL, NULL, 1436016983, 2, 5, 1436191404, 37, 1, 1, 1, 0);
INSERT INTO `orders` VALUES (86, '2015070416551630', 42, '', '18666188660', '', '黄老师', '231', '', 'dr', 41, '15:00', '15:00', 0.01, '', NULL, NULL, 1436028916, 1, 5, NULL, 37, 0, 0, NULL, 0);
INSERT INTO `orders` VALUES (87, '2015070804014055', 36, '', '15013059004', 'willer123', '黄老师', '良好', '', '2015.07.09', 41, '08:30', '07:30', 0.01, '加强补习', NULL, NULL, 1436328100, 1, 5, NULL, 37, 0, 0, NULL, 0);
INSERT INTO `orders` VALUES (88, '2015070804044574', 27, '', '15013059001', '黄老师', '黄老师', 'sdfsdf', '', '2015.07.09', 41, '09:00', '07:30', 0.01, 'fsdfsdf', NULL, NULL, 1436328285, 1, 5, NULL, 37, 1, 0, NULL, 0);
INSERT INTO `orders` VALUES (89, '2015070804361081', 28, '', '15013059003', '学生家长1', '黄老师', '测试', '', '2015.07.09', 41, '07:30', '08:00', 0.01, '测试', NULL, NULL, 1436330170, 1, 5, NULL, 37, 1, 0, NULL, 0);

-- --------------------------------------------------------

-- 
-- 表的结构 `orders_payment_info`
-- 

DROP TABLE IF EXISTS `orders_payment_info`;
CREATE TABLE `orders_payment_info` (
  `InfoId` mediumint(8) NOT NULL auto_increment,
  `OrderId` mediumint(8) default '0',
  `FirstName` varchar(20) default NULL,
  `LastName` varchar(20) default NULL,
  `SentMoney` decimal(10,2) default NULL,
  `MTCNNumber` varchar(10) default NULL,
  `Currency` varchar(3) default NULL,
  `Country` varchar(50) default NULL,
  `SentTime` varchar(10) default NULL,
  `BankTransactionNumber` varchar(20) default NULL,
  `Contents` text,
  `PostTime` int(10) default '0',
  PRIMARY KEY  (`InfoId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `orders_payment_info`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `orders_product_list`
-- 

DROP TABLE IF EXISTS `orders_product_list`;
CREATE TABLE `orders_product_list` (
  `LId` mediumint(8) NOT NULL auto_increment,
  `OrderId` mediumint(8) default '0',
  `ProId` mediumint(8) default '0',
  `CateId` smallint(5) default '0',
  `Color` varchar(50) default NULL,
  `Size` varchar(50) default NULL,
  `Name` varchar(100) default NULL,
  `ItemNumber` varchar(20) default NULL,
  `Weight` decimal(10,3) default '0.000',
  `PicPath` varchar(100) default NULL,
  `Price` decimal(10,2) default '0.00',
  `Qty` smallint(5) default '0',
  `Url` varchar(200) default NULL,
  `Remark` varchar(100) default NULL,
  PRIMARY KEY  (`LId`)
) ENGINE=MyISAM AUTO_INCREMENT=1017 DEFAULT CHARSET=utf8 AUTO_INCREMENT=1017 ;

-- 
-- 导出表中的数据 `orders_product_list`
-- 

INSERT INTO `orders_product_list` VALUES (1016, 89, 41, 5, NULL, NULL, '黄老师', NULL, 0.000, '/images/orders/2015_07/2015070804361081/s_482c78f403.png', 0.01, 1, NULL, NULL);
INSERT INTO `orders_product_list` VALUES (985, 63, 37, 8, NULL, NULL, '黄老师', NULL, 0.000, '/images/orders/2015_06/2015062903364085/s_0fb4953bd9.jpg', 300.00, 0, NULL, NULL);
INSERT INTO `orders_product_list` VALUES (994, 67, 39, 5, NULL, NULL, '天天', NULL, 0.000, '/images/orders/2015_07/2015070108360392/s_69bdb1672e.jpg', 2600.00, 1, NULL, NULL);
INSERT INTO `orders_product_list` VALUES (987, 0, 37, 8, NULL, NULL, '黄老师', NULL, 0.000, '/images/orders/2015_06/2015062910195367/s_0fb4953bd9.jpg', 300.00, 1, NULL, NULL);
INSERT INTO `orders_product_list` VALUES (988, 0, 37, 8, NULL, NULL, '黄老师', NULL, 0.000, '/images/orders/2015_06/2015062910311981/s_0fb4953bd9.jpg', 300.00, 1, NULL, NULL);
INSERT INTO `orders_product_list` VALUES (989, 0, 37, 8, NULL, NULL, '黄老师', NULL, 0.000, '/images/orders/2015_06/2015063014043495/s_0fb4953bd9.jpg', 300.00, 1, NULL, NULL);
INSERT INTO `orders_product_list` VALUES (990, 0, 37, 8, NULL, NULL, '黄老师', NULL, 0.000, '/images/orders/2015_07/2015070104281339/s_0fb4953bd9.jpg', 300.00, 1, NULL, NULL);
INSERT INTO `orders_product_list` VALUES (991, 0, 37, 8, NULL, NULL, '黄老师', NULL, 0.000, '/images/orders/2015_07/2015070106505241/s_0fb4953bd9.jpg', 300.00, 1, NULL, NULL);
INSERT INTO `orders_product_list` VALUES (1015, 88, 41, 5, NULL, NULL, '黄老师', NULL, 0.000, '/images/orders/2015_07/2015070804044574/s_482c78f403.png', 0.01, 1, NULL, NULL);
INSERT INTO `orders_product_list` VALUES (1014, 87, 41, 5, NULL, NULL, '黄老师', NULL, 0.000, '/images/orders/2015_07/2015070804014055/s_482c78f403.png', 0.01, 1, NULL, NULL);
INSERT INTO `orders_product_list` VALUES (1013, 86, 41, 5, NULL, NULL, '黄老师', NULL, 0.000, '/images/orders/2015_07/2015070416551630/s_482c78f403.png', 0.01, 1, NULL, NULL);
INSERT INTO `orders_product_list` VALUES (1012, 85, 41, 5, NULL, NULL, '黄老师', NULL, 0.000, '/images/orders/2015_07/2015070413362335/s_482c78f403.png', 0.01, 1, NULL, NULL);
INSERT INTO `orders_product_list` VALUES (1011, 84, 41, 8, NULL, NULL, '黄老师', NULL, 0.000, '/images/orders/2015_07/2015070407585310/s_31d1675f1f.jpg', 0.01, 1, NULL, NULL);
INSERT INTO `orders_product_list` VALUES (1010, 83, 41, 8, NULL, NULL, '黄老师', NULL, 0.000, '/images/orders/2015_07/2015070317403596/s_31d1675f1f.jpg', 0.01, 1, NULL, NULL);
INSERT INTO `orders_product_list` VALUES (1009, 82, 41, 8, NULL, NULL, '黄老师', NULL, 0.000, '/images/orders/2015_07/2015070317370210/s_31d1675f1f.jpg', 0.01, 1, NULL, NULL);
INSERT INTO `orders_product_list` VALUES (1008, 81, 41, 8, NULL, NULL, '黄老师', NULL, 0.000, '/images/orders/2015_07/2015070317341497/s_31d1675f1f.jpg', 0.01, 1, NULL, NULL);
INSERT INTO `orders_product_list` VALUES (1007, 80, 41, 8, NULL, NULL, '黄老师', NULL, 0.000, '/images/orders/2015_07/2015070317275530/s_31d1675f1f.jpg', 0.01, 1, NULL, NULL);
INSERT INTO `orders_product_list` VALUES (1006, 79, 41, 8, NULL, NULL, '黄老师', NULL, 0.000, '/images/orders/2015_07/2015070317223439/s_31d1675f1f.jpg', 0.01, 1, NULL, NULL);
INSERT INTO `orders_product_list` VALUES (1005, 78, 41, 8, NULL, NULL, '黄老师', NULL, 0.000, '/images/orders/2015_07/2015070316512596/s_31d1675f1f.jpg', 0.01, 1, NULL, NULL);
INSERT INTO `orders_product_list` VALUES (1004, 77, 41, 8, NULL, NULL, '黄老师', NULL, 0.000, '/images/orders/2015_07/2015070316491940/s_31d1675f1f.jpg', 0.01, 1, NULL, NULL);
INSERT INTO `orders_product_list` VALUES (1003, 76, 42, 23, NULL, NULL, '啊老师', NULL, 0.000, '/images/orders/2015_07/2015070314473670/s_fda1a7983a.jpg', 1.00, 1, NULL, NULL);
INSERT INTO `orders_product_list` VALUES (1002, 75, 42, 23, NULL, NULL, '啊老师', NULL, 0.000, '/images/orders/2015_07/2015070314365550/s_fda1a7983a.jpg', 0.00, 1, NULL, NULL);
INSERT INTO `orders_product_list` VALUES (1001, 74, 42, 23, NULL, NULL, '啊老师', NULL, 0.000, '/images/orders/2015_07/2015070314280262/s_fda1a7983a.jpg', 300.00, 1, NULL, NULL);
INSERT INTO `orders_product_list` VALUES (1000, 73, 42, 23, NULL, NULL, '啊老师', NULL, 0.000, '/images/orders/2015_07/2015070314111842/s_fda1a7983a.jpg', 300.00, 1, NULL, NULL);
INSERT INTO `orders_product_list` VALUES (999, 72, 41, 8, NULL, NULL, '黄老师', NULL, 0.000, '/images/orders/2015_07/2015070310313491/s_31d1675f1f.jpg', 300.00, 1, NULL, NULL);
INSERT INTO `orders_product_list` VALUES (998, 71, 37, 8, NULL, NULL, '黄老师', NULL, 0.000, '/images/orders/2015_07/2015070310283725/s_0fb4953bd9.jpg', 300.00, 1, NULL, NULL);
INSERT INTO `orders_product_list` VALUES (997, 70, 41, 8, NULL, NULL, '黄老师', NULL, 0.000, '/images/orders/2015_07/2015070310025063/s_31d1675f1f.jpg', 300.00, 1, NULL, NULL);
INSERT INTO `orders_product_list` VALUES (996, 69, 41, 8, NULL, NULL, '黄老师', NULL, 0.000, '/images/orders/2015_07/2015070308553691/s_31d1675f1f.jpg', 300.00, 1, NULL, NULL);
INSERT INTO `orders_product_list` VALUES (995, 68, 41, 8, NULL, NULL, '黄老师', NULL, 0.000, '/images/orders/2015_07/2015070109365437/s_31d1675f1f.jpg', 300.00, 1, NULL, NULL);
INSERT INTO `orders_product_list` VALUES (993, 66, 39, 5, NULL, NULL, '天天', NULL, 0.000, '/images/orders/2015_07/2015070106574693/s_69bdb1672e.jpg', 2600.00, 1, NULL, NULL);
INSERT INTO `orders_product_list` VALUES (986, 64, 37, 8, NULL, NULL, '黄老师', NULL, 0.000, '/images/orders/2015_06/2015062905560324/s_0fb4953bd9.jpg', 300.00, 0, NULL, NULL);

-- --------------------------------------------------------

-- 
-- 表的结构 `product`
-- 

DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `ProId` mediumint(8) NOT NULL auto_increment,
  `CateId` smallint(5) default '0',
  `Name` varchar(100) default NULL,
  `Title` varchar(30) default '男',
  `ItemNumber` varchar(20) default NULL,
  `Model` varchar(20) default NULL,
  `IsInIndex` tinyint(1) default '0',
  `IsHot` tinyint(1) default '0',
  `IsRecommend` tinyint(1) default '0',
  `IsNew` tinyint(1) default '0',
  `IssueTime` varchar(30) default NULL,
  `SoldOut` tinyint(1) default '0',
  `ColorId` varchar(50) default NULL,
  `CircleId` varchar(50) default '0',
  `SizeId` varchar(50) default NULL,
  `BrandId` smallint(5) default '0',
  `Date` varchar(100) NOT NULL,
  `Stock` smallint(5) default '0',
  `StartFrom` smallint(5) default '0',
  `Weight` decimal(10,3) default '0.000',
  `PicPath_0` varchar(100) default NULL,
  `Alt_0` varchar(100) default NULL,
  `Price_0` decimal(10,2) default '0.00',
  `Price_1` decimal(10,2) default '0.00',
  `IsSpecialOffer` tinyint(1) default '0',
  `SpecialOfferPrice` decimal(10,2) default '0.00',
  `BriefDescription` mediumtext,
  `SeoTitle` varchar(200) default NULL,
  `SeoKeywords` varchar(200) default NULL,
  `SeoDescription` varchar(200) default NULL,
  `PageUrl` varchar(250) default NULL,
  `MyOrder` smallint(5) default '0',
  `AccTime` int(10) default '0',
  `Checktime` int(10) default NULL,
  `MemberId` int(10) default NULL,
  `Degree` tinyint(2) default NULL,
  `Identity` tinyint(2) default NULL,
  `Certification` tinyint(2) default NULL,
  `Video` varchar(160) default NULL,
  PRIMARY KEY  (`ProId`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 AUTO_INCREMENT=43 ;

-- 
-- 导出表中的数据 `product`
-- 

INSERT INTO `product` VALUES (37, 8, '黄老师', '男', '', '', 0, 0, 0, 0, '2015-10-1', 0, '1', '0', '||', 0, '|1|2|7|10|18|20|', 0, 1, 0.000, '/u_file/face/70_01/01/s_0fb4953bd9.jpg', '', 400.00, 300.00, 0, 0.00, '', '', '', '', '/product/1/8/37.html', 0, 1435536000, NULL, 27, 0, 0, 0, 'http://player.youku.com/player.php/Type/Folder/Fid/23804650/Ob/1/sid/XOTU4NDkzMTY0/v.swf');
INSERT INTO `product` VALUES (39, 5, '天天', '女', '', '', 0, 0, 0, 0, '2015-10-30', 0, '2', '0', '||', 0, '|1|3|7|8|9|11|12|15|17|18|', 0, 1, 0.000, '/u_file/face/70_01/01/s_69bdb1672e.jpg', '', 2800.00, 2600.00, 0, 0.00, '', '', '', '', '/product/1/5/39.html', 0, 1435708800, NULL, 35, 1, 1, 1, 'http://player.youku.com/player.php/Type/Folder/Fid/23804650/Ob/1/sid/XOTU4NDkzMTY0/v.swf');
INSERT INTO `product` VALUES (40, 23, 'willer123', '女', '', '', 0, 0, 0, 0, '2015-10-22', 1, '2', '0', '||', 0, '|2|3|9|10|11|12|16|', 0, 1, 0.000, '/u_file/face/70_01/01/s_bc6f49d67b.jpg', '', 1800.00, 1600.00, 0, 0.00, '', '', '', '', '/product/9/23/willer123-40.html', 0, 1435708800, NULL, 36, 0, 0, 0, 'http://player.youku.com/player.php/Type/Folder/Fid/23804650/Ob/1/sid/XOTU4NDkzMTY0/v.swf');
INSERT INTO `product` VALUES (41, 5, '黄老师', '男', '', '', 0, 0, 0, 0, '2015-06-12', 0, '1', '18', '||', 0, '|1|2|3|6|8|10|11|13|18|19|', 0, 1, 0.000, '/u_file/face/70_01/01/s_482c78f403.png', '', 800.00, 0.01, 0, 0.00, '', '', '', '', '/product/1/5/41.html', 0, 1436313600, NULL, 37, 0, 0, 0, 'http://player.youku.com/player.php/Type/Folder/Fid/23804650/Ob/1/sid/XOTU4NDkzMTY0/v.swf');
INSERT INTO `product` VALUES (42, 23, '啊老师', '男', '', '', 0, 0, 0, 0, '2015-10-1', 1, '1', '18', '||', 0, '|1|2|8|9|', 0, 1, 0.000, '/u_file/face/70_01/01/s_fda1a7983a.jpg', '', 500.00, 1.00, 0, 0.00, '', '', '', '', '/product/9/23/42.html', 0, 1436313600, NULL, 41, 0, 0, 0, '');

-- --------------------------------------------------------

-- 
-- 表的结构 `product_brand`
-- 

DROP TABLE IF EXISTS `product_brand`;
CREATE TABLE `product_brand` (
  `BId` smallint(5) NOT NULL auto_increment,
  `Brand` varchar(50) default NULL,
  `LogoPath` varchar(100) default NULL,
  `SeoTitle` varchar(200) default NULL,
  `SeoKeywords` varchar(200) default NULL,
  `SeoDescription` varchar(200) default NULL,
  `PageUrl` varchar(250) default NULL,
  `MyOrder` smallint(5) default '0',
  PRIMARY KEY  (`BId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `product_brand`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `product_brand_description`
-- 

DROP TABLE IF EXISTS `product_brand_description`;
CREATE TABLE `product_brand_description` (
  `DId` smallint(5) NOT NULL auto_increment,
  `BId` smallint(5) default '0',
  `Description` text,
  PRIMARY KEY  (`DId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `product_brand_description`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `product_category`
-- 

DROP TABLE IF EXISTS `product_category`;
CREATE TABLE `product_category` (
  `CateId` smallint(5) NOT NULL auto_increment,
  `Category` varchar(50) default NULL,
  `UId` varchar(50) default NULL,
  `PicPath` varchar(100) default NULL,
  `SeoTitle` varchar(200) default NULL,
  `SeoKeywords` varchar(200) default NULL,
  `SeoDescription` varchar(200) default NULL,
  `Dept` tinyint(2) default '1',
  `BriefDescription` varchar(240) default NULL,
  `SubCate` smallint(5) default '0',
  `PageUrl` varchar(250) default NULL,
  `MyOrder` smallint(5) default '0',
  `IsInIndex` int(1) default '0',
  `IsNav` tinyint(2) default '0',
  PRIMARY KEY  (`CateId`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

-- 
-- 导出表中的数据 `product_category`
-- 

INSERT INTO `product_category` VALUES (1, '民族乐器', '0,', '', '民族乐器', '民族乐器', '民族乐器', 1, NULL, 13, '/product/1/', 0, 1, 1);
INSERT INTO `product_category` VALUES (2, '西洋乐器', '0,', '', '西洋乐器', '西洋乐器', '西洋乐器', 1, NULL, 4, '/product/2/', 0, 1, 1);
INSERT INTO `product_category` VALUES (3, '声  乐', '0,', '', '声  乐', '声  乐', '声  乐', 1, NULL, 2, '/product/3/', 0, 1, 1);
INSERT INTO `product_category` VALUES (4, '舞  蹈', '0,', '', '舞  蹈', '舞  蹈', '舞  蹈', 1, NULL, 2, '/product/4/', 0, 1, 1);
INSERT INTO `product_category` VALUES (5, '二胡', '0,1,', '/u_file/product/15_05_04/s_983cb8aa1b.jpg', '二胡', '二胡', '二胡', 2, '丰富的早期音乐体验可以帮助宝宝在很多方面的学习上的成功，当孩子演奏乐器或聆听音乐时，大脑在尝试着处理对音调和节奏的', 0, '/product/1/5/', 0, 0, 0);
INSERT INTO `product_category` VALUES (6, '长笛', '0,1,', '/u_file/product/15_05_04/s_583d5fccbe.gif', '长笛', '长笛', '长笛', 2, '丰富的早期音乐体验可以帮助宝宝在很多方面的学习上的成功，当孩子演奏乐器或聆听音乐时，大脑在尝试着处理对音调和节奏的', 0, '/product/1/6/', 0, 0, 0);
INSERT INTO `product_category` VALUES (7, '短箫', '0,1,', '/u_file/product/15_05_04/s_10ea7af5ce.jpg', '短箫', '短箫', '短箫', 2, '丰富的早期音乐体验可以帮助宝宝在很多方面的学习上的成功，当孩子演奏乐器或聆听音乐时，大脑在尝试着处理对音调和节奏的', 0, '/product/1/7/', 0, 0, 0);
INSERT INTO `product_category` VALUES (8, '金属口弦', '0,1,', '/u_file/product/15_05_04/s_9d731112d0.jpg', '金属口弦', '金属口弦', '金属口弦', 2, '丰富的早期音乐体验可以帮助宝宝在很多方面的学习上的成功，当孩子演奏乐器或聆听音乐时，大脑在尝试着处理对音调和节奏的', 0, '/product/1/8/', 0, 0, 0);
INSERT INTO `product_category` VALUES (9, '乐  理', '0,', '', '乐  理', '乐  理', '乐  理', 1, NULL, 2, '/product/9/', 0, 0, 1);
INSERT INTO `product_category` VALUES (10, '云锣', '0,1,', '', '云锣', '云锣', '云锣', 2, NULL, 0, '/product/1/10/', 0, 0, 0);
INSERT INTO `product_category` VALUES (11, '琵琶', '0,1,', '', '琵琶', '琵琶', '琵琶', 2, NULL, 0, '/product/1/11/', 0, 0, 0);
INSERT INTO `product_category` VALUES (12, '月琴', '0,1,', '', '月琴', '月琴', '月琴', 2, NULL, 0, '/product/1/12/', 0, 0, 0);
INSERT INTO `product_category` VALUES (13, '象脚鼓', '0,1,', '', '象脚鼓', '象脚鼓', '象脚鼓', 2, NULL, 0, '/product/1/13/', 0, 0, 0);
INSERT INTO `product_category` VALUES (14, '冬不拉', '0,1,', '', '冬不拉', '冬不拉', '冬不拉', 2, NULL, 0, '/product/1/14/', 0, 0, 0);
INSERT INTO `product_category` VALUES (15, '侗笛', '0,1,', '', '侗笛', '侗笛', '侗笛', 2, NULL, 0, '/product/1/15/', 0, 0, 0);
INSERT INTO `product_category` VALUES (16, '板胡', '0,1,', '', '板胡', '板胡', '板胡', 2, NULL, 0, '/product/1/16/', 0, 0, 0);
INSERT INTO `product_category` VALUES (17, '编钟', '0,1,', '', '编钟', '编钟', '编钟', 2, NULL, 0, '/product/1/17/', 0, 0, 0);
INSERT INTO `product_category` VALUES (18, '电子琴', '0,2,', '/u_file/product/15_05_04/s_2affd0e779.jpg', '', '', '', 2, '丰富的早期音乐体验可以帮助宝宝在很多方面的学习上的成功，当孩子演奏乐器或聆听音乐时，大脑在尝试着处理对音调和节奏的', 0, '/product/2/18/', 0, 0, 0);
INSERT INTO `product_category` VALUES (19, '手拉琴', '0,2,', '/u_file/product/15_05_04/s_8a09a6fbdc.jpg', '手拉琴', '手拉琴', '手拉琴', 2, '丰富的早期音乐体验可以帮助宝宝在很多方面的学习上的成功，当孩子演奏乐器或聆听音乐时，大脑在尝试着处理对音调和节奏的', 0, '/product/2/19/', 0, 0, 0);
INSERT INTO `product_category` VALUES (20, '手提琴', '0,2,', '/u_file/product/15_05_04/s_c96861c340.jpg', '手提琴', '手提琴', '手提琴', 2, '丰富的早期音乐体验可以帮助宝宝在很多方面的学习上的成功，当孩子演奏乐器或聆听音乐时，大脑在尝试着处理对音调和节奏的', 0, '/product/2/20/', 0, 0, 0);
INSERT INTO `product_category` VALUES (21, '大提琴', '0,2,', '/u_file/product/15_05_04/s_ac62ff0619.jpg', '大提琴', '大提琴', '大提琴', 2, '丰富的早期音乐体验可以帮助宝宝在很多方面的学习上的成功，当孩子演奏乐器或聆听音乐时，大脑在尝试着处理对音调和节奏的', 0, '/product/2/21/', 0, 0, 0);
INSERT INTO `product_category` VALUES (22, '吉他乐理', '0,9,', '/u_file/product/15_05_04/s_63bfd2182b.jpg', '', '', '', 2, '', 0, '/product/9/22/', 0, 0, 0);
INSERT INTO `product_category` VALUES (23, '吉他技巧', '0,9,', '/u_file/product/15_05_04/s_c4b9a7fa9c.jpg', '', '', '', 2, '', 0, '/product/9/23/', 0, 0, 0);
INSERT INTO `product_category` VALUES (24, '长号', '0,1,', '', '', '', '', 2, NULL, 0, '/product/1/24/', 0, 0, 0);
INSERT INTO `product_category` VALUES (25, '二胡', '0,3,', '/u_file/product/15_05_04/s_6a085fe70e.jpg', '', '', '', 2, '', 0, '/product/3/25/', 0, 0, 0);
INSERT INTO `product_category` VALUES (26, '吉他', '0,3,', '/u_file/product/15_05_04/s_7d94f69d5b.jpg', '', '', '', 2, '', 0, '/product/3/26/', 0, 0, 0);
INSERT INTO `product_category` VALUES (27, '二胡', '0,4,', '/u_file/product/15_05_04/s_5fb7b86bd3.jpg', '', '', '', 2, '', 0, '/product/4/27/', 0, 0, 0);
INSERT INTO `product_category` VALUES (28, '吉他', '0,4,', '/u_file/product/15_05_04/s_ff6d222b21.jpg', '', '', '', 2, '', 0, '/product/4/28/', 0, 0, 0);

-- --------------------------------------------------------

-- 
-- 表的结构 `product_category_description`
-- 

DROP TABLE IF EXISTS `product_category_description`;
CREATE TABLE `product_category_description` (
  `DId` smallint(5) NOT NULL auto_increment,
  `CateId` smallint(5) default '0',
  `Description` text,
  `Description_lang_1` text,
  PRIMARY KEY  (`DId`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

-- 
-- 导出表中的数据 `product_category_description`
-- 

INSERT INTO `product_category_description` VALUES (1, 1, '', NULL);
INSERT INTO `product_category_description` VALUES (2, 2, '', NULL);
INSERT INTO `product_category_description` VALUES (3, 3, '', NULL);
INSERT INTO `product_category_description` VALUES (4, 4, '', NULL);
INSERT INTO `product_category_description` VALUES (5, 5, '', NULL);
INSERT INTO `product_category_description` VALUES (6, 6, '', NULL);
INSERT INTO `product_category_description` VALUES (7, 7, '', NULL);
INSERT INTO `product_category_description` VALUES (8, 8, '', NULL);
INSERT INTO `product_category_description` VALUES (9, 9, '', NULL);
INSERT INTO `product_category_description` VALUES (10, 10, '', NULL);
INSERT INTO `product_category_description` VALUES (11, 11, '', NULL);
INSERT INTO `product_category_description` VALUES (12, 12, '', NULL);
INSERT INTO `product_category_description` VALUES (13, 13, '', NULL);
INSERT INTO `product_category_description` VALUES (14, 14, '', NULL);
INSERT INTO `product_category_description` VALUES (15, 15, '', NULL);
INSERT INTO `product_category_description` VALUES (16, 16, '', NULL);
INSERT INTO `product_category_description` VALUES (17, 17, '', NULL);
INSERT INTO `product_category_description` VALUES (18, 18, '', NULL);
INSERT INTO `product_category_description` VALUES (19, 19, '', NULL);
INSERT INTO `product_category_description` VALUES (20, 20, '', NULL);
INSERT INTO `product_category_description` VALUES (21, 21, '', NULL);
INSERT INTO `product_category_description` VALUES (22, 22, '', NULL);
INSERT INTO `product_category_description` VALUES (23, 23, '', NULL);
INSERT INTO `product_category_description` VALUES (24, 24, '', NULL);
INSERT INTO `product_category_description` VALUES (25, 25, '', NULL);
INSERT INTO `product_category_description` VALUES (26, 26, '', NULL);
INSERT INTO `product_category_description` VALUES (27, 27, '', NULL);
INSERT INTO `product_category_description` VALUES (28, 28, '', NULL);

-- --------------------------------------------------------

-- 
-- 表的结构 `product_circle`
-- 

DROP TABLE IF EXISTS `product_circle`;
CREATE TABLE `product_circle` (
  `CId` tinyint(2) NOT NULL auto_increment,
  `Circle` varchar(50) default NULL,
  `PicPath` varchar(100) default NULL,
  `MyOrder` tinyint(2) default '0',
  PRIMARY KEY  (`CId`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

-- 
-- 导出表中的数据 `product_circle`
-- 

INSERT INTO `product_circle` VALUES (18, '商圈1', '', 0);
INSERT INTO `product_circle` VALUES (19, '商圈2', '', 0);
INSERT INTO `product_circle` VALUES (20, '商圈3', '', 0);

-- --------------------------------------------------------

-- 
-- 表的结构 `product_color`
-- 

DROP TABLE IF EXISTS `product_color`;
CREATE TABLE `product_color` (
  `CId` tinyint(2) NOT NULL auto_increment,
  `Color` varchar(50) default NULL,
  `PicPath` varchar(100) default NULL,
  `MyOrder` tinyint(2) default '0',
  PRIMARY KEY  (`CId`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

-- 
-- 导出表中的数据 `product_color`
-- 

INSERT INTO `product_color` VALUES (1, '广州市', '', 0);
INSERT INTO `product_color` VALUES (2, '深圳市', '', 0);
INSERT INTO `product_color` VALUES (3, '珠海市', '', 0);
INSERT INTO `product_color` VALUES (4, '汕头市', '', 0);
INSERT INTO `product_color` VALUES (6, '韶关市', '', 0);
INSERT INTO `product_color` VALUES (7, '河源市', '', 0);
INSERT INTO `product_color` VALUES (8, '惠州市', '', 0);
INSERT INTO `product_color` VALUES (9, '东莞市', '', 0);
INSERT INTO `product_color` VALUES (10, '中山市', '', 0);
INSERT INTO `product_color` VALUES (11, '佛山市', '', 0);
INSERT INTO `product_color` VALUES (12, '江门市', '', 0);
INSERT INTO `product_color` VALUES (13, '阳江市', '', 0);
INSERT INTO `product_color` VALUES (14, '湛江市', '', 0);
INSERT INTO `product_color` VALUES (15, '茂名市', '', 0);
INSERT INTO `product_color` VALUES (16, '肇庆市', '', 0);
INSERT INTO `product_color` VALUES (17, '清远市', '', 0);

-- --------------------------------------------------------

-- 
-- 表的结构 `product_description`
-- 

DROP TABLE IF EXISTS `product_description`;
CREATE TABLE `product_description` (
  `DId` mediumint(8) NOT NULL auto_increment,
  `ProId` mediumint(8) default '0',
  `Description` text,
  `Description_lang_1` text,
  PRIMARY KEY  (`DId`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

-- 
-- 导出表中的数据 `product_description`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `product_ext`
-- 

DROP TABLE IF EXISTS `product_ext`;
CREATE TABLE `product_ext` (
  `EId` mediumint(8) NOT NULL auto_increment,
  `ProId` mediumint(8) default '0',
  `Warranty0` text,
  `Warranty1` text,
  `Warranty2` text,
  `Warranty3` text,
  `Volume` varchar(100) default NULL,
  `T_age` varchar(100) default NULL,
  `P_age` varchar(100) default NULL,
  `Applicable` varchar(100) default NULL,
  `S_0` varchar(100) default NULL,
  `S_1` varchar(100) default NULL,
  `S_2` varchar(100) default NULL,
  `S_3` varchar(100) default NULL,
  `Warranty4` varchar(255) default NULL,
  PRIMARY KEY  (`EId`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 AUTO_INCREMENT=43 ;

-- 
-- 导出表中的数据 `product_ext`
-- 

INSERT INTO `product_ext` VALUES (22, 0, '路过的', '酱油测试', '酱油测试\r\n酱油测试', '酱油测试\r\n酱油测试', NULL, '7', NULL, '保密', NULL, NULL, NULL, NULL, '酱油测试\r\n酱油测试\r\n酱油测试');
INSERT INTO `product_ext` VALUES (34, 34, '认真，负责', '认真，负责', '认真，负责', '认真，负责', '幽默', '10', '26', '男', '100', '88', '', '99', '认真，负责');
INSERT INTO `product_ext` VALUES (32, 32, '路过的', '酱油测试', '酱油测试\r\n酱油测试', '酱油测试\r\n酱油测试', '激动，活力', '7', '', '保密', '100', '88', '25', '99', '酱油测试\r\n酱油测试\r\n酱油测试');
INSERT INTO `product_ext` VALUES (33, 33, '路过的', '酱油测试', '酱油测试\r\n酱油测试', '酱油测试\r\n酱油测试', '激动，活力', '7', '23', '保密', '100', '88', '50', '99', '酱油测试\r\n酱油测试\r\n酱油测试');
INSERT INTO `product_ext` VALUES (37, 37, '认真，负责', '认真，负责', '认真，负责', '认真，负责', '幽默', '10', '26', '男', '100', '88', '', '99', '认真，负责');
INSERT INTO `product_ext` VALUES (39, 39, '天天向上', '还是大家咖啡', '还是大家咖啡', '还是大家咖啡', '细心，认真，活力', '12', '23', '男', '100', '88', '', '99', '还是大家咖啡');
INSERT INTO `product_ext` VALUES (40, 40, '路过的', '激动，活力', '激动，活力', '激动，活力', '激动，活力', '3', '30', '男', '100', '88', '', '99', '激动，活力');
INSERT INTO `product_ext` VALUES (41, 41, '认真 努力', '认真 努力', '认真 努力', '认真 努力', '认真 努力', '4', '25', '男', '100', '88', '', '99', '认真 努力');
INSERT INTO `product_ext` VALUES (42, 42, '额特殊他', '额特殊他', '酱油测试 酱油测试', '酱油测试 额特殊他', '45', '17', '5', '男', '100', '88', '', '99', '额特殊他');

-- --------------------------------------------------------

-- 
-- 表的结构 `product_inquire`
-- 

DROP TABLE IF EXISTS `product_inquire`;
CREATE TABLE `product_inquire` (
  `IId` mediumint(8) NOT NULL auto_increment,
  `ProId` varchar(100) default NULL,
  `FirstName` varchar(25) default NULL,
  `LastName` varchar(25) default NULL,
  `Email` varchar(100) default NULL,
  `Address` varchar(200) default NULL,
  `Area` varchar(50) default NULL,
  `City` varchar(50) default NULL,
  `State` varchar(50) default NULL,
  `Country` varchar(50) default NULL,
  `PostalCode` varchar(10) default NULL,
  `Phone` varchar(20) default NULL,
  `Fax` varchar(20) default NULL,
  `Subject` varchar(100) default NULL,
  `Message` text,
  `Ip` varchar(15) default NULL,
  `PostTime` int(10) default '0',
  `IsRead` tinyint(1) default '0',
  PRIMARY KEY  (`IId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `product_inquire`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `product_review`
-- 

DROP TABLE IF EXISTS `product_review`;
CREATE TABLE `product_review` (
  `RId` mediumint(8) NOT NULL auto_increment,
  `ProId` mediumint(8) default '0',
  `FullName` varchar(50) default NULL,
  `Email` varchar(100) default NULL,
  `Rating` tinyint(1) default '5',
  `Contents` text,
  `Phone` varchar(30) default NULL,
  `Ip` varchar(15) default NULL,
  `Reply` text,
  `ReplyTime` int(10) default '0',
  `Display` tinyint(1) default '0',
  `PostTime` int(10) default '0',
  `Review_Level` tinyint(3) default NULL,
  `ID` varchar(30) NOT NULL,
  PRIMARY KEY  (`RId`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

-- 
-- 导出表中的数据 `product_review`
-- 

INSERT INTO `product_review` VALUES (25, 41, '学生家长1', NULL, 5, '123123', '15013059003', '163.179.244.46', NULL, 0, 0, 1435960401, 5, '28');
INSERT INTO `product_review` VALUES (26, 41, '学生家长1', NULL, 5, '123123', '15013059003', '163.179.244.46', NULL, 0, 0, 1435960404, 5, '28');
INSERT INTO `product_review` VALUES (27, 41, '学生家长1', NULL, 5, '而是天天', '15013059003', '163.179.244.46', NULL, 0, 0, 1435960788, 2, '28');
INSERT INTO `product_review` VALUES (24, 41, '学生家长1', NULL, 5, '123123', '15013059003', '163.179.244.46', NULL, 0, 0, 1435960392, 5, '28');

-- --------------------------------------------------------

-- 
-- 表的结构 `product_size`
-- 

DROP TABLE IF EXISTS `product_size`;
CREATE TABLE `product_size` (
  `SId` tinyint(2) NOT NULL auto_increment,
  `Size` varchar(50) default NULL,
  `MyOrder` tinyint(2) default '0',
  PRIMARY KEY  (`SId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `product_size`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `product_two_review`
-- 

DROP TABLE IF EXISTS `product_two_review`;
CREATE TABLE `product_two_review` (
  `RId` mediumint(8) NOT NULL auto_increment,
  `ProId` mediumint(8) default '0',
  `FullName` varchar(50) default NULL,
  `Email` varchar(100) default NULL,
  `Rating` tinyint(1) default '5',
  `Contents` text,
  `Phone` varchar(30) default NULL,
  `Ip` varchar(15) default NULL,
  `Reply` text,
  `ReplyTime` int(10) default '0',
  `Display` tinyint(1) default '0',
  `PostTime` int(10) default '0',
  `Review_Level` tinyint(3) default NULL,
  `ID` varchar(30) NOT NULL,
  PRIMARY KEY  (`RId`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- 
-- 导出表中的数据 `product_two_review`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `product_wholesale_class`
-- 

DROP TABLE IF EXISTS `product_wholesale_class`;
CREATE TABLE `product_wholesale_class` (
  `PId` mediumint(8) NOT NULL auto_increment,
  `ProId` mediumint(8) default '0',
  `Issue_D` varchar(10) default '0',
  `Issue_T` varchar(12) default NULL,
  `Issue_L` varchar(10) default NULL,
  PRIMARY KEY  (`PId`)
) ENGINE=MyISAM AUTO_INCREMENT=108 DEFAULT CHARSET=utf8 AUTO_INCREMENT=108 ;

-- 
-- 导出表中的数据 `product_wholesale_class`
-- 

INSERT INTO `product_wholesale_class` VALUES (107, 33, '3', '2', '5');
INSERT INTO `product_wholesale_class` VALUES (106, 33, '1', '1', '5');
INSERT INTO `product_wholesale_class` VALUES (105, 33, '3', '2', '5');
INSERT INTO `product_wholesale_class` VALUES (104, 33, '1', '3', '5');
INSERT INTO `product_wholesale_class` VALUES (103, 33, '1', '2', '5');
INSERT INTO `product_wholesale_class` VALUES (102, 33, '1', '2', '5');
INSERT INTO `product_wholesale_class` VALUES (101, 33, '1', '3', '5');
INSERT INTO `product_wholesale_class` VALUES (100, 33, '2', '2', '5');
INSERT INTO `product_wholesale_class` VALUES (99, 33, '2', '1', '5');

-- --------------------------------------------------------

-- 
-- 表的结构 `product_wholesale_price`
-- 

DROP TABLE IF EXISTS `product_wholesale_price`;
CREATE TABLE `product_wholesale_price` (
  `PId` mediumint(8) NOT NULL auto_increment,
  `ProId` mediumint(8) default '0',
  `Qty` smallint(5) default '0',
  `Price` decimal(10,2) default '0.00',
  PRIMARY KEY  (`PId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `product_wholesale_price`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `search_keyword`
-- 

DROP TABLE IF EXISTS `search_keyword`;
CREATE TABLE `search_keyword` (
  `KId` smallint(5) NOT NULL auto_increment,
  `Keyword` varchar(50) default NULL,
  `Language` varchar(10) default NULL,
  `MyOrder` smallint(5) default '0',
  PRIMARY KEY  (`KId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- 
-- 导出表中的数据 `search_keyword`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `shopping_cart`
-- 

DROP TABLE IF EXISTS `shopping_cart`;
CREATE TABLE `shopping_cart` (
  `CId` mediumint(8) NOT NULL auto_increment,
  `MemberId` mediumint(8) default '0',
  `SessionId` varchar(10) default NULL,
  `ProId` mediumint(8) default '0',
  `CateId` smallint(5) default '0',
  `StartFrom` smallint(5) default '0',
  `Color` varchar(50) default NULL,
  `Size` varchar(50) default NULL,
  `Name` varchar(100) default NULL,
  `ItemNumber` varchar(20) default NULL,
  `PicPath` varchar(100) default NULL,
  `Price` decimal(10,2) default '0.00',
  `Qty` smallint(5) default '0',
  `Url` varchar(200) default NULL,
  `OrderStatus` tinyint(2) default '1',
  `Remark` varchar(100) default NULL,
  `AddTime` int(10) default '0',
  `AllTime` int(8) default NULL,
  PRIMARY KEY  (`CId`)
) ENGINE=MyISAM AUTO_INCREMENT=214 DEFAULT CHARSET=utf8 AUTO_INCREMENT=214 ;

-- 
-- 导出表中的数据 `shopping_cart`
-- 


-- --------------------------------------------------------

-- 
-- 表的结构 `survey`
-- 

DROP TABLE IF EXISTS `survey`;
CREATE TABLE `survey` (
  `SId` smallint(5) NOT NULL auto_increment,
  `Subject` varchar(100) default NULL,
  `Language` tinyint(1) NOT NULL default '0',
  `MyOrder` smallint(5) default '0',
  PRIMARY KEY  (`SId`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- 导出表中的数据 `survey`
-- 

INSERT INTO `survey` VALUES (1, '您是从何处得知本网站的？', 0, 0);

-- --------------------------------------------------------

-- 
-- 表的结构 `survey_item`
-- 

DROP TABLE IF EXISTS `survey_item`;
CREATE TABLE `survey_item` (
  `IId` tinyint(5) NOT NULL auto_increment,
  `SId` tinyint(5) default '0',
  `ItemTitle` varchar(100) default NULL,
  `VotesCount` mediumint(8) default '0',
  PRIMARY KEY  (`IId`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- 
-- 导出表中的数据 `survey_item`
-- 

INSERT INTO `survey_item` VALUES (1, 1, '朋友介绍', 8);
INSERT INTO `survey_item` VALUES (2, 1, '电视广告', 12);
INSERT INTO `survey_item` VALUES (3, 1, '百度搜索', 14);
INSERT INTO `survey_item` VALUES (4, 1, 'Google搜索', 9);
INSERT INTO `survey_item` VALUES (5, 1, '无意中点进来', 2);

-- --------------------------------------------------------

-- 
-- 表的结构 `translate`
-- 

DROP TABLE IF EXISTS `translate`;
CREATE TABLE `translate` (
  `LId` smallint(5) NOT NULL auto_increment,
  `Name` varchar(50) default NULL,
  `Url` varchar(200) default NULL,
  `LogoPath` varchar(100) default NULL,
  `Language` varchar(10) default NULL,
  `MyOrder` smallint(5) default '0',
  PRIMARY KEY  (`LId`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- 
-- 导出表中的数据 `translate`
-- 

INSERT INTO `translate` VALUES (1, 'Deutsch', 'http://translate.google.com.hk/translate?hl=zh-CN&sl=en&tl=de&u=http://www.ly200.com', '/u_file/translate/12_02_14/s_ef22f59995.jpg', '', 0);
INSERT INTO `translate` VALUES (2, 'Italiano', 'http://translate.google.com.hk/translate?hl=zh-CN&sl=en&tl=it&u=http://www.ly200.com', '/u_file/translate/12_02_14/s_b89e604667.jpg', '', 0);
INSERT INTO `translate` VALUES (3, 'Dansk', 'http://translate.google.com.hk/translate?hl=zh-CN&sl=en&tl=da&u=http://www.ly200.com', '/u_file/translate/12_02_14/s_04dc696139.jpg', '', 0);
INSERT INTO `translate` VALUES (4, 'Nederlands', 'http://translate.google.com.hk/translate?hl=zh-CN&sl=en&tl=nl&u=http://www.ly200.com', '/u_file/translate/12_02_14/s_c9d5989165.jpg', '', 0);

-- --------------------------------------------------------

-- 
-- 表的结构 `userinfo`
-- 

DROP TABLE IF EXISTS `userinfo`;
CREATE TABLE `userinfo` (
  `UserId` smallint(5) NOT NULL auto_increment,
  `UserName` varchar(16) default NULL,
  `Password` varchar(32) default NULL,
  `LastLoginTime` int(10) default '0',
  `LastLoginIp` varchar(15) default NULL,
  `Locked` tinyint(1) default '0',
  `GroupId` tinyint(1) default '2',
  PRIMARY KEY  (`UserId`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=2 ;

-- 
-- 导出表中的数据 `userinfo`
-- 

INSERT INTO `userinfo` VALUES (1, 'lywebsite', '40a0dde983b71b64fb75d86d36975cc3', 1436351486, '59.42.115.243', 0, 1);

-- --------------------------------------------------------

-- 
-- 表的结构 `wish_lists`
-- 

DROP TABLE IF EXISTS `wish_lists`;
CREATE TABLE `wish_lists` (
  `WId` mediumint(8) NOT NULL auto_increment,
  `MemberId` mediumint(8) default '0',
  `ProId` mediumint(8) default '0',
  `Category` varchar(150) default NULL,
  `WishTime` int(10) default '0',
  PRIMARY KEY  (`WId`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

-- 
-- 导出表中的数据 `wish_lists`
-- 

INSERT INTO `wish_lists` VALUES (11, 9, 31, NULL, 1432103416);
INSERT INTO `wish_lists` VALUES (12, 10, 31, NULL, 1433665241);
INSERT INTO `wish_lists` VALUES (16, 8, 33, NULL, 1435112508);
INSERT INTO `wish_lists` VALUES (17, 28, 41, NULL, 1435745917);
