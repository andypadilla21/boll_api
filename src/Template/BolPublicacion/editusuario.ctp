<?php
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;
$this->layout = 'menuadmin';
?>
<div class="section scrollspy white" id="work">
  <div class="">
    <div class="row">
      <div class="col s10 right">
        <?= $this->Form->create(null, ['url' => ['controller' => 'BolPublicacion', 'action' => 'editusuario'], 'class' => '']);?>
        <div class="row">
          <p class="flow-text"><b>Datos de Usuario</b></p>
          <input type="hidden" name="Cod_User" value="<?php echo $p["Cod_User"] ?>">
          <div class="col s10 center">
            <?= $this->Html->image('perfiles/'.$p['ImgPerfil'], array('class' => 'circle responsive-img'))?> <br>
            <b><?php echo $p["Nombres"] ?>  <?php echo $p["Apellidos"] ?></b>
          </div><br>
          <div class="col s6">
             <p><b>Sexo</b></p>  
            <?php echo $p["Sexo"] ?>
          </div>
          <div class="col s6">
            <p><b>Número de identificación</b></p>
            <?php echo $p["Cod_User"] ?>
          </div>
          <div class="col s6">
            <p><b>Fecha de Nacimiento</b></p>  
            <?php echo $p["Fecha_Nacimiento"] ?>
          </div>
          <div class="col s6">
            <p><b>Teléfono</b></p>
            <?php echo $p["Telefono"] ?>
          </div>
          <div class="col s6">
            <p><b>Email</b></p>
            <?php echo $p["Email"] ?>      
          </div>
          <div class="col s6">
            <p><b>Usuario</b></p>
            <?php echo $p["Username"] ?>
          </div>
          <div class="col s6">
            <p><b>Tipo de Usuario</b></p>  
            <?php echo $p["Tipo_Usuario"] ?>
          </div>
          <div class="col s6">
            <p><b>Fecha de Registro</b></p>  
            <?php echo $p["Fecha_Registro"] ?>
          </div>
          <div class="col s6">
            <p><b>País</b></p>
            <?php echo $p["Pais"] ?>     
          </div>
          <div class="col s6">
            <p><b>Ciudad</b></p>
            <?php echo $p["Ciudad"] ?>  
          </div>
          <br><br><br><br>
        </div>
          <?php if($p["Estado"] == 1) { ?>
          <p><b>Cambiar Rol de Usuario</b></p>
          <div class="col s6">
            <select required name="Rol" id="Rol" type="text">
              <option value="<?php echo $p["Rol"] ?>" ><?php echo $p["Rol"] ?></option>
              <option value="Suscriptor">Suscriptor</option>
              <option value="Editor">Editor</option>
              <option value="Coordinador">Coordinador</option>
              <option value="Administrador">Administrador</option>
            </select>
              <script> $(document).ready(function() {
                   $('select').material_select();
              });</script>
          </div>
          <div class="col s6">
            <div class="text-center">
              <?php echo $this->Form->button(__('Guardar'),['class'=>'btn btn-block hoverable elegant-color']);?>
            </div>
          </div>
          <div class="col s12">
             <?php   echo $this->Html->link('<i class="fa fa-stop nav_icon"></i> Desactivar Cuenta',['controller'=>'BolPublicacion','action'=>'desactivar',$p["Cod_User"]],['escape' => false]);?> 
          </div>
          <?php }else{?>
          <div class="col s12">
            <?php   echo $this->Html->link('<i class="fa fa-stop nav_icon"></i> Habilitar Cuenta',['controller'=>'BolPublicacion','action'=>'desactivar',$p["Cod_User"]],['escape' => false]);?> 
          </div>
          <?php } ?> 
        <?= $this->Form->end() ?>
      </div>
    </div>
  </div>
</div>