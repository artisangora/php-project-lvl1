install:
	composer install
validate:
	composer validate

lint:
	composer run-script linter
test:
	./vendor/bin/phpunit tests

php:
	docker-compose -f docker-compose-dev.yml up -d
	docker-compose -f docker-compose-dev.yml exec php-cli bash

brain-games:
	./bin/brain-games
brain-even:
	./bin/brain-even
brain-calc:
	./bin/brain-calc
brain-gcd:
	./bin/brain-gcd
brain-progression:
	./bin/brain-progression
brain-prime:
	./bin/brain-prime