<?php

//
// F L Y N N — v0.45
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
if (has("or", ["привет", "здравствуй", "здравствуйте", "ку"])) send("Привет, ".FLN_USER_FIRST_NAME."!", "");
elseif (has("or", ["пока", "прощай"]) || has("and", ["до", "свидания"]) || has("and", ["до", "встречи"])) send("Возвращайся снова!", "");
elseif (has("and", ["что", "солнце"]) || has("and", ["расскажи", "про", "солнце"])) send(ifile("sun"), "photo-188445631_457239028");
elseif (has("and", ["что", "меркурий"]) || has("and", ["расскажи", "про", "меркурий"])) send(ifile("mercury"), "photo-188445631_457239045");
elseif (has("and", ["что", "венера"]) || has("and", ["расскажи", "про", "венеру"])) send(ifile("venus"), "photo-188445631_457239041");
elseif (has("and", ["что", "земля"]) || has("and", ["расскажи", "про", "землю"])) send(ifile("earth"), "photo-188445631_457239042");
elseif (has("and", ["что", "марс"]) || has("and", ["расскажи", "про", "марс"])) send(ifile("mars"), "photo-188445631_457239024");
elseif (has("and", ["что", "юпитер"]) || has("and", ["расскажи", "про", "юпитер"])) send(ifile("jupiter"), "photo-188445631_457239043");
elseif (has("and", ["что", "сатурн"]) || has("and", ["расскажи", "про", "сатурн"])) send(ifile("saturn"), "photo-188445631_457239032");
elseif (has("and", ["что", "уран"]) || has("and", ["расскажи", "про", "уран"])) send(ifile("uranus"), "photo-188445631_457239040");
elseif (has("and", ["что", "нептун"]) || has("and", ["расскажи", "про", "нептун"])) send(ifile("neptune"), "photo-188445631_457239047");
elseif (has("and", ["что", "звезда"]) && has("not", ["нейтронная"]) && has("not", ["двойная"])) send(ifile("star"), "");
elseif (has("and", ["что", "планета"])) send(ifile("planet"), "");
elseif (has("and", ["что", "экзопланета"])) send(ifile("exoplanet"), "");
elseif (has("and", ["что", "квазар"])) send(ifile("quasar"), "");
elseif (has("and", ["что", "кротовая", "нора"])) send(ifile("wormholes"), "");
elseif (has("and", ["что", "галактика"])) send(ifile("galaxy"), "");
elseif (has("and", ["какая", "звезда", "ближайшая"])) send(ifile("nearest_star"), "");
elseif (has("and", ["что", "спутник"])) send(ifile("satellite"), "");
elseif (has("and", ["что", "млечный", "путь"]) || has("and", ["расскажи", "про", "млечный", "путь"])) send(ifile("milky_way"), "photo-188445631_457239026");
elseif (has("and", ["что", "черная", "дыра"]) || has("and", ["расскажи", "про", "черную", "дыру"])) send(ifile("blackholes"), "photo-188445631_457239037");
elseif (has("and", ["что", "нейтронная", "звезда"]) || has("and", ["расскажи", "про", "нейтронную", "звезду"])) send(ifile("neutron_stars"), "photo-188445631_457239038");
elseif (has("and", ["что", "астрономическая", "единица"])) send(ifile("au"), "");
elseif (has("and", ["что", "луна"]) || has("and", ["расскажи", "про", "луну"])) send(ifile("moon"), "photo-188445631_457239046  ");
elseif (has("and", ["что", "парсек"])) send(ifile("parsec"), "");
elseif (has("and", ["что", "солнечная", "система"]) || has("and", ["расскажи", "про", "солнечную", "систему"])) send(ifile("solar_system"), "photo-188445631_457239029");
elseif (has("and", ["что", "сверхновая"]) || has("and", ["расскажи", "про", "сверхновую"])) send(ifile("supernova"), "photo-188445631_457239044");
elseif (has("and", ["кто", "гагарин"]) || has("and", ["расскажи", "про", "гагарина"])) send(ifile("gagarin"), "");
elseif (has("and", ["кто", "терешкова"]) || has("and", ["расскажи", "про", "терешкову"])) send(ifile("tereshkova"), "");
elseif (has("and", ["кто", "леонов"]) || has("and", ["расскажи", "про", "леонова"])) send(ifile("leonov"), "");
elseif (has("and", ["кто", "армстронг"]) || has("and", ["расскажи", "про", "армстронга"])) send(ifile("armstrong"), "");
elseif (has("and", ["кто", "олдрин"]) || has("and", ["расскажи", "про", "олдрина"])) send(ifile("aldrin"), "");
elseif (has("and", ["что", "аполлон"]) || has("and", ["расскажи", "про", "высадку", "на", "луну"])) send(ifile("apollo"), "");
elseif (has("and", ["что", "протозвезда"]) || has("and", ["расскажи", "про", "протозвезды"])) send(ifile("protostar"), "");
elseif (has("and", ["что", "небесная", "сфера"]) || has("and", ["расскажи", "про", "небесную", "сферу"])) send(ifile("aerosphere"), "");
elseif (has("and", ["что", "затмение"]) || has("and", ["расскажи", "про", "затмение"])) send(ifile("eclipse"), "");
elseif (has("and", ["что", "звездообразование"]) || has("and", ["расскажи", "про", "звездообразование"])) send(ifile("star_formation"), "");
elseif (has("and", ["что", "красный", "гигант"]) || has("and", ["расскажи", "про", "красный", "гигант"])) send(ifile("red_giant"), "");
elseif (has("and", ["что", "белый", "карлик"]) || has("and", ["расскажи", "про", "белый", "карлик"])) send(ifile("white_dwarf"), "");
elseif (has("and", ["что", "двойная", "звезда"]) || has("and", ["расскажи", "про", "двойную", "звезду"])) send(ifile("binary_star"), "");
elseif (has("and", ["какие", "книги", "про", "космос"])) send(ifile("books"), "");
elseif (has("and", ["когда", "день", "космонавтики"]) || has("and", ["расскажи", "про", "день", "космонавтики"])) send(ifile("cosmo_day"), "");
elseif (has("and", ["что", "световой", "год"])) send(ifile("light_year"), "");
elseif (has("and", ["что", "ты", "можешь"]) || has("and", ["что", "ты", "умеешь"]) || has("and", ["список", "вопросов"])) send(ifile("list"), "");
elseif (has("and", ["спасибо"])) send("Не за что, обращайся ещё!", "");
elseif (has("or", $forbidden)) send(getr($forbs), ""); // Forbidden words
else send(getr($defaults), "");

?>
