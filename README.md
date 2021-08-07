<h1 align="center">ramsey/uuid-console</h1>

<p align="center">
    <strong>A console application for generating UUIDs with <a href="https://github.com/ramsey/uuid">ramsey/uuid</a></strong>
</p>

<p align="center">
    <a href="https://github.com/ramsey/uuid-console"><img src="http://img.shields.io/badge/source-ramsey/uuid--console-blue.svg?style=flat-square" alt="Source Code"></a>
    <a href="https://packagist.org/packages/ramsey/uuid-console"><img src="https://img.shields.io/packagist/v/ramsey/uuid-console.svg?style=flat-square&label=release" alt="Download Package"></a>
    <a href="https://php.net"><img src="https://img.shields.io/packagist/php-v/ramsey/uuid-console.svg?style=flat-square&colorB=%238892BF" alt="PHP Programming Language"></a>
    <a href="https://github.com/ramsey/uuid-console/blob/main/LICENSE"><img src="https://img.shields.io/packagist/l/ramsey/uuid-console.svg?style=flat-square&colorB=darkcyan" alt="Read License"></a>
    <a href="https://github.com/ramsey/uuid-console/actions/workflows/continuous-integration.yml"><img src="https://img.shields.io/github/workflow/status/ramsey/uuid-console/build/main?style=flat-square&logo=github" alt="Build Status"></a>
    <a href="https://codecov.io/gh/ramsey/uuid-console"><img src="https://img.shields.io/codecov/c/gh/ramsey/uuid-console?label=codecov&logo=codecov&style=flat-square" alt="Codecov Code Coverage"></a>
    <!--<a href="https://shepherd.dev/github/ramsey/uuid-console"><img src="https://img.shields.io/endpoint?style=flat-square&url=https%3A%2F%2Fshepherd.dev%2Fgithub%2Framsey%2Fuuid-console%2Fcoverage" alt="Psalm Type Coverage"></a>-->
</p>

## About

ramsey/uuid-console is a console application for generating UUIDs with
[ramsey/uuid](https://github.com/ramsey/uuid).

This project adheres to a [code of conduct](CODE_OF_CONDUCT.md).
By participating in this project and its community, you are expected to
uphold this code.

## Installation

Install this package as a dependency using [Composer](https://getcomposer.org).

```bash
composer require ramsey/uuid-console
```

This will install a reference to the console tool in `./vendor/bin/uuid`.

## Usage

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

Contributions are welcome! To contribute, please familiarize yourself with
[CONTRIBUTING.md](CONTRIBUTING.md).

## Coordinated Disclosure

Keeping user information safe and secure is a top priority, and we welcome the
contribution of external security researchers. If you believe you've found a
security issue in software that is maintained in this repository, please read
[SECURITY.md](SECURITY.md) for instructions on submitting a vulnerability report.

## Copyright and License

The ramsey/uuid-console library is copyright © [Ben Ramsey](https://benramsey.com/) and
licensed for use under the MIT License (MIT). Please see [LICENSE](LICENSE) for more
information.
