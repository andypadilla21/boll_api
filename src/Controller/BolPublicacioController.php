<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Mailer\MailerAwareTrait; 

class BolPublicacionController extends AppController
{
    var $paginate = [
        'limit' => 15,
        'order' => ['BolPublicacion.Fecha' => 'desc'],
        'group by' => ['BolPublicacion.Estado']
    ];
    var $imp = 0;
    public function initialize()
    {
        parent::initialize();
        $p = TableRegistry::get('bol_publicacion');
        $cont = $p->find()
        ->select(['cant'=>'COUNT(*)','Estado'])
        ->where(['Estado' => 'Editada']);
        $this->set('cont',$cont);
        foreach ($cont as $key) {
            $i = $key["cant"];
            $this->set('contador',$i);
        }
    }
    
    public function logout(){
        $this->Auth->logout();
        return $this->redirect(array('controller' => 'Home', 'action' => 'index'));
    }

    public function estadisticas(){
        $p = TableRegistry::get('bol_publicacion');
        $dp = TableRegistry::get('bol_detalle_publicacion');
        $user = TableRegistry::get('bol_registro');
        $cont = $p->find()
        ->select(['cant'=>'COUNT(*)']);
        foreach ($cont as $key) {
            $imp = $key["cant"];
            $this->set('num',$imp);
        }
        $cont = $p->find()
        ->select(['cant2'=>'COUNT(*)','Estado'])
        ->where(['Estado' => 'Publicada']);
        foreach ($cont as $key) {
            $totalpub = $key['cant2'];
           $this->set('num2',$totalpub);
        }
        $cont = $p->find() //Contar número de publicaciones no atendidas
        ->select(['can'=>'COUNT(*)','Estado'])
        ->where(['Estado' => 'Recibido'])
        ->orWhere(['Estado' => 'Editada'])->orWhere(['Estado' => 'En Edicion']);
        foreach ($cont as $key) {
            $totalpub = $key['can'];
           $this->set('can',$totalpub);
        }
        $cont = $p->find()
        ->select(['cantidad'=>'COUNT(*)','Estado'])
        ->where(['Estado' => 'Publicada']);
        foreach ($cont as $key) {
            $total = $key['cantidad'];
            $porc = ($total/$imp)*100;
            $graf1 = round($porc);
            $this->set('porc',$graf1);
        }
        $cont = $dp->find()
        ->select(['inv'=>'COUNT(*)','Cod_Categoria','Estado'])
        ->where(['Estado' => 'Publicada','Cod_Categoria' => 10]);
        foreach ($cont as $key) {
            $totalinv = $key['inv'];
           $this->set('ninv',$totalinv);
        }
        $cont = $dp->find()
        ->select(['doc'=>'COUNT(*)','Cod_Categoria','Estado'])
        ->where(['Estado' => 'Publicada','Cod_Categoria' => 11]);
        foreach ($cont as $key) {
            $totaldoc = $key['doc'];
           $this->set('ndoc',$totaldoc);
        }
        $cont = $dp->find()
        ->select(['int'=>'COUNT(*)','Cod_Categoria','Estado'])
        ->where(['Estado' => 'Publicada','Cod_Categoria' => 12]);
        foreach ($cont as $key) {
            $totalint = $key['int'];
           $this->set('nint',$totalint);
        }
        $cont = $dp->find()
        ->select(['conv'=>'COUNT(*)','Cod_Categoria','Estado'])
        ->where(['Estado' => 'Publicada','Cod_Categoria' => 13]);
        foreach ($cont as $key) {
            $totalconv = $key['conv'];
           $this->set('nconv',$totalconv);
        }
        $cont = $user->find()
        ->select(['cont'=>'COUNT(*)','Estado']);
        foreach ($cont as $key) {
            $totaluser = $key['cont'];
           $this->set('contuser',$totaluser);
        }
        $cont = $user->find()
        ->select(['cont'=>'COUNT(*)','Estado'])->where(['Estado' => 0])->orWhere(['Estado' => 10]);
        foreach ($cont as $key) {
            $total = $key['cont'];
            $porc = ($total/$totaluser)*100;
            $graf1 = round($porc);
            $this->set('p',$graf1);
        }
        $cont = $user->find()
        ->select(['cont'=>'COUNT(*)','Estado'])->where(['Estado' => 1]);
        foreach ($cont as $key) {
            $total = $key['cont'];
            $porc = ($total/$totaluser)*100;
            $graf1 = round($porc);
            $this->set('pp',$graf1);
        }
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

    public function actualizarclave(){
        if ($this->request->is('post')) {
        $clave = $this->request->data['password'];
        $clave1 = $this->request->data['password1'];
        $userTable = TableRegistry::get('bol_registro');
            $user = $userTable->get($this->request->session()->read('Auth.User.Cod_User'));
            if(!empty($clave)){
                $c = hash('sha512', $clave, false);
                if($user->Password != $c){
                    $this->Flash->error('<div class="alert alert-warning alert-dismissable">
                  Tu clave es incorrecta, verifica e intenta nuevamente.
                </div>', [
                        'key' => 'error','escape' => false]);
                    return $this->redirect(array('Controller'=>'BolPublicacion','action' => 'perfil'));
                }else{
                   $user->Password = hash('sha512', $clave1, false);
                   $user->confirmPassword = hash('sha512', $clave1, false);
                   $userTable->save($user);
                 $this->Flash->error('<div class="alert alert-success alert-dismissable">
                  Tus datos se han actualizado.
                  <button aria-hidden="true" data-dismiss="alert" class="close" type="button"> × </button>
                </div>', [
                        'key' => 'perfil','escape' => false]);  
                }
            }
            
            return $this->redirect(array('Controller'=>'BolPublicacion','action' => 'perfil'));
            $this->Auth->setUser($user);  
        }
    }

    public function desactivar($Cod_User = null){
        $userTable = TableRegistry::get('bol_registro');
        $estado = $userTable->get($Cod_User);
        if ($estado->Estado == 1) {
            $query = $userTable->query();
            $query->update()
            ->set(['Estado' => 10])
            ->where(['Cod_User' => $Cod_User])
            ->execute();
            return $this->redirect(array('controller'=>'BolPublicacion','action' => 'register')); 
        }else{
            $query = $userTable->query();
            $query->update()
            ->set(['Estado' => 1])
            ->where(['Cod_User' => $Cod_User])
            ->execute();
            return $this->redirect(array('controller'=>'BolPublicacion','action' => 'register')); 
        }
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
                                imagejpeg($thumbnail, $destinothumb, 100); // El 100 es la calidade de la imagen (entre 1 y 100. Con 100 sin compresion ni perdida de calidad.).
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
                    }
                    
                }
           }
            
        } 
    }

    public function videosMultimedia(){
        if ($this->request->is('post') ){
            $cod = $this->request->data['cod'];
            $des = $this->request->data['des'];
            $mult = TableRegistry::get('bol_multimedia');
            $detalle = $mult->get($cod);
            $detalle->Estado = $des;
            if ($mult->save($detalle)) {
                return $this->redirect(array('Controller'=>'BolPublicacion','action' => 'multimedia'));
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
            return $this->redirect(['action' => 'BolPublicacion','action'=>'multimedia']);
        }
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
                  return $this->redirect(array('Controller'=>'BolPublicacion','action' => 'multimedia'));
                }
        }
    }

    public function publicadas(){
        $publicacion = TableRegistry::get('bol_publicacion');
        $pub = $publicacion->find()
        ->select(['cat'=>'b.Categoria','cod'=>'c.Codigo','Estado'=>'c.Estado','Titulo','Desarrollo','Imagen','Fecha','codigo_publicacion','Usuario'])
        ->hydrate(true)
        ->join([
            'c' => [
                'table' => 'bol_detalle_publicacion',
                'type' => 'LEFT',
                'conditions' => [
                    'c.Cod_Publicacion = bol_publicacion.codigo_publicacion'
                ]
            ]
        ])
        ->join([
            'b' => [
                'table' => 'bol_categoria',
                'type' => 'LEFT',
                'conditions' => [
                    'c.Cod_Categoria = b.codigo'
                ]
            ]
        ])
        ->distinct(['c.Cod_Publicacion'])
        ->order(['Fecha' => 'DESC']);
        $this->set('bol',$this->paginate($pub));
        
    }

    public function publicacion($codigo_publicacion = null){
        $bol = TableRegistry::get('bol_categoria');
        $pub2 = $bol->find()->select(['Codigo', 'Categoria']);
        $this->set('bol', $pub2);

        $userTable = TableRegistry::get('bol_publicacion');
        $publicacion = $userTable->find()
        ->select(['cat'=>'b.Categoria','cat'=>'b.Categoria','cod'=>'c.Cod_Publicacion','Titulo', 'Desarrollo','Imagen','Fecha','codigo_publicacion','Usuario','Enlace','codigo_User'])
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
           return $this->redirect(array('controller' => 'BolPublicacion', 'action' => 'publicadas'));
        }
        $this->set('p',$publicacion);
    }
    
    public function administrar(){
        $publicacion = TableRegistry::get('bol_publicacion');
        if ($this->request->is('post') ){
            $cod = $this->request->data['cod'];
            $des = $this->request->data['des'];
            $detallePub = TableRegistry::get('bol_detalle_publicacion');
            $detalle = $detallePub->get($cod);
            $detalle->Destacada = $des;
            $detallePub->save($detalle);
        }
        $p = $publicacion->find()
        ->select(['cat'=>'b.Categoria','cod'=>'c.Codigo','codp'=>'c.Cod_Publicacion','d'=>'c.Destacada','est'=>'c.Estado','Titulo','Desarrollo','Imagen','Fecha','codigo_publicacion','Usuario'])
        ->distinct(['Titulo'])
        ->hydrate(true)
        ->join([
            'c' => [
                'table' => 'bol_detalle_publicacion',
                'type' => 'LEFT',
                'conditions' => [
                    'c.Cod_Publicacion = bol_publicacion.codigo_publicacion'
                ]
            ]
        ])
        ->join([
            'b' => [
                'table' => 'bol_categoria',
                'type' => 'LEFT',
                'conditions' => [
                    'c.Cod_Categoria = b.codigo'
                ]
            ]
        ])
        ->where(['c.Estado'=>'Publicada'])
        ->order(['c.Destacada' => 'DESC']);
        $this->set('pub',$this->paginate($p));
    }

    public function add()
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
                    $name = $this->request->data['codigo_user'].'-'.$foto['name'];
                    $destino = WWW_ROOT.'img'.DS.$name;
                    $destinothumb = WWW_ROOT.'img'.DS.'thumb'.DS.$name;
                    
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
                            return $this->redirect(array('Controller'=>'BolPublicacion','action' => 'enviadas'));
                        }
                    }
                    
                }
            }
            
        }
    }

    public function editar($codigo_publicacion = null){
        $publicacion = TableRegistry::get('bol_publicacion');
        $pub = $publicacion->find()
        ->select(['cat'=>'b.Categoria','cod'=>'c.Codigo','Titulo','Desarrollo','Imagen','Fecha','codigo_publicacion','Usuario','Enlace','Estado'])
        ->hydrate(true)
        ->join([
            'c' => [
                'table' => 'bol_detalle_publicacion',
                'type' => 'LEFT',
                'conditions' => [
                    'c.Cod_Publicacion = bol_publicacion.codigo_publicacion'
                ]
            ]
        ])
        ->join([
            'b' => [
                'table' => 'bol_categoria',
                'type' => 'LEFT',
                'conditions' => [
                    'c.Cod_Categoria = b.codigo'
                ]
            ]
        ])
        ->distinct(['c.Cod_Publicacion'])
        ->where(['codigo_publicacion' => $codigo_publicacion,'c.Estado'=>'Editada','c.Destacada'=>'0'])->first();
        if(empty($pub)){
           return $this->redirect(array('controller' => 'Home', 'action' => 'index'));
        }
        $this->set('p', $pub);

        if ($this->request->is('post') ){ // IF 1 (Actiliza el estado de la publicación)
            $cod = $this->request->data['codigo_publicacion'];
            $codigo = $this->request->data['Codigo'];
            $pub = $publicacion->get($cod);
            $pub->Estado = 'Publicada';
            $publicacion->save($pub);
            if ($publicacion->save($pub)) { // IF 2
                $detallePub = TableRegistry::get('bol_detalle_publicacion');
                $query = $detallePub->query();
                $query->update()
                ->set(['Estado' => Publicada])
                ->where(['Cod_Publicacion' => $cod])
                ->execute();
                return $this->redirect(array('Controller'=>'BolPublicacion','action' => 'publicadas'));
            } //END IF 1
        }//END IF 2
    }//FIn editar
    use MailerAwareTrait;
    public function register(){
        $reg = TableRegistry::get('bol_registro');
        $usu = $reg->find('all');
        $this->set('reg',$this->paginate($usu));

        $tipo = TableRegistry::get('bol_tipo_documento');
        $tipodoc = $tipo->find('all');
        $this->set('tipodoc', $tipodoc);

        $pais = TableRegistry::get('country');
        $p = $pais->find()->select(['Name','Code'])
        ->order(['Name' => 'ASC']);
        $this->set('pais', $p);

        if ($this->request->is('post')) {
            $coduser = $this->request->data['Cod_User'];
            $clave = $this->request->data['Password'];
            $user = TableRegistry::get('bol_registro');
                        
            $usu = $user->newEntity();
            $usu->Nombres = $this->request->data['Nombres'];
            $usu->Sexo = $this->request->data['Sexo'];
            $usu->Fecha_Nacimiento = date("y-m-d",strtotime($fecha));
            $usu->Tipo_Id = $this->request->data['Tipo_Id'];
            $usu->Cod_User = $coduser;
            $usu->Telefono = $this->request->data['Telefono'];
            $usu->Email = $this->request->data['Email'];
            $usu->Username = $this->request->data['Username'];
            $usu->Password = $hasher = hash('sha512', $clave , false);
            $usu->confirmPassword = $hasher = hash('sha512', $clave , false);
            $usu->Tipo_Usuario = $this->request->data['Tipo_Usuario'];
            $usu->Rol = $this->request->data['Rol'];
            $usu->Pais = $this->request->data['Pais'];
            $usu->Ciudad = $this->request->data['Ciudad'];
            $usu->Fecha_Registro = date("y-m-d",strtotime("now"));
            if ($user->save($usu)) {
                $this->getMailer('bolRegistro')->send('bienvenido',[$usu]);
                return $this->redirect(array('Controller'=>'BolPublicacion','action' => 'register'));
            }else{
               $this->Flash->error('error', ['key' => 'registro',]);
            }
        } 
    }

    public function editusuario($cod_user = null){
       $edit = TableRegistry::get('bol_registro');
       $c = $edit->find()
        ->select(['Cod_User','Tipo_Id','Nombres','Sexo','Fecha_Nacimiento','Telefono','Email','Username','Tipo_Usuario','Rol','Pais', 'Ciudad','Fecha_Registro','ImgPerfil','Estado'])
        ->where(['Cod_User' => $cod_user])->first();
        if(empty($edit)){
           return $this->redirect(array('controller' => 'Home', 'action' => 'index'));
        }
        $this->set('p', $c);

        if ($this->request->is('post') ){ // IF 1 (Actiliza la información de un usuario)
            $cod = $this->request->data['Cod_User'];
            $clave1 = $this->request->data['Password'];
            $clave2 = $this->request->data['confirmPassword'];
            $rol = $this->request->data['Rol'];
            $c = $edit->get($cod);
            $query = $edit->query();
            $query->update()
            ->set(['Rol' => $rol])
            ->where(['Cod_User' => $cod])
            ->execute();
            return $this->redirect(array('Controller'=>'BolPublicacion','action' => 'register'));
        } //END IF 1 
    }
}
?>