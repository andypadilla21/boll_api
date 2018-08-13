<?php
$this->layout = 'menuadmin';
?>
<?php echo $this->Html->script('easypiechart') ?>
<?php echo $this->Html->script('easypiechart-data') ?>
<style type="text/css">
  @media only screen and (min-width : 993px){.container{width:85% !important}}
  }
</style>
<div class="container">
  <div class="row">
    <p class="col s10 right flow-text"><i class="fa fa-bar-chart nav_icon"></i>  <b>Dashboard</b></p>
    <div class="col s10 right">
      <p><b>Publicaciones</b></p><hr>
        <div class="col s12 m4 l3">
          <p>Total Publicaciones</p>
		      <blockquote><?php echo $num ?></blockquote>
        </div>
        <div class="col s12 m4 l3">
          <p>Publicadas</p>
          <blockquote><?php echo $num2 ?></blockquote>
        </div>
        <div class="col s12 m4 l3">
          <p>En Proceso de Revisión</p>
			    <blockquote><?php echo $can ?></blockquote>
        </div>
        <div class="col s12 m4 l3">
          <p>Porcentaje </p>
          <blockquote><?php echo $porc ?>% publicado</blockquote>
        </div>
    </div>
    <div class="col s10 right">
      <p><b>Categorías</b></p><hr>
        <div class="col s12 m4 l3">
          <p>Investigación Extensión</p>
          <blockquote><?php echo $ninv ?></blockquote>
        </div>
        <div class="col s12 m4 l3">
          <p>Docencia</p>
          <blockquote><?php echo $ndoc ?></blockquote>
        </div>
        <div class="col s12 m4 l3">
          <p>Internacionalización</p>
          <blockquote><?php echo $nint ?></blockquote>
        </div>
        <div class="col s12 m4 l3">
          <p>Conovatorias</p>
          <blockquote><?php echo $nconv ?></blockquote>
        </div>  
    </div>
    <div class="col s10 right">
      <p><b>Usuarios</b></p><hr>
        <div class="col s12 m4 l3">
          <p>Total Registrados</p>
          <blockquote><?php echo $contuser ?></blockquote>
        </div>
        <div class="col s12 m4 l3">
          <p>Usuarios Activos</p>
          <div class="panel-body easypiechart-panel">
            <div class="easypiechart" id="easypiechart-green" data-percent="<?php echo $pp ?>">
              <span class="percent"><?php echo $pp ?>% Activos</span>
            </div>
          </div> 
        </div>
        <div class="col s12 m4 l3">
          <p>Usuarios Inactivos</p>
          <div class="panel-body easypiechart-panel">
            <div class="easypiechart" id="easypiechart-red" data-percent="<?php echo $p ?>">
              <span class="percent"><?php echo $p ?>% inactivos</span>
            </div>
         </div>
        </div>
    </div>
  </div>
</div>