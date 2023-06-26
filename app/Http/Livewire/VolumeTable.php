<?php

namespace App\Http\Livewire;

use App\Models\Catalogue;
use App\Models\Item;
use App\Models\Volume;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

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
            ->addColumn('discount_active_till_formatted', function (Volume $model) {
                if($model->discount_active_till != null)
                {
                    return Carbon::parse($model->discount_active_till)->format('d-m-Y');
                } else {
                    return '---';
                }
            })
            ->addColumn('status', function (Volume $model) {
                if($model->status == 1)
                {
                return "<a href='volumes/change_status/".$model->id."'><i class='fa fa-toggle-on' style='font-size:30px;color:#4e73df'></i></a>";
                }
                else {
                return "<a href='volumes/change_status/".$model->id."'><i class='fa fa-toggle-off' style='font-size:30px;color:#B0B0B0'></i></a>";
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

            Column::make('PRICE', 'price')
                ->sortable()
                ->makeInputRange(),

            Column::make('DISCOUNT', 'discount')
                ->sortable()
                ->makeInputRange(),

            Column::make('DISCOUNT TILL',
                'discount_active_till_formatted',
                'discount_active_till'
            )
            ->searchable()
            ->sortable()
            ->makeInputDatePicker(),

            Column::make(
                'RELEASE DATE',
                'release_date_formatted',
                'release_date'
            )
            ->searchable()
            ->sortable()
            ->makeInputDatePicker(),

            Column::make('STATUS', 'status')
                ->sortable(),
        ];
    }

    public function actions(): array
    {
        $actions = [];

        if(auth()->guard('admin')->user()->hasPermissionTo('volume report'))
        {
            $actions[] = Button::make('read', '<i class="fas fa-info-circle"></i>')
                ->class('btn btn-info btn-circle btn-sm')
                ->route('read-volume-view', ['id' => 'id'])->target('');
        }
        if(auth()->guard('admin')->user()->hasPermissionTo('update volume'))
        {
            $actions[] = Button::make('edit', '<i class="fas fa-pen"></i>')
                ->class('btn btn-warning btn-circle btn-sm');
            // ->route('item.edit', ['item' => 'id'])->target('');
        }
        if(auth()->guard('admin')->user()->hasPermissionTo('delete volume'))
        {
            $actions[] = Button::make('destroy', '<i class="fas fa-trash"></i>')
                ->class('btn btn-danger btn-circle btn-sm');
            // ->route('item.destroy', ['item' => 'id'])->target('')
        }

        return $actions;
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
