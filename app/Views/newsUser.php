<div class="container" >
    <br>
      <center><h2 class="titlePrin">Ingrese los datos del usuario</h2></center>
      <br>
        <form method="POST" action="<?php echo APP_URL; ?>/app/Model/newUser.php" enctype="multipart/form-data">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputEmail4">Nombre y apellido:</label>
                <input type="text" class="form-control" name="nombre" placeholder="Ingrese el nombre" required>
              </div>
             
              <div class="form-group col-md-6">
                <label for="inputEmail4">Nombre del usuario:</label>
                <input type="text" class="form-control" name="usuario" placeholder="Ingrese el usuario" required>
              </div>
             
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputEmail4">Correo Electronico:</label>
                <input type="email" class="form-control" name="correo" placeholder="Ingrese el correo" required>
              </div>
              <div class="form-group col-md-6">
                <label for="inputEmail4">Numero de telefono:</label>
                <input type="number" class="form-control" id="inputEmail4" placeholder="Ingrese el numero de telefono" name="telefono" required>
              </div>
           
             
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputEmail4">Ingrese su contraseña:</label>
                <input type="password" class="form-control" name="password" placeholder="Ingrese la contraseña" required>
              </div>
              <div class="form-group col-md-6">
                <label for="inputState">Rol del Usuario</label>
                <select class="form-control" name="rol" id="sector" required>
                  <option value="" disabled selected>Seleccione un rol</option>
                  <option value="Admin">Administrador</option>
                  <option value="User">Usuario</option>
        
                </select>
              </div>
             
             
            </div>
          
         
         

        
      
           
            <button type="submit" class="btn btn-outline-primary">Guardar Producto</button>
            <a href="<?php echo APP_URL; ?>/app/Views/usuario.php" class="btn btn-outline-secondary">Cancelar</a>
            <br>
          </form>
    <br>
    </div>
   