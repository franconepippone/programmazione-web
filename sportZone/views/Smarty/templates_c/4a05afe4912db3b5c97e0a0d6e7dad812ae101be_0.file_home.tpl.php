<?php
/* Smarty version 5.5.1, created on 2025-05-29 01:15:35
  from 'file:user/home.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_683799176903e6_40402567',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4a05afe4912db3b5c97e0a0d6e7dad812ae101be' => 
    array (
      0 => 'user/home.tpl',
      1 => 1748474089,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_683799176903e6_40402567 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\programmazioneweb\\sportZone\\views\\Smarty\\templates\\user';
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome Home</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eef;
            padding: 2rem;
            text-align: center;
        }
        .box {
            background: white;
            padding: 2rem;
            max-width: 500px;
            margin: 3rem auto;
            box-shadow: 0 0 12px rgba(0,0,0,0.15);
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <div class="box">
        <h1>Welcome Home</h1>
        <p>Hello, <strong><?php echo htmlspecialchars((string)$_smarty_tpl->getValue('username'), ENT_QUOTES, 'UTF-8', true);?>
</strong>!</p>
        <p>Glad to see you again.</p>
    </div>
</body>
</html>
<?php }
}
