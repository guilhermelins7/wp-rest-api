<?php 

use const API\Endpoints\ROUTE_PREFIX;

function usuario_post($request) {
    $response = array(
        'success' => true,
        'nome' => 'Fulano',
    );

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