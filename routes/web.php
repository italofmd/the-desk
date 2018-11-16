<?php

Auth::routes();

Route::group(['prefix' => '/', 'middleware' => 'auth'], function(){

    Route::get('', 'HomeController@index')->name('home');
    Route::get('notificacoes', 'HomeController@showNotification')->name('notification');

});

Route::group(['prefix' => '/', 'middleware' => 'guest'], function(){

    Route::get('cadastro', 'HomeController@showRegister')->name('register');
    Route::post('cadastro', 'HomeController@saveRegister')->name('register');

});

Route::group(['prefix' => 'equipamentos', 'middleware' => 'auth'], function(){

    Route::get('', 'EquipmentController@showIndex')->name('equipmentIndex');
    Route::get('cadastrar', 'EquipmentController@showCreate')->name('equipmentCreate');
    Route::post('cadastrar', 'EquipmentController@saveCreate')->name('equipmentCreate');
    Route::get('editar/{id}', 'EquipmentController@showEdit')->name('equipmentEdit');
    Route::post('editar/{id}', 'EquipmentController@saveEdit')->name('equipmentEdit');
    Route::get('apagar/{id}', 'EquipmentController@saveDelete')->name('equipmentDelete'); 

});

Route::group(['prefix' => 'categorias', 'middleware' => 'auth'], function(){

    Route::get('', 'TicketCategoryController@showIndex')->name('categoryIndex');
    Route::post('cadastrar', 'TicketCategoryController@saveCreate')->name('categoryCreate');
    Route::get('apagar/{id}', 'TicketCategoryController@saveDelete')->name('categoryDelete');
    Route::get('editar/{id}', 'TicketCategoryController@showEdit')->name('categoryEdit');
    Route::post('editar/{id}', 'TicketCategoryController@saveEdit')->name('categoryEdit');    
   
});

Route::group(['prefix' => 'usuarios', 'middleware' => 'auth'], function(){

    Route::get('', 'UserController@showIndex')->name('userIndex');
    Route::get('cadastrar', 'UserController@showCreate')->name('userCreate');
    Route::post('cadastrar', 'UserController@saveCreate')->name('userCreate');
    Route::get('editar/{id}', 'UserController@showEdit')->name('userEdit');
    Route::post('editar/{id}', 'UserController@saveEdit')->name('userEdit');
    Route::get('apagar/{id}', 'UserController@saveDelete')->name('userDelete');
    Route::get('editar/{id}/estado/cidades/{state_id}', 'UserController@getCity');
      
});

Route::group(['prefix' => 'tickets', 'middleware' => 'auth'], function(){

    Route::get('', 'TicketController@showIndex')->name('ticketIndex');
    Route::get('abrir', 'TicketController@showCreate')->name('ticketCreate');
    Route::post('abrir', 'TicketController@saveCreate')->name('ticketCreate');
    Route::get('apagar/{id}', 'TicketController@saveDelete')->name('ticketDelete');
    Route::get('visualizar/{id}', 'TicketController@showView')->name('ticketView');
    Route::post('visualizar/mensagens/{id}', 'TicketController@saveMessage')->name('messageCreate');    
    Route::post('atualizar/{id}', 'TicketController@saveUpdate')->name('ticketUpdate');
    
});

Route::group(['prefix' => 'perfil', 'middleware' => 'auth'], function(){

    Route::get('editar', 'ProfileController@showEdit')->name('profileEdit');
    Route::post('editar', 'ProfileController@saveEdit')->name('profileEdit');
    Route::get('senha', 'ProfileController@showPassword')->name('profilePassword');
    Route::post('senha', 'ProfileController@savePassword')->name('profilePassword');
    Route::get('editar/estado/cidades/{id}', 'ProfileController@getCity');
   
});

Route::group(['prefix' => 'relatorios', 'middleware' => 'auth'], function(){

    Route::get('', 'ReportController@showIndex')->name('reportIndex');
    Route::get('imprimir', 'ReportController@showPrint')->name('reportPrint');
    Route::get('periodo', 'ReportController@showPeriod')->name('reportPeriod');
    Route::post('periodo', 'ReportController@savePeriod')->name('reportPeriod');
    Route::post('periodo/imprimir', 'ReportController@showPeriodPrint')->name('reportPeriodPrint');
});

Route::group(['prefix' => 'estatisticas', 'middleware' => 'auth'], function(){

    Route::get('', 'StatisticController@showIndex')->name('statisticIndex');    
   
});

Route::group(['prefix' => 'artigos', 'middleware' => 'auth'], function(){

    Route::get('', 'ArticleController@showIndex')->name('articleIndex');
    Route::get('cadastrar', 'ArticleController@showCreate')->name('articleCreate');
    Route::post('cadastrar', 'ArticleController@saveCreate')->name('articleCreate');
    Route::get('apagar/{id}', 'ArticleController@saveDelete')->name('articleDelete');
    Route::get('editar/{id}', 'ArticleController@showEdit')->name('articleEdit');
    Route::post('editar/{id}', 'ArticleController@saveEdit')->name('articleEdit');

});

Route::group(['prefix' => 'artigos/categorias', 'middleware' => 'auth'], function(){

    Route::get('', 'ArticleCategoryController@showIndex')->name('articleCategoryIndex');
    Route::get('cadastrar', 'ArticleCategoryController@showCreate')->name('articleCategoryCreate');
    Route::post('cadastrar', 'ArticleCategoryController@saveCreate')->name('articleCategoryCreate');
    Route::get('apagar/{id}', 'ArticleCategoryController@saveDelete')->name('articleCategoryDelete');
    Route::get('editar/{id}', 'ArticleCategoryController@showEdit')->name('articleCategoryEdit');
    Route::post('editar/{id}', 'ArticleCategoryController@saveEdit')->name('articleCategoryEdit');

});

Route::group(['prefix' => 'conhecimento', 'middleware' => 'auth'], function(){

    Route::get('', 'KnowledgeController@showIndex')->name('knowledge');
    Route::get('pesquisar', 'KnowledgeController@showSearch')->name('knowledgeSearch');

});