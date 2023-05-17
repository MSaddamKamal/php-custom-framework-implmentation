<?php

namespace App\Models;
use PDO;

class QueryBuilder
{
    /**
     * @var void|null
     */
    protected $pdo;

    public function __construct()
    {
        $this->pdo = getConnection();

    }

    /**
     * @param $sql_string
     * @param array $parameters
     */
    public function query($sql_string, $parameters=[])
    {
        try {
            $query = $this->pdo->prepare($sql_string);

            $query->execute($parameters);

            return $query;

        } catch (Exception $e) {
            die('Something went wrong.');
        }
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        // SQL query:
        $query = $this->query(sprintf("select * from %s",static::$table));

        // Fetch all results and store results and map columns to class properties:
//        return $query->fetchAll(PDO::FETCH_CLASS,get_class($this));
        return $query->fetchAll(PDO::FETCH_ASSOC);

    }

    /**
     * @param $table
     * @param $parameters
     * @return  int
     */
    public function insert($table, $parameters)
    {
        // array_keys() returns an array containing the keys of the input array,
        // and implode() concatenates each element of the new array into a
        // string in which each element is separated by ", ":
        $columns = implode(', ', array_keys($parameters));

        // preface each column name with a colon, which acts as a
        // placeholder for the value corresponding to the specified key:
        $values = ':' . implode(', :', array_keys($parameters));

        // sprintf() allows you to declare a string with placeholders to which
        // you can attach variables (in this case, strings identified as %s):
        $sql_string = sprintf(
            'insert into %s (%s) values (%s)', $table, $columns, $values
        );

       $this->query($sql_string,$parameters);

       return $this->pdo->lastInsertId();
    }

    /**
     * @param $table
     * @param $attr
     * @param $value
     * @return mixed
     */
    public function findByAttr($table, $attr, $value)
    {
        $sql_string = sprintf( "select * from %s where %s = '%s' ", $table, $attr, $value
        );
        $query = $this->query($sql_string);

//        return $query->fetchAll(PDO::FETCH_CLASS,get_class($this));
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param $attr
     * @param $arr
     */
    public static function deleteAll($attr, $arr)
    {

        $data = implode(",", array_values($arr));
        $sql_string = sprintf( "DELETE FROM %s WHERE %s IN ($data) ", static::$table, $attr);
        $instance = new self;
        $instance->query($sql_string);

    }

}
