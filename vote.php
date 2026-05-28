<?php

require __DIR__.'/lib.php';

if($_SERVER['REQUEST_METHOD'] !== "POST") { exit; }
$pollId = (int)$_POST['poll_id'];
$optionId = (int)$_POST['option_id'];

$db = pdo();
$row = $db->query("SELECT current_poll_id FROM settings WHERE id = 1")->fetch();
$active = (int)($row['current_poll_id']);

$st = $db->prepare("SELECT id FROM poll_options WHERE id = ? AND poll_id = ?");
$st->execute([$optionId, $pollId]);

if(!$st->fetch()) { exit("Opção inválida!"); }

$db->prepare("UPDATE poll_options SET votes=votes+1 WHERE id = ?")->execute([$optionId]);

set_voted_cookie($pollId);
header('Location: index.php');

exit;