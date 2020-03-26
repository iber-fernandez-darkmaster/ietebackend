<?php

// namespace app\controllers;
// namespace app\components\inscripcion;
namespace app\components\inscripcion;

use Yii;
use app\models\Inscripcion;
use app\models\InscripcionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use app\models\PlanHorario;
use app\models\Matricula;
use app\models\Estudiante;
use app\models\Plan;
use app\models\InscripcionHisModificado;
use app\models\Mensualidad;
use app\models\MensualidadSearch;
use app\models\Pago;
use app\models\Config;
use app\models\PagoMatricula;
use app\models\InscripcionTema;
use app\models\EstudianteSellos;
use app\models\Tema;
use kartik\mpdf\Pdf;



/**
 * InscripcionController implements the CRUD actions for Inscripcion model.
 */
class InscripcionComponent 
{

    public $numeroMeses = 3;
    
    /**
     * Inhabilitar una inscripcion en espesifico
     * @param int $id
     * @return void
     */
    public function inhabilitarInscripcion($id){
        $inscripcion = Inscripcion::findOne($id);
        if ( count($inscripcion->mensualidadesConDeuda()) >= $this->numeroMeses && $inscripcion->estado == Inscripcion::ESTADO_ACTIVO  ){
            $inscripcion->plan_id = 0;
            $inscripcion->estado = Inscripcion::ESTADO_INACTIVO;
            if ( !$inscripcion->save() ){
                throw new \Exception('Verificar campos de inscripcion'.var_dump($inscripcion->errors));
            }
        }
    }

    /**
     * Verifica el numero de deudas de todas las 
     * inscripciones activas y les cambia de estado 
     * como inactivao
     *
     * @return void
     */
    public function inhabilitar(){
        $inscripciones = Inscripcion::find()->where(['estado'=>Inscripcion::ESTADO_ACTIVO])->all();
        foreach ($inscripciones as $key => $inscripcion) {
            if ( count($inscripcion->mensualidadesConDeuda()) >= $this->numeroMeses ){
                $inscripcion->estado = Inscripcion::ESTADO_INACTIVO;
                $inscripcion->plan_id = 0;
                if ( !$inscripcion->save() ){
                    echo var_dump($inscripcion->errors);
                }
                echo "Inscripcion inhabilitada.\n";
            }
        }
    }

    /**
     * Inhabilitar una inscripcion en espesifico
     * @param int $id
     * @return void
     */
    public function habilitarInscripcion($id){
        $inscripcion = Inscripcion::findOne($id);
        if ( count($inscripcion->mensualidadesConDeuda()) < $this->numeroMeses && $inscripcion->estado == Inscripcion::ESTADO_INACTIVO  ){
            $inscripcion->plan_id = 0;
            $inscripcion->estado = Inscripcion::ESTADO_ACTIVO;
            
            if ( !$inscripcion->save() ){
                throw new \Exception('Verificar campos de inscripcion'.var_dump($inscripcion->errors));
            }
        }
    }
    
    /**
     * Verifica el numero de deudas de todas las 
     * inscripciones Inactivas y les cambia de estado 
     * como activo si ya deben solo menos de 3 meses
     *
     * @return void
     */
    public function habilitar(){
        $inscripciones = Inscripcion::find()->where(['estado'=>Inscripcion::ESTADO_INACTIVO])->all();
        foreach ($inscripciones as $key => $inscripcion) {
            if ( count($inscripcion->mensualidadesConDeuda()) < $this->numeroMeses ){
                $inscripcion->estado = Inscripcion::ESTADO_ACTIVO;
                $inscripcion->plan_id = 0;
                if ( !$inscripcion->save() ){
                    return var_dump($inscripcion->errors);
                }
            }
        }
    }

}
