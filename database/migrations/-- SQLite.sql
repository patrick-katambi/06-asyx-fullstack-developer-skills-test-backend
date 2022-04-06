-- SQLite
-- proiority table
insert into priorities (name) values ('low');
insert into priorities (name) values ('moderate');
insert into priorities (name) values ('high');
insert into priorities (name) values ('asap');

-- impact table
insert into impact_levels (name) values ('low');
insert into impact_levels (name) values ('moderate');
insert into impact_levels (name) values ('high');
insert into impact_levels (name) values ('extreme');

-- states table
insert into ticket_states (name) values ('new');
insert into ticket_states (name) values ('in progress');
insert into ticket_states (name) values ('on hold');
insert into ticket_states (name) values ('resolved');
insert into ticket_states (name) values ('closed');
insert into ticket_states (name) values ('cancelled');

-- categories table
insert into ticket_categories (name) values ('hardware');
insert into ticket_categories (name) values ('software');
insert into ticket_categories (name) values ('database');
insert into ticket_categories (name) values ('network');
insert into ticket_categories (name) values ('helpdesk');

-- resolution codes table
insert into resolution_codes (name) values ('none');
insert into resolution_codes (name) values ('solved (workaround)');
insert into resolution_codes (name) values ('solved (permanently)');
insert into resolution_codes (name) values ('solved remotely (workaround)');
insert into resolution_codes (name) values ('solved remotely (permanently)');
insert into resolution_codes (name) values ('not solved (too costly)');
insert into resolution_codes (name) values ('closed (solved by caller)');

-- user groups table
insert into user_groups (name, description) VALUES ('Networking department', 'this is the Networking department');
insert into user_groups (name, description) VALUES ('Programming department', 'this is the Programming department');
insert into user_groups (name, description) VALUES ('Tech Support department', 'this is the Tech Support department');
insert into user_groups (name, description) VALUES ('Hardware and Troubleshooting department', 'this is the Hardware and Troubleshooting department');
insert into user_groups (name, description) VALUES ('Helpdesk department', 'this is the Helpdesk department');


-- users table
insert INTO users (name, email, user_group_id, password) VALUES ('Jamie Linn', 'jamie@gmail.com', 1, 'jamiejamie');
insert INTO users (name, email, user_group_id, password) VALUES ('Paul Linn', 'paul@gmail.com', 1, 'paulpaul');
insert INTO users (name, email, user_group_id, password) VALUES ('Jackson Linn', 'jack@gmail.com', 1, 'jackjack');
insert INTO users (name, email, user_group_id, password) VALUES ('Camalk Linn', 'camalky@gmail.com', 1, 'camalkcamalk');
insert INTO users (name, email, user_group_id, password) VALUES ('Weet Linn', 'Weet@gmail.com', 2, 'WeetWeet');
insert INTO users (name, email, user_group_id, password) VALUES ('Proffesor Mark', 'Proffesor@gmail.com', 2, 'ProffesorProffesor');
insert INTO users (name, email, user_group_id, password) VALUES ('Jackson Mark', 'mark@gmail.com', 2, 'jackjack');
insert INTO users (name, email, user_group_id, password) VALUES ('Camalk Robson', 'camalk@gmail.com', 2, 'camalkcamalk');
insert INTO users (name, email, user_group_id, password) VALUES ('Jonas Linn', 'Jonas@gmail.com', 3, 'JonasJonas');
insert INTO users (name, email, user_group_id, password) VALUES ('Ruffalo Mark', 'Ruffalo@gmail.com', 3, 'RuffaloRuffalo');
insert INTO users (name, email, user_group_id, password) VALUES ('Jackson Lamda', 'Lamda@gmail.com', 3, 'jackjack');
insert INTO users (name, email, user_group_id, password) VALUES ('Stero Robson', 'Stero@gmail.com', 3, 'SteroStero');
insert INTO users (name, email, user_group_id, password) VALUES ('Peaky Linn', 'Peaky@gmail.com', 4, 'PeakyJonas');
insert INTO users (name, email, user_group_id, password) VALUES ('Lionel Mark', 'Lionel@gmail.com', 4, 'LionelLionel');
insert INTO users (name, email, user_group_id, password) VALUES ('Jackson Edson', 'Edson@gmail.com', 4, 'jackjack');
insert INTO users (name, email, user_group_id, password) VALUES ('Christian Robson', 'Christian@gmail.com', 4, 'ChristianCrhistian');
insert INTO users (name, email, user_group_id, password) VALUES ('Riqui Linn', 'Riqui@gmail.com', 5, 'RiquiJonas');
insert INTO users (name, email, user_group_id, password) VALUES ('Bosquet Mark', 'Bosquet@gmail.com', 5, 'BosquetBosquet');
insert INTO users (name, email, user_group_id, password) VALUES ('Jackson Depay', 'Depay@gmail.com', 5, 'jackjack');
insert INTO users (name, email, user_group_id, password) VALUES ('Auba Robson', 'Auba@gmail.com', 5, 'AubaCrhistian');

-- tickets table
insert into tickets (id, caller, description, short_desc, created_by, due_date, assignment_group, assigned_to, category, impact, priority, state)
VALUES ('2022-01', 2, 'keyboard problem since monday', 'keyboard issue', 5, NULL, 4, 15, 1, 2, 3, 1);
insert into tickets (id, caller, description, short_desc, created_by, due_date, assignment_group, assigned_to, category, impact, priority, state)
VALUES ('2022-02', 3, 'printer problem since last week', 'printer issue', 6, NULL, 4, 14, 1, 3, 4, 2);
insert into tickets (id, caller, description, short_desc, created_by, due_date, assignment_group, assigned_to, category, impact, priority, state)
VALUES ('2022-03', 1, 'windows 11 doesnt install Witcher', 'Software issue', 9, NULL, 3, 10, 2, 1, 1, 1);
