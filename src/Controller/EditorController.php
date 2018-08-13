<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;

class EditorController extends AppController
{
    
    public function initialize(){
        parent::initialize();
        $this->Auth->allow([]);
        if ($this->Auth->user('Rol') != 'Editorial') {
            return $this->redirect(array('controller' => 'Home', 'action' => 'index'));
        }
        $publicacion = TableRegistry::get('bol_publicacion');
        $consulta = $publicacion->find('all')//Contar el número de solicitudes no atendidas
        ->select(['cant' => 'count(*)'])
        ->where(['Estado' => 'En Edición']);
        foreach ($consulta as $key) {
            $cantidad = $key["cant"];
            $this->set('num',$cantidad);
        }           
    }

    public function contacto(){
        $reg = TableRegistry::get('bol_registro');
        $usu = $reg->find('all')
        ->where(['Estado' => 1,]);
        $this->set('reg',$this->paginate($usu));
    }

    public function actualizarclave(){
        if ($this->request->is('post')) {
            $clave = $this->request->data['password'];
            $clave1 = $this->request->data['password1'];
            $userTable = TableRegistry::get('bol_registro');
            
            $user = $userTable->get($this->request->session()->read('Auth.User.Cod_User'));
            if(!empty($clave)){
                $clave = hash('sha512', $clave, false);
                if($user->Password != $clave){
                $this->Flash->error('<div class="alert alert-warning alert-dismissable">
                  Tu clave es incorrecta, verifica e intenta nuevamente.
                </div>', ['key' => 'error','escape' => false]);
                return $this->redirect(array('Controller'=>'Editor','action' => 'perfil'));
                }
                $user->Password = hash('sha512', $clave1, false);
            }
            $userTable->save($user);
            $this->Auth->setUser($user);
            $this->Flash->error('<div class="alert alert-success alert-dismissable">
                  Tus datos se han actualizado.
                  <button aria-hidden="true" data-dismiss="alert" class="close" type="button"> × </button>
                </div>', ['key' => 'perfil','escape' => false]);  
        }
        return $this->redirect(array('controller' => 'Perfil', 'action' => 'index'));
    }

    public function enviadas(){
        $userTable = TableRegistry::get('bol_publicacion');
        $publicacion = $userTable->find()
        ->select(['cat'=>'b.Categoria','cod'=>'c.Cod_Publicacion','Titulo', 'Desarrollo','Imagen','Fecha','codigo_publicacion','Usuario','Enlace','Estado'])
        ->hydrate(false)
        ->join([
            'c' => [
                'table' => 'bol_detalle_publicacion',
                'conditions' => [
                    'c.Cod_Publicacion = bol_publicacion.codigo_publicacion'
                ]
            ]
        ])
        ->join([
            'b' => [
                'table' => 'bol_categoria',
                'conditions' => [
                    'c.Cod_Categoria = b.codigo'
                ]
            ]
        ])
        ->where(['c.Cod_Usuario' => $this->request->session()->read('Auth.User.Cod_User')])
        ->distinct(['c.Cod_Publicacion'])
        ->order(['Fecha' => 'DESC']);
        $this->set('pub',$this->paginate($publicacion));
    }

    public function perfil(){
        if ($this->request->is('post')) {
        $foto = $this->request->data['fotoperfil'];
            if($foto['type']=='image/jpeg' || $foto['type']=='image/gif' || $foto['type']=='image/png'){
                if( $foto['error'] == 0 &&  $foto['size'] > 0){
                    $name = $this->request->session()->read('Auth.User.Cod_User').'.jpeg';
                    $destino = WWW_ROOT.'img'.DS.'perfiles'.DS.$name;
                    $destinothumb = WWW_ROOT.'img'.DS.'perfiles'.DS.$name;
                    
                    if(move_uploaded_file($foto['tmp_name'], $destino)){   
                        list($ancho, $alto) = getimagesize($destino);
                        $nuevoAncho=250;
                        $nuevoAlto=250;
                        /**** abrir imagen******/
                        $info = getimagesize($destino);
                        switch ($info["mime"]){
                            case "image/jpeg":
                                $imagen = imagecreatefromjpeg($destino);
                                break;
                            case "image/gif":
                                $imagen = imagecreatefromgif($destino);
                                break;
                            case "image/png":
                                $imagen = imagecreatefrompng($destino);
                                break;
                            default :
                                echo "Error: No es un tipo de imagen permitido.";
                        }
                        $tipo= $info["mime"];
                        /******/
                        $thumbnail = imagecreatetruecolor($nuevoAncho, $nuevoAlto);  
                        imagecopyresampled($thumbnail , $imagen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                        /****guardar imagen *******/
                        switch ($tipo){
                            case "image/jpeg":
                                imagejpeg($thumbnail, $destinothumb, 95); // El 100 es la calidade de la imagen (entre 1 y 100. Con 100 sin compresion ni perdida de calidad.).
                                break;
                            case "image/jpg":
                                imagejpg($thumbnail, $destinothumb, 95); // El 100 es la calidade de la imagen (entre 1 y 100. Con 100 sin compresion ni perdida de calidad.).
                                break;
                            case "image/gif":
                                imagegif($thumbnail, $destinothumb);
                                break;
                            case "image/png":
                                imagepng($thumbnail, $destinothumb, 9); // El 9 es grado de compresion de la imagen (entre 0 y 9. Con 9 maxima compresion pero igual calidad.).
                                break;
                        }
                        /*****************/
                        $userTable = TableRegistry::get('bol_registro');
                        $user = $userTable->get($this->request->session()->read('Auth.User.Cod_User'));
                        $user->ImgPerfil = $name;
                        $userTable->save($user);
                        $this->Auth->setUser($user);
                        $this->Flash->error('<div class="alert alert-success alert-dismissable">
                          Tus datos se han actualizado.
                          <button aria-hidden="true" data-dismiss="alert" class="close" type="button"> × </button>
                        </div>', [
                                'key' => 'perfil','escape' => false]);
                    }//Fin Move 
                }//Fin Error Size
            }//Fin Type  
        }//Fin Request
    }//Fin Metodo

    public function publicacion($codigo_publicacion = null){
        $bol = TableRegistry::get('bol_categoria');
        $pub2 = $bol->find()->select(['Codigo', 'Categoria']);
        $this->set('bol', $pub2);

        $userTable = TableRegistry::get('bol_publicacion');
        $publicacion = $userTable->find()
        ->select(['cat'=>'b.Categoria','cod'=>'c.Cod_Publicacion','Titulo', 'Desarrollo','Imagen','Fecha','codigo_publicacion','Usuario','Enlace','codigo_User'])
        ->hydrate(false)
        ->join([
            'c' => [
                'table' => 'bol_detalle_publicacion',
                'conditions' => [
                    'c.Cod_Publicacion = bol_publicacion.codigo_publicacion'
                ]
            ]
        ])
        ->join([
            'b' => [
                'table' => 'bol_categoria',
                'conditions' => [
                    'c.Cod_Categoria = b.codigo'
                ]
            ]
        ])
        ->where(['codigo_publicacion' => $codigo_publicacion])->first();
        if(empty($publicacion)){
           return $this->redirect(array('controller' => 'Editor', 'action' => 'inbox'));
        }
        $this->set('p',$publicacion);
    }

    public function editar($codigo_publicacion = null)
    {
        $userTable = TableRegistry::get('bol_publicacion');
        $publicacion = $userTable->find()
        ->select(['cod' => 'd.Cod_Publicacion','Titulo', 'Desarrollo','Imagen','Fecha','codigo_publicacion','Usuario','Enlace','codigo_User'])
        ->hydrate(false)
        ->join([
            'd' => [
                'table' => 'bol_detalle_publicacion',
                'conditions' => ['d.Cod_Publicacion = bol_publicacion.codigo_publicacion']
                   ]
               ])
        ->where(['codigo_publicacion' => $codigo_publicacion])->first();
        $this->set('p',$publicacion);

        if ($this->request->is(['patch', 'post', 'put'])) {
        $foto = $this->request->data['Imagen'];
        if($foto['type']=='image/jpeg' || $foto['type']=='image/gif' || $foto['type']=='image/png'){
                if( $foto['error'] == 0 &&  $foto['size'] > 0){
                    $name = 'Img'.'-'.$foto['name'];
                    $destino = WWW_ROOT.'img'.DS.$name;
                    $destinothumb = WWW_ROOT.'img'.DS.$name;
                    if(move_uploaded_file($foto['tmp_name'], $destino)){ 
                        $nuevoAncho=1280;
                        $nuevoAlto=682;
                        list($ancho, $alto) = getimagesize($destino);
                        /**** abrir imagen******/
                        $info = getimagesize($destino);
                        switch ($info["mime"]){
                            case "image/jpeg":
                                $imagen = imagecreatefromjpeg($destino);
                                break;
                            case "image/gif":
                                $imagen = imagecreatefromgif($destino);
                                break;
                            case "image/png":
                                $imagen = imagecreatefrompng($destino);
                                break;
                            default :
                                echo "Error: No es un tipo de imagen permitido.";
                        }
                        $tipo= $info["mime"];
                        /******/
                        $thumbnail = imagecreatetruecolor($nuevoAncho, $nuevoAlto);  
                        imagecopyresampled($thumbnail , $imagen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                        /****guardar imagen *******/
                        switch ($tipo){
                            case "image/jpeg":
                                imagejpeg($thumbnail, $destinothumb, 80); // El 100 es la calidade de la imagen (entre 1 y 100. Con 100 sin compresion ni perdida de calidad.).
                                break;
                            case "image/gif":
                                imagegif($thumbnail, $destinothumb);
                                break;
                            case "image/png":
                                imagepng($thumbnail, $destinothumb, 9); // El 9 es grado de compresion de la imagen (entre 0 y 9. Con 9 maxima compresion pero igual calidad.).
                                break;
                        }
                        /*****************/
                        $p = $userTable->get($codigo_publicacion);
                        $p->codigo_User = $this->request->data['codigo_User'];
                        $p->Titulo = $this->request->data['Titulo'];
                        $p->Fecha = strtotime("now");
                        $p->Desarrollo = $this->request->data['Desarrollo'];
                        $p->Imagen = $name;
                        $p->Enlace = $this->request->data['Enlace'];
                        $p->Usuario = $this->request->data['Usuario'];
                        $p->Estado = 'Editada';
                            if ($userTable->save($p)) {
                                $detallePub = TableRegistry::get('bol_detalle_publicacion');
                                $cod = $this->request->data['Cod_Publicacion'];
                                $query = $detallePub->query();
                                $query->update()
                                ->set(['Estado' => Editada])
                                ->where(['Cod_Publicacion' => $cod])
                                ->execute();
                                return $this->redirect(['action' => 'Editor','action'=>'inbox']);
                            }//Fin Si
                    }//Fin Move
                }//Fin Error
            }//Fin Type
        }//Fin Request

    }//Fin Método

    public function inbox(){
       $publicacion = TableRegistry::get('bol_publicacion');
        $p = $publicacion->find('all')
        ->order(['Fecha' => 'DESC']);
        $this->set('pub',$this->paginate($p));
    }

    public function multimedia(){
        $publicacion = TableRegistry::get('bol_multimedia');
           $pub = $publicacion->find()
            ->order(['Fecha' => 'DESC'])
            ->where(['Cod_User' => $this->request->session()->read('Auth.User.Cod_User')]);
            $this->set('bol',$this->paginate($pub));

        if ($this->request->is('post')) {
            $multimedia = TableRegistry::get('bol_multimedia');
            $archivo = $multimedia->newEntity();
            $archivo->Url_Link = $this->request->data['Url_Link'];
            $archivo->Cod_User = $this->request->session()->read('Auth.User.Cod_User');
            $archivo->Estado = 'Recibido';
                if ($multimedia->save($archivo)) {
                  return $this->redirect(array('Controller'=>'Editor','action' => 'multimedia'));
                }
        }
    }

    public function borrarvideo(){
        if ($this->request->is('post') ){
            $cod = $this->request->data['cod'];
            $mult = TableRegistry::get('bol_multimedia');
            $query = $mult->query();
            $query->delete()
            ->where(['Codigo' => $cod])
            ->execute();
            return $this->redirect(['action' => 'Editor','action'=>'multimedia']);
        }
    }

    public function crear()
    {
        $bol = TableRegistry::get('bol_categoria');
        $pub2 = $bol->find()->select(['Codigo', 'Categoria']);
        $this->set('bol', $pub2);

        if ($this->request->is('post')) {
            $categoria = $this->request->data['cod_Categoria'];
            $titulo = $this->request->data['Titulo'];
            $desarrollo = $this->request->data['Desarrollo'];
            $foto = $this->request->data['Imagen'];
            $enlace = $this->request->data['Fuente'];
            $usuario = $this->request->data['Usuario'];
           if($foto['type']=='image/jpeg' || $foto['type']=='image/gif' || $foto['type']=='image/png'){
                if( $foto['error'] == 0 &&  $foto['size'] > 0){
                    $name = $this->request->$foto['name'];
                    $destino = WWW_ROOT.'img'.DS.$name;
                    $destinothumb = WWW_ROOT.'img'.DS.$name;
                    
                    if(move_uploaded_file($foto['tmp_name'], $destino)){ 
                        $nuevoAncho=1280;
                        $nuevoAlto=682;
                        list($ancho, $alto) = getimagesize($destino);
                        /**** abrir imagen******/
                        $info = getimagesize($destino);
                        switch ($info["mime"]){
                            case "image/jpeg":
                                $imagen = imagecreatefromjpeg($destino);
                                break;
                            case "image/gif":
                                $imagen = imagecreatefromgif($destino);
                                break;
                            case "image/png":
                                $imagen = imagecreatefrompng($destino);
                                break;
                            default :
                                echo "Error: No es un tipo de imagen permitido.";
                        }
                        $tipo= $info["mime"];
                        /******/
                        $thumbnail = imagecreatetruecolor($nuevoAncho, $nuevoAlto);  
                        imagecopyresampled($thumbnail , $imagen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                        /****guardar imagen *******/
                        switch ($tipo){
                            case "image/jpeg":
                                imagejpeg($thumbnail, $destinothumb, 80); // El 100 es la calidade de la imagen (entre 1 y 100. Con 100 sin compresion ni perdida de calidad.).
                                break;
                            case "image/gif":
                                imagegif($thumbnail, $destinothumb);
                                break;
                            case "image/png":
                                imagepng($thumbnail, $destinothumb, 9); // El 9 es grado de compresion de la imagen (entre 0 y 9. Con 9 maxima compresion pero igual calidad.).
                                break;
                        }
                        /*****************/
                        $pub = TableRegistry::get('bol_publicacion');
                        $p = $pub->newEntity();
                        $p->codigo_User = $this->request->session()->read('Auth.User.Cod_User');
                        $p->Categoria = $categoria;
                        $p->Titulo = $titulo;
                        $p->Fecha = strtotime("now");
                        $p->Desarrollo = $desarrollo;
                        $p->Imagen = $name;
                        $p->Enlace = $enlace;
                        $p->Usuario = $usuario;
                        $p->Estado = "Recibido";
                        if ($pub->save($p)) {
                            return $this->redirect(array('Controller'=>'BolPublicacion','action' => 'inbox'));
                        }
                    }
                    
                }
            }
            
        }
    }//Fin Método crear

    
}
