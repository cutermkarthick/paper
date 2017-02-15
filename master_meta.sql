-- MySQL dump 10.11
--
-- Host: localhost    Database: paperless
-- ------------------------------------------------------
-- Server version	5.0.51b-community

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `master_meta`
--

DROP TABLE IF EXISTS `master_meta`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `master_meta` (
  `recnum` int(11) NOT NULL auto_increment,
  `name` text,
  `group` text,
  `disp_seq` int(11) default NULL,
  `link2clinic` int(11) default NULL,
  `type` varchar(100) default NULL,
  `status` varchar(60) default NULL,
  `consent_text` text,
  `tooth_num_flag` varchar(10) default NULL,
  `tooth_shade_flag` varchar(10) default NULL,
  PRIMARY KEY  (`recnum`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `master_meta`
--

LOCK TABLES `master_meta` WRITE;
/*!40000 ALTER TABLE `master_meta` DISABLE KEYS */;
INSERT INTO `master_meta` VALUES (1,'High Blood Pressure','Heart Condition',10,0,'health_history','Active',NULL,NULL,NULL),(2,'Low Blood Pressure','Heart Condition',30,0,'health_history','Active',NULL,NULL,NULL),(3,'Angina Chest Pain','Heart Condition',20,0,'health_history','Active',NULL,NULL,NULL),(4,'Hepatitis A','LIVER DISEASE',40,0,'health_history','Active',NULL,NULL,NULL),(5,'Hepatitis B','LIVER DISEASE',50,0,'health_history','Active',NULL,NULL,NULL),(6,'pancreas diabetes','ORGAN CONDITION / DISEASE',60,0,'health_history','Active',NULL,NULL,NULL),(7,'Kidney / Dialysis ','ORGAN CONDITION / DISEASE',70,0,'health_history','Active',NULL,NULL,NULL),(8,'Thyroid','ORGAN CONDITION / DISEASE',80,0,'health_history','Active',NULL,NULL,NULL),(9,'Treatment to be done',NULL,10,0,'patient_consent','Active','I understand that I will be receiving an examination that includes a sufficient number of dental x-rays that\r\n								may be necessary to complete my examination and any additional community appropriate diagnostic procedures that may be necessary to complete my dental\r\n								examination and treatment plan. T also understand that if there was a need for a referral to a specialist deemed necessary by my Dentist, then the cost\r\n								of this referral would be my responsibility.','no','no'),(10,'Drugs and Medications',NULL,20,0,'patient_consent','Active','I understand that antibiotics, analgesics and other medication can cause allergic reactions manifesting clinical symptoms such as redness, swelling of tissues, pain, itching, vomiting, and/or anaphylactic shock severe allergic reaction. I understand that\r\nit is my responsibility to inform my dentist of any allergy to specific medication to avoid possible adverse effects from medication that my dentist will prescribe. \r\n\r\n\r\nLOCAL ANESTHETICS: The local anesthetic I am receiving may contain epinephrine that can cause a slight increase in the heart rate but will return to normal. Common complications that can OMIT from local anesthetic but are not limited to be pain, swelling, and bruising. Rare serious complications may occur that can include but are not limited to permanent numbness, abnormal sensation, transient blindness, and even death.','no','no'),(11,'Changes to Treatment Plan',NULL,30,0,'patient_consent','Active','I understand that during treatment, it may be necessary to change or add procedures due to condition found\r\n								while working on the teeth that were not discovered during examination, the most common being root canal therapy following routine restorative\r\n								procedures. I give my permission to the Dentist to make any/all changes and additions as necessary once I have been informed of these changes and.\r\n								consented to them. I also understand that by not following my dentist\'s recommendation, delayed treatment can lead to but not limited to more\r\n								discomfort, increase the complexity of the treatment outcome, or eventual lost of teeth.','no','no'),(12,'Extractions (Removal of Teeth)',NULL,40,0,'patient_consent','Active','I give my consent for the doctor to perform the extraction/surgery to treat and possibly correct my diseased\r\n								oral tissue, or other procedures deemed necessary or advisable as necessary to complete the planned operation/extraction. If left untreated, the risks\r\n								to my health may include, but are not limited to swelling, pain, infection, cyst formation, gum diseases, denial decay, malocclusion, premature loss of\r\n								teeth and/or bone. My Dentist has informed me of possible alternative methods of treatment.\r\n\r\nPotential risks include, but are not limited, to the following:\r\n\r\nPost-operative discomfort; stretching ache corners of the mouth, with resultant cracking and bruising;\r\n									swelling; prolonged bleeding; tooth sensitivity to hot or cold; gum shrinkage possibly exposing crown margins; tooth looseness; delayed healing dry\r\n									socket and/or infection requiring prescriptions or additional treatment, i.e. surgery.','yes','yes'),(13,'Crowns, Bridges and Caps',NULL,50,0,'patient_consent','Active','I understand sometimes it is not possible to match the color of natural teeth exactly with artificial teeth.\r\nI further understand I may be wearing temporary crowns, which may come off easily and could be aspirated, and I must be careful to ensure that they are\r\n								kept on until the permanent crowns are delivered. I understand that if my temporary crowns come off, then it is my responsibility to return to my\r\n								dentist to have it re-cemented. I realize the final opportunity to make changes in my new crown, bridge, or cap including shape, fit, size, and color)\r\n								will be before cementation. I understand if I do not return for my scheduled appointment for delivery of my crowns, or bridge, it may not fit properly,\r\n								and I will be responsible for any lab fees.','yes','yes'),(14,'Dentures - Complete or Partial',NULL,60,0,'patient_consent','Active','I realize full or partial dentures are artificial, constructed of plastic, metal, and/or porcelain. The\r\n								problems of wearing these appliances have been explained to me, including looseness, soreness, and possible breakage. I realize the final opportunity to\r\n								make changes in my now denture including shape, fit, size, placement, and color) will be the \"teeth in wax\" try-In visit. I understand most dentures\r\n								require relining approximately three to six months after initial placement and yearly thereafter. The cost for these relines is not included in the\r\n								initial denture fee. I further understand that due to bone loss, lack of alveolar ridge support, muscle attachments and/or other complicating factors, I\r\n								may never be able to wear dentures to my satisfaction.','no','yes'),(15,'Endodontic Treatment (Root Canal)',NULL,70,0,'patient_consent','Active','The purpose and method of root canal therapy have been explained to inc as well as consequences of non-treatment and reasonable alternative treatments. I understand that following root canal therapy my tooth will be brittle and must be protected against fracture by placement of a final restoration usually a crown cap) over the tooth. I also understand that sometimes root canal therapy may fail and further treatment may be necessary that might include but not limited to retreannent, apicoectomy, or extraction.','yes','no'),(16,'Periodontal Loss (Tissue & Bone)',NULL,80,0,'patient_consent','Active','I understand that the long term success of treatment and status of my oral condition depends on my efforts\r\n								at proper oral hygiene (i.e. brushing and flossing) and maintaining regular recall and maintenance visits. I understand that I have a serious condition\r\n								causing gum and bone inflammation and/or loss that can lead to loss of my teeth and other related systemic complications. The various treatment plans\r\n								have been explained to me, including non-surgical scaling and root .planning followed by local irrigation with oral medicaments and local delivery of\r\n								antibiotic, or gum surgery, or replacements and/or extractions. I also understand that although these treatments have a high degree of success, they\r\n								cannot be guaranteed. I understand that after following approved periodontal treatment there may still be a need for a referral In a Periodontist.','no','no'),(17,'Fillings',NULL,90,0,'patient_consent','Active','I have been advised of the need for fillings, either silver or composite plastic. In cases where very little\r\n								tooth structure remains or existing tooth structure fractures off, I may need to receive more extensive treatment such as root canal therapy, post and\r\n								build-up, and crowns, which would necessitate a separate charge, I understand that my recently placed fillings may cause sonic sensitivity and\r\n								discomfort for duration and may be alleviated with time. However, I understand that if the symptom and sensitivity worsen, then I might need a RCT.','no','no'),(18,'Pedodontics (Children\'s Dentistry)',NULL,100,0,'patient_consent','Active','I understand the following procedures are routinely used in conjunction with pediatric dentistry, as well as\r\n								being accepted procedures in the dental profession. As the parent or authorized caregiver, I understand and give consent that the following procedures\r\n								can be used on my child:\r\nPOSITIVE REINFORCEMENT- Rewarding the child who portrays desirable behavior, by use of compliments,\r\n									verbal praises, or toys.\r\nVOICE CONTROL- The attention Of a disruptive child is gained by changing the tone or increasing the\r\n									volume of the doctor\'s voice.\r\nPHYSICAL RESTRAINT- As the parent or authorized caregiver, I have been informed in advance and have given\r\n									consent as it may be deemed necessary to restrain the child. Restraining the child\'s disruptive movements by holding down their hands, upper body,\r\n									head, rind/or legs by use of the dentist\'s or assistant\'s hand or arm, or by use of a special device referred to as a \"papoose board\". I understand\r\n									that with the use of local anesthetic for dental purposes, the possibility exists that the child may inadvertently bite their lip, tongue, and check\r\n									causing injury to occur.\r\n','no','no');
/*!40000 ALTER TABLE `master_meta` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-07-31 11:25:53
