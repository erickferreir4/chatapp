<?php declare(strict_types=1);

namespace app\lib;

use app\interfaces\ILogger;

/**
 *  Logger HTML
 */
class LoggerHTML implements ILogger
{
    private $file_name;
    
    /**
     *  Construct
     *  @param {string} $file_name - file name log
     */
    public function __construct(string $file_name)
    {
        $this->file_name = $file_name;
    }

    /**
     *  Write Message
     *  @param {string} $message - Message write
     */
    public function write(string $message) : void
    {
        date_default_timezone_set('America/Sao_Paulo');
        $time = date("Y-m-d H:i:s");

        $text = "<h3>$time :: $message</h3><br /><br />";

        $handler = fopen(__DIR__ . '/../tmp/'.$this->file_name, 'a');

        fwrite($handler, $text);
        fclose($handler);
    }
}
