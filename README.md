Symfony Demo Application
========================

The simple application for creating documents from pdf file.

Requirements
------------

* Docker;
* Docker-compose util;
* PHP 7.4 or higher;
* Composer(is a tool for dependency management in PHP);
* Git;

Installation
------------

First you need clone the repository:

```bash
$ git clone git@github.com:USERNAME/sun.git

$ cd path/to/clone
```

Rename the `.example.env` with `.env`

Start the project
-----------------

Build and start the images and containers using:

```bash
$ docker-compose up -d --build
```

You should also run commands such as `composer` in the container. 
The container environment is named `php` so you will pass that value to docker-compose run:

```bash
$ docker-compose run --rm -u${UID} php composer install
```
 
Change the permissions on folders `var` and `public/uploads` follow command:

```bash
$ sudo chmod 777 -R var public/uploads
```

At this point, you can visit `http://localhost:8000` to see the site running.

Example
-------

Creating the new documents with attachment

```bash
curl -i -X POST -H "Content-Type: multipart/form-data" -F "pdfDocument=@test.pdf" http://localhost:8000/documents/attachments
```

Issues
------
TODO