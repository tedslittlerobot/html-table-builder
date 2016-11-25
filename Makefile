REPORT_DIR=./report

test:
	@./vendor/bin/phpunit

coverage:
	@./vendor/bin/phpunit --coverage-html $(REPORT_DIR)
