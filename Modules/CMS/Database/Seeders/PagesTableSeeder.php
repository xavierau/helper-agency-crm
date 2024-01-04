<?php

namespace Modules\CMS\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\CMS\Database\DefaultSetting;
use Modules\CMS\Entities\Content;
use Modules\CMS\Entities\Page;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        foreach (DefaultSetting::getPages() as $pageData) {

            if ($contentData = $pageData['contents'] ?? null) {
                unset($pageData['contents']);

                $page = Page::create($pageData);

                $languages = ['zh', 'en'];

                foreach ($contentData as $content) {
                    foreach ($languages as $language) {
                        $content['language'] = $language;
                        $page->contents()->create($content);
                    }
                }
            } else {
                Page::create($pageData);
            }

        }


        foreach (DefaultSetting::getCommonContents() as $commonContent) {
            $commonContent['language'] = 'en';
            Content::create($commonContent);
        }

    }
}
