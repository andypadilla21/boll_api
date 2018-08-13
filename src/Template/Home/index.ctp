<?php 
use Cake\Cache\Cache;
$this->layout = 'default';
?>
 <?php echo $this->Html->script('materializejs') ?>
  <style type="text/css">
    @media only screen and (min-width : 993px){.container2{width:100% !important}.container{width:80% !important}}
    .carrucel{
      height:  575px !important
    }
    .imagen{
      height:  550px !important
    }
    #text{
      background-color: rgba(0, 0, 0, 0.5);
      border-radius: 15px 15px 15px 15px;
    }
  </style>
  <div  class="container2">
  <div class="slider carrucel">
    <script language='JavaScript'>
        // Pause slider
            $('.slider').slider('pause');
            // Start slider
            $('.slider').slider('start');
            // Next slide
            $('.slider').slider('next');
            // Previous slide
            $('.slider').slider('prev');
         $(document).ready(function(){
      $('.slider').slider();
    });
    </script>
    <ul class="slides">
    <?php foreach ($bol as $p) { ?>
      <li class="imagen">
        <?= $this->Html->image($p['Imagen'], ['class' => 'responsive-img']); ?> 
        <div class="caption center-align">
          <h3 id="text"><b><?php echo $p['Titulo'] ?></b></h3>
          <div class="row center">
            <?= $this->Html->link('<button class="btn btn-danger waves-effect waves-btn" type="submit" id="submit">Ver Publicación</button>',['controller' => 'Home', 'action' => 'publicacion', $p['codigo_publicacion']],
                        ['escape'    => false])?>
          </div>
        </div>
      </li>
    <?php } ?>
    </ul>
  </div>
  </div>
<div class="container">
  <div class="row">
    <h5 class="header text_b teal-text">Investigación - Extensión</h5>
    <div class="divider blue-grey lighten-4"></div><br>
    <?php  foreach ($index as $p) { ?>
    <div class="col s12 m4 l4">
      <div class="card">
        <div class="card-image waves-effect waves-block waves-light">
          <?= $this->Html->image($p['Imagen'], ['class' => 'activator'])?>
        </div>
        <div class="card-content">
          <span class="card-title activator grey-text text-darken-4"><?php echo substr ($p['Titulo'],0,45)?>...<i class="material-icons right">more_vert</i></span>
          <b align="right"><?= $this->Html->link('Ver Publicación',['controller' => 'Home', 'action' => 'publicacion', $p['codigo_publicacion']])?></b>
        </div>
        <div class="card-reveal">
          <span class="card-title grey-text text-darken-4"><?= $p['Titulo'] ?><i class="material-icons right">close</i></span>
          <p><?= substr ($p['Desarrollo'],0,200)?>[...]</p>
          <b><?= $p['Fecha'] ?></b>
        </div>
      </div>
    </div>
    <?php } ?>
  </div>
  <div class="row">
    <h5 class="header text_b teal-text">Docencia</h5>
    <div class="divider blue-grey lighten-4"></div><br>
    <?php  foreach ($doc as $p) { ?>
    <div class="col s12 m4 l4">
      <div class="card">
        <div class="card-image waves-effect waves-block waves-light">
          <?= $this->Html->image($p['Imagen'], ['class' => 'activator'])?>
        </div>
        <div class="card-content">
          <span class="card-title activator grey-text text-darken-4"><?php echo substr ($p['Titulo'],0,48)?></span>
          <b align="right"><?= $this->Html->link('Ver Publicación',['controller' => 'Home', 'action' => 'publicacion', $p['codigo_publicacion']])?></b>
        </div>
        <div class="card-reveal">
          <span class="card-title grey-text text-darken-4"><?= $p['Titulo'] ?><i class="material-icons right">close</i></span>
          <p><?= substr ($p['Desarrollo'],0,200)?>[...]</p>
          <b><?= $p['Fecha'] ?></b>
        </div>
      </div>
    </div>
    <?php } ?>
  </div>
</div>


