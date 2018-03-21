EditorConfig
================
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://github.com/PNNL/editorconfig/blob/master/LICENSE.md)
[![Travis CI](https://travis-ci.org/pnnl/editorconfig.svg?branch=master)](https://travis-ci.org/pnnl/drupal-installer)
[![Coverage Status](https://coveralls.io/repos/github/pnnl/editorconfig/badge.svg?branch=master)](https://coveralls.io/github/pnnl/editorconfig?branch=master)

Ensure files conform to `.editorconfig` file settings.

How it works
----------------
Uses [`editorconfig-checker/editorconfig-checker`](https://packagist.org/packages/editorconfig-checker/editorconfig-checker)
to verify your files follow the rules defined in your `.editorconfig` file.


How to use:
----------------
Add the package to your `composer.json` file:
```shell
composer require --dev pnnl/editorconfig
```

Add the extension to your `grumphp.yml` file:
```yaml
#grumphp.yml
parameters:
  extensions:
    - Pnnl\EditorConfig\Extension\Loader
```

Add and configure the tasks as defined below in the "Parameters" section.

Parameters:
----------------
```yaml
#grumphp.yml
parameters:
  tasks:
    editorconfig:
      auto_fix: false
      dotfiles: false
      ignore_defaults: false
      ignore_patterns: []
      list_files: false
      triggered_by: []
```
**auto_fix**

*Default: false*

Will automatically fix fixable issues (insert_final_newline, end_of_line, trim_trailing_whitespace, tabs to spaces).
See [README] for location of autofixed files.

**dotfiles**

*Default: false*

Use this flag if you want to exclude dotfiles.

**ignore_defaults**

*Default: false*

Will ignore default excludes, see [README] for details.

**ignore_patterns**

*Default: []*

String or regex to filter files which should not be checked.

*Example:*
```yaml
parameters:
  tasks:
    editorconfig:
      ignored_patterns:
        - '.(yml|yaml)' # ignore all files ending in yml or yaml
        - '.json' # ignore all files ending in json
        - 'tests/' # ignore all files in the tests folder
```

**list_files**

*Default: false*

Will print all files which are checked to stdout (will only output if there is an error).

**triggered_by**

*Default: []*

This is a list of extensions that should be checked. Leave empty for all.

*Example:*
```yaml
parameters:
  tasks:
    editorconfig:
      triggered_by:
        - yml
        - yaml
        - json
        - php
```

Disclaimer
----------------
This material was prepared as an account of work sponsored by an agency of the United States Government.  Neither the United States Government nor the United States Department of Energy, nor Battelle, nor any of their employees, nor any jurisdiction or organization that has cooperated in the development of these materials, makes any warranty, express or implied, or assumes any legal liability or responsibility for the accuracy, completeness, or usefulness or any information, apparatus, product, software, or process disclosed, or represents that its use would not infringe privately owned rights.

Reference herein to any specific commercial product, process, or service by trade name, trademark, manufacturer, or otherwise does not necessarily constitute or imply its endorsement, recommendation, or favoring by the United States Government or any agency thereof, or Battelle Memorial Institute. The views and opinions of authors expressed herein do not necessarily state or reflect those of the United States Government or any agency thereof.

<p align="center">
PACIFIC NORTHWEST NATIONAL LABORATORY<br />
<em>operated by</em><br />
BATTELLE<br />
<em>for the</em><br />
UNITED STATES DEPARTMENT OF ENERGY<br />
<em>under Contract DE-AC05-76RL01830</em><br />
</p>


[README]: https://github.com/editorconfig-checker/editorconfig-checker.php/blob/master/README.md
