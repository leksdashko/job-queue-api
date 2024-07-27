# Laravel job queue API 

## Introduction
This project is a Laravel-based API that accepts a POST request to the `/submit` endpoint with a JSON payload, validates the data, processes it using a job queue, saves it to a database, and triggers an event after saving.

## Setup Instructions

### Prerequisites
- PHP >= 8.0
- Composer
- MySQL or another database system

### Installation
1. **Clone the repository:**
    ```bash
    git clone https://github.com/leksdashko/job-queue-api.git
    cd job-queue-api
    ```

2. **Install dependencies:**
    ```bash
    composer install
    ```

3. **Set up environment variables:**
    - Update the `.env` file with your database credentials:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=db_name
    DB_USERNAME=db_username
    DB_PASSWORD=db_password
    ```

### Running Migrations
1. **Run the migrations to create the necessary database tables:**
    ```bash
    php artisan migrate
    ```

2. **Set up the database for job queues:**
    ```bash
    php artisan queue:table
    php artisan migrate
    ```

### Running the Queue Worker
		To process the queued jobs, you need to run the queue worker:
		```bash
		php artisan queue:work
		```

## Testing the API Endpoint

### Using Postman
1. **Open Postman.**
2. **Set the request type to `POST`.**
3. **Set the URL to:**
    ```
    http://laravel-app.test/api/submit
    ```
4. **In the Body tab, select `raw` and `JSON`, then provide the JSON payload:**
    ```json
    {
        "name": "John Doe",
        "email": "john.doe@example.com",
        "message": "This is a test message."
    }
    ```

### Expected Responses
- **Success (200):**
    ```json
    {
        "success": true,
        "message": "Data validated and job dispatched successfully!"
    }
    ```
- **Validation Error (400):**
    ```json
    {
        "success": false,
        "errors": {
            "name": ["The name field is required."],
            "email": ["The email field is required."],
            "message": ["The message field is required."]
        }
    }
    ```
- **Job Dispatch Error (500):**
    ```json
    {
        "success": false,
        "message": "Failed to dispatch job. Please try again later."
    }
    ```

### Running Tests
- **Run the tests:**
    ```bash
    php artisan test
    ```
