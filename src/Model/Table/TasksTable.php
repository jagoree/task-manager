<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\Event;

/**
 * Tasks Model
 *
 * @property \App\Model\Table\TagsTable&\Cake\ORM\Association\BelongsToMany $Tags
 *
 * @method \App\Model\Entity\Task get($primaryKey, $options = [])
 * @method \App\Model\Entity\Task newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Task[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Task|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Task saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Task patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Task[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Task findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TasksTable extends Table
{
    private $__schema = [];
    
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setDisplayField('caption');
        $this->setPrimaryKey('id');
        
        $this->getSchema()
                ->setColumnType('priority', 'integer')
                ->setColumnType('status', 'integer');
        $this->setFieldSchema([
            'status' => [
                'type' => 'select', 'options' => [__('Finished'), __('In progress')], 'label' => __('Status')
            ],
            'priority' => [
                'type' =>'select', 'options' => [__('Low'), __('Medium'), __('High')], 'label' => __('Priority')
            ]
        ]);

        $this->addBehavior('Timestamp');

        $this->belongsToMany('Tags', [
            'foreignKey' => 'task_id',
            'targetForeignKey' => 'tag_id',
            'joinTable' => 'tags_tasks'
        ]);
    }
    
    public function getFieldSchema($key = null)
    {
        if ($key !== null and isset($this->__schema[$key])) {
            return $this->__schema[$key];
        }
        return $this->__schema;
    }
    
    public function setFieldSchema($schema)
    {
        $this->__schema = $schema;
    }
    
    public function fetchRows($data)
    {
        $query = $this->query()
                ->contain('Tags')
                ->order(['Tasks.status' => 'DESC']);
        if (isset($data['tags'])) {
            $query->innerJoin(['TagsTasks' => 'tags_tasks'], 'TagsTasks.task_id = Tasks.id')
                    ->where(['TagsTasks.tag_id IN' => $data['tags']])
                    ->group('Tasks.id');
        }
        if (!isset($data['order'])) {
            $query->order(['Tasks.priority' => 'DESC']);
        }
        return $query;
    }
    
    public function beforeFind(Event $event, Query $query, \ArrayObject $options)
    {
        $statuses = $this->getFieldSchema('status')['options'];
        $priorities = $this->getFieldSchema('priority')['options'];
        return $query->mapReduce(function ($item, $index, $mapReduce) use ($statuses, $priorities) {
            $item->set('status_text', $statuses[$item->status] ?? null);
            $item->set('priority_text', $priorities[$item->priority] ?? null);
            $mapReduce->emit($item, $index);
        });
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
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('caption')
            ->maxLength('caption', 255)
            ->requirePresence('caption', 'create')
            ->notEmptyString('caption');

        $validator
            ->integer('status')
            ->requirePresence('status');

        $validator
            ->integer('priority')
            ->requirePresence('priority');

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
        $rules->add(function ($entity, $options) {
            if (empty(trim($entity->caption))) {
                return __d('cake', 'This field cannot be left empty');
            }
            return true;
        }, ['errorField' => 'caption']);

        return $rules;
    }
}
