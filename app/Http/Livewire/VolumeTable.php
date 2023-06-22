<?php

namespace App\Http\Livewire;

use App\Models\Catalogue;
use App\Models\Item;
use App\Models\Volume;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class VolumeTable extends PowerGridComponent
{
    use ActionButton;

    public bool $multiSort = true;

    public function setUp(): array
    {
        return [
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return Volume::query()->leftJoin('items', 'volumes.item_id','=','items.id')
        ->leftJoin('catalogues','volumes.catalogue_id','=','catalogues.id')
        ->select('volumes.*','items.title as item','catalogues.name as catalogue');
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function addColumns(): PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('id')
            ->addColumn('item_id')
            ->addColumn('catalogue_id')
            ->addColumn('product_unique_id')

           /** Example of custom column using a closure **/
            ->addColumn('product_unique_id_lower', function (Volume $model) {
                return strtolower(e($model->product_unique_id));
            })

            ->addColumn('release_date_formatted', fn (Volume $model) => Carbon::parse($model->release_date)->format('d-m-Y'))
            ->addColumn('quantity')
            ->addColumn('price')
            ->addColumn('discount')
            ->addColumn('cost')
            ->addColumn('status', function (Volume $model) {
                if($model->status == 1)
                {
                    return 'ACTIVE';
                }
                else {
                    return 'INACTIVE';
                }
            });
    }

    public function columns(): array
    {
        return [

            Column::make('#SERIAL', 'product_unique_id')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('CATALOGUE', 'catalogue')
            ->sortable()
            ->searchable()
            ->makeInputSelect(Catalogue::all(), 'name', null, ['class']),

            Column::make('SERIES', 'item')
                ->sortable()
                ->searchable()
                ->makeInputSelect(Item::all(),'title',null,['class']),

            Column::make('QUANTITY', 'quantity')
                ->makeInputRange(),

            Column::make('COST', 'cost')
            ->sortable()
            ->makeInputRange(),

            Column::make('PRICE', 'price')
                ->sortable()
                ->makeInputRange(),

            Column::make('DISCOUNT', 'discount')
                ->sortable()
                ->makeInputRange(),

            Column::make('STATUS', 'status')
                ->sortable(),

            Column::make('RELEASE DATE',
                'release_date_formatted',
                'release_date'
            )
            ->searchable()
            ->sortable()
            ->makeInputDatePicker(),
        ];
    }

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


//    public function actionRules(): array
//    {
//       return [
//
//           //Hide button edit for ID 1
//            Rule::button('edit')
//                ->when(fn($volume) => $volume->id === 1)
//                ->hide()
//        ];
//    }

}
