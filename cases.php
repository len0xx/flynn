<?php

//
// F L Y N N — v0.57
//
// "Cases" file 
// this file searches for certain phrases in users' message and decides what reply to send him
//

// Default phrases
$defaults = ["Я не понимаю тебя", "К сожалению, я не могу тебя понять", "Кажется, я не понимаю, о чём ты"];
$greets = ["Привет, ".FLN_USER_FIRST_NAME."!", "Привет, ".FLN_USER_FIRST_NAME."!"];
$forbs = ["Неожидал услышать от тебя такие слова!", "Мне неприятно читать твою нецензурную лексику!"];

// Processing all the possible cases and choosing the valid reply variant
// incase of undefined case, returning the default reply
if (count($message) < 4 && (has("or", ["привет", "здравствуй", "здравствуйте", "ку"]))) send(FLN_APPNAME, "Привет, ".FLN_USER_FIRST_NAME."!", "");
elseif (count($message) < 3 && (has("or", ["пока", "прощай"]) || has("and", ["до", "свидания"]) || has("and", ["до", "встречи"]))) send(FLN_APPNAME, "Возвращайся снова!", "");
elseif (count($message) < 5 && (has("and", ["что", "солнце"]) || has("and", ["расскажи", "про", "солнце"]))) send(FLN_APPNAME, ifile("sun"), "photo-188445631_457239028");
elseif (count($message) < 5 && (has("and", ["что", "меркурий"]) || has("and", ["расскажи", "про", "меркурий"]))) send(FLN_APPNAME, ifile("mercury"), "photo-188445631_457239045");
elseif (count($message) < 5 && (has("and", ["что", "венера"]) || has("and", ["расскажи", "про", "венеру"]))) send(FLN_APPNAME, ifile("venus"), "photo-188445631_457239041");
elseif (count($message) < 5 && (has("and", ["что", "земля"]) || has("and", ["расскажи", "про", "землю"]))) send(FLN_APPNAME, ifile("earth"), "photo-188445631_457239042");
elseif (count($message) < 5 && (has("and", ["что", "марс"]) || has("and", ["расскажи", "про", "марс"]))) send(FLN_APPNAME, ifile("mars"), "photo-188445631_457239024");
elseif (count($message) < 5 && (has("and", ["что", "юпитер"]) || has("and", ["расскажи", "про", "юпитер"]))) send(FLN_APPNAME, ifile("jupiter"), "photo-188445631_457239043");
elseif (count($message) < 5 && (has("and", ["что", "сатурн"]) || has("and", ["расскажи", "про", "сатурн"]))) send(FLN_APPNAME, ifile("saturn"), "photo-188445631_457239032");
elseif (count($message) < 5 && (has("and", ["что", "уран"]) || has("and", ["расскажи", "про", "уран"]))) send(FLN_APPNAME, ifile("uranus"), "photo-188445631_457239040");
elseif (count($message) < 5 && (has("and", ["что", "нептун"]) || has("and", ["расскажи", "про", "нептун"]))) send(FLN_APPNAME, ifile("neptune"), "photo-188445631_457239047");
elseif (count($message) < 5 && (has("and", ["что", "звезда"]) && has("not", ["нейтронная"]) && has("not", ["двойная"]))) send(FLN_APPNAME, ifile("star"), "");
elseif (count($message) < 5 && (has("and", ["как", "рождается", "звезда"]) || has("and", ["как", "появляется", "звезда"]) || has("and", ["как", "рождаются", "звезды"]) || has("and", ["как", "появляются", "звезды"]))) send(FLN_APPNAME, ifile("star_formation"), "");
elseif (count($message) < 4 && (has("and", ["что", "планета"]))) send(FLN_APPNAME, ifile("planet"), "");
elseif (count($message) < 4 && (has("and", ["что", "экзопланета"]))) send(FLN_APPNAME, ifile("exoplanet"), "");
elseif (count($message) < 4 && (has("and", ["что", "квазар"]))) send(FLN_APPNAME, ifile("quasar"), "");
elseif (count($message) < 4 && (has("and", ["что", "пульсар"]))) send(FLN_APPNAME, ifile("pulsar"), "");
elseif (count($message) < 5 && (has("and", ["что", "космос"]) || has("and", ["расскажи", "про", "космос"]))) send(FLN_APPNAME, ifile("cosmos"), "");
elseif (count($message) < 5 && (has("and", ["что", "кротовая", "нора"]))) send(FLN_APPNAME, ifile("wormholes"), "");
elseif (count($message) < 4 && (has("and", ["что", "галактика"]))) send(FLN_APPNAME, ifile("galaxy"), "");
elseif (count($message) < 6 && (has("and", ["какая", "звезда", "ближайшая"]))) send(FLN_APPNAME, ifile("nearest_star"), "");
elseif (count($message) < 4 && (has("and", ["что", "спутник"]))) send(FLN_APPNAME, ifile("satellite"), "");
elseif (count($message) < 6 && (has("and", ["искусственные", "спутники", "земли"]))) send(FLN_APPNAME, ifile("artificial_satellites"), "");
elseif (count($message) < 5 && (has("and", ["спутники", "сатурна"]))) send(FLN_APPNAME, ifile("saturn_satellites"), "");
elseif (count($message) < 5 && (has("and", ["спутники", "юпитера"]))) send(FLN_APPNAME, ifile("jupiter_satellites"), "");
elseif (count($message) < 5 && (has("and", ["спутники", "меркурия"]))) send(FLN_APPNAME, ifile("mercury_satellites"), "");
elseif (count($message) < 5 && (has("and", ["спутники", "марса"]))) send(FLN_APPNAME, ifile("mars_satellites"), "");
elseif (count($message) < 5 && (has("and", ["спутники", "венеры"]))) send(FLN_APPNAME, ifile("venus_satellites"), "");
elseif (count($message) < 5 && (has("and", ["спутники", "нептуна"]))) send(FLN_APPNAME, ifile("neptune_satellites"), "");
elseif (count($message) < 5 && (has("and", ["спутники", "урана"]))) send(FLN_APPNAME, ifile("uranus_satellites"), "");
elseif (count($message) < 5 && (has("and", ["что", "млечный", "путь"]) || has("and", ["расскажи", "про", "млечный", "путь"]))) send(FLN_APPNAME, ifile("milky_way"), "photo-188445631_457239026");
elseif (count($message) < 5 && (has("and", ["что", "черная", "дыра"]) || has("and", ["расскажи", "про", "черную", "дыру"]))) send(FLN_APPNAME, ifile("blackholes"), "photo-188445631_457239037");
elseif (count($message) < 5 && (has("and", ["что", "чёрная", "дыра"]) || has("and", ["расскажи", "про", "чёрную", "дыру"]))) send(FLN_APPNAME, ifile("blackholes"), "photo-188445631_457239037");
elseif (count($message) < 5 && (has("and", ["что", "нейтронная", "звезда"]) || has("and", ["расскажи", "про", "нейтронную", "звезду"]))) send(FLN_APPNAME, ifile("neutron_stars"), "photo-188445631_457239038");
elseif (count($message) < 5 && (has("and", ["что", "астрономическая", "единица"]))) send(FLN_APPNAME, ifile("au"), "");
elseif (count($message) < 4 && (has("and", ["что", "луна"]) || has("and", ["расскажи", "про", "луну"]))) send(FLN_APPNAME, ifile("moon"), "photo-188445631_457239046  ");
elseif (count($message) < 4 && (has("and", ["что", "парсек"]))) send(FLN_APPNAME, ifile("parsec"), "");
elseif (count($message) < 5 && (has("and", ["что", "солнечная", "система"]) || has("and", ["расскажи", "про", "солнечную", "систему"]))) send(FLN_APPNAME, ifile("solar_system"), "photo-188445631_457239029");
elseif (count($message) < 4 && (has("and", ["что", "сверхновая"]) || has("and", ["расскажи", "про", "сверхновую"]))) send(FLN_APPNAME, ifile("supernova"), "photo-188445631_457239044");
elseif (count($message) < 10 && (has("and", ["кто", "гагарин"]) || has("and", ["расскажи", "про", "гагарина"]))) send(FLN_APPNAME, ifile("gagarin"), "");
elseif (count($message) < 10 && (has("and", ["кто", "терешкова"]) || has("and", ["расскажи", "про", "терешкову"]))) send(FLN_APPNAME, ifile("tereshkova"), "");
elseif (count($message) < 10 && (has("and", ["кто", "леонов"]) || has("and", ["расскажи", "про", "леонова"]))) send(FLN_APPNAME, ifile("leonov"), "");
elseif (count($message) < 10 && (has("and", ["кто", "армстронг"]) || has("and", ["расскажи", "про", "армстронга"]))) send(FLN_APPNAME, ifile("armstrong"), "");
elseif (count($message) < 10 && (has("and", ["кто", "олдрин"]) || has("and", ["расскажи", "про", "олдрина"]))) send(FLN_APPNAME, ifile("aldrin"), "");
elseif (count($message) < 10 && (has("and", ["что", "аполлон"]) || has("and", ["расскажи", "про", "высадку", "на", "луну"]))) send(FLN_APPNAME, ifile("apollo"), "");
elseif (count($message) < 10 && (has("and", ["что", "протозвезда"]) || has("and", ["расскажи", "про", "протозвезды"]))) send(FLN_APPNAME, ifile("protostar"), "");
elseif (count($message) < 10 && (has("and", ["что", "небесная", "сфера"]) || has("and", ["расскажи", "про", "небесную", "сферу"]))) send(FLN_APPNAME, ifile("aerosphere"), "");
elseif (count($message) < 10 && (has("and", ["что", "затмение"]) || has("and", ["расскажи", "про", "затмение"]))) send(FLN_APPNAME, ifile("eclipse"), "");
elseif (count($message) < 10 && (has("and", ["что", "звездообразование"]) || has("and", ["расскажи", "про", "звездообразование"]))) send(FLN_APPNAME, ifile("star_formation"), "");
elseif (count($message) < 10 && (has("and", ["что", "красный", "гигант"]) || has("and", ["расскажи", "про", "красный", "гигант"]))) send(FLN_APPNAME, ifile("red_giant"), "");
elseif (count($message) < 10 && (has("and", ["что", "белый", "карлик"]) || has("and", ["расскажи", "про", "белый", "карлик"]))) send(FLN_APPNAME, ifile("white_dwarf"), "");
elseif (count($message) < 10 && (has("and", ["что", "двойная", "звезда"]) || has("and", ["расскажи", "про", "двойную", "звезду"]))) send(FLN_APPNAME, ifile("binary_star"), "");
elseif (count($message) < 10 && (has("and", ["какие", "книги", "про", "космос"]) || has("and", ["какие", "книги", "про", "астрономию"]))) send(FLN_APPNAME, ifile("books"), "");
elseif (count($message) < 10 && (has("and", ["когда", "день", "космонавтики"]) || has("and", ["расскажи", "про", "день", "космонавтики"]))) send(FLN_APPNAME, ifile("cosmo_day"), "");
elseif (count($message) < 10 && (has("and", ["что", "скорость", "света"]) || has("and", ["чему", "равна", "скорость", "света"]))) send(FLN_APPNAME, ifile("light_speed"), "");
elseif (count($message) < 10 && (has("and", ["что", "световой", "год"]))) send(FLN_APPNAME, ifile("light_year"), "");
elseif (count($message) < 10 && (has("and", ["что", "световой", "день"]))) send(FLN_APPNAME, ifile("light_day"), "");
elseif (count($message) < 10 && (has("and", ["что", "ты", "можешь"]) || has("and", ["что", "ты", "умеешь"]) || has("and", ["список", "вопросов"]))) send(FLN_APPNAME, ifile("list"), "");
elseif (count($message) < 10 && (has("and", ["спасибо"]))) send(FLN_APPNAME, "Не за что, обращайся ещё!", "");
elseif (count($message) < 10 && (has("or", $forbidden))) send(FLN_APPNAME, getr($forbs), ""); // Forbidden words
elseif (count($message) < 10 && (has("and", ["сколько", "в", "световых", "годах"]) && count($message) > 5 && count($message) < 8)) send(FLN_APPNAME, calc("light_years"), "");
elseif (count($message) < 10 && (has("and", ["сколько", "в", "световых", "днях"]) && count($message) > 5 && count($message) < 8)) send(FLN_APPNAME, calc("light_days"), "");
elseif (count($message) < 10 && (has("and", ["сколько", "в", "астрономических", "единицах"]) && count($message) > 5 && count($message) < 9)) send(FLN_APPNAME, calc("au"), "");
elseif (count($message) < 10 && (has("and", ["сколько", "в", "парсеках"]) && count($message) > 4 && count($message) < 7)) send(FLN_APPNAME, calc("parsec"), "");
elseif (count($message) < 10 && (has("and", ["сколько", "в", "световом", "году"]) && count($message) > 5 && count($message) < 8)) send(FLN_APPNAME, calc("light_years1"), "");
elseif (count($message) < 10 && (has("and", ["сколько", "в", "световом", "дне"]) && count($message) > 5 && count($message) < 8)) send(FLN_APPNAME, calc("light_days1"), "");
elseif (count($message) < 10 && (has("and", ["сколько", "в", "астрономической", "единице"]) && count($message) > 5 && count($message) < 9)) send(FLN_APPNAME, calc("au1"), "");
elseif (count($message) < 10 && (has("and", ["сколько", "в", "парсеке"]) && count($message) > 4 && count($message) < 7)) send(FLN_APPNAME, calc("parsec1"), "");
else send(FLN_APPNAME, getr($defaults), "");

?>
