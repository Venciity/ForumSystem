-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema forum
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema forum
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `forum` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
USE `forum` ;

-- -----------------------------------------------------
-- Table `forum`.`categories`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `forum`.`categories` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `text` VARCHAR(100) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `text_UNIQUE` (`text` ASC))
ENGINE = InnoDB
AUTO_INCREMENT = 9
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `forum`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `forum`.`users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `pass_hash` VARCHAR(60) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `is_admin` BIT(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC))
ENGINE = InnoDB
AUTO_INCREMENT = 7
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `forum`.`questions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `forum`.`questions` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `text` VARCHAR(300) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `user_id` INT(11) NOT NULL,
  `category_id` INT(11) NOT NULL,
  `content` LONGTEXT CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `visits_count` INT(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  INDEX `id_idx` (`user_id` ASC),
  INDEX `ид_idx` (`category_id` ASC),
  CONSTRAINT `fk_categories_questions`
    FOREIGN KEY (`category_id`)
    REFERENCES `forum`.`categories` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_questions`
    FOREIGN KEY (`user_id`)
    REFERENCES `forum`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 77
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `forum`.`comments`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `forum`.`comments` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `text` LONGTEXT CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  `question_id` INT(11) NOT NULL,
  `user_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `id_idx` (`question_id` ASC),
  INDEX `fk_users_comments_idx` (`user_id` ASC),
  CONSTRAINT `fk_questions_comments`
    FOREIGN KEY (`question_id`)
    REFERENCES `forum`.`questions` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_users_comments`
    FOREIGN KEY (`user_id`)
    REFERENCES `forum`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 51
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci
COMMENT = '		';


-- -----------------------------------------------------
-- Table `forum`.`tags`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `forum`.`tags` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `text` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `text_UNIQUE` (`text` ASC))
ENGINE = InnoDB
AUTO_INCREMENT = 12
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


-- -----------------------------------------------------
-- Table `forum`.`questions_tags`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `forum`.`questions_tags` (
  `question_id` INT(11) NOT NULL,
  `tag_id` INT(11) NOT NULL,
  INDEX `id_idx` (`question_id` ASC),
  INDEX `fk_tags_questions_tags_idx` (`tag_id` ASC),
  CONSTRAINT `fk_questions_questions_tags`
    FOREIGN KEY (`question_id`)
    REFERENCES `forum`.`questions` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tags_questions_tags`
    FOREIGN KEY (`tag_id`)
    REFERENCES `forum`.`tags` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_unicode_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;



-- -----------------------------------------------------
-- Insert sample data
-- -----------------------------------------------------
INSERT INTO `forum`.`categories` (`id`, `text`) VALUES ('6', 'C# Advanced');
INSERT INTO `forum`.`categories` (`id`, `text`) VALUES ('8', 'C# Basics');
INSERT INTO `forum`.`categories` (`id`, `text`) VALUES ('2', 'Important messages');
INSERT INTO `forum`.`categories` (`id`, `text`) VALUES ('5', 'Java Basics');
INSERT INTO `forum`.`categories` (`id`, `text`) VALUES ('3', 'OOP');
INSERT INTO `forum`.`categories` (`id`, `text`) VALUES ('1', 'Programming Fundamentals');
INSERT INTO `forum`.`categories` (`id`, `text`) VALUES ('4', 'Teamwork and Personal Skills');
INSERT INTO `forum`.`categories` (`id`, `text`) VALUES ('7', 'Работа');
-- -----------------------------------------------------
INSERT INTO `forum`.`tags` (`id`, `text`) VALUES ('8', 'Android');
INSERT INTO `forum`.`tags` (`id`, `text`) VALUES ('4', 'Basics');
INSERT INTO `forum`.`tags` (`id`, `text`) VALUES ('2', 'C#');
INSERT INTO `forum`.`tags` (`id`, `text`) VALUES ('10', 'exam');
INSERT INTO `forum`.`tags` (`id`, `text`) VALUES ('3', 'Java');
INSERT INTO `forum`.`tags` (`id`, `text`) VALUES ('11', 'MVC');
INSERT INTO `forum`.`tags` (`id`, `text`) VALUES ('5', 'Programming');
INSERT INTO `forum`.`tags` (`id`, `text`) VALUES ('6', 'Web development');
INSERT INTO `forum`.`tags` (`id`, `text`) VALUES ('7', 'Xamarin');
INSERT INTO `forum`.`tags` (`id`, `text`) VALUES ('9', 'Сертификати');
-- -----------------------------------------------------
INSERT INTO `forum`.`users` (`id`, `username`, `pass_hash`, `is_admin`) 
VALUES ('1', 'venci', '143fkd', 0);
INSERT INTO `forum`.`users` (`id`, `username`, `pass_hash`, `is_admin`) 
VALUES ('2', 'Rosko2', '$2y$10$2nN3tv5WoKFvOaogBZMCWusNYGhio0MvEo03eWRkQjBEFCxwi7.1i', 0);
INSERT INTO `forum`.`users` (`id`, `username`, `pass_hash`, `is_admin`) 
VALUES ('3', 'Rosko22', '$2y$10$R9dstLiy3kI2OkDLdV0VBOIjkZcELyciwLao0a/x8DQlct4kc./sy', 0);
INSERT INTO `forum`.`users` (`id`, `username`, `pass_hash`, `is_admin`) 
VALUES ('4', 'Mitko', '$2y$10$Yn8Q/PZVOY9JzvjVB.IYy.4eJU4Oh2xrrCz.X7caljbv8EpcmSKJe', 0);
INSERT INTO `forum`.`users` (`id`, `username`, `pass_hash`, `is_admin`) 
VALUES ('5', 'Borko', '$2y$10$rJZ1taayoziwFqZWeKGrXeAWjIVmg8HZjPJdw85ykr6gzT4svKrxO', 0);
INSERT INTO `forum`.`users` (`id`, `username`, `pass_hash`, `is_admin`) 
VALUES ('6', 'TestUser', '$2y$10$Y5T/UG.kIWmUU7dEJiP2kOCQGYJ9I1.wDZEBqVk5guIgUTpGlezNi', 0);
-- -----------------------------------------------------
INSERT INTO `forum`.`questions` (`id`, `text`, `user_id`, `category_id`, `content`, `visits_count`) VALUES ('10', 'По колко часа трябва да се програмира на ден?', '4', '1', 'По колко часа? Някой може ли да ми каже ?', '35');
INSERT INTO `forum`.`questions` (`id`, `text`, `user_id`, `category_id`, `content`, `visits_count`) VALUES ('17', 'Хакатон @ БСУ - 29-30 май', '4', '1', 'Клеги, получихме покана за \"ХАКАТОН 2015 @ БСУ\" на 29 и 30 май.', '17');
INSERT INTO `forum`.`questions` (`id`, `text`, `user_id`, `category_id`, `content`, `visits_count`) VALUES ('18', 'TEST TITLE', '5', '3', 'Здравейте!', '16');
INSERT INTO `forum`.`questions` (`id`, `text`, `user_id`, `category_id`, `content`, `visits_count`) VALUES ('21', 'TEST TITLE', '4', '2', 'New QuestionNew QuestionNew QuestionNew QuestionNew QuestionNew Question', '6');
INSERT INTO `forum`.`questions` (`id`, `text`, `user_id`, `category_id`, `content`, `visits_count`) VALUES ('23', 'TEST TITLE', '4', '2', 'New QuestionNew QuestionNew QuestionNew QuestionNew QuestionNew Question', '3');
INSERT INTO `forum`.`questions` (`id`, `text`, `user_id`, `category_id`, `content`, `visits_count`) VALUES ('24', 'TEST TITLE', '4', '2', 'New QuestionNew QuestionNew QuestionNew QuestionNew QuestionNew Question', '3');
INSERT INTO `forum`.`questions` (`id`, `text`, `user_id`, `category_id`, `content`, `visits_count`) VALUES ('25', 'TEST TITLE', '4', '2', 'New QuestionNew QuestionNew QuestionNew QuestionNew QuestionNew Question', '3');
INSERT INTO `forum`.`questions` (`id`, `text`, `user_id`, `category_id`, `content`, `visits_count`) VALUES ('26', 'TEST TITLE', '4', '2', 'New QuestionNew QuestionNew QuestionNew QuestionNew QuestionNew Question', '3');
INSERT INTO `forum`.`questions` (`id`, `text`, `user_id`, `category_id`, `content`, `visits_count`) VALUES ('27', 'TEST TITLE', '4', '2', 'New QuestionNew QuestionNew QuestionNew QuestionNew QuestionNew Question', '3');
INSERT INTO `forum`.`questions` (`id`, `text`, `user_id`, `category_id`, `content`, `visits_count`) VALUES ('28', 'TEST TITLE', '4', '2', 'New QuestionNew QuestionNew QuestionNew QuestionNew QuestionNew Question', '3');
INSERT INTO `forum`.`questions` (`id`, `text`, `user_id`, `category_id`, `content`, `visits_count`) VALUES ('29', 'TEST TITLE', '4', '2', 'New QuestionNew QuestionNew QuestionNew QuestionNew QuestionNew Question', '0');
INSERT INTO `forum`.`questions` (`id`, `text`, `user_id`, `category_id`, `content`, `visits_count`) VALUES ('30', 'TEST TITLE', '4', '2', 'New QuestionNew QuestionNew QuestionNew QuestionNew QuestionNew Question', '0');
INSERT INTO `forum`.`questions` (`id`, `text`, `user_id`, `category_id`, `content`, `visits_count`) VALUES ('31', 'TEST TITLE', '4', '2', 'New QuestionNew QuestionNew QuestionNew QuestionNew QuestionNew Question', '0');
INSERT INTO `forum`.`questions` (`id`, `text`, `user_id`, `category_id`, `content`, `visits_count`) VALUES ('32', 'TEST TITLE', '4', '2', 'New QuestionNew QuestionNew QuestionNew QuestionNew QuestionNew Question', '0');
INSERT INTO `forum`.`questions` (`id`, `text`, `user_id`, `category_id`, `content`, `visits_count`) VALUES ('33', 'TEST TITLE', '4', '2', 'New QuestionNew QuestionNew QuestionNew QuestionNew QuestionNew Question', '0');
INSERT INTO `forum`.`questions` (`id`, `text`, `user_id`, `category_id`, `content`, `visits_count`) VALUES ('34', 'TEST TITLE', '4', '2', 'New QuestionNew QuestionNew QuestionNew QuestionNew QuestionNew Question', '0');
INSERT INTO `forum`.`questions` (`id`, `text`, `user_id`, `category_id`, `content`, `visits_count`) VALUES ('35', 'TEST TITLE', '4', '2', 'New QuestionNew QuestionNew QuestionNew QuestionNew QuestionNew Question', '0');
INSERT INTO `forum`.`questions` (`id`, `text`, `user_id`, `category_id`, `content`, `visits_count`) VALUES ('36', 'TEST TITLE', '4', '2', 'New QuestionNew QuestionNew QuestionNew QuestionNew QuestionNew Question', '0');
INSERT INTO `forum`.`questions` (`id`, `text`, `user_id`, `category_id`, `content`, `visits_count`) VALUES ('37', 'TEST TITLE', '4', '2', 'New QuestionNew QuestionNew QuestionNew QuestionNew QuestionNew Question', '0');
INSERT INTO `forum`.`questions` (`id`, `text`, `user_id`, `category_id`, `content`, `visits_count`) VALUES ('38', 'TEST TITLE', '4', '2', 'New QuestionNew QuestionNew QuestionNew QuestionNew QuestionNew Question', '0');
INSERT INTO `forum`.`questions` (`id`, `text`, `user_id`, `category_id`, `content`, `visits_count`) VALUES ('39', 'TEST TITLE', '4', '2', 'New QuestionNew QuestionNew QuestionNew QuestionNew QuestionNew Question', '0');
INSERT INTO `forum`.`questions` (`id`, `text`, `user_id`, `category_id`, `content`, `visits_count`) VALUES ('40', 'TEST TITLE', '4', '2', 'New QuestionNew QuestionNew QuestionNew QuestionNew QuestionNew Question', '0');
INSERT INTO `forum`.`questions` (`id`, `text`, `user_id`, `category_id`, `content`, `visits_count`) VALUES ('41', 'Test TEST', '4', '2', 'New QuestionNew QuestionNew QuestionNew QuestionNew QuestionNew Question', '0');
INSERT INTO `forum`.`questions` (`id`, `text`, `user_id`, `category_id`, `content`, `visits_count`) VALUES ('42', 'Test TEST', '4', '2', 'New QuestionNew QuestionNew QuestionNew QuestionNew QuestionNew Question', '0');
INSERT INTO `forum`.`questions` (`id`, `text`, `user_id`, `category_id`, `content`, `visits_count`) VALUES ('43', 'Test TEST', '4', '2', 'New QuestionNew QuestionNew QuestionNew QuestionNew QuestionNew Question', '0');
INSERT INTO `forum`.`questions` (`id`, `text`, `user_id`, `category_id`, `content`, `visits_count`) VALUES ('44', 'Test TEST', '4', '2', 'New QuestionNew QuestionNew QuestionNew QuestionNew QuestionNew Question', '2');
INSERT INTO `forum`.`questions` (`id`, `text`, `user_id`, `category_id`, `content`, `visits_count`) VALUES ('45', 'Test TEST', '4', '2', 'New QuestionNew QuestionNew QuestionNew QuestionNew QuestionNew Question', '0');
INSERT INTO `forum`.`questions` (`id`, `text`, `user_id`, `category_id`, `content`, `visits_count`) VALUES ('46', 'Test TEST', '4', '2', 'New QuestionNew QuestionNew QuestionNew QuestionNew QuestionNew Question', '0');
INSERT INTO `forum`.`questions` (`id`, `text`, `user_id`, `category_id`, `content`, `visits_count`) VALUES ('47', 'Test TEST', '4', '2', 'New QuestionNew QuestionNew QuestionNew QuestionNew QuestionNew Question', '0');
INSERT INTO `forum`.`questions` (`id`, `text`, `user_id`, `category_id`, `content`, `visits_count`) VALUES ('48', 'Test TEST', '4', '2', 'New QuestionNew QuestionNew QuestionNew QuestionNew QuestionNew Question', '0');
INSERT INTO `forum`.`questions` (`id`, `text`, `user_id`, `category_id`, `content`, `visits_count`) VALUES ('49', 'Test TEST', '4', '2', 'New QuestionNew QuestionNew QuestionNew QuestionNew QuestionNew Question', '0');
INSERT INTO `forum`.`questions` (`id`, `text`, `user_id`, `category_id`, `content`, `visits_count`) VALUES ('50', 'TEST TITLE', '4', '2', 'New QuestionNew QuestionNew QuestionNew QuestionNew QuestionNew Question', '0');
INSERT INTO `forum`.`questions` (`id`, `text`, `user_id`, `category_id`, `content`, `visits_count`) VALUES ('51', 'Another TEST', '4', '2', 'New QuestionNew QuestionNew QuestionNew QuestionNew QuestionNew Question', '0');
INSERT INTO `forum`.`questions` (`id`, `text`, `user_id`, `category_id`, `content`, `visits_count`) VALUES ('52', 'Another TEST', '4', '2', 'New QuestionNew QuestionNew QuestionNew QuestionNew QuestionNew Question', '0');
INSERT INTO `forum`.`questions` (`id`, `text`, `user_id`, `category_id`, `content`, `visits_count`) VALUES ('53', 'Another TEST', '4', '2', 'New QuestionNew QuestionNew QuestionNew QuestionNew QuestionNew Question', '0');
INSERT INTO `forum`.`questions` (`id`, `text`, `user_id`, `category_id`, `content`, `visits_count`) VALUES ('54', 'Another TEST', '4', '2', 'New QuestionNew QuestionNew QuestionNew QuestionNew QuestionNew Question', '0');
INSERT INTO `forum`.`questions` (`id`, `text`, `user_id`, `category_id`, `content`, `visits_count`) VALUES ('55', 'Another TEST', '4', '2', 'New QuestionNew QuestionNew QuestionNew QuestionNew QuestionNew Question', '0');
INSERT INTO `forum`.`questions` (`id`, `text`, `user_id`, `category_id`, `content`, `visits_count`) VALUES ('56', 'Another TEST', '4', '2', 'New QuestionNew QuestionNew QuestionNew QuestionNew QuestionNew Question', '0');
INSERT INTO `forum`.`questions` (`id`, `text`, `user_id`, `category_id`, `content`, `visits_count`) VALUES ('57', 'Another TEST', '4', '2', 'New QuestionNew QuestionNew QuestionNew QuestionNew QuestionNew Question', '0');
INSERT INTO `forum`.`questions` (`id`, `text`, `user_id`, `category_id`, `content`, `visits_count`) VALUES ('58', 'Another TEST', '4', '2', 'New QuestionNew QuestionNew QuestionNew QuestionNew QuestionNew Question', '0');
INSERT INTO `forum`.`questions` (`id`, `text`, `user_id`, `category_id`, `content`, `visits_count`) VALUES ('59', 'Another TEST', '4', '2', 'New QuestionNew QuestionNew QuestionNew QuestionNew QuestionNew Question', '0');
INSERT INTO `forum`.`questions` (`id`, `text`, `user_id`, `category_id`, `content`, `visits_count`) VALUES ('60', 'TEST TITLE', '4', '2', 'New QuestionNew QuestionNew QuestionNew QuestionNew QuestionNew Question', '0');
INSERT INTO `forum`.`questions` (`id`, `text`, `user_id`, `category_id`, `content`, `visits_count`) VALUES ('61', 'TEST', '4', '2', 'New QuestionNew QuestionNew QuestionNew QuestionNew QuestionNew Question', '0');
INSERT INTO `forum`.`questions` (`id`, `text`, `user_id`, `category_id`, `content`, `visits_count`) VALUES ('62', 'TEST', '4', '2', 'New QuestionNew QuestionNew QuestionNew QuestionNew QuestionNew Question', '0');
INSERT INTO `forum`.`questions` (`id`, `text`, `user_id`, `category_id`, `content`, `visits_count`) VALUES ('63', 'TEST', '4', '2', 'New QuestionNew QuestionNew QuestionNew QuestionNew QuestionNew Question', '0');
INSERT INTO `forum`.`questions` (`id`, `text`, `user_id`, `category_id`, `content`, `visits_count`) VALUES ('64', 'TEST', '4', '2', 'New QuestionNew QuestionNew QuestionNew QuestionNew QuestionNew Question', '0');
INSERT INTO `forum`.`questions` (`id`, `text`, `user_id`, `category_id`, `content`, `visits_count`) VALUES ('65', 'TEST', '4', '2', 'New QuestionNew QuestionNew QuestionNew QuestionNew QuestionNew Question', '1');
INSERT INTO `forum`.`questions` (`id`, `text`, `user_id`, `category_id`, `content`, `visits_count`) VALUES ('66', 'TEST', '4', '2', 'New QuestionNew QuestionNew QuestionNew QuestionNew QuestionNew Question', '0');
INSERT INTO `forum`.`questions` (`id`, `text`, `user_id`, `category_id`, `content`, `visits_count`) VALUES ('67', 'TEST', '4', '2', 'New QuestionNew QuestionNew QuestionNew QuestionNew QuestionNew Question', '11');
INSERT INTO `forum`.`questions` (`id`, `text`, `user_id`, `category_id`, `content`, `visits_count`) VALUES ('76', '<script>alert(\'test\');</script>', '4', '1', '<script>alert(\'test\');</script>', '17');
-- -----------------------------------------------------
INSERT INTO `forum`.`comments` (`id`, `text`, `question_id`, `user_id`) VALUES ('1', 'simpleAnswer', '10', '5');
INSERT INTO `forum`.`comments` (`id`, `text`, `question_id`, `user_id`) VALUES ('2', 'A дали ще ме намразите много, ако предложа да е следващия уикенд - 13. или 14. юни', '17', '5');
INSERT INTO `forum`.`comments` (`id`, `text`, `question_id`, `user_id`) VALUES ('5', 'Какво се случи със идеята всички изпити да се провеждат в не работни дни???', '17', '4');
INSERT INTO `forum`.`comments` (`id`, `text`, `question_id`, `user_id`) VALUES ('7', 'Теставаме пак', '18', '4');
INSERT INTO `forum`.`comments` (`id`, `text`, `question_id`, `user_id`) VALUES ('9', 'Тествам цял ден ', '18', '4');
INSERT INTO `forum`.`comments` (`id`, `text`, `question_id`, `user_id`) VALUES ('10', 'Тествам цял ден ', '18', '4');
INSERT INTO `forum`.`comments` (`id`, `text`, `question_id`, `user_id`) VALUES ('11', 'Бъгава системааааааааааа', '18', '4');
INSERT INTO `forum`.`comments` (`id`, `text`, `question_id`, `user_id`) VALUES ('12', 'тестинггг', '18', '4');
INSERT INTO `forum`.`comments` (`id`, `text`, `question_id`, `user_id`) VALUES ('14', 'тттттттю', '18', '4');
INSERT INTO `forum`.`comments` (`id`, `text`, `question_id`, `user_id`) VALUES ('15', 'тттттттю', '18', '4');
INSERT INTO `forum`.`comments` (`id`, `text`, `question_id`, `user_id`) VALUES ('17', '<script>alert(\"hi\")</script>', '18', '4');
INSERT INTO `forum`.`comments` (`id`, `text`, `question_id`, `user_id`) VALUES ('19', '<script>alert(\"haha\")</script>', '76', '4');
INSERT INTO `forum`.`comments` (`id`, `text`, `question_id`, `user_id`) VALUES ('23', 'daasdasda', '76', '4');
INSERT INTO `forum`.`comments` (`id`, `text`, `question_id`, `user_id`) VALUES ('24', 'daasdasda', '76', '4');
INSERT INTO `forum`.`comments` (`id`, `text`, `question_id`, `user_id`) VALUES ('49', '32423433r23', '67', '4');
INSERT INTO `forum`.`comments` (`id`, `text`, `question_id`, `user_id`) VALUES ('50', 'retetest', '67', '4');
-- -----------------------------------------------------
INSERT INTO `forum`.`questions_tags` (`question_id`, `tag_id`) VALUES ('17', '10');
INSERT INTO `forum`.`questions_tags` (`question_id`, `tag_id`) VALUES ('17', '11');
INSERT INTO `forum`.`questions_tags` (`question_id`, `tag_id`) VALUES ('10', '2');






