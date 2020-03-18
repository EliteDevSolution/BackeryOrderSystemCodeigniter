DROP TABLE IF EXISTS `address`;

CREATE TABLE `address` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `address` varchar(200) NOT NULL,
  `price` float(15,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `address` */

insert  into `address`(`id`,`address`,`price`) values (1,'West End Quay',40.00),(2,'First Delivery Point',37.50),(3,'4 Number Point',35.00),(4,'Best City 5 Point',15.00);

/*Table structure for table `cart` */

DROP TABLE IF EXISTS `cart`;

CREATE TABLE `cart` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `customer_id` int(9) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cart` */

/*Table structure for table `cart_data` */

DROP TABLE IF EXISTS `cart_data`;

CREATE TABLE `cart_data` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `cartid` int(9) NOT NULL,
  `productid` int(9) NOT NULL,
  `price` varchar(50) NOT NULL DEFAULT '0',
  `tax` varchar(50) DEFAULT '0',
  `realprice` varchar(50) NOT NULL DEFAULT '0',
  `qty` int(9) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`,`qty`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cart_data` */

/*Table structure for table `customer` */

DROP TABLE IF EXISTS `customer`;

CREATE TABLE `customer` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `businessname` varchar(200) NOT NULL,
  `abn` int(9) NOT NULL,
  `priceband` varchar(10) NOT NULL DEFAULT 'A',
  `deliveryaddress` varchar(200) NOT NULL,
  `role` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `customer` */

insert  into `customer`(`id`,`name`,`email`,`password`,`businessname`,`abn`,`priceband`,`deliveryaddress`,`role`) values (1,'admin','admin@123.com','123456','Bakery Order System',908908,'A','West Stone City',1),(2,'user1','user@123.com','123456','Test1',12321,'C','Stone house',0),(3,'user2','user@987.com','123456','bakery',128379,'A','Auritla tooler',0),(4,'user3','user@456.com','123456','bakery sys',18829,'B','Huixinag',0);

/*Table structure for table `holiday` */

DROP TABLE IF EXISTS `holiday`;

CREATE TABLE `holiday` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `customer_id` int(9) NOT NULL,
  `title` varchar(300) NOT NULL,
  `firstdate` varchar(50) NOT NULL,
  `lastdate` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `holiday` */

insert  into `holiday`(`id`,`customer_id`,`title`,`firstdate`,`lastdate`) values (2,2,'First holiday','20/07/2019','21/07/2019'),(3,3,'My funny holiday','27/07/2019','30/07/2019');

/*Table structure for table `order` */

DROP TABLE IF EXISTS `order`;

CREATE TABLE `order` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `customer_id` int(9) NOT NULL,
  `date` varchar(50) NOT NULL,
  `state` varchar(30) NOT NULL DEFAULT 'PENDING',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Data for the table `order` */

insert  into `order`(`id`,`customer_id`,`date`,`state`) values (1,2,'09/07/2019','PENDING'),(2,2,'10/07/2019','PENDING'),(3,2,'19/07/2019','PENDING'),(4,2,'27/07/2019','PENDING'),(5,3,'10/07/2019','PENDING'),(6,3,'11/07/2019','PENDING'),(7,3,'12/07/2019','PENDING'),(8,3,'13/07/2019','PENDING'),(9,3,'22/07/2019','PENDING'),(10,2,'11/07/2019','PENDING');

/*Table structure for table `order_item` */

DROP TABLE IF EXISTS `order_item`;

CREATE TABLE `order_item` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `orderid` int(9) NOT NULL,
  `productid` int(9) DEFAULT NULL,
  `price` varchar(50) DEFAULT '0',
  `tax` varchar(50) DEFAULT '0',
  `realprice` varchar(50) DEFAULT '0',
  `qty` int(9) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

/*Data for the table `order_item` */

insert  into `order_item`(`id`,`orderid`,`productid`,`price`,`tax`,`realprice`,`qty`) values (2,1,6,'14.52','$1.32 (0.1%)','13.2',2),(3,2,6,'14.52','$1.32 (0.1%)','13.2',3),(4,3,6,'14.52','$1.32 (0.1%)','13.2',5),(5,4,6,'14.52','$1.32 (0.1%)','13.2',6),(6,5,8,'33','$3.00 (0.1%)','30',3),(7,5,7,'35','$0.00 (0.0%)','35',3),(9,6,8,'33','$3.00 (0.1%)','30',4),(10,6,7,'35','$0.00 (0.0%)','35',4),(12,7,8,'33','$3.00 (0.1%)','30',5),(13,7,7,'35','$0.00 (0.0%)','35',5),(15,8,8,'33','$3.00 (0.1%)','30',6),(16,8,7,'35','$0.00 (0.0%)','35',6),(18,9,8,'33','$3.00 (0.1%)','30',1),(19,9,7,'35','$0.00 (0.0%)','35',1),(20,10,6,'14.52','$1.32 (0.1%)','13.2',4);

/*Table structure for table `product` */

DROP TABLE IF EXISTS `product`;

CREATE TABLE `product` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `pricea` float(15,2) DEFAULT NULL,
  `priceb` float(15,2) DEFAULT NULL,
  `pricec` float(15,2) DEFAULT NULL,
  `priced` float(15,2) DEFAULT NULL,
  `gst` int(2) NOT NULL DEFAULT '0',
  `description` text,
  `groupid` int(9) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `product` */

insert  into `product`(`id`,`name`,`pricea`,`priceb`,`pricec`,`priced`,`gst`,`description`,`groupid`) values (1,'Pastaies ABC',14.00,7.00,13.00,7.00,0,'Okay Good!',1),(5,'Pizzas ABQ',29.00,23.00,20.00,17.00,1,'OK!~~~~~~~~',3),(6,'Prisai',25.00,17.20,13.20,10.36,1,'ok',1),(7,'CackPizas',35.00,30.00,28.00,25.00,0,'ok good',3),(8,'Spageti trinsue',30.00,29.00,20.00,25.00,1,'okokoko',2);

/*Table structure for table `product_group` */

DROP TABLE IF EXISTS `product_group`;

CREATE TABLE `product_group` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `product_group` */

insert  into `product_group`(`id`,`name`) values (1,'Pastries'),(2,'Spageti'),(3,'Pizzas');

/*Table structure for table `standorders` */

DROP TABLE IF EXISTS `standorders`;

CREATE TABLE `standorders` (
  `customer_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `price` varchar(20) NOT NULL,
  `real_price` varchar(20) NOT NULL,
  `mon` varchar(20) DEFAULT NULL,
  `tue` varchar(20) DEFAULT NULL,
  `wed` varchar(20) DEFAULT NULL,
  `thu` varchar(20) DEFAULT NULL,
  `fri` varchar(20) DEFAULT NULL,
  `sat` varchar(20) DEFAULT NULL,
  `sun` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `standorders` */

insert  into `standorders`(`customer_id`,`product_id`,`price`,`real_price`,`mon`,`tue`,`wed`,`thu`,`fri`,`sat`,`sun`) values (2,6,'14.52','13.2','1','2','3','4','5','6','7'),(3,8,'33','30','1','2','3','4','5','6','7'),(3,7,'35','35','1','2','3','4','5','6','7');

/* Procedure structure for procedure `get_available_rooms` */

/*!50003 DROP PROCEDURE IF EXISTS  `get_available_rooms` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`hotel`@`localhost` PROCEDURE `get_available_rooms`(IN o_room_type varchar(50), IN o_checkin_date varchar(50), IN o_checkout_date varchar(50))
BEGIN
SELECT * FROM `room` WHERE room_type=o_room_type AND NOT EXISTS (
SELECT room_id FROM reservation WHERE reservation.room_id=room.room_id AND checkout_date >= o_checkin_date AND checkin_date <= o_checkout_date
UNION ALL
SELECT room_id FROM room_sales WHERE room_sales.room_id=room.room_id AND checkout_date >= o_checkin_date AND checkin_date <= o_checkout_date
);
END */$$
DELIMITER ;

/* Procedure structure for procedure `get_customers` */

/*!50003 DROP PROCEDURE IF EXISTS  `get_customers` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`hotel`@`localhost` PROCEDURE `get_customers`(IN today_date varchar(50))
BEGIN
SELECT * FROM `room_sales` NATURAL JOIN `customer` WHERE checkout_date >= today_date AND checkin_date <= today_date;
END */$$
DELIMITER ;

/* Procedure structure for procedure `todays_service_count` */

/*!50003 DROP PROCEDURE IF EXISTS  `todays_service_count` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`hotel`@`localhost` PROCEDURE `todays_service_count`(IN today_date varchar(50))
BEGIN
SELECT count(*) as amount, "laundry" as type FROM laundry_service WHERE laundry_date=today_date UNION ALL SELECT count(*) as amount, "massage" as type FROM massage_service WHERE massage_date=today_date UNION ALL SELECT count(*) as amount, "roomservice" as type FROM get_roomservice WHERE roomservice_date=today_date UNION ALL SELECT count(*) as amount, "medicalservice" as type FROM get_medicalservice WHERE medicalservice_date=today_date UNION ALL SELECT count(*) as amount, "sport" as type FROM do_sport WHERE dosport_date=today_date
UNION ALL SELECT count(*) as amount, "restaurant" as type FROM restaurant_booking WHERE book_date=today_date;
END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
