<?php
return [
    "models" => [
        "user" => "{1}Utilisateur|[2.*]Utilisateurs",
        "admin" => "{1}Administrateur|[2.*]Administrateurs",
        "brand" => "{1}Marque|[2.*]Marques",
        "category" => "{1}Catégorie|[2.*]Catégories",
        "product" => "{1}Produit|[2.*]Produits",
        "order" => "{1}Commande|[2.*]Commandes",
        "attribute" => "{1}Attribut|[2.*]Attributs",
        "value" => "{1}Valeur|[2.*]Valeurs",
        "permission" => "{1}Permission|[2.*]Permissions",
        "log" => "{1}Journal|[2.*]Journaux",
        "setting" => "{1}Paramètre|[2.*]Paramètres",
    ],
    "enum" => [
        "order" => [
            "state" => [
                0 => "En attente",
                1 => "Confirmé",
                2 => "Annulé",
                3 => "Rejeté",
            ],
            "activity_log" => [
                "event" => [
                    1 => "Créer",
                    2 => "Editer",
                    3 => "Supprimer",
                    4 => "Confirmer",
                    5 => "Annuler",
                ],
            ],
            "carousel" => [
                "type" => [
                    1 => "Rien",
                    2 => "Produit",
                    3 => "Lien",
                ],
            ],
        ]
    ]
];
