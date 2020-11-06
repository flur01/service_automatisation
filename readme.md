# Deploy project:

- Open project folder

- Ceate dependency:

    ```
    npm i
    composer i
    ```

- Generate key:

    ```
    php artisan key:generate
    ```

- Rename **_.env.example_** -> **_.env.example_** 

- Edit  **_.env.example_** file:

    **DB_CONNECTION=_db tpype_**
    
    **DB_HOST=_ip_**
    
    **DB_PORT=_port_**
    
    **DB_DATABASE=_db name_**
    
    **DB_USERNAME=__username__**
    
    **DB_PASSWORD=_password_**
    
- Run migration:

    ```
    php artisan migrete
    ```
    
- Compil Sass and Vue files:

    ```
    npm run dev
    ```
    
- Start server:

    ```
    php artisan serve
    ```

# Data for test:

**/test_data.xlsx**