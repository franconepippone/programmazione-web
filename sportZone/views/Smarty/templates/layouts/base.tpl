<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>{block name='title'}My Site{/block}</title>
  <link rel="stylesheet" href="{$base_url}/assets/styles.css">
</head>
<body>

  <header>
    <nav>
      <ul>
        <li><a href="{$base_url}/">Home</a></li>
        <li><a href="{$base_url}/about">About</a></li>
        <li><a href="{$base_url}/contact">Contact</a></li>
      </ul>
    </nav>
  </header>

  <main>
    {block name='content'}{/block}
  </main>

  <footer>
    <p>&copy; {$smarty.now|date_format:"%Y"} My Site. All rights reserved.</p>
  </footer>

</body>
</html>
