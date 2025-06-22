<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <title>Elenco Prenotazioni</title>
  <style>
    body { font-family: 'Inter', sans-serif; background: #f5faff; padding: 2rem; }
    h1 { text-align: center; color: #0d47a1; }
    form { margin-bottom: 1.5rem; text-align: center; }
    input { margin: 0 0.5rem; padding: 0.4rem; }
    button { padding: 0.4rem 1rem; background-color: #1565c0; color: white; border: none; border-radius: 4px; cursor: pointer; }
    button:hover { background-color: #0d47a1; }
    table { width: 100%; border-collapse: collapse; }
    th, td { padding: 0.8rem; border-bottom: 1px solid #ccc; text-align: left; }
    th { background-color: #1565c0; color: white; }
    tr:hover { background-color: #e3f2fd; }
  </style>
</head>
<body>
  <h1>Elenco Prenotazioni</h1>

  <form method="get" action="">
    <input type="date" name="date" value="{$filters.date|escape}" placeholder="Data">
    <input type="text" name="sport" value="{$filters.sport|escape}" placeholder="Sport">
    <input type="text" name="client" value="{$filters.client|escape}" placeholder="Nome cliente">
    <button type="submit">Filtra</button>
  </form>

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
          <td>{$res->getDate()|date_format:"%Y-%m-%d"}</td>
          <td>{$res->getTime()|default:"[getTime()]"} </td>
          <td>{$res->getField()->getSport()|default:"[getSport()]"}</td>
          <td>
            {if $res->getClient() neq null}
              {$res->getClient()->getName()|default:"[getName()]"} {$res->getClient()->getSurname()|default:"[getSurname()]"}
            {else}
              [getClient()->getName()] [getClient()->getSurname()]
            {/if}
          </td>
        </tr>
      {/foreach}
    </tbody>
  </table>
</body>
</html>
