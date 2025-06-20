<?php
/* Smarty version 5.5.1, created on 2025-06-20 18:20:02
  from 'file:field/create_field.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.5.1',
  'unifunc' => 'content_68558a32726d42_26107677',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a852a093a8b55c21c1e6bc4dc938a75e09e98d87' => 
    array (
      0 => 'field/create_field.tpl',
      1 => 1750436330,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_68558a32726d42_26107677 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\programmazioneweb\\sportZone\\views\\Smarty\\templates\\field';
?><form action="/create-field.php" method="post">
  <label for="sport">Sport:</label><br>
  <input type="text" id="sport" name="sport" required><br><br>

  <label for="terrainType">Tipo di terreno:</label><br>
  <input type="text" id="terrainType" name="terrainType" required><br><br>

  <label for="isIndoor">È al coperto?</label><br>
  <select id="isIndoor" name="isIndoor" required>
    <option value="1">Sì</option>
    <option value="0">No</option>
  </select><br><br>

  <label for="hourlyCost">Costo orario (€):</label><br>
  <input type="number" step="0.01" id="hourlyCost" name="hourlyCost" required><br><br>

  <button type="submit">Crea campo</button>
</form>
<?php }
}
