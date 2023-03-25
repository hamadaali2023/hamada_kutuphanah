    <div class="main-menu-content">
      <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
       
        <li class="nav-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
            <a href="{{url('admin/dashboard')}}"><i class="la la-envelope"></i><span class="menu-title" data-i18n="">الرئيسية</span></a>
        </li>
        <li class="nav-item {{ Request::is('admin/categories') ? 'active' : '' }}">
            <a href="{{url('admin/categories')}}"><i class="la la-envelope"></i><span class="menu-title" data-i18n="">التخصصات</span></a>
        </li>
        <li class="nav-item {{ Request::is('admin/products') ? 'active' : '' }}">
            <a href="{{url('admin/products')}}"><i class="la la-envelope"></i><span class="menu-title" data-i18n="">المنتجات</span></a>
        </li>
        <li class="nav-item {{ Request::is('admin/childcategory') ? 'active' : '' }}">
            <a href="{{url('admin/childcategory')}}"><i class="la la-envelope"></i><span class="menu-title" data-i18n="">الطلبات</span></a>
        </li>
        
        <!-- <li class=" nav-item"><a href="#"><i class="la la-bolt"></i><span class="menu-title" data-i18n="nav.flot_charts.main">الإعدادات</span></a>
          <ul class="menu-content">
            <li  class="{{ Request::is('admin/settings') ? 'active' : '' }}"> 
                <a class="menu-item" href="{{ url('admin/settings') }}" data-i18n="nav.flot_charts.flot_line_charts">الاعدادات</a>
            </li>
          
            <li  class="{{ Request::is('admin/privacy') ? 'active' : '' }}"> 
                <a class="menu-item" href="{{url('admin/privacy')}}" data-i18n="nav.flot_charts.flot_bar_charts">سياسية الخصوصية</a>
            </li>
            <li  class="{{ Request::is('admin/contact') ? 'active' : '' }}"> 
                <a class="menu-item" href="{{url('admin/contact')}}" data-i18n="nav.flot_charts.flot_pie_charts">معلومات التواصل</a>
            </li>
             <li  class="{{ Request::is('admin/terms') ? 'active' : '' }}"> 
                <a class="menu-item" href="{{url('admin/terms')}}" data-i18n="nav.flot_charts.flot_pie_charts">الشروط والتعليمات</a>
            </li>
             <li  class="{{ Request::is('admin/return_policy') ? 'active' : '' }}"> 
                <a class="menu-item" href="{{url('admin/return_policy')}}" data-i18n="nav.flot_charts.flot_pie_charts">سياسة الإرجاع</a>
            </li>
          </ul>
        </li> -->
        
        <!-- <li class="nav-item {{ Request::is('admin/videoviews') ? 'active' : '' }}">
            <a href="{{url('admin/videoviews')}}"><i class="la la-envelope"></i><span class="menu-title" data-i18n="">المشاهدات</span></a>
        </li>
        <li class="nav-item {{ Request::is('admin/sliders') ? 'active' : '' }}">
            <a href="{{url('admin/sliders')}}"><i class="la la-envelope"></i><span class="menu-title" data-i18n="">اسلايدر</span></a>
        </li>
       
        <li class="nav-item {{ Request::is('admin/countries') ? 'active' : '' }}">
            <a href="{{url('admin/countries')}}"><i class="la la-envelope"></i><span class="menu-title" data-i18n="">الدولة</span></a>
        </li>

        <li class="nav-item {{ Request::is('admin/profile') ? 'active' : '' }}">
            <a href="{{url('admin/profile')}}"><i class="la la-envelope"></i><span class="menu-title" data-i18n="">حسابي</span></a>
        </li>
        -->
        

      </ul>
    </div>
  </div>