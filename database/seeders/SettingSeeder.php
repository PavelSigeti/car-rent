<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::query()->insert([
            'name' => 'vk_link',
            'title' => 'Ссылка VK',
            'value' => '/',
        ]);
        Setting::query()->insert([
            'name' => 'inst_link',
            'title' => 'Ссылка Inst',
            'value' => '/',
        ]);
        Setting::query()->insert([
            'name' => 'tw_link',
            'title' => 'Ссылка Twitter',
            'value' => '/',
        ]);
        Setting::query()->insert([
            'name' => 'fb_link',
            'title' => 'Ссылка FaceBook',
            'value' => '/',
        ]);
        Setting::query()->insert([
            'name' => 'address',
            'title' => 'Адрес',
            'value' => '/',
        ]);
        Setting::query()->insert([
            'name' => 'phone',
            'title' => 'Телефон',
            'value' => '+7 (978) 075-76-05',
        ]);
        Setting::query()->insert([
            'name' => 'phone_link',
            'title' => 'Телефон ссылка',
            'value' => '+79780757605',
        ]);
        Setting::query()->insert([
            'name' => 'phone2',
            'title' => 'Телефон2',
            'value' => '',
        ]);
        Setting::query()->insert([
            'name' => 'phone2_link',
            'title' => 'Телефон2 ссылка',
            'value' => '',
        ]);
        Setting::query()->insert([
            'name' => 'email',
            'title' => 'Email',
            'value' => 'foxrent@mail.ru',
        ]);
        Setting::query()->insert([
            'name' => 'whatsapp',
            'title' => 'WhatsApp',
            'value' => 'https://wa.me/79780757605',
        ]);
        Setting::query()->insert([
            'name' => 'viber',
            'title' => 'Viber',
            'value' => 'viber://chat?number=79780757605',
        ]);
        Setting::query()->insert([
            'name' => 'tg',
            'title' => 'Telegram',
            'value' => 'https://t.me/FoxRent_777',
        ]);
    }
}
