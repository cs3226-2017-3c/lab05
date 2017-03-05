<?php

Route::filter('localization', function() {
    App::setLocale(Route::input('lang'));
});