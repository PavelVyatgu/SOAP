<?php

include './client.php';

echo 'Получение одного студента по id' . PHP_EOL;
var_dump($client->getStudent(1));

echo 'Добавление нового студента в БД' . PHP_EOL;
echo 'Получить всех студентов (чтобы показать корректность добавления в БД)' . PHP_EOL;
$student = [
    'name' => 'Kate',
    'surname' => 'Galaseva',
    'group' => 'GGH-7799',
    'course' => '3'
];
var_dump($client->addStudent($student));
var_dump($client->getStudents());

echo 'Удалить студента' . PHP_EOL;
echo 'Получить всех студентов (чтобы показать корректность удаления студента в БД)' . PHP_EOL;
var_dump($client->deleteStudent(133));
var_dump($client->getStudents());
