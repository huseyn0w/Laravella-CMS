# Laravella CMS
<p align="center">
<img alt="Laravella Logo" src="https://raw.githubusercontent.com/huseyn0w/Laravella-CMS/master/public/front/default/img/readme.png">
</p>
The CMS Project based on Laravel PHP Framework

## Getting Started
Laravella CMS is developed as analog to such popular CMS as Wordpress, DLE, Joomla and etc, but based on framework Laravel.
These instructions will get you a copy of the project up and running on your local machine / server for using or testing it.
See deployment for notes on how to deploy the project on a live system.

## Installation instructions
1) Clone project to your server
2) Rename .env.example to .env and put all necessary information (Database, API keys and etc.)
3) Give CHMOD 777 to public folder
4) Run SITE_URL/install.php
5) Enjoy =)



## Admin credentials:
Go to: SITE_URL/cpanel
<pre>
Username: admin
Password: laravelladmin123
</pre>

##To manage website languages:
1) Open config/app.php file and edit array of languages:
<pre>
'languages_list' => [
    'en'  => ['title' => 'English', 'icon' => env('APP_URL').'/admin/img/flags/en.png'],
    'ru'  => ['title' => 'Русский', 'icon' => env('APP_URL').'/admin/img/flags/ru.png'],
    'est' => ['title' => 'Eesti',   'icon' => env('APP_URL').'/admin/img/flags/et.png'],
],
</pre>
2) open resourses/lang/ folder to add/edit/remove language localization string files.


## Demo
soon...

## General features
* General CMS Features;
* Social media authentication possibility
* Website search possibility
* Users with different statuses
* Custom fields
* Flexible template changing system
* Multiple languages possibility
* Database caching

## Planning additional features
* E-Commerce extension
* REST API for posts and pages



## Advantages for developers
Why it is easy to extend? Because it was written by using best practices and technologies, such as:
* Short controllers
* Separate Validator Request classes
* Repository pattern to work with DB
* Middlewares
* Observers
* Policies
* Beautiful text editor (TinyMCE)
* Perfect File Manager (Laravel FileManager)

## Version

Current Version of Laravel Framework is 6.0.4

Current version of CMS is pre~alpha 0.0.1

## Author

* **Elman Hüseynov** - [huseyn0w](https://linkedin.com/in/huseyn0w)

## Contributor

* **Ilkin Alibayli** - [ilkinalibayli](https://www.linkedin.com/in/ilkin-alibayli/)

## License

This project is licensed under the Public V3 License - see the [LICENSE.md](LICENSE.md) file for details

