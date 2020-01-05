## Installation
- copy ``.env.example`` to ``.env`` and configure database envs
- ``composer install``
- ``php artisan key:generate``
- ``php artisan jwt:secret``
- ``php artisan migrate --seed``
- add the following line to **crontab -e**: 
``* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1``

## Api doc
Documentation is available at ``http://localhost/api/documentation`` url

## Sitemap
To generate a sitemap manually, use the command:
``php artisan sitemap:generate``

## Image optimizer
For the image optimizer to **work correctly**, you need to install the following console applications:
- optipng (``sudo apt-get install optipng``)
- pngquant (``sudo apt-get install pngquant``)
- jpeg-recompress (https://github.com/danielgtaylor/jpeg-archive)
