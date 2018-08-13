<?php
$this->layout = 'menuadmin';
?>
<style type="text/css">
  @media only screen and (min-width : 993px){.container{width:80% !important}}
  }
</style>
<br>
<div class="row">
  <div class="col s10 right">
    <div class="text-center" align="right">
      <ul class="pagination right ">
        <li>
          <?= $this->Paginator->prev('<b class="fa fa-chevron-left"></b>',['escape'=> false])?>
          <?= $this->Paginator->counter(['format' => __('Página {{page}} de {{pages}}')])?>
          <?= $this->Paginator->next('<b class="fa fa-chevron-right"></b>',['escape'=> false])?>
        </li>
      </ul>        
    </div>
    <div class="card-tabs">
    <p class="flow-text"><b>Usuarios</b></p>
      <ul class="tabs tabs-fixed-width grey lighten-5">
        <li class="tab"><a class="black-text" href="#admin">Registrados</a></li>
        <li class="tab"><a class="black-text" href="#registrar">Registrar</a></li>
        <div class="indicator"></div>
      </ul>
    </div><br>
    <div class="card-content">
    <div id="admin">
    <ul class="collection with-header">
    <div  class="buscar" id="counter">
      <?php foreach($reg as $p): ?>
      <a href="<?php echo \Cake\Routing\Router::url(array('controller'=>'BolPublicacion','action'=>'editusuario',$p["Cod_User"]));?>" class="collection-item black-text">
        <li>
          <div class="row">
            <div class="col s12 m4 l1">
              <?= $this->Html->image('perfiles/'.$p['ImgPerfil'], array('class' => 'circle responsive-img'))?>
            </div>
            <div class="col s12 m4 l3">
              <b><?php echo $p['Nombres'];?>
              <br><?php echo $p["Username"]; ?>
            </div>
            <div class="col s12 m4 l4">
              <?php echo $p["Email"];?></b>
              <br>Contacto: <?php echo $p["Telefono"];?>
            </div>
            <div class="col s12 m4 l2">
              <?php echo $p["Rol"];?>
              <?php if($p["Estado"] == 1) {
              echo '<br><br><i class="mdi-action-account-circle" style="color: green"></i>'; 
              } else 
                if($p["Estado"] == 0 || $p["Estado"] == 10) { 
              echo '<br><br><i class="mdi-action-account-circle" style="color: red"></i>'; 
              } ?> 
            </div>
            <div class="col s12 m4 l2">
              <?php echo $p["Tipo_Usuario"];?>
            </div>
          </div>
        </li>
      </a>
      <?php endforeach;?>
    </div>  
    </ul>
    </div>
    <script type="text/javascript">
      $(document).ready(function () {
        (function ($) {
          $('#filtrar').keyup(function () {
            var rex = new RegExp($(this).val(), 'i');
              $('.buscar a').hide();
              $('.buscar a').filter(function () {
              return rex.test($(this).text());
              }).show();
          })
        }(jQuery));
      });
    </script>
  <div id="registrar">
    <?= $this->Flash->render() ?>
    <div class="row">
    <?= $this->Form->create(null, ['url' => ['controller' => 'BolPublicacion', 'action' => 'register'], 'class' => '']);?>
      <div class="row">
        <div class="input-field col s6">
          <input type="text" class="validate"  name="Nombres"  id="Nombres" required>
          <label>Nombres y Apellidos</label> 
        </div>
        <div class="input-field col s6">  
          <select required name="Sexo" id="Sexo">
            <option value="" disabled selected>Seleccionar sexo</option>
            <option value="Masculino">Masculino</option>
            <option value="Femenino">Femenino</option>
          </select>
        </div>
        <div class="input-field col s6">
          <input name="Fecha_Nacimiento" id="Fecha_Nacimiento" type="date"  placeholder="Fecha de Nacimiento" class="validate" required>
        </div>
        <div class="input-field col s6">
          <?php if(!empty($tipodoc)):?>
            <?php echo '<select name="Tipo_Id" id="Tipo_Id" required="">
              <option value="" disabled selected>Seleccionar tipo de documento</option>';?>
                <?php foreach ($tipodoc as $p):?>
                   <?php echo '<option value="'.$p->Codigo.'">'.$p->Tipo.'</option>';?>
                <?php endforeach;?>
            <?php echo '</select>';?>
          <?php endif;?> 
          <script> 
            $(document).ready(function() {
            $('select').material_select();});
          </script>
        </div>
        <div class="input-field col s6">
          <input name="Cod_User" id="Cod_User" type="number" class="validate" required>
          <label>Número de identificación</label>
        </div>
        <div class="input-field col s6">
          <input name="Telefono" id="Telefono" type="tel" class="validate" required pattern="^\d{0,15}$">
          <label  data-error="Escribe un número de teléfono válido">Teléfono</label>
        </div>
        <div class="input-field col s6">
          <input name="Email" id="Email" type="email" class="validate" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$">
          <label data-error="Escribe una direccion de correo válida" data-success="¡Bien hecho!" data-not-empty="¡Completa este campo!">Correo electrónico</label>
        </div>
        <div class="input-field col s6">
          <input name="Username" id="Username" type="text" class="validate" required>
          <label>Usuario</label>
        </div>
        <div class="input-field col s6">
          <input name="Password" id="Password" type="password" class="validate" required>
          <label data-error="¡Advertencia!, tu contraseña debe contener mínimo 8 caracteres">Contraseña</label>
        </div>
        <div class="input-field col s6">  
          <select required name="Tipo_Usuario" id="Tipo_Usuario">
            <option value="" disabled selected>Seleccionar tipo de usuario</option>
            <option value="Estudiante">Estudiante</option>
            <option value="Profesional Universitario">Profesional Universitario</option>
            <option value="Docente">Docente</option>
            <option value="Otro">Otro</option>
          </select>  
        </div>
        <div class="input-field col s6">  
          <select required name="Rol" id="Rol">
            <option value="" disabled selected>Seleccionar Rol</option>
            <option value="Suscriptor">Suscriptor</option>
            <option value="Editor">Editorial</option>
            <option value="Coordinador">Coordinador</option>
            <option value="Administrador">Administrador</option>
          </select>
        </div>
        <div class="input-field col s6">
          <?php if(!empty($pais)):?>
            <?php echo '<select name="Pais" id="Pais" required="">
              <option value="" disabled selected>Selecciona tu país</option>';?>
               <?php foreach ($pais as $p):?>
                <?php echo '<option value="'.$p->Name.'">'.$p->Name.'</option>';?>
              <?php endforeach;?>
            <?php echo '</select>';?>
          <?php endif;?>    
        </div>
        <div class="input-field col s6">
          <input type="text" name="Ciudad" id="Ciudad" required="">
          <label>Ciudad</label> 
        </div>
        <div class="input-field col s6">
          <div class="text-center">
            <?= $this->Form->button(__('Registrar'),['class'=>'btn btn-block hoverable elegant-color'])?>
          </div>
        </div>
      </div>
      <?= $this->Form->end() ?>
     </div>
    </div>
  </div>
</div>

