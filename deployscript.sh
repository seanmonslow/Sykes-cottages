mv ./src/.env1 ./src/.env
docker-compose build && docker-compose up -d
docker exec php php artisan migrate