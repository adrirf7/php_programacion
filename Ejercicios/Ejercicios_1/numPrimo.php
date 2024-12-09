    <?php
    function esPrimo($n)
    {
        if ($n < 2) {
            return false;
        }
        for ($i = 2; $i <= sqrt($n); $i++) {
            if ($n % $i == 0) {
                return false;
            }
        }
        return true;
    }

    $n = (int)readline("Ingrese un numero: ");

    if (esPrimo($n)) {
        echo "$n es primo";
    } else {
        echo "$n no es primo";
    }