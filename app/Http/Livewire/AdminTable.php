<?php

namespace App\Http\Livewire;

use App\Models\Admin;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class AdminTable extends PowerGridComponent
{
    use ActionButton;

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
        return Admin::query()->leftJoin('model_has_roles', 'admins.id', '=', 'model_has_roles.model_id')
            ->leftJoin('roles','roles.id','=','model_has_roles.role_id')
            ->select('admins.*', 'roles.name as role');
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function addColumns(): PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('id')
            ->addColumn('role', function(Admin $model) {
                return '<b>'.$model->role.'</b>';
            })
            ->addColumn('name')

           /** Example of custom column using a closure **/
            ->addColumn('name_lower', function (Admin $model) {
                return strtolower(e($model->name));
            })

            ->addColumn('email')
            ->addColumn('contact')
            ->addColumn('is_active', function (Admin $model) {
                if ($model->is_active == 1) {
                    return "<i class='fa fa-circle' style='font-size:12px;color:green'></i>";
                } else {
                    return "<i class='fa fa-circle' style='font-size:12px;color:#B0B0B0'></i>";
                }
            })
            ->addColumn('created_at_formatted', fn (Admin $model) => Carbon::parse($model->created_at)->format('d-m-Y'));
    }

    public function columns(): array
    {
        return [
            Column::make('ROLE', 'role')
                ->sortable()
                ->searchable(),

            Column::make('NAME', 'name')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('EMAIL', 'email')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('CONTACT', 'contact')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('STATUS', 'is_active')
                ->sortable(),

            Column::make('JOINED ON', 'created_at_formatted', 'created_at')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker(),

        ]
;
    }

    public function actions(): array
    {
        $actions = [];

        if(auth()->guard('admin')->user()->hasPermissionTo('user information'))
        {
            $actions[] = Button::make('read', '<i class="fas fa-info-circle"></i>')
                            ->class('btn btn-info btn-circle btn-sm')
                            ->route('read-admin-view', ['id' => 'id'])->target('');
        }
        if (auth()->guard('admin')->user()->hasPermissionTo('activate/deactivate user'))
        {
            $actions[] = Button::make('destroy', '<i class="fas fa-power-off"></i>')
            ->class('btn btn btn-warning btn-circle btn-sm')
            ->route('change-status', ['id' => 'id'])->target('');
        }
        if (auth()->guard('admin')->user()->hasPermissionTo('delete user'))
        {
            $actions[] = Button::make('destroy', '<i class="fas fa-trash"></i>')
                ->class('btn btn-danger btn-circle btn-sm')
                ->route('admin-delete', ['id' => 'id'])->target('');
        }

        return $actions;
    }

    /*
    public function actionRules(): array
    {
        return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($admin) => $admin->id === 1)
                ->hide(),
        ];
    }
    */
}
