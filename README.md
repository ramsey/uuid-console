# ramsey/uuid-console

[![Source Code][badge-source]][source]
[![Latest Version][badge-release]][release]
[![Software License][badge-license]][license]
[![Build Status][badge-build]][build]
[![Coverage Status][badge-coverage]][coverage]
[![Total Downloads][badge-downloads]][downloads]

ramsey/uuid-console is a console application for generating UUIDs with
[ramsey/uuid][ramsey-uuid].

This project adheres to a [Contributor Code of Conduct][conduct]. By participating in this project and its community, you are expected to uphold this code.

## Installation

The preferred method of installation is via [Packagist][] and [Composer][].

```bash
composer require ramsey/uuid-console
```

This will install a reference to the console tool in `./vendor/bin/uuid`.

## Examples

If installed in your project, you may execute the console application from the
command line:

    $ ./vendor/bin/uuid

If installed globally using Composer, ensure your global Composer installation
is in your `PATH` (it's usually somewhere like `~/.composer/vendor/bin`). Then,
you may execute it:

    $ uuid

Please be aware that some systems may already have a command line application
named `uuid` installed, so this might create a conflict if anything using your
`PATH` expects the other `uuid` tool.

You can generate UUIDs:

    $ ./vendor/bin/uuid generate
    afe1296a-660b-11e5-bd9f-3c15c2caed47

By default, the application generates version 1 (time-based) UUIDs, but you may
specify other versions:

    $ ./vendor/bin/uuid generate 4
    54478f1d-8b9d-4bf9-8767-1a23010d48a7

You may also decode UUIDs to get information about them:

    $ ./vendor/bin/uuid decode afe1296a-660b-11e5-bd9f-3c15c2caed47
     ========= ========== =========================================
      encode:   STR:       afe1296a-660b-11e5-bd9f-3c15c2caed47
                INT:       233784006064090443909084029429027106119
      decode:   variant:   RFC 4122
                version:   1 (time and node based)
                content:   time:  2015-09-28T18:06:49+00:00
                           clock: 15775 (usually random)
                           node:  3c:15:c2:ca:ed:47
     ========= ========== =========================================

For help, just type `./vendor/bin/uuid` and read the help information.

## Contributing

Contributions are welcome! Please read [CONTRIBUTING][] for details.

## Copyright and License

The ramsey/uuid-console library is copyright © [Ben Ramsey](https://benramsey.com/) and
licensed for use under the MIT License (MIT). Please see [LICENSE][] for more
information.


[ramsey-uuid]: https://github.com/ramsey/uuid
[conduct]: https://github.com/ramsey/uuid-console/blob/master/CODE_OF_CONDUCT.md
[packagist]: https://packagist.org/packages/ramsey/uuid-console
[composer]: http://getcomposer.org/
[contributing]: https://github.com/ramsey/uuid-console/blob/master/CONTRIBUTING.md

[badge-source]: http://img.shields.io/badge/source-ramsey/uuid--console-blue.svg?style=flat-square
[badge-release]: https://img.shields.io/packagist/v/ramsey/uuid-console.svg?style=flat-square
[badge-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[badge-build]: https://img.shields.io/travis/ramsey/uuid-console/master.svg?style=flat-square
[badge-coverage]: https://img.shields.io/coveralls/ramsey/uuid-console/master.svg?style=flat-square
[badge-downloads]: https://img.shields.io/packagist/dt/ramsey/uuid-console.svg?style=flat-square

[source]: https://github.com/ramsey/uuid-console
[release]: https://packagist.org/packages/ramsey/uuid-console
[license]: https://github.com/ramsey/uuid-console/blob/master/LICENSE
[build]: https://travis-ci.org/ramsey/uuid-console
[coverage]: https://coveralls.io/r/ramsey/uuid-console?branch=master
[downloads]: https://packagist.org/packages/ramsey/uuid-console
