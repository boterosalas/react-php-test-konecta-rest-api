-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `users`
--
CREATE TABLE `users` (
    `UserId` int(11) NOT NULL,
    `Name` varchar(45) DEFAULT NULL,
    `Email` varchar(45) DEFAULT NULL,
    `Password` varchar(45) DEFAULT NULL,
    `Cellphone` varchar(45) DEFAULT NULL,
    `Role` varchar(45) DEFAULT NULL,
    `IsActive` TINYINT DEFAULT NULL,
    `Created_date` datetime DEFAULT NULL,
    `Updated_date` datetime DEFAULT NULL
);

--
-- Volcado de datos para la tabla `users`
--
INSERT INTO
    `users` (
        `UserId`,
        `Name`,
        `Email`,
        `Password`,
        `Cellphone`,
        `Role`,
        `IsActive`,
        `Created_date`,
        `Updated_date`
    )
VALUES
    (
        1,
        'David',
        'boterosalas@gmail.com',
        '123456',
        '3148066315',
        'Admin',
        1,
        '2021-11-09 08:35:00',
        '2021-11-09 08:35:00'
    ) -- --------------------------------------------------------
    --
    -- Estructura de tabla para la tabla `categories`
    --
    CREATE TABLE `categories` (
        `CategoryId` int(11) NOT NULL,
        `Name` varchar(45) DEFAULT NULL,
        `IsActive` TINYINT DEFAULT NULL,
        `Created_date` datetime DEFAULT NULL,
        `Updated_date` datetime DEFAULT NULL
    );

--
-- Volcado de datos para la tabla `categories`
--
INSERT INTO
    `categories` (
        `CategoryId`,
        `Name`,
        `IsActive`,
        `Created_date`,
        `Updated_date`
    )
VALUES
    (
        1,
        'Naturaleza',
        1,
        '2021-11-09 08:35:00',
        '2021-11-09 08:35:00'
    ) -- --------------------------------------------------------
    --
    -- Estructura de tabla para la tabla `posts`
    --
    CREATE TABLE `posts` (
        `PostId` int(11) NOT NULL,
        `CategoryId` varchar(45) DEFAULT NULL,
        `UserId` varchar(45) DEFAULT NULL,
        `Title` varchar(45) DEFAULT NULL,
        `Slug` varchar(45) DEFAULT NULL,
        `ShortText` varchar(45) DEFAULT NULL,
        `LongText` varchar(45) DEFAULT NULL,
        `Image` varchar(45) DEFAULT NULL,
        `Likes` int(11) NOT NULL,
        `Dislikes` int(11) NOT NULL,
        `IsActive` TINYINT DEFAULT NULL,
        `Created_date` datetime DEFAULT NULL,
        `Updated_date` datetime DEFAULT NULL
    );

--
-- Volcado de datos para la tabla `posts`
--
INSERT INTO
    `posts` (
        'PostId',
        'CategoryId',
        'UserId',
        'Title',
        'Slug',
        'ShortText',
        'LongText',
        'Image',
        'Likes',
        'Dislikes',
        `IsActive`,
        'Created_date',
        'Updated_date'
    )
VALUES
    (
        1,
        1,
        1,
        'My first post',
        'my-first-post',
        'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
        "Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.",
        'Image',
        23,
        0,
        1,
        '2021-11-09 08:35:00',
        '2021-11-09 08:35:00'
    ) -- --------------------------------------------------------
    --
    -- Estructura de tabla para la tabla `commentaries`
    --
    CREATE TABLE `commentaries` (
        `CommentaryId` int(11) NOT NULL,
        `Commentary` varchar(45) DEFAULT NULL,
        `UserId` varchar(45) DEFAULT NULL,
        `PostId` varchar(45) DEFAULT NULL,
        `IsActive` TINYINT DEFAULT NULL,
        `Created_date` datetime DEFAULT NULL,
        `Updated_date` datetime DEFAULT NULL
    );

--
-- Volcado de datos para la tabla `commentaries`
--
INSERT INTO
    `commentaries` (
        'CommentaryId',
        'Commentary',
        'UserId',
        'PostId',
        'IsActive',
        'Created_date',
        'Updated_date'
    )
VALUES
    (
        1,
        'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
        1,
        1,
        1,
        '2021-11-09 08:35:00',
        '2021-11-09 08:35:00'
    )