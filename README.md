# Task Project

Here is the demo project for posts using this repo, we can create, read, update and delele posts .

## Features

- Create Post
- Read Post
- Update Post
- Delete Post

## Installation



```bash
  composer update
  php artisan migrate (Generate for migration tables)
  php artisan db:seed --class=PostSeeder (Generate for sample data)
```

## API Reference

#### Get all items



| Http Methos | Endpoint | Description | Request Body|
| :-------- | :------- | :------------------------- | :------------------------- |
| **GET** | `/posts` | Fetch all posts | `None` |
| **POST** | `/posts` | Create a new post | { "title": "My Post", "priority": "high", "medium", "low", due_date: "2024-12-26" } |
| **GET** | `/posts/{postId}` | Fetch a single post | `None` |
| **PATCH** | `/posts/{postId}` | Update an existing post | { "title": "My Post", "priority": "high", "medium", "low", due_date: "2024-12-26" } |
| **DELETE** | `/posts/{postId}` | Delete a specific post | `None` |
