<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <title>Elenco Prenotazioni</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(to bottom right, #e3f2fd, #ffffff);
      padding: 2rem;
      margin: 0;
    }
    h1 {
      text-align: center;
      color: #0d47a1;
      margin-bottom: 2rem;
    }
    form {
      display: flex;
      justify-content: center;
      gap: 1rem;
      flex-wrap: wrap;
      margin-bottom: 2rem;
    }
    input, button {
      padding: 0.5rem 0.9rem;
      font-size: 1rem;
      border-radius: 8px;
      border: 1px solid #90caf9;
    }
    input {
      width: 180px;
      background-color: #ffffff;
    }
    button {
      background-color: #1565c0;
      color: white;
      border: none;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    button:hover {
      background-color: #0d47a1;
    }
    .message {
      text-align: center;
      background-color: #ffcdd2;
      color: #b71c1c;
      padding: 1rem;
      margin-bottom: 2rem;
      border-radius: 10px;
      font-weight: 600;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      background-color: #ffffff;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    th, td {
      padding: 1rem;
      text-align: left;
    }
    th {
      background-color: #1976d2;
      color: white;
    }
    tr:nth-child(even) {
      background-color: #f1f8ff;
    }
    tr:hover {
      background-color: #e3f2fd;
    }
  </style>
</head>
<body>

  <h1>Elenco Prenotazioni</h1>

  <form method="post" action="/employee/showReservation">
    <input type="date" name="date" value="{$filters.date|default:''|escape}">
    <input type="text" name="sport" value="{$filters.sport|default:''|escape}" placeholder="Sport">
    <input type="text" name="client" value="{$filters.client|default:''|escape}" placeholder="Nome cliente">
    <button type="submit">Filtra</button>
  </form>

  {if isset($message)}
    <div class="message">{$message}</div>
  {/if}

  {if $reservations|@count > 0}
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Data</th>
          <th>Orario</th>
          <th>Campo</th>
          <th>Cliente</th>
        </tr>
      </thead>
      <tbody>
        {foreach from=$reservations item=res}
          <tr>
            <td>{$res->getId()|default:'[getId()]'}</td>
            <td>{$res->getDate()|date_format:"%Y-%m-%d"}</td>
            <td>{$res->getTime()|default:'[getTime()]'}</td>
            <td>{$res->getField()->getSport()|default:'[getSport()]'}</td>
            <td>
              {if $res->getClient() neq null}
                {$res->getClient()->getName()|default:'[getName()]'} {$res->getClient()->getSurname()|default:'[getSurname()]'}
              {else}
                [getClient()->getName()] [getClient()->getSurname()]
              {/if}
            </td>
          </tr>
        {/foreach}
      </tbody>
    </table>
  {/if}

</body>
</html>
