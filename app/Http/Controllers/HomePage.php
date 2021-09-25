<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Orchid\Platform\Models\Role;
use Pheature\Core\Toggle\Read\Toggle;
use Pheature\Model\Toggle\Identity;

final class HomePage extends Controller
{
    public function __construct(
        private Toggle $toggle
    ) {}

    public function __invoke(Request $request): View
    {
        $user = Auth::user();
        $showCommercialName = $this->toggle->isEnabled('show_commercial_name');
        $showHomeDynamicCatalog = $this->toggle->isEnabled('show_home_dynamic_catalog', new Identity(
            'anon',
            [
                'role' => $user?->roles
                    ->filter(fn(Role $role) => 'developer' === $role->slug)
                    ->map(fn(Role $role) => $role->slug)
                    ?->first()
            ]
        ));

        return view('welcome', [
            'show_brand_logo' => $this->toggle->isEnabled('show_brand_logo'),
            'show_home_dynamic_catalog' => $showHomeDynamicCatalog,
            'catalog' => $showHomeDynamicCatalog ? Product::paginate() : [],
            'show_contact_info' => $this->toggle->isEnabled('show_contact_info'),
            'show_commercial_name' => $showCommercialName,
            'commercial_name' => $showCommercialName ? 'My Little Friend Shop' : null,
        ]);
    }
}
