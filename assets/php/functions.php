<?php
    // Funzione che crea l'array con gli effettivi caratteri validi con i quali comporre la password
    function create_valid_char_array($parameters, $char_set_array)
    {
        $final_array = [];
        // L'array $keys consentirà di puntare direttamente alla chiave booleana (in $parameters) ed alla chiave array (in $char_set_array)trattandole come chiavi numeriche, pur essendo chiavi di array associativi. In questo modo si mantiene una chiarezza semantica e diimmediato riconoscimento
        $keys = array_keys($parameters);
        for ($i = 0; $i < count($parameters); $i++)
        {
            if ($parameters[$keys[$i]])
            {
                foreach($char_set_array[$keys[$i]] as $char)
                {
                    $final_array[] = $char;
                }
            }
        }
        return $final_array;
    }

    function generate_psw($password_length, $valid_char_array, $letters_array, $allow_repeated)
    {
        // RICORDARSI DI INSERIRE UNA LOGICA CHE TENGA CONTO DELLA QUANTITA' DEI CARATTERI VALIDI E DEL PASSWORD LENGTH
        $psw_array = [];
        $index = 0;
        for ($i = 0; $i < $password_length; $i++)
        {
            $index = mt_rand(0,count($valid_char_array) - 1);
            $char = $valid_char_array[$index];
            // echo "Indice di creazione password: " . $i . "<br>";
            // echo "Carattere generato: " . $char . "<br>";
            if (array_search($char, $letters_array, true) !== false)
            {
                // significa che si tratta di una lettera e dunque si deve eseguire un random booleano per decidere se deve essere maiuscola o minuscola
                if (boolval(mt_rand(0,1)))
                    $char = strtoupper($char);
            }
            // Se il carattere $char generato e pronto per essere inserito nella password è già presente (strettamente) e non sono permesse ripetizioni di carattere, allora si decrementa l'indice e si ripete il ciclo, altrimenti il carattere viene definitivamente inserito nella password
            if (!$allow_repeated && array_search($char, $psw_array, true) !== false)
                $i--;
            else
                $psw_array[] = $char;
                // echo "Array della password: " . implode("",$psw_array) . "<br>";
        }
        return implode("",$psw_array);
    };