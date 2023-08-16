default:
	date

-include var/Makefile

build-local:
	docker-compose build
	docker-compose up -d

stop:
	@docker-compose stop