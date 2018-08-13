<?php
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;
$this->layout = 'suscriptor';
?>
<?php echo $this->Html->script('ckeditor') ?>
<?php echo $this->Html->script('materialize') ?>
<br>
<div class="section scrollspy white" id="work">
  <div class="container">
    <div class="row">
      <div class="col s11 right">
        <?= $this->Flash->render('registro') ?>
        <div class="row">
          <?= $this->Form->create($bolPublicacion) ?>
          <p class="flow-text"><b><?php echo $p["Titulo"] ?></b></p>
          <?php echo $this->Form->input('codigo_User',['type'=>'hidden','value="'.$p["codigo_User"].'"']); ?>
          <input name="Cod_Publicacion" type="hidden" value="<?php echo $p["cod"] ?>">
          <b>De: </b><?php echo $p["Usuario"] ?>
          <br><b>Fecha: </b><?php echo $p["Fecha"] ?>
          <br><b class="header text_b teal-text">Observaciones: </b><?php echo $p["Correccion"] ?>
          <?php echo $this->Form->input('codigo_publicacion',['type'=>'hidden','value="'.$p["codigo_publicacion"].'"']);?>
            <div class="row">
              <br><div class="input-field col s12">
                <?php echo $this->Form->input('Titulo',['class'=>'validate','value="'.$p["Titulo"].'"']);?>
              </div>
              <div class="input-field col s12">
                <input type="hidden" value="<?php echo $p->Fecha ?>" readonly>
              </div>
              <div class="input-field col s12">
                <textarea name="Desarrollo" id="ckeditor" class="ckeditor"><?php echo $p["Desarrollo"] ?></textarea><br><br>
              </div>
              <div class="col s12" align="center">
                 <figure>
                 <?= $this->Html->image($p["Imagen"], array('class' => 'responsive-img materialboxed','width'=>'450','hight'=>'450'))?>
                 </figure> 
              </div>
              <div class="input-field col s12">
                <div class="file-field input-field">
                  <div class="btn">
                    <b>Añadir Imagen</b>
                    <input type="file" name="Imagen" value="<?php echo $p->Imagen ?>">
                  </div>
                  <div class="file-path-wrapper">
                    <input name="Imagen" class="file-path validate" type="text" value="<?php echo $p["Imagen"] ?>">
                  </div>
                </div>
              </div><br>
              <div class="input-field col s12">
                <div align=right>
                <a class="tooltipped" align=right href="https://goo.gl/" target="_blank" data-position="bottom" data-delay="50" data-tooltip="Presiona aquí para acortar la URL">Acortar enlace</a>
                </div>
                <?php echo $this->Form->input('Enlace',['class'=>'validate','value="'.$p["Enlace"].'"']); ?>
              </div>
              <div class="input-field col s12">
                <b><?php echo $this->Form->control('Usuario',['type'=>'hidden','value="'.$p["Usuario"].'"']);?></b>
              </div>
              <div class="input-field col s12">
                <center>
                  <div class="text-center">
                    <?= $this->Form->button(__('Enviar'),['class'=>'btn btn-block hoverable elegant-color'])?>
                  </div>
                </center>
              </div>
            </div>
          <?= $this->Form->end() ?>  
        </div>  
      </div>
    </div>
  </div>
</div>

