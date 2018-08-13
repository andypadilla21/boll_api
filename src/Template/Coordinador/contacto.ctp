<?php 
$this->layout = 'inicio';
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
  <p class="flow-text"><b>Mensajes</b></p>
  <div id="cont">
    <ul class="collection">
    <div class="buscar" id="counter">
      <?php foreach($c as $p): ?>
      <?php if ($p->Estado == 1) { ?>
      <a class="collection-item black-text active" href="<?php echo \Cake\Routing\Router::url(array('controller'=>'Coordinador','action'=>'mensaje',$p["Id"]));?>">
        <li>
        <b>
          <div class="row">
            <div class="col s12 m4 l3">
              <?php echo $p->Nombres; ?>
            </div>
            <div class="col s12 m4 l6">
              <?php echo substr ($p['Mensaje'],0,65) ?>
            </div>
            <div class="col s12 m4 l2">
              <?php echo $p->Fecha; ?>
            </div>
            <div>
              <i class="mdi-navigation-more-vert right"></i>
            </div>
          </div>
        </b>
        </li>
      </a>
      <?php }else{ ?>
      <a class="collection-item black-text" href="<?php echo \Cake\Routing\Router::url(array('controller'=>'Coordinador','action'=>'mensaje',$p["Id"]));?>">
        <li>
          <div class="row">
            <div class="col s12 m4 l3">
              <?php echo $p->Nombres;?>
            </div>
            <div class="col s12 m4 l6">
              <?php echo substr ($p->Mensaje,0,65) ?>
            </div>
            <div class="col s12 m4 l2">
              <?php echo $p->Fecha;?>
            </div>
            <div>
              <i class="mdi-navigation-more-vert right"></i>
            </div>
          </div>
        </li>
      </a>
      <?php } ?>
    <?php endforeach;?> 
    </div>
    </ul>
  </div>
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