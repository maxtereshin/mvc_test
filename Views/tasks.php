<div class="container">
    <?php
        if(isset($added)) {
            echo "<div class=\"alert alert-primary\" role=\"alert\">Задача успешно добавлена</div>";
        }
    ?>
    <br>
    <a class="btn btn-primary" href="/admin/login" role="button">Авторизация</a>
    <br>
    <br>
    <div class="row">
        <div class="col-md text-center">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Имя пользователя</a>
            <div class="dropdown-menu">
                <?php
                    echo "<a class=\"dropdown-item\" href=\"/?key=user_name&sort=asc&page=$page\">По возрастанию</a>";
                    echo "<a class=\"dropdown-item\" href=\"/?key=user_name&sort=desc&page=$page\">По убыванию</a>";
                ?>
            </div>
        </div>
        <div class="col-md text-center">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Email пользователя</a>
            <div class="dropdown-menu">
                <?php
                    echo "<a class=\"dropdown-item\" href=\"/?key=email&sort=asc&page=$page\">По возрастанию</a>";
                    echo "<a class=\"dropdown-item\" href=\"/?key=email&sort=desc&page=$page\">По убыванию</a>";
                ?>
            </div>
        </div>
        <div class="col-md text-center">
            <a class="nav-link" href="#">Описание задачи</a>
        </div>
        <div class="col-md text-center">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Статус</a>
            <div class="dropdown-menu">
                <?php
                    echo "<a class=\"dropdown-item\" href=\"/?key=status&sort=asc&page=$page\">По возрастанию</a>";
                    echo "<a class=\"dropdown-item\" href=\"/?key=status&sort=desc&page=$page\">По убыванию</a>";
                ?>
            </div>
        </div>
        <div class="col-md"></div>
    </div>


    <?php
        foreach ($tasks as $task) {
            echo "<div class=\"row\">";
            echo "<div class=\"col-md text-center\">" . $task["user_name"] . "</div>";
            echo "<div class=\"col-md text-center\">" . $task["email"] . "</div>";
            echo "<div class=\"col-md text-center\">" . $task["description"] . "</div>";
            if($task["status"] && $task["status"] == 1) {
                $status = "Выполнено";
            } else {
                $status = "В работе";
            }
            echo "<div class=\"col-md text-center\">" . $status . "</div>";
            $updated = "";
            if($task["updated"]) {
                $updated = "Отредактировано администратором";
            }
            echo "<div class=\"col-md text-center\"><i>" . $updated . "</i></div>";
            echo "</div>";
        }
    ?>
    <br>
    <div><?php echo $pagination->get(); ?></div>
    <br>
    <br>
    <form action="" method="post">
        <div class="form-group">
            <label for="user_name">Имя пользователя</label>
            <input type="text" class="form-control" name="name" placeholder="Имя">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" placeholder="name@example.com">
        </div>
        <div class="form-group">
            <label for="description">Текст задачи</label>
            <textarea class="form-control" name="description" rows="3"></textarea>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Добавить</button>
    </form>

    <?php
    if(isset($errors)) {
        foreach ($errors as $error) {
            echo "<div class=\"alert alert-danger\" role=\"alert\">$error</div>";
        }
    }
    ?>

</div>