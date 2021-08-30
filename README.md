# blog project
yii2blog is a blog service that powered by yii2 framework.

## install
download source code and config database

git clone https://github.com/meshjak/sanjagh.git

## install dependency package 
composer install

## run migration
php yii migrate

php yii migrate --migrationPath=@yii/rbac/migrations/

## create user admin
php yii seed/admin

## create role and assign to admin
php yii rbac/init