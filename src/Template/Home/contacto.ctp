<?php 
use Cake\Cache\Cache;
$this->layout = 'default';
?>
<?php echo $this->Html->css('bootstrap') ?>
<style type="text/css">
  @media only screen and (min-width : 993px){.container{width:83% !important}}
  }
</style>
<div class="container">
<br>
<h5 class="header text_b teal-text">CONTÁCTANOS</h5>
<?= $this->Flash->render('contacto') ?>
<div class="divider blue-grey lighten-4"></div><br>
<div class="row">
  <div class="col l7 s12">
    <?= $this->Form->create(null, ['url' => ['controller' => 'Home', 'action' => 'contacto'], 'class' => '']);?>
      <div class="row">
        <div class="input-field col s6 m6 l6">
          <input name="nombres" type="text" class="validate" required>
          <label>Nombre</label>
        </div>
        <div class="input-field col s6 m6 l6">
          <input name="ciudad" type="text" class="validate">
          <label>Ciudad</label>
        </div>
        <div class="input-field col s6 m6 l6">
          <input name="telefono" type="text" class="validate">
          <label>Teléfono</label>
        </div>
        <div class="input-field col s6 m6 l6">
          <input name="correo" type="email" class="validate" required>
          <label>Correo Electrónico</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <textarea name="mensaje" class="materialize-textarea" required></textarea>
          <label>Mensaje</label>
        </div>
      </div>
        <div class="input-field col s6">
          <div class="text-center">
            <?= $this->Form->button(__('Enviar'),['class'=>'btn btn-block elegant-color'])?>
          </div>
        </div>
     <?= $this->Form->end() ?> 
  </div>
  <div class=""></div>
  <div class="col l5 s12">
    <div class="row">
      <h6 class="teal-text"><b>Boletín Informativo de la Facultad de Ingeniería.</b></h6>
        <p align="justify">Contáctanos y haznos llegar tus sugerencias y/o comentarios con respecto a la información contenida en este sitio web, agradecemos tu colaboración.
        Tus datos están sujetos a las políticas de tratamiento de datos, te responderemos en la mayor brevedad posible.</p>
          <div class="more-address"> 
            <address>
              <strong>Universidad Simón Bolívar.</strong><br>
              Carrera 59 No. 59-6<br>
              Barranquilla, Colombia<br>
              PBX +57 (5) 344 4333<br>
              Fax : +57 (5) 3682892
            </address>
                <address>
                  <b>Correo Electrónico</b><br>
                  <b>facultad.ingenierias@unisimonbolivar.edu.co</b>
                 </address>
          </div>
    </div>
  </div>
</div>
</div>

