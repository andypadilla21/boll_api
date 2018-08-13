<?php
use Cake\Cache\Cache;
$this->layout = 'inicio';
?><br><br>

<?php echo $this->Html->script('bootstrap') ?>
<div class="container">
  <div class="row">
    <div class="col s11 right">
       <?= $this->Flash->render('perfil') ?>
      <div class="row">
        <div class="col s12 ">
          <div class="card-panel center">
            <p class="flow-text"><b>Tu Perfil</b></p>
            <?= $this->Html->image('perfiles/'.$this->request->session()->read('Auth.User.ImgPerfil'), array('class' => 'circle responsive-img'))?>
            <br><h5><?= $this->request->session()->read('Auth.User.Nombres')?>   <?= $this->request->session()->read('Auth.User.Apellidos')?></h5>
            <span><?= $this->request->session()->read('Auth.User.Email')?></span>
            <?= $this->Form->create(null, ['url' => ['controller' => 'Coordinador', 'action' => 'editar'], 'type' => 'file', 'id' => 'formprueba', 'class' => 'center']);?>
            <div class="file-field input-field">
               <div class="btn-floating waves-effect waves-light green tooltipped" data-position="bottom" data-delay="50" data-tooltip="Actualizar foto de perfil">
                 <span><b class="fa fa-pencil"></b></span>
                 <input type="file" name="fotoperfil" onchange="enviar()">
               </div>
            </div> 
            <?= $this->Form->end() ?>
          </div>
        </div>
      </div>
        <?= $this->Flash->render('error') ?>
    </div>
  </div>
</div><!--Contenedor-->
<div class="container">
  <div class="row">
    <div class="col s11 right card-panel">
       <?= $this->Flash->render('perfil') ?>
      <div class="row">
        <div class="col s12">
        <p><b>Actualizar Contraseña</b></p>
          <div class="divider"></div>
          <?= $this->Form->create(null, ['url' => ['controller' => 'Coordinador', 'action' => 'actualizarclave']]);?>
          <div class="input-field col s6">
            <input id="Password" name="password" type="password" class="validate" required>
            <label>Contraseña Actual</label>
          </div>
          <?= $this->Flash->render('error') ?>
          <div class="input-field col s6">
            <input name="password1" id="ConfirmPassword" type="password" class="validate" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" ">
            <label data-error="Incluye números, mayúsculas, minúsculas, mínimo 8 caracteres">Nueva Contraseña</label><br><br>
          </div>
          <div class="text-center center">
            <button class="btn elegant-color" type="submit">Actualizar</button>
          </div><br>
          <?= $this->Form->end() ?>
        </div>
      </div>
      <div class="col s12">
        <?= $this->Html->link('<i class="fa fa-stop nav_icon"></i> Desactivar mi cuenta',['controller'=>'Coordinador','action'=>'desactivar','class' => 'red-text'],['escape'    => false])?>
      </div><br>
    </div>
  </div>
</div><!--Contenedor-->
<script type="text/javascript">
  function enviar(){
      var formulario = document.getElementById("formprueba"); 
      formulario.submit();
  }
  function desactivar(){
      var formulario = document.getElementById("desactivar"); 
      formulario.submit();
  }
</script>