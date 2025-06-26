{extends file=$layout}

{block name="styles"}
  <style>
    .searchbox {
      padding: 20px 0;
    }

    h2 {
      text-align: center;
      color: #333;
    }

    form {
      background: #fff;
      padding: 25px;
      border-radius: 10px;
      max-width: 400px;
      margin: 0 auto;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    .form-group {
      display: flex;
      flex-direction: column;
    }

    label {
      font-weight: bold;
      margin-bottom: 6px;
      color: #333;
    }

    input[type="date"],
    select {
      padding: 10px;
      font-size: 1rem;
      border: 1px solid #ccc;
      border-radius: 5px;
      width: 100%;
      box-sizing: border-box;
    }

    button {
      padding: 12px;
      background-color: #007BFF;
      color: white;
      font-size: 1rem;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.2s ease;
    }

    button:hover {
      background-color: #0056b3;
    }
  </style>
{/block}

{block name="content"}
  <section class="searchbox">
    <h2>Inserisci Giorno e Sport</h2>

    <form action="/field/showResults" method="GET">
      <div class="form-group">
        <label for="date">Giorno:</label>
        <input type="date" id="date" name="date" required>
      </div>

      <div class="form-group">
        <label for="sport">Seleziona uno sport:</label>
        <select name="sport" id="sport">
          <option value="">-- Tutti gli sport --</option>
          <option value="football">Calcio</option>
          <option value="tennis" selected>Tennis</option>
          <option value="basket">Basket</option>
          <option value="padel">Padel</option>
        </select>
      </div>

      <button type="submit">Invia</button>
    </form>
  </section>
{/block}