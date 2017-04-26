DROP TABLE IF EXISTS kuaidian_admin;
CREATE TABLE kuaidian_admin(
  id tinyint(3) unsigned not null auto_increment,
  username char(64) not null comment '账号',
  password char(32) not null comment '密码',
  addtime int(11) not null comment '注册时间',
  status tinyint(1) unsigned not null default '1' comment '状态： 1-启用 0-禁用',
  primary key (id)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 comment '管理员表';
INSERT INTO ehuo_admin VALUES('1','root','c4481fb4f4b282f18d2de6935fcdb627','1481212449',1);

DROP TABLE IF EXISTS kuaidian_category;
CREATE TABLE kuaidian_category(
	id int unsigned not null auto_increment,
	name varchar(32) not null default '' comment '分类名称',
	store_id int unsigned DEFAULT null comment '店铺id',
	cat_addtime int(11) unsigned not null default '0' comment '添加时间',
	status tinyint(1) unsigned not null DEFAULT '1' comment '状态：1-启用 0-禁用',
	primary key (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 comment '菜品分类表';

DROP TABLE IF EXISTS kuaidian_goods;
CREATE TABLE kuaidian_goods(
	id int unsigned not null auto_increment,
	store_id int  unsigned not null comment '店铺id',
	cat_id int unsigned not null comment '餐品分类id',
	goods_name varchar(128) not null default '' comment '菜名',
	goods_price decimal(10,2)  not null DEFAULT '0.00'  comment '价格',
	goods_pic varchar(255) DEFAULT NULL comment '配图',
	goods_sm_pic varchar(255) DEFAULT NULL comment '略缩图',
	sale_num int(12) not null DEFAULT '0' comment '餐品数量',
	is_recommend tinyint(1) not null DEFAULT '0' comment '是否推荐：1-是，0-否',
	addtime int(11) not null DEFAULT '0' comment '添加时间',
	primary key (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 comment '菜品信息表';
 
DROP TABLE IF EXISTS kuaidian_menu;
CREATE TABLE kuaidian_menu(
	id int unsigned not null auto_increment,
	text varchar(32) not null  default '' comment '菜单内容',
	module varchar(32) not null default '' comment '模块',
	action varchar(32) not null default '' comment '操作',
	href varchar(255) not null default '' comment '链接地址',
	pid int not null default '0' comment '父id',
	sort int not null default '0' comment '菜单排序',
	homepage int not null default '0' comment '默认打开的首页',
	status tinyint(1) not null default '1' comment '菜单状态：1-正常，0-禁用',
	primary key (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 comment '菜单信息表';

/*DROP TABLE IF EXISTS kuaidian_order;
CREATE TABLE kuaidian_order(
	id int unsigned not null auto_increment ,
	user_id int DEFAULT null comment '用户id',
	store_id int  not null comment '店铺id',
	store_name varchar(64) not null comment '店铺名称',
	store_logo varchar(255) DEFAULT null comment '店铺logo',
	goods_id int DEFAULT null comment '菜品id',
	goods_name varchar(128) DEFAULT null comment '菜品名称',
	goods_price decimal(10,2) DEFAULT null comment '菜品价格',
	goods_num int(12) DEFAULT null comment '菜品数量',
	total decimal(10,2) default '0.00' comment '总价',
	address varchar(255) DEFAULT null comment '送餐地址',
	tel varchar(11) DEFAULT null comment '联系方式',
	mark varchar(255) DEFAULT null comment '备注',
	status tinyint(1) not null DEFAULT '0' comment '状态：1-已完成，0-派送中',
	addtimes int  default null comment '下单时间',
	day varchar(128) DEFAULT null comment '',
	primary key (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 comment '订单表';*/

DROP TABLE IF EXISTS kuaidian_order;
CREATE TABLE kuaidian_order(
	id int unsigned not null auto_increment ,
	user_id int DEFAULT null comment '用户id',
	store_id int  not null comment '店铺id',
	total_price decimal(10,2) default '0.00' comment '定单总价',
	scr_name varchar(64) not null comment '联系人',
	scr_tel varchar(11) DEFAULT null comment '收餐电话',
	scr_address varchar(255) DEFAULT null comment '收餐地址',
	room_time int  default null comment '送餐时间',
	payment_method tinyint(1) not null DEFAULT '0' comment '状态：0-餐到付款，1-在线支付',
	mark varchar(255) DEFAULT null comment '备注',
	add_times int  default null comment '下单时间',
	order_number varchar(16) DEFAULT null comment '订单号',
	pay_status tinyint unsigned not null default '0' comment '支付状态，0：未支付 1：已支付',
    post_status tinyint unsigned not null default '0' comment '送餐状态，0：未送餐 1：已送餐 2：已收餐',
	primary key (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 comment '订单基本信息表';
ALTER TABLE kuaidian_order ADD pick_status tinyint unsigned not null default '0' comment '摘单状态，0：禁止摘单 1：允许摘单 2：未摘单 3：已摘单';

DROP TABLE IF EXISTS kuaidian_order_goods;
CREATE TABLE kuaidian_order_goods(	
	order_number varchar(16)  DEFAULT null comment '订单号',
	store_id int  not null comment '店铺id',
    user_id mediumint unsigned not null comment '用户id',
    goods_id mediumint unsigned not null comment '菜品id',
    goods_price decimal(10,2) not null comment '菜品的价格',
    goods_number int unsigned not null comment '购买的数量',
    key order_number(order_number),
    key goods_id(goods_id),
    key user_id(user_id),
    key store_id(store_id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 comment '订单菜品表';

DROP TABLE IF EXISTS kuaidian_store;
CREATE TABLE kuaidian_store(
	id int unsigned not null auto_increment,
	username varchar(64) not null comment '用户名',
	password char(32) not null comment '密码',
	truename varchar(64) default null comment '真实姓名',
	tel varchar(11) not null comment '联系方式',
	storename varchar(128) default null comment '店铺名称',
	storeaddress varchar(255) default null comment '店铺的地址',
	storedesc longtext default null comment '店铺的描述',
	logo varchar(255) not null default '' comment '店铺的logo',
	sm_logo varchar(255) not null default '' comment '店铺的略缩图logo',
	addtime int(11) not null default '0' comment '添加时间',
	status tinyint(1) not null default '0' comment '状态：1-正常，0-禁用',
	ischeck tinyint(1) not null default '0' comment '是否通过审核：1-是，0-否',
	primary key (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 comment '店铺信息表';

DROP TABLE IF EXISTS kuaidian_user;
CREATE TABLE kuaidian_user(
	id int unsigned not null auto_increment,
	username varchar(64) not null comment '用户名',
	password char(32) not null comment '密码',
	addtime int(11)  not null comment '添加时间',
	status tinyint(1) not null default '1' comment '状态：1-正常，0-禁用',
	primary key (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 comment '注册用户表';
ALTER TABLE kuaidian_users ADD money decimal(10,2) not null default '0.00' comment '担保金';

DROP TABLE IF EXISTS kuaidian_pick;
CREATE TABLE kuaidian_pick(
	id int unsigned not null auto_increment,
	order_number varchar(16)  DEFAULT null comment '订单号',
	pick_price decimal(10,2) not null comment '摘单价格',
	pick_user  varchar(64) not null comment '摘单用户',
	status tinyint(1) not null default '1' comment '状态：1-完成，0-未完成',
	pick_time int(11)  not null comment '摘单时间',
	primary key (id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 comment '摘单列表';

DROP TABLE IF EXISTS kuaidian_privilege;
CREATE TABLE kuaidian_privilege
(
	id smallint unsigned not null auto_increment,
	pri_name varchar(30) not null comment '权限名称',
	module_name varchar(20) not null comment '模块名称',
	controller_name varchar(20) not null comment '控制器名称',
	action_name varchar(20) not null comment '方法名称',
	parent_id smallint unsigned not null default '0' comment '上级权限的ID，0：代表顶级权限',
	primary key (id)
)engine=InnoDB default charset=utf8 comment '权限表';

DROP TABLE IF EXISTS kuaidian_role;
CREATE TABLE kuaidian_role
( 
    id smallint unsigned not null auto_increment,
    role_name varchar(30) not null comment '角色名称',
    primary key(id)
)engine=InnoDB default charset=utf8 comment '角色表';

DROP TABLE IF EXISTS kuaidian_role_privilege;
CREATE TABLE kuaidian_role_privilege
(
	pri_id smallint unsigned not null comment '权限的ID',
	role_id smallint unsigned not null comment '角色的id',
	key pri_id(pri_id),
	key role_id(role_id)
)engine=InnoDB default charset=utf8 comment '角色权限表';

DROP TABLE IF EXISTS kuaidian_admin_role;
CREATE TABLE kuaidian_admin_role
(
	admin_id tinyint unsigned not null comment '管理员的id',
	role_id smallint unsigned not null comment '角色的id',
	key admin_id(admin_id),
	key role_id(role_id)
)engine=InnoDB default charset=utf8 comment '管理员角色表';

DROP TABLE IF EXISTS kuaidian_store_privilege;
CREATE TABLE kuaidian_store_privilege
(
	id smallint unsigned not null auto_increment,
	pri_name varchar(30) not null comment '权限名称',
	module_name varchar(20) not null comment '模块名称',
	controller_name varchar(20) not null comment '控制器名称',
	action_name varchar(20) not null comment '方法名称',
	parent_id smallint unsigned not null default '0' comment '上级权限的ID，0：代表顶级权限',
	primary key (id)
)engine=InnoDB default charset=utf8 comment '店铺权限表';