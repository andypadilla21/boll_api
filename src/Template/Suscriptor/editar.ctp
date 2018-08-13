<?php
use Cake\Core\Configure;
use Cake\Core\Plugin;
$this->layout = 'suscriptor';
?><br><br>
<?php echo $this->Html->script('jquery-3.1.1.min') ?>
<?php echo $this->Html->css('bootstrap') ?>
<?php echo $this->Html->script('bootstrap') ?>
<div class="container">
  <div class="row">
    <div class="col s11 right">
    <?= $this->Flash->render('perfil') ?>
    <div class="row">
      <div class="col s12 ">
        <div class="card-panel">
          <div id="center" class="center">
          <p class="flow-text">Tu Perfil</p>
          <?= $this->Html->image('perfiles/'.$this->request->session()->read('Auth.User.ImgPerfil'), array('class' => 'circle responsive-img'))?>
          <br><h5><?= $this->request->session()->read('Auth.User.Nombres')?>   <?= $this->request->session()->read('Auth.User.Apellidos')?></h5>
          <span><?= $this->request->session()->read('Auth.User.Email')?></span>
          <?= $this->Form->create(null, ['url' => ['controller' => 'Suscriptor', 'action' => 'editar'], 'type' => 'file', 'id' => 'formprueba', 'class' => 'center']);?>
            <div class="file-field input-field">
              <div class="btn-floating waves-effect waves-light green tooltipped" data-position="bottom" data-delay="50" data-tooltip="Actualizar foto de perfil">
              <span><b class="fa fa-pencil"></b></span>
              <input type="file" name="fotoperfil" onchange="enviar()">
              </div>
            </div> 
          </div>
        </div>
      </div>
    </div>
    <?= $this->Flash->render('error') ?>
    <div class="card-panel">
    <div class="card-tabs">
      <ul class="tabs tabs-fixed-width elegant-color">
        <li class="tab"><a class="active  black-text ">Actualizar datos</a></li>
        
        <div class="indicator white-color" style="right: 61.7031px; left: 92.2969px;"></div>
      </ul>
    </div>
    <div class="card-content">
    <div id="refresh" class="active">
      <div class="row">
        <div class="row">
          <div class="col s12">
          <div class="divider"></div>
            <?= $this->Form->create(null, ['url' => ['controller' => 'Suscriptor', 'action' => 'actualizarclave'], 'class' => 'center']);?>
            <br>
            <div class="input-field col s6">
              <input id="Password" name="password" type="password" class="validate" required>
              <label>Contraseña Actual</label>
            </div>
            <?= $this->Flash->render('error') ?>
            <div class="input-field col s6">
              <input name="password1" tabindex="2" id="ConfirmPassword" type="password" class="validate" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" ">
              <label data-error="¡Advertencia!, Tu contraseña debe contener numeros, mayúsculas, minúsculas y mínimo 8 o más caracteres">Nueva Contraseña</label>
            </div>
          </div>
          <br><br>
          <div class="text-center center">
            <button class="btn elegant-color" type="submit">Actualizar</button>
          </div><br>
            <?= $this->Form->end();?>
        </div>
       </div>
    </div>
    </div>
    </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  function enviar(){
      var formulario = document.getElementById("formprueba"); 
      formulario.submit();
  }
</script>