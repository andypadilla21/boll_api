<?php 
use Cake\Cache\Cache;
$this->layout = 'default';
?>
<?php echo $this->Html->script('plugin-min') ?>
<?php echo $this->Html->script('custom-min') ?>
<style type="text/css">
  @media only screen and (min-width : 993px){.container{width:83% !important}}
  }
</style>
<div class="container">
  <br>
  <h5 class="header text_b teal-text">Artículos de Interés</h5>
  <div class="divider blue-grey lighten-4"></div><br>
  <div class="row">
    <?php foreach($int as $p): ?>
      <div class="col s12 m6">
      <div class="card">
        <div class="card-content">
          <p class="card-title activator grey-text text-darken-4"><?php echo substr ($p['Titulo'],0,84)?></p>
          <p align="right"><b><?= $this->Html->link('Leer Artículo <i class="fa fa-plus"></i>',['controller' => 'Home', 'action' => 'publicacion', $p['codigo_publicacion']],
                        ['escape'    => false])?></b></p>
        </div>
      </div>
      </div>
    <?php endforeach;?> 
  </div>
  <br>
  <h5 class="header text_b teal-text">Multimedia</h5>
  <div class="divider blue-grey lighten-4"></div><br>
  <div class="row">
    <?php foreach($multi as $p): ?>
      <div class="col s12 m4 l4">
        <div class="video-container">
          <iframe width="853" height="480" src="<?php echo $p["Url_Link"];?>" frameborder="0" allowfullscreen></iframe>
        </div><br>
      </div>
    <?php endforeach;?> 
</div>
</div>

