-- Запросы к БД для получения следующих данных для последних 50 посетителей:
-- 1) идентификаторы посетителей
-- 2) дата первого открытия фото
-- 3) дата последнего открытия фото
-- 5) сколько всего фото было открыто посетителем
SELECT
    user_id,
    MIN(created_at) AS first_open,
    MAX(created_at) AS last_open,
    COUNT(image_id) AS total_open
FROM image_views
GROUP BY user_id
ORDER BY ANY_VALUE(created_at) DESC
LIMIT 3

-- 4) какое фото сколько раз было открыто посетителем
SELECT
    image_views.user_id,
    image_views.image_id,
    COUNT(image_views.image_id)
FROM image_views
INNER JOIN (
    SELECT DISTINCT user_id
        FROM image_views
        ORDER BY ANY_VALUE(created_at) DESC
        LIMIT 3
) AS users ON users.user_id = image_views.user_id
GROUP BY user_id, image_id


-- Запросы с сортировкой по полям:
-- 1) дата первого открытия
SELECT *
FROM (
    SELECT
        user_id,
        MIN(created_at) AS first_open,
        MAX(created_at) AS last_open,
        COUNT(image_id) AS total_open
    FROM image_views
    GROUP BY user_id
    ORDER BY ANY_VALUE(created_at) DESC
    LIMIT 3
) AS tmp
ORDER BY first_open DESC

-- 2) дата последнего открытия
SELECT *
FROM (
    SELECT
        user_id,
        MIN(created_at) AS first_open,
        MAX(created_at) AS last_open,
        COUNT(image_id) AS total_open
    FROM image_views
    GROUP BY user_id
    ORDER BY ANY_VALUE(created_at) DESC
    LIMIT 3
) AS tmp
ORDER BY last_open DESC

-- 3) открыто всего
SELECT *
FROM (
    SELECT
        user_id,
        MIN(created_at) AS first_open,
        MAX(created_at) AS last_open,
        COUNT(image_id) AS total_open
    FROM image_views
    GROUP BY user_id
    ORDER BY ANY_VALUE(created_at) DESC
    LIMIT 3
) AS tmp
ORDER BY total_open DESC
