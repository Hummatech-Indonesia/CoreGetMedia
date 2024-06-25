<?php

namespace Database\Seeders;

use App\Models\AboutGet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutGetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AboutGet::create([
            'image' => 'assets/img/logo/get-media-light.svg',
            'slogan' => 'GetMedia berita terlengkap dengan berita terbaru dan terpopuler',
            'email' => 'getmedia@gmail.com',
            'phone_number' => '+62 0000 0000',
            'address' => 'Permata Regency',
            'header' => 'KAMI ADALAH PORTAL BERITA TERBAIK DAN PROFESSIONAL',
            'description' => 'Di era digital yang penuh dengan informasi yang tak terhingga, kami hadir sebagai sumber berita
                                yang terpercaya dan mudah diakses oleh Anda. Kami bukan sekadar portal berita biasa, tetapi
                                sebuah komunitas yang berkomitmen untuk menyajikan informasi yang akurat, objektif, dan
                                mencerahkan bagi masyarakat',
            'url_facebook' => 'facebook.com',
            'url_twitter' => 'twitter.com',
            'url_instagram' => 'instagram.com',
            'url_linkedin' => 'linkedin.com',
        ]);
    }
}
