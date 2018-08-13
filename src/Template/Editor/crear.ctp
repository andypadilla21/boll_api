<?php
use Cake\Cache\Cache;
use Cake\Core\Configure;
$this->layout = 'editor';
?>
<style type="text/css">
  @media only screen and (min-width : 993px){.container{width:85% !important}}
  }
</style>
<div class="section scrollspy white" id="work">
    <div class="container responsive">
      <div class="container right">
            <div class="card-content">
                <!--Header-->
                <div class="" align="center">
                <p class="flow-text"><b>Crear Publicación</b></p>
                </div>
            </div>
            <?= $this->Flash->render('registro') ?>
            <div class="row">
            <?= $this->Form->create(null, ['type' => 'file']);?>
            <input type="hidden" name="codigo_User" value="<?= $this->request->session()->read('Auth.User.Cod_User') ?>" readonly required>
            <div class="row">
                <div class="input-field col s12">
                <div class="alert alert-info alert-dismissable">
                  En este espacio podrás enviar tu colaboración publicaciones de interés o eventos, ten en cuenta que tu publicación será evaluada y editada por el coordinador del boletín.  Recuerda informar la procedencia de tu aporte en caso que se requiera. 
                </div>
                </div>
                <div class="input-field col s12">
                  <?php echo $this->Form->input('Titulo',['class'=>'validate','data-success'=>'¡Bien hecho!','required']);?>
                </div>
                <br><br>
                <div class="input-field col s12">
                  <p>Ingresa a continuación el desarrollo de tu publicación, puedes hacer uso de las herramientas de edición de texto</p>
                  <textarea id="ckeditor" class="ckeditor" name="Desarrollo" > </textarea>
                </div>
                <br><br>
                <div class="input-field col s8">
                  <div class="file-field input-field">
                      <div class="btn" title="Añadir Imagen">
                        <i class="fa fa-picture-o"></i>
                        <input type="file" name="Imagen">
                      </div>
                      <div class="file-path-wrapper">
                        <input class="file-path validate" type="text" placeholder="Añade una imagen">
                      </div>
                  </div>
                </div>
                <div class="input-field col s12">
                  <?php echo $this->Form->input('Fuente',['class'=>'validate tooltipped','Placeholder'=>'http://www.ejemplo.com','data-delay'=>'50','data-tooltip'=>'Indicanos la url o el enlace web de referencia','required']); ?>
                </div>
                <div class="input-field col s12">
                   <input type="hidden" name="Usuario" value="<?= $this->request->session()->read('Auth.User.Nombres') ?>" readonly required>
                </div>
                <div class="input-field col s12">
                <center>
                    <div class="text-center">
                        <?= $this->Form->button(__('Enviar para edición'),['class'=>'btn btn-block hoverable elegant-color'])?>
                    </div>
                </center>
                  </div>
              </div>
              <?= $this->Form->end() ?>  
         </div>  
      </div>
    </div>
</div>

