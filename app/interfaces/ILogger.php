<?php declare(strict_types=1);

namespace app\interfaces;

/**
 *  Interface Logger
 */
interface ILogger
{
    public function __construct(string $file_name);

    public function write(string $message);
}
