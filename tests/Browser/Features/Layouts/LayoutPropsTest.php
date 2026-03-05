<?php

use App\Models\User;

it('renders the layout props page with setLayoutProps demo', function () {
    $this->actingAs(User::factory()->create());

    $page = visit('/features/layouts/layout-props');

    $page->assertSee('Layout Props')
        ->assertSee('setLayoutProps()')
        ->assertSee('API Reference')
        ->assertSee('resetLayoutProps()')
        ->assertNoJavaScriptErrors();
});
