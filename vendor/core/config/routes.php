<?php
return [
    '/' => 'Shop@index',
    '/about/' => 'Main@about',
    '/cabinet/' => 'USer@cabinet',
    '/contacts/' => 'Main@contacts',
    '/login/'=>'User@index',
    '/logout/' => 'User@logout',
    '/register/' => 'User@register',
    '/product/{s}' => 'Shop@product',
    '/shop/ajaxFilters/' => 'Shop@ajaxFilters',
    '/shop/ajaxAddToChosen/' => 'Shop@ajaxAddToChosen',
    '/shop/ajaxRemoveFromChosen/' => 'Shop@ajaxRemoveFromChosen',
    '/shop/ajaxAddToCart/' =>  'Shop@ajaxAddToCart',
    '/shop/openCart/' => 'Shop@openCart',
    '/shop/clearCart/' => 'Shop@clearCart',
    '/shop/ajaxDeleteFromCart/' => 'Shop@ajaxDeleteFromCart',
];