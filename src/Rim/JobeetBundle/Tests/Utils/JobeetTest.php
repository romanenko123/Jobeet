<?php
namespace Rim\JobeetBundle\Tests\Utils;

use Rim\JobeetBundle\Utils\Jobeet;

class JobeetTest extends \PHPUnit_Framework_TestCase
{

    public function testSlugify()
    {
        $this->assertEquals('sensio', Jobeet::slugify('Sensio'), '-+-+-+-+-+- Converts all characters to lower case');
        $this->assertEquals('sensio-labs', Jobeet::slugify('sensio labs'), '-+-+-+-+-+- Replaces a white space by a -');
        $this->assertEquals('sensio-labs', Jobeet::slugify('sensio   labs'), '-+-+-+-+-+- Replaces several white spaces by a single -');
        $this->assertEquals('paris-france', Jobeet::slugify('paris,france'), '-+-+-+-+-+- Replaces non-ASCII characters by a -');
        $this->assertEquals('sensio', Jobeet::slugify(' sensio'), '-+-+-+-+-+- Removes - at the beginning of a string');
        $this->assertEquals('sensio', Jobeet::slugify('sensio '), '-+-+-+-+-+- Removes - at the end of a string');
        $this->assertEquals('n-a', Jobeet::slugify(''), '-+-+-+-+-+- Converts the empty string to n-a');
        $this->assertEquals('n-a', Jobeet::slugify(' - '), '-+-+-+-+-+- Converts a string that only contains non-ASCII characters to n-a');
        if (function_exists('iconv')) {
            $this->assertEquals('developpeur-web', Jobeet::slugify('Développeur Web'), '-+-+-+-+-+- Removes accents');
        }
    }
}