Reference
------

## Env processors

### [grinway_env_http_or_https]() ([test]())

#### When I want to use it:

Get the `http` or `https` string

Logic depending on native `HTTPS` environment which if exists equals to `on`

#### Usage:

```yaml
# "%kernel.project_dir%/config/services.yaml"

parameters:
    # HTTPS is the native php environment variable
    https_string: '%env(grinway_env_http_or_https:default::HTTPS)%'
```

### [grinway_env_assert_absolute_path]() ([test]())

#### When I want to use it:

Guarantee the given path is absolute

If not [NotAbsolutePathEnvProcessorException]() is thrown

#### Usage:

```yaml
# "%kernel.project_dir%/config/services.yaml"

parameters:
    some_parameter: '%env(grinway_env_assert_absolute_path:SOME_ABSOLUTE_PATH)%'
```

### [grinway_env_assert_file_exists]() ([test]())

#### When I want to use it:

Guarantee the given filepath is the path to the existing file

If not [FileNonExistentEnvProcessorException]() is thrown

#### Usage:

```yaml
# "%kernel.project_dir%/config/services.yaml"

parameters:
    some_parameter: '%env(grinway_env_assert_file_exists:SOME_EXISTENT_FILEPATH)%'
```

### [grinway_env_assert_path_exists]() ([test]())

#### When I want to use it:

Guarantee the given path is existing

If not [PathNonExistentVarProcessorException]() is thrown

#### Usage:

```yaml
# "%kernel.project_dir%/config/services.yaml"

parameters:
    some_parameter: '%env(grinway_env_assert_path_exists:SOME_EXISTENT_PATH)%'
```

### [grinway_env_normalize_path]() ([test]())

#### When I want to use it:

When you want to beautify the path

Mean replace all `\` to the `/` in the path

#### Usage:

```yaml
# "%kernel.project_dir%/config/services.yaml"

parameters:
    some_parameter: '%env(grinway_env_normalize_path:SOME_PATH)%'
```

### [grinway_env_r_trim]() ([test]())

#### When I want to use it:

Executes a usual native php `rtrim` to the env variable

Accepts charsets with 1st parameter

#### Usage:

```yaml
# "%kernel.project_dir%/config/services.yaml"

parameters:
    some_parameter: '%env(grinway_env_r_trim:grinway_env.charset:SOME_STRING)%'
```

## Abstract env processor classes

### [AbstractEnvProcessor]()

Can be used to create your
custom [symfony env processors](https://symfony.com/doc/current/configuration/env_var_processors.html#custom-environment-variable-processors)

### [AbstractWithParamsVarProcessor]()

Same as [AbstractEnvProcessor]() but even more!

Extending from it, you can pass env processor parameters

For example look at [RTrimVarProcessor]() this out-of-the-box env processor has 1 parameter

> **TIP**: Think about env parameters like arguments to the method/function
