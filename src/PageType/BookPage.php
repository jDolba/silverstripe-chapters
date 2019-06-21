<?php

namespace JDolba\Chapters\PageType;

use SilverStripe\CMS\Model\SiteTree;

class BookPage extends \Page
{
    public const PAGE_TYPES_TABLE_NAME_PREFIX = 'ChaptersModule';

    private static $table_name = self::PAGE_TYPES_TABLE_NAME_PREFIX . 'BookPage';

    private static $singular_name = 'Book';
    private static $plural_name = 'Book\'s';

    /**
     * @var array
     */
    private static $db = [
    ];

    private static $has_one = [
        'TableOfContentPage' => TableOfContentPage::class,
    ];

    private static $allowed_children = [
        SimplePage::class,
        ChapterPage::class,
        TableOfContentPage::class,
    ];

    private static $default_child = ChapterPage::class;
}
