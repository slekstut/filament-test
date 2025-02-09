<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Artist;
use App\Models\Album;
use App\Models\Genre;
use App\Models\Track;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Genres
        $pop = Genre::create(['name' => 'Pop', 'description' => 'Popular music genre']);
        $rock = Genre::create(['name' => 'Rock', 'description' => 'Rock music genre']);

        // Create Artists
        $artist1 = Artist::create([
            'name' => 'Artist 1',
            'image' => null,
            'description' => 'This is a description of Artist 1.',
            'country' => 'USA',
        ]);

        $artist2 = Artist::create([
            'name' => 'Artist 2',
            'image' => null,
            'description' => 'This is a description of Artist 2.',
            'country' => 'UK',
        ]);

        // Create Albums
        $album1 = Album::create([
            'title' => 'Album 1',
            'artist_id' => $artist1->id,
            'cover_image' => null,
            'release_date' => now(),
            'status' => 'released',
        ]);

        $album2 = Album::create([
            'title' => 'Album 2',
            'artist_id' => $artist2->id,
            'cover_image' => null,
            'release_date' => now(),
            'status' => 'upcoming',
        ]);

        // Create Tracks
        Track::create([
            'title' => 'Track 1',
            'artist_id' => $artist1->id,
            'album_id' => $album1->id,
            'genre_id' => $pop->id,
            'duration' => 240,
            'release_date' => now(),
            'url' => null,
            'status' => 'active',
        ]);

        Track::create([
            'title' => 'Track 2',
            'artist_id' => $artist2->id,
            'album_id' => $album2->id,
            'genre_id' => $rock->id,
            'duration' => 180,
            'release_date' => now(),
            'url' => null,
            'status' => 'archived',
        ]);
    }
}
