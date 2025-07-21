<?php 

function registrar_transacao() {
    register_post_type('transacao', array(
        'label' => 'Transacao',
        'description' => 'Transacao',
        'public' => true,
        'show_ui' => true, // Mostra na interface?
        'capability_type' => 'post',
        'rewrite' => array(
            'slug' => 'transacoes', 
            'width_front' => true
        ),
        'query_var' => true,
        'supports' => array(
            'author',
            'title',
        ),
        'publicly_queryable' => true,
    ));
}
add_action('init', 'registrar_transacao');

?>