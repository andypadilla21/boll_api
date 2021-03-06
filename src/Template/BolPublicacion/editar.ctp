<?php
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;
$this->layout = 'menuadmin';
?>
<?php echo $this->Html->script('materialize') ?>
<div class="section scrollspy white" id="work">
  <div class="container">
    <div class="row">
      <div class="col s11 right">
          <div class="row">
            <?= $this->Form->create($bolPublicacion) ?>
            <p class="flow-text"><b><?php echo $p["Titulo"]?></b></p>
            <div class="text-center" align="right">
              <?= $this->Form->button(__('Publicar'),['class'=>'btn btn-block hoverable elegant-color tooltipped','data-delay'=>'50','data-tooltip'=>'Publicar'])?>
            </div>
            <input name="codigo_publicacion" type="hidden" value="<?php echo $p["codigo_publicacion"] ?>">
            <input name="Codigo" type="hidden" value="<?php echo $p["cod"] ?>">
            <b>De: </b><?php echo $p["Usuario"] ?>
            <br><b>Fecha: </b><?php echo $p["Fecha"] ?>
            <!-- <br><b>Categoría: </b><?php echo $p["cat"] ?> -->
            <br>
            <div class="col s12" align="center">
              <div class="card-image">
                <?= $this->Html->image($p["Imagen"], array('class' => 'responsive-img materialboxed','width'=>'450','hight'=>'450'))?>
              </div>
            </div>
            <?php echo $this->Form->input('codigo_publicacion',['type'=>'hidden','value="'.$p["codigo_publicacion"].'"']);?>
            <div class="row">
              <br>
              <div class="input-field col s12" align="justify">
                <?php echo $p["Desarrollo"] ?>
              </div>
              <div class="input-field col s12">
                <a href="<?php echo $p["Enlace"];?>"><?php echo $p["Enlace"];?></a>
              </div>
            </div>
            <?= $this->Form->end() ?>  
          </div>  
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $('#textarea').trigger('autoresize');
</script>

