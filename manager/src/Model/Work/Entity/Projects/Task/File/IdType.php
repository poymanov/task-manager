<?php

declare(strict_types=1);

namespace App\Model\Work\Entity\Projects\Task\File;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;

class IdType extends GuidType
{
    public const NAME = 'work_projects_task_file_id';

    /**
     * @param mixed $value
     * @param AbstractPlatform $platform
     * @return mixed|string
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value instanceof Id ? $value->getValue(): $value;
    }

    /**
     * @param mixed $value
     * @param AbstractPlatform $platform
     * @return Id|mixed|null
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return !empty($value) ? new Id($value): null;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return self::NAME;
    }
}