<?php


class TaskController
{

    public function actionIndex($sort, $page)
    {

        $turn = 'ASC';

        switch ($sort) {
            case 'id':
                $sort = 'id';
                $turn = 'DESC';
                break;
            case 'namedesc':
                $sort = 'username';
                $turn = 'DESC';
                break;
            case 'nameasc':
                $sort = 'username';
                $turn = 'ASC';
                break;
            case 'emaildesc':
                $sort = 'email';
                $turn = 'DESC';
                break;
            case 'emailasc':
                $sort = 'email';
                $turn = 'ASC';
                break;
            case 'statusdesc':
                $sort = 'status';
                $turn = 'DESC';
                break;
            case 'statusasc':
                $sort = 'status';
                $turn = 'ASC';
                break;

        }


        $tasks = Task::getTasks($page, $sort, $turn);

        $total = Task::getAmountTasks();

        $pagination = new Pagination($total, $page, Task::SHOW_BY_DEFAULT, 'page-');

        if (isset($_POST['delete-task'])) {
            $id = $_POST['delete-task'];
            $result = Task::delete($id);
            header("Refresh:0");
        }

        if (isset($_POST['done-task'])) {
            $id = $_POST['done-task'];
            $result = Task::setStatus($id);
            header("Refresh:0");

        }

        require_once(ROOT . '/views/task/index.php');

        return true;
    }

    public function actionCreate()
    {

        $name = '';
        $email = '';
        $description = '';
        $status = 'Не выполнено';
        $result = false;

        if (isset($_POST['task-create'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $description = $_POST['description'];

            $errors = false;

            if (!User::checkName($name)) {
                $errors[] = 'Имя не должно быть короче 2-х символов';
            }

            if (!User::checkEmail($email)) {
                $errors[] = 'Неправильный email';
            }

            if (!Task::checkDescription($description)) {
                $errors[] = 'Описание не должно быть пустым';
            }

            if ($errors == false) {
                $result = Task::create($name, $email, $description, $status);
            }

        }

        require_once(ROOT . '/views/task/create.php');

        return true;
    }

    public function actionEdit($id)
    {

        if (!User::isAdmin() || User::isGuest()) {
            header("Location:/");
        }

        $result = false;

        $description = Task::getDescriptionTaskById($id);


        if (isset($_POST['task-edit'])) {


            $description = $_POST['description'];


            $errors = false;

            if (!Task::checkDescription($description)) {
                $errors[] = 'Описание не должно быть пустым';
            }

            if ($errors == false) {
                $result = Task::edit($id, $description);
            }

        }

        require_once(ROOT . '/views/task/edit.php');

        return true;
    }


}