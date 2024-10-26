<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'RedirectIfNotAuthenticated'], function() {

/* employee */
 Route::group(['prefix'=>"employee-group",'as'=>'employee-group.','namespace'=>"App\Http\Controllers"],function(){
     Route::get('/list','EmployeeGroupController@index')->name('index');
     Route::get('/create','EmployeeGroupController@create')->name('create');
     Route::post('/store','EmployeeGroupController@store')->name('store');
     Route::get('/edit/{id}','EmployeeGroupController@edit')->name('edit');
     Route::post('/update','EmployeeGroupController@update')->name('update');
     Route::get('/delete/{id}','EmployeeGroupController@delete')->name('delete');
 });
/* employee */

/* employee */
 Route::group(['prefix'=>"employee",'as'=>'employee.','namespace'=>"App\Http\Controllers"],function(){
     Route::get('/list','EmployeeController@index')->name('index');
     Route::get('/create','EmployeeController@create')->name('create');
     Route::post('/store','EmployeeController@store')->name('store');
     Route::get('/edit/{id}','EmployeeController@edit')->name('edit');
     Route::post('/update','EmployeeController@update')->name('update');
     Route::get('/delete/{id}','EmployeeController@delete')->name('delete');
 });
/* employee */

/* customer group */
 Route::group(['prefix'=>"customer-group",'as'=>'customer-group.','namespace'=>"App\Http\Controllers"],function(){
     Route::get('/list','CustomerGroupController@index')->name('index');
     Route::get('/create','CustomerGroupController@create')->name('create');
     Route::post('/store','CustomerGroupController@store')->name('store');
     Route::get('/edit/{id}','CustomerGroupController@edit')->name('edit');
     Route::post('/update','CustomerGroupController@update')->name('update');
     Route::get('/delete/{id}','CustomerGroupController@delete')->name('delete');
 });
/* customer group */

/* customer */
 Route::group(['prefix'=>"customer",'as'=>'customer.','namespace'=>"App\Http\Controllers"],function(){
     Route::get('/list','CustomerController@index')->name('index');
     Route::get('/create','CustomerController@create')->name('create');
     Route::post('/store','CustomerController@store')->name('store');
     Route::get('/edit/{id}','CustomerController@edit')->name('edit');
     Route::post('/update','CustomerController@update')->name('update');
     Route::get('/delete/{id}','CustomerController@delete')->name('delete');
     Route::get('/ledger','CustomerController@ledger')->name('ledger');
     Route::get('/ledger/details/{id}','CustomerController@ledger_details')->name('ledger.details');
 });
/* customer */


/* cashintype */
 Route::group(['prefix'=>"cashintype",'as'=>'cashintype.','namespace'=>"App\Http\Controllers"],function(){
     Route::get('/list','CashInTypeController@index')->name('index');
     Route::get('/create','CashInTypeController@create')->name('create');
     Route::post('/store','CashInTypeController@store')->name('store');
     Route::get('/edit/{id}','CashInTypeController@edit')->name('edit');
     Route::post('/update','CashInTypeController@update')->name('update');
     Route::get('/delete/{id}','CashInTypeController@delete')->name('delete');
 });
/* cashintype */

/* cashintype assign */
 Route::group(['prefix'=>"cashintype-assign",'as'=>'cashintype-assign.','namespace'=>"App\Http\Controllers"],function(){
     Route::get('/list','CashInTypeAssignController@index')->name('index');
     Route::get('/create','CashInTypeAssignController@create')->name('create');
     Route::post('/store','CashInTypeAssignController@store')->name('store');
     Route::get('/edit/{id}','CashInTypeAssignController@edit')->name('edit');
     Route::post('/update','CashInTypeAssignController@update')->name('update');
     Route::get('/delete/{id}','CashInTypeAssignController@delete')->name('delete');
 });
/* cashintype assign */

/* cashin */
 Route::group(['prefix'=>"cashin",'as'=>'cashin.','namespace'=>"App\Http\Controllers"],function(){
     Route::get('/list','CashInController@index')->name('index');
     Route::get('/create','CashInController@create')->name('create');
     Route::post('/store','CashInController@store')->name('store');
     Route::get('/edit/{id}','CashInController@edit')->name('edit');
     Route::post('/update','CashInController@update')->name('update');
     Route::get('/delete/{id}','CashInController@delete')->name('delete');
 });
/* cashin */

/* cashout */
 Route::group(['prefix'=>"cashout",'as'=>'cashout.','namespace'=>"App\Http\Controllers"],function(){
     Route::get('/list','CashOutController@index')->name('index');
     Route::get('/create','CashOutController@create')->name('create');
     Route::post('/store','CashOutController@store')->name('store');
     Route::get('/edit/{id}','CashOutController@edit')->name('edit');
     Route::post('/update','CashOutController@update')->name('update');
     Route::get('/delete/{id}','CashOutController@delete')->name('delete');
 });
/* cashout */


/* product */
 Route::group(['prefix'=>"product",'as'=>'product.','namespace'=>"App\Http\Controllers"],function(){
     Route::get('/list','ProductController@index')->name('index');
     Route::get('/create','ProductController@create')->name('create');
     Route::post('/store','ProductController@store')->name('store');
     Route::get('/edit/{id}','ProductController@edit')->name('edit');
     Route::post('/update','ProductController@update')->name('update');
     Route::get('/delete/{id}','ProductController@delete')->name('delete');
 });
/* product */

/* product group */
 Route::group(['prefix'=>"product-group",'as'=>'product-group.','namespace'=>"App\Http\Controllers"],function(){
     Route::get('/list','ProductGroupController@index')->name('index');
     Route::get('/create','ProductGroupController@create')->name('create');
     Route::post('/store','ProductGroupController@store')->name('store');
     Route::get('/edit/{id}','ProductGroupController@edit')->name('edit');
     Route::post('/update','ProductGroupController@update')->name('update');
     Route::get('/delete/{id}','ProductGroupController@delete')->name('delete');
 });
/* product group */


/* sale */
 Route::group(['prefix'=>"sale",'as'=>'sale.','namespace'=>"App\Http\Controllers"],function(){
     Route::get('/details/{order_id}','SaleController@details')->name('details');
     Route::get('/list','SaleController@index')->name('index');
     Route::get('/create','SaleController@create')->name('create');
     Route::post('/store','SaleController@store')->name('store');
     Route::get('/edit/{id}','SaleController@edit')->name('edit');
     Route::post('/update','SaleController@update')->name('update');
     Route::get('/delete/{id}','SaleController@delete')->name('delete');
 });
/* sale */

/* purchase */
 Route::group(['prefix'=>"purchase",'as'=>'purchase.','namespace'=>"App\Http\Controllers"],function(){
     Route::get('/details/{order_id}','PurchaseController@details')->name('details');
     Route::get('/list','PurchaseController@index')->name('index');
     Route::get('/create','PurchaseController@create')->name('create');
     Route::post('/store','PurchaseController@store')->name('store');
     Route::get('/edit/{id}','PurchaseController@edit')->name('edit');
     Route::post('/update','PurchaseController@update')->name('update');
     Route::get('/delete/{id}','PurchaseController@delete')->name('delete');
 });
/* purchase */

/* advance-salary */
 Route::group(['prefix'=>"advance-salary",'as'=>'advance-salary.','namespace'=>"App\Http\Controllers"],function(){
     Route::get('/list','AdvanceSalaryController@index')->name('index');
     Route::get('/create','AdvanceSalaryController@create')->name('create');
     Route::post('/store','AdvanceSalaryController@store')->name('store');
     Route::get('/edit/{id}','AdvanceSalaryController@edit')->name('edit');
     Route::post('/update','AdvanceSalaryController@update')->name('update');
     Route::get('/delete/{id}','AdvanceSalaryController@delete')->name('delete');
 });
/* advance-salary */

/* bank */
 Route::group(['prefix'=>"bank",'as'=>'bank.','namespace'=>"App\Http\Controllers"],function(){
     Route::get('/list','BackInformationController@index')->name('index');
     Route::get('/create','BackInformationController@create')->name('create');
     Route::post('/store','BackInformationController@store')->name('store');
     Route::get('/edit/{id}','BackInformationController@edit')->name('edit');
     Route::post('/update','BackInformationController@update')->name('update');
     Route::get('/delete/{id}','BackInformationController@delete')->name('delete');
     Route::get('/details/{id}','BackInformationController@details')->name('details');
 });
/* bank */


/* bank calculation */
 Route::group(['prefix'=>"bank-calculation",'as'=>'bank-calculation.','namespace'=>"App\Http\Controllers"],function(){
     Route::get('/list','BankCalculationController@index')->name('index');
     Route::get('/create','BankCalculationController@create')->name('create');
     Route::post('/store','BankCalculationController@store')->name('store');
     Route::get('/edit/{id}','BankCalculationController@edit')->name('edit');
     Route::post('/update','BankCalculationController@update')->name('update');
     Route::get('/delete/{id}','BankCalculationController@delete')->name('delete');
 });
/* bank calculation */

/* director */
 Route::group(['prefix'=>"director",'as'=>'director.','namespace'=>"App\Http\Controllers"],function(){
     Route::get('/list','DirectorController@index')->name('index');
     Route::get('/create','DirectorController@create')->name('create');
     Route::post('/store','DirectorController@store')->name('store');
     Route::get('/edit/{id}','DirectorController@edit')->name('edit');
     Route::post('/update','DirectorController@update')->name('update');
     Route::get('/delete/{id}','DirectorController@delete')->name('delete');
 });
/* director */

/* director payment */
 Route::group(['prefix'=>"director-payment",'as'=>'director-payment.','namespace'=>"App\Http\Controllers"],function(){
     Route::get('/list','DirectorPaymentController@index')->name('index');
     Route::get('/create','DirectorPaymentController@create')->name('create');
     Route::post('/store','DirectorPaymentController@store')->name('store');
     Route::get('/edit/{id}','DirectorPaymentController@edit')->name('edit');
     Route::post('/update','DirectorPaymentController@update')->name('update');
     Route::get('/delete/{id}','DirectorPaymentController@delete')->name('delete');
 });
/* director payment */

/* advance-salary */
 Route::group(['prefix'=>"setting",'as'=>'setting.','namespace'=>"App\Http\Controllers"],function(){
     Route::get('/create','SettingController@create')->name('create');
     Route::post('/store','SettingController@store')->name('store');
     Route::get('/{id}/edit','SettingController@edit')->name('edit');
     Route::patch('/{id}/update','SettingController@update')->name('update');
 });
/* advance-salary */

/* additional work */
 Route::group(['prefix'=>"get",'as'=>'get.','namespace'=>"App\Http\Controllers"],function(){
     Route::get('/products','AdditionalController@getProducts')->name('products');
     Route::get('/customers','AdditionalController@getCustomers')->name('customers');
     Route::get('/invoices','AdditionalController@getInvoices')->name('invoices');
     Route::get('/customer/group','AdditionalController@getCustomerGroup')->name('customer.group');
 });
/* additional work */


/* factory group */
 Route::group(['prefix'=>"factory-group",'as'=>'factory-group.','namespace'=>"App\Http\Controllers"],function(){
     Route::get('/list','FactoryGroupController@index')->name('index');
     Route::get('/create','FactoryGroupController@create')->name('create');
     Route::post('/store','FactoryGroupController@store')->name('store');
     Route::get('/edit/{id}','FactoryGroupController@edit')->name('edit');
     Route::post('/update','FactoryGroupController@update')->name('update');
     Route::get('/delete/{id}','FactoryGroupController@delete')->name('delete');
 });
/* factory group */

/* factory */
 Route::group(['prefix'=>"factory",'as'=>'factory.','namespace'=>"App\Http\Controllers"],function(){
     Route::get('/list','FactoryController@index')->name('index');
     Route::get('/create','FactoryController@create')->name('create');
     Route::post('/store','FactoryController@store')->name('store');
     Route::get('/edit/{id}','FactoryController@edit')->name('edit');
     Route::post('/update','FactoryController@update')->name('update');
     Route::get('/delete/{id}','FactoryController@delete')->name('delete');
 });
/* factory */



/* report */
 Route::group(['prefix'=>"report",'as'=>'report.','namespace'=>"App\Http\Controllers"],function(){
     Route::get('/sale/print/{id}','ReportController@sale_print')->name('sale.print');
     Route::get('/sale/bank','ReportController@bank')->name('sale.bank');
     Route::get('/sale/cash','ReportController@cash')->name('sale.cash');
     Route::get('/total/cashin','ReportController@cashin')->name('sale.cashin');
     Route::get('/total/cashout','ReportController@cashout')->name('sale.cashout');
     Route::get('/total/due','ReportController@total_due')->name('total.due');
     Route::get('/customer/due','ReportController@customer_due')->name('customer.due');
     Route::get('/employee/salary','ReportController@employee_salary')->name('employee.salary');

     Route::get('/sale/history/{customer_group_id}/{customer_id}','ReportController@sale_history')->name('sale.history');

     Route::get('/purchase/print/{id}','ReportController@purchase_print')->name('purchase.print');

     Route::get('/product/history/{product_id}','ReportController@product_history')->name('product.history');

     Route::get('/customer/payment','ReportController@customer_payment')->name('customer.payment');

     // Route::get('/account/statement','ReportController@account_statement')->name('account.statement');

     // Route::post('/date/wise/account/statement','ReportController@date_wise_account_statement')->name('date.wise.account.statement');

     Route::match(['get', 'post'], '/account/statement', 'ReportController@account_statement')->name('account.statement');


 });
/* report */

});




Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
