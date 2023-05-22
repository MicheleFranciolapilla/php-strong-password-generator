<!-- Descrizione
Dobbiamo creare una pagina che permetta ai nostri utenti di utilizzare il nostro generatore di password (abbastanza) sicure.
L’esercizio è suddiviso in varie milestone ed è molto importante svilupparle in modo ordinato.
Milestone 1
Creare un form che invii in GET la lunghezza della password. Una nostra funzione utilizzerà questo dato per generare una password casuale (composta da lettere, lettere maiuscole, numeri e simboli) da restituire all’utente.
Scriviamo tutto (logica e layout) in un unico file index.php
Milestone 2
Verificato il corretto funzionamento del nostro codice, spostiamo la logica in un file functions.php che includeremo poi nella pagina principale
Milestone 3 (BONUS)
Invece di visualizzare la password nella index, effettuare un redirect ad una pagina dedicata che tramite $_SESSION recupererà la password da mostrare all’utente.
Milestone 4 (BONUS)
Gestire ulteriori parametri per la password: quali caratteri usare fra numeri, lettere e simboli. Possono essere scelti singolarmente (es. solo numeri) oppure possono essere combinati fra loro (es. numeri e simboli, oppure tutti e tre insieme).
Dare all’utente anche la possibilità di permettere o meno la ripetizione di caratteri uguali. -->

<?php
    // Array con valori booleani indicanti le categorie di caratteri (sub array in $char_set_array) da utilizzare per la composizione della password
    $parameters = [
        "letters" => false,
        "numbers" => false,
        "symbols" => true
    ];

    // $letters = true;
    // $numbers = true;
    // $symbols = true;

    // Array multidimensionale con tre sotto-array contenenti, nel complesso, la totalità dei caratteri validi per la composizione della password
    $char_set_array = [
        ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'],
        ['0','1','2','3','4','5','6','7','8','9'],
        ['!','?','#','$','%','&','@']
    ];

    function create_valid_char_array($parameters, $char_set_array)
    {
        $final_array = [];
        $keys = array_keys($parameters);
        for ($i = 0; $i < count($parameters); $i++)
        {
            if ($parameters[$keys[$i]])
            {
                foreach($char_set_array[$i] as $char)
                {
                    $final_array[] = $char;
                }
            }
        }
        return $final_array;
    }

    $valid_char_array = create_valid_char_array($parameters, $char_set_array);
    var_dump("Array appena generato: ",$valid_char_array);

    function generate_psw($password_length)
    {
        $psw_array = [];
        var_dump("Array vuoto: ",$psw_array);
        for ($i = 0; $i < $password_length; $i++)
        {
        }
    };


    if (isset($_GET['psw_length']))
    {
        $psw_length = $_GET['psw_length'];
        $password = generate_psw($psw_length);
    }
    var_dump("password length = ", $psw_length);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link a Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Strong Password Generator</title>
</head>
<body>
    <header>
        <h1 class="text-center text-primary">Strong Password Generator</h1>
    </header>
    <main>
        <section id="form_section" class="mt-5">
            <form action="index.php" method="GET">
                <div class="my-3">
                    <label for="psw_length_input" class="text-info me-2">Digita la lunghezza richiesta per la password...</label>
                    <input id="psw_length_input" type="number" min="1" max="50" step="1" name="psw_length">
                </div>
                <button class="btn btn-primary" type="submit">Conferma</button>
            </form>
        </section>
    </main>
    
<!-- CDN per Bootstrap 5 -->
<script 
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
</body>
</html>