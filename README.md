## SENDMAIL API
This is a small project made with laravel to a specific company
hiring challenge

## Proposed problem

Create an Restful Api to receive templates and email data in order to send it with
desired themes the api user can post to the api.
Must solve problems like not holding the customer too long, while the email service takes to long
to process, and the possibility of choosing bettwen lots of templates as desired

## Solution

Two apis where created, one to recive the themes and another to
receive the desired emails. The themes api can receive a blade template on its body
while the post api can receive params to be replaced on the chosen theme.

The email api receives the request but dont send it right away, it is sent to a job queue
to be processed in background. This job queue is maintained on redis server, in order to get
better performance than a job queue stored on a database. Amqp is much better for this use case
by the way, but laravel doesn't supports it natively as it supports redis.

### Solution Stack
* PHP 7+
* Laravel 5
* Redis 3.2
* mysql 5.7

## The downsides of this solution

First thing i don't like much about this stack is eloquent, however, laravel has
greate solutions and it totally coupled with it.

Another downside is when async job queues are used, the api user
never knows if the data he sent is correct, for example, he needs to pass
the correct params for each theme, however, if the params are wrong
it will only fail on the background. It is possible to create resend mechanics to the failed jobs,
but it will keep failing in case of misplaced data.

Laravel doesn't enforce state of art OOP coding, it is really simple and extensible, however,
all the static calls makes it a lot coupled. That doesn't seen to be a problem when
you got a responsible team working on the project

## Running Localy

Install composer, mysql 5.7, php 7+ with pdo_mysql support, redis and curl 

```
$ composer install
$ ./artisan migrate
$ ./artisan serve
```

## Running docker

This app is docker ready, just run the docker-compose command

```
$ docker-compose up -d
```

You migth run this command at least twice, so mysql has time to boot and be available
to the php container

## APi Documentation

```
POST /api/themes {
    "name": "wonderfull name",
    "body": "Hello {{$name}}, we have a offer for you, it is {{$offer}}"
}

POST /api/emails {
    "subject": "some subject",
    "recipients": ["email@email.com"],
    "params": {"name": "foo", "offer": "game discount"},
    "theme_id": 3
}
```

Its also possible to list and update the themes by going to 
POST /api/themes, PUT /api/themes/{id}, GET /api/themes/{id}

