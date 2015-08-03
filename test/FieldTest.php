<?php

use Data\Field\Field;
use Data\Field\IntField;
use Data\Field\BoolField;
use Data\Field\CharField;
use Data\Field\TextField;
use Data\Field\FloatField;
use Data\Field\BigIntField;
use Data\Field\DecimalField;
use Data\Field\TinyIntField;
use Data\Field\VarCharField;
use Data\Field\DateTimeField;
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
            [function () { return TinyIntField::unsignedNotNull(null); }],
            [function () { return TinyIntField::signedNotNull(''); }],
            [function () { return TinyIntField::unsignedNotNull(''); }],

            [function () { return SmallIntField::signedNotNull(null); }],
            [function () { return SmallIntField::unsignedNotNull(null); }],
            [function () { return SmallIntField::signedNotNull(''); }],
            [function () { return SmallIntField::unsignedNotNull(''); }],

            [function () { return MediumIntField::signedNotNull(null); }],
            [function () { return MediumIntField::unsignedNotNull(null); }],
            [function () { return MediumIntField::signedNotNull(''); }],
            [function () { return MediumIntField::unsignedNotNull(''); }],

            [function () { return IntField::signedNotNull(null); }],
            [function () { return IntField::unsignedNotNull(null); }],
            [function () { return IntField::signedNotNull(''); }],
            [function () { return IntField::unsignedNotNull(''); }],

            [function () { return BigIntField::signedNotNull(null); }],
            [function () { return BigIntField::unsignedNotNull(null); }],
            [function () { return BigIntField::signedNotNull(''); }],
            [function () { return BigIntField::unsignedNotNull(''); }],

            [function () { return FloatField::signedNotNull(null); }],
            [function () { return FloatField::unsignedNotNull(null); }],
            [function () { return FloatField::signedNotNull(''); }],
            [function () { return FloatField::unsignedNotNull(''); }],

            [function () { return DecimalField::signedNotNull(null, 10, 2); }],
            [function () { return DecimalField::unsignedNotNull(null, 10, 2); }],
            [function () { return DecimalField::signedNotNull('', 10, 2); }],
            [function () { return DecimalField::unsignedNotNull('', 10, 2); }],

            [function () { return TinyTextField::notNull(null, 'UTF-8'); }],
            [function () { return TinyTextField::notNull('', 'UTF-8'); }],

            [function () { return TextField::notNull(null, 'UTF-8'); }],
            [function () { return TextField::notNull('', 'UTF-8'); }],

            [function () { return LongTextField::notNull(null, 'UTF-8'); }],
            [function () { return LongTextField::notNull('', 'UTF-8'); }],

            [function () { return CharField::notNull(null, CharField::MAX_FIELD_LENGTH, 'UTF-8'); }],
            [function () { return CharField::notNull('', CharField::MAX_FIELD_LENGTH, 'UTF-8'); }],

            [function () { return VarCharField::notNull(null, VarCharField::MAX_FIELD_LENGTH, 'UTF-8'); }],
            [function () { return VarCharField::notNull('', VarCharField::MAX_FIELD_LENGTH, 'UTF-8'); }],

            [function () { return DateTimeField::notNull(null, 'UTC'); }],
            [function () { return DateTimeField::notNull('', 'UTC'); }],

            [function () { return BoolField::notNull(null); }],
            [function () { return BoolField::notNull(''); }],
        ];
    }

    /**
     * @dataProvider defaultProvider
     */
    public function testDefault(Closure $closure, $expected, $something_else)
    {
        $instance = $closure();
        $this->assertSame($expected, $instance->getData()->value());

        $instance->getData()->set($something_else);
        $this->assertSame($something_else, $instance->getData()->value());

        $instance->getData()->set(null);
        $this->assertSame($expected, $instance->getData()->value());

        $instance->getData()->set($something_else);
        $this->assertSame($something_else, $instance->getData()->value());

        $instance->getData()->set('');
        $this->assertSame($expected, $instance->getData()->value());
    }

    /**
     * @test
     */
    public function defaultProvider()
    {
        return [
            [function () { return TinyIntField::signedNotNull('test', '12'); }, 12, 11],
            [function () { return TinyIntField::unsignedNotNull('test', '12'); }, 12, 11],

            [function () { return SmallIntField::signedNotNull('test', '12'); }, 12, 11],
            [function () { return SmallIntField::unsignedNotNull('test', '12'); }, 12, 11],

            [function () { return MediumIntField::signedNotNull('test', '12'); }, 12, 11],
            [function () { return MediumIntField::unsignedNotNull('test', '12'); }, 12, 11],

            [function () { return IntField::signedNotNull('test', '12'); }, 12, 11],
            [function () { return IntField::unsignedNotNull('test', '12'); }, 12, 11],

            [function () { return BigIntField::signedNotNull('test', '12'); }, 12, 11],
            [function () { return BigIntField::unsignedNotNull('test', '12'); }, 12, 11],

            [function () { return FloatField::signedNotNull('test', '12'); }, 12.0, 11.0],
            [function () { return FloatField::unsignedNotNull('test', '12'); }, 12.0, 11.0],
            [function () { return FloatField::signedNotNull('test', '12'); }, 12.0, 11.0],
            [function () { return FloatField::unsignedNotNull('test', '12'); }, 12.0, 11.0],

            [function () { return DecimalField::signedNotNull('test', 10, 2, '12'); }, 12.0, 11.0],
            [function () { return DecimalField::unsignedNotNull('test', 10, 2, '12'); }, 12.0, 11.0],

            [function () { return TinyTextField::notNull('test', 'UTF-8', '12'); }, '12', '11'],

            [function () { return TextField::notNull('test', 'UTF-8', '12'); }, '12', '11'],

            [function () { return LongTextField::notNull('test', 'UTF-8', '12'); }, '12', '11'],

            [function () { return CharField::notNull('test', CharField::MAX_FIELD_LENGTH, 'UTF-8', '12'); }, '12', '11'],

            [function () { return VarCharField::notNull('test', VarCharField::MAX_FIELD_LENGTH, 'UTF-8', '12'); }, '12', '11'],

            [function () { return DateTimeField::notNull('test', 'UTC', '2013-06-09'); }, '2013-06-09 00:00:00', '2013-06-29 00:00:00'],

            [function () { return BoolField::notNull('test', true); }, true, false],
        ];
    }
}
