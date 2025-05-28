{extends file='layouts/base.tpl'}

{block name='title'}Home Page{/block}

{block name='content'}
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
    <a href="{$base_url}/signup" class="btn">Get Started</a>
  </div>
{/block}
