BEGIN;
INSERT INTO athlete (name, date_of_birth, sex,email,nationality)
VALUES('Mohamed Konate','2002/05/01','M','mkona05@gmail.com','France'),
('Kamagate Abdoul-Aziz','2001/10/16','M','kam056@gmail.com','Canada'),
('Loic Ky','2000/09/14','M','kyloic@gmail.com','Burkina Faso'),
('Molly Kanyatsi','2001/09/16','F','mkany@gmail.com','Ivory Coast'),
('Yoanna Jones', '2001/02/09','F','joyoanna@gmail.com', 'France'),
('Isabela Christine','2001/11/18','M','isachr07@gmail.com','USA'),
('Andrew Magie','1995/09/14','M','andremag@gmail.com','USA'),
('Rose Monde','1996/09/16','F','rosemo@gmail.com','Canada'),
('Dao Fatoumata', '1997/02/09','F','daofatou@gmail.com', 'Ivory Coast'),
('Ouattara Aziz','2001/12/16','M','ouattaziz@gmail.com','Ivory Coast'),
('Henock Francis','2000/04/14','M','henfrancis@gmail.com','Congo'),
('Perle Yao','2001/05/01','F','pyaoyao@gmail.com','Congo'),
('Wang Lee', '2001/06/06','F','wangleen@gmail.com', 'China'),
('Ahmed Bakayoko','2000/10/16','M','bakamd@gmail.com','Ivory Coast'),
('Wilfried Sankara','1990/09/14','M','wilfsank@gmail.com','Burkina Faso'),
('Emmanuel Kouassi','1991/09/16','F','emmkouass@gmail.com','Ivory Coast'),
('Yapo Ange', '1993/02/09','F','yapang@gmail.com', 'France'),
('Emma Belle','2000/10/31','M','emmbelle@gmail.com','France'),
('Sery Dorcas','2000/09/15','M','dorcassery@gmail.com','France'),
('Jean Kouassi','2000/09/17','F','jeankouass@gmail.com','Ivory Coast'),
('Lisanna Lin', '2000/02/02','F','lisaliss@gmail.com', 'USA'),
('Jeanne Domi','1965/02/25','F','jeanne@gmail.com','France'),
('Eleanore Hellis','2000/06/14','F','helleanne@gmail.com','USA'),
('Jemima Antick','2001/05/23','F','jems@gmail.com','Congo'),
('Sung Park', '2001/06/26','F','sungpark@gmail.com', 'Corea'),
('Sarah Bakayoko','2002/10/16','F','baksarah@gmail.com','Congo'),
('Williane Ezy','1992/09/14','F','wilfezy@gmail.com','Burkina Faso'),
('Emmanuella Konate','1993/09/16','F','emmakona@gmail.com','Ivory Coast'),
('Yapo Angele', '1995/02/09','F','yapangele@gmail.com', 'Canada'),
('Jeanne Domiane','1965/02/20','F','jeanne05@gmail.com','Canada'),
('Helleanore Helliotte','2001/06/14','F','helliot@gmail.com','USA'),
('Jean Antick','2001/05/23','M','jeams@gmail.com','Congo'),
('Young Park', '1999/06/26','M','youngpark@gmail.com', 'Corea'),
('Christian Yoko','2002/10/16','M','chriyo@gmail.com','Canada'),
('Chris Youho','1992/09/24','M','youchrs@gmail.com','Burkina Faso'),
('Emmanuel Kanate','1993/09/30','M','emkana@gmail.com','Canada'),
('Yapi Paulin', '1995/02/09','M','yapaul@gmail.com', 'France'),
('Jean Lou','1992/09/14','M','jlou@gmail.com','France'),
('Kante Kylian','2001/09/16','M','kylliankante@gmail.com','France'),
('Yapo Kenny', '2001/02/09','M','yapkenny@gmail.com', 'Canada'),
('Jean Francois','1995/06/28','M','jfran@gmail.com','France'),
('Shein Frank','1995/06/28','M','shfrank05@gmail.com','Canada');

INSERT INTO partners (company_name, address, city, representative,email,phone_number)
VALUES('Plateau Inc.','252 Road Left','Toronto', 'Malick Jounia','malickjoun056@plateau.ca',8133550456),
('Agartha SARL','356 Road Main','Ottawa', 'Bertrand Asher','berasher@gmail.ca',6133550469),
('Limuse Inc.','406 Road North','Gatineau', 'Manotti Christian','manochris@gmail.ca',6133547484),
('Mionsta SARL.','256 Road West','Ottawa', 'Bernard Francis','bernfran@gmail.ca',6133650436),
('Apple Inc.','556 Road California','California', 'Steve Jobs','stevjobs5@gmail.ca',8653355046);

INSERT INTO competitions(partner_id, name,venue,compet_year ,start_date , end_date, start_time,max_athlete,number_events,representative,email,phone_number)
VALUES
(1,'Joyfest','Arena Joshau',2021,'2021/02/10','2021/02/14' ,'13:30',10,2,'Galilé Jonia','galijon086@plateau.ca',8133550456),
(2,'Montreal Tour', 'Trudeau Stadium',2020 ,'2021/05/15','2021/05/20' ,'14:00',15,3,'Wes Gibbins','wegibb@gmail.ca',6134550469),
(2,'Ottawa Fest','uOttawa',1025 , '2021/04/03', '2021/04/06','9:00',20,5,'Laurel Castillo','laurcastillo@gmail.ca',6144550469),
(3,'Toronto Fest','Martin Square', 2019,'2021/03/01', '2021/03/03','16:00',20,2,'Annalise Keating', 'annakeat@gmail.com',6144557469),
(5,'California Fit','Calif Square',2021,'2021/04/15', '2021/04/20','16:00',20,5,'frank Delfino', 'frankdelf@gmail.com',8144567469),
(1,'Solar Fest','Solary Beach',2021,'2021-03-28','2021-03-29','11:00',10,2,'James Franco','jamesfr@gmail.com',8733550472);

INSERT INTO register(athlete_id,competition_id,gender)
VALUES(1,1,'M'),
(1,6,'M'),
(2,1,'M'),
(3,1,'M'),
(4,1,'F'),
(5,1,'F'),
(32,2,'M'),
(33,2,'M'),
(34,2,'M'),
(35,2,'M'),
(36,2,'M'),
(37,2,'M'),
(38,2,'M'),
(39,2,'M'),
(20,2,'F'),
(21,2,'F'),
(22,2,'F'),
(23,2,'F'),
(24,2,'F'),
(25,2,'F'),
(26,2,'F'),
(27,2,'F'),
(6,1,'M'),
(7,1,'M'),
(10,1,'M'),
(11,1,'M'),
(14,1,'M'),
(15,1,'M'),
(41,1,'M'),
(41,6,'M'),
(42,6,'M');

INSERT INTO events (name,competition_id, event_date, primary_score,time_cap,time_cap_tb)
VALUES('500 burpees in 15mn',1,'2021/02/10','Time ASC','Count DESC','Time ASC'),
('maximum weight moved',1,'2021/02/14','Count DESC',null,null),
('20.1',2,'2021/05/15','Time ASC','Count DESC','Time ASC'),
('20.2',2,'2021/05/16','Count ASC',null,null),
('20.3',2,'2021/05/20','Time ASC','Count DESC','Time ASC');

INSERT INTO scores(event_id,athlete_id,number_reps,finish_time,best_set_time)
VALUES(1,1,500,'14:45','10:47'),
(1,2,500,'14:00','12:47'),
(1,3,300,'15:00','10:47'),
(1,4,245,'15:00','11:47'),
(1,5,315,'15:00','14:47'),
(1,6,500,'14:47','10:40'),
(1,7,500,'14:48','9:45'),
(1,10,500,'13:53','9:45'),
(1,11,500,'13:53','9:45'),
(1,14,500,'15:08','10:45'),
(1,15,500,'15:08','10:45'),
(1,41,500,'13:48','10:45'),
(2,1,452,null,null),
(2,2,545,null,null),
(2,3,452,null,null),
(2,4,245,null,null),
(2,5,245,null,null),
(2,6,235,null,null),
(2,7,254,null,null),
(2,10,568,null,null),
(2,11,455,null,null),
(2,14,463,null,null),
(2,15,350,null,null),
(2,41,505,null,null),

(3,32,400,'11:00','9:00'),
(3,33,350,'13:00','10:00'),
(3,34,360,'13:45','10:00'),
(3,35,370,'13:10','10:00'),
(3,36,375,'12:50','10:00'),
(3,37,300,'12:55','10:00'),
(3,38,340,'12:47','10:00'),
(3,39,330,'11:50','10:00'),
(3,20,400,'11:00','9:00'),
(3,21,320,'11:45','10:00'),
(3,22,380,'10:56','10:00'),
(3,23,280,'18:00','10:00'),
(3,24,400,'17:00','10:00'),
(3,25,400,'16:50','10:00'),
(3,26,400,'16:20','10:00'),
(3,27,400,'13:12','10:00'),
(4,32,406,null,null),
(4,33,356,null,null),
(4,34,366,null,null),
(4,35,376,null,null),
(4,36,376,null,null),
(4,37,306,null,null),
(4,38,346,null,null),
(4,39,336,null,null),
(4,20,200,null,null),
(4,21,326,null,null),
(4,22,386,null,null),
(4,23,286,null,null),
(4,24,406,null,null),
(4,25,406,null,null),
(4,26,406,null,null),
(4,27,406,null,null),
(5,32,400,'11:00','9:00'),
(5,33,400,'13:00','10:00'),
(5,34,400,'13:45','10:00'),
(5,35,400,'13:10','10:00'),
(5,36,400,'12:50','10:00'),
(5,37,400,'12:55','10:00'),
(5,38,400,'12:47','10:00'),
(5,39,400,'11:50','10:00'),
(5,20,400,'11:00','9:00'),
(5,21,400,'11:45','10:00'),
(5,22,400,'10:56','10:00'),
(5,23,280,'18:00','10:00'),
(5,24,300,'17:00','10:00'),
(5,25,200,'16:50','10:00'),
(5,26,300,'16:20','10:00'),
(5,27,350,'13:12','10:00');
COMMIT;