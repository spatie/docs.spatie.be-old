<?php

return [
    [
        'Introduction',
        'Postcardware',
        'Requirements',
        'Installation & setup',
        'Questions & issues',
        'Changelog',
        'Resources and alternatives'
    ],
    'Getting familiar with event sourcing' => [
        'Introduction',
        'The traditional application',
        'Using projectors to transform events',
        'Using aggregates to make decisions based on the past',
    ],
    'Using projectors' => [
        'Writing your first projector',
        'Creating and configuring projectors',
        'Replaying events',
        'Making sure events get handled in the right order',
        'Thinking in events',
    ],
    'Using reactors' => [
        'Writing your first reactor',
        'Creating and configuring reactors',
    ],
    'Using aggregates' => [
        'Writing your first aggregate',
        'Creating and configuring aggregates',
    ],
    'Advanced usage' => [
        'Preparing events',
        'Storing metadata',
        'Handling exceptions',
        'Using your own event storage model',
        'Using your own event serializer',
    ],
];
