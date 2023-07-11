<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class OrderTable extends PowerGridComponent
{
    use ActionButton;

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp(): array
    {
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
    * @return Builder<\App\Models\Order>
    */
    public function datasource(): Builder
    {
        return Order::query()->leftJoin('users','orders.user_id','=','users.id')
        ->leftJoin('order_statuses','orders.status_id','=','order_statuses.id')->select('orders.*','users.id as user_id','users.name as user_name',
        'order_statuses.id as status_id','order_statuses.name as order_status')->latest();
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
            ->addColumn('user_id')
            ->addColumn('user_name')
            ->addColumn('address_id')
            ->addColumn('order_no')

           /** Example of custom column using a closure **/
            ->addColumn('order_no_lower', function (Order $model) {
                return strtolower(e($model->order_no));
            })

            ->addColumn('delivery_tracking_no')
            ->addColumn('contact')
            ->addColumn('is_promo')
            ->addColumn('promo_discount')
            ->addColumn('shipping_cost')
            ->addColumn('total', function(Order $model) {
                return $model->total + $model->shipping_cost - $model->promo_discount;
            })
            ->addColumn('status_id')
            ->addColumn('order_status', function (Order $model) {
                if($model->status_id == 1) {
                    return "<button class='btn btn-warning'>" . $model->order_status . "</button>";
                } else if($model->status_id == 2) {
                    return "<button class='btn btn-primary'>" . $model->order_status . "</button>";
                } else if($model->status_id == 3) {
                    return "<button class='btn btn-danger'>" . $model->order_status . "</button>";
                } else {
                    return "<button class='btn btn-info'>" . $model->order_status . "</button>";
                }
            })
            ->addColumn('created_at_formatted', fn (Order $model) => Carbon::parse($model->created_at)->format('d-m-Y'));
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
            Column::make('ORDER NO', 'order_no')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('CUSTOMER', 'user_name')
                ->sortable()
                ->searchable()
                ->makeInputSelect(User::all(), 'name', null, ['class']),

            Column::make('DELIVERY TRACKING NO', 'delivery_tracking_no')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('CONTACT', 'contact')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('TOTAL', 'total')
                ->makeInputRange(),

            Column::make('STATUS', 'order_status')
                ->sortable()
                ->searchable(),

            Column::make('ORDERED ON', 'created_at_formatted', 'created_at')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker(),

        ]
;
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

     /**
     * PowerGrid Order Action Buttons.
     *
     * @return array<int, Button>
     */


    public function actions(): array
    {
        $actions = [];

        if(auth()->guard('admin')->user()->hasPermissionTo('order list')) {
            $actions[] = Button::make('read', '<i class="fas fa-info-circle"></i>')
            ->class('btn btn-info btn-circle btn-sm')
            ->route('read-order-view', ['id' => 'id'])->target('');
        }

        return $actions;
    }


    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

     /**
     * PowerGrid Order Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($order) => $order->id === 1)
                ->hide(),
        ];
    }
    */
}
