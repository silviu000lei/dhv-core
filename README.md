# Step to start app: 

1. ##### run in terminal `composer install`
2. ##### create `.env` file and copy all from .env.example ( change connection to db if you need)
3. ##### run in terminal `php bin/command doctrine:database:create `
###### if already have the database created please run before `php bin/command doctrine:database:drop` step 3
4. ##### run in terminal `php bin/console doctrine:migrations:migrate`
5. ##### start app by run in terminal `php -S localhost:8000 -t public/`