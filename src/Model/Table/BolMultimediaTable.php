<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BolMultimedia Model
 *
 * @method \App\Model\Entity\BolMultimedia get($primaryKey, $options = [])
 * @method \App\Model\Entity\BolMultimedia newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\BolMultimedia[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BolMultimedia|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BolMultimedia|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BolMultimedia patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\BolMultimedia[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\BolMultimedia findOrCreate($search, callable $callback = null, $options = [])
 */
class BolMultimediaTable extends Table
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

        $this->setTable('bol_multimedia');
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
            ->scalar('Cod_User')
            ->maxLength('Cod_User', 20)
            ->requirePresence('Cod_User', 'create')
            ->notEmpty('Cod_User');

        $validator
            ->scalar('Url_Link')
            ->requirePresence('Url_Link', 'create')
            ->notEmpty('Url_Link');

        $validator
            ->scalar('Estado')
            ->maxLength('Estado', 10)
            ->requirePresence('Estado', 'create')
            ->notEmpty('Estado');

        $validator
            ->dateTime('Fecha')
            ->requirePresence('Fecha', 'create')
            ->notEmpty('Fecha');

        return $validator;
    }
}
