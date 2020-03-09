/*
SQLyog Community Edition- MySQL GUI v8.12
MySQL - 5.5.16 : Database - school
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`school` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `school`;

/*Table structure for table `academicyear` */

DROP TABLE IF EXISTS `academicyear`;

CREATE TABLE `academicyear` (
  `AcademicYearId` int(11) NOT NULL AUTO_INCREMENT,
  `AcademicYear` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`AcademicYearId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `academicyear` */

insert  into `academicyear`(`AcademicYearId`,`AcademicYear`) values (1,'2010-2011'),(2,'2011-2012'),(3,'2012-2013');

/*Table structure for table `attendence` */

DROP TABLE IF EXISTS `attendence`;

CREATE TABLE `attendence` (
  `InstituteId` int(10) DEFAULT NULL,
  `AttendenceId` int(10) NOT NULL AUTO_INCREMENT,
  `RollNo` varchar(10) DEFAULT NULL,
  `Year` varchar(10) DEFAULT NULL,
  `MonthId` smallint(2) DEFAULT NULL,
  `TotalDays` float DEFAULT '0',
  `Morning` smallint(2) DEFAULT '0',
  `Afternoon` smallint(2) DEFAULT '0',
  PRIMARY KEY (`AttendenceId`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Data for the table `attendence` */

insert  into `attendence`(`InstituteId`,`AttendenceId`,`RollNo`,`Year`,`MonthId`,`TotalDays`,`Morning`,`Afternoon`) values (1,13,'1','2011-2012',12,2.5,6,0),(NULL,14,'2','2011-2012',12,2.5,6,0);

/*Table structure for table `book` */

DROP TABLE IF EXISTS `book`;

CREATE TABLE `book` (
  `InstituteId` int(10) DEFAULT NULL,
  `BookId` int(10) NOT NULL AUTO_INCREMENT,
  `BookName` varchar(256) NOT NULL,
  `BookCode` varchar(10) NOT NULL,
  `BookCategoryId` int(10) NOT NULL,
  `BookAuthor` varchar(256) NOT NULL,
  `BookVolume` varchar(10) DEFAULT NULL,
  `BookEdition` varchar(10) DEFAULT NULL,
  `BookStatus` tinyint(1) NOT NULL,
  `BookDes` text,
  PRIMARY KEY (`BookId`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Data for the table `book` */

insert  into `book`(`InstituteId`,`BookId`,`BookName`,`BookCode`,`BookCategoryId`,`BookAuthor`,`BookVolume`,`BookEdition`,`BookStatus`,`BookDes`) values (1,1,'Ilakiyam','b1',1,'kalki','9','first',1,NULL),(1,2,'Tamil Novel','b2',1,'sujatha','8','second',1,NULL),(1,3,'Tamil Essays','b3',1,'jeyakanthan','7','third',1,NULL),(1,4,'Grammar','b4',2,'wren and martin','9','first',1,NULL),(1,5,'Oliver Twist','b5',2,'Christopher','7','fifth',1,NULL),(1,6,'Shakespear\'s plays','b6',2,'Johns','6','fourth',1,NULL),(1,7,'Letter Writing','b7',2,'Martina','5','first',1,NULL),(2,8,'Algebra','b1',7,'Chelly','8','second',1,NULL),(2,9,'Geometry','b2',7,'Siberschatz','5','third',1,NULL),(2,10,'Statistics','b3',7,'balagurusamy','3','fifth',1,NULL),(2,11,'Java','b4',8,'Kannan','6','fourth',1,NULL),(2,12,'PHP','b5',8,'jeyanth','2','first',1,NULL),(2,13,'DBMS','b6',8,'Lakshman','3','second',1,NULL),(2,14,'Operating System','b7',8,'Harish','2','third',1,NULL);

/*Table structure for table `bookcategory` */

DROP TABLE IF EXISTS `bookcategory`;

CREATE TABLE `bookcategory` (
  `InstituteId` int(10) DEFAULT NULL,
  `BookCategoryId` int(10) NOT NULL AUTO_INCREMENT,
  `BookCategory` varchar(256) NOT NULL,
  `BookCategoryDes` text,
  PRIMARY KEY (`BookCategoryId`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `bookcategory` */

insert  into `bookcategory`(`InstituteId`,`BookCategoryId`,`BookCategory`,`BookCategoryDes`) values (1,1,'Tamil',NULL),(1,2,'English',NULL),(1,3,'Maths',NULL),(1,4,'Science',NULL),(1,5,'Social',NULL),(1,6,'ComputerScience',NULL),(2,7,'Maths',NULL),(2,8,'ComputerScience',NULL),(2,9,'Politics',NULL),(2,10,'Economics',NULL),(2,11,'Researches',NULL);

/*Table structure for table `bookcode` */

DROP TABLE IF EXISTS `bookcode`;

CREATE TABLE `bookcode` (
  `InstituteId` int(10) DEFAULT NULL,
  `BookCodeId` int(10) NOT NULL AUTO_INCREMENT,
  `BookCode` varchar(10) NOT NULL,
  `BookCategoryId` int(10) NOT NULL,
  `BookCodeDes` text,
  PRIMARY KEY (`BookCodeId`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Data for the table `bookcode` */

insert  into `bookcode`(`InstituteId`,`BookCodeId`,`BookCode`,`BookCategoryId`,`BookCodeDes`) values (1,1,'b1',1,'dgfgdfg'),(1,2,'b2',1,'yyyy'),(1,3,'b3',1,'t4t4'),(1,4,'b4',2,NULL),(1,5,'b5',2,NULL),(1,6,'b6',2,NULL),(1,7,'b7',2,NULL),(2,8,'b1',1,NULL),(2,9,'b2',1,NULL),(2,10,'b3',1,NULL),(2,11,'b4',2,NULL),(2,12,'b5',2,NULL),(2,13,'b6',2,NULL),(2,14,'b7',2,NULL);

/*Table structure for table `castcategory` */

DROP TABLE IF EXISTS `castcategory`;

CREATE TABLE `castcategory` (
  `InstituteId` int(10) DEFAULT NULL,
  `CastCategoryId` int(10) NOT NULL AUTO_INCREMENT,
  `CastCategory` varchar(256) NOT NULL,
  `CastCategoryDes` text,
  PRIMARY KEY (`CastCategoryId`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `castcategory` */

insert  into `castcategory`(`InstituteId`,`CastCategoryId`,`CastCategory`,`CastCategoryDes`) values (1,1,'OC','eerreeeeeeeee'),(1,2,'BC-A','fgfgfg'),(1,3,'BC-B',NULL),(1,4,'BC-C',NULL),(1,5,'BC-D',NULL),(1,6,'ST',NULL),(2,7,'BC',NULL),(2,8,'SC',NULL),(2,9,'OC',NULL),(2,10,'FC',NULL);

/*Table structure for table `classexamfeestype` */

DROP TABLE IF EXISTS `classexamfeestype`;

CREATE TABLE `classexamfeestype` (
  `InstituteId` int(10) DEFAULT NULL,
  `ClassExamFeesTypeId` smallint(5) NOT NULL AUTO_INCREMENT,
  `ClassId` smallint(5) DEFAULT NULL,
  `NoOfSubjects` varchar(50) DEFAULT NULL,
  `ExamFees` float DEFAULT NULL,
  `Year` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`ClassExamFeesTypeId`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=latin1;

/*Data for the table `classexamfeestype` */

insert  into `classexamfeestype`(`InstituteId`,`ClassExamFeesTypeId`,`ClassId`,`NoOfSubjects`,`ExamFees`,`Year`) values (1,1,1,'1',50,'2011-2012'),(1,2,1,'2',100,'2011-2012'),(1,3,1,'3',150,'2011-2012'),(1,4,1,'4',200,'2011-2012'),(1,5,1,'5',250,'2011-2012'),(1,6,1,'6',300,'2011-2012'),(1,7,2,'1',150,'2011-2012'),(1,8,2,'2',200,'2011-2012'),(1,9,2,'3',250,'2011-2012'),(1,10,2,'4',300,'2011-2012'),(1,11,2,'5',350,'2011-2012'),(1,12,2,'6',400,'2011-2012'),(1,13,3,'1',250,NULL),(1,14,3,'2',300,NULL),(1,15,3,'3',350,NULL),(1,16,3,'4',400,NULL),(1,17,3,'5',450,NULL),(1,18,3,'6',500,NULL),(1,19,4,'1',350,NULL),(1,20,4,'2',400,NULL),(1,21,4,'3',450,NULL),(1,22,4,'4',500,NULL),(1,23,4,'5',550,NULL),(1,24,4,'6',600,NULL),(1,25,5,'1',450,NULL),(1,26,5,'2',500,NULL),(1,27,5,'3',550,NULL),(1,28,5,'4',600,NULL),(1,29,5,'5',650,NULL),(1,30,5,'6',700,NULL),(1,31,6,'1',500,NULL),(1,32,6,'2',550,NULL),(1,33,6,'3',600,NULL),(1,34,6,'4',650,NULL),(1,35,6,'5',700,NULL),(1,36,6,'6',750,NULL),(1,37,7,'1',550,NULL),(1,38,7,'2',600,NULL),(1,39,7,'3',650,NULL),(1,40,7,'4',700,NULL),(1,41,7,'5',750,NULL),(1,42,7,'6',800,NULL),(1,43,8,'1',550,NULL),(1,44,8,'2',600,NULL),(1,45,8,'3',650,NULL),(1,46,8,'4',700,NULL),(1,47,8,'5',750,NULL),(1,48,8,'6',800,NULL),(1,49,9,'1',600,NULL),(1,50,9,'2',650,NULL),(1,51,9,'3',700,NULL),(1,52,9,'4',750,NULL),(1,53,9,'5',800,NULL),(1,54,9,'6',850,NULL),(1,55,10,'1',650,NULL),(1,56,10,'2',700,NULL),(1,57,10,'3',750,NULL),(1,58,10,'4',800,NULL),(1,59,10,'5',850,NULL),(1,60,10,'6',900,NULL),(1,61,11,'1',700,NULL),(1,62,11,'2',750,NULL),(1,63,11,'3',800,NULL),(1,64,11,'4',850,NULL),(1,65,11,'5',900,NULL),(1,66,11,'6',950,NULL),(1,67,12,'1',700,NULL),(1,68,12,'2',750,NULL),(1,69,12,'3',800,NULL),(1,70,12,'4',850,NULL),(1,71,12,'5',900,NULL),(1,72,12,'6',950,NULL),(1,73,13,'1',700,NULL),(1,74,13,'2',750,NULL),(1,75,13,'3',800,NULL),(1,76,13,'4',850,NULL),(1,77,13,'5',900,NULL),(2,78,1,'1',950,NULL),(2,79,1,'2',1000,NULL),(2,80,1,'3',1050,NULL),(2,81,2,'1',950,NULL),(2,82,2,'2',1000,NULL),(2,83,2,'3',1050,NULL);

/*Table structure for table `classfees` */

DROP TABLE IF EXISTS `classfees`;

CREATE TABLE `classfees` (
  `InstituteId` int(10) DEFAULT NULL,
  `ClassFeeId` int(11) NOT NULL AUTO_INCREMENT,
  `ClassId` int(11) DEFAULT NULL,
  `ClassFees` double(10,2) DEFAULT NULL,
  `ClassDes` text,
  `Year` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`ClassFeeId`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

/*Data for the table `classfees` */

insert  into `classfees`(`InstituteId`,`ClassFeeId`,`ClassId`,`ClassFees`,`ClassDes`,`Year`) values (1,1,1,50.00,NULL,'2011-2012'),(1,2,2,100.00,NULL,'2011-2012'),(1,3,3,100.00,NULL,'2011-2012'),(1,4,4,200.00,NULL,'2011-2012'),(1,5,1,100.00,NULL,'2012-2013'),(1,6,2,200.00,NULL,'2012-2013'),(1,7,3,200.00,NULL,'2012-2013'),(1,8,4,300.00,NULL,'2012-2013'),(2,9,9,50.00,NULL,'2011-2012'),(2,10,10,100.00,NULL,'2011-2012'),(2,11,11,200.00,NULL,'2011-2012'),(2,12,9,100.00,NULL,'2012-2013'),(2,13,10,100.00,NULL,'2012-2013'),(2,14,11,300.00,NULL,'2012-2013'),(2,15,14,3000.00,NULL,'2012-2013'),(2,16,12,5000.00,NULL,'2012-2013'),(2,17,15,1000.00,NULL,'2012-2013');

/*Table structure for table `classrollnumbers` */

DROP TABLE IF EXISTS `classrollnumbers`;

CREATE TABLE `classrollnumbers` (
  `InstituteId` int(10) DEFAULT NULL,
  `ClassRollId` int(11) NOT NULL AUTO_INCREMENT,
  `ClassId` int(11) NOT NULL,
  `SectionId` int(11) NOT NULL,
  `RollNumberId` int(11) NOT NULL,
  `StudentId` int(11) NOT NULL,
  PRIMARY KEY (`ClassRollId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `classrollnumbers` */

insert  into `classrollnumbers`(`InstituteId`,`ClassRollId`,`ClassId`,`SectionId`,`RollNumberId`,`StudentId`) values (1,1,3,1,1,7),(2,2,16,2,1,8);

/*Table structure for table `classsubject` */

DROP TABLE IF EXISTS `classsubject`;

CREATE TABLE `classsubject` (
  `InstituteId` int(10) DEFAULT NULL,
  `ClassSubjectId` int(11) NOT NULL AUTO_INCREMENT,
  `ClassId` smallint(2) DEFAULT NULL,
  `SubjectId` smallint(2) DEFAULT NULL,
  PRIMARY KEY (`ClassSubjectId`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;

/*Data for the table `classsubject` */

insert  into `classsubject`(`InstituteId`,`ClassSubjectId`,`ClassId`,`SubjectId`) values (1,1,1,1),(1,2,2,1),(1,3,2,2),(1,7,3,1),(1,8,3,2),(1,9,3,3),(1,10,4,1),(1,11,4,2),(1,12,4,3),(1,13,4,4),(1,14,5,1),(1,15,5,2),(1,16,5,3),(1,17,5,4),(1,18,5,5),(1,19,6,1),(1,20,6,2),(1,21,6,3),(1,22,7,1),(1,23,7,2),(1,24,7,3),(1,25,7,4),(1,26,8,1),(1,27,8,2),(1,28,8,4),(2,29,10,6),(2,30,10,7),(2,31,9,6),(2,32,9,7),(2,33,11,6),(2,34,11,7),(2,35,11,8),(2,36,11,9),(2,37,11,10),(2,38,12,6),(2,39,12,9),(2,40,12,10),(2,41,12,11),(2,42,13,6),(2,43,13,7),(2,44,13,8),(2,45,13,9),(2,54,14,7),(2,55,14,12),(2,56,14,11);

/*Table structure for table `course` */

DROP TABLE IF EXISTS `course`;

CREATE TABLE `course` (
  `InstituteId` int(10) DEFAULT NULL,
  `ClassId` int(5) NOT NULL AUTO_INCREMENT,
  `ClassName` varchar(10) NOT NULL,
  `ClassDes` text,
  PRIMARY KEY (`ClassId`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

/*Data for the table `course` */

insert  into `course`(`InstituteId`,`ClassId`,`ClassName`,`ClassDes`) values (1,1,'Nursery',NULL),(1,2,'LKG',NULL),(1,3,'UKG',NULL),(1,4,'I',NULL),(1,5,'II',NULL),(1,6,'III',NULL),(1,7,'IV',NULL),(1,8,'V',NULL),(2,9,'LKG',NULL),(2,10,'Playschool',NULL),(2,11,'I',NULL),(2,12,'II',NULL),(2,13,'III',NULL),(2,14,'IV',''),(2,15,'V','');

/*Table structure for table `dailyattendence` */

DROP TABLE IF EXISTS `dailyattendence`;

CREATE TABLE `dailyattendence` (
  `InstituteId` int(10) DEFAULT NULL,
  `AttendenceId` int(1) NOT NULL AUTO_INCREMENT,
  `RollNo` int(11) DEFAULT NULL,
  `MonthId` smallint(2) DEFAULT NULL,
  `Attendance` bit(1) DEFAULT NULL,
  `SessionId` smallint(1) DEFAULT NULL,
  `AttendDate` date DEFAULT NULL,
  `Year` varchar(10) DEFAULT NULL,
  `Name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`AttendenceId`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;

/*Data for the table `dailyattendence` */

insert  into `dailyattendence`(`InstituteId`,`AttendenceId`,`RollNo`,`MonthId`,`Attendance`,`SessionId`,`AttendDate`,`Year`,`Name`) values (1,43,1,1,'',1,'2012-12-25','2011-2012','gg'),(1,44,2,12,'',1,'2012-12-25','2011-2012','ram'),(1,45,1,1,'',1,'2012-12-25','2011-2012','venky'),(1,46,2,12,'',1,'2012-12-25','2011-2012','hh'),(1,47,1,1,'',1,'2012-12-25','2011-2012',NULL),(2,48,2,12,'',1,'2012-12-25','2011-2012',NULL),(2,49,1,1,'',1,'2012-12-25','2011-2012',NULL),(2,50,2,12,'',1,'2012-12-25','2011-2012',NULL),(1,51,1,1,'',1,'2012-12-25','2011-2012',NULL),(1,52,2,12,'',1,'2012-12-25','2011-2012',NULL),(1,53,1,1,'',1,'2012-12-25','2011-2012',NULL),(1,54,2,12,'\0',1,'2012-12-25','2011-2012',NULL),(1,55,6,1,'',1,'2013-01-02','2011-2012',NULL),(2,56,50,1,'',1,'2013-01-02','2011-2012',NULL);

/*Table structure for table `daylist` */

DROP TABLE IF EXISTS `daylist`;

CREATE TABLE `daylist` (
  `DayId` smallint(1) NOT NULL AUTO_INCREMENT,
  `DayName` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`DayId`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `daylist` */

insert  into `daylist`(`DayId`,`DayName`) values (1,'Monday'),(2,'Tuesday'),(3,'Wednesday'),(4,'Thursday'),(5,'Friday'),(6,'Saturday');

/*Table structure for table `exam` */

DROP TABLE IF EXISTS `exam`;

CREATE TABLE `exam` (
  `InstituteId` int(10) DEFAULT NULL,
  `ExamId` int(10) NOT NULL AUTO_INCREMENT,
  `ExamType` varchar(256) NOT NULL,
  `ExamMarks` int(5) NOT NULL,
  `Year` varchar(100) NOT NULL,
  `ExamDes` text,
  PRIMARY KEY (`ExamId`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

/*Data for the table `exam` */

insert  into `exam`(`InstituteId`,`ExamId`,`ExamType`,`ExamMarks`,`Year`,`ExamDes`) values (1,1,'Quarterly',50,'2011-2012',NULL),(1,2,'Halfyearly',50,'2011-2012',NULL),(1,3,'Annual',100,'2011-2012',NULL),(1,4,'Quarterly',50,'2012-2013',NULL),(1,5,'Midterm',25,'2012-2013',NULL),(1,6,'Halfyearly',75,'2012-2013',NULL),(1,7,'Annual',100,'2012-2013',NULL),(2,8,'Monthly',20,'2011-2012',NULL),(2,9,'Quarterly',50,'2011-2012',NULL),(2,10,'Halfyearly',100,'2011-2012',NULL),(2,11,'Assignment',20,'2012-2013',NULL),(2,12,'Quarterly',50,'2012-2013',NULL),(2,13,'Halfyearly',100,'2012-2013',NULL),(2,14,'Annual',200,'2012-2013',NULL),(2,15,'test1',50,'','');

/*Table structure for table `examfee` */

DROP TABLE IF EXISTS `examfee`;

CREATE TABLE `examfee` (
  `InstituteId` int(10) DEFAULT NULL,
  `ExamFeeId` int(10) NOT NULL AUTO_INCREMENT,
  `StudentId` varchar(10) DEFAULT NULL,
  `ExamTypeId` int(10) DEFAULT NULL,
  `ExamFeeClass` smallint(5) DEFAULT NULL,
  `ExamFee` double(5,2) DEFAULT NULL,
  `NoOfSubjects` smallint(2) DEFAULT NULL,
  `Subjects` varchar(500) DEFAULT NULL,
  `ReceiptNo` int(10) DEFAULT NULL,
  `PaidDate` date DEFAULT NULL,
  `Year` varchar(100) DEFAULT NULL,
  `ExamFeeDes` text,
  PRIMARY KEY (`ExamFeeId`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `examfee` */

insert  into `examfee`(`InstituteId`,`ExamFeeId`,`StudentId`,`ExamTypeId`,`ExamFeeClass`,`ExamFee`,`NoOfSubjects`,`Subjects`,`ReceiptNo`,`PaidDate`,`Year`,`ExamFeeDes`) values (1,1,'1',4,1,700.00,2,'1,2',1,'2013-12-10','2012-2013',NULL),(1,2,'2',4,1,700.00,2,'1,2',2,'2013-12-13','2012-2013',NULL),(1,3,'3',4,1,700.00,3,'1,2,3',3,'2013-12-12','2012-2013',NULL),(1,4,'4',4,1,700.00,2,'1,2',4,'2013-12-14','2012-2013',NULL),(2,5,'13',11,9,500.00,3,'1,2,3',5,'2013-12-20','2012-2013',NULL),(2,6,'14',11,9,500.00,3,'1,2,3',6,'2013-12-17','2012-2013',NULL),(2,7,'15',11,9,500.00,3,'1,2,3',7,'2013-12-17','2012-2013',NULL),(2,8,'16',11,9,500.00,3,'1,2,3',8,'2013-12-20','2012-2013',NULL);

/*Table structure for table `examfeesclass` */

DROP TABLE IF EXISTS `examfeesclass`;

CREATE TABLE `examfeesclass` (
  `InstituteId` int(10) DEFAULT NULL,
  `ExamFeesClassId` smallint(5) NOT NULL AUTO_INCREMENT,
  `ClassId` smallint(5) DEFAULT NULL,
  PRIMARY KEY (`ExamFeesClassId`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `examfeesclass` */

insert  into `examfeesclass`(`InstituteId`,`ExamFeesClassId`,`ClassId`) values (1,1,1),(1,2,2),(1,3,3),(1,4,4),(1,5,5),(1,6,6),(1,7,7),(1,8,8),(2,9,9),(2,10,10),(2,11,11),(2,12,12),(2,13,13);

/*Table structure for table `expenditure` */

DROP TABLE IF EXISTS `expenditure`;

CREATE TABLE `expenditure` (
  `InstituteId` int(10) DEFAULT NULL,
  `ExpenditureId` int(10) NOT NULL AUTO_INCREMENT,
  `ExpenditureFor` text NOT NULL,
  `BillNo` int(10) NOT NULL,
  `Amount` double NOT NULL,
  `SpentBy` varchar(100) NOT NULL,
  `ReceivedBy` varbinary(100) NOT NULL,
  `SpendDate` date NOT NULL,
  `Year` varchar(100) NOT NULL,
  `Des` text,
  PRIMARY KEY (`ExpenditureId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `expenditure` */

insert  into `expenditure`(`InstituteId`,`ExpenditureId`,`ExpenditureFor`,`BillNo`,`Amount`,`SpentBy`,`ReceivedBy`,`SpendDate`,`Year`,`Des`) values (1,1,'rwrawrfwer',122,3333,'wrfwarfwa','r3re','2011-12-14','2011-2012',NULL),(1,2,'wrw3rwrr',1222,3344,'tgsdg','r3rrr','2011-12-14','2011-2012',NULL),(2,3,'ddfdfdfd',44444,3344,'sdvgsdgg','gsrg','2012-12-20','2011-2012',NULL);

/*Table structure for table `facultylist` */

DROP TABLE IF EXISTS `facultylist`;

CREATE TABLE `facultylist` (
  `InstituteId` int(10) DEFAULT NULL,
  `FacultyId` int(11) NOT NULL AUTO_INCREMENT,
  `TeacherId` int(11) DEFAULT NULL,
  `SubjectId` smallint(5) DEFAULT NULL,
  `Year` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`FacultyId`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `facultylist` */

insert  into `facultylist`(`InstituteId`,`FacultyId`,`TeacherId`,`SubjectId`,`Year`) values (NULL,1,1,1,'2011-2012'),(NULL,2,1,2,'2011-2012'),(NULL,3,1,5,'2011-2012'),(NULL,4,2,3,'2011-2012'),(NULL,5,2,4,'2011-2012'),(NULL,6,3,6,'2011-2012'),(NULL,7,4,7,'2011-2012'),(NULL,8,5,8,'2011-2012');

/*Table structure for table `hostelfees` */

DROP TABLE IF EXISTS `hostelfees`;

CREATE TABLE `hostelfees` (
  `InstituteId` int(10) DEFAULT NULL,
  `HostelFeeId` int(2) NOT NULL AUTO_INCREMENT,
  `ClassId` varchar(3) DEFAULT NULL,
  `HostelFees` double(10,2) DEFAULT NULL,
  `Year` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`HostelFeeId`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

/*Data for the table `hostelfees` */

insert  into `hostelfees`(`InstituteId`,`HostelFeeId`,`ClassId`,`HostelFees`,`Year`) values (1,1,'1',100.00,'2012-2013'),(1,2,'3',200.00,'2012-2013'),(1,3,'2',300.00,'2012-2013'),(1,4,'4',400.00,'2012-2013'),(1,5,'5',500.00,'2012-2013'),(1,6,'6',600.00,'2012-2013'),(1,7,'7',700.00,'2012-2013'),(1,8,'8',800.00,'2012-2013'),(2,9,'9',100.00,'2012-2013'),(2,10,'10',200.00,'2012-2013'),(2,11,'11',300.00,'2012-2013'),(2,12,'12',400.00,'2012-2013'),(2,13,'13',500.00,'2012-2013'),(2,17,'14',4000.00,'2012-2013'),(2,18,'15',500.00,'2012-2013');

/*Table structure for table `hostelrecord` */

DROP TABLE IF EXISTS `hostelrecord`;

CREATE TABLE `hostelrecord` (
  `InstituteId` int(10) DEFAULT NULL,
  `HostelRecordId` int(11) NOT NULL AUTO_INCREMENT,
  `StudentId` int(11) DEFAULT NULL,
  `HostelTermNo` int(5) DEFAULT NULL,
  `HostelTermFee` double DEFAULT NULL,
  `TermPaidDate` date DEFAULT NULL,
  `PaidBy` varchar(100) DEFAULT NULL,
  `Year` varchar(10) DEFAULT NULL,
  `HostelTermDes` text,
  PRIMARY KEY (`HostelRecordId`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

/*Data for the table `hostelrecord` */

insert  into `hostelrecord`(`InstituteId`,`HostelRecordId`,`StudentId`,`HostelTermNo`,`HostelTermFee`,`TermPaidDate`,`PaidBy`,`Year`,`HostelTermDes`) values (1,1,1,1,1000,'2012-11-17','ram','2012-2013',''),(1,2,2,1,3000,'2012-11-17','raj','2012-2013',''),(1,3,3,2,3000,'2012-11-17','ram','2012-2013',''),(1,4,4,1,4000,'2012-11-17','dev','2012-2013',''),(1,5,5,3,2000,'2012-11-18','raj','2012-2013',''),(1,6,6,1,1000,'2013-10-15','rahu','2012-2013',''),(1,7,7,1,900,'2013-11-07','ravi','2012-2013',''),(1,8,8,1,5000,'2013-11-06','selvi','2012-2013',''),(1,9,9,0,9888,'2013-11-09','priyaa','2012-2013',''),(1,11,11,1,999,'2013-11-14','nithya','2012-2013',''),(1,12,12,1,9000,'2013-11-05','saravanan','2012-2013',''),(2,13,13,2,890,'2013-11-10','jansi','2012-2013',''),(2,14,14,1,1000,'2013-11-15','angel','2012-2013',''),(2,15,15,2,90,'2013-11-27','hari','2012-2013',''),(2,16,16,0,4000,'2013-12-16','praba','2012-2013',''),(2,17,17,3,2000,'2013-12-16','niranjan','2012-2013',''),(2,19,18,1,2000,'2013-12-16','raki','2012-2013',''),(2,22,19,1,1000,'2013-12-10','jagan','2012-2013',NULL),(2,23,20,3,500,'2013-12-17','uma','2012-2013',NULL),(2,24,21,0,2000,'2013-12-10','hari','2012-2013',NULL),(2,25,22,1,1000,'2013-12-20','ranjan','2012-2013',NULL);

/*Table structure for table `hostelregister` */

DROP TABLE IF EXISTS `hostelregister`;

CREATE TABLE `hostelregister` (
  `InstituteId` int(10) DEFAULT NULL,
  `HostelRegId` int(11) NOT NULL AUTO_INCREMENT,
  `StudentId` int(11) DEFAULT NULL,
  `HostelFee` double DEFAULT NULL,
  `HostelFeeDiscount` float DEFAULT NULL,
  `HostelJoinDate` date DEFAULT NULL,
  `Year` varchar(10) DEFAULT NULL,
  `HostelDes` text,
  PRIMARY KEY (`HostelRegId`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

/*Data for the table `hostelregister` */

insert  into `hostelregister`(`InstituteId`,`HostelRegId`,`StudentId`,`HostelFee`,`HostelFeeDiscount`,`HostelJoinDate`,`Year`,`HostelDes`) values (1,1,1,8000,1000,'2012-11-17','2012-2013',NULL),(1,2,2,7500,500,'2012-11-17','2012-2013',NULL),(1,3,3,16500,700,'2012-11-17','2012-2013',NULL),(1,4,4,500,10,'2012-11-17','2012-2013',NULL),(1,5,5,500,5,'2012-11-17','2012-2013',NULL),(1,6,6,17050,1000,'2012-11-17','2012-2013',NULL),(1,7,7,5000,200,'2013-12-05','2012-2013',NULL),(1,8,8,15000,1000,'2013-12-05','2012-2013',NULL),(1,9,9,15000,1000,'2013-12-05','2012-2013',NULL),(1,10,11,4000,2000,'2013-12-05','2012-2013',NULL),(1,11,12,3000,900,'2013-12-07','2012-2013',NULL),(2,12,13,3000,2000,'2013-12-16','2012-2013',NULL),(2,14,14,1000,900,'2013-12-16','2012-2013',NULL),(2,15,15,5000,1000,'2013-12-20','2012-2013',NULL),(2,16,16,17000,980,'2013-12-13','2012-2013',NULL),(2,17,17,800,10,'2013-12-20','2012-2013',NULL),(2,18,18,900,90,'2013-12-20','2012-2013',NULL),(2,19,19,2000,20,'2013-12-17','2012-2013',NULL),(2,20,20,1000,100,'2013-12-18','2012-2013',NULL),(2,21,21,600,60,'2013-12-21','2012-2013',NULL),(2,22,22,800,20,'2013-12-23','2012-2013',NULL);

/*Table structure for table `libraryrecord` */

DROP TABLE IF EXISTS `libraryrecord`;

CREATE TABLE `libraryrecord` (
  `InstituteId` int(10) DEFAULT NULL,
  `LibraryRecordId` int(10) DEFAULT NULL,
  `LibraryNo` varchar(5) NOT NULL,
  `BookCode` varchar(5) NOT NULL,
  `IssuedDate` date NOT NULL,
  `ReturnDate` date NOT NULL,
  `ReceivedDate` date DEFAULT NULL,
  `Year` varchar(10) DEFAULT NULL,
  `LibraryDes` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `libraryrecord` */

insert  into `libraryrecord`(`InstituteId`,`LibraryRecordId`,`LibraryNo`,`BookCode`,`IssuedDate`,`ReturnDate`,`ReceivedDate`,`Year`,`LibraryDes`) values (1,1,'1','b1','2013-10-16','2013-10-15',NULL,'2012-2013','calculation'),(1,2,'2','b2','2012-11-18','2013-10-10','2013-10-09','2012-2013',NULL),(1,3,'3','b3','2012-11-19','2013-10-09','2013-10-09','2012-2013',NULL),(1,4,'4','b4','2013-10-09','2013-10-09','2013-10-24','2012-2013',NULL),(1,5,'5','b5','2013-10-09','2013-10-09','2013-10-23','2012-2013',NULL),(1,6,'6','b6','2013-10-11','2013-10-11','2013-10-22','2012-2013',NULL),(1,7,'7','b7','2013-10-11','2013-10-10','2013-10-22','2012-2013',NULL),(1,8,'8','b1','2013-10-08','2013-10-10','2013-10-24','2012-2013',NULL),(1,9,'9','b2','2013-10-15','2013-10-15',NULL,'2012-2013',NULL),(1,11,'11','b3','2013-10-15','2013-10-17',NULL,'2012-2013',NULL),(1,12,'12','b4','2013-10-22','2013-10-21',NULL,'2012-2013',NULL),(2,13,'13','b1','2013-10-24','2013-10-23',NULL,'2012-2013',NULL),(2,14,'14','b2','2013-10-25','2013-10-24',NULL,'2012-2013',NULL),(2,15,'15','b3','2013-11-08','2013-11-07',NULL,'2012-2013',NULL),(2,18,'18','b6','2013-11-23','2013-11-12',NULL,'2012-2013',NULL),(2,17,'17','b5','2013-11-23','2013-11-02',NULL,'2012-2013',NULL),(2,18,'18','b6','2013-11-23','2013-11-12',NULL,'2012-2013',NULL),(2,19,'19','b7','2013-11-23','2013-11-12',NULL,'2012-2013',NULL),(2,20,'20','b1','2013-12-19','2013-12-21',NULL,'2012-2013',NULL),(2,21,'21','b2','2013-12-11','2013-12-14',NULL,'2012-2013',NULL),(2,22,'22','b3','2013-12-20','2013-12-22',NULL,'2012-2013',NULL);

/*Table structure for table `libraryreg` */

DROP TABLE IF EXISTS `libraryreg`;

CREATE TABLE `libraryreg` (
  `InstituteId` int(10) DEFAULT NULL,
  `LibraryId` int(10) NOT NULL AUTO_INCREMENT,
  `LibraryNo` varchar(10) NOT NULL,
  `StudentId` varchar(10) NOT NULL,
  `Year` varchar(10) DEFAULT NULL,
  `LibraryDes` text,
  PRIMARY KEY (`LibraryId`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

/*Data for the table `libraryreg` */

insert  into `libraryreg`(`InstituteId`,`LibraryId`,`LibraryNo`,`StudentId`,`Year`,`LibraryDes`) values (1,1,'1','1','2012-2013',NULL),(1,2,'2','2','2012-2013',NULL),(1,3,'3','3','2012-2013',NULL),(1,4,'4','4','2012-2013',NULL),(1,5,'5','5','2012-2013',NULL),(1,6,'6','6','2012-2013',NULL),(1,7,'7','7','2012-2013',NULL),(1,8,'8','8','2012-2013',NULL),(1,9,'9','9','2012-2013',NULL),(1,11,'11','11','2012-2013',NULL),(1,12,'12','12','2012-2013',NULL),(2,13,'13','13','2012-2013',NULL),(2,14,'14','14','2012-2013',NULL),(2,15,'15','15','2012-2013',NULL),(2,16,'16','16','2012-2013',NULL),(2,17,'17','17','2012-2013',NULL),(2,18,'18','18','2012-2013',NULL),(2,19,'19','19','2012-2013',NULL),(2,20,'20','20','2012-2013',NULL),(2,21,'21','21','2012-2013',NULL),(2,22,'22','22','2012-2013',NULL);

/*Table structure for table `mainmenu` */

DROP TABLE IF EXISTS `mainmenu`;

CREATE TABLE `mainmenu` (
  `MainMenuId` int(5) NOT NULL AUTO_INCREMENT,
  `MainMenuName` varchar(256) NOT NULL,
  `MainMenuDes` text,
  PRIMARY KEY (`MainMenuId`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `mainmenu` */

insert  into `mainmenu`(`MainMenuId`,`MainMenuName`,`MainMenuDes`) values (1,'Home',NULL),(2,'Admin',NULL),(3,'Student',NULL),(4,'Staff',NULL),(5,'Library',NULL),(6,'Settings',NULL);

/*Table structure for table `marks` */

DROP TABLE IF EXISTS `marks`;

CREATE TABLE `marks` (
  `InstituteId` int(10) DEFAULT NULL,
  `MarksId` int(10) NOT NULL AUTO_INCREMENT,
  `RollNo` varchar(10) NOT NULL,
  `ExamTypeId` int(5) NOT NULL,
  `SubjectId` int(5) NOT NULL,
  `TotalMarks` int(5) NOT NULL,
  `Marks` float NOT NULL,
  `Year` varchar(100) NOT NULL,
  `MarksDes` text,
  PRIMARY KEY (`MarksId`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

/*Data for the table `marks` */

insert  into `marks`(`InstituteId`,`MarksId`,`RollNo`,`ExamTypeId`,`SubjectId`,`TotalMarks`,`Marks`,`Year`,`MarksDes`) values (1,1,'1',1,1,25,20,'2011-2012','ram'),(1,2,'1',1,2,25,20,'2011-2012','fgfdg'),(1,3,'1',1,3,25,21,'2011-2012','8oy8yy'),(1,4,'1',1,4,25,21,'2011-2012',NULL),(1,5,'1',1,5,25,19,'2011-2012',NULL),(1,6,'1',1,6,25,23,'2011-2012',NULL),(1,7,'2',1,1,25,22,'2011-2012',NULL),(1,8,'2',1,2,25,21,'2011-2012',NULL),(1,9,'2',1,3,25,24,'2011-2012',NULL),(NULL,10,'2',1,4,24,19,'2011-2012',NULL),(NULL,11,'1',2,1,25,20,'2011-2012',NULL),(NULL,12,'1',2,2,25,21,'2011-2012',''),(NULL,13,'1',2,3,25,19,'2011-2012',NULL),(NULL,14,'1',2,4,25,22,'2012-2013',''),(NULL,15,'1',2,5,25,20,'2011-2012',NULL),(NULL,16,'1',1,3,25,50,'2012-2013','rrraji'),(NULL,17,'1',2,1,25,18,'2011-2012',''),(1,20,'56',2,3,25,76,'2012-2013','ccccc'),(1,21,'56',3,4,25,79,'2012-2013','lkg'),(1,22,'56',2,1,25,80,'2012-2013','vvv'),(1,23,'56',5,3,50,78,'2012-2013','kk'),(1,24,'56',2,7,25,70,'2012-2013','xxx'),(1,25,'56',2,2,25,88,'2012-2013','bbbbb'),(1,26,'56',2,2,25,80,'2012-2013','ffff'),(1,27,'19',3,6,25,85,'2012-2013','swaga'),(1,28,'17',2,3,25,20,'2012-2013','hindi'),(1,29,'10',3,3,25,78,'2012-2013','xxx'),(1,30,'24',2,3,25,90,'2012-2013','.mn,mn,mn'),(1,31,'14',5,5,50,90,'2012-2013','good'),(1,32,'50',10,1,98,99,'2012-2013','klp'),(1,33,'19',6,17,100,79,'2012-2013',''),(1,34,'23',6,2,100,900,'2012-2013',''),(1,35,'23',6,2,100,900,'2012-2013','');

/*Table structure for table `months` */

DROP TABLE IF EXISTS `months`;

CREATE TABLE `months` (
  `MonthNo` smallint(2) NOT NULL AUTO_INCREMENT,
  `MonthName` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`MonthNo`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `months` */

insert  into `months`(`MonthNo`,`MonthName`) values (1,'January'),(2,'Febrary'),(3,'March'),(4,'April'),(5,'May'),(6,'June'),(7,'July'),(8,'Auguest'),(9,'Spetember'),(10,'October'),(11,'November'),(12,'December');

/*Table structure for table `nationality` */

DROP TABLE IF EXISTS `nationality`;

CREATE TABLE `nationality` (
  `InstituteId` int(10) DEFAULT NULL,
  `NationalityId` int(2) NOT NULL AUTO_INCREMENT,
  `Nationality` varchar(100) NOT NULL,
  `NationalityDes` text,
  PRIMARY KEY (`NationalityId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `nationality` */

insert  into `nationality`(`InstituteId`,`NationalityId`,`Nationality`,`NationalityDes`) values (1,1,'Indian',NULL),(1,2,'Russian',NULL),(2,3,'Indian',NULL),(2,4,'Russian',NULL),(2,5,'Italian',NULL);

/*Table structure for table `periodtimings` */

DROP TABLE IF EXISTS `periodtimings`;

CREATE TABLE `periodtimings` (
  `InstituteId` int(10) DEFAULT NULL,
  `PeriodTimingId` int(11) NOT NULL AUTO_INCREMENT,
  `PeriodNo` smallint(2) DEFAULT NULL,
  `PeriodTime` varchar(50) DEFAULT NULL,
  `SessionId` smallint(2) DEFAULT NULL,
  `Year` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`PeriodTimingId`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `periodtimings` */

insert  into `periodtimings`(`InstituteId`,`PeriodTimingId`,`PeriodNo`,`PeriodTime`,`SessionId`,`Year`) values (1,1,1,'09.30-10.15',1,'2011-2012'),(1,2,2,'10.15-11.00',1,'2011-2012'),(1,3,3,'11.30-12.15',1,'2011-2012'),(1,4,4,'12.15-01.00',1,'2011-2012'),(1,5,5,'02.00-02.45',2,'2011-2012'),(1,6,6,'02.45-03.00',2,'2011-2012'),(2,7,7,'03.30-04.15',2,'2011-2012'),(2,8,8,'04.15-05.00',2,'2011-2012');

/*Table structure for table `roll` */

DROP TABLE IF EXISTS `roll`;

CREATE TABLE `roll` (
  `InstituteId` int(10) DEFAULT NULL,
  `RollId` int(10) NOT NULL AUTO_INCREMENT,
  `RollType` varchar(50) NOT NULL,
  `RollDes` text,
  PRIMARY KEY (`RollId`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `roll` */

insert  into `roll`(`InstituteId`,`RollId`,`RollType`,`RollDes`) values (1,1,'Admin',NULL),(1,2,'Staff1',NULL),(1,3,'Staff2',NULL),(2,4,'Admin',NULL),(2,5,'Staff1',NULL),(2,6,'Staff2',NULL),(2,7,'Staff9','');

/*Table structure for table `rollmenu` */

DROP TABLE IF EXISTS `rollmenu`;

CREATE TABLE `rollmenu` (
  `InstituteId` int(10) DEFAULT NULL,
  `RollMenuId` int(5) NOT NULL AUTO_INCREMENT,
  `RollId` int(11) NOT NULL,
  `MainMenuId` int(5) NOT NULL,
  `SubMenuId` int(5) NOT NULL,
  `RollMenuDes` text,
  PRIMARY KEY (`RollMenuId`),
  UNIQUE KEY `RollMenuId` (`RollMenuId`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

/*Data for the table `rollmenu` */

insert  into `rollmenu`(`InstituteId`,`RollMenuId`,`RollId`,`MainMenuId`,`SubMenuId`,`RollMenuDes`) values (1,1,1,1,0,''),(1,2,1,2,1,NULL),(1,3,1,2,2,NULL),(1,4,1,2,3,NULL),(1,5,1,2,4,NULL),(1,6,1,2,5,NULL),(1,7,1,2,6,NULL),(1,8,1,3,7,NULL),(1,9,1,3,8,NULL),(1,10,1,3,9,NULL),(1,11,1,3,10,NULL),(1,12,1,3,11,NULL),(NULL,13,1,4,12,NULL),(NULL,14,1,4,13,NULL),(NULL,15,1,5,14,NULL),(NULL,16,1,5,15,NULL),(NULL,17,1,5,16,NULL),(NULL,18,1,5,17,NULL),(NULL,19,1,6,18,NULL),(NULL,20,1,2,19,NULL);

/*Table structure for table `schoolfees` */

DROP TABLE IF EXISTS `schoolfees`;

CREATE TABLE `schoolfees` (
  `InstituteId` int(10) DEFAULT NULL,
  `SchoolFeeId` int(10) NOT NULL AUTO_INCREMENT,
  `StudentId` int(10) DEFAULT NULL,
  `Fees` double(10,2) DEFAULT NULL,
  `ReceiptNo` int(11) unsigned DEFAULT NULL,
  `TermNo` int(5) DEFAULT NULL,
  `PaidDate` date DEFAULT NULL,
  `Year` varchar(11) DEFAULT NULL,
  `SchoolFeeDes` text,
  PRIMARY KEY (`SchoolFeeId`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

/*Data for the table `schoolfees` */

insert  into `schoolfees`(`InstituteId`,`SchoolFeeId`,`StudentId`,`Fees`,`ReceiptNo`,`TermNo`,`PaidDate`,`Year`,`SchoolFeeDes`) values (1,1,1,0.00,0,0,'0000-00-00','2012-2013','0'),(1,2,2,0.00,0,0,'0000-00-00','2012-2013','0'),(1,3,3,0.00,0,0,'0000-00-00','2012-2013','0'),(1,4,4,0.00,0,0,'0000-00-00','2012-2013','0'),(1,5,5,0.00,0,0,'0000-00-00','2012-2013','0'),(1,6,6,0.00,0,0,'0000-00-00','2012-2013','0'),(1,7,7,0.00,0,0,'0000-00-00','2012-2013','0'),(1,8,8,0.00,0,0,'0000-00-00','2012-2013','0'),(1,9,9,0.00,0,0,'0000-00-00','2012-2013','0'),(1,11,11,0.00,0,0,'0000-00-00','2012-2013','0'),(1,12,12,0.00,0,0,'0000-00-00','2012-2013','0'),(2,13,13,0.00,0,0,'0000-00-00','2012-2013','0'),(2,14,14,0.00,0,0,'0000-00-00','2012-2013','0'),(2,15,15,0.00,0,0,'0000-00-00','2012-2013','0'),(2,16,16,0.00,0,0,'0000-00-00','2012-2013','0'),(2,17,17,0.00,0,0,'0000-00-00','2012-2013','0'),(2,18,18,0.00,0,0,'0000-00-00','2012-2013','0'),(2,19,19,0.00,0,0,'0000-00-00','2012-2013','0'),(2,20,20,0.00,0,0,'0000-00-00','2012-2013','0'),(2,21,21,0.00,0,0,'0000-00-00','2012-2013','0'),(2,22,22,0.00,0,0,'0000-00-00','2012-2013','0');

/*Table structure for table `section` */

DROP TABLE IF EXISTS `section`;

CREATE TABLE `section` (
  `InstituteId` int(10) DEFAULT NULL,
  `SectionId` smallint(3) NOT NULL AUTO_INCREMENT,
  `SectionName` varchar(3) DEFAULT NULL,
  `SectionDes` text,
  PRIMARY KEY (`SectionId`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `section` */

insert  into `section`(`InstituteId`,`SectionId`,`SectionName`,`SectionDes`) values (1,1,'A',NULL),(1,2,'B',NULL),(1,3,'C',NULL),(2,4,'A',NULL),(2,5,'B',NULL),(2,6,'C',NULL),(2,7,'D',NULL);

/*Table structure for table `sectionclass` */

DROP TABLE IF EXISTS `sectionclass`;

CREATE TABLE `sectionclass` (
  `InstituteId` int(10) DEFAULT NULL,
  `SectionClassId` int(10) NOT NULL AUTO_INCREMENT,
  `ClassId` int(10) DEFAULT NULL,
  `SectionId` int(10) DEFAULT NULL,
  `Year` varchar(10) DEFAULT NULL,
  `SectionClassDes` text,
  PRIMARY KEY (`SectionClassId`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

/*Data for the table `sectionclass` */

insert  into `sectionclass`(`InstituteId`,`SectionClassId`,`ClassId`,`SectionId`,`Year`,`SectionClassDes`) values (1,14,1,1,'2012-2013',NULL),(1,15,1,2,'2012-2013',NULL),(1,16,2,1,'2012-2013',NULL),(1,17,2,2,'2012-2013',NULL),(1,18,2,3,'2012-2013',NULL),(1,19,3,1,'2012-2013',NULL),(1,20,3,2,'2012-2013',NULL),(1,21,4,1,'2012-2013',NULL),(1,22,4,2,'2012-2013',NULL),(1,23,4,3,'2012-2013',NULL),(1,24,5,1,'2012-2013',NULL),(1,25,5,2,'2012-2013',NULL),(1,26,6,1,'2012-2013',NULL),(1,27,6,2,'2012-2013',NULL),(1,28,6,3,'2012-2013',NULL),(1,29,7,1,'2012-2013',NULL),(1,30,8,1,'2012-2013',NULL),(2,31,9,4,'2012-2013',NULL),(2,32,9,5,'2012-2013',NULL),(2,33,9,6,'2012-2013',NULL),(2,34,10,4,'2012-2013',NULL),(2,35,10,5,'2012-2013',NULL),(2,36,11,4,'2012-2013',NULL),(2,37,11,5,'2012-2013',NULL),(2,38,11,6,'2012-2013',NULL),(2,39,11,7,'2012-2013',NULL),(2,40,12,5,'2012-2013',NULL),(2,41,12,6,'2012-2013',NULL),(2,42,13,4,'2012-2013',NULL),(2,43,13,5,'2012-2013',NULL),(2,44,13,6,'2012-2013',NULL),(2,45,13,7,'2012-2013',NULL);

/*Table structure for table `staff` */

DROP TABLE IF EXISTS `staff`;

CREATE TABLE `staff` (
  `InstituteId` int(10) DEFAULT NULL,
  `StaffId` int(10) NOT NULL AUTO_INCREMENT,
  `StaffName` varchar(256) NOT NULL,
  `StaffTypeId` int(5) NOT NULL,
  `Qualification` varchar(256) NOT NULL,
  `Experiance` int(2) NOT NULL,
  `Subject01` varchar(256) NOT NULL,
  `Subject02` varchar(256) NOT NULL,
  `Subject03` varchar(256) DEFAULT NULL,
  `Subject04` varchar(256) DEFAULT NULL,
  `PhoneNo` int(15) DEFAULT NULL,
  `MobileNo` int(15) NOT NULL,
  `Email` varchar(256) DEFAULT NULL,
  `Town` varchar(256) NOT NULL,
  `Address` text NOT NULL,
  `Status` varchar(100) NOT NULL,
  `StaffDes` text,
  PRIMARY KEY (`StaffId`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `staff` */

insert  into `staff`(`InstituteId`,`StaffId`,`StaffName`,`StaffTypeId`,`Qualification`,`Experiance`,`Subject01`,`Subject02`,`Subject03`,`Subject04`,`PhoneNo`,`MobileNo`,`Email`,`Town`,`Address`,`Status`,`StaffDes`) values (1,1,'Geetha',1,'MBA',9,'English','Tamil','Social','Science',997865564,99765768,'geetha@insdec.com','trichy','malligai st.','Staff',NULL),(1,2,'Amuthapriya',2,'Mcom',7,'Science','social','maths','tamil',900786576,90087657,'amutha@insdec.co.in','trichy','R.V.Nagar','Applicant',NULL),(1,3,'Selvam',3,'+2',0,'tamil','social','science','social',9887657,988765765,'selvam@insdec.com','madurai','T.V.S.colony','Staff',NULL),(1,4,'Anbu',4,'+2',0,'tamil','social','science','social',997657865,99786576,'anbu@insdec.com','madurai','thamarai st.','Staff',NULL),(2,5,'Malarvizhi',5,'CA',10,'Maths','science','social','english',999786576,90087587,'malar@insdec.co.in','sivagangai','Bank colony','Applicant',NULL),(2,6,'Karthika',6,'Mcom',9,'Tamil','Science','Social','Englisj',900786576,2147483647,'karthi@insdec.com','sivakasi','tillainagar','Staff',NULL),(2,7,'Lakshmi',7,'bcom',0,'science','social','maths','english',988665765,998758796,'lakshmi@insdec.co.in','ramnad','sivaji nagar','Applicant',NULL);

/*Table structure for table `stafftype` */

DROP TABLE IF EXISTS `stafftype`;

CREATE TABLE `stafftype` (
  `InstituteId` int(10) DEFAULT NULL,
  `StaffTypeId` int(10) NOT NULL AUTO_INCREMENT,
  `StaffType` char(200) NOT NULL,
  `StaffDes` text,
  PRIMARY KEY (`StaffTypeId`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `stafftype` */

insert  into `stafftype`(`InstituteId`,`StaffTypeId`,`StaffType`,`StaffDes`) values (1,1,'Principal',NULL),(1,2,'Teacher',NULL),(1,3,'Officeboy',NULL),(1,4,'Attender',NULL),(2,5,'Principal',NULL),(2,6,'Teacher',NULL),(2,7,'Clerk',NULL),(2,8,'attender','');

/*Table structure for table `student` */

DROP TABLE IF EXISTS `student`;

CREATE TABLE `student` (
  `InstituteId` int(10) DEFAULT NULL,
  `StudentId` int(10) NOT NULL AUTO_INCREMENT,
  `AdmissionNo` varchar(10) DEFAULT NULL,
  `StudentRollNo` varchar(10) NOT NULL,
  `StudentName` varchar(25) DEFAULT NULL,
  `FatherName` varchar(25) DEFAULT NULL,
  `MotherName` varchar(25) DEFAULT NULL,
  `FatherAccupation` varchar(25) DEFAULT NULL,
  `MotherAccupation` varchar(25) DEFAULT NULL,
  `DateOfBirth` date DEFAULT NULL,
  `Gender` varchar(1) DEFAULT NULL,
  `Town` varchar(25) DEFAULT NULL,
  `Cast` varchar(25) DEFAULT NULL,
  `CastCategoryId` int(2) DEFAULT NULL,
  `NationalityId` int(2) DEFAULT NULL,
  `PH` varchar(1) DEFAULT NULL,
  `Address` text,
  `PhoneNo` int(15) DEFAULT NULL,
  `MobileNo` decimal(15,0) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `OnTC` varbinary(1) DEFAULT NULL,
  `PhotoPath` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`StudentId`,`StudentRollNo`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

/*Data for the table `student` */

insert  into `student`(`InstituteId`,`StudentId`,`AdmissionNo`,`StudentRollNo`,`StudentName`,`FatherName`,`MotherName`,`FatherAccupation`,`MotherAccupation`,`DateOfBirth`,`Gender`,`Town`,`Cast`,`CastCategoryId`,`NationalityId`,`PH`,`Address`,`PhoneNo`,`MobileNo`,`Email`,`OnTC`,`PhotoPath`) values (1,1,NULL,'101','Anushka','Venkatesan','Suja','central','central','2013-12-01','f','madurai','vellalar',2,1,'N','melamasi st.',998736573,'9987578689','kala.s@insdec.com','N',''),(1,2,NULL,'102','Abinaya','Ragavan','Rathi','government','housewife','2013-12-06','f','coimbatore','thevar',3,1,'N','C.V.Raman nagar',98763423,'99785463','jhkljhk','N',''),(1,3,NULL,'101','Anjana','Hari','Selvi','government','government','2013-12-04','f','karur','chettiar',4,1,'N','thandu mariamman koil',99728747,'9986786557','anjana@insdec.com','N',''),(1,4,NULL,'102','Akalya','sriraman','seetha','government','business','2013-12-07','f','ooty','kallar',4,1,'N','sasthri nagar',998786567,'9987751212','akl@insdec.com','N',''),(1,5,NULL,'201','Bala','Babu','Banumathi','central','central','2012-12-03','m','pondichery','pillai',2,1,'x','100 feet road',987671235,'9967121223','bala@insdec.co.in','N',''),(1,6,NULL,'202','Banu','Ganesh','Selvi','government','housewife','2011-12-06','f','trichy','vellala',2,1,'N','rajendraparasad nagar..',990007556,'9887564345','banu@insdec.com','N',''),(1,7,NULL,'203','Chinna','Rajendar','Selvi','CentralGovernment','business','2011-12-12','f','Kodaikanal','yadavar',5,1,'N','thamarai st.',99878676,'98342334','chinna@insdec.com','N',''),(1,8,NULL,'201','Baskar','Venkatesan','Chandra','Government','business','2011-12-21','m','kanyakumari','Iyyangar',1,1,'N','malligai st..',90077885,'9912123243','baskar@insdec.com','N',''),(1,9,NULL,'202','Cibi','Karthikeyan','Kamala','centralgovernment','government','2013-12-03','m','nagarkoil','chettiar',4,1,'N','vilakuthoon',2147483647,'988056895','cibi@insdec.co.in','N',''),(1,11,NULL,'201','Devan','Kandasamy','Rani','government','business','2013-12-12','m','lalgudi','yadavar',5,1,'N','thamarai st.',990044522,'9887766556','devan@insdec.com','N',''),(1,12,NULL,'202','Dhinesh','Sekaran','Mala','central','business','2008-12-17','m','sivagangai','yadavar',4,1,'N','thousand light st.',97867102,'99213084','dinesh@insdec.co.in','N',''),(2,13,NULL,'101','Mahesh','Manjunathan','Kanmani','government','housewife','2012-11-14','m','natham','vellalar',7,3,'N','E.B.road.',998676666,'999231097','mahesh@insdec.com','N',''),(2,14,NULL,'102','Rakesh','Lakshman','Lakshmi','central','central','2013-12-05','m','rameshwaram','yadavar',7,3,'N','sirC.V.raman nagar',998001234,'99002847','rakesh@insdec.co.in','N',''),(2,15,NULL,'101','Shanthini','Shanmugam','Leela','government','business','2011-10-10','f','namakkal','chettiar',8,3,'N','goripalayam',998067854,'998654567','shanthini@insdec.com','N',''),(2,16,NULL,'102','Shankar','Palaniyappan','Umamaheswari','government','business','2013-12-16','m','karur','thevar',7,3,'N','bankcolony',99876578,'988456087','shankar@insdec.com','N',''),(2,17,NULL,'101','Angelina','Dayalan','Marry','central','housewife','2013-12-20','f','nagapattinam','christian',10,3,'N','maathur',99878767,'990087678','angel@insdec.com','N',''),(2,18,NULL,'102','Uma','Janakiraman','Janani','government','housewife','2013-07-08','f','kanyakumari','vellalar',7,3,'N','janapuram',99765786,'89005599','uma@insdec.co.in','N',''),(2,19,NULL,'201','Rakshana','Kathirvel','Kanjana','government','government','2013-12-12','f','kanchipuram','Iyyangar',9,3,'N','pudur',990876576,'98810765','rakshana@insdec.com','N',''),(2,20,NULL,'202','Suha','Jagan','Lalitha','centralgovernment','government','2013-12-16','f','sivakasi','pillai',7,3,'N','jayanagar',990787687,'98976878','suha@insdec.com','N',''),(2,21,NULL,'201','Suganya','Gajendran','Lakshmi','government','housewife','2013-12-10','f','srivilliputhur','yadavar',10,3,'N','agraharam',999786587,'976767867','suganya@insdec.co.in','Y',''),(2,22,NULL,'202','Amala','Thanajeyam','Parvathi','government','business','2013-12-07','f','salem','vellala',7,3,'N','narayanapuram',99976576,'98876576','amala@insdec.c0m','N',''),(1,23,NULL,'301','Prem','Kumar','Sanjana','central','central','2012-12-01','f','madurai','vellalar',2,1,'N','melamasi st.',998736573,'9987578689','kala.s@insdec.com','N',''),(1,24,NULL,'302','sam','Rajagopal','Krishnaveni','government','housewife','2012-12-06','f','coimbatore','thevar',3,1,'N','C.V.Raman nagar',98763423,'99785463','jhkljhk','N',''),(2,25,NULL,'401','Sanjana','sam','rani','central','central','2012-12-01','f','madurai','vellalar',2,1,'N','melamasi st.',998736573,'9987578689','kala.s@insdec.com','N',''),(2,26,NULL,'402','Mohan','Rajagopal','Krishnaveni','government','housewife','2012-12-06','m','Trichy','na',3,1,'N','C.V.Raman nagar',98763423,'99785463','test@insdec.com','Y','');

/*Table structure for table `studentclass` */

DROP TABLE IF EXISTS `studentclass`;

CREATE TABLE `studentclass` (
  `InstituteId` int(10) DEFAULT NULL,
  `StudentClassId` int(11) NOT NULL AUTO_INCREMENT,
  `StudentId` int(11) DEFAULT NULL,
  `RollNo` int(11) DEFAULT NULL,
  `Medium` smallint(5) DEFAULT NULL,
  `StudentClass` smallint(5) DEFAULT NULL,
  `SectionId` int(2) DEFAULT NULL,
  `Year` varchar(10) DEFAULT NULL,
  `StudentClassDes` text,
  PRIMARY KEY (`StudentClassId`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

/*Data for the table `studentclass` */

insert  into `studentclass`(`InstituteId`,`StudentClassId`,`StudentId`,`RollNo`,`Medium`,`StudentClass`,`SectionId`,`Year`,`StudentClassDes`) values (1,1,1,101,2,1,1,'2012-2013',NULL),(1,2,2,102,2,1,1,'2012-2013',NULL),(1,3,3,101,2,1,2,'2012-2013',NULL),(1,4,4,102,2,1,2,'2012-2013',NULL),(1,5,5,201,2,2,1,'2012-2013',NULL),(1,6,6,202,2,2,1,'2012-2013',NULL),(1,7,7,203,2,2,1,'2012-2013',NULL),(1,8,8,201,2,2,2,'2012-2013',NULL),(1,9,9,202,2,2,2,'2012-2013',NULL),(1,11,11,201,2,2,3,'2012-2013',NULL),(1,12,12,202,2,2,3,'2012-2013',NULL),(2,13,13,101,2,9,4,'2012-2013',NULL),(2,14,14,102,2,9,4,'2012-2013',NULL),(2,15,15,101,2,9,5,'2012-2013',NULL),(2,16,16,102,2,9,5,'2012-2013',NULL),(2,17,17,101,2,9,6,'2012-2013',NULL),(2,18,18,102,2,9,6,'2012-2013',NULL),(2,19,19,201,2,10,4,'2012-2013',NULL),(2,20,20,202,2,10,4,'2012-2013',NULL),(2,21,21,201,2,10,5,'2012-2013',NULL),(2,22,22,202,2,10,5,'2012-2013',NULL),(1,23,23,301,2,1,1,'2011-2012',NULL),(1,24,24,302,2,1,2,'2011-2012',NULL),(2,25,25,401,1,9,4,'2011-2012',NULL),(2,26,26,402,1,10,5,'2011-2012',NULL);

/*Table structure for table `studentfees` */

DROP TABLE IF EXISTS `studentfees`;

CREATE TABLE `studentfees` (
  `InstituteId` int(10) DEFAULT NULL,
  `StudentFeesId` int(11) NOT NULL AUTO_INCREMENT,
  `StudentId` int(11) DEFAULT NULL,
  `FeesTypeId` smallint(3) DEFAULT NULL,
  `Fees` float(10,2) DEFAULT NULL,
  `Year` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`StudentFeesId`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

/*Data for the table `studentfees` */

insert  into `studentfees`(`InstituteId`,`StudentFeesId`,`StudentId`,`FeesTypeId`,`Fees`,`Year`) values (1,1,1,1,100.00,'2012-2013'),(1,2,2,2,100.00,'2012-2013'),(1,3,3,3,100.00,'2012-2013'),(1,4,4,4,100.00,'2012-2013'),(1,5,5,5,100.00,'2012-2013'),(1,6,6,6,200.00,'2012-2013'),(1,7,7,7,200.00,'2012-2013'),(1,8,8,8,200.00,'2012-2013'),(1,9,9,9,200.00,'2012-2013'),(1,10,11,10,200.00,'2012-2013'),(1,11,12,11,200.00,'2012-2013'),(2,12,13,12,300.00,'2012-2013'),(2,13,14,13,300.00,'2012-2013'),(2,14,15,14,200.00,'2012-2013'),(2,15,16,15,300.00,'2012-2013'),(2,16,17,16,200.00,'2012-2013'),(2,17,18,17,300.00,'2012-2013'),(2,18,19,1,900.00,'2012-2013'),(2,19,19,2,800.00,'2012-2013'),(2,20,19,3,3000.00,'2012-2013'),(2,21,20,1,900.00,'2012-2013'),(2,22,20,2,800.00,'2012-2013'),(2,23,20,3,3000.00,'2012-2013'),(2,24,21,1,900.00,'2012-2013'),(2,25,21,2,800.00,'2012-2013'),(2,26,21,3,3000.00,'2012-2013'),(2,27,22,1,900.00,'2012-2013'),(2,28,22,2,800.00,'2012-2013'),(2,29,22,3,3000.00,'2012-2013');

/*Table structure for table `subject` */

DROP TABLE IF EXISTS `subject`;

CREATE TABLE `subject` (
  `InstituteId` int(10) DEFAULT NULL,
  `SubjectId` int(10) NOT NULL AUTO_INCREMENT,
  `SubjectName` varchar(256) NOT NULL,
  `SubjectDes` text,
  PRIMARY KEY (`SubjectId`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `subject` */

insert  into `subject`(`InstituteId`,`SubjectId`,`SubjectName`,`SubjectDes`) values (1,1,'Tamil',NULL),(1,2,'English',NULL),(1,3,'Maths',NULL),(1,4,'Science',NULL),(1,5,'Social',NULL),(2,6,'Tamil',NULL),(2,7,'English',NULL),(2,8,'Hindi',NULL),(2,9,'Maths',NULL),(2,10,'Science',NULL),(2,11,'Social',NULL),(2,12,'Computerscience','');

/*Table structure for table `submenu` */

DROP TABLE IF EXISTS `submenu`;

CREATE TABLE `submenu` (
  `SubMenuId` int(5) NOT NULL AUTO_INCREMENT,
  `SubMenuName` varchar(256) NOT NULL,
  `SubMenuLink` varchar(256) NOT NULL,
  `MainMenuId` int(5) NOT NULL,
  `MenuDes` text,
  PRIMARY KEY (`SubMenuId`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

/*Data for the table `submenu` */

insert  into `submenu`(`SubMenuId`,`SubMenuName`,`SubMenuLink`,`MainMenuId`,`MenuDes`) values (1,'Rolls','roll/listview',2,NULL),(2,'Users','user/listview',2,NULL),(3,'Staff Types','stafftype/listview',2,NULL),(4,'Subjects','subject/listview',2,NULL),(5,'Courses','course/listview',2,NULL),(6,'Exam Types','examtype/listview',2,NULL),(7,'Students','student/listview',3,NULL),(8,'Attendence','attendence/listview',3,NULL),(9,'Marks','marks/listview',3,NULL),(10,'School Fees','schoolfees/listview',3,NULL),(11,'Exam Fees','examFee/listview',3,NULL),(12,'Staff','staff/listview',4,NULL),(13,'Time Table','timetable/listview',4,NULL),(14,'Register','libraryreg/listview',5,NULL),(15,'Categories','category/listview',5,NULL),(16,'Books','book/listview',5,NULL),(17,'Management','libraryrecord/listview',5,NULL),(18,'Settings','setting/listview',6,NULL),(19,'Roll Menu','rollmenu/listview',2,NULL);

/*Table structure for table `timetable` */

DROP TABLE IF EXISTS `timetable`;

CREATE TABLE `timetable` (
  `InstituteId` int(10) DEFAULT NULL,
  `TimeTableId` int(11) NOT NULL AUTO_INCREMENT,
  `ClassId` smallint(5) DEFAULT NULL,
  `SectionId` smallint(5) DEFAULT NULL,
  `SubjectId` smallint(3) DEFAULT NULL,
  `TeacherId` smallint(5) DEFAULT NULL,
  `PeriodId` smallint(5) DEFAULT NULL,
  `DayId` smallint(1) DEFAULT NULL,
  `Year` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`TimeTableId`)
) ENGINE=InnoDB AUTO_INCREMENT=598 DEFAULT CHARSET=latin1;

/*Data for the table `timetable` */

insert  into `timetable`(`InstituteId`,`TimeTableId`,`ClassId`,`SectionId`,`SubjectId`,`TeacherId`,`PeriodId`,`DayId`,`Year`) values (NULL,1,1,NULL,1,1,1,1,'2011-2012'),(NULL,2,1,NULL,2,1,2,1,'2011-2012'),(NULL,3,1,NULL,5,1,3,1,'2011-2012'),(NULL,4,1,NULL,0,0,4,1,'2011-2012'),(NULL,5,1,NULL,0,0,5,1,'2011-2012'),(NULL,6,1,NULL,0,0,6,1,'2011-2012'),(NULL,7,1,NULL,0,0,7,1,'2011-2012'),(NULL,8,1,NULL,0,0,8,1,'2011-2012'),(NULL,9,1,NULL,0,0,1,2,'2011-2012'),(NULL,10,1,NULL,0,0,2,2,'2011-2012'),(NULL,11,1,NULL,0,0,3,2,'2011-2012'),(NULL,12,1,NULL,0,0,4,2,'2011-2012'),(NULL,13,1,NULL,0,0,5,2,'2011-2012'),(NULL,14,1,NULL,0,0,6,2,'2011-2012'),(NULL,15,1,NULL,0,0,7,2,'2011-2012'),(NULL,16,1,NULL,0,0,8,2,'2011-2012'),(NULL,17,1,NULL,0,0,1,3,'2011-2012'),(NULL,18,1,NULL,0,0,2,3,'2011-2012'),(NULL,19,1,NULL,0,0,3,3,'2011-2012'),(NULL,20,1,NULL,0,0,4,3,'2011-2012'),(NULL,21,1,NULL,0,0,5,3,'2011-2012'),(NULL,22,1,NULL,0,0,6,3,'2011-2012'),(NULL,23,1,NULL,0,0,7,3,'2011-2012'),(NULL,24,1,NULL,0,0,8,3,'2011-2012'),(NULL,25,1,NULL,0,0,1,4,'2011-2012'),(NULL,26,1,NULL,0,0,2,4,'2011-2012'),(NULL,27,1,NULL,0,0,3,4,'2011-2012'),(NULL,28,1,NULL,0,0,4,4,'2011-2012'),(NULL,29,1,NULL,0,0,5,4,'2011-2012'),(NULL,30,1,NULL,0,0,6,4,'2011-2012'),(NULL,31,1,NULL,0,0,7,4,'2011-2012'),(NULL,32,1,NULL,0,0,8,4,'2011-2012'),(NULL,33,1,NULL,0,0,1,5,'2011-2012'),(NULL,34,1,NULL,0,0,2,5,'2011-2012'),(NULL,35,1,NULL,0,0,3,5,'2011-2012'),(NULL,36,1,NULL,0,0,4,5,'2011-2012'),(NULL,37,1,NULL,0,0,5,5,'2011-2012'),(NULL,38,1,NULL,0,0,6,5,'2011-2012'),(NULL,39,1,NULL,0,0,7,5,'2011-2012'),(NULL,40,1,NULL,0,0,8,5,'2011-2012'),(NULL,41,1,NULL,0,0,1,6,'2011-2012'),(NULL,42,1,NULL,0,0,2,6,'2011-2012'),(NULL,43,1,NULL,0,0,3,6,'2011-2012'),(NULL,44,1,NULL,0,0,4,6,'2011-2012'),(NULL,45,1,NULL,0,0,5,6,'2011-2012'),(NULL,46,1,NULL,0,0,6,6,'2011-2012'),(NULL,47,1,NULL,0,0,7,6,'2011-2012'),(NULL,48,1,NULL,0,0,8,6,'2011-2012'),(NULL,49,2,NULL,0,0,1,1,'2011-2012'),(NULL,50,2,NULL,0,0,2,1,'2011-2012'),(NULL,51,2,NULL,0,0,3,1,'2011-2012'),(NULL,52,2,NULL,0,0,4,1,'2011-2012'),(NULL,53,2,NULL,0,0,5,1,'2011-2012'),(NULL,54,2,NULL,0,0,6,1,'2011-2012'),(NULL,55,2,NULL,0,0,7,1,'2011-2012'),(NULL,56,2,NULL,0,0,8,1,'2011-2012'),(NULL,57,2,NULL,0,0,1,2,'2011-2012'),(NULL,58,2,NULL,0,0,2,2,'2011-2012'),(NULL,59,2,NULL,0,0,3,2,'2011-2012'),(NULL,60,2,NULL,0,0,4,2,'2011-2012'),(NULL,61,2,NULL,0,0,5,2,'2011-2012'),(NULL,62,2,NULL,0,0,6,2,'2011-2012'),(NULL,63,2,NULL,0,0,7,2,'2011-2012'),(NULL,64,2,NULL,0,0,8,2,'2011-2012'),(NULL,65,2,NULL,0,0,1,3,'2011-2012'),(NULL,66,2,NULL,0,0,2,3,'2011-2012'),(NULL,67,2,NULL,0,0,3,3,'2011-2012'),(NULL,68,2,NULL,0,0,4,3,'2011-2012'),(NULL,69,2,NULL,0,0,5,3,'2011-2012'),(NULL,70,2,NULL,0,0,6,3,'2011-2012'),(NULL,71,2,NULL,0,0,7,3,'2011-2012'),(NULL,72,2,NULL,0,0,8,3,'2011-2012'),(NULL,73,2,NULL,0,0,1,4,'2011-2012'),(NULL,74,2,NULL,0,0,2,4,'2011-2012'),(NULL,75,2,NULL,0,0,3,4,'2011-2012'),(NULL,76,2,NULL,0,0,4,4,'2011-2012'),(NULL,77,2,NULL,0,0,5,4,'2011-2012'),(NULL,78,2,NULL,0,0,6,4,'2011-2012'),(NULL,79,2,NULL,0,0,7,4,'2011-2012'),(NULL,80,2,NULL,0,0,8,4,'2011-2012'),(NULL,81,2,NULL,0,0,1,5,'2011-2012'),(NULL,82,2,NULL,0,0,2,5,'2011-2012'),(NULL,83,2,NULL,0,0,3,5,'2011-2012'),(NULL,84,2,NULL,0,0,4,5,'2011-2012'),(NULL,85,2,NULL,0,0,5,5,'2011-2012'),(NULL,86,2,NULL,0,0,6,5,'2011-2012'),(NULL,87,2,NULL,0,0,7,5,'2011-2012'),(NULL,88,2,NULL,0,0,8,5,'2011-2012'),(NULL,89,2,NULL,0,0,1,6,'2011-2012'),(NULL,90,2,NULL,0,0,2,6,'2011-2012'),(NULL,91,2,NULL,0,0,3,6,'2011-2012'),(NULL,92,2,NULL,0,0,4,6,'2011-2012'),(NULL,93,2,NULL,0,0,5,6,'2011-2012'),(NULL,94,2,NULL,0,0,6,6,'2011-2012'),(NULL,95,2,NULL,0,0,7,6,'2011-2012'),(NULL,96,2,NULL,0,0,8,6,'2011-2012'),(NULL,97,3,NULL,0,0,1,1,'2011-2012'),(NULL,98,3,NULL,0,0,2,1,'2011-2012'),(NULL,99,3,NULL,0,0,3,1,'2011-2012'),(NULL,100,3,NULL,0,0,4,1,'2011-2012'),(NULL,101,3,NULL,0,0,5,1,'2011-2012'),(NULL,102,3,NULL,0,0,6,1,'2011-2012'),(NULL,103,3,NULL,0,0,7,1,'2011-2012'),(NULL,104,3,NULL,0,0,8,1,'2011-2012'),(NULL,105,3,NULL,0,0,1,2,'2011-2012'),(NULL,106,3,NULL,0,0,2,2,'2011-2012'),(NULL,107,3,NULL,0,0,3,2,'2011-2012'),(NULL,108,3,NULL,0,0,4,2,'2011-2012'),(NULL,109,3,NULL,0,0,5,2,'2011-2012'),(NULL,110,3,NULL,0,0,6,2,'2011-2012'),(NULL,111,3,NULL,0,0,7,2,'2011-2012'),(NULL,112,3,NULL,0,0,8,2,'2011-2012'),(NULL,113,3,NULL,0,0,1,3,'2011-2012'),(NULL,114,3,NULL,0,0,2,3,'2011-2012'),(NULL,115,3,NULL,0,0,3,3,'2011-2012'),(NULL,116,3,NULL,0,0,4,3,'2011-2012'),(NULL,117,3,NULL,0,0,5,3,'2011-2012'),(NULL,118,3,NULL,0,0,6,3,'2011-2012'),(NULL,119,3,NULL,0,0,7,3,'2011-2012'),(NULL,120,3,NULL,0,0,8,3,'2011-2012'),(NULL,121,3,NULL,0,0,1,4,'2011-2012'),(NULL,122,3,NULL,0,0,2,4,'2011-2012'),(NULL,123,3,NULL,0,0,3,4,'2011-2012'),(NULL,124,3,NULL,0,0,4,4,'2011-2012'),(NULL,125,3,NULL,0,0,5,4,'2011-2012'),(NULL,126,3,NULL,0,0,6,4,'2011-2012'),(NULL,127,3,NULL,0,0,7,4,'2011-2012'),(NULL,128,3,NULL,0,0,8,4,'2011-2012'),(NULL,129,3,NULL,0,0,1,5,'2011-2012'),(NULL,130,3,NULL,0,0,2,5,'2011-2012'),(NULL,131,3,NULL,0,0,3,5,'2011-2012'),(NULL,132,3,NULL,0,0,4,5,'2011-2012'),(NULL,133,3,NULL,0,0,5,5,'2011-2012'),(NULL,134,3,NULL,0,0,6,5,'2011-2012'),(NULL,135,3,NULL,0,0,7,5,'2011-2012'),(NULL,136,3,NULL,0,0,8,5,'2011-2012'),(NULL,137,3,NULL,0,0,1,6,'2011-2012'),(NULL,138,3,NULL,0,0,2,6,'2011-2012'),(NULL,139,3,NULL,0,0,3,6,'2011-2012'),(NULL,140,3,NULL,0,0,4,6,'2011-2012'),(NULL,141,3,NULL,0,0,5,6,'2011-2012'),(NULL,142,3,NULL,0,0,6,6,'2011-2012'),(NULL,143,3,NULL,0,0,7,6,'2011-2012'),(NULL,144,3,NULL,0,0,8,6,'2011-2012'),(NULL,145,4,NULL,0,0,1,1,'2011-2012'),(NULL,146,4,NULL,0,0,2,1,'2011-2012'),(NULL,147,4,NULL,0,0,3,1,'2011-2012'),(NULL,148,4,NULL,0,0,4,1,'2011-2012'),(NULL,149,4,NULL,0,0,5,1,'2011-2012'),(NULL,150,4,NULL,0,0,6,1,'2011-2012'),(NULL,151,4,NULL,0,0,7,1,'2011-2012'),(NULL,152,4,NULL,0,0,8,1,'2011-2012'),(NULL,153,4,NULL,0,0,1,2,'2011-2012'),(NULL,154,4,NULL,0,0,2,2,'2011-2012'),(NULL,155,4,NULL,0,0,3,2,'2011-2012'),(NULL,156,4,NULL,0,0,4,2,'2011-2012'),(NULL,157,4,NULL,0,0,5,2,'2011-2012'),(NULL,158,4,NULL,0,0,6,2,'2011-2012'),(NULL,159,4,NULL,0,0,7,2,'2011-2012'),(NULL,160,4,NULL,0,0,8,2,'2011-2012'),(NULL,161,4,NULL,0,0,1,3,'2011-2012'),(NULL,162,4,NULL,0,0,2,3,'2011-2012'),(NULL,163,4,NULL,0,0,3,3,'2011-2012'),(NULL,164,4,NULL,0,0,4,3,'2011-2012'),(NULL,165,4,NULL,0,0,5,3,'2011-2012'),(NULL,166,4,NULL,0,0,6,3,'2011-2012'),(NULL,167,4,NULL,0,0,7,3,'2011-2012'),(NULL,168,4,NULL,0,0,8,3,'2011-2012'),(NULL,169,4,NULL,0,0,1,4,'2011-2012'),(NULL,170,4,NULL,0,0,2,4,'2011-2012'),(NULL,171,4,NULL,0,0,3,4,'2011-2012'),(NULL,172,4,NULL,0,0,4,4,'2011-2012'),(NULL,173,4,NULL,0,0,5,4,'2011-2012'),(NULL,174,4,NULL,0,0,6,4,'2011-2012'),(NULL,175,4,NULL,0,0,7,4,'2011-2012'),(NULL,176,4,NULL,0,0,8,4,'2011-2012'),(NULL,177,4,NULL,0,0,1,5,'2011-2012'),(NULL,178,4,NULL,0,0,2,5,'2011-2012'),(NULL,179,4,NULL,0,0,3,5,'2011-2012'),(NULL,180,4,NULL,0,0,4,5,'2011-2012'),(NULL,181,4,NULL,0,0,5,5,'2011-2012'),(NULL,182,4,NULL,0,0,6,5,'2011-2012'),(NULL,183,4,NULL,0,0,7,5,'2011-2012'),(NULL,184,4,NULL,0,0,8,5,'2011-2012'),(NULL,185,4,NULL,0,0,1,6,'2011-2012'),(NULL,186,4,NULL,0,0,2,6,'2011-2012'),(NULL,187,4,NULL,0,0,3,6,'2011-2012'),(NULL,188,4,NULL,0,0,4,6,'2011-2012'),(NULL,189,4,NULL,0,0,5,6,'2011-2012'),(NULL,190,4,NULL,0,0,6,6,'2011-2012'),(NULL,191,4,NULL,0,0,7,6,'2011-2012'),(NULL,192,4,NULL,0,0,8,6,'2011-2012'),(NULL,193,5,NULL,0,0,1,1,'2011-2012'),(NULL,194,5,NULL,0,0,2,1,'2011-2012'),(NULL,195,5,NULL,0,0,3,1,'2011-2012'),(NULL,196,5,NULL,0,0,4,1,'2011-2012'),(NULL,197,5,NULL,0,0,5,1,'2011-2012'),(NULL,198,5,NULL,0,0,6,1,'2011-2012'),(NULL,199,5,NULL,0,0,7,1,'2011-2012'),(NULL,200,5,NULL,0,0,8,1,'2011-2012'),(NULL,201,5,NULL,0,0,1,2,'2011-2012'),(NULL,202,5,NULL,0,0,2,2,'2011-2012'),(NULL,203,5,NULL,0,0,3,2,'2011-2012'),(NULL,204,5,NULL,0,0,4,2,'2011-2012'),(NULL,205,5,NULL,0,0,5,2,'2011-2012'),(NULL,206,5,NULL,0,0,6,2,'2011-2012'),(NULL,207,5,NULL,0,0,7,2,'2011-2012'),(NULL,208,5,NULL,0,0,8,2,'2011-2012'),(NULL,209,5,NULL,0,0,1,3,'2011-2012'),(NULL,210,5,NULL,0,0,2,3,'2011-2012'),(NULL,211,5,NULL,0,0,3,3,'2011-2012'),(NULL,212,5,NULL,0,0,4,3,'2011-2012'),(NULL,213,5,NULL,0,0,5,3,'2011-2012'),(NULL,214,5,NULL,0,0,6,3,'2011-2012'),(NULL,215,5,NULL,0,0,7,3,'2011-2012'),(NULL,216,5,NULL,0,0,8,3,'2011-2012'),(NULL,217,5,NULL,0,0,1,4,'2011-2012'),(NULL,218,5,NULL,0,0,2,4,'2011-2012'),(NULL,219,5,NULL,0,0,3,4,'2011-2012'),(NULL,220,5,NULL,0,0,4,4,'2011-2012'),(NULL,221,5,NULL,0,0,5,4,'2011-2012'),(NULL,222,5,NULL,0,0,6,4,'2011-2012'),(NULL,223,5,NULL,0,0,7,4,'2011-2012'),(NULL,224,5,NULL,0,0,8,4,'2011-2012'),(NULL,225,5,NULL,0,0,1,5,'2011-2012'),(NULL,226,5,NULL,0,0,2,5,'2011-2012'),(NULL,227,5,NULL,0,0,3,5,'2011-2012'),(NULL,228,5,NULL,0,0,4,5,'2011-2012'),(NULL,229,5,NULL,0,0,5,5,'2011-2012'),(NULL,230,5,NULL,0,0,6,5,'2011-2012'),(NULL,231,5,NULL,0,0,7,5,'2011-2012'),(NULL,232,5,NULL,0,0,8,5,'2011-2012'),(NULL,233,5,NULL,0,0,1,6,'2011-2012'),(NULL,234,5,NULL,0,0,2,6,'2011-2012'),(NULL,235,5,NULL,0,0,3,6,'2011-2012'),(NULL,236,5,NULL,0,0,4,6,'2011-2012'),(NULL,237,5,NULL,0,0,5,6,'2011-2012'),(NULL,238,5,NULL,0,0,6,6,'2011-2012'),(NULL,239,5,NULL,0,0,7,6,'2011-2012'),(NULL,240,5,NULL,0,0,8,6,'2011-2012'),(NULL,241,6,NULL,0,0,1,1,'2011-2012'),(NULL,242,6,NULL,0,0,2,1,'2011-2012'),(NULL,243,6,NULL,0,0,3,1,'2011-2012'),(NULL,244,6,NULL,0,0,4,1,'2011-2012'),(NULL,245,6,NULL,0,0,5,1,'2011-2012'),(NULL,246,6,NULL,0,0,6,1,'2011-2012'),(NULL,247,6,NULL,0,0,7,1,'2011-2012'),(NULL,248,6,NULL,0,0,8,1,'2011-2012'),(NULL,249,6,NULL,0,0,1,2,'2011-2012'),(NULL,250,6,NULL,0,0,2,2,'2011-2012'),(NULL,251,6,NULL,0,0,3,2,'2011-2012'),(NULL,252,6,NULL,0,0,4,2,'2011-2012'),(NULL,253,6,NULL,0,0,5,2,'2011-2012'),(NULL,254,6,NULL,0,0,6,2,'2011-2012'),(NULL,255,6,NULL,0,0,7,2,'2011-2012'),(NULL,256,6,NULL,0,0,8,2,'2011-2012'),(NULL,257,6,NULL,0,0,1,3,'2011-2012'),(NULL,258,6,NULL,0,0,2,3,'2011-2012'),(NULL,259,6,NULL,0,0,3,3,'2011-2012'),(NULL,260,6,NULL,0,0,4,3,'2011-2012'),(NULL,261,6,NULL,0,0,5,3,'2011-2012'),(NULL,262,6,NULL,0,0,6,3,'2011-2012'),(NULL,263,6,NULL,0,0,7,3,'2011-2012'),(NULL,264,6,NULL,0,0,8,3,'2011-2012'),(NULL,265,6,NULL,0,0,1,4,'2011-2012'),(NULL,266,6,NULL,0,0,2,4,'2011-2012'),(NULL,267,6,NULL,0,0,3,4,'2011-2012'),(NULL,268,6,NULL,0,0,4,4,'2011-2012'),(NULL,269,6,NULL,0,0,5,4,'2011-2012'),(NULL,270,6,NULL,0,0,6,4,'2011-2012'),(NULL,271,6,NULL,0,0,7,4,'2011-2012'),(NULL,272,6,NULL,0,0,8,4,'2011-2012'),(NULL,273,6,NULL,0,0,1,5,'2011-2012'),(NULL,274,6,NULL,0,0,2,5,'2011-2012'),(NULL,275,6,NULL,0,0,3,5,'2011-2012'),(NULL,276,6,NULL,0,0,4,5,'2011-2012'),(NULL,277,6,NULL,0,0,5,5,'2011-2012'),(NULL,278,6,NULL,0,0,6,5,'2011-2012'),(NULL,279,6,NULL,0,0,7,5,'2011-2012'),(NULL,280,6,NULL,0,0,8,5,'2011-2012'),(NULL,281,6,NULL,0,0,1,6,'2011-2012'),(NULL,282,6,NULL,0,0,2,6,'2011-2012'),(NULL,283,6,NULL,0,0,3,6,'2011-2012'),(NULL,284,6,NULL,0,0,4,6,'2011-2012'),(NULL,285,6,NULL,0,0,5,6,'2011-2012'),(NULL,286,6,NULL,0,0,6,6,'2011-2012'),(NULL,287,6,NULL,0,0,7,6,'2011-2012'),(NULL,288,6,NULL,0,0,8,6,'2011-2012'),(NULL,289,7,NULL,0,0,1,1,'2011-2012'),(NULL,290,7,NULL,0,0,2,1,'2011-2012'),(NULL,291,7,NULL,0,0,3,1,'2011-2012'),(NULL,292,7,NULL,0,0,4,1,'2011-2012'),(NULL,293,7,NULL,0,0,5,1,'2011-2012'),(NULL,294,7,NULL,0,0,6,1,'2011-2012'),(NULL,295,7,NULL,0,0,7,1,'2011-2012'),(NULL,296,7,NULL,0,0,8,1,'2011-2012'),(NULL,297,7,NULL,0,0,1,2,'2011-2012'),(NULL,298,7,NULL,0,0,2,2,'2011-2012'),(NULL,299,7,NULL,0,0,3,2,'2011-2012'),(NULL,300,7,NULL,0,0,4,2,'2011-2012'),(NULL,301,7,NULL,0,0,5,2,'2011-2012'),(NULL,302,7,NULL,0,0,6,2,'2011-2012'),(NULL,303,7,NULL,0,0,7,2,'2011-2012'),(NULL,304,7,NULL,0,0,8,2,'2011-2012'),(NULL,305,7,NULL,0,0,1,3,'2011-2012'),(NULL,306,7,NULL,0,0,2,3,'2011-2012'),(NULL,307,7,NULL,0,0,3,3,'2011-2012'),(NULL,308,7,NULL,0,0,4,3,'2011-2012'),(NULL,309,7,NULL,0,0,5,3,'2011-2012'),(NULL,310,7,NULL,0,0,6,3,'2011-2012'),(NULL,311,7,NULL,0,0,7,3,'2011-2012'),(NULL,312,7,NULL,0,0,8,3,'2011-2012'),(NULL,313,7,NULL,0,0,1,4,'2011-2012'),(NULL,314,7,NULL,0,0,2,4,'2011-2012'),(NULL,315,7,NULL,0,0,3,4,'2011-2012'),(NULL,316,7,NULL,0,0,4,4,'2011-2012'),(NULL,317,7,NULL,0,0,5,4,'2011-2012'),(NULL,318,7,NULL,0,0,6,4,'2011-2012'),(NULL,319,7,NULL,0,0,7,4,'2011-2012'),(NULL,320,7,NULL,0,0,8,4,'2011-2012'),(NULL,321,7,NULL,0,0,1,5,'2011-2012'),(NULL,322,7,NULL,0,0,2,5,'2011-2012'),(NULL,323,7,NULL,0,0,3,5,'2011-2012'),(NULL,324,7,NULL,0,0,4,5,'2011-2012'),(NULL,325,7,NULL,0,0,5,5,'2011-2012'),(NULL,326,7,NULL,0,0,6,5,'2011-2012'),(NULL,327,7,NULL,0,0,7,5,'2011-2012'),(NULL,328,7,NULL,0,0,8,5,'2011-2012'),(NULL,329,7,NULL,0,0,1,6,'2011-2012'),(NULL,330,7,NULL,0,0,2,6,'2011-2012'),(NULL,331,7,NULL,0,0,3,6,'2011-2012'),(NULL,332,7,NULL,0,0,4,6,'2011-2012'),(NULL,333,7,NULL,0,0,5,6,'2011-2012'),(NULL,334,7,NULL,0,0,6,6,'2011-2012'),(NULL,335,7,NULL,0,0,7,6,'2011-2012'),(NULL,336,7,NULL,0,0,8,6,'2011-2012'),(NULL,337,8,NULL,0,0,1,1,'2011-2012'),(NULL,338,8,NULL,0,0,2,1,'2011-2012'),(NULL,339,8,NULL,0,0,3,1,'2011-2012'),(NULL,340,8,NULL,0,0,4,1,'2011-2012'),(NULL,341,8,NULL,0,0,5,1,'2011-2012'),(NULL,342,8,NULL,0,0,6,1,'2011-2012'),(NULL,343,8,NULL,0,0,7,1,'2011-2012'),(NULL,344,8,NULL,0,0,8,1,'2011-2012'),(NULL,345,8,NULL,0,0,1,2,'2011-2012'),(NULL,346,8,NULL,0,0,2,2,'2011-2012'),(NULL,347,8,NULL,0,0,3,2,'2011-2012'),(NULL,348,8,NULL,0,0,4,2,'2011-2012'),(NULL,349,8,NULL,0,0,5,2,'2011-2012'),(NULL,350,8,NULL,0,0,6,2,'2011-2012'),(NULL,351,8,NULL,0,0,7,2,'2011-2012'),(NULL,352,8,NULL,0,0,8,2,'2011-2012'),(NULL,353,8,NULL,0,0,1,3,'2011-2012'),(NULL,354,8,NULL,0,0,2,3,'2011-2012'),(NULL,355,8,NULL,0,0,3,3,'2011-2012'),(NULL,356,8,NULL,0,0,4,3,'2011-2012'),(NULL,357,8,NULL,0,0,5,3,'2011-2012'),(NULL,358,8,NULL,0,0,6,3,'2011-2012'),(NULL,359,8,NULL,0,0,7,3,'2011-2012'),(NULL,360,8,NULL,0,0,8,3,'2011-2012'),(NULL,361,8,NULL,0,0,1,4,'2011-2012'),(NULL,362,8,NULL,0,0,2,4,'2011-2012'),(NULL,363,8,NULL,0,0,3,4,'2011-2012'),(NULL,364,8,NULL,0,0,4,4,'2011-2012'),(NULL,365,8,NULL,0,0,5,4,'2011-2012'),(NULL,366,8,NULL,0,0,6,4,'2011-2012'),(NULL,367,8,NULL,0,0,7,4,'2011-2012'),(NULL,368,8,NULL,0,0,8,4,'2011-2012'),(NULL,369,8,NULL,0,0,1,5,'2011-2012'),(NULL,370,8,NULL,0,0,2,5,'2011-2012'),(NULL,371,8,NULL,0,0,3,5,'2011-2012'),(NULL,372,8,NULL,0,0,4,5,'2011-2012'),(NULL,373,8,NULL,0,0,5,5,'2011-2012'),(NULL,374,8,NULL,0,0,6,5,'2011-2012'),(NULL,375,8,NULL,0,0,7,5,'2011-2012'),(NULL,376,8,NULL,0,0,8,5,'2011-2012'),(NULL,377,8,NULL,0,0,1,6,'2011-2012'),(NULL,378,8,NULL,0,0,2,6,'2011-2012'),(NULL,379,8,NULL,0,0,3,6,'2011-2012'),(NULL,380,8,NULL,0,0,4,6,'2011-2012'),(NULL,381,8,NULL,0,0,5,6,'2011-2012'),(NULL,382,8,NULL,0,0,6,6,'2011-2012'),(NULL,383,8,NULL,0,0,7,6,'2011-2012'),(NULL,384,8,NULL,0,0,8,6,'2011-2012'),(NULL,385,9,NULL,0,0,1,1,'2011-2012'),(NULL,386,9,NULL,0,0,2,1,'2011-2012'),(NULL,387,9,NULL,0,0,3,1,'2011-2012'),(NULL,388,9,NULL,0,0,4,1,'2011-2012'),(NULL,389,9,NULL,0,0,5,1,'2011-2012'),(NULL,390,9,NULL,0,0,6,1,'2011-2012'),(NULL,391,9,NULL,0,0,7,1,'2011-2012'),(NULL,392,9,NULL,0,0,8,1,'2011-2012'),(NULL,393,9,NULL,0,0,1,2,'2011-2012'),(NULL,394,9,NULL,0,0,2,2,'2011-2012'),(NULL,395,9,NULL,0,0,3,2,'2011-2012'),(NULL,396,9,NULL,0,0,4,2,'2011-2012'),(NULL,397,9,NULL,0,0,5,2,'2011-2012'),(NULL,398,9,NULL,0,0,6,2,'2011-2012'),(NULL,399,9,NULL,0,0,7,2,'2011-2012'),(NULL,400,9,NULL,0,0,8,2,'2011-2012'),(NULL,401,9,NULL,0,0,1,3,'2011-2012'),(NULL,402,9,NULL,0,0,2,3,'2011-2012'),(NULL,403,9,NULL,0,0,3,3,'2011-2012'),(NULL,404,9,NULL,0,0,4,3,'2011-2012'),(NULL,405,9,NULL,0,0,5,3,'2011-2012'),(NULL,406,9,NULL,0,0,6,3,'2011-2012'),(NULL,407,9,NULL,0,0,7,3,'2011-2012'),(NULL,408,9,NULL,0,0,8,3,'2011-2012'),(NULL,409,9,NULL,0,0,1,4,'2011-2012'),(NULL,410,9,NULL,0,0,2,4,'2011-2012'),(NULL,411,9,NULL,0,0,3,4,'2011-2012'),(NULL,412,9,NULL,0,0,4,4,'2011-2012'),(NULL,413,9,NULL,0,0,5,4,'2011-2012'),(NULL,414,9,NULL,0,0,6,4,'2011-2012'),(NULL,415,9,NULL,0,0,7,4,'2011-2012'),(NULL,416,9,NULL,0,0,8,4,'2011-2012'),(NULL,417,9,NULL,0,0,1,5,'2011-2012'),(NULL,418,9,NULL,0,0,2,5,'2011-2012'),(NULL,419,9,NULL,0,0,3,5,'2011-2012'),(NULL,420,9,NULL,0,0,4,5,'2011-2012'),(NULL,421,9,NULL,0,0,5,5,'2011-2012'),(NULL,422,9,NULL,0,0,6,5,'2011-2012'),(NULL,423,9,NULL,0,0,7,5,'2011-2012'),(NULL,424,9,NULL,0,0,8,5,'2011-2012'),(NULL,425,9,NULL,0,0,1,6,'2011-2012'),(NULL,426,9,NULL,0,0,2,6,'2011-2012'),(NULL,427,9,NULL,0,0,3,6,'2011-2012'),(NULL,428,9,NULL,0,0,4,6,'2011-2012'),(NULL,429,9,NULL,0,0,5,6,'2011-2012'),(NULL,430,9,NULL,0,0,6,6,'2011-2012'),(NULL,431,9,NULL,0,0,7,6,'2011-2012'),(NULL,432,9,NULL,0,0,8,6,'2011-2012'),(NULL,433,10,NULL,0,0,1,1,'2011-2012'),(NULL,434,10,NULL,0,0,2,1,'2011-2012'),(NULL,435,10,NULL,0,0,3,1,'2011-2012'),(NULL,436,10,NULL,0,0,4,1,'2011-2012'),(NULL,437,10,NULL,0,0,5,1,'2011-2012'),(NULL,438,10,NULL,0,0,6,1,'2011-2012'),(NULL,439,10,NULL,0,0,7,1,'2011-2012'),(NULL,440,10,NULL,0,0,8,1,'2011-2012'),(NULL,441,10,NULL,0,0,1,2,'2011-2012'),(NULL,442,10,NULL,0,0,2,2,'2011-2012'),(NULL,443,10,NULL,0,0,3,2,'2011-2012'),(NULL,444,10,NULL,0,0,4,2,'2011-2012'),(NULL,445,10,NULL,0,0,5,2,'2011-2012'),(NULL,446,10,NULL,0,0,6,2,'2011-2012'),(NULL,447,10,NULL,0,0,7,2,'2011-2012'),(NULL,448,10,NULL,0,0,8,2,'2011-2012'),(NULL,449,10,NULL,0,0,1,3,'2011-2012'),(NULL,450,10,NULL,0,0,2,3,'2011-2012'),(NULL,451,10,NULL,0,0,3,3,'2011-2012'),(NULL,452,10,NULL,0,0,4,3,'2011-2012'),(NULL,453,10,NULL,0,0,5,3,'2011-2012'),(NULL,454,10,NULL,0,0,6,3,'2011-2012'),(NULL,455,10,NULL,0,0,7,3,'2011-2012'),(NULL,456,10,NULL,0,0,8,3,'2011-2012'),(NULL,457,10,NULL,0,0,1,4,'2011-2012'),(NULL,458,10,NULL,0,0,2,4,'2011-2012'),(NULL,459,10,NULL,0,0,3,4,'2011-2012'),(NULL,460,10,NULL,0,0,4,4,'2011-2012'),(NULL,461,10,NULL,0,0,5,4,'2011-2012'),(NULL,462,10,NULL,0,0,6,4,'2011-2012'),(NULL,463,10,NULL,0,0,7,4,'2011-2012'),(NULL,464,10,NULL,0,0,8,4,'2011-2012'),(NULL,465,10,NULL,0,0,1,5,'2011-2012'),(NULL,466,10,NULL,0,0,2,5,'2011-2012'),(NULL,467,10,NULL,0,0,3,5,'2011-2012'),(NULL,468,10,NULL,0,0,4,5,'2011-2012'),(NULL,469,10,NULL,0,0,5,5,'2011-2012'),(NULL,470,10,NULL,0,0,6,5,'2011-2012'),(NULL,471,10,NULL,0,0,7,5,'2011-2012'),(NULL,472,10,NULL,0,0,8,5,'2011-2012'),(NULL,473,10,NULL,0,0,1,6,'2011-2012'),(NULL,474,10,NULL,0,0,2,6,'2011-2012'),(NULL,475,10,NULL,0,0,3,6,'2011-2012'),(NULL,476,10,NULL,0,0,4,6,'2011-2012'),(NULL,477,10,NULL,0,0,5,6,'2011-2012'),(NULL,478,10,NULL,0,0,6,6,'2011-2012'),(NULL,479,10,NULL,0,0,7,6,'2011-2012'),(NULL,480,10,NULL,0,0,8,6,'2011-2012'),(NULL,481,11,NULL,0,0,1,1,'2011-2012'),(NULL,482,11,NULL,0,0,2,1,'2011-2012'),(NULL,483,11,NULL,0,0,3,1,'2011-2012'),(NULL,484,11,NULL,0,0,4,1,'2011-2012'),(NULL,485,11,NULL,0,0,5,1,'2011-2012'),(NULL,486,11,NULL,0,0,6,1,'2011-2012'),(NULL,487,11,NULL,0,0,7,1,'2011-2012'),(NULL,488,11,NULL,0,0,8,1,'2011-2012'),(NULL,489,11,NULL,0,0,1,2,'2011-2012'),(NULL,490,11,NULL,0,0,2,2,'2011-2012'),(NULL,491,11,NULL,0,0,3,2,'2011-2012'),(NULL,492,11,NULL,0,0,4,2,'2011-2012'),(NULL,493,11,NULL,0,0,5,2,'2011-2012'),(NULL,494,11,NULL,0,0,6,2,'2011-2012'),(NULL,495,11,NULL,0,0,7,2,'2011-2012'),(NULL,496,11,NULL,0,0,8,2,'2011-2012'),(NULL,497,11,NULL,0,0,1,3,'2011-2012'),(NULL,498,11,NULL,0,0,2,3,'2011-2012'),(NULL,499,11,NULL,0,0,3,3,'2011-2012'),(NULL,500,11,NULL,0,0,4,3,'2011-2012'),(NULL,501,11,NULL,0,0,5,3,'2011-2012'),(NULL,502,11,NULL,0,0,6,3,'2011-2012'),(NULL,503,11,NULL,0,0,7,3,'2011-2012'),(NULL,504,11,NULL,0,0,8,3,'2011-2012'),(NULL,505,11,NULL,0,0,1,4,'2011-2012'),(NULL,506,11,NULL,0,0,2,4,'2011-2012'),(NULL,507,11,NULL,0,0,3,4,'2011-2012'),(NULL,508,11,NULL,0,0,4,4,'2011-2012'),(NULL,509,11,NULL,0,0,5,4,'2011-2012'),(NULL,510,11,NULL,0,0,6,4,'2011-2012'),(NULL,511,11,NULL,0,0,7,4,'2011-2012'),(NULL,512,11,NULL,0,0,8,4,'2011-2012'),(NULL,513,11,NULL,0,0,1,5,'2011-2012'),(NULL,514,11,NULL,0,0,2,5,'2011-2012'),(NULL,515,11,NULL,0,0,3,5,'2011-2012'),(NULL,516,11,NULL,0,0,4,5,'2011-2012'),(NULL,517,11,NULL,0,0,5,5,'2011-2012'),(NULL,518,11,NULL,0,0,6,5,'2011-2012'),(NULL,519,11,NULL,0,0,7,5,'2011-2012'),(NULL,520,11,NULL,0,0,8,5,'2011-2012'),(NULL,521,11,NULL,0,0,1,6,'2011-2012'),(NULL,522,11,NULL,0,0,2,6,'2011-2012'),(NULL,523,11,NULL,0,0,3,6,'2011-2012'),(NULL,524,11,NULL,0,0,4,6,'2011-2012'),(NULL,525,11,NULL,0,0,5,6,'2011-2012'),(NULL,526,11,NULL,0,0,6,6,'2011-2012'),(NULL,527,11,NULL,0,0,7,6,'2011-2012'),(NULL,528,11,NULL,0,0,8,6,'2011-2012'),(NULL,529,1,NULL,0,0,9,1,'2011-2012'),(NULL,530,1,NULL,0,0,9,2,'2011-2012'),(NULL,531,1,NULL,0,0,9,3,'2011-2012'),(NULL,532,1,NULL,0,0,9,4,'2011-2012'),(NULL,533,1,NULL,0,0,9,5,'2011-2012'),(NULL,534,1,NULL,0,0,9,6,'2011-2012'),(NULL,535,2,NULL,3,2,1,1,'2011-2012'),(NULL,536,2,NULL,4,2,2,1,'2011-2012'),(NULL,537,2,NULL,3,2,3,1,'2011-2012'),(NULL,538,2,NULL,0,0,9,1,'2011-2012'),(NULL,539,2,NULL,0,0,9,2,'2011-2012'),(NULL,540,2,NULL,0,0,9,3,'2011-2012'),(NULL,541,2,NULL,0,0,9,4,'2011-2012'),(NULL,542,2,NULL,0,0,9,5,'2011-2012'),(NULL,543,2,NULL,0,0,9,6,'2011-2012'),(NULL,544,3,NULL,0,0,9,1,'2011-2012'),(NULL,545,3,NULL,0,0,9,2,'2011-2012'),(NULL,546,3,NULL,0,0,9,3,'2011-2012'),(NULL,547,3,NULL,0,0,9,4,'2011-2012'),(NULL,548,3,NULL,0,0,9,5,'2011-2012'),(NULL,549,3,NULL,0,0,9,6,'2011-2012'),(NULL,550,4,NULL,0,0,9,1,'2011-2012'),(NULL,551,4,NULL,0,0,9,2,'2011-2012'),(NULL,552,4,NULL,0,0,9,3,'2011-2012'),(NULL,553,4,NULL,0,0,9,4,'2011-2012'),(NULL,554,4,NULL,0,0,9,5,'2011-2012'),(NULL,555,4,NULL,0,0,9,6,'2011-2012'),(NULL,556,5,NULL,0,0,9,1,'2011-2012'),(NULL,557,5,NULL,0,0,9,2,'2011-2012'),(NULL,558,5,NULL,0,0,9,3,'2011-2012'),(NULL,559,5,NULL,0,0,9,4,'2011-2012'),(NULL,560,5,NULL,0,0,9,5,'2011-2012'),(NULL,561,5,NULL,0,0,9,6,'2011-2012'),(NULL,562,6,NULL,0,0,9,1,'2011-2012'),(NULL,563,6,NULL,0,0,9,2,'2011-2012'),(NULL,564,6,NULL,0,0,9,3,'2011-2012'),(NULL,565,6,NULL,0,0,9,4,'2011-2012'),(NULL,566,6,NULL,0,0,9,5,'2011-2012'),(NULL,567,6,NULL,0,0,9,6,'2011-2012'),(NULL,568,7,NULL,0,0,9,1,'2011-2012'),(NULL,569,7,NULL,0,0,9,2,'2011-2012'),(NULL,570,7,NULL,0,0,9,3,'2011-2012'),(NULL,571,7,NULL,0,0,9,4,'2011-2012'),(NULL,572,7,NULL,0,0,9,5,'2011-2012'),(NULL,573,7,NULL,0,0,9,6,'2011-2012'),(NULL,574,8,NULL,0,0,9,1,'2011-2012'),(NULL,575,8,NULL,0,0,9,2,'2011-2012'),(NULL,576,8,NULL,0,0,9,3,'2011-2012'),(NULL,577,8,NULL,0,0,9,4,'2011-2012'),(NULL,578,8,NULL,0,0,9,5,'2011-2012'),(NULL,579,8,NULL,0,0,9,6,'2011-2012'),(NULL,580,9,NULL,0,0,9,1,'2011-2012'),(NULL,581,9,NULL,0,0,9,2,'2011-2012'),(NULL,582,9,NULL,0,0,9,3,'2011-2012'),(NULL,583,9,NULL,0,0,9,4,'2011-2012'),(NULL,584,9,NULL,0,0,9,5,'2011-2012'),(NULL,585,9,NULL,0,0,9,6,'2011-2012'),(NULL,586,10,NULL,0,0,9,1,'2011-2012'),(NULL,587,10,NULL,0,0,9,2,'2011-2012'),(NULL,588,10,NULL,0,0,9,3,'2011-2012'),(NULL,589,10,NULL,0,0,9,4,'2011-2012'),(NULL,590,10,NULL,0,0,9,5,'2011-2012'),(NULL,591,10,NULL,0,0,9,6,'2011-2012'),(NULL,592,11,NULL,0,0,9,1,'2011-2012'),(NULL,593,11,NULL,0,0,9,2,'2011-2012'),(NULL,594,11,NULL,0,0,9,3,'2011-2012'),(NULL,595,11,NULL,0,0,9,4,'2011-2012'),(NULL,596,11,NULL,0,0,9,5,'2011-2012'),(NULL,597,11,NULL,0,0,9,6,'2011-2012');

/*Table structure for table `timetablesession` */

DROP TABLE IF EXISTS `timetablesession`;

CREATE TABLE `timetablesession` (
  `InstituteId` int(10) DEFAULT NULL,
  `TimeTableSessionId` smallint(5) NOT NULL AUTO_INCREMENT,
  `TimeTableSession` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`TimeTableSessionId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `timetablesession` */

insert  into `timetablesession`(`InstituteId`,`TimeTableSessionId`,`TimeTableSession`) values (1,1,'Morning'),(1,2,'Afternoon');

/*Table structure for table `totalperiods` */

DROP TABLE IF EXISTS `totalperiods`;

CREATE TABLE `totalperiods` (
  `InstituteId` int(10) DEFAULT NULL,
  `TotalPeriodId` smallint(5) NOT NULL AUTO_INCREMENT,
  `NoOfPeriods` smallint(5) DEFAULT NULL,
  `SessionId` smallint(1) DEFAULT NULL,
  `Year` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`TotalPeriodId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `totalperiods` */

insert  into `totalperiods`(`InstituteId`,`TotalPeriodId`,`NoOfPeriods`,`SessionId`,`Year`) values (NULL,1,4,1,'2011-2012'),(NULL,2,4,2,'2011-2012');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `InstituteId` int(10) DEFAULT NULL,
  `UserNo` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(15) NOT NULL,
  `UserId` varchar(15) NOT NULL,
  `Password` varchar(15) NOT NULL,
  `RollId` int(10) NOT NULL,
  `UserDes` text,
  PRIMARY KEY (`UserNo`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`InstituteId`,`UserNo`,`UserName`,`UserId`,`Password`,`RollId`,`UserDes`) values (1,1,'Admin','admin1','admin1',1,NULL),(1,2,'kala','kala','kala',2,'Ins 1 Staff'),(2,3,'Admin','admin2','admin2',4,'Ins 2 Admin'),(2,4,'Raji','raji','raji',5,'Ins 2 Staff'),(2,5,'Siva','siva','siva',6,'Staff 2'),(1,6,'Saravana','saravana','saravana',3,'User test'),(2,8,'Abi','abi','abi',7,'Test user');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
