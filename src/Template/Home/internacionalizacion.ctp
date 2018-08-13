<?php 
use Cake\Cache\Cache;
$this->layout = 'default';
?>
<?php echo $this->Html->script('plugin-min') ?>
<?php echo $this->Html->script('custom-min') ?>
<style type="text/css">
  @media only screen and (min-width : 993px){.container{width:83% !important}}
  }
</style><br>
<div class="container">
<div class="row">
      <div class="col s12 m7 l8">
      <h5 class="teal-text">INTERNACIONALIZACIÓN</h5>
      <div class="divider blue-grey lighten-4"></div><br>
      <div class="row">
      <?php foreach ($int as $p) { ?>
      <div class="col s12 m5 l6">
        <?= $this->html->image($p['Imagen'],['url' => array('controller' => 'Home', 'action' => 'publicacion',$p['codigo_publicacion']),'class' => 'responsive-img']); ?>
        <p align="justify"><b><?= $this->Html->link($p["Titulo"],['controller' => 'Home', 'action' => 'publicacion', $p['codigo_publicacion']],['class'=> 'black-text'])?></b></p>
      </div>
      <?php }?>
      </div>
        <ul class="pagination right ">
          <li>
            <?= $this->Paginator->prev('<b class="fa fa-chevron-left"></b>',['escape'=> false])?>
            <?= $this->Paginator->counter(['format' => __('Página {{page}} de {{pages}}')])?>
            <?= $this->Paginator->next('<b class="fa fa-chevron-right"></b>',['escape'=> false])?>
          </li>
        </ul>
      </div>
      <div class="col s12 m5 l4">
      <h5 class="teal-text">Otras Publicaciones</h5><br>
      <div class="row" align="justify">
        <?php  
          foreach ($bol as $p) {
        ?>
          <div class="col s12"><b><?= $this->Html->link($p["Titulo"],['controller' => 'Home', 'action' => 'publicacion', $p['codigo_publicacion']],['class'=> 'black-text'])?></b>
             <div class="divider blue-grey lighten-5"></div><br>
          </div>
        <?php
          }
        ?>
      </div>
      <video class="responsive-video" controls>
          <iframe  src="files/bol.mp4" frameborder="0" allowfullscreen></iframe>
      </video><br>
    </div>
    </div>
</div>

