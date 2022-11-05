<?php 
namespace App\ViewComposers\ordering;
 
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
 
class PoNonStockComposer {
 
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
            'view' => $auth->can('.view'),
            'edit' => $auth->can('.update'),
            'delete' => $auth->can('.delete'),
            'request' => $auth->can('.request'),
            'verify1' => $auth->can('.verify1'),
            'verify2' => $auth->can('.verify2'),
            'approve' => $auth->can('.approve'),
            'print' => $auth->can('.print'),
        ];
        $view->with('access', $access);
    }
 
}