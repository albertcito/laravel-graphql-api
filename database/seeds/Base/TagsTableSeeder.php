<?php

declare(strict_types=1);

namespace Seeds\Base;

use App\Base\Model\Generic\Tag;
use App\Base\Model\Lang\Lang;
use App\Base\Model\Lang\Text;
use App\Base\Model\Lang\Translation;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create();
        $langs = Lang::all();
        $translation = Translation::latest()->first();
        if (! $translation) {
            $translation = new stdClass;
            $translation->translation_id = 0;
        }
        for ($i = 0; $i < 20; $i++) {
            $id = $translation->translation_id + 1;
            $translation = Translation::create([
                'code' => $faker->word.'-'.$id,
            ])->fresh();
            foreach ($langs as $lang) {
                $text = $faker->word.' ('.$lang->lang_id.')';
                Text::create([
                    'text' => $text,
                    'lang_id' => $lang->lang_id,
                    'translation_id' => $translation->translation_id,
                ])->fresh();
            }
            Tag::create(['translation_id' => $id]);
        }
    }
}
