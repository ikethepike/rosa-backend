# Seeds coding

This is a rebranded version of the old rosa backend. It'll need some love and attention (plus updates!) But it's essentially what we need for the upcoming site. 

# Getting started

There are multiple ways of starting the Rosa app, either use the build in docker config or download Laravel Valet.

### Requirements

-   [Node](https://nodejs.org/en/)
-   [Composer](https://getcomposer.org/)
-   [Prettier](https://github.com/prettier/prettier)

## Docker

Docker is a virtualized environment where servers run within containers, negating the need to setup local server setups on your machine.
[Get started with docker](https://www.docker.com/)

To kick up the servers, navigate into root and run the command `docker-compose up --build`. It will go through and build the server containers for you. If it is successful, you should be able to access the server at [localhost:8080](http://localhost:8080)

## Valet

Valet is a pre-configured nginx server that runs locally, thereby maximizing performance. It's slick, it's great, it does require you to setup a server.

[Valet for Mac](https://laravel.com/docs/5.7/valet)
[Valet for Windows](https://github.com/cretueusebiu/valet-windows)

# Setting up the environment

To setup the project correctly, copy all the data inside of env.example into a .env file and in a terminal window run the following commands:

`php artisan key:generate`  
`php artisan migrate --seed`  
`yarn`

# Compiling content

Once the server is correctly setup, you can start compiling content by running:  
`yarn watch`.
