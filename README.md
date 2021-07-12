# football-predictions
![Current Version](https://img.shields.io/badge/version-1.0-brightgreen) ![Php Version](https://img.shields.io/badge/PHP-7.4-yellowgreen)

## Autor

[Tomasz Lublin](mailto:lubski@gmail.com)

## Technologies Used
Languages:
- [PHP 7.4](https://www.php.net/)

## Frameworks / Tools
- [Symfony 5](https://symfony.com/)
- [PostgreSQL 13](https://www.postgresql.org/)
- [Api Platform](https://api-platform.com/)
- [Docker/Docker Compose](https://www.docker.com/)
- [PHPUnit](https://phpunit.de/)

## Installation and Configuration
In root catalog You must create image and run docker containers from ```docker-compose.yaml```
```bash
docker-compose up -d
```

after that You must enter terminal for container ```php``` 

```bash
docker exec -it php bash
```

in ```/var/www/football-predictions``` and run command

```bash
symfony composer update
```
Now we need to make migrations for update database

```bash
symfony console doctrine:migrations:migrate
```

Now you should see dashboard site of api at address [link](http://127.0.0.1:8080/api/)
```
http://127.0.0.1:8080/api/
```

If something wrong and website it's not open rebuild images and run container again or look into logs.
```
docker-compose down
docker-compose up -d --build
```