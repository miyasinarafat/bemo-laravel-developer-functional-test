# BeMo laravel developer functional test

### How to setup this project:

**1. Clone the repository**
```git
git clone git@github.com:miyasinarafat/bemo-laravel-developer-functional-test.git
```

**2. Install composer dependency**
```sh
composer install
```

**3. Setup docker envoirment and frontend dependency**
1. `./vendor/bin/sail build`
2. `./vendor/bin/sail up`
3. `./vendor/bin/sail php artisan migrate`
4. `./vendor/bin/sail npm install`
5. `./vendor/bin/sail npm run dev` or `./vendor/bin/sail npm run build`

**4. Now browse localhost or 0.0.0.0 to access your initial fullstack setup.**


### LICENSE
**This repository is highly restricted for personal, commercial, or any use.**
