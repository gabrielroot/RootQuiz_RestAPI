project:
	symfony server:start --port=8000

db:
	docker-compose up -d

up: db project
