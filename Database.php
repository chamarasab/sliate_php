<?php

class Database
{
    private string $host = "localhost";
    private string $user = "root";
    private string $pass = "";
    private string $dbname = "sliate";

    public function getConnection()
    {
        return mysqli_connect($this->host, $this->user, $this->pass, $this->dbname);
    }
}
