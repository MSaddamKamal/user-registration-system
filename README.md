# User Registration System

A simple user registration system with token based authetaiction accomapnied with beautiful user profile where on can track his account activites.

## Technology Stack
It is built on Laravel and Vue.js, accompanied with beautiful UI using Tailwind CSS. The authentication system has been implemneted using third party package passport.


## Features
* User Login/Signup
* Personalize profile
* Track account acitvity
* Proper Validation

## Demo
![Demo](https://raw.githubusercontent.com/MSaddamKamal/user-registration-system/main/gif/user_system_demo.gif)

## Installation

Create `.env` file at the root of the project and add database credentials

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=kanban
DB_USERNAME=root
DB_PASSWORD=

```

Install composer vendor packages by following command

```bash
composer install
```

Install node modules  by following command

```bash
npm install
```

As for token based authetication passport package is installed therfore you have to make your own key so run

```bash
php artisan passport:install
```

Run migrations by following command

```bash
php artisan migrate:fresh --seed
```

Clear Cache

```bash
php artisan optimize
```

## Troubleshooting

Run following commands for troubleshooting

```bash
php artisan optimize
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://choosealicense.com/licenses/mit/)
