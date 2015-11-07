<?php

require_once 'app/init.php';

$itemsQuery = $db -> prepare("
	SELECT id,name,done
	FROM items
	WHERE user = :user"
	);

$itemsQuery -> execute([
	'user' => $_SESSION['user_id']
]);

$items = $itemsQuery -> rowCount() ? $itemsQuery : [];

?>


<!DOCTYPE html>
<html lang = "pt-br">
	<head>
		<meta charset = "UTF-8">
		<title> ToDo List </title>

		<link rel="stylesheet" href="css/main.css"
	</head>

	<body>
		<div class="list">
			<h1 class = "header"> To-do List. </h1>

			<?php if(!empty($items)): ?>
			<ul class = "items">
				<?php foreach($items as $item): ?>
					<li>
						<span class = "item<?php echo $item['done'] ? ' done' : '' ?>"><?php echo $item['name'] ?></span>
						<?php if(!$item['done']): ?>
							<a href="mark.php?as=done&item=<?php echo $item['id']; ?>" class="done-button"> Feito! </a>
						<?php endif; ?>		
						<a href="#" class="edit-button"> Editar </a>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php else: ?>
			<p> A lista está vazia. </p>
		<?php endif; ?>

			<form class = "item-add" action="add.php" method="post">
				<input type="text" name="name" placeholder = "Adicionar tarefa" class="input" autocomplete="off" required>
				<input type="submit" value = "Adicionar" class = "submit">
			</form>

		</div>
	</body>
</html>