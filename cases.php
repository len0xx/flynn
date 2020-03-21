<?php

//
// F L Y N N — v0.56
//
// "Cases" file 
// this file searches for certain phrases in users' message and decides what reply to send him
//

// Наборы стандартных фраз
$defaults = ["Я не понимаю тебя", "К сожалению, я не могу тебя понять", "Кажется, я не понимаю, о чём ты"];
$greets = ["Привет, ".FLN_USER_FIRST_NAME."!", "Привет, ".FLN_USER_FIRST_NAME."!"];
$forbs = ["Неожидал услышать от тебя такие слова!", "Мне неприятно читать твою нецензурную лексику!"];

// Обрабатываем все возможные кейсы полученных сообщений и подбираем нужный ответ
// в случае нераспознанного сообщения возвращаем дефолтный ответ
if (count($message) < 4 && (has("or", ["привет", "здравствуй", "здравствуйте", "ку"]))) send("Привет, ".FLN_USER_FIRST_NAME."!", "");
elseif (count($message) < 3 && (has("or", ["пока", "прощай"]) || has("and", ["до", "свидания"]) || has("and", ["до", "встречи"]))) send("Возвращайся снова!", "");
elseif (count($message) < 5 && (has("and", ["что", "солнце"]) || has("and", ["расскажи", "про", "солнце"]))) send(ifile("sun"), "photo-188445631_457239028");
elseif (count($message) < 5 && (has("and", ["что", "меркурий"]) || has("and", ["расскажи", "про", "меркурий"]))) send(ifile("mercury"), "photo-188445631_457239045");
elseif (count($message) < 5 && (has("and", ["что", "венера"]) || has("and", ["расскажи", "про", "венеру"]))) send(ifile("venus"), "photo-188445631_457239041");
elseif (count($message) < 5 && (has("and", ["что", "земля"]) || has("and", ["расскажи", "про", "землю"]))) send(ifile("earth"), "photo-188445631_457239042");
elseif (count($message) < 5 && (has("and", ["что", "марс"]) || has("and", ["расскажи", "про", "марс"]))) send(ifile("mars"), "photo-188445631_457239024");
elseif (count($message) < 5 && (has("and", ["что", "юпитер"]) || has("and", ["расскажи", "про", "юпитер"]))) send(ifile("jupiter"), "photo-188445631_457239043");
elseif (count($message) < 5 && (has("and", ["что", "сатурн"]) || has("and", ["расскажи", "про", "сатурн"]))) send(ifile("saturn"), "photo-188445631_457239032");
elseif (count($message) < 5 && (has("and", ["что", "уран"]) || has("and", ["расскажи", "про", "уран"]))) send(ifile("uranus"), "photo-188445631_457239040");
elseif (count($message) < 5 && (has("and", ["что", "нептун"]) || has("and", ["расскажи", "про", "нептун"]))) send(ifile("neptune"), "photo-188445631_457239047");
elseif (count($message) < 5 && (has("and", ["что", "звезда"]) && has("not", ["нейтронная"]) && has("not", ["двойная"]))) send(ifile("star"), "");
elseif (count($message) < 5 && (has("and", ["как", "рождается", "звезда"]) || has("and", ["как", "появляется", "звезда"]) || has("and", ["как", "рождаются", "звезды"]) || has("and", ["как", "появляются", "звезды"]))) send(ifile("star_formation"), "");
elseif (count($message) < 4 && (has("and", ["что", "планета"]))) send(ifile("planet"), "");
elseif (count($message) < 4 && (has("and", ["что", "экзопланета"]))) send(ifile("exoplanet"), "");
elseif (count($message) < 4 && (has("and", ["что", "квазар"]))) send(ifile("quasar"), "");
elseif (count($message) < 4 && (has("and", ["что", "пульсар"]))) send(ifile("pulsar"), "");
elseif (count($message) < 5 && (has("and", ["что", "космос"]) || has("and", ["расскажи", "про", "космос"]))) send(ifile("cosmos"), "");
elseif (count($message) < 5 && (has("and", ["что", "кротовая", "нора"]))) send(ifile("wormholes"), "");
elseif (count($message) < 4 && (has("and", ["что", "галактика"]))) send(ifile("galaxy"), "");
elseif (count($message) < 6 && (has("and", ["какая", "звезда", "ближайшая"]))) send(ifile("nearest_star"), "");
elseif (count($message) < 4 && (has("and", ["что", "спутник"]))) send(ifile("satellite"), "");
elseif (count($message) < 6 && (has("and", ["искусственные", "спутники", "земли"]))) send(ifile("artificial_satellites"), "");
elseif (count($message) < 5 && (has("and", ["спутники", "сатурна"]))) send(ifile("saturn_satellites"), "");
elseif (count($message) < 5 && (has("and", ["спутники", "юпитера"]))) send(ifile("jupiter_satellites"), "");
elseif (count($message) < 5 && (has("and", ["спутники", "меркурия"]))) send(ifile("mercury_satellites"), "");
elseif (count($message) < 5 && (has("and", ["спутники", "марса"]))) send(ifile("mars_satellites"), "");
elseif (count($message) < 5 && (has("and", ["спутники", "венеры"]))) send(ifile("venus_satellites"), "");
elseif (count($message) < 5 && (has("and", ["спутники", "нептуна"]))) send(ifile("neptune_satellites"), "");
elseif (count($message) < 5 && (has("and", ["спутники", "урана"]))) send(ifile("uranus_satellites"), "");
elseif (count($message) < 5 && (has("and", ["что", "млечный", "путь"]) || has("and", ["расскажи", "про", "млечный", "путь"]))) send(ifile("milky_way"), "photo-188445631_457239026");
elseif (count($message) < 5 && (has("and", ["что", "черная", "дыра"]) || has("and", ["расскажи", "про", "черную", "дыру"]))) send(ifile("blackholes"), "photo-188445631_457239037");
elseif (count($message) < 5 && (has("and", ["что", "чёрная", "дыра"]) || has("and", ["расскажи", "про", "чёрную", "дыру"]))) send(ifile("blackholes"), "photo-188445631_457239037");
elseif (count($message) < 5 && (has("and", ["что", "нейтронная", "звезда"]) || has("and", ["расскажи", "про", "нейтронную", "звезду"]))) send(ifile("neutron_stars"), "photo-188445631_457239038");
elseif (count($message) < 5 && (has("and", ["что", "астрономическая", "единица"]))) send(ifile("au"), "");
elseif (count($message) < 4 && (has("and", ["что", "луна"]) || has("and", ["расскажи", "про", "луну"]))) send(ifile("moon"), "photo-188445631_457239046  ");
elseif (count($message) < 4 && (has("and", ["что", "парсек"]))) send(ifile("parsec"), "");
elseif (count($message) < 5 && (has("and", ["что", "солнечная", "система"]) || has("and", ["расскажи", "про", "солнечную", "систему"]))) send(ifile("solar_system"), "photo-188445631_457239029");
elseif (count($message) < 4 && (has("and", ["что", "сверхновая"]) || has("and", ["расскажи", "про", "сверхновую"]))) send(ifile("supernova"), "photo-188445631_457239044");
elseif (count($message) < 10 && (has("and", ["кто", "гагарин"]) || has("and", ["расскажи", "про", "гагарина"]))) send(ifile("gagarin"), "");
elseif (count($message) < 10 && (has("and", ["кто", "терешкова"]) || has("and", ["расскажи", "про", "терешкову"]))) send(ifile("tereshkova"), "");
elseif (count($message) < 10 && (has("and", ["кто", "леонов"]) || has("and", ["расскажи", "про", "леонова"]))) send(ifile("leonov"), "");
elseif (count($message) < 10 && (has("and", ["кто", "армстронг"]) || has("and", ["расскажи", "про", "армстронга"]))) send(ifile("armstrong"), "");
elseif (count($message) < 10 && (has("and", ["кто", "олдрин"]) || has("and", ["расскажи", "про", "олдрина"]))) send(ifile("aldrin"), "");
elseif (count($message) < 10 && (has("and", ["что", "аполлон"]) || has("and", ["расскажи", "про", "высадку", "на", "луну"]))) send(ifile("apollo"), "");
elseif (count($message) < 10 && (has("and", ["что", "протозвезда"]) || has("and", ["расскажи", "про", "протозвезды"]))) send(ifile("protostar"), "");
elseif (count($message) < 10 && (has("and", ["что", "небесная", "сфера"]) || has("and", ["расскажи", "про", "небесную", "сферу"]))) send(ifile("aerosphere"), "");
elseif (count($message) < 10 && (has("and", ["что", "затмение"]) || has("and", ["расскажи", "про", "затмение"]))) send(ifile("eclipse"), "");
elseif (count($message) < 10 && (has("and", ["что", "звездообразование"]) || has("and", ["расскажи", "про", "звездообразование"]))) send(ifile("star_formation"), "");
elseif (count($message) < 10 && (has("and", ["что", "красный", "гигант"]) || has("and", ["расскажи", "про", "красный", "гигант"]))) send(ifile("red_giant"), "");
elseif (count($message) < 10 && (has("and", ["что", "белый", "карлик"]) || has("and", ["расскажи", "про", "белый", "карлик"]))) send(ifile("white_dwarf"), "");
elseif (count($message) < 10 && (has("and", ["что", "двойная", "звезда"]) || has("and", ["расскажи", "про", "двойную", "звезду"]))) send(ifile("binary_star"), "");
elseif (count($message) < 10 && (has("and", ["какие", "книги", "про", "космос"]) || has("and", ["какие", "книги", "про", "астрономию"]))) send(ifile("books"), "");
elseif (count($message) < 10 && (has("and", ["когда", "день", "космонавтики"]) || has("and", ["расскажи", "про", "день", "космонавтики"]))) send(ifile("cosmo_day"), "");
elseif (count($message) < 10 && (has("and", ["что", "скорость", "света"]) || has("and", ["чему", "равна", "скорость", "света"]))) send(ifile("light_speed"), "");
elseif (count($message) < 10 && (has("and", ["что", "световой", "год"]))) send(ifile("light_year"), "");
elseif (count($message) < 10 && (has("and", ["что", "световой", "день"]))) send(ifile("light_day"), "");
elseif (count($message) < 10 && (has("and", ["что", "ты", "можешь"]) || has("and", ["что", "ты", "умеешь"]) || has("and", ["список", "вопросов"]))) send(ifile("list"), "");
elseif (count($message) < 10 && (has("and", ["спасибо"]))) send("Не за что, обращайся ещё!", "");
elseif (count($message) < 10 && (has("or", $forbidden))) send(getr($forbs), ""); // Forbidden words
elseif (count($message) < 10 && (has("and", ["сколько", "в", "световых", "годах"]) && count($message) > 5 && count($message) < 8)) send(calc("light_years"), "");
elseif (count($message) < 10 && (has("and", ["сколько", "в", "световых", "днях"]) && count($message) > 5 && count($message) < 8)) send(calc("light_days"), "");
elseif (count($message) < 10 && (has("and", ["сколько", "в", "астрономических", "единицах"]) && count($message) > 5 && count($message) < 9)) send(calc("au"), "");
elseif (count($message) < 10 && (has("and", ["сколько", "в", "парсеках"]) && count($message) > 4 && count($message) < 7)) send(calc("parsec"), "");
elseif (count($message) < 10 && (has("and", ["сколько", "в", "световом", "году"]) && count($message) > 5 && count($message) < 8)) send(calc("light_years1"), "");
elseif (count($message) < 10 && (has("and", ["сколько", "в", "световом", "дне"]) && count($message) > 5 && count($message) < 8)) send(calc("light_days1"), "");
elseif (count($message) < 10 && (has("and", ["сколько", "в", "астрономической", "единице"]) && count($message) > 5 && count($message) < 9)) send(calc("au1"), "");
elseif (count($message) < 10 && (has("and", ["сколько", "в", "парсеке"]) && count($message) > 4 && count($message) < 7)) send(calc("parsec1"), "");
else send(getr($defaults), "");

?>
