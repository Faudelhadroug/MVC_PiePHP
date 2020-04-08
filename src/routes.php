<?php
/* URL VIRGIN */
Core\Router::connect('/', ['controller' => 'app', 'action' => 'index']);
/* REGISTER */
Core\Router::connect('/register', ['controller' => 'user', 'action' => 'add']);
Core\Router::connect('/register/save', ['controller' => 'user', 'action' => 'register']);
/* LOGIN */
Core\Router::connect('/login', ['controller' => 'user', 'action' => 'login']);
Core\Router::connect('/login/connexion', ['controller' => 'user', 'action' => 'loginUser']);
/* USER */
Core\Router::connect('/delete/{id}', ['controller' => 'user', 'action' => 'delete']);
Core\Router::connect('/user/details/{id}', ['controller' => 'user', 'action' => 'details']);
/* 42 */
Core\Router::connect('/user/42', ['controller' => 'user', 'action' => 'caca']);