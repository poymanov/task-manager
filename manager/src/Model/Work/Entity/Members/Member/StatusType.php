<?php

declare(strict_types=1);

namespace App\Model\Work\Entity\Members\Member;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class StatusType extends StringType
{
    public const NAME = 'work_members_member_status';

    /**
     * @param mixed $value
     * @param AbstractPlatform $platform
     * @return mixed|string
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value instanceof Status ? $value->getName(): $value;
    }

    /**
     * @param mixed $value
     * @param AbstractPlatform $platform
     * @return Email|mixed|null
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return !empty($value) ? new Status($value): null;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return self::NAME;
    }
}