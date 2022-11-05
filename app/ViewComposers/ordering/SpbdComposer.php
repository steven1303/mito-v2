<?php 
namespace App\ViewComposers\ordering;
 
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
 
class SpbdComposer {
 
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
            'view' => $auth->can('spbd.view'),
            'store' => $auth->can('spbd.store'),
            'edit' => $auth->can('spbd.update'),
            'delete' => $auth->can('spbd.delete'),
            'request' => $auth->can('spbd.request'),
            'verify1' => $auth->can('spbd.verify1'),
            'verify2' => $auth->can('spbd.verify2'),
            'approve' => $auth->can('spbd.approve'),
            'print' => $auth->can('spbd.print'),
        ];
        $view->with('access', $access);
    }
 
}