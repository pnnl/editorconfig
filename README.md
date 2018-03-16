EditorConfig
================
Ensure files conform to `.editorconfig` file settings.

How it works
----------------
TODO: Fill this in

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
      ignore_patterns: []
```
**ignore_patterns**

*Default: []*

This is a list of patterns that will be ignored by the task. 
With this option you can skip files.
