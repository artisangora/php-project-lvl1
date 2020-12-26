install:
	composer install

validate:
	composer validate

lint:
	composer run-script linter

brain-games:
	./bin/brain-games

brain-even:
	./bin/brain-even