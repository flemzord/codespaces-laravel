<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/peliculas', function () {
    return view('peliculas');
});

Route::get('/sumar', function () {
    return view('sumar');
});

Route::post('/sumar', function (Request $request) {
    $numero1 = $request->input('numero1');
    $numero2 = $request->input('numero2');
    $resultado = $numero1 + $numero2;

    return view('sumar', ['resultado' => $resultado]);
});



//web.php son rutas que devuelven vistas
?>

