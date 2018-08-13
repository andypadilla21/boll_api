<?php 
use Cake\Cache\Cache;
$this->layout = 'menuadmin';
?>
<style type="text/css">
  @media only screen and (min-width : 993px){.container{width:85% !important}}
  }
</style>
 <div class="">
 <div class="row">
 <div class="col s10 right" id="buscar">
 <p class="flow-text"><b>Publicaciones Destacadas</b></p>
    <div class="row">
      <div class="text-center" align="right">
        <ul class="pagination right ">
          <li>
            <?= $this->Paginator->prev('<b class="fa fa-chevron-left"></b>',['escape'=> false])?>
            <?= $this->Paginator->counter(['format' => __('Página {{page}} de {{pages}}')])?>
            <?= $this->Paginator->next('<b class="fa fa-chevron-right"></b>',['escape'=> false])?>
          </li>
        </ul>        
      </div>
    </div>
    Marcar Publicaciones como Destacadas <i class="fa fa-star-o"></i> 
    <ul class="collection">  
    <div class="buscar" id="counter">  
      <?php foreach($pub as $p): ?>
      <?= $this->Form->create(null, ['url' => ['controller' => 'BolPublicacion', 'action' => 'administrar'], 'id' => 'formprueba']);?>
      <a class="collection-item black-text">
        <li>
          <div class="row">
            <div class="col s12 m4 l6">
               <?php echo $p["Titulo"];?>
            </div>
            <div class="col s12 m4 l4">
              <?php echo $p["Fecha"];?>
            </div>
            <div class="col s12 m4 l2">
            <input type="hidden" name="cod" value="<?php echo $p['cod'];?>">
             <?php if($p["d"] == 0){?>
              <button title="Presione para Destacar" class="btn waves-effect waves-light white darken-2" type="submit" name="des" value="1" onchange="enviar()"><i class="fa fa-star-o black-text"></i>
              </button>
             <?php }else{ ?>
              <button title="Destacada" class="btn waves-effect waves-light white darken-2" type="submit" name="des" value="0" onchange="enviar()"><i class="fa fa-star yellow-text"></i>
              </button>
            <?php } ?>
            </div>
          </div>
        </li>
      </a>
      <?= $this->Form->end() ?>
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
  <script type="text/javascript">
    function enviar(){
      var formulario = document.getElementById("formprueba");
      formulario.submit();
    }
  </script>
</div>
  
