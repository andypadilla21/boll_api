<?php 
use Cake\Cache\Cache;
$this->layout = 'login';?>
<?php echo $this->Html->css('bootstrap') ?>
<style type="text/css">
    #test{
    	margin-top: 150px !important;
        margin-bottom: 100px;
    }
 </style>
 <br>
    <div class="container" id="test">
      <div class="row">
            <div align="center">
               <?= $this->Flash->render('login') ?>
               <?= $this->Flash->render('desactivar') ?>
               <h5 class="teal-text"><b>INICIAR SESIÓN</b></h5>
            </div>
            <br>
            <div class="container">
			   <div class="container panel">
				  <div class="container">
				  	<?= $this->Form->create();?>
				      <div class="row">
				      <div class="row">
				        <div class="input-field col s12">
				           <input type="text" name="emailorphone" class="validate" required>
				           <label>Email o Teléfono</label>
				        </div>
				      </div>
				      <div class="row">
				        <div class="input-field col s12">
				          <input type="password" name="Password" class="validate" required>
				          <label>Contraseña</label>
				        </div>
				      </div>
				          <p><?= $this->Html->link('¿No puedes acceder?',array('controller' => 'Home', 'action' => 'login'),['class'=> 'teal-text']);  ?></p>
				      <div class="row">
				        <div class="col s12">
				          <center>
		                    <div class="text-center">
		                        <?= $this->Form->button(__('INICIAR SESIÓN'),['class'=>'btn waves-effect waves-light  teal lighten-1'])?>
		                    </div><br>
		                    <b><?= $this->Html->link('¡Crea una nueva cuenta!',array('controller' => 'BolRegistro', 'action' => 'add'),['class'=> 'teal-text']);  ?></b>
		                </center>
				        </div>
				      </div>
				    <?= $this->Form->end(); ?>
                   </div>
				  </div>  
               </div>  
            </div>
        </div>
      </div>
     </div>