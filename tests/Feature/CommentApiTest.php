<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\Group;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function api_store_comment()
    {
        $group = create(Group::class);
        $comment = make(Comment::class)->toArray();

        $this->postJsonRoute('api.v1.comments.store', data: array_merge($comment, ['group' => $group->slug]))->assertCreated();

        $this->assertDatabaseCount('comments', 1);
    }

    /** @test */
    public function api_get_comments_of_group()
    {
        $group = create(Group::class);
        $comments = create(Comment::class, ['group_id' => $group->id]);

        $response = $this->getJsonRoute('api.v1.comments.index', ['group' => $group->slug])->json();

        $this->assertEquals(1, $response['meta']['total']);
    }

    /** @test */
    public function api_get_comments_accepts_sort()
    {
        $group = create(Group::class);
        $older = create(Comment::class, ['group_id' => $group->id, 'created_at' => now()->subMinute()]);
        $newer = create(Comment::class, ['group_id' => $group->id]);

        $response = $this->getJsonRoute('api.v1.comments.index', ['group' => $group->slug, 'sort' => 'created_at,desc'])
            ->assertSeeInOrder([json_encode($newer->name), json_encode($older->name)], false);
    }
}
