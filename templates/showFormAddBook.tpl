 {include 'navAdmin.tpl'}
 
<div class= "container formAgregar">
    <h1 class="titAgreLib"><b>AGREGAR LIBRO</b></h1>
  
    <form action='agregarLibro' method="POST" enctype="multipart/form-data">
      
      <div class="form-group">
        <select class="form-control" name="autor" id="exampleFormControlSelect1">
            <option select>Seleccionar autor</option>
          {foreach $id item=autores}
            
            <option value={$autores->id_autor}>{$autores->nombre_autor}</option>
          
          {/foreach}
        </select>
      
      </div>
      
      <div class= "row">
        
        <div class="form-group col-md-4 agrNomNuevo">
          <input type="text" name="nombreLibro" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nombre del libro" autocomplete="off">
        </div>
        
        <div class="form-group col-md-4">
          <input type="text" name="tipo" class="form-control" id="exampleInputPassword1" placeholder="Tipo" autocomplete="off">
        </div>
        
        <div class="form-group col-md-2">
          <input type="number" name="anio" class="form-control" id="exampleInputPassword1" placeholder="Año" autocomplete="off">
        </div>
  
      </div>
  
        <div class="form-group">
          <input type="text" name="sinopsis" class="form-control" id="exampleInputPassword1" placeholder="Sinopsis" style="HEIGHT: 98px" autocomplete="off">
        </div>

      {if $error}
        <div class="alert alert-warning" role="alert">
            {$error}
        </div>
      {/if}

        <input type="submit" value="Agregar libro" class="btn btn-secondary btn-lg btn-block btnGuardarNuevoLib">
    </form>
</div>