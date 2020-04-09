<?php
class Controller_Task extends Controller_Base
{
	public $layouts = "first_layouts";
	function index()
	{
		// сортировка
		if (!empty($_GET['sort_1']) || !empty($_GET['sort_2']) || !empty($_GET['sort_3'])) {
			if (!empty($_GET['sort_1'])) {
				if (!empty($_GET['revers'])) {
					$select = array(
						'where' => "id > 0",
						'order' => "user_name DESC",
					);
				} else {
					$select = array(
						'where' => "id > 0",
						'order' => "user_name",
					);
				}
			}
			if (!empty($_GET['sort_2'])) {
				if (!empty($_GET['revers'])) {
					$select = array(
						'where' => "id > 0",
						'order' => "e_mail DESC",
					);
				} else {
					$select = array(
						'where' => "id > 0",
						'order' => "e_mail",
					);
				}
			}
			if (!empty($_GET['sort_3'])) {
				if (!empty($_GET['revers'])) {
					$select = array(
						'where' => "id > 0",
						'order' => "active_task DESC",
					);
				} else {
					$select = array(
						'where' => "id > 0",
						'order' => "active_task",
					);
				}
			}
		} else {
			$select = array(
				'where' => "id > 0",
			);
		}
		$model = new Model_Task($select);
		$task = $model->getAllRows();
		$this->template->vars('task', $task);
		$this->template->view('index');

		// вход в админ панель
		if (!empty($_POST['admin_panel'])) {
			if (!empty($_POST['login_admin']) && !empty($_POST['password_admin'])) {
				$login = trim(strip_tags($_POST['login_admin']));
				$password = trim(strip_tags($_POST['password_admin']));

				$select_where = array(
					'where' => 'id = 1',
				);

				$admin = new Model_User($select_where);
				if ($login == $admin->getRowById(1)[1] && $password == $admin->getRowById(1)[2]) {
					$_SESSION['login'] = $login;
					$_SESSION['password'] = $password;
					header("Location:" . $_SERVER['PHP_SELF']);
					echo "<meta http-equiv='refresh' content='0'>";
					echo "<h4>$login - Администратор!</h4>";
				} else {
					echo "<h4>Логин или пароль не верен!</h4>";
				}
			} else {
				echo "<h4>Заполните все поля!</h4>";
			}
		}

		// изменение статуса задачи
		if (!empty($_POST['task_inactiv'])) {
			if (!empty($_SESSION['login'])) {
				if (!empty($_POST['task_inactiv']) && !empty($_POST['id'])) {
					$id = $_POST['id'];
					$select_update = array(
						'where' => "id = $id",
					);
					$model_update = new Model_Task($select_update);
					$model_update->fetchOne();
					$model_update->active_task = 1;
					$model_update->update();
					header("Location:" . $_SERVER['PHP_SELF']);
					echo "<meta http-equiv='refresh' content='0'>";
					echo "<h4>Статус задачи изменен, задача выполненая!</h4>";
				}
			} else {
				echo "<h4>Авторизуйтесь!</h4>";
			}
		}

		// изменение задачи
		if (!empty($_POST['task_save'])) {
			if (!empty($_SESSION['login'])) {
				if (!empty($_POST['task_post_update']) && !empty($_POST['id'])) {
					$id = $_POST['id'];
					$select_update = array(
						'where' => "id = $id",
					);
					$model_update = new Model_Task($select_update);
					$model_update->fetchOne();
					if ($model_update->task != trim($_POST['task_post_update'])) {
						$model_update->task = $_POST['task_post_update'];
						$model_update->updata_admin = 1;
						$model_update->update();
						header("Location:" . $_SERVER['PHP_SELF']);
						echo "<meta http-equiv='refresh' content='0'>";
						echo "<h4>задача отредактирована!</h4>";
					} else {
						echo "<h4>Задача не изменина!</h4>";
					}
				} else {
					echo "<h4>Задача не может быть пустой!</h4>";
				}
			} else {
				echo "<h4>Авторизуйтесь!</h4>";
			}
		}

		// добавление задачи
		if (!empty($_POST['add_task'])) {
			if (!empty($_POST['user_name_post']) && !empty($_POST['e_mail_post']) && !empty($_POST['task_post'])) {
				$item = preg_match('/^((([0-9A-Za-z]{1}[-0-9A-z\.]{1,}[0-9A-Za-z]{1})|([0-9А-Яа-я]{1}[-0-9А-я\.]{1,}[0-9А-Яа-я]{1}))@([-A-Za-z]{1,}\.){1,2}[-A-Za-z]{2,})$/u', strip_tags($_POST['e_mail_post']));
				if ($item == 1) {
					$model_new = new Model_Task();
					$model_new->user_name = strip_tags($_POST['user_name_post']);
					$model_new->e_mail = strip_tags($_POST['e_mail_post']);
					$model_new->task = strip_tags($_POST['task_post']);
					$model_new->save();
					header("Location:" . $_SERVER['PHP_SELF']);
					echo "<meta http-equiv='refresh' content='0'>";
					echo "<h4>Данные заполнены!</h4>";
				} else {
					echo "<h4>E-mail не валиден</h4>";
				}
			} else {
				echo "<h4>Данные не заполнены</h4>";
			}
		}
	}
}
