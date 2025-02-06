<?php

namespace GrinWay\EnvProcessor\Tests;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

abstract class AbstractEnvProcessorTestCase extends KernelTestCase
{
    protected static \Closure $getenv;
    protected static string $cacheDir;
    protected static string $tmpTestExistingAbsFilepath;
    protected static string $tmpTestNonExistingAbsFilepath;
    protected static string $charset;

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();

        self::$cacheDir = self::getContainer()->getParameter('kernel.cache_dir');
        self::$tmpTestExistingAbsFilepath = \sprintf(
            '%s/test_empty_file.txt',
            self::$cacheDir,
        );
        if (!\is_file(self::$tmpTestExistingAbsFilepath)) {
            \touch(self::$tmpTestExistingAbsFilepath);
        }

        self::$tmpTestNonExistingAbsFilepath = \sprintf(
            '%s/test_empty_file_%s.txt',
            self::$cacheDir,
            \str_shuffle('abcdefghijklmnopqrstuvwxyz'),
        );
        if (\is_file(self::$tmpTestNonExistingAbsFilepath)) {
            \unlink(self::$tmpTestNonExistingAbsFilepath);
        }

        self::$charset = self::getContainer()->getParameter('grinway_env.charset');

        self::$getenv = self::getContainer()->get('container.getenv');
    }

    public static function tearDownAfterClass(): void
    {
        parent::tearDownAfterClass();

        if (\is_file(self::$tmpTestExistingAbsFilepath)) {
            \unlink(self::$tmpTestExistingAbsFilepath);
        }

        if (\is_file(self::$tmpTestNonExistingAbsFilepath)) {
            \unlink(self::$tmpTestNonExistingAbsFilepath);
        }
    }
}
