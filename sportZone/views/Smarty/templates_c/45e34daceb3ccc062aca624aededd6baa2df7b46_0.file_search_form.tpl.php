<?php
/* Smarty version 5.5.1, created on 2025-06-20 17:36:39
  from 'file:field/search_form.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_68558007d191e2_52782603',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '45e34daceb3ccc062aca624aededd6baa2df7b46' => 
    array (
      0 => 'field/search_form.tpl',
      1 => 1750433726,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_68558007d191e2_52782603 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\programmazioneweb\\sportZone\\views\\Smarty\\templates\\field';
?><!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <title>Modulo Giorno e Sport</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 20px;
      background-color: #f5f5f5;
    }
    form {
      background: #fff;
      padding: 20px;
      border-radius: 8px;
      max-width: 400px;
      margin: auto;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
    label {
      display: block;
      margin-top: 10px;
      margin-bottom: 5px;
    }
    input[type="text"], input[type="date"] {
      width: 100%;
      padding: 8px;
      box-sizing: border-box;
    }
    button {
      margin-top: 15px;
      padding: 10px 15px;
      background-color: #007BFF;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
    button:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>

  <h2>Inserisci Giorno e Sport</h2>

  <form action="/field/showResults" method="POST">
    <label for="giorno">Giorno:</label>
    <input type="date" id="giorno" name="giorno" required>

    <label for="sport">Sport:</label>
    <input type="text" id="sport" name="sport" placeholder="Es. Calcio, Tennis" required>

    <button type="submit">Invia</button>
  </form>

</body>
</html>
<?php }
}
