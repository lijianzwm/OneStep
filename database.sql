CREATE TABLE os_user(
  id INT(20) NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT '主键id,自增',
  username VARCHAR(20) NOT NULL COMMENT '登录用户名',
  password VARCHAR(32) NOT NULL COMMENT '登录密码',
  nickname VARCHAR(20) NOT NULL COMMENT '昵称'
)ENGINE = InnoDB DEFAULT CHARSET = utf8;


CREATE TABLE os_note(
  id INT(20) NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT '主键id,自增',
  userid INT(20) NOT NULL COMMENT '用户id',
  title VARCHAR(200) NOT NULL COMMENT '笔记标题',
  content LONGTEXT DEFAULT NULL COMMENT '笔记内容',
  `date` DATE NOT NULL COMMENT '笔记日期'
)ENGINE=InnoDB DEFAULT CHARSET=utf8;