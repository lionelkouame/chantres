cs-fix-dry:
	vendor/bin/php-cs-fixer fix --dry-run --diff
cs-fix:
	vendor/bin/php-cs-fixer fix
phpstan:
	vendor/bin/phpstan analyse
phpunit:
		vendor/bin/phpunit

audi: cs-fix phpstan phpunit
