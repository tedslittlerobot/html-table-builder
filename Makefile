REPORT_DIR=./report

test:
	@./vendor/bin/phpunit

coverage:
	@./vendor/bin/phpunit --coverage-html $(REPORT_DIR)

test-active:
	@./vendor/bin/phpunit --stop-on-failure --group active
