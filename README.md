# PERFORMANCE COMERCIAL

Prova da empresa Agence desenvolvida em PHP utilizando framework Laravel.

## Features

- OAuth
- Login
- Routes
- Filter
- View Blade

## Requirements

- Apache
- PHP >= 5.5.9
- MySql >=5
- Composer

## Tecnologies

- PHP
- JS
- Jquery
- CSS
- Bootstrap
- ChartJS
- Composer
- Artisan

## Installation

```
$ git clone https://github.com/danilomeneghel/prova_agence.git

$ cd prova_agence

$ composer install
```

Crie um banco de dados com o nome "caol" no seu Mysql. <br>
Você encontra o dump na raiz do projeto (caol.sql) e pode efetuar importação da seguinte forma:

```
$ mysql -u <your user> -p <your password>

mysql> create database `caol`;

mysql> use `caol`;

mysql> source caol.sql
```

Volte o terminal, verifique o arquivo .env e efetue a configuração correta para conexão do seu banco de dados e depois rode o Artisan:

```
$ php artisan key:generate

$ php artisan migrate

$ php artisan db:seed
```

Depois de realizado isso, rode o projeto:

```
$ php artisan serve
```

Finalmente abra http://localhost:8000/ em seu navegador.

## Conexão 

Para poder se logar no sistema é só criar um novo usuário clicando no link "Criar uma conta".

## License

Performance Comercial está sob a licença <a href="LICENSE">The MIT License (MIT)</a>.

## Screenshots

![Screenshots](screenshots/screenshot01.png)<br><br>
![Screenshots](screenshots/screenshot02.png)<br><br>
![Screenshots](screenshots/screenshot03.png)<br><br>
![Screenshots](screenshots/screenshot04.png)<br><br>
![Screenshots](screenshots/screenshot05.png)<br><br>
![Screenshots](screenshots/screenshot06.png)<br><br>
![Screenshots](screenshots/screenshot07.png)<br><br>
![Screenshots](screenshots/screenshot08.png)<br><br>
