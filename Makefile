.PHONY: stopa2 start bash stop restart log phplog help

STACK_NAME=api
php_container_id = $(shell docker ps --filter name="$(STACK_NAME)" -q)

stopa2: ## for those who have apache2 and mysql running on host
	sudo service apache2 stop && sudo service mysql stop

build-client: ## Allow from the first install to build the container
	cd client && npm install --silent

build-admin: ## Allow from the first install to build the container
	cd admin && yarn install --silent

start: ## spin up all container or specific one with c=<container_name>
	make build-client && make build-admin && docker-compose up -d ${c}

up: ##shortcut for start
	docker-compose up -d

bash: ## bash in the php (api) container
	docker exec -it $(php_container_id) bash

stop: ## stop the environment it's not as usefull as docker restart
	docker-compose down

restart: ## restart environment
	make stop && docker-compose up -d

log: ## log the php output, nginx is configured to stdout error logs there
	docker logs -f --details $(php_container_id)

build: ## build a container in particular with "c=<container_name>" : make build c=admin
	docker-compose up -d --build ${c}


help: ## Display this help message
	@cat $(MAKEFILE_LIST) | grep -e "^[a-zA-Z_\-]*: *.*## *" | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-10s\033[0m %s\n", $$1, $$2}'

force-recreate: ## May the force recreate containers (usefull when links are broken)
	docker-compose up --force-recreate
