
# API для мастер-класса от Института перспективных технологий

## Описание проекта

**Привет всем!** 
Это REST API для интернет-магазина комиксов, разработанное в рамках дня открытых дверей ИПТИП. API предоставляет интерфейсы для работы с данными о комиксах: создание, получение, обновление и удаление записей.

## Технологии

Проект создан на основе следующих технологий:

- **PHP 7.3+** — основной язык программирования.
- **PDO** — для работы с базой данных MySQL.
- **Swagger/OpenAPI** — для документирования и тестирования API.
- **Composer** — для управления зависимостями.
- **JWT (JSON Web Token)** — для аутентификации (если включено). Для особо пытливых умом 😃
- **MySQL** — для хранения данных о комиксах.

## Структура проекта

- `public/` — содержит точку входа `index.php` и файлы Swagger документации.
- `src/` — содержит все классы и модули проекта:
  - `Config/` — конфигурационные файлы, включая подключение к базе данных.
  - `Controller/` — классы контроллеров для обработки запросов API.
  - `Service/` — бизнес-логика и взаимодействие с базой данных.
  - `Model/` — модели данных (например, для комиксов).
- `vendor/` — директория для установленных через Composer зависимостей.

## Установка

1. Склонируйте репозиторий:
    ```bash
    git clone https://github.com/stasnorman/Open-Door-Backend.git
    ```

2. Перейдите в директорию проекта:
    ```bash
    cd Open-Door-Backend
    ```

3. Установите зависимости с помощью Composer:
    ```bash
    composer install
    ```

4. Настройте файл `.env` или `config.php` для подключения к базе данных MySQL:
    ```php
    // Пример файла конфигурации базы данных
    $host = 'localhost';
    $db_name = 'open_door';
    $username = 'root';
    $password = '';
    ```

5. Импортируйте SQL-файл для создания базы данных и таблиц:
    ```bash
    mysql -u root -p open_door < database/schema.sql
    ```

6. Запустите сервер:
    ```bash
    php -S localhost:8000 -t public
    ```

## Маршруты API

- `GET /comics` — Получить список всех комиксов.
- `GET /comics/{id}` — Получить информацию о комиксе по ID.
- `POST /comics` — Добавить новый комикс.
- `PUT /comics/{id}` — Полностью обновить комикс.
- `PATCH /comics/{id}` — Частично обновить комикс.
- `DELETE /comics/{id}` — Удалить комикс по ID.

### Пример запроса

**Получение всех комиксов:**

```bash
curl -X GET https://opendoor.easy4.team/public/comics
```

**Добавление нового комикса:**

```bash
curl -X POST https://opendoor.easy4.team/public/comics   -H "Content-Type: application/json"   -d '{
        "image_url": "https://example.com/image.jpg",
        "name": "Новый комикс",
        "price": 15.99,
        "description": "Описание комикса",
        "author_id": 1,
        "genre_id": 1,
        "published_date": "2024-01-01",
        "stock": 10
      }'
```

## Документация API

Документация API предоставлена с использованием Swagger UI. Вы можете получить доступ к документации по следующему URL:

- [Swagger UI](https://opendoor.easy4.team/public/swagger.html)

## Использование JWT (при необходимости)

Для работы с защищенными маршрутами вы можете использовать JSON Web Token (JWT). Пример получения токена:

```bash
curl -X POST https://opendoor.easy4.team/public/login   -H "Content-Type: application/json"   -d '{"username": "user", "password": "password"}'
```

После получения токена используйте его для доступа к защищенным маршрутам:

```bash
curl -X GET https://opendoor.easy4.team/public/comics   -H "Authorization: Bearer <ваш_токен>"
```

## Лицензия

Проект распространяется под лицензией MIT. Подробности можно найти в файле [LICENSE](./LICENSE).
