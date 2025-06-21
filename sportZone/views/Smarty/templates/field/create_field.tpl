<form action="/field/finalizeFieldCreation" method="post" enctype="multipart/form-data">
  <label for="name">Name:</label><br>
  <input type="text" id="name" name="name" required><br><br>

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

  <label for="fieldImage">Carica una foto del campo:</label><br>
  <input type="file" id="fieldImage" name="fieldImage" accept="image/*"><br><br>

  <button type="submit">Crea campo</button>
</form>
