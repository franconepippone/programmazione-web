<?php
/* Smarty version 5.5.1, created on 2025-05-28 15:06:12
  from 'file:user/home.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_68370a44422da6_80532410',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4a05afe4912db3b5c97e0a0d6e7dad812ae101be' => 
    array (
      0 => 'user/home.tpl',
      1 => 1748436545,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_68370a44422da6_80532410 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\programmazioneweb\\sportZone\\views\\Smarty\\templates\\user';
$_smarty_tpl->getInheritance()->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_54461231668370a4441cb61_49627884', 'title');
?>


<?php 
$_smarty_tpl->getInheritance()->instanceBlock($_smarty_tpl, 'Block_118094423468370a44421873_09278087', 'content');
?>

<?php $_smarty_tpl->getInheritance()->endChild($_smarty_tpl, 'layouts/base.tpl', $_smarty_current_dir);
}
/* {block 'title'} */
class Block_54461231668370a4441cb61_49627884 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\programmazioneweb\\sportZone\\views\\Smarty\\templates\\user';
?>
Home Page<?php
}
}
/* {/block 'title'} */
/* {block 'content'} */
class Block_118094423468370a44421873_09278087 extends \Smarty\Runtime\Block
{
public function callBlock(\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\programmazioneweb\\sportZone\\views\\Smarty\\templates\\user';
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
