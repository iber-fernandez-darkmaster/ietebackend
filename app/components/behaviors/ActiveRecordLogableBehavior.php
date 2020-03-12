<?php
namespace app\components\behaviors;
use yii\base\Behavior;
use app\models\TrailsLog;
use yii\db\BaseActiveRecord;

class ActiveRecordLogableBehavior extends Behavior
{
	private $_oldattributes = [];

	public function events()
    {
        return[
            // BaseActiveRecord::EVENT_AFTER_FIND => 'afterFind',
            BaseActiveRecord::EVENT_AFTER_INSERT => 'afterSave',
            BaseActiveRecord::EVENT_AFTER_UPDATE => 'afterUpdate',
            BaseActiveRecord::EVENT_AFTER_DELETE => 'afterDelete'
        ];
    }

	public function afterSave($event)
	{	
		$model = $this->owner;

		$log = new TrailsLog;
		$log->model = get_class($model);
		$log->id_model = $model->getPrimaryKey();
		$log->action = 'create';
		$log->creation_date= time();
		if ( method_exists(\Yii::$app, 'getSession') ){
			$log->ip = \Yii::$app->getRequest()->getUserIP();
			if (\Yii::$app->user->identity){
				$log->user_id = \Yii::$app->user->identity->id;
				$log->description = 'El usuario '.\Yii::$app->user->identity->username .': Registro ' . $log->model 
				. '[' . $log->id_model .'].';
			}else{
				$log->description = 'El usuario anonimo: Registro ' . $log->model 
								. '[' . $log->id_model .'].';
			}
		}else{
			$log->ip = "";
			$log->user_id = null;
			$log->description = 'El usuario anonimo: Registro ' . $log->model 
								. '[' . $log->id_model .'].';
		}
		$log->save();
	}

	public function afterUpdate($event)
	{	
		$model = $this->owner;
		// $newattributes = $model->getAttributes();
		// $oldattributes = $this->getOldAttributes();
		
		// // compare old and new
		// foreach ($newattributes as $name => $value) {
		// 	if (!empty($oldattributes)) {
		// 		$old = $oldattributes[$name];
		// 	} else {
		// 		$old = '';
		// 	}
			// if ($value != $old && $name != 'created_at' && $name !=  'updated_at') {
				$log = new TrailsLog;
				$log->model = get_class($model);
				$log->id_model = $model->getPrimaryKey();
				$log->action = 'update';
				
				$log->creation_date = time();
				if ( method_exists(\Yii::$app, 'getSession') ){
					$log->ip = \Yii::$app->getRequest()->getUserIP();
					if (\Yii::$app->user->identity){
						$log->user_id=	\Yii::$app->user->identity->id;
						$log->description = 'El usuario '.\Yii::$app->user->identity->username .': Modifico ' . $log->model.'[' . $log->id_model .'].';
					}else{
						$log->user_id =	null;
						$log->description = 'El usuario anonimo: Modifico ' . $log->model.'[' . $log->id_model .'].';; 
					}
				}else{
					$log->ip = "";
					$log->user_id =	null;
					$log->description = 'El usuario anonimo: Modifico ' . $log->model.'[' . $log->id_model .'].';; 
				}
				
				$log->save();
			// }
		// }
	}

	public function afterDelete($event)
	{
		$log = new TrailsLog;
		$model = $this->owner;
		$log->description=	'El usuario '.\Yii::$app->user->identity->username .': Elimino ' 
                                .get_class($model)
                                . '[' .$model->getPrimaryKey().'].';
		$log->action = 'delete';
		$log->model = get_class($model);
		$log->id_model = $model->getPrimaryKey();
		$log->ip = \Yii::$app->getRequest()->getUserIP();
		$log->creation_date = time();
		$log->user_id = \Yii::$app->user->identity->id;
		$log->save();
	}

	// public function afterFind($event)
	// {
	// 	// Save old values
	// 	$model = $this->owner;
	// 	$this->setOldAttributes($model->getAttributes());
	// }

	// public function getOldAttributes()
	// {
	// 	return $this->_oldattributes;
	// }

	// public function setOldAttributes($value)
	// {
	// 	$this->_oldattributes=$value;
	// }
}