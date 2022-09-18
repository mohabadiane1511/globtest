# GlobTest


## Enoncé

[Echo](https://www.instagram.com/globalisecho/?hl=fr), mascotte de l'équipe de [Globalis](https://www.globalis-ms.com/), a découvert une fonction `foo()` bien mystérieuse. Hélas, il n'a pas accès au code. Curieux et grand amateur de [rétro-ingénierie](https://fr.wikipedia.org/wiki/R%C3%A9tro-ing%C3%A9nierie), Echo s'est amusé à appeler cette fonction, en injectant des données en entrée et en récoltant les sorties. Le comportement de la fonction `foo()` est le suivant :

|  Appel     |  Sortie     |
| ---   |:-:    |
| `foo([[0, 3], [6, 10]])` | `[[0, 3], [6, 10]]` |
| `foo([[0, 5], [3, 10]])` | `[[0, 10]]` |
| `foo([[0, 5], [2, 4]])` | `[[0, 5]]` |
| `foo([[7, 8], [3, 6], [2, 4]])` | `[[2, 6], [7, 8]]` |
| `foo([[3, 6], [3, 4], [15, 20], [16, 17], [1, 4], [6, 10], [3, 6]])` | `[[1, 10], [15, 20]]` |

Le challenge, si vous l'acceptez, serait d'aider Echo à comprendre ce que fait cette fonction et à la recoder. Vous êtes partant ? ;)

### Question 1

Expliquez, en quelques lignes, ce que fait cette fonction.

- Reponse :

    Cette fonction permet de recupérer les intervalles maximales à partir des intervalles 
    données. Les plus grandes valeurs sont retournées dans une seconde
    intervalle lorsqu'elles sont imbriquées dans la premiére intervalle.
    Exemple : [[2,5] ,[1,4]] => [1,5]



### Question 2

Codez cette fonction.
Merci de fournir un fichier contenant :

- la fonction, 
- l'appel de la fonction, avec un jeu de test en entrée,
- l'affichage du résultat en sortie.

```bash
<?php
function foo(array $intervals): array
{
    // Tableau contenant les intervalles imbriquees.
    $ranges = [];
    
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

```

### Question 3

Précisez en combien de temps vous avez implémenté cette fonction.

- Reponse :

Cette fonction a été implémenté en 1 heure 30 minutes. 

## Merci

Par avance, un grand merci pour le temps que vous consacrerez à ce challenge, en espérant vous voir rejoindre très prochainement [nos équipes](https://www.globalis-ms.com/jobs/) ;) 
## Authors

- [@mohabadiane1511](https://github.com/mohabadiane1511)

