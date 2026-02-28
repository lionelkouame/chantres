# Variables
DOCKER_COMPOSE = docker compose
PHP_CONT = $(DOCKER_COMPOSE) exec -T php

.PHONY: help build up down ssh audit phpstan rector rector-dry cs-fix cs-fix-dry phpunit test-ci

help: ## Affiche cette aide
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-20s\033[0m %s\n", $$1, $$2}'

## --- DOCKER ---

build: ## Construit les images
	$(DOCKER_COMPOSE) build --pull

up: ## Démarre les services (attend qu'ils soient healthy)
	$(DOCKER_COMPOSE) up -d --wait

down: ## Arrête tout et supprime les volumes
	$(DOCKER_COMPOSE) down -v

ps: ## Affiche les conteneurs en cours avec leur taille
	docker ps --size --format "table {{.Names}}\t{{.Status}}\t{{.Size}}"

ssh: ## Entre dans le conteneur PHP
	$(DOCKER_COMPOSE) exec php bash

## --- QUALITÉ & TESTS ---

cs-fix-dry: ## PHP-CS-Fixer en mode simulation
	$(PHP_CONT) vendor/bin/php-cs-fixer fix --dry-run --diff

cs-fix: ## PHP-CS-Fixer (applique les corrections)
	$(PHP_CONT) vendor/bin/php-cs-fixer fix

phpstan: ## Analyse statique PHPStan
	$(PHP_CONT) vendor/bin/phpstan analyse

rector-dry: ## Rector en mode simulation
	$(PHP_CONT) vendor/bin/rector process --dry-run

rector: ## Rector (applique les modifications)
	$(PHP_CONT) vendor/bin/rector process

phpunit: ## Lance les tests unitaires
	$(PHP_CONT) vendor/bin/phpunit

audit: cs-fix phpstan phpunit rector ## Lance l'audit complet local (avec corrections auto)

## --- CI SIMULATION ---

test-ci: up phpstan rector-dry cs-fix-dry phpunit ## Simule exactement le passage de la CI
	@echo "\033[32m✅ La simulation CI est passée avec succès !\033[0m"
