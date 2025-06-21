<?php

use App\Controller\UserController;
include("App/controller/UserController.php");
include("App/Config.php");
if (isset($_GET["logout"])) {
  UserController::logout();
  header(header: "Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="assets/css/vendors/all.min.css">
  <link rel="stylesheet" href="assets/css/vendors/bootstrap.rtl.min.css">
  <link rel="stylesheet" href="assets/css/vendors/owl.carousel.min.css">
  <link rel="stylesheet" href="assets/css/vendors/owl.theme.default.min.css">
  <link rel="stylesheet" href="assets/css/main.min.css">
</head>

<body>
  <!-- Header Content Start -->
  <div>
    <div class="header-container fixed-top border-bottom">
      <header>
        <div class="section-container d-flex justify-content-between">
          <div class="header__email d-flex gap-2 align-items-center">
            <i class="fa-regular fa-envelope"></i>
            coding.arabic@gmail.com
          </div>
          <div class="header__info d-none d-lg-block">
            شحن مجاني للطلبات 💥 عند الشراء ب 699ج او اكثر
          </div>
          <div class="header__branches d-flex gap-2 align-items-center">
            <a class="text-white text-decoration-none" href="branches.php">
              <i class="fa-solid fa-location-dot"></i>
              فروعنا
            </a>
          </div>
        </div>
      </header>
      <!--    -->
      <nav class="nav">
        <div class="section-container w-100 d-flex align-items-center gap-4 h-100">
          <div class="nav__categories-btn align-items-center justify-content-center rounded-1 d-none d-lg-flex">
            <button class="border-0 bg-transparent" data-bs-toggle="offcanvas" data-bs-target="#nav__categories">
              <i class="fa-solid fa-align-center fa-rotate-180"></i>
            </button>
          </div>
          <div class="nav__logo">
            <a href="index.php">
              <img class="h-100" src="assets/images/logo.png" alt="">
            </a>
          </div>
          <div class="nav__search w-100">
            <input class="nav__search-input w-100" type="search" placeholder="أبحث هنا عن اي شئ تريده...">
            <span class="nav__search-icon">
              <i class="fa-solid fa-magnifying-glass"></i>
            </span>
          </div>
          <ul class="nav__links gap-3 list-unstyled d-none d-lg-flex m-0">
            <?php
            $user = UserController::isLogIn($db);
            if ($user) {
              ?>
              <li class="nav__link nav__link-user">
                <a class="d-flex align-items-center gap-2">
                  حسابي
                  <i class="fa-regular fa-user"></i>
                  <i class="fa-solid fa-chevron-down fa-2xs"></i>
                </a>
                <ul class="nav__user-list position-absolute p-0 list-unstyled bg-white">
                  <li class="nav__link nav__user-link"><a href="profile.php">لوحة التحكم</a></li>
                  <li class="nav__link nav__user-link"><a href="orders.php">الطلبات</a></li>
                  <li class="nav__link nav__user-link"><a href="account_details.php">تفاصيل الحساب</a></li>
                  <li class="nav__link nav__user-link"><a href="favourites.php">المفضلة</a></li>
                  <li class="nav__link nav__user-link"><a href="?logout">تسجيل الخروج</a></li>
                </ul>
              </li>
              <li class="nav__link">
                <a class="d-flex align-items-center gap-2" href="favourites.php">
                  المفضلة
                  <div class="position-relative">
                    <i class="fa-regular fa-heart"></i>
                    <div class="nav__link-floating-icon">
                      0
                    </div>
                  </div>
                </a>
              </li>
              <li class="nav__link">
                <a class="d-flex align-items-center gap-2" data-bs-toggle="offcanvas" data-bs-target="#nav__cart">
                  عربة التسوق
                  <div class="position-relative">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <div class="nav__link-floating-icon">
                      0
                    </div>
                  </div>
                </a>
              </li>
              <?php
            } else {
              ?>
              <li class="nav__link">
                <a class="d-flex align-items-center gap-2" href="account.php">
                  تسجيل الدخول
                  <i class="fa-regular fa-user"></i>
                </a>
              </li>
            <?php } ?>

          </ul>
        </div>
        <div class="nav-mobile fixed-bottom d-block d-lg-none">
          <ul class="nav-mobile__list d-flex justify-content-around gap-2 list-unstyled  m-0 border-top">
            <li class="nav-mobile__link">
              <a class="d-flex align-items-center flex-column gap-1 text-decoration-none" href="index.php">
                <i class="fa-solid fa-house"></i>
                الرئيسية
              </a>
            </li>
            <li class="nav-mobile__link d-flex align-items-center flex-column gap-1" data-bs-toggle="offcanvas"
              data-bs-target="#nav__categories">
              <i class="fa-solid fa-align-center fa-rotate-180"></i>
              الاقسام
            </li>
            <li class="nav-mobile__link d-flex align-items-center flex-column gap-1">
              <a class="d-flex align-items-center flex-column gap-1 text-decoration-none" href="profile.php">
                <i class="fa-regular fa-user"></i>
                حسابي
              </a>
            </li>
            <li class="nav-mobile__link d-flex align-items-center flex-column gap-1">
              <a class="d-flex align-items-center flex-column gap-1 text-decoration-none" href="favourites.php">
                <i class="fa-regular fa-heart"></i>
                المفضلة
              </a>
            </li>
            <li class="nav-mobile__link d-flex align-items-center flex-column gap-1" data-bs-toggle="offcanvas"
              data-bs-target="#nav__cart">
              <i class="fa-solid fa-cart-shopping"></i>
              السلة
            </li>
          </ul>
          <!--  -->
        </div>
      </nav>

      <div class="nav__categories offcanvas offcanvas-start px-4 py-2" tabindex="-1" id="nav__categories"
        aria-labelledby="nav__categories">
        <div class="nav__categories-header offcanvas-header justify-content-end">
          <button type="button" class="border-0 bg-transparent text-danger nav__close" data-bs-dismiss="offcanvas"
            aria-label="Close">
            <i class="fa-solid fa-x fa-1x fw-light"></i>
          </button>
        </div>
        <div class="nav__categories-body offcanvas-body pt-0">
          <div class="nav__side-logo mb-2">
            <img class="w-100" src="assets/images/logo.png" alt="">
          </div>
          <ul class="nav__list list-unstyled">
            <li class="nav__link nav__side-link"><a href="shop.php" class="py-3">جميع المنتجات</a></li>
            <li class="nav__link nav__side-link"><a href="shop.php" class="py-3">كتب عربيه</a></li>
            <li class="nav__link nav__side-link"><a href="shop.php" class="py-3">كتب انجليزية</a></li>
          </ul>
        </div>
      </div>

      <div class="nav__cart offcanvas offcanvas-end px-3 py-2" tabindex="-1" id="nav__cart" aria-labelledby="nav__cart">
        <div class="nav__categories-header offcanvas-header align-items-center">
          <h5>سلة التسوق</h5>
          <button type="button" class="border-0 bg-transparent text-danger nav__close" data-bs-dismiss="offcanvas"
            aria-label="Close">
            <i class="fa-solid fa-x fa-1x fw-light"></i>
          </button>
        </div>
        <div class="nav__categories-body offcanvas-body pt-4">
          <p>لا توجد منتجات في سلة المشتريات.</p>
          <div class="cart-products">
            <ul class="nav__list list-unstyled">
              <li class="cart-products__item d-flex justify-content-between gap-2">
                <div class="d-flex gap-2">
                  <div>
                    <button class="cart-products__remove">x</button>
                  </div>
                  <div>
                    <p class="cart-products__name m-0 fw-bolder">Flutter Apprentice</p>
                    <p class="cart-products__price m-0">1 x 350.00 جنيه</p>
                  </div>
                </div>
                <div class="cart-products__img">
                  <img class="w-100" src="assets/images/product-1.webp" alt="">
                </div>
              </li>
            </ul>
            <div class="d-flex justify-content-between">
              <p class="fw-bolder">المجموع:</p>
              <p>350.00 جنيه</p>
            </div>
          </div>
          <button class="nav__cart-btn text-center text-white w-100 border-0 mb-3 py-2 px-3 bg-success">اتمام
            الطلب</button>
          <button class="nav__cart-btn text-center w-100 py-2 px-3 bg-transparent">تابع التسوق</button>
        </div>
      </div>
    </div>

    <!-- Account Modal Start -->
    <div class="account__modal modal" id="account__modal" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <button type="button"
            class="btn-close position-absolute top-0 start-0 modal__close-btn d-flex justify-content-center align-items-center opacity-100 rounded-circle bg-white"
            data-bs-dismiss="modal">
            <i class="fa-regular fa-circle-xmark"></i>
          </button>
          <div class="modal-body h-100 p-0 d-flex">
            <div class="px-5 pt-5 account__modal-forms">
              <div class="account account--login w-100 mb-5">
                <div class="account__tabs w-100 d-flex mb-3">
                  <div class="account__tab account__tab--login text-center fs-6 py-3 w-50">تسجيل الدخول</div>
                  <div class="account__tab account__tab--register text-center fs-6 py-3 w-50">حساب جديد</div>
                </div>
                <div class="account__login w-100">
                  <form class="mb-5">
                    <div class="input-group rounded-1 mb-3">
                      <input type="text" class="form-control p-3" placeholder="البريد الالكتروني" aria-label="email"
                        aria-describedby="basic-addon1">
                      <span class="input-group-text login__input-icon" id="basic-addon1">
                        <i class="fa-solid fa-envelope"></i>
                      </span>
                    </div>
                    <div class="input-group rounded-1 mb-3">
                      <input type="password" class="form-control p-3" placeholder="كلمة السر" aria-label="password"
                        aria-describedby="basic-addon1">
                      <span class="input-group-text login__input-icon" id="basic-addon1">
                        <i class="fa-solid fa-key"></i>
                      </span>
                    </div>
                    <div class="login__bottom d-flex justify-content-between mb-3">
                      <a class="login__forget-btn" href="">نسيت كلمة المرور؟</a>
                      <div>
                        <input type="checkbox">
                        <label for="">تذكرني</label>
                      </div>
                    </div>
                    <button class="text-center fs-6 py-2 w-100 bg-black text-white border-0 rounded-1">تسجيل
                      الدخول</button>
                  </form>
                  <div class="account__external">
                    <div class="account__external-header position-relative">
                      <div
                        class="account__external-text bg-white px-3 fs-6 fw-bolder position-absolute top-50 start-50 translate-middle">
                        او سجل الدخول باستخدام
                      </div>
                    </div>
                    <div class="d-flex justify-content-center flex-wrap gap-2 mt-5">
                      <div class="account__external-google bg-danger px-4 py-2 text-white">
                        Google
                        <i class="fa-brands fa-google"></i>
                      </div>
                      <div class="account__external-facebook px-4 py-2 text-white">
                        Facebook
                        <i class="fa-brands fa-square-facebook"></i>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="account__register w-100">
                  <form class="mb-5">
                    <div class="input-group rounded-1 mb-3">
                      <input type="text" class="form-control p-3" placeholder="الاسم كامل" aria-label="Username"
                        aria-describedby="basic-addon1">
                      <span class="input-group-text login__input-icon" id="basic-addon1">
                        <i class="fa-solid fa-user"></i>
                      </span>
                    </div>
                    <div class="input-group rounded-1 mb-3">
                      <input type="text" class="form-control p-3" placeholder="البريد الالكتروني" aria-label="email"
                        aria-describedby="basic-addon1">
                      <span class="input-group-text login__input-icon" id="basic-addon1">
                        <i class="fa-solid fa-envelope"></i>
                      </span>
                    </div>
                    <div class="input-group rounded-1 mb-3">
                      <input type="password" class="form-control p-3" placeholder="كلمة السر" aria-label="password"
                        aria-describedby="basic-addon1">
                      <span class="input-group-text login__input-icon" id="basic-addon1">
                        <i class="fa-solid fa-key"></i>
                      </span>
                    </div>

                    <button class="text-center fs-6 py-2 w-100 bg-black text-white border-0 rounded-1">حساب
                      جديد</button>
                  </form>

                  <div class="account__external">
                    <div class="account__external-header position-relative">
                      <div
                        class="account__external-text bg-white px-3 fs-5 fw-bolder position-absolute top-50 start-50 translate-middle">
                        او سجل باستخدام
                      </div>
                    </div>
                    <div class="d-flex justify-content-center flex-wrap gap-2 mt-5">
                      <div class="account__external-google bg-danger px-4 py-2 text-white">
                        Google
                        <i class="fa-brands fa-google"></i>
                      </div>
                      <div class="account__external-facebook px-4 py-2 text-white">
                        Facebook
                        <i class="fa-brands fa-square-facebook"></i>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="account__forget">
                  <p>فقدت كلمة المرور الخاصة بك؟ الرجاء إدخال عنوان البريد الإلكتروني الخاص بك. ستتلقى رابطا لإنشاء كلمة
                    مرور جديدة عبر البريد الإلكتروني.</p>
                  <form action="">
                    <div class="input-group rounded-1 mb-3">
                      <input type="text" class="form-control p-3" placeholder="البريد الالكتروني" aria-label="Username"
                        aria-describedby="basic-addon1">
                      <span class="input-group-text login__input-icon" id="basic-addon1">
                        <i class="fa-solid fa-envelope"></i>
                      </span>
                    </div>
                    <button class="text-center fs-6 py-2 w-100 bg-black text-white border-0 rounded-1">اعادة تعيين كلمة
                      المرور</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Account Modal End -->

    <!-- News Content Start -->
    <section class="sales text-center p-2 d-block d-lg-none">
      شحن مجاني للطلبات 💥 عند الشراء ب 699ج او اكثر
    </section>
    <!-- News Content End -->
  </div>
  <!-- Header Content End -->


  <main>
    <section class="page-top d-flex justify-content-center align-items-center flex-column text-center ">
      <div class="page-top__overlay"></div>
      <div class="position-relative">
        <div class="page-top__title mb-3">
          <h2>حسابي</h2>
        </div>
        <div class="page-top__breadcrumb">
          <a class="text-gray" href="index.php">الرئيسية</a> /
          <span class="text-gray">حسابي</span>
        </div>
      </div>
    </section>

    <section class="section-container profile my-3 my-md-5 py-5 d-md-flex gap-5">
      <div class="profile__right">
        <div class="profile__user mb-3 d-flex gap-3 align-items-center">
          <div class="profile__user-img rounded-circle overflow-hidden">
            <img class="w-100" src="assets/images/user.png" alt="">
          </div>
          <div class="profile__user-name">moamenyt</div>
        </div>
        <ul class="profile__tabs list-unstyled ps-3">
          <li class="profile__tab">
            <a class="py-2 px-3 text-black text-decoration-none" href="profile.php">لوحة التحكم</a>
          </li>
          <li class="profile__tab active">
            <a class="py-2 px-3 text-black text-decoration-none" href="orders.php">الطلبات</a>
          </li>
          <li class="profile__tab">
            <a class="py-2 px-3 text-black text-decoration-none" href="account_details.php">تفاصيل الحساب</a>
          </li>
          <li class="profile__tab">
            <a class="py-2 px-3 text-black text-decoration-none" href="favourites.php">المفضلة</a>
          </li>
          <li class="profile__tab">
            <a class="py-2 px-3 text-black text-decoration-none" href="?logout">تسجيل الخروج</a>
          </li>
        </ul>
      </div>
      <div class="profile__left mt-4 mt-md-0 w-100">
        <div class="profile__tab-content orders active">
          <div class="orders__none d-flex justify-content-between align-items-center py-3 px-4">
            <p class="m-0">لم يتم تنفيذ اي طلب بعد.</p>
            <button class="primary-button">تصفح المنتجات</button>
          </div>

          <table class="orders__table w-100">
            <thead>
              <th class="d-none d-md-table-cell">الطلب</th>
              <th class="d-none d-md-table-cell">التاريخ</th>
              <th class="d-none d-md-table-cell">الحالة</th>
              <th class="d-none d-md-table-cell">الاجمالي</th>
              <th class="d-none d-md-table-cell">اجراءات</th>
            </thead>
            <tbody>
              <tr class="order__item">
                <td class="d-flex justify-content-between d-md-table-cell">
                  <div class="fw-bolder d-md-none">الطلب:</div>
                  <div><a href="">#79574</a></div>
                </td>
                <td class="d-flex justify-content-between d-md-table-cell">
                  <div class="fw-bolder d-md-none">التاريخ:</div>
                  <div>يوليو 25, 2023</div>
                </td>
                <td class="d-flex justify-content-between d-md-table-cell">
                  <div class="fw-bolder d-md-none">الحالة:</div>
                  <div>قيد التنفيذ</div>
                </td>
                <td class="d-flex justify-content-between d-md-table-cell">
                  <div class="fw-bolder d-md-none">الاجمالي:</div>
                  <div>239.0 جنيه لعنصر واحد</div>
                </td>
                <td class="d-flex justify-content-between d-md-table-cell">
                  <div class="fw-bolder d-md-none">اجراءات:</div>
                  <div><a class="primary-button" href="">عرض</a></div>
                </td>
              </tr>
              <tr class="order__item">
                <td class="d-flex justify-content-between d-md-table-cell">
                  <div class="d-md-none">الطلب:</div>
                  <div><a href="">#79574</a></div>
                </td>
                <td class="d-flex justify-content-between d-md-table-cell">
                  <div class="d-md-none">التاريخ:</div>
                  <div>يوليو 25, 2023</div>
                </td>
                <td class="d-flex justify-content-between d-md-table-cell">
                  <div class="d-md-none">الحالة:</div>
                  <div>قيد التنفيذ</div>
                </td>
                <td class="d-flex justify-content-between d-md-table-cell">
                  <div class="d-md-none">الاجمالي:</div>
                  <div>239.0 جنيه لعنصر واحد</div>
                </td>
                <td class="d-flex justify-content-between d-md-table-cell">
                  <div class="d-md-none">اجراءات:</div>
                  <div><a class="primary-button" href="">عرض</a></div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <!-- <section class="section-container">
          <p>تم تقديم الطلب #79917 في يوليو 26, 2023 وهو الآن بحالة قيد التنفيذ.</p>
    
          <section>
            <h2>تفاصيل الطلب</h2>
            <table class="success__table w-100 mb-5">
              <thead>
                <tr class="border-0 bg-main text-white">
                  <th>المنتج</th>
                  <th class="d-none d-md-table-cell">الإجمالي</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <div>
                      <a href="">كوتش فلات ديزارت -رجالى - الابيض, 42</a> x 1
                    </div>
                    <div>
                      <span class="fw-bold">اللون:</span>
                      <span>لابيض</span>
                    </div>
                    <div>
                      <span class="fw-bold">المقاس:</span>
                      <span>42</span>
                    </div>
                  </td>
                  <td>
                    200.00 جنيه
                  </td>
                </tr>
                <tr>
                  <td>
                    <div>
                      <a href="">كوتش كاجوال -رجالى - بنى, 43</a> x 1
                    </div>
                    <div>
                      <span class="fw-bold">اللون:</span>
                      <span>بني</span>
                    </div>
                    <div>
                      <span class="fw-bold">المقاس:</span>
                      <span>43</span>
                    </div>
                  </td>
                  <td>
                    150.00 جنيه
                  </td>
                </tr>
                <tr>
                  <th>المجموع:</th>
                  <td class="fw-bolder">350.00 جنيه</td>
                </tr>
                <tr>
                  <th>الشحن:</th>
                  <td class="d-flex gap-2 align-items-center"><span class="fw-bolder">39.00 جنيه </span><p class="fa-xs m-0">بواسطة موف ات القاهرة والجيزة</p></td>
                </tr>
                <tr>
                  <th>وسيلة الدفع:</th>
                  <td class="fw-bold">الدفع نقدًا عند الاستلام</td>
                </tr>
                <tr>
                  <th>الإجمالي:</th>
                  <td class="fw-bold">389.00 جنيه </td>
                </tr>
              </tbody>
            </table>
          </section>
          <section class="mb-5">
            <h2>عنوان الفاتورة</h2>
            <div class="border p-3 rounded-3">
              <p class="mb-1">محمد محسن</p>
              <p class="mb-1">43 الاتحاد</p>
              <p class="mb-1">القاهرة</p>
              <p class="mb-1">01020288964</p>
              <p class="mb-1">moamenyt@gmail.com</p>
            </div>
          </section>
        </section> -->
      </div>
    </section>
  </main>

  <!-- Footer Section Start -->
  <footer class="footer text-white">
    <div class="footer__upper">
      <div class="section-container row">
        <div class="col-md-6 col-lg-3 mb-5 mb-lg-0">
          <div class="footer__logo">
            <img class="w-100" src="assets/images/logo.png" alt="">
          </div>
          <p class="my-3 text-gray">شركتنا هي أكبر شركة متخصصة لبيع الاحذية أونلاين وتوصيلها حتي المنزل.</p>
          <div class="footer__social d-flex gap-3">
            <a href=""><i class="fa-brands fa-facebook fa-2x text-white"></i></a>
            <a href=""><i class="fa-brands fa-instagram fa-2x text-white"></i></a>
            <a href=""><i class="fa-brands fa-tiktok fa-2x text-white"></i></a>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 px-md-4 mb-5 mb-lg-0">
          <div class="footer__list-title fw-bolder mb-1">
            عن Coding arabic
          </div>
          <div class="footer__list list-unstyled p-0">
            <li><a class="footer__link text-decoration-none d-inline-block text-gray py-1" href="about.php">من نحن</a>
            </li>
            <li><a class="footer__link text-decoration-none d-inline-block text-gray py-1" href="contact.php">تواصل
                معنا</a></li>
            <li><a class="footer__link text-decoration-none d-inline-block text-gray py-1"
                href="privacy-policy.php">سياسة الخصوصية</a></li>
            <li><a class="footer__link text-decoration-none d-inline-block text-gray py-1"
                href="refund-policy.php">سياسة الاستبدال و
                الاسترجاع</a></li>
            <li><a class="footer__link text-decoration-none d-inline-block text-gray py-1" href="track-order.php">تتبع
                طلبك</a></li>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 px-md-4 mb-5 mb-lg-0">
          <div class="footer__list-title fw-bolder mb-1">
            فروعنا
          </div>
          <div class="footer__list">
            <div class="d-flex gap-3 mb-3">
              <div class="fs-5"><i class="fa-solid fa-location-dot"></i></div>
              <div class="text-gray">فرع طنطا: ش بطرس مع سعيد امام المركز الطبى - طنطا.</div>
            </div>
            <div class="d-flex gap-3">
              <div class="fs-5"><i class="fa-solid fa-location-dot"></i></div>
              <div class="text-gray">فرع اسكندرية: ش جمال عبد الناصر - تحت كوبرى 45 - ميامى.</div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 mb-5 mb-lg-0">
          <div>
            <div class="footer__list-title fw-bolder mb-1">
              تحتاج مساعدة ؟
            </div>
            <div class="d-flex gap-3 mb-3">
              <div class="fs-5"><i class="fa-solid fa-envelope"></i></div>
              <div class="text-gray">coding.arabic@gmail.com</div>
            </div>
          </div>
          <div>
            <div class="footer__list-title fw-bolder mb-3">
              اشترك في نشرتنا
            </div>
            <form class="footer__form position-relative">
              <input
                class="footer__email-input w-100 bg-transparent border border-white py-2 px-3 rounded-2 text-white pe-5"
                placeholder="البريد الالكتروني">
              <button
                class="footer__submit mx-3 position-absolute top-50 translate-middle-y end-0 bg-transparent border-0 text-white d-flex align-items-center"><i
                  class="fa-solid fa-paper-plane"></i></button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="footer__bottom text-center p-3 section-container">
      جميع الحقوق محفوظة Eraasoft 2023
    </div>
  </footer>
  <!-- Footer Section End -->


  <script src="assets/js/vendors/all.min.js"></script>
  <script src="assets/js/vendors/bootstrap.bundle.min.js"></script>
  <script src="assets/js/vendors/jquery-3.7.0.js"></script>
  <script src="assets/js/vendors/owl.carousel.min.js"></script>
  <script src="assets/js/app.js"></script>
</body>

</html>