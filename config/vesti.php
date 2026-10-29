<?php
 
// Brand-uudiin medeelel. Shine brand nemehdee end nemne.
// n = ner, f = font, s = nemelt style, c = gradient 2 uls, t = tagline
return [
    'brands' => [
        ['n' => 'Zara',      'f' => "'Playfair Display',serif",  's' => 'font-weight:500;letter-spacing:.08em', 'c' => ['#2b2b2b', '#8a7f72'], 't' => 'Шинэ улирлын цуглуулга'],
        ['n' => 'Uniqlo',    'f' => "'Noto Sans',sans-serif",    's' => 'font-weight:700',                       'c' => ['#b5121b', '#e8554e'], 't' => 'LifeWear · Өдөр тутмын тав тух'],
        ['n' => 'Pull&Bear', 'f' => "'Archivo Black',sans-serif",'s' => '',                                      'c' => ['#1f3b4d', '#5b8fa8'], 't' => 'Залуучуудын street style'],
        ['n' => 'H&M',       'f' => "'Oswald',sans-serif",       's' => 'font-weight:600',                       'c' => ['#c8102e', '#ff6f7f'], 't' => 'Загвар хүн бүрт'],
        ['n' => 'adidas',    'f' => "'Montserrat',sans-serif",   's' => 'font-weight:800;text-transform:lowercase', 'c' => ['#101010', '#4a4a4a'], 't' => 'Impossible is nothing'],
        ['n' => 'Nike',      'f' => "'Anton',sans-serif",        's' => 'font-style:italic;letter-spacing:.04em','c' => ['#f26b1d', '#ffb27a'], 't' => 'Just do it'],
        ['n' => 'Converse',  'f' => "'Permanent Marker',cursive",'s' => '',                                      'c' => ['#1b2a6b', '#6b7fd6'], 't' => 'Chuck Taylor · Classic'],
    ],
 
    // Brand tus buriin "Shine ireltiin" baraanuud
    'items' => [
        'Zara'      => ['Oversize пиджак', 'Сатин дээл', 'Өндөр бэлхүүстэй өмд', 'Трикотаж цамц'],
        'Uniqlo'    => ['Heattech дотуур хувцас', 'Ultra Light Down', 'Оксфорд цамц', 'Fleece цамц'],
        'Pull&Bear' => ['Cargo өмд', 'Graphic цамц', 'Баггий жинс', 'Бомбер хүрэм'],
        'H&M'       => ['Ноосон цамц', 'Шугаман даашинз', 'Хүрэм', 'Бүс'],
        'adidas'    => ['Samba оноол', 'Trefoil цамц', 'Тренинг өмд', 'Спорт цүнх'],
        'Nike'      => ['Air Force 1', 'Dunk Low', 'Tech Fleece', 'Running өмд'],
        'Converse'  => ['Chuck 70', 'All Star', 'Run Star Hike', 'Платформ'],
    ],
];