install:
	composer install

validate:
	composer validate

lint:
	composer run-script linter

bg:
	./bin/brain-games