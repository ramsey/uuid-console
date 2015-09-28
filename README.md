# ramsey/uuid-console

[![Gitter Chat](https://img.shields.io/badge/gitter-join_chat-brightgreen.svg?style=flat-square)](https://gitter.im/ramsey/uuid)
[![Source Code](http://img.shields.io/badge/source-ramsey/uuid--console-blue.svg?style=flat-square)](https://github.com/ramsey/uuid-console)
[![Latest Version](https://img.shields.io/github/release/ramsey/uuid-console.svg?style=flat-square)](https://github.com/ramsey/uuid-console/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](https://github.com/ramsey/uuid-console/blob/master/LICENSE)
[![Build Status](https://img.shields.io/travis/ramsey/uuid-console/master.svg?style=flat-square)](https://travis-ci.org/ramsey/uuid-console)
[![HHVM Status](https://img.shields.io/hhvm/ramsey/uuid-console.svg?style=flat-square)](http://hhvm.h4cc.de/package/ramsey/uuid-console)
[![Scrutinizer](https://img.shields.io/scrutinizer/g/ramsey/uuid-console/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/ramsey/uuid-console/)
[![Coverage Status](https://img.shields.io/coveralls/ramsey/uuid-console/master.svg?style=flat-square)](https://coveralls.io/r/ramsey/uuid-console?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/ramsey/uuid-console.svg?style=flat-square)](https://packagist.org/packages/ramsey/uuid-console)

## About

ramsey/uuid-console is a console application for generating UUIDs with
[ramsey/uuid][ramsey-uuid].

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

The ramsey/uuid library is copyright © [Ben Ramsey](https://benramsey.com/) and
licensed for use under the MIT License (MIT). Please see [LICENSE][] for more
information.


[ramsey-uuid]: https://github.com/ramsey/uuid
[packagist]: https://packagist.org/packages/ramsey/uuid-console
[composer]: http://getcomposer.org/
[contributing]: https://github.com/ramsey/uuid-console/blob/master/CONTRIBUTING.md
[license]: https://github.com/ramsey/uuid-console/blob/master/LICENSE
