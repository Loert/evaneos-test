# Evaneos technical test

![Super Runner](https://github.com/Loert/evaneos-test/workflows/Super%20Runner/badge.svg?branch=master)

## Prerequisite

- PHP 7.1
- Extension mb-string

## Installation

- Clone repository
- Go to project directory
- Run `composer install`
- Run `php example/example.php`

## Units tests

You can run units tests with : 

    php vendor/phpunit/phpunit/phpunit -c phpunit.xml --coverage-clover=coverage.xml
    
## My approach

- Analysis of all existing code (Reading of all files)
- Adding missing PHP Doc on all existing functions 
- Adding return types and typing of function parameters
- Added code coverage for unit tests
- Setting up namespaces within the application
- Cleaning and simplification of the code of the `TemplateManager` class (naming of variables, deletion of unnecessary conditions, creation of a method for replacing values)
- Create services to compute each text placeholder categories
- Code compliance with PSR-12 standards
- Add units tests to get a coverage of 100% on `Context`, `Repository`, `Service` and `TemplateManager`
- Setting up a runner in the repository to validate the whole code and run units tests on push

The objective of these different actions was to make the code more pleasant to maintain as well as to make it closer to what can be found in today's PHP frameworks.

Hope to see you soon ! Thomas Rollet
