<?php

require_once 'vendor/autoload.php';
$faker = Faker\Factory::create();

// bd
include 'includes/db.php';
// $base = new DB();

$pnombre = $faker->firstName('male');
$snombre = $faker->firstName('female');
$appaterno = $faker->lastName;
$apmaterno = $faker->lastName;
$genero = "masculino";
$celular = $faker->randomNumber(7, $strict = false);
$dir = $faker->streetAddress;

// echo $pnombre . "<br>";
// echo $snombre . "<br>";
// echo $appaterno . "<br>";
// echo $apmaterno . "<br>";
// echo $genero . "<br>";
// echo $celular . "<br>";
// echo $dir . "<br>";
$imgmasculino=['boy.png','boy-1.png','man.png','man-1.png','man-2.png','man-3.png'];
$imgfemenino=['girl.png','girl-1.png','man-4.png'];
$base = new DB();
for ($i = 50; $i < 150; $i++) {

    # code...

    if($i%2==0){
        $pnombre = $faker->firstName('male');
        $snombre = $faker->firstName('male');
        $genero = "masculino";
        $fotografia=$imgmasculino[random_int(0, 5)];
    }else{
        $pnombre = $faker->firstName('female');
        $snombre = $faker->firstName('female');
        $genero = "femenino";
        $fotografia=$imgfemenino[random_int(0, 2)];
    }

    $appaterno = $faker->lastName;
    $apmaterno = $faker->lastName;

    $celular = $faker->randomNumber(7, $strict = false);
    $dir = $faker->streetAddress;


    // $query = $base->connect()->prepare("INSERT INTO empleado VALUES (1, 'Fernando','Ale','Paz','Guerra','masculino',787878,'Calle v','man-1.png');");
    $query = $base->connect()->prepare("INSERT INTO empleado VALUES ($i, '$pnombre','$snombre','$appaterno','$apmaterno', '$genero',  $celular, '$dir','$fotografia');");
    $query->execute();
}




// Insertamos datos
// $query = $base->connect()->prepare("INSERT INTO empleado VALUES (1, 'Fernando','Ale','Paz','Guerra','masculino',787878,'Calle v','man-1.png');");
// $query->execute();
