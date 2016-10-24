<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Strings Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in strings throughout the system.
    | Regardless where it is placed, a string can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'backend' => [
        'access' => [
            'users' => [
                'delete_user_confirm' => 'Estás seguro de querer eliminar este Usuario de forma permanente? Esto puede producir un error grave en aquéllas partes de la aplicación que hagan referencia al mismo. Proceda con cautela. Esta operación no puede ser revertida.',
                'if_confirmed_off' => '(Si la confirmación está desactivada)',
                'restore_user_confirm' => 'Restaurar este Usuario a su estado original?',
            ],
        ],

        'dashboard' => [
            'title' => 'Panel de Administración',
            'welcome' => 'Bienvenido',
        ],

        'general' => [
            'all_rights_reserved' => 'Todos los derechos reservados.',
            'are_you_sure' => 'Está seguro?',
            'boilerplate_link' => 'Laravel 5 Boilerplate',
            'continue' => 'Continuar',
            'member_since' => 'Miembro desde',
            'minutes' => ' minutos',
            'search_placeholder' => 'Buscar...',
            'timeout' => 'Usted ha sido automaticamente desconectado por razones de seguridad ya que no tuvo actividad en ',

            'see_all' => [
                'messages' => 'Ver todos los mensajes',
                'notifications' => 'Ver todo',
                'tasks' => 'Ver todas las tareas',
            ],

            'status' => [
                'online' => 'Conectado',
                'offline' => 'Desconectado',
            ],

            'you_have' => [
                'messages' => '{0} No tiene nuevos mensajes|{1} Tiene 1 nuevo mensaje|[2,Inf] Tiene :number mensajes nuevos',
                'notifications' => '{0} No tiene nuevas notificaciones|{1} Tiene 1 nueva notificación|[2,Inf] Tiene :number notificaciones',
                'tasks' => '{0} No tiene nuevas tareas|{1} Tiene 1 nueva tarea|[2,Inf] Tiene :number nuevas tareas',
            ],
        ],
    ],

    'emails' => [
        'auth' => [
            'error' => 'Whoops!',
            'greeting' => 'Hello!',
            'regards' => 'Regards,',
            'trouble_clicking_button' => 'If you’re having trouble clicking the ":action_text" button, copy and paste the URL below into your web browser:',
            'thank_you_for_using_app' => 'Thank you for using our application!',

            'password_reset_subject' => 'Su enlace de reinicio de la contraseña',
            'password_cause_of_email' => 'You are receiving this email because we received a password reset request for your account.',
            'password_if_not_requested' => 'If you did not request a password reset, no further action is required.',
            'reset_password' => 'Pulse aquí para reiniciar su contraseña',

            'click_to_confirm' => 'Pulse aquí para verificar su cuenta:',
        ],
    ],

    'frontend' => [
        'test' => 'Prueba',

        'tests' => [
            'based_on' => [
                'permission' => 'Basado en el Permiso - ',
                'role' => 'Basado en el Rol - ',
            ],

            'js_injected_from_controller' => 'Javascript inyectado desde el Controlador',

            'using_blade_extensions' => 'Usando las extensiones de Blade',

            'using_access_helper' => [
                'array_permissions' => 'Uso de Access Helper con lista de nombres de Permisos o ID\'s donde el usuario tiene que tenerlos todos.',
                'array_permissions_not' => 'Uso de Access Helper con lista de nombres de Permisos o ID\'s donde el usuario no tiene por que tenerlos todos.',
                'array_roles' => 'Uso de Access Helper con lista de nombres de Roles o ID\'s donde el usuario tiene que tenerlos todos.',
                'array_roles_not' => 'Uso de Access Helper con lista de nombres de Roles o ID\'s donde el usuario no tiene que tenerlos todos.',
                'permission_id' => 'Uso de Access Helper mediante ID de Permiso',
                'permission_name' => 'Uso de Access Helper mediante nombre de Permiso',
                'role_id' => 'Uso de Access Helper mediante ID de Rol',
                'role_name' => 'Uso de Access Helper mediante nombre de Rol',
            ],

            'view_console_it_works' => 'Mire la consola del navegador, deberia ver \'Funciona!!\' que tiene su origen en FrontendController@index',
            'you_can_see_because' => 'Puede ver esto, por que dispone del Rol \':role\'!',
            'you_can_see_because_permission' => 'Puede ver esto, por que dispone del Permiso \':permission\'!',
        ],

        'user' => [
            'profile_updated' => 'Perfil actualizado satisfactoriamente.',
            'password_updated' => 'Contraseña actualizada satisfactoriamente.',
        ],

        'welcome_to' => 'Bienvenido a :place',
    ],
];
