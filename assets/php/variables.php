<?php
    // Array con valori booleani indicanti le categorie di caratteri (sub array in $char_set_array) da utilizzare per la composizione della password
    $parameters = [
        "letters" => true,
        "numbers" => true,
        "symbols" => true
    ];
    // Valore provvisorio. Questa variabile assumerà il valore booleano stabilito nel form (bonus)
    $allow_repeated = true;

    $psw_length = 0;
    $password = "";
    
    // Array multidimensionale con tre sotto-array contenenti, nel complesso, la totalità dei caratteri validi per la composizione della password
    $char_set_array = [
        "letters" => ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'],
        "numbers" => ['0','1','2','3','4','5','6','7','8','9'],
        "symbols" => ['!','?','#','$','%','&','@']
    ];