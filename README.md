
# Books API

### Resume
This repo is for the purpose of studying the Symfony Framework, For now it's a simple book crud but I plan to put login, authors, comments on the books and notes.

### Technologies
<a href="https://symfony.com">
    <img src="https://shields.io/badge/Symfony-7.0-blue.svg?logo=symfony" alt="Symfony 7.0" />
    <img src="https://shields.io/badge/php-8.2-blue.svg" alt="PHP 8.2" />
    <img src="https://shields.io/badge/nginx-1.25.3-blue.svg" alt="nginx 1.25.3" />
    <img src="https://shields.io/badge/docker-20.10-blue.svg" alt="docker" />
    <img src="https://shields.io/badge/postgres-15.5-blue.svg" alt="postgres 15.5" />
</a>

### Instalation

 - Run: ````docker compose up --build````
 - In PHP container run ````docker exec -it <id-php-container> /bin/bash```` and run ````php bin/console doctrine:migrations:migrate```` to create the database.