<?php


class server
{
    /** @var SQLite3 */
    private $con;

    public function __construct()
    {
        $this->con = self::connect();
    }

    protected static function connect(): SQLite3
    {
        return new SQLite3('database.db', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
    }

    public function __destruct()
    {
        $this->con->close();
    }

    public function getStudents(): array
    {
        $arr = [];
        $results = $this->con->query('SELECT * FROM students');
        while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
            $arr[] = $row;
        }
        return $arr;
    }

    public function getStudent(int $id): array
    {
        $arr = [];
        $results = $this->con->query("SELECT * FROM students WHERE id = '$id'");
        while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
            $arr[] = $row;
        }
        return $arr;
    }

    public function addStudent($array): string
    {
        $sql = $this->con->prepare(
            "INSERT INTO students (name,surname,course,'group') VALUES (:name,:surname,:course,:group);"
        );
        $sql->bindValue(':name', $array['name']);
        $sql->bindValue(':surname', $array['surname']);
        $sql->bindValue(':group', $array['group']);
        $sql->bindValue(':course', $array['course']);
        $result = $sql->execute();
        $sql->close();
        if ( !$result ) {
            return 'Ошибка добавления студента, проверьте передаваемые данные';
        }
        return 'Студент успешно добавлен';
    }

    public function deleteStudent(int $id): string
    {
        $results = $this->con->exec("DELETE FROM students WHERE id='$id'");

        if ( !$results ) {
            return 'Проверьте существует ли по указанному ID запись студента';
        }
        return 'Студент удален с id = ' . $id;
    }
}

$params = ['uri' => 'soap.loc/server.php', 'wsdl_cache' => WSDL_CACHE_NONE];
$server = new SoapServer(null, $params);

$server->setClass('server');
$server->handle();
