<?php
/* Smarty version 5.5.1, created on 2025-05-28 14:43:46
  from 'file:layouts/base.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_68370502148473_86477176',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '245549995582a814d220c8e897b7091743d23fe1' => 
    array (
      0 => 'layouts/base.tpl',
      1 => 1748436224,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_68370502148473_86477176 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\programmazioneweb\\sportZone\\views\\Smarty\\templates\\layouts';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, false);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_1584768178683705020a8699_17994388', 'title');
?>
</title>
  <link rel="stylesheet" href="<?php echo $_smarty_tpl->getValue('base_url');?>
/assets/styles.css">
</head>
<body>

  <header>
    <nav>
      <ul>
        <li><a href="<?php echo $_smarty_tpl->getValue('base_url');?>
/">Home</a></li>
        <li><a href="<?php echo $_smarty_tpl->getValue('base_url');?>
/about">About</a></li>
        <li><a href="<?php echo $_smarty_tpl->getValue('base_url');?>
/contact">Contact</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_1228091836683705020aec99_68273140', 'content');
?>

  </main>

  <footer>
    <p>&copy; <?php echo $_smarty_tpl->getSmarty()->getModifierCallback('date_format')(time(),"%Y");?>
 My Site. All rights reserved.</p>
  </footer>

</body>
</html>
<?php }
/* {block 'title'} */
class Block_1584768178683705020a8699_17994388 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\programmazioneweb\\sportZone\\views\\Smarty\\templates\\layouts';
?>
My Site<?php
}
}
/* {/block 'title'} */
/* {block 'content'} */
class Block_1228091836683705020aec99_68273140 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\programmazioneweb\\sportZone\\views\\Smarty\\templates\\layouts';
}
}
/* {/block 'content'} */
}
