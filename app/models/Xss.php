<?php

namespace app\models;

use Arrayy\ArrayyIterator;
use voku\db\ActiveRecord;

/**
 * @property int $id
 * @property string $xss
 * @property null|string $desc
 * @property null|string $keywords
 * @property string $author
 * @property null|string $date
 */
class Xss extends ActiveRecord
{
    protected function init()
    {
        $this->table = 'xss';
    }
}
