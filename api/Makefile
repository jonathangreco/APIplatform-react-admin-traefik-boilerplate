.PHONY: clear-cache diff migrate

clear-cache cc:
	bin/console cache:clear

diff:
	bin/console doctrine:migrations:diff

migrate:
	bin/console doctrine:migrations:migrate
