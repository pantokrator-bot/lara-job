# Project Setup and API Testing

## Setup Instructions

1. **Clone the repository:**
   ```sh
   git clone https://github.com/pantokrator-bot/lara-job.git
   ```
   ```sh
    cd lara-job
    ```
2. **Install dependencies:** 
   ```sh
   composer install
   ```
   ```sh
   npm install
   ```
3. **Create a copy of the `.env` file:**
   ```sh
    cp .env.example .env
    ```
4. **Generate an app encryption key:** 
   ```sh
   php artisan key:generate
    ```
5. **Configure the database:** 
   - Open the `.env` file and set the database credentials
6. **Run the database migrations:** 
   ```sh
   php artisan migrate
    ```
7. **Start the local development server:** 
   ```sh
   php artisan serve
    ```
8. **Start the quque worker:** 
   ```sh
   php artisan queue:work
    ```
## API Testing
1. **Submit Data via API:** 
   - Open Postman and submit a POST request to `http://localhost:8000/api/submit` with the following JSON payload:
   ```json
   {
       "name": "John Doe",
       "email": "john.doe@example.com",
       "message": "This is a test message."
   }
   ```
   Example using cURL:
   ```sh
   curl -X POST http://localhost:8000/api/submit \ 
   -H "Content-Type: application/json" \
   -d '{"name": "John Doe", "email": "john@example.com", "message": "Hello!"}'
    ```
2. **Check the Response:**
   - If the request is successful, you should receive a JSON response similar to the following:
   ```json
   {
       "message": "Data submitted successfully."
   }
   ```
3. **Chech the Logs:**
   - Open the `storage/logs/laravel.log` file to check the log entries.
4. **Check the Database:**
   - Open the database and check the `submissions` table to verify that the data has been saved.
