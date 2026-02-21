cs-fix-dry:
	vendor/bin/php-cs-fixer fix --dry-run --diff

cs-fix:
	vendor/bin/php-cs-fixer fix

phpstan:
	vendor/bin/phpstan analyse

phpunit:
	vendor/bin/phpunit

rector:
	vendor/bin/rector process

rector-dry:
	vendor/bin/rector process --dry-run

ps:
	docker ps --format "table {{.Names}}\t{{.Status}}\t{{.Ports}}"

reload:
	docker compose down && docker compose up -d

reset-hard:
	docker compose down && docker compose up --build -d --force-recreate && ps
reset:
	docker compose up -d --force-recreate php


audit: cs-fix phpstan phpunit rector

log-php:
	docker compose logs -f php

ssh:
	docker compose exec php /bin/bash

consume:
	docker exec -it chantres-php-1 php bin/console messenger:consume
