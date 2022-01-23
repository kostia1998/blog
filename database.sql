SET
SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET
time_zone = "+00:00";

CREATE TABLE `articles`
(
    `id`          int(11) NOT NULL,
    `author_id`   int(11) NOT NULL,
    `name`        varchar(255) NOT NULL,
    `description` varchar(255) NOT NULL,
    `text`        text         NOT NULL,
    `created_at`  datetime     NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `users`
(
    `id`            int(11) NOT NULL,
    `nickname`      varchar(128) NOT NULL,
    `email`         varchar(255) NOT NULL,
    `is_confirmed`  tinyint(1) NOT NULL DEFAULT '0',
    `role`          enum('admin','user') NOT NULL,
    `password_hash` varchar(255) NOT NULL,
    `auth_token`    varchar(255) NOT NULL,
    `created_at`    datetime     NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `users_activation_codes`
(
    `id`      int(11) NOT NULL,
    `user_id` int(11) NOT NULL,
    `code`    varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `nickname`, `email`, `is_confirmed`, `role`, `password_hash`, `auth_token`, `created_at`)
VALUES (1, 'admin', 'admin@gmail.com', 1, 'admin', 'hash1', 'token1', '2022-01-14 17:00:00'),
       (2, 'user', 'user@gmail.com', 1, 'user', 'hash2', 'token2', '2022-01-14 17:00:00');

INSERT INTO `articles` (`id`, `author_id`, `name`, `description`, `text`, `created_at`)
VALUES (1, 1, 'Walk', 'An article about how I walked', 'I was walking along the sidewalk when all of a sudden...', '2021-01-31 18:52:51'),
       (2, 1, 'My live', 'Post about life', 'I was sitting here in the kitchen with a friend and then he asked this question ...', '2021-01-31 18:52:51');

ALTER TABLE `users`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `nickname` (`nickname`),
    ADD UNIQUE KEY `email` (`email`);

ALTER TABLE `articles`
    ADD PRIMARY KEY (`id`);

ALTER TABLE `users_activation_codes`
    ADD PRIMARY KEY (`id`);

ALTER TABLE `articles`
    MODIFY `id` int (11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `users`
    MODIFY `id` int (11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `users_activation_codes`
    MODIFY `id` int (11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `articles`
    ADD FOREIGN KEY (`author_id`) REFERENCES users (id);

ALTER TABLE `users_activation_codes`
    ADD FOREIGN KEY (`user_id`) REFERENCES users (id);


