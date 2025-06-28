{extends file=$layout}

{block name="content"}
<div class="container py-4">
    <div class="card shadow-sm mx-auto" style="max-width: 600px;">
        <div class="card-body">
            <h2 class="card-title text-center mb-4">Prenotazione Campo</h2>

            <form method="POST" action="/reservation/reservationSummary">
                <div class="mb-3">
                    <label class="form-label fw-bold">Campo:</label>
                    <div>{$fieldData.sport} - {$fieldData.terrainType}</div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Data:</label>
                    <div>{$date}</div>
                </div>

                <div class="mb-4">
                    <label for="time" class="form-label">Orario:</label>
                    <select name="time" id="time" class="form-select" required>
                        {foreach $avaiableHours as $hour}
                            <option value="{$hour}">{$hour|regex_replace:"/^0?(\d+):.*$/":"$1:00"}</option>
                        {/foreach}
                    </select>
                </div>

                <input type="hidden" name="field_id" value="{$fieldData.id}">
                <input type="hidden" name="date" value="{$date}">

                <div class="d-grid gap-2 mb-3">
                    <button type="submit" class="btn btn-primary">Prosegui</button>
                    <button type="button" class="btn btn-secondary" onclick="window.history.back()">Torna indietro</button>
                </div>
            </form>
        </div>
    </div>
</div>
{/block}