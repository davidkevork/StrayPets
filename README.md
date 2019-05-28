# StrayPets


[![Build Status](https://api.travis-ci.org/davidkevork/StrayPets.svg?branch=master)](https://travis-ci.org/davidkevork/StrayPets) [![Coverage Status](https://coveralls.io/repos/github/davidkevork/StrayPets/badge.svg?branch=master)](https://coveralls.io/github/davidkevork/StrayPets?branch=master)

## Development

```
git clone https://github.com/davidkevork/StrayPets.git
cd StrayPets
composer install
```

`phpunit` within the folder should execute all unit tests for this project. If you're on OSX using entr (`brew install entr`), you can run the following command for live testing as you develop:

```
find src/ tests/ | entr -c phpunit
```