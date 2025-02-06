Abilities
------

* Out-of-the-box `env processors`:
    * [grinway_env_http_or_https](https://github.com/GrinWay/env-processor-bundle/blob/main/docs/reference.md#grinway_env_http_or_https-test)
      \(its [tests](https://github.com/GrinWay/env-processor-bundle/blob/main/tests/Unit/HttpsToStringEnvVarProcessorTest.php))
    * [grinway_env_assert_absolute_path](https://github.com/GrinWay/env-processor-bundle/blob/main/docs/reference.md#grinway_env_assert_absolute_path-test)
      \(its [tests](https://github.com/GrinWay/env-processor-bundle/blob/main/tests/Unit/AssertAbsolutePathVarProcessorTest.php))
        * can throw
          [NotAbsolutePathEnvProcessorException](https://github.com/GrinWay/env-processor-bundle/blob/main/src/Exception/NotAbsolutePathEnvProcessorException.php)
    * [grinway_env_assert_path_exists](https://github.com/GrinWay/env-processor-bundle/blob/main/docs/reference.md#grinway_env_assert_path_exists-test)
      \(its [tests](https://github.com/GrinWay/env-processor-bundle/blob/main/tests/Unit/AssertPathExistsVarProcessorTest.php))
        * can throw
          [PathNonExistentVarProcessorException](https://github.com/GrinWay/env-processor-bundle/blob/main/src/Exception/PathNonExistentVarProcessorException.php)
    * [grinway_env_assert_file_exists](https://github.com/GrinWay/env-processor-bundle/blob/main/docs/reference.md#grinway_env_assert_file_exists-test)
      \(its [tests](https://github.com/GrinWay/env-processor-bundle/blob/main/tests/Unit/AssertFileExistsVarProcessorTest.php))
        * can throw
          [FileNonExistentEnvProcessorException](https://github.com/GrinWay/env-processor-bundle/blob/main/src/Exception/FileNonExistentEnvProcessorException.php)
    * [grinway_env_normalize_path](https://github.com/GrinWay/env-processor-bundle/blob/main/docs/reference.md#grinway_env_normalize_path-test)
      \(its [tests](https://github.com/GrinWay/env-processor-bundle/blob/main/tests/Unit/NormalizePathEnvVarProcessorTest.php))
    * [grinway_env_r_trim](https://github.com/GrinWay/env-processor-bundle/blob/main/docs/reference.md#grinway_env_r_trim-test)
      \(its [tests](https://github.com/GrinWay/env-processor-bundle/blob/main/tests/Unit/RTrimVarProcessorTest.php))
* `Abstract classes` to create new custom
  [symfony env processors](https://symfony.com/doc/current/configuration/env_var_processors.html#custom-environment-variable-processors):
    * [AbstractEnvProcessor](https://github.com/GrinWay/env-processor-bundle/blob/main/src/EnvProcessor/AbstractEnvProcessor.php)
    * [AbstractWithParamsVarProcessor](https://github.com/GrinWay/env-processor-bundle/blob/main/src/EnvProcessor/AbstractWithParamsVarProcessor.php)
