<?php
namespace App\Logging;

use Monolog\Logger;
use App\Models\Log as LogModel;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\LogRecord;

class DatabaseLogger extends AbstractProcessingHandler
{
    protected function write(array|LogRecord $record): void
    {
        LogModel::create([
            'level' => $record['level_name'],
            'message' => $record['message'],
            'context' => json_encode($record['context']),
        ]);
    }
}
