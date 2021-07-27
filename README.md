# copy the .env.example file to .env
$ cp .env.example .env

# Generate the application key
$ php artisan key:generate

# Install the PHP dependencies
$ composer install

# Install node modules
$ npm install --legacy-peer-deps

# Compile the js and sass code
$ npm run dev

# Migrate the application
$ php artisan migrate

# Create the symbolic link
$ php artisan storage:link
