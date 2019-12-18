<h4>Панель администрирования</h4>
<p> <a class="btn btn-primary" href="/admin/logout" role="button">Выход</a></p>

<div class="container">
    <div class="row">
        <div class="col-md-12 text-center"><h4>Список задач</h4></div>
    </div>
    <br>
    <?php
    foreach ($tasks as $task) {
        echo "<form action=\"\" method=\"post\">";
        echo "<div class=\"row\">";
        echo "<div class=\"col-md text-center\">" . $task["user_name"] . "</div>";
        echo "<div class=\"col-md text-center\">" . $task["email"] . "</div>";
        echo "<div class=\"col-md text-center\">";
        echo "<textarea class=\"form-control\" id=\"description\" name=\"description\" rows=\"3\">" . $task["description"] . "</textarea>";
        echo "</div>";
        if($task["status"]) {
            $checked = "checked";
        } else {
            $checked = "";
        }
        echo "<div class=\"col-md text-center\">";
        echo "<input class=\"form-check-input\" " . $checked . " type=\"checkbox\" id=\"status_" . $task["id"] . "\" onclick=\"checkboxOnClick(" . $task["id"] . ")\">";
        echo "</div>";
        echo "<input type=\"hidden\" name=\"id\" value=" . $task["id"] . ">";
        echo "<div class=\"col-md text-center\"><button type=\"submit\" name=\"submit\" class=\"btn btn-primary\">Сохранить</button></div>";
        echo "</div>";
        echo "</form>";
    }
    ?>
</div>

<script type="text/javascript">

    function checkboxOnClick(id){
        var val;
        if($("#status_"+id).is(':checked')) {
            val = 1;
        } else {
            val = 0;
        }
        $.get("/admin/?id="+id+"&status="+val, function(data, status){
        });
    }

</script>
