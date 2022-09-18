<?php

function foo(array $intervals): array
{
    // Tableau contenant les intervalles imbriquees.
    $ranges = [];
    //Pour eviter les doublons 
    /*$intervals = array_map('json_encode', $intervals);
    $intervals = array_unique($intervals);
    $intervals = array_map('json_decode', $intervals);*/


    $addrange = false;
    foreach ($intervals as $interval) {

        foreach ($ranges as &$range) {
            // Si l'intervalle actuel est imbriquee avec la précédente 
            if (($interval[0] >= $range[0] && $interval[0] <= $range[1]) || ($interval[1] >= $range[0] && $interval[1] <= $range[1])) {
                // On fusionne les intervalles en trouvant la plus petite et la plus grande valeur.
                $range = [
                    min($interval[0], $interval[1], $range[0], $range[1]),
                    max($interval[0], $interval[1], $range[0], $range[1])
                ];
                $addrange = true;
                break;
            }
        }

        // Si cette intervalle n'a pas été ajoutée, cela signifie qu'elle n'est pas imbriquee avec 
        // aucune intervalle précédente. Si c'est la première intervalle, nous devons l'ajouter au tableau des ranges.

        if (!$addrange)
            $ranges[] = $interval;
    }

    sort($ranges);

    return $ranges;
}


echo "<pre>";
print_r(foo([[0, 3], [6, 10]]));
print_r(foo([[0, 5], [3, 10]]));
print_r(foo([[0, 5], [2, 4]]));
print_r(foo([[7, 8], [3, 6], [2, 4]]));
print_r(foo([[39, 40], [11, 15],  [13, 16]]));
echo "</pre>";
