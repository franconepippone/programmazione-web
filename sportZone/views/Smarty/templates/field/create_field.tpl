<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8" />
  <title>Crea Campo Sportivo</title>
  <link
    rel="stylesheet"
    href="https://unpkg.com/leaflet/dist/leaflet.css"
  />
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
      background-color: #eef0f4;
    }

    label {
      font-weight: bold;
    }

    input,
    select,
    textarea {
      width: 100%;
      max-width: 400px;
      padding: 8px;
      margin-top: 4px;
      margin-bottom: 15px;
      border-radius: 4px;
      border: 1px solid #ccc;
      font-size: 1em;
    }

    #map {
      width: 100%;
      max-width: 600px;
      height: 400px;
      margin-bottom: 20px;
      border-radius: 8px;
      border: 1px solid #ccc;
    }

    button {
      padding: 12px 24px;
      font-size: 1.1em;
      background-color: #007bff;
      border: none;
      border-radius: 6px;
      color: white;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #0056b3;
    }
    form {
      max-width: 600px;      /* larghezza massima del form */
      margin: 0 auto;        /* centro orizzontalmente */
      background: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    label {
      display: block;        /* ogni label a capo */
      margin-bottom: 6px;
      font-weight: 600;
    }

    input, select, textarea {
      width: 100%;           /* prendono tutta la larghezza disponibile */
      padding: 8px 12px;
      margin-bottom: 20px;
      border-radius: 6px;
      border: 1px solid #ccc;
      box-sizing: border-box; /* include padding e bordo nella larghezza */
      font-size: 1em;
    }

    button {
      display: block;
      width: 100%;
      max-width: 300px;
      margin: 0 auto;
      padding: 12px;
      font-size: 1.1em;
      border-radius: 8px;
      border: none;
      background-color: #007bff;
      color: white;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>
  <h1>Crea Campo Sportivo</h1>

  <form
    action="/field/finalizeFieldCreation"
    method="post"
    enctype="multipart/form-data"
  >
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required />

    <label for="sport">Sport:</label>
    <input type="text" id="sport" name="sport" required />

    <label for="terrainType">Tipo di terreno:</label>
    <input type="text" id="terrainType" name="terrainType" required />

    <label for="isIndoor">È al coperto?</label>
    <select id="isIndoor" name="isIndoor" required>
      <option value="1">Sì</option>
      <option value="0">No</option>
    </select>

    <label for="hourlyCost">Costo orario (€):</label>
    <input
      type="number"
      step="0.01"
      id="hourlyCost"
      name="hourlyCost"
      required
      min="0"
    />

    <label for="description">Descrizione:</label>
    <textarea
      id="description"
      name="description"
      rows="4"
      required
      placeholder="Inserisci una descrizione del campo"
    ></textarea>

    <label for="fieldImages">Carica foto del campo:</label>
    <input type="file" id="images" name="images[]" accept="image/*" multiple />


    <label>Seleziona la posizione sulla mappa:</label>
    <div id="map"></div>

    <input type="hidden" id="latitude" name="latitude" required />
    <input type="hidden" id="longitude" name="longitude" required />

    <button type="submit">Crea campo</button>
  </form>

  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  {literal}
  <script>
    const map = L.map("map").setView([41.9028, 12.4964], 13); // Roma centro

    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
      attribution: "&copy; OpenStreetMap contributors",
    }).addTo(map);

    const marker = L.marker([41.9028, 12.4964], { draggable: true }).addTo(map);

    function updateLatLng(latlng) {
      document.getElementById("latitude").value = latlng.lat.toFixed(7);
      document.getElementById("longitude").value = latlng.lng.toFixed(7);
    }

    // Imposta inizialmente lat e lng
    updateLatLng(marker.getLatLng());

    marker.on("dragend", () => {
      updateLatLng(marker.getLatLng());
    });

    map.on("click", (e) => {
      marker.setLatLng(e.latlng);
      updateLatLng(e.latlng);
    });
  </script>
  {/literal}
</body>
</html>
