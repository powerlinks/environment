Environment
=============

This library should be use in each project you need detect the environment.

Usage
-----

composer.json

```
{
    "require": {
        "powerlinks/environment": "dev-master"
    }
}
```

How you can define an environment
---------------------------------

It can be used two type of environment definition:
* file
* global variable

### File

By default the file name, where the environment name is stored, is ".env.php" in the project directory.
The file ".env.php" has to added to .gitignore to avoid to push in production the wrong environment definition.

### Global variable

This solution is very fast and it allows you to force the environment during the server set up and you will not have to take care of it anymore. 
A global variable have to be defined at http server level and it can be configured for either apache or nginx.

#### Apache
```
SetEnv ENVIRONMENT development
```

#### Nginx
```
location / {
    ...
    fastcgi_param ENVIRONMENT development; 
    ...
}
```