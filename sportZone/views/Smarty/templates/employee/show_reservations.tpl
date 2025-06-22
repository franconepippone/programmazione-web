<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <title>Elenco Prenotazioni</title>
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background: #f4faff;
      padding: 2rem;
      color: #333;
    }

    h1 {
      text-align: center;
      color: #0d47a1;
      margin-bottom: 2rem;
    }

    form {
      text-align: center;
      margin-bottom: 2rem;
    }

    input, button {
      padding: 0.5rem 0.8rem;
      margin: 0.3rem;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 1rem;
    }

    input {
      width: 180px;
    }

    button {
      background-color: #1565c0;
      color: white;
      border: none;
      cursor: pointer;
    }

    button:hover {
      background-color: #0d47a1;
    }

    .message {
      text-align: center;
      color: #d32f2f;
      font-weight: bold;
      margin-bottom: 1.5rem;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    th, td {
      padding: 1rem;
      border-bottom: 1px solid #ddd;
      text-align: left;
    }

    th {
      background-color: #1565c0;
      color: white;
    }

    tr:hover {
      background-color: #e3f2fd;
    }
  </style>
</head>
<body>

  <h1>Elenco Prenotazioni</h1>

  <form method="post" action="/employee/showReservations">
    <input type="text" name="client" value="{$filters.client|default:''|escape}" placeholder="Nome cliente">
    <input type="date" name="date" value="{$filters.date|default:''|escape}" placeholder="Data">
    <input type="text" name="sport" value="{$filters.sport|default:''|escape}" placeholder="Sport">
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
            <td>{$res->getId()|default:"[getId()]"}</td>
            <td>{$res->getDate()|date_format:"%Y-%m-%d"|default:"[getDate()]"}</td>
            <td>{$res->getTime()|default:"[getTime()]"}</td>
            <td>
              {assign var=field value=$res->getField()}
              {if $field neq null}
                {$field->getSport()|default:"[getSport()]"}
              {else}
                [getField()->getSport()]
              {/if}
            </td>
            <td>
              {assign var=client value=$res->getClient()}
              {if $client neq null}
                {$client->getName()|default:"[getName()]"} {$client->getSurname()|default:"[getSurname()]"}
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
