<?php

use Illuminate\Http\Request;
use App\Http\Controllers\ToDoController;
 
Route::middleware('auth:sanctum')->group(function() {
    Route::controller(ToDoController::class)->group(function() {
      Route::get('/todos', 'index');
      Route::post('/todos', 'create');
      Route::put('/todos/{id}', 'update');
      Route::delete('/todos/{id}', 'delete');
    });
});

?>