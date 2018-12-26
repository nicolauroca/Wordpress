function wpup_bbp_list_replies( $args = array() ) {
 
    // Reseteo de la profundidad de la respuesta/comentario
    bbpress()->reply_query->reply_depth = 0;
 
    // Loop de respuestas
    bbpress()->reply_query->in_the_loop = true;
 
    $r = bbp_parse_args( $args, array(
        'walker'       => null,
        'max_depth'    => bbp_thread_replies_depth(),
        'style'        => 'ul',
        'callback'     => null,
        'end_callback' => null
    ), 'list_replies' );
 
    // Obtiene las respuestas sobre las que hacer el loop en $_replies
    $walker = new BBP_Walker_Reply;
    $walker->paged_walk( bbpress()->reply_query->posts, $r['max_depth'], $r['page'], $r['per_page'], $r );
 
    bbpress()->max_num_pages = $walker->max_pages;
    bbpress()->reply_query->in_the_loop = false;
}
