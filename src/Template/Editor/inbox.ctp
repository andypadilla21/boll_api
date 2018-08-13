<?php 
$this->layout = 'editor';
?>
 <style type="text/css">
  @media only screen and (min-width : 993px){.container{width:85% !important}}
  }
</style>
 <div id="body">
 <div class="row">
  <div class="col s10 right" id="buscar">
    <div class="row">
      <div class="text-center" align="right">
        <ul class="pagination right">
          <li>
            <?php foreach($cont as $key){ ?>
            <b class="green-text fa fa-inbox"></b> <b><?php echo $key['cant'];?> Solicitudes requieren de su atención</b> 
            <?php } ?>
          </li>
          <li>
             <span id="cont"></span>
          </li>
          <li><?= $this->Paginator->prev('<b class="fa fa-chevron-left"></b>',['escape'=> false])?></li>
          <?= $this->Paginator->counter(['format' => __('Página {{page}} de {{pages}}')])?>
         <?= $this->Paginator->next('<b class="fa fa-chevron-right"></b>',['escape'=> false])?>
        </ul>        
      </div>
    </div>
  <script type="text/javascript">
      $(document).ready(function(){
        var refresh = setTimeout(myFunction,45000);
        $.ajaxSetup({cache: false});
      });
      function myFunction() {
        $.ajax({
          async: true,
          url: '/usbbol/Editor/inbox',
          type: "GET",
          dataType:"html",
            success: function(data){
              $('body').html(data);
            },
            error : function(objXMLHttpRequest) {
            console.log("error",objXMLHttpRequest);
            }           
        }); 
      }
  </script>
   <p class="flow-text"><b>Bandeja de Entrada</b></p>
    <ul class="collection">
    <div class="buscar" id="counter">
    <?php foreach($pub as $p): ?>
      <?php if($p["Estado"] == 'En Edición'){?>
      <a href="<?php echo \Cake\Routing\Router::url(array('controller'=>'Editor','action'=>'editar',($p["codigo_publicacion"])));?>" >
        <li>
        <b>
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
        </b>
        </li>
      </a> 
      <?php }else{ ?>
      <a href="<?php echo \Cake\Routing\Router::url(array('controller'=>'Editor','action'=>'publicacion',$p["codigo_publicacion"]));?>" class="collection-item black-text">
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
    <?php } ?>
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