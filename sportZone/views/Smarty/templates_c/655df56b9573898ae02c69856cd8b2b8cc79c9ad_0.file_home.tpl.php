<?php
/* Smarty version 5.5.1, created on 2025-05-28 14:42:44
  from 'file:home.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_683704c44cf9f9_93614962',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '655df56b9573898ae02c69856cd8b2b8cc79c9ad' => 
    array (
      0 => 'home.tpl',
      1 => 1748435316,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_683704c44cf9f9_93614962 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\programmazioneweb\\sportZone\\views\\Smarty\\templates';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_218430643683704c4282b57_25292331', 'title');
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_469877766683704c44ce7d5_94722443', 'content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layouts/base.tpl', $_smarty_current_dir);
}
/* {block 'title'} */
class Block_218430643683704c4282b57_25292331 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\programmazioneweb\\sportZone\\views\\Smarty\\templates';
?>
Home Page<?php
}
}
/* {/block 'title'} */
/* {block 'content'} */
class Block_469877766683704c44ce7d5_94722443 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\programmazioneweb\\sportZone\\views\\Smarty\\templates';
?>

  <h1>Welcome to Our Website</h1>
  <p>This is the homepage. Enjoy your stay!</p>

  <div class="features">
    <h2>Features</h2>
    <ul>
      <li>Fast and secure</li>
      <li>Easy to use</li>
      <li>Responsive design</li>
    </ul>
  </div>

  <div class="cta">
    <a href="<?php echo $_smarty_tpl->getValue('base_url');?>
/signup" class="btn">Get Started</a>
  </div>
<?php
}
}
/* {/block 'content'} */
}
