<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use DataTables;
use URL;

class DataTableController extends Controller
{
    /**
     * @return mixed
     */
    public function users()
    {
        $row = User::query();

        return Datatables::of($row)
            ->addColumn('action', function ($row) {
                $editBtn = '<a title="редактировать" class="btn btn-xs btn-primary"  href="' . URL::route('admin.users.edit', ['id' => $row->id]) . '"><span  class="fa fa-edit"></span></a> &nbsp;';
                $deleteBtn = '<a title="удалить" class="btn btn-xs btn-danger deleteRow" id="' . $row->id . '"><span class="fa fa-trash"></span></a>';

                return '<div class="nobr"> ' . $editBtn . $deleteBtn . '</div>';
            })
            ->rawColumns(['action'])->make(true);
    }
}
