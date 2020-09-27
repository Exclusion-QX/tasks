<?php include ROOT . '/views/layouts/header.php'; ?>

<main>

    <div class="container">

        <form class="form-signin mt-5" method="POST">

            <?php if ($result): ?>

                <h2 class="text-center">Задача отредактирована</h2>

            <?php else: ?>

                <?php if (isset($errors) && is_array($errors)): ?>
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li> - <?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

                <h2>Редактирование задачи</h2>
                <textarea class="form-control mb-3" name="description"><?php echo @$description ?></textarea>
                <input class="btn btn-lg btn-dark btn-block waves-effect waves-light m-0" type="submit"
                       name="task-edit"
                       class="btn btn-default" value="Редактировать"/>

            <?php endif; ?>

        </form>
    </div>
</main>
