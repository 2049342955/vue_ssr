
<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::get('/test', 'Admin\IndexController@test');

Route::group(['middleware' => 'guest'], function(){
	
	Route::get('/', 'Admin\IndexController@index');


	/**
	 * 后台首页管理模块
	 * @author      mozarlee
	 * @time        2017-07-11 13:58:01
	 * @created by  Sublime Text 3
	 */
	
	// banner设置
	Route::get('/home', 'Admin\Banner\BannerController@index');
	// 新增\更新
	Route::get('/banner/savebanner', 'Admin\Banner\BannerController@showSaveBanner');
	Route::post('/banner/savebanner', 'Admin\Banner\BannerController@saveBanner');

	// 删除
	Route::get('/banner/delete', 'Admin\Banner\BannerController@deleteBanner');

	/**
	 * 信息发布模块管理
	 * @author      mozarlee
	 * @time        2017-07-11 13:57:58
	 * @created by  Sublime Text 3
	 */
	// 模块管理
	Route::get('/information/module', 'Admin\Information\InformationClassController@index');
	// 编辑
	Route::get('/information/module_update', 'Admin\Information\InformationClassController@update');
	Route::post('/information/module_update', 'Admin\Information\InformationClassController@doUpdate');
	// 新增
	Route::get('/information/module_create', 'Admin\Information\InformationClassController@create');
	Route::post('/information/module_create', 'Admin\Information\InformationClassController@doCreate');
	// 删除
	Route::get('/information/module_delete', 'Admin\Information\InformationClassController@delete');

	// 内容管理
	Route::get('/information/content', 'Admin\Information\InformationContentController@index');
	// 编辑
	Route::get('/information/content_update', 'Admin\Information\InformationContentController@update');
	Route::post('/information/content_update', 'Admin\Information\InformationContentController@doUpdate');
	// 新增
	Route::get('/information/content_create', 'Admin\Information\InformationContentController@create');
	Route::post('/information/content_create', 'Admin\Information\InformationContentController@doCreate');
	// 删除
	Route::get('/information/content_delete', 'Admin\Information\InformationContentController@delete');
	

	/**
	 * 常见问题管理模块
	 * @author      mozarlee
	 * @time        2017-07-11 13:57:56
	 * @created by  Sublime Text 3
	 */
	
	// 模块管理
	Route::get('/help_module', 'Admin\Help\HelpClassController@index');
	// 编辑
	Route::get('/help_module_update', 'Admin\Help\HelpClassController@update');
	Route::post('/help_module_update', 'Admin\Help\HelpClassController@doUpdate');
	// 新增
	Route::get('/help_module_create', 'Admin\Help\HelpClassController@create');
	Route::post('/help_module_create', 'Admin\Help\HelpClassController@doCreate');
	// 删除
	Route::get('/help_module_delete', 'Admin\Help\HelpClassController@delete');

	// 内容管理
	Route::get('/help_content', 'Admin\Help\HelpContentController@index');
	// 编辑
	Route::get('/help_content_update', 'Admin\Help\HelpContentController@update');
	Route::post('/help_content_update', 'Admin\Help\HelpContentController@doUpdate');
	// 新增
	Route::get('/help_content_create', 'Admin\Help\HelpContentController@create');
	Route::post('/help_content_create', 'Admin\Help\HelpContentController@doCreate');
	// 删除
	Route::get('/help_content_delete', 'Admin\Help\HelpContentController@delete');

	/**
	 * 用户管理
	 * @author      mozarlee
	 * @time        2017-07-11 13:58:09
	 * @created by  Sublime Text 3
	 */
	// 用户基本信息
	Route::get('/usermsg', 'Admin\User\UserController@index');
	Route::get('/usermsg/search', 'Admin\User\UserController@search');
	// 禁止、解禁登陆
	Route::get('/usermsg/forbid_login/{status}', 'Admin\User\UserController@forbidLogin');
	// 禁止、解禁提现
	Route::get('/usermsg/forbid_withdraw/{status}', 'Admin\User\UserController@forbidWithdraw');
	// 禁止、解禁交易
	Route::get('/usermsg/forbid_trade/{status}', 'Admin\User\UserController@forbidTrade');

	// 用户认证资料
	Route::get('/user_verify', 'Admin\User\UserVerifyController@index');
	// 查询
	Route::get('/user_verify/search', 'Admin\User\UserVerifyController@search');
	// 更新认证状态
	Route::get('/user_verify/updatestatus/{status}', 'Admin\User\UserVerifyController@updateStatus');

	// 用户绑定银行卡
	Route::get('/user_bindcard', 'Admin\User\UserBindcardController@index');
	Route::get('/user_bindcard/search', 'Admin\User\UserBindcardController@search');
	// 验证银行卡
	Route::get('/user_bindcard/check/{status}', 'Admin\User\UserBindcardController@check');
	

	/**
	 * 理财产品管理
	 * @author      mozarlee
	 * @time        2017-07-11 15:53:39
	 * @created by  Sublime Text 3
	 */
	// 新增算力类型管理
	Route::get('/product/hashtype', 'Admin\Product\ProductTypeController@index');
	Route::get('/product/hashtype/save', 'Admin\Product\ProductTypeController@showSave');
	Route::post('/product/hashtype/save', 'Admin\Product\ProductTypeController@save');


	// 产品基类设置
	Route::get('/product/base', 'Admin\Product\ProductBaseController@index');
	// 保存数据
	Route::get('/product/base/save', 'Admin\Product\ProductBaseController@showSave');
	Route::post('/product/base/save', 'Admin\Product\ProductBaseController@save');

	// 同一基类产品介绍
	Route::get('/product/base/introduction/{base_id}', 'Admin\Product\ProductIntroductionController@index');
	Route::get('/product/base/introduction/save/{base_id}', 'Admin\Product\ProductIntroductionController@showSave');
	Route::post('/product/base/introduction/save/{base_id}', 'Admin\Product\ProductIntroductionController@save');
	Route::get('/product/base/introduction/delete/{base_id}', 'Admin\Product\ProductIntroductionController@delete');

	// 合同模板管理
	Route::get('/product/contract', 'Admin\Product\ContractController@index');
	Route::get('/product/contract/save', 'Admin\Product\ContractController@showSave');
	Route::post('/product/contract/save', 'Admin\Product\ContractController@save');
	// 预览合同内容
	Route::get('/product/contract/preview', 'Admin\Product\ContractController@preview');

	// 产品管理
	Route::get('/product/manage', 'Admin\Product\ProductController@index');
	Route::get('/product/manage/save', 'Admin\Product\ProductController@showSave');
	Route::post('/product/manage/save', 'Admin\Product\ProductController@save');
	// 修改是否在首页展示
	Route::get('/product/manage/top/{status}', 'Admin\Product\ProductController@changeTop');
	// 修改产品状态
	Route::get('/product/manage/changestatus/{status}', 'Admin\Product\ProductController@changeStatus');
	// 查询
	Route::get('/product/manage/search', 'Admin\Product\ProductController@search');

	// 产品结算
	Route::get('/product/settle', 'Admin\Product\ProductSettleController@index');
	// 录入收益
	Route::get('/product/settle/insert/{id}', 'Admin\Product\ProductSettleController@showInsertIncome');
	Route::post('/product/settle/insert/{id}', 'Admin\Product\ProductSettleController@insertIncome');
	// 允许分配
	Route::get('/product/settle/allow_distribution/{id}', 'Admin\Product\ProductSettleController@allowDistribution');
	// 执行分配操作
	Route::get('/product/settle/distribution/{id}', 'Admin\Product\ProductSettleController@distribution');
	// 执行审核通过操作
	Route::get('/product/settle/checkaccess/{id}', 'Admin\Product\ProductSettleController@checkAccess');
	// 转账
	Route::get('/product/settle/transfer/{id}', 'Admin\Product\ProductSettleController@transfer');

	/**
	 * 转让产品管理
	 */
	Route::get('/attorn', 'Admin\Attorn\AttornController@index');

	/**
	 * 推广奖励管理
	 */
	Route::get('/award ', 'Admin\Award\PromotionAwardController@index');
	

	/**
	 * 人民币流水管理
	 * @author      mozarlee
	 * @time        2017-07-12 19:19:27
	 * @created by  Sublime Text 3
	 */
	// 充值列表
	Route::get('/yen/recharge', 'Admin\Yen\RechargeController@index');
	Route::get('/yen/recharge/search', 'Admin\Yen\RechargeController@search');
	// 提现列表
	Route::get('/yen/withdraw', 'Admin\Yen\WithdrawController@index');
	Route::get('/yen/withdraw/search', 'Admin\Yen\WithdrawController@search');
	// 提现审核
	Route::get('/yen/withdraw/check/{status}', 'Admin\Yen\WithdrawController@check');
	// 打款完成操作
	Route::get('/yen/withdraw/transferdone', 'Admin\Yen\WithdrawController@transferDone');
	// 取消体系那
	Route::get('/yen/withdraw/cancel', 'Admin\Yen\WithdrawController@cancel');
	
	/**
	 * 数据统计对账
	 */
	// 人民币统计
	Route::get('/statistics/yuanstat', 'Admin\Statistics\YenstatController@index');
	Route::get('/statistics/yuanstat/search/{status}', 'Admin\Statistics\YenstatController@search');
	// 数字货币统计
	Route::get('/statistics/digitalstat', 'Admin\Statistics\DigitalstatController@index');
	Route::get('/statistics/digitalstat/search/{status}', 'Admin\Statistics\DigitalstatController@search');

	// 用户账户人民币
	Route::get('/statistics/yuancash', 'Admin\Statistics\YencashController@index');
	Route::get('/statistics/yuancash/search', 'Admin\Statistics\YencashController@search');
	// 用户账户数字货币
	Route::get('/statistics/digitalcash', 'Admin\Statistics\DigitalcashController@index');
	Route::get('/statistics/digitalcash/search', 'Admin\Statistics\DigitalcashController@search');

	/**
	 * 数字货币兑换
	 */
	// 兑换列表
	Route::get('/digitalcoin/transfer', 'Admin\Digitalcoin\DigitalTransferController@index');
	Route::get('/digitalcoin/transfer/search', 'Admin\Digitalcoin\DigitalTransferController@search');
	// 提币管理
	Route::get('/digitalcoin/withdraw', 'Admin\Digitalcoin\DigitalWithdrawController@index');
	Route::get('/digitalcoin/withdraw/search', 'Admin\Digitalcoin\DigitalWithdrawController@search');
	// 审核通过
	Route::get('/digitalcoin/withdraw/checkaccess', 'Admin\Digitalcoin\DigitalWithdrawController@checkAccess');
	// 打币完成
	Route::get('/digitalcoin/withdraw/transferdone', 'Admin\Digitalcoin\DigitalWithdrawController@transferBtcDone');
	// 取消
	Route::get('/digitalcoin/withdraw/cancel', 'Admin\Digitalcoin\DigitalWithdrawController@cancel');



	/**
	 * 账户权限管理
	 * @author      mozarlee
	 * @time        2017-07-11 13:57:53
	 * @created by  Sublime Text 3
	 */
	// 角色管理
	Route::get('/admin_roles', 'Admin\Account\AccountRolesController@index');
	// 编辑
	Route::get('/admin_roles_update', 'Admin\Account\AccountRolesController@update');
	Route::post('/admin_roles_update', 'Admin\Account\AccountRolesController@doUpdate');
	// 新增
	Route::get('/admin_roles_create', 'Admin\Account\AccountRolesController@create');
	Route::post('/admin_roles_create', 'Admin\Account\AccountRolesController@doCreate');
	// 启用角色
	Route::get('/admin_roles_enable', 'Admin\Account\AccountRolesController@enableRole');
	// 禁用角色
	Route::get('/admin_roles_disable', 'Admin\Account\AccountRolesController@disableRole');

	// 账号管理
	Route::get('/admin_account', 'Admin\Account\AccountController@index');
	// 编辑
	Route::get('/admin_account_update', 'Admin\Account\AccountController@update');
	Route::post('/admin_account_update', 'Admin\Account\AccountController@doUpdate');
	// 新增
	Route::get('/admin_account_create', 'Admin\Account\AccountController@create');
	Route::post('/admin_account_create', 'Admin\Account\AccountController@doCreate');
	// 启用
	Route::get('/admin_account_enable', 'Admin\Account\AccountController@enableRole');
	// 禁用
	Route::get('/admin_account_disable', 'Admin\Account\AccountController@disableRole');

});

// 自定义ueditor后端配置
Route::get('/upload', 'Upload\UploadImgController@mainGet');
Route::post('/upload', 'Upload\UploadImgController@mainPost');