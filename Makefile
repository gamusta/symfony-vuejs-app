phpcs:
	@docker exec -it php-con bash -c  'vendor/bin/phpcs --standard=PSR12 src config'

build:
	make build-back
	make build-front

build-back:
	@docker-compose up -d --build
	make composer-install

composer-install:
	@docker exec -it php-con bash -c  'composer install --prefer-dist'

db-init:
	make db-create
	make db-migrate

db-create:
	@docker exec -it php-con bash -c  'php bin/console doctrine:database:create'

db-migrate:
	@docker exec -it php-con bash -c  'php bin/console doctrine:migrations:migrate --no-interaction'

fruits-fetch:
	@docker exec -it php-con bash -c  'php bin/console fruits:fetch'

build-front:
	make yarn-install
	make yarn-build

yarn-install:
	@docker exec -it node-con bash -c  'yarn install'

yarn-build:
	@docker exec -it node-con bash -c  'yarn run build'




