<?php 
$this->layout = 'editor';
?>
<style type="text/css">
  @media only screen and (min-width : 993px){.container{width:85% !important}}
  }
</style>
 <div class="">
 <div class="row">
  <div class="col s10 right" id="buscar">
    <div class="row">
      <div class="text-center" align="right">
        <ul class="pagination right">
          <li><?= $this->Paginator->prev('<b class="fa fa-chevron-left"></b>',['escape'=> false])?></li>
          <?= $this->Paginator->counter(['format' => __('Página {{page}} de {{pages}}')])?>
         <?= $this->Paginator->next('<b class="fa fa-chevron-right"></b>',['escape'=> false])?>
        </ul>        
      </div>
    </div>
   <p class="flow-text"><b>Usuarios Registrados</b></p>
    <ul class="collection">
    <div class="buscar" id="counter">
    <?php foreach($reg as $p): ?>
      <a class="collection-item black-text">
        <li>
          <div class="row">
            <div class="col s12 m4 l1">
              <?= $this->Html->image('perfiles/'.$p['ImgPerfil'], array('class' => 'circle responsive-img'))?>
            </div>
            <div class="col s12 m4 l3">
              <b><?php echo $p['Nombres'];?>
              <?php echo $p["Apellidos"];?>
            </div>
            <div class="col s12 m4 l4">
              <?php echo $p["Email"];?></b>
              <br>Contacto: <?php echo $p["Telefono"];?>
            </div>
            <div class="col s12 m4 l2">
              <?php echo $p["Tipo_Usuario"];?>
            </div>
            <div class="col s12 m4 l2">
              <?php echo $p["Rol"];?>
            </div>
          </div>
        </li>
        </a>
    <?php endforeach;?> 
    </div>
    </ul>
  </div>
  </div>
  <script type="text/javascript">
    $(document).ready(function () {
      (function ($) {
        $('#filtrar').keyup(function () {
          var rex = new RegExp($(this).val(), 'i');
            $('.buscar a').hide();
            $('.buscar a').filter(function () {
            return rex.test($(this).text());
            }).show();
        })
      }(jQuery));
    });
  </script>
</div>