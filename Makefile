install:
	composer install

validate:
	composer validate

lint:
	composer run-script linter

test:
	./vendor/bin/phpunit tests

brain-games:
	./bin/brain-games

brain-even:
	./bin/brain-even