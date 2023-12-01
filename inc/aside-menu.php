<!-- Menu -->
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a href="index.html" class="app-brand-link">
      <span class="app-brand-logo demo">
        <img src="<?php route("assets/logo1.png") ?>" width="40">
      </span>
      <span class="app-brand-text demo menu-text fw-bold ms-2" style="text-transform: none;">ThirdFace</span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    <!-- Dashboards -->
    <li class="menu-item <?php if(getCurrentRoute() == "dashboard/"){ echo "active"; } ?>">
      <a href="<?php route("dashboard") ?>" class="menu-link">
        <i class="menu-icon fa-solid fa-house"></i>
        <div data-i18n="Dashboards">Boshqaruv paneli</div>
      </a>
    </li>

    <li class="menu-item <?php if(getCurrentRoute() == "directions/"){ echo "active"; } ?>">
      <a href="<?php route("directions") ?>" class="menu-link">
        <i class="menu-icon fa-solid fa-building-columns"></i>
        <div>Yonalishlar</div>
      </a>
    </li>

    <li class="menu-item <?php if(getCurrentRoute() == "subjects/"){ echo "active"; } ?>">
      <a href="<?php route("subjects") ?>" class="menu-link">
        <i class="menu-icon fa-solid fa-book"></i>
        <div>Fanlar</div>
      </a>
    </li>

    <li class="menu-item <?php if(getCurrentRoute() == "topics/"){ echo "active"; } ?>">
      <a href="<?php route("topics") ?>" class="menu-link">
        <i class="menu-icon fa-solid fa-book-bookmark"></i>
        <div>Mavzular</div>
      </a>
    </li>

    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">Monitorlar</span>
    </li>

    <li class="menu-item <?php if(getCurrentRoute() == "monitors/"){ echo "active"; } ?>">
      <a href="<?php route("monitors") ?>" class="menu-link">
        <i class="menu-icon fa-solid fa-tv"></i>
        <div>Monitorlar</div>
      </a>
    </li>

    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">Sozlamalar</span>
    </li>

    <li class="menu-item">
      <a href="<?php route("settings") ?>" class="menu-link">
        <i class="menu-icon fa-solid fa-sliders"></i>
        <div>Platforma sozlamalari</div>
      </a>
    </li>

    <!-- Misc -->
    <li class="menu-header small text-uppercase"><span class="menu-header-text">Other</span></li>
    <li class="menu-item">
      <a href="https://github.com/themeselection/sneat-html-admin-template-free/issues" target="_blank" class="menu-link">
        <i class="menu-icon tf-icons bx bx-support"></i>
        <div data-i18n="Support">Support</div>
      </a>
    </li>
  </ul>
</aside>
<!-- / Menu -->