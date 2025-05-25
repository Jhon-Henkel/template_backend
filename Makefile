cf-bash:
	@echo "Starting bash..."
	docker compose start && docker exec -it [CONTAINER_NAME] bash

tail:
	@echo "Tailing logs..."
	tail -f -n 100 storage/logs/laravel.log

deploy:
	@echo "Deploy im progress..."
	php artisan optimize && php artisan migrate --force

PHONY: cf-bash tail deploy
