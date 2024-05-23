CREATE TABLE IF NOT EXISTS `consumer` (
    `姓名` char(4) NOT NULL,
    `性別` char(1) DEFAULT '男',
    `來自縣市` char(4)  DEFAULT '台北市',
    `E-mail` char(50) NOT NULL,
    `密碼` char(50) NOT NULL,
    `手機號碼` char(10) DEFAULT NULL,
    
    PRIMARY KEY (`E-mail`),
    UNIQUE KEY `手機號碼` (`手機號碼`)
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS store (
    `店家名稱` CHAR( 50 ) NOT NULL ,
    `負責人姓名` CHAR( 5 ) NOT NULL ,
    `負責人手機號碼` char(10) DEFAULT NULL,
    `E-mail` char(50) NOT NULL,
    `店家電話` char(10) DEFAULT NULL,
    `店家地址` char(50) NOT NULL,
    `密碼` char(50) NOT NULL,

    PRIMARY KEY ( `E-mail` ),
    UNIQUE KEY `負責人手機號碼` (`負責人手機號碼`)

) DEFAULT CHARSET = utf8;
