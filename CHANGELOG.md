# ramsey/uuid-console Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

## 2.0.0 - 2022-12-21

### Added

* Support generating and decoding version 6 UUIDs ([#18](https://github.com/ramsey/uuid-console/pull/18))
* Support generating and decoding version 7 UUIDs
* Support decoding version 8 UUIDs

### Changed

* Removed `--comb` and `--guid` options from the `generate` command.
* Minimum version of PHP is now 7.4.
* Minimum version of symfony/console is now 5.0.
* Minimum version of ramsey/uuid is now 3.9.7.

## 1.2.1 - 2021-08-06

### Fixed

* Do not exclude the `bin/` directory from the distribution package.

## 1.2.0 - 2021-08-06

### Added

* Return proper exit codes from commands to avoid type errors in newer versions of symfony/console.

## 1.1.4 - 2020-07-16

### Added

* Add support for ramsey/uuid v4

## 1.1.3 - 2020-07-16

### Added

* Add support for symfony/console v5 ([#12](https://github.com/ramsey/uuid-console/pull/12))

## 1.1.2 - 2017-11-06

### Added

* Add support for symfony/console v4 ([#3](https://github.com/ramsey/uuid-console/pull/3))

## 1.1.1 - 2017-02-02

### Fixed

* Allow empty strings and `0` to be passed as the "name" for version 3 and version 5 UUIDs.

## 1.1.0 - 2015-12-17

### Added

* Add support for symfony/console v3.
* Add project [Contributor Code of Conduct](https://github.com/ramsey/uuid-console/blob/main/CONDUCT.md).

## 1.0.0 - 2015-09-28

* Initial release!
* Separated from [ramsey/uuid](https://github.com/ramsey/uuid) library into a stand-alone package.
