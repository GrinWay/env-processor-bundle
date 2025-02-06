Abilities
------

* Out-of-the-box `env processors`:
    * [grinway_env_http_or_https]() (its [tests]())
    * [grinway_env_assert_absolute_path]() (its [tests]())
    * [grinway_env_assert_path_exists]() (its [tests]())
    * [grinway_env_normalize_path]() (its [tests]())
    * [grinway_env_r_trim]() (its [tests]())
* `Abstract classes` to create new custom
  [symfony env processors](https://symfony.com/doc/current/configuration/env_var_processors.html#custom-environment-variable-processors):
    * [AbstractEnvProcessor]()
    * [AbstractWithParamsVarProcessor]()
