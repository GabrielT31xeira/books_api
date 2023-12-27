
# Books API

### Resume
This repo is for the purpose of studying the Symfony Framework, For now it's a simple book CRUD but I plan to put login, authors, comments on the books and notes.

### Technologies
<a href="https://symfony.com">
    <img src="https://shields.io/badge/Symfony-7.0-blue.svg?logo=symfony" alt="Symfony 7.0" />
</a>
<a href="https://www.php.net/">
    <img src="https://shields.io/badge/php-8.2-blue.svg?logo=php" alt="PHP 8.2" />
</a>
<a href="https://nginx.org/en/">
    <img src="https://shields.io/badge/nginx-1.25.3-blue.svg?logo=nginx" alt="nginx 1.25.3" />
</a>
<a href="https://www.docker.com/">
    <img src="https://shields.io/badge/docker-20.10-blue.svg?logo=docker" alt="docker" />
</a>
<a href="https://www.postgresql.org/">
    <img src="https://shields.io/badge/postgres-15.5-blue.svg?logo=postgresql" alt="postgres 15.5" />
</a>

### Installation

 - Run: ````docker compose up --build````
 - In PHP container run ````docker exec -it <id-php-container> /bin/bash```` enter in project path ````cd /var/www/html```` and run ````php bin/console doctrine:migrations:migrate```` to create the database.