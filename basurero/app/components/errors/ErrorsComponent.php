<?php
namespace app\components\errors;

use Yii;
use yii\web\UnprocessableEntityHttpException;

/**
 * Componente para convertir el array de model->errors a una 
 * cadena pqra que e pueda visualizar en un mensaje string
 */
class ErrorsComponent 
{
    /**
     * Convierte model->errors a un string exceptionError.
     * Recorre los cada atributo observado por la validacion del modelo
     * y cada reposueta observada de cada atributo par devolver 
     * un UnprocessableEntityHttpException con la cadena con el nombre 
     * delatributo y la observacion de validación.
     * Param array $errors array de errors del modelo active records
     * Return UnprocessableEntityHttpException.
     * 
     * @param array $errors array de errors del modelo active records
     * @return UnprocessableEntityHttpException
     */
    static public function format($errors){
        foreach ($errors as $attribute=>$error)
        {
            foreach ($error as $message)
            {
                throw new UnprocessableEntityHttpException( $attribute.": ".$message );
            }
        }
    }
    
    /**
     * Convierte model->errors a un string solamente.
     * Recorre los cada atributo observado por la validacion del modelo
     * y cada reposueta observada de cada atributo par devolver 
     * una  cadena con el nombre delatributo y la observacion de validación.
     * Param array $errors array de errors del modelo active records
     * Return UnprocessableEntityHttpException.
     * 
     * @param array $errors array de errors del modelo active records
     * @return string
     */
    static public function formatJustString($errors){
        foreach ($errors as $attribute=>$error){
            foreach ($error as $message){
                return $attribute.": ".$message;
            }
        }
    }

}
