<?php
App::uses('ModelBehavior', 'Model');

class NodeEventBehavior extends ModelBehavior {

/**
 * Setup
 *
 * @param Model $model
 * @param array $config
 * @return void
 */
	public function setup(Model $model, $config = array()) {
		
            $model->hasOne['NodeEvent'] = array(
                'className' => 'NodeEvent',
                'foreignKey' => 'node_id'
            );
	}

}
