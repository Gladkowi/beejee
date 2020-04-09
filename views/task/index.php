<?
$select = array('where' => "id > 0");
$model = new Model_Task($select);
$count = $model->getCount();
$count_per_page = 3;
$len = ceil($count / $count_per_page);
$par = http_build_query($_GET);
$p = isset($_GET["p"]) ? (int) $_GET["p"] : 0;
?>

<div class="new_task">
    <div>
        <h4>Добавить задачу</h4>
        <form method="post">
            <div class="input_view">
                <input name="user_name_post" id="user_name" class="label_show" type="text"
                    placeholder="Введите ваше имя">
                <label class="label_font" for="user_name">имя</label>
            </div>
            <div class="input_view">
                <input name="e_mail_post" id="e_mail" class="label_show" type="text" placeholder="Введите ваш e-mail">
                <label class="label_font" for="e_mail">e-mail</label>
            </div>
            <div class="input_view"">
		        <textarea name=" task_post" id="task" class="label_show" placeholder="Введите вашу задачу"></textarea>
                <label class="label_font" for="task">задача</label>
            </div>
            <input name="add_task" type="submit" value="Добавить задачу" class="buttom buttom_big" />
        </form>

        <? if (!empty($_SESSION['login'])) { ?>

        <form action="log.php" method="post">
            <input type="submit" value="Выйти" class="buttom buttom_big" />
        </form>

        <? } else { ?>

        <h4>Вход администратора</h4>
        <form method="post">
            <div class="input_view">
                <input name="login_admin" id="login_admin" class="label_show" type="text" placeholder="Введите login">
                <label class="label_font" for="login_admin">login</label>
            </div>
            <div class="input_view">
                <input name="password_admin" id="password_admin" class="label_show" type="password"
                    placeholder="Введите ваш password">
                <label class="label_font" for="password_admin">password</label>
            </div>
            <input name="admin_panel" type="submit" value="Войти" class="buttom" />
        </form>

        <? } ?>
        <h4>Сортировка</h4>
        <form method="get">
            <label><input name="sort_1" type="checkbox">Пользователь</label>
            <label><input name="sort_2" type="checkbox">е маил</label>
            <label><input name="sort_3" type="checkbox">статус</label>
            <label><input name="revers" type="checkbox">обратная сортировка</label>
            <input type="submit" class="buttom buttom_big" value="Отсортировать" />
        </form>
    </div>


    <div class="task_list">
        <? for ($i = $p * $count_per_page; $i < ($p + 1) * $count_per_page; $i++) {
            if (!empty($task[$i])) { ?>

        <div class="task_view">

            <span>Пользователь: <span style="color: black;"><?= $task[$i]["user_name"]; ?></span></span>
            <span>E-mail: <span style="color: black;"><?= $task[$i]["e_mail"]; ?></span></span>

            <? if (!empty($_SESSION['login'])) { ?>
            <form method="post">
                <textarea name="task_post_update" id="task" class="area_admin" placeholder="Введите вашу Задачу">
				            <? echo trim($task[$i]["task"]); ?>
			    </textarea>
                <input type="hidden" id="id" name="id" value="<?= $task[$i]['id']; ?>" />
                <input name="task_save" type="submit" value="сохранить" class="buttom buttom_smoll" />
            </form>
            <form method="post">
                <input type="hidden" id="id" name="id" value="<?= $task[$i]['id']; ?>" />
                <input name="task_inactiv" type="submit" value="задача выполнена" class="buttom buttom_smoll" />
            </form>
            <? } else { ?>
            <span>Задача:<div class="area_text"><?= $task[$i]["task"]; ?></div></span>
            <? } ?>
            <div style="display: flex; justify-content: space-between;">
                <div>
                    <span style="margin-right: 20px">Дата: <?= $task[$i]["date_create"]; ?></span>
                    <? if ($task[$i]['active_task'] == 1) { ?>
                    <span>Статус: <span style="color: black;">выполненая</span></span>
                    <? } else { ?>
                    <span>Статус: <span style="color: black;">активная</span></span>
                    <? };?>
                </div>
                <? if ($task[$i]['updata_admin'] == 1) { ?>
                <span style="color: black;">Отредактированно администратором</span>
                <? }; ?>
            </div>
        </div>
        <? }
        } ?>
        <nav>
            <ul class="pagination">
                <? for ($i = 0; $i <= $len - 1; $i++) { ?>
                <li>
                    <a href="?<?= $par ?>&p=<?= $i ?>"><?= $i + 1 ?></a>
                </li>
                <? } ?>
            </ul>
        </nav>
    </div>