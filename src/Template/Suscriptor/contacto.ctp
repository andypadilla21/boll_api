<?php
$this->layout = 'suscriptor';
?>
<?php echo $this->Html->script('ckeditor') ?>
<style type="text/css">
  @media only screen and (min-width : 993px){.container{width:85% !important}}
  }
</style>
<?php echo $this->Html->css('bootstrap') ?>
<div class="section scrollspy white" id="work">
    <div class="container responsive">
      <div class="container right">
        <p class="flow-text"><b>Contacto</b></p>
        <?= $this->Flash->render('registro') ?>
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
         </div>  
      </div>
    </div>
</div>

