all: build test clean

build:
	@echo ">> Building images"
	docker-compose build
	phive install https://phar.phpunit.de/phpunit-5.7.21.phar -c -t ../bin

test:
	@echo ">> Run tests"
	docker-compose run --rm plugin bin/phpunit -c phpunit.xml.dist
	docker-compose run --rm phpstan analyse -c phpstan.neon src tests --level=5

clean:
	@echo ">> Cleanup"
	docker-compose rm -f &>/dev/null