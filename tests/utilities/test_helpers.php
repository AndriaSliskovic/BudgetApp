<?php
/*
 * $class - model koji se koristi
 * $attributes - polja koja je potrebno popuniti
 * $times - koliko puta se koristi
 * */
function createFactory($class, $attributes=[], $times=null){
    //dd($attributes);
    return factory($class, $times)->create($attributes);
}

function makeFactory($class, $attributes=[], $times=null){
    return factory($class, $times)->make($attributes);
}