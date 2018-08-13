<?php 
$this->layout = 'suscriptor';
?>
<?php echo $this->Html->script('jquery-3.1.1.min') ?>
<?php echo $this->Html->css('bootstrap') ?>
  <style type="text/css">
  @media only screen and (min-width : 993px){.container{width:85% !important}}
  }
  </style>
  <script type="text/javascript">
  $(document).ready(function(){
    var refresh = setTimeout(myFunction,45000);
    $.ajaxSetup({cache: false});
  });
  function myFunction() {
    $.ajax({
      async: true,
      url: '/usbbol/Suscriptor/inbox',
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
<div id="body">
 <div class="row">
  <div class="col s10 right" id="buscar">
    <div class="row">
      <div class="text-center" align="right">
        <ul class="pagination right ">
          <li>
            <b class="green-text fa fa-inbox"></b> <b><?php if($c > 0){ echo 'Hay publicaciones que requieren de su atención'; } ?> </b>
          </li>
          <li>
             <span id="cont"></span>
          </li>
          <li>
            <?= $this->Paginator->prev('<b class="fa fa-chevron-left"></b>',['escape'=> false])?>
            <?= $this->Paginator->counter(['format' => __('Página {{page}} de {{pages}}')])?>
            <?= $this->Paginator->next('<b class="fa fa-chevron-right"></b>',['escape'=> false])?>
          </li>
        </ul>        
      </div>
    </div>  
   <?= $this->Flash->render('ex') ?>
   <?= $this->Flash->render('msj') ?>
   <p class="flow-text"><b>Publicaciones</b></p>
    <ul class="collection">
    <div class="buscar" id="counter">
    <?php foreach($bol as $p): ?>
      <?php if($p["Estado"] == 'Corrección'){?>
      <a  href="<?php echo \Cake\Routing\Router::url(array('controller'=>'Suscriptor','action'=>'editarpublicacion',$p["codigo_publicacion"]));?>" class="collection-item active black-text">
        <li>
          <div class="row">
            <div class="col s12 m4 l3">
              <b><?php echo $p['Usuario'];?></b>
            </div>
            <div class="col s12 m4 l6">
              <b><?php echo $p["Titulo"];?></b>
            </div>
            <div class="col s12 m4 l2">
              <b><?php echo $p["Fecha"];?></b>
              <br><b><?php echo $p["Estado"];?></b>
            </div>
            <div>
              <i class="mdi-navigation-more-vert right"></i>
            </div>
          </div>
        </li>
      </a> 
      <?php }else{ ?>
      <a href="<?php echo \Cake\Routing\Router::url(array('controller'=>'Suscriptor','action'=>'publicacion',$p["codigo_publicacion"]));?>" class="collection-item black-text">
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
</div>