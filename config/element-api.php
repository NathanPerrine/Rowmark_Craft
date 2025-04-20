<?php

use craft\elements\Entry;
use craft\helpers\UrlHelper;

return [
    'endpoints' => [
        // Endpoint for all news articles
        'api/news' => function() {
            return [
                'elementType' => Entry::class,
                'criteria' => [
                    'section' => 'news',
                    'limit' => null,
                ],
                'cache' => false,
                'transformer' => function(Entry $entry) {
                    return [
                        'id' => $entry->id,
                        'title' => $entry->title,
                        'content' => $entry->content,
                        'dateCreated' => $entry->dateCreated->format('Y-m-d'),
                        'slug' => $entry->slug,
                    ];
                },
            ];
        },

        // Endpoint for a single news article
        'api/news/<entryId:\d+>' => function($entryId) {
            return [
                'elementType' => Entry::class,
                'criteria' => [
                    'id' => $entryId,
                    'section' => 'news',
                ],
                'one' => true,
                'transformer' => function(Entry $entry) {
                    return [
                        'id' => $entry->id,
                        'title' => $entry->title,
                        'content' => $entry->content,
                        'dateCreated' => $entry->dateCreated->format('Y-m-d'),
                        'url' => $entry->url,
                    ];
                },
            ];
        },
    ]
];