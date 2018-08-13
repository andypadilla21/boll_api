<?php 
use Cake\Cache\Cache;
$this->layout = 'default';
?>
<style type="text/css">
  @media only screen and (min-width : 993px){.container{width:83% !important}}
  }
</style>
<br>
<div class="container" id="contenedor">
<div class="row">
  <div class="col s12 m7 l8"> 
    <div class="col s12 ">
      <h5><b align="justify"><?php echo $p["Titulo"] ?>.</b></h5>
      <div class="divider blue-grey lighten-5"></div>
      <br>
      <?= $this->Html->image($p['Imagen'], ['class' => 'responsive-img'])?>
      <div >
        <ul>
          <li>Colaborador:  <?= $this->Html->image('perfiles/'.$p['img'], array('class' => 'circle responsive-img', 'width'=>'40px'))?><a><?php echo $p["Usuario"];?></a> | <?php echo $p["Fecha"];?></li>
        </ul>
      </div>
      <p>
        <?php echo $p["Desarrollo"]; ?>
      </p>
        <p>Tomado de: <a target="_blank" href="<?php echo $p["Enlace"];?>"><?php echo $p["Enlace"];?></a></p>
    </div> 
     
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
      </div><br>
       <video class="responsive-video" controls>
          <iframe  src="files/bol.mp4" frameborder="0" allowfullscreen></iframe>
       </video>
      
  </div>
</div>
 </div>

