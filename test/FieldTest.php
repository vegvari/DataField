<?php

use Data\Field\Field;
use Data\Field\IntField;
use Data\Field\CharField;
use Data\Field\TextField;
use Data\Field\FloatField;
use Data\Field\BigIntField;
use Data\Field\DecimalField;
use Data\Field\TinyIntField;
use Data\Field\VarCharField;
use Data\Field\LongTextField;
use Data\Field\SmallIntField;
use Data\Field\TinyTextField;
use Data\Field\MediumIntField;
use Data\Field\MediumTextField;

/**
 * @coversDefaultClass \Data\Field\Field
 */
class FieldTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @dataProvider invalidNameProvider
     */
    public function invalidName(Closure $closure)
    {
        $this->setExpectedException('InvalidArgumentException', 'Name must be string, at least one character long');
        $closure();
    }

    /**
     * @test
     */
    public function invalidNameProvider()
    {
        return [
            [function () { return TinyIntField::signedNotNull(null); }],
            [function () { return TinyIntField::signedNullable(null); }],
            [function () { return TinyIntField::unsignedNotNull(null); }],
            [function () { return TinyIntField::unsignedNullable(null); }],
            [function () { return TinyIntField::serial(null); }],
            [function () { return TinyIntField::signedNotNull(''); }],
            [function () { return TinyIntField::signedNullable(''); }],
            [function () { return TinyIntField::unsignedNotNull(''); }],
            [function () { return TinyIntField::unsignedNullable(''); }],
            [function () { return TinyIntField::serial(''); }],

            [function () { return SmallIntField::signedNotNull(null); }],
            [function () { return SmallIntField::signedNullable(null); }],
            [function () { return SmallIntField::unsignedNotNull(null); }],
            [function () { return SmallIntField::unsignedNullable(null); }],
            [function () { return SmallIntField::serial(null); }],
            [function () { return SmallIntField::signedNotNull(''); }],
            [function () { return SmallIntField::signedNullable(''); }],
            [function () { return SmallIntField::unsignedNotNull(''); }],
            [function () { return SmallIntField::unsignedNullable(''); }],
            [function () { return SmallIntField::serial(''); }],

            [function () { return MediumIntField::signedNotNull(null); }],
            [function () { return MediumIntField::signedNullable(null); }],
            [function () { return MediumIntField::unsignedNotNull(null); }],
            [function () { return MediumIntField::unsignedNullable(null); }],
            [function () { return MediumIntField::serial(null); }],
            [function () { return MediumIntField::signedNotNull(''); }],
            [function () { return MediumIntField::signedNullable(''); }],
            [function () { return MediumIntField::unsignedNotNull(''); }],
            [function () { return MediumIntField::unsignedNullable(''); }],
            [function () { return MediumIntField::serial(''); }],

            [function () { return IntField::signedNotNull(null); }],
            [function () { return IntField::signedNullable(null); }],
            [function () { return IntField::unsignedNotNull(null); }],
            [function () { return IntField::unsignedNullable(null); }],
            [function () { return IntField::serial(null); }],
            [function () { return IntField::signedNotNull(''); }],
            [function () { return IntField::signedNullable(''); }],
            [function () { return IntField::unsignedNotNull(''); }],
            [function () { return IntField::unsignedNullable(''); }],
            [function () { return IntField::serial(''); }],

            [function () { return BigIntField::signedNotNull(null); }],
            [function () { return BigIntField::signedNullable(null); }],
            [function () { return BigIntField::unsignedNotNull(null); }],
            [function () { return BigIntField::unsignedNullable(null); }],
            [function () { return BigIntField::serial(null); }],
            [function () { return BigIntField::signedNotNull(''); }],
            [function () { return BigIntField::signedNullable(''); }],
            [function () { return BigIntField::unsignedNotNull(''); }],
            [function () { return BigIntField::unsignedNullable(''); }],
            [function () { return BigIntField::serial(''); }],

            [function () { return FloatField::signedNotNull(null); }],
            [function () { return FloatField::signedNullable(null); }],
            [function () { return FloatField::unsignedNotNull(null); }],
            [function () { return FloatField::unsignedNullable(null); }],
            [function () { return FloatField::signedNotNull(''); }],
            [function () { return FloatField::signedNullable(''); }],
            [function () { return FloatField::unsignedNotNull(''); }],
            [function () { return FloatField::unsignedNullable(''); }],

            [function () { return DecimalField::signedNotNull(null, 10, 2); }],
            [function () { return DecimalField::signedNullable(null, 10, 2); }],
            [function () { return DecimalField::unsignedNotNull(null, 10, 2); }],
            [function () { return DecimalField::unsignedNullable(null, 10, 2); }],
            [function () { return DecimalField::signedNotNull('', 10, 2); }],
            [function () { return DecimalField::signedNullable('', 10, 2); }],
            [function () { return DecimalField::unsignedNotNull('', 10, 2); }],
            [function () { return DecimalField::unsignedNullable('', 10, 2); }],

            [function () { return TinyTextField::notNull(null, 'UTF-8'); }],
            [function () { return TinyTextField::nullable(null, 'UTF-8'); }],
            [function () { return TinyTextField::notNull('', 'UTF-8'); }],
            [function () { return TinyTextField::nullable('', 'UTF-8'); }],

            [function () { return TextField::notNull(null, 'UTF-8'); }],
            [function () { return TextField::nullable(null, 'UTF-8'); }],
            [function () { return TextField::notNull('', 'UTF-8'); }],
            [function () { return TextField::nullable('', 'UTF-8'); }],

            [function () { return LongTextField::notNull(null, 'UTF-8'); }],
            [function () { return LongTextField::nullable(null, 'UTF-8'); }],
            [function () { return LongTextField::notNull('', 'UTF-8'); }],
            [function () { return LongTextField::nullable('', 'UTF-8'); }],

            [function () { return CharField::notNull(null, CharField::MAX_FIELD_LENGTH, 'UTF-8'); }],
            [function () { return CharField::nullable(null, CharField::MAX_FIELD_LENGTH, 'UTF-8'); }],
            [function () { return CharField::notNull('', CharField::MAX_FIELD_LENGTH, 'UTF-8'); }],
            [function () { return CharField::nullable('', CharField::MAX_FIELD_LENGTH, 'UTF-8'); }],

            [function () { return VarCharField::notNull(null, VarCharField::MAX_FIELD_LENGTH, 'UTF-8'); }],
            [function () { return VarCharField::nullable(null, VarCharField::MAX_FIELD_LENGTH, 'UTF-8'); }],
            [function () { return VarCharField::notNull('', VarCharField::MAX_FIELD_LENGTH, 'UTF-8'); }],
            [function () { return VarCharField::nullable('', VarCharField::MAX_FIELD_LENGTH, 'UTF-8'); }],
        ];
    }
}
