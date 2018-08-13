<?php 
use Cake\Cache\Cache;
$this->layout = 'default';
?>
<style type="text/css">
  @media only screen and (min-width : 993px){.container{width:83% !important}}
  }
</style>
<div class="container">
  <br>
  <h5 class="header text_b teal-text">EVENTOS</h5>
  <div class="divider blue-grey lighten-4"></div><br>
  <div class="row">
      <?php foreach ($e as $p) { ?>
      <div class="col s12 m4 l4">
        <?= $this->html->image($p['Imagen'],['url' => array('controller' => 'Home', 'action' => 'publicacion',$p['codigo_publicacion']),'class' => 'responsive-img']); ?>
        <p><b><?= $this->Html->link($p["Titulo"],['controller' => 'Home', 'action' => 'publicacion', $p['codigo_publicacion']],['class'=> 'black-text'])?></b></p>
      </div>
      <?php }?>
  </div>
</div>
