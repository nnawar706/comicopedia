<?php

namespace App\Http\Livewire;

use App\Models\Item;
use Livewire\WithPagination;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

class ItemTable extends PowerGridComponent
{
    use ActionButton, WithPagination;

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp():array
    {
        $this->showCheckBox();

        return [
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */

    /**
    * PowerGrid datasource.
    *
    * @return Builder<\App\Models\Item>
    */
    public function datasource(): Builder
    {
        return Item::query();
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */

    /**
     * Relationship search.
     *
     * @return array<string, array<int, string>>
     */
    public function relationSearch(): array
    {
        return [];
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    | ❗ IMPORTANT: When using closures, you must escape any value coming from
    |    the database using the `e()` Laravel Helper function.
    |
    */
    public function addColumns(): PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('id')
            ->addColumn('item_unique_id')

           /** Example of custom column using a closure **/
            ->addColumn('item_unique_id_lower', function (Item $model) {
                return strtolower(e($model->item_unique_id));
            })

            ->addColumn('genre_id')
            ->addColumn('title')
            ->addColumn('author')
            ->addColumn('magazine')
            ->addColumn('volumes')
            ->addColumn('created_at_formatted', fn (Item $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
    }

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
    */

     /**
     * PowerGrid Columns.
     *
     * @return array<int, Column>
     */
    public function columns(): array
    {
        return [
            Column::make('Series No', 'item_unique_id')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('GENRE ID', 'genre_id')
                ->makeInputRange(),

            Column::make('TITLE', 'title')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('AUTHOR', 'author')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('MAGAZINE', 'magazine')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('VOLUMES', 'volumes')
                ->sortable(),

            Column::make('CREATED AT', 'created_at_formatted', 'created_at')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker(),

        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

     /**
     * PowerGrid Item Action Buttons.
     *
     * @return array<int, Button>
     */


     public function actions(): array
     {
         return [
             Button::make('read', '<i class="fas fa-info-circle"></i>')
                 ->class('btn btn-info btn-circle btn-sm')
              ->route('read-item-view', ['id' => 'id']),

             Button::make('edit', '<i class="fas fa-pen"></i>')
                 ->class('btn btn-warning btn-circle btn-sm'),
                 // ->route('item.edit', ['item' => 'id']),

             Button::make('destroy', '<i class="fas fa-trash"></i>')
                 ->class('btn btn-danger btn-circle btn-sm')
                 // ->route('item.destroy', ['item' => 'id'])
                 ->method('delete')
             ];
     }


    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

     /**
     * PowerGrid Item Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($item) => $item->id === 1)
                ->hide(),
        ];
    }
    */
}
