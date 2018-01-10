all: clean build test

build:
	@echo ">> Building images"
	docker-compose build

test:
	docker-compose run --rm composer global update --prefer-dist
	docker-compose run --rm composer phive:run install --trust-gpg-keys -c -t ../bin https://phar.phpunit.de/phpunit-5.7.21.phar
	# uncomment if you need to know which GPG version is installed
	# docker-compose run --rm --entrypoint /usr/bin/gpg plugin --version
	@echo ">> Run tests"
	docker-compose run --rm plugin bin/phpunit -c phpunit.xml.dist
	docker-compose run --rm phpstan analyse -c phpstan.neon src tests --level=2

clean:
	@echo ">> Cleanup"
	docker-compose rm -f &>/dev/null
