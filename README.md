# gameMap2D
Библиотека для работы с игровыми 2d картами

Работает  с 2D картой. 
Основные предназначения: 
1. изменения состояния клеток 
2. автоустановка элементов на незанятые клетки

## Установка

composer require archee-nic/game-map2d:dev-master

## Быстрый старт

```php
<?
//Сначала созадаем карту
$mapCanvas=[
    [0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0],
    [0, 0, 0, 0, 0],
];
// Далее работаем с Builder классом
$Map=new ArcheeNic\Map2D\Map($mapCanvas);
$Builder=new ArcheeNic\Map2D\Builder($Map);
// Автоустановка здания
$Builder->autoDeploy(5,[2,2]);
// Просто установка здания
$Builder->deploy(5,[0,3],[2,2]);
```
