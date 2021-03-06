<?php

declare(strict_types=1);

namespace Tests\Feature\Base\GraphQL\Admin\Query\Translation;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class TranslationQueryTest extends TestCase
{
    use WithoutMiddleware;

    public function test()
    {
        $query = 'query translation($translationID: Int){
            translation(translationID: $translationID) {
              data {
                translationID
                code
                text {
                  text
                }
              }
            }
        }';

        $expected = [
            'data' => [
                'translation' => [
                    'data' => [
                        'translationID',
                        'code',
                        'text' => [
                            'text',
                        ],
                    ],
                ],
            ],
        ];

        $variables = [
            'translationID' => 1,
        ];

        $this->assertJsonStructureLogged(
            '/graphql/admin',
            [
                'query' => $query,
                'variables' => $variables,
            ],
            $expected
        );
    }
}
