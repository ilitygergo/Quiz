<?php

Route::set('index', function() {
    Index::view('Index');
    Index::test();
});

Route::set('login', function() {
    Login::view('Login');
});

Route::set('profil', function() {
    Profil::view('Profil');
});

Route::set('game', function() {
    Game::view('Game');
});
