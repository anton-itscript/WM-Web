<?php


class ListenerLogProcessError extends CStubActiveRecord {


    public static function model($className=__CLASS__){
        return parent::model($className);
    }
    public function beforeSave(){
        if(!$this->getUseLong()){
            if ($this->isNewRecord){
                $this->created = new CDbExpression('NOW()');
            }
            $this->updated = new CDbExpression('NOW()');
        }
        return parent::beforeSave();
    }


    public function tableName() {
        return 'listener_log_process_error';
    }



    
}