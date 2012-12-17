/*
Navicat MySQL Data Transfer

Source Server         : localhost_pkuss
Source Server Version : 50515
Source Host           : localhost:3306
Source Database       : pkucxcy

Target Server Type    : MYSQL
Target Server Version : 50515
File Encoding         : 65001

Date: 2012-12-18 00:08:49
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `activities`
-- ----------------------------
DROP TABLE IF EXISTS `activities`;
CREATE TABLE `activities` (
  `activityid` int(11) NOT NULL AUTO_INCREMENT,
  `activitysubject` varchar(100) DEFAULT NULL,
  `starttime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `endtime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `applydeadline` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `createtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `activitycontent` text,
  `activitytype` int(11) DEFAULT NULL,
  `attachmentpath` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`activityid`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of activities
-- ----------------------------
INSERT INTO `activities` VALUES ('17', '国际交流活动新闻测试1', '2012-11-17 16:26:37', '2012-11-17 16:26:37', '2012-11-17 16:26:37', '2012-10-12 23:56:20', '<p>\r\n	asdfasdfasdfasdfasd</p>\r\n', '91', 'app_detect_result_warning.png###17.activity');
INSERT INTO `activities` VALUES ('20', '学生创新创业系列赛事', '2012-11-23 01:56:33', '2012-11-23 01:56:37', '2012-11-22 01:56:35', '2012-11-25 01:56:29', '<h3 style=\"color:blue;\">\r\n	&nbsp;</h3>\r\n<div id=\"right_center_txt_name\" style=\"width: 547px; height: 70px; line-height: 80px; background-image: url(http://www.cxcyds.com/images/bjtp_03.gif); margin-left: auto; margin-right: auto; border: 0px; text-align: center; color: rgb(51, 51, 51); font-size: 16px; font-family: 微软雅黑, tahoma, arial, sans-serif; font-weight: normal; background-position: 0% 100%; background-repeat: no-repeat no-repeat;\">\r\n	<h3 style=\"color:blue;\">\r\n		<b>大赛目的&nbsp;</b></h3>\r\n</div>\r\n<div style=\"color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-weight: normal; line-height: 25px;\">\r\n	<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 整合创新创业要素，搭建为科技型中小企业服务的平台，引导更广泛的社会资源支持创新创业，促进科技型中小企业创新发展。</p>\r\n	<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n		（一）提升创新创业水平。通过促进科技创新和成果转化，培育高水平、高层次、高素质的创业团队和具有核心创新能力的高成长性战略性新兴产业源头企业，提升新时期创新创业水平。</p>\r\n	<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n		（二）营造创新创业氛围。激发全民创新创业精神，吸纳优秀创新创业人才，营造&ldquo;鼓励创新、支持创业&rdquo;的氛围，在全社会掀起创新创业的高潮，为建设创新型国家奠定坚实的基础。</p>\r\n	<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n		（三）弘扬创新创业文化。探索科技与文化的结合，充分利用电视、新媒体等互动方式，宣传创新创业人物，树立创新创业品牌，让更多的人了解和参与创新创业，带动就业。</p>\r\n	<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n		（四）促进科技和金融结合。发挥政府引导作用，利用市场机制，聚集各种创新资源，吸纳包括银行、创业投资机构在内的社会各方力量广泛参与对科技型中小企业的投入，为创新创业团队和企业搭建融资服务平台，促进中小企业的创新发展。</p>\r\n	<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n		&nbsp;</p>\r\n	<div id=\"right_center_txt_name\" style=\"width: 547px; height: 70px; line-height: 80px; background-image: url(http://www.cxcyds.com/images/bjtp_03.gif); margin-left: auto; margin-right: auto; border: 0px; text-align: center; font-size: 16px; background-position: 0% 100%; background-repeat: no-repeat no-repeat;\">\r\n		<b>组织机构</b></div>\r\n	<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n		<strong>指导单位</strong></p>\r\n	<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n		中华人民共和国科学技术部</p>\r\n	<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n		中华人民共和国教育部</p>\r\n	<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n		中华人民共和国财政部</p>\r\n	<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n		中华全国工商业联合会</p>\r\n	<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n		&nbsp;</p>\r\n	<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n		<strong>支持单位</strong></p>\r\n	<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n		中国共产主义青年团中央委员会</p>\r\n	<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n		中国致公党中央委员会</p>\r\n	<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n		中华人民共和国国家外国专家局</p>\r\n	<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n		&nbsp;</p>\r\n	<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n		<strong>承办单位</strong></p>\r\n	<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n		科技部火炬高技术产业开发中心</p>\r\n	<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n		科技部科技型中小企业技术创新基金管理中心</p>\r\n	<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n		科技日报社</p>\r\n	<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n		陕西省现代科技创业基金会</p>\r\n	<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n		&nbsp;</p>\r\n	<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n		<strong>分赛区承办单位</strong></p>\r\n	<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n		深圳市人民政府</p>\r\n	<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n		中关村科技园区管委会</p>\r\n	<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n		宁波国家高新技术产业开发区管委会</p>\r\n	<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n		成都高新技术产业开发区管委会</p>\r\n	<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n		上海市大学生科技创业基金会</p>\r\n	<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n		&nbsp;</p>\r\n	<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n		<strong>协办单位</strong></p>\r\n	<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n		中国高新技术产业开发区协会</p>\r\n	<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n		中国技术创业协会</p>\r\n	<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n		国家科技风险开发事业中心</p>\r\n	<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n		各省、自治区、直辖市、计划单列市科技厅（委、局）、新疆生产建设兵团科技局</p>\r\n	<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n		各有关国家高新技术产业开发区</p>\r\n	<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n		深圳证券交易所</p>\r\n	<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n		上海联合产权交易所</p>\r\n	<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n		&nbsp;</p>\r\n	<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n		<strong>特别支持</strong></p>\r\n	<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n		招商银行创新创业公益基金</p>\r\n	<div>\r\n		&nbsp;</div>\r\n	<div>\r\n		<div id=\"right_center_txt_name\" style=\"width: 547px; height: 70px; line-height: 80px; background-image: url(http://www.cxcyds.com/images/bjtp_03.gif); margin-left: auto; margin-right: auto; border: 0px; text-align: center; font-size: 16px; background-position: 0% 100%; background-repeat: no-repeat no-repeat;\">\r\n			<b>支持政策</b></div>\r\n		<div style=\"line-height: 25px; width: 555px; height: 30px;\">\r\n			&nbsp;</div>\r\n		<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n			（一）中国创新创业大赛入围企业</p>\r\n		<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n			进入分赛区决赛的企业（约200家），获得以下政策支持：</p>\r\n		<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n			1.符合科技型中小企业技术创新基金以及政策引导类科技计划要求的，纳入科技部备选项目库，给予优先支持；</p>\r\n		<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n			2.由风险投资机构推荐，符合科技型中小企业创业投资引导基金要求的，纳入项目库，给予优先支持；</p>\r\n		<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n			3.优先推荐给大赛投资基金和创业投资机构进行支持；</p>\r\n		<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n			4.大赛合作商业银行给予企业授信支持；</p>\r\n		<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n			5.由上海联合产权交易所提供免费并购咨询服务；</p>\r\n		<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n			6.由深圳证券交易所、有关券商等免费提供股改、上市等辅导培训；</p>\r\n		<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n			7.地方政府和机构对入围企业给予配套政策支持。</p>\r\n		<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n			（二）中国创新创业大赛入围团队</p>\r\n		<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n			进入全国总决赛的约20支团队，获得以下政策支持：</p>\r\n		<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n			1.获得创业导师的创业辅导；</p>\r\n		<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n			2.选择在孵化器落户的，给与一定时期免收房租等优惠政策支持；</p>\r\n		<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n			3.优先推荐给大赛投资基金和创业投资机构进行支持；</p>\r\n		<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n			4.地方政府和机构对入围团队给予配套政策支持。</p>\r\n		<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n			（三）中国创新创业大赛分赛区支持政策</p>\r\n		<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n			四个分赛区分别赛出初创企业组前6名和成长企业组前6名，由分赛区承办单位给予资金支持。</p>\r\n		<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n			第一名每组各1家</p>\r\n		<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n			第二名每组各2家</p>\r\n		<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n			第三名每组各3家</p>\r\n		<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n			（四）中国创新创业大赛总决赛</p>\r\n		<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n			1.支持企业政策：</p>\r\n		<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n			总决赛产生中国创新创业大赛企业组前12名，给予创新创业扶持资金支持。</p>\r\n		<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n			第一名2家</p>\r\n		<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n			第二名4家</p>\r\n		<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n			第三名6家</p>\r\n		<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n			2.支持团队政策：</p>\r\n		<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n			总决赛产生中国创新创业大赛团队组前10名，在6个月内注册成立企业后可获创新创业扶持资金支持。</p>\r\n		<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n			第一名1个</p>\r\n		<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n			第二名3个</p>\r\n		<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n			第三名6个</p>\r\n	</div>\r\n	<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em;\">\r\n		&nbsp;</p>\r\n</div>\r\n', '60', 'ThinkPHP3.0 完全开发手册.pdf###20.activity');
INSERT INTO `activities` VALUES ('25', '中国创新创业大赛分赛区复赛圆满结束', '2012-11-17 18:41:19', '2012-11-17 18:41:19', '2012-11-17 18:41:19', '2012-11-24 02:08:02', '<h3 style=\"color:blue;\">\r\n	&nbsp;</h3>\r\n<p align=\"center\" style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-weight: normal; text-indent: 2em;\">\r\n	<strong>两百多家企业进入尽职调查环节</strong></p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-weight: normal; text-indent: 2em;\">\r\n	10月25日，2012首届中国创新创业大赛分区赛复赛圆满结束，大赛进入分赛区决赛前的尽职调查阶段。</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-weight: normal; text-indent: 2em;\">\r\n	18-25日，大赛分区赛复赛依次在深圳、宁波、成都和北京四个城市举办，依据大赛规则评选出的241家企业进入尽职调查环节，通过尽职调查的企业将晋级11月中下旬的分赛区决赛。</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-weight: normal; text-indent: 2em;\">\r\n	据悉，为了保证大赛的公平、公开、公正，来自互联网、节能环保、生物医药、文化娱乐等十个行业的1400余家复赛企业被按照就近原则分配给四个分赛区，并统一通过8+12模式（8分钟企业自我介绍，12分钟现场问答）完成现场答辩，由5名投资及行业专家对参赛企业从技术、产品、商业模式、市场、团队和财务等多个角度进行打分，并以最终获得的平均分确认晋级资格。</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-weight: normal; text-indent: 2em;\">\r\n	记者了解到，进入尽职调查阶段的参赛企业中，信息技术组数量最多，共有61家企业；新材料组则有34家企业，先进设备制造、生物医药、光机电一体化与节能环保组均有20余家。地域方面，北京地区的优胜企业数最多，共有40余家，深圳、江苏紧追其后，各有20余家。</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-weight: normal; text-indent: 2em;\">\r\n	通过尽职调查筛选出的200家参赛企业不仅能够获得分赛区决赛席位，进而争夺48张全国总决赛入场券，符合条件的还可以优先入选科技部项目库，获得有关国家科技计划的扶持；同时分享由特别支持单位招商银行提供的贷款授信。</p>\r\n', '61', '');
INSERT INTO `activities` VALUES ('29', '学生创新创业系列赛事', '2012-11-15 22:37:23', '2012-12-08 22:37:29', '2012-11-21 22:37:26', '2012-11-30 22:37:20', '<p>\r\n	test</p>\r\n', '90', 'Chameleon Install 1754.rar###29.activity');
INSERT INTO `activities` VALUES ('30', '国际交流活动测试1', '2012-11-14 22:39:57', '2012-11-23 22:40:01', '2012-11-15 22:40:04', '2012-11-08 22:39:54', '<p>\r\n	test</p>\r\n', '90', '');
INSERT INTO `activities` VALUES ('31', '国际交流活动测试2', '2012-11-14 22:39:57', '2012-11-23 22:40:01', '2012-11-15 22:40:04', '2012-11-08 22:39:54', '<p>\r\n	test</p>\r\n', '90', '中国人口趋势.gif###31.activity');
INSERT INTO `activities` VALUES ('32', '河合创业基金描述', '2012-11-16 02:58:19', '2013-12-08 02:58:24', '2012-12-01 02:58:27', '2012-11-16 02:58:16', '<p>\r\n	<span style=\"color:#f00;\"><span style=\"font-size: 72px;\">河合内容</span></span></p>\r\n', '80', '');
INSERT INTO `activities` VALUES ('33', '河合当前阶段标题', '2012-11-17 16:31:24', '2012-11-17 16:31:24', '2012-11-17 16:31:24', '2012-11-25 02:59:38', '<p>\r\n	<span style=\"font-size:48px;\"><span style=\"color: rgb(0, 255, 0);\">报名火热进行中！！！！</span></span></p>\r\n', '81', '');
INSERT INTO `activities` VALUES ('37', 'test国际新闻', '2012-11-17 16:48:28', '2012-11-17 16:48:28', '2012-11-17 16:48:28', '2012-11-17 16:34:28', '<p>\r\n	ateataetseasdfasdfasdfasdf</p>\r\n', '91', '');
INSERT INTO `activities` VALUES ('38', '测试新闻添加', '2012-11-17 16:39:43', '2012-11-17 16:39:43', '2012-11-17 16:39:43', '2012-11-17 16:39:35', '<p>\r\n	test</p>\r\n', '91', '###38.activity');
INSERT INTO `activities` VALUES ('39', '测试新闻添加2', '2012-11-17 16:40:27', '2012-11-17 16:40:27', '2012-11-17 16:40:27', '2012-11-17 16:39:35', '<p>\r\n	testasdfasdfasdfasdfasd</p>\r\n', '91', '');
INSERT INTO `activities` VALUES ('42', '继续测试添加', '2012-11-17 16:49:46', '2012-11-17 16:49:46', '2012-11-17 16:49:46', '2012-11-09 16:49:41', '<p>\r\n	asdfasdfasdfasdf</p>\r\n', '91', '###42.activity');
INSERT INTO `activities` VALUES ('43', '参赛条件', '2012-11-17 17:03:05', '2012-11-17 17:03:05', '2012-11-17 17:03:05', '2012-11-17 17:02:57', '<p>\r\n	&nbsp;</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	<span style=\"font-family: \'Microsoft YaHei\';\"><span style=\"line-height: 1.5; font-size: 12px;\">&nbsp;&nbsp;</span><span style=\"line-height: 1.5;\">大赛按照初创企业组、成长企业组和创业团队组进行比赛。参赛项目应符合国家产业、技术政策，创新性强。</span></span></p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	&nbsp;</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	<b><span style=\"line-height: 1.5; font-family: \'Microsoft YaHei\';\">（一）&nbsp;</span></b><b><span style=\"line-height: 1.5; font-family: \'Microsoft YaHei\';\">初创企业组参赛资格</span></b></p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	<span style=\"line-height: 1.5; font-family: \'Microsoft YaHei\'; font-size: 14px;\">1.</span><span style=\"line-height: 1.5; font-family: \'Microsoft YaHei\';\">具有高成长性和投资价值的科技型中小企业；</span></p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	<span style=\"line-height: 1.5; font-family: \'Microsoft YaHei\';\">2.</span><span style=\"line-height: 31px; font-family: 仿宋_GB2312; font-size: 16pt;\"><span style=\"line-height: 1.5; font-family: \'Microsoft YaHei\'; font-size: 14px;\">成立时间不超过</span><span style=\"line-height: 1.5; font-family: \'Microsoft YaHei\'; font-size: 14px;\">5</span><span style=\"line-height: 1.5; font-family: \'Microsoft YaHei\'; font-size: 14px;\">年（</span><span style=\"line-height: 1.5; font-family: \'Microsoft YaHei\'; font-size: 14px;\">2007</span><span style=\"line-height: 1.5; font-family: \'Microsoft YaHei\'; font-size: 14px;\">年</span><span style=\"line-height: 1.5; font-family: \'Microsoft YaHei\'; font-size: 14px;\">7</span><span style=\"line-height: 1.5; font-family: \'Microsoft YaHei\'; font-size: 14px;\">月</span><span style=\"line-height: 1.5; font-family: \'Microsoft YaHei\'; font-size: 14px;\">1</span><span style=\"line-height: 1.5; font-family: \'Microsoft YaHei\'; font-size: 14px;\">日以后注册）；</span></span></p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	<span style=\"line-height: 1.5; font-family: \'Microsoft YaHei\';\">3.</span><span style=\"line-height: 31px; font-family: 仿宋_GB2312; font-size: 16pt;\"><span style=\"line-height: 1.5; font-family: \'Microsoft YaHei\'; font-size: 14px;\">年销售额不超过</span><span style=\"line-height: 1.5; font-family: \'Microsoft YaHei\'; font-size: 14px;\">3000</span><span style=\"line-height: 1.5; font-family: \'Microsoft YaHei\'; font-size: 14px;\">万元人民币；</span></span></p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	<span style=\"line-height: 1.5; font-family: \'Microsoft YaHei\';\">4.</span><span style=\"line-height: 1.5; font-family: \'Microsoft YaHei\';\">拥有合法的知识产权，无知识产权纠纷；</span></p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	<span style=\"line-height: 1.5; font-family: \'Microsoft YaHei\';\">5.</span><span style=\"line-height: 1.5; font-family: \'Microsoft YaHei\';\">经营规范，社会信誉良好，无不良记录。</span></p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	&nbsp;</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	<b><span style=\"line-height: 1.5; font-family: \'Microsoft YaHei\';\">（二）</span></b><b><span style=\"line-height: 1.5; font-family: \'Microsoft YaHei\';\">成长企业组参赛资格</span></b></p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	<span style=\"line-height: 1.5; font-family: \'Microsoft YaHei\';\">1.</span><span style=\"line-height: 1.5; font-family: \'Microsoft YaHei\';\">具有高成长性和投资价值的科技型中小企业；</span></p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	<span style=\"line-height: 1.5; font-family: \'Microsoft YaHei\';\">2.</span><span style=\"line-height: 31px; font-family: 仿宋_GB2312; font-size: 16pt;\"><span style=\"line-height: 1.5; font-family: \'Microsoft YaHei\'; font-size: 14px;\">年销售额原则上不超过</span><span style=\"line-height: 1.5; font-family: \'Microsoft YaHei\'; font-size: 14px;\">15000</span><span style=\"line-height: 1.5; font-family: \'Microsoft YaHei\'; font-size: 14px;\">万元人民币；</span></span></p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	<span style=\"line-height: 1.5; font-family: \'Microsoft YaHei\';\">3.</span><span style=\"line-height: 1.5; font-family: \'Microsoft YaHei\';\">拥有合法的知识产权，无知识产权纠纷；</span></p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	<span style=\"line-height: 1.5; font-family: \'Microsoft YaHei\';\">4.</span><span style=\"line-height: 1.5; font-family: \'Microsoft YaHei\';\">经营规范，社会信誉良好，无不良记录。</span></p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	&nbsp;</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	<b><span style=\"line-height: 1.5; font-family: \'Microsoft YaHei\';\">（三） 创业团队组参赛资格</span></b></p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	<span style=\"line-height: 1.5; font-family: \'Microsoft YaHei\';\">1.</span><span style=\"line-height: 1.5; font-family: \'Microsoft YaHei\';\">具有创新创业精神的创业团队（如海外留学回国创业人员、进入创业实施阶段的优秀科技团队、大学生创业团队等）；</span></p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	<span style=\"line-height: 1.5; font-family: \'Microsoft YaHei\';\">2.</span><span style=\"line-height: 1.5; font-family: \'Microsoft YaHei\';\">拥有合法的知识产权，无知识产权纠纷；</span></p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	<span style=\"line-height: 1.5; font-family: \'Microsoft YaHei\';\">3.</span><span style=\"line-height: 31px; font-family: 仿宋_GB2312; font-size: 16pt;\"><span style=\"line-height: 1.5; font-family: \'Microsoft YaHei\'; font-size: 14px;\">核心团队成员不少于</span><span style=\"line-height: 1.5; font-family: \'Microsoft YaHei\'; font-size: 14px;\">3</span><span style=\"line-height: 1.5; font-family: \'Microsoft YaHei\'; font-size: 14px;\">人；</span></span></p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	<span style=\"line-height: 1.5; font-family: \'Microsoft YaHei\';\">4.</span><span style=\"line-height: 31px; font-family: 仿宋_GB2312; font-size: 16pt;\"><span style=\"line-height: 1.5; font-family: \'Microsoft YaHei\'; font-size: 14px;\">预计赛后</span><span style=\"line-height: 1.5; font-family: \'Microsoft YaHei\'; font-size: 14px;\">6</span><span style=\"line-height: 1.5; font-family: \'Microsoft YaHei\'; font-size: 14px;\">个月内成立企业。</span></span></p>\r\n', '62', '###43.activity');
INSERT INTO `activities` VALUES ('44', '报名渠道及方式', '2012-11-17 17:03:34', '2012-11-17 17:03:34', '2012-11-17 17:03:34', '2012-11-17 17:03:31', '<p>\r\n	&nbsp;</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	<strong>报名渠道：</strong>参赛企业和团队通过大赛网站统一报名。<br />\r\n	<strong>企业组报名时间：</strong>2012年7月5日-9月15日<br />\r\n	<strong>团队组报名时间：</strong>2012年7月5日-10月31日</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	&nbsp;</p>\r\n<div style=\"color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px; line-height: 25px; text-align: center;\">\r\n	<img alt=\"\" src=\"http://www.cxcyds.com/attached/image/20120701/20120701200821_91816.jpg\" style=\"border: none;\" /></div>\r\n<p>\r\n	<strong style=\"color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px; line-height: 25px;\">报名方式及流程：&nbsp;</strong><br style=\"color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px; line-height: 25px;\" />\r\n	<span style=\"color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px; line-height: 25px;\">第一步：登录大赛官网</span><a href=\"http://www.cxcyds.com/\" style=\"color: rgb(102, 102, 102); text-decoration: initial; font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px; line-height: 25px;\">www.cxcyds.com</a><span style=\"color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px; line-height: 25px;\">；</span><br style=\"color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px; line-height: 25px;\" />\r\n	<span style=\"color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px; line-height: 25px;\">第二步：点击&quot;在线报名&quot;；</span><br style=\"color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px; line-height: 25px;\" />\r\n	<span style=\"color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px; line-height: 25px;\">第三步：仔细阅读&quot;参赛声明和参赛企业注册条款&quot;，并同意；</span><br style=\"color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px; line-height: 25px;\" />\r\n	<span style=\"color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px; line-height: 25px;\">第四步：填写注册信息，选择参赛组别；</span><br style=\"color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px; line-height: 25px;\" />\r\n	<span style=\"color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px; line-height: 25px;\">第五步：注册成功后，登录系统；</span><br style=\"color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px; line-height: 25px;\" />\r\n	<span style=\"color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px; line-height: 25px;\">第六步：填写基本信息；</span><br style=\"color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px; line-height: 25px;\" />\r\n	<span style=\"color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px; line-height: 25px;\">第七步：填写股东信息；</span><br style=\"color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px; line-height: 25px;\" />\r\n	<span style=\"color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px; line-height: 25px;\">第八步：填写商业计划书（可选择下载商业计划书模板，填写完毕后将资料复制到网上填报）；&nbsp;</span><br style=\"color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px; line-height: 25px;\" />\r\n	<span style=\"color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px; line-height: 25px;\">第九步：上传资质证件（企业营业执照、专利证书等相关证件扫描件或其他文档）；</span><br style=\"color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px; line-height: 25px;\" />\r\n	<span style=\"color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px; line-height: 25px;\">第十步：审核信息确保无误，选择全部提交信息，完成报名。</span></p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	&nbsp;</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	<b>报名咨询电话：</b><br />\r\n	[大赛指导委员会]<br />\r\n	010-88656381、88656382、88656383、88655384<br />\r\n	（周一到周五 9：00-17:30）</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	[分赛区]</p>\r\n<p>\r\n	<span style=\"color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px; line-height: 25px;\">深圳赛区报名热线： 0755-86309878 、 86671369 、 86671299</span><br style=\"color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px; line-height: 25px;\" />\r\n	<span style=\"color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px; line-height: 25px;\">宁波赛区报名热线： 0574-87907707 、 87901215、 87906190</span><br style=\"color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px; line-height: 25px;\" />\r\n	<span style=\"color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px; line-height: 25px;\">上海赛区报名热线： 021-55238517&nbsp;</span><br style=\"color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px; line-height: 25px;\" />\r\n	<span style=\"color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px; line-height: 25px;\">成都赛区报名热线： 028-85312177、 85311629&nbsp;</span><br style=\"color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px; line-height: 25px;\" />\r\n	<span style=\"color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px; line-height: 25px;\">北京赛区报名热线： 010- 84922543</span></p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	&nbsp;</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	<b>[24小时紧急联系]</b><br />\r\n	010-88656381</p>\r\n', '62', '###44.activity');
INSERT INTO `activities` VALUES ('45', '赛程安排', '2012-11-17 18:39:26', '2012-11-17 18:39:26', '2012-11-17 18:39:26', '2012-11-17 18:39:23', '<p>\r\n	&nbsp;</p>\r\n<div id=\"right_center_txt_name\" style=\"width: 547px; height: 70px; line-height: 80px; background-image: url(http://www.cxcyds.com/images/bjtp_03.gif); margin-left: auto; margin-right: auto; border: 0px; text-align: center; color: rgb(51, 51, 51); font-size: 16px; font-family: 微软雅黑, tahoma, arial, sans-serif; background-position: 0% 100%; background-repeat: no-repeat no-repeat;\">\r\n	<br />\r\n	&nbsp;</div>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	（一）报名</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	1.报名渠道：参赛单位通过大赛网站<a href=\"http://www.cxcyds.com/\" style=\"color: rgb(102, 102, 102); text-decoration: initial;\">www.cxcyds.com</a>统一报名。</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	报名时间：<br />\r\n	企业组报名时间：2012年7月5日-9月15日<br />\r\n	团队组报名时间：2012年7月5日-10月31日</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	2.参赛项目确认：国家高新区对辖区内报名的项目进行确认，并将结果汇总上报至所在省、自治区、直辖市或计划单列市科技厅（委、局）。各省、自治区、直辖市和计划单列市科技厅（委、局）、新疆生产建设兵团科技局对辖区内高新区以外的报名项目进行确认，并将结果和辖区内高新区报名项目汇总后，通过大赛网站一并上报。</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	确认时间：2012年9月上旬</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	3.初审：大赛指导委员会办公室对经过地方科技主管部门确认后的项目进行初审。</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	初审时间：2012年9月中旬</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	（二）初赛</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	2012年9月底前，大赛指导委员会办公室组织创投和技术专家在网上审核确定进入分赛区复赛的企业，每个分赛区约500家。同时确定进入复赛的团队约100支。</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	（三）分区赛</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	1.复赛</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	企业组：2012年10月，初创企业组和成长企业组在北京、宁波、深圳、成都四个分赛区举行复赛。由创投专家审核确定出共约200家企业进入分赛区决赛。</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	团队组：2012年11月，创业团队组在上海进行复赛，最终确定出约20支团队进入全国总决赛。<br />\r\n	2.决赛</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	2012年10月-11月，初创企业组和成长企业组在四个分赛区举行分赛区决赛。由创投机构对企业进行尽职调查，根据尽职调查和比赛得分的结果，四个赛区共产生48家企业进入全国总决赛。</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	对进入分赛区决赛的企业和进入全国总决赛的团队通过大赛网站向社会公示。</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	（四）全国总决赛</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	2012年12月，总决赛采用企业和团队面对审核专家进行现场风采展示的方式，并在中央电视台播出。通过比赛确定出中国创新创业大赛企业组前12名和团队组前10名。</p>\r\n', '62', '###45.activity');
INSERT INTO `activities` VALUES ('46', '评审流程', '2012-11-17 18:40:39', '2012-11-17 18:40:39', '2012-11-17 18:40:39', '0000-00-00 00:00:00', '<p>\r\n	&nbsp;</p>\r\n<div id=\"right_center_txt_name\" style=\"width: 547px; height: 70px; line-height: 80px; background-image: url(http://www.cxcyds.com/images/bjtp_03.gif); margin-left: auto; margin-right: auto; border: 0px; text-align: center; color: rgb(51, 51, 51); font-size: 16px; font-family: 微软雅黑, tahoma, arial, sans-serif; background-position: 0% 100%; background-repeat: no-repeat no-repeat;\">\r\n	<span style=\"font-size: 14px; line-height: 2em;\">一、初赛</span></div>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	1、初创组和成长组比赛方式</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	初赛采用网上评分形式；</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	每家参赛企业将接受不少于3名分别来自投资领域和技术领域的专家评委评分；</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	2、团队组比赛方式</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	初赛采用网上评分形式；</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	每家参赛团队将接受不少于3名分别来自投资领域和技术领域的评委评分；</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	&nbsp;</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	二、分区赛复赛</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	1、初创组和成长组比赛方式</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	分区赛复赛采用8+12模式的答辩评选：参赛企业自我介绍8分钟，现场答辩12分钟；</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	入围分区赛复赛环节企业，将被分至4个赛区进行答辩；</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	每家参赛企业将接受不少于5名评委现场评分；</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	2、团队组比赛方式</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	分区赛复赛采用网上视频答辩形式；</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	分区赛复赛采用8+12模式的答辩评选：参赛团队自我介绍8分钟，视频答辩12分钟；</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	每个参赛团队将接受不少于3名评委评分；</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	&nbsp;</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	三、分区赛决赛比赛方式（初创组和成长组）</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	比赛地点与分区赛复赛一致；</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	进入分区赛决赛的企业均要接受尽职调查，根据尽职调查结果判断并通知进入分区赛决赛现场答辩环节的参赛企业。通过企业尽职调查从投资角度判断参赛企业发展潜力，确认参赛企业递交资料的真实性，如有造假信息将被直接取消参赛资格。</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	分区赛决赛采用10+20模式的答辩评选：参赛企业自我介绍10分钟，现场答辩20分钟。</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	每家参赛企业将接受不少于7名评委现场评分；</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	&nbsp;</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	四、全国总决赛</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	1、企业组（初创组和成长组）</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	全国总决赛采用现场答辩形式；</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	评委来自投资界、行业领域、金融机构等相关专家；</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	通过竞赛确定出中国创新创业大赛企业组前12名。</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	2、团队组</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	全国总决赛采用现场答辩形式；</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	评委来自投资界、行业领域、金融机构等相关专家；</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	通过比赛确定出中国创新创业大赛团队组前10名。</p>', '62', '###46.activity');
INSERT INTO `activities` VALUES ('47', '投资联盟', '2012-11-17 19:57:25', '2012-11-17 19:57:25', '2012-11-17 19:57:25', '0000-00-00 00:00:00', '<p>\r\n	&nbsp;</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px; text-indent: 2em;\">\r\n	科技型中小企业投融资联盟：</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px; text-indent: 2em;\">\r\n	&ldquo;科技型中小企业投融资联盟&rdquo;由在中华人民共和国境内经批准合法设立的股权投资企业、银行、证券机构、相关研究机构、股权投资中介和咨询服务机构等自愿组成。宗旨是协调科技型中小企业、股权投资机构及公共服务机构，通过推动科技型中小企业同资本市场的紧密结合，实现联盟成员的共赢发展并促进我国科技自主创新能力建设。</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px; text-indent: 2em;\">\r\n	在首届中国创新创业大赛中，联盟参与企业评选工作，并为参赛企业提供投融资等服务。</p>\r\n', '82', '');
INSERT INTO `activities` VALUES ('48', '合作投资机构', '2012-11-17 18:43:22', '2012-11-17 18:43:22', '2012-11-17 18:43:22', '0000-00-00 00:00:00', '<p>\r\n	&nbsp;</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	<strong>由各分赛区推荐，参与大赛评审与投资的金融机构列表（部分）：</strong></p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	北极光创业投资基金</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	北京金沙江创业投资管理有限公司</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	北京青云创业投资管理有限公司</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	创新工场</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	德同中国投资基金</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	芳晟股权投资基金</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	中卫基金</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	富汇创业投资管理有限公司</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	经纬创投</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	君联资本有限公司</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	开信创业投资管理有限公司</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	启迪创业投资管理有限公司</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	软银赛富投资基金</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	泰山天使创业基金</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	深圳市创赛基金投资管理有限公司</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	深圳市创新投资集团有限公司</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	深圳市高特佳投资集团有限公司</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	深圳市深港产学研创业投资有限公司</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	深圳市同威创业投资有限公司</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	成都盈创动力投资发展有限公司</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	成都高新区教育科技园孵化器有限公司</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	成都创新风险投资有限公司</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	成都德同银科创业投资基金</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	成都凯晟投资管理中心</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	合力投资管理有限公司</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	开铂银科（成都）创业投资公司</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	迈普（四川）通信技术有限公司</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	上海复星创富投资管理有限公司</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	深圳松禾资本管理有限公司</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	CXC创投创始</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	戈壁合伙人有限公司</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	昆吾九鼎投资管理有限公司</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	联创策源</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	金沙江创业投资基金</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	起点创业投资基金</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	上海新中欧投资管理有限公司</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	亚商集团</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	天亿投资（集团）有限公司</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	上海致景投资管理有限公司</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	上海永宣创业投资管理有限公司</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	启迪创业投资管理（北京）有限公司</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	中孵创业投资有限公司</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	软银中国创业投资有限公司</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	中国风险投资公司</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	IDG资本</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	英菲尼迪集团</p>\r\n<p style=\"margin: 5px 0px 0px; padding: 0px; list-style: none; outline: none; line-height: 2em; color: rgb(51, 51, 51); font-family: 微软雅黑, tahoma, arial, sans-serif; font-size: 14px;\">\r\n	德丰杰龙脉基金</p>\r\n', '82', '###48.activity');

-- ----------------------------
-- Table structure for `activityapplication`
-- ----------------------------
DROP TABLE IF EXISTS `activityapplication`;
CREATE TABLE `activityapplication` (
  `actapplicationid` int(11) NOT NULL AUTO_INCREMENT,
  `actid` int(11) DEFAULT NULL,
  `acttype` int(11) NOT NULL,
  `studentid` int(11) DEFAULT NULL,
  `studentname` varchar(20) DEFAULT NULL,
  `submittime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `attachmentpath` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`actapplicationid`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of activityapplication
-- ----------------------------
INSERT INTO `activityapplication` VALUES ('12', '20', '60', '21', '测试学生', '2012-11-15 04:22:51', 'flashgamemaster.rar###12.actapp');
INSERT INTO `activityapplication` VALUES ('14', '20', '63', '21', '测试学生', '2012-11-15 22:46:53', 'Chameleon Install 1754.rar###14.actapp');
INSERT INTO `activityapplication` VALUES ('15', '29', '90', '21', '测试学生', '2012-11-16 01:51:54', 'Silverlight.exe###15.actapp');
INSERT INTO `activityapplication` VALUES ('16', '32', '80', '21', '测试学生', '2012-11-16 03:00:31', 'twitter-bootstrap-v2.1.0-1-g320b75d.zip###16.actapp');
INSERT INTO `activityapplication` VALUES ('17', '32', '83', '21', '测试学生', '2012-11-16 03:00:37', 'ThinkPHP3.0 完全开发手册.pdf###17.actapp');

-- ----------------------------
-- Table structure for `appraisal`
-- ----------------------------
DROP TABLE IF EXISTS `appraisal`;
CREATE TABLE `appraisal` (
  `appraisalid` int(11) NOT NULL AUTO_INCREMENT,
  `teacherid` int(11) DEFAULT NULL,
  `compid` int(11) DEFAULT NULL,
  `comtype` int(11) NOT NULL,
  `attachmentpath` varchar(1024) DEFAULT NULL,
  `appraisalstatus` int(11) DEFAULT NULL,
  PRIMARY KEY (`appraisalid`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of appraisal
-- ----------------------------
INSERT INTO `appraisal` VALUES ('1', '3', '20', '64', 'twitter-bootstrap-v2.1.0-1-g320b75d.zip', '0');
INSERT INTO `appraisal` VALUES ('2', '3', '20', '65', '', '1');
INSERT INTO `appraisal` VALUES ('3', '5', null, '64', 'twitter-bootstrap-v2.1.0-1-g320b75d.zip', null);
INSERT INTO `appraisal` VALUES ('4', '8', null, '64', 'twitter-bootstrap-v2.1.0-1-g320b75d.zip', null);
INSERT INTO `appraisal` VALUES ('5', '12', null, '64', '', null);
INSERT INTO `appraisal` VALUES ('6', '12', null, '65', '', null);
INSERT INTO `appraisal` VALUES ('7', '11', null, '84', '15_121013115406.rar', null);
INSERT INTO `appraisal` VALUES ('8', '12', null, '84', '15_121013115406.rar', null);

-- ----------------------------
-- Table structure for `collection`
-- ----------------------------
DROP TABLE IF EXISTS `collection`;
CREATE TABLE `collection` (
  `stuid` int(11) DEFAULT NULL,
  `originalityid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of collection
-- ----------------------------
INSERT INTO `collection` VALUES ('1', '6');
INSERT INTO `collection` VALUES ('2', '6');
INSERT INTO `collection` VALUES ('2', '1');
INSERT INTO `collection` VALUES ('1', '1');
INSERT INTO `collection` VALUES ('8', '6');

-- ----------------------------
-- Table structure for `courses`
-- ----------------------------
DROP TABLE IF EXISTS `courses`;
CREATE TABLE `courses` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `coursename` varchar(50) DEFAULT NULL,
  `introduction` text,
  `hoursarrangement` text,
  `teacher` varchar(20) DEFAULT NULL,
  `place` varchar(100) DEFAULT NULL,
  `headcount` int(11) DEFAULT NULL,
  `ispublic` int(11) DEFAULT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of courses
-- ----------------------------

-- ----------------------------
-- Table structure for `curriculum`
-- ----------------------------
DROP TABLE IF EXISTS `curriculum`;
CREATE TABLE `curriculum` (
  `courseid` int(11) DEFAULT NULL,
  `stuid` int(11) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `mark` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of curriculum
-- ----------------------------

-- ----------------------------
-- Table structure for `guidanceprocess`
-- ----------------------------
DROP TABLE IF EXISTS `guidanceprocess`;
CREATE TABLE `guidanceprocess` (
  `gpid` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(100) DEFAULT NULL,
  `content` text,
  `type` int(11) DEFAULT NULL,
  PRIMARY KEY (`gpid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of guidanceprocess
-- ----------------------------

-- ----------------------------
-- Table structure for `incubator`
-- ----------------------------
DROP TABLE IF EXISTS `incubator`;
CREATE TABLE `incubator` (
  `incubatorid` int(11) NOT NULL AUTO_INCREMENT,
  `incubatorname` varchar(1024) DEFAULT NULL,
  `incubatorcontent` text,
  PRIMARY KEY (`incubatorid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of incubator
-- ----------------------------
INSERT INTO `incubator` VALUES ('1', '如何腾飞', '创业成长计划之“腾飞创业”针对在大赛中表现优异，并有志于实际创业，具有原创自主知识产权项目的优秀团队，提供更加广阔的平台，深入企业园区与孵化器亲身投入实践，并为其提供全程创业孵化及促进科技成果转化创业服务，最终使团队实现实质创业。目前仍在建设之中…');
INSERT INTO `incubator` VALUES ('2', '腾飞展望', '“腾飞展望”部分，主要包括“推介交流”、“服务概述”与“团队义务”\ni.	“推介交流”，“推介交流”活动的介绍，具体内容参照“附件7”\nii.	“服务概述”主要分为“初始阶段”、“成长阶段”和“毕业离园”，具体内容参照“附件8”\niii.	“团队义务”具体内容参照“附件9”\n');
INSERT INTO `incubator` VALUES ('3', '创业平台简介', '<p>\n	&nbsp;</p>\n<p class=\"MsoNormal\" style=\"margin-left:18.0pt;text-indent:8.25pt\">\n	<span style=\"font-family:仿宋_GB2312;mso-bidi-font-family:仿宋_GB2312\">北大孵化器（全称：北京北达燕园科技孵化器有限公司）成立于<span lang=\"EN-US\">2002</span>年<span lang=\"EN-US\">5</span>月<span lang=\"EN-US\">, </span>由北京北大科技园有限公司控股<span lang=\"EN-US\">,</span>注册资本<span lang=\"EN-US\">5000</span>万元人民币<span lang=\"EN-US\">.</span>是北京大学和中关村科技园区管委会共建的创业孵化器基地；是北京市科委认定的北京市高新技术企业孵化基地；是北京市人事局认定的北京市留学人员创业园。本公司集孵化、投资和运营顾问服务三位一体，为具有原创自主知识产权的项目提供全程创业孵化及促进科技成果转化的创业服务机构。<span lang=\"EN-US\"><o:p></o:p></span></span></p>\n<p class=\"MsoNormal\" style=\"margin-left:18.0pt\">\n	<span style=\"font-family:仿宋_GB2312;\nmso-bidi-font-family:仿宋_GB2312\">北大孵化器现已形成三个基地两个平台的发展模式。三个基点基地主要是指北大留学人员创业园（中关村科技园区留学人员北大服务基地）；北京市留学人员创业园（北京市人事局、科委留学人才服务基地）；北京北达燕园科技孵化器有限公司（北京市高新技术产业孵化基地），而两个平台指：第一：北大孵化器投融资服务平台，主要是通过向企业提供融资信息、建立融资渠道、开展投融资咨询、策划和辅导，形成投资基金对有融资需求的企业直接投资，带动风险投资进入 ；第二：北大孵化器&ldquo;微构分析测试&rdquo;科技条件平台。<span lang=\"EN-US\"><o:p></o:p></span></span></p>\n<p class=\"MsoNormal\" style=\"margin-left:18.0pt\">\n	<span style=\"font-family:仿宋_GB2312;\nmso-bidi-font-family:仿宋_GB2312\">园区培育的科技产业化典范有北大青鸟、北大未名和北大方正；园区培育典范有北京北大先锋科技技术有限公司、北京科宇联合干细胞生物技术有限公司、北京盖雅环境科技有限公司、北京峨兰斯科技有限公司；成功引入风投典范有北京科宇联合干细胞生物技术有限公司、北京梦之窗数码科技有限公司、北京老虎宝典科技有限责任公司；获得国际创新奖项有北京老虎宝典科技有限责任公司、博看科技（北京）有限公司，也是培育最多优秀企业的孵化器之一。<span lang=\"EN-US\"><o:p></o:p></span></span></p>\n<p class=\"MsoNormal\" style=\"margin-left:18.0pt\">\n	<span style=\"font-family:仿宋_GB2312;\nmso-bidi-font-family:仿宋_GB2312\">为企业营造良好的创业条件，还引进实惠专业服务机构，搭建中介服务平台；组织企业成立企业家沙龙，促进企业间与社会各界人士间的交流与合作。<span lang=\"EN-US\"><o:p></o:p></span></span></p>\n<p class=\"MsoNormal\" style=\"margin-left:18.0pt\">\n	<span style=\"font-family:仿宋_GB2312;\nmso-bidi-font-family:仿宋_GB2312\">入驻企业在我园均可享受提供免费的创业服务，帮助企业争取一定数量的非北京生源应届毕业生北京户口指标；组织企业参加各种项目推介会及融资洽谈会；协助企业申请国家科技中小企业创新基金、申请国家、北京市政府和园区的各种专项资助，包括重大产业化支持等。技术标准研制、知识产权技术转移。集成电路资助、专利申请补贴等专项资金；通过入股和自有资金入股等方式，对企业直接进行投资；引进风险投资机构。<span lang=\"EN-US\"><o:p></o:p></span></span></p>\n');

-- ----------------------------
-- Table structure for `incubatormodules`
-- ----------------------------
DROP TABLE IF EXISTS `incubatormodules`;
CREATE TABLE `incubatormodules` (
  `moduleid` int(11) NOT NULL AUTO_INCREMENT,
  `incubatorno` int(11) DEFAULT NULL,
  `modulename` varchar(1024) DEFAULT NULL,
  `modulecontent` text,
  PRIMARY KEY (`moduleid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of incubatormodules
-- ----------------------------
INSERT INTO `incubatormodules` VALUES ('1', '2', '推介交流', '在每年创业大赛结束后的12月底，为在创业大赛涌现出的优质团队、成长计划中形成的优质团队、其他大赛推荐的优质团队以及网络平台自主申报的项目营造一个与风险投资人见面洽谈的机会。如果对您的团队资格、资料信息、项目框架等方面的考核无误，我们将会交由包括知名企业家、投资人的专家评审团评议，以确定进入推介会的团队。推介会中由您的团队将自行展示，有关企业进行评估交流。如有合作意向，则在团队、企业、办公室三方同意的基础上签订有关合同，完成选拔。\r\n您可能会成功，如果：\r\na 符合国家十二五规划及北京市产业规划要求，主营业务应是从事节能环保、信息技术、生物医药、高端装备、新能源、新材料、新能源车的研究、开发、生产及技术服务的企业；\r\nb 有产权明晰的专有技术、专利发明、软件著作权或经过鉴定的科技成果；\r\nc 拥有承担国家863、973、创新基金、中小企业发展基金及其他政府重大课题的项目；\r\nd 所开发的项目和产品有良好的市场产业化前景和实用价值。\r\n');
INSERT INTO `incubatormodules` VALUES ('2', '2', '服务概述', '(1)“初创阶段”主要内容为介绍创业初期的相关信息，内容如下：\r\n（1）企业注册服务\r\n工商注册、税务登记、银行开户、会计记账等服务。帮助企业完成工商注册的各种手续，包括：工商登记注册；高新技术企业资格认定；企业变更登记、改制登记、组织机构代码证登记。\r\n（2）孵化场地投资（协议另拟）\r\n对于成熟的可进行成果转化的项目，北大科技园将以  的形式给予  的孵化场地进行投资。\r\n（3）物业服务\r\n入驻服务、日常物业服务、商务服务、其他物业服务、安全服务与管理。（详情另见创业服务手册）\r\n（4）咨询服务\r\n为拟入驻企业提供各项咨询和服务，并在企业入住后提供各项咨询和服务，帮助企业寻找解决疑问的途径和方法。\r\n（5）创业辅导\r\na 创业辅导：针对创业初期的各种问题，综合园内企业创办的经验，提供各种参考性建议。\r\nb 融资顾问：为企业融资需求提供咨询服务，判断企业发展阶段融资可能性，判断适当的融资对象和方法，引介投资人，促进融资谈判和交易。\r\n（2）“成长阶段”主要介绍创业成长过程的相关信息，内容如下：\r\n（2）企业成长阶段\r\n1）企业管理服务\r\na 提供企业策划服务及运营管理服务，帮助入驻企业根据公司章程梳理、设计公司法人治理结构。\r\nb 提供财务筹划相关服务。\r\n2）政策、培训等服务\r\na 不定期发布与宣贯政策、科技、经济等相关信息。\r\nb 组织开展涉及政策、法律、金融、市场、财务等方面的讲座、培训及交流活动。\r\n3）人才服务\r\n依据国家高端人才政策，帮助企业申请千人计划、高聚工程、海聚工程。\r\n4）人事代理服务\r\n可协助园内企业进行人才招聘、人事管理等工作。包括帮助企业解决应届毕业生落户、帮助留学人员申请北京市工作居住证、留学人员留京落户、留学人员档案管理、工作寄住证等咨询服务。同时引进专业机构为企业提供各种人事代理服务、人才测评、人才派遣、人力资源管理咨询、人才开发培训、就业指导、政策咨询、代办网上招聘会等。\r\n5）专项服务\r\na 协助企业申报高新技术企业以及其他企业资质认定；\r\nb 协助企业联系科学试验、产品检测的有关实验室；\r\nc 协助企业开展技术成果鉴定，产品鉴定、成果登记等工作；\r\nd 不定期组织企业人员参加国内外相关交流会、交易会；\r\ne 协助企业联系中试及产业化场地（位于北京周边及全国北大科技园分园所在地）。\r\n6）创业沙龙、各类讲坛\r\n定期举办创新创业沙龙主题活动，中关村管委会打造中关村创业讲坛。为创业者提供学习与交流的平台，营造良好的创业环境。讲坛的主讲人有中关村知名企业家、创业者，有天使投资人、风险投资家，还有国外知名学者和政府官员等，促进企业间的交流、信息共享，对企业发展中的问题沟通答疑。\r\n7）银行贷款服务	\r\n企业如需申请中关村“绿色通道”贴息贷款，我园将辅导企业填报材料，负责向担保公司推荐，提高企业贷款金额和效率。\r\n8）融资推荐服务\r\n我园是中关村创业投资发展中心种子资金的合作伙伴，可以向机构推荐优秀企业。\r\n9）各项资金申请服务	\r\n我园可帮助企业申请国家、北京市政府、园区等各项专项资助。包括国家创新资金、留学人员开办费、专利申请补贴专项资金等。\r\n10）项目推荐\r\n组织园内优秀企业参加各种展览会、项目推荐会以及各项论坛、交流会等活动，提高市场、融资机会。\r\n（1）“毕业离园”部分介绍企业脱离孵化器后部分的相关信息，内容如下：\r\n（3）、企业毕业离园\r\n在入园年后，企业成长已具备一定的规模，按孵化流程，企业孵化成功毕业，办理离园。\r\n');
INSERT INTO `incubatormodules` VALUES ('3', '2', '团队义务', '创业平台简介：\r\n北大孵化器（全称：北京北达燕园科技孵化器有限公司）成立于2002年5月, 由北京北大科技园有限公司控股,注册资本5000万元人民币.是北京大学和中关村科技园区管委会共建的创业孵化器基地；是北京市科委认定的北京市高新技术企业孵化基地；是北京市人事局认定的北京市留学人员创业园。本公司集孵化、投资和运营顾问服务三位一体，为具有原创自主知识产权的项目提供全程创业孵化及促进科技成果转化的创业服务机构。\r\n北大孵化器现已形成三个基地两个平台的发展模式。三个基点基地主要是指北大留学人员创业园（中关村科技园区留学人员北大服务基地）；北京市留学人员创业园（北京市人事局、科委留学人才服务基地）；北京北达燕园科技孵化器有限公司（北京市高新技术产业孵化基地），而两个平台指：第一：北大孵化器投融资服务平台，主要是通过向企业提供融资信息、建立融资渠道、开展投融资咨询、策划和辅导，形成投资基金对有融资需求的企业直接投资，带动风险投资进入 ；第二：北大孵化器“微构分析测试”科技条件平台。\r\n园区培育的科技产业化典范有北大青鸟、北大未名和北大方正；园区培育典范有北京北大先锋科技技术有限公司、北京科宇联合干细胞生物技术有限公司、北京盖雅环境科技有限公司、北京峨兰斯科技有限公司；成功引入风投典范有北京科宇联合干细胞生物技术有限公司、北京梦之窗数码科技有限公司、北京老虎宝典科技有限责任公司；获得国际创新奖项有北京老虎宝典科技有限责任公司、博看科技（北京）有限公司，也是培育最多优秀企业的孵化器之一。\r\n为企业营造良好的创业条件，还引进实惠专业服务机构，搭建中介服务平台；组织企业成立企业家沙龙，促进企业间与社会各界人士间的交流与合作。\r\n入驻企业在我园均可享受提供免费的创业服务，帮助企业争取一定数量的非北京生源应届毕业生北京户口指标；组织企业参加各种项目推介会及融资洽谈会；协助企业申请国家科技中小企业创新基金、申请国家、北京市政府和园区的各种专项资助，包括重大产业化支持等。技术标准研制、知识产权技术转移。集成电路资助、专利申请补贴等专项资金；通过入股和自有资金入股等方式，对企业直接进行投资；引进风险投资机构。\r\nd 在上述文字出现之后，文字底部应当有一个返回之前主页面的按钮。\r\n2、“腾飞展望”部分\r\na 用户在将鼠标移至“腾飞展望”字样上时，“如何腾飞”部分数轴在不放大的情况下拉长，数轴上分别标注“推介交流”“服务概述”“团队义务”。\r\nb 用户点击“推介交流”后，数轴纵向放大成一张白纸或一卷书卷，标注上移。出现如下文字：\r\n在每年创业大赛结束后的12月底，为在创业大赛涌现出的优质团队、成长计划中形成的优质团队、其他大赛推荐的优质团队以及网络平台自主申报的项目营造一个与风险投资人见面洽谈的机会。如果对您的团队资格、资料信息、项目框架等方面的考核无误，我们将会交由包括知名企业家、投资人的专家评审团评议，以确定进入推介会的团队。推介会中由您的团队将自行展示，有关企业进行评估交流。如有合作意向，则在团队、企业、办公室三方同意的基础上签订有关合同，完成选拔。\r\n您可能会成功，如果：\r\na 符合国家十二五规划及北京市产业规划要求，主营业务应是从事节能环保、信息技术、生物医药、高端装备、新能源、新材料、新能源车的研究、开发、生产及技术服务的企业；\r\nb 有产权明晰的专有技术、专利发明、软件著作权或经过鉴定的科技成果；\r\nc 拥有承担国家863、973、创新基金、中小企业发展基金及其他政府重大课题的项目；\r\nd 所开发的项目和产品有良好的市场产业化前景和实用价值。\r\n');

-- ----------------------------
-- Table structure for `lecture`
-- ----------------------------
DROP TABLE IF EXISTS `lecture`;
CREATE TABLE `lecture` (
  `lid` int(11) NOT NULL AUTO_INCREMENT,
  `lname` varchar(100) DEFAULT NULL,
  `lcontent` text,
  PRIMARY KEY (`lid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lecture
-- ----------------------------

-- ----------------------------
-- Table structure for `lecturecomment`
-- ----------------------------
DROP TABLE IF EXISTS `lecturecomment`;
CREATE TABLE `lecturecomment` (
  `lcid` int(11) NOT NULL AUTO_INCREMENT,
  `content` text,
  `commenter` varchar(20) DEFAULT NULL,
  `lectureid` int(11) DEFAULT NULL,
  PRIMARY KEY (`lcid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of lecturecomment
-- ----------------------------

-- ----------------------------
-- Table structure for `originality`
-- ----------------------------
DROP TABLE IF EXISTS `originality`;
CREATE TABLE `originality` (
  `oid` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(100) DEFAULT NULL,
  `author` varchar(50) DEFAULT NULL,
  `background` text,
  `abstract` text,
  `functiondescription` text,
  `filepath` varchar(1024) DEFAULT NULL,
  `stuid` int(11) DEFAULT NULL,
  `isopen` int(11) DEFAULT NULL,
  `submittime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `collectiontimes` int(11) DEFAULT NULL,
  `ispublic` int(11) DEFAULT NULL,
  `publictime` timestamp NULL DEFAULT NULL,
  `asignment` int(11) DEFAULT NULL,
  `finalmark` float DEFAULT NULL,
  PRIMARY KEY (`oid`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of originality
-- ----------------------------
INSERT INTO `originality` VALUES ('1', '无人飞机控制', '张三、李四、王五', '<p>\r\n	<span style=\"font-size:16px;\"><u><em><strong>人力成本越来越高</strong></em></u></span></p>\r\n', '<h1>\r\n	<span style=\"background-color:#ff8c00;\"><span style=\"font-family: \'times new roman\', times, serif; \">一言难尽</span></span></h1>\r\n', '<ol>\r\n	<li>\r\n		控制起飞</li>\r\n	<li>\r\n		下降</li>\r\n	<li>\r\n		侦查</li>\r\n</ol>\r\n', '应用场景描述以及存在问题2.0.docx', '3', '1', '2012-12-17 23:57:13', '6', null, '0000-00-00 00:00:00', '1', '50');
INSERT INTO `originality` VALUES ('2', '情景智能', '小明、小红', '<blockquote>\r\n	<p>\r\n		<span style=\"background-color:lime;\">情景的智能化是将来的一大趋势<img alt=\";)\" src=\"http://localhost:8082/cxcy/Public/ckeditor/plugins/smiley/images/wink_smile.gif\" title=\";)\" /></span></p>\r\n</blockquote>\r\n', '<p>\r\n	<em><span style=\"color:#f00;\"><strong>这是一个非常有用的新技术<br />\r\n	</strong></span></em></p>\r\n<p>\r\n	概述如下：</p>\r\n', '<ul>\r\n	<li>\r\n		创</li>\r\n	<li>\r\n		意</li>\r\n	<li>\r\n		功</li>\r\n	<li>\r\n		能</li>\r\n	<li>\r\n		说</li>\r\n	<li>\r\n		明</li>\r\n</ul>\r\n', '2012-2013 Residential Agreement - Bruce Hall.pdf', '1', '0', '2012-12-17 00:13:22', '5', null, '0000-00-00 00:00:00', null, null);
INSERT INTO `originality` VALUES ('5', '智能商务', '你，我，他', '<p>\r\n	社会高速发展</p>\r\n', '<p>\r\n	<span style=\"background-color:#ffa500;\">嗯，概述一下</span></p>\r\n', '<p>\r\n	a啊啊啊</p>\r\n', '000000.txt', '2', '0', '2012-12-16 14:39:45', null, '1', '0000-00-00 00:00:00', '1', '92');
INSERT INTO `originality` VALUES ('6', '智能就业', '小何、小李', '<p>\r\n	<span style=\"font-size:22px;\"><span style=\"color: rgb(255, 165, 0); \"><u><strong>就业是个严重的问题</strong></u></span></span></p>\r\n', '<p>\r\n	&nbsp;</p>\r\n<table border=\"1\" cellpadding=\"1\" cellspacing=\"1\" style=\"width: 200px; \">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n				1</td>\r\n			<td>\r\n				2</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				3</td>\r\n			<td>\r\n				4</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				5</td>\r\n			<td>\r\n				6</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	&nbsp;</p>', '<ol>\r\n	<li>\r\n		<span style=\"font-size:20px;\">凡<br />\r\n		</span></li>\r\n	<li>\r\n		<span style=\"font-size:20px;\">是<br />\r\n		</span></li>\r\n	<li>\r\n		<span style=\"font-size:20px;\">就<br />\r\n		</span></li>\r\n	<li>\r\n		<span style=\"font-size:20px;\">业<br />\r\n		</span></li>\r\n	<li>\r\n		<span style=\"font-size:20px;\">的<br />\r\n		</span></li>\r\n	<li>\r\n		<span style=\"font-size:20px;\">功<br />\r\n		</span></li>\r\n	<li>\r\n		<span style=\"font-size:20px;\">能<br />\r\n		</span></li>\r\n	<li>\r\n		<span style=\"font-size:20px;\">都<br />\r\n		</span></li>\r\n	<li>\r\n		<span style=\"font-size:20px;\">有<br />\r\n		</span></li>\r\n</ol>\r\n', '11月.png', '21', '1', '2012-12-17 00:22:10', '3', null, null, null, null);
INSERT INTO `originality` VALUES ('7', '基于单芯片云计算机的系统移植', '高明、小红、陈7、王五', '<p>\r\n	<span style=\"font-size:16px;\"><em><strong>单芯片云计算机是云计算实现的另一种可靠渠道</strong></em></span></p>\r\n', '<p>\r\n	<span style=\"background-color:#f00;\">此种机器的研究属第一次</span></p>\r\n<p>\r\n	<span style=\"background-color: rgb(255, 0, 0); \">系统移植到此平台第一次</span></p>\r\n', '<ol>\r\n	<li>\r\n		实现操作系统功能</li>\r\n	<li>\r\n		搭载毕业的驱动</li>\r\n</ol>\r\n', 'o-week.png', '8', '0', '2012-12-17 00:34:37', null, '1', null, '1', '95');

-- ----------------------------
-- Table structure for `originalitycomment`
-- ----------------------------
DROP TABLE IF EXISTS `originalitycomment`;
CREATE TABLE `originalitycomment` (
  `ocid` int(11) NOT NULL AUTO_INCREMENT,
  `content` text,
  `commentername` varchar(20) DEFAULT NULL,
  `originalityid` int(11) DEFAULT NULL,
  `commentTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ocid`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of originalitycomment
-- ----------------------------
INSERT INTO `originalitycomment` VALUES ('4', '好样的！！！\r\n加油~', '陈2', '2', '2012-12-08 15:01:45');
INSERT INTO `originalitycomment` VALUES ('5', '回复陈2：回我自己。。', '陈2', '2', '2012-12-08 15:10:51');
INSERT INTO `originalitycomment` VALUES ('6', '回复陈2：谢谢！呵呵', '张三', '2', '2012-12-08 15:17:13');
INSERT INTO `originalitycomment` VALUES ('7', '你也不错嘛！', '张三', '1', '2012-12-08 15:18:05');
INSERT INTO `originalitycomment` VALUES ('8', '回复张三：你们俩都不错啊！', '李四', '1', '2012-12-08 21:58:44');
INSERT INTO `originalitycomment` VALUES ('9', '好！', 't4', '5', '2012-12-16 22:27:29');
INSERT INTO `originalitycomment` VALUES ('10', '回复t4：老师好棒！', '张三', '5', '2012-12-16 22:59:10');
INSERT INTO `originalitycomment` VALUES ('11', '回复张三：分数给得很合理！', '陈7', '5', '2012-12-17 00:23:49');

-- ----------------------------
-- Table structure for `originalityreview`
-- ----------------------------
DROP TABLE IF EXISTS `originalityreview`;
CREATE TABLE `originalityreview` (
  `originalityid` int(11) DEFAULT NULL,
  `teacherid` int(11) DEFAULT NULL,
  `comment` varchar(1024) DEFAULT NULL,
  `mark` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of originalityreview
-- ----------------------------
INSERT INTO `originalityreview` VALUES ('5', '5', '有创造力和执行力！！', '95');
INSERT INTO `originalityreview` VALUES ('5', '10', '题目非常新颖', '90');
INSERT INTO `originalityreview` VALUES ('5', '11', '还是挺不错的', '88');
INSERT INTO `originalityreview` VALUES ('1', '9', null, null);
INSERT INTO `originalityreview` VALUES ('1', '10', null, null);
INSERT INTO `originalityreview` VALUES ('1', '11', null, null);
INSERT INTO `originalityreview` VALUES ('7', '3', '结合目前最新的研究热点，非常好', '95');
INSERT INTO `originalityreview` VALUES ('7', '5', null, '90');
INSERT INTO `originalityreview` VALUES ('7', '9', null, '96');

-- ----------------------------
-- Table structure for `participation`
-- ----------------------------
DROP TABLE IF EXISTS `participation`;
CREATE TABLE `participation` (
  `lectureid` int(11) DEFAULT NULL,
  `stuid` int(11) DEFAULT NULL,
  `certificationstatus` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of participation
-- ----------------------------

-- ----------------------------
-- Table structure for `pathofodeclaredtable`
-- ----------------------------
DROP TABLE IF EXISTS `pathofodeclaredtable`;
CREATE TABLE `pathofodeclaredtable` (
  `path` varchar(1024) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of pathofodeclaredtable
-- ----------------------------
INSERT INTO `pathofodeclaredtable` VALUES ('附件1——创意申报表.doc');

-- ----------------------------
-- Table structure for `reviewrule`
-- ----------------------------
DROP TABLE IF EXISTS `reviewrule`;
CREATE TABLE `reviewrule` (
  `rrid` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(100) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`rrid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of reviewrule
-- ----------------------------
INSERT INTO `reviewrule` VALUES ('1', '评审工作的基本原则', '<p>\r\n	&nbsp;</p>\r\n<p class=\"MsoNormal\" style=\"text-indent:28.0pt;mso-char-indent-count:2.0;\r\nline-height:35.0pt;mso-line-height-rule:exactly\">\r\n	<span lang=\"EN-US\" style=\"font-size:14.0pt;font-family:宋体\">1</span><span style=\"font-size:14.0pt;\r\nfont-family:宋体\">、评审过程中综合考虑作品的文化创意水平、与北京市社会经济和城市发展相关度、与天津本土文化特色结合度、可操作性和实际应用价值等方面因素。<span lang=\"EN-US\"><o:p></o:p></span></span></p>\r\n<p class=\"MsoNormal\" style=\"text-indent:28.0pt;mso-char-indent-count:2.0;\r\nline-height:35.0pt;mso-line-height-rule:exactly\">\r\n	<span lang=\"EN-US\" style=\"font-size:14.0pt;font-family:宋体\">2</span><span style=\"font-size:14.0pt;\r\nfont-family:宋体\">、评审要先进行预选，选出<span lang=\"EN-US\">10</span>强作品进入决赛，决赛经评审委员会现场提问评选出特等奖一项、一等奖一项、二等奖两项、三等奖两项。<span lang=\"EN-US\"><o:p></o:p></span></span></p>\r\n<p class=\"MsoNormal\" style=\"text-indent:28.0pt;mso-char-indent-count:2.0;\r\nline-height:35.0pt;mso-line-height-rule:exactly\">\r\n	<span lang=\"EN-US\" style=\"font-size:14.0pt;font-family:宋体\">3</span><span style=\"font-size:14.0pt;\r\nfont-family:宋体\">、评审实行保密制度。在评审结束前，任何评委不得以任何方式对外宣布、泄露评审情况和结果。<span lang=\"EN-US\"><o:p></o:p></span></span></p>\r\n<p class=\"MsoNormal\" style=\"text-indent:28.0pt;mso-char-indent-count:2.0;\r\nline-height:35.0pt;mso-line-height-rule:exactly\">\r\n	<span lang=\"EN-US\" style=\"font-size:14.0pt;font-family:宋体\">4</span><span style=\"font-size:14.0pt;\r\nfont-family:宋体\">、评审委员会的评审工作按评审实施细则规定执行。<span lang=\"EN-US\"><o:p></o:p></span></span></p>\r\n');

-- ----------------------------
-- Table structure for `student`
-- ----------------------------
DROP TABLE IF EXISTS `student`;
CREATE TABLE `student` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `stuno` varchar(11) DEFAULT NULL,
  `sname` varchar(20) DEFAULT NULL,
  `spassword` varchar(32) DEFAULT NULL,
  `issurveyed` int(11) DEFAULT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of student
-- ----------------------------
INSERT INTO `student` VALUES ('1', '110', '张三', '5F93F983524DEF3DCA464469D2CF9F3E', '1');
INSERT INTO `student` VALUES ('2', '111', '李四', '698D51A19D8A121CE581499D7B701668', '1');
INSERT INTO `student` VALUES ('3', '112', '陈2', '7F6FFAA6BB0B408017B62254211691B5', '1');
INSERT INTO `student` VALUES ('6', '115', '陈5', '2B44928AE11FB9384C4CF38708677C48', '1');
INSERT INTO `student` VALUES ('8', '117', '陈7', '698D51A19D8A121CE581499D7B701668', '1');
INSERT INTO `student` VALUES ('9', '118', '陈8', null, null);
INSERT INTO `student` VALUES ('10', '119', '陈9', null, null);
INSERT INTO `student` VALUES ('11', '120', '陈10', null, null);
INSERT INTO `student` VALUES ('14', '123', '陈13', null, null);
INSERT INTO `student` VALUES ('16', '125', '陈15', null, null);
INSERT INTO `student` VALUES ('17', '126', '陈16', null, null);
INSERT INTO `student` VALUES ('19', '128', '陈18', null, null);
INSERT INTO `student` VALUES ('20', '129', '陈19', null, null);
INSERT INTO `student` VALUES ('21', 'root', 'root', '63A9F0EA7BB98050796B649E85481845', '1');

-- ----------------------------
-- Table structure for `stuff`
-- ----------------------------
DROP TABLE IF EXISTS `stuff`;
CREATE TABLE `stuff` (
  `stuffid` int(11) NOT NULL AUTO_INCREMENT,
  `usrname` varchar(20) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `secondpwd` varchar(32) DEFAULT NULL,
  `role` int(11) DEFAULT NULL,
  `teachername` varchar(20) DEFAULT NULL,
  `teachertitle` varchar(40) DEFAULT NULL,
  `major` varchar(1024) DEFAULT NULL,
  `area` varchar(1024) DEFAULT NULL,
  `teacherdescription` text,
  PRIMARY KEY (`stuffid`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of stuff
-- ----------------------------
INSERT INTO `stuff` VALUES ('1', 'admin', '202cb962ac59075b964b07152d234b70', '81dc9bdb52d04dc20036dbd8313ed055', '0', null, null, null, null, null);
INSERT INTO `stuff` VALUES ('2', '小王', '202CB962AC59075B964B07152D234B70', null, '0', null, null, null, null, null);
INSERT INTO `stuff` VALUES ('3', 't1', '83F1535F99AB0BF4E9D02DFD85D3E3F7', null, '1', '李老师', '教授', '计算机', '软件服务工程', '<p>\r\n	<u><strong><span style=\"background-color: rgb(0, 0, 205);\">开拓者</span></strong></u></p>\r\n');
INSERT INTO `stuff` VALUES ('5', 't2', '0f826a89cf68c399c5f4cf320c1a5842', null, '1', '李强', '教授', '计算机', '数据挖掘', '<p>\r\n	<span style=\"color: rgb(0, 0, 0); font-size: 9pt; line-height: 18px; text-align: justify; font-family: 宋体; \"><strong>主讲课程</strong>：《动画原理》、《故事版创作原理》、《美术设计》、《导演与制作》</span><span lang=\"EN-US\" style=\"color: rgb(0, 0, 0); font-family: \'Trebuchet MS\', Verdana, Arial, Helvetica, sans-serif; font-size: 9pt; line-height: 18px; text-align: justify; \"><br />\r\n	<font face=\"Times New Roman\">&nbsp;<br />\r\n	</font></span><span style=\"color:#f00;\"><span style=\"font-size: 9pt; line-height: 18px; text-align: justify; font-family: 宋体; \"><strong>影视动画作品创作情况：</strong></span><span lang=\"EN-US\" style=\"font-family: \'Trebuchet MS\', Verdana, Arial, Helvetica, sans-serif; font-size: 9pt; line-height: 18px; text-align: justify; \"><br />\r\n	<font face=\"Times New Roman\">1989</font></span><span style=\"font-size: 9pt; line-height: 18px; text-align: justify; font-family: 宋体; \">年在长春电影制片厂出品的动画片《医生与皇帝》担任导演。获广电部首届</span></span></p>\r\n');
INSERT INTO `stuff` VALUES ('9', 't3', '202cb962ac59075b964b07152d234b70', null, '1', '王老师', '副教授', '计算机', '测试', '');
INSERT INTO `stuff` VALUES ('10', 't4', '202cb962ac59075b964b07152d234b70', null, '1', '陈老师', '副教授', '计算机', '数据挖掘', '');
INSERT INTO `stuff` VALUES ('11', 't5', '202cb962ac59075b964b07152d234b70', null, '1', '张老师', '讲师', '计算机', '嵌入式', '');
INSERT INTO `stuff` VALUES ('12', 'root', '63A9F0EA7BB98050796B649E85481845', null, '1', 'root老师', '教授', null, null, null);

-- ----------------------------
-- Table structure for `teacherselection`
-- ----------------------------
DROP TABLE IF EXISTS `teacherselection`;
CREATE TABLE `teacherselection` (
  `studentid` int(11) DEFAULT NULL,
  `teacherid` int(11) DEFAULT NULL,
  `Intention` int(11) DEFAULT NULL,
  `selectionstatus` int(11) DEFAULT NULL,
  `projectoutline` varchar(1024) DEFAULT NULL,
  `adminid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of teacherselection
-- ----------------------------
INSERT INTO `teacherselection` VALUES ('21', '12', '100', '2', 'jyqxz3xgq.rar###21.cyds.student', null);
