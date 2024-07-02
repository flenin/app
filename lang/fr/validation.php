<?php

return [
    'custom' => [
        'from_location' => [
            'required_if' => 'Sélectionnez le lieu de départ',
        ],
        'to_location' => [
            'required_if' => 'Sélectionnez le lieu d\'arrivée',
            'different' => 'Sélectionnez un lieu d\'arrivée différent du lieu de départ',
        ],
        'from_date' => [
            'required_if' => 'Sélectionnez la date de départ',
            'date_format' => 'Sélectionnez la date de départ',
        ],
        'from_time' => [
            'required_if' => 'Sélectionnez l\'heure de départ',
            'date_format' => 'Sélectionnez l\'heure de départ',
        ],
        'adults' => [
            'required_if' => 'Sélectionnez le nombre d\'adultes',
            'integer' => 'Sélectionnez le nombre d\'adultes',
            'between' => 'Sélectionnez le nombre d\'adultes',
        ],
        'children' => [
            'required_if' => 'Sélectionnez le nombre d\'enfants',
            'integer' => 'Sélectionnez le nombre d\'enfants',
            'between' => 'Sélectionnez le nombre d\'enfants',
        ],
        'luggages' => [
            'required_if' => 'Sélectionnez le nombre de bagages',
            'integer' => 'Sélectionnez le nombre de bagages',
            'between' => 'Sélectionnez le nombre de bagages',
        ],
        'name' => [
            'required_if' => 'Renseignez votre prénom',
            'max' => 'Renseignez votre prénom',
        ],
        'phone' => [
            'required_if' => 'Renseignez votre numéro de téléphone mobile',
            'max' => 'Renseignez votre numéro de téléphone mobile',
        ],
        'voucher' => [
            'present_if' => 'Renseignez le code promo',
            'exists' => 'Le code promo n\'est pas valide',
        ],
        'custom_amount' => [
            'integer' => 'Saisissez un montant entre 1 et 1000',
            'between' => 'Saisissez un montant entre 1 et 1000',
        ],
    ],
];
