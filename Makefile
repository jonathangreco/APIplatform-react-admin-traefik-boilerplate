.PHONY: stopa2 start bash stop restart

STACK_NAME=api
php_container_id = $(shell docker ps --filter name="$(STACK_NAME)" -q)

stopa2:
	sudo service apache2 stop

start:
	docker-compose up -d ${c}

bash:
	docker exec -it $(php_container_id) bash

stop:
	docker-compose down

restart:
	docker-compose down && docker-compose up -d


