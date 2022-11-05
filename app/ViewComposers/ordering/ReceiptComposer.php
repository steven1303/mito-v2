<?php 
namespace App\ViewComposers\ordering;
 
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
 
class ReceiptComposer {
 
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $auth =  Auth::user();
        $access = [
            'view' => $auth->can('receipt.view'),
            'store' => $auth->can('receipt.store'),
            'edit' => $auth->can('receipt.update'),
            'delete' => $auth->can('receipt.delete'),
            'approve' => $auth->can('receipt.approve'),
            'print' => $auth->can('receipt.print'),
        ];
        $view->with('access', $access);
    }
 
}