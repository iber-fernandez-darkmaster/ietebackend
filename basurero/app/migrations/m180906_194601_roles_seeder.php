<?php

use yii\db\Migration;

/**
 * Class m180906_194601_roles_seeder
 */
class m180906_194601_roles_seeder extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        //asignando roles y permisos por medio del auth
        $admin = $this->crearPermisosAndRoles($this->getPermisosSuperUsuario(), 'admin');
        $administrador = $this->crearPermisosAndRoles($this->getPermisosAdministrador(), 'administrador');
        $editor = $this->crearPermisosAndRoles($this->getPermisosEditor(), 'editor');

        $auth->addChild($admin, $administrador);
        $auth->addChild($administrador, $editor);
        
        //asignacion de roles a usuarios
        $auth->assign($admin, 1);
        $auth->assign($administrador, 2);
        $auth->assign($editor, 3);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->truncateTable('auth_assignment');
        $this->truncateTable('auth_item');
        $this->truncateTable('auth_item_child');
        $this->truncateTable('auth_rule');
        $this->truncateTable('auth_rule');
        return false;
    }

    /**
     * crear el rol y los permisos 
     * y ademas los agregaal rol
     * @param array $permisos
     * @param string $rolName
     * @return Rol
     */
    private function crearPermisosAndRoles($permisos, $rolName){
        $auth = Yii::$app->authManager;
        $rol = $auth->createRole($rolName);
        $auth->add($rol);
        foreach ($permisos as $key => $item) {
            //Permisos en forma de rutas de acceso 
            $permiso = $auth->createPermission($item['ruta']);
            $permiso->description = $item['descripcion'];
            $auth->add($permiso);
            //Roles de acceso
            $auth->addChild($rol, $permiso);
        }
        return $rol;
    }

    /**
     * Obtiene las rutas permitidas
     * del rol super usuario
     * @return array
     */
    private function getPermisosSuperUsuario(){
        return [
            [
                'ruta'=>'/*',
                'descripcion'=>'acceso total a todos los modulos'
            ],
            [
                'ruta'=>'/gii/*',
                'descripcion'=>'acceso a generador de codigo'
            ],
        ];
    }
    
    /**
     * Obtiene las rutas permitidas
     * del rol adminsitrador o director general
     * @return array
     */
    private function getPermisosAdministrador(){
        return [
            //module user
            [
                'ruta'=>'/admin/user/index',
                'descripcion'=>''
            ],
            [
                'ruta'=>'/admin/user/view',
                'descripcion'=>''
            ],
            [
                'ruta'=>'/admin/user/delete',
                'descripcion'=>''
            ],
            [
                'ruta'=>'/admin/user/signup',
                'descripcion'=>''
            ],
            [
                'ruta'=>'/admin/user/request-password-reset',
                'descripcion'=>''
            ],
            [
                'ruta'=>'/admin/user/reset-password',
                'descripcion'=>''
            ],
            [
                'ruta'=>'/admin/user/activate',
                'descripcion'=>''
            ],
            //module assignment
            [
                'ruta'=>'/admin/assignment/index',
                'descripcion'=>''
            ],
            [
                'ruta'=>'/admin/assignment/view',
                'descripcion'=>''
            ],
            [
                'ruta'=>'/admin/assignment/assign',
                'descripcion'=>''
            ],
            [
                'ruta'=>'/admin/assignment/revoke',
                'descripcion'=>''
            ],
            //module rol
            [
                'ruta'=>'/admin/role/index',
                'descripcion'=>''
            ],
            [
                'ruta'=>'/admin/role/view',
                'descripcion'=>''
            ],
            [
                'ruta'=>'/admin/role/create',
                'descripcion'=>''
            ],
            [
                'ruta'=>'/admin/role/update',
                'descripcion'=>''
            ],
            [
                'ruta'=>'/admin/role/delete',
                'descripcion'=>''
            ],
            [
                'ruta'=>'/admin/role/assign',
                'descripcion'=>''
            ],
            [
                'ruta'=>'/admin/role/remove',
                'descripcion'=>''
            ],
            //module routes or permisos
            [
                'ruta'=>'/admin/route/index',
                'descripcion'=>''
            ],
            [
                'ruta'=>'/admin/route/create',
                'descripcion'=>''
            ],
            [
                'ruta'=>'/admin/route/assign',
                'descripcion'=>''
            ],
            [
                'ruta'=>'/admin/route/remove',
                'descripcion'=>''
            ],
            [
                'ruta'=>'/admin/route/refresh',
                'descripcion'=>''
            ],
            [
                'ruta'=>'/site/*',
                'descripcion'=>''
            ],
            
        ];
    }
    /**
     * Obtiene las rutas permitidas
     * del rol adminsitrador o director general
     * @return array
     */
    private function getPermisosEditor(){
        return [
            //module 
            [
                'ruta'=>'/espacio-publicitario/*',
                'descripcion'=>''
            ],
            [
                'ruta'=>'/portafolio/*',
                'descripcion'=>''
            ],
            [
                'ruta'=>'/cliente/*',
                'descripcion'=>''
            ],
            [
                'ruta'=>'/contacto/*',
                'descripcion'=>''
            ],
            
        ];
    }

    
    
    
}
