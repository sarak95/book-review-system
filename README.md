# Book Review System - REST API

This is a REST API for managing books, authors, and tags, built with Laravel and secured using Laravel Sanctum.

## Project Setup

Follow these steps to set up the project locally.

## Installation

1. Clone the repository:

```sh
git clone https://github.com/your-username/book-review-system.git
cd book-review-system
```

2. Install PHP dependencies:

```sh
composer install
```

3. Copy the environment file:

```sh
cp .env.example .env
```

4. Generate APP_KEY:

```sh
php artisan key:generate
```

5. Configure the database in `.env` file:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=book_review_db
DB_USERNAME=root
DB_PASSWORD=
```

6. Run database migrations and seed sample data:

```sh
php artisan migrate --seed
```

7. Install Laravel Sanctum:

```sh
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
php artisan migrate
```

8. Start the development server:

```sh
php artisan serve
```

## Authentication (Laravel Sanctum)

All protected routes require Bearer Token Authentication.

### Login

**Endpoint:** `POST /api/login`  
**Body:**

```json
{
    "email": "user@example.com",
    "password": "password"
}
```

**Response:**

```json
{
    "message": "Login successful",
    "token": "your-generated-token",
    "role": "admin"
}
```

After logging in, use the token in the Authorization header for all protected requests:

```
Authorization: Bearer your-generated-token
```

### Logout

**Endpoint:** `POST /api/logout`  
**Authorization:** Bearer Token  

**Response:**

```json
{
    "message": "Logged out"
}
```

## API Documentation

### Authors API

#### Get all authors

**Endpoint:** `GET /api/authors`

**Response:**

```json
[
    {
        "id": 1,
        "name": "John Doe"
    }
]
```

#### Get a single author

**Endpoint:** `GET /api/authors/{id}`

**Response:**

```json
{
    "id": 1,
    "name": "John Doe"
}
```

#### Update an author

**Endpoint:** `PUT /api/authors/{id}`  
**Authorization:** Bearer Token  

**Request Body:**

```json
{
    "name": "Updated Author Name"
}
```

**Response:**

```json
{
    "id": 1,
    "name": "Updated Author Name"
}
```

#### Delete an author

**Endpoint:** `DELETE /api/authors/{id}`  
**Authorization:** Bearer Token  

**Response:**

```json
{
    "message": "Author deleted successfully"
}
```

### Books API

#### Get all books

**Endpoint:** `GET /api/books`

**Response:**

```json
[
    {
        "id": 7,
        "title": "Example Book",
        "publication_year": "2023",
        "author": {
            "id": 2,
            "name": "John Doe"
        },
        "tags": [],
        "created_at": "2025-02-22 17:11:28"
    }
]
```

#### Get a single book

**Endpoint:** `GET /api/books/{id}`

**Response:**

```json
{
    "id": 7,
    "title": "Example Book",
    "publication_year": "2023",
    "author": {
        "id": 2,
        "name": "John Doe"
    },
    "tags": [],
    "created_at": "2025-02-22 17:11:28"
}
```

#### Create a new book

**Endpoint:** `POST /api/books`  
**Authorization:** Bearer Token  

**Request Body:**

```json
{
    "title": "Example Book",
    "publication_year": 2023,
    "description": "A book description",
    "author_id": 1
}
```

**Response:**

```json
{
    "id": 8,
    "title": "Example Book",
    "publication_year": 2023,
    "author": {
        "id": 2,
        "name": "John Doe"
    },
    "tags": [],
    "created_at": "2025-02-23 08:17:15"
}
```

#### Update a book

**Endpoint:** `PUT /api/books/{id}`  
**Authorization:** Bearer Token  

**Request Body:**

```json
{
    "title": "Updated Book",
    "publication_year": 2023,
    "author_id": 1
}
```

**Response:**

```json
{
    "id": 7,
    "title": "Updated Book",
    "publication_year": 2023,
    "author": {
        "id": 1,
        "name": "John Doe"
    },
    "tags": [],
    "created_at": "2025-02-22 17:11:28"
}
```

#### Delete a book

**Endpoint:** `DELETE /api/books/{id}`  
**Authorization:** Bearer Token  

**Response:**

```json
{
    "message": "Book deleted successfully"
}
```

### Tags API

#### Get all tags

**Endpoint:** `GET /api/tags`

**Response:**

```json
[
    {
        "id": 1,
        "name": "Fiction",
    }
]
```

#### Attach a tag to a book

**Endpoint:** `POST /api/books/{book_id}/tags`  
**Authorization:** Bearer Token  

**Request Body:**

```json
{
    "tags": [1, 2]
}
```

**Response:**

```json
{
    "message": "Tags attached successfully"
}
```

#### Detach a tag from a book

**Endpoint:** `DELETE /api/books/{book_id}/tags/{tag_id}`  
**Authorization:** Bearer Token  

**Response:**

```json
{
    "message": "Tag detached successfully"
}
```

## Middleware & Role-Based Access

- Sanctum Authentication (`auth:sanctum`) is required for most routes.
- Admin Middleware (`admin`) is required for managing books, authors, and tags.
- Only admin users can create, update, or delete books, authors, and tags.

## Technologies Used

- PHP 8.x
- Laravel 10.x
- MySQL
- Laravel Sanctum (API authentication)
- Eloquent ORM

