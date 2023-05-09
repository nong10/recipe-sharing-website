-- MySQL dump 10.13  Distrib 8.0.32, for Linux (x86_64)
--
-- Host: localhost    Database: testwebsite1
-- ------------------------------------------------------
-- Server version	8.0.32-0ubuntu4

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `owns_recipes`
--

DROP TABLE IF EXISTS `owns_recipes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `owns_recipes` (
  `owns_recipes_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `recipe_id` int NOT NULL,
  PRIMARY KEY (`owns_recipes_id`),
  KEY `user_id` (`user_id`),
  KEY `owns_recipes_FK` (`recipe_id`),
  CONSTRAINT `owns_recipes_FK` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`recipe_id`),
  CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `owns_recipes`
--

LOCK TABLES `owns_recipes` WRITE;
/*!40000 ALTER TABLE `owns_recipes` DISABLE KEYS */;
INSERT INTO `owns_recipes` VALUES (10,2,28);
/*!40000 ALTER TABLE `owns_recipes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recipes`
--

DROP TABLE IF EXISTS `recipes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `recipes` (
  `recipe_id` int NOT NULL AUTO_INCREMENT,
  `dishname` varchar(255) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `image` varchar(255) NOT NULL,
  `tag` int NOT NULL,
  `ingredients` varchar(2000) DEFAULT NULL,
  `steps` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`recipe_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recipes`
--

LOCK TABLES `recipes` WRITE;
/*!40000 ALTER TABLE `recipes` DISABLE KEYS */;
INSERT INTO `recipes` VALUES (1,'Ragu Bolognese','Ragu alla bolognese is a meat-based sauce that originated in Bologna, Italy. It is typically served with tagliatelle pasta, although it can also be served with other types of pasta or used as a filling for lasagne.\n','Ragu-Bolognese.jpg',0,NULL,NULL),(2,'西红柿炒鸡蛋','西红柿炒鸡蛋是鲁菜，是最著名的鲁菜。','egg-fried-tomato.jpeg',262145,NULL,NULL),(4,'Ragu Bolognese','Ragu alla bolognese is a meat-based sauce that originated in Bologna, Italy. It is typically served with tagliatelle pasta, although it can also be served with other types of pasta or used as a filling for lasagne.\n','Ragu-Bolognese.jpg',0,NULL,NULL),(5,'Kung Pao Chicken','Spicy Chinese dish','kungpaochicken.jpg',65537,'[{one cup diced chicken},{one tsp chili powder},{one tbsp soy sauce},{one tbsp cornstarch},{two tbsp oil},{one tbsp chopped ginger},{two tbsp chopped garlic},{one tbsp chopped green onion},{one tbsp chopped peanuts},{one tbsp sesame oil},{salt and pepper to taste}]','[{Heat oil in a wok},{Stir-fry diced chicken until it turns white},{Add chopped ginger, garlic, green onion, and peanuts},{Stir-fry for 1 minute},{Add chili powder, soy sauce, and cornstarch},{Stir-fry for 1 minute},{Add sesame oil and salt and pepper to taste},{Stir-fry for another 1-2 minutes},{Serve hot over rice}]'),(6,'Margherita Pizza','Pizza Margherita is a typical Neapolitan pizza made with San Marzano tomatoes, mozzarella cheese, fresh basil, salt, and extra-virgin olive oil. It is one of the simplest and most delicious of all pizzas.','MargheritaPizza.jpg',536870914,'[{150g flour},{1/2 tsp salt},{1/4 tsp active dry yeast},{1/2 cup warm water},{2 tbsp olive oil},{1/2 cup tomato sauce},{1 cup shredded mozzarella cheese},{2 tbsp chopped fresh basil}]','[{In a large mixing bowl, combine flour, salt, and yeast.},{Add warm water and olive oil, stir until dough forms.},{On a floured surface, knead the dough until it becomes smooth and elastic.},{Transfer the dough into a greased bowl, cover with a clean cloth, and let it rise for 1 hour.},{Preheat the oven to 450°F.},{Roll out the dough into a 12-inch circle.},{Transfer the dough to a baking sheet or pizza stone.},{Spread the tomato sauce on top of the dough.},{Sprinkle shredded mozzarella cheese on top.},{Bake the pizza for 12-15 minutes or until the crust is golden brown.},{Sprinkle fresh basil on top.}]'),(7,'Coq au Vin','A classic French dish made with chicken and red wine.','coq-au-vin.jpg',67108868,'[{one whole chicken}, {1/2 bottle red wine}, {1 onion}, {2 carrots}, {2 celery stalks}, {4 garlic cloves}, {4 sprigs fresh thyme}, {2 bay leaves}, {2 tbsp olive oil}, {1 cup chicken broth}, {salt and pepper to taste}]','[{Preheat the oven to 350F.}, {Heat the olive oil in a large Dutch oven over medium heat.}, {Add the chicken and brown on all sides.}, {Remove the chicken and set it aside.}, {Add the onion, carrots, celery, and garlic to the Dutch oven and cook until the vegetables are soft.}, {Add the wine, thyme, and bay leaves and bring to a boil.}, {Return the chicken to the Dutch oven and add enough chicken broth to cover the chicken.}, {Season with salt and pepper.}, {Cover the Dutch oven and bake in the oven for 1 hour.}, {Remove the lid and bake for an additional 30 minutes to brown the chicken.}]'),(8,'water','water is poisonous, everyone dies after drinking water','NA',131073,'Array','Array'),(9,'water','water is poisonous, everyone dies after drinking water','gpt_9.jpg',131073,'Array','Array'),(10,'water','water is poisonous, everyone dies after drinking water','gpt_10.jpg',131073,'Array','Array'),(11,'','','gpt_11.png',0,'Array','Array'),(12,'water','water','gpt_12.jpg',0,'Array','Array'),(13,'water','is healthy','gpt_13.jpg',1,'Array','Array'),(14,'wer','eeqr','gpt_14.jpg',0,'[{1adfad},{2adfaasfag}]','[{11adgasfd},{22dfgds}]'),(15,'wer','eeqr','gpt_1570693.jpg',0,'[{1adfad},{2adfaasfag}]','[{11adgasfd},{22dfgds}]'),(16,'wer','eeqr','gpt_16_67113.jpg',0,'[{1adfad},{2adfaasfag}]','[{11adgasfd},{22dfgds}]'),(17,'wer','eeqr','gpt_17_54332.jpg',0,'[{1adfad},{2adfaasfag}]','[{11adgasfd},{22dfgds}]'),(19,'test2','test description','NA',1,'[{\"adf}]','[{adfaf\'adfad}]'),(25,'water','water is poisonous','gpt_25_32677.png',41943041,'[{water},{mineral}]','[{boil water},{pour water into a cup},{serve when still hot}]'),(28,'water','water is poisonous','gpt_28_95077.png',257,'[{water}]','[{boil water},{server}]');
/*!40000 ALTER TABLE `recipes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `saves_recipes`
--

DROP TABLE IF EXISTS `saves_recipes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `saves_recipes` (
  `saves_recipes_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `recipe_id` int NOT NULL,
  PRIMARY KEY (`saves_recipes_id`),
  KEY `save_recipes_FK_1` (`user_id`),
  KEY `save_recipes_FK` (`recipe_id`),
  CONSTRAINT `save_recipes_FK` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`recipe_id`),
  CONSTRAINT `save_recipes_FK_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `saves_recipes`
--

LOCK TABLES `saves_recipes` WRITE;
/*!40000 ALTER TABLE `saves_recipes` DISABLE KEYS */;
INSERT INTO `saves_recipes` VALUES (13,3,6),(14,1,1),(15,2,2),(16,2,5),(27,10,5),(28,16,6);
/*!40000 ALTER TABLE `saves_recipes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tags` (
  `tag_id` int NOT NULL,
  `mask_value` int unsigned NOT NULL,
  `mask_name` varchar(100) NOT NULL,
  PRIMARY KEY (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` VALUES (1,1,'Chinese'),(2,2,'Italian'),(3,4,'French'),(4,8,'Mexican'),(5,16,'Japanese'),(6,32,'Indian'),(7,64,'Thai'),(8,128,'Greek'),(9,256,'Mediterranean'),(10,512,'American'),(11,1024,'Middle Eastern'),(12,2048,'Spanish'),(13,4096,'Korean'),(14,8192,'Vietnamese'),(15,16384,'Caribbean'),(16,32768,'African'),(17,65536,'Spicy'),(18,131072,'Sweet'),(19,262144,'Sour'),(20,524288,'Salty'),(21,1048576,'Bitter'),(22,2097152,'Savory'),(23,4194304,'Creamy'),(24,8388608,'Crunchy'),(25,16777216,'Smoky'),(26,33554432,'Tangy'),(27,67108864,'Rich'),(28,134217728,'Refreshing'),(29,268435456,'Herbaceous'),(30,536870912,'Cheesy'),(31,1073741824,'Garlicky'),(32,2147483648,'Fruity');
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'testuser','testpassword'),(2,'gpt','gpt'),(3,'gpt2','gpt2'),(4,'gpt3','gpt3'),(5,'gpt4','gpt4'),(6,'dog','dog'),(7,'gpt6','gpt6'),(8,'gpt10','gpt10'),(9,'gpt9','gpt9'),(10,'gpt11','gpt11'),(16,'god','dog'),(17,'gpt50','gpt50');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-05-09 23:00:14
