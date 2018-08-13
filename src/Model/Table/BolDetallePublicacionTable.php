<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BolDetallePublicacion Model
 *
 * @method \App\Model\Entity\BolDetallePublicacion get($primaryKey, $options = [])
 * @method \App\Model\Entity\BolDetallePublicacion newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\BolDetallePublicacion[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BolDetallePublicacion|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BolDetallePublicacion|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BolDetallePublicacion patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\BolDetallePublicacion[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\BolDetallePublicacion findOrCreate($search, callable $callback = null, $options = [])
 */
class BolDetallePublicacionTable extends Table
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

        $this->setTable('bol_detalle_publicacion');
        $this->setDisplayField('Codigo');
        $this->setPrimaryKey('Codigo');
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
            ->integer('Codigo')
            ->allowEmpty('Codigo', 'create');

        $validator
            ->integer('Cod_Publicacion')
            ->requirePresence('Cod_Publicacion', 'create')
            ->notEmpty('Cod_Publicacion');

        $validator
            ->scalar('Cod_Usuario')
            ->maxLength('Cod_Usuario', 20)
            ->requirePresence('Cod_Usuario', 'create')
            ->notEmpty('Cod_Usuario');

        $validator
            ->integer('Cod_Categoria')
            ->requirePresence('Cod_Categoria', 'create')
            ->notEmpty('Cod_Categoria');

        $validator
            ->scalar('Estado')
            ->maxLength('Estado', 25)
            ->requirePresence('Estado', 'create')
            ->notEmpty('Estado');

        $validator
            ->dateTime('Fecha_Publicacion')
            ->requirePresence('Fecha_Publicacion', 'create')
            ->notEmpty('Fecha_Publicacion');

        $validator
            ->integer('Destacada')
            ->requirePresence('Destacada', 'create')
            ->notEmpty('Destacada');

        return $validator;
    }
}
