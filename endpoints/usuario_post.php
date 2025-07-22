<?php 

use const API\Endpoints\ROUTE_PREFIX;

function usuario_post($request) {
    $campos = [
        'nome' => sanitize_text_field( $request['nome'] ),
        'email' => sanitize_email( $request['email'] ),
        'senha' => $request['senha'], // Senha não deve ser sanitizada, pois o wp_create já trata da forma correta.
        'cep' => sanitize_text_field( $request['cep'] ),
        'rua' => sanitize_text_field( $request['rua'] ),
    ];

    // Verificando se o usuário existe:
    $user_exist = username_exists($campos['email']);
    $email_exists = email_exists( $campos['email'] );

    // Se usuário não existir, cria-lo:
    if($campos['email'] && !$user_exist && !$email_exists) {
        // após criado, retorna o user_id para demais definições
        $user_id = wp_create_user($campos['nome'], $campos['senha'], $campos['email']);

        $response = [
            'ID' => $user_id,
            'display_name' => $nome,
            'first_name' => $nome,
            'role' => 'subscriber' // permisões do usuário
        ];

        wp_update_user( $response );

        update_user_meta($user_id, 'cep', $campos['cep']);
        update_user_meta($user_id, 'rua', $campos['rua']);
    }
    else {
        $response = new WP_Error('email', 'Email já cadastrado', ['status' => 403]);
    }

    return rest_ensure_response($response);
}

function registrar_usuario_post() {
    register_rest_route(ROUTE_PREFIX, '/usuario', array(
        array(
            'methods' => WP_REST_Server::CREATABLE, // Método HTTP.
            'callback' => 'usuario_post'
        ),
        ));
}

add_action('rest_api_init', 'registrar_usuario_post');

?>