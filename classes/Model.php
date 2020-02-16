<?php
abstract class Model extends Logger {
    protected $dbh;
    protected $statement;
    protected $logger;

    public function __construct()
    {
            $this->dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);
            $logger = new Logger();
    }

    public function CreateQuery($query)
    {
        $this->statement = $this->dbh->prepare($query);
    }

    public function bind($param, $value, $type = null)
    {
        if(is_null($type))
        {
            switch(true)
            {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->statement->bindValue($param, $value, $type);
    }

    public function Execute()
    {
        if($this->statement->execute())
        {
            echo "Success!";
        }
        else
        {
            echo "Failed!";
        }
    }

    public function ResultSet()
    {
        $this->Execute();
        return $this->statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ResultSingle()
    {
        $this->Execute();
        return $this->statement->fetch(PDO::FETCH_ASSOC);
    }


    public function lastInsertID()
    {
        return $this->dbh->lastInsertId();
    }
}