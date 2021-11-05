project:
	symfony server:start

db:
	docker-compose up -d

up: db project
