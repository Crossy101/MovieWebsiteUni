<?php
abstract class LoggerCodes {
    const Error = 0;
    const Warning = 1;
    const Info = 2;
}

class Logger {
    public function LogMessage($logType, $message)
    {
        switch($logType)
        {
            case LoggerCodes::Error;
                $message = "ERROR: ".$message;
                break;
            case LoggerCodes::Info:
                $message = "INFO: ".$message;
                break;
            case LoggerCodes::Warning:
                $message = "WARNING: ".$message;
                break;
            default:
                $message = "ERROR: ".$message;
        }
        $this->CommitLog($logType, $message);
    }

    private function CommitLog($logType, $message)
    {
        $this->CreateQuery('INSERT INTO logs (log_type, log_message) VALUES(:log_type, :log_message)');
        $this->bind(':log_type', $logType);
        $this->bind(':log_message', $message);
        $this->Execute();
    }
}
