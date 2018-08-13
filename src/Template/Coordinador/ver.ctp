<?php
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;
$this->layout = 'inicio';
?>
<?php echo $this->Html->script('materialize') ?>
  <div class="container">
    <div class="row">
      <div class="col s11 right">
        <?= $this->Form->create(null, ['type' => 'file']); ?>
        <p class="flow-text"><b><?php echo $p->Titulo ?></b></p>
        <?php echo $this->Form->input('codigo_User',['type'=>'hidden','value="'.$p->codigo_User.'"']); ?>
        <b>De: </b><?php echo $p->Usuario ?>
        <br><b>Fecha: </b><?php echo $p->Fecha ?>
        <?php echo $this->Form->input('codigo_publicacion',['type'=>'hidden','value="'.$p->codigo_publicacion.'"']);?>
          <div class="row">
            <br>
            <div class="col s12" align="center">
              <div class="card-image">
                <?= $this->Html->image($p["Imagen"], array('class' => 'responsive-img materialboxed','width'=>'450','hight'=>'450'))?>
              </div>
            </div>
            <div class="input-field col s12">
              <?php echo $p["Desarrollo"] ?>
            </div>
            <div class="input-field col s12">
            <a href="<?php echo $p->Enlace; ?>"><?php echo $p->Enlace; ?></a>
            </div>
            <?php if($p["Estado"] == "Recibido"){ ?>
            <div class="input-field col s12">
              <select multiple name="Cod_Categoria[]" required="">
                <option value="" disabled selected>Seleccionar Categoría</option>
                  <?php foreach ($bol as $b):?>
                       <?php echo '<option value="'.$b->Codigo.'">'.$b->Categoria.'</option>';?>
                  <?php endforeach;?>
              </select>
              <script> $(document).ready(function() {
                   $('select').material_select();});
              </script>
            </div>
            <div class="input-field col s12">  
              <select  name="Estado" id="select" onchange="correccion(this.value)" required="">
                <option value="" disabled selected>Cambiar estado</option>
                <option value="En Edición">Aceptada</option>
                <option value="Rechazada">Rechazada</option>
                <option value="Corrección">Correción</option>
              </select>
            </div>
                <script type="text/javascript">
                  function correccion(id){
                    if (id ==  "Corrección" || id == "Rechazada") {
                      $('.cor').show();
                    }
                      if(id == "En Edición"){
                        $('.cor').hidden();
                      }
                  }
                </script>
                <style type="text/css">
                    .cor{
                      display: none;
                    }
                </style>
            <div class="input-field col s12 cor">
              <?php echo $this->Form->textarea('Correccion',['class'=>'materialize-textarea validate','id'=>'cor','placeholder'=>'Indica las correcciones necesarias.']);?>
              <label>Observaciones</label>
            </div>
            <div class="input-field col s12 ">
              <center>
                <div class="text-center">
                  <?= $this->Form->button(__('Guardar'),['class'=>'btn btn-block hoverable elegant-color'])?>
                </div>
              </center>
            </div>
          <?php }?>
          </div>
          <?= $this->Form->end() ?> 
      </div>
    </div>  
  </div>

