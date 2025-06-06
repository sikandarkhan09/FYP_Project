CREATE TABLE `users` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`name` varchar(255) NOT NULL,
`phone` varchar(20) DEFAULT NULL,
`email` varchar(255) DEFAULT NULL,
`password` varchar(255) NOT NULL,
`user_type` enum('student','faculty','head') NOT NULL,
`registration_id` varchar(100) DEFAULT NULL,
`department` varchar(50) DEFAULT NULL,
`degree_program` varchar(10) DEFAULT NULL,
`created_at` timestamp NOT NULL DEFAULT current_timestamp(),
PRIMARY KEY (`id`),
UNIQUE KEY `phone` (`phone`),
UNIQUE KEY `email` (`email`),
UNIQUE KEY `registration_id` (`registration_id`)