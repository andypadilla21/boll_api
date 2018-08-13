<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BolTipoDocumento Model
 *
 * @method \App\Model\Entity\BolTipoDocumento get($primaryKey, $options = [])
 * @method \App\Model\Entity\BolTipoDocumento newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\BolTipoDocumento[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BolTipoDocumento|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BolTipoDocumento|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BolTipoDocumento patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\BolTipoDocumento[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\BolTipoDocumento findOrCreate($search, callable $callback = null, $options = [])
 */
class BolTipoDocumentoTable extends Table
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

        $this->setTable('bol_tipo_documento');
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
            ->scalar('Tipo')
            ->maxLength('Tipo', 30)
            ->requirePresence('Tipo', 'create')
            ->notEmpty('Tipo');

        return $validator;
    }
}
