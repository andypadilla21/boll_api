<?php
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;
$this->layout = 'inicio';
?>
<style type="text/css">
  @media only screen and (min-width : 993px){.container{width:85% !important}}
  }
</style>
<div class="section scrollspy white container" id="work">
  <div class="row">
    <div class="col s10 right">
    <?= $this->Form->create($bolPublicacion) ?>
      <div class="row">
      <p class="flow-text"><b><?php echo $p["Nombres"] ?></b></p>
      <div class="text-center" align="right">
        <?php if ($p["Respuesta"] == NULL) { 
          echo '<a href="#" title="Responder" onclick="mostrar();"><i class="fa fa-mail-reply black-text"></i></a>';   
         } ?>  
      </div>
        <input name="Id" type="hidden" value="<?php echo $p["Id"] ?>">
        <br><b>Fecha: </b><?php echo $p["Fecha"] ?>
        <br><b>Correo: </b><?php echo $p["Correo"] ?>
        <br><b>Ciudad: </b><?php echo $p["Ciudad"] ?>
        <br>
        <div class="row">
          <br>
          <div class="input-field col s12">
            <?php echo $p["Mensaje"]?>
          </div>
        </div>
        <div class="row" style="background-color: #eeeeee">
          <br>
          <div class="input-field col s12">
            <?php echo  $p["Respuesta"]?>
          </div>
        </div>
        <div>
            <textarea name="resp" class="materialize-textarea validate" placeholder="Deja tu respuesta aquí" id="resp" style="display: none;" required></textarea>
            <input name="Id" type="hidden" value="<?php echo $p["Id"] ?>">
            <input type="hidden" name="email" value="<?php echo $p["Correo"] ?>">
            <input type="submit" name="Enviar" value="Enviar" id="btn" style="display: none;">
        </div>  
      </div>
      <?= $this->Form->end() ?>   
    </div>
  </div>
</div>
<script type="text/javascript">
  $('#textarea').trigger('autoresize');
  function mostrar(){
    document.getElementById('resp').style.display='block';
    document.getElementById('btn').style.display='block';
  }
</script>

