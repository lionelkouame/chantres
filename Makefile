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
rector:
	vendor/bin/rector process --dry-run


audi: cs-fix phpstan phpunit
