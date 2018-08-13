<?php 
$this->layout = 'menuadmin';
?>
<?php echo $this->Html->css('bootstrap') ?>
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
          Página <?= $this->Paginator->counter()?>
         <?= $this->Paginator->next('<b class="fa fa-chevron-right"></b>',['escape'=> false])?>
        </ul>        
      </div>
    </div>
   <p class="flow-text"><b>Publicaciones Enviadas</b></p>
    <ul class="collection">
    <div class="buscar" id="counter">
    <?php foreach($pub as $p): ?>
      <?php if ($pub == null) {
        $this->Flash->render('No hay publicaciones');
      }?>
      <a href="<?php echo \Cake\Routing\Router::url(array('controller'=>'BolPublicacion','action'=>'publicacion',$p["codigo_publicacion"]));?>" class="collection-item black-text">
        <li>
          <div class="row">
            <div class="col s12 m4 l3">
              <?php echo $p['Usuario'];?>
            </div>
            <div class="col s12 m4 l6">
              <?php echo $p["Titulo"];?>
            </div>
            <div class="col s12 m4 l2">
              <?php echo $p["Fecha"];?>
              <br><?php echo $p["Estado"];?>
            </div>
            <div>
              <i class="mdi-navigation-more-vert right"></i>
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