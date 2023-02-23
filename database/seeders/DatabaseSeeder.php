<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Comment;
use App\Models\Group;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create(['name' => 'admin', 'email' => 'example@gmail.com', 'password' => \Hash::make('1234')]);

        $groups = Group::factory(100)->create();

        $first_group = tap(Group::first(), function ($group) {
            $group->update([
                'name'        => 'گروه تلگرام برنامه نویسان لاراول',
                'description' => 'گروه پرسش و پاسخ تخصصی برنامه نویس های بکند php laravel<br>چت غیر تخصصی نکنید لطفا.<br>با هم خوب باشید و اینا.<br>پیوی بدون اجازه = بلاک😂',
                'image'       => 'laravel.jpg',
                'slug'        => 'laravel',
                'link'        => 'https://t.me/laravel_frameworkk',
                'members'     => 565,
                'views'       => 100,
            ]);
        });

        $first_group->tags()->detach();
        $first_group->tags()->createMany([
            [
                'name'        => 'بک-اند',
                'slug'        => 'backend',
                'color'       => '#AAAAAA',
                'title'       => 'گروه های برنامه نویسی سمت سرور و بکند در لاراول',
                'description' => 'لیست بهترین گروه های تلگرام بک-اند در این صفحه جمع آوری شده.',
            ],
            [
                'name'  => 'فریمورک',
                'slug'  => 'framework',
                'color' => '#5ED4F3',
            ],
        ]);

        $comments = Comment::factory(20)->create(['group_id' => $first_group->id]);
        $tags = Tag::factory(20)->create();
        $tagIds = $tags->pluck('id')->toArray();

        // 10% of groups get no tags. while others will have 1 to 5 tags.
        $groups->each(function ($group) use ($tagIds) {
            if ($group->id == 1) return;

            $group->tags()->sync(
                fake()->optional(90)->randomElements($tagIds, rand(1, 5))
            );
        });
    }
}
