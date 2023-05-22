up:
	docker-compose up -d

down:
	docker-compose down

exec:
	docker exec -it blog_app bash

up-prod:
	docker-compose -f docker-compose.prod.yml up -d
