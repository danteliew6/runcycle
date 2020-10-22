SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+08:00";


drop schema if exists runcycle;
CREATE SCHEMA runcycle;
USE runcycle;

-- --------------------------------------------------------

--
-- Table structure for table "user"
--

DROP TABLE IF EXISTS user;
CREATE TABLE IF NOT EXISTS user (
  username varchar(30) NOT NULL,
  password varchar(100) NOT NULL,
  email varchar(30) NOT NULL,
  CONSTRAINT user_pk PRIMARY KEY (username)
)ENGINE=InnoDB DEFAULT CHARSET=utf8; 



--
-- Table structure for table "event"
--

DROP TABLE IF EXISTS event;
CREATE TABLE event (
  event_id int(11) NOT NULL AUTO_INCREMENT,
  username varchar(30) NOT NULL,
  title varchar(30) NOT NULL,
  start_point varchar(30) NOT NULL,
  end_point varchar(30) NOT NULL,
  event_datetime TIMESTAMP NOT NULL,
  event_desc varchar(100) NOT NULL,
  capacity int(11) NOT NULL,
  CONSTRAINT event_pk PRIMARY KEY (event_id),
  CONSTRAINT event_fk FOREIGN KEY (username) references user(username)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8; 

--
-- Table structure for table "participants"
--

DROP TABLE IF EXISTS participants;
CREATE TABLE participants (
  event_id int(11) NOT NULL,
  username varchar(30) NOT NULL,
  CONSTRAINT capacity_pk PRIMARY KEY (event_id, username),
  CONSTRAINT capacity_fk1 FOREIGN KEY (event_id) references event(event_id),
  CONSTRAINT capacity_fk2 FOREIGN KEY (username) references user(username)
) ENGINE=InnoDB DEFAULT CHARSET=utf8; 


--
-- Table structure for table 'comment'
--

DROP TABLE IF EXISTS comment;
CREATE TABLE IF NOT EXISTS comment (
  comment_id int(11) NOT NULL AUTO_INCREMENT,
  event_id int(11) NOT NULL,
  username varchar(30) NOT NULL,
  content varchar(100) NOT NULL,
  created_datetime timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT comment_pk PRIMARY KEY (comment_id),
  CONSTRAINT comment_fk1 FOREIGN KEY (event_id) references event(event_id),
  CONSTRAINT comment_fk2 FOREIGN KEY (username) references user(username)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8; 