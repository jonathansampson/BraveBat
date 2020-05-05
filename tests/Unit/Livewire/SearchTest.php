<?php

namespace Tests\Unit\Livewire;

use Tests\TestCase;
use Livewire\Livewire;
use App\Models\Creator;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SearchTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function the_search_dropdown_works_correctly()
    {
        $creator = factory(Creator::class)->create([
            'name' => 'bravebat.info',
            'rank' => 1,
            'valid' => true,
        ]);
        Livewire::test('search')
            ->assertDontSee('bravebat.info')
            ->set('search', 'bravebat')
            ->assertSee('bravebat.info');
    }
}
