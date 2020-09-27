<?php include ROOT . '/views/layouts/header.php'; ?>

<main>

    <div class="container">

        <form class="form-signin mt-5" method="POST">

            <?php if ($result): ?>
                <h2 class="text-center">Задача создана</h2>

            <?php else: ?>

                <?php if (isset($errors) && is_array($errors)): ?>
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li> - <?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

                <h2>Создание задачи</h2>
                <input class="form-control mb-3" type="text" name="name" placeholder="Имя"/>
                <input class="form-control mb-3" type="email" name="email" placeholder="E-mail"/>
                <textarea class="form-control mb-3" name="description" placeholder="Описание"></textarea>
                <input class="btn btn-lg btn-dark btn-block waves-effect waves-light m-0" type="submit"
                       name="task-create"
                       class="btn btn-default" value="Создать"/>

            <?php endif; ?>

        </form>
    </div>
</main>