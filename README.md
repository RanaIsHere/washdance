<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

# Washdance

Washdance is an application designed to manage a laundromat franchise. Please keep in mind that this is a school project, thus should not be used for realistic usages in the real world. This application uses Orchid Admin Panel.

Keep in mind that the account underneath requires the option seeder upon migrating the database,

```
    php artisan migrate:fresh --seed
```

And you can now log into this full admin account without any limitation. 

```
    Default user: team_origin@protonmail.com
    Password: admin
```

90% of the view resources are located within `app\Orchid\Screens\` and custom templates are within the usual `resources/views` and this also means that the routing system are no longer located in web.php except the route to `/`.

You can find the routing file in `config/platform.php`
Check the documentation for Orchid for further information on changing the application looks and functionality, and if needed, troubleshooting during installation.

[Check the Orchid documentation](https://orchid.software/en/docs)