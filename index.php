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
    // Si include il file functions.php
    include __DIR__ . '/assets/php/functions.php';



    if (isset($_GET['psw_length']))
    {
        $psw_length = $_GET['psw_length'];
        $allow_repeated = get_bool_value($_GET['allow_repeated']);
        $parameters['letters'] = (isset($_GET['allow_letters']));
        $parameters['numbers'] = (isset($_GET['allow_numbers']));
        $parameters['symbols'] = (isset($_GET['allow_symbols']));
        // Creazione effettiva dell'array con i caratteri validi per la generazione della password
        $valid_char_array = create_valid_char_array($parameters, $char_set_array);
        $password = generate_psw($psw_length, $valid_char_array, $char_set_array["letters"], $allow_repeated);
        var_dump($valid_char_array);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link a Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body
        {
            background-color: #001632;
            /* background-color:green; */
        }
        main
        {
            width: 70%;
            margin: 0 auto;
        }
        form
        {
            gap: 1.5rem;
        }
        .basis60
        {
            flex-basis: 60%;
        }
    </style>
    <title>Strong Password Generator</title>
</head>
<body>
    <header>
        <h1 class="text-center text-primary">Strong Password Generator</h1>
    </header>
    <main>
        <section id="form_section" class="mt-5">
            <form action="index.php" method="GET" class="d-flex flex-column rounded-3 py-5 bg-light">

                <div id="length_area" class="d-flex justify-content-start px-5">
                    <label for="psw_length_input" class="basis60 text-black-50 me-2">Digita la lunghezza (da 1 a 50 caratteri) della password...</label>
                    <input id="psw_length_input" class="rounded-3" type="number" min="1" max="50" step="1" name="psw_length" required
                    value="<?php if ($psw_length != 0) echo $psw_length; ?>">
                </div>

                <div id="repeated_area" class="d-flex justify-content-start px-5">
                    <span class="basis60 text-black-50 me-2">Consenti la ripetizione di caratteri?</span>
                    <div id="radio_box" class="d-flex flex-column form-check">
                        <div>
                            <input id="repeated_yes" class="form-check-input" type="radio" name="allow_repeated" value="true"
                                <?php
                                    if  (($allow_repeated) || ($psw_length == 0))
                                        echo "checked";
                                ?>
                            >
                            <label for="repeated_yes" class="form-check-label">Sì, consento</label>
                        </div>
                        <div>
                            <input id="repeated_not" class="form-check-input" type="radio" name="allow_repeated" value="false"
                                <?php
                                    if  (!$allow_repeated)
                                        echo "checked";
                                ?>
                            >
                            <label for="repeated_not" class="form-check-label">Non consento</label>
                        </div>
                    </div>
                </div>

                <div id="categories_area" class="d-flex justify-content-start px-5">
                    <span class="basis60 text-black-50 me-2">Seleziona le categorie di caratteri da utilizzare...</span>
                    <div id="check_box" class="d-flex flex-column form-check">
                        <div>
                            <input id="letters_yes" class="form-check-input" type="checkbox" name="allow_letters"
                                <?php
                                    if ($parameters['letters']) echo "checked";
                                ?>
                            value="true">
                            <label for="letters_yes" class="form-check-label">Lettere</label>
                        </div>
                        <div>
                            <input id="numbers_yes" class="form-check-input" type="checkbox" name="allow_numbers"
                                <?php
                                    if ($parameters['numbers']) echo "checked";
                                ?>
                            value="true">
                            <label for="numbers_yes" class="form-check-label">Numeri</label>
                        </div>
                        <div>
                            <input id="symbols_yes" class="form-check-input" type="checkbox" name="allow_symbols"
                                <?php
                                    if ($parameters['symbols']) echo "checked";
                                ?>
                            value="true">
                            <label for="symbols_yes" class="form-check-label">Simboli</label>
                        </div>
                    </div>
                </div>

                <div class="mx-auto">
                    <button class="btn btn-primary" type="submit">Conferma</button>
                </div>
            </form>
        </section>
        <?php
            if (isset($_GET['psw_length'])) :
        ?>
        <section id="output_section" class="my-2 text-center rounded-3 py-5 bg-light">
            <?php
                echo "<h6>La password generata è la seguente: " . $password . "</h6>";
            ?>
        </section>
        <?php
            endif;
        ?>
    </main>
    
<!-- CDN per Bootstrap 5 -->
<script 
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<!-- <script>
    function set_bool_value(element)
    {
        (element.checked) ? (element.setAttribute("value","true")) : (element.setAttribute("value","false"));
    }

    function check_submit()
    {
        let radio_yes = document.querySelector("#repeated_yes");
        set_bool_value(radio_yes);
        let radio_not = document.querySelector("#repeated_not");
        set_bool_value(radio_not);
        let letters_yes = document.querySelector("#letters_yes");
        set_bool_value(letters_yes);
        let numbers_yes = document.querySelector("#numbers_yes");
        set_bool_value(numbers_yes);        
        let symbols_yes = document.querySelector("#symbols_yes");
        set_bool_value(symbols_yes);
    }
</script> -->
</body>
</html>