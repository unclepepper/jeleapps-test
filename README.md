## JeLeApps


### Что бы запустить приложение, необходимо выполнить команды:


``` make init ``` Для сборки, настройки и запуска контейнеров для приложения

``` make test``` Для запуска автотестов приложения

# User API Documentation
📌 **Описание:** API для регистрации и получения профиля пользователя.  
📌 **Формат данных:** `JSON`  
📌 **Базовый URL:** `http://localhost/api`

## 🔹 Регистрация пользователя
**Метод:** `POST`  
**URL:** `/api/registration`

**Тело запроса (JSON):**
```json
{
  "email": "user@test.ru",
  "password": "password",
  "gender": "male"
}
```
**Заголовки:**

```Content-Type: application/json```

**Ответы API:**

**✅ 201 Created**

```json
{
  "message": "User registered",
  "user": {
    "email": "user@test.ru",
    "gender": "male",
    "updated_at": "2025-05-14T09:02:44.000000Z",
    "created_at": "2025-05-14T09:02:44.000000Z",
    "id": 3
  }
}
```
**❌ 422 Unprocessable Entity (ошибка валидации)**

```json
{
  "error": "Invalid input",
  "messages": {
  "email": ["The email field is required."],
  "password": ["The password must be at least 6 characters."],
  "gender": ["The gender field is required."]
  }
}
```

**❌ 500 Server Error (непредвиденная ошибка)**

```json
{
  "error": "Server error",
  "message": "Unexpected error occurred"
}
```
## 🔹 2. Получение профиля пользователя
**Метод: GET**

**URL:** /api/profile

**Параметры запроса (Query):**

`email=test@test.ru`

**Примеры запросов:**

`GET /api/profile?email=test@test.ru`

**Ответы API:**

**✅ 200 OK**

```json
{
  "id": 2,
  "email": "test@test.ru",
  "gender": "male",
  "created_at": "2025-05-14T08:40:59.000000Z",
  "updated_at": "2025-05-14T08:40:59.000000Z"
}
```
**❌ 404 Not Found (пользователь не найден)**

```json
{
  "error": "User not found"
}
```

