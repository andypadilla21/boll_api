<?php
$this->layout = 'menuadmin';
?>
<?php echo $this->Html->css('bootstrap') ?>
<style type="text/css">
  @media only screen and (min-width : 993px){.container{width:80% !important}}
  }
</style>
<div class="">
  <div class="row">
    <div class="col s10 right">
    <p class="flow-text"><b>Multimedia</b></p>
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
      <ul class="tabs tabs-fixed-width grey lighten-5">
        <li class="tab"><a class="black-text active" href="#mult">Añadir</a></li>
        <li class="tab"><a class="black-text" href="#galeria">Galería</a></li>
        <div class="indicator black-color" style="right: 61.7031px; left: 92.2969px;"></div>
      </ul>
    </div><br>
  <div class="card-content">
    <div id="galeria" class="active" >
    <?php foreach($bol as $p): ?>
      <div class="row col s8">
        <div class="col col s8 m4 l4">
          <div class="video-container">
            <iframe width="280" height="250" src="<?php echo $p["Url_Link"] ?>" frameborder="0" allowfullscreen>
            </iframe>
          </div>
        </div>
        <div class="col s4 m4 l4">
          <p><b>Usuario:</b> <?php echo $p["nombre"],'  ',$p["apellido"] ?></p>
          <p><b>Fecha:</b> <?php echo $p["Fecha"] ?></p>
          <p><b>Estado:</b> <?php echo $p["Estado"] ?></p>
        </div>
        <div class="col s4 m4 l4">
          <?= $this->Form->create(null, ['url' => ['controller' => 'BolPublicacion', 'action' => 'borrarvideo'], 'id' => 'formprueba']);?>
            <input type="hidden" name="cod" value="<?php echo $p['Codigo'];?>">
            <button title="Borrar" class="btn waves-effect waves-light red darken-2" type="submit" name="del" onchange="enviar()"><i class="mdi-action-delete"></i></button>
          <?= $this->Form->end() ?>
          <br>
        </div>
        <div class="col s4 m4 l4">
          <?= $this->Form->create(null, ['url' => ['controller' => 'BolPublicacion', 'action' => 'videosMultimedia'], 'id' => 'formprueba']);?>
            <?php if($p["Estado"] == 'Recibido'){?>
              <input type="hidden" name="cod" value="<?php echo $p['Codigo'];?>">
              <button title="Publicar y Destacar" class="btn waves-effect waves-light yellow darken-2" type="submit" name="des" value="Publicado" onchange="enviar()"><i class="mdi-action-thumb-up"></i>
              </button>
             <?php }else{ ?>
             <input type="hidden" name="cod" value="<?php echo $p['Codigo'];?>">
              <button title="No destacar" class="btn waves-effect waves-light blue accent-4" type="submit" name="des" value="Recibido" onchange="enviar()"><i class="mdi-action-thumb-down"></i>
              </button>
            <?php } ?>
          <?= $this->Form->end() ?>
        </div>
      </div>
    <?php endforeach;?> 
    </div>
    <div id="mult">
    <br>
      <?= $this->Form->create(null, ['url' => ['controller' => 'BolPublicacion', 'action' => 'multimedia']]);?>
      <div class="row">
      <div class="alert alert-info alert-dismissable">
      Ten en cuenta:
        <li>Añade videos de interés en general (Sugetos a verificación del contenido).</li>
        <li>Puedes seguir los detalles del video sugerido en la pestaña <b>Galería</b>.</li>
        <li>Recuerda indicar la <b>url</b> de procedencia del video.</li>
      </div>
        <div class="input-field col s6">
          <input name="Url_Link" type="url" class="validate" placeholder="http://www.ejemplo.com/video" required>
          <label for="titulo">URL </label>
        </div>
        <div class="input-field col s6">
          <button class="btn waves-effect waves-light"><i class="fa fa-cloud-upload left"></i>Subir</button>
        </div>
      </div>
      <?= $this->Form->end() ?>
    </div>
  </div>
    </div>
  </div>
</div>
</script>
  <?php echo $this->Html->script('jquery-3.1.1.min') ?>
  <script type="text/javascript">
    function enviar(){
      var formulario = document.getElementById("formprueba"); 
      formulario.submit();
    }
  </script>
