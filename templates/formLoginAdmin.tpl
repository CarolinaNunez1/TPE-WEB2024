{include 'navPublic.tpl'}

<form method="POST" action="verifyAdmin" class="col-md-4 offset-md-4 mt-4">
    <div class="form-group">
        <input type="text" name="nombre" class="form-control" placeholder="Ingrese el nombre de usuario" autocomplete="none">
    </div>

    <div class="form-group">
        <input type="password" name="password" class="form-control" placeholder="Contraseña">
    </div>

    {if isset($error) && $error}
    <div class="alert alert-dark">
        {$error}
    </div>
    {/if}

    <input type="submit" class="btn btn-primary" value="Iniciar sesión"/>
</form>

