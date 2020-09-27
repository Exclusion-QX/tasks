<?php include ROOT . '/views/layouts/header.php'; ?>

<div class="container mt-5">

    <section>

        <div class="row wow fadeIn">

            <div class="col-md-12 mt-5">

                <div class="dropdown open">
                    <a class="btn btn-dark dropdown-toggle" href="http://example.com" id="dropdownMenuLink"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Сортировка
                    </a>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="/sort-namedesc">По имени ↑</a>
                        <a class="dropdown-item" href="/sort-nameasc">По имени ↓</a>
                        <a class="dropdown-item" href="/sort-emaildesc">По email ↑</a>
                        <a class="dropdown-item" href="/sort-emailasc">По email ↓</a>
                        <a class="dropdown-item" href="/sort-statusdesc">По статусу ↑</a>
                        <a class="dropdown-item" href="/sort-statusasc">По статусу ↓</a>
                    </div>
                </div>
            </div>

            <?php foreach ($tasks as $task): ?>

                <div class="col-md-12 mb-5">

                    <div class="card p-2">

                        <div class="task-info">
                            <div class="row p-4">
                                <div class="col-md-4"><?php echo Task::protect($task['username']); ?></div>
                                <div class="col-md-4 text-center"><?php echo Task::protect($task['email']); ?></div>
                                <div class="col-md-4 text-right"><?php echo Task::protect($task['status']); ?></div>
                            </div>
                            <div class="row p-4">
                                <div class="col-md-12">
                                    <p>
                                        <?php echo Task::protect($task['description']); ?>
                                    </p>
                                </div>
                            </div>
                            <div class="row pl-4 pr-4">
                                <?php if (User::isAdmin()): ?>
                                    <div class="col-md-2">
                                        <a href="/task/edit/<?= $task['id'] ?>">Редактировать</a>
                                    </div>
                                    <div class="col-md-2">
                                        <form method="POST">
                                            <button class="btn-sm" type="submit" name="done-task"
                                                    value="<?= $task['id'] ?>">Выполнено
                                            </button>
                                        </form>
                                    </div>
                                    <div class="col-md-4">
                                        <form method="POST">
                                            <button class="btn-sm" type="submit" name="delete-task"
                                                    value="<?= $task['id'] ?>">Удалить
                                            </button>
                                        </form>
                                    </div>
                                <?php endif; ?>

                                <?php if (Task::isEdit($task['id'])): ?>

                                    <div class="col-md-4">
                                        <p>Отредактировано администратором</p>
                                    </div>

                                <?php endif; ?>
                            </div>
                        </div>

                    </div>

                </div>

            <?php endforeach; ?>

            <div class="col-md-12">
                <?php echo $pagination->get(); ?>
            </div>

    </section>

</div>

<?php include ROOT . '/views/layouts/footer.php'; ?>

