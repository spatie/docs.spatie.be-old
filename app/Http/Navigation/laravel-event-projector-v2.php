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
        'Intro',
        'The traditional application',
        'Using projectors to transform events',
        'Using aggregates to make decisions based on the past',
    ],
    'Using projectors' => [
        'Writing your first projector',
        'Handling side effects using reactors',
        'Thinking in events',
        'Making sure events get handled in the right order',
    ],
    'Using aggregates' => [
        'What are aggregates',
        'How to use aggregates',
    ],
    'Handling events' => [
        'Preparing events',
        'Using projectors',
        'Using reactors',
        'Handling exceptions',
    ],
    'Advanced usage' => [
        'Replaying events',
        'Storing metadata',
        'Using your own event storage model',
        'Using your own event serializer',
    ],
];
