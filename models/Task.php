<?php


class Task
{

    /**
     *  Количество отображаемых задач по умолчани.
     */
    const SHOW_BY_DEFAULT = 3;

    /**
     * @param $page
     * @return array
     */
    public static function getTasks($page, $sort, $turn)
    {
        $page = intval($page);
        $offset = ($page - 1) * self::SHOW_BY_DEFAULT;

        $db = Db::getConnection();
        $taskList = array();

        $result = $db->query('SELECT * FROM task ORDER BY ' . $sort . ' ' . $turn . ' '
            . 'LIMIT ' . self::SHOW_BY_DEFAULT
            . ' OFFSET ' . $offset);

        $i = 0;

        while ($row = $result->fetch()) {
            $taskList[$i]['id'] = $row['id'];
            $taskList[$i]['username'] = $row['username'];
            $taskList[$i]['email'] = $row['email'];
            $taskList[$i]['description'] = $row['description'];
            $taskList[$i]['status'] = $row['status'];
            $i++;
        }

        return $taskList;
    }

    /**
     * @param $username
     * @param $email
     * @param $description
     * @param $status
     * @return bool
     */
    public static function create($username, $email, $description, $status)
    {
        $db = Db::getConnection();

        $sql = 'INSERT INTO task (username, email, description, status) '
            . 'VALUES (:username, :email, :description, :status)';

        $result = $db->prepare($sql);
        $result->bindParam(':username', $username, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':description', $description, PDO::PARAM_STR);
        $result->bindParam(':status', $status, PDO::PARAM_STR);

        return $result->execute();
    }

    /**
     * @param $description
     * @return bool
     */
    public static function checkDescription($description)
    {
        if (!($description === '')) {
            return true;
        }
        return false;
    }

    /**
     * @return int
     */
    public static function getAmountTasks()
    {
        $db = Db::getConnection();

        $result = $db->query('SELECT count(id) AS count FROM task');
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();

        return $row['count'];
    }

    /**
     * @param $id
     * @return string
     */
    public static function isEdit($id)
    {
        $db = Db::getConnection();
        $sql = 'SELECT edit FROM task WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();


        return $result->fetch()['edit'];
    }

    public static function delete($id)
    {
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'DELETE FROM task WHERE id = :id';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    /**
     * @param $id
     * @return mixed
     */
    public static function getDescriptionTaskById($id)
    {
        $db = Db::getConnection();

        $sql = 'SELECT description FROM task WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        $result->setFetchMode(PDO::FETCH_ASSOC);
        $result->execute();


        return $result->fetch()['description'];
    }

    /**
     * @param $id
     * @param $description
     * @return bool
     */
    public static function edit($id, $description)
    {

        $edit = 1;

        $db = Db::getConnection();

        $sql = "UPDATE task
            SET 
                description = :description,
                edit = :edit
            WHERE id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':description', $description, PDO::PARAM_STR);
        $result->bindParam(':edit', $edit, PDO::PARAM_INT);

        if (!User::isAdmin()) {
            header("Location:/");
        } else {
            return $result->execute();
        }

    }

    /**
     * @param $id
     * @return bool
     */
    public static function setStatus($id)
    {
        $status = 'Выполнено';

        $db = Db::getConnection();
        $sql = "UPDATE task
            SET 
                status = :status
            WHERE id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':status', $status, PDO::PARAM_STR);
        return $result->execute();
    }


    /**
     * Обработчик строки
     * @param $string
     * @return string
     */
    public static function protect($string)
    {
        return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    }

}