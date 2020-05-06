<?php

Route::get("check-migrant-code/{code}", "ApiController@check_migrant_code");
Route::get("give-food-to-migrant/{token}", "ApiController@give_food");