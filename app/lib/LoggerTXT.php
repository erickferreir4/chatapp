<?php declare(strict_types=1);

namespace app\lib;

use app\interfaces\ILogger;

/**
 *  Logger txt file
 */
class LoggerTXT implements ILogger
{
    private $file_name;

    /**
     *  Construct
     *  @param {string} $file_name - file path
     */
    public function __construct(string $file_name)
    {
        $this->file_name = $file_name;
    }

    /**
     *  Write message in file
     *  @param {string} $message - message to write
     */
    public function write(string $message) : void
    {
        date_default_timezone_set('America/Sao_Paulo');
		$time = date("Y-m-d H:i:s");

		$text = "$time :: $message \n \n \n";

        $handler = fopen(__DIR__ . '/../tmp/' . $this->file_name, 'a');
        fwrite($handler, $text);
        fclose($handler);
    }
}
