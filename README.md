# setting up
1. create the database:
    ```bash
    php artisan migrate
    ```

2. create dummy data:
    ```bash
    php artisan db:seed --class=DatabaseSeeder
    ```

3. create a personal access client:
    ```bash
    php artisan passport:client --personal
    ```
4. start server
    ```bash
    php artisan serve
    ```
5. run loging unit test
   ```bash
   php artisan test
   ```
# import api collections
you can download all collection from here:  https://app.getpostman.com/join-team?invite_code=380c3c806b00d7ef853034a99b705af7&target_code=fdd2e815a3bd2ef472e94cadd8cba6ea

# steps of test the implemented API endpoints.]
1-set your localhost global variable {{localhost}} with yor local development server address
2-getcategories request in Website collection --> get all categories and related posts and creation info to all system users<br>
3-register request in auth collection -->register new user<br>
4-login request in auth collection and copy the token fom response -->log in with the user you just created or log in with (email:test1@gmail.com  password: 12312313 )<br>
5-send all request in category collection but make sure that you send token by Bear Token in Authentication section<br>
6-send all request in category collection but make sure that you send token by Bear Token in Authentication section<br>

