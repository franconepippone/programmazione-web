<div class="container py-4" style="max-width: 900px;">
        <h2 class="mb-4">Gestisci Campi Sportivi</h2>

        <form class="row g-3 mb-1" method="GET" action="/dashboard/manageFields">
            <div class="col-md-4">
                <label for="fieldName" class="form-label">Nome:</label>
                <input type="text"
                       class="form-control"
                       id="fieldName"
                       name="name"
                       value="{$title}"
                       placeholder="Nome campo"
                       oninput="filterFields()">
            </div>

            <div class="col-md-4">
                <label for="sport" class="form-label">Sport:</label>
                {include file="field/sport_selection.tpl"}
            </div>

            <div class="col-md-4 d-flex align-items-end gap-2">
                <button type="submit" class="btn btn-primary">Cerca</button>
                <a href="/field/createFieldForm" class="btn btn-outline-primary">Crea Campo</a>
            </div>
        </form>
    </div>
        
    <div class="container-fluid px-5">
        <hr>
        <h4 class="mb-4">Risultati:</h4>
        {if $fields|@count > 0}
            <div class="row row-cols-1 row-cols-md-3 g-4" id="fields-list">
                {foreach $fields as $field}
                    <div class="col field-card" data-field-title="{$field.name|lower|escape}">
                        {assign var="fieldUrl" value="/field/modifyField/{$field.id}"}
                        {include file="field/field_card.tpl" field=$field}
                    </div>
                {/foreach}
            </div>
            <div class="alert alert-warning mt-4" role="alert" id="no-fields-alert" style="display:none;">
                Nessun campo trovato.
            </div>
        {else}
            <div class="alert alert-warning mt-4" role="alert">
                Nessun campo trovato.
            </div>
        {/if}
    </div>

    {literal}
    <script>
    function filterFields() {
        const input = document.getElementById('fieldName').value.toLowerCase().trim();
        const cards = document.querySelectorAll('.field-card');
        let visibleCount = 0;
        cards.forEach(card => {
            const title = card.getAttribute('data-field-title');
            if (!input || (title && title.includes(input))) {
                card.style.display = '';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });
        var alert = document.getElementById('no-fields-alert');
        if (alert) {
            alert.style.display = visibleCount === 0 ? '' : 'none';
        }
    }
    </script>
    {/literal}