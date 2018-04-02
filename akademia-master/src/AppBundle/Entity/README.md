##stworzenie bazy danych
php bin/console doctrine:database:create

##drop bazy czyli usuniecie
php bin/console doctrine:database:drop --force

##walidator poprawnosci
php bin/console doctrine:schema:validate

##aktualizacja struktury bazy danych
php bin/console doctrine:schema:update --force
