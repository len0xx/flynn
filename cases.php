<?php

//
// F L Y N N — v0.62
//
// "Cases" file 
// this file searches for certain phrases in users' message and decides what reply to send him
//

// Default phrases
$defaults = ["Я не понимаю тебя", "К сожалению, я не могу тебя понять", "Кажется, я не понимаю, о чём ты"];
$defaults_stickers = ["Я пока что не понимаю таких стикеров :/", "К сожалению, я ещё не знаю, как реагировать на такой стикер", "Кажется, я не понимаю, что значит этот стикер"];
$greets = ["Привет, ".FLN_USER_FIRST_NAME."!", "Привет, ".FLN_USER_FIRST_NAME."!"];
$forbs = ["Неожидал услышать от тебя такие слова!", "Мне неприятно читать твою нецензурную лексику!"];

define("FLN_QUESTIONS", array(
    "Расскажи про Солнце",
    "Расскажи про Землю",
    "Расскажи про Луну",
    "Расскажи про Меркурий",
    "Расскажи про Венеру",
    "Расскажи про Марс",
    "Расскажи про Юпитер",
    "Расскажи про Сатурн",
    "Расскажи про Уран",
    "Расскажи про Нептун",
    "Расскажи про Млечный Путь",
    "Расскажи про Солнечную систему",
    "Что такое планета?",
    "Что такое экзопланета?",
    "Что такое чёрная дыра?",
    "Что такое квазар?",
    "Что такое спутник?",
    "Что такое пульсар?",
    "Что такое космос?",
    "Что такое кротовая нора?",
    "Что такое галактика?",
    "Что такое звезда?",
    "Кто такой Юрий Гагарин?",
    "Кто такой Алексей Леонов?",
    "Кто такой Армстронг?",
    "Кто такой Базз Олдрин?",
    "Расскажи про высадку на Луну",
    "Кто такая Валентина Терешкова?",
    "Расскажи про известных космонавтов",
    "Кто такой Юрий Гагарин?",
    "Спутники Меркурия",
    "Спутники Венеры",
    "Спутники Земли",
    "Спутники Марса",
    "Спутники Юпитера",
    "Спутники Сатурна",
    "Спутники Урана",
    "Спутники Нептуна",
    "Что такое искусственный спутник?",
    "Что такое астрономическая единица?",
    "Что такое световой год?",
    "Что такое световой день?",
    "Чему равна скорость света?",
    "Что такое затмение?",
    "Что такое Вояджер?",
    "Что такое протозвезда?",
    "Какие книги про космос можно почитать?",
    "Какие лучшие фильмы про космос ты знаешь?",
    "Сколько километров в ".rand(2, 10)." парсеках?",
    "Сколько метров в ".rand(2, 15)." световых днях?",
    "Сколько световых лет в ".rand(500, 10000)." астрономических единицах?",
    "Сколько астрономических единиц в ".rand(2, 20)." световых годах?",
    "Сколько парсек в ".rand(10, 35)." световых годах?",
    "Что такое нейтронная звезда?",
    "Что такое двойная звезда?",
    "Что такое красный гигант?",
    "Что такое белый карлик?",
    "Что такое пояс астероидов?",
    "Что такое МКС?",
    "Расскажи про Белку и Стрелку",
    "Первый человек в космосе",
    "Первая женщина в космосе",
    "Почему Земля круглая?",
    "Что такое Хаббл?"
));

$q_list_reply = implode("\n", getr_few(FLN_QUESTIONS, 8));

// Processing all the possible cases and choosing the valid reply variant
// incase of undefined case, returning the default reply

if (!FLN_MESSAGE_EMPTY || FLN_MESSAGE_ATTACHMENT_TYPE == 'fwd_messages') {
    if (count($message) < 4 && (has("or", ["привет", "здравствуй", "здравствуйте", "ку"]))) send(FLN_APPNAME, "Привет, ".FLN_USER_FIRST_NAME."!", "");
    elseif (count($message) < 3 && (has("or", ["пока", "прощай"]) || has("and", ["до", "свидания"]) || has("and", ["до", "встречи"]))) send(FLN_APPNAME, "Возвращайся снова!", "");
    elseif (count($message) < 5 && (has("and", ["что", "солнце"]) || has("and", ["расскажи", "про", "солнце"]))) send(FLN_APPNAME, ifile("sun"), "photo-188445631_457239090");
    elseif (count($message) < 5 && (has("and", ["что", "меркурий"]) || has("and", ["расскажи", "про", "меркурий"]))) send(FLN_APPNAME, ifile("mercury"), "photo-188445631_457239045");
    elseif (count($message) < 5 && (has("and", ["что", "венера"]) || has("and", ["расскажи", "про", "венеру"]))) send(FLN_APPNAME, ifile("venus"), "photo-188445631_457239091");
    elseif (count($message) < 5 && (has("and", ["что", "земля"]) || has("and", ["расскажи", "про", "землю"]))) send(FLN_APPNAME, ifile("earth"), "photo-188445631_457239093");
    elseif (count($message) < 5 && (has("and", ["что", "марс"]) || has("and", ["расскажи", "про", "марс"]))) send(FLN_APPNAME, ifile("mars"), "photo-188445631_457239085");
    elseif (count($message) < 5 && (has("and", ["что", "юпитер"]) || has("and", ["расскажи", "про", "юпитер"]))) send(FLN_APPNAME, ifile("jupiter"), "photo-188445631_457239043");
    elseif (count($message) < 5 && (has("and", ["что", "сатурн"]) || has("and", ["расскажи", "про", "сатурн"]))) send(FLN_APPNAME, ifile("saturn"), "photo-188445631_457239032");
    elseif (count($message) < 5 && (has("and", ["что", "уран"]) || has("and", ["расскажи", "про", "уран"]))) send(FLN_APPNAME, ifile("uranus"), "photo-188445631_457239040");
    elseif (count($message) < 5 && (has("and", ["что", "нептун"]) || has("and", ["расскажи", "про", "нептун"]))) send(FLN_APPNAME, ifile("neptune"), "photo-188445631_457239047");
    elseif (count($message) < 5 && (has("and", ["что", "плутон"]) || has("and", ["расскажи", "про", "плутон"]))) send(FLN_APPNAME, ifile("pluto"), "photo-188445631_457239088");
    elseif (count($message) < 5 && (has("and", ["что", "звезда"]) && has("not", ["нейтронная", "двойная"]))) send(FLN_APPNAME, ifile("star"), "");
    elseif (count($message) < 5 && (has("and", ["как", "рождается", "звезда"]) || has("and", ["как", "появляется", "звезда"]) || has("and", ["как", "рождаются", "звезды"]) || has("and", ["как", "появляются", "звезды"]))) send(FLN_APPNAME, ifile("star_formation"), "");
    elseif (count($message) < 4 && (has("and", ["что", "планета"]))) send(FLN_APPNAME, ifile("planet"), "photo-188445631_457239059");
    elseif (count($message) < 4 && (has("and", ["что", "экзопланета"]))) send(FLN_APPNAME, ifile("exoplanet"), "photo-188445631_457239100");
    elseif (count($message) < 4 && (has("and", ["что", "квазар"]))) send(FLN_APPNAME, ifile("quasar"), "photo-188445631_457239089");
    elseif (count($message) < 4 && (has("and", ["что", "пульсар"]))) send(FLN_APPNAME, ifile("pulsar"), "");
    elseif (count($message) < 5 && (has("and", ["что", "космос"]) || has("and", ["расскажи", "про", "космос"]))) send(FLN_APPNAME, ifile("cosmos"), "photo-188445631_457239078");
    elseif (count($message) < 5 && (has("and", ["что", "кротовая", "нора"]))) send(FLN_APPNAME, ifile("wormholes"), "photo-188445631_457239064");
    elseif (count($message) < 4 && (has("and", ["что", "галактика"]))) send(FLN_APPNAME, ifile("galaxy"), "photo-188445631_457239101");
    elseif (count($message) < 6 && (has("and", ["какая", "звезда", "ближайшая"]))) send(FLN_APPNAME, ifile("nearest_star"), "");
    elseif (count($message) < 4 && (has("and", ["что", "спутник"]) && has("not", ["искусственный"]))) send(FLN_APPNAME, ifile("satellite"), "photo-188445631_457239062");
    elseif (count($message) < 6 && (has("and", ["искусственные", "спутники", "земли"]) || has("and", ["что", "искусственный", "спутник"]))) send(FLN_APPNAME, ifile("artificial_satellites"), "photo-188445631_457239077");
    elseif (count($message) < 5 && (has("and", ["спутники", "сатурна"]))) send(FLN_APPNAME, ifile("saturn_satellites"), "");
    elseif (count($message) < 5 && (has("and", ["спутники", "юпитера"]))) send(FLN_APPNAME, ifile("jupiter_satellites"), "");
    elseif (count($message) < 5 && (has("and", ["спутники", "меркурия"]))) send(FLN_APPNAME, ifile("mercury_satellites"), "");
    elseif (count($message) < 5 && (has("and", ["спутники", "марса"]))) send(FLN_APPNAME, ifile("mars_satellites"), "");
    elseif (count($message) < 5 && (has("and", ["спутники", "венеры"]))) send(FLN_APPNAME, ifile("venus_satellites"), "");
    elseif (count($message) < 5 && (has("and", ["спутники", "нептуна"]))) send(FLN_APPNAME, ifile("neptune_satellites"), "");
    elseif (count($message) < 5 && (has("and", ["спутники", "урана"]))) send(FLN_APPNAME, ifile("uranus_satellites"), "");
    elseif (count($message) < 5 && (has("and", ["что", "млечный", "путь"]) || has("and", ["расскажи", "про", "млечный", "путь"]))) send(FLN_APPNAME, ifile("milky_way"), "photo-188445631_457239086");
    elseif (count($message) < 5 && (has("and", ["что", "черная", "дыра"]) || has("and", ["расскажи", "про", "черную", "дыру"]))) send(FLN_APPNAME, ifile("blackholes"), "photo-188445631_457239096");
    elseif (count($message) < 5 && (has("and", ["что", "чёрная", "дыра"]) || has("and", ["расскажи", "про", "чёрную", "дыру"]))) send(FLN_APPNAME, ifile("blackholes"), "photo-188445631_457239096");
    elseif (count($message) < 5 && (has("and", ["что", "нейтронная", "звезда"]) || has("and", ["расскажи", "про", "нейтронную", "звезду"]))) send(FLN_APPNAME, ifile("neutron_stars"), "photo-188445631_457239038");
    elseif (count($message) < 5 && (has("and", ["что", "астрономическая", "единица"]))) send(FLN_APPNAME, ifile("au"), "");
    elseif (count($message) < 4 && (has("and", ["что", "луна"]) || has("and", ["расскажи", "про", "луну"]))) send(FLN_APPNAME, ifile("moon"), "photo-188445631_457239087");
    elseif (count($message) < 4 && (has("and", ["что", "парсек"]) || has("and", ["чему", "равен", "парсек"]))) send(FLN_APPNAME, ifile("parsec"), "");
    elseif (count($message) < 5 && (has("and", ["что", "солнечная", "система"]) || has("and", ["расскажи", "про", "солнечную", "систему"]))) send(FLN_APPNAME, ifile("solar_system"), "photo-188445631_457239029");
    elseif (count($message) < 4 && (has("and", ["что", "сверхновая"]) || has("and", ["расскажи", "про", "сверхновую"]))) send(FLN_APPNAME, ifile("supernova"), "photo-188445631_457239044");
    elseif (count($message) < 6 && (has("and", ["кто", "гагарин"]) || has("and", ["расскажи", "про", "гагарина"]) || has("and", ["первый", "человек", "в", "космосе"]))) send(FLN_APPNAME, ifile("gagarin"), "photo-188445631_457239053");
    elseif (count($message) < 6 && (has("and", ["кто", "терешкова"]) || has("and", ["расскажи", "про", "терешкову"]) || has("and", ["первая", "женщина", "в", "космосе"]))) send(FLN_APPNAME, ifile("tereshkova"), "photo-188445631_457239052");
    elseif (count($message) < 6 && (has("and", ["кто", "леонов"]) || has("and", ["расскажи", "про", "леонова"]) || has("and", ["первый", "человек", "в", "открытом", "космосе"]))) send(FLN_APPNAME, ifile("leonov"), "photo-188445631_457239051");
    elseif (count($message) < 7 && (has("and", ["кто", "армстронг"]) || has("and", ["расскажи", "про", "армстронга"]) || has("and", ["первый", "человек", "на", "луне"]))) send(FLN_APPNAME, ifile("armstrong"), "photo-188445631_457239071");
    elseif (count($message) < 7 && (has("and", ["кто", "олдрин"]) || has("and", ["расскажи", "про", "олдрина"]))) send(FLN_APPNAME, ifile("aldrin"), "photo-188445631_457239072");
    elseif (count($message) < 7 && (has("and", ["что", "аполлон"]) || has("and", ["расскажи", "про", "высадку", "на", "луну"]))) send(FLN_APPNAME, ifile("apollo"), "photo-188445631_457239094");
    elseif (count($message) < 5 && (has("and", ["что", "протозвезда"]) || has("and", ["расскажи", "про", "протозвезды"]))) send(FLN_APPNAME, ifile("protostar"), "");
    elseif (count($message) < 6 && (has("and", ["что", "небесная", "сфера"]) || has("and", ["расскажи", "про", "небесную", "сферу"]))) send(FLN_APPNAME, ifile("aerosphere"), "");
    elseif (count($message) < 5 && (has("and", ["что", "затмение"]) || has("and", ["расскажи", "про", "затмение"]))) send(FLN_APPNAME, ifile("eclipse"), "photo-188445631_457239099");
    elseif (count($message) < 6 && (has("and", ["что", "звездообразование"]) || has("and", ["расскажи", "про", "звездообразование"]) || has("and", ["как", "образуются", "звезды"]) || has("and", ["как", "появляются", "звезды"]) || has("and", ["как", "рождаются", "звезды"]))) send(FLN_APPNAME, ifile("star_formation"), "");
    elseif (count($message) < 6 && (has("and", ["что", "красный", "гигант"]) || has("and", ["расскажи", "про", "красный", "гигант"]))) send(FLN_APPNAME, ifile("red_giant"), "");
    elseif (count($message) < 6 && (has("and", ["что", "белый", "карлик"]) || has("and", ["расскажи", "про", "белый", "карлик"]))) send(FLN_APPNAME, ifile("white_dwarf"), "");
    elseif (count($message) < 6 && (has("and", ["что", "двойная", "звезда"]) || has("and", ["расскажи", "про", "двойную", "звезду"]))) send(FLN_APPNAME, ifile("binary_star"), "photo-188445631_457239063");
    elseif (count($message) < 6 && (has("and", ["книги", "про", "космос"]) || has("and", ["книги", "про", "астрономию"]) || has("and", ["книги", "по", "астрономии"]))) send(FLN_APPNAME, ifile("books"), "");
    elseif (count($message) < 6 && (has("and", ["когда", "день", "космонавтики"]) || has("and", ["расскажи", "про", "день", "космонавтики"]))) send(FLN_APPNAME, ifile("cosmo_day"), "");
    elseif (count($message) < 5 && (has("and", ["что", "вояджер"]) || has("and", ["расскажи", "про", "вояджер"]))) send(FLN_APPNAME, ifile("voyager"), "photo-188445631_457239092");
    elseif (count($message) < 6 && (has("and", ["что", "скорость", "света"]) || has("and", ["чему", "равна", "скорость", "света"]))) send(FLN_APPNAME, ifile("light_speed"), "");
    elseif (count($message) < 7 && (has("and", ["белка", "и", "стрелка"]) || has("and", ["расскажи", "про", "белку", "и", "стрелку"]))) send(FLN_APPNAME, ifile("belka_and_strelka"), "photo-188445631_457239065");
    elseif (count($message) < 7 && (has("and", ["что", "пояс", "койпера"]) || has("and", ["расскажи", "про", "пояс", "койпера"]))) send(FLN_APPNAME, ifile("koiper_belt"), "");
    elseif (count($message) < 7 && (has("and", ["что", "пояс", "астероидов"]) || has("and", ["расскажи", "про", "пояс", "астероидов"]))) send(FLN_APPNAME, ifile("asteroid_belt"), "");
    elseif (count($message) < 7 && (has("and", ["что", "хаббл"]) || has("and", ["расскажи", "про", "хаббл"]))) send(FLN_APPNAME, ifile("hubble"), "photo-188445631_457239083");
    elseif (count($message) < 7 && (has("and", ["что", "мкс"]) || has("and", ["что", "международная", "космическая", "станция"]) || has("and", ["расскажи", "про", "международную", "космическую", "станцию"]) || has("and", ["расскажи", "про", "мкс"]))) send(FLN_APPNAME, ifile("iss"), "photo-188445631_457239084");
    elseif (count($message) < 5 && (has("and", ["что", "световой", "год"]))) send(FLN_APPNAME, ifile("light_year"), "");
    elseif (count($message) < 5 && (has("and", ["что", "световой", "день"]))) send(FLN_APPNAME, ifile("light_day"), "");
    elseif (count($message) < 4 && (has("and", ["что", "комета"]))) send(FLN_APPNAME, ifile("comet"), "photo-188445631_457239069");
    elseif (count($message) < 4 && (has("and", ["что", "астероид"]))) send(FLN_APPNAME, ifile("asteroid"), "");
    elseif (count($message) < 5 && (has("and", ["почему", "земля", "круглая"]))) send(FLN_APPNAME, ifile("round_earth"), "");
    elseif (count($message) < 6 && (has("and", ["фильмы", "про", "космос"]))) send(FLN_APPNAME, ifile("films"), "");
    elseif (count($message) < 5 && (has("and", ["что", "ты", "можешь"]) || has("and", ["что", "ты", "умеешь"]) || has("and", ["список", "вопросов"]))) send(FLN_APPNAME, "Я могу дать ответ на многие вопросы, связанные с астрономией.\nНапример, попробуй задать какой-нибудь из этого списка:\n\n" . $q_list_reply, "");
    elseif (count($message) < 4 && (has("and", ["спасибо"]))) send(FLN_APPNAME, "Не за что, обращайся ещё!", "");
    elseif (count($message) > 1 && (has("or", $forbidden))) send(FLN_APPNAME, getr($forbs), ""); // Forbidden words
    elseif (count($message) < 10 && (has("and", ["сколько", "в", "световых", "годах"]) && count($message) > 5 && count($message) < 8)) send(FLN_APPNAME, calc("light_years"), "");
    elseif (count($message) < 10 && (has("and", ["сколько", "в", "световых", "днях"]) && count($message) > 5 && count($message) < 8)) send(FLN_APPNAME, calc("light_days"), "");
    elseif (count($message) < 10 && (has("and", ["сколько", "в", "астрономических", "единицах"]) && count($message) > 5 && count($message) < 9)) send(FLN_APPNAME, calc("au"), "");
    elseif (count($message) < 10 && (has("and", ["сколько", "в", "парсеках"]) && count($message) > 4 && count($message) < 7)) send(FLN_APPNAME, calc("parsec"), "");
    elseif (count($message) < 10 && (has("and", ["сколько", "в", "световом", "году"]) && count($message) > 5 && count($message) < 8)) send(FLN_APPNAME, calc("light_years1"), "");
    elseif (count($message) < 10 && (has("and", ["сколько", "в", "световом", "дне"]) && count($message) > 5 && count($message) < 8)) send(FLN_APPNAME, calc("light_days1"), "");
    elseif (count($message) < 10 && (has("and", ["сколько", "в", "астрономической", "единице"]) && count($message) > 5 && count($message) < 9)) send(FLN_APPNAME, calc("au1"), "");
    elseif (count($message) < 10 && (has("and", ["сколько", "в", "парсеке"]) && count($message) > 4 && count($message) < 7)) send(FLN_APPNAME, calc("parsec1"), "");
    else {
        if (count($message) == 1 && (has("or", ['ладно', 'понятно', 'хорошо', 'понял']))) send(FLN_APPNAME, false, "");
        elseif (startsWith(FLN_RECIEVED_MESSAGE, "https://") || startsWith(FLN_RECIEVED_MESSAGE, "http://")) send(FLN_APPNAME, "К моему сожалению, пока что я не умею понимать, что находится в ссылках", "");
        else send(FLN_APPNAME, getr($defaults), "");
    }
} else {
    if (FLN_MESSAGE_ATTACHMENT_TYPE == 'sticker') {
        if (FLN_STICKER_ID == '271_8748' || FLN_STICKER_ID == '325_10699') send(FLN_APPNAME, "Алоха, ".FLN_USER_FIRST_NAME."!", "");
        elseif (FLN_STICKER_ID == '500_17616' || FLN_STICKER_ID == '522_18463' || FLN_STICKER_ID == '151_4710' || FLN_STICKER_ID == '111_3462' || FLN_STICKER_ID == '94_3003' || FLN_STICKER_ID == '500_17616' || FLN_STICKER_ID == '1_21') send(FLN_APPNAME, "Привет, ".FLN_USER_FIRST_NAME."!", "");
        elseif (FLN_STICKER_ID == '111_3467' || FLN_STICKER_ID == '111_3480' || FLN_STICKER_ID == '111_3461') send(FLN_APPNAME, ifile("earth"), "photo-188445631_457239093");
        elseif (FLN_STICKER_ID == '111_3483') send(FLN_APPNAME, ifile("solar_system"), "photo-188445631_457239029");
        elseif (FLN_STICKER_ID == '111_3469' || FLN_STICKER_ID == '111_3482') send(FLN_APPNAME, ifile("moon"), "photo-188445631_457239087");
        elseif (FLN_STICKER_ID == '111_3479' || FLN_STICKER_ID == '94_2923') send(FLN_APPNAME, ifile("blackholes"), "photo-188445631_457239037");
        elseif (FLN_STICKER_ID == '94_2920') send(FLN_APPNAME, ifile("gagarin"), "photo-188445631_457239053");
        elseif (FLN_STICKER_ID == '94_2921') send(FLN_APPNAME, ifile("comet"), "photo-188445631_457239069");
        elseif (FLN_STICKER_ID == '94_3002') send(FLN_APPNAME, ifile("artificial_satellites"), "photo-188445631_457239095");
        elseif (FLN_STICKER_ID == '94_2924') send(FLN_APPNAME, ifile("cosmos"), "photo-188445631_457239097");
        elseif (FLN_STICKER_ID == '94_2926') send(FLN_APPNAME, ifile("pluto"), "photo-188445631_457239088");
        else send(FLN_APPNAME, getr($defaults_stickers), "");
    } elseif (FLN_MESSAGE_ATTACHMENT_TYPE == 'photo') {
        send(FLN_APPNAME, "Я ещё не научился распознавать, что находится на фотографиях, поэтому не могу тебе ничего ответить", "");
    } elseif (FLN_MESSAGE_ATTACHMENT_TYPE == 'doc') {
        send(FLN_APPNAME, "К сожалению, сейчас я не могу распознавать, что содержится в документах", "");
    } elseif (FLN_MESSAGE_ATTACHMENT_TYPE == 'video') {
        send(FLN_APPNAME, "Пока что я не могу тебе ничего ответить на видео сообщения", "");
    } elseif (FLN_MESSAGE_ATTACHMENT_TYPE == 'audio') {
        send(FLN_APPNAME, "Увы, но в данный момент я не умею слушать аудиозаписи", "");
    } elseif (FLN_MESSAGE_ATTACHMENT_TYPE == 'graffiti') {
        send(FLN_APPNAME, "К сожалению, я ещё не умею распознавать граффити и Memoji и не знаю, как ответить тебе на это сообщение", "");
    } elseif (FLN_MESSAGE_ATTACHMENT_TYPE == 'audio_message') {
        send(FLN_APPNAME, "Надо признаться, пока что я не способен распознавать твою речь и не могу ответить тебе на это сообщение", "");
    } elseif (FLN_MESSAGE_ATTACHMENT_TYPE == 'fwd_messages') {
        send(FLN_APPNAME, "Я пока что не очень хорошо понимаю пересланные сообщения", "");
    } elseif (FLN_MESSAGE_ATTACHMENT_TYPE == 'wall') {
        send(FLN_APPNAME, "К сожалению, я не могу сейчас ничего ответить на этот пост", "");
    } elseif (FLN_MESSAGE_ATTACHMENT_TYPE == 'geo') {
        send(FLN_APPNAME, "Надо признаться, я не могу знать, что находится в этой геолокации, соответственно и ответить ничего не могу", "");
    } elseif (FLN_MESSAGE_ATTACHMENT_TYPE == 'podcast') {
        send(FLN_APPNAME, "Подкасты — это, определенно, очень интересный формат, однако я, к сожалению, пока что не научился их слушать", "");
    } elseif (FLN_MESSAGE_ATTACHMENT_TYPE == 'link') {
        send(FLN_APPNAME, "К моему сожалению, пока что я не умею понимать, что находится в ссылках", "");
    } else send(FLN_APPNAME, getr($defaults), "");
}

?>
