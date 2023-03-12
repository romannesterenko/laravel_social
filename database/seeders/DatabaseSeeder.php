<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        \App\Models\User::factory(850)->create();
        $this->command->info('Пользователи загружены');
        \App\Models\Community::factory(100)->create();
        $this->command->info('Сообщества загружены');
        \App\Models\Admin\Post::factory(7500)->create();
        $this->command->info('Посты загружены');
       \App\Models\Coment::factory(15000)->create();
        $this->command->info('Комментарии загружены');
       \App\Models\CommunityUser::factory(10000)->create();
        $this->command->info('Подписки на сообщества загружены');
    }
}
