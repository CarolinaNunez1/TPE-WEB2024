{include 'navPublic.tpl'}

<div class="container infoLibro">
    <h2>{$libro->NombreLibro}</h2>
    <li><b>Tipo: </b>{$libro->Tipo}</li>
    <li><b>Sinopsis: </b>{$libro->Sinopsis}</li>
    <li><b>Año de publicaciòn: </b>{$libro->Anio}</li>
</div>

{include 'templates/footer.tpl'}