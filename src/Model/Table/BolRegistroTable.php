<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Utility\Text;
use Cake\Event\Event;
use Cake\Utility\Security;

/**
 * BolRegistro Model
 *
 * @method \App\Model\Entity\BolRegistro get($primaryKey, $options = [])
 * @method \App\Model\Entity\BolRegistro newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\BolRegistro[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BolRegistro|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BolRegistro|bool saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BolRegistro patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\BolRegistro[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\BolRegistro findOrCreate($search, callable $callback = null, $options = [])
 */
class BolRegistroTable extends Table
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

        $this->setTable('bol_registro');
        $this->setDisplayField('Cod_User');
        $this->setPrimaryKey('Cod_User');
    }

    public function beforeSave(Event $event)
    {
        $entity = $event->getData('entity');

        if ($entity->isNew()) {
            $hasher = new DefaultPasswordHasher();

            // Generate an API 'token'
            $entity->api_key_plain = Security::hash(Security::randomBytes(32), 'sha256', false);

            // Bcrypt the token so BasicAuthenticate can check
            // it during login.
            $entity->api_key = $hasher->hash($entity->api_key_plain);
        }
        return true;
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
            ->scalar('Cod_User')
            ->maxLength('Cod_User', 20)
            ->allowEmpty('Cod_User', 'create');

        $validator
            ->integer('Tipo_Id')
            ->requirePresence('Tipo_Id', 'create')
            ->notEmpty('Tipo_Id');

        $validator
            ->scalar('Nombres')
            ->maxLength('Nombres', 90)
            ->requirePresence('Nombres', 'create')
            ->notEmpty('Nombres');

        $validator
            ->scalar('Apellidos')
            ->maxLength('Apellidos', 90)
            ->requirePresence('Apellidos', 'create')
            ->notEmpty('Apellidos');

        $validator
            ->scalar('ImgPerfil')
            ->maxLength('ImgPerfil', 255)
            ->allowEmpty('ImgPerfil');

        $validator
            ->scalar('Sexo')
            ->maxLength('Sexo', 15)
            ->requirePresence('Sexo', 'create')
            ->notEmpty('Sexo');

        $validator
            ->date('Fecha_Nacimiento')
            ->requirePresence('Fecha_Nacimiento', 'create')
            ->notEmpty('Fecha_Nacimiento');

        $validator
            ->scalar('Telefono')
            ->maxLength('Telefono', 15)
            ->allowEmpty('Telefono');

        $validator
            ->scalar('Email')
            ->maxLength('Email', 50)
            ->requirePresence('Email', 'create')
            ->notEmpty('Email')
            ->add('Email', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('Password')
            ->maxLength('Password', 255)
            ->requirePresence('Password', 'create')
            ->notEmpty('Password');

        $validator
            ->scalar('Tipo_Usuario')
            ->maxLength('Tipo_Usuario', 18)
            ->allowEmpty('Tipo_Usuario');

        $validator
            ->scalar('Rol')
            ->maxLength('Rol', 45)
            ->requirePresence('Rol', 'create')
            ->notEmpty('Rol');

        $validator
            ->scalar('Pais')
            ->maxLength('Pais', 20)
            ->requirePresence('Pais', 'create')
            ->notEmpty('Pais');

        $validator
            ->scalar('Ciudad')
            ->maxLength('Ciudad', 50)
            ->requirePresence('Ciudad', 'create')
            ->notEmpty('Ciudad');

        $validator
            ->dateTime('Fecha_Registro')
            ->requirePresence('Fecha_Registro', 'create')
            ->notEmpty('Fecha_Registro');

        $validator
            ->integer('Estado')
            ->allowEmpty('Estado');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['Email']));
        $rules->add($rules->isUnique(['Telefono']));

        return $rules;
    }
}
