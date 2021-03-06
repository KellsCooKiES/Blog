<?php

namespace Tests\Unit;

use \App\Reply;
use App\Thread;
use \App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use \Tests\TestCase;

class ThreadTest extends TestCase
{
    use DatabaseMigrations;

    protected $thread;

    public function setUp():void
    {
        parent::setUp();
        $this->thread =factory(Thread::class)->create();
    }

    /**
     * @test
     */
    public function a_thread_has_a_creator()
    {
        $this->assertInstanceOf(User::class,$this->thread->creator);
    }



    /**
     * @test
     */
    public function a_thread_has_replies()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection',$this->thread->replies);
    }



    /**
     * @test
     */
    public function a_thread_can_add_reply()
    {
        $this->thread->addReply([
            'body' => 'foobar',
            'user_id' => '1'
        ]);
        $this->assertCount(1,$this->thread->replies);
    }

    /**
     * @test
     */
    public function a_thread_belongs_to_channel()
    {
        $this->assertInstanceOf('App\Channel',$this->thread->channel);
    }

    /**
     * @test
     */
    public function a_thread_can_make_string_path()
    {
        $thread = $this->thread;
        $this->assertEquals("/threads/{$thread->channel->slug}/{$thread->id}",$thread->path());
    }
}
