<?php

Route::set('index', function() {
    Index::view('Index');
});

Route::set('login', function() {
    Login::view('Login');
});

Route::set('profile', function() {
    Profile::view('Profile');
});

Route::set('game', function() {
    Game::view('Game');
});

Route::set('played', function() {
    Played::view('Played');
});

Route::set('friends', function() {
    Friends::view('Friends');
});

Route::set('ranklist', function() {
    Ranklist::view('Ranklist');
});

Route::set('AdminPanel', function() {
    AdminPanel::view('AdminPanel');
});

Route::set('deleteUser', function() {
    Ranklist::action('deleteUser');
});
