<?php

use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Route;



// frontend
Route::get('/',[App\Http\Controllers\FrontendController::class,'index'])->name('index');
Route::get('product/details/{id}/{slug}',[App\Http\Controllers\FrontendController::class,'ProductDetails'])->name('product.details');
Route::get('vendor/details/{id}',[App\Http\Controllers\FrontendController::class,'VendorDetails'])->name('vendor.details');
Route::get('vendor/price/filter/{id}',[App\Http\Controllers\FrontendController::class,'VendorPriceFilter'])->name('vendor.price.filter');
Route::get('vendor/category/filter/{id}/{vendor_id}',[App\Http\Controllers\FrontendController::class,'VendorCategoryFilter'])->name('vendor.category.filter');
Route::get('vendor/shop/page',[App\Http\Controllers\FrontendController::class,'VendorShopPage'])->name('vendor.shop.page');
Route::get('vendor/search/all/page',[App\Http\Controllers\FrontendController::class,'VendorSearchAllPage'])->name('vendor.search.all.page');
// category products
Route::get('category/products/{id}',[App\Http\Controllers\FrontendController::class,'categoryProducts'])->name('category.products');
Route::get('category/price/filter/{id}',[App\Http\Controllers\FrontendController::class,'categoryPriceFilter'])->name('category.price.filter');
// subcategory product
Route::get('subcategory/products/{id}',[App\Http\Controllers\FrontendController::class,'subcategoryProducts'])->name('subcategory.products');
Route::get('subcategory/price/filter/{id}',[App\Http\Controllers\FrontendController::class,'subcategoryPriceFilter'])->name('subcategory.price.filter');
// all brand products
Route::get('brand/all/products/{id}',[App\Http\Controllers\FrontendController::class,'allBrandProduct'])->name('all.brand.product');
Route::get('brand/price/filter/{id}',[App\Http\Controllers\FrontendController::class,'brandPriceFilter'])->name('brand.price.filter');
// quick view load
Route::get('quick/view/load/{id}',[App\Http\Controllers\QuickViewController::class,'QuickLoad'])->name('quick.load');
// cart
Route::post('product/add/to/cart/{id}',[App\Http\Controllers\frontend\CartController::class,'addToCart']);
Route::get('product/add/to/mini/cart',[App\Http\Controllers\frontend\CartController::class,'addToMiniCart']);
Route::get('product/remove/mini/cart/{rowId}',[App\Http\Controllers\frontend\CartController::class,'removeMiniCart']);
// single add to cart
Route::post('single/addTo/cart',[App\Http\Controllers\frontend\CartController::class,'AddToCartSingle']);
// All Blog Post Routes
Route::get('blog/page',[App\Http\Controllers\FrontendController::class,'blogPage'])->name('blog.page');
Route::get('blog/details/{id}',[App\Http\Controllers\FrontendController::class,'blogDetails'])->name('blog.details');
Route::get('category_wise/blog/post/{id}',[App\Http\Controllers\FrontendController::class,'catWiseBlogPost'])->name('blog.post.cat');
// advance search
Route::post('product/search',[App\Http\Controllers\frontend\SearchController::class,'productSearch'])->name('product.search');
Route::post('product/search/suggestion',[App\Http\Controllers\frontend\SearchController::class,'productSearchSuggestion'])->name('product.search.suggestion');


Route::middleware(['auth','role:user'])->group(function () {
    // cart page
    Route::get('cart/page',[App\Http\Controllers\frontend\CartController::class,'cartPage'])->name('cart.page');
    Route::get('cart/page/load',[App\Http\Controllers\frontend\CartController::class,'cartPageLoad'])->name('cart.page.load');
    Route::get('cart/decrement/{rowId}',[App\Http\Controllers\frontend\CartController::class,'cartDecrement'])->name('cart.decrement');
    Route::get('cart/increment/{rowId}',[App\Http\Controllers\frontend\CartController::class,'cartIncrement'])->name('cart.increment');
    Route::get('cart/remove/{rowId}',[App\Http\Controllers\frontend\CartController::class,'cartRemove'])->name('cart.remove');
    // delivery charge and coupon apply
    Route::post('coupon/apply',[App\Http\Controllers\frontend\CartController::class,'couponApply'])->name('coupon.apply');
    Route::get('cart/district/select/{id}',[App\Http\Controllers\frontend\CartController::class,'cartDistrictSelect'])->name('cart.district.select');
    Route::get('cart/state/select/{id}',[App\Http\Controllers\frontend\CartController::class,'cartStateSelect'])->name('cart.state.select');
    Route::get('cart/charge/select/{id}',[App\Http\Controllers\frontend\CartController::class,'cartChargeSelect'])->name('cart.charge.select');
    // calculation
    Route::get('cart/page/cal',[App\Http\Controllers\frontend\CartController::class,'cartPageCal']);
    Route::get('remove/coupon',[App\Http\Controllers\frontend\CartController::class,'couponRemove']);
    //wishlist
    Route::post('addTo/Wishlist/{id}',[App\Http\Controllers\frontend\WishlistController::class,'addToWishlist']);
    Route::get('load/Wishlist',[App\Http\Controllers\frontend\WishlistController::class,'loadWishlist']);
    Route::get('remove/wishlist/product/{id}',[App\Http\Controllers\frontend\WishlistController::class,'removeProWish']);
    Route::get('Wishlist/page',[App\Http\Controllers\frontend\WishlistController::class,'WishlistPage'])->name('wishlist.page');
    // compare
    Route::get('compare/view',[App\Http\Controllers\frontend\CompareController::class,'compareView'])->name('compare.view');
    Route::get('compare/add/{id}',[App\Http\Controllers\frontend\CompareController::class,'compareAdd']);
    Route::get('compare/show',[App\Http\Controllers\frontend\CompareController::class,'compareShow']);
    Route::get('compare/remove/{id}',[App\Http\Controllers\frontend\CompareController::class,'compareRemove']);
    // checkout
    Route::get('checkout/page',[App\Http\Controllers\frontend\CheckoutController::class,'checkoutPage'])->name('checkout.page');
    // stripe payment
    Route::post('payment/gateway',[App\Http\Controllers\frontend\CheckoutController::class,'paymentGateway'])->name('payment.gateway');
    Route::post('stripe/store',[App\Http\Controllers\frontend\StripeController::class,'stripeStore'])->name('stripe.store');
    // cash on delivery
    Route::post('cash/store',[App\Http\Controllers\frontend\CashController::class,'cashStore'])->name('cash.store');
    // SSLCOMMERZ Start
    Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
    Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

    Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
    Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

    Route::post('/success', [SslCommerzPaymentController::class, 'success']);
    Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
    Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

    Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
    // SSLCOMMERZ END
    Route::get('user/dashboard',[App\Http\Controllers\user\UserController::class,'userDashboard'])->name('user.dashboard');
    Route::get('user/order',[App\Http\Controllers\user\UserController::class,'userOrder'])->name('user.order');
    Route::get('order/track',[App\Http\Controllers\user\UserController::class,'orderTrack'])->name('order.track');
    Route::get('user/address',[App\Http\Controllers\user\UserController::class,'userAddress'])->name('user.address');
    Route::get('user/account',[App\Http\Controllers\user\UserController::class,'userAccount'])->name('user.account');
    Route::post('user/account/store',[App\Http\Controllers\user\UserController::class,'userAccountStore'])->name('user.account.store');
    Route::get('user/change/password',[App\Http\Controllers\user\UserController::class,'userChangePassword'])->name('user.change.password');
    Route::post('store/change/password',[App\Http\Controllers\user\UserController::class,'storeChangePassword'])->name('store.change.password');
    // order details
    Route::get('user/order/details/{id}',[App\Http\Controllers\user\UserController::class,'userOrderDetails'])->name('user.order.details');
    // user invoice
    Route::get('user/invoice/{id}',[App\Http\Controllers\user\UserController::class,'userInvoice'])->name('user.invoice');
    // user return order
    Route::post('return/order/{id}',[App\Http\Controllers\user\UserController::class,'returnOrder'])->name('return.order');
    Route::get('user/all/return/order',[App\Http\Controllers\user\UserController::class,'userAllReturnOrder'])->name('user.all.return.order');
    // banner count
    Route::get('banner/count/{id}',[App\Http\Controllers\admin\BannerController::class,'bannerCount'])->name('banner.count');
    // rating and review
    Route::post('product/review',[App\Http\Controllers\user\ReviewController::class,'productReview'])->name('product.review');
    // order tracking
    Route::post('user/order/tracking',[App\Http\Controllers\user\UserController::class,'userOrderTracking'])->name('user.order.tracking');

});
Route::get('user/logout',[App\Http\Controllers\user\UserController::class,'userLogout'])->name('user.logout');

require __DIR__.'/auth.php';

Route::middleware(['auth','role:admin'])->group(function (){
    Route::get('admin/dashboard',[App\Http\Controllers\AdminController::class,'adminDashboard'])->name('admin.dashboard');
    Route::get('admin/logout',[App\Http\Controllers\AdminController::class,'adminLogout'])->name('admin.logout');
    //admin profile
    Route::get('admin/profile',[App\Http\Controllers\AdminController::class,'adminProfile'])->name('admin.profile');
    Route::post('admin/profile/update',[App\Http\Controllers\AdminController::class,'adminProfileUpdate'])->name('admin.profile.update');
    // admin change password
    Route::get('admin/change/password',[App\Http\Controllers\AdminController::class,'AdminChangePassword'])->name('admin.change.password');
    Route::post('admin/change/password/store',[App\Http\Controllers\AdminController::class,'AdminChangePasswordStore'])->name('admin.change.password.store');
    // brand crud setup
    Route::get('brand/view',[App\Http\Controllers\admin\BrandController::class,'brandView'])->name('brand.view');
    Route::post('brand/add',[App\Http\Controllers\admin\BrandController::class,'brandAdd'])->name('brand.add');
    Route::get('brand/edit/{id}',[App\Http\Controllers\admin\BrandController::class,'brandEdit'])->name('brand.edit');
    Route::post('brand/update/{id}',[App\Http\Controllers\admin\BrandController::class,'brandUpdate'])->name('brand.update');
    Route::get('brand/delete/{id}',[App\Http\Controllers\admin\BrandController::class,'brandDelete'])->name('brand.delete');
    // category crud
    Route::get('category/view',[App\Http\Controllers\admin\CategoryController::class,'categoryView'])->name('category.view');
    Route::post('category/store',[App\Http\Controllers\admin\CategoryController::class,'categoryStore'])->name('category.store');
    Route::get('category/edit/{id}',[App\Http\Controllers\admin\CategoryController::class,'categoryEdit'])->name('category.edit');
    Route::post('category/update/{id}',[App\Http\Controllers\admin\CategoryController::class,'categoryUpdate'])->name('category.update');
    Route::get('category/delete/{id}',[App\Http\Controllers\admin\CategoryController::class,'categoryDelete'])->name('category.delete');
    // sub-category
    Route::get('subCategory/view',[App\Http\Controllers\admin\CategoryController::class,'SubCategoryView'])->name('subcategory.view');
    Route::post('subCategory/store',[App\Http\Controllers\admin\CategoryController::class,'SubCategoryStore'])->name('subcategory.store');
    Route::get('subCategory/edit/{id}',[App\Http\Controllers\admin\CategoryController::class,'SubCategoryEdit'])->name('subcategory.edit');
    Route::post('subCategory/update/{id}',[App\Http\Controllers\admin\CategoryController::class,'SubCategoryUpdate'])->name('subcategory.update');
    Route::get('subCategory/delete/{id}',[App\Http\Controllers\admin\CategoryController::class,'SubCategoryDelete'])->name('subcategory.delete');
    // active vendor
    Route::get('vendor/inactive',[App\Http\Controllers\AdminController::class,'vendorInactive'])->name('vendor.inactive');
    Route::get('vendor/inactive/details/{id}',[App\Http\Controllers\AdminController::class,'vendorInactiveDetails'])->name('vendor.inactive.details');
    Route::get('vendor/status/active/{id}',[App\Http\Controllers\AdminController::class,'vendorStatusActive'])->name('vendor.status.active');
    // inactive vendor
    Route::get('vendor/active',[App\Http\Controllers\AdminController::class,'vendorActive'])->name('vendor.active');
    Route::get('vendor/active/details/{id}',[App\Http\Controllers\AdminController::class,'vendorActiveDetails'])->name('vendor.active.details');
    Route::get('vendor/status/inactive/{id}',[App\Http\Controllers\AdminController::class,'vendorStatusInactive'])->name('vendor.status.inactive');
    // product add view edit delete
    Route::get('all/product',[App\Http\Controllers\admin\ProductController::class,'allProduct'])->name('all.product');
    Route::get('add/new/product',[App\Http\Controllers\admin\ProductController::class,'addNewProduct'])->name('add.new.product');
    Route::get('select/subcategory/{category_id}',[App\Http\Controllers\admin\ProductController::class,'selectSubcategory'])->name('select.subcategory');
    Route::post('product/store',[App\Http\Controllers\admin\ProductController::class,'productStore'])->name('product.store');
    Route::get('product/inactive/{id}',[App\Http\Controllers\admin\ProductController::class,'productInactive'])->name('product.inactive');
    Route::get('product/active/{id}',[App\Http\Controllers\admin\ProductController::class,'productActive'])->name('product.active');
    //product edit with multi image
    Route::get('product/edit/{id}',[App\Http\Controllers\admin\ProductController::class,'productEdit'])->name('product.edit');
    Route::post('product/update/{id}',[App\Http\Controllers\admin\ProductController::class,'productUpdate'])->name('product.update');
    Route::get('product/delete/{id}',[App\Http\Controllers\admin\ProductController::class,'productDelete'])->name('product.delete');
    Route::post('multiImg/update',[App\Http\Controllers\admin\ProductController::class,'multiUpdate'])->name('multi.update');
    Route::get('multiImg/delete/{id}',[App\Http\Controllers\admin\ProductController::class,'multiImgDelete'])->name('multi.delete');
    // slider part
    Route::get('slider/view',[App\Http\Controllers\admin\SliderController::class,'sliderView'])->name('slider.view');
    Route::post('slider/store',[App\Http\Controllers\admin\SliderController::class,'sliderStore'])->name('slider.store');
    Route::get('slider/edit/{id}',[App\Http\Controllers\admin\SliderController::class,'sliderEdit'])->name('slider.edit');
    Route::post('slider/update/{id}',[App\Http\Controllers\admin\SliderController::class,'sliderUpdate'])->name('slider.update');
    Route::get('slider/delete/{id}',[App\Http\Controllers\admin\SliderController::class,'sliderDelete'])->name('slider.delete');
    // banner
    Route::get('banner/view',[App\Http\Controllers\admin\BannerController::class,'bannerView'])->name('banner.view');
    Route::post('banner/store',[App\Http\Controllers\admin\BannerController::class,'bannerStore'])->name('banner.store');
    Route::get('banner/edit/{id}',[App\Http\Controllers\admin\BannerController::class,'bannerEdit'])->name('banner.edit');
    Route::post('banner/update/{id}',[App\Http\Controllers\admin\BannerController::class,'bannerUpdate'])->name('banner.update');
    Route::get('banner/delete/{id}',[App\Http\Controllers\admin\BannerController::class,'bannerDelete'])->name('banner.delete');
    // coupon admin part
    Route::get('all/coupon',[App\Http\Controllers\admin\CouponController::class,'allCoupon'])->name('all.coupon');
    Route::get('add/coupon',[App\Http\Controllers\admin\CouponController::class,'addCoupon'])->name('add.coupon');
    Route::post('store/coupon',[App\Http\Controllers\admin\CouponController::class,'storeCoupon'])->name('store.coupon');
    Route::get('edit/coupon/{id}',[App\Http\Controllers\admin\CouponController::class,'editCoupon'])->name('edit.coupon');
    Route::post('update/coupon/{id}',[App\Http\Controllers\admin\CouponController::class,'updateCoupon'])->name('update.coupon');
    Route::get('delete/coupon/{id}',[App\Http\Controllers\admin\CouponController::class,'deleteCoupon'])->name('delete.coupon');
    // shipping division
    Route::get('division/view',[App\Http\Controllers\admin\ShippingController::class,'divisionView'])->name('division.view');
    Route::post('division/store',[App\Http\Controllers\admin\ShippingController::class,'divisionStore'])->name('division.store');
    Route::get('division/edit/{id}',[App\Http\Controllers\admin\ShippingController::class,'divisionEdit'])->name('division.edit');
    Route::post('division/update/{id}',[App\Http\Controllers\admin\ShippingController::class,'divisionUpdate'])->name('division.update');
    Route::get('division/delete/{id}',[App\Http\Controllers\admin\ShippingController::class,'divisionDelete'])->name('division.delete');
    // district
    Route::get('district/view',[App\Http\Controllers\admin\ShippingController::class,'districtView'])->name('district.view');
    Route::post('district/store',[App\Http\Controllers\admin\ShippingController::class,'districtStore'])->name('district.store');
    Route::get('district/edit/{id}',[App\Http\Controllers\admin\ShippingController::class,'districtEdit'])->name('district.edit');
    Route::post('district/update/{id}',[App\Http\Controllers\admin\ShippingController::class,'districtUpdate'])->name('district.update');
    Route::get('district/delete/{id}',[App\Http\Controllers\admin\ShippingController::class,'districtDelete'])->name('district.delete');
    // state
    Route::get('state/view',[App\Http\Controllers\admin\ShippingController::class,'stateView'])->name('state.view');
    Route::get('district/select/{id}',[App\Http\Controllers\admin\ShippingController::class,'districtSelect']);
    Route::get('edit/district/select/{id}',[App\Http\Controllers\admin\ShippingController::class,'districtSelectEdit']);
    Route::post('state/store',[App\Http\Controllers\admin\ShippingController::class,'stateStore'])->name('state.store');
    Route::get('state/edit/{id}',[App\Http\Controllers\admin\ShippingController::class,'stateEdit'])->name('state.edit');
    Route::post('state/update/{id}',[App\Http\Controllers\admin\ShippingController::class,'stateUpdate'])->name('state.update');
    Route::get('state/delete/{id}',[App\Http\Controllers\admin\ShippingController::class,'stateDelete'])->name('state.delete');
    // orders
    Route::get('pending/order',[App\Http\Controllers\admin\OrderController::class,'pendingOrder'])->name('pending.order');
    Route::get('pending/order/details/{id}',[App\Http\Controllers\admin\OrderController::class,'OrderDetails'])->name('order.details');
    Route::get('status/order/confirm/{id}',[App\Http\Controllers\admin\OrderController::class,'OrderConfirm'])->name('order.confirm');
    Route::get('status/order/processing/{id}',[App\Http\Controllers\admin\OrderController::class,'OrderProcessing'])->name('order.processing');
    Route::get('status/delivered/{id}',[App\Http\Controllers\admin\OrderController::class,'StatusDelivered'])->name('status.delivered');
    Route::get('all/confirm/order',[App\Http\Controllers\admin\OrderController::class,'allConfirmOrder'])->name('all.confirm.order');
    Route::get('all/processing/order',[App\Http\Controllers\admin\OrderController::class,'allProcessOrder'])->name('all.process.order');
    Route::get('all/delivered/order',[App\Http\Controllers\admin\OrderController::class,'allDeliveredOrder'])->name('all.delivered.order');
    // product details admin
    Route::get('single/product/details/{id}',[App\Http\Controllers\admin\ProductController::class,'singleProductDetails'])->name('single.product.details');
    Route::get('admin/order/invoice/{id}',[App\Http\Controllers\admin\OrderController::class,'adminOrderInvoice'])->name('admin.order.invoice');
    // return order
    Route::get('all/return/order',[App\Http\Controllers\admin\OrderController::class,'allReturnOrder'])->name('all.return.order');
    Route::get('approve/return/order/{id}',[App\Http\Controllers\admin\OrderController::class,'approveReturnOrder'])->name('approve.return.order');
    Route::get('all/approve/return/order',[App\Http\Controllers\admin\OrderController::class,'allApproveReturnOrder'])->name('all.approve.return.order');
    // all reports
    Route::get('all/reports',[App\Http\Controllers\admin\ReportController::class,'allReports'])->name('all.reports');
    Route::post('date/reports',[App\Http\Controllers\admin\ReportController::class,'dateReports'])->name('date.reports');
    Route::post('month/reports',[App\Http\Controllers\admin\ReportController::class,'monthReports'])->name('month.reports');
    Route::post('year/reports',[App\Http\Controllers\admin\ReportController::class,'yearReports'])->name('year.reports');
    // user report
    Route::get('show/user/reports',[App\Http\Controllers\admin\ReportController::class,'userReportsShow'])->name('user.reports.show');
    Route::post('store/user/reports',[App\Http\Controllers\admin\ReportController::class,'userReportsStore'])->name('user.reports.store');
    // active inactive user or vendor
    Route::get('active/user/show',[App\Http\Controllers\admin\ActiveUserController::class,'activeUser'])->name('active.user');
    Route::get('active/user/edit/{id}',[App\Http\Controllers\admin\ActiveUserController::class,'activeUserEdit'])->name('active.user.edit');
    Route::post('active/user/update/{id}',[App\Http\Controllers\admin\ActiveUserController::class,'activeUserUpdate'])->name('active.user.update');
    Route::get('active/user/delete/{id}',[App\Http\Controllers\admin\ActiveUserController::class,'activeUserDelete'])->name('active.user.delete');
    // active inactive user or vendor
    Route::get('active/vendor/view',[App\Http\Controllers\admin\ActiveUserController::class,'activeVendor'])->name('active.vendor');
    Route::get('active/vendor/edit/{id}',[App\Http\Controllers\admin\ActiveUserController::class,'activeVendorEdit'])->name('active.vendor.edit');
    Route::post('active/vendor/update/{id}',[App\Http\Controllers\admin\ActiveUserController::class,'activeVendorUpdate'])->name('active.vendor.update');
    Route::get('active/vendor/delete/{id}',[App\Http\Controllers\admin\ActiveUserController::class,'activeVendorDelete'])->name('active.vendor.delete');
    // all blog category routes
    Route::get('blog/category',[App\Http\Controllers\admin\BlogController::class,'blogCategory'])->name('blog.category');
    Route::post('blog/category/store',[App\Http\Controllers\admin\BlogController::class,'blogCategoryStore'])->name('blog.category.store');
    Route::get('blog/category/edit/{id}',[App\Http\Controllers\admin\BlogController::class,'blogCategoryEdit'])->name('blog.category.edit');
    Route::post('blog/category/update/{id}',[App\Http\Controllers\admin\BlogController::class,'blogCategoryUpdate'])->name('blog.category.update');
    Route::get('blog/category/delete/{id}',[App\Http\Controllers\admin\BlogController::class,'blogCategoryDelete'])->name('blog.category.delete');
    // all blog post routes
    Route::get('blog/post/add',[App\Http\Controllers\admin\BlogController::class,'addBlogPost'])->name('add.blog.post');
    Route::post('blog/post/store',[App\Http\Controllers\admin\BlogController::class,'storeBlogPost'])->name('store.blog.post');
    Route::get('blog/post',[App\Http\Controllers\admin\BlogController::class,'blogPost'])->name('blog.post');
    Route::get('blog/post/edit/{id}',[App\Http\Controllers\admin\BlogController::class,'blogPostEdit'])->name('blog.post.edit');
    Route::post('blog/post/update/{id}',[App\Http\Controllers\admin\BlogController::class,'blogPostUpdate'])->name('blog.post.update');
    Route::get('blog/post/delete/{id}',[App\Http\Controllers\admin\BlogController::class,'blogPostDelete'])->name('blog.post.delete');
    // admin review
    Route::get('all/review',[App\Http\Controllers\user\ReviewController::class,'allReview'])->name('all.review');
    Route::get('review/active/{id}',[App\Http\Controllers\user\ReviewController::class,'reviewActive'])->name('active.review');
    Route::get('review/Inactive/{id}',[App\Http\Controllers\user\ReviewController::class,'reviewInactive'])->name('inactive.review');
    Route::get('review/edit/{id}',[App\Http\Controllers\user\ReviewController::class,'reviewEdit'])->name('review.edit');
    Route::post('review/update/{id}',[App\Http\Controllers\user\ReviewController::class,'reviewUpdate'])->name('review.update');
    // setting
    Route::get('site/setting',[App\Http\Controllers\admin\SettingController::class,'siteSetting'])->name('site.setting');
    Route::post('site/setting/store',[App\Http\Controllers\admin\SettingController::class,'siteSettingStore'])->name('site.setting.store');
    Route::get('seo/setting',[App\Http\Controllers\admin\SettingController::class,'seoSetting'])->name('seo.setting');
    Route::post('seo/setting/store',[App\Http\Controllers\admin\SettingController::class,'seoSettingStore'])->name('seo.setting.store');
    // stock
    Route::get('product/stock',[App\Http\Controllers\admin\ProductController::class,'productStock'])->name('product.stock');
    // roles and permission
    Route::get('all/permission',[App\Http\Controllers\admin\RoleController::class,'allPermission'])->name('all.permission');
    Route::post('store/permission',[App\Http\Controllers\admin\RoleController::class,'storePermission'])->name('store.permission');
    Route::get('edit/permission/{id}',[App\Http\Controllers\admin\RoleController::class,'editPermission'])->name('edit.permission');
    Route::post('update/permission/{id}',[App\Http\Controllers\admin\RoleController::class,'updatePermission'])->name('update.permission');
    Route::get('delete/permission/{id}',[App\Http\Controllers\admin\RoleController::class,'deletePermission'])->name('delete.permission');

    Route::get('view/roles',[App\Http\Controllers\admin\RoleController::class,'viewRoles'])->name('view.roles');
    Route::get('add/roles',[App\Http\Controllers\admin\RoleController::class,'addRoles'])->name('add.roles');
    Route::post('store/roles',[App\Http\Controllers\admin\RoleController::class,'storeRoles'])->name('store.roles');
    Route::get('edit/roles/{id}',[App\Http\Controllers\admin\RoleController::class,'editRoles'])->name('edit.roles');
    Route::post('update/roles/{id}',[App\Http\Controllers\admin\RoleController::class,'updateRoles'])->name('update.roles');
    Route::get('delete/roles/{id}',[App\Http\Controllers\admin\RoleController::class,'deleteRoles'])->name('delete.roles');
    // roles in permission
    Route::get('add/roles/permission',[App\Http\Controllers\admin\RoleController::class,'rolesPermissionAdd'])->name('roles.permission');
    Route::post('roles/permission/store',[App\Http\Controllers\admin\RoleController::class,'rolesPermissionStore'])->name('roles.permission.store');
    // role permission edit and delete
    Route::get('role/permission/view',[App\Http\Controllers\Admin\RoleController::class,'rolesPermissionView'])->name('role.permission.view');
});

Route::get('admin/login',[App\Http\Controllers\AdminController::class,'adminLogin'])->name('admin.login')->middleware(RedirectIfAuthenticated::class);

Route::middleware(['auth','role:vendor'])->group(function (){
    Route::get('vendor/dashboard',[App\Http\Controllers\VendorController::class,'vendorDashboard'])->name('vendor.dashboard');
    Route::get('vendor/logout',[App\Http\Controllers\VendorController::class,'vendorLogout'])->name('vendor.logout');
    // vendor profile
    Route::get('vendor/profile',[App\Http\Controllers\VendorController::class,'vendorProfile'])->name('vendor.profile');
    Route::post('vendor/profile/update',[App\Http\Controllers\VendorController::class,'vendorProfileUpdate'])->name('vendor.profile.update');
    // vendor change password
    Route::get('vendor/change/password',[App\Http\Controllers\VendorController::class,'vendorChangePassword'])->name('vendor.change.password');
    Route::post('vendor/change/password/update',[App\Http\Controllers\VendorController::class,'vendorChangePasswordUpdate'])->name('vendor.change.password.update');
    // vendor all product
    Route::get('vendor/all/products',[App\Http\Controllers\vendor\VendorProductController::class,'vendorAllProduct'])->name('vendor.all.product');
    Route::get('vendor/add/products',[App\Http\Controllers\vendor\VendorProductController::class,'vendorAddProduct'])->name('vendor.add.product');
    Route::post('vendor/store/products',[App\Http\Controllers\vendor\VendorProductController::class,'vendorStoreProduct'])->name('vendor.store.product');
    Route::get('select/vendor/subcategory/{category_id}',[App\Http\Controllers\vendor\VendorProductController::class,'vendorSubCategory'])->name('vendor.subcategory');
    // vendor product active inactive
    Route::get('vendor/product/inactive/{id}',[App\Http\Controllers\vendor\VendorProductController::class,'vendorProductInactive'])->name('vendor.product.inactive');
    Route::get('vendor/product/active/{id}',[App\Http\Controllers\vendor\VendorProductController::class,'vendorProductActive'])->name('vendor.product.active');
    // vendor product edit
    Route::get('vendor/product/edit/{id}',[App\Http\Controllers\vendor\VendorProductController::class,'vendorProEdit'])->name('vendor.pro.edit');
    Route::post('vendor/product/update/{id}',[App\Http\Controllers\vendor\VendorProductController::class,'vendorProUpdate'])->name('vendor.pro.update');
    Route::post('vendor/multiImg/update',[App\Http\Controllers\vendor\VendorProductController::class,'vendorMultiUpdate'])->name('vendor.multi.update');
    Route::get('vendor/multiImg/delete/{id}',[App\Http\Controllers\vendor\VendorProductController::class,'vendorMultiDelete'])->name('vendor.multi.delete');
    // vendor product delete
    Route::get('vendor/product/delete/{id}',[App\Http\Controllers\vendor\VendorProductController::class,'vendorProductDelete'])->name('vendor.pro.delete');
    // orders
    Route::get('vendor/order',[App\Http\Controllers\vendor\OrderController::class,'vendorPendingOrder'])->name('vendor.pending.order');
    Route::get('vendor/order/details/{id}',[App\Http\Controllers\vendor\OrderController::class,'vendorOrderDetails'])->name('vendor.order.details');
    // vendor return order
    Route::get('vendor/return/order',[App\Http\Controllers\vendor\OrderController::class,'vendorReturnOrder'])->name('vendor.return.order');
    Route::get('vendor/approve/return/order',[App\Http\Controllers\vendor\OrderController::class,'vendorApproveReturnOrder'])->name('vendor.approve.return.order');
    // vendor product details
    Route::get('vendor/product/details/{id}',[App\Http\Controllers\vendor\VendorProductController::class,'vendorProductDetails'])->name('vendor.product.details');
    // vendor review
    Route::get('vendor/review',[App\Http\Controllers\user\ReviewController::class,'vendorReview'])->name('vendor.review');

});
Route::get('vendor/login',[App\Http\Controllers\VendorController::class,'vendorLogin'])->name('vendor.login')->middleware(RedirectIfAuthenticated::class);
Route::get('vendor/register',[App\Http\Controllers\VendorController::class,'vendorRegister'])->name('vendor.register');
Route::post('vendor/register/store',[App\Http\Controllers\VendorController::class,'vendorRegisterStore'])->name('vendor.register.store');
