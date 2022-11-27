#!/bin/bash
BASE_DIR="$PWD"

echo -e "\033[33m=========================================\033[m"
echo -e "\033[33m> Iniciando Instalação\033[m"
echo -e "\033[33m=========================================\033[m"

##===========Backend===========
echo -e "\033[37\033[m"
echo -e "\033[33m-------------------------------\033[m"
echo -e "\033[33m>> Instalando Backend\033[m"
echo -e "\033[33m-------------------------------\033[m"
echo -e "\033[37\033[m"

php -v
cd $BASE_DIR/backend/
composer install
cp ./.env.example ./.env
php artisan jwt:secret

echo -e "\033[37\033[m"
echo -e "\033[33m>>> Parâmetros do Banco de Dados PostgreSQL (criado previamente):\033[m"
echo -e "\033[37\033[m"

read -p "HOST ou IP: " DB_HOST
read -e -p "PORT: " -i "5432" DB_PORT
read -e -p "DATABASE: " -i "esic_aquarius" DB_DATABASE
read -e -p "SCHEMA: " -i "api" DB_SCHEMA
read -p "USERNAME: " DB_USERNAME
read -sp "PASSWORD: " DB_PASSWORD
echo -e "\033[37\033[m"
echo -e "\033[33m-------------------------------\033[m"
echo -e "\033[37\033[m"
echo ">$DB_HOST"
echo ">$DB_PORT"
echo ">$DB_DATABASE"
echo ">$DB_SCHEMA"
echo ">$DB_USERNAME"

sed -i -E "s/DB_API_HOST=.+/DB_API_HOST=${DB_HOST}/g" $BASE_DIR/backend/.env
sed -i -E "s/DB_API_PORT=.+/DB_API_PORT=${DB_PORT}/g" $BASE_DIR/backend/.env
sed -i -E "s/DB_API_DATABASE=.+/DB_API_DATABASE=${DB_DATABASE}/g" $BASE_DIR/backend/.env
sed -i -E "s/DB_API_SCHEMA=.+/DB_API_SCHEMA=${DB_SCHEMA}/g" $BASE_DIR/backend/.env
sed -i -E "s/DB_API_USERNAME=.+/DB_API_USERNAME=${DB_USERNAME}/g" $BASE_DIR/backend/.env
sed -i -E "s/DB_API_PASSWORD=.+/DB_API_PASSWORD=${DB_PASSWORD}/g" $BASE_DIR/backend/.env

echo -e "\033[37\033[m"
echo -e "\033[33m>>> Populando tabelas\033[m"
echo -e "\033[37\033[m"
php artisan migrate
php artisan db:seed

##===========Frontend===========
echo -e "\033[37\033[m"
echo -e "\033[33m-------------------------------\033[m"
echo -e "\033[33m>> Instalando Frontend\033[m"
echo -e "\033[33m-------------------------------\033[m"
echo -e "\033[37\033[m"
echo "node -v"
node -v
echo "npm -v"
npm -v
cd $BASE_DIR/frontend/
npm install