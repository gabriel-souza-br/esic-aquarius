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

read -p "HOST ou IP > " DB_HOST
read -p "PORT (recomendado: 5432) > " DB_PORT
read -p "DATABASE (recomendado: esic_aquarius) > " DB_DATABASE
read -p "SCHEMA (recomendado: api) > " DB_SCHEMA
read -p "USERNAME > " DB_USERNAME
read -sp "PASSWORD > " DB_PASSWORD
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
php db:seed

##===========Frontend===========
echo -e "\033[37\033[m"
echo -e "\033[33m-------------------------------\033[m"
echo -e "\033[33m>> Instalando Frontend\033[m"
echo -e "\033[33m-------------------------------\033[m"
echo -e "\033[37\033[m"
echo "node: "$(node -v)
echo "npm: "$(npm -v)
cd $BASE_DIR/frontend/
npm install