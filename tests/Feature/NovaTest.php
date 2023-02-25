<?php

use App\Models\Group;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;

uses(RefreshDatabase::class);

beforeEach(fn() => $this->actingAs(user: create(User::class)) && Storage::fake());

test('create group with image', function () {
    $this->post('/nova-api/groups/', [
        'name'  => 'foo',
        'link'  => 'https://foo.com',
        'slug'  => 'foo',
        'image' => UploadedFile::fake()->image('img.webp'),
    ])->assertCreated();

    Storage::assertExists("group/foo.jpg");
    $this->assertDatabaseHas('groups', ['image' => 'foo.jpg']);
});

test('update group with image replacement', function () {
    $group = create(Group::class, ['image' => 'foo.jpg']);
    Storage::put('group/foo.jpg', 'some non-jpg content :D');

    $this->put("/nova-api/groups/$group->id", [
        'name'  => 'bar',
        'link'  => 'https://bar.com',
        'slug'  => 'bar',
        'image' => UploadedFile::fake()->image('img.webp'),
    ])->assertSuccessful();

    Storage::assertMissing("group/foo.jpg");
    Storage::assertExists("group/bar.jpg");
    $this->assertDatabaseHas('groups', ['image' => 'bar.jpg']);
});