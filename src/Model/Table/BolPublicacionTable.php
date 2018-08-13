<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BolPublicacion Model
 *
 * @method \App\Model\Entity\BolPublicacion get($primaryKey, $options = [])
 * @method \App\Model\Entity\BolPublicacion newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\BolPublicacion[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BolPublicacion|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BolPublicacion|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BolPublicacion patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\BolPublicacion[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\BolPublicacion findOrCreate($search, callable $callback = null, $options = [])
 */
class BolPublicacionTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('bol_publicacion');
        $this->setDisplayField('codigo_publicacion');
        $this->setPrimaryKey('codigo_publicacion');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('codigo_publicacion')
            ->allowEmpty('codigo_publicacion', 'create');

        $validator
            ->scalar('codigo_User')
            ->maxLength('codigo_User', 20)
            ->requirePresence('codigo_User', 'create')
            ->notEmpty('codigo_User');

        $validator
            ->scalar('Titulo')
            ->maxLength('Titulo', 190)
            ->requirePresence('Titulo', 'create')
            ->notEmpty('Titulo');

        $validator
            ->dateTime('Fecha')
            ->allowEmpty('Fecha');

        $validator
            ->scalar('Desarrollo')
            ->maxLength('Desarrollo', 60000)
            ->allowEmpty('Desarrollo');

        $validator
            ->scalar('Imagen')
            ->allowEmpty('Imagen');

        $validator
            ->scalar('Enlace')
            ->maxLength('Enlace', 150)
            ->allowEmpty('Enlace');

        $validator
            ->scalar('Usuario')
            ->maxLength('Usuario', 35)
            ->requirePresence('Usuario', 'create')
            ->notEmpty('Usuario');

        $validator
            ->scalar('Estado')
            ->maxLength('Estado', 25)
            ->requirePresence('Estado', 'create')
            ->notEmpty('Estado');

        $validator
            ->scalar('Correccion')
            ->maxLength('Correccion', 1200)
            ->allowEmpty('Correccion');

        return $validator;
    }
}
