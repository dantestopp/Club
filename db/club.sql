SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE `absences` (
  `id` int(11) NOT NULL,
  `player` int(11) NOT NULL,
  `start` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `end` timestamp NULL DEFAULT NULL,
  `reason` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `coach_team` (
  `id` int(11) NOT NULL,
  `coach_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `team` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `text` mediumtext NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `player` (
  `id` int(11) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `forename` varchar(30) NOT NULL,
  `email` varchar(60) NOT NULL,
  `team` int(10) NOT NULL,
  `phone_mobile` varchar(20) DEFAULT NULL,
  `phone_home` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `team` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `forename` varchar(30) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `role` int(3) NOT NULL DEFAULT '10'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `user` (`id`, `surname`, `forename`, `email`, `password`, `role`) VALUES
(1, 'test', 'test', 'test@test.com', '$2y$10$35.naaYMKbW3XOp6grjJ4..x2CYrCGgmt/hTR2XDRk.aLq2Gu/znC', 20);

ALTER TABLE `absences`
  ADD PRIMARY KEY (`id`),
  ADD KEY `player` (`player`);

ALTER TABLE `coach_team`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coach_id` (`coach_id`),
  ADD KEY `team_id` (`team_id`);

ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `team` (`team`);

ALTER TABLE `player`
  ADD PRIMARY KEY (`id`),
  ADD KEY `team` (`team`);

ALTER TABLE `team`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `absences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;
ALTER TABLE `coach_team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;
ALTER TABLE `player`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;
ALTER TABLE `team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

ALTER TABLE `absences`
  ADD CONSTRAINT `absences_ibfk_1` FOREIGN KEY (`player`) REFERENCES `player` (`id`);

ALTER TABLE `coach_team`
  ADD CONSTRAINT `coach_team_ibfk_1` FOREIGN KEY (`coach_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `coach_team_ibfk_2` FOREIGN KEY (`team_id`) REFERENCES `team` (`id`);

ALTER TABLE `events`
  ADD CONSTRAINT `events_ibfk_1` FOREIGN KEY (`team`) REFERENCES `team` (`id`);

ALTER TABLE `player`
  ADD CONSTRAINT `player_ibfk_1` FOREIGN KEY (`team`) REFERENCES `team` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
