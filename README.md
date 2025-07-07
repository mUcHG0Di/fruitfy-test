Objective:

Back-end Assessment: [ ] Make all tests pass, applying the best practices of Laravel and SOLID and clean arch

Front-end Assessment: [ ] Implement a front-end using Inertia.js, Vue3 and TailwindCss for contact CRUD

* Plus: Feel free to implement improvements and more features as you wish, such as sending an email to the contact when that contact is deleted from the system.

# Installation
1. Clone the repository
2. Have PHP 8.3 installed on your machine, composer 2, and activate the extensions requested by composer when running "composer install"
3. Run "Composer install"
4. Create a .env file and paste the contents of .env.example
5. Run the command php artisan key:generate
6. Run the command php artisan test, solve the tests

7. After the test is complete, create a repository on github, and upload your resolution to the repository
8. Send the repository link to WhatsApp +55 41 98702-5814

# Test notes
Original fixes for backend assessment tests are in commit: 2ff995439de8a2aceb2dfb64f48c22e4a35fb5d9.
(Final code has been updated to support inertia requests)

Some improvements I've made:
- Add email notifications for deleted contacts
- Added sweetalert library for delete confirmation and snackbars messages
- Added authentication with laravel breeze
- Added a command to update phone numbers that were factory created and contains special characters
- Added a job to call the command created
- Added a schedule to run the job daily at 6:00 AM
