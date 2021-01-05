.PHONY: stopa2 start bash stop restart log phplog

STACK_NAME=api
php_container_id = $(shell docker ps --filter name="$(STACK_NAME)" -q)

stopa2:
	sudo service apache2 stop && sudo service mysql stop

start:
	docker-compose up -d ${c}

bash:
	docker exec -it $(php_container_id) bash

stop:
	docker-compose down

restart:
	docker-compose down && docker-compose up -d

log:
	docker logs -f --details $(php_container_id)

build:
	docker-compose up -d --build ${c}

