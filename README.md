# TCHATCHAO.FR

[![License: MIT](https://img.shields.io/badge/License-MIT-green.svg)](https://opensource.org/licenses/MIT)

The website is accessible here: https://tchatchao.fr

![screenshot](/screenshot.png?raw=true "Screenshot")


## Getting started

### Prerequisites

* Docker >= 18.09.2
* Docker-compose >= 1.23.2
* docker-hostmanager (latest docker image iamluc/docker-hostmanager)

### Installing

1. Clone the repository    
    
    ````
    $ git clone https://github.com/aektos/tchatchao.fr.git
    ````
    
2. Regénérer le certificat ssl auto-signé
   
       $ docker run -it -v `pwd`/docker/ssl:/export frapsoft/openssl req -new -newkey rsa:4096 -days 3650 -nodes -x509 -subj "/C=US/ST=CA/L=SF/O=Docker-demo/CN=tchatchao.local" -keyout /export/tchatchao.local.key -out "/export/tchatchao.local.cert"

3. Build and Start Docker container :

    ````    
    $ docker-compose up -d
    ````

4. Access the site in local at: https://tchatchao.local
         
## Running the tests

Tests should be added soon!

## Deployement

The master branch is deployed on shared hosting here : https://tchatchao.fr

## Built with

* [Symfony4](https://symfony.com/4)

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.