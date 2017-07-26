<?php
	require 'init.php';
	$back=$app->layout->add('Button');
	$back->set('Back');
	$back->link('index.php');
	$friend = new Friends($db);
	$friend->load($app->stickyGet('friends_id'));
	$loans = $friend->ref('Money');
	$columns = $app->layout->add(['ui'=>'segment'])->add(new \atk4\ui\Columns('divided'));
	$column = $columns->addColumn();
	$ispaid = ['positive'=>['new return'],'negative'=>['new lend']];
	$crud = $column->add('CRUD');
	$crud->addColumn('type', new \atk4\ui\TableColumn\Status($ispaid));
  $crud->setModel($loans,['amount','date']);
	$column2 =  $columns->addColumn();
 	$reminder = $column2->add('Header')->set('Here you have reminder message for your friend. If you will, you can send it to him.')->add(new ReminderBox())->setModel($friend);
