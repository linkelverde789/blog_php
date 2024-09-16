<?php
function pepe($arr)
{
    $uno = $arr[0];
    $contador = 0;
    $iguales = 0;

    foreach ($arr as $element) {
        if ($element !== $arr) {
            $contador;
        } else {
            $iguales++;
        }
    }
    if ($contador == 1 && $iguales == 3) {
        return true;
    } else {
        return false;
    }

}




function checkThreeAndTwo($arr)
{
    $nuevo = [];
    foreach ($arr as $item) {
        if (!in_array($item, $nuevo)) {
            $nuevo[] = $item;
        }
    }
    if (count($nuevo) != 2) {
        return false;
    }
    $cont = 0;
    foreach ($nuevo as $item) {
        foreach ($arr as $element) {
            if ($element === $item) {
                $cont++;
            }
        }
        if ($cont == 2 || $cont == 3) {
            return true;
        } else {
            return false;
        }
    }
}
?>