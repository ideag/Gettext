<?php

namespace Gettext\Tests;

use Gettext\Comments;
use PHPUnit\Framework\TestCase;

class CommentsTest extends TestCase
{
    public function testComments()
    {
        $comments = new Comments();

        $this->assertSame([], $comments->toArray());
        $this->assertCount(0, $comments);
        
        $comments->add('foo');
        
        $this->assertSame(['foo'], $comments->toArray());
        $this->assertCount(1, $comments);
        
        $comments->add('foo');
        
        $this->assertSame(['foo'], $comments->toArray());
        $this->assertCount(1, $comments);
        
        $comments->add('bar');

        $this->assertSame(['foo', 'bar'], $comments->toArray());
        $this->assertCount(2, $comments);
    }

    public function testMergeComments()
    {
        $comments1 = new Comments('one', 'two', 'three');
        $comments2 = new Comments('three', 'four', 'five');

        $merged = $comments1->mergeWith($comments2);

        $this->assertCount(5, $merged);
        $this->assertSame(['one', 'two', 'three', 'four', 'five'], $merged->toArray());

        $this->assertNotSame($merged, $comments1);
        $this->assertNotSame($merged, $comments2);
    }
}
