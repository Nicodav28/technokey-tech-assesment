<?php

$router->get('/login', [::class, 'login']);
$router->post('/login', [::class, 'login']);
$router->get('/logout', [::class, 'logout']);
$router->get('/flights', [::class, 'index']);
