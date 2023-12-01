start:
	docker-compose up -d --build

healthcheck:
	docker-compose run --rm healthcheck

down:
	docker-compose down

install: start healthcheck

configure:
	docker-compose -f docker-compose.yml -f ./docker/wp-core-install.yml run --rm wp-core-install

autoinstall: start configure
