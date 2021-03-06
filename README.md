# LaraCache Artisan Commands

[![TravisCI](https://travis-ci.org/jordanbardsley7/LaraCache.svg?branch=master)](https://travis-ci.org/jordanbardsley7/LaraCache.svg?branch=master)
[![StyleCI](https://styleci.io/repos/67170335/shield)](https://styleci.io/repos/67170335)

This repository didnt quite make it into the Laravel source code so I thought I would create a seperate service provider
for anyone who wanted to use the artisan console commands.

### Register The Service Provider
Before you can actually use the console command you need to register the service provider in the Laravel application
configuration file.

```php
\LaraCache\LaraCacheServiceProvider::class,
```

### Display A Cache Store
The following command can be used to display the total cache for a given store. You currently can only pass "memcached"
or "redis" but I will work on adding all the other cache drivers.

```
php artisan cache:show memcached
```

### Querying A Cache
Sometimes you may want to query your default caching instance. Todo so, all you need todo is run the below command
and the query will be matched against all cache keys.

```
php artisan cache:find name
```

### Examples
![LaravelCache Memcached](/screenshots/memcached.png?raw=true)
![LaravelCache Redis](/screenshots/redis.png?raw=true)