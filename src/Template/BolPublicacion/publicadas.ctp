<?php 
$this->layout = 'menuadmin';
?>

  <style type="text/css">
  @media only screen and (min-width : 993px){.container{width:85% !important}}
  }
  </style>
  <script type="text/javascript">
  /**
  * Llamada a obj XMLHttpRequest.
  * @constructor
  */
  $(document).ready(function(){
    var refresh = setTimeout(myFunction,50000);
    $.ajaxSetup({cache: false});
  });
  function myFunction() {
    $.ajax({
      async: true,
      url: "/usbbol/BolPublicacion/publicadas",
      type: "GET",
      dataType:"html",
        success: function(data){
          $('body').html(data);
          console.clear();
        },
        error : function(objXMLHttpRequest) {
        console.warn("error",objXMLHttpRequest);
        }           
    }); 
  }
  </script>
<body>
 <div class="row">
  <div class="col s10 right" id="buscar">
    <div class="row">
      <div class="text-center" align="right">
        <ul class="pagination right">
          <li>
             <span id="cont"></span>
          </li>
          <li><?= $this->Paginator->prev('<b class="fa fa-chevron-left"></b>',['escape'=> false])?>
            <?= $this->Paginator->counter(['format' => __('Página {{page}} de {{pages}}')])?>
         <?= $this->Paginator->next('<b class="fa fa-chevron-right"></b>',['escape'=> false])?>
          </li>
          
        </ul>        
      </div>
    </div>
   <p class="flow-text"><b>Solicitudes de Publicación</b></p>
    <ul class="collection">
    <div class="buscar">
    <?php foreach($bol as $p): ?>
      <?php if($p["Estado"] == 'Editada'){?>
      <a  href="<?php echo \Cake\Routing\Router::url(array('controller'=>'BolPublicacion','action'=>'editar',$p["codigo_publicacion"]));?>" class="collection-item active black-text" title="Sin atender">
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
      <a href="<?php echo \Cake\Routing\Router::url(array('controller'=>'BolPublicacion','action'=>'publicacion',$p["codigo_publicacion"]));?>" class="collection-item black-text" title="Atendida">
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
  //<![CDATA[
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
    //]]>
  </script>
</body>
 