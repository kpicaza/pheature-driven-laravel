<?php

namespace App\Orchid\Screens\Product;

use App\Models\Product;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class ProductEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Create new Product';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Store products';

    /**
     * @var bool
     */
    public $exists = false;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Product $product): array
    {
        $this->exists = $product->exists;

        if ($this->exists) {
            $this->name = 'Edit product';
        }

        $product->load('attachment');
        $product->attachment()->syncWithoutDetaching(
            $product->picture
        );

        return [
            'product' => $product
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Button::make('Save product')
                ->icon('save')
                ->method('createOrUpdate')
                ->canSee(!$this->exists),

            Button::make('Update')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->exists),

            Button::make('Remove')
                ->icon('trash')
                ->method('remove')
                ->canSee($this->exists),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            Layout::rows([
                Input::make('product.name')
                    ->title('Title')
                    ->placeholder('Attractive but mysterious name')
                    ->help('Specify a short descriptive title for this product.'),
                Picture::make('product.picture')
                    ->targetId()
                    ->title('Picture')
                    ->width(80)
                    ->help('Add a picture for this product.'),
                Input::make('product.price')
                    ->title('Price')
                    ->placeholder('Product price')
                    ->help('Specify a price for this product.'),
            ])
        ];
    }


    /**
     * @param Product $product
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(Product $product, Request $request)
    {
        $product->fill($request->get('product'))->save();

        $product->attachment()->syncWithoutDetaching(
            $request->input('product.picture', [])
        );
        Alert::info('You have successfully created a product.');

        return redirect()->route('platform.product.list');
    }

    /**
     * @param Product $product
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove(Product $product)
    {
        $product->delete();

        Alert::info('You have successfully deleted the product.');

        return redirect()->route('platform.product.list');
    }
}
