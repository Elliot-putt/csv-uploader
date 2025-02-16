# CSV Homeowners Laravel App with docker

## Prerequisites

Before you begin, make sure you have the following software installed:

- [Docker Desktop](https://www.docker.com/products/docker-desktop)
- [Git](https://git-scm.com/)

## Installation

1. Clone the repository to your local machine:

```bash
git clone https://github.com/Elliot-putt/csv-uploader.git
 ```



The .env has been included for simple installation.


### Open your hosts file and add the following line:
```text
127.0.0.1 homeowner.local
```

### Building and start the Docker containers:

```bash
 docker-compose up -d --build
```


### Open Docker Desktop and ensure that the containers are running.

Access the app-1 container on `docker desktop` and visit the exec tab:

Inside the app-1 container, run the following command to install Laravel dependencies:

```text
composer install
```
### creating your database:
Access the MySQL container and visit the exec tab:

Inside the MySQL container, log in to MySQL:

```text
mysql -p
```

When prompted for the password, enter literally the word `password`.

Create the database for the application:

```text
create database homeowner;
```

You may need to run migrations which you will execute the following command inside the app-1 container on the exec tab:

```text
php artisan migrate
```

Finally run npm install and npm run dev to compile the assets:

```text
npm install
npm run dev
```

You're all set! You can now access the Laravel app by visiting http://homeowner.local/ in your web browser.

