<?php

namespace App\Http\Controllers\Front;

use AhmedAlmory\JodaResources\JodaResource;
use App\Http\Controllers\Controller;
use App\Models\BankAccount;
use Illuminate\Http\Request;

class BankAccountsController extends Controller
{
    use JodaResource;
    public $model = BankAccount::class;
    public $view = "front.bank-accounts";


    public $permissions = [
        'read' => ['index'],
        'create' => ['create', 'store'],
        'update' => ['edit', 'update'],
        'delete' => ['destroy'],
    ];





    public function query($query)
    {
        return $query->get();
    }
}