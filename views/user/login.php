<?php include ROOT . '/views/layouts/header.php'; ?>

    <main>
        <div class="container">

            <form class="form-signin mt-5" method="post">
                <?php if (isset($errors) && is_array($errors)): ?>
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li> - <?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

                <h2>Вход</h2>
                <input class="form-control mb-3" type="text" name="email" placeholder="E-mail"/>
                <input class="form-control mb-3" type="password" name="password" placeholder="Пароль"/>
                <input class="btn btn-lg btn-dark btn-block waves-effect waves-light m-0" type="submit" name="submit"
                       class="btn btn-default" value="Вход"/>
            </form>


        </div>

    </main>

