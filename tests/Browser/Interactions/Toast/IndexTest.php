<?php

namespace Tests\Browser\Interactions\Toast;

use Laravel\Dusk\Browser;
use Tests\Browser\BrowserTestCase;
use Tests\Browser\Interactions\Toast\Components\ToastComponent;

class IndexTest extends BrowserTestCase
{
    /** @test */
    public function can_send_all(): void
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, ToastComponent::class)
                // success
                ->assertDontSee('Foo bar success')
                ->click('#success')
                ->pause(150)
                ->assertSee('Foo bar success')
                // error
                ->assertDontSee('Foo bar error')
                ->click('#error')
                ->pause(150)
                ->assertSee('Foo bar error')
                // info
                ->assertDontSee('Foo bar info')
                ->click('#info')
                ->pause(150)
                ->assertSee('Foo bar info')
                // warning
                ->assertDontSee('Foo bar warning')
                ->click('#warning')
                ->pause(150)
                ->assertSee('Foo bar warning');
        });
    }

    /** @test */
    public function can_send_confirmation(): void
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, ToastComponent::class)
                ->assertDontSee('Foo bar confirmation description')
                ->click('#confirm')
                ->pause(150)
                ->assertSee('Foo bar confirmation description')
                ->pause(150)
                ->click('#tasteui_confirmation')
                ->pause(150)
                ->assertDontSee('Foo bar confirmation description');
        });
    }

    /** @test */
    public function can_send_cancellation(): void
    {
        $this->browse(function (Browser $browser) {
            $this->visit($browser, ToastComponent::class)
                ->assertDontSee('Foo bar confirmation description')
                ->click('#confirm')
                ->pause(150)
                ->assertSee('Foo bar confirmation description')
                ->pause(150)
                ->click('#tasteui_cancellation')
                ->pause(150)
                ->assertSee('Bar foo cancelled bar');
        });
    }
}
