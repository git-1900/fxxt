<?php
defined('IN_IA') or exit('Access Denied');


$sql = "
CREATE TABLE `ims_bj_qmxk_msg_template` (
  `weid` int(10) NOT NULL,
  `template` varchar(5000) NOT NULL,
  `tkey` varchar(10) NOT NULL,
  `tenable` tinyint(4) NOT NULL DEFAULT '0',
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS  `ims_bj_qmxk_follow` (
  `weid` int(10) unsigned NOT NULL,
  `leader` varchar(100) NOT NULL,
  `follower` varchar(100) NOT NULL,
  `channel` int(10) NOT NULL DEFAULT '0' COMMENT '渠道唯一标示符',
  `credit` int(10) NOT NULL DEFAULT '0',
  `createtime` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`weid`,`leader`,`follower`,`channel`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS  `ims_bj_qmxk_qr` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `qr_url` varchar(1024) NOT NULL,
  `createtime` int(11) NOT NULL,
  `expiretime` int(11) NOT NULL,
  `media_id` varchar(1024) NOT NULL,
  `channel` int(10) NOT NULL DEFAULT '0' COMMENT '渠道唯一标示符',
  `from_user` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `ims_bj_qmxk_channel` (
  `channel` int(10) NOT NULL AUTO_INCREMENT,
  `active` int(10) unsigned NOT NULL DEFAULT '0',
  `bg` varchar(1024) NOT NULL,
  `title` varchar(1024) NOT NULL,
  `bgparam` varchar(10240) NOT NULL,
  `notice` varchar(1024) NOT NULL,
  `click_credit` int(10) NOT NULL COMMENT '未关注的用户关注,送分享者积分',
  `sub_click_credit` int(10) NOT NULL COMMENT '未关注的用户关注,送上线积分',
  `newbie_credit` int(10) NOT NULL COMMENT '通过本渠道关注微信号，送新用户大礼包积分',
  `weid` int(10) unsigned NOT NULL,
  `createtime` int(10) unsigned NOT NULL DEFAULT '0',
  `msgtype` int(10) unsigned NOT NULL DEFAULT '1',
  `isdel`  int(5)  NOT NULL DEFAULT '0',
  PRIMARY KEY (`channel`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE `ims_bj_qmxk_phb_medal` (
  `fans_count` int(11) DEFAULT NULL,
  `medal_name` varchar(50) DEFAULT NULL,
  `weid` int(11) NOT NULL,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `ims_bj_qmxk_address` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `openid` varchar(50) NOT NULL,
  `realname` varchar(20) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `province` varchar(30) NOT NULL,
  `city` varchar(30) NOT NULL,
  `area` varchar(30) NOT NULL,
  `address` varchar(300) NOT NULL,
  `isdefault` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `deleted` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `ims_bj_qmxk_adv` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) DEFAULT '0',
  `advname` varchar(50) DEFAULT '',
  `link` varchar(255) NOT NULL DEFAULT '',
  `thumb` varchar(255) DEFAULT '',
  `displayorder` int(11) DEFAULT '0',
  `enabled` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `indx_weid` (`weid`),
  KEY `indx_enabled` (`enabled`),
  KEY `indx_displayorder` (`displayorder`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `ims_bj_qmxk_cart` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `goodsid` int(11) NOT NULL,
  `goodstype` tinyint(1) NOT NULL DEFAULT '1',
  `from_user` varchar(50) NOT NULL,
  `total` int(10) unsigned NOT NULL,
  `optionid` int(10) DEFAULT '0',
  `marketprice` decimal(10,2) DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `idx_openid` (`from_user`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `ims_bj_qmxk_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '所属帐号',
  `commission` int(10) unsigned DEFAULT '0' COMMENT '推荐该类商品所能获得的佣金',
  `name` varchar(50) NOT NULL COMMENT '分类名称',
  `thumb` varchar(255) NOT NULL COMMENT '分类图片',
  `parentid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '上级分类ID,0为第一级',
  `isrecommand` int(10) DEFAULT '0',
  `description` varchar(500) NOT NULL COMMENT '分类介绍',
  `displayorder` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `enabled` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否开启',
  `sn` varchar(30) DEFAULT '' COMMENT '分类编号',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `ims_bj_qmxk_commission` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `mid` int(10) unsigned NOT NULL COMMENT '粉丝ID',
  `ogid` int(10) unsigned DEFAULT NULL COMMENT '订单商品ID',
  `commission` decimal(10,2) unsigned NOT NULL COMMENT '佣金',
  `content` text,
  `flag` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0为账户充值记录，1为提现记录',
  `isout` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0为未导出，1为已导出',
  `isshare` int(11) DEFAULT NULL,
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `ims_bj_qmxk_credit_award` (
  `award_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `title` varchar(50) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL DEFAULT '0',
  `deadline` datetime NOT NULL,
  `credit_cost` int(11) NOT NULL DEFAULT '0',
  `price` int(11) NOT NULL DEFAULT '100',
  `content` text NOT NULL,
  `createtime` int(10) NOT NULL,
  PRIMARY KEY (`award_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `ims_bj_qmxk_credit_request` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `from_user` varchar(50) NOT NULL,
  `award_id` int(10) unsigned NOT NULL,
  `createtime` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `ims_bj_qmxk_dispatch` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) DEFAULT '0',
  `dispatchname` varchar(50) DEFAULT '',
  `dispatchtype` int(11) DEFAULT '0',
  `displayorder` int(11) DEFAULT '0',
  `firstprice` decimal(10,2) DEFAULT '0.00',
  `secondprice` decimal(10,2) DEFAULT '0.00',
  `firstweight` int(11) DEFAULT '0',
  `secondweight` int(11) DEFAULT '0',
  `express` int(11) DEFAULT '0',
  `description` text,
  PRIMARY KEY (`id`),
  KEY `indx_weid` (`weid`),
  KEY `indx_displayorder` (`displayorder`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `ims_bj_qmxk_express` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) DEFAULT '0',
  `express_name` varchar(50) DEFAULT '',
  `displayorder` int(11) DEFAULT '0',
  `express_price` varchar(10) DEFAULT '',
  `express_area` varchar(100) DEFAULT '',
  `express_url` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `indx_weid` (`weid`),
  KEY `indx_displayorder` (`displayorder`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `ims_bj_qmxk_feedback` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `openid` varchar(50) NOT NULL,
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1为维权，2为告擎',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态0未解决，1用户同意，2用户拒绝',
  `feedbackid` varchar(30) NOT NULL COMMENT '投诉单号',
  `transid` varchar(30) NOT NULL COMMENT '订单号',
  `reason` varchar(1000) NOT NULL COMMENT '理由',
  `solution` varchar(1000) NOT NULL COMMENT '期待解决方案',
  `remark` varchar(1000) NOT NULL COMMENT '备注',
  `createtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_weid` (`weid`),
  KEY `idx_feedbackid` (`feedbackid`),
  KEY `idx_createtime` (`createtime`),
  KEY `idx_transid` (`transid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `ims_bj_qmxk_goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `pcate` int(10) unsigned NOT NULL DEFAULT '0',
  `ccate` int(10) unsigned NOT NULL DEFAULT '0',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1为实体，2为虚拟',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `displayorder` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL DEFAULT '',
  `thumb` varchar(255) DEFAULT '',
  `xsthumb` varchar(255) DEFAULT '',
  `unit` varchar(5) NOT NULL DEFAULT '',
  `description` varchar(1000) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `goodssn` varchar(50) NOT NULL DEFAULT '',
  `productsn` varchar(50) NOT NULL DEFAULT '',
  `marketprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `productprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `costprice` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total` int(10) NOT NULL DEFAULT '0',
  `totalcnf` int(11) DEFAULT '0' COMMENT '0 拍下减库存 1 付款减库存 2 永久不减',
  `sales` int(10) unsigned NOT NULL DEFAULT '0',
  `spec` varchar(5000) NOT NULL,
  `createtime` int(10) unsigned NOT NULL,
  `weight` decimal(10,2) NOT NULL DEFAULT '0.00',
  `credit` int(11) DEFAULT '0',
  `maxbuy` int(11) DEFAULT '0',
  `hasoption` int(11) DEFAULT '0',
  `dispatch` int(11) DEFAULT '0',
  `thumb_url` text,
  `isnew` int(11) DEFAULT '0',
  `ishot` int(11) DEFAULT '0',
  `issendfree` int(11) DEFAULT '0',
  `isdiscount` int(11) DEFAULT '0',
  `isrecommand` int(11) DEFAULT '0',
  `istime` int(11) DEFAULT '0',
  `timestart` int(11) DEFAULT '0',
  `timeend` int(11) DEFAULT '0',
  `viewcount` int(11) DEFAULT '0',
  `deleted` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `commission2` int(3) DEFAULT NULL,
    `commission3` int(3) DEFAULT NULL,
  `commission` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `ims_bj_qmxk_goods_option` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goodsid` int(10) DEFAULT '0',
  `title` varchar(50) DEFAULT '',
  `thumb` varchar(60) DEFAULT '',
  `productprice` decimal(10,2) DEFAULT '0.00',
  `marketprice` decimal(10,2) DEFAULT '0.00',
  `costprice` decimal(10,2) DEFAULT '0.00',
  `stock` int(11) DEFAULT '0',
  `weight` decimal(10,2) DEFAULT '0.00',
  `displayorder` int(11) DEFAULT '0',
  `specs` text,
  PRIMARY KEY (`id`),
  KEY `indx_goodsid` (`goodsid`),
  KEY `indx_displayorder` (`displayorder`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `ims_bj_qmxk_goods_param` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goodsid` int(10) DEFAULT '0',
  `title` varchar(50) DEFAULT '',
  `value` text,
  `displayorder` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `indx_goodsid` (`goodsid`),
  KEY `indx_displayorder` (`displayorder`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `ims_bj_qmxk_member` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `shareid` int(11) DEFAULT NULL,
  `from_user` varchar(50) NOT NULL,
  `realname` varchar(20) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `pwd` varchar(20) NOT NULL,
  `bankcard` varchar(20) DEFAULT NULL,
  `banktype` varchar(20) DEFAULT NULL,
  `alipay` varchar(100) DEFAULT NULL,
  `wxhao` varchar(100) DEFAULT NULL,
  `commission` decimal(10,2) unsigned DEFAULT '0.00' COMMENT '已结佣佣金',
  `zhifu` decimal(10,2) unsigned DEFAULT '0.00' COMMENT '已打款佣金',
  `content` text,
  `createtime` int(10) NOT NULL,
  `flagtime` int(10) DEFAULT NULL COMMENT '为成推广人的时间',
  `status` tinyint(1) DEFAULT '1' COMMENT '0为禁用，1为可用',
  `flag` tinyint(1) DEFAULT '0' COMMENT '0为会推广人，1为推广人',
  `clickcount` int(11) NOT NULL DEFAULT '0' COMMENT '点击次数',
  `dzdflag`  tinyint(3) DEFAULT '0' COMMENT '店中店开启',
  `dzdtitle` varchar(100) DEFAULT '' COMMENT '店中店名称',
  `dzdsendtext` varchar(100) DEFAULT '' COMMENT '店中店转发话术',
  `credit2` double DEFAULT '0'  COMMENT '余额',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `ims_bj_qmxk_order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `from_user` varchar(50) NOT NULL,
  `shareid` int(10) unsigned DEFAULT '0' COMMENT '推荐人ID',
  `ordersn` varchar(20) NOT NULL,
  `price` varchar(10) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '-1取消状态，0普通状态，1为已付款，2为已发货，3为成功',
  `sendtype` tinyint(1) unsigned NOT NULL COMMENT '1为快递，2为自提',
  `paytype` tinyint(1) unsigned NOT NULL COMMENT '1为余额，2为在线，3为到付',
  `transid` varchar(30) NOT NULL DEFAULT '0' COMMENT '微信支付单号',
  `goodstype` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `remark` varchar(1000) NOT NULL DEFAULT '',
  `addressid` int(10) unsigned NOT NULL,
  `expresscom` varchar(30) NOT NULL DEFAULT '',
  `expresssn` varchar(50) NOT NULL DEFAULT '',
  `express` varchar(200) NOT NULL DEFAULT '',
  `goodsprice` decimal(10,2) DEFAULT '0.00',
  `dispatchprice` decimal(10,2) DEFAULT '0.00',
  `dispatch` int(10) DEFAULT '0',
  `createtime` int(10) unsigned NOT NULL,
  `updatetime` int(10) DEFAULT '0' COMMENT '订单更新时间',
  `shareid2`  int(10) DEFAULT '0' COMMENT '2级代理id',
  `shareid3`  int(10) DEFAULT '0' COMMENT '3级代理id',
  `isrest` tinyint(1) DEFAULT '0' COMMENT '是否发生换货操作',
  `rsreson` varchar(500) DEFAULT ''  COMMENT '退货款退原因',
  `sendtime` int(10) NOT NULL DEFAULT '0' COMMENT '发货时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `ims_bj_qmxk_order_goods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `orderid` int(10) unsigned NOT NULL,
  `goodsid` int(10) unsigned NOT NULL,
  `commission` decimal(10,2) unsigned DEFAULT '0.00' COMMENT '该订单的推荐佣金',
  `commission2` decimal(10,2) unsigned DEFAULT '0.00' NULL,
   `commission3` decimal(10,2) unsigned DEFAULT '0.00' NULL,
  `applytime` int(10) unsigned DEFAULT NULL COMMENT '申请时间',
  `checktime` int(10) unsigned DEFAULT NULL COMMENT '审核时间',
  `status` tinyint(3) DEFAULT '0' COMMENT '申请状态，-2为标志删除，-1为审核无效，0为未申请，1为正在申请，2为审核通过',
  `content` text,
  `price` decimal(10,2) DEFAULT '0.00',
  `total` int(10) unsigned NOT NULL DEFAULT '1',
  `optionid` int(10) DEFAULT '0',
  `createtime` int(10) unsigned NOT NULL,
  `optionname` text,
  `applytime2` int(10) DEFAULT '0' COMMENT '2级申请时间',
  `checktime2` int(10) DEFAULT '0' COMMENT '2级审核时间',
  `applytime3` int(10) DEFAULT '0' COMMENT '3级申请时间',
  `checktime3` int(10) DEFAULT '0' COMMENT '3级审核时间',
  `status2`  tinyint(3) DEFAULT '0' COMMENT '2级申请状态',
  `status3`  tinyint(3) DEFAULT '0' COMMENT '3级申请状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `ims_bj_qmxk_product` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `goodsid` int(11) NOT NULL,
  `productsn` varchar(50) NOT NULL,
  `title` varchar(1000) NOT NULL,
  `marketprice` decimal(10,0) unsigned NOT NULL,
  `productprice` decimal(10,0) unsigned NOT NULL,
  `total` int(11) NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `spec` varchar(5000) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_goodsid` (`goodsid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `ims_bj_qmxk_rule` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT '',
  `rule` text,
  `terms` text,
  `createtime` int(10) NOT NULL,
  `gzurl` varchar(255) NOT NULL,
  `teamfy` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `ims_bj_qmxk_rules` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) NOT NULL,
  `rule` text,
  `terms` text,
  `createtime` int(10) NOT NULL,
  `commtime` int(5) NOT NULL DEFAULT '15' COMMENT '默认15天',
  `promotertimes` int(10) NOT NULL DEFAULT '1' COMMENT '1购买一单 成为会员 0无条件成为会员 2达到单数 3达到金额',
      `promotercount` int(10) NOT NULL DEFAULT '0' COMMENT '成为代理需要成交单数',
    `promotermoney` decimal(10,2) NOT NULL DEFAULT '0' COMMENT '成为代理需要成交总金额',
  `ischeck` tinyint(1) DEFAULT '1' COMMENT '0为未审核，1为审核',
  `clickcredit` int(10) NOT NULL DEFAULT '0' COMMENT '点击获取积分',
  `autofinishcktime` int(10) NOT NULL DEFAULT '0' COMMENT '自动收货检查',
  `jsapi_ticket` varchar(300) NOT NULL DEFAULT '' COMMENT 'jsapi_ticket',
  `jsapi_ticket_exptime` int(10) NOT NULL DEFAULT '0' COMMENT 'jsapi_ticket_exptime',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `ims_bj_qmxk_share_history` (
  `sharemid` int(11) DEFAULT NULL,
  `weid` int(11) DEFAULT NULL,
  `from_user` varchar(50) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
   `joinway` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '0默认驱动加入,1二维码加入',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `ims_bj_qmxk_spec` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weid` int(10) unsigned NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `displaytype` tinyint(3) unsigned NOT NULL,
  `content` text NOT NULL,
  `goodsid` int(11) DEFAULT '0',
  `displayorder` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `ims_bj_qmxk_spec_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weid` int(11) DEFAULT '0',
  `specid` int(11) DEFAULT '0',
  `title` varchar(255) DEFAULT '',
  `thumb` varchar(255) DEFAULT '',
  `show` int(11) DEFAULT '0',
  `displayorder` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `indx_weid` (`weid`),
  KEY `indx_specid` (`specid`),
  KEY `indx_show` (`show`),
  KEY `indx_displayorder` (`displayorder`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
ALTER TABLE `ims_bj_qmxk_member`  ADD INDEX `idx_member_from_user` (`from_user`);
ALTER TABLE `ims_bj_qmxk_member`  ADD INDEX `idx_weid` (`weid`);

CREATE TABLE IF NOT EXISTS `ims_bj_qmxk_pormotions` (
  `description` varchar(200) DEFAULT NULL COMMENT '描述(预留)',
  `endtime` int(10) NOT NULL COMMENT '束结时间',
  `starttime` int(10) NOT NULL COMMENT '开始时间',
  `condition` decimal(10,2) NOT NULL COMMENT '条件',
  `promoteType` int(11) NOT NULL COMMENT '0 按订单数包邮 1满额包邮',
  `weid` int(11) NOT NULL COMMENT '务号服id',
  `pname` varchar(100) NOT NULL COMMENT '名称',
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `ims_bj_qmxk_paylog` (
  `createtime` int(10) NOT NULL,
  `tag` varchar(100) NOT NULL,
  `fee` decimal(10,2) NOT NULL,
  `credit2` decimal(10,2) NOT NULL DEFAULT '0',
  `mid` int(10) NOT NULL COMMENT 'member id',
  `openid` varchar(40) NOT NULL,
  `weid` int(11) NOT NULL,
  `type` varchar(30) NOT NULL COMMENT 'usegold使用金额 addgold充值金额 usecredit使用积分 addcredit充值积分',
  `plid` bigint(20) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`plid`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `ims_bj_qmxk_credit_order` (
  `createtime` int(10) NOT NULL,
  `status` int(10) NOT NULL DEFAULT '0',
  `fee` decimal(10,2) NOT NULL,
  `transid` varchar(30) NOT NULL,
  `openid` varchar(40) NOT NULL,
  `weid` int(11) NOT NULL,
  `crid` varchar(32) NOT NULL,
  PRIMARY KEY (`crid`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
";

pdo_run($sql);