<?php
use yii\helpers\Url;
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'Administrador';
?>

<?php if (\Yii::$app->user->can('Administrador')){ ?>
    
    <h4>Bienvenido al panel de administración de la aplicación de IETE
    ¿Qué hay en cada item del menú de la izquierda?</h4>
    <h4>
    Centros:
    Es donde se dan de alta a los centros.
    </h4>
    <br>
    <h4>Estudiantes
    En este item se puede:</h4>
    <h4>
        <p>-Cambiar a los alumnos de un centro a otro</p>
        <p>-Revisar la información de los alumnos.</p>  
        <p>-Dar de alta estudiantes, pero esta tarea le corresponde a los responsables de cada centro.</p>
    </h4>
    <br>
    <h4>Materias:
    En esta sección se podrá:</h4>
    <h4>
        <p>-Crear las materias para que se puedan</p>
        <p>-Crear los exámenes, que contendrán</p>
        <p>-Las preguntas con sus respuestas.</p>
        <p>-Habilitar/deshabilitar las materias. Esto será útil para habilitar a los alumnos cuando compren los libros. (Ampliaremos más adelante)</p>
    </h4>
    <br>
    <h4>Habilitaciones
    En esta sección se podrá:</h4>
    <h4>
        <p>-Crear una habilitación, que se hará cuando se confirme el pago del libro.</p>
        <p>-La habilitación consiste en buscar al alumno, buscar la materia y guardar.</p>
        <p>-Sólo después de eso, el alumno puede rendir el exámen.</p>
        <p>-Esta habilitación la harán las personas que se encargan de revisar las cobranzas.</p>
    </h4>
    <br>
    <h4>Sistema
    Opciones de desarrollador. NO TOCAR.</h4>

<?php } ?>

<?php if (\Yii::$app->user->can('Responsable Centro')){ ?>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
        <a class="btn btn-info" href="<?=Url::to(['/estudiante'])?>">
            <h4>Estudiantes</h4>
        </a>
    </div>
</div>

<?php } ?>