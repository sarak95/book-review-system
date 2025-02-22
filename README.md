# Book Review System - REST API

This is a REST API for managing books, authors, and tags, built with Laravel and secured using Laravel Sanctum.

## Project Setup

Follow these steps to set up the project locally.

## Installation

1. Clone the repository:

git clone https://github.com/your-username/book-review-system.git
cd book-review-system

2. Install PHP dependencies:

composer install

3. Copy the environment file:

cp .env.example .env

4. Generate APP_KEY:

php artisan key:generate

5. Configure the database in .env file:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=book_review_db
DB_USERNAME=root
DB_PASSWORD=

6. Run database migrations and seed sample data:

php artisan migrate --seed

7. Install Laravel Sanctum:

php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
php artisan migrate

8. Start the development server:

php artisan serve

## Authentication (Laravel Sanctum)

All protected routes require Bearer Token Authentication.

- Login

Endpoint: POST /api/login Body:

{
    "email": "user@example.com",
    "password": "password"
}

Response:

{
    "message": "Login successful",
    "token": "your-generated-token",
    "role" : "admin"
}

After logging in, use the token in the Authorization header for all protected requests:

Authorization: Bearer your-generated-token

- Logout

Endpoint: POST /api/logout: Bearer TokenResponse:

{
    "message": "Logged out"
}

## API Documentation

### Authors API 

 - Get all authors 

Endpoint: GET /api/authors Response:

[
    {
        "id": 1,
        "name": "John Doe",
        "created_at": "2025-02-22T09:00:20.000000Z",
        "updated_at": "2025-02-22T09:00:20.000000Z"
    },
]

- Get a single author

Endpoint: GET /api/authors/{id} Response: 

{
    "id": 1,
    "name": "John Doe",
    "created_at": "2025-02-22T09:00:20.000000Z",
    "updated_at": "2025-02-22T09:00:20.000000Z"
}

- Update author: 

Endpoint: PUT /api/authors/{id}  Authorization: Bearer TokenRequest Body:

{
  "name": "Updated Author Name",
}

Response: 

{
    "id": 1,
    "name": "Updated Author Name",
    "created_at": "2025-02-22T09:00:20.000000Z",
    "updated_at": "2025-02-22T16:53:52.000000Z"
}

- Delete author:

Endpoint: DELETE /api/authors/{id} Authorization: Bearer TokenResponse:

{
    "message": "Author deleted successfully"
}


### Books API

- Get all books

Endpoint: GET /api/books Response:

[
    {
        "id": 1,
        "title": "Book Title",
        "author": "Author Name"
    }
]

- Get a single book

Endpoint: GET /api/books/{id} Response:

    {
        "id": 1,
        "title": "Example Book",
        "publication_year": "2023",
        "description": "A book description",
        "author_id": 1,
        "created_at": "2025-02-22T09:01:32.000000Z",
        "updated_at": "2025-02-22T09:01:32.000000Z"
    },


- Create a new book

Endpoint: POST /api/books Authorization: Bearer TokenRequest Body:

{
    "title": "Example Book",
    "publication_year": 2023,
    "description": "A book description",
    "author_id": 1  
}

Response:

{
   "title": "Example Book",
    "publication_year": 2023,
    "description": "A book description",
    "author_id": 1,
    "updated_at": "2025-02-22T16:07:50.000000Z",
    "created_at": "2025-02-22T16:07:50.000000Z",
    "id": 3
}

- Update a book

Endpoint: PUT /api/books/{id} Authorization: Bearer TokenRequest Body:

{
  "title": "Updated Book",
  "publication_year": 2023,
  "author_id": 1 
}

Response:

{
    "id": 1,
    "title": "Updated Book",
    "publication_year": 2023,
    "description": "A book description",
    "author_id": 1,
    "created_at": "2025-02-22T09:01:32.000000Z",
    "updated_at": "2025-02-22T16:15:45.000000Z"
}

- Delete a book

Endpoint: DELETE /api/books/{id} Authorization: Bearer TokenResponse:

{
    "message": "Book deleted successfully"
}

### Tags API

- Get all tags

Endpoint: GET /api/tags Response:

[
   {
        "id": 1,
        "name": "Fiction",
        "created_at": "2025-02-22T09:02:47.000000Z",
        "updated_at": "2025-02-22T09:02:47.000000Z"
    }
]

- Attach a tag to a book

Endpoint: POST /api/books/{book_id}/tags Authorization: Bearer TokenRequest Body:

{
    "tags": [1, 2]
}

Response:

{
    "message": "Tags attached successfully"
}

- Detach a tag from a book

Endpoint: DELETE /api/books/{book_id}/tags/{tag_id} Authorization: Bearer TokenResponse:

{
    "message": "Tag detached successfully"
}

## Middleware & Role-Based Access

Sanctum Authentication (auth:sanctum) is required for most routes.

Admin Middleware (admin) is required for managing books, authors, and tags.

Only admin users can create, update, or delete books, authors, and tags.

## Technologies Used

PHP 8.x

Laravel 10.x

MySQL

Laravel Sanctum (API authentication)

Eloquent ORM
