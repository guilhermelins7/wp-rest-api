<?php 

function registrar_produto() {
    register_post_type('produto', array(
        'label' => 'Produto',
        'description' => 'Produtos',
        'public' => true,
        'show_ui' => true, // Mostra na interface?
        'capability_type' => 'post',
        'rewrite' => array(
            'slug' => 'produtos', 
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
add_action('init', 'registrar_produto');

?>