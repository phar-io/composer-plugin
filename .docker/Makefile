all: clean build test

build:
	@echo ">> Building images"
	docker-compose build

test:
	docker-compose run --rm composer global update --prefer-dist
	docker-compose run --rm composer phive:run install -c -t bin --trust-gpg-keys 2A8299CE842DD38C phpunit@^5.7
	# uncomment if you need to know which GPG version is installed
	# docker-compose run --rm --entrypoint /usr/bin/gpg plugin --version
	@echo ">> Run tests"
	docker-compose run --rm plugin bin/phpunit -c phpunit.xml.dist
	docker-compose run --rm phpstan analyse -c phpstan.neon src tests --level=2

clean:
	@echo ">> Cleanup"
	docker-compose rm -f &>/dev/null
