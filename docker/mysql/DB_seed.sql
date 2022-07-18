USE `application`;

#
# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users`
(
    `id`         int unsigned NOT NULL AUTO_INCREMENT,
    `password`   varchar(32)  NOT NULL,
    `full_name`  varchar(32)           DEFAULT '',
    `email`      varchar(32)  NOT NULL,
    `created_at` datetime     NOT NULL DEFAULT (CURRENT_TIME),
    `updated_at` datetime     NOT NULL DEFAULT (CURRENT_TIME),
    PRIMARY KEY (`id`),
    UNIQUE KEY `email` (`email`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

LOCK TABLES `users` WRITE;

INSERT INTO `users` (`id`, `password`, `full_name`, `email`)
VALUES (1, 'DvJUanOjiZ1akdMRHvSPnCs57WT3EkbJ', 'Test Admin', 'admin@test.com'),
       (2, 'DvJUanOjiZ1akdMRHvSPnCs57WT3EkbJ', 'Test Manager', 'manager@test.com'),
       (3, 'DvJUanOjiZ1akdMRHvSPnCs57WT3EkbJ', 'Test Customer', 'customer@test.com');

UNLOCK TABLES;

#
# Dump of table groups
# ------------------------------------------------------------

DROP TABLE IF EXISTS `groups`;

create table `groups`
(
    id   int,
    name varchar(50) not null
);

create unique index groups_id_uindex
    on `groups` (id);

create unique index groups_name_uindex
    on `groups` (name);

alter table `groups`
    add constraint groups_pk
        primary key (id);

alter table `groups`
    modify id int auto_increment;

LOCK TABLES `groups` WRITE;

INSERT INTO `groups` (`id`, `name`)
VALUES (1, 'Administrator'), (2, 'Manager'), (3, 'Customer');

UNLOCK TABLES;

#
# Dump of table users2groups
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users2groups`;

create table `users2groups`
(
    id       int auto_increment
        primary key,
    user_id  int not null,
    group_id int not null,
    constraint users2groups_id_uindex
        unique (id)
);

LOCK TABLES `users2groups` WRITE;

INSERT INTO `users2groups` (id, user_id, group_id)
VALUES (1, 1, 1), (2, 2, 2), (3, 3, 3);

UNLOCK TABLES;


#
# Dump of table groups_permissions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `groups_permissions`;

create table `groups_permissions`
(
    id         int auto_increment
        primary key,
    group_id   int         not null,
    permission varchar(10) not null,
    constraint groups_permissions_id_uindex
        unique (id)
);

LOCK TABLES `groups_permissions` WRITE;

INSERT INTO `groups_permissions` (id, group_id, permission)
VALUES (1, 1, 'show'),(2, 1, 'create'),(3, 1, 'update'),(4, 1, 'delete'),
       (5, 2, 'show'),(6, 2, 'create'),(7, 2, 'update'),
       (8, 3, 'show');

UNLOCK TABLES;
