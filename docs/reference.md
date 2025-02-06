Reference
------

## Env processors

### [grinway_env_http_or_https](https://github.com/GrinWay/env-processor-bundle/blob/main/src/EnvProcessor/HttpsToStringEnvVarProcessor.php) ([tests](https://github.com/GrinWay/env-processor-bundle/blob/main/tests/Unit/HttpsToStringEnvVarProcessorTest.php))

#### When I want to use it:

Get the `http` or `https` string

Logic depending on native `HTTPS` environment which if exists equals to `on`

#### Usage:

```env
# "%kernel.project_dir%/.env"

APP_DOMAIN='127.0.0.1'
APP_PORT_WITH_DOTS=':80'
APP_HOST="${APP_DOMAIN}${APP_PORT_WITH_DOTS}"
# MAGIC IS HERE
APP_PROTOCOL="%env(grinway_env_http_or_https:default::HTTPS)%" # needs %env(resolve:<>)%
APP_URL="%env(resolve:APP_PROTOCOL)%://${APP_HOST}"  # needs %env(resolve:<>)%
```

### [grinway_env_assert_absolute_path](https://github.com/GrinWay/env-processor-bundle/blob/main/src/EnvProcessor/AssertAbsolutePathVarProcessor.php) ([tests](https://github.com/GrinWay/env-processor-bundle/blob/main/tests/Unit/AssertAbsolutePathVarProcessorTest.php))

#### When I want to use it:

Guarantee the given path is absolute

If
not [NotAbsolutePathEnvProcessorException](https://github.com/GrinWay/env-processor-bundle/blob/main/src/Exception/NotAbsolutePathEnvProcessorException.php)
is thrown

#### Usage:

```yaml
# "%kernel.project_dir%/config/services.yaml"

parameters:
    some_parameter: '%env(grinway_env_assert_absolute_path:SOME_ABSOLUTE_PATH)%'
```

### [grinway_env_assert_path_exists](https://github.com/GrinWay/env-processor-bundle/blob/main/src/EnvProcessor/AssertPathExistsVarProcessor.php) ([tests](https://github.com/GrinWay/env-processor-bundle/blob/main/tests/Unit/AssertPathExistsVarProcessorTest.php))

#### When I want to use it:

Guarantee the given path is existing

If
not [PathNonExistentVarProcessorException](https://github.com/GrinWay/env-processor-bundle/blob/main/src/Exception/PathNonExistentVarProcessorException.php)
is thrown

#### Usage:

```yaml
# "%kernel.project_dir%/config/services.yaml"

parameters:
    some_parameter: '%env(grinway_env_assert_path_exists:SOME_EXISTENT_PATH)%'
```

### [grinway_env_assert_file_exists](https://github.com/GrinWay/env-processor-bundle/blob/main/src/EnvProcessor/AssertFileExistsVarProcessor.php) ([tests](https://github.com/GrinWay/env-processor-bundle/blob/main/tests/Unit/AssertFileExistsVarProcessorTest.php))

#### When I want to use it:

Guarantee the given filepath is the path to the existing file

If
not [FileNonExistentEnvProcessorException](https://github.com/GrinWay/env-processor-bundle/blob/main/src/Exception/FileNonExistentEnvProcessorException.php)
is thrown

#### Usage:

```yaml
# "%kernel.project_dir%/config/services.yaml"

parameters:
    some_parameter: '%env(grinway_env_assert_file_exists:SOME_EXISTENT_FILEPATH)%'
```

### [grinway_env_normalize_path](https://github.com/GrinWay/env-processor-bundle/blob/main/src/EnvProcessor/NormalizePathEnvVarProcessor.php) ([tests](https://github.com/GrinWay/env-processor-bundle/blob/main/tests/Unit/NormalizePathEnvVarProcessorTest.php))

#### When I want to use it:

When you want to beautify the path

Mean replace all `\` to the `/` in the path

#### Usage:

```yaml
# "%kernel.project_dir%/config/services.yaml"

parameters:
    some_parameter: '%env(grinway_env_normalize_path:SOME_PATH)%'
```

### [grinway_env_r_trim](https://github.com/GrinWay/env-processor-bundle/blob/main/src/EnvProcessor/RTrimVarProcessor.php) ([tests](https://github.com/GrinWay/env-processor-bundle/blob/main/tests/Unit/RTrimVarProcessorTest.php))

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

### [AbstractEnvProcessor](https://github.com/GrinWay/env-processor-bundle/blob/main/src/EnvProcessor/AbstractEnvProcessor.php)

Can be used to create your
custom [symfony env processors](https://symfony.com/doc/current/configuration/env_var_processors.html#custom-environment-variable-processors)

### [AbstractWithParamsVarProcessor](https://github.com/GrinWay/env-processor-bundle/blob/main/src/EnvProcessor/AbstractWithParamsVarProcessor.php)

Same as
[AbstractEnvProcessor](https://github.com/GrinWay/env-processor-bundle/blob/main/src/EnvProcessor/AbstractEnvProcessor.php)
but even more!
<br>
Extending from it, you can pass env processor parameters

For example look at
[RTrimVarProcessor](https://github.com/GrinWay/env-processor-bundle/blob/main/src/EnvProcessor/RTrimVarProcessor.php)
this out-of-the-box env processor has 1 parameter

> **TIP**: Think about env parameters like arguments to the method/function
