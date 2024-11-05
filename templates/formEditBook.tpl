 {include 'navAdmin.tpl'}

<div class= "container formAgregar">
  <h1>Editar libro {$info->nombre_libro}</h1>

  {if $error}
      <div class="alert alert-warning" role="alert">
          {$error}
      </div>
  {/if}

<form action='guardarCambiosLib/{$info->id_libro}' method="POST" enctype="multipart/form-data">
    <div class="form-group">
      <label for="exampleInputEmail1">Nombre del libro</label>
      <input type="text" name="nombreLibro" value="{$info->nombre_libro}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" autocomplete="off">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Tipo</label>
      <input type="text" name="tipo" value="{$info->tipo}" class="form-control" id="exampleInputPassword1" autocomplete="off">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Sinopsis</label>
      <input type="text" name="sinopsis" value="{$info->sinopsis}" class="form-control" id="exampleInputPassword1" autocomplete="off">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Año</label>
      <input type="number" name="anio" value="{$info->anio}" class="form-control" id="exampleInputPassword1" autocomplete="off">
    </div>
      <div class="form-group">
      <label for="exampleFormControlSelect1">Seleccione autor</label>
      <select class="form-control" name="autor" id="exampleFormControlSelect1">
          <option select value={$info->id_autor}>{$info->autor}</option>
        {foreach $autor item=autores}
          <option value={$autores->id_autor}>{$autores->nombre_autor}</option>
      </div>
        {/foreach}
      
      
    <input type="submit" value="Guardar cambios" class="btn btn-primary btnGuardarCambios">
</form>